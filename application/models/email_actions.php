<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property CI_Email           $email
    * @property settings_actions           $settings_actions
    * @property user_actions        $user_actions
    */ 
  class Email_actions extends CI_Model
  {
      private $send_type='immediately';
      
      function __construct()
      {
          parent::__construct();
          $this->load->library('email');
          $this->email->charset='UTF-8';
          $this->email->set_newline('\r\n');
          $this->email->set_mailtype('html');
          $this->email->useragent='';
      }
      
      private function send_email($to,$subject,$message,$configured=FALSE)
      {
         if (!$configured) 
         {
             $this->configure_email();
         }
         
         if ($this->send_type=='lazy')
         {
             $this->db->insert('emails',array('recipient'=>$to,'subject'=>$subject,'message'=>$message));
             return TRUE;
         }
         
         return $this->proccess_email($to,$subject,$message);
      }
      
      private function proccess_email($to,$subject,$message)
      {
          $this->email->to(array($to));
          $this->email->subject($subject);
          $this->email->message($message);
         
          $send_result=$this->email->send();
          if (!$send_result)
          {
              $this->error=$this->email->_debug_msg[0];
          }
          return $send_result; 
      }
      
      
      private function get_port_number($server)
      {
          if (preg_match('/^(.*?):([0-9]+)$/si',$server,$port))
          {
              $this->email->smtp_host=$port[1];
              $this->email->smtp_port=$port[2];
              return ;
          }
          
          $this->email->smtp_host=$server;
      }
      
      function send_test_message()
      {
          if (!in_array($this->input->post('email_method'),array('mail','smtp')))
          {
              return FALSE;
          }
          
          $this->email->set_protocol($this->input->post('email_method'));
          
          if ($this->input->post('email_method')=='smtp')
          {
              $this->get_port_number($this->input->post('smtp_server'));
              $this->email->smtp_pass=$this->input->post('smtp_password');
              $this->email->smtp_user=$this->input->post('smtp_user_name');
          }
          
          $this->email->initialize();
          
          if ($this->input->post('from_email'))
          {
              $this->email->from($this->input->post('from_email'),$this->input->post('message_from'));
          }
          
          return $this->send_email($this->input->post('test_email'),'Email Test','Testing the email',TRUE);
      }
      
      function invite_person($person_type,$name,$email,$id)
      {
          $this->load->model('user_actions');
          $code=$this->user_actions->add_invitation_code(array('id'=>$id,'type'=>$person_type),'invitation');
          
          $this->load->model('settings_actions');
          $school_info=$this->settings_actions->get_school_info();
          
          $template=$this->settings_actions->get_email_template($person_type.'_invitation');
          
          $template['template_fields']=explode('|',$template['template_fields']);
          foreach($template['template_fields'] as $index=>$field)
          {
              $template['template_fields'][$index]='/#'.$field.'#/si';
          }
          
          $template=preg_replace(
                        $template['template_fields'],
                        array($name,$school_info['name'],'<a href="'.$this->config->item('base_url').'start/accept_invite/'.$code.'" target="_blank">'.$this->config->item('base_url').'start/accept_invite/'.$code.'</a>'),
                        $template['template_content']);
          
          $this->send_email($email,'Inivation to join "'.$school_info['name'].'"',$template);
      }
      
      private function configure_email()
      {
         $this->load->model('settings_actions');
         $settings=$this->settings_actions->get_settings('email');
         $this->send_type=$settings['send_type']; 
         
         $this->email->set_protocol($settings['email_method']);
         if ($settings['email_method']=='smtp')
         {
             $this->get_port_number($settings['smtp_server']);
             $this->email->smtp_pass=$settings['smtp_password'];
             $this->email->smtp_user=$settings['smtp_user_name'];
         }
         $this->email->initialize();
         
         $this->email->from($settings['from_email'],$settings['message_from']);
      }
      
      function send_lazy_emails()
      {
         $this->configure_email();
         
         if ($this->send_type!='lazy')
         {
             return FALSE;
         }
         
         $process_id=rand(0,65000);
         
         $this->db->limit(20);
         $this->db->update('emails',array('busy_by'=>$process_id),array('busy_by'=>0));
         
         if ($this->db->affected_rows()==0)
         {
             return FALSE;
         }
         
         $emails=$this->db
                      ->select('message_id,recipient,subject,message')
                      ->where('busy_by',$process_id)
                      ->get('emails')
                      ->result_array();
         foreach($emails as $email)
         {
             $this->proccess_email($email['recipient'],$email['subject'],$email['message'],TRUE)?
             $this->db->delete('emails',array('message_id'=>$email['message_id'])):
             $this->db->update('emails',array('busy_by'=>0),array('message_id'=>$email['message_id']));
         }
      }
  }
?>