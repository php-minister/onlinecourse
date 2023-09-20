<?php  
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */ 
  class Notification_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_new_notifications()
      {
         $result=$this->db
                      ->select('COUNT(notification_id) as notifications',FALSE)  
                      ->where(array('recipient_id'=>$this->session->userdata('person_id'),'recipient_type'=>$this->session->userdata('person_type'),'is_read'=>0))
                      ->get('notifications')
                      ->row_array();
         
         return $result['notifications']?$result['notifications']:0;
      }
      
      function get_notifications($read=FALSE)
      {
          if ($read)
          {
              $this->db->update('notifications',array('is_read'=>1),array('recipient_id'=>$this->session->userdata('person_id'),'recipient_type'=>$this->session->userdata('person_type'),'is_read'=>0));
          }
          
          return $this->db
                      ->select('notification_id,notification,date')
                      ->where(array('recipient_id'=>$this->session->userdata('person_id'),'recipient_type'=>$this->session->userdata('person_type')))
                      ->order_by('date','DESC')
                      ->get('notifications')
                      ->result_array();
      }
      
      function delete_notification($notification_id)
      {
          $this->db->delete('notifications',array('notification_id'=>$notification_id,'recipient_id'=>$this->session->userdata('person_id'),'recipient_type'=>$this->session->userdata('person_type')));
      }
      
      function get_new_messages()
      {
          $result=$this->db
                       ->select('SUM(new_messages) as new_messages',FALSE) 
                       ->where(array('person_id'=>$this->session->userdata('person_id'),'person_type'=>$this->session->userdata('person_type')))
                       ->get('messages_interlocutors')
                       ->row_array();
          
          return $result['new_messages']?$result['new_messages']:0;
      }
  }
?>