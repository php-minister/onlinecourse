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
    
  class Parents_actions extends School_model
  {
      protected $search_colums=array('parents.parent_id','parents.name','parents.status','parents.address','parents.city','students.name');
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_parents()
      {
          $this->prepare_filters('parents');
          
          $this->db
               ->select('SQL_CALC_FOUND_ROWS parents.parent_id, parents.name as name ,IFNULL(GROUP_CONCAT(students.name SEPARATOR ", "),"-")as students_name,parents.`status`',FALSE)
               ->join('students_parents','students_parents.parent_id = parents.parent_id','LEFT')
               ->join('students','students.student_id = students_parents.student_id','LEFT')
               ->group_by('parents.parent_id')
               ->from('parents');
          
          $data=$this->db
                     ->query(preg_replace('/AND\s*(`parents`.`parent_id`.*?)GROUP/si','AND ($1) GROUP ',$this->db->_compile_select()))
                     ->result_array();
          
          $result['rows']=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
          $result['rows']=$result['rows']['rows'];
          
          $result['data']=array();
          
          foreach($data as $item)
          {
              $item['actions']=sprintf($this->lang->line('parents_actions_edit'),$item['parent_id']);
              
              if (preg_match('/active/i',$item['status']))
              {
                  $item['actions'].=sprintf($this->lang->line('parents_actions_delete'),$item['parent_id']);
              }
              $result['data'][]=$item;
          }
          
          $result['count']=$this->db->query('SELECT COUNT(teacher_id) as `count` FROM teachers')->row_array();
          $result['count']=$result['count']['count'];          
          
          return $result;
      }
      
      function save_parent()
      {
         if (!$this->upload_photo($this->input->post('parent_id'),'parent'))
         {
             return FALSE;
         }
         
         $data=array(
                'name'=>$this->input->post('parent_name'),
                'birth_date'=>($this->input->post('birth_date'))?date('Y-m-d',strtotime($this->input->post('birth_date'))):null,
                'gender'=>($this->input->post('gender')=='male'?'male':'female'),
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
         
         if ($this->input->post('parent_id')=='0')
         {
             $this->db->insert('parents',$data);
             $result['result']=$this->db->insert_id();
             $this->assign_children($result['result']);
             $this->invite_person('parent',$result['result'],$this->input->post('parent_name'),$this->input->post('email'));
             return $result;
         }
         
         $this->db->update('parents',$data,array('parent_id'=>$this->input->post('parent_id')));
         $this->update_user_email('parent',$this->input->post('parent_id'),$this->input->post('email'));
         $this->assign_children($this->input->post('parent_id'));
         $result['result']=TRUE;
         return $result;
      }
      
      function get_parent($parent_id)
      {
          $parent = $this->db
                      ->select('*')
                      ->where('parent_id',$parent_id)
                      ->get('parents')
                      ->row_array();
          
          $parent['children']=$this->get_relatives($parent_id,'parent');
          
          return $parent;
      }
      
      function change_status($new_status,$parent_id)
      {
          switch($new_status)
          {
              case 'deleted':{
                  $this->db->update('parents',array('status'=>ucfirst($new_status)),array('parent_id'=>$parent_id));
                  $this->delete_user($parent_id,'parent');
                  break;
              }
              case 'restore':{
                  $parent=$this->db->select('email,name')->where('parent_id',$parent_id)->get('parents')->row_array();
                  
                  if (count($parent)==0)
                  {
                      $this->set_error($this->lang->line('parent_not_found'));
                      return FALSE;
                  }
                  
                  if (!$this->check_user_email($parent['email'],$parent_id,'parent'))
                  {
                      $this->set_error($this->lang->line('error_email_used'));
                      return FALSE;
                  }
                  
                  $this->invite_person('parent',$parent_id,$parent['name'],$parent['email']);
                  
                  $this->db->update('parents',array('status'=>'Inactive'),array('parent_id'=>$parent_id));
                  break;
              }
			  case 'active':
			  {
				  $this->db->update('parents',array('status'=>'Active'),array('parent_id'=>$parent_id));
				  $this->db->update('users',array('is_active'=>'1'),array('person_id'=>$parent_id));	
			  }
			  case 'inactive' :
			  {
				   $this->db->update('parents',array('status'=>'Inactive'),array('parent_id'=>$parent_id)); 
				   $this->db->update('users',array('is_active'=>'0'),array('person_id'=>$parent_id));
			  }
          }
          
          return TRUE;
      }
      
      private function assign_children($parent_id)
      {
          $children=json_decode($this->input->post('children_list'),TRUE);
          if ((!is_array($children)))
          {
              return FALSE;
          }
          
          $this->db->delete('students_parents',array('parent_id'=>$parent_id));
          $new_children=array();
          foreach($children as $child_id)
          {
              $new_children[]=array('student_id'=>(int)$child_id,'parent_id'=>$parent_id);
          }
          
          $this->db->insert_batch('students_parents',$new_children);
      }
      
      function get_parents_list()
      {
          return $this->db
                      ->select('parent_id as id, name',FALSE)
                      ->where_in('status',array('Active','Inactive'))
                      ->where('( name LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->order_by('name')
                      ->limit(10)
                      ->get('parents')
                      ->result_array();
      }
      
      
      function get_children()
      {
          $this->db->ar_aliased_tables[]='"Active"';
          $this->db->ar_aliased_tables[]='"Inactive")';
          return $this->db
                      ->select('students.student_id,name,status,avatar')
                      ->join('students','students.student_id = students_parents.student_id','LEFT')
                      ->where('parent_id',$this->session->userdata('person_id'))
                      ->order_by('FIELD(status,"Active","Inactive")','DESC')
                      ->get('students_parents')
                      ->result_array();
      }
      
      function is_child($student_id)
      {
          return $this->db
                      ->select('student_id')
                      ->where(array('student_id'=>$student_id,'parent_id'=>$this->session->userdata('person_id')))
                      ->get('students_parents')
                      ->num_rows()>0?TRUE:FALSE;
      }
  }
?>