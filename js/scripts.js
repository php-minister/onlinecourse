var current_table,config,lang;
var show_deleted=false;
var current_teacher=0;

function ajax_query(link,target,callback,entity_id){
    entity_id=entity_id||0;
    callback=callback||"";
    block_screen();
    $.ajax({
        url:link,
        success:function(html){
            if(target){
                $("#"+target).html(html)
            }
            if(callback!=""){
                callback.call(null,html);
            }
            free_screen();
        },
        error:function(response){
            show_error_message(response.responseText)
        }
   });
}

function delete_row(entity_id,message){ 
    message=message||"";
    
    if ($('.modal-header').length>0)
    {
        $("#waiting_for_response").modal("hide");
    }
    
    if (entity_id>0)
    {
        var row = $(current_table.selector+' tbody tr[entity_id='+entity_id+']').get(0);
        current_table.fnDeleteRow(current_table.fnGetPosition(row));    
    }
    else
    {
        current_table.fnDeleteRow(0,null,true);
    }
        
    if(message){
        show_message(message)
    } 
    
    free_screen();
}

function block_screen(){
    $('<div class="ui-widget-overlay" id="block_screen_overlay" style="z-index:9999"><h1 style="padding-top:25%;padding-left:50%;margin-left:-50px" class="text-info">'+lang.processing+'<br/><img src="images/ajax-loader.gif" /></h1></div>').appendTo("body");
    $(".ui-widget-overlay").height($(document).height())
}

function free_screen(){
    $("#block_screen_overlay").remove()
}

function show_error_message(message){
    $("#waiting_for_response").html('<div  class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a>'+message+'</div>').show();
    free_screen();
}

function show_message(message){
    $("#waiting_for_response").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>'+message+'</div>').show();
    free_screen();
}

function waiting_for_response(){
  $("#waiting_for_response").html('<img src="images/ajax-loader.gif" />').show();  
}

function change_validation_position(form_selector)
{
    $(form_selector).validate({
        errorPlacement:function(error, element){
            element.parent().find('.help-block').remove();
            element.parent().toggleClass('error',error.html().length!=0);  
            if (error.html().length!=0){
                element.after('<label class="help-block error">'+error.html()+'</label>');    
            }
        },
        success:function(element){}
    });
}

function submit_form(form_selector,target)
{
    target= target || "#save_result";    
	
    $(target).html('<img src="images/ajax-loader.gif" />');
    change_validation_position(form_selector);    	
	    
    $(form_selector).ajaxSubmit({
        beforeSubmit:function(arr,$form){
            if ($($form).valid()==true)
            {
	if(form_selector == '#make_donation_form')
	{
		$('#donation_container').css("margin-top" , '65px');
	}
                return true;
            }
			
            $(target).html('');
            return false;
        },
        target:target
    }); 
}

function init_avatar_actions()
{
  $("#user_avatar").change(function(){
       $("#save_result").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>'+lang.update_photo+'</div>');
       $("#avatar_upload_area").hide();
       $("#remove_photo").show();
       $("#delete_photo").val(0);
    })
    
    $("#remove_photo").click(function(){
        $("#avatar_upload_area").show();
        $("#remove_photo").hide();
        $("#user_avatar").val('');
        $("#user_avatar_image").css('background-image','url("'+config.base_url+'images/no_avatar.jpg")');
        $("#delete_photo").val(1);
    })  
}

function save_person(person_type)
{
    $("#save_result").html('<img src="images/ajax-loader.gif" />');
    change_validation_position('#person_form');
    $('#person_form').ajaxSubmit({
        beforeSubmit:function(arr,$form){
            if ($($form).valid()==true)
            {
                return true;
            }
            $("#save_result").html('');
            return false;
        },
        dataType:'json',
        success:function(data){

            if (data.error_message)
            {
               $("#save_result").html('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a>'+data.error_message+'</div>');
               return ;
            }
            
            $("#save_result").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>'+((data.result===true)?lang.updated:lang.saved)+'</div>');
            
            if (!isNaN(parseFloat(data.result)) && isFinite(data.result))
            {
                $("#"+person_type+"_id").val(data.result);
            }
            
            if (data.photo)
            {
                $("#user_avatar_image").css('background-image','url("'+config.base_url+data.photo+'")');
                $("#user_avatar").val('');
            }
            $("#delete_photo").val(0);
            current_table.fnDraw();
        }
    });
}

