<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('gradebook_of_my_child'),'forms'=>TRUE)) ?>
<?php $this->load->view('parent/menu',array('active_menu'=>'children'))?>
<script>
    $('document').ready(function(){
        $("#semester_id").change(function(){
            $("#download_pdf").attr('href','children/gradebook/<?= $student_id?>?pdf&semester_id='+$(this).val());
            ajax_query('children/get_semester_gradebook/<?= $student_id?>/'+$(this).val(),'student_gradebook');
        })
    })
</script>

<header>
    <h2><?= $this->lang->line('gradebook')?><a href="children/gradebook/<?= $student_id?>?pdf&semester_id=<?= (isset($semesters[0]['semester_id']))?$semesters[0]['semester_id']:0?>" target="_blank" id="download_pdf" title="<?= $this->lang->line('download_pdf')?>"><img src="images/pdf.png"></a></h2>
</header>
<section>
    <article>
            <?php if (count($semesters)==0){?>
            <div class="alert alert-info"><?= $this->lang->line('no_marks_yet')?></div>
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