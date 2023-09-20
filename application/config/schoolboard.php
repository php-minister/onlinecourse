<?php
    //Import
  $config['import_fields']['students']=$config['import_fields']['parents']=$config['import_fields']['teachers']=array('given_name','middle_initial','sur_name','birth_date','gender','ssn','address','city','state','zip_code','home_phone','cell_phone','email');
  
  array_push($config['import_fields']['students'],'grade');
  
  $config['import_fields']['limits']=array('given_name'=>300,'middle_initial'=>300,'sur_name'=>300,'birth_date'=>300,'gender'=>100,'ssn'=>20,'address'=>300,'city'=>100,'state'=>30,'zip_code'=>10,'home_phone'=>20,'cell_phone'=>20,'email'=>60,'grade'=>3);  
  
  
  
  
  $config['simple_login']=FALSE;
  
  
  //Permissions
  $config['permissions_template']=array(
        'admin'=>TRUE,
        'import'=>TRUE,
        'messages_center'=>TRUE,
        'fees'=>TRUE,
        'registrations'=>TRUE,
        'settings'=>TRUE,
        'students'=>TRUE,
        'teachers'=>TRUE,
        'users'=>TRUE
  );
  
  //Payments
  
  $config['payment_methods']=array(
        'paypal'=>array(
            'fields'=>array('username','password','signature'),
            'currencies'=>array('AUD','BRL','CAD','CZK','DKK','EUR','HKD','HUF','ILS','JPY','MYR','MXN','NOK','NZD','PHP','PLN','GBP','SGD','SEK','CHF','TWD','THB','TRY','USD')
        ),
        '2checkout'=>array(
            'fields'=>array('account_no','secret_word','api_user','api_password'),
            'currencies'=>array('ARS','AUD','BRL','GBP','CAD','DKK','EUR','HKD','INR','ILS','JPY','LTL','MYR','MXN','NZD','NOK','PHP','RON','RUB','SGD','ZAR','SEK','CHF','TRY','AED','USD')
        )
  );
  
  //allowed files to upload into library
  $config['allowed_files']=array('doc','docx','xls','xlsx','gif','jpeg','jpg','pdf','txt','png','ppt','pptx','mp3','mp4','avi','wmv','mpg','dat','flv','rtf','rar','wav','zip','csv');
  
  $config['max_file_size']='10M';
?>