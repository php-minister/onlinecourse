<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property teachers_actions    $teachers_actions
    * @property scheduling_actions    $scheduling_actions
    */  
    
  class Teachers extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
          $this->load->view('teachers/index');
      }
      
      function data()
      {
          $this->load->model('teachers_actions');
          $teachers=$this->teachers_actions->get_teachers();
           
          echo json_encode(array(
                    "sEcho" => intval($this->input->get('sEcho')),
                    "iTotalRecords" => $teachers['count'],
                    "iTotalDisplayRecords" =>$teachers['rows'],
                    "aaData" =>$teachers['data']
               ));
      }
      
      function new_teacher()
      {
          $this->load->view('teachers/new_teacher');
      }
      
      function save_teacher()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'teacher_id','rules'=>'required|is_numeric','label'=>$this->lang->line('teacher_id')),
                        array('field'=>'teacher_name','rules'=>'required','label'=>$this->lang->line('teacher_name')),
                        array('field'=>'email','rules'=>'required|valid_email','label'=>$this->lang->line('email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit(json_encode(array('error_message'=>$this->form_validation->error_string())));
          }
          
          if (($this->input->post('birth_date')) AND (!strtotime($this->input->post('birth_date'))) )
          {
              exit(json_encode(array('error_message'=>$this->lang->line('error_wrong_date'))));
          }
          
          $this->load->model('teachers_actions');

          if (!$this->teachers_actions->check_user_email($this->input->post('email'),$this->input->post('teacher_id'),'teacher'))
          {
              exit (json_encode(array('error_message'=>$this->lang->line('error_email_used'))));
          }
          
          $save_result=$this->teachers_actions->save_teacher();

          if (!$save_result)
          {
              exit(json_encode(array('error_message'=>$this->teachers_actions->get_error())));
          }

          echo json_encode($save_result);
      }
      
      function edit($teacher_id=0)
      {
          $this->load->model('teachers_actions');
          $this->load->view('teachers/edit_teacher',array('teacher'=>$this->teachers_actions->get_teacher($teacher_id)));
      }
      
      function resend_invitation($teacher_id=0)
      {
          $this->load->model('teachers_actions');
          $this->teachers_actions->resend_invitation($teacher_id,'teacher');
          $this->load->view('layout/success',array('message'=>$this->lang->line('invitation_sent')));
      }
      
      function change_status($new_status='',$teacher_id=0)
      {
          $this->load->model('teachers_actions');
          $result=$this->teachers_actions->change_status($new_status,$teacher_id);
          if (!$result)
          {
              exit (json_encode(array('error_message'=>$this->teachers_actions->get_error())));
          }
          echo json_encode(array('message'=>$this->lang->line('done')));
      }
      
      function find_teacher()
      {
          $this->load->model('teachers_actions');
          echo json_encode($this->teachers_actions->search_teachers());
      }
      
      function scheduling($teacher_id=0)
      {
          $this->load->model('scheduling_actions');
          $this->load->model('teachers_actions');
		  $scheduling_array = json_decode($this->scheduling_actions->get_teacher_scheduling($teacher_id));
		  if(empty($scheduling_array))
		  {
				header('Location:'.$this->config->item('base_url').'teachers');
				exit;
		   }
	     $this->load->view('scheduling/teacher',array(
            'scheduling'=>$this->scheduling_actions->get_teacher_scheduling($teacher_id),
            'teacher'=>$this->teachers_actions->get_teacher_name($teacher_id),
            'teacher_id'=>$teacher_id
          ));
      }
      
      function new_lesson($teacher_id=0)
      {
          $this->load->model('teachers_actions');
          $this->load->view('scheduling/new_lesson',array(
                        'subjects'=>$this->teachers_actions->get_teacher_subjects($teacher_id),
                        'teacher_id'=>$teacher_id
          ));
      }
      
      function edit_lesson($lesson_id=0)
      {
          $this->load->model('scheduling_actions');
          $this->load->model('teachers_actions');
          
          $lesson=$this->scheduling_actions->get_lesson($lesson_id);
          $this->load->vars('lesson',$lesson);
          $this->load->vars('subjects',$this->teachers_actions->get_teacher_subjects($lesson['teacher_id']));
          $this->load->view('scheduling/edit_lesson');
      }
  }
?>