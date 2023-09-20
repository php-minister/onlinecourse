<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('import'),'forms'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'settings'))?>
<header>
    <h2><?= $this->lang->line('import_data')?></h2>
</header>
<section>
    <article>
        <div class="span3">
            <form action="import/import_file" id="import_file" method="POST" enctype="multipart/form-data">
                <div class="control-group">
                    <label for="data_type"><?= $this->lang->line('data_type')?><sup class="mandatory">*</sup></label>
                    <select id="data_type" name="data_type" class="required" onchange="$('#save_result').html('')">
                        <option value="students"><?= $this->lang->line('students')?></option>
                        <option value="parents"><?= $this->lang->line('parents')?></option>
                        <option value="teachers"><?= $this->lang->line('teachers')?></option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="import_file"><?= $this->lang->line('file')?><sup class="mandatory">*</sup></label>
                    <input type="file" name="import_file" id="import_file" class="required span12">
                </div>
                <div class="control-group">
                    <b><?= $this->lang->line('csv_options')?></b>
                    <div class="clearfix"></div>
                    <div class="pull-left margin_right_10 control-group span4">
                        <label for="csv_delimiter"><?= $this->lang->line('delimiter')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="csv_delimiter" id="csv_delimiter" class="required input-mini" value="," maxlength="1">
                    </div>
                    <div class="pull-left margin_right_10 control-group span4">
                        <label for="csv_enclosure"><?= $this->lang->line('enclosure')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="csv_enclosure" id="csv_enclosure" class="required input-mini" value='"' maxlength="1">
                    </div>
                    <div class="pull-left control-group span4">
                        <label for="csv_escape"><?= $this->lang->line('escape')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="csv_escape" id="csv_escape" class="required input-mini" value="\" maxlength="1">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="control-group">
                    <label>
                        <input type="checkbox" name="skip_first_line"><?= $this->lang->line('skip_data_from_first_line')?>
                    </label>
                </div>
                <div>
                    <br/><button type="button" class="btn btn-info" onclick="submit_form('#import_file')"><?= $this->lang->line('import')?></button>
                </div>
            </form>
        </div>
        <div class="span9">
            <br/>
            <div id="save_result"></div>
        </div>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>