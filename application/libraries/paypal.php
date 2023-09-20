<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/********************************************
PayPal Express Checkout Library for CodeIgniter
based on paypalfunctions.php by Paypal Integration Wizard
---------------------------------------------
by Khairil Iszuddin Ismail
https://github.com/kidino/paypal_ec

How to install and use
----------------------

- Store this file (Paypal_ec.php) into the application/library folder
- You may load the library from any controller function. I suggest that
you load it from the __construct() function
- Before calling the library, you may want to create an array that contains
your Paypal API credentials -- get that from Sandbox or your own Paypal account

$paypal_credentials = array(
'API_username' => 'paypal_api1.somedomain.com',
'API_signature' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabc.0123456789abcdefgihjklmn-e',
'API_password' => 'ABCDEFGHIJ123456',
'sandbox_status' => true
);

$this->load->library('paypal_ec', $paypal_credentials);

********************************************/
class Paypal {
	// set these using the constructor
	private $USE_PROXY = false;
	private $PROXY_HOST = '127.0.0.1';
	private $PROXY_PORT = '808';
	private $API_username = "<API_USERNAME>";
	private $API_password = "<API_PASSWORD>";
	private $API_signature = "<API_SIGNATURE>";
	private $sandbox_flag = false;
	
    //private $API_endpoint = "https://api-3t.paypal.com/nvp";
    //public  $paypal_url = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=";	
	
    private $API_endpoint = "https://api-3t.sandbox.paypal.com/nvp";
    public  $paypal_url = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=";
    private $currency='USD';
	public $result=array();
    public $checkout_result=array();
    
    private $version = "93";
	// codeigniter master object
	private $CI;
	
	/* --------------------------------------------------------------------
	* constructor
	* will set default values such as credentials and sandbox status
	* for the object
	* ---------------------------------------------------------------------
	*/
	function __construct($credentials = array()) {
		$this->CI = & get_instance();
		$this->CI->load->library('session');
		// to set proxy for curl - true or false
		if (isset($credentials['proxy'])) {
			$this->USE_PROXY = $credentials['proxy'];
		}
		// to set proxy for curl
		if (isset($credentials['proxy_host'])) {
			$this->PROXY_HOST = $credentials['proxy_host'];
		}
		// to set proxy for curl
		if (isset($credentials['proxy_port'])) {
			$this->PROXY_PORT = $credentials['proxy_port'];
		}
		if (isset($credentials['version'])) {
			$this->version = $credentials['version'];
		}
		if (isset($credentials['username'])) {
			$this->API_username = $credentials['username'];
		}
		if (isset($credentials['password'])) {
			$this->API_password = $credentials['password'];
		}
		if (isset($credentials['signature'])) {
			$this->API_signature = $credentials['signature'];
		}
        
		if (isset($credentials['sandbox_status'])) {
			$this->sandbox_flag = $credentials['sandbox_status'];
			if ($this->sandbox_flag === TRUE) {
				$this->API_endpoint = "https://api-3t.sandbox.paypal.com/nvp";
                $this->paypal_url = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=";
			}
		}
        
        if (isset($credentials['currency']))
        {
            $this->currency=$credentials['currency'];
        }
	}
	
