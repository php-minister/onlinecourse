<div id="gradebook_table">
    <?php foreach($students['data'] as $student){?>
        <div class="pull-left student_details">
            <h5 class="pull-left" style="width: 63%;"><?= $student['name']?> <?= isset($student['group_name'])?(sprintf($this->lang->line('from_group'),$student['group_name'])):''?></h5>
            <div class="input-append pull-right" style="width: 35%;">
                <input type="text" class="input-mini" value="<?= $student['score']?>"  id="score_<?= $set_id?>_<?= $student['student_id']?>" maxlength="6" max="999">
                <span class="add-on" id="label_<?= $set_id?>_<?= $student['student_id']?>" title="<?= $student['label']?>"> <?=$student['label']?></span>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php }?>
</div>
<div class="clearfix"></div>
<div class="pagination pagination-right">
    <button class="btn btn-info" type="button" style="margin-top: -25px;" onclick="save_scores()"><?= $this->lang->line('save_scores')?></button>
    <?php if ($students['rows']>1){?>
    <ul>
        <li <?= ($page_id==1?'class="disabled"':'')?>><a href="#" page_id="<?= ($page_id==1?0:$page_id-1)?>">&larr;<?= $this->lang->line('prev')?></a></li>
        <?php for($i=max(1,$page_id-3);$i<=min($students['rows'],$page_id+3);$i++){?>
        <li <?= ($page_id==$i?'class="active"':'')?>><a href="#" page_id="<?= ($page_id==$i?0:$i)?>"><?= $i?></a></li>
        <?php }?>
        <li <?= ($page_id==$students['rows']?'class="disabled"':'')?>><a href="#" page_id="<?= ($page_id==$students['rows']?$students['rows']:$page_id+1)?>"><?= $this->lang->line('next')?>&rarr;</a></li>
    </ul>
    <?php }?>
</div>
<div class="clearfix"></div>