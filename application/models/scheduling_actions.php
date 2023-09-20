<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    */   
  class Scheduling_actions extends CI_Model
  {
      var $error;
      
      private $start_time;
      
      private $end_time;
      
      private $lesson_id;
      
      function __construct()
      {
          parent::__construct();
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      function get_free_classes()
      {
          return $this->db->query('SELECT classrooms.*
                                   FROM classrooms
                                   LEFT JOIN scheduling ON scheduling.`date`=? AND scheduling.room_id = classrooms.room_id AND end_time>? AND start_time<?
                                   WHERE (scheduling_id IS NULL OR is_shared=1 )AND is_deleted=0',array(date('Y-m-d',$this->start_time),date('H:i:00',$this->start_time),date('H:i:00',$this->end_time)))->result_array();
      }
      
      function check_lesson_times()
      {
          $this->start_time=strtotime($this->input->post('start_date').' '.$this->input->post('lesson_start'));
          $this->end_time=strtotime($this->input->post('start_date').' '.$this->input->post('lesson_end'));
          if ((!$this->start_time) OR (!$this->end_time) )
          {
              $this->set_error($this->lang->line('check_start_end_time'));
              return FALSE;
          }
          
          if ($this->start_time>$this->end_time)
          {
              $this->set_error($this->lang->line('start_time_must_be_bigger'));
              return FALSE;
          }
          
          if ($this->end_time<time())
          {
              $this->set_error($this->lang->line('end_time_lower'));
              return FALSE;
          }
          
          return TRUE;
      }
      
      private function check_is_avaliable()
      {
         $grade=explode('-',$this->input->post('grade')); 
          
         $is_avaliable=$this->db->query('SELECT classrooms.room_id,teacher_id,scheduling_id,student_group,grade
                                FROM scheduling
                                LEFT JOIN classrooms ON classrooms.room_id = scheduling.room_id
                                WHERE `date`=? AND (classrooms.room_id=? OR teacher_id=? OR grade=?) AND end_time>? AND start_time<? AND is_shared=0',array(date('Y-m-d',$this->start_time),$this->input->post('room'),$this->input->post('teacher_id'),$grade[0],date('H:i:00',$this->start_time),date('H:i:00',$this->end_time)))->row_array();
          
          if ((count($is_avaliable)==0) OR ($this->input->post('lesson_id')==$is_avaliable['scheduling_id']))
          {
              return TRUE;
          }
          
          if ($is_avaliable['room_id']==$this->input->post('room'))
          {
              $this->set_error($this->lang->line('room_is_busy'));
              return FALSE;
          }
          elseif($is_avaliable['teacher_id']==$this->input->post('teacher_id'))
          {
              $this->set_error($this->lang->line('teacher_is_busy'));
              return FALSE;
          }
          elseif(($is_avaliable['grade']==$grade[0]) AND ($is_avaliable['student_group']==$grade[1] OR $is_avaliable['student_group']==0))
          {
              $this->set_error($this->lang->line('grade_is_busy'));
              return FALSE;
          }
          
          return TRUE;
      }
      
      function add_lesson()
      {
          if ((!$this->check_lesson_times()) OR (!$this->check_is_avaliable()))
          {
              return FALSE;
          }
          
          $data=array(
                'start_time'=>date('H:i:00',$this->start_time),
                'end_time'=>date('H:i:00',$this->end_time),
                'date'=>date('Y-m-d',$this->start_time),
                'teacher_id'=>$this->input->post('teacher_id'),
                'subject_id'=>$this->input->post('subject'),
                'room_id'=>$this->input->post('room')
          );
          
          
          if ($this->input->post('is_private')=='true')
          {
              $data['grade']=$data['student_group']=0;
              $data['is_private']=implode(',',json_decode($this->input->post('chosen_students'),TRUE));
          }
          else
          {
              $grade=explode('-',$this->input->post('grade'));    
              $data['grade']=$grade[0];
              $data['student_group']=$grade[1];
              $data['is_private']=NULL;
          }
          
          if ($this->input->post('lesson_id')=='0')
          {
              $data['autor_id']=(isset($this->session->userdata['admin_id']))?0:$this->session->userdata('person_id');
              $this->db->insert('scheduling',$data);
              $this->lesson_id=$this->db->insert_id();
              return $this->lesson_id;
          }
          
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('autor_id',$this->session->userdata('person_id'));
          }
          
          $this->db->update('scheduling',$data,array('scheduling_id'=>$this->input->post('lesson_id')));
          $this->lesson_id=$this->input->post('lesson_id');
          return TRUE;
      }
      
      function get_teacher_scheduling($teacher_id)
      {
          (isset($this->session->userdata['admin_id']))?$this->db->select('1 as allow_edit',FALSE):$this->db->select('autor_id=teacher_id as allow_edit',FALSE);
          
          $this->db
                 ->select('scheduling_id as id,start_time,end_time,DATE_FORMAT(date,"%m-%d-%Y") as `date`,IFNULL(CONCAT(subjects.name,"{|}, ",IFNULL(grades.name,"-"),", ",IF(is_private IS NULL,IFNULL(group_name,"'.$this->lang->line('all_groups').'"),GROUP_CONCAT(students.name)),""),"") as title',FALSE)
                ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                ->join('grades','grades.grade_id = scheduling.grade','LEFT')
                ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                ->join('students_groups','students_groups.group_id = scheduling.student_group','LEFT')
                ->join('students','students.student_id=students.student_id AND is_private REGEXP CONCAT("(^",students.student_id,",|,",students.student_id,",|,",students.student_id,"$|^",students.student_id,"$)")','LEFT')
                ->group_by('scheduling_id')
                ->where('teacher_id',$teacher_id);
            
            return json_encode($this->db
                                    ->get('scheduling')
                                    ->result_array());
      }

      function get_teacher_schedule()
      {
          (isset($this->session->userdata['admin_id']))?$this->db->select('1 as allow_edit',FALSE):$this->db->select('autor_id=teacher_id as allow_edit',FALSE);
          
          $this->db
                 ->select('scheduling_id as id,start_time,end_time,DATE_FORMAT(date,"%m-%d-%Y") as `date`,IFNULL(CONCAT(subjects.name,"{|}, ",IFNULL(grades.name,"-"),", ",IF(is_private IS NULL,IFNULL(group_name,"'.$this->lang->line('all_groups').'"),GROUP_CONCAT(students.name))," '.$this->lang->line('in').' ",classrooms.name),"") as title',FALSE)
                ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                ->join('grades','grades.grade_id = scheduling.grade','LEFT')
                ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                ->join('students_groups','students_groups.group_id = scheduling.student_group','LEFT')
                ->join('students','students.student_id=students.student_id AND is_private REGEXP CONCAT("(^",students.student_id,",|,",students.student_id,",|,",students.student_id,"$|^",students.student_id,"$)")','LEFT')
                ->group_by('scheduling_id')
                ->where('teacher_id',$this->session->userdata('person_id'));
            
            return json_encode($this->db
                                    ->get('scheduling')
                                    ->result_array());
      }
      
      function get_added_event()
      {
          return json_encode($this->db
                      ->select('scheduling_id as id,start_time,DATE_FORMAT(date,"%m-%d-%Y") as `date`,end_time,IFNULL(CONCAT(subjects.name,"{|} ",IF(is_private IS NULL, IFNULL(group_name, "'.$this->lang->line('all_groups').'"), GROUP_CONCAT(students.name)), " '.$this->lang->line('in').' ", classrooms.name), "") as title',FALSE)
                      ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                      ->join('grades','grades.grade_id = scheduling.grade','LEFT')
                      ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                      ->join('students_groups','students_groups.group_id = scheduling.student_group AND students_groups.is_deleted=0','LEFT')
                      ->join('students','students.student_id=students.student_id AND is_private REGEXP CONCAT("(^",students.student_id,",|,",students.student_id,",|,",students.student_id,"$|^",students.student_id,"$)")','LEFT')
                      ->where('scheduling_id',$this->lesson_id)
                      ->get('scheduling')
                      ->row_array());
      }
      
      function get_lesson($lesson_id)
      {
          $this->db->where('scheduling_id',$lesson_id);
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('autor_id',$this->session->userdata('person_id'));
          }
          
          $result=$this->db
                       ->select('scheduling_id,start_time,end_time,`date`,subject_id,grade,student_group,scheduling.room_id,teachers.name,CONCAT(`date`," ",end_time)>now() as allow_to_edit,scheduling.teacher_id,classrooms.name as class_room,is_private',FALSE)
                       ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                       ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                       ->get('scheduling')
                       ->row_array();
          
          if (!is_null($result['is_private']))
          {
              $result['students']=$this->db
                                      ->select('student_id as id,CONCAT(students.name,"<span class=\'person_details\'> (",IFNULL(grades.name,"-"),", ",ssn,")</span>") as name',FALSE)
                                      ->join('grades','grades.grade_id = students.grade','LEFT')
                                      ->where_in('student_id',explode(',',$result['is_private']))
                                      ->where_in('status',array('Active','Inactive'))
                                      ->get('students')
                                      ->result_array();
          }
          
          return $result;
      }
      
      function get_lesson_details($lesson_id)
      {
          return $this->db
                      ->select('scheduling_id,start_time,end_time,date,subjects.name as subject_name,teachers.name as teacher_name')
                      ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                      ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                      ->where('scheduling_id',$lesson_id)
                      ->get('scheduling')
                      ->row_array();
      }
      
      function remove_lessson($lesson_id)
      {
          $this->db->where('scheduling_id',$lesson_id);
          
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('autor_id',$this->session->userdata('person_id'));
          }
          
          $this->db->where('CONCAT(`date`," ",end_time)>','now()',FALSE);
          $this->db->delete('scheduling');
          return ($this->db->affected_rows()>0)?TRUE:FALSE;
      }
      
      function get_student_scheduling($student_id=0,$month='')
      {
          $student_id=($student_id===0)?$this->session->userdata('person_id'):(int)$student_id;
          
          $this->db->_reserved_identifiers[]=$student_id;
          
          $this->db->where(array('students.student_id'=>$student_id));
          
          if ($month!='')
          {
              $this->db->where('DATE_FORMAT(date,"%c-%Y")',"'".preg_replace('/[^0-9-]+/si','',$month)."'",FALSE);
          }
          
          return json_encode($this->db
                                  ->select('scheduling_id as id,start_time,`students`.`name` , students.class_attend_url , DATE_FORMAT(date,"%m-%d-%Y") as `date`,end_time,CONCAT(subjects.name,"{|} by ",teachers.name," '.$this->lang->line('in').' ",IFNULL(classrooms.name,"-")) as title,IF(teachers_comments.lesson_id IS NULL,0,1) as is_commented',FALSE)  
                                  ->join('scheduling',' scheduling.grade = students.grade  AND  scheduling.student_group  IN(students.`group`,0) OR is_private REGEXP \'(^'.$student_id.',|,'.$student_id.',|,'.$student_id.'$|^'.$student_id.'$)\'','LEFT')
                                  ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                                  ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                                  ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                                  ->join('teachers_comments','teachers_comments.lesson_id = scheduling.scheduling_id AND teachers_comments.student_id='.$student_id,'LEFT')
                                  ->order_by('date')
                                  ->order_by('start_time')
                                  ->get('students')
                                  ->result_array());
      }
      
	  function get_schedule_details($student_id=0,$month='' , $schedule_id)
	  {
          $student_id=($student_id===0)?$this->session->userdata('person_id'):(int)$student_id;
          
          $this->db->_reserved_identifiers[]=$student_id;
          
          $this->db->where(array('students.student_id'=>$student_id));          
          if ($month!='')
          {
              $this->db->where('DATE_FORMAT(date,"%c-%Y")',"'".preg_replace('/[^0-9-]+/si','',$month)."'",FALSE);
          }          
          return json_encode($this->db
                                  ->select('scheduling_id as id,start_time,`students`.`name` , DATE_FORMAT(date,"%m-%d-%Y") as `date`,end_time,CONCAT(subjects.name,"{|} by ",teachers.name," '.$this->lang->line('in').' ",IFNULL(classrooms.name,"-")) as title,IF(teachers_comments.lesson_id IS NULL,0,1) as is_commented',FALSE)  
                                  ->join('scheduling',' scheduling.grade = students.grade  AND  scheduling.student_group  IN(students.`group`,0) OR is_private REGEXP \'(^'.$student_id.',|,'.$student_id.',|,'.$student_id.'$|^'.$student_id.'$)\'','LEFT')
                                  ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                                  ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                                  ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                                  ->join('teachers_comments','teachers_comments.lesson_id = scheduling.scheduling_id AND teachers_comments.student_id='.$student_id,'LEFT')
								  ->where('scheduling_id' , $schedule_id)
                                  ->order_by('date')
                                  ->order_by('start_time')
                                  ->get('students')
                                  ->result_array());		  
		  
	  }
	  
	  function get_children_schedule_details($student_id=0,$month='' , $schedule_id)
	  {
          $student_id=($student_id===0)?$this->session->userdata('person_id'):(int)$student_id;
          
          $this->db->_reserved_identifiers[]=$student_id;
          
          $this->db->where(array('students.student_id'=>$student_id));          
          if ($month!='')
          {
              $this->db->where('DATE_FORMAT(date,"%c-%Y")',"'".preg_replace('/[^0-9-]+/si','',$month)."'",FALSE);
          }          
          return json_encode($this->db
                                  ->select('scheduling_id as id,start_time,`students`.`name` , DATE_FORMAT(date,"%m-%d-%Y") as `date`,end_time,CONCAT(subjects.name,"{|} by ",teachers.name," '.$this->lang->line('in').' ",IFNULL(classrooms.name,"-")) as title,IF(teachers_comments.lesson_id IS NULL,0,1) as is_commented',FALSE)  
                                  ->join('scheduling',' scheduling.grade = students.grade  AND  scheduling.student_group  IN(students.`group`,0) OR is_private REGEXP \'(^'.$student_id.',|,'.$student_id.',|,'.$student_id.'$|^'.$student_id.'$)\'','LEFT')
                                  ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                                  ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                                  ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                                  ->join('teachers_comments','teachers_comments.lesson_id = scheduling.scheduling_id AND teachers_comments.student_id='.$student_id,'LEFT')
								  ->where('scheduling_id' , $schedule_id)
                                  ->order_by('date')
                                  ->order_by('start_time')
                                  ->get('students')
                                  ->result_array());		  
		  
	  }	  
	  
	  
      function get_group_scheduling($group_id)
      {
          return json_encode($this->db
                                  ->select('scheduling_id as id,start_time,end_time,DATE_FORMAT(date,"%m-%d-%Y") as `date`,CONCAT(subjects.name,"{|} by ",teachers.name," in ",IFNULL(classrooms.name,"-")) as title',FALSE)
                                  ->join('scheduling','scheduling.student_group = students_groups.group_id OR (scheduling.student_group = 0 AND scheduling.grade = students_groups.grade_id)','LEFT')
                                  ->join('classrooms','classrooms.room_id = scheduling.room_id','LEFT')
                                  ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                                  ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                                  ->where(array('student_group'=>$group_id))
                                  ->order_by('date')
                                  ->order_by('start_time')
                                  ->get('students_groups')
                                  ->result_array());
      }
      
      function get_classroom_scheduling($classroom_id)
      {
          return json_encode($this->db
                                  ->select('scheduling_id as id,start_time,end_time,DATE_FORMAT(date,"%m-%d-%Y") as `date`, CONCAT(subjects.name,"{|} by ",teachers.name," for ",IFNULL(grades.name,"-")," ( ",IFNULL(CONCAT(students_groups.group_name," group"),"all groups")," )") as title',FALSE)
                                  ->join('teachers','teachers.teacher_id = scheduling.teacher_id','LEFT')
                                  ->join('subjects','subjects.subject_id = scheduling.subject_id','LEFT')
                                  ->join('grades','grades.grade_id = scheduling.grade','LEFT')
                                  ->join('students_groups','students_groups.group_id = scheduling.student_group','LEFT')
                                  ->where(array('room_id'=>$classroom_id))
                                  ->order_by('date')
                                  ->order_by('start_time')
                                  ->get('scheduling')
                                  ->result_array());
      }
      
      function is_lesson_owner($teacher_id,$lesson_id)
      {
          return $this->db
                      ->select('scheduling_id')
                      ->where(array('scheduling_id'=>$lesson_id,'teacher_id'=>$teacher_id))
                      ->get('scheduling')
                      ->num_rows()==0?FALSE:TRUE;
      }
  }
?>