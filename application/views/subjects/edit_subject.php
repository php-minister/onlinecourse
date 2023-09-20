<script>
    var teachers,grades;
    $('document').ready(function(){
        teachers=$('#teachers').magicSuggest(magic_suggest_options({data:'teachers/find_teacher',name:'teachers_list'}));
        <?php if ((count($subject['teachers'])>0) AND (!is_null($subject['teachers'][0]['id']))){?>
        teachers.addToSelection(<?= json_encode($subject['teachers'])?>);
        <?php }?>
        
        grades=$('#grades').magicSuggest(magic_suggest_options({data:<?= json_encode($grades)?>,name:'grades_list'}));
        <?php if ((count($subject['grades'])>0) AND (!is_null($subject['grades'][0]['id']))){?>
        grades.addToSelection(<?= json_encode($subject['grades'])?>);
        <?php }?>
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_subject')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="subjects/save_subject" method="POST" id="subject_form">
            <input type="hidden" name="subject_id" id="subject_id" value="<?= $subject['subject']['subject_id']?>">
            <div class="control-group">
                <label for="name"><?= $this->lang->line('name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="name" id="name" maxlength="50" class="required" value="<?= $subject['subject']['name']?>">
            </div>
            <div class="control-group">
                <label for="teachers"><?= $this->lang->line('teachers')?><sup class="mandatory">*</sup></label>
                <input type="text" name="teachers" id="teachers"  class="required">
            </div>
            <div class="control-group">
                <label for="grades"><?= $this->lang->line('grades')?><sup class="mandatory">*</sup></label>
                <input type="text" name="grades" id="grades" class="required">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button class="btn btn-info" onclick="submit_form('#subject_form')"><?= $this->lang->line('save')?></button>
    </div>
</div>