<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property gradebook_actions       $gradebook_actions
    * @property settings_actions       $settings_actions
    */
  class Gradebook extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'teachers');
      }
      
      function index()
      {
          $this->load->model('settings_actions');
          $scale=$this->settings_actions->get_settings('scale');
          
          $this->load->model('gradebook_actions');
          $grades=$this->gradebook_actions->get_grades();
          $subjects=$this->gradebook_actions->get_subjects(isset($grades[0]['grade_id'])?$grades[0]['grade_id']:0);
   
          $this->load->view('gradebook/index',array(
                'grades'=>$grades,
                'semester'=>$this->gradebook_actions->get_current_semester(),
                'subjects'=>$subjects,
                'sets'=>$this->gradebook_actions->get_grade_sets(($grades[0]['grade_id'].'-'.$grades[0]['group_id']),(isset($subjects[0]['subject_id'])?$subjects[0]['subject_id']:0)),
                'scale'=>unserialize($scale['scale'])
          ));
      }
      
      function get_subjects($grade_id=0)
      {
          $this->load->model('gradebook_actions');
          $subjects=$this->gradebook_actions->get_subjects($grade_id);
          $this->load->view('gradebook/subjects',array(
            'subjects'=>$subjects,
            'sets'=>$this->gradebook_actions->get_grade_sets($grade_id,(isset($subjects[0]['subject_id'])?$subjects[0]['subject_id']:0))
          ));
      }
      
      function get_sets($grade_id=0,$subject_id=0)
      {
         $this->load->model('gradebook_actions');
          
         $this->load->view('gradebook/assignments',array(
                    'sets'=>$this->gradebook_actions->get_grade_sets($grade_id,$subject_id,$this->session->userdata('person_id'))
         )); 
      }
      
      function get_students()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'group_id','label'=>$this->lang->line('group'),'rules'=>'required'),
                array('field'=>'subject_id','label'=>$this->lang->line('subject'),'rules'=>'required'),
                array('field'=>'student_page','label'=>$this->lang->line('page'),'rules'=>'required'),
                array('field'=>'assignment_id','label'=>$this->lang->line('assignment'),'rules'=>'required')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          
          $this->load->view('gradebook/students',array(
               'students'=>$this->gradebook_actions->get_students($this->input->post('group_id'),$this->input->post('student_page'),$this->input->post('assignment_id')),
               'page_id'=>$this->input->post('student_page'),
               'set_id'=>(int)$this->input->post('assignment_id')
          ));
      }
      
      function save_scores()
      {
          $scores=json_decode($this->input->post('scores'),TRUE);
          if (is_null($scores))
          {
              exit (json_encode(array('error'=>$this->lang->line('error'))));
          }
          
          $this->load->model('gradebook_actions');
          if (!$this->gradebook_actions->save_new_scores($scores))
          {
              exit(json_encode(array('error'=>$this->gradebook_actions->get_error())));
          }
          
          echo json_encode(array('success'=>TRUE));
      }
      
      function delete_set($set_id=0)
      {
          $this->load->model('gradebook_actions');
          if (!$this->gradebook_actions->delete_set($set_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('can_not_delete_assignment')),TRUE));
          }
          echo $this->lang->line('Deleted');
      }
      
      function new_set()
      {
          $this->load->view('gradebook/new_set');
      }
      
      function save_set()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'set_id','rules'=>'requried','label'=>$this->lang->line('set_id')),
                array('field'=>'name','rules'=>'requried|max_length[100]','label'=>$this->lang->line('name')),
                array('field'=>'date','rules'=>'requried','label'=>$this->lang->line('assignment_date'))
          ));
          
          if ($this->input->post('set_id')=='0')
          {
              $this->form_validation->set_rules(array(
                    array('field'=>'group_id','rules'=>'required','label'=>$this->lang->line('group')),
                    array('field'=>'subject_id','rules'=>'required','label'=>$this->lang->line('subject'))
              ));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          $result=$this->gradebook_actions->save_set();
          if (!$result)
          {
              exit($this->load->view('layout/error',array('message'=>$this->gradebook_actions->get_error()),TRUE));
          }
          
          $this->load->view('gradebook/edit_set_result',array(
            'result'=>$result,
            'name'=>$this->input->post('name'),
            'date'=>date('d M Y',strtotime($this->input->post('date'))),
            'set_id'=>$this->input->post('set_id')
          ));
      }
      
      function edit_set($set_id=0)
      {
          $this->load->model('gradebook_actions');
          $this->load->view('gradebook/edit_set',array('set'=>$this->gradebook_actions->get_set($set_id)));
      }
  }
?>