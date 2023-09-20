<script>
    $('document').ready(function(){
        $("#date").datepicker();
        
        $('#student').magicSuggest(magic_suggest_options({data:'teacher/find_student',name:'student_list'}));
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_incident')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="teacher/save_incident" method="POST" id="incident_form">
            <input type="hidden" name="incident_id" id="incident_id" value="0">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('incident')?></a></li>
              <li><a href="#taken_actions_tab" data-toggle="tab"><?= $this->lang->line('taken_actions')?></a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="details_tab">
                   <div class="control-group">
                        <label for="student"><?= $this->lang->line('students')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="student" id="student" class="required">
                    </div>
                   <div class="control-group">
                        <label for="date"><?= $this->lang->line('date')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="date" id="date" class="required" maxlength="20">
                    </div>
                   <div class="control-group">
                        <label for="details"><?= $this->lang->line('details')?><sup class="mandatory">*</sup></label>
                        <textarea rows="2" name="details" id="details" class="required span12"></textarea>
                    </div>
                </div>
                <div class="tab-pane" id="taken_actions_tab">
                    <div class="control-group">
                        <label><?= $this->lang->line('reported_by')?></label>
                        <input type="text" value="<?= $this->session->userdata['name']?>" readonly="readonly">
                    </div>
                    <div class="control-group">
                        <label for="response"><?= $this->lang->line('response')?></label>
                        <textarea rows="2" name="response" id="response" class="span12"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#incident_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>