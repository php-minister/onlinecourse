<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('teacher_feedbacks'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'reports'))?>
<script>
    var teacher;
    $('document').ready(function(){
        
        var teacher=$('#teacher').magicSuggest(magic_suggest_options({data:'teachers/find_teacher',name:'teacher',maxSelection:1}));
        
        $(teacher).on('selectionchange', function(event, combo, selection){
            if (selection[0].id)
            {
                $("#teacher_feedbacks_area").html('<img src="images/ajax-loader.gif"');
                ajax_query('reports/get_teacher_feedbacks/'+selection[0].id,'teacher_feedbacks_area');
            }
        });
        
        $(teacher).on('focus',function(selection){
            selection.currentTarget.clear();
        })
    })
</script>
<header>
    <h2><?= $this->lang->line('teacher_feedbacks')?></h2>
</header>
<section>
    <article>
        <label><?= $this->lang->line('select_teacher')?></label>
        <input type="text" name="teacher" id="teacher" class="span4">
        <div id="teacher_feedbacks_area" style="margin-top: 15px;">
            <table class="dynamicTable table-bordered table table-condensed table-hover">
                <thead>
                    <tr>
                        <th><?= $this->lang->line('teacher')?></th>
                        <th><?= $this->lang->line('student')?></th>
                        <th><?= $this->lang->line('feedback')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($feedbacks as $feedback){?>
                    <tr>
                        <td><?= $feedback['teacher_name']?> <?= $this->lang->line('for')?> <?= $feedback['subject_name']?> (<?= date('d M Y',strtotime($feedback['date'].' '.$feedback['start_time']))?>)</td>
                        <td>
                            <?= $feedback['student_name']?>
                            <?= (!is_null($feedback['grade_name'])?('('.$feedback['grade_name'].')'):'')?>
                        </td>
                        <td>
                            <span class="rating rate_<?= $feedback['rating']?>"></span>
                            <?= $feedback['comment']?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>