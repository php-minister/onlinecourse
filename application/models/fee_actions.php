<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */  
  class Fee_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_fees()
      {
            return $this->db
                        ->select('*')
                        ->where('is_deleted',0)
                        ->get('fees')
                        ->result_array();
      }
      
      function save_fee($student_id = '')
      {
          $data=array(
            'fee_name'=>$this->input->post('fee_name'),
            'fee_description'=>$this->input->post('fee_description'),
            'until'=>(!strtotime($this->input->post('until')))?NULL:date('Y-m-d',strtotime($this->input->post('until'))),
            'amount'=>(int)$this->input->post('amount'),
            'type'=>$this->input->post('fee_type'),
            'is_subscription'=>$this->input->post('subscription_payment')=='on'?1:0,
            'time_period'=>$this->input->post('subscription_payment')=='on'?$this->input->post('time_period'):NULL
          );
          
          if ($this->input->post('fee_id')=='0')
          {
              $this->db->insert('fees',$data);
              $result=$fee_id=$this->db->insert_id();
          }
          else
          {
              $this->db->update('fees',$data,array('fee_id'=>$this->input->post('fee_id')));
              $result=TRUE;
              $fee_id=$this->input->post('fee_id');
              if ($this->input->post('subscription_payment')!='on')
              {
                 $this->delete_subscriptions($fee_id);
              }
          }
          
		  if($student_id == '')
		  {
          	$this->assign_students(($this->input->post('fee_type')=='groups')?json_decode($this->input->post('groups_list'),TRUE):json_decode($this->input->post('students_list'),TRUE),$this->input->post('fee_type'),$fee_id);          }
		  else
		  {
			  $student_id = '["'.$student_id.'"]';
			  $student_id = json_decode($student_id,TRUE);
		 	$this->assign_students($student_id ,$this->input->post('fee_type'),$fee_id);
		  }
          return $result;
      }
      
      private function assign_students($data,$fee_type,$fee_id)
      {
          $this->db->delete('fees_members',array('fee_id'=>$fee_id,'is_paid'=>0));
          $this->db->update('fees_members',array('is_deleted'=>1),array('fee_id'=>$fee_id,'is_paid'=>1));
          
          $clean_data=array();
          foreach($data as $item)
          {
              $clean_data[]=(int)$item;
          }
          
          $query='INSERT INTO fees_members (fee_id,student_id,group_id)
                  SELECT ?,student_id,`group`
                  FROM students
                  WHERE ';
          
          $query.=($fee_type=='groups')?('`group` IN ('.implode(',',$clean_data).')'):('`student_id` IN ('.implode(',',$clean_data).')');
          
          $query.=' AND `status` IN ("Active","Inactive") ON DUPLICATE KEY UPDATE group_id=group_id';
          
          $this->db->query($query,array($fee_id));
          
          $this->db->query('INSERT INTO events(event_date,event_type,source_id,target_person,person_type)
                            SELECT now(),"payment",fee_id,student_id,"student"
                            FROM fees_members
                            LEFT JOIN `events` ON `events`.source_id = fees_members.fee_id AND `events`.event_type="payment" AND `events`.target_person = fees_members.student_id
                            WHERE fee_id=? AND event_id IS NULL AND is_paid=0 AND is_deleted=0',array($fee_id));
          
         $this->db->query('INSERT INTO events(event_date,event_type,source_id,target_person,person_type)
                           SELECT now(),"payment",fee_id,parents.parent_id,"parent"
                           FROM fees_members
                           LEFT JOIN students_parents ON students_parents.student_id = fees_members.student_id
                           LEFT JOIN parents ON parents.parent_id = students_parents.parent_id AND parents.status IN ("Active","Inactive")
                           LEFT JOIN `events` ON `events`.source_id = fees_members.fee_id AND `events`.event_type="payment" AND `events`.target_person = students_parents.parent_id
                           WHERE fee_id=? AND parents.parent_id IS NOT NULL AND event_id IS NULL  AND is_paid=0 AND is_deleted=0',array($fee_id));
      }
      
      function get_fee_brief($fee_id)
      {
          return $this->db
                       ->select('*')
                       ->where('fee_id',$fee_id)
                       ->where('is_deleted',0)
                       ->get('fees')
                       ->row_array();
      }
      
      function get_fee_name($fee_id)
      {
         $result=$this->get_fee_brief($fee_id);
         return $result['fee_name'];
      }
      
      function get_fee($fee_id)
      {
          $result=$this->get_fee_brief($fee_id);
          $result['students']=$result['groups']=array();
          
          if ($result['type']=='students')
          {
              $result['students']=$this->db
                                       ->select('students.student_id as id, name',FALSE)
                                       ->join('students','students.student_id = fees_members.student_id AND students.group = fees_members.group_id','LEFT')
                                       ->where('fee_id',$fee_id)
                                       ->where('name IS NOT',' NULL',FALSE)
                                       ->order_by('name')
                                       ->get('fees_members')
                                       ->result_array();
          }
          else
          {
              $result['groups']=$this->db
                                     ->select('students_groups.group_id as id,CONCAT(group_name,"(",name,")") as name',FALSE) 
                                     ->join('students_groups','students_groups.group_id = fees_members.group_id','LEFT')
                                     ->join('grades','grades.grade_id = students_groups.grade_id','LEFT')
                                     ->where('fee_id',$fee_id)
                                     ->where('name IS NOT',' NULL',FALSE)
                                     ->order_by('name')
                                     ->group_by('fees_members.group_id')
                                     ->get('fees_members')
                                     ->result_array();
          }
          
          return $result;
      }
      
      function delete_fee($fee_id)
      {
          $this->db->update('fees',array('is_deleted'=>1),array('fee_id'=>$fee_id));
          $this->db->update('fees_members',array('is_deleted'=>1),array('fee_id'=>$fee_id));
          $this->delete_subscriptions($fee_id);
      }
      
      function get_fee_details($fee_id)
      {
          $this->db->_reserved_identifiers[]=(int)$fee_id;
          if ($this->session->userdata('person_type')=='parent')
          {
              return $this->db
                          ->select('fees_members.student_id,fee_name, fee_description, name,fees.fee_id,part_of_donation,is_subscription,time_period')
                          ->select('IF (part_of_donation>0,((100-part_of_donation)/100*`amount`),`amount`) as `amount`,IFNULL(fees_members.until,fees.until) as until',FALSE)
                          ->join('fees_members','fees_members.student_id = students_parents.student_id AND fees_members.fee_id='.(int)$fee_id.' AND fees_members.is_paid=0 AND fees_members.is_deleted=0','LEFT')
                          ->join('fees','fees.fee_id = fees_members.fee_id AND fees.is_deleted=0','LEFT')
                          ->join('students','students.student_id = fees_members.student_id AND status IN ("Active","Inactive")','LEFT')
                          ->where('parent_id',$this->session->userdata('person_id'))
                          ->where('fees_members.fee_id IS NOT',' NULL ',FALSE)
                          ->where('fee_name IS NOT ',' NULL ',FALSE)
                          ->get('students_parents')
                          ->result_array();
          }
          
          return $this->db
                      ->select('fee_name,fee_description,fees.fee_id,part_of_donation,is_subscription,time_period')
                      ->select('IF (part_of_donation>0,((100-part_of_donation)/100*`amount`),`amount`) as `amount`,IFNULL(fees_members.until,fees.until) as until',FALSE)
                      ->join('fees','fees.fee_id = fees_members.fee_id','LEFT')
                      ->join('students','students.student_id = fees_members.student_id','LEFT')
                      ->where(array('fees_members.fee_id'=>$fee_id,'fees_members.student_id'=>$this->session->userdata('person_id'),'is_paid'=>0,'fees_members.is_deleted'=>0,'fees.is_deleted'=>0))
                      ->get('fees_members')
                      ->result_array();
      }
      
      function get_payments($fee_id)
      {
          return $this->db
                      ->select('is_paid,fees_members.is_deleted,name,group_name,students.student_id,students.part_of_donation ,fees_members.donated_ids,	 is_subscribed,until,transactions.transaction_id,transactions.status,payment_date')
                      ->join('students','students.student_id = fees_members.student_id','LEFT')
                      ->join('students_groups','students_groups.group_id = students.group','LEFT')
                      ->join('transactions','transactions.transaction_id = fees_members.transaction_id','LEFT')
                      ->where('fees_members.fee_id',$fee_id)
                      ->get('fees_members')
                      ->result_array();
      }

      function get_pending_payments()
	  {
		$data =    $this->db
		  		->query('SELECT fees.fee_id,	s.student_id, s.`name` , s.`part_of_donation` , fees.`amount` , fees_members.`is_paid` , IFNULL(fees_members.until,fees.until) as until ,fees_members.is_deleted, fees_members.is_subscribed, fees_members.`donated_ids` , fees_members.`transaction_id`
					FROM students s, donors , students_donors, fees_members , fees
					WHERE s.`student_id` = fees_members.`student_id`
					AND students_donors.`donor_id` = donors.`donor_id`
					AND s.`student_id` = students_donors.`student_id`
					AND fees.`fee_id` = fees_members.`fee_id`
					AND fees_members.`is_paid` = 0
					AND fees.`is_deleted` = 0 order by fees.until desc
					 
					')
				->result_array();			

		return $data;		
				
	  }
	  
	  
	  function get_single_payment($fee_id , $student_id)
	  {
          return $this->db
                      ->select('is_paid,fees_members.is_deleted,name,group_name,students.student_id,students.part_of_donation ,  fees_members.donated_ids, is_subscribed,until,transactions.transaction_id,transactions.status,payment_date')
                      ->join('students','students.student_id = fees_members.student_id','LEFT')
                      ->join('students_groups','students_groups.group_id = students.group','LEFT')
                      ->join('transactions','transactions.transaction_id = fees_members.transaction_id','LEFT')
                      ->where('fees_members.fee_id',$fee_id)
					  ->where('fees_members.student_id',$student_id)
                      ->get('fees_members')
                      ->result_array();					 					  		  
	  }


      function delete_subscriptions($fee_id)
      {
          $subscriptions=$this->db
                              ->select('GROUP_CONCAT(subscription_id) as subscriptions',FALSE)  
                              ->where(array('fee_id'=>$fee_id,'is_active'=>1))
                              ->get('fees_subscriptions')
                              ->row_array();
          if (count($subscriptions)==0)
          {
              return FALSE;
          }											
          
          $this->db->where_in('subscription_id',explode(',',$subscriptions['subscriptions']));
          $this->db->update('fees_subscriptions',array('is_active'=>0,'completed_at'=>date('Y-m-d')));
         
          $this->load->model('payment_actions');
          $subscriptions=$this->db
                              ->select('source,source_id')
                              ->where_in('subscription_id',explode(',',$subscriptions['subscriptions']))
                              ->get('fees_subscriptions')
                              ->result_array();
          
          $this->payment_actions->init_payment_methods();
          foreach($subscriptions as $subscription)
          {
              $this->payment_actions->cancel_subscription($subscription['source'],$subscription['source_id']);
          }
      }
      
      function get_payment_dates($fee_id,$student_id)
      {
          $this->db->_reserved_identifiers[]=(int)$student_id;
          
          return $this->db
                      ->select('fees.`until` as default_until,fees_members.`until`')
                      ->join('fees_members','fees_members.fee_id = fees.fee_id AND fees_members.student_id='.(int)$student_id,'LEFT')
                      ->where('fees.fee_id',$fee_id)
                      ->get('fees')
                      ->row_array();
      }
      
      function change_until()
      {
          $this->db->update('fees_members',
            array('until'=>$this->input->post('until')?date('Y-m-d',strtotime($this->input->post('until'))):NULL),
            array('fee_id'=>$this->input->post('fee_id'),'student_id'=>$this->input->post('student_id')));
      }
      
      function delete_student($fee_id,$studen_id)
      {
          $this->db->update('fees_members',array('is_deleted'=>1),array('fee_id'=>$fee_id,'student_id'=>$studen_id));
      }
      
      function get_fees_list()
      {
          return $this->db
                      ->select('fee_id as id,fee_name as name')
                      ->where('( fee_name LIKE "%'.$this->input->post('query').'%" OR fee_description LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->order_by('fee_name')
                      ->limit(10)
                      ->get('fees')
                      ->result_array();
      }
  }
?>