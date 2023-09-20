<script>
    var grades=<?= json_encode($subjects['grades'])?>,students;
    $('document').ready(function(){
        $("#subject").change(function(){
            load_grades(grades[$(this).val()]);
        });
        <?php if (count($subjects['subjects'])>0){?>
        load_grades(grades[<?= key($subjects['subjects'])?>]);
        <?php }?>
        $('#lesson_start,#lesson_end').timepicker({minuteStep:5,defaultTime:'08:00 AM'});
        $('#start_date').datepicker({start:'<?= date('Y-m-d')?>'});
        load_classrooms('teacher');
        
        students=$('#chosen_students').magicSuggest(magic_suggest_options({data:'teacher/find_student',name:'chosen_students'}));
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_lesson')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="public_scheduling/save_lesson" method="POST" id="lesson_form">
            <input type="hidden" name="user_type" value="teacher">
            <input type="hidden" id="lesson_id" name="lesson_id" value="0">
            <input type="hidden" id="teacher_id" name="teacher_id" value="<?= $teacher_id?>">
            <div class="control-group">
                <label for="start_date"><?= $this->lang->line('start_date')?><sup class="mandatory">*</sup></label>
                <input type="text" id="start_date" name="start_date" value="<?= date('m/d/Y')?>" class="required">
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="lesson_start"><?= $this->lang->line('lesson_start')?><sup class="mandatory">*</sup></label>
                <div class="input-append bootstrap-timepicker">
                    <input type="text" name="lesson_start" id="lesson_start" class="input-small" value="<?= date('h:i A')?>">
                    <span class="add-on"><i class="icon-time"></i></span>
                </div>
            </div>
            <div class="control-group pull-left margin_right_10">
                <label for="lesson_end"><?= $this->lang->line('lesson_end')?><sup class="mandatory">*</sup></label>
                <div class="input-append bootstrap-timepicker">
                    <input type="text" name="lesson_end" id="lesson_end" class="input-small" value="<?= date('h:i A',time()+3600)?>">
                    <span class="add-on"><i class="icon-time"></i></span>
                </div>
            </div>
            <div class="control-group pull-left">
                <label>&nbsp;</label>
                <div class="btn-group" data-toggle="buttons-checkbox">
                  <button type="button" class="btn" onclick="private_lesson()"><?= $this->lang->line('private_lesson')?></button>
                  <input type="hidden" id="is_private" name="is_private" value="false">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="subject"><?= $this->lang->line('subject')?><sup class="mandatory">*</sup></label>
                <?php if (count($subjects['subjects'])==0){?>
                <?= $this->lang->line('you_don_t_have_any_subjects')?>
                <?php }else{?>
                <select name="subject" id="subject" class="required">
                    <?php foreach($subjects['subjects'] as $subject_id=>$subject_name){?>
                    <option value="<?= $subject_id?>"><?= $subject_name?></option>
                    <?php }?>
                </select>
                <?php }?>
            </div>
            <div class="control-group pull-left private_lesson">
                <label for="grade"><?= $this->lang->line('grade')?><sup class="mandatory">*</sup></label>
                <select name="grade" id="grade" class="required"></select>
            </div>
            <div class="clearfix"></div>
            <div class="control-group hide private_lesson">
                <label for="chosen_students"><?= $this->lang->line('students')?><sup class="mandatory">*</sup></label>
                <input type="text" id="chosen_students" name="chosen_students">
            </div>
            <div class="clearfix"></div>
            <div class="control-group">
                <label for="room"><?= $this->lang->line('class_room')?><sup class="mandatory">*</sup></label>
                <select name="room" id="room" class="required margin_right_10"></select>
                <button type="button" onclick="load_classrooms('teacher');" class="btn btn-success"><?= $this->lang->line('find_classrooms')?></button>
            </div>
            
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#lesson_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>