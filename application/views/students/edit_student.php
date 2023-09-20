<script>
    var parents,donors;
    $('document').ready(function(){
        $("#birth_date").datepicker();
        $("#join_date").datepicker();	
		 $("#until").datepicker({start:'<?= date('Y-m-d')?>'});			
	    init_avatar_actions();
        groups=<?= json_encode($groups)?>;
        $("#grade").change(function(){
            load_groups(groups[$(this).val()]);
        });
        <?php if (($student['group']) AND ($student['grade'])){?>
        load_groups(groups[<?= $student['grade']?>],<?= $student['group']?>);
        <?php }else{?>
        load_groups(groups[1],0);
        <?php }?>
        
        parents = $('#parents')
            .magicSuggest(magic_suggest_options({data:'parents/find_parent',name:'parents_list'}))
            .addToSelection(<?= json_encode($student['parents'])?>);
        donors = $('#donors')
                 .magicSuggest(magic_suggest_options({data:'donors/find_donor',name:'donors_list'}))
                 .addToSelection(<?= json_encode($student['donors'])?>);
    })
	
    function toggle_payers(new_type)
    {
        $('#fee_type').val(new_type);
        $('.payers_area').toggleClass('hide');
        (new_type=='students')?groups.clear(true):students.clear(true);
    }	
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_student')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="students/save_student" method="POST" id="person_form">
            <input type="hidden" id="student_id" name="student_id" value="<?= $student['student_id']?>">
            <input type="hidden" id="delete_photo" name="delete_photo" value="0">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#main_tab" data-toggle="tab"><?= $this->lang->line('main')?></a></li>
              <li><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('details')?></a></li>
              <li><a href="#add_tab" data-toggle="tab"><?= $this->lang->line('add_fees')?></a></li>              
              <li class="pull-right">
                <?= $this->lang->line('status')?>:&nbsp;
                <div class="btn-group">
                    <button class="btn btn-small dropdown-toggle btn-success" data-toggle="dropdown"><span id="status_text"><?= $this->lang->line($student['status'])?></span><span class="caret" style="border-top-color: white;"></span></button>
                    <ul class="dropdown-menu pull-right">
                        <?php if ($student['status']=='Active'){?>
                        <li><a href="#" onclick="change_status(<?= $student['student_id']?>,'students','inactive');return false;"><?= $this->lang->line('Inactive')?></a></li>
                        <li><a href="#" onclick="change_status(<?= $student['student_id']?>,'students','graduated');return false;"><?= $this->lang->line('graduated')?></a></li>
                        <li><a href="#" onclick="change_status(<?= $student['student_id']?>,'students','left');return false;"><?= $this->lang->line('left_the_school')?></a></li>
                        <?php }?>
                        <?php if ($student['status']=='Inactive'){?>                     
                        <li><a href="#" onclick="change_status(<?= $student['student_id']?>,'students','active');return false;"><?= $this->lang->line('Active')?></a></li>
   					    <li><a href="#" onclick="resend_invitation(<?= $student['student_id']?>,'students');return false;"><?= $this->lang->line('resend_invitation')?></a></li>
                    	<?php }?>
                        <?php if (($student['status']=='Deleted') OR ($student['status']=='Left') OR ($student['status']=='Graduated')){?>
                        <li><a href="#" onclick="restore_person(<?= $student['student_id']?>,'students');return false;"><?= $this->lang->line('restore_person')?></a></li>
                        <?php }?>
                    </ul>
                </div>
              </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="main_tab">
                    <div class="pull-left margin_right_10" style="background-image: url('<?= $student['avatar']?>');" id="user_avatar_image">
                        <div id="person_photo_area">
                            <div id="avatar_upload_area" class="<?= ($student['avatar']!=DEFAULT_PHOTO)?'hide':''?> pull-left">
                                <input type="file" id="user_avatar" name="user_avatar">
                                <button type="button" class="btn btn-mini"><i class="icon-pencil"></i>  <?= $this->lang->line('upload_photo')?></button>
                            </div>
                            <button type="button" class="btn btn-mini <?= ($student['avatar']==DEFAULT_PHOTO)?'hide':''?> pull-left" title="<?= $this->lang->line('remove_photo')?>" id="remove_photo"><i class="icon-remove"></i></button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="pull-left">
                        <div class="pull-left control-group margin_right_10">
                            <label for="student_name"><?= $this->lang->line('student_name')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="student_name" id="student_name" maxlength="150" class="required" value="<?= $student['name']?>">
                        </div>
                        <div class="pull-left control-group">
                            <label><?= $this->lang->line('gender')?></label>
                            <select id="gender" name="gender" class="input-medium">
                                <option value="male" <?= ($student['gender']==='male'?'selected="selected"':'')?>><?= $this->lang->line('male')?></option>
                                <option value="female" <?= ($student['gender']===''?'selected="selected"':'')?> ><?= $this->lang->line('female')?></option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div class="control-group">
                            <label for="email"><?= $this->lang->line('email')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="email" id="email" maxlength="60" class="required email input-xlarge" value="<?= $student['email']?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pull-left control-group margin_right_10">
                        <label for="grade"><?= $this->lang->line('grade')?><sup class="mandatory">*</sup></label>
                        <select id="grade" name="grade" class="required input-medium">
                            <?php foreach($grades as $grade){?>
                            <option value="<?= $grade['grade_id']?>" <?= ($student['grade']==$grade['grade_id']?'selected="selected"':'')?>><?= $grade['name']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="pull-left control-group">
                        <label for="group"><?= $this->lang->line('group')?></label>
                        <select id="group" name="group"></select>
                        <?php if ($student['old_group']){?>
                        <br/><small><i><?= $this->lang->line('previous_group_is')?>: <?= $student['old_group']?></i></small>
                        <?php }?>
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
                        <input type="text" name="part_of_donation" id="part_of_donation" class="span12" value="<?= $student['part_of_donation']?>">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="details_tab">
                    <div class="pull-left control-group margin_right_10">
                        <label for="ssn"><?= $this->lang->line('ssn')?></label>
                        <input type="text" name="ssn" id="ssn" maxlength="20" class="input-large" value="<?= $student['ssn']?>">
                    </div>
                    <div  class="pull-left control-group">
                        <label for="birth_date"><?= $this->lang->line('join_date')?></label>
                        <input type="text" name="birth_date" id="birth_date" maxlength="10" class="input-large"  value="<?= ($student['join_date'])?date('m/d/Y',strtotime($student['join_date'])):''?>">
                    </div>
                    <div class="clearfix"></div>
                       <div  class="pull-left control-group margin_right_10">
                        <label for="birth_date"><?= $this->lang->line('birth_date')?></label>
                        <input type="text" name="join_date" id="join_date" maxlength="10" class="input-large" data-date-viewmode="years" value="<?= ($student['birth_date'])?date('m/d/Y',strtotime($student['birth_date'])):''?>">
                    </div>
                    
                    <div class="pull-left control-group">
                        <label for="address"><?= $this->lang->line('address')?></label>
                        <input type="text" name="address" id="address" maxlength="300"  value="<?= $student['address']?>">
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="pull-left control-group margin_right_10">
                        <label for="city"><?= $this->lang->line('city')?></label>
                        <input type="text" name="city" id="city" maxlength="100" class="input-medium" value="<?= $student['city']?>">
                    </div>

                    <div class="pull-left control-group margin_right_10">
                        <label for="state"><?= $this->lang->line('state')?></label>
                        <input type="text" name="state" id="state" maxlength="30" class="input-small" value="<?= $student['state']?>">
                    </div>   
                    <div class="pull-left control-group margin_right_10">
                        <label for="zip_code"><?= $this->lang->line('zip')?></label>
                        <input type="text" name="zip_code" id="zip_code"  maxlength="10" class="input-small" value="<?= $student['zip_code'] ?>">
                    </div>
                   <div class="clearfix"></div>                    
				      <div class="pull-left control-group margin_right_10">
                        <label for="cell_phone"><?= $this->lang->line('cell_phone')?></label>
                        <input type="text" name="cell_phone" id="cell_phone" maxlength="20"  value="<?= $student['cell_phone']?>">
                    </div>                    
                
                    <div  class="pull-left control-group">
                        <label for="home_phone"><?= $this->lang->line('home_phone')?></label>
                        <input type="text" name="home_phone" id="home_phone" maxlength="20" value="<?= $student['home_phone']?>">
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