	/* --------------------------------------------------------------------------------
	* Does the SetExpressCheckout to Paypal
	*
	* @ec_data - associative array for SetExpressCheckout
	*
	* - you can set the $ec_array and pass values which are
	*    'currency' => currency code - USD|AUD|BRL|GBP|CAD|CZK|DKK|EUR|HKD|HUF|ILS|JPY|MYR|MXN|NZD|NOK|PHP|PLN|SGD|SEK|CHF|TWD|THB
	*    'type' => 'Sale|Order|Authorization' -- normally we use Sale for instant payment
	*    'return_URL' => the URL to be redirected from Paypal, which will do
	*       DoExpressCheckout and GetExpressCheckout
	*    'cancel_URL' => the URL where the customer clicks cancel at Paypal
	*    'get_shipping' => true or false -- NOSHIPPING=0 when not set, where shipping is optional by customer
	*    'shipping_amount' => total shipping amount
	*    'tax_amount' => total tax amount
	*    'handling_amount' => total handling amount
	*    'products' => is a set of array where you can set multiple products
	*    example:
	*       $ec_data['products'] = array(
	*           array('name' => 'Soap', 'amount' => 0.40, 'desc' => 'clean', 'number' => 'A001', 'quantity' => 1),
	*           array('name' => 'Comb', 'amount' => 0.65, 'desc' => 'for hair', 'number' => 'B123', 'quantity' => 2),
	*           array('name' => 'Gel', 'amount' => 2.95, 'desc' => 'sticky', 'number' => 'C456', 'quantity' => 1)
	*       );
	*
	* @custom_data - if you want to set your own SetExpressCheckout data. Refer to Paypal API documentation
	* use $ec_data again to set the values again.
	* https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_SetExpressCheckout
	*/
	function set_ec($ec_data = array(), $custom_data = false) {
		$nvpstr = '';
		
		if (isset($ec_data['currency'])) {
			$nvpstr.= "&PAYMENTREQUEST_0_CURRENCYCODE=" . urlencode($ec_data['currency']);
		}
		if (isset($ec_data['desc'])) {
			$nvpstr.= "&PAYMENTREQUEST_n_DESC=" . urlencode($ec_data['desc']);
		}
		if (isset($ec_data['type'])) {
			$nvpstr.= "&PAYMENTREQUEST_0_PAYMENTACTION=" . urlencode($ec_data['type']);
		} else {
			$nvpstr.= "&PAYMENTREQUEST_0_PAYMENTACTION=Sale"; // defaults to Sale            
		}
		if (isset($ec_data['return_URL'])) {
			$nvpstr.= "&RETURNURL=" . urlencode($ec_data['return_URL']);
		}
		if (isset($ec_data['cancel_URL'])) {
			$nvpstr.= "&CANCELURL=" . urlencode($ec_data['cancel_URL']);
		}
		if (isset($ec_data['get_shipping'])) {
			$nvpstr.= ($ec_data['get_shipping'] === true) ? "&NOSHIPPING=2" : "&NOSHIPPING=1";
		} else {
			$nvpstr.= "&NOSHIPPING=0";
		}
		$shipping_amount = 0;
		if (isset($ec_data['shipping_amount'])) {
			$shipping_amount = (float)$ec_data['shipping_amount'];
			$nvpstr.= "&PAYMENTREQUEST_0_SHIPPINGAMT=" . urlencode(sprintf('%.2f', $shipping_amount));
		}
		$handling_amount = 0;
		if (isset($ec_data['handling_amount'])) {
			$handling_amount = (float)$ec_data['handling_amount'];
			$nvpstr.= "&PAYMENTREQUEST_0_HANDLINGAMT=" . urlencode(sprintf('%.2f', $handling_amount));
		}
		$tax_amount = 0;
		if (isset($ec_data['tax_amount'])) {
			$tax_amount = (float)$ec_data['tax_amount'];
			$nvpstr.= "&PAYMENTREQUEST_0_TAXAMT=" . urlencode(sprintf('%.2f', $tax_amount));
		}
		// setting the parameters for your products
		$total_amount = 0;
		foreach($ec_data['products'] as $k => $v) {
			if (isset($v['name'])) {
				$nvpstr.= "&L_PAYMENTREQUEST_0_NAME$k=" . urlencode($v['name']);
			}
			if (isset($v['desc'])) {
				$nvpstr.= "&L_PAYMENTREQUEST_0_DESC$k=" . urlencode($v['desc']);
			}
			if (isset($v['number'])) {
				$nvpstr.= "&L_PAYMENTREQUEST_0_NUMBER$k=" . urlencode($v['number']);
			}
			if (isset($v['quantity'])) {
				$nvpstr.= "&L_PAYMENTREQUEST_0_QTY$k=" . urlencode($v['quantity']);
			}
			if (isset($v['amount'])) {
				$nvpstr.= "&L_PAYMENTREQUEST_0_AMT$k=" . urlencode($v['amount']);
				if (isset($v['quantity'])) {
					$total_amount+= (float)($v['amount'] * (int)$v['quantity']);
				} else {
					$total_amount+= (float)$v['amount'];
				}
			} else {
				$nvpstr.= "&L_PAYMENTREQUEST_0_AMT$k=" . urlencode('0.00');
				$total_amount+= 0;
			}
		}
		$nvpstr.= "&PAYMENTREQUEST_0_ITEMAMT=" . urlencode(sprintf('%.2f', $total_amount));
		$nvpstr.= "&PAYMENTREQUEST_0_AMT=" . urlencode(sprintf('%.2f', $total_amount + $shipping_amount + $tax_amount + $handling_amount));
	
        if (is_array($custom_data)) {	
			// this is if you set your own SetExpressCheckout parameters
			// -- if you use this, you have to set everything yourself in the $ec_data array
			foreach($custom_data as $k => $v) {
				$nvpstr.= "&$k=" . urlencode($v);
			}
		}
		$resArray = $this->hash_call("SetExpressCheckout", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$resArray['status'] = true;
		} else {
			$resArray['status'] = false;
		}
		return $resArray;
	}
		
