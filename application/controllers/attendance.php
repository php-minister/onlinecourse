<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property attendance_actions       $attendance_actions
    */
  class Attendance extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'students');
      }
      
      function index()
      {
          $this->load->model('attendance_actions');
          $grades=$this->attendance_actions->get_date_grades(date('Y-m-d'));
          $this->load->vars('grades',$grades);
          if (count($grades)>0)
          {
              $this->load->vars('subjects',$this->attendance_actions->get_date_subjects(date('Y-m-d'),$grades[0]['grade_id'],$grades[0]['group_id']));
          }
          else
          {
              $this->load->vars('subjects',array());
          }
          $this->load->view('attendance/index');
          unset($grades);
      }
      
      function show_students()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'date','rules'=>'required','label'=>$this->lang->line('date')),
                        array('field'=>'grade','rules'=>'required','label'=>$this->lang->line('grade')),
                        array('field'=>'subject','rules'=>'required','label'=>$this->lang->line('subject'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('attendance_actions');
          $this->load->view('attendance/show_students',array(
                            'students'=>$this->attendance_actions->get_students($this->input->post('grade'),$this->input->post('subject')),
                            'attendance'=>$this->attendance_actions->get_attendance_statuses(),
                            'lesson_id'=>$this->input->post('subject'),
                            'user_type'=>'admin'
          ));
      }
      
      function get_date_grades($date='')
      {
          $date=strtotime(str_replace('-','/',$date));
          if ((!$date) OR ($date>mktime(0,0,0)))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error_wrong_date')),TRUE));
          }
          
          $date=date('Y-m-d',$date);
          $this->load->model('attendance_actions');
          $grades=$this->attendance_actions->get_date_grades($date);
          $this->load->vars('grades',$grades);
          if (count($grades)>0)
          {
              $this->load->vars('subjects',$this->attendance_actions->get_date_subjects($date,$grades[0]['grade_id'],$grades[0]['group_id']));
          }
          else
          {
              $this->load->vars('subjects',array());
          }
          $this->load->view('attendance/grades_subjects',array('user_type'=>'admin'));
      }
      
      function get_subjects($date='',$grade_id='0-0')
      {
         $date=strtotime(str_replace('-','/',$date));
          if (!$date)
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error_wrong_date')),TRUE));
          }
          
          $date=date('Y-m-d',$date);
          $grade_id=explode('-',$grade_id);
          $this->load->model('attendance_actions');
          $this->load->view('attendance/subjects',array('subjects'=>$this->attendance_actions->get_date_subjects($date,$grade_id[0],$grade_id[1])));
      }
      
      function set_status($new_status=1,$lesson_id=0,$student_id=0)
      {
          $this->load->model('attendance_actions');
          
          if (!in_array($new_status,array_keys($this->attendance_actions->get_attendance_statuses())))
          {
              exit (json_encode(array('error_message'=>$this->lang->line('wrong_attendance_status'))));
          }
          
          $this->attendance_actions->set_status($new_status,$lesson_id,$student_id);
          echo json_encode(array('success'=>TRUE));
      }
      
      function set_comments($lesson_id=0,$student_id=0)
      {
          $this->load->model('attendance_actions');
          $this->load->view('attendance/set_comments',array(
            'lesson_id'=>$lesson_id,
            'student_id'=>$student_id,
            'user_type'=>'admin',
            'comments'=>$this->attendance_actions->get_attendance_comments($lesson_id,$student_id)
          ));
      }
      
      function save_comments()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'student_id','rules'=>'required','label'=>'student_id'),
                array('field'=>'lesson_id','rules'=>'required','label'=>'lesson_id'),
                array('field'=>'comment','rules'=>'max_length[450]','label'=>$this->lang->line('comment')),
                array('field'=>'private_comment','rules'=>'max_length[450]','label'=>$this->lang->line('private_comment'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('attendance_actions');
          $this->attendance_actions->set_comments();
          $this->load->view('layout/success',array('message'=>$this->lang->line('saved')));
      }
  }
?>