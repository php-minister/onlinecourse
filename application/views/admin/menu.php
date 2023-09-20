<script>
    lang={
        processing:'<?= $this->lang->line('processing')?>',
        update_photo:'<?= $this->lang->line('update_photo')?>',
        updated:'<?= $this->lang->line('updated')?>',
        saved:'<?= $this->lang->line('saved')?>',
        change_status:'<?= $this->lang->line('change_status')?>',
        all_groups:'<?= $this->lang->line('all_groups')?>',
        without_group:'<?= $this->lang->line('without_group')?>',
        delete_lesson:'<?= $this->lang->line('delete_lesson')?>',
        status_changed:'<?= $this->lang->line('status_changed')?>',
        no_comments:'<?= $this->lang->line('no_comments')?>'
    }
</script>
<nav>
  <div class="navbar navbar-inverse navbar-static-top">
   <div class="navbar-inner">
     <div class="container-fluid">
       <img src="images/logo.png" class="brand">
        <ul class="nav" id="main_menu">
            
            <li <?= ($active_menu=='dashboard'?'class="active"':'')?>>
                <a href="admin">
                    <i class="fontello-wallet"></i>
                    <span class="hidden-phone">Dashboard</span>
                </a>
            </li>          
          <?php if ($this->admin_actions->is_allowed('teachers')){?>  
          <li class="dropdown <?= ($active_menu=='teachers')?'active':''?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="teachers">
                <i class="fontello-users-1"></i>
                <span class="hidden-phone"><?= $this->lang->line('teachers')?></span>
                <b class="caret"></b>
            </a> 
            <ul class="dropdown-menu">
                <li><a href="teachers"><?= $this->lang->line('teachers')?></a></li>
                <li><a href="subjects"><?= $this->lang->line('subjects')?></a></li>
            </ul>
          </li>
          <?php }?>
          
          <?php if ($this->admin_actions->is_allowed('students')){?>
          <li class="dropdown <?= ($active_menu=='students'?'active':'')?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="sudents">
                <i class="fontello-graduation-cap"></i>
                <span class="hidden-phone"><?= $this->lang->line('students')?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="students"><?= $this->lang->line('students')?></a></li>
                <li><a href="parents"><?= $this->lang->line('parents')?></a></li>
                <li><a href="donors"><?= $this->lang->line('donors')?></a></li>
                <li class="divider"></li>
                <li><a href="attendance"><?= $this->lang->line('attendance')?></a></li>
                <li><a href="incidents"><?= $this->lang->line('incidents')?></a></li>
                <li class="divider"></li>
                <li><a href="students_groups"><?= $this->lang->line('groups')?></a></li>
                <li class="divider"></li>
                <li><a href="content/library"><?= $this->lang->line('library')?></a></li>
            </ul>
          </li>
          <?php }?>
          
          <?php if (($this->admin_actions->is_allowed('students')) OR ($this->admin_actions->is_allowed('fees')) OR ($this->admin_actions->is_allowed('teachers'))){?>
          <li class="dropdown <?= ($active_menu=='reports'?'active':'')?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="reports">
                <i class="fontello-chart-bar"></i>
                <span class="hidden-phone"><?= $this->lang->line('reports')?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <?php if ($this->admin_actions->is_allowed('students')){?>
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="reports/students_attendance"><?= $this->lang->line('students')?></a>
                    <ul class="dropdown-menu">
                        <li><a href="reports/students_attendance"><?= $this->lang->line('attendance')?></a></li>   
                    </ul>
                </li>
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('fees')){?>
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#"><?= $this->lang->line('fees')?></a>
                    <ul class="dropdown-menu">
                        <li><a href="reports/payments"><?= $this->lang->line('payments')?></a></li>
                        <li><a href="reports/donations"><?= $this->lang->line('donations')?></a></li>
                        <li><a href="reports/donated"><?= $this->lang->line('donated')?></a></li>
                    </ul>
                </li>
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('teachers')){?>
                <li><a href="reports/teachers_feedback"><?= $this->lang->line('teacher_feedbacks')?></a></li>
                <?php }?>
                <li><a href="reports/donors_report"><?= $this->lang->line('donors')?></a></li>
            </ul>
          </li>
          <?php }?>
          <?php if ($this->admin_actions->is_allowed('settings') OR $this->admin_actions->is_allowed('teachers') OR $this->admin_actions->is_allowed('fees') OR ($this->admin_actions->is_allowed('registrations'))){?>
          <li class="dropdown <?= ($active_menu=='school')?'active':''?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="school"> 
                <i class="fontello-building"></i>
                <span class="hidden-phone"><?= $this->lang->line('school')?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <?php if ($this->admin_actions->is_allowed('settings')){?>
<!--                <li><a href="classrooms"><?= $this->lang->line('classrooms')?></a></li>
                <li><a href="semesters"><?= $this->lang->line('semesters')?></a></li>
-->                <?php }?>
                <?php if ($this->admin_actions->is_allowed('settings') AND $this->admin_actions->is_allowed('teachers')){?>
               <!-- <li class="divider"></li>-->
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('teachers')){?>
               <!-- <li><a href="gradebook"><?= $this->lang->line('gradebook')?></a></li>-->
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('teachers') AND $this->admin_actions->is_allowed('fees')){?>
                <!--<li class="divider"></li>-->
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('fees')){?>
                <li><a href="fees"><?= $this->lang->line('fees')?></a></li>
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('fees') AND $this->admin_actions->is_allowed('registrations')){?>
                <li class="divider"></li>
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('registrations')){?>
                <li><a href="registrations"><?= $this->lang->line('registrations')?></a></li>
                <?php }?>
            </ul>
          </li>
          <?php }?>
          
          <?php if ($this->admin_actions->is_allowed('users')){?>
          <li class="dropdown <?= ($active_menu=='users')?'active':''?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="users">
                    <i class="fontello-users"></i>
                    <span class="hidden-phone"><?= $this->lang->line('users')?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="users/staff"><?= $this->lang->line('staff')?></a></li>
                </ul>
          </li>
          <?php }?>

          <?php if ($this->admin_actions->is_allowed('settings') OR $this->admin_actions->is_allowed('import')){?>
          <li class="dropdown <?= ($active_menu=='settings')?'active':''?>">
            <a class="dropdown-toggle" data-toggle="dropdown" href="settings"> 
                <i class="fontello-cog"></i>
                <span class="hidden-phone"><?= $this->lang->line('settings')?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <?php if ($this->admin_actions->is_allowed('settings')){?>
                <li><a href="settings/global_settings" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('global_settings')?></a></li>
                <li><a href="settings/school_info" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('school_info')?></a></li>
                <li><a href="settings/scale" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('grading_scale')?></a></li>
                <li><a href="settings/grades" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('grades')?></a></li>
                <li class="divider"></li>
                <li><a href="settings/email" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('email_settings')?></a></li>
                <li><a href="settings/email_templates"><?= $this->lang->line('email_templates')?></a></li>
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('settings') AND $this->admin_actions->is_allowed('import')){?>
                <li class="divider"></li>
                <?php }?>
                <?php if ($this->admin_actions->is_allowed('import')){?>
                <li><a href="import"><?= $this->lang->line('import_data')?></a></li>
                <?php }?>
            </ul>
          </li>
          <?php }?>
        </ul>
        <ul class="nav pull-right">
          <?php if ($this->admin_actions->is_allowed('messages_center')){?>  
          <li class="<?= ($active_menu=='messages')?'active':''?>">
            <a href="messages_center">
                <i class="fontello-mail-alt"></i>
            </a>
          </li>
          <?php }?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $this->lang->line('hi')?> <?= $this->session->userdata('admin_name')?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="admin/new_password" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('change_password')?></a></li>
                <li><a href="admin/logout"><?= $this->lang->line('logout')?></a></li>
            </ul>
          </li>
        </ul>
     </div>
   </div>
  </div>
</nav>
 <div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="clearfix"></div>
            <div id="waiting_for_response">
                <?php if (isset($language_error)){?>
                <div class="alert alert-error"><?= $this->lang->line('error_languge_missed')?><a class="close" data-dismiss="alert" href="#">&times;</a></div>
                <?php }?>
            </div>