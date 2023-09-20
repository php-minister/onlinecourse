<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_password')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="admin/change_password" id="new_password_form" method="POST">
            <div class="control-group">
                <label for="current_password"><?= $this->lang->line('current_password')?><sup class="mandatory">*</sup></label>
                <input type="password" name="current_password" id="current_password" class="required">
            </div>
            <div class="control-group">
                <label for="new_password"><?= $this->lang->line('new_password')?><sup class="mandatory">*</sup></label>
                <input type="password" name="new_password" id="new_password" class="required">
            </div>
            <div class="control-group">
                <label for="new_password_again"><?= $this->lang->line('new_password_again')?><sup class="mandatory">*</sup></label>
                <input type="password" name="new_password_again" id="new_password_again" class="required" equalTo="#new_password">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#new_password_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>