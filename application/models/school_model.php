<?php
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property email_actions           $email_actions
    */   
  
  class School_model extends CI_Model
  {
      protected $photo=FALSE;
      
      protected $error='';
      
      protected $search_colums;
      
      function __construct()
      {
          parent::__construct();
          $this->load->language('actions');
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      function upload_photo($user_id,$person_type)
      {
         if (isset($_FILES['user_avatar'])  AND ($_FILES['user_avatar']['error']==0))
         {
             $this->load->library('upload',array('upload_path'=>PHOTOS_LOCATION,'allowed_types'=>'gif|jpg|jpeg|png','max_size'=>'300','encrypt_name'=>TRUE));
             
             if (!$this->upload->do_upload('user_avatar'))
             {
                 $this->set_error($this->upload->display_errors());
                 return FALSE;
             }

             $this->load->library('image_lib',array('image_library'=>'gd2','source_image'=>$this->upload->upload_path.$this->upload->file_name,'maintain_ratio'=>TRUE,'width'=>140,'height'=>140)); 

             if (!$this->image_lib->resize())
             {
                 $this->set_error($this->image_lib->display_errors());
                 return FALSE;
             } 
             
             $this->delete_current_photo($user_id,$person_type);
             
             $this->photo='avatars/'.$this->upload->file_name;
         }
         elseif($this->input->post('delete_photo')=='1')
         {
             $this->delete_current_photo($user_id,$person_type);
         }
         
         return TRUE;
      }
      
      private function delete_current_photo($person_id,$person_type)
      {
          if ($person_id=='0')
          {
              return ;
          }
          
          $this->db->select('avatar');
          
          switch($person_type)
          {
              case 'teacher':{
                  $current_photo=$this->db->where('teacher_id',$person_id)->get('teachers');
                  break;
              }
              case 'student':{
                  $current_photo=$this->db->where('student_id',$person_id)->get('students');
                  break;
              }
              case 'parent':{
                  $current_photo=$this->db->where('parent_id',$person_id)->get('parents');
                  break;
              }
              case 'donor':{
                  $current_photo=$this->db->where('donor_id',$person_id)->get('donors');
                  break;
              }
          }
          
          $current_photo=$current_photo->row_array();
          
          if ($current_photo['avatar']!=DEFAULT_PHOTO)
          {
              unlink(PHOTOS_LOCATION.pathinfo($current_photo['avatar'],PATHINFO_BASENAME));
          }
          
          $this->photo=DEFAULT_PHOTO;
      }
      
      function check_user_email($email,$person_id,$person_type)
      {
          return $this->db->query('SELECT user_id
                                   FROM users
                                   WHERE user_email=? AND person_id!=? AND person_type=?',array($email,$person_id,$person_type))->num_rows()==0?TRUE:FALSE;
      }
      
      function delete_user($person_id,$person_type)
      {
          $this->db->delete('users',array('person_id'=>$person_id,'person_type'=>$person_type));
      }
      
      function prepare_filters($status_table='')
      {
          if ($this->input->get('iDisplayLength') AND $this->input->get('iDisplayStart')!='-1')
          {
              $this->db->limit((int)$this->input->get('iDisplayLength'),(int)$this->input->get('iDisplayStart'));
          }
          
          if (isset($_GET['iSortCol_0']))
          {
              for ($i=0;$i<intval($this->input->get('iSortingCols'));$i++)
              {
                  if (($this->input->get('bSortable_'.intval($this->input->get('iSortCol_'.$i))) == "true")  AND (isset($this->search_colums[intval($this->input->get('iSortCol_'.$i))])))
                  {
                      $this->db->order_by($this->search_colums[intval($this->input->get('iSortCol_'.$i))],$this->input->get('sSortDir_'.$i)==='asc'?'asc':'desc');
                  }
              }
          }
          else
          {
              $this->db->order_by('name');
          }
          
          if ($this->input->get('sSearch'))
          {
              for ( $i=0 ; $i<count($this->search_colums) ; $i++ )
              {
                  $this->db->_like($this->search_colums[$i],$this->input->get('sSearch'),'OR');
              }
          }
          
          if ($this->input->get('deleted')=='false')
          {
              $this->db->where_in(($status_table?($status_table.'.'):'').'status',array('Active','Inactive'));    
          }
      }
      
      function invite_person($person_type,$id,$name,$email)
      {
          $this->load->model('email_actions');
          $this->email_actions->invite_person($person_type,$name,$email,$id);
      }
      
      function resend_invitation($person_id,$person_type)
      {
          switch($person_type)
          {
              case 'teacher':{
                  $person=$this->get_teacher($person_id);
                  $person['id']=$person['teacher_id'];
                  break;
              }
              case 'student':{
                  $person=$this->get_student($person_id);
                  $person['id']=$person['student_id'];
                  break;
              }
              case 'parent':{
                  $person=$this->get_parent($person_id);
                  $person['id']=$person['parent_id'];
                  break;
              }
              case 'donor':{
                  $person=$this->get_donor($person_id);
                  $person['id']=$person['donor_id'];
                  break;
              }
          }
          
          $this->invite_person($person_type,(int)$person['id'],$person['name'],$person['email']);
      }
      
      function update_user_email($person_type,$person_id,$email)
      {
          $this->db->update('users',array('user_email'=>$email),array('person_id'=>$person_id,'person_type'=>$person_type));
      }
      
      function get_relatives($person_id,$person_type)
      {
          $this->db->select('`name`',FALSE);
          if ($person_type=='student')
          {
              $this->db
                   ->select('parents.parent_id as id') 
                   ->join('parents','parents.parent_id = students_parents.parent_id','LEFT')
                   ->where('student_id',$person_id)
                   ->where_in('status',array('Active','Inactive'));
          }
          else
          {
              $this->db
                   ->select('students.student_id as id') 
                   ->join('students','students.student_id = students_parents.student_id','LEFT')
                   ->where('parent_id',$person_id)
                   ->where_in('status',array('Active','Inactive'));
          }
          
          return $this->db
                      ->get('students_parents')
                      ->result_array();
      }
      
      function get_student_donors($person_id,$person_type)
      {
          $this->db->select(' `name`',FALSE);
          if ($person_type=='student')
          {
              $this->db
                   ->select('donors.donor_id as id') 
                   ->join('donors','donors.donor_id = students_donors.donor_id','LEFT')
                   ->where('student_id',$person_id)
                   ->where_in('status',array('Active','Inactive'));
          }
          else
          {
              $this->db
                   ->select('students.student_id as id') 
                   ->join('students','students.student_id = students_donors.student_id','LEFT')
                   ->where('donor_id',$person_id)
                   ->where_in('status',array('Active','Inactive'));
          }
          
          return $this->db
                      ->get('students_donors')
                      ->result_array();
      }
  }
?>