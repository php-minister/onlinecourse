<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property notification_actions          $notification_actions
    */
  class Notifications extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in();
      }
      
      function index()
      {
          $this->load->model('notification_actions');
          $this->load->view('user/notifications',array(
                'notifications_list'=>$this->notification_actions->get_notifications(TRUE),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function delete($notification_id=0)
      {
          $this->load->model('notification_actions');
          $this->notification_actions->delete_notification($notification_id);
          echo $this->lang->line('deleted');
      }
  }
?>