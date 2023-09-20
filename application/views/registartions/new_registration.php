<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('registration'),'forms'=>TRUE)) ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="clearfix"></div>
            <div class="span7 offset1">
                <h2><img src="images/logo.png" alt="School Board">&nbsp;&nbsp;<?= $school['name']?></h2>
                <?= $school['address']?>, <?= $school['city']?>, <?= $school['state']?>, <?= $school['zip'] ?><br/>
                <?= $school['phone']?>, <?= $school['email']?>
                <div id="save_result"></div>
                <form action="registration/save_form/" method="POST" id="registration_form">
                    <input type="hidden" name="form_id" value="<?= $form_id?>">
                    <div class="control-group">
                        <label for="student_name"><?= $this->lang->line('name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="student_name" id="student_name" class="required span6" maxlength="100">
                    </div>
                    <div class="control-group">
                        <label for="student_phone"><?= $this->lang->line('phone')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="student_phone" id="student_phone" class="required span6" maxlength="50">
                    </div>
                    <div class="control-group">
                        <label for="student_email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                        <input type="text" id="student_email" name="student_email" class="required span6 email" maxlength="60">
                    </div>
                    <div class="control-group">
                        <label for="student_comment"><?= $this->lang->line('comment')?></label>
                        <textarea class="span6" id="student_comment" name="student_comment"></textarea>
                    </div>
                </form>
                <button class="btn btn-info btn-large" onclick="submit_form('#registration_form')"><?= $this->lang->line('send')?></button>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>