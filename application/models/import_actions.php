<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property CI_Security           $security
    */  
  class Import_actions extends CI_Model
  {
      private $error;
      
      private $file_details;
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function import_file()
      {
          if (!isset($_FILES['import_file'])  OR ($_FILES['import_file']['error']!=0))
          {
              $this->set_error($this->lang->line('can_not_upload_file'));
              return FALSE;
          }
          
          $this->load->library('upload',array('upload_path'=>pathinfo($_FILES['import_file']['tmp_name'],PATHINFO_DIRNAME),'allowed_types'=>'csv','max_size'=>'2048','encrypt_name'=>TRUE));
          
          if (!$this->upload->do_upload('import_file'))
          {
              $this->set_error($this->upload->display_errors());
              return FALSE;
          }
          
          $this->session->set_userdata(array($this->input->post('data_type').'_file'=>$this->upload->upload_path.$this->upload->file_name));
          
          $file=fopen($this->upload->upload_path.$this->upload->file_name,'r');
          
          if ($file===FALSE)
          {
              $this->set_error($this->lang->line('can_not_open_imported_file'));
              return FALSE;
          }
          
          $result=array();
          
          for($line=0;$line<2;$line++)
          {
              $data = fgetcsv($file,2048,$this->input->post('csv_delimiter'),$this->input->post('csv_enclosure'),$this->input->post('csv_escape'));
              
              if ($data===FALSE)
              {
                  continue;
              }
              
              if (count($data)==1)
              {
                  $this->set_error($this->lang->line('can_not_split'));
                  return FALSE;
              }
              
             $result[]=$data;
          }
          
          $this->file_details=array_combine($result[0],$result[1]);
          $index=0;
          foreach($this->file_details as $name=>$example)
          {
              $this->file_details[$name]=array('example'=>$example,'index'=>$index++);
          }
          ksort($this->file_details);
          
          return TRUE;
      }
      
      function get_file_details()
      {
          return $this->file_details;
      }
      
      function process_file()
      {
          if (!file_exists($this->session->userdata($this->input->post('data_type').'_file')))
          {
              $this->set_error($this->lang->line('can_not_upload_file'));
              return FALSE;
          }
          
          $file=fopen($this->session->userdata($this->input->post('data_type').'_file'),'r');
          
          if ($file===FALSE)
          {
              $this->set_error($this->lang->line('can_not_upload_file'));
              return FALSE;
          }
          
          $clean_fields=array();
          
          $this->load->config('schoolboard');
          $person_fields=$this->config->item('import_fields');
          $limits=$person_fields['limits'];
          $person_fields=$person_fields[$this->input->post('data_type')];
          foreach($person_fields as $field)
          {
              if ((isset($_POST['field'][$field])) AND ($_POST['field'][$field]!='skip'))
              {
                  $clean_fields[$field]=(int)$_POST['field'][$field];
              }
          }
          
          if (count($clean_fields)==0)
          {
              $this->set_error($this->lang->line('nothing_to_import'));
              return FALSE;
          }
          
          if ($this->input->post('skip_first_line')=='on')
          {
              fgetcsv($file);
          }
          
          $to_insert=array();
          
          while (($data = fgetcsv($file,2048,$this->input->post('csv_delimiter'),$this->input->post('csv_enclosure'),$this->input->post('csv_escape'))) !== FALSE) 
          {
              $result=array();
              foreach($clean_fields as $field=>$id)
              {
                  $result[$field]=substr($this->security->xss_clean($data[$id]),0,$limits[$field]);
                  switch(TRUE)
                  {
                      case ($field=='birth_date'):
                      {
                          $result[$field]=strtotime($result[$field])?date('Y-m-d',strtotime($result[$field])):NULL;
                          break;
                      }
                      case (($field=='gender') AND (!in_array($field,array('male','female')))):
                      {
                          $result[$field]='male';
                          break;
                      }
                      case ($field=='grade'):
                      {
                          $result[$field]=(int)$result[$field];
                          break;
                      }
                  }
              }
              
              if (isset($result['given_name']))
              {
                  $result['name']=$result['given_name'];
                  unset($result['given_name']);
              }
              
              if (isset($result['middle_initial']))
              {
                  $result['name'].=' '.$result['middle_initial'];
                  unset($result['middle_initial']);
              }
              
              if (isset($result['sur_name']))
              {
                  $result['name'].=' '.$result['sur_name'];
                  unset($result['sur_name']);
              }
              
              $result['name']=substr($result['name'],0,150);
              
              if (count($to_insert)>30)
              {
                  $this->db->insert_batch($this->input->post('data_type'),$to_insert);
                  $to_insert=array();
              }
              $to_insert[]=$result;
          }
          
          $this->db->insert_batch($this->input->post('data_type'),$to_insert);
          $this->session->unset_userdata($this->input->post('data_type').'_file');
          
          return TRUE;
      }
  }
?>