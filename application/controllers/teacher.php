<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property settings_actions          $settings_actions
    * @property scheduling_actions          $scheduling_actions
    * @property teachers_actions          $teachers_actions
    * @property incidents_actions          $incidents_actions
    * @property students_actions          $students_actions
    * @property gradebook_actions          $gradebook_actions
    * @property attendance_actions          $attendance_actions
    * @property notification_actions          $notification_actions
    * @property reminder_actions          $reminder_actions
    */ 
  class Teacher extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('teacher');
          $this->load->model('school_model');
      }
      
      function index()
      {
          $this->load->model('settings_actions');
          $this->load->model('scheduling_actions');
          $this->load->model('notification_actions');
		/* print_r($this->scheduling_actions->get_teacher_scheduling($this->session->userdata['person_id']));
		  die();*/
          
          $this->load->view('teacher/index',array(
            'settings'=>$this->settings_actions->get_settings('global'),
            'scheduling'=>$this->scheduling_actions->get_teacher_scheduling($this->session->userdata['person_id']),
            'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function new_lesson()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_own_subjects')!='on')
          {	
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('teachers_actions');
          $this->load->view('teacher/new_lesson',array(
                'subjects'=>$this->teachers_actions->get_teacher_subjects($this->session->userdata('person_id')),
                'teacher_id'=>$this->session->userdata('person_id')
          ));
      }
	  
	  function get_schedule()
	  {
	          $this->load->model('scheduling_actions');		
			  $this->load->model('teachers_actions');  
			  $this->load->vars('scheduling',$this->scheduling_actions->get_teacher_schedule());              
			  $this->load->vars('teacher_data' , $this->teachers_actions->get_teacher($this->session->userdata('person_id')));
			  //print_r($this->teachers_actions->get_teacher($this->session->userdata('person_id')));
			  $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('teacher_schedule');		  
	  }
      
      function edit_lesson($lesson_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_own_subjects')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('scheduling_actions');
          $this->load->model('teachers_actions');
          
          $lesson=$this->scheduling_actions->get_lesson($lesson_id);
          if (count($lesson)==0)
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('lesson_not_found')),TRUE));
          }
          $this->load->vars('lesson',$lesson);
          $this->load->vars('subjects',$this->teachers_actions->get_teacher_subjects($lesson['teacher_id']));
          $this->load->view('teacher/edit_lesson');
      }
      
      /*--------- Incidents --------------*/
      function incidents()
      {
          $this->load->model('settings_actions');
          $settings=$this->settings_actions->get_settings('global');
          if ($settings['teacher_manage_incidents']!='on')
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('notification_actions');
          $this->load->model('incidents_actions');
          $this->load->view('teacher/incidents',array(
            'incidents'=>$this->incidents_actions->get_person_incidents('teacher'),
            'settings'=>$settings,
            'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function new_incident()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_incidents')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          $this->load->view('teacher/new_incident');
      }
      
      function save_incident()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_incidents')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                    array('field'=>'incident_id','rules'=>'required','label'=>$this->lang->line('incident_id')),
                    array('field'=>'student_list','rules'=>'required|min_length[3]','label'=>$this->lang->line('students')),
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
          $_POST['teacher_list']=json_encode(array($this->session->userdata('person_id')));
          
          $this->load->view('teacher/edit_incident_result',array(
                'result'=>$this->incidents_actions->save_incident(),
                'date'=>date('d M Y',strtotime($this->input->post('date')))
          ));
      }
      
      function edit_incident($incident_id=0)
      {
         $this->load->model('settings_actions');
         if ($this->settings_actions->get_setting('teacher_manage_incidents')!='on')
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
         }
         
         $this->load->model('incidents_actions');
         $this->load->view('teacher/edit_incident',array('incident'=>$this->incidents_actions->get_incident($incident_id)));
      }
      
      function view_incident($incident_id=0)
      {
         $this->load->model('settings_actions');
         if ($this->settings_actions->get_setting('teacher_manage_incidents')!='on')
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
         }
         
         $this->load->model('incidents_actions');
         $this->load->view('teacher/view_incident',array('incident'=>$this->incidents_actions->get_breif_incident($incident_id)));
      }
      
      function delete_incident($incident_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_incidents')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          $this->load->model('incidents_actions');
          $this->incidents_actions->delete_incident($incident_id);
          echo 'Deleted';
      }
      
      function find_student()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_incidents')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('students_actions');
          echo json_encode($this->students_actions->get_teachers_students_list());
      }
      
      /*----------- Gradebook -----------------*/
      function gradebook()
      {
          $this->load->model('settings_actions');
          $settings=$this->settings_actions->get_settings('global');
          if ($settings['teacher_manage_gradebook']!='on')
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $scale=$this->settings_actions->get_settings('scale');
          
          $this->load->model('notification_actions');
          $this->load->model('gradebook_actions');
          $grades=$this->gradebook_actions->get_teacher_grades();
          $subjects=$this->gradebook_actions->get_subjects(isset($grades[0]['grade_id'])?$grades[0]['grade_id']:0,$this->session->userdata('person_id'));
          
          $this->load->view('teacher/gradebook',array(
                'grades'=>$grades,
                'semester'=>$this->gradebook_actions->get_current_semester(),
                'settings'=>$settings,
                'subjects'=>$subjects,
                'sets'=>$this->gradebook_actions->get_grade_sets((isset($grades[0]))?($grades[0]['grade_id'].'-'.$grades[0]['group_id']):('0-0'),isset($subjects[0])?$subjects[0]['subject_id']:0,$this->session->userdata('person_id')),
                'scale'=>unserialize($scale['scale']),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function get_gradebook_subjects($grade_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          $subjects=$this->gradebook_actions->get_subjects($grade_id,$this->session->userdata('person_id'));
          
          $this->load->view('teacher/gradebook_subjects',array(
                    'subjects'=>$subjects,
                    'sets'=>$this->gradebook_actions->get_grade_sets($grade_id,$subjects[0]['subject_id'],$this->session->userdata('person_id'))
          ));
      }
      
      function get_gradebook_sets($grade_id=0,$subject_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          
          $this->load->view('teacher/gradebook_assignments',array(
                    'sets'=>$this->gradebook_actions->get_grade_sets($grade_id,$subject_id,$this->session->userdata('person_id'))
          ));
      }
      
      function get_gradebook_students()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
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
          
          $this->load->view('teacher/gradebook_students',array(
               'students'=>$this->gradebook_actions->get_students($this->input->post('group_id'),$this->input->post('student_page'),$this->input->post('assignment_id')),
               'page_id'=>$this->input->post('student_page'),
               'set_id'=>(int)$this->input->post('assignment_id')
          ));
      }
      
      function delete_gradebook_set($set_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          if (!$this->gradebook_actions->delete_set($set_id,$this->session->userdata('person_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('can_not_delete_assignment')),TRUE));
          }
          echo 'Deleted';
      }
      
      function new_gradebook_set()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->view('teacher/new_gradebook_set');
      }
      
      function save_gradebook_set()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'set_id','rules'=>'requried','label'=>$this->lang->line('set_id')),
                array('field'=>'name','rules'=>'requried|max_length[100]','label'=>$this->lang->line('name')),
                array('field'=>'date','rules'=>'requried','label'=>$this->lang->line('date'))
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
      
      function edit_gradebook_set($set_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          $this->load->view('teacher/edit_gradebook_set',array('set'=>$this->gradebook_actions->get_set($set_id)));
      }
      
      function save_gradebook_scores()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_gradebook')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          
          $scores=json_decode($this->input->post('scores'),TRUE);
          if (is_null($scores))
          {
              exit (json_encode(array('error'=>$this->lang->line('error'))));
          }
          
          $this->load->model('gradebook_actions');
          if (!$this->gradebook_actions->save_new_scores($scores))
          {
              exit  (json_encode(array('error'=>$this->gradebook_actions->get_error())));
          }
          
          echo json_encode(array('success'=>TRUE));
      }
      
      /*------------ Attendance -------------*/
      function attendance()
      {
          $this->load->model('settings_actions');
          $settings=$this->settings_actions->get_settings('global');
          if ($settings['teacher_manage_attendance']!='on')
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
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
          
          $this->load->model('notification_actions');
          $this->load->view('teacher/attendance',array(
                'settings'=>$settings,
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function show_attendance_students()
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_attendance')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
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
          
          $this->load->language('attendance');
          $this->load->model('attendance_actions');
          $this->load->view('attendance/show_students',array(
                            'students'=>$this->attendance_actions->get_students($this->input->post('grade'),$this->input->post('subject')),
                            'attendance'=>$this->attendance_actions->get_attendance_statuses(),
                            'lesson_id'=>$this->input->post('subject'),
                            'user_type'=>'teacher'
          ));
      }
      
      function get_date_grades($date='')
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_attendance')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $date=strtotime(str_replace('-','/',$date));
          if ((!$date) OR ($date>mktime(0,0,0)))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error_wrong_date')),TRUE));
          }
          
          $date=date('Y-m-d',$date);
          
          $this->load->language('attendance');
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
          $this->load->view('attendance/grades_subjects',array('user_type'=>'teacher'));
      }
      
      function get_subjects($date='',$grade_id='')
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_attendance')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $date=strtotime(str_replace('-','/',$date));
          if (!$date)
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error_wrong_date')),TRUE));
          }
          
          $date=date('Y-m-d',$date);
          $grade_id=explode('-',$grade_id);
          
          $this->load->language('attendance');
          $this->load->model('attendance_actions');
          $this->load->view('attendance/subjects',array('subjects'=>$this->attendance_actions->get_date_subjects($date,$grade_id[0],$grade_id[1])));
      }
      
      function set_attendance_status($new_status=1,$lesson_id=0,$student_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_attendance')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->language('attendance');
          $this->load->model('attendance_actions');
          
          if (!in_array($new_status,array_keys($this->attendance_actions->get_attendance_statuses())))
          {
              exit (json_encode(array('error_message'=>$this->lang->line('wrong_attendance_status'))));
          }
          
          $this->attendance_actions->set_status($new_status,$lesson_id,$student_id);
          echo json_encode(array('success'=>TRUE)); 
      }
      
      function set_attendance_comments($lesson_id=0,$student_id=0)
      {
          $this->load->model('settings_actions');
          if ($this->settings_actions->get_setting('teacher_manage_attendance')!='on')
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('denied')),TRUE));
          }
          
          $this->load->model('scheduling_actions');
          if (!$this->scheduling_actions->is_lesson_owner($this->session->userdata('person_id'),$lesson_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          
          $this->load->model('attendance_actions');
          $this->load->view('attendance/set_comments',array(
            'lesson_id'=>$lesson_id,
            'student_id'=>$student_id,
            'user_type'=>'teacher',
            'comments'=>$this->attendance_actions->get_attendance_comments($lesson_id,$student_id)
          ));
      }
      
      function save_attendance_comments()
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
          
          $this->load->model('scheduling_actions');
          if (!$this->scheduling_actions->is_lesson_owner($this->session->userdata('person_id'),$this->input->post('lesson_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('attendance_actions');
          $this->attendance_actions->set_comments();
          $this->load->view('layout/success',array('message'=>$this->lang->line('saved')));
      }
      
      function add_reminder($lesson_id=0)
      {
          if (!$this->input->post('reminder'))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('reminder_actions');
          $this->reminder_actions->add_lesson_reminder($lesson_id);
      }
      
      function view_lesson_reminders($lesson_id=0)
      {
          $this->load->model('scheduling_actions');
          if (!$this->scheduling_actions->is_lesson_owner($this->session->userdata('person_id'),$lesson_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('reminder_actions');
          $this->load->view('teacher/view_reminders',array('reminders'=>$this->reminder_actions->get_lesson_reminders($lesson_id)));
      }
      
      function complete_reminder($reminder_id=0)
      {
          $this->load->model('reminder_actions');
          $this->reminder_actions->complete_reminder($reminder_id);
      }
  }
?>