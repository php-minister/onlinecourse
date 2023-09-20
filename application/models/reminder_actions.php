<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property CI_Security           $security
    * @property scheduling_actions           $scheduling_actions
    */ 
  class Reminder_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      private function add_reminder($reminder_text,$owner_id,$owner,$object_id,$object_type)
      {
          $this->db->insert('reminders',array('remind_text'=>$reminder_text,'remind_owner'=>$owner_id,'remind_person_type'=>$owner,'remind_object'=>$object_id,'remind_object_type'=>$object_type));
      }
      
      function add_lesson_reminder($lesson_id)
      {
          $this->load->model('scheduling_actions');
          if (!$this->scheduling_actions->is_lesson_owner($this->session->userdata('person_id'),$lesson_id))
          {
              return FALSE;
          }
          
          $this->add_reminder($this->input->post('reminder'),$this->session->userdata('person_id'),'teacher',$lesson_id,'lesson');
      }
      
      function get_lesson_reminders($lesson_id)
      {
          $base_lesson=$this->db
                            ->select('subject_id,grade,student_group')
                            ->where('scheduling_id',$lesson_id)
                            ->get('scheduling')
                            ->row_array();
          
          return $this->db
                      ->select('remind_id,remind_text')
                      ->join('reminders','reminders.remind_object = scheduling.scheduling_id AND reminders.remind_object_type="lesson" AND is_completed=0','LEFT')
                      ->where(array('teacher_id'=>$this->session->userdata('person_id'),'grade'=>$base_lesson['grade'],'subject_id'=>$base_lesson['subject_id'],'student_group'=>$base_lesson['student_group']))
                      ->where('reminders.remind_id IS NOT NULL',NULL,FALSE)
                      ->get('scheduling')
                      ->result_array();
      }
      
      function complete_reminder($reminder_id)
      {
          $this->db->update('reminders',array('is_completed'=>1),array('remind_id'=>$reminder_id,'remind_owner'=>$this->session->userdata('person_id'),'remind_person_type'=>'teacher'));
      }
  }
?>