<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('login'),'forms'=>TRUE , 'page_name' => 'Login'))?>
<script>
$(document.body).on("keyup", "#user_password", function(e) {
  if(e.which == 13)
    $('.btn').trigger("click");
});
</script>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <section class="alert alert-info offset4 span4 login_user">                  
                 <div class="line_only"> </div> <div class="login_heading">  <h3><?= $this->lang->line('login')?></h3></div><div class="line_only"></div>
                  
                  <article>
                    <div id="save_result" class="errors_show_div">
                        <?php if (isset($message)){echo '<div class="alert alert-error">'.$message.'</div>';}?>
                    </div>
                    <form action="start/check_user" id="check_user_form" method="POST" style="margin-left:20px;">
                        <div class="control-group">
                            <input type="text" name="user_email" id="user_email" class="required email span12" placeholder="<?= $this->lang->line('your_email')?>">  
                        </div>
                        <div class="control-group">
                            <input type="password" name="user_password" id="user_password" class="required span12" placeholder="<?= $this->lang->line('your_password')?>">
                        </div>
                        <div class="center_align">
                        <button class="btn btn-info" <?php if(!$this->config->item('simple_login')){ ?>  onclick="submit_form('#check_user_form')" type="button" <?php } else { ?> type="submit" <?php }?> ><?= $this->lang->line('login')?></button>
                        </div>
                    </form><!--&nbsp;&nbsp;<a href="start/new_password">Forgot password?</a>-->
                  </article>
            </section>
<?php $this->load->view('layout/footer_web')?>