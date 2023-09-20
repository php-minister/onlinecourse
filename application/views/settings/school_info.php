<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('school_info')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="settings/save_school_info" method="POST" id="school_info_form">
            <div class="pull-left control-group margin_right_10">
                <label for="name"><?= $this->lang->line('school_name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="name" id="name" value="<?= $school['name']?>" maxlength="100" class="required">
            </div>
            <div class="pull-left control-group">
                <label for="principal"><?= $this->lang->line('principal')?><sup class="mandatory">*</sup></label>
                <select id="principal" name="principal" class="required">
                    <?php foreach($teachers as $teacher){?>
                    <option value="<?= $teacher['id']?>" <?= ($teacher['id']==$school['principal']?'selected="selected"':'')?>><?= $teacher['name']?> (<?= $teacher['ssn']?>)</option>
                    <?php }?>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="address"><?= $this->lang->line('address')?></label>
                <input type="text" name="address" id="address" value="<?= $school['address']?>" maxlength="300">
            </div>
            <div class="pull-left control-group">
                <label for="city"><?= $this->lang->line('city')?></label>
                <input type="text" name="city" id="city" value="<?= $school['city']?>" maxlength="100">
            </div>
            <div class="clearfix"></div>
            <div class="pull-left control-group margin_right_10">
                <label for="state"><?= $this->lang->line('state')?></label>
                <input type="text" name="state" id="state" value="<?= $school['state']?>" maxlength="30" class="input-small">
            </div>
            <div class="pull-left control-group margin_right_10">
                <label for="zip_code"><?= $this->lang->line('zip')?></label>
                <input type="text" name="zip_code" id="zip_code" value="<?= $school['zip']?>" maxlength="10" class="input-small">
            </div>
            <div class="pull-left control-group">
                <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                <input type="text" name="email" id="email" value="<?= $school['email']?>" maxlength="60" class="required email">
            </div>
            <div class="clearfix"></div>
            <div class="control-group">
                <label for="phone"><?= $this->lang->line('phone')?><sup class="mandatory">*</sup></label>
                <input type="text" name="phone" id="phone" value="<?= $school['phone']?>" maxlength="20" class="required">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#school_info_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>