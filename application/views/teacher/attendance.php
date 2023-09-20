<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('attendance'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE)) ?>
<?php $this->load->view('teacher/menu',array('active_menu'=>'attendance'))?>
<script>
    $('document').ready(function(){
        $("#date").datepicker({
            set_date:function(){
                get_date_grades($("#date").val(),'teacher');
            },
            end:'<?= date('Y-m-d')?>'
        });
    })
</script>
<section>
    <article>
        <div class="span3" style="margin-bottom: 10px;">
            <header>
                <h2><?= $this->lang->line('attendance')?></h2>
            </header>
            <form action="teacher/show_attendance_students" id="show_students" method="POST">
                <div class="control-group">
                    <label for="date"><?= $this->lang->line('date')?>:<sup class="mandatory">*</sup></label>
                    <input type="text" name="date" id="date" value="<?= date('m/d/Y')?>" class="required" onchange="get_date_grades($('#date').val(),'teacher');">
                </div>
                <div id="grades_subjects_area">
                    <?= $this->load->view('attendance/grades_subjects',array('user_type'=>'teacher'))?>
                </div>
            </form>
            <br/>
            <a href="teacher/attendance#students_list" class="btn btn-info" onclick="submit_form('#show_students')"><?= $this->lang->line('show_students')?></a>
        </div>
        <div class="span9" id="students_list">
            <div id="save_result"></div>
        </div>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>