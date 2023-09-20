<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('accept_invite'),'forms'=>TRUE))?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <section class="alert alert-info offset4 span4">
                <header>
                    <img src="images/logo_text.png" title="School Board" alt="School Board">
                    <h3><?= $this->lang->line('set_password')?></h3>
                </header>
                <article>
                    <div id="save_result"></div>
                    <form action="start/add_user" id="add_user" method="POST">
                        <input type="hidden" name="code" value="<?= $code?>">
                        <div class="control-group">
                            <label for="password"><?= $this->lang->line('password')?><sup class="mandatory">*</sup></label>
                            <input type="password" name="password" id="password" class="required input-xlarge">
                        </div>
                        <div class="control-group">
                            <label for="password_again"><?= $this->lang->line('password_again')?><sup class="mandatory">*</sup></label>
                            <input type="password" name="password_again" id="password_again" class="required input-xlarge" equalTo="#password">
                        </div>
                    </form>
                    <button class="btn btn-info" onclick="submit_form('#add_user')"><?= $this->lang->line('set_password')?></button>
                </article>
            </section>
<?php $this->load->view('layout/footer') ?>