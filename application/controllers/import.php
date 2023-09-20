<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property import_actions       $import_actions
    */
  class Import extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
          $this->load->view('import/index');
      }
      
      private function validate_fields()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'data_type','rules'=>'required','label'=>$this->lang->line('data_type')),
                array('field'=>'csv_delimiter','rules'=>'required|max_length[1]','label'=>$this->lang->line('delimiter')),
                array('field'=>'csv_enclosure','rules'=>'required|max_length[1]','label'=>$this->lang->line('enclosure')),
                array('field'=>'csv_escape','rules'=>'required|max_length[1]','label'=>$this->lang->line('escape'))
          ));

          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if (!in_array($this->input->post('data_type'),array('students','parents','teachers')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('wrong_data_type')),TRUE));
          }
      }
      
      function import_file()
      {
          $this->validate_fields();
          
          $this->load->model('import_actions');
          if (!$this->import_actions->import_file())
          {
              exit($this->load->view('layout/error',array('message'=>$this->import_actions->get_error()),TRUE));
          }
          
          $this->load->config('schoolboard');
          $fields=$this->config->item('import_fields');
          
          $this->load->view('import/process_file',array(
                'file_details'=>$this->import_actions->get_file_details(),
                'fields'=>$fields[$this->input->post('data_type')],
                'data_type'=>$this->input->post('data_type'),
                'csv_delimiter'=>$this->input->post('csv_delimiter'),
                'csv_enclosure'=>$this->input->post('csv_enclosure'),
                'csv_escape'=>$this->input->post('csv_escape'),
                'skip_first_line'=>$this->input->post('skip_first_line')
          ));
      }
      
      
      function process_file()
      {
          $this->validate_fields();
          
          if (count($_POST['field'])==0)
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('nothing_to_upload')),TRUE));
          }
          
          $this->load->model('import_actions');
          if (!$this->import_actions->process_file())
          {
              exit($this->load->view('layout/error',array('message'=>$this->import_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('imported')));
      }
  }
?>