<?php
  class _2checkout
  {
      private $account_no = "";
      private $secret_word = "";
      private $api_user;
      private $api_password;
      
      private $currency='USD';
      public $result=array();
      public $checkout_result=array();
      private $is_demo=FALSE;
      private $url='';
      private $token='';
      private $error;     
      
      // codeigniter master object
      private $CI;
      
      function __construct($credentials=array())
      {
          $this->CI = & get_instance();
          
          if (isset($credentials['account_no']))
          {
              $this->account_no=$credentials['account_no'];
          }
          
          if (isset($credentials['secret_word']))
          {
              $this->secret_word=$credentials['secret_word'];
          }
          
          if (isset($credentials['api_user']))
          {
              $this->api_user=$credentials['api_user'];
          }
          
          if (isset($credentials['api_password']))
          {
              $this->api_password=$credentials['api_password'];
          }
          
          if (isset($credentials['currency']))
          {
              $this->currency=$credentials['currency'];
          }
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      function set_error($error)
      {
          $this->error=$error;
      }
      
      
      function create_subscription()
      {
          return TRUE;
      }
            
      function init_checkout($fee,$students,$payer,$is_subscription=FALSE)
      {
         $this->url='https://www.2checkout.com/checkout/purchase?sid='.$this->account_no.'&mode=2CO&li_0_type=product&li_0_price='.$fee['amount'].'&li_0_quantity=1&li_0_name='.urlencode(substr(($fee['fee_name'].($payer=='parent'?(' ('.$students['names'].')'):'')),0,128));
         
         if (strlen($fee['fee_description'])>0)
         {
             $this->url.=('&li_0_description='.substr($fee['fee_description'],0,256));
         }
         
         if ($is_subscription)
         {
             $this->url.='&li_0_recurrence=1 Month';
         }
         
         $this->url.=('&currency_code='.$this->currency);
         $this->url.=('&merchant_order_id='.$this->get_token());
         if ($payer=='donor')
         {
             $this->url.=('&x_receipt_link_url='.$this->CI->config->item('base_url').'donor/donate/2checkout');
         }
         else
         {
             $this->url.=('&x_receipt_link_url='.$this->CI->config->item('base_url').'payments/index/2checkout');    
         }
         
         
         return TRUE;
      }
      
      function get_url()
      {
          return $this->url.($this->is_demo?'&demo=Y':'');
      }
      
      function get_token()
      {
          if ($this->token=='')
          {
              $this->CI->load->helper('key_generator');
              $this->token=strtoupper(generate_key(35));
          }
          return $this->token;
      }
      
      function is_transaction_completed()
      {
          if (!$this->CI->input->get_post('merchant_order_id'))
          {
              return TRUE;
          }
          return $this->CI->db
                          ->select('transaction_code')
                          ->where(array('token'=>$this->CI->input->get_post('merchant_order_id')))
                          ->where('transaction_code IS NOT ',' NULL ',FALSE)
                          ->get('transactions')
                          ->num_rows()>0?TRUE:FALSE;
      }
      
      function complete_transaction()
      {
          if ((strtoupper(md5($this->secret_word.$this->account_no.$this->CI->input->get_post('order_number').$this->CI->input->get_post('total')))!=$this->CI->input->get_post('key')) AND ($this->is_demo==FALSE))
          {
              $this->set_error('0');
              //return FALSE;
          }
          
          $this->result=$this->get_data('https://www.2checkout.com/api/sales/detail_sale?invoice_id='.$this->CI->input->get_post('invoice_id'));
          
          if (!$this->result)
          {
             $this->set_error('1');
             //return FALSE; 
          }
          
          $this->result=json_decode($this->result,TRUE);
          
          if ((!isset($this->result['response_code']) OR ($this->result['response_code']!='OK')))
          {
             $this->set_error(isset($this->result['errors'][0]['message'])?(' 2 '.$this->result['errors'][0]['message']):'2');
             //return FALSE;
          }
          
          $this->token=$this->result['sale']['invoices'][0]['vendor_order_id'];
          
          return TRUE;
      }
      
      private  function get_data($url,$post=null)
      {
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_USERAGENT, "2Checkout PHP/0.1.0%s");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          curl_setopt($ch, CURLOPT_USERPWD, "{$this->api_user}:{$this->api_password}");
          curl_setopt($ch, CURLOPT_POST,TRUE);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
          $resp = curl_exec($ch);
          
          curl_close($ch);
          return $resp;
      }
      
      function get_transaction()
      {
          return array(
            'transaction_code'=>$this->result['sale']['sale_id'],
            'status'=>ucfirst($this->result['sale']['invoices'][0]['status']),
            'payer_id'=>$this->result['sale']['customer']['customer_id'],
            'title'=>$this->result['sale']['invoices'][0]['lineitems'][0]['product_name'],
            'quantity'=>(int)($this->result['sale']['invoices'][0]['customer_total']/$this->result['sale']['invoices'][0]['lineitems'][0]['product_price']),
            'sum'=>$this->result['sale']['invoices'][0]['customer_total']
        );
      }
      
      function validate_transaction()
      {
          return $this->input->post('md5_hash')==strtoupper(md5($this->input->post('sale_id').$this->account_no.$this->input->post('invoice_id').$this->secret_word));
      }
      
      function get_status()
      {
          return ucfirst($this->input->post('invoice_status'));
      }
    
      function get_transaction_code()
      {
          return $this->input->post('sale_id');
      }
      
      function get_profile_id()
      {
          return rand(0,1000);
      }
      
      function get_amount()
      {
          return $this->CI->input->post('total');
      }
      
      function get_subscription_name()
      {
          return $this->CI->input->post('li_0_name');
      }
      
      function get_ipn_event()
      {
          return 'change_status';
          switch($this->CI->input->post('txn_type'))
          {
              case('express_checkout'):{
                  return 'change_status';
              }
              case('recurring_payment'):{
                  return 'recurring_payment';
              }
          }
      }
  }
?>