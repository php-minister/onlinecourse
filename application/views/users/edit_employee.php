<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_employee')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="users/save_employee" method="POST" id="employee_form">
            <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['admin_id']?>">
            
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('details')?></a></li>
              <li><a href="#permissions_tab" data-toggle="tab"><?= $this->lang->line('permissions')?></a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active" id="details_tab">
                    <div class="control-group pull-left margin_right_10">
                        <label for="admin_name"><?= $this->lang->line('employee_name')?><sup  class="mandatory">*</sup></label>
                        <input type="text" name="admin_name" id="admin_name" maxlength="50" class="required" value="<?= $employee['admin_name']?>">
                    </div>
                    <div class="control-group pull-left">
                        <label for="admin_login"><?= $this->lang->line('employee_login')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="admin_login" id="admin_login" maxlength="50" class="required" value="<?= $employee['admin_login']?>">
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group pull-left margin_right_10">
                        <label for="admin_password"><?= $this->lang->line('employee_password')?></label>
                        <input type="password" name="admin_password" id="admin_password" maxlength="20">
                    </div>
                    <div class="control-group pull-left">
                        <label for="password_again"><?= $this->lang->line('employee_password_again')?></label>
                        <input type="password" name="password_again" id="password_again" maxlength="20" equalTo="#admin_password">
                    </div>
                    <div class="clearfix"></div>   
                </div>
                <div class="tab-pane" id="permissions_tab">
                <?php $employee['admin_permissions']=unserialize($employee['admin_permissions']); ?>
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
                            <input type="checkbox" name="<?= $permission?>" 
                            <?= (isset($employee['admin_permissions'][$permission]) AND $employee['admin_permissions'][$permission])?'checked="checked"':''?>><?= $this->lang->line($permission)?>
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