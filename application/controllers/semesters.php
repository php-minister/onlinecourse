<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property semesters_actions       $semesters_actions
    */
  class Semesters extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'settings');
      }
      
      function index()
      {
          $this->load->model('semesters_actions');
          $this->load->view('semesters/index',array('semesters'=>$this->semesters_actions->get_semesters()));
      }
      
      function new_semester()
      {
          $this->load->view('semesters/new_semester');
      }
      
      function save_semester()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'semester_id','rules'=>'required','label'=>$this->lang->line('semester_id')),
                array('field'=>'year_start','rules'=>'required|greater_than['.(date('Y')-1).']|less_than[2150]','label'=>$this->lang->line('academic_year_start')),
                array('field'=>'year_end','rules'=>'required|greater_than['.(date('Y')-1).']|less_than[2150]','label'=>$this->lang->line('academic_year_end'))
          ));
          
          if ($this->input->post('semester_id')=='0')
          {
              $this->form_validation->set_rules(array(
                    array('field'=>'start_date','rules'=>'required','label'=>$this->lang->line('start_date')),
                    array('field'=>'end_date','rules'=>'requried','label'=>$this->lang->line('end_date'))
              ));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('semesters_actions');
          $result=$this->semesters_actions->save_semester();
          if (!$result)
          {
              exit($this->load->view('layout/error',array('message'=>$this->semesters_actions->get_error()),TRUE));
          }
          
          $this->load->view('semesters/edit_semester_result',array(
                'result'=>$result,
                'start_date'=>strtotime($this->input->post('start_date')),
                'end_date'=>strtotime($this->input->post('end_date')),
                'is_current'=>$this->semesters_actions->is_current()
          ));
      }
      
      function delete($semester_id=0)
      {
          $this->load->model('semesters_actions');
          if (!$this->semesters_actions->delete_semester($semester_id))
          {
              header('HTTP/1.0 400 Bad Request');
              die($this->lang->line('semester_already_started'));
          }
          
          echo $this->lang->line('deleted');
      }
      
      function edit($semested_id=0)
      {
          $this->load->model('semesters_actions');
          $this->load->view('semesters/edit_semester',array('semester'=>$this->semesters_actions->get_semester($semested_id)));
      }
      
      function close()
      {
         $this->load->model('semesters_actions');
         $this->load->view('semesters/active_semester',array('semester'=>$this->semesters_actions->get_active_semester()));
      }
      
      function complete_semester()
      {
         $this->load->model('semesters_actions');
         if (!$this->semesters_actions->complete_semester())
         {
             exit($this->load->view('layout/error',array('message'=>$this->semesters_actions->get_error()),TRUE));
         }
         
         $this->load->view('layout/success',array('message'=>$this->lang->line('semester_completed')));
         
         $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'semesters'));
      }
  }
?>