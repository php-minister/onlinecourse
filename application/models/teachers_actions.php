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
  class Teachers_actions extends School_model
  {
      protected $search_colums=array('teacher_id','name','status','address','city');
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_teachers()
      {
          $this->prepare_filters();
          
          $this->db
               ->select('SQL_CALC_FOUND_ROWS teacher_id,name,ssn,status',FALSE)
               ->from('teachers');
          
          $data=$this->db
                     ->query(preg_replace('/(`teacher_id.*?)ORDER/si','($1) ORDER ',$this->db->_compile_select()))
                     ->result_array();
          
          $result['rows']=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
          $result['rows']=$result['rows']['rows'];
          
          $result['data']=array();
          
          foreach($data as $item)
          {
              $item['actions']=sprintf($this->lang->line('teacher_actions_edit'),$item['teacher_id'],$item['teacher_id']);
              
              if (preg_match('/active/i',$item['status']))
              {
                  $item['actions'].=sprintf($this->lang->line('teacher_actions_delete'),$item['teacher_id']);
              }
			 $q =  mysql_query("SELECT SUM(rating) AS ratings , COUNT(*) AS num_row FROM teachers_comments WHERE teacher_id =".$item['teacher_id']);
			 $ratings =0;
			 $rating_array = mysql_fetch_array($q);
			 if(isset($rating_array['ratings']))
			 {
			 	$ratings = $rating_array['ratings']/$rating_array['num_row'];
				$ratings = number_format( round($ratings, 1), 2);
			 }
			 

			  
			  $item['ratings'] = $ratings;
              $result['data'][]=$item;
          }
          
          $result['count']=$this->db->query('SELECT COUNT(teacher_id) as `count` FROM teachers')->row_array();
          $result['count']=$result['count']['count'];          
          
          return $result;
      }
      
      function save_teacher()
      {
         if (!$this->upload_photo($this->input->post('teacher_id'),'teacher'))
         {
             return FALSE;
         }
         
         $data=array(
                'name'=>$this->input->post('teacher_name'),
                'birth_date'=>($this->input->post('birth_date'))?date('Y-m-d',strtotime($this->input->post('birth_date'))):null,
                'gender'=>($this->input->post('gender')=='male'?'male':'female'),
                'ssn'=>($this->input->post('ssn'))?date('Y-m-d',strtotime($this->input->post('ssn'))):null,
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'zip_code'=>$this->input->post('zip_code'),
                'home_phone'=>$this->input->post('home_phone'),
                'cell_phone'=>$this->input->post('cell_phone'),
                'email'=>$this->input->post('email')
         );
         
         $result['status']=TRUE;
         if ($this->photo)
         {
             $result['photo']=$data['avatar']=$this->photo;
         }
         
         if ($this->input->post('teacher_id')=='0')
         {
             $this->db->insert('teachers',$data);
             $result['result']=$this->db->insert_id();
             $this->invite_person('teacher',$result['result'],$this->input->post('teacher_name'),$this->input->post('email'));
             return $result;
         }
         
         $this->db->update('teachers',$data,array('teacher_id'=>$this->input->post('teacher_id')));
         $this->update_user_email('teacher',$this->input->post('teacher_id'),$this->input->post('email'));
         $result['result']=TRUE;
         return $result;
      }
      
      function get_teachers_list()
      {
          return $this->db
                      ->select('name,teacher_id as id,ssn')
                      ->where_in('status',array('Active','Inactive'))
                      ->order_by('name','ASC')
                      ->get('teachers')
                      ->result_array();
      }
      
      function search_teachers()
      {
          return $this->db
                      ->select('teacher_id as id,CONCAT(name,"<span class=\'person_details\'> (",ssn,")</span>") as name',FALSE)
                      ->where_in('status',array('Active','Inactive'))
                      ->where('(name LIKE "%'.$this->input->post('query').'%" OR ssn LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->order_by('name')
                      ->limit(10)
                      ->get('teachers')
                      ->result_array();
      }
      
      
      function get_teacher($teacher_id)
      {
          return $this->db
                      ->select('*')
                      ->where('teacher_id',$teacher_id)
                      ->get('teachers')
                      ->row_array();
      }
      
      function change_status($new_status,$teacher_id)
      {
          switch($new_status)
          {
              case 'restore':
              {
                  $teacher=$this->db->select('email,name')->where('teacher_id',$teacher_id)->get('teachers')->row_array();
                  
                  if (count($teacher)==0)
                  {
                      $this->set_error($this->lang->line('teacher_not_found'));
                      return FALSE;
                  }
                  
                  if (!$this->check_user_email($teacher['email'],$teacher_id,'teacher'))
                  {
                      $this->set_error($this->lang->line('error_email_used'));
                      return FALSE;
                  }
                  
                  $this->invite_person('teacher',$teacher_id,$teacher['name'],$teacher['email']);
                  
                  $this->db->update('teachers',array('status'=>'Inactive'),array('teacher_id'=>$teacher_id));
                  break;
              }
              case 'deleted';
              case 'resigned':
              {
                 $this->db->update('teachers',array('status'=>ucfirst($new_status)),array('teacher_id'=>$teacher_id));
                 $this->delete_user($teacher_id,'teacher');
                 break; 
              }
			  case 'inactive':
			  {
                  $this->db->update('teachers',array('status'=>'Inactive'),array('teacher_id'=>$teacher_id));
				  $this->db->update('users',array('is_active'=>'0'),array('person_id'=>$teacher_id));
                 break; 				  
			  }
			  case 'active':
			  {
                  $this->db->update('teachers',array('status'=>'Active'),array('teacher_id'=>$teacher_id));
				  $this->db->update('users',array('is_active'=>'1'),array('person_id'=>$teacher_id));				 
                 break; 				  
			  }			  
          }
          
          return TRUE;
      }
      
      function get_teacher_subjects($teacher_id)
      {
          $subjects=$this->db
                         ->select('subjects.subject_id,subjects.name as subject_name,grades.grade_id,grades.name as grade_name,IFNULL(GROUP_CONCAT(CONCAT(students_groups.group_id,"|",students_groups.group_name)),"") as groups',FALSE)
                         ->join('subjects','subjects.subject_id = teacher_subjects.subject_id','LEFT')
                         ->join('grades','grades.grade_id = teacher_subjects.grade_id','LEFT')
                         ->join('students_groups','students_groups.grade_id = grades.grade_id','LEFT')
                         ->where('teacher_id',$teacher_id)
                         ->group_by('subjects.subject_id,grades.grade_id')
                         ->get('teacher_subjects')
                         ->result_array();
          $result=array('subjects'=>array(),'grades'=>array());
          foreach($subjects as $subject)
          {
              $result['subjects'][$subject['subject_id']]=$subject['subject_name'];
              $result['grades'][$subject['subject_id']][]=array('name'=>$subject['grade_name'],'id'=>$subject['grade_id'],'groups'=>$subject['groups']);
          }
          
          return $result;
      }
      
      function get_teacher_name($teacher_id)
      {
          $teacher=$this->get_teacher($teacher_id);
          return $teacher['name'];
      }
  }
?>