	/* ----------------------------------------------------------------------------------------------
	* Does the GetExpressCheckoutDetails
	* - which is called after redirected from Paypal back to return_URL to get transactiond details
	*
	* @token - the token derived from $_GET['TOKEN'] passed by Paypal when redirecting back to return_URL
	* -----------------------------------------------------------------------------------------------
	*/
	function get_ec($token) {
		$nvpstr = "&TOKEN=" . $token;
		$resArray = $this->hash_call("GetExpressCheckoutDetails", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$resArray['status'] = true;
		} else {
			$resArray['status'] = false;
		}
		return $resArray;
	}
    
    function get_transaction_details($transaction_id)
    {
        $nvpstr = "&TransactionID=".$transaction_id;
        $resArray = $this->hash_call("GetTransactionDetails", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $resArray['status'] = true;
        } else {
            $resArray['status'] = false;
        }
        
        $this->result=$resArray;
        
        return $resArray['status'];
    }
    
	/* -------------------------------------------------------------------------------
	* Does the DoExpressCheckoutPayment
	* - which is called after redirected from Paypal back to return_URL
	* - most of the data can be obtained from GetExpressCheckoutDetails
	* - make sure that you use the same "type" as you did during SetExpressCheckout
	*
	* @ec_details - associative array that contains the data for DoExpressCheckoutPayment
	* --------------------------------------------------------------------------------
	*/
	function do_ec(
		$ec_details = array(
			'token' => '', 
			'payer_id' => '', 
			'currency' => '', 
			'amount' => '', 
			'IPN_URL' => '', 
			'type' => 'Sale')
	) {
		$nvpstr = '';
		if (isset($ec_details['token'])) {
			$nvpstr.= '&TOKEN=' . urlencode($ec_details['token']);
		}
		if (isset($ec_details['payer_id'])) {
			$nvpstr.= '&PAYERID=' . urlencode($ec_details['payer_id']);
		}
		if (isset($ec_details['type'])) {
			$nvpstr.= '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($ec_details['type']);
		}
		if (isset($ec_details['amount'])) {
			$nvpstr.= '&PAYMENTREQUEST_0_AMT=' . urlencode($ec_details['amount']);
		}
		if (isset($ec_details['currency'])) {
			$nvpstr.= '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($ec_details['currency']);
		}
		if (isset($ec_details['IPN_URL'])) {
			$nvpstr.= '&NOTIFYURL=' . urlencode($ec_details['IPN_URL']);
		}
		$nvpstr.= '&IPADDRESS=' . urlencode($_SERVER['SERVER_NAME']);
		$resArray = $this->hash_call("DoExpressCheckoutPayment", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$resArray['status'] = true;
		} else {
			$resArray['status'] = false;
		}
		return $resArray;
	}
	
    
	/**	--------------------------------------------------------------------------
	 * hash_call: Function to perform the API call to PayPal using API signature
	 * @methodName is name of API  method.
	 * @nvpStr is nvp string.
	 * returns an associtive array containing the response from the server.
	 * --------------------------------------------------------------------------
	 */
	function hash_call($methodName, $nvpStr) {
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->API_endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
		//Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php
		if ($this->USE_PROXY) curl_setopt($ch, CURLOPT_PROXY, $this->PROXY_HOST . ':' . $this->PROXY_PORT);
		//NVPRequest for submitting to server
		$nvpreq = "METHOD=" . urlencode($methodName);
		$nvpreq.= "&VERSION=" . urlencode($this->version);
		$nvpreq.= "&PWD=" . urlencode($this->API_password);
		$nvpreq.= "&USER=" . urlencode($this->API_username);
		$nvpreq.= "&SIGNATURE=" . urlencode($this->API_signature) . $nvpStr;
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		//getting response from server
		$response = curl_exec($ch);
        
		//convrting NVPResponse to an Associative Array
		$nvpResArray = $this->_deformatNVP($response);
		$nvpReqArray = $this->_deformatNVP($nvpreq);
		//$this->CI->session->set_userdata(array('nvpReqArray' => $nvpReqArray));
		if (curl_errno($ch)) {
			// moving to display page to display curl errors
			//$this->CI->session->set_userdata(array('curl_error_no' => curl_errno($ch)));
			//$this->CI->session->set_userdata(array('curl_error_msg' => curl_error($ch)));
			//Execute the Error handling module to display errors.
		}
		//closing the curl
		curl_close($ch);
		return $nvpResArray;
	}
	
