<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property content_actions       $content_actions
    */
    
  class Content extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'students');
      }
      
      function library()
      {
          $this->load->model('content_actions');
          include BASEPATH.'../'.APPPATH.'/views/content/item_templates.php';
          $this->load->view('content/library',array(
            'library'=>$this->content_actions->get_library(),
            'template'=>$template
          ));
      }
      
      function delete_library_item($item_id=0)
      {
          $this->load->model('content_actions');
          $this->content_actions->delete_library_item($item_id);
          echo $this->lang->line('deleted');
      }
      
      function new_library_item()
      {
          $this->load->config('schoolboard');
          
          $this->load->view('content/new_library_item',array(
            'allowed_files'=>$this->config->item('allowed_files'),
            'max_file_size'=>$this->config->item('max_file_size')
          ));
      }
      
      function save_library_item()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'item_id','rules'=>'requried','label'=>'Item id'),
                array('field'=>'description','rules'=>'max_length[400]','label'=>$this->lang->line('description'))
          ));
          
          if ($this->input->post('item_id')=='0')
          {
              $this->form_validation->set_rules(array('field'=>'file_name','rules'=>'required','label'=>$this->lang->line('file')));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit(json_encode(array('error_message'=>$this->form_validation->error_string())));
          }
          
          if (!in_array($this->input->post('access_type'),array('groups','students')))
          {
              exit(json_encode(array('error_message'=>$this->lang->line('wrong_type'))));
          }
          
          if (($this->input->post('is_public')!='on') AND  (!is_array(json_decode($this->input->post('groups_list'),TRUE))) AND (!is_array(json_decode($this->input->post('students_list'),TRUE))))
          {
              exit(json_encode(array('error_message'=>$this->lang->line('one_type'))));
          }
          
          $this->load->model('content_actions');
          $result=$this->content_actions->upload_library_item();
          if (!$result)
          {
              exit(json_encode(array('error_message'=>$this->content_actions->get_error())));
          }
          
          echo json_encode($result);
      }
      
      function edit_library_item($item_id=0)
      {
         $this->load->model('content_actions');
         $this->load->config('schoolboard');
          
         $this->load->view('content/edit_library_item',array(
            'item'=>$this->content_actions->get_library_item($item_id),
            'allowed_files'=>$this->config->item('allowed_files'),
            'max_file_size'=>$this->config->item('max_file_size')
         )); 
      }
  }
?>