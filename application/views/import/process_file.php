<?php
     $file_details_txt='<option value="skip">'.$this->lang->line('skip').'</option>';
     foreach($file_details as $name=>$examle)
     {
         $file_details_txt.='<option value="'.$examle['index'].'">'.trim(ucfirst($name),'"').' ('.$this->lang->line('example').': '.$examle['example'].')</option>';
     }
 ?>
<form action="import/process_file" id="process_file" method="POST">
    <input type="hidden" name="data_type" value="<?= $data_type?>">
    <input type="hidden" name="csv_delimiter" value="<?= $csv_delimiter?>">
    <input type="hidden" name="csv_enclosure" value='<?= $csv_enclosure?>'>
    <input type="hidden" name="csv_escape" value="<?= $csv_escape?>">
    <input type="hidden" name="skip_first_line" value="<?= $skip_first_line?>">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?= $this->lang->line('person_s_field')?></th>
                <th><?= $this->lang->line('column_from_file')?></th>
            </tr>
        </thead>
        <tbody>
             <?php foreach($fields as $field){?>
             <tr>
                <td><label for="<?= $field?>"><?= $this->lang->line($field)?></label></td>
                <td>
                    <select class="span12" id="<?= $field?>" name="field[<?= $field?>]"><?= $file_details_txt?></select>
                    <br/><i><?= $this->lang->line($field.'_desc')?></i>
                </td>
             </tr>
             <?php }?>
             <tr id="submit_button">
                <td colspan="2" style="text-align: center;">
                    <div id="save_result2"></div>
                    <button type="button" class="btn btn-info" onclick="submit_form('#process_file','#save_result2')"><?= $this->lang->line('process_file')?></button>
                </td>
             </tr>
        </tbody>
    </table>
</form>