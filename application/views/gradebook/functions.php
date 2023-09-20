$(document).on('click','.pagination a',function(){
     $("#scores_save").html('');
     if ($(this).attr('page_id')==0)
     {
         return false;
     }
     
     if ((changed) && (confirm('<?= $this->lang->line('scores_changed__do_you_want_to_save_them_')?>')))
     {
         save_scores();
     }
     changed=false;
     changes={};
     $("#student_page").val($(this).attr('page_id'));
     <?php if ((isset($semester['name'])) AND ($semester['is_active']=='1')){?>
     submit_form('#students_form');
     <?php }?>
     return false;
 });
 
 $(document).on('change','#gradebook_table input',function(){
      changed=true;
      details=$(this).attr('id').split('_');
      var value=parseFloat($(this).val());
      if ((!(typeof(value) === 'number')) || (isNaN(value)))
      {
          alert('<?= $this->lang->line('only_digits_allowed')?>');
          $(this).focus().select();
          return false;
      }
      if (scale.length==0)
      {
          add_gradebook_changes(details[1],details[2],value,'');
          return true;
      }
      
      for(var min in scale)
      {
          if ((parseFloat(min)<=value) && ((parseFloat(scale[min].max)+1)>value))
          {
              add_gradebook_changes(details[1],details[2],value,scale[min].label);
              return true;
          }
      }
      add_gradebook_changes(details[1],details[2],value,(value>0)?scale[min].label:'');
 });