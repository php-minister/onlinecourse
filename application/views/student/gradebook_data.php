<script>
    $('document').ready(function(){
        $('.btn.btn-mini').click(function(){
            $(this).parent().find('.gradebook_assignment').toggle();
            $(this).find('i')
                   .toggleClass('icon-chevron-down')
                   .toggleClass('icon-chevron-up');
        })
    })
</script>
<div class="gradebook_subject">
<?php 
    $current_subject=0;
    foreach($gradebook as $index=>$item){
        if ($current_subject!=$item['subject_id']){
            if ($current_subject>0){?>
            <div class="clearfix"></div>
            </div>
            </div>
            <div class="gradebook_subject">
            <?php } ?>
            <div class="gradebook_subject_group">
                <h4><?= $item['subject_name']?>: <?= ($item['score']==(int)$item['score'])?(int)$item['score']:$item['score'] ?> <?= $item['label']?></h4>
                <small><i><?= $item['name']?>, <?= date('d M Y',strtotime($item['date']))?></i></small>
                <?php if ((isset($gradebook[$index+1])) AND ($gradebook[$index+1]['subject_id']==$item['subject_id'])){?>
                <button class="btn btn-mini"><i class="icon-chevron-down"></i><?= $this->lang->line('all_marks')?></button>
                <?php }?>
            <div class="clearfix"></div>
    <?php 
        $current_subject=$item['subject_id'];
        continue;
     }?>
     <div class="gradebook_assignment pull-left">
        <h5><?= $item['name']?>: 
        <?php if (!is_null($item['score'])){?>
        <?= '  '.($item['score']==(int)$item['score'])?(int)$item['score']:$item['score'] ?> <?= $item['label']?>
        <?php }else{?>
        -
        <?php }?></h5>
        <small><i><?= date('d M Y',strtotime($item['date']))?></i></small>
   </div>
   <?php }?>
   <div class="clearfix"></div>
   </div>
</div>