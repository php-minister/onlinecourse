<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */ 
  class Attendance_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_date_grades($date)
      {
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('teacher_id',$this->session->userdata('person_id'));
          }
          
          return $this->db
                      ->select('IFNULL(grades.grade_id,0) as grade_id,IFNULL(grades.name,"Private lessons") as name,is_active,`order`,IFNULL(students_groups.group_id,0) as group_id,IFNULL(students_groups.group_name,"'.$this->lang->line('all_groups').'") as group_name',FALSE)
                      ->join('grades','grades.grade_id = scheduling.grade','LEFT')
                      ->join('students_groups','students_groups.group_id = scheduling.student_group AND students_groups.is_deleted=0','LEFT')
                      ->where('date',$date)
                      ->group_by('scheduling.grade,scheduling.student_group')
                      ->order_by('grades.name,group_id','asc')
                      ->get('scheduling')
                      ->result_array();
      }
      
      function get_date_subjects($date,$grade_id,$group_id)
      {
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('teacher_id',$this->session->userdata('person_id'));
          }
          
          return $this->db
                      ->select('scheduling_id,start_time,end_time,subjects.name as subject_name')  
                      ->join('subjects','subjects.subject_id =  scheduling.subject_id','LEFT')
                      ->where(array('`date`'=>$date,'grade'=>$grade_id,'student_group'=>$group_id))
                      ->order_by('start_time','ASC')
                      ->get('scheduling')
                      ->result_array();
          
      }
      
      function get_students($grade,$subject)
      {
          $grade=explode('-',$grade);
          if ($grade[0]!='0')
          {
              $this->db->where('grade',$grade[0]);
              if ($grade[1]!='0')
              {
                  $this->db->where('group',$grade[1]);
              }    
          }
          else
          {
              $students=$this->db
                             ->select('is_private')
                             ->where(array('grade'=>0,'student_group'=>0))
                             ->where('date','"'.date('Y-m-d',strtotime($this->input->post('date'))).'"',FALSE)
                             ->where('is_private IS NOT NULL',NULL,FALSE)
                             ->get('scheduling')
                             ->row_array();
              
              $this->db->where_in('students.student_id',explode(',',$students['is_private']));
          }
          
          
          $this->db->_reserved_identifiers[]=(int)$subject;
          
          return $this->db
                      ->select('students.student_id,name,IFNULL(attendance.status,0) as status',FALSE)
                      ->join('attendance','attendance.lesson_id = '.(int)$subject.' AND attendance.student_id = students.student_id','LEFT')
                      ->where_in('students.`status`',array('Active','Inactive'))
                      ->order_by('name')
                      ->get('students')
                      ->result_array();
      }
      
      function set_status($new_status,$lesson_id,$student_id)
      {
        /*  if ($new_status==1)
          {
              $this->db->where(array('lesson_id'=>$lesson_id,'student_id'=>$student_id));
              $this->db->where('comment IS ','NULL',FALSE);
              $this->db->delete('attendance');
              if ($this->db->affected_rows()!=0)
              {
                  return TRUE;
              }
          }*/
          
          if (!isset($this->session->userdata['admin_id'])) 
         {
             $this->db->_reserved_identifiers[]=(int)$student_id;
             if ($this->db
                      ->select('student_id')
                      ->join('students','students.student_id = '.(int)$student_id.' AND students.grade = teacher_subjects.grade_id','LEFT')
                      ->where('teacher_id',$this->session->userdata('person_id'))
                      ->where('student_id IS NOT ','NULL',FALSE)
                      ->limit(1)
                      ->get('teacher_subjects')
                      ->num_rows()==0)
             {
                 //this teacher doesn't teach this student
                 return FALSE;
             }
         }
          
          
         $this->db->query('INSERT INTO attendance(lesson_id,student_id,status)
                           VALUES(?,?,?)
                           ON DUPLICATE KEY UPDATE status=?',array($lesson_id,$student_id,$new_status,$new_status));
      }
      
      function set_comments()
      {
          $comment=($this->input->post('comment'))?$this->input->post('comment'):NULL;
          $private_comment=($this->input->post('private_comment'))?$this->input->post('private_comment'):NULL;
          
          if ((is_null($comment)) AND (is_null($private_comment)))
          {
              $this->db->query('DELETE FROM `attendance` WHERE `lesson_id` = ? AND `student_id` =  ? AND (`status`=1  OR `status` IS  NULL)',array($this->input->post('lesson_id'),$this->input->post('student_id')));
              return TRUE;
          }
          
          $added_by=(isset($this->session->userdata['admin_id']))?0:$this->session->userdata('person_id');
          
          $this->db->query('INSERT INTO attendance(lesson_id,student_id,comment,private_comment,added,added_by)
                            VALUES(?,?,?,?,now(),?)
                            ON DUPLICATE KEY UPDATE comment=?,private_comment=?,added=now(),added_by=?',array($this->input->post('lesson_id'),$this->input->post('student_id'),$comment,$private_comment,$added_by,
                            $comment,$private_comment,$added_by));
      }
      
      function init_attendance_statuses($statuses)
      {
         $this->db->query('DROP TEMPORARY TABLE IF EXISTS attendance_statuses');
         $this->db->query('CREATE TEMPORARY TABLE IF NOT EXISTS attendance_statuses(status_id int,name varchar(300))');
         
         foreach($statuses as $id=>$name)
         {
             $this->db->insert('attendance_statuses',array('status_id'=>$id,'name'=>$name));
         } 
      }
      
      function get_student_attendance($student_id=0,$month='')
      {
         $statuses=$this->get_attendance_statuses();
         $this->init_attendance_statuses($statuses);
         $this->db->where('student_id',$student_id);
         
         if ($month!='')
         {
              $this->db->where('DATE_FORMAT(date,"%c-%Y")',"'".preg_replace('/[^0-9-]+/si','',$month)."'",FALSE);
         }
         
         return json_encode($this->db
                                 ->select('scheduling_id as id,start_time,DATE_FORMAT(date,"%m-%d-%Y") as `date`,end_time,CONCAT(IFNULL(attendance_statuses.name,"'.$statuses[1].'")," '.$this->lang->line('during').' ",subjects.name,IF (attendance.comment IS NULL,"",CONCAT("{|} '.$this->lang->line('comment_is').': ",attendance.comment,""))) as title',FALSE)
                                 ->join('scheduling','scheduling.scheduling_id = attendance.lesson_id','LEFT')
                                 ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                                 ->join('attendance_statuses','attendance_statuses.status_id = attendance.status','LEFT')                                 
                                 ->where('scheduling_id IS NOT NULL',NULL,FALSE)
                                 ->order_by('date,start_time','ASC')
                                 ->get('attendance')
                                 ->result_array());								 
      }

      function get_attendance_statuses()
      {
          $this->load->language('attendance');
          return array(
            1=>$this->lang->line('attendance_1'),
            2=>$this->lang->line('attendance_2'),
            3=>$this->lang->line('attendance_3'),
            4=>$this->lang->line('attendance_4'),
            5=>$this->lang->line('attendance_5')
          );
      }
      
      function is_student_presented($lesson_id)
      {
          return $this->db
                      ->select('lesson_id')
                      ->where(array('lesson_id'=>$lesson_id,'student_id'=>$this->session->userdata('person_id')))
                      ->where_in('status',array(2,3))
                      ->get('attendance')
                      ->num_rows()==0?TRUE:FALSE;
      }
      
      function get_attendance_comments($lesson_id,$student_id)
      {
          return $this->db
                      ->select('comment,private_comment')
                      ->where(array('lesson_id'=>$lesson_id,'student_id'=>$student_id))
                      ->get('attendance')
                      ->row_array();
      }
  }
?>