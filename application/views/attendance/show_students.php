<script type="text/javascript">
  var  attendance_statuses=<?= json_encode($attendance)?>;
  $('document').ready(function(){
     $(".dynamicTable").on('click','.dropdown-toggle',function(){
        $("#attendance_statuses").remove();   
        options=$('<ul class="dropdown-menu" id="attendance_statuses">');
        current_status=$(this).parent().parent().parent().attr('status_id');
        current_student=$(this).parent().parent().parent().attr('student_id');
        <?php foreach($attendance as $id=>$name){?>
    
		if (current_status!=<?= $id?>)
        {
          options.append('<li><a href="#" onclick="change_attendance_status(<?= $id?>,<?= $lesson_id?>,current_student,\'<?= $user_type?>\');return false;"><?= $this->lang->line('attendance_'.$id)?></a></li>');
        }
        <?php }?>
        $(this).after(options);
     });
      
     current_table=$('.dynamicTable').dataTable({"sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>});
     <?php if ($user_type=='teacher'){?>
     $(".dataTables_wrapper").prepend('<div class="pull-left" id="reminder_buttons">'+
     '<button class="btn btn-info btn-small" onclick="toggle_buttons()"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_reminder')?></button>'+
     '<button class="btn btn-small btn-info hide" onclick="save_reminder()"><?= $this->lang->line('save')?></button>&nbsp;'+
     '<button class="btn btn-small hide" onclick="toggle_buttons()"><?= $this->lang->line('cancel')?></button>'+
     '</div>');
     <?php }?>
  });
  
  <?php if ($user_type=='teacher'){?>
  function save_reminder()
  {
      if ($("#reminder").val().length>0)
      {
          waiting_for_response();
          $.post('teacher/add_reminder/<?= $lesson_id?>',{reminder:$("#reminder").val()},function(){
              toggle_buttons();
              $("#reminder").val('');
              show_message('<?= $this->lang->line('added')?>');
          })
      }
  }
  
  function toggle_buttons()
  {
      $("#reminder_buttons .btn,#reminder").toggleClass('hide');
  }
  <?php }?>
</script>
<div class="clearfix" style="margin-top: 3px;"></div>

<textarea rows="2" class="span7 hide" id="reminder" name="reminder" style="margin-bottom: 5px;"></textarea>
<div class="clearfix"></div>
<table class="dynamicTable table-bordered table table-condensed table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th><?= $this->lang->line('student')?></th>
            <th><?= $this->lang->line('status')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($students as $student){?>
        <tr student_id="<?= $student['student_id']?>" status_id="<?= $student['status']?>">
            <td><?= $student['student_id']?></td>
            <td><?= $student['name']?></td>
            <td>
                <div class="btn-group margin_right_10 pull-left">
                  <button class="btn btn-mini disabled btn-info"><? if($student['status'] == 0){ echo "Select"; } else{ echo $attendance[$student['status']]; }?></button>
                  <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                </div>
                <div class="pull-left">
                    <a data-target="#waiting_for_response" data-toggle="modal" href="<?= ($user_type=='admin')?'attendance/set_comments/':'teacher/set_attendance_comments/'?><?= $lesson_id?>/<?= $student['student_id']?>" class="btn btn-mini"><i class="icon-comment"></i></a>
                </div>
                <div class="clearfix"></div>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>