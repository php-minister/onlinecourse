<script>
    $('document').ready(function(){
        $("#birth_date").datepicker();
        init_avatar_actions();
        
        $('#students').magicSuggest(magic_suggest_options({data:'students/find_student',name:'students_list'}));
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_donor')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="donors/save_donor" method="POST" id="person_form">
            <input type="hidden" id="donor_id" name="donor_id" value="0">
            <input type="hidden" id="delete_photo" name="delete_photo" value="0">
            <div class="pull-left margin_right_10" style="background-image: url('<?= DEFAULT_PHOTO?>');" id="user_avatar_image">
                <div id="person_photo_area">
                    <div id="avatar_upload_area" class="pull-left">
                        <input type="file" id="user_avatar" name="user_avatar">
                        <button type="button" class="btn btn-mini"><i class="icon-pencil"></i>  <?= $this->lang->line('upload_photo')?></button>
                    </div>
                    <button type="button" class="btn btn-mini hide pull-left" title="<?= $this->lang->line('remove_photo')?>" id="remove_photo"><i class="icon-remove"></i></button>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="pull-left">
                <div class="pull-left control-group margin_right_10">
                        <label for="donor_name"><?= $this->lang->line('donor_name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="donor_name" id="donor_name" maxlength="150" class="required">
                </div>
                <div class="pull-left control-group">
                    <label><?= $this->lang->line('gender')?></label>
                    <select id="gender" name="gender" class="input-medium">
                        <option value="male"><?= $this->lang->line('male')?></option>
                        <option value="female"><?= $this->lang->line('female')?></option>
                    </select>
                </div>
                <div class="clearfix"></div>

                <div  class="pull-left control-group">
                    <label for="birth_date"><?= $this->lang->line('birth_date')?></label>
                    <input type="text" name="birth_date" id="birth_date" maxlength="10" data-date-viewmode="years">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="address"><?= $this->lang->line('address')?></label>
                <input type="text" name="address" id="address" maxlength="300">
            </div>
            <div class="pull-left control-group">
                <label for="city"><?= $this->lang->line('city')?></label>
                <input type="text" name="city" id="city" maxlength="100">
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="state"><?= $this->lang->line('state')?></label>
                <input type="text" name="state" id="state" maxlength="30" class="input-small">
            </div>
            <div class="pull-left control-group margin_right_10">
                <label for="zip_code"><?= $this->lang->line('zip')?></label>
                <input type="text" name="zip_code" id="zip_code"  maxlength="10" class="input-small">
            </div>
            <div class="pull-left control-group">
                <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                <input type="text" name="email" id="email" maxlength="60" class="required email">
            </div>
            <div class="clearfix"></div>
            <div class="control-group">
                <label for="students"><?= $this->lang->line('students')?></label>
                <input type="text" name="students" id="students">
            </div>
            <div class="clearfix"></div>
            <div  class="pull-left control-group margin_right_10">
                <label for="home_phone"><?= $this->lang->line('home_phone')?></label>
                <input type="text" name="home_phone" id="home_phone" maxlength="20">
            </div>
            <div class="pull-left control-group">
                <label for="cell_phone"><?= $this->lang->line('cell_phone')?></label>
                <input type="text" name="cell_phone" id="cell_phone" maxlength="20">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_person('donor')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>