	/*--------------------------------------------------------------------------------
	* Purpose: Redirects to PayPal.com site.
	* Inputs:  NVP string.
	* Returns:
	* -------------------------------------------------------------------------------
	*/
	function redirect_to_paypal($token, $mobile = false) {
		$payPalURL = ($mobile === true) ? str_replace("_express-checkout", "_express-checkout-mobile", $this->paypal_url) : $this->paypal_url;
		// Redirect to paypal.com here
		$payPalURL = $this->paypal_url . $token;
		header("Location: " . $payPalURL);
		exit;
	}
	
	/* ----------------------------------------------------------------------------------
	* This function will take NVPString and convert it to an Associative Array and it will decode the response.
	* It is usefull to search for a particular key and displaying arrays.
	* @nvpstr is NVPString.
	* @nvpArray is Associative Array.
	* ----------------------------------------------------------------------------------
	*/
	function _deformatNVP($nvpstr) {
		$intial = 0;
		$nvpArray = array();
		while (strlen($nvpstr)) {
			//postion of Key
			$keypos = strpos($nvpstr, '=');
			//position of value
			$valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&') : strlen($nvpstr);
			/*getting the Key and Value values and storing in a Associative Array */
			$keyval = substr($nvpstr, $intial, $keypos);
			$valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
			//decoding the respose
			$nvpArray[urldecode($keyval) ] = urldecode($valval);
			$nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
		}
		return $nvpArray;
	}
    
    
    function create_subscription()
    {
        $transaction=$this->get_transaction();
        
        $nvpstr='&TOKEN='.$this->get_token();
        $nvpstr.='&PROFILESTARTDATE='.date('Y-m-d\T00:00:00\Z',mktime(0,0,0,date('m')+1,date('d'),date('Y')));
        $nvpstr.='&DESC='.$transaction['title'];
        $nvpstr.='&BILLINGPERIOD=Month';
        $nvpstr.='&BILLINGFREQUENCY=1';
        $nvpstr.='&AMT='.$transaction['sum'];
        $nvpstr.='&CURRENCYCODE='.$this->currency;
        $nvpstr.='&MAXFAILEDPAYMENTS=5';
        
        $resArray = $this->hash_call("CreateRecurringPaymentsProfile", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            $resArray['status'] = true;
        } else {
            $resArray['status'] = false;
        }
        
        $this->result=$resArray;
        
        return $this->result['status'];
    }
    
    function init_checkout($fee,$students,$payer,$is_subscription=FALSE)
    {
        $cancel_url=($payer=='donor')?'donor/donate':('payments/pay/'.$fee['fee_id']);
        $return_url=($payer=='donor')?'donor/donate/':'payments/index/';
        
        $payment = array(
            'currency' =>$this->currency,
            'type' => 'Sale', 
            'return_URL' =>$this->CI->config->item('base_url').$return_url.'paypal', 
            'cancel_URL' =>$this->CI->config->item('base_url').$cancel_url,
            'products' =>array(
                array(
                    'name' => $fee['fee_name'].($payer=='parent'?(' ('.$students['names'].')'):''), 
                    'desc' => $fee['fee_description'],
                    'quantity' =>1,
                    'amount' => $fee['amount'])
                )
          );
          
          $additional_data=FALSE;
          if ($is_subscription)
          {
              $additional_data=array(
                'L_BILLINGTYPE0'=>'RecurringPayments',
                'L_BILLINGAGREEMENTDESCRIPTION0'=>$fee['fee_name'].($payer=='parent'?(' ('.$students['names'].')'):'')
            );
          }
                
          $this->result=$this->set_ec($payment,$additional_data);
          
          return (isset($this->result['status']) AND ($this->result['status'] === TRUE));
    }
    
