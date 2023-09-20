<?php $this->load->view('layout/header',array('page_title'=>'Install','forms'=>TRUE));?>
<div class="container">
    <div>
        <div>
            <header>
                <h2>Installing</h2>
            </header>
            <section>
                <article>
                    <div id="save_result"></div>
                    <form action="install/save_config" method="POST" id="save_config_form">
                         <fieldset>
                            <legend>Database connection options</legend>
                            <div class="clearfix"></div>
                            <div class="control-group pull-left margin_right_10">
                                <label for="database_host">Database host<sup class="mandatory">*</sup></label>
                                <input type="text" id="database_host" name="database_host" class="required">
                            </div>
                            <div class="control-group pull-left">
                                <label for="database_name">Database name<sup class="mandatory">*</sup></label>
                                <input type="text" name="database_name" id="database_name" class="required" class="required">
                            </div>
                            <div class="clearfix"></div>
                            <div class="control-group pull-left margin_right_10">
                                <label for="database_user">Database user<sup class="mandatory">*</sup></label>
                                <input type="text" name="database_user" id="database_user" class="required">
                            </div>
                            <div class="control-group pull-left">
                                <label for="database_password">Database password<sup class="mandatory">*</sup></label>
                                <input type="password" name="database_password" id="database_password" class="required">
                            </div>
                            <div class="clearfix"></div>
                         </fieldset>
                         <fieldset>
                            <legend>Admin password</legend>
                            <div class="clearfix"></div>
                            <div class="control-group pull-left margin_right_10">
                                <label for="admin_password">Password<sup class="mandatory">*</sup></label>
                                <input type="password" name="admin_password" id="admin_password" class="required">
                            </div>
                            <div class="control-group pull-left">
                                <label for="admin_password_again">Password again<sup class="mandatory">*</sup></label>
                                <input type="password" name="admin_password_again" id="admin_password_again" class="required" equalTo="#admin_password">
                            </div>
                         </fieldset>
                         <fieldset>
                            <legend>School</legend>
                            <div class="clearfix"></div>
                            <div class="control-group pull-left margin_right_10">
                                <label for="school_name">School name<sup class="mandatory">*</sup></label>
                                <input type="text" name="school_name" id="school_name" maxlength="100" class="required">
                            </div>
                            <div class="control-group pull-left">
                                <label for="base_url">Applicaion url<sup class="mandatory">*</sup></label>
                                <input type="text" name="base_url" id="base_url" value="<?= $this->config->item('base_url')?>" class="required input-xlarge">
                            </div>
                         </fieldset>
                    </form>
                    <br/><button class="btn btn-info" onclick="submit_form('#save_config_form')">Install</button>
                </article>
            </section>            
<?php $this->load->view('layout/footer');?>