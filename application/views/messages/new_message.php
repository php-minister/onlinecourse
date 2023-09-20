<?php if($this->session->userdata('person_type') == 'teacher'){?>
<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('new_message'),'forms'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php } else {?>
<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('new_message'),'forms'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php } ?>
<?php $this->load->view($this->session->userdata('person_type').'/menu',array('active_menu'=>'messages'))?>
<script>
    var persons={students:false,parents:false,teachers:false};
    $('document').ready(function(){
        persons.teachers = $('#teachers').magicSuggest(magic_suggest_options({data:'user/find_teacher',name:'teachers_list'}));
        
        <?php if (($this->session->userdata('person_type')=='teacher') OR ($this->session->userdata('person_type')=='parent')){?>
        persons.parents = $('#parents').magicSuggest(magic_suggest_options({data:'user/find_parent',name:'parents_list'}));
        <?php }?>
        
        <?php if ($this->session->userdata('person_type')=='teacher'){?>
        persons.students = $('#students').magicSuggest(magic_suggest_options({data:'user/find_student',name:'students_list'}));
        <?php }?>
        
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
        if (
            (persons.teachers.getSelectedItems().length==0)
            <?php if (($this->session->userdata('person_type')=='teacher') OR ($this->session->userdata('person_type')=='parent')){?>
            && (persons.parents.getSelectedItems().length==0)
            <?php }?>
            <?php if ($this->session->userdata('person_type')=='teacher'){?>
            && (persons.students.getSelectedItems().length==0)   
            <?php }?>
            && (!$("#to_admin").is(':checked'))
        )
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


    <h2><?= $this->lang->line('new_message')?></h2>

<section>
    <article>
        <div id="save_result"></div>
        <form action="messages/send_message" method="POST" id="send_message_form">
            <div class="span1">
                <label><?= $this->lang->line('teachers')?>:</label>
            </div>
            <div class="span11">
                <div class="span9"><input type="text" id="teachers" name="teachers"></div>
                <?php if ($this->session->userdata('person_type')=='teacher'){?>
                <div class="span3"><label><input type="checkbox" class="all_persons" person_type="teachers" name="to_all_teachers"><?= $this->lang->line('to_all_teachers')?></label></div>
                <?php }?>
            </div>
            <div class="clearfix"></div>
            <hr/>
            
            <?php if (($this->session->userdata('person_type')=='teacher') OR ($this->session->userdata('person_type')=='parent')){?>
            <div class="span1" style="margin-left: 0">
                <label><?= $this->lang->line('parents')?>:</label>
            </div>
            <div class="span11">
                <div class="span9"><input type="text" id="parents" name="parents"></div>
                <div class="span3"><label><input type="checkbox" class="all_persons" person_type="parents" name="to_all_parents"><?= $this->lang->line('to_all_parents')?></label></div>
            </div>
            <div class="clearfix"></div>
            <hr/>
            <?php }?>
            
            <?php if ($this->session->userdata('person_type')=='teacher'){?>
            <div class="span1" style="margin-left: 0;">
                <label><?= $this->lang->line('students')?>:</label>
            </div>
            <div class="span11">
                <div class="span9"><input type="text" id="students" name="students"></div>
                <div class="span3"><label><input type="checkbox" class="all_persons" person_type="students" name="to_all_students"><?= $this->lang->line('to_all_students')?></label></div>
            </div>
            <div class="clearfix"></div>
            <hr/>
            <?php }?>
            
            <div>
                <label>
                    <input type="checkbox" name="to_admin" id="to_admin"><?= $this->lang->line('message_to_admin')?>
                </label>
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
<?php if($this->session->userdata('person_type') == 'teacher'){?>
<?php $this->load->view('layout/footer') ?>
<?php } else{
	$this->load->view('layout/footer_web');
	}?>