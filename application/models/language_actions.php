<?php
  class Language_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_current_language($languge_file='')
      {
          $result=$this->db
                       ->select('setting_value')  
                       ->where('setting_key','current_language')
                       ->get('settings')
                       ->row_array();
          
          if (!file_exists(BASEPATH.'../'.APPPATH.'/language/'.$result['setting_value'].'/'.$languge_file.'_lang.php'))
          {
              return FALSE;
          }
          
          $this->config->set_item('language',$result['setting_value']);
          
          return TRUE;
      }
  }
?>