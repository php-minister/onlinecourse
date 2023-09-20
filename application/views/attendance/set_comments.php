<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('comments')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
            <form action="<?= ($user_type=='admin')?'attendance/save_comments':'teacher/save_attendance_comments'?>" method="POST" id="save_comments_form">
                <input type="hidden" name="student_id" id="student_id" value="<?= $student_id?>">
                <input type="hidden" name="lesson_id" id="lesson_id" value="<?= $lesson_id?>">
                <div class="control-group">
                    <label for="comment"><?= $this->lang->line('comment')?></label>
                    <textarea rows="2" class="span12" maxlength="450" id="comment" name="comment"><?= (isset($comments['comment'])?$comments['comment']:'')?></textarea>
                </div>
                <div class="control-group">
                    <label for="private_comment"><?= $this->lang->line('private_comment')?></label>
                    <textarea rows="2" class="span12" maxlength="450" id="private_comment" name="private_comment"><?= (isset($comments['private_comment'])?$comments['private_comment']:'')?></textarea>
                </div>
            </form>
        </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#save_comments_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>