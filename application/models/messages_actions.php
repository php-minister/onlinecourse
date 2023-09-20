<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property email_actions           $email_actions
    */
  class Messages_actions extends CI_Model
  {
      private $error;
      
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
      
      function create_thread()
      {
          $thread=(isset($this->session->userdata['admin_id']))?array('thread_autor'=>0,'thread_person'=>'admin'):array('thread_autor'=>$this->session->userdata('person_id'),'thread_person'=>$this->session->userdata('person_type'));
          
          $thread['thread_subject']=$this->input->post('subject');
          $thread['last_message_by']=(isset($this->session->userdata['admin_id']))?$this->lang->line('admin'):$this->session->userdata('full_name');
          $thread['last_message_at']=date('Y-m-d H:i:s');
          $thread['last_message']=strlen($this->input->post('message'))>50?(substr($this->input->post('message'),0,50).'...'):$this->input->post('message');
          
          $this->db->insert('messages_thread',$thread);
          
          $thread_id=$this->db->insert_id();
          $this->db->insert('messages',array('thread_id'=>$thread_id,'message_body'=>nl2br($this->input->post('message')),'message_date'=>date('Y-m-d H:i:s'),'message_sender'=>$thread['thread_autor'],'sender_person'=>$thread['thread_person'],'is_last_message'=>1));
          $message_id=$this->db->insert_id();
          
          $this->db->insert('messages_interlocutors',array('thread_id'=>$thread_id,'person_id'=>$thread['thread_autor'],'person_type'=>$thread['thread_person'],'is_active'=>1));
          
          $trachers=json_decode($this->input->post('teachers_list'),TRUE);
          if ((is_array($trachers)) AND (count($trachers)>0))
          {
              $clean_persons=array();
              foreach($trachers as $person_id)
              {
                  $clean_persons[]=(int)$person_id;
              }
              $this->db->query('INSERT INTO messages_interlocutors(thread_id,person_id,person_type,new_messages)
                                SELECT ?,teacher_id,"teacher",1
                                FROM teachers
                                WHERE '.($this->input->post('to_all_teachers')=='on'?'':(' teacher_id IN ('.implode(',',$clean_persons).') AND ')).' status IN ("Active","Inactive") AND teacher_id<>?',array($thread_id,$thread['thread_autor']));
          }
          
          $students=json_decode($this->input->post('students_list'),TRUE);
          if ((is_array($students)) AND (count($students)>0))
          {
              $clean_persons=array();
              foreach($students as $person_id)
              {
                  $clean_persons[]=(int)$person_id;
              }
              $this->db->query('INSERT INTO messages_interlocutors(thread_id,person_id,person_type,new_messages)
                                SELECT ?,student_id,"student",1
                                FROM students
                                WHERE '.($this->input->post('to_all_students')=='on'?'':(' student_id IN ('.implode(',',array_values($students)).') AND ')).' status IN ("Active","Inactive") AND student_id<>?',array($thread_id,$thread['thread_autor']));
          }
          
          $parents=json_decode($this->input->post('parents_list'),TRUE);
          if ((is_array($parents)) AND (count($parents)>0))
          {
              $clean_persons=array();
              foreach($parents as $person_id)
              {
                  $clean_persons[]=(int)$person_id;
              }
              $this->db->query('INSERT INTO messages_interlocutors(thread_id,person_id,person_type,new_messages)
                                SELECT ?,parent_id,"parent",1
                                FROM parents
                                WHERE '.($this->input->post('to_all_parents')=='on'?'':(' parent_id IN ('.implode(',',array_values($parents)).') AND ')).' status IN ("Active","Inactive") AND parent_id<>?',array($thread_id,$thread['thread_autor']));
          }                 
          
          if ($this->input->post('to_admin')=='on')
          {
              $this->db->insert('messages_interlocutors',array('thread_id'=>$thread_id,'person_id'=>0,'person_type'=>'admin','new_messages'=>1));
          }
          
          $this->crete_message_event($thread_id,$message_id);
          
          return TRUE;                  
      }
      
      function get_messages()
      {
          isset($this->session->userdata['admin_id'])?$this->db->where(array('person_id'=>0,'person_type'=>'admin')):$this->db->where(array('person_id'=>$this->session->userdata('person_id'),'person_type'=>$this->session->userdata('person_type')));
          
          return $this->db
                      ->select('messages_thread.thread_id,thread_subject,IF (thread_autor=person_id AND thread_person=person_type,1,0) as is_owner,last_message_by,last_message_at,last_message,new_messages',FALSE)
                      ->join('messages_thread','messages_thread.thread_id = messages_interlocutors.thread_id','LEFT')
                      ->get('messages_interlocutors')
                      ->result_array();
      }
      
      function check_permissions($thread_id)
      {
          $this->db->where('thread_id',$thread_id);
          (isset($this->session->userdata['admin_id']))?$this->db->where(array('person_id'=>0,'person_type'=>'admin')):$this->db->where(array('person_id'=>$this->session->userdata('person_id'),'person_type'=>$this->session->userdata('person_type')));
          
          return $this->db
                      ->select('thread_id')
                      ->get('messages_interlocutors')
                      ->num_rows()==0?FALSE:TRUE;
      }
      
      function get_thread_messages($thread_id)
      {
          $result['messages']=$this->db
                                   ->select('SQL_CALC_FOUND_ROWS message_id,message_date,message_body,message_sender,sender_person',FALSE)
                                   ->where('thread_id',$thread_id)
                                   ->get('messages')
                                   ->result_array();
         return $result;
      }
      
      function get_thread($thread_id,$read_thread=FALSE)
      {
          if ($read_thread)
          {
              $this->db->update('messages_interlocutors',array('new_messages'=>0),array('thread_id'=>$thread_id,'person_id'=>$this->session->userdata('person_id'),'person_type'=>$this->session->userdata('person_type')));
          }
          
          $thread=$this->db
                       ->select('thread_id,thread_subject')
                       ->where('thread_id',$thread_id)
                       ->get('messages_thread')
                       ->row_array();
          
          $thread=array_merge($thread,$this->get_thread_messages($thread_id));
          
          $persons=$this->db
                        ->select('GROUP_CONCAT(person_id) as persons,person_type',FALSE)
                        ->where(array('thread_id'=>$thread_id,'is_active'=>1))
                        ->group_by('person_type')
                        ->get('messages_interlocutors')
                        ->result_array();
          
          $this->load->helper('result_array_index');
          foreach($persons as $person)
          {
              if ($person['person_type']=='admin')
              {
                  continue;
              }
              
              $thread[$person['person_type']]=result_array($this->db
                                                                ->select('name,avatar,'.$person['person_type'].'_id as id')
                                                                ->where_in($person['person_type'].'_id',explode(',',$person['persons']))
                                                                ->get($person['person_type'].'s'));
          }
          unset($persons);
          
          return $thread;
      }
      
      function add_message($thread_id)
      {
          $thread=(isset($this->session->userdata['admin_id']))?array('thread_autor'=>0,'thread_person'=>'admin'):array('thread_autor'=>$this->session->userdata('person_id'),'thread_person'=>$this->session->userdata('person_type'));
          
          $this->db->update('messages',array('is_last_message'=>0),array('thread_id'=>$thread_id,'is_last_message'=>1));
          
          $this->db->insert('messages',array(
            'thread_id'=>$thread_id,
            'message_body'=>nl2br($this->input->post('new_message')),
            'message_date'=>date('Y-m-d H:i:s'),
            'message_sender'=>$thread['thread_autor'],
            'sender_person'=>$thread['thread_person'],
            'is_last_message'=>1));
          
          $this->crete_message_event($thread_id,$this->db->insert_id());
          
          $this->db->query('UPDATE messages_interlocutors SET new_messages=new_messages+1 WHERE thread_id=?',array($thread_id));
          
          $this->db->update('messages_interlocutors',array('is_active'=>1,'new_messages'=>0),array(
            'thread_id'=>$thread_id,
            'person_id'=>$thread['thread_autor'],
            'person_type'=>$thread['thread_person'])
          );
          
          $this->db->update('messages_thread',array(
            'last_message_by'=>(isset($this->session->userdata['admin_id']))?$this->lang->line('admin'):$this->session->userdata('full_name'),
            'last_message'=>strlen($this->input->post('new_message'))>50?(substr($this->input->post('new_message'),0,50).'...'):$this->input->post('new_message'),
            'last_message_at'=>date('Y-m-d H:i:s')
          ),array('thread_id'=>$thread_id));
          
          
      }
      
      private function crete_message_event($thread_id,$message_id)
      {
          $this->db->query('INSERT INTO events(event_date,event_type,source_id,target_person,person_type)
                            SELECT now(),"message",?,person_id,person_type
                            FROM messages_interlocutors
                            LEFT JOIN messages ON messages.message_id=?
                            WHERE messages_interlocutors.thread_id=? AND new_messages>0 AND person_type!="admin"',array($message_id,$message_id,$thread_id));
      }
  }
?>