<script src="js/jquery.raty.min.js"></script>
<script>
    $("document").ready(function(){
        $("#rating").raty({
            cancelHint:'<?= $this->lang->line('raty_cancel_hint')?>',
            hints:<?= $this->lang->line('raty_hints')?>,
            noRatedMsg:'<?= $this->lang->line('raty_not_rated')?>',
            <?php if (!$is_comment_added){?>
            cancel:true
            <?php }else{?>
            score:<?= $is_comment_added['rating']?>,
            cancel:false,
            readOnly:true
            <?php }?>
        });
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('feedback')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <label><?= $lesson['subject_name']?> <?= $this->lang->line('by')?> <?= $lesson['teacher_name']?>, <?= $this->lang->line('at')?> <?= date('d M h:i A',strtotime($lesson['date'].' '.$lesson['start_time']))?></label>
        <form action="student/save_comment" method="POST" id="save_comment_form">
            <input type="hidden" name="scheduling_id" value="<?= $lesson['scheduling_id']?>">
            <div class="control-group">
                <label><?= $this->lang->line('rating')?></label>
                <div id="rating"></div>
            </div>
            <div class="control-group">
                <label for="comment"><?= $this->lang->line('comment')?></label>
                <div id="comment_area">
                    <?php if (!$is_comment_added){?>
                    <textarea rows="2" class="span12" id="comment" name="comment" maxlength="400"></textarea>
                    <?php }else{
                    echo nl2br($is_comment_added['comment']);
                    }?>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <?php if (!$is_comment_added){?>
        <button onclick="submit_form('#save_comment_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
        <?php }?>
    </div>
</div>