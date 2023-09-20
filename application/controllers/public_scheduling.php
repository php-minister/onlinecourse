<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property scheduling_actions       $scheduling_actions
    * @property user_actions       $user_actions
    * @property settings_actions       $settings_actions
    */
  class Public_scheduling extends CI_Controller
  {
      function  __construct()
      {
          parent::__construct();
          if ($this->input->post('user_type')=='admin')
          {
              $this->load->model('admin_actions');
              $this->admin_actions->is_loged_in(__CLASS__,'teachers');
          }
          elseif($this->input->post('user_type')=='teacher')
          {
              $this->load->model('user_actions');
              $this->user_actions->is_loged_in('teacher');
              
              $this->load->model('settings_actions');
              if ($this->settings_actions->get_setting('teacher_manage_own_subjects')!='on')
              {
                  exit();
              }
              $this->load->language('public_scheduling');
          }
          else
          {
              exit();
          }
      }
      
      function find_free_classroom()
      {
          $this->load->model('scheduling_actions');
          
          if (!$this->scheduling_actions->check_lesson_times())
          {
              exit ($this->load->view('layout/error',array('message'=>$this->scheduling_actions->get_error()),TRUE));
          }
          
          $this->load->view('scheduling/add_rooms',array('rooms'=>$this->scheduling_actions->get_free_classes()));
      }
      
      function save_lesson()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'lesson_id','rules'=>'requried','label'=>$this->lang->line('lesson_id')),
                        array('field'=>'teacher_id','rules'=>'requried','label'=>$this->lang->line('teacher_id')),
                        array('field'=>'start_date','rules'=>'required','label'=>$this->lang->line('start_date')),
                        array('field'=>'lesson_start','rules'=>'required','label'=>$this->lang->line('lesson_start')),
                        array('field'=>'lesson_end','rules'=>'required','label'=>$this->lang->line('lesson_end')),
                        array('field'=>'subject','rules'=>'required','label'=>$this->lang->line('subject')),
                        array('field'=>'room','rules'=>'required','label'=>$this->lang->line('room'))
          ));
          
          if ($this->input->post('is_private')=='true')
          {
              $this->form_validation->set_rules(array(
                array('field'=>'chosen_students','rules'=>'required|min_length[3]','label'=>$this->lang->line('students'))
              ));
          }
          else
          {
              $this->form_validation->set_rules(array(
                array('field'=>'grade','rules'=>'required','label'=>$this->lang->line('grade'))
              ));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if ((isset($this->session->userdata['person_id'])) AND  ($this->input->post('teacher_id')!=$this->session->userdata('person_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('scheduling_actions');
          $result=$this->scheduling_actions->add_lesson();
          if (!$result)
          {
              exit($this->load->view('layout/error',array('message'=>$this->scheduling_actions->get_error()),TRUE));
          }
          
          $this->load->view('scheduling/edit_lesson_result',array(
                                'result'=>$result,
                                'event'=>$this->scheduling_actions->get_added_event(),
                                'room_id'=>$this->input->post('room')
          ));
      }
      
      function remove_lesson($lesson_id=0)
      {
          $this->load->model('scheduling_actions');
          if (!$this->scheduling_actions->remove_lessson($lesson_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('lesson_not_removed')),TRUE));
          }
          
          $this->load->view('scheduling/remove_lesson',array('lesson_id'=>$lesson_id));
      }
  }
?>