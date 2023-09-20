<script>
    $('document').ready(function(){
      
        
        $('#student')
            .magicSuggest(magic_suggest_options({data:'students/find_student',name:'student_list'}))
            .addToSelection(<?= json_encode($incident['student'])?>);
        
        $('#reported')
            .magicSuggest(magic_suggest_options({data:'teachers/find_teacher',name:'teacher_list'}))
            .addToSelection(<?= json_encode($incident['teacher'])?>);
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('view_incident')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="incidents/save_incident" method="POST" id="incident_form">
            <input type="hidden" name="incident_id" id="incident_id" value="<?= $incident['incident_id']?>">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('incident')?></a></li>
              <li><a href="#taken_actions_tab" data-toggle="tab"><?= $this->lang->line('actions_taken')?></a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="details_tab">
                   <div class="control-group">
                        <label for="student"><?= $this->lang->line('student')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="student" id="student" class="required" disabled="disabled">
                    </div>
                   <div class="control-group">
                        <label for="date"><?= $this->lang->line('date')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="date" id="date" class="required" maxlength="20" value="<?= date('m/d/Y',strtotime($incident['date']))?>" disabled="disabled">
                    </div>
                   <div class="control-group">
                        <label for="details"><?= $this->lang->line('details')?><sup class="mandatory">*</sup></label>
                        <textarea rows="2" name="details" id="details" class="required span12" disabled="disabled"><?= $incident['details']?></textarea>
                    </div>
                </div>
                <div class="tab-pane" id="taken_actions_tab">
                    <div class="control-group">
                        <label for="reported"><?= $this->lang->line('reported_by')?></label>
                        <input type="text" name="reported" id="reported" disabled="disabled">
                    </div>
                    <div class="control-group">
                        <label for="response"><?= $this->lang->line('response')?></label>
                        <textarea rows="2" name="response" id="response" class="span12" disabled="disabled"><?= $incident['response']?></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>