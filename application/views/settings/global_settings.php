<script>
    $('document').ready(function(){
        $('.popover_details').popover({trigger:'hover',placement:'bottom'});
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('global_settings')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="settings/save_global_settings" method="POST" id="settings_form">
            
            <ul class="nav nav-tabs">
                <li class="active"><a href="#settings_tab" data-toggle="tab"><?= $this->lang->line('settings')?></a></li>
                <li><a href="#permissions_tab" data-toggle="tab"><?= $this->lang->line('permissions')?></a></li>
                <li><a href="#payments_tab" data-toggle="tab"><?= $this->lang->line('payments')?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="settings_tab">
                   <div class="control-group pull-left margin_right_10" style="margin-top: 3px;">
                        <input type="hidden" name="final_score_method" id="final_score_method" value="<?= $settings['final_score_method']?>">
                        <label><?= $this->lang->line('method_for_calculation')?>:&nbsp;&nbsp;</label>
                    </div>
                    <div class="btn-group pull-left" data-toggle="buttons-radio">
                        <button type="button" class="btn popover_details <?= ($settings['final_score_method']=='avg')?'active':''?>" data-content="<?= $this->lang->line('calculate_average')?>" onclick="$('#final_score_method').val('avg')"><?= $this->lang->line('average')?></button>    
                        <button type="button" class="btn popover_details <?= ($settings['final_score_method']=='sum')?'active':''?>" data-content="<?= $this->lang->line('calculate_sum')?>" onclick="$('#final_score_method').val('sum')"><?= $this->lang->line('sum')?></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="control-group pull-left margin_right_10">
                        <label for="current_language"><?= $this->lang->line('language')?><sup class="mandatory">*</sup></label>
                        <select name="current_language" id="current_language" class="required">
                        <?php foreach($languages as $language){?>
                        <option value="<?= $language?>" <?= ($settings['current_language']==$language)?'selected="selected"':''?>><?= ucfirst($language)?></option>
                        <?php }?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <br/>
                </div>
                <div class="tab-pane" id="permissions_tab">
                   <fieldset>
                        <h4><?= $this->lang->line('teachers_can_manage')?></h4>
                        <div  class="pull-left margin_right_10">
                            <label>
                                <input type="checkbox" name="teacher_manage_own_subjects" <?= ($settings['teacher_manage_own_subjects']=='on'?'checked="checked"':'')?>><?= $this->lang->line('own_subjects')?>
                            </label>
                        </div>
                        <div class="pull-left margin_right_10">
                            <label>
                                <input type="checkbox" name="teacher_manage_attendance" <?= ($settings['teacher_manage_attendance']=='on'?'checked="checked"':'')?>><?= $this->lang->line('attendance')?>
                            </label>
                        </div>
                        <div class="pull-left margin_right_10">
                            <label>
                                <input type="checkbox" name="teacher_manage_gradebook" <?= ($settings['teacher_manage_gradebook']=='on'?'checked="checked"':'')?>><?= $this->lang->line('gradebook')?>
                            </label>
                        </div>
                        <div class="pull-left margin_right_10">
                            <label>
                                <input type="checkbox" name="teacher_manage_incidents" <?= ($settings['teacher_manage_incidents']=='on'?'checked="checked"':'')?>><?= $this->lang->line('incidents')?>
                            </label>
                        </div>
                        <div class="clearfix"></div>
                    </fieldset>
                </div>
                <div class="tab-pane" id="payments_tab">
                    <?php
                        $currencies=array();
                        foreach($payment_methods as $method)
                        {
                            $currencies=array_merge($currencies,array_flip($method['currencies']));
                        }
                        ksort($currencies);
                     ?>
                    <div class="control-group">
                        <label for="current_currency"><?= $this->lang->line('currency')?><sup class="mandatory">*</sup></label>
                        <select id="current_currency" name="current_currency" class="required">
                            <?php foreach($currencies as $currency=>$trash){?>
                            <option value="<?= $currency?>" <?= ($currency==$settings['current_currency'])?'selected="selected"':'' ?>><?= $currency?>, <?= $this->lang->line('currency_'.$currency)?></option>
                            <?php }?>
                        </select>
                    </div>
                    <?php 
                        $settings['payment_settings']=unserialize($settings['payment_settings']);
                        $settings['active_payments']=explode(',',$settings['active_payments']);
                    ?>
                    <div class="accordion" id="accordion2">
                      <?php foreach($payment_methods as $method_name=>$details){?>
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?= $method_name?>"><?= ucfirst($method_name)?></a>
                        </div>
                        <div id="collapse<?= $method_name?>" class="accordion-body collapse">
                          <div class="accordion-inner">
                            <label>
                                <input type="checkbox" name="methods[<?= $method_name?>][is_active]" <?= (in_array($method_name,$settings['active_payments']))?'checked="checked"':''?>><?= $this->lang->line('is_active')?>
                            </label>
                            <div class="clearfix"></div>
                            <?php 
                            foreach($details['fields'] as $index=>$field){?>
                                <div class="control-group pull-left <?=($index%2==0)?'margin_right_10':'' ?>">
                                    <label for="<?= $method_name?>_<?= $field?>"><?= $this->lang->line($method_name.'_'.$field)?></label>
                                    <input type="text" name="methods[<?= $method_name?>][<?= $field?>]" id="<?= $method_name?>_<?= $field?>" value="<?= isset($settings['payment_settings'][$method_name][$field])?$settings['payment_settings'][$method_name][$field]:''?>">
                                </div>
                            <?php if ($index%2!=0){?>
                            <div class="clearfix"></div>
                            <?php }?>
                            <?php }?>
                            <div class="control-group">
                               <label for="<?= $method_name?>_currency"><?= $this->lang->line('accept_money_in')?></label>
                               <select name="methods[<?= $method_name?>][currency]" id="<?= $method_name?>_currency">
                               <?php foreach($details['currencies'] as $currency){?>
                               <option value="<?= $currency?>" <?= (isset($settings['payment_settings'][$method_name]['currency']) AND ($settings['payment_settings'][$method_name]['currency']==$currency))?'selected="selected"':''?> ><?= $currency?>, <?= $this->lang->line('currency_'.$currency)?></option>
                               <?php }?>
                               </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="alert alert-info" style="font-size: 13px;overflow: auto;margin-bottom: 0;padding: 2px 2px 2px 10px;"><?= $this->lang->line('ipn_url')?>: <?=  (strpos($this->config->item('base_url'),'schoolboard.im')?$this->lang->line('path_your_server'):$this->config->item('base_url')).'ipn/'.$method_name?></div> 
                          </div>
                        </div>
                      </div>
                      <?php }?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#settings_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>