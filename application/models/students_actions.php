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
  class Students_actions extends School_model
  {
      protected $search_colums=array('student_id','students.name','grades.name','status','address','city');
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_students()
      {
          $this->prepare_filters();
          
          $this->db
               ->select('SQL_CALC_FOUND_ROWS student_id,CONCAT(students.name," (",IFNULL(grades.name,"-"),")") as name,status',FALSE)
               ->join('grades','grades.grade_id = students.grade','LEFT')
               ->from('students');
               
          $data=$this->db
                     ->query(preg_replace('/(`student_id.*?)ORDER/si','($1) ORDER ',$this->db->_compile_select()))
                     ->result_array();
          
          $result['rows']=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
          $result['rows']=$result['rows']['rows'];
          
          $result['data']=array();
          
          foreach($data as $item)
          {
			  // Total fee of student
			  $query  = mysql_query("select * from fees_members, fees where fees.fee_id = fees_members.fee_id and  student_id = ".$item['student_id']);
			  $total_fees = 0;
			  while($result_fee = mysql_fetch_array($query))
			  {
				  $total_fees += $result_fee['amount'];
			  }
			  
			  $item['total_fees'] = $total_fees;
              
			  // Total fee PAID BY STUDENT
			  $query  = mysql_query("select * from fees_members, fees where fees.fee_id = fees_members.fee_id and is_paid =1 and student_id = ".$item['student_id'] );
			  $paid_fees = 0;
			  while($result_paid_fee = mysql_fetch_array($query))
			  {
				  $paid_fees += $result_paid_fee['amount'];
			  }
			  
			  $item['paid_fees'] = $paid_fees;
              
			  // Donor Names			  
			  $q = "SELECT donors.name , students_donors.donor_id  FROM `donors` , students_donors WHERE students_donors.donor_id = donors.donor_id AND students_donors.student_id = ".$item['student_id'];
			  $query  = mysql_query($q);
			  $donors_html = '';
			  while($result_query = mysql_fetch_array($query))
			  {	
				  $donors_html.= '<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="View donor" href="donors/view/'.$result_query["donor_id"].'">'.$result_query['name'].'</a>';
			  }
			  
			  // Parents Names			  
			  $q = "SELECT parents.name , students_parents.parent_id  FROM `parents` , students_parents WHERE students_parents.parent_id = parents.parent_id AND students_parents.student_id =".$item['student_id'];
			  $query  = mysql_query($q);
			  $parents_html = '';
			  while($result_query = mysql_fetch_array($query))
			  {	
				  $parents_html.= '<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="View donor" href="parents/view/'.$result_query["parent_id"].'">'.$result_query['name'].'</a>';
			  }			  
			  
			  $item['donors_name'] = $donors_html;
			  $item['parents_name'] = $parents_html;
			  $item['actions']=sprintf($this->lang->line('student_actions_edit'),$item['student_id']);
              			 			  
              if (preg_match('/active/i',$item['status']))
              {
                  $item['actions'].=sprintf($this->lang->line('student_actions_delete'),$item['student_id']);
              }
			  $item['actions'] .= ' <a class="btn btn-small" href="students/scheduling/'.$item["student_id"].'"> <i class="icon-calendar"></i><span class="hidden-phone">'.$this->lang->line("scheduling").'</span></a>';
			  $item['actions'] .= ' <a class="btn btn-small" href="students/attendance/'.$item["student_id"].'"><i class="icon-ok"></i><span class="hidden-phone">'.$this->lang->line("attendance").'</span></a>';
			  $item['actions'] .=  sprintf($this->lang->line('view_payment'),$item['student_id']);
			  $item['actions'] .= sprintf($this->lang->line('student_actions_edit_class_url'),$item['student_id']);			  
              $result['data'][]=$item;
          }
          
          $result['count']=$this->db->query('SELECT COUNT(student_id) as `count` FROM students')->row_array();
          $result['count']=$result['count']['count'];          
          
          return $result;
      }
      
      function save_student()
      {
         if (!$this->upload_photo($this->input->post('student_id'),'student'))
         {
             return FALSE;
         }
         
         $data=array(
                'name'=>$this->input->post('student_name'),
                'birth_date'=>($this->input->post('birth_date'))?date('Y-m-d',strtotime($this->input->post('birth_date'))):null,
				'join_date'=>($this->input->post('join_date'))?date('Y-m-d',strtotime($this->input->post('join_date'))):null,
                'gender'=>($this->input->post('gender')=='male'?'male':'female'),
                'ssn'=>$this->input->post('ssn'),
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'zip_code'=>$this->input->post('zip_code'),
                'home_phone'=>$this->input->post('home_phone'),
                'cell_phone'=>$this->input->post('cell_phone'),
                'email'=>$this->input->post('email'),
                'grade'=>$this->input->post('grade'),
                'group'=>$this->input->post('group'),
                'part_of_donation'=>$this->input->post('part_of_donation')
         );
         
         $result['status']=TRUE;
         if ($this->photo)
         {
             $result['photo']=$data['avatar']=$this->photo;
         }
         
         if ($this->input->post('student_id')=='0')
         {
             $this->db->insert('students',$data);
             $result['result']=$this->db->insert_id();
             $this->assign_parents($result['result']);
             $this->assign_donors($result['result']);
             $this->invite_person('student',$result['result'],$this->input->post('student_name'),$this->input->post('email'));
             return $result;
         }
         
         $data['old_group']=NULL;
         $this->db->update('students',$data,array('student_id'=>$this->input->post('student_id')));
         $this->update_user_email('student',$this->input->post('student_id'),$this->input->post('email'));
         $this->assign_parents($this->input->post('student_id'));
         $this->assign_donors($this->input->post('student_id'));
         $result['result']=TRUE;
         return $result;
      }
      
      function get_student($student_id,$is_bief=FALSE)
      {
          $student = $this->db
                      ->select('*')
                      ->where('student_id',$student_id)
                      ->get('students')
                      ->row_array();
          
          if (!$is_bief)
          {
              $student['parents']=$this->get_relatives($student_id,'student');
              
              $student['donors']=$this->get_student_donors($student_id,'student');
          }
          
          return $student;
      }
      
      function change_status($new_status,$student_id)
      {
          switch($new_status)
          {
              case 'restore':
              {
                  $student=$this->db->select('email,name')->where('student_id',$student_id)->get('students')->row_array();
                  
                  if (count($student)==0)
                  {
                      $this->set_error($this->lang->line('student_not_found'));
                      return FALSE;
                  }
                  
                  if (!$this->check_user_email($student['email'],$student_id,'student'))
                  {
                      $this->set_error($this->lang->line('error_email_used'));
                      return FALSE;
                  }
                  
                  $this->invite_person('student',$student_id,$student['name'],$student['email']);
                  
                  $this->db->update('students',array('status'=>'Inactive'),array('student_id'=>$student_id));
                  break;
              }
              case 'deleted';
              case 'left';
              case 'graduated':
              {
                  $this->db->update('students',array('status'=>ucfirst($new_status)),array('student_id'=>$student_id));
                  $this->delete_user($student_id,'student');
                  break;
              }
			  case 'active':
			  {
				  $this->db->update('students',array('status'=>'Active'),array('student_id'=>$student_id));
				  $this->db->update('users',array('is_active'=>'1'),array('person_id'=>$student_id));	
				  break;
			  }
			  case 'inactive':
			  {
				  $this->db->update('students',array('status'=>'Inactive'),array('student_id'=>$student_id));
				  $this->db->update('users',array('is_active'=>'0'),array('person_id'=>$student_id));
				  break;
			  }
          }
          
          return TRUE;
      }
      
      private function assign_parents($student_id)
      {
          $parents=json_decode($this->input->post('parents_list'),TRUE);
          if ((!is_array($parents)))
          {
              return FALSE;
          }
          
          $this->db->delete('students_parents',array('student_id'=>$student_id));
          $new_parents=array();
          foreach($parents as $parent_id)
          {
              $new_parents[]=array('student_id'=>$student_id,'parent_id'=>(int)$parent_id);
          }
          
          $this->db->insert_batch('students_parents',$new_parents);
      }
      
      private function assign_donors($student_id)
      {
         $donors=json_decode($this->input->post('donors_list'),TRUE);
          if ((!is_array($donors)))
          {
              return FALSE;
          }
          
          $this->db->delete('students_donors',array('student_id'=>$student_id));
          $new_donors=array();
          foreach($donors as $donor_id)
          {
              $new_donors[]=array('student_id'=>$student_id,'donor_id'=>(int)$donor_id);
          }
          
          $this->db->insert_batch('students_donors',$new_donors); 
      }
      
      function get_students_list()
      {
          return $this->db
                      ->select('student_id as id,CONCAT(students.name,"<span class=\'person_details\'> (",IFNULL(grades.name,"-"),", ",ssn,")</span>") as name',FALSE)
                      ->join('grades','grades.grade_id = students.grade','LEFT')
                      ->where_in('status',array('Active','Inactive'))
                      ->where('( students.name LIKE "%'.$this->input->post('query').'%" OR ssn LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->order_by('students.name')
                      ->limit(10)
                      ->get('students')
                      ->result_array();
      }
      
      function is_student_involved($lesson_id)
      {
          $this->db->_reserved_identifiers[]=(int)$lesson_id;
          
          return $this->db
                      ->select('students.student_id')
                      ->join('scheduling','scheduling.scheduling_id='.(int)$lesson_id,'LEFT')
                      ->where('student_id',$this->session->userdata('person_id'))
                      ->where('((students.grade=scheduling.grade AND scheduling.student_group  IN (students.`group`,0)) OR (is_private REGEXP \'(^'.$this->session->userdata('person_id').',|,'.$this->session->userdata('person_id').',|,'.$this->session->userdata('person_id').'$|^'.$this->session->userdata('person_id').'$)\'))  AND CONCAT(date," ",end_time)<NOW()',NULL,FALSE)
                      ->get('students')
                      ->num_rows()>0?TRUE:FALSE;
      }
      
      function get_teachers_students_list()
      {
          return $this->db
                      ->select('student_id as id,CONCAT(students.name,"<span class=\'person_details\'> (",IFNULL(grades.name,"-"),", ",ssn,")</span>") as name',FALSE)
                      ->join('grades','grades.grade_id  = teacher_subjects.grade_id','LEFT')
                      ->join('students','students.grade = teacher_subjects.grade_id','LEFT')
                      ->where('teacher_id',$this->session->userdata('person_id'))
                      ->where('student_id IS NOT NULL',NULL,FALSE)
                      ->where('( students.name LIKE "%'.$this->input->post('query').'%" OR ssn LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->group_by('students.student_id')
                      ->order_by('students.name')
                      ->limit(10)
                      ->get('teacher_subjects')
                      ->result_array();
      }
	  
	  function save_student_url()
	  {
		  $student_id = $this->input->post('student_id');
		  $class_attend_url = $this->input->post('student_url');
		 $this->db->update('students',array('class_attend_url'=> $class_attend_url),array('student_id'=>$this->input->post('student_id')));
         return $result['result']=TRUE;
	  }
  }
?>