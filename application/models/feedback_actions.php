<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */ 
  class Feedback_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function add_comment()
      {
          $teacher_id=$this->db
                           ->select('teacher_id,DATE_FORMAT(date,"%m-%d-%Y") as date,scheduling_id',FALSE)
                           ->where('scheduling_id',$this->input->post('scheduling_id'))
                           ->get('scheduling')
                           ->row_array();
          
          if (count($teacher_id)==0)
          {
              return FALSE;
          }
          
          $this->db->query('INSERT INTO teachers_comments(lesson_id,teacher_id,student_id,rating,comment,date_added)
                           VALUES(?,?,?,?,?,now())
                           ON DUPLICATE KEY UPDATE lesson_id=lesson_id',array($this->input->post('scheduling_id'),$teacher_id['teacher_id'],$this->session->userdata('person_id'),(int)$this->input->post('score'),$this->input->post('comment')));
                           
          return $teacher_id;
      }
      
      function is_comment_added($lesson_id)
      {
          $result=$this->db
                       ->select('rating,comment')
                       ->where(array('lesson_id'=>$lesson_id,'student_id'=>$this->session->userdata('person_id')))
                       ->get('teachers_comments')
                       ->row_array();
          
          return (count($result)==0)?FALSE:$result;
      }
  }
?>