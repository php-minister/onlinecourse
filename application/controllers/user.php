<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    */ 
  
  class User extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in();
      }
      
      function logout()
      {
		  if ($this->session->userdata('person_type')=='teacher')
          {
			  $header_location = $this->config->item('base_url').'start';
		  }
		  else
		  {
			  $header_location = $this->config->item('base_url');
		  }
			  
          $this->user_actions->logout();
          header('Location:'.$header_location);
      }
      
      function new_password()
      {
          $this->load->view('user/new_password');
      }
      
      function change_password()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                                array('field'=>'current_password','rules'=>'required','label'=>$this->lang->line('current_password')),
                                array('field'=>'new_password','rules'=>'required','label'=>$this->lang->line('new_password')),
                                array('field'=>'new_password_again','rules'=>'required|matches[new_password]','label'=>$this->lang->line('new_password_again'))
          ));
          
          if ($this->form_validation->run()===FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if (!$this->user_actions->change_password($this->input->post('current_password'),$this->input->post('new_password')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error_wrong_password')),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('password_changed')));
      }
      
      function find_teacher()
      {
         $this->load->model('school_model');
         $this->load->model('teachers_actions');
         echo json_encode($this->teachers_actions->search_teachers()); 
      }
      
      function find_student()
      {
          $this->user_actions->is_loged_in('teacher');
          $this->load->model('school_model');
          $this->load->model('students_actions');
          echo json_encode($this->students_actions->get_students_list());
      }
      
      function find_parent()
      {
         if (!$this->user_actions->is_loged_in('teacher',FALSE))
         {
            $this->user_actions->is_loged_in('parent');    
         }
         
         $this->load->model('school_model');
         $this->load->model('parents_actions');
         echo json_encode($this->parents_actions->get_parents_list()); 
      }
  }
?>