<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property users_actions       $users_actions
    */
    
  class Users extends CI_Controller
  {
     function __construct()
     {
         parent::__construct();
         $this->load->model('admin_actions');
         $this->admin_actions->is_loged_in(__CLASS__);
     } 
     
     function index()
     {
         header('Location:users/staff');
     }
     
     function staff()
     {
         $this->load->model('users_actions');
         $this->load->view('users/staff',array('staff'=>$this->users_actions->get_staff()));
     }
     
     function delete_staff($employee_id=0)
     {
         $this->load->model('users_actions');
         $this->users_actions->delete_employee($employee_id);
         echo $this->lang->line('deleted');
     }
     
     function new_employee()
     {
         $this->load->config('schoolboard');
         $this->load->view('users/new_employee');
     }
     
     function save_employee()
     {
         $this->load->library('form_validation');
         $this->form_validation->set_rules(array(
                array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
                array('field'=>'admin_name','rules'=>'required|max_length[50]','label'=>$this->lang->line('employee_name')),
                array('field'=>'admin_login','rules'=>'required|max_length[50]','label'=>$this->lang->line('employee_login'))
         ));
         
         if ($this->input->post('employee_id')=='0')
         {
             $this->form_validation->set_rules(array(
                array('field'=>'admin_password','rules'=>'required|max_length[20]','label'=>$this->lang->line('employee_password')),
                array('field'=>'password_again','rules'=>'required|matches[admin_password]','label'=>$this->lang->line('employee_password_again'))
             ));
         }
         else
         {
             $this->form_validation->set_rules(array(
                array('field'=>'password_again','rules'=>'matches[admin_password]','label'=>$this->lang->line('employee_password_again'))
             ));
         }
         
         if ($this->form_validation->run()==FALSE)
         {
             exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
         }
         
         $this->load->model('users_actions');
         if ($this->users_actions->is_login_busy())
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('login_is_busy')),TRUE));
         }
         
         $this->load->view('users/edit_employee_result',array('result'=>$this->users_actions->save_employee()));
     }
     
     function staff_edit($employee_id=0)
     {
         $this->load->config('schoolboard');
         
         $this->load->model('users_actions');
         $this->load->view('users/edit_employee',array('employee'=>$this->users_actions->get_employee($employee_id)));
     }
  }
?>