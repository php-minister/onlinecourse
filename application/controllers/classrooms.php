<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property classrooms_actions       $classrooms_actions
    * @property scheduling_actions       $scheduling_actions
    */
  
  class Classrooms extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'settings');
      }
      
      function index()
      {
          $this->load->model('classrooms_actions');
          $this->load->view('classrooms/index',array('classrooms'=>$this->classrooms_actions->get_classrooms()));
      }
      
      function new_classroom()
      {
          $this->load->view('classrooms/new_classroom');
      }
      
      function save_classroom()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                    array('field'=>'classroom_id','rules'=>'required','label'=>$this->lang->line('classroom_id')),
                    array('field'=>'name','rules'=>'required','label'=>$this->lang->line('classroom_name'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('classrooms_actions');
          
          $this->load->view('classrooms/edit_classroom_result',array('result'=>$this->classrooms_actions->save_classroom()));
      }
      
      function edit($classroom_id=0)
      {
          $this->load->model('classrooms_actions');
          $this->load->view('classrooms/edit_classroom',array('classroom'=>$this->classrooms_actions->get_classroom($classroom_id)));
      }
      
      function scheduling($classroom_id=0)
      {
          $this->load->model('scheduling_actions');
          $this->load->model('classrooms_actions');
          $this->load->view('classrooms/scheduling',array(
            'scheduling'=>$this->scheduling_actions->get_classroom_scheduling($classroom_id),
            'classroom'=>$this->classrooms_actions->get_classroom($classroom_id)
          ));
      }
      
      function delete($classroom_id=0)
      {
         $this->load->model('classrooms_actions');
         if (!$this->classrooms_actions->delete_classroom($classroom_id))
         {
             header('HTTP/1.0 400 Bad Request');
             die($this->lang->line('classroom_already_in_use'));
         }
         
         echo $this->lang->line('deleted');
      }
  }
?>