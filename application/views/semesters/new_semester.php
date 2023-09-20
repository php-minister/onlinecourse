<script>
    $('document').ready(function(){
        $(".date_picker").datepicker({start:'<?= date('Y-m-d')?>'});
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_semester')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="semesters/save_semester" method="POST" id="semester_form">
            <input type="hidden" name="semester_id" id="semester_id" value="0">
            <div class="control-group">
                <label for="name"><?= $this->lang->line('semester_name')?></label>
                <input type="text" name="name" id="name">
            </div>
            <div class="control-group pull-left margin_right_10">
                <label for="start_date"><?= $this->lang->line('start_date')?><sup class="mandatory">*</sup></label>
                <input type="text" name="start_date" id="start_date" maxlength="12" class="required date_picker">
            </div>
            <div class="control-group pull-left">
                <label for="end_date"><?= $this->lang->line('end_date')?><sup class="mandatory">*</sup></label>
                <input type="text" name="end_date" id="end_date" maxlength="12" class="required date_picker">
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="year_start"><?= $this->lang->line('academic_year_start')?><sup class="mandatory">*</sup></label>
                <input type="text" name="year_start" id="year_start" class="required digits" min="<?= date('Y')?>" max="2150" maxlength="4">
            </div>
            <div class="control-group pull-left">
                <label for="year_end"><?= $this->lang->line('academic_year_end')?><sup class="mandatory">*</sup></label>
                <input type="text" name="year_end" id="year_end" class="required digits" min="<?= date('Y')?>" max="2150" maxlength="4">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#semester_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>