function resend_invitation(id,type)
{
    $("#save_result").html('<img src="images/ajax-loader.gif" />');
    $.ajax({
        url:type+'/resend_invitation/'+id,
        success:function(html){
            $("#save_result").html(html);
        }
    })
}

function change_status(id,type,status)
{
    if (confirm(lang.change_status))
    {
        $("#save_result").html('<img src="images/ajax-loader.gif" />');
        $.ajax({
            url:type+'/change_status/'+status+'/'+id,
            success:function(html){
                delete_row(0,'Status changes');
            }
        })
    }
}

function restore_person(id,type)
{
    $("#save_result").html('<img src="images/ajax-loader.gif" />');
    $.ajax({
        url:type+'/change_status/restore/'+id,
        dataType:'json',
        success:function(data){
           if (data.error_message)
           {
               $("#save_result").html('<div class="alert alert-error">'+data.error_message+'</div>');    
           }
           else
           {
               delete_row(0,data.message);
           }
        }
    })
}

function load_classrooms(user_type)
{
   user_type = user_type || 'admin';
    
   $("#save_result").html('<img src="images/ajax-loader.gif" />');
   $.post('public_scheduling/find_free_classroom',{start_date:$("#start_date").val(),lesson_start:$("#lesson_start").val(),lesson_end:$("#lesson_end").val(),teacher_id:$("#teacher_id").val(), grade:$("#grade").val(),user_type:user_type},function(html){
       $("#save_result").html(html);
   });
}

function load_grades(grades,active_grade,active_group)
{
    active_grade = active_grade || 0;
    active_group = active_group || 0;
    
    $("#grade").html('');
    for(var index in grades)
    {
       groups=grades[index]['groups'].split(',');
       groups_txt='';
       if (groups!='')
       {
           for(var group_index in groups)
           {
               group=groups[group_index].split('|');
               groups_txt+='<option value="'+grades[index]['id']+'-'+group[0]+'" '+(((grades[index]['id']==active_grade) && (group[0]==active_group))?'selected="selected"':'')+'>'+group[1]+'</option>';
           }
       }
        
       $("#grade").append('<optgroup label="'+grades[index]['name']+'"><option value="'+grades[index]['id']+'-0" '+(((grades[index]['id']==active_grade) && (active_group==0))?'selected="selected"':'')+'>'+lang.all_groups+' '+grades[index]['name']+'</option>'+groups_txt+'</optgroup>');
    }
}

function load_groups(groups,active_group)
{
    active_group = active_group || 0;
    
    $("#group").html('');
    $("#group").append('<option value="0">'+lang.without_group+'</option>');
    for(var index in groups)
    {
        $("#group").append('<option value="'+groups[index]['id']+'" '+(active_group==groups[index]['id']?'selected="selected"':'')+'>'+groups[index]['name']+'</option>');
    }
}

function show_teacher_lessons(teacher_id,past_lessons)
{
    if ((current_teacher==teacher_id) && past_lessons==false)
    {
       return ;
    }
    current_teacher=teacher_id;
    $("#teachers_list li").removeClass('active');
    $("#teachers_list li[teacher_id="+teacher_id+"]").addClass('active');
    block_screen();
    $.ajax({
        url:'scheduling/teacher_lessons/'+teacher_id+'/'+past_lessons,
        dataType:'json',
        success:function(lessons){
            $('#teacher_calendar').fullCalendar('removeEvents');
            $('#teacher_calendar').fullCalendar('addEventSource',lessons);
            free_screen();
        }
    })
}

function remove_lesson(lesson_id)
{
    if (confirm(lang.delete_lesson))
    {
        $("#save_result").html('<img src="images/ajax-loader.gif" />');
        $.post('public_scheduling/remove_lesson/'+lesson_id,{user_type:$("#user_type").val()},function(html){$("#save_result").html(html);});
    }
}

