<script>
    var groups,students;
    $('document').ready(function(){
        $("#until").datepicker({start:'<?= date('Y-m-d')?>'});
        groups =  $('#groups').magicSuggest(magic_suggest_options({data:'students_groups/find_groups',name:'groups_list'}));
        students = $('#students').magicSuggest(magic_suggest_options({data:'students/find_student',name:'students_list'}));
    })
    
    function toggle_payers(new_type)
    {
        $('#fee_type').val(new_type);
        $('.payers_area').toggleClass('hide');
        (new_type=='students')?groups.clear(true):students.clear(true);
    }
    
    function save_fee()
    {
        if ((groups.getSelectedItems().length==0) && (students.getSelectedItems().length==0))
        {
            $("#save_result").html('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('one_payer')?></div>');
            return false;
        }
        submit_form('#fee_form'); 
    }
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_fee')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="fees/save_fee" method="POST" id="fee_form">
            <input type="hidden" name="fee_id" id="fee_id" value="0">
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="fee_name"><?= $this->lang->line('fee_name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="fee_name" id="fee_name" maxlength="150" class="required">
            </div>
            <div class="control-group pull-left">
                <label for="until"><?= $this->lang->line('until')?></label>
                <input type="text" name="until" id="until">
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label for="amount"><?= $this->lang->line('amount')?><sup class="mandatory">*</sup></label>
                <input type="text" name="amount" id="amount" class="required digits">
            </div>
            <div class="control-group pull-left">
                <label for="fee_description"><?= $this->lang->line('fee_description')?></label>
                <input type="text" id="fee_description" name="fee_description" maxlength="400" />
            </div>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <label>
                    <input type="checkbox" name="subscription_payment" onclick="$('#time_period_area').toggleClass('hide')"><?= $this->lang->line('subscription_payment')?>
                </label>
            </div>
            <div class="control-group pull-left hide" id="time_period_area">
                <label for="time_period"><?= $this->lang->line('time_period')?></label>
                <select id="time_period" name="time_period">
                    <option value="1_M"><?= $this->lang->line('monthly_basis')?></option>
                </select>
            </div>
            <div class="clearfix"></div>
            <label><?= $this->lang->line('payers')?><sup class="mandatory">*</sup></label>
            <div class="btn-group" data-toggle="buttons-radio" style="margin-bottom: 15px;">
                <input type="hidden" name="fee_type" id="fee_type" value="groups">
                <button type="button" class="btn active" onclick="toggle_payers('groups')"><?= $this->lang->line('groups')?></button>
                <button type="button" class="btn" onclick="toggle_payers('students')"><?= $this->lang->line('students')?></button>
            </div>
            <div class="control-group payers_area" id="groups_area">
                <input type="text" name="groups" id="groups">
            </div>
            <div class="control-group hide payers_area" id="students_area">
                <input type="text" name="students" id="students">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_fee()" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>