<script>
    var students;
    $('document').ready(function(){
        $("#birth_date").datepicker();
        init_avatar_actions();
        
        students=$('#students')
                .magicSuggest(magic_suggest_options({data:'students/find_student',name:'students_list'}))
                .addToSelection(<?= json_encode($donor['students'])?>);
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_donor')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="donors/save_donor" method="POST" id="person_form">
            <input type="hidden" id="donor_id" name="donor_id" value="<?= $donor['donor_id']?>">
            <input type="hidden" id="delete_photo" name="delete_photo" value="0">
            <div class="pull-left margin_right_10" style="background-image: url('<?= $donor['avatar']?>');" id="user_avatar_image">
                <div id="person_photo_area">
                    <div id="avatar_upload_area" class="<?= ($donor['avatar']!=DEFAULT_PHOTO)?'hide':''?> pull-left">
                        <input type="file" id="user_avatar" name="user_avatar">
                        <button type="button" class="btn btn-mini"><i class="icon-pencil"></i>  <?= $this->lang->line('upload_photo')?></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="pull-left">
                <div class="pull-right">
                    <?= $this->lang->line('status')?>:&nbsp;
                    <div class="btn-group">
                        <button class="btn btn-small dropdown-toggle btn-success" data-toggle="dropdown"><span id="status_text"><?= $this->lang->line($donor['status'])?></span><span class="caret"></span></button>
                       <?php /*?> <ul class="dropdown-menu pull-right">
                            <?php if ($donor['status']=='Inactive'){?>
                            <li><a href="#" onclick="change_status(<?= $donor['donor_id']?>,'donors' , 'active');return false;"><?= $this->lang->line('Active')?></a></li>
                            <li><a href="#" onclick="resend_invitation(<?= $donor['donor_id']?>,'donors');return false;"><?= $this->lang->line('resend_invitation')?></a></li>
                            <?php }?>
                            <?php if ($donor['status']=='Deleted'){?>
                            <li><a href="#" onclick="restore_person(<?= $donor['donor_id']?>,'donors');return false;"><?= $this->lang->line('restore_person')?></a></li>
                            <?php }?>
                            <?php if ($donor['status']=='Active'){?>
                            <li><a href="#" onclick="change_status(<?= $donor['donor_id']?>,'donors' , 'inactive');return false;"><?= $this->lang->line('Inactive')?></a></li>
                            <?php } ?>                            
                        </ul><?php */?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="pull-left control-group margin_right_10">
                    <label for="donor_name"><?= $this->lang->line('donor_name')?><sup class="mandatory">*</sup></label>
                    <input type="text" name="donor_name" id="donor_name" maxlength="150" class="required" value="<?= $donor['name'] ?>" disabled="disabled" >
                </div>
                <div class="pull-left control-group">
                    <label><?= $this->lang->line('gender')?></label>
                    <select id="gender" name="gender" class="input-medium" disabled>
                        <option value="male" <?= ($donor['gender']==='male'?'selected="selected"':'')?>><?= $this->lang->line('male')?></option>
                        <option value="female" <?= ($donor['gender']===''?'selected="selected"':'')?> ><?= $this->lang->line('female')?></option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <div  class="pull-left control-group">
                    <label for="birth_date"><?= $this->lang->line('birth_date')?></label>
                    <input type="text" name="birth_date" id="birth_date" maxlength="10" disabled data-date-viewmode="years" value="<?= $donor['birth_date']?date('m/d/Y',strtotime($donor['birth_date'])):''?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="address"><?= $this->lang->line('address')?></label>
                <input type="text" name="address" id="address" maxlength="300" value="<?= $donor['address']?>" disabled>
            </div>
            <div class="pull-left control-group">
                <label for="city"><?= $this->lang->line('city')?></label>
                <input type="text" name="city" id="city" maxlength="100" value="<?= $donor['city']?>" disabled>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="state"><?= $this->lang->line('state')?></label>
                <input type="text" name="state" id="state" maxlength="30" class="input-small" value="<?= $donor['state']?>" disabled>
            </div>
            <div class="pull-left control-group margin_right_10">
                <label for="zip_code"><?= $this->lang->line('zip')?></label>
                <input type="text" name="zip_code" id="zip_code"  maxlength="10" class="input-small" value="<?= $donor['zip_code'] ?>" disabled>
            </div>
            <div class="pull-left control-group">
                <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                <input type="text" name="email" id="email" maxlength="60" class="required email" value="<?= $donor['email']?>" disabled>
            </div>
            <div class="clearfix"></div>
            <div class="control-group">
                <label for="students"><?= $this->lang->line('students')?></label>
                <input type="text" name="students" id="students" disabled>
            </div>
            <div class="clearfix"></div>
            <div  class="pull-left control-group margin_right_10">
                <label for="home_phone"><?= $this->lang->line('home_phone')?></label>
                <input type="text" name="home_phone" id="home_phone" maxlength="20" value="<?= $donor['home_phone']?>" disabled>
            </div>
            <div class="pull-left control-group">
                <label for="cell_phone"><?= $this->lang->line('cell_phone')?></label>
                <input type="text" name="cell_phone" id="cell_phone" maxlength="20" value="<?= $donor['cell_phone']?>" disabled>
            </div>
        </form>
    </div>
</div>