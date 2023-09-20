<script>
    lang={
        processing:'<?= $this->lang->line('processing')?>',
        updated:'<?= $this->lang->line('updated')?>',
        saved:'<?= $this->lang->line('saved')?>',
        all_groups:'<?= $this->lang->line('all_groups')?>',
        delete_lesson:'<?= $this->lang->line('delete_lesson')?>',
        no_comments:'<?= $this->lang->line('no_comments')?>',
        status_changed:'<?= $this->lang->line('status_changed')?>',
    }
</script>
<nav>
  <div class="navbar navbar-inverse navbar-static-top">
   <div class="navbar-inner">
     <div class="container-fluid">
       <img src="images/logo.png" class="brand">
        
        <ul class="nav" id="main_menu">
            <li <?= ($active_menu=='teacher'?'class="active"':'')?>>
                <a href="teacher">
                    <i class="fontello-calendar"></i>
                    <span class="hidden-phone"><?= $this->lang->line('scheduler')?></span>
                </a>
            </li>
            <?php if ($settings['teacher_manage_incidents']=='on'){?>
            <li <?= ($active_menu=='incidents'?'class="active"':'')?>>
                <a href="teacher/incidents">
                    <i class="fontello-attention"></i>
                    <span class="hidden-phone"><?= $this->lang->line('incidents')?></span>
                </a>
            </li>
            <?php }?>
            <?php if ($settings['teacher_manage_attendance']=='on'){?>
            <li <?= ($active_menu=='attendance')?'class="active"':''?>>
                <a href="teacher/attendance">
                    <i class="fontello-ok"></i>
                    <span class="hidden-phone"><?= $this->lang->line('attendance')?></span>
                </a>
            </li>
            <?php }?>
            <?php if ($settings['teacher_manage_gradebook']=='on'){?>
       <!--     <li <?= ($active_menu=='gradebook')?'class="active"':''?>>
                <a href="teacher/gradebook">
                    <i class="fontello-book"></i>
                    <span class="hidden-phone"><?= $this->lang->line('gradebook')?></span>
                </a>
            </li>-->
            <?php }?>
            <li <?= ($active_menu=='files'?'class="active"':'')?>>
                <a href="library">
                    <i class="fontello-download-cloud"></i>
                    <span class="hidden-phone"><?= $this->lang->line('my_files')?></span>
                </a>
            </li>
        </ul>
        <ul class="nav pull-right">
            <li <?= ($active_menu=='messages'?'class="active"':'')?>>
                <a href="messages" <?= ($messages>0)?('title="'.sprintf($this->lang->line('new_messages'),$messages).'"'):''?>>
                    <span class="fontello-mail-alt <?= ($messages>0)?' notifications':''?>"><b><?= ($messages>0)?$messages:''?></b></span>
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $this->lang->line('hi')?> <?= $this->session->userdata('name')?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="user/new_password" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('change_password')?></a></li>
                    <li><a href="user/logout"><?= $this->lang->line('logout')?></a></li>
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