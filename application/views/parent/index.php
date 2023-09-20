<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('children'),'forms'=>TRUE)); ?>
<?php $this->load->view('parent/menu',array('active_menu'=>'children'))?>

    <h2><?= $this->lang->line('children')?></h2>

<section>
    <article>
        <?php foreach($children as $child){?>
        <div class="well pull-left margin_right_10">
             <img src="<?= $child['avatar']?>" class="pull-left">
             <div class="pull-left child_details">
                <h4><?= $child['name']?></h4>
                <div class="btn-group">
                    <a class="btn btn-small" href="children/scheduling/<?= $child['student_id']?>">
                        <i class="icon-calendar"></i>
                        <span class="hidden-phone"><?= $this->lang->line('scheduling')?></span>
                    </a>
                    <a class="btn btn-small" href="children/incidents/<?= $child['student_id']?>">
                        <i class="icon-warning-sign"></i>
                        <span class="hidden-phone"><?= $this->lang->line('incidents')?></span>
                    </a>
					<!--<a class="btn btn-small" href="children/gradebook/<?= $child['student_id']?>">
                        <i class="icon-book"></i>
                        <span class="hidden-phone"><?= $this->lang->line('gradebook')?></span>
                    </a>-->
                    <a class="btn btn-small" href="children/attendance/<?= $child['student_id']?>">
                        <i class="icon-ok"></i>
                        <span class="hidden-phone"><?= $this->lang->line('attendance')?></span>
                    </a>
                </div>
             </div>
             <div class="clearfix"></div>
        </div>
        <?php }?>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>