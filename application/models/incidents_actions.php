<?php
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    */
  class Incidents_actions extends School_model
  {
      protected $search_colums=array('incidents.incident_id','date','students.name','details','incidents.status');
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_incidents()
      {
          $this->prepare_filters('incidents');
          
          $this->db
               ->select('SQL_CALC_FOUND_ROWS incidents.incident_id,DATE_FORMAT(`date`,"%d %M %Y") as `date`,LEFT(details,30) as detail, GROUP_CONCAT(CONCAT(students.name," (",IFNULL(grades.name,"-"),")") ,"</small></i>") as details,incidents.status',FALSE)
               ->join('incidents_persons','incidents_persons.incident_id = incidents.incident_id AND person_type="student"','LEFT')
               ->join('students','students.student_id = incidents_persons.person_id','LEFT')
               ->join('grades','grades.grade_id = students.grade','LEFT')
               ->from('incidents')
               ->group_by('incidents.incident_id');
          
          $data=$this->db
                     ->query(preg_replace('/AND(  `incidents`.`incident_id`.*?)GROUP/si','AND ($1) GROUP ',$this->db->_compile_select()))
                     ->result_array();
         
          
          
          $result['rows']=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
          $result['rows']=$result['rows']['rows'];
          
          $result['data']=array();
          
          foreach($data as $item)
          {
              $item['actions']=sprintf($this->lang->line('incident_actions_edit'),$item['incident_id']);
			   $item['actions'].=sprintf($this->lang->line('incidents_view'),$item['incident_id']);
              
              if (preg_match('/active/i',$item['status']))
              {
                  $item['actions'].=sprintf($this->lang->line('incident_actions_delete'),$item['incident_id']);			
              }
          
		      $result['data'][]=$item;
          }
          
          $result['count']=$this->db->query('SELECT COUNT(incident_id) as `count` FROM incidents')->row_array();
          $result['count']=$result['count']['count'];          
          
          return $result;
      }
      
      function save_incident()
      {
          $data=array(
                'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
                'details'=>$this->input->post('details'),
                'response'=>$this->input->post('response'),
                'autor_id'=>(!isset($this->session->userdata['admin_id']))?$this->session->userdata('person_id'):0
          );
          
          if ($this->input->post('incident_id')=='0')
          {
              $this->db->insert('incidents',$data);
              $incident_id=$result=$this->db->insert_id();
          }
          else
          {
              $this->db->where('incident_id',$this->input->post('incident_id'));
              if ($data['autor_id']>0)
              {
                  $this->db->where('autor_id',$this->session->userdata('person_id'));
              }
              
              $this->db->update('incidents',$data);
              $incident_id=$this->input->post('incident_id');
              $result=TRUE;
          }
          
          $this->assign_persons($incident_id,json_decode($this->input->post('student_list'),TRUE),json_decode($this->input->post('teacher_list'),TRUE));
          
          return $result;
      }
      
      function assign_persons($incident_id,$student,$teacher)
      {
          $this->db->delete('incidents_persons',array('incident_id'=>$incident_id));
          $persons=array();
          if (is_array($student))
          {
              foreach($student as $student_id)
              {
                  $persons[]=array('incident_id'=>$incident_id,'person_id'=>$student_id,'person_type'=>'student');
              }    
          }
          
          if (is_array($teacher))
          {
              foreach($teacher as $teacher_id)
              {
                  $persons[]=array('incident_id'=>$incident_id,'person_id'=>$teacher_id,'person_type'=>'teacher');
              }    
          }
          
          
          $this->db->insert_batch('incidents_persons',$persons);
      }
      
      function get_incident($incident_id)
      {
          $this->db->where('incident_id',$incident_id);
          
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where(array('autor_id'=>$this->session->userdata('person_id'),'status'=>'Active'));
          }
          
          $incident=$this->db
                         ->select('*')
                         ->get('incidents')
                         ->row_array();
          
          if (count($incident)==0)
          {
              return FALSE;
          }
          
          $incident['student']=$this->db
                                    ->select('student_id as id,CONCAT(students.name,"<span class=\'person_details\'> (",IFNULL(grades.name,"-"),", ",ssn,")</span>") as name',FALSE)
                                    ->join('students','students.student_id = incidents_persons.person_id ')
                                    ->join('grades','grades.grade_id = students.grade','LEFT')
                                    ->where(array('incident_id'=>$incident_id,'person_type'=>'student'))
                                    ->get('incidents_persons')
                                    ->result_array();
          
          
          $incident['teacher']=$this->db
                                    ->select('teacher_id as id,CONCAT(name,"<span class=\'person_details\'> (",ssn,")</span>") as name',FALSE)
                                    ->join('teachers','teachers.teacher_id = incidents_persons.person_id ')
                                    ->where(array('incident_id'=>$incident_id,'person_type'=>'teacher'))
                                    ->get('incidents_persons')
                                    ->result_array();
          
          return $incident;
      }
      
      function get_breif_incident($incident_id)
      {
          $incident=$this->db
                         ->select('*')
                         ->where(array('incident_id'=>$incident_id,'status'=>'Active'))
                         ->get('incidents')
                         ->row_array();
          
          if (count($incident)==0)
          {
              return FALSE;
          } 
          
          $incident['teacher']=$this->db
                                    ->select('GROUP_CONCAT(incidents_persons.person_id) teacher_ids,GROUP_CONCAT(name) as teachers',FALSE)
                                    ->join('teachers','teachers.teacher_id = incidents_persons.person_id ')
                                    ->where(array('incident_id'=>$incident_id,'person_type'=>'teacher'))
                                    ->group_by('incident_id')
                                    ->get('incidents_persons')
                                    ->row_array();
          if (!in_array($this->session->userdata('person_id'),explode(',',$incident['teacher']['teacher_ids'])))
          {
              return FALSE;
          }
          
          $incident['teacher']=$incident['teacher']['teachers'];
          
          $incident['student']=$this->db
                                    ->select('GROUP_CONCAT(CONCAT(students.name," (",IFNULL(grades.name,"-"),")"))
                                     as students',FALSE)
                                    ->join('students','students.student_id = incidents_persons.person_id ')
                                    ->join('grades','grades.grade_id = students.grade','LEFT')
                                    ->where(array('incident_id'=>$incident_id,'person_type'=>'student'))
                                    ->group_by('incident_id')
                                    ->get('incidents_persons')
                                    ->row_array();
          
          return $incident;
      }
      
      function delete_incident($incident_id)
      {
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('autor_id',$this->session->userdata('person_id'));
          }
          $this->db->update('incidents',array('status'=>'Deleted'),array('incident_id'=>$incident_id));
      }
      
      function get_person_incidents($person_type,$person_id=0)
      {
         return $this->db
                     ->select('incidents.incident_id,`date`,LEFT(details,30) as details,incidents.`status`,autor_id,details as full_details,response',FALSE)
                     ->join('incidents','incidents.incident_id = incidents_persons.incident_id','LEFT')
                     ->where(array('person_id'=>($person_id==0)?$this->session->userdata('person_id'):$person_id,'person_type'=>$person_type,'status'=>'Active'))
                     ->get('incidents_persons')
                     ->result_array();
      }
  }
?>