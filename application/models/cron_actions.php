<?php 
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property settings_actions          $settings_actions
    */
  class Cron_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function run_tasks($task='')
      {
         if ($task=='')
         {
             $task=$this->db
                        ->select('task_name')
                        ->order_by('last_run','ASC')
                        ->limit(1)
                        ->get('cron_tasks')
                        ->row_array();
             $task=$task['task_name'];
         }
         
         if (method_exists($this,'_'.$task))
         {
            call_user_func(array($this,'_'.$task));
         }
         $this->db->update('cron_tasks',array('last_run'=>date('Y-m-d H:i:s')),array('task_name'=>$task));
      }
      
      private function _send_emails()
      {
          $this->load->model('email_actions');
          $this->email_actions->send_lazy_emails();
      }
      
      private function _send_notificaitions($start_status=0,$events=FALSE)
      {
           $procces_id=rand(1,65000);
           $this->db->limit(50);
           if ($events)
           {
               $this->db->where_in('event_id',explode(',',$events));
           }
           
           $this->db->update('events',array('busy_by'=>$procces_id),array('busy_by'=>0,'event_status'=>$start_status));
           
           
           if ($this->db->affected_rows()==0)
           {
               return FALSE;
           }
           
           $this->load->language('cron');
           $events=$this->db
                        ->select('event_id,event_type,source_id,target_person,person_type')
                        ->where('busy_by',$procces_id)
                        ->order_by('event_type','ASC')
                        ->get('events')
                        ->result_array();
           
           $this->load->model('settings_actions');
           $currency=$this->settings_actions->get_setting('current_currency');
           
           $school_name=$this->db
                             ->select('name')
                             ->get('school_info')
                             ->row_array();
           
           $current_event=array('type'=>'','id'=>0);
           
           foreach($events as $event)
           {
               switch($event['event_type'])
               {
                   case 'payment':
                   {
                       if (($current_event['type']!='payment') OR ($current_event['id']!=$event['source_id']))
                       {
                           $event_data=$this->db
                                            ->select('fee_id,fee_name,fee_description,until,amount')
                                            ->where('fee_id',$event['source_id'])
                                            ->get('fees')
                                            ->row_array();
                           
                           $current_event=array('type'=>'payment','id'=>$event['source_id']);
                       }
                       
                       $event_notification=preg_replace(
                            array(
                                '/#amount#/si',
                                '/#fee_name#/si',
                                '/#fee_description#/si',
                                '/#until#/si',
                                '/#base_url#/si',
                                '/#id#/si'
                            ),
                            array(
                                $currency.' '.$event_data['amount'],
                                $event_data['fee_name'],
                                ($event_data['fee_description']?'(':'').$event_data['fee_description'].($event_data['fee_description']?')':''),
                                is_null($event_data['until'])?'':date('d M Y',strtotime($event_data['until'])),
                                $this->config->item('base_url'),
                                $event_data['fee_id']
                            ),
                            $this->lang->line('payment_notification')
                       );
                       
                       $this->db->insert('notifications',array('recipient_id'=>$event['target_person'],'recipient_type'=>$event['person_type'],'event_id'=>$event['event_id'],'date'=>date('Y-m-d H:i:s'),'notification'=>$event_notification));
                       
                       $person=$this->get_person_details($event['target_person'],$event['person_type']);
                       
                       $email_message=preg_replace(
                            array(
                               '/#amount#/si',
                                '/#fee_name#/si',
                                '/#fee_description#/si',
                                '/#until#/si',
                                '/#base_url#/si',
                                '/#id#/si',
                                '/#user#/si',
                                '/#school_name#/si'
                            ),
                            array(
                                $currency.' '.$event_data['amount'],
                                $event_data['fee_name'],
                                ($event_data['fee_description']?'(':'').$event_data['fee_description'].($event_data['fee_description']?')':''),
                                is_null($event_data['until'])?'':date('d M Y',strtotime($event_data['until'])),
                                $this->config->item('base_url'),
                                $event_data['fee_id'],
                                $person['name'],
                                $school_name['name']
                            ),
                            $this->lang->line('payment_email')
                       );
                       
                       $this->db->insert('emails',array('recipient'=>$person['email'],'subject'=>$this->lang->line('payment_subject'),'message'=>$email_message));
                       break;
                   }
                   case 'message':
                   {
                       if (($current_event['type']!='message') OR ($current_event['id']!=$event['source_id']))
                       {
                           $event_data=$this->db
                                            ->select('message_body,thread_subject,message_sender,sender_person,messages.thread_id')
                                            ->join('messages_thread','messages_thread.thread_id = messages.thread_id','LEFT')
                                            ->where('message_id',$event['source_id'])
                                            ->get('messages')
                                            ->row_array();    
                           
                           $current_event=array('type'=>'message','id'=>$event['source_id']);
                           $sender_person=$this->get_person_details($event_data['message_sender'],$event_data['sender_person'],FALSE);
                       }
                       
                       $person=$this->get_person_details($event['target_person'],$event['person_type']);
                       
                       $email_message=preg_replace(
                            array(
                                '/#base_url#/si',
                                '/#id#/si',
                                '/#user#/si',
                                '/#school_name#/si',
                                '/#from#/si',
                                '/#message_subject#/si',
                                '/#message#/si'
                            ),
                            array(
                                $this->config->item('base_url'),
                                $event_data['thread_id'],
                                $person['name'],
                                $school_name['name'],
                                $sender_person['name'],
                                $event_data['thread_subject'],
                                $event_data['message_body']
                            ),
                            $this->lang->line('new_message_email')
                       );
                       
                       $this->db->insert('emails',array('recipient'=>$person['email'],'subject'=>sprintf($this->lang->line('new_message_subject'),$school_name['name']),'message'=>$email_message));
                       $this->db->delete('events',array('event_id'=>$event['event_id']));
                       
                       break;
                   }
               }
           }
           
           $this->db->update('events',array('event_status'=>1,'busy_by'=>0,'last_notification'=>date('Y-m-d H:i:s')),array('busy_by'=>$procces_id));
      }
      
      private function get_person_details($person_id,$person_type,$extract_name=TRUE)
      {
         $this->db->select('name,email');
         switch($person_type)
         {
             case 'student':
             {
                 $person=$this->db
                              ->where('student_id',$person_id)
                              ->get('students')
                              ->row_array();
                 break;
             }
             case 'parent':
             {
                 $person=$this->db
                              ->where('parent_id',$person_id)
                              ->get('parents')
                              ->row_array();
                 break;
             }
             case 'teacher':
             {
                 $person=$this->db
                              ->where('teacher_id',$person_id)
                              ->get('teachers')
                              ->row_array();
                 break;
             }
             case 'admin':
             {
                 $person['name']='Admin';
                 break;
             }
         }
         
         if ($extract_name)
         {
             $this->load->helper('extract_first_name');
             $person['name']=extract_first_name($person['name']);    
         }
         
         return $person;
      }
      
      private function _check_payments()
      {
          $events=$this->db->query('SELECT GROUP_CONCAT(event_id) as events
                                    FROM fees
                                    LEFT JOIN events ON events.event_type="payment" AND events.source_id = fees.fee_id
                                    WHERE until BETWEEN DATE_ADD(CURDATE(),INTERVAL -3 DAY) AND DATE_ADD(CURDATE(),INTERVAL 3 DAY) AND DATE_ADD(last_notification,INTERVAL 1 DAY)<NOW()
                                    LIMIT 15')->row_array();
          if ($events['events'])
          {
              $this->_send_notificaitions(1,$events['events']);
          }
      }
	  
	  function cron_deduct_from_donor()
	  {
		$fees_res = $this->db->query('SELECT *
						  FROM fees 
						  WHERE DATE(fees.`until`) = CURDATE()');		  
						  
			if($fees_res->num_rows() > 0)
			{
				foreach($fees_res->result_array() as $fees_data)
				{
					$fee_id = $fees_data['fee_id'];
					$member_res = $this->db->query('SELECT fees_members.fee_id, fees_members.student_id ,donor_id , students.`part_of_donation` , fees.`amount`
													FROM fees_members , students_donors ,students, fees
													WHERE fees_members.`student_id` = students_donors.`student_id`
													AND fees.`fee_id` = fees_members.`fee_id`
													AND students.`student_id` = fees_members.`student_id`
													AND donated_ids=0 
													AND fees_members.fee_id = '.$fee_id);
										
					if($member_res->num_rows() > 0)					
					{
						foreach($member_res->result_array() as $member)
						{
							$part_of_donation = $member['part_of_donation'];
							if($part_of_donation)
							{
									$student_id = $member['student_id'];
									$donor_id = $member['donor_id'];
									$fees_amount = $member['amount'];
									
									$date = date('Y-m-d H:i:s');																					
									$donor_amount = ($fees_amount * $part_of_donation)/100;
																		
									
									$this->db
										 ->insert('donated' , array('donor_id' => $donor_id,
																	'student_id' => $student_id,
																	'amount' => $donor_amount,
																	'date' => $date,
																	'fee_id' => $fee_id));								
									mysql_query("UPDATE fees_members set donated_ids = ".$donor_id." where fee_id = ".$fee_id." and student_id = ".$student_id);	
							}
							
							if($part_of_donation == 100)																								
							{
								$fees_amount = $member['amount'] - $donor_amount;

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
							
						}
					}
				}				
			}
	  }
  }
?>