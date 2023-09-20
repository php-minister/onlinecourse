<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('complete_active_semester')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="semesters/complete_semester" method="POST" id="semester_form">
            <?= $this->lang->line('active_semester')?>: <?= ($semester['name'])?('<span title="'.date('d M Y',strtotime($semester['start_date'])).' - '.date('d M Y',strtotime($semester['end_date'])).'">'.$semester['name'].'</span><br/>'):('<i>'.date('d M Y',strtotime($semester['start_date'])).' - '.date('d M Y',strtotime($semester['end_date'])).'</i>')?>
            <br/>
            <label>
                <input type="checkbox" name="to_next_grade"><?= $this->lang->line('also__move_students_to_next_grade')?>
            </label>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#semester_form')" class="btn btn-info"><?= $this->lang->line('complete')?></button>
    </div>
</div>