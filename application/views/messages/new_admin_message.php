<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('new_message'),'forms'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'messages'))?>
<script>
    var persons={students:false,parents:false,teachers:false};
    $('document').ready(function(){
        persons.students = $('#students').magicSuggest(magic_suggest_options({data:'students/find_student',name:'students_list'}));
        
        persons.parents = $('#parents').magicSuggest(magic_suggest_options({data:'parents/find_parent',name:'parents_list'}));
        
        persons.teachers = $('#teachers').magicSuggest(magic_suggest_options({data:'teachers/find_teacher',name:'teachers_list'}));
        
        $(".all_persons").click(function(){
            persons[$(this).attr('person_type')].clear(true);
            if ($(this).is(':checked'))
            {
                persons[$(this).attr('person_type')].addToSelection([{'id':'all','name':'<?= $this->lang->line('all')?>'}]);
                persons[$(this).attr('person_type')].disable();
            }
            else
            {
                persons[$(this).attr('person_type')].enable();
            }
            persons[$(this).attr('person_type')].collapse();
        });
    })
    
    function send_message()
    {
        if ((persons.students.getSelectedItems().length==0) && (persons.parents.getSelectedItems().length==0) && (persons.teachers.getSelectedItems().length==0))
        {
            $("#save_result").html('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('one_recipient')?></div>');
            return false;
        }
        
        submit_form('#send_message_form');
    }
</script>
<style>
    hr{margin-bottom: 10px;}
</style>
<header>
    <h2><?= $this->lang->line('new_message')?></h2>
</header>
<section>
    <article>
        <div id="save_result"></div>
        <form action="messages_center/send_message" method="POST" id="send_message_form">
            <div class="span1">
                <label><?= $this->lang->line('teachers')?>:</label>
            </div>
            <div class="span11">
                <div class="span9"><input type="text" id="teachers" name="teachers"></div>
                <div class="span3"><label><input type="checkbox" class="all_persons" person_type="teachers" name="to_all_teachers"><?= $this->lang->line('to_all_teachers')?></label></div>
            </div>
            <div class="clearfix"></div>
            <hr/>
            <div class="span1" style="margin-left: 0">
                <label><?= $this->lang->line('parents')?>:</label>
            </div>
            <div class="span11">
                <div class="span9"><input type="text" id="parents" name="parents"></div>
                <div class="span3"><label><input type="checkbox" class="all_persons" person_type="parents" name="to_all_parents"><?= $this->lang->line('to_all_parents')?></label></div>
            </div>
            <div class="clearfix"></div>
            <hr/>
            <div class="span1" style="margin-left: 0;">
                <label><?= $this->lang->line('students')?>:</label>
            </div>
            <div class="span11">
                <div class="span9"><input type="text" id="students" name="students"></div>
                <div class="span3"><label><input type="checkbox" class="all_persons" person_type="students" name="to_all_students"><?= $this->lang->line('to_all_students')?></label></div>
            </div>
            <div class="clearfix"></div>
            <hr/>
            <div class="control-group">
                <label for="subject"><?= $this->lang->line('subject')?><sup class="mandatory">*</sup></label>
                <input type="text" name="subject" id="subject" class="span6 required" maxlength="200">
            </div>
            <div class="control-group">
                <label for="message"><?= $this->lang->line('message')?><sup class="mandatory">*</sup></label>
                <textarea id="message" name="message" class="span6 required" rows="4"></textarea>
            </div>
            <button type="button" class="btn btn-info" onclick="send_message()"><?= $this->lang->line('send_message')?></button>
        </form>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>