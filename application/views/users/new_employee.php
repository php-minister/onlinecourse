<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('new_employee')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="users/save_employee" method="POST" id="employee_form">
            <input type="hidden" name="employee_id" id="employee_id" value="0">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('details')?></a></li>
              <li><a href="#permissions_tab" data-toggle="tab"><?= $this->lang->line('permissions')?></a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="details_tab">
                    <div class="control-group pull-left margin_right_10">
                        <label for="admin_name"><?= $this->lang->line('employee_name')?><sup  class="mandatory">*</sup></label>
                        <input type="text" name="admin_name" id="admin_name" maxlength="50" class="required">
                    </div>
                    <div class="control-group pull-left">
                        <label for="admin_login"><?= $this->lang->line('employee_login')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="admin_login" id="admin_login" maxlength="50" class="required">
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group pull-left margin_right_10">
                        <label for="admin_password"><?= $this->lang->line('employee_password')?><sup class="mandatory">*</sup></label>
                        <input type="password" name="admin_password" id="admin_password" maxlength="20" class="required">
                    </div>
                    <div class="control-group pull-left">
                        <label for="password_again"><?= $this->lang->line('employee_password_again')?><sup class="mandatory">*</sup></label>
                        <input type="password" name="password_again" id="password_again" maxlength="20" class="required" equalTo="#admin_password">
                    </div>
                    <div class="clearfix"></div>   
                </div>
                <div class="tab-pane" id="permissions_tab">
                  <?php 
                    $permissions=$this->config->item('permissions_template');
                    foreach($permissions as $permission=>$default_value){
                          if ($permission=='admin'){ ?>
                          <input type="hidden" name="<?= $permission?>" value="on">
                    <?php continue; 
                          }
                    ?>
                    <div class="span6" style="margin-left: 0;padding-right: 8px;">
                        <label style="margin-bottom: 0;">
                            <input type="checkbox" name="<?= $permission?>" <?= $default_value?'checked="checked"':''?>><?= $this->lang->line($permission)?>
                        </label>
                        <small><i><?= $this->lang->line($permission.'_description')?></i></small>
                    </div>
                    <?php }?>  
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button class="btn btn-info" onclick="submit_form('#employee_form')"><?= $this->lang->line('save')?></button>
    </div>
</div>