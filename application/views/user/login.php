<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('login'),'forms'=>TRUE))?>
<script>
$(document.body).on("keyup", "#user_password", function(e) {
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
                    <form action="start/check_user" id="check_user_form" method="POST">
                        <div class="control-group">
                            <label for="user_email"><?= $this->lang->line('your_email')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="user_email" id="user_email" class="required email span12"> 
                        </div>
                        <div class="control-group">
                            <label for="user_password"><?= $this->lang->line('your_password')?><sup class="mandatory">*</sup></label>
                            <input type="password" name="user_password" id="user_password" class="required span12"> 
                        </div>
                        <button class="btn btn-info" 
                        <?php if (!$this->config->item('simple_login')){?> 
                        onclick="submit_form('#check_user_form')" type="button"
                        <?php }else{?>
                        type="submit"
                        <?php }?>
                        ><?= $this->lang->line('login')?></button>
                    </form><!--&nbsp;&nbsp;<a href="start/new_password">Forgot password?</a>-->
                  </article>
            </section>
<?php $this->load->view('layout/footer')?>