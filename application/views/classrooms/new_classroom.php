<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_classroom')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="classrooms/save_classroom" method="POST" id="classroom_form">
            <input type="hidden" name="classroom_id" id="classroom_id" value="0">
            <div class="control-group">
                <label for="name"><?= $this->lang->line('classroom_name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="name" id="name" maxlength="50" class="required">
            </div>
            <div class="control-group">
                <label>
                    <input type="checkbox" name="is_shared" id="is_shared"><?= $this->lang->line('is_shared')?>
                </label>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#classroom_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>