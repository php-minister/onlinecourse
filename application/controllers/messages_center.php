<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property messages_actions       $messages_actions
    */
  class Messages_center extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
          $this->load->model('messages_actions');
          $this->load->view('messages/admin_messages',array('messages'=>$this->messages_actions->get_messages()));
      }
      
      function new_message()
      {
          $this->load->view('messages/new_admin_message');
      }
      
      function send_message()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'message','rules'=>'required|max_length[2000]','label'=>$this->lang->line('message')),
                array('field'=>'subject','rules'=>'required|max_length[200]','label'=>$this->lang->line('subject'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if ((!isset($_POST['teachers_list'])) AND (!isset($_POST['students_list'])) AND (!isset($_POST['parents_list'])))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('one_recipient')),TRUE));
          }
          
          if ((!is_array(json_decode($this->input->post('teachers_list'),TRUE))) AND (!is_array(json_decode($this->input->post('students_list'),TRUE))) AND (!is_array(json_decode($this->input->post('parents_list'),TRUE))))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('one_recipient')),TRUE));
          }
          
          
          $this->load->model('messages_actions');
          
          if (!$this->messages_actions->create_thread())
          {
              exit($this->load->view('layout/error',array('message'=>$this->messages_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('message_sent')));
          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'messages_center'));
      }
      
      function thread($thread_id=0)
      {
          $this->load->model('messages_actions');
          if (!$this->messages_actions->check_permissions($thread_id))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->view('messages/admin_thread',array('thread'=>$this->messages_actions->get_thread($thread_id)));
      }
      
      function reply($thread_id=0)
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                                            array('field'=>'new_message','rules'=>'required|max_length[2000]','label'=>$this->lang->line('new_message'))
            ));
            
          if ($this->form_validation->run()===FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('messages_actions');
          if (!$this->messages_actions->check_permissions($thread_id))
          {
              $this->load->view('layout/error',array('message'=>$this->lang->line('error')));
          }
          
          $this->messages_actions->add_message($thread_id);
          
          $this->load->view('messages/add_message',array(
                                                    'message'=>preg_replace('/\n/si','<br/>',addslashes($this->input->post('new_message'))),
                                                    'autor'=>'Admin',
                                                    'avatar'=>DEFAULT_PHOTO,
            ));
      }
  }
?>