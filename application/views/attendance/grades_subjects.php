<div class="control-group hidden_class">
    <label for="grade" class="pull-left margin_right_10"><?= $this->lang->line('grade')?>:<sup class="mandatory">*</sup></label>
    <?php if (count($grades)==0){?>
    <span class="label label-warning pull-left"><?= $this->lang->line('can_t_find_grades')?></span>
    <?php }?>
    <div class="clearfix"></div>
    <select id="grade" name="grade" class="required" onchange="get_subjects($('#date').val(),$(this).val(),'<?= $user_type?>')">
        <?php $current_grade=0;
        foreach($grades as $grade){?>
        <?php if ($current_grade!=$grade['grade_id']){?>
        <?php if ($current_grade!=0){?>
        </optgroup>
        <?php }?>
        <optgroup label="<?= $grade['name'] ?>">
        <?php  $current_grade=$grade['grade_id']; }?>
            <option value="<?= $grade['grade_id']?>-<?= $grade['group_id']?>">
            <?= $grade['group_name']?>
            <?= ($grade['group_id']==0?($this->lang->line('in').$grade['name']):'')?></option>
        <?php }?>
        </optgroup>
    </select>
</div>
<div id="subjects_area">
    <?php $this->load->view('attendance/subjects') ?>
</div>