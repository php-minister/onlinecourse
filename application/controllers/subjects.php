<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property subjects_actions       $subjects_actions
    * @property teachers_actions       $teachers_actions
    */ 
  
  class Subjects extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'teachers');
      }
      
      function index()
      {
          $this->load->model('subjects_actions');
          $this->load->view('subjects/index',array('subjects'=>$this->subjects_actions->get_subjects()));
      }
      
      function new_subject()
      {
          $this->load->model('groups_actions');
          $this->load->view('subjects/new_subject',array('grades'=>$this->groups_actions->get_grades()));
      }
      
      function save_subject()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'subject_id','rules'=>'required','label'=>$this->lang->line('subject_id')),
                        array('field'=>'name','rules'=>'requried','label'=>$this->lang->line('name')),
                        array('field'=>'teachers_list','rules'=>'required|min_length[3]','label'=>$this->lang->line('teachers')),
                        array('field'=>'grades_list','rules'=>'required|min_length[3]','label'=>$this->lang->line('grades'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if ((!is_array(json_decode($this->input->post('grades_list'),TRUE))) OR (!is_array(json_decode($this->input->post('teachers_list'),TRUE))))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('please_check_teachers_and_grades')),TRUE));
          }
          
          $this->load->model('subjects_actions');
          $this->load->view('subjects/edit_subject_result',array('result'=>$this->subjects_actions->save_subject()));
      }
      
      function edit($subject_id=0)
      {
          $this->load->helper('json_encode');
          
          $this->load->model('subjects_actions');
          $this->load->model('groups_actions');
          $this->load->view('subjects/edit_subject',array(
                'subject'=>$this->subjects_actions->get_subject($subject_id),
                'grades'=>$this->groups_actions->get_grades()
          ));
      }
      
      function delete($subject_id=0)
      {
          $this->load->model('subjects_actions');
          $this->subjects_actions->delete_subject($subject_id);
          echo $this->lang->line('deleted');
      }
  }
?>