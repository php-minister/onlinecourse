<script>
    $('document').ready(function(){
        $("#birth_date").datepicker();
		 $("#ssn").datepicker();
        init_avatar_actions();
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_teacher')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="teachers/save_teacher" method="POST" id="person_form">
            <input type="hidden" id="teacher_id" name="teacher_id" value="<?= $teacher['teacher_id']?>">
            <input type="hidden" id="delete_photo" name="delete_photo" value="0">
            <div class="pull-left margin_right_10" style="background-image: url('<?= $teacher['avatar']?>');" id="user_avatar_image">
                <div id="person_photo_area">
                    <div id="avatar_upload_area" class="<?= ($teacher['avatar']!=DEFAULT_PHOTO)?'hide':''?> pull-left">
                        <input type="file" id="user_avatar" name="user_avatar">
                        <button type="button" class="btn btn-mini"><i class="icon-pencil"></i>  <?= $this->lang->line('upload_photo')?></button>
                    </div>
                    <button type="button" class="btn btn-mini <?= ($teacher['avatar']==DEFAULT_PHOTO)?'hide':''?> pull-left" title="<?= $this->lang->line('remove_photo')?>" id="remove_photo"><i class="icon-remove"></i></button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="pull-left">
                <div class="pull-right">
                    <?= $this->lang->line('status')?>:&nbsp;
                    <div class="btn-group">
                        <button class="btn btn-small dropdown-toggle btn-success" data-toggle="dropdown"><span id="status_text"><?= $this->lang->line($teacher['status'])?></span><span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
<?php /*?>                            <?php if (($teacher['status']=='Inactive')  OR ($teacher['status']=='Active')){?>
                            <li><a href="#" onclick="change_status(<?= $teacher['teacher_id']?>,'teachers','resigned');return false;"><?= $this->lang->line('status_resign')?></a></li>   
                            <?php }?>
                            <?php if ($teacher['status']=='Inactive'){?>
                            <li><a href="#" onclick="resend_invitation(<?= $teacher['teacher_id']?>,'teachers');return false;"><?= $this->lang->line('resend_invitation')?></a></li>
                            <?php }?>
                            <?php if (($teacher['status']=='Deleted') OR ($teacher['status']=='Resigned')){?>
                            <li><a href="#" onclick="restore_person(<?= $teacher['teacher_id']?>,'teachers');return false;"><?= $this->lang->line('restore_person')?></a></li>
                            <?php }?><?php */?>
                             <?php if (($teacher['status']=='Inactive')){?>
                            <li><a href="#" onclick="change_status(<?= $teacher['teacher_id']?>,'teachers','active');return false;"><?= $this->lang->line('Active')?></a></li>   
                            <?php }?>
                             <?php if ($teacher['status']=='Active'){?>
                            <li><a href="#" onclick="change_status(<?= $teacher['teacher_id']?>,'teachers','inactive');return false;"><?= $this->lang->line('Inactive')?></a></li>   
                            <?php }?><strong></strong>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="pull-left control-group margin_right_10">
                    <label for="teacher_name"><?= $this->lang->line('teacher_name')?><sup class="mandatory">*</sup></label>
                    <input type="text" name="teacher_name" id="teacher_name" maxlength="150" class="required" value="<?= $teacher['name'] ?>">
                </div>
                <div class="pull-left control-group">
                    <label><?= $this->lang->line('gender')?></label>
                    <select id="gender" name="gender" class="input-medium">
                        <option value="male" <?= ($teacher['gender']==='male'?'selected="selected"':'')?>><?= $this->lang->line('male')?></option>
                        <option value="female" <?= ($teacher['gender']===''?'selected="selected"':'')?> ><?= $this->lang->line('female')?></option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="pull-left control-group margin_right_10">
                    <label for="ssn"><?= $this->lang->line('join_date')?></label>
                    <input type="text" name="ssn" id="ssn" maxlength="20" class="input-medium" value="<?= $teacher['ssn']?date('m/d/Y',strtotime($teacher['ssn'])):''?>">
                </div>
                <div  class="pull-left control-group">
                    <label for="birth_date"><?= $this->lang->line('birth_date')?></label>
                    <input type="text" name="birth_date" id="birth_date" maxlength="10" class="input-medium" data-date-viewmode="years" value="<?= $teacher['birth_date']?date('m/d/Y',strtotime($teacher['birth_date'])):''?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="address"><?= $this->lang->line('address')?></label>
                <input type="text" name="address" id="address" maxlength="300" value="<?= $teacher['address']?>">
            </div>
            <div class="pull-left control-group">
                <label for="city"><?= $this->lang->line('city')?></label>
                <input type="text" name="city" id="city" maxlength="100" value="<?= $teacher['city']?>">
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="state"><?= $this->lang->line('state')?></label>
                <input type="text" name="state" id="state" maxlength="30" class="input-small" value="<?= $teacher['state']?>">
            </div>
            <div class="pull-left control-group margin_right_10">
                <label for="zip_code"><?= $this->lang->line('zip')?></label>
                <input type="text" name="zip_code" id="zip_code"  maxlength="10" class="input-small" value="<?= $teacher['zip_code'] ?>">
            </div>
            <div class="pull-left control-group">
                <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                <input type="text" name="email" id="email" maxlength="60" class="required email" value="<?= $teacher['email']?>">
            </div>
            <div class="clearfix"></div>
            <div  class="pull-left control-group margin_right_10">
                <label for="home_phone"><?= $this->lang->line('home_phone')?></label>
                <input type="text" name="home_phone" id="home_phone" maxlength="20" value="<?= $teacher['home_phone']?>">
            </div>
            <div class="pull-left control-group">
                <label for="cell_phone"><?= $this->lang->line('cell_phone')?></label>
                <input type="text" name="cell_phone" id="cell_phone" maxlength="20" value="<?= $teacher['cell_phone']?>">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_person('teacher')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>