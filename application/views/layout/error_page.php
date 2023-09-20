<?php  $this->load->view('layout/header',array('page_title'=>$this->lang->line('Error'))) ?>
<div class="container">
    <div class="row-fluid">
        <div class="span12">
            <div class="clearfix"></div>
            <div class="alert alert-error"><?= $message?></div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>