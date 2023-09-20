<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property incidents_actions       $incidents_actions
    */
  class Incidents extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'students');
      }
      
      function index()
      {
          $this->load->view('incidents/index');
      }
      
      function data()
      {
          $this->load->model('incidents_actions');
          $incidents=$this->incidents_actions->get_incidents();
           
          echo json_encode(array(
                    "sEcho" => intval($this->input->get('sEcho')),
                    "iTotalRecords" => $incidents['count'],
                    "iTotalDisplayRecords" =>$incidents['rows'],
                    "aaData" =>$incidents['data']
               ));
      }
      
      function new_incident()
      {
          $this->load->view('incidents/new_incident');
      }
      
      function save_incident()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                    array('field'=>'incident_id','rules'=>'required','label'=>$this->lang->line('incident_id')),
                    array('field'=>'student_list','rules'=>'required|min_length[3]','label'=>$this->lang->line('student')),
                    array('field'=>'teacher_list','rules'=>'min_length[3]','label'=>$this->lang->line('reported_by')),
                    array('field'=>'details','rules'=>'required','label'=>$this->lang->line('details')),
                    array('field'=>'date','rules'=>'requried','label'=>$this->lang->line('date'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if (!strtotime($this->input->post('date')))
          {
              exit(json_encode(array('error_message'=>$this->lang->line('error_wrong_date'))));
          }
          
          $this->load->model('incidents_actions');
          
          $this->load->view('incidents/edit_incident_result',array('result'=>$this->incidents_actions->save_incident()));
      }
      
      function edit($incident_id=0)
      {
          $this->load->model('incidents_actions');
          $this->load->view('incidents/edit_incident',array('incident'=>$this->incidents_actions->get_incident($incident_id)));
      }
      
	  function view($incident_id = 0)
	  {
		  $this->load->model('incidents_actions');
          $this->load->view('incidents/view_incident',array('incident'=>$this->incidents_actions->get_incident($incident_id)));
	  }
	  
      function delete($incident_id=0)
      {
          $this->load->model('incidents_actions');
          $this->incidents_actions->delete_incident($incident_id);
          echo $this->lang->line('deleted');
      }
  }
?>