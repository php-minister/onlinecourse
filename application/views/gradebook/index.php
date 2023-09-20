<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('gradebook'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'school'))?>
<script type="text/javascript">
  var scale=<?= json_encode($scale)?>;
  var changed=false;
  var changes={};
  <?php if ((isset($semester['name'])) AND ($semester['is_active']=='1')){?>
  var semester={start:'<?= $semester['start_date']?>',end:'<?= $semester['end_date']?>'};
  <?php }?>
  $('document').ready(function(){
     $("#group_id").change(function(){
         $("#student_page").val(1);
         <?php if ((isset($semester['name'])) AND ($semester['is_active']=='1')){?>
         ajax_query('gradebook/get_subjects/'+$(this).val(),'subjects_area');
         <?php }?>
     });
     
     <?php $this->load->view('gradebook/functions')?>
  }); 
  
  function remove_assigment(set_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_to_delete_this_assignment_')?>'))
      {
          ajax_query('gradebook/delete_set/'+set_id,'',function(){
              $("#assignment_id option[value='"+set_id+"']").remove();
              if ($("#assignment_id option").length==0)
              {
                  $("#edit_set_area").addClass('hide');
              }
          });
      }
  }
  
  function save_scores()
  {
      if (changed)
      {
          block_screen();
          $.post('gradebook/save_scores',{scores:JSON.stringify(changes)},function(data){
                 if (data.error)
                 {
                     $("#scores_save").html('<div  class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a>'+data.error+'</div>');
                 }
                 else
                 {
                     $("#scores_save").html('<div  class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('saved')?></div>');
                     changed=false;
                     changes={};
                 }
                 free_screen();
             },'json');
      }
      else
      {
          $("#scores_save").html('<div  class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('you_didn_t_change_any_scores')?></div>');
      }
  }
</script>
<header>
    <h2><?= $this->lang->line('gradebook')?> 
    <?php if ((isset($semester['name'])) AND ($semester['is_active']=='1')){?>
    <small><?= ($semester['name'])?('<span title="'.sprintf($this->lang->line('from_to'),date('d M Y',strtotime($semester['start_date'])),date('d M Y',strtotime($semester['end_date']))).'">'.$semester['name'].'</span><br/>'):('<i>'.date('d M Y',strtotime($semester['start_date'])).' - '.date('d M Y',strtotime($semester['end_date'])).'</i>')?></small>
    <?php }?>
    </h2>
    
    <?php if (!isset($semester['name'])){?>
    <div class="alert alert-error"><?= $this->lang->line('previous_semester_completed')?></div>
    <?php }?>
    <?php if ((isset($semester['is_active'])) AND ($semester['is_active']=='0') AND ($semester['is_completed']=='0')){?>
    <div class="alert alert-error"><?= $this->lang->line('make_sure_you_made_previous_semester_completed')?></div>
    <?php }?>
    <?php if ((isset($semester['is_active'])) AND ($semester['is_completed']=='1')){?>
    <div class="alert alert-info"><?= $this->lang->line('current_semester_completed')?></div>
    <?php }?>
</header>
<section>
    <article>
        <div class="span3">
            <form action="gradebook/get_students" id="students_form" method="POST">
                <input type="hidden" name="student_page" id="student_page" value="1">
                <input type="hidden" name="show_all" id="show_all" value="false">
                <div class="control-group">
                    <label for="group_id"><?= $this->lang->line('group')?><sup class="mandatory">*</sup></label>
                    <select name="group_id" id="group_id" class="required">
                    <?php $current_grade=0;
                        foreach($grades as $group){
                            if ($current_grade!=$group['grade_id']){ ?>
                            <?php if ($current_grade>0){?>
                            </optgroup>
                            <?php }?>
                            <optgroup label="<?= $group['name']?>">
                            <option value="<?= $group['grade_id']?>-0"><?= $this->lang->line('all_groups_in')?> <?= $group['name']?></option>
                            <?php $current_grade=$group['grade_id']; }?>
                        <?php if (!is_null($group['group_id'])){?>
                        <option value="<?= $group['grade_id']?>-<?= $group['group_id']?>"><?= $group['group_name']?></option>
                        <?php }?>
                    <?php } ?>
                    </select>
                </div>
                <div id="subjects_area">
                    <?php $this->load->view('gradebook/subjects');?>
                </div>
            </form>
            <br/>
            <?php if ((isset($semester['name'])) AND ($semester['is_active']=='1')){?>
            <a href="gradebook#students_list" class="btn btn-info" onclick="submit_form('#students_form')"><?= $this->lang->line('show_students')?></a>
            <?php }?>
            <button type="button" class="btn btn-small" style="margin-top: 2px;" onclick="$('#scale_details').toggle()"><?= $this->lang->line('show_scale')?></button>
        </div>
        <div class="span9">
            <br/>
            <div id="scores_save"></div>
            <div id="scale_details" style="display: none;" class="alert alert-info">
                <a class="close" onclick="$('#scale_details').hide();return false;"  href="#">&times;</a>
                <?php foreach($scale as $min=>$details){?>
                <span class="pull-left margin_right_10"><?= $min?> - <?= $details['max']?> &rarr; <b><?= $details['label']?></b> , </span>
                <?php }?>
                <div class="clearfix"></div>
            </div>
            <div id="save_result"></div>
        </div>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>