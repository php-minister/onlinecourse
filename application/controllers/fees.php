<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions     $admin_actions
    * @property fee_actions     $fee_actions
    * @property settings_actions     $settings_actions
    * @property payment_actions     $payment_actions
    */
  class Fees extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
          $this->load->language('settings');
          $this->load->model('settings_actions');
          $this->load->model('fee_actions');
          
          $this->load->view('fees/index',array(
            'fees'=>$this->fee_actions->get_fees(),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
      
      function new_fee()
      {
          $this->load->view('fees/new_fee');
      }
      
      function save_fee()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'fee_id','rules'=>'required','label'=>$this->lang->line('fee_id')),
                array('field'=>'fee_name','rules'=>'required|max_length[150]','label'=>$this->lang->line('fee_name')),
                array('field'=>'amount','rules'=>'required|is_natural_no_zero','label'=>$this->lang->line('amount')),
                array('field'=>'fee_description','rules'=>'max_length[400]','label'=>$this->lang->line('fee_description')),
                array('field'=>'fee_type','rules'=>'required','label'=>$this->lang->line('payers'))
          ));
          
          if ($this->input->post('subscription_payment')=='on')
          {
              $this->form_validation->set_rules(array(
                    array('field'=>'time_period','rules'=>'required','label'=>$this->lang->line('time_period'))
              ));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if (!in_array($this->input->post('fee_type'),array('groups','students')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('wrong_payer_type')),TRUE));
          }
          
          
          if (!in_array($this->input->post('time_period'),array('1_M')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('wrong_time_period')),TRUE));
          }
          
          if ((!is_array(json_decode($this->input->post('groups_list'),TRUE))) AND (!is_array(json_decode($this->input->post('students_list'),TRUE))))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('one_payer')),TRUE));
          }
          
          $this->load->model('fee_actions');
          $this->load->view('fees/edit_fee_result',array(
            'result'=>$this->fee_actions->save_fee(),
            'amount'=>number_format($this->input->post('amount'))
          ));
      }
      
      function edit($fee_id=0)
      {
         $this->load->model('fee_actions');
         $this->load->view('fees/edit_fee',array(
                'fee'=>$this->fee_actions->get_fee($fee_id)
         ));
      }
      
      function delete($fee_id=0)
      {
          $this->load->model('fee_actions');
          $this->fee_actions->delete_fee($fee_id);
          echo $this->lang->line('deleted');
      }
      
      function payers($fee_id=0)
      {
         $this->load->model('fee_actions');
         $this->load->language('settings');
         $this->load->model('settings_actions');
         

         $this->load->view('fees/payers',array(
            'payments'=>$this->fee_actions->get_payments($fee_id),
            'currency'=>$this->settings_actions->get_setting('current_currency'),
            'fee'=>$this->fee_actions->get_fee($fee_id),
            'fee_id'=>$fee_id
         ));
      }      
	  
	  function pay_fees($fee_id =0 , $student_id=0)
	  {
		  $data['fee_id'] = $fee_id;
		  $data['student_id'] = $student_id;

         $this->load->model('fee_actions');
         $this->load->language('settings');
         $this->load->model('settings_actions');		  
		  
		  $this->load->view('fees/pay_fees' , array(
            'payments'=>$this->fee_actions->get_single_payment($fee_id , $student_id),
            'currency'=>$this->settings_actions->get_setting('current_currency'),
            'fee'=>$this->fee_actions->get_fee($fee_id),
            'fee_id'=>$fee_id,
			'student_id' => $student_id)
			);
	  }
      
      function mark_as_completed($fee_id=0,$student_id=0)
      {
          $this->load->model('payment_actions');
          $this->payment_actions->mark_as_completed($fee_id,$student_id);
          $this->load->view('layout/success',array('message'=>$this->lang->line('done')));
      }
      
	  function deduct_from_donor($fee_id =0, $student_id=0, $donor_amount = 0)
	  {
          $this->load->model('payment_actions');
          $this->payment_actions->deduct_from_donor($fee_id,$student_id , $donor_amount);
          $this->load->view('layout/success',array('message'=>$this->lang->line('done')));		  
	  }
	  
      function change_until($fee_id=0,$student_id=0)
      {
          $this->load->model('fee_actions');
          
          $this->load->view('fees/change_until',array(
            'fee_id'=>$fee_id,
            'student_id'=>$student_id,
            'payment_dates'=>$this->fee_actions->get_payment_dates($fee_id,$student_id)
          ));
      }
      
      function save_until()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'fee_id','rules'=>'required','label'=>'fee_id'),
                array('field'=>'student_id','rules'=>'required','label'=>'student_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('fee_actions');
          $this->fee_actions->change_until();
          $this->load->view('fees/until_changed',array(
                'student_id'=>$this->input->post('student_id'),
                'until'=>$this->input->post('until')
          ));
      }
      
      function delete_student($fee_id=0,$studen_id=0)
      {
          $this->load->model('fee_actions');
          $this->fee_actions->delete_student($fee_id,$studen_id);
          $this->load->view('layout/success',array('message'=>$this->lang->line('deleted')));
      }
      
      function find_payment()
      {
          $this->load->model('fee_actions');
          echo json_encode($this->fee_actions->get_fees_list());
      }
  }
?>