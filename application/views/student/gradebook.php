<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('gradebook'),'forms'=>TRUE, 'page_name' => 'Students' )) ?>
<?php $this->load->view('student/menu',array('active_menu'=>'gradebook'))?>
<script>
    $('document').ready(function(){
        $("#semester_id").change(function(){
            ajax_query('student/get_semester_gradebook/'+$(this).val(),'student_gradebook');
        })
    })
</script>
<!--<header>
    <h2>My gradebook</h2>
</header>-->
<section>
    <article>
            <?php if (count($semesters)==0){?>
            <div class="alert alert-info"><?= $this->lang->line('no_grades_yet')?></div>
            <?php }else{?>
            <label for="semester_id"><?= $this->lang->line('selected_semester')?></label>
            <select name="semester_id" id="semester_id">
            <?php 
            $current_grade=0;
            foreach($semesters as $semester){?>
            <?php if($current_grade!=$semester['grade_id']){ ?>
            <?php if ($current_grade>0){?>
            </optgroup>
            <?php }?>
            <optgroup label="<?= $semester['grade_name']?>">
            <?php $current_grade=$semester['grade_id'];}?>
                <option value="<?= $semester['semester_id']?>">
                <?= ($semester['name'])?($semester['name'].' ('.date('d M Y',strtotime($semester['start_date'])).' - '.date('d M Y',strtotime($semester['end_date'])).')'):(date('d M Y',strtotime($semester['start_date'])).' - '.date('d M Y',strtotime($semester['end_date'])))?>
                </option>
            <?php }?>
            </select>
            <?php }?>
            <div id="student_gradebook">
                <?php $this->load->view('student/gradebook_data') ?>
            </div>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>