function get_date_grades(date,user_type)
{
    user_type= user_type || 'admin';
    
    $("#save_result").html('<img src="images/ajax-loader.gif" />');
    $.ajax({
        url:(user_type=='admin'?'attendance/get_date_grades/':'teacher/get_date_grades/')+date.replace(/\//g,'-'),
        success:function(html){
           $("#grades_subjects_area").html(html);
           $("#save_result").html('');
           $('select#grade')
                .popover({placement:'right',trigger:'focus'})
                .popover('show');
        }
    })
}

function get_subjects(date,grade_id,user_type)
{
    user_type = user_type || 'admin';
    
    $('select#grade').popover('destroy');
    $("#save_result").html('<img src="images/ajax-loader.gif" />');
    $.ajax({
        url:(user_type=='admin'?'attendance/get_subjects/':'teacher/get_subjects/')+date.replace(/\//g,'-')+'/'+grade_id,
        success:function(html){
           $('#subjects_area').html(html);
           $("#save_result").html('');
           $('select#subject')
                .popover({placement:'right',trigger:'manual'})
                .popover('show');
        }
    })
}

function change_attendance_status(new_status,lesson_id,student_id,user_type)
{
    user_type = user_type || 'admin';
    
    waiting_for_response();
    $.ajax({
        url:(user_type=='admin'?'attendance/set_status/':'teacher/set_attendance_status/')+new_status+'/'+lesson_id+'/'+student_id,
        dataType:'json',
        success:function(data){
            if (data.error_message)
            {
                show_error_message(data.error_message);
                return ;
            }
            show_message(lang.status_changed);
            $('tr[student_id="'+student_id+'"]').attr('status_id',new_status);
            
            row = $('tbody tr[student_id='+student_id+']').get(0);
            
            current_table.fnUpdate(current_table.fnGetData(row)[2].replace(/<button class="btn btn-mini disabled btn-info">.*?<\/button>/gi,'<button class="btn btn-mini disabled btn-info">'+attendance_statuses[new_status]+'<\/button>'),row,2);
        }
    })
}

function magic_suggest_options(new_options)
{
    return $.extend({expandOnFocus:true,maxDropHeight:80,hideTrigger:true,maxSelection:10},new_options);
}

function add_scale_value()
{
    scales++;
    $('.modal tbody').append('<tr><td class="control-group"><input type="text" name="min_value['+scales+']" class="required input-mini numeric" value="0" max="999"></td><td class="control-group"><input type="text" name="max_value['+scales+']" class="input-mini numeric" max="999"></td><td class="control-group"><input type="text" name="label['+scales+']" class="input-mini" maxlength="20"></td><td><button class="btn btn-mini" onclick="$(this).parent().parent().remove()"><i class="icon-remove"></i></button></td></tr>');
}

function add_gradebook_changes(set_id,student_id,value,label)
{
    if (typeof(changes[set_id])!='object')
    {
        changes[set_id]={};
    }
    changes[set_id][student_id]=value;
    $('#label_'+set_id+'_'+student_id)
        .html(label)
        .attr('title',label); 
}

function private_lesson()
{
    $('.private_lesson').toggleClass('hide');
    $('#is_private').val($('#is_private').val()=='false'?true:false);
}

function upload_item(item_form)
{
    $("#save_result").html('<img src="images/ajax-loader.gif" />');
    change_validation_position(item_form);
    
    $(item_form).ajaxSubmit({
        beforeSubmit:function(arr,$form){
            if ($($form).valid()==true)
            {
                return true;
            }
            $("#save_result").html('');
            return false;
        },
        dataType:'json',
        success:function(data){
            if (data.error_message)
            {
               $("#save_result").html('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a>'+data.error_message+'</div>');
               return ;
            }
            
            $("#save_result").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a>'+((data.result===true)?lang.updated:lang.saved)+'</div>');
            
            if (!isNaN(parseFloat(data.result)) && isFinite(data.result))
            {
                $("#item_id").val(data.result);
                row = current_table.fnAddData([data.result,data.item_name,data.uploaded,data.actions]);
                oSettings = current_table.fnSettings();
                oSettings.aoData[row[0]].nTr.setAttribute('entity_id',data.result);
            }
            else
            {
                row = $('tbody tr[entity_id='+$('#item_id').val()+']').get(0);
                current_table.fnUpdate(data.item_name,row,1);
                current_table.fnUpdate(data.uploaded,row,2);
            }
            
            $("#file_name_area").html(data.file_name);
            $("#file_name").val('');
        }
    });
}