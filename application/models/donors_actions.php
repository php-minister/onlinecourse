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
	  
  class Donors_actions  extends School_model
  {
      protected $search_colums=array('donors.donor_id','donors.name','donors.status','donors.address','donors.city','students.name');
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_donors()
      {
          $this->prepare_filters('donors');
          
          $this->db
               ->select('SQL_CALC_FOUND_ROWS donors.donor_id,CONCAT(donors.name," <br/><i><small>",IFNULL(GROUP_CONCAT(students.name SEPARATOR ","),"-"),"</small></i>") as name,donors.`status`',FALSE)
               ->join('students_donors','students_donors.donor_id = donors.donor_id','LEFT')
               ->join('students','students.student_id = students_donors.student_id','LEFT')
               ->group_by('donors.donor_id')
               ->from('donors');
          
          $data=$this->db
                     ->query(preg_replace('/AND\s*(`donors`.`donor_id`.*?)GROUP/si','AND ($1) GROUP ',$this->db->_compile_select()))
                     ->result_array();
          
          $result['rows']=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
          $result['rows']=$result['rows']['rows'];
          
          $result['data']=array();
          
          foreach($data as $item)
          {
              $item['actions']=sprintf($this->lang->line('donors_actions_edit'),$item['donor_id'],$item['donor_id']);
              
			  // Total number of students of the donor			 			  
			 $q = mysql_query( "SELECT * FROM students_donors , students where students_donors.donor_id = ".$item['donor_id']." and students.student_id = students_donors.student_id");
			 	$num_of_students = mysql_num_rows($q);
			  $item['number_of_students'] = $num_of_students;
			  
			  // total donated by the donor
			  
			  $total_donated = 0;
			  
			  $query = 'SELECT * from donations where donor_id = '.$item['donor_id'];
			  $query_res = mysql_query($query);
			  while($donated_result = mysql_fetch_array($query_res))	
			  {
				    $total_donated += $donated_result['donation'];
		 	  }
							  
			  $item['total_donated'] = $total_donated;
			  
			  // Total Used
			  
			  $total_used = 0;
			  
			  $query = 'SELECT * from donated where donor_id = '.$item['donor_id'];
			  $query_res = mysql_query($query);
			  while($used_result = mysql_fetch_array($query_res))	
			  {
				    $total_used += $used_result['amount'];
		 	  }
				
			  $current_balance = $total_donated - $total_used;	
							  
			  $item['current_balance'] = $current_balance;
			  $item['total_donated'] = $total_donated;
			  $item['total_used'] = $total_used;
			  
              if (preg_match('/active/i',$item['status']))
              {
                  $item['actions'].=sprintf($this->lang->line('donors_actions_delete'),$item['donor_id']);
              }
              $result['data'][]=$item;
          }
          
		 
		  
          $result['count']=$this->db->query('SELECT COUNT(donor_id) as `count` FROM donors')->row_array();
          $result['count']=$result['count']['count'];          
          
          return $result;
      }
	  
	  function get_donors_reports()
	  {
          $this->prepare_filters('donors');
          
          /*$this->db
               ->select('SQL_CALC_FOUND_ROWS donors.donor_id,CONCAT(donors.name," <br/><i><small>",IFNULL(GROUP_CONCAT(students.name SEPARATOR ","),"-"),"</small></i>") as name,donors.`status`',FALSE)
               ->join('students_donors','students_donors.donor_id = donors.donor_id','LEFT')
               ->join('students','students.student_id = students_donors.student_id','LEFT')
               ->group_by('donors.donor_id')
               ->from('donors');*/
			   
		   $this->db
               ->select('SQL_CALC_FOUND_ROWS donors.donor_id,donors.name,donors.cell_phone, donors.address, donors.city, donors.state,  IFNULL(GROUP_CONCAT(students.name SEPARATOR ","),"-") as student_name,donors.`status`',FALSE)
               ->join('students_donors','students_donors.donor_id = donors.donor_id','LEFT')
               ->join('students','students.student_id = students_donors.student_id','LEFT')
               ->group_by('donors.donor_id')
               ->from('donors');	   
          
          $data=$this->db
                     ->query(preg_replace('/AND\s*(`donors`.`donor_id`.*?)GROUP/si','AND ($1) GROUP ',$this->db->_compile_select()))
                     ->result_array();
          
          $result['rows']=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
          $result['rows']=$result['rows']['rows'];
          
          $result['data']=array();
          
          foreach($data as $item)
          {
              $item['actions']=sprintf($this->lang->line('donors_actions_download'),$item['donor_id'],$item['donor_id']);
              $item['actions'] .=sprintf($this->lang->line('donors_actions_donations'),$item['donor_id'],$item['donor_id']);			  
              
			  $student_array = explode("," , $item['student_name']);
			  $student_names = '';
			  if(count($student_array) > 20)
			  {
				  for ($i = 0; $i<20; $i++)
				  {
				  	$student_names .=$student_array[$i] . ",";
				  }
			  }
			  else
			  {
				  $student_names = $item['student_name'];
			  }
			  
			  
			  // Total number of students of the donor			 			  
			 $q = mysql_query( "SELECT * FROM students_donors , students where students_donors.donor_id = ".$item['donor_id']." and students.student_id = students_donors.student_id");
			 $num_of_students = mysql_num_rows($q);
			 $item['number_of_students'] = '<a rel="tooltip" href="donors" title="'.$student_names.'" class="btn">'.$num_of_students.'</a>';
			  
			  // total donated by the donor
			  
			  $total_donated = 0;
			  
			  $query = 'SELECT * from donations where donor_id = '.$item['donor_id'];
			  $query_res = mysql_query($query);
			 
			  while($donated_result = mysql_fetch_array($query_res))	
			  {
				    $total_donated += $donated_result['donation'];
		 	  }
							  
			  $item['total_donated'] = $total_donated;
			  $item['address'] = $item['address'].' '.$item['city'].' ' .$item['state'];
			  // Total Used
			  
			  $total_used = 0;
			  
			  $query = 'SELECT * from donated where donor_id = '.$item['donor_id'];
			  $query_res = mysql_query($query);
			  while($used_result = mysql_fetch_array($query_res))	
			  {
				    $total_used += $used_result['amount'];
		 	  }
				
			  $current_balance = $total_donated - $total_used;	
							  
			  $item['current_balance'] = $current_balance;
			  $item['total_donated'] = $total_donated;
			  $item['total_used'] = $total_used;

              $result['data'][]=$item;		  
		}

          $result['count']=$this->db->query('SELECT COUNT(donor_id) as `count` FROM donors')->row_array();
          $result['count']=$result['count']['count'];          
          return $result;

	  }
      
      function save_donor()
      {
         if (!$this->upload_photo($this->input->post('donor_id'),'donor'))
         {
             return FALSE;
         }
         
         $data=array(
                'name'=>$this->input->post('donor_name'),
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
   
	
         if ($this->input->post('donor_id')=='0')
         {
             $this->db->insert('donors',$data);
             $result['result']=$this->db->insert_id();
			     
				 $students=json_decode($this->input->post('students_list'),TRUE);
				 if(!empty($students))
				 {
             		$this->assign_students($result['result']);
				 }
             $this->invite_person('donor',$result['result'],$this->input->post('donor_name'),$this->input->post('email'));
             return $result;
         }
         
         $this->db->update('donors',$data,array('donor_id'=>$this->input->post('donor_id')));
         $this->update_user_email('donor',$this->input->post('donor_id'),$this->input->post('email'));
         $this->assign_students($this->input->post('donor_id'));
         $result['result']=TRUE;
         return $result;
      }
      
      function get_donor($donor_id)
      {
          $donor = $this->db
                        ->select('*')
                        ->where('donor_id',$donor_id)
                        ->get('donors')
                        ->row_array();
          
          $donor['students']=$this->get_student_donors($donor_id,'donors');
          
          return $donor;
      }
      
      function change_status($new_status,$donor_id)
      {
          switch($new_status)
          {
              case 'deleted':{
                  $this->db->update('donors',array('status'=>ucfirst($new_status)),array('donor_id'=>$donor_id));
                  $this->delete_user($donor_id,'donor');
                  break;
              }
              case 'restore':{
                  $donor=$this->db->select('email,name')->where('donor_id',$donor_id)->get('donors')->row_array();
                  
                  if (count($donor)==0)
                  {
                      $this->set_error($this->lang->line('donor_not_found'));
                      return FALSE;
                  }
                  
                  if (!$this->check_user_email($donor['email'],$donor_id,'donor'))
                  {
                      $this->set_error($this->lang->line('error_email_used'));
                      return FALSE;
                  }
                  
                  $this->invite_person('donor',$donor_id,$donor['name'],$donor['email']);
                  
                  $this->db->update('donors',array('status'=>'Inactive'),array('donor_id'=>$donor_id));
                  break;
              }
			  case 'active' :
			  {
				  $this->db->update('donors',array('status'=>'Active'),array('donor_id'=>$donor_id));
				  $this->db->update('users',array('is_active'=>'1'),array('person_id'=>$donor_id));	
				  break;
			  }
			  case 'inactive' :
		  	  {
					 $this->db->update('donors',array('status'=>'Inactive'),array('donor_id'=>$donor_id));
					 $this->db->update('users',array('is_active'=>'0'),array('person_id'=>$donor_id));
					 break;
			  }
          }
          
          return TRUE;
      }
      
      private function assign_students($donor_id)
      {
          $students=json_decode($this->input->post('students_list'),TRUE);
          if ((!is_array($students)))
          {
              return FALSE;
          }
          
          $this->db->delete('students_donors',array('donor_id'=>$donor_id));
          $new_students=array();
          foreach($students as $student_id)
          {
              $new_students[]=array('student_id'=>(int)$student_id,'donor_id'=>$donor_id);
          }
          
          $this->db->insert_batch('students_donors',$new_students);
      }
      
      function get_donors_list()
      {
          return $this->db
                      ->select('donor_id as id, name',FALSE)
                      ->where_in('status',array('Active','Inactive'))
                       ->where('( name LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->order_by('name')
                      ->limit(10)
                      ->get('donors')
                      ->result_array();
      }
      
      function get_monies()
      {
         /* return $this->db
                      ->select('donations,donated')
                      ->where('donor_id',$this->session->userdata('person_id'))
                      ->get('donors')
                      ->row_array();*/
					  
					 $second_ret = $this->db
										->query('SELECT fees_members.`donated_ids` AS donate_id , (fees.`amount` * students.`part_of_donation`)/100 AS paid, students.`name`, "-" AS date , fee_name, fee_description, fees.amount, IFNULL(students_donors.student_id, 0) AS is_current  FROM fees_members, fees,donors,students, students_donors
						WHERE fees_members.`fee_id` = fees.`fee_id`
						AND students.`student_id` = fees_members.`student_id`
						AND students.`student_id` = students_donors.`student_id`
						AND students_donors.`donor_id` = donors.`donor_id`
						AND donors.`donor_id` = '.$this->session->userdata('person_id'). '
						AND fees_members.`donated_ids` = 0
						',FALSE)
                      ->result_array();	
					  
					  //print_r($second_ret);
					  $to_pay = 0;
					  foreach($second_ret as $un_paid)
					  {
						  $to_pay += $un_paid['paid'];
					  }
					  
				$total_students_res = mysql_query('SELECT DISTINCT student_id FROM donated WHERE donor_id = '.$this->session->userdata('person_id'));	  
				$total_students = mysql_num_rows($total_students_res);	  
				
				$donor_res = mysql_query("select * from donors where donor_id =" . $this->session->userdata('person_id'));
				$donor_data = mysql_fetch_array($donor_res);
				$donor_name = $donor_data['name'];
				
			  $total_donated = 0;
			  
			  $query = 'SELECT * from donations where donor_id = '.$this->session->userdata('person_id').' and is_paid = 1';
			  $query_res = mysql_query($query);
			  while($donated_result = mysql_fetch_array($query_res))	
			  {
				    $total_donated += $donated_result['donation'];
		 	  }
							  
			  $total_donated;
			  
			  // Total Used
			  
			  $total_used = 0;
			  
			  $query = 'SELECT * from donated where donor_id = '.$this->session->userdata('person_id');
			  $query_res = mysql_query($query);
			  while($used_result = mysql_fetch_array($query_res))	
			  {
				    $total_used += $used_result['amount'];
		 	  }
				
			  $current_balance = $total_donated - $total_used;						  
					  
				$data_array = array('total_donated' => $total_donated  , 'total_used' => $total_used , 'current_balance'=> $current_balance , 'to_pay' => $to_pay , 'total_students' => $total_students , 'donor_name' => $donor_name);	  
				return $data_array;
      }


      function get_monies_for_reports($donor_id)
      {

					 $second_ret = $this->db
										->query('SELECT fees_members.`donated_ids` AS donate_id , (fees.`amount` * students.`part_of_donation`)/100 AS paid, students.`name`, "-" AS date , fee_name, fee_description, fees.amount, IFNULL(students_donors.student_id, 0) AS is_current  FROM fees_members, fees,donors,students, students_donors
						WHERE fees_members.`fee_id` = fees.`fee_id`
						AND students.`student_id` = fees_members.`student_id`
						AND students.`student_id` = students_donors.`student_id`
						AND students_donors.`donor_id` = donors.`donor_id`
						AND donors.`donor_id` = '.$donor_id. '
						AND fees_members.`donated_ids` = 0
						',FALSE)
                      ->result_array();	
					  
					  //print_r($second_ret);
					  $to_pay = 0;
					  foreach($second_ret as $un_paid)
					  {
						  $to_pay += $un_paid['paid'];
					  }
					  
				$total_students_res = mysql_query('SELECT DISTINCT student_id FROM donated WHERE donor_id = '.$donor_id);	  
				$total_students = mysql_num_rows($total_students_res);	  
				
				$donor_res = mysql_query("select * from donors where donor_id =" . $donor_id);
				$donor_data = mysql_fetch_array($donor_res);
				$donor_name = $donor_data['name'];
				
			  $total_donated = 0;
			  
			  $query = 'SELECT * from donations where donor_id = '.$donor_id.' and is_paid = 1';
			  $query_res = mysql_query($query);
			  while($donated_result = mysql_fetch_array($query_res))	
			  {
				    $total_donated += $donated_result['donation'];
		 	  }
							  
			  $total_donated;
			  
			  // Total Used
			  
			  $total_used = 0;
			  
			  $query = 'SELECT * from donated where donor_id = '.$donor_id;
			  $query_res = mysql_query($query);
			  while($used_result = mysql_fetch_array($query_res))	
			  {
				    $total_used += $used_result['amount'];
		 	  }
				
			  $current_balance = $total_donated - $total_used;						  
					  
				$data_array = array('total_donated' => $total_donated  , 'total_used' => $total_used , 'current_balance'=> $current_balance , 'to_pay' => $to_pay , 'total_students' => $total_students , 'donor_name' => $donor_name);	  
				return $data_array;
      }

      
/*      function get_donated()
      {
          return $this->db
                      ->select(' distinct donate_id,donated.amount as paid,date,name,fee_name,fee_description,fees.amount,IFNULL(students_donors.student_id,0) as is_current',FALSE)
                      ->join('students','students.student_id = donated.student_id','LEFT')
                      ->join('fees','fees.fee_id = donated.fee_id','LEFT')
                      ->join('students_donors','students_donors.student_id = donated.student_id','LEFT')
                      ->where('donated.donor_id',$this->session->userdata('person_id'))
                      ->get('donated')
                      ->result_array();
      }*/
	  
      function get_donated()
      {

          $ret = $this->db
                      ->select(' distinct donate_id,donated.amount as paid,date,name,fee_name,fee_description,fees.amount,IFNULL(students_donors.student_id,0) as is_current , students.student_id',FALSE)
                      ->join('students','students.student_id = donated.student_id','LEFT')
                      ->join('fees','fees.fee_id = donated.fee_id','LEFT')
                      ->join('students_donors','students_donors.student_id = donated.student_id','LEFT')
                      ->where('donated.donor_id',$this->session->userdata('person_id'))
                      ->get('donated')
                      ->result_array();

					 $second_ret = $this->db
										->query('SELECT fees_members.`donated_ids` AS donate_id , (fees.`amount` * students.`part_of_donation`)/100 AS paid, students.`name`, "-" AS date , fee_name, fee_description, fees.amount, IFNULL(students_donors.student_id, 0) AS is_current, students.student_id  FROM fees_members, fees,donors,students, students_donors
						WHERE fees_members.`fee_id` = fees.`fee_id`
						AND students.`student_id` = fees_members.`student_id`
						AND students.`student_id` = students_donors.`student_id`
						AND students_donors.`donor_id` = donors.`donor_id`
						AND donors.`donor_id` = '.$this->session->userdata('person_id'). '
						AND fees_members.`donated_ids` = 0
						',FALSE)
                      ->result_array();				
					  
					  $complete_array = array();
					  $complete_array[0] = $ret;
					  $complete_array[1] = $second_ret;
					return  $result = call_user_func_array('array_merge', $complete_array);
					  
      }	  
	  
	  function get_donated_report($donor_id)
	  {
	  
          $ret = $this->db
                      ->select(' distinct donate_id,donated.amount as paid,date,name,fee_name,fee_description,fees.amount,IFNULL(students_donors.student_id,0) as is_current , students.student_id',FALSE)
                      ->join('students','students.student_id = donated.student_id','LEFT')
                      ->join('fees','fees.fee_id = donated.fee_id','LEFT')
                      ->join('students_donors','students_donors.student_id = donated.student_id','LEFT')
                      ->where('donated.donor_id',$donor_id)
                      ->get('donated')
                      ->result_array();

					 $second_ret = $this->db
										->query('SELECT fees_members.`donated_ids` AS donate_id , (fees.`amount` * students.`part_of_donation`)/100 AS paid, students.`name`, "-" AS date , fee_name, fee_description, fees.amount, IFNULL(students_donors.student_id, 0) AS is_current, students.student_id  FROM fees_members, fees,donors,students, students_donors
						WHERE fees_members.`fee_id` = fees.`fee_id`
						AND students.`student_id` = fees_members.`student_id`
						AND students.`student_id` = students_donors.`student_id`
						AND students_donors.`donor_id` = donors.`donor_id`
						AND donors.`donor_id` = '.$donor_id. '
						AND fees_members.`donated_ids` = 0
						',FALSE)
                      ->result_array();				
					  
					  $complete_array = array();
					  $complete_array[0] = $ret;
					  $complete_array[1] = $second_ret;
					return  $result = call_user_func_array('array_merge', $complete_array);
					  
      
	  
	  }
	  
      function get_donated_date($start , $end)
      {
          $ret =  $this->db
                      ->select(' distinct donate_id,donated.amount as paid,date,name,fee_name,fee_description,fees.amount,IFNULL(students_donors.student_id,0) as is_current, students.student_id , ',FALSE)
                      ->join('students','students.student_id = donated.student_id','LEFT')
                      ->join('fees','fees.fee_id = donated.fee_id','LEFT')
                      ->join('students_donors','students_donors.student_id = donated.student_id','LEFT')
                      ->where('donated.donor_id',$this->session->userdata('person_id'))
					  ->where('donated.date >=',$start)
					  ->where('donated.date <=',$end)
                      ->get('donated')
                      ->result_array();
					  
					 $second_ret = $this->db
										->query('SELECT fees_members.`donated_ids` AS donate_id , (fees.`amount` * students.`part_of_donation`)/100 AS paid, students.`name`, "-" AS date , fee_name, fee_description, fees.amount, IFNULL(students_donors.student_id, 0) AS is_current, students.student_id  FROM fees_members, fees,donors,students, students_donors
						WHERE fees_members.`fee_id` = fees.`fee_id`
						AND students.`student_id` = fees_members.`student_id`
						AND students.`student_id` = students_donors.`student_id`
						AND students_donors.`donor_id` = donors.`donor_id`
						AND donors.`donor_id` = '.$this->session->userdata('person_id'). '
						AND fees_members.`donated_ids` = 0
						AND fees.until >= "'.$start.'"
						and fees.until <= "'.$end.'"
						',FALSE)
                      ->result_array();					  
					  
					  $complete_array = array();
					  $complete_array[0] = $ret;
					  $complete_array[1] = $second_ret;
					return  $result = call_user_func_array('array_merge', $complete_array);					  
					  
      }	  
      
      function get_donations()
      {
          return $this->db
                      ->select('donation_id,donation,donation_date,is_paid,comment,source,status,transaction_code')
                      ->join('transactions','transactions.transaction_id = donations.transaction_id','LEFT')
                      ->where('donor_id',$this->session->userdata('person_id'))
                      ->where('is_paid',1)
                      ->get('donations')
                      ->result_array();
      }
      
	  function get_donations_report($donor_id)
	  {
	      return $this->db
                      ->select('donation_id,donation,donation_date,is_paid,comment,source,status,transaction_code')
                      ->join('transactions','transactions.transaction_id = donations.transaction_id','LEFT')
                      ->where('donor_id',$donor_id)
                      ->where('is_paid',1)
                      ->get('donations')
                      ->result_array();
      }
	  
      function make_donation()
      {
          $this->db->insert('donations',array(
            'donor_id'=>$this->input->post('donor_id'),
            'donation'=>$this->input->post('donation'),
            'donation_date'=>date('Y-m-d'),
            'is_paid'=>1,
            'comment'=>$this->input->post('comment')
          ));
          
          $this->db->query('UPDATE donors SET donations=donations+? WHERE donor_id=?',array($this->input->post('donation'),$this->input->post('donor_id')));
      }
      
      function donate_to_students($fee_id,$students)
      {
          $this->db->_reserved_identifiers[]=(int)$fee_id;
          
          $donated=$this->db
                        ->select('students_donors.student_id,GROUP_CONCAT(students_donors.donor_id) as donors,fee_id,IF (part_of_donation>0,(part_of_donation/100*`amount`),0) as `amount`',FALSE)
                        ->join('students','students.student_id = students_donors.student_id','LEFT')
                        ->join('fees','fees.fee_id='.(int)$fee_id,'LEFT')
                        ->where_in('students_donors.student_id',explode(',',$students))
                        ->where('part_of_donation>0',NULL,FALSE)
                        ->get('students_donors')
                        ->result_array();
          
          foreach($donated as $student)
          {
              $student['donors']=explode(',',$student['donors']);
              $student['amount']=$student['amount']/count($student['donors']);
              $donated_ids=array();
              foreach($student['donors'] as $donor_id)
              {
                  $this->db->insert('donated',array('donor_id'=>$donor_id,'student_id'=>$student['student_id'],'amount'=>$student['amount'],'date'=>date('Y-m-d H:i:s'),'fee_id'=>$fee_id));
                  $donated_ids[]=$this->db->insert_id();
                  $this->db->query('UPDATE donors SET donated=donated+? WHERE donor_id=?',array($student['amount'],$donor_id));
              }
              
              $this->db->update('fees_members',array('donated_ids'=>implode(',',$donated_ids)),array('student_id'=>$student['student_id'],'fee_id'=>$fee_id));
          }
      }
  }
?>