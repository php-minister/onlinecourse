<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_student')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="students/save_student_url" method="POST" id="person_form">
            <input type="hidden" id="student_id" name="student_id" value="<?= $student['student_id']?>">            
            <ul class="nav nav-tabs">
            </ul>
            <div class="tab-content">
                   <div class="pull-left">
                        <div class="pull-left control-group margin_right_10">
                            <label for="student_name"><?= $this->lang->line('student_class_url')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="student_url" id="student_url" maxlength="300" class="required input-xlarge" value="<?= $student['class_attend_url']?>">
                        </div>                 
                </div>
           </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_person('student')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>