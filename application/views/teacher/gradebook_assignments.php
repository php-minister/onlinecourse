<label for="assignment_id">
    <?= $this->lang->line('assignment')?><sup class="mandatory">*</sup>
    <a href="teacher/new_gradebook_set" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('new_assignment')?>"><i class="icon-plus"></i><?= $this->lang->line('new')?></a>
</label>
<select id="assignment_id" name="assignment_id" class="required">
    <?php foreach($sets as $set){?>
    <option value="<?= $set['set_id']?>"><?= $set['name'].', '.date('d M Y',strtotime($set['date']))?></option>
    <?php }?>
</select>
<div class="btn-group <?= (count($sets)==0?'hide':'')?>" id="edit_set_area" style="margin-top: 5px;">
    <a  class="btn btn-mini" title="Edit assignment" href="teacher/edit_gradebook_set/<?= (isset($sets[0]['set_id'])?$sets[0]['set_id']:0)?>" data-target="#waiting_for_response" data-toggle="modal"><i class="icon-edit"></i><?= $this->lang->line('edit')?></a>
    <button type="button" title="<?= $this->lang->line('remove_assignment')?>" onclick="remove_assigment(<?= (isset($sets[0]['set_id'])?$sets[0]['set_id']:0)?>)"  class="btn btn-mini"><i class="icon-remove"></i><?= $this->lang->line('delete')?></button>
</div>