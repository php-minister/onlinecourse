<div class="control-group " >
    <label for="subject" class="pull-left margin_right_10"><?= $this->lang->line('subject')?>:<sup class="mandatory">*</sup></label>
    <?php if (count($subjects)==0){?>
    <span class="label label-warning pull-left"><?= $this->lang->line('can_t_find_subjects')?></span>
    <?php }?>
    <div class="clearfix"></div>
    <select id="subject" name="subject" class="required">
        <?php foreach($subjects as $subject){?>
        <option value="<?= $subject['scheduling_id']?>"><?= $subject['subject_name']?> <?= $this->lang->line('starts_at')?> <?= preg_replace('/:[0-9]+$/si','',$subject['start_time'])?></option>
        <?php }?>
    </select>
</div>