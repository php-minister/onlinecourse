<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property groups_actions       $groups_actions
    * @property scheduling_actions       $scheduling_actions
    */
    
  class Students_groups extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'students');
      }
      
      function index()
      {
          $this->load->model('groups_actions');
          $this->load->view('groups/index',array('groups'=>$this->groups_actions->get_groups()));
      }
      
      function new_group()
      {
          $this->load->model('groups_actions');
          $this->load->view('groups/new_group',array('grades'=>$this->groups_actions->get_grades()));
      }
      
      function save_group()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                    array('field'=>'group_id','rules'=>'required','label'=>$this->lang->line('group_id')),
                    array('field'=>'name','rules'=>'required','label'=>$this->lang->line('name'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('groups_actions');
          $this->load->view('groups/edit_group_result',array('result'=>$this->groups_actions->save_group()));
      }
      
      function edit($group_id=0)
      {
          $this->load->model('groups_actions');
          $this->load->view('groups/edit_group',array(
                        'group'=>$this->groups_actions->get_group($group_id),
                        'grades'=>$this->groups_actions->get_grades()
          ));
      }
      
      function delete($group_id=0)
      {
          $this->load->model('groups_actions');
          if (!$this->groups_actions->delete_group($group_id))
          {
              header('HTTP/1.0 400 Bad Request');
              die($this->lang->line('group_used'));
          }
          
          echo $this->lang->line('deleted');
      }
      
      function scheduling($group_id=0)
      {
          $this->load->model('scheduling_actions');
          $this->load->model('groups_actions');
          $this->load->view('groups/scheduling',array(
            'scheduling'=>$this->scheduling_actions->get_group_scheduling($group_id),
            'group'=>$this->groups_actions->get_group($group_id)
          ));
      }
      
      function find_groups()
      {
          $this->load->model('groups_actions');
          echo json_encode($this->groups_actions->find_groups());
      }
  }
?>