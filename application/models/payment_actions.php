<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property fee_actions          $fee_actions
    * @property settings_actions          $settings_actions
    * @property donors_actions          $donors_actions
    */ 
  class Payment_actions  extends CI_Model
  {
      private $error;
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function prepare_transaction()
      {
          $payment_method=$this->input->post('payment_method');
          $this->load->model('settings_actions');
          if (strpos($this->settings_actions->get_setting('active_payments'),$payment_method)===FALSE)
          {
              $this->set_error($this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
          
          if (!file_exists(BASEPATH.'../'.APPPATH.'/libraries/'.$payment_library.'.php'))
          {
              $this->set_error($this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $this->load->model('fee_actions');
          $fee=$this->fee_actions->get_fee_details($this->input->post('fee_id'));
          
          if (count($fee)==0)
          {
              $this->set_error($this->lang->line('fee_not_found'));
              return FALSE;
          }
          
          if ($this->session->userdata('person_type')=='student')
          {
             $students=array('ids'=>$this->session->userdata('person_id'));
          }
          else
          {
              if (!isset($_POST['student']))
              {
                  $this->set_error($this->lang->line('select_students'));
                  return FALSE;
              }
              
              $clean_students=array();
              foreach($this->input->post('student') as $student=>$trash)
              {
                  $clean_students[]=(int)$student;
              }
              
              $this->db->_reserved_identifiers[]=$this->session->userdata('person_id');
              
              $students=$this->db
                             ->select('GROUP_CONCAT(name) as names,GROUP_CONCAT(fees_members.student_id) as ids,SUM(IF (part_of_donation>0,((100-part_of_donation)/100*`amount`),`amount`)) as total',FALSE)
                             ->join('students_parents','students_parents.student_id = fees_members.student_id AND students_parents.parent_id='.$this->session->userdata('person_id'),'LEFT')
                             ->join('students','students.student_id = fees_members.student_id','LEFT')
                             ->join('fees','fees.fee_id = fees_members.fee_id','LEFT')
                             ->where('fees_members.fee_id',$fee[0]['fee_id'])
                             ->where('students_parents.parent_id IS NOT ',' NULL ',FALSE)
                             ->where_in('fees_members.student_id',$clean_students)
                             ->get('fees_members')
                             ->row_array();
              $fee[0]['amount']=$students['total'];
          }
          
          $payment_settings=unserialize($this->settings_actions->get_setting('payment_settings'));
          
          $this->load->library($payment_library,$payment_settings[$payment_method]);
          
          if (!$this->$payment_library->init_checkout($fee[0],$students,$this->session->userdata('person_type'),$this->input->post('is_subscription')=='on')) 
          {
              $this->set_error($this->lang->line('payment_error').$this->$payment_library->get_error());
              return FALSE;
          }
          
          $this->db->insert('transactions',array(
                'source'=>$payment_method,
                'token'=>$this->$payment_library->get_token(),
                'payment_date'=>date('Y-m-d H:i:s'),
                'transaction_type'=>'payment',
                'fee_id'=>$fee[0]['fee_id'],
                'is_subscription'=>$this->input->post('is_subscription')=='on'?1:0
          ));
          
          $this->db
               ->where('fee_id',$fee[0]['fee_id'])
               ->where_in('student_id',explode(',',$students['ids']));
          
          $this->db->update('fees_members',array('transaction_id'=>$this->db->insert_id()));
          
          return $this->$payment_library->get_url();
      }
      
      function prepare_donation()
      {
          $payment_method=$this->input->post('payment_method');
          $this->load->model('settings_actions');
          if (strpos($this->settings_actions->get_setting('active_payments'),$payment_method)===FALSE)
          {
              $this->set_error($this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
          
          if (!file_exists(BASEPATH.'../'.APPPATH.'/libraries/'.$payment_library.'.php'))
          {
              $this->set_error($this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $payment_settings=unserialize($this->settings_actions->get_setting('payment_settings'));
          
          $this->load->library($payment_library,$payment_settings[$payment_method]);
          
          $school_info=$this->settings_actions->get_school_info();
          
          $fee=array(
            'fee_name'=>$this->lang->line('donation_for').' "'.$school_info['name'].'"',
            'fee_description'=>'',
            'amount'=>$this->input->post('amount')
          );
          
          if (!$this->$payment_library->init_checkout($fee,array(),$this->session->userdata('person_type'))) 
          {
              $this->set_error($this->lang->line('payment_error').$this->$payment_library->get_error());
              return FALSE;
          }
          
          $this->db->insert('transactions',array(
            'source'=>$payment_method,
            'token'=>$this->$payment_library->get_token(),
            'payment_date'=>date('Y-m-d H:i:s'),
            'transaction_type'=>'donation'
          ));
          
          $this->db->insert('donations',array(
            'donor_id'=>$this->session->userdata('person_id'),
            'donation'=>$this->input->post('amount'),
            'donation_date'=>date('Y-m-d'),
            'transaction_id'=>$this->db->insert_id()
          ));
          
          return $this->$payment_library->get_url();
      }
      
      function checkout($payment_method)
      {
          $this->load->model('settings_actions');
          if (strpos($this->settings_actions->get_setting('active_payments'),$payment_method)===FALSE)
          {
              $this->load->vars('payment_error',$this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
          
          if (!file_exists(BASEPATH.'../'.APPPATH.'/libraries/'.$payment_library.'.php'))
          {
              $this->load->vars('payment_error',$this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $payment_settings=unserialize($this->settings_actions->get_setting('payment_settings'));
          
          $this->load->library($payment_library,$payment_settings[$payment_method]);
          
          if ($this->$payment_library->is_transaction_completed())
          {
              $this->load->vars('payment_success',$this->lang->line('payment_completed'));
              return TRUE;
          }
          
          if (!$this->$payment_library->complete_transaction()) 
          {
              $this->load->vars('payment_error',$this->lang->line('payment_error').$this->$payment_library->get_error());
              return FALSE;
          }
          
          $this->db->update('transactions',$this->$payment_library->get_transaction(),array('source'=>$payment_method,'token'=>$this->$payment_library->get_token()));
          
          
          $transaction=$this->db
                            ->select('transaction_id,is_subscription,fee_id')
                            ->where(array('token'=>$this->$payment_library->get_token(),'source'=>$payment_method))
                            ->get('transactions')
                            ->row_array();
          
          if (count($transaction)==0)
          {
              $this->load->vars('payment_error',$this->lang->line('transaction_not_found'));
              return FALSE;
          }
          
          $this->load->vars('payment_success',$this->lang->line('payment_completed'));
          
          if ($this->session->userdata('person_type')=='donor')
          {
              $this->db->update('donations',array('is_paid'=>1),array('transaction_id'=>$transaction['transaction_id']));
              return TRUE;
          }
          
          $this->db->update('fees_members',array('is_paid'=>1),array('transaction_id'=>$transaction['transaction_id']));
          
          $students=$this->db
                         ->select('fee_id,GROUP_CONCAT(student_id) as students',FALSE)
                         ->where('transaction_id',$transaction['transaction_id'])
                         ->where('is_paid',1)
                         ->get('fees_members')
                         ->row_array();
          
          $this->db->where_in('target_person',explode(',',$students['students']));
          $this->db->delete('events',array('event_type'=>'payment','person_type'=>'student','source_id'=>$students['fee_id']));
          
          if ($this->session->userdata('person_type')=='parent')
          {
              $this->db->limit(count(explode(',',$students['students'])));
              $this->db->delete('events',array('event_type'=>'payment','person_type'=>'parent','source_id'=>$students['fee_id'],'target_person'=>$this->session->userdata('person_id')));
          }
          
          $this->load->model('school_model');
          $this->load->model('donors_actions');
          $this->donors_actions->donate_to_students($students['fee_id'],$students['students']);
          
          if ($transaction['is_subscription']=='1')
          {
              if (!$this->$payment_library->create_subscription())
              {
                  $this->load->vars('payment_error',$this->lang->line('subscription_not_created'));
                  return FALSE;
              }
              
               $this->db->insert('fees_subscriptions',array(
                    'person_id'=>$this->session->userdata('person_id'),
                    'person_type'=>$this->session->userdata('person_type'),
                    'fee_id'=>$transaction['fee_id'],
                    'source'=>$payment_method,
                    'source_id'=>$this->$payment_library->get_profile_id(),
                    'is_active'=>1,
                    'started_at'=>date('Y-m-d'),
                    'subscription_value'=>$this->$payment_library->get_amount(),
                    'subscription_name'=>$this->$payment_library->get_subscription_name(),
                    'current_transaction'=>$transaction['transaction_id']
              ));
              
              $this->load->vars('payment_success',$this->load->get_var('payment_success').$this->lang->line('subscription_added'));
          }
          
          return TRUE;
      }
      
      function get_payments()
      {
          if ($this->session->userdata('person_type')=='parent')
          {
              return $this->db
                          ->select('fees_members.transaction_id,fee_name,source,transactions.status,name,payment_date,is_paid,fees.fee_id,part_of_donation')
                          ->select('IF (part_of_donation>0,((100-part_of_donation)/100*`amount`),`amount`) as `amount`',FALSE)
                          ->join('fees_members','fees_members.student_id = students_parents.student_id','LEFT')
                          ->join('fees','fees.fee_id = fees_members.fee_id','LEFT')
                          ->join('transactions','transactions.transaction_id = fees_members.transaction_id','LEFT')
                          ->join('students','students.student_id = fees_members.student_id','LEFT')
                          ->where(array('parent_id'=>$this->session->userdata('person_id'),'fees_members.is_deleted'=>0,'fees.is_deleted'=>0))
                          ->where('fees_members.fee_id IS NOT ',' NULL ',FALSE)
                          ->get('students_parents')
                          ->result_array();
          }
          
          return $this->db
                      ->select('fees_members.transaction_id,fee_name,source,transactions.status,payment_date,is_paid,fees.fee_id,part_of_donation')
                      ->select('IF (part_of_donation>0,((100-part_of_donation)/100*`amount`),`amount`) as `amount`',FALSE)
                      ->join('fees','fees.fee_id = fees_members.fee_id','LEFT')
                      ->join('transactions','transactions.transaction_id = fees_members.transaction_id','LEFT')
                      ->join('students','students.student_id = fees_members.student_id','LEFT')
                      ->where(array('fees_members.student_id'=>$this->session->userdata('person_id'),'fees_members.is_deleted'=>0,'fees.is_deleted'=>0))
                      ->get('fees_members')
                      ->result_array();
      }
      
      function proccess_ipn($payment_method)
      {
          $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
          
          if (!file_exists(BASEPATH.'../'.APPPATH.'/libraries/'.$payment_library.'.php'))
          {
              $this->load->vars('payment_error',$this->lang->line('wrong_payment_method'));
              return FALSE;
          }
          
          $this->load->model('settings_actions');
          
          $payment_settings=unserialize($this->settings_actions->get_setting('payment_settings'));
          
          $this->load->library($payment_library,$payment_settings[$payment_method]);
          
          $method=$this->$payment_library->get_ipn_event();
          
          if (method_exists($this,$method))
          {
              call_user_func(array('Payment_actions',$method),$payment_method);    
          }
      }
      
      private function change_status($payment_method)
      {
          $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
          
          if (!$this->$payment_library->validate_transaction())
          {
              return FALSE;
          }
          
          $this->db->update('transactions',
            array(
                'status'=>$this->$payment_library->get_status()
            ),
            array(
                'transaction_code'=>$this->$payment_library->get_transaction_code(),
                'source'=>$payment_method
            )
          );
          
          if (!in_array($this->$payment_library->get_status(),array('deposited','completed')))
          {
              return FALSE;
          }
          
          $transaction=$this->db
                            ->select('transaction_id')
                            ->where(array('transaction_code'=>$this->$payment_library->get_transaction_code(),'source'=>$payment_method,'transaction_type'=>'donation'))
                            ->get('transactions')
                            ->row_array();
          
          if (count($transaction)>0)
          {
              $donation=$this->db
                             ->select('donation,donor_id')
                             ->where('transaction_id',$transaction['transaction_id'])
                             ->get('donations')
                             ->row_array();
              
              $this->db->query('UPDATE donors SET donations=donations+? WHERE donor_id=?',array($donation['donation'],$donation['donor_id']));
          }
      }
      
      private function recurring_payment($payment_method)
      {
         $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method); 
          
         if (!$this->$payment_library->validate_transaction())
         {
             return FALSE;
         } 
         
         $subscription_details=$this->db
                                    ->select('subscription_id,fee_id,subscription_name,subscription_value,current_transaction')
                                    ->where(array('source'=>$payment_method,'source_id'=>$this->$payment_library->get_source_id()))
                                    ->get('fees_subscriptions')
                                    ->row_array();
         
         $transaction=$this->$payment_library->get_transaction_details($this->$payment_library->get_transaction_code());
         
         $this->db->insert('transactions',array(
            'source'=>$payment_method,
            'token'=>0,
            'status'=>$this->$payment_library->get_transaction_status(),
            'payer_id'=>$this->$payment_library->get_payer_id(),
            'title'=>$subscription_details['subscription_name'],
            'quantity'=>1,
            'sum'=>$subscription_details['subscription_value'],
            'transaction_code'=>$this->$payment_library->get_transaction_code(),
            'payment_date'=>date('Y-m-d H:i:s'),
            'transaction_type'=>'payment',
            'fee_id'=>$subscription_details['fee_id'],
            'is_subscription'=>1
         ));
         
         $transaction_id=$this->db->insert_id();
         
         $this->db->update('fees_members',array('transaction_id'=>$transaction_id),array('transaction_id'=>$subscription_details['current_transaction']));
         
         $this->db->update('fees_subscriptions',array('current_transaction'=>$transaction_id),array('subscription_id'=>$subscription_details['current_transaction']));
         
         
         $donated=$this->db
                       ->select('donated_ids,fee_id,student_id')
                       ->where('transaction_id',$transaction_id)
                       ->where('donated_ids>0',NULL,FALSE)
                       ->get('fees_members')
                       ->result_array();
         
         foreach($donated as $donation)
         {
             $donation['donated_ids']=explode(',',$donation['donated_ids']);
             foreach($donation['donated_ids'] as $donated_id)
             {
                 $this->db->query('INSERT INTO donated(donor_id,student_id,amount,date,fee_id)
                                   SELECT  donor_id,student_id,amount,now(),fee_id
                                   FROM donated
                                   WHERE donate_id=?',array($donated_id));
                 
                 $donation['new_donated'][]=$this->db->insert_id();
             }
             
             $this->db->update('fees_members',array('donated_ids'=>implode(',',$donation['new_donated'])),array('fee_id'=>$donation['fee_id'],'student_id'=>$donation['student_id']));
             
             $this->db->query('UPDATE donors,donated SET 
                               donors.donated=donors.donated+donated.amount
                               WHERE donors.donor_id = donated.donor_id AND donated.donate_id IN ('.implode(',',$donation['new_donated']).')');
         }
      }
      
      function mark_as_completed($fee_id,$student_id)
      {
          $transaction_id=$this->db
                               ->select('transaction_id,amount')
                               ->join('fees','fees.fee_id = fees_members.fee_id')
                               ->where(array('fees_members.fee_id'=>$fee_id,'student_id'=>$student_id))
                               ->get('fees_members')
                               ->row_array();
							   
          if ($transaction_id['transaction_id']>0)
          {
              $this->db->update('transactions',array('status'=>'Completed'),array('transaction_id'=>$transaction_id['transaction_id']));
              return TRUE;
          }
          
		 $student_query = mysql_query("SELECT students.`part_of_donation` FROM students, donors , students_donors WHERE students.`student_id` = students_donors.`student_id` AND donors.`donor_id` = students_donors.`donor_id` AND students.`student_id` =  ". $student_id);
		 
		 $student_data = mysql_fetch_array($student_query);
		 
		 $part_of_donation = $student_data['part_of_donation'];
		 
		 $fees_amount = $transaction_id['amount'];
		 
		 if($part_of_donation)
		 {
			 $donor_amount = ($transaction_id['amount'] * $part_of_donation)/100;
			 $fees_amount = $transaction_id['amount'] - $donor_amount;
		 }

          $this->db->insert('transactions',array(
                'source'=>$this->lang->line('manual'),
                'token'=>0,
                'status'=>'Completed',
                'sum'=>$fees_amount,
                'transaction_code'=>0,
                'payment_date'=>date('Y-m-d H:i:s')
          ));
          
          $this->db->update('fees_members',
                array('transaction_id'=>$this->db->insert_id(),'is_paid'=>1),
                array('fee_id'=>$fee_id,'student_id'=>$student_id)
          );
		  
          return TRUE; 
      }
	  
	  function deduct_from_donor($fee_id , $student_id, $donor_amount)
	  {
		  
		  $date = date('Y-m-d H:i:s');
		 $donor = $this->db
		  		->select('donor_id')
				->where('student_id' , $student_id)
				->get('students_donors')
				->row_array();

			$donor_id = $donor['donor_id'];
			
			$this->db
				 ->insert('donated' , array('donor_id' => $donor_id,
				 						    'student_id' => $student_id,
											'amount' => $donor_amount,
											'date' => $date,
											'fee_id' => $fee_id));	
											
			mysql_query("UPDATE fees_members set donated_ids = ".$donor_id." where fee_id = ".$fee_id." and student_id = ".$student_id);																		
			
			$res = mysql_query("SELECT * FROM students , fees WHERE fee_id = ".$fee_id." AND student_id = ".$student_id."");
			$student_fees = mysql_fetch_array($res);
			$part_of_donation = $student_fees['part_of_donation'];
			
							if($part_of_donation == 100)																								
							{
								$fees_amount = $student_fees['amount'] - $donor_amount;

								  $this->db->insert('transactions',array(
										'source'=>'Manual',
										'token'=>0,
										'status'=>'Completed',
										'sum'=>$fees_amount,
										'transaction_code'=>0,
										'payment_date'=>date('Y-m-d H:i:s')
								  ));
								  
								  $this->db->update('fees_members',
										array('transaction_id'=>$this->db->insert_id(),'is_paid'=>1),
										array('fee_id'=>$fee_id,'student_id'=>$student_id)
								  );								
							}

			//$this->update('fees_members' , array('donated_ids' => $donor_id) , array('fee_id' => $fee_id));		
			return true;
			
	  }
      
      function init_payment_methods()
      {
          $this->load->model('settings_actions');
          $payment_settings=unserialize($this->settings_actions->get_setting('payment_settings'));
          
          foreach($payment_settings as $payment_method=>$payment_settings)
          {
              $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
              $this->load->library($payment_library,$payment_settings);   
          }
      }
      
      function cancel_subscription($payment_method,$subscription_id)
      {
          $payment_library=preg_replace('/([0-9]+)/si','_$1',$payment_method);
          $this->$payment_library->cancel_subscription($subscription_id);
          $this->db->update('fees_subscriptions',array('is_active'=>0,'completed_at'=>date('Y-m-d')),array('source'=>$payment_method,'source_id'=>$subscription_id));
      }
      
      function get_subscriptions()
      {
          return $this->db
                      ->select('subscription_id,subscription_name,subscription_value,is_active,started_at,completed_at')
                      ->where(array('person_id'=>$this->session->userdata('person_id'),'person_type'=>$this->session->userdata('person_type')))
                      ->get('fees_subscriptions')
                      ->result_array();
      }
      
      function remove_subscription($subscription_id)
      {
          $subscription=$this->db
                             ->select('source,source_id')
                             ->where(array('subscription_id'=>$subscription_id,'person_id'=>$this->session->userdata('person_id'),'person_type'=>$this->session->userdata('person_type')))
                             ->get('fees_subscriptions')
                             ->row_array();
          
          if (count($subscription)==0)
          {
              return FALSE;
          }
          
          $this->init_payment_methods();
          $this->cancel_subscription($subscription['source'],$subscription['source_id']);
          return TRUE;
      }
  }
  
?>