<?php  $this->load->view('layout/header',array('page_title'=>'Admin','forms'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>FALSE)) ?>
<link rel="stylesheet" type="text/css" href="css/fontello.css"> 
<a class="btn btn-large" href="teachers"><i class="fontello-users"></i>Teachers</a>
<?php $this->load->view('layout/footer') ?>