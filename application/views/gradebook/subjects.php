<script>
    $('document').ready(function(){
        $("#subject_id").change(function(){
            ajax_query('gradebook/get_sets/'+$('#group_id').val()+'/'+$(this).val(),'assignmets_area');
        })
    })
</script>
<div class="control-group">
    <label for="subject_id"><?= $this->lang->line('subject')?><sup class="mandatory">*</sup></label>
    <select id="subject_id" name="subject_id" class="required">
        <?php foreach($subjects as $subject){?>
        <option value="<?= $subject['subject_id']?>"><?= $subject['name']?></option>
        <?php }?>
    </select>
</div>
<div class="control-group" id="assignmets_area" style="margin-top: 10px;">
    <?php $this->load->view('gradebook/assignments') ?>
</div>