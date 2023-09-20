<script>
    lang={
        processing:'<?= $this->lang->line('processing')?>'
    }
	$(document).ready(function(){
		  // $('.dropdown-toggle').dropdown()	
	});
</script>
<nav>
  <div class="navbar navbar-inverse navbar-static-top" id="menu_bar">
   <div class="navbar-inner">
     <div class="container-fluid">
       <!--<img src="images/logo.png" class="brand">-->
        <ul class="nav" id="main_menu">
            <li <?= ($active_menu=='students'?'class="active"':'')?>>
                <a href="donor">
                    <i class="fontello-users"></i>
                    <span class="hidden-phone"><?= $this->lang->line('dashboards')?></span>
                </a>
            </li>
            <li <?= ($active_menu=='donate'?'class="active"':'')?>>
                <a href="donor/donate">
                    <i class="fontello-wallet"></i>
                    <span class="hidden-phone"><?= $this->lang->line('donate')?></span>
                </a>
            </li>
            <li <?= ($active_menu=='download'?'class="active"':'')?>>
                <a href="donor/download">
                    <i class="icon-download"></i>
                    <span class="hidden-phone">Downloads</span>
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