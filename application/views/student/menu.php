<script>
    lang={
        processing:'<?= $this->lang->line('processing')?>'
    }
</script>
<nav>
  <div id="menu_bar" class="navbar navbar-inverse navbar-static-top">
   <div class="navbar-inner">
     <div class="container-fluid">
        <ul class="nav" id="main_menu">
            <li <?= ($active_menu=='scheduler'?'class="active"':'')?>>
                <a href="student">
                    <i class="fontello-calendar"></i>
                    <span class="hidden-phone"><?= $this->lang->line('scheduler')?></span>
                </a>
            </li>
            <li <?= ($active_menu=='incidents'?'class="active"':'')?>>
                <a href="student/incidents">
                    <i class="fontello-attention"></i>
                    <span class="hidden-phone"><?= $this->lang->line('incidents')?></span>
                </a>
            </li>
<!--            <li <?= ($active_menu=='gradebook'?'class="active"':'')?>>
                <a href="student/gradebook">
                    <i class="fontello-book"></i>
                    <span class="hidden-phone"><?= $this->lang->line('gradebook')?></span>
                </a>
            </li>-->
            <li <?= ($active_menu=='payments'?'class="active"':'')?>>
                <a href="payments">
                    <i class="fontello-wallet"></i>
                    <span class="hidden-phone"><?= $this->lang->line('payments')?></span>
                </a>
            </li>
            <li <?= ($active_menu=='library'?'class="active"':'')?>>
                <a href="student/library">
                    <i class="fontello-download-cloud"></i>
                    <span class="hidden-phone"><?= $this->lang->line('library')?></span>
                </a>
            </li>
        </ul>
        <ul class="nav pull-right">
            <li <?= ($active_menu=='messages'?'class="active"':'')?>>
                <a href="messages" <?= ($messages>0)?('title="'.sprintf($this->lang->line('new_messages'),$messages).'"'):''?>>
                    <span class="fontello-mail-alt <?= ($messages>0)?' notifications':''?>"><b><?= ($messages>0)?$messages:''?></b></span>
                </a>
            </li>
            <li <?= ($active_menu=='notifications'?'class="active"':'')?>>
                <a href="notifications" <?= ($notifications>0)?('title="'.sprintf($this->lang->line('new_notifications'),$notifications).'"'):''?>>
                    <span class="fontello-bell-alt <?= ($notifications>0)?' notifications':''?>"><b><?= ($notifications>0)?$notifications:''?></b></span>
                </a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $this->lang->line('hi')?> <?= $this->session->userdata('name')?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="user/new_password" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('change_password')?></a></li>
                    <li><a href="payments/subscriptions" data-target="#waiting_for_response" data-toggle="modal"><?= $this->lang->line('subscriptions')?></a></li>
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