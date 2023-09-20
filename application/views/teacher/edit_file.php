<script>
    var groups,students;
    $('document').ready(function(){
        groups =  $('#groups').magicSuggest(magic_suggest_options({data:'library/find_groups',name:'groups_list'}));
        <?php if ($item['access_type']=='groups'){?>
        groups.addToSelection(<?= $item['access']?>);
        <?php }?>
        
        students = $('#students').magicSuggest(magic_suggest_options({data:'library/find_student',name:'students_list'}));        
        <?php if ($item['access_type']=='students'){?>
        students.addToSelection(<?= $item['access']?>);
        <?php }?>
    })
    
    function toggle_type(new_type)
    {
        $('#access_type').val(new_type);
        $('.type_area').toggleClass('hide');
        (new_type=='students')?groups.clear(true):students.clear(true);
    }
    
    function save_item()
    {
        if ((!$("#is_public").is(':checked')) && (groups.getSelectedItems().length==0) && (students.getSelectedItems().length==0))
        {
            $("#save_result").html('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('one_type')?></div>');
            return false;
        }
        upload_item('#item_form');
    }
    
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_file')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="library/save_file" method="POST" id="item_form">
            <input type="hidden" name="item_id" id="item_id" value="<?= $item['item_id']?>">
            <div class="control-group">
                <span id="file_name_area" class="wrapword"><?= $item['item_file']?></span>
                <label for="file_name"><?= $this->lang->line('file')?><sup class="mandatory">*</sup></label>
                <input type="file" name="file_name" id="file_name" class="span12">
                <div class="well" style="margin-bottom: 0;font-size: 14px;">
                    <?= $this->lang->line('allowed_files')?>: <?= implode(', ',$allowed_files)?>
                    <br/> <?= $this->lang->line('max_file_size')?>: <?= $max_file_size?>
                </div>
            </div>
            <div class="control-group">
                <label><?= $this->lang->line('access_for')?><sup class="mandatory">*</sup></label>
                <label>
                    <input type="checkbox" name="is_public" id="is_public" <?= (is_null($item['access_type'])?'checked="checked"':'')?> onclick="$('#access').toggleClass('hide')"><?= $this->lang->line('for_all')?>
                </label>
            </div>
            <div id="access" <?= (is_null($item['access_type'])?'class="hide"':'')?>>
                <div class="control-group">
                    <label><?= $this->lang->line('can_download')?></label>
                    <div class="btn-group" data-toggle="buttons-radio" style="margin-bottom: 15px;">
                        <input type="hidden" name="access_type" id="access_type" value="<?= (is_null($item['access_type'])?'groups':$item['access_type'])?>">
                        <button type="button" class="btn <?= (($item['access_type']=='groups') OR (is_null($item['access_type'])))?'active':''?>" onclick="toggle_type('groups')"><?= $this->lang->line('groups')?></button>
                        <button type="button" class="btn <?= ($item['access_type']=='students')?'active':''?>" onclick="toggle_type('students')"><?= $this->lang->line('students')?></button>
                    </div>
                </div>
                <div class="control-group <?= (($item['access_type']!='groups') OR (is_null($item['access_type'])))?'hide':''?> type_area" id="groups_area">
                    <input type="text" name="groups" id="groups">
                </div>
                <div class="control-group <?= ($item['access_type']!='students')?'hide':''?> type_area" id="students_area">
                    <input type="text" name="students" id="students">
                </div>
            </div>
            <div class="control-group">
                <label for="description"><?= $this->lang->line('description')?></label>
                <textarea rows="2" class="span12" maxlength="400" name="description" id="description"><?= $item['item_description']?></textarea>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="save_item()" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>