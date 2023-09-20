<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('view_incident')?></h3>
    </div>
    <div class="modal-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('incident')?></a></li>
          <li><a href="#taken_actions_tab" data-toggle="tab"><?= $this->lang->line('taken_actions')?></a></li>
        </ul>
            
        <div class="tab-content">
            <div class="tab-pane active" id="details_tab">
               <div class="control-group">
                    <label><?= $this->lang->line('students')?></label>
                    <?= $incident['student']['students']?>
                </div>
               <div class="control-group">
                    <label><?= $this->lang->line('date')?></label>
                    <?= date('d M Y',strtotime($incident['date']))?>
                </div>
               <div class="control-group">
                    <label><?= $this->lang->line('details')?></label>
                    <p><?= $incident['details']?></p>
                </div>
            </div>
            <div class="tab-pane" id="taken_actions_tab">
                <div class="control-group">
                    <label><?= $this->lang->line('reported_by')?></label>
                    <?= $incident['teacher']?>
                </div>
                <div class="control-group">
                    <label><?= $this->lang->line('response')?></label>
                    <p><?= $incident['response']?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
    </div>
</div>