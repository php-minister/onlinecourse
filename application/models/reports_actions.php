<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property attendance_actions          $attendance_actions
    */ 
  
  class Reports_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_last_teacher_comments()
      {
         return $this->db
                     ->select('rating,comment,date_added,teachers.name as teacher_name,students.name as student_name,grades.name as grade_name,subjects.name as subject_name,date,start_time',FALSE)
                     ->join('teachers','teachers.teacher_id = teachers_comments.teacher_id','LEFT')
                     ->join('students','students.student_id = teachers_comments.student_id','LEFT')
                     ->join('grades','grades.grade_id = students.grade','LEFT')
                     ->join('scheduling','scheduling.scheduling_id = teachers_comments.lesson_id','LEFT')
                     ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                     ->limit(10)
                     ->order_by('date_added','DESC')
                     ->get('teachers_comments')
                     ->result_array();
      }
      
      function get_teacher_feedbacks($teacher_id)
      {
          return $this->db
                     ->select('rating,comment,date_added,students.name as student_name,grades.name as grade_name,subjects.name as subject_name,date,start_time',FALSE)
                     ->join('students','students.student_id = teachers_comments.student_id','LEFT')
                     ->join('grades','grades.grade_id = students.grade','LEFT')
                     ->join('scheduling','scheduling.scheduling_id = teachers_comments.lesson_id','LEFT')
                     ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                     ->where('teachers_comments.teacher_id',$teacher_id)
                     ->get('teachers_comments')
                     ->result_array();
      }
      
      function get_last_student_attendance()
      {
          $this->load->model('attendance_actions');
          $statuses=$this->attendance_actions->get_attendance_statuses();
          $this->attendance_actions->init_attendance_statuses($statuses);
          
          
          return $this->db
                      ->select('subjects.name as subject_name,start_time,date,private_comment, teachers.name as teacher_name,students.name as student_name,IFNULL(attendance_statuses.name,"'.$statuses[1].'") as attendance_status',FALSE)
                      ->join('scheduling','scheduling.scheduling_id = attendance.lesson_id','LEFT')
                      ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                      ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                      ->join('students','students.student_id = attendance.student_id','LEFT')
                      ->join('attendance_statuses','attendance_statuses.status_id = attendance.status','LEFT')
                      ->where('private_comment IS NOT NULL',NULL,FALSE)
                      ->order_by('added','DESC')
                      ->limit(10)
                      ->get('attendance')
                      ->result_array();
      }
      
      function get_student_attendance($student_id)
      {
          $this->load->model('attendance_actions');
          $statuses=$this->attendance_actions->get_attendance_statuses();
          $this->attendance_actions->init_attendance_statuses($statuses);
          
          return $this->db
                      ->select('subjects.name as subject_name,start_time,date,private_comment,comment,teachers.name as teacher_name,IFNULL(attendance_statuses.name,"'.$statuses[1].'") as attendance_status',FALSE)
                      ->join('scheduling','scheduling.scheduling_id = attendance.lesson_id','LEFT')
                      ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                      ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                      ->join('attendance_statuses','attendance_statuses.status_id = attendance.status','LEFT')
                      ->where('student_id',$student_id)
                      ->where('private_comment IS NOT NULL',NULL,FALSE)
                      ->get('attendance')
                      ->result_array();
      }
      
      function get_donations()
      {
          return $this->db
                      ->select('donation_id,donation,donation_date,comment,name,source,transactions.status,transaction_code')
                      ->join('donors','donors.donor_id = donations.donor_id','LEFT')
                      ->join('transactions','transactions.transaction_id = donations.transaction_id','LEFT')
                      ->where('is_paid',1)
                      ->get('donations')
                      ->result_array();
      }
      
      function get_donated()
      {
          return $this->db
                      ->select('donate_id,donated.amount as donated,date,students.name as student_name,donors.name as donor_name,fee_name,fees.amount as fee_amount')
                      ->join('students','students.student_id = donated.student_id','LEFT')
                      ->join('donors','donors.donor_id = donated.donor_id','LEFT')
                      ->join('fees','fees.fee_id = donated.fee_id','LEFT')
                      ->get('donated')
                      ->result_array();
      }
      
      function get_last_payments()
      {
          return $this->db
                      ->select('transactions.transaction_id,source,fee_name,sum,transaction_code,payment_date,students.name as student_name,transactions.`status`')
                      ->join('fees_members','fees_members.transaction_id = transactions.transaction_id')
                      ->join('students','students.student_id = fees_members.student_id','LEFT')
                      ->join('fees','fees.fee_id = fees_members.fee_id','LEFT')
                      ->where('transactions.`status` IS NOT NULL',NULL,FALSE)
                      ->order_by('transactions.transaction_id','DESC')
                      ->limit(10)
                      ->get('transactions')
                      ->result_array();
      }
      
      function get_payments($fee_id)
      {
          return $this->db
                      ->select('is_paid,fees_members.is_deleted,source,sum,transaction_code,payment_date,students.name as student_name,IFNULL(fees_members.until,fees.until) as until,transactions.`status`',FALSE)  
                      ->join('transactions','transactions.transaction_id = fees_members.transaction_id','LEFT')
                      ->join('students','students.student_id = fees_members.student_id','LEFT')
                      ->join('fees','fees.fee_id = fees_members.fee_id','LEFT')
                      ->where('fees_members.fee_id',$fee_id)
                      ->get('fees_members')
                      ->result_array();
      }
  }
?>