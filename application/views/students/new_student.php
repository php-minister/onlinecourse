<script>
    $('document').ready(function(){
        $("#birth_date").datepicker();
		$("#join_date").datepicker();
		 $("#until").datepicker({start:'<?= date('Y-m-d')?>'});
        init_avatar_actions();
        groups=<?= json_encode($groups)?>;
        $("#grade").change(function(){
            load_groups(groups[$(this).val()]);
        });
        load_groups(groups[1]);
        
        $('#parents').magicSuggest(magic_suggest_options({data:'parents/find_parent',name:'parents_list'}));
        $('#donors').magicSuggest(magic_suggest_options({data:'donors/find_donor',name:'donors_list'}));
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_student')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="students/save_student" method="POST" id="person_form">
            <input type="hidden" id="student_id" name="student_id" value="0">
            <input type="hidden" id="delete_photo" name="delete_photo" value="0">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#main_tab" data-toggle="tab"><?= $this->lang->line('main')?></a></li>
              <li><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('details')?></a></li>
              <li><a href="#add_tab" data-toggle="tab"><?= $this->lang->line('add_fees')?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="main_tab">
                    <div class="pull-left margin_right_10" style="background-image: url('<?= DEFAULT_PHOTO?>');" id="user_avatar_image">
                        <div id="person_photo_area">
                            <div id="avatar_upload_area" class="pull-left">
                                <input type="file" id="user_avatar" name="user_avatar">
                                <button type="button" class="btn btn-mini"><i class="icon-pencil"></i> <?= $this->lang->line('upload_photo')?></button>
                            </div>
                            <button type="button" class="btn btn-mini hide pull-left" title="<?= $this->lang->line('remove_photo')?>" id="remove_photo"><i class="icon-remove"></i></button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="pull-left">
                        <div class="pull-left control-group margin_right_10">
                                <label for="student_name"><?= $this->lang->line('student_name')?><sup class="mandatory">*</sup></label>
                                <input type="text" name="student_name" id="student_name" maxlength="150" class="required">
                        </div>
                        <div class="pull-left control-group">
                            <label><?= $this->lang->line('gender')?></label>
                            <select id="gender" name="gender" class="input-medium">
                                <option value="male"><?= $this->lang->line('male')?></option>
                                <option value="female"><?= $this->lang->line('female')?></option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-left control-group">
                            <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="email" id="email" maxlength="60" class="required email">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-left control-group margin_right_10">
                        <label for="grade"><?= $this->lang->line('grade')?><sup class="mandatory">*</sup></label>
                        <select id="grade" name="grade" class="required">
                            <?php foreach($grades as $grade){?>
                            <option value="<?= $grade['grade_id']?>"><?= $grade['name']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="pull-left control-group">
                        <label for="group"><?= $this->lang->line('group')?></label>
                        <select id="group" name="group"></select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group">
                        <label for="parents"><?= $this->lang->line('parents')?></label>
                        <input type="text" name="parents" id="parents">
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-left span9" style="margin-left: 0;">
                        <label><?= $this->lang->line('donors')?></label>
                        <input type="text" name="donors" id="donors">
                    </div>
                    <div class="pull-left span3">
                        <label for="part_of_donation"><?= $this->lang->line('part_of_donation')?></label>
                        <input type="text" name="part_of_donation" id="part_of_donation" class="span12">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="details_tab">
                    <div class="pull-left control-group margin_right_10">
                        <label for="ssn"><?= $this->lang->line('ssn')?></label>
                        <input type="text" name="ssn" id="ssn" maxlength="20">
                    </div>
                    <div  class="pull-left control-group">
                        <label for="birth_date"><?= $this->lang->line('birth_date')?></label>
                        <input type="text" name="birth_date" id="birth_date" maxlength="10" class="input-medium" data-date-viewmode="years">
                    </div>
                    <div class="clearfix"></div>
                    <div  class="pull-left control-group margin_right_10">
                        <label for="birth_date"><?= $this->lang->line('join_date')?></label>
                        <input type="text" name="join_date" id="join_date" maxlength="10" class="input-medium" data-date-viewmode="years">
                    </div>                    
                    
                    <div class="pull-left control-group ">
                        <label for="address"><?= $this->lang->line('address')?></label>
                        <input type="text" name="address" id="address" maxlength="300">
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="pull-left control-group margin_right_10">
                        <label for="city"><?= $this->lang->line('city')?></label>
                        <input type="text" name="city" id="city" maxlength="100">
                    </div>

                    <div class="pull-left control-group margin_right_10">
                        <label for="state"><?= $this->lang->line('state')?></label>
                        <input type="text" name="state" id="state" maxlength="30" class="input-small">
                    </div>
                    <div class="pull-left control-group margin_right_10">
                        <label for="zip_code"><?= $this->lang->line('zip')?></label>
                        <input type="text" name="zip_code" id="zip_code"  maxlength="10" class="input-small">
                    </div>
                    <div class="clearfix"></div>
                                        
                    <div  class="pull-left control-group">
                        <label for="home_phone"><?= $this->lang->line('home_phone')?></label>
                        <input type="text" name="home_phone" id="home_phone" maxlength="20">
                    </div>                   
                    <div class="pull-left control-group">
                        <label for="cell_phone"><?= $this->lang->line('cell_phone')?></label>
                        <input type="text" name="cell_phone" id="cell_phone" maxlength="20">
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                  <div class="tab-pane" id="add_tab">
                        <input type="hidden" name="fee_id" id="fee_id" value="0">
                        <input type="hidden" name="fee_type" id="fee_type" value="students">
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
                  </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_person('student')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>