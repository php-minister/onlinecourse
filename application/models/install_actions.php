<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */

  class Install_actions extends CI_Model
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
      
      function is_installed()
      {
          return ((defined('INSTALLED')) AND (INSTALLED===TRUE));
      }
      
      private function check_database()
      {
          @mysql_connect($this->input->post('database_host'),$this->input->post('database_user'),$this->input->post('database_password'));
          
          if (mysql_errno()!=0)
          {
              $this->set_error(mysql_error());
              return FALSE;
          }
          
          @mysql_select_db($this->input->post('database_name'));
          
          if (mysql_errno()!=0)
          {
              $this->set_error(mysql_error());
              return FALSE;
          }
          
          return TRUE;
      }
      
      function install()
      {
          if (!$this->check_database())
          {
              return FALSE;
          }
          
          $sql=file_get_contents(BASEPATH.'../sql_data/database.sql');
          $sql=explode(';',$sql);
          foreach($sql as $query)
          {
              if ($query=='')
              {
                  continue;
              }
              @mysql_query($query);
              if (mysql_errno()!=0)
              {
                  $this->set_error(mysql_error());
                  return FALSE;
              }
          }
          
          mysql_query('INSERT INTO school_info(name) VALUES("'.mysql_real_escape_string($this->input->post('school_name')).'")');
          
          $this->load->helper('key_generator_helper');
          $salt=generate_key();
                   
          mysql_query('INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_login`, `admin_password`, `admin_salt`) VALUES (1, "Admin", "admin", "'.hash('sha512',$salt.$this->input->post('admin_password')).'", "'.$salt.'")');
          
          
          $config_folder=BASEPATH.'../'.APPPATH.'config/';
          
          $config_file=preg_replace(
                         "/'x\+b'\);/si",
                         "'x+b');\r\n\r\ndefine('PHOTOS_LOCATION',BASEPATH.'../avatars/');\r\ndefine('DEFAULT_PHOTO','images/no_avatar.jpg');\r\ndefine('INSTALLED',TRUE);",
                         file_get_contents($config_folder.'constants.php')
          );
          
          file_put_contents($config_folder.'constants.php',$config_file);
          
          $base_url=$this->input->post('base_url');
          if ($base_url[strlen($base_url)-1]!='/')
          {
              $base_url.='/';
          }
          
          $config_file=preg_replace(
                       array(
                            "/config\['base_url'\].*?';/si",
                            "/config\['encryption_key'\].*?';/si"
                       ),
                       array(
                           'config[\'base_url\']    = \''.$base_url.'\';',
                           'config[\'encryption_key\']    = \''.generate_key(40).'\';' 
                       ),
                       file_get_contents($config_folder.'config.php')
          );
          
          file_put_contents($config_folder.'config.php',$config_file);
          
          $config_file=preg_replace(
                       "/autoload\['libraries'\] = array\(\);/si",
                       'autoload[\'libraries\'] = array(\'database\',\'session\');',
                       file_get_contents($config_folder.'autoload.php')
          );
          
          file_put_contents($config_folder.'autoload.php',$config_file);
          
          
          $config_file=preg_replace(
                       array(
                            "/\['hostname'\] = '';/si",
                            "/\['username'\] = '';/si",
                            "/\['password'\] = '';/si",
                            "/\['database'\] = '';/si"
                       ),
                       array(
                            '[\'hostname\'] = \''.$this->input->post('database_host').'\';',
                            '[\'username\'] = \''.$this->input->post('database_user').'\';',
                            '[\'password\'] = \''.$this->input->post('database_password').'\';',
                            '[\'database\'] = \''.$this->input->post('database_name').'\';'
                       ),
                       file_get_contents($config_folder.'database.php')
          );
          
          file_put_contents($config_folder.'database.php',$config_file);
          
          return TRUE;
      }
  }
?>