<script>
    $('document').ready(function(){
        $("#group_name").html($("#group_id option[value=<?= $set['grade_id']?>-<?= $set['group_id']?>]").text());
        $("#subject_name").html($("#subject_id option:selected").text());
        
        $("#date").datepicker(semester);
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_assignment')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result2"></div>
        <form action="gradebook/save_set" method="POST" id="set_form">
            <input type="hidden" name="set_id" id="set_id" value="<?= $set['set_id']?>">
            <div class="control-group pull-left margin_right_10">
                <label for="name"><?= $this->lang->line('name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="name" id="name" class="required input-xlarge" maxlength="100" value="<?= $set['name']?>">
            </div>
            <div class="control-group pull-left">
                <label for="date"><?= $this->lang->line('assignment_date')?><sup class="mandatory">*</sup></label>
                <input type="text" name="date" id="date" class="required input-medium" value="<?= date('m/d/Y',strtotime($set['date']))?>">
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label><?= $this->lang->line('group')?></label>
                <span id="group_name"></span>
            </div>
            <div class="control-group pull-left">
                <label><?= $this->lang->line('subject')?></label>
                <span id="subject_name"></span>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#set_form','#save_result2')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>