    function get_url()
    {
        return $this->paypal_url.$this->result['TOKEN'];
    }
    
    function get_error()
    {
        return $this->result['L_ERRORCODE0'].', '.$this->result['L_SHORTMESSAGE0'];
    }
    
    function is_transaction_completed()
    {
        return $this->CI->db
                        ->select('transaction_code')
                        ->where(array('token'=>$this->CI->input->get('token')))
                        ->where('transaction_code IS NOT ',' NULL ',FALSE)
                        ->get('transactions')
                        ->num_rows()>0?TRUE:FALSE;
    }
    
    function complete_transaction()
    {
        $this->result=$this->get_ec($this->CI->input->get('token'));
        
        if(!isset($this->result['status']) OR ($this->result['status'] == FALSE))
        {
            return FALSE;
        }
        
        $this->checkout_result=$this->result;
            
        $this->result = $this->do_ec(array(
                                     'token' => $this->CI->input->get('token'), 
                                     'payer_id' =>$this->CI->input->get('PayerID'), 
                                     'currency' => $this->currency, 
                                     'amount' => $this->checkout_result['PAYMENTREQUEST_0_AMT'], 
                                     'IPN_URL' => $this->CI->config->item('base_url').'ipn/paypal', 
                                     'type' =>'Sale')
        );
        
        return (isset($this->result['status']) AND ($this->result['status'] === TRUE));
    }
    
    function  get_transaction()
    {
        return array(
            'transaction_code'=>$this->result['PAYMENTINFO_0_TRANSACTIONID'],
            'status'=>$this->result['PAYMENTINFO_0_PAYMENTSTATUS'],
            'payer_id'=>$this->checkout_result['PAYERID'],
            'title'=>$this->checkout_result['L_NAME0'],
            'quantity'=>$this->checkout_result['L_QTY0'],
            'sum'=>$this->checkout_result['AMT']
        );
    }
    
    private  function get_data($url,$post=null)
    {
      $curl=curl_init();
      curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($curl,CURLOPT_URL,$url);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1); 
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      if (!is_null($post))
      {
          curl_setopt($curl, CURLOPT_POST,1);
          curl_setopt($curl, CURLOPT_POSTFIELDS,$post);    
      }
      
      return curl_exec($curl);
    }
     
    function validate_transaction()
    {
        $post_string = '';    
        foreach ($_POST as $field=>$value){
            $post_string.=$field.'='.urlencode(stripslashes($value)).'&';
        }
        $post_string.="cmd=_notify-validate";
          
        $data=$this->get_data('https://www.paypal.com/cgi-bin/webscr',$post_string);
        return preg_match('/VERIFIED/si',$data);
    }
    
    function get_token()
    {
        return $this->result['TOKEN'];
    }
    
    function get_status()
    {
        return $this->CI->input->post('payment_status');
    }
    
    function get_transaction_status()
    {
        return $this->result['PAYMENTSTATUS'];
    }
    
    function get_transaction_code()
    {
        return $this->CI->input->post('txn_id');
    }
    
    function get_profile_id()
    {
        return $this->result['PROFILEID'];
    }
    
    function get_amount()
    {
        return $this->checkout_result['AMT'];
    }
    
    function get_subscription_name()
    {
        return $this->checkout_result['L_NAME0'];
    }
    
    function cancel_subscription($profile_id)
    {
        $nvpstr='&PROFILEID='.$profile_id;
        $nvpstr.='&ACTION=Cancel';
        
        $this->hash_call("ManageRecurringPaymentsProfileStatus", $nvpstr);
    }
    
    function get_ipn_event()
    {
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
    
    function get_source_id()
    {
        return $this->CI->input->post('recurring_payment_id');
    }
    
    function get_payer_id()
    {
        return $this->result['PAYERID'];
    }
}
	