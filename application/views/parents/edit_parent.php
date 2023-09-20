<script>
    $('document').ready(function(){
        $("#birth_date").datepicker();
        init_avatar_actions();
        
        children=$('#children')
            .magicSuggest(magic_suggest_options({data:'students/find_student',name:'children_list'}))
            .addToSelection(<?= json_encode($parent['children'])?>);
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_parent')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="parents/save_parent" method="POST" id="person_form">
            <input type="hidden" id="parent_id" name="parent_id" value="<?= $parent['parent_id']?>">
            <input type="hidden" id="delete_photo" name="delete_photo" value="0">
            <div class="pull-left margin_right_10" style="background-image: url('<?= $parent['avatar']?>');" id="user_avatar_image">
                <div id="person_photo_area">
                    <div id="avatar_upload_area" class="<?= ($parent['avatar']!=DEFAULT_PHOTO)?'hide':''?> pull-left">
                        <input type="file" id="user_avatar" name="user_avatar">
                        <button type="button" class="btn btn-mini"><i class="icon-pencil"></i>  <?= $this->lang->line('upload_photo')?></button>
                    </div>
                    <button type="button" class="btn btn-mini <?= ($parent['avatar']==DEFAULT_PHOTO)?'hide':''?> pull-left" title="<?= $this->lang->line('remove_photo')?>" id="remove_photo"><i class="icon-remove"></i></button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="pull-left">
                <div class="pull-right">
                    <?= $this->lang->line('status')?>:&nbsp;
                    <div class="btn-group">
                        <button class="btn btn-small dropdown-toggle btn-success" data-toggle="dropdown"><span id="status_text"><?= $this->lang->line($parent['status'])?></span><span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <?php if ($parent['status']=='Inactive'){?>
                            <li><a href="#" onclick="change_status(<?= $parent['parent_id']?>,'parents','active');return false;"><?= $this->lang->line('Active')?></a></li>
                            <li><a href="#" onclick="resend_invitation(<?= $parent['parent_id']?>,'parents');return false;"><?= $this->lang->line('resend_invitation')?></a></li>
                            <?php }?>
                            <?php if ($parent['status']=='Deleted'){?>
                            <li><a href="#" onclick="restore_person(<?= $parent['parent_id']?>,'parents');return false;"><?= $this->lang->line('restore_person')?></a></li>
                            <?php }?>
                            <?php if ($parent['status']=='Active'){?>
                            <li><a href="#" onclick="change_status(<?= $parent['parent_id']?>,'parents' , 'inactive');return false;"><?= $this->lang->line('Inactive')?></a></li>
                            <?php }?>                            
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="pull-left control-group margin_right_10">
                    <label for="parent_name"><?= $this->lang->line('parent_name')?><sup class="mandatory">*</sup></label>
                    <input type="text" name="parent_name" id="parent_name" maxlength="150" class="required" value="<?= $parent['name'] ?>">
                </div>
                <div class="pull-left control-group">
                    <label><?= $this->lang->line('gender')?></label>
                    <select id="gender" name="gender" class="input-medium">
                        <option value="male" <?= ($parent['gender']==='male'?'selected="selected"':'')?>><?= $this->lang->line('male')?></option>
                        <option value="female" <?= ($parent['gender']===''?'selected="selected"':'')?> ><?= $this->lang->line('female')?></option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <div  class="pull-left control-group">
                    <label for="birth_date"><?= $this->lang->line('birth_date')?></label>
                    <input type="text" name="birth_date" id="birth_date" maxlength="10"  data-date-viewmode="years" value="<?= $parent['birth_date']?date('m/d/Y',strtotime($parent['birth_date'])):''?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="address"><?= $this->lang->line('address')?></label>
                <input type="text" name="address" id="address" maxlength="300" value="<?= $parent['address']?>">
            </div>
            <div class="pull-left control-group">
                <label for="city"><?= $this->lang->line('city')?></label>
                <input type="text" name="city" id="city" maxlength="100" value="<?= $parent['city']?>">
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="state"><?= $this->lang->line('state')?></label>
                <input type="text" name="state" id="state" maxlength="30" class="input-small" value="<?= $parent['state']?>">
            </div>
            <div class="pull-left control-group margin_right_10">
                <label for="zip_code"><?= $this->lang->line('zip')?></label>
                <input type="text" name="zip_code" id="zip_code"  maxlength="10" class="input-small" value="<?= $parent['zip_code'] ?>">
            </div>
            <div class="pull-left control-group">
                <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                <input type="text" name="email" id="email" maxlength="60" class="required email" value="<?= $parent['email']?>">
            </div>
            <div class="clearfix"></div>
            <div class="control-group">
                <label for="children"><?= $this->lang->line('children')?></label>
                <input type="text" name="children" id="children">
            </div>
            <div class="clearfix"></div>
            <div  class="pull-left control-group margin_right_10">
                <label for="home_phone"><?= $this->lang->line('home_phone')?></label>
                <input type="text" name="home_phone" id="home_phone" maxlength="20" value="<?= $parent['home_phone']?>">
            </div>
            <div class="pull-left control-group">
                <label for="cell_phone"><?= $this->lang->line('cell_phone')?></label>
                <input type="text" name="cell_phone" id="cell_phone" maxlength="20" value="<?= $parent['cell_phone']?>">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_person('parent')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>