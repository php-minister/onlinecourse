<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property fee_actions          $fee_actions
    * @property settings_actions          $settings_actions
    * @property payment_actions          $payment_actions
    */
    
    class Payments extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('user_actions');
            if ((!$this->user_actions->is_loged_in('parent',FALSE)) AND (!$this->user_actions->is_loged_in('student',FALSE)))
            {
                if ($this->session->userdata('person_type')=='donor')
                {
                    //Fix 2checkpout return link
                    if (($this->input->post('x_receipt_link_url')) AND (strpos($this->input->post('x_receipt_link_url'),$this->config->item('base_url'))===0))
                    {
                        header('Location: '.$this->input->post('x_receipt_link_url').
                            '?key='.$this->input->post('key').
                            '&total='.$this->input->post('total').
                            '&order_number='.$this->input->post('order_number').
                            '&merchant_order_id='.$this->input->post('merchant_order_id').
                            '&invoice_id='.$this->input->post('invoice_id')
                        );
                        exit();
                    }
                }
                else
                {
                    $this->user_actions->is_loged_in('student');
                }
            }
        }
        
        function index($payment_method='')
        {
            $this->load->model('payment_actions');
            if ($payment_method!='')
            {
                $this->payment_actions->checkout($payment_method);
            }
            
            $this->load->model('notification_actions');
            $this->load->model('settings_actions');
            
            $this->load->view('payments/index',array(
                'currency'=>$this->settings_actions->get_setting('current_currency'),
                'payments'=>$this->payment_actions->get_payments(),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
            ));
        }
        
        function pay($fee_id=0)
        {
           $this->load->model('fee_actions');
           $this->load->model('notification_actions');
           $this->load->model('settings_actions');
           
           $this->load->view('payments/pay',array(
            'fee'=>$this->fee_actions->get_fee_details($fee_id),
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages(),
            'currency'=>$this->settings_actions->get_setting('current_currency'),
            'fee_id'=>$fee_id,
            'active_payments'=>$this->settings_actions->get_setting('active_payments')
           ));
        }
        
        function process_payment()
        {
           $this->load->library('form_validation');
           $this->form_validation->set_rules(array(
                array('field'=>'fee_id','rules'=>'required','label'=>$this->lang->line('fee')),
                array('field'=>'payment_method','rules'=>'required','label'=>$this->lang->line('payment_method'))
           ));
           
           if ($this->form_validation->run()==FALSE)
           {
               exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
           }
            
           $this->load->model('payment_actions');
           $redirect_url=$this->payment_actions->prepare_transaction();
           if (!$redirect_url)
           {
               exit ($this->load->view('layout/error',array('message'=>$this->payment_actions->get_error()),TRUE));
           }
           
           $this->load->view('layout/success',array('message'=>$this->lang->line('redirecting_to_payment_system')));
           $this->load->view('layout/redirect',array('url'=>$redirect_url));
        }
        
        function subscriptions()
        {
          $this->load->model('payment_actions');
          $this->load->model('settings_actions');
          
          $this->load->view('payments/subscriptions',array(
            'subscriptions'=>$this->payment_actions->get_subscriptions(),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
        }
        
        function remove_subscription($subscription_id=0)
        {
            $this->load->model('payment_actions');
            if (!$this->payment_actions->remove_subscription($subscription_id))
            {
                exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
            }
            
            $this->load->view('payments/subscription_removed',array('subscription_id'=>$subscription_id));
        }
    }
?>