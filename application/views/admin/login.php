<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('login'),'forms'=>TRUE)) ?>
<script>
$(document.body).on("keyup", "#password", function(e) {
  if(e.which == 13)
    $('.btn').trigger("click");
});
</script>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <section class="alert alert-info offset4 span4">
                <header>
                    <img src="images/logo_text.png" title="School Board" alt="School Board">
                    <h3><?= $this->lang->line('login')?></h3>
                </header>
                <article>
                    <div id="save_result">
                        <?php if (isset($message)){echo '<div class="alert alert-error">'.$message.'</div>';}?>
                    </div>
                    <form action="admin_login/check_admin" id="login_form" method="POST">
                        <div class="control-group">
                            <label for="admin_name"><?= $this->lang->line('login')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="admin_name" id="admin_name" class="required span12">
                        </div>
                        <div class="control-group">
                            <label for="password"><?= $this->lang->line('password')?><sup class="mandatory">*</sup></label>
                            <input type="password" id="password" name="password" class="required span12">
                        </div>
                        <button 
                        <?php if (!$this->config->item('simple_login')){?> 
                        onclick="submit_form('#login_form')"  type="button"
                        <?php }else{?> 
                        type="submit"
                        <?php }?>
                        class="btn btn-info"><?= $this->lang->line('login')?></button>
                    </form>
                </article>
            </section>
<?php $this->load->view('layout/footer') ?>