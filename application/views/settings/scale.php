<script>var scales=<?= count($scale)?>;</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('edit_scale')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="settings/save_scale" method="POST" id="scale_form">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?= $this->lang->line('min_value')?><sup class="mandatory">*</sup></th>
                        <th><?= $this->lang->line('max_value')?></th>
                        <th><?= $this->lang->line('grade')?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $index=0;
                    foreach($scale as $min=>$value){
                    $index++;
                    ?>
                    <tr>
                        <td class="control-group">
                            <input type="text" name="min_value[<?= $index?>]" class="required input-mini numeric" value="<?= $min?>" max="999">
                        </td>
                        <td class="control-group">
                            <input type="text" name="max_value[<?= $index?>]" class="input-mini numeric" value="<?= $value['max']?>" max="999">
                        </td>
                        <td class="control-group">
                            <input type="text" name="label[<?= $index?>]" class="input-mini" maxlength="20" value="<?= $value['label']?>">
                        </td>
                        <td>
                            <button class="btn btn-mini" onclick="$(this).parent().parent().remove()" title="Delete"><i class="icon-remove"></i></button>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <button type="button" class="btn btn-success" onclick="add_scale_value()"><?= $this->lang->line('add_scale_value')?></button>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#scale_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>