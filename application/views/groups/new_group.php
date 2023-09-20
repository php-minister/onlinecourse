<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_group')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="students_groups/save_group" method="POST" id="group_form">
            <input type="hidden" name="group_id" id="group_id" value="0">
            <div class="control-group">
                <label for="name"><?= $this->lang->line('group_name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="name" id="name" maxlength="50" class="required">
            </div>
            <div class="control-group">
                <label for="grade"><?= $this->lang->line('grade')?></label>
                <select name="grade" id="grade">
                    <?php foreach($grades as $grade){?>
                    <option value="<?= $grade['grade_id']?>"><?= $grade['name']?></option>
                    <?php }?>
                </select>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#group_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>