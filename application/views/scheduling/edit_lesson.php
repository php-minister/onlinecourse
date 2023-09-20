<script>
    var grades=<?= json_encode($subjects['grades'])?>,students;
    $('document').ready(function(){
        $("#subject").change(function(){
            load_grades(grades[$(this).val()]);
        })
        load_grades(grades[<?= $lesson['subject_id']?>],<?= $lesson['grade']?>,<?= $lesson['student_group']?>);
        <?php if($lesson['allow_to_edit']=='1'){?>
        $('#lesson_start,#lesson_end').timepicker({minuteStep:5,defaultTime:'08:00 AM'});
        $('#start_date').datepicker({start:'<?= date('Y-m-d')?>'});
        load_classrooms();
        <?php }?>
        $("#room").append('<option value="<?= $lesson['room_id']?>" selected="selected"><?= $lesson['class_room']?></option>');
        
        students=$('#chosen_students')
                    .magicSuggest(magic_suggest_options({data:'students/find_student',name:'chosen_students'}));
        <?php if (!is_null($lesson['is_private'])){?>
        students.addToSelection(<?= json_encode($lesson['students'])?>);
        <?php }?>
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $lesson['name']?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="public_scheduling/save_lesson" method="POST" id="lesson_form">
            <input type="hidden" name="user_type" id="user_type" value="admin">
            <input type="hidden" id="lesson_id" name="lesson_id" value="<?= $lesson['scheduling_id']?>">
            <input type="hidden" id="teacher_id" name="teacher_id" value="<?= $lesson['teacher_id']?>">
            <div class="control-group">
                <?php if($lesson['allow_to_edit']=='1'){?>
                <label for="start_date"><?= $this->lang->line('start_date')?><sup class="mandatory">*</sup></label>
                <input type="text" id="start_date" name="start_date" value="<?= date('m/d/Y',strtotime($lesson['date']))?>">
                <?php }else{?>
                <label><?= $this->lang->line('for_date')?>: <?= date('d M Y',strtotime($lesson['date']))?></label>
                <input type="hidden" id="start_date" name="start_date" value="<?= $lesson['date']?>">
                <?php }?>
            </div>
            <div class="control-group pull-left margin_right_10">
                <label for="lesson_start"><?= $this->lang->line('lesson_start')?><sup class="mandatory">*</sup></label>
                <div class="input-append bootstrap-timepicker">
                    <input type="text" name="lesson_start" id="lesson_start" class="input-small" value="<?= date('h:i A',strtotime($lesson['date'].' '.$lesson['start_time']))?>">
                    <span class="add-on"><i class="icon-time"></i></span>
                </div>
            </div>
            <div class="control-group pull-left margin_right_10">
                <label for="lesson_end"><?= $this->lang->line('lesson_end')?><sup class="mandatory">*</sup></label>
                <div class="input-append bootstrap-timepicker">
                    <input type="text" name="lesson_end" id="lesson_end" class="input-small" value="<?= date('h:i A',strtotime($lesson['date'].' '.$lesson['end_time']))?>">
                    <span class="add-on"><i class="icon-time"></i></span>
                </div>
            </div>
            <div class="control-group pull-left">
                <label>&nbsp;</label>
                <div class="btn-group" data-toggle="buttons-checkbox">
                  <button type="button" class="btn <?= (is_null($lesson['is_private']))?'':'active'?>" onclick="private_lesson()"><?= $this->lang->line('private_lesson')?></button>
                  <input type="hidden" id="is_private" name="is_private" value="<?= (is_null($lesson['is_private']))?'false':'true'?>">
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="subject"><?= $this->lang->line('subject')?><sup class="mandatory">*</sup></label>
                <select name="subject" id="subject" class="required">
                    <?php foreach($subjects['subjects'] as $subject_id=>$subject_name){?>
                    <option value="<?= $subject_id?>" <?= ($subject_id==$lesson['subject_id']?'selected="selected"':'')?>><?= $subject_name?></option>
                    <?php }?>
                </select>
            </div>
            <div class="control-group pull-left private_lesson <?= (!is_null($lesson['is_private']))?'hide':''?>">
                <label for="grade"><?= $this->lang->line('grade')?><sup class="mandatory">*</sup></label>
                <select name="grade" id="grade" class="required"></select>
            </div>
            <div class="clearfix"></div>
            <div class="control-group private_lesson <?= (is_null($lesson['is_private']))?'hide':''?>">
                <label for="chosen_students"><?= $this->lang->line('students')?><sup class="mandatory">*</sup></label>
                <input type="text" id="chosen_students" name="chosen_students">
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="room"><?= $this->lang->line('class_room')?><sup class="mandatory">*</sup></label>
                <select name="room" id="room" class="required"></select>
            </div>
            <div class="pull-left">
                <label>&nbsp;</label>
                <button type="button" onclick="load_classrooms();" class="btn btn-success <?= ($lesson['allow_to_edit']=='0')?'disabled':''?>" <?= ($lesson['allow_to_edit']=='0'?'disabled="disabled"':'')?> ><?= $this->lang->line('find_classrooms')?></button>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>
    <div class="modal-footer">
        <?php if ($lesson['allow_to_edit']=='1'){?>
        <button class="pull-left btn btn-danger" onclick="remove_lesson(<?= $lesson['scheduling_id']?>)"><?= $this->lang->line('remove')?></button>
        <?php }?>
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <?php if ($lesson['allow_to_edit']=='1'){?>
        <button onclick="submit_form('#lesson_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
        <?php }?>
    </div>
</div>