<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('attendance'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'reports'))?>
<script>
    var student;
    $('document').ready(function(){
        
        var student=$('#student').magicSuggest(magic_suggest_options({data:'students/find_student',name:'student',maxSelection:1}));
        
        $(student).on('selectionchange', function(event, combo, selection){
            if (selection[0].id)
            {
                $("#teacher_feedbacks_area").html('<img src="images/ajax-loader.gif"');
                ajax_query('reports/get_student_attendance/'+selection[0].id,'student_attendance_area');
            }
        });
        
        $(student).on('focus',function(selection){
            selection.currentTarget.clear();
        })
    })
</script>
<header>
    <h2><?= $this->lang->line('attendance')?></h2>
</header>
<section>
    <article>
        <label><?= $this->lang->line('select_student')?></label>
        <input type="text" name="student" id="student" class="span4">
        <div id="student_attendance_area" style="margin-top: 15px;">
            <table class="dynamicTable table-bordered table table-condensed table-hover">
                <thead>
                    <tr>
                        <th><?= $this->lang->line('student')?></th>
                        <th><?= $this->lang->line('lesson')?></th>
                        <th><?= $this->lang->line('status')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($attendance as $status){?>
                        <tr>
                            <td><?= $status['student_name']?></td>
                            <td>
                                <?= $status['subject_name']?><?= $this->lang->line('at')?><?= date('d M Y h:i A',strtotime($status['date'].' '.$status['start_time']))?><?= $this->lang->line('by')?><?= $status['teacher_name']?>
                            </td>
                            <td>
                                <?= $status['attendance_status']?>
                                <?= (!is_null($status['private_comment']))?(', '.$this->lang->line('with_comment').$status['private_comment']):''?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>