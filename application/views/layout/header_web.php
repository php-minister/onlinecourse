<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">        
        
        <base href="<?= $this->config->item('base_url')?>" />
        <title><?= $page_title?></title>                         
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?ver=1.1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css?ver=1.1">
        <link rel="stylesheet" type="text/css" href="css/style.css?ver=1.2">
        
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php if (isset($forms)){?>
        <script src="js/forms.min.js"></script>
        <?php if ($this->config->item('language')!='english'){?>
        <script src="js/jvalidation/messages_<?= $this->config->item('language')?>.js"></script>
        <?php }?>
        <?php }?>
        <?php if (isset($tables)){?>
        <script src="js/jquery.dataTables.1.6.0.min.js?ver=1.1"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.1.6.0.css?ver=1.1">
        <?php }?>
        <?php if (isset($magic_suggest)){?>
        <link rel="stylesheet" type="text/css" href="css/magicsuggest-1.2.3-min.css?ver=1.2"> 
        <script src="js/magicsuggest-1.2.3-min.js?ver=1.2"></script>
        <?php }?>
        <?php if ((isset($date_picker)) AND ($date_picker)){?>
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">
        <?php if ($this->config->item('language')!='english'){?>
        <script src="js/datepicker/messages_<?= $this->config->item('language')?>.js"></script>
        <?php }?>
        <script src="js/bootstrap-datepicker.2.2.1.min.js?ver=1.2"></script>
        <?php }?>
		
		<?php if (isset($calendar_new)){?>
        <link rel="stylesheet" type="text/css" href="css/calendario.1.0.css?ver=1.3"> 
        <script src="js/jquery-calendrio.js"></script>
        <?php }?>

        
        <script src="js/scripts.js?ver=1.3"></script>
        <script>
            config={
                base_url:'<?= $this->config->item('base_url')?>'
            }
        </script>
			<script type="text/javascript" src="js/moment.min.js"></script>
            <script type="text/javascript" src="js/daterangepicker.js"></script>
            <link rel="stylesheet" type="text/css" href="css/daterangepicker-bs2.css" />    
            
            <!-- Libs CSS -->
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/fonts/font-awesome/css/font-awesome.css">
            <link rel="stylesheet" href="vendor/flexslider/flexslider.css" media="screen" />
            <link rel="stylesheet" href="vendor/fancybox/jquery.fancybox.css" media="screen" />
            
            <!-- Theme CSS -->
            <link rel="stylesheet" href="css/theme.css">
            <link rel="stylesheet" href="css/theme-elements.css">
            
            <!-- Current Page Styles -->
            <link rel="stylesheet" href="vendor/revolution-slider/css/settings.css" media="screen" />
            <link rel="stylesheet" href="vendor/revolution-slider/css/captions.css" media="screen" />
            <link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css" media="screen" />
            
            <!-- Custom CSS -->
            <link rel="stylesheet" href="css/custom.css">
            
            <!-- Skin -->
            <link rel="stylesheet" href="css/skins/blue.css">
            
            <!-- Responsive CSS -->
            <link rel="stylesheet" href="css/bootstrap-responsive.css" />
            <link rel="stylesheet" href="css/theme-responsive.css" />
            
            <!-- Favicons -->
            <link rel="shortcut icon" href="img/favicon.ico">
            <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
            <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
            <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">
            
            <!-- Head Libs -->
            <script src="vendor/modernizr.js"></script>
            
            <!--[if IE]>
                        <link rel="stylesheet" href="css/ie.css">
                    <![endif]-->
            
            <!--[if lte IE 8]>
                        <script src="vendor/respond.js"></script>
                    <![endif]-->            
            <?php 
				if(isset($page_style))
				{
					if($page_style == 'students_home' || $page_style = 'parent_scheduling' || $page_style = 'parent_attendance')
					{
						?>
                        <style> 
							.container-fluid{height: 100%;position: relative;}
							#student_schedule_page{ height:100%;}
							.container{ height:100%;}
							.main{ height:100%;}
							.body{ height:100%;}
							footer{ margin-top:202px; bottom:0;}
							.container-fluid{padding-right: 20px;padding-left: 20px;}
							
						</style>
                        <?php
					}
				}
			?>        
                    
    </head>
<body>
<div class="body">
  <header>
    <div class="container">
      <h1 class="logo"> <a href="<?= $this->config->item('base_url')?>"> <img alt="AlQuran Now" src="<?= $this->config->item('base_url')?>img/logo.jpg"> </a> </h1>
      <!--<div class="search">
        <form class="form-search" id="searchForm" action="page-search-results.html" method="get">
          <div class="control-group">
            <input type="text" class="input-medium search-query" name="q" id="q" placeholder="Search...">
            <button class="search" type="submit"><i class="icon-search"></i></button>
          </div>
        </form>
      </div>-->
      <nav>
        <ul class="nav nav-pills nav-top">
          <li class="phone"> <span><i class="icon-phone red-icon"></i> US/Canada: +1-866-611-8272 Dubai: +971-4-431-7373 Pakistan:+92-51-843-0552 </span> </li>
        </ul>
      </nav>
      <div class="social-icons">
        <ul class="social-icons">
          <li class="facebook"><a href="http://www.facebook.com/pages/alQuranNowcom/218294908318084" target="_blank" title="Facebook">Facebook</a></li>
          <li class="twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter">Twitter</a></li>
          <!--<li class="linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin">Linkedin</a></li>-->
        </ul>
      </div>
      <nav>
        <ul class="nav nav-pills nav-main" id="mainMenu">
          <li> <a href="<?= $this->config->item('base_url')?>"> Home </a> 
            <!--  <ul class="dropdown-menu"> <li class="dropdown"><a class="dropdown-toggle" href="about-us.html">About Us <i class="icon-angle-down"></i> </a>
          
            <ul class="dropdown-menu">
              <li><a href="management.html">Management Team</a></li>
              <li><a href="testimonials.html">Testimonials</a></li>
            </ul>
          </li>
            </ul>--> 
          </li>
          <li class="dropdown"> <a class="dropdown-toggle" href="<?= $this->config->item('base_url')?>main/about_us">About Us <i class="icon-angle-down"></i> </a>
            <ul class="dropdown-menu">
              <li><a href="<?= $this->config->item('base_url')?>main/management">Management Team</a></li>
              <li><a href="<?= $this->config->item('base_url')?>main/testimonials">Testimonials</a></li>
            </ul>
          </li>
          <li> <a href="<?= $this->config->item('base_url')?>main/courses">Courses</a> </li>
          <li> <a href="<?= $this->config->item('base_url')?>main/students_area"> Students Area <!--<i class="icon-angle-down"></i>--> </a> 
            <!--<ul class="dropdown-menu">
              <li><a href="#">Teacher 1</a></li>
              <li><a href="feature-grid-system.html">Teacher 2</a></li>
            </ul>--> 
          </li>
          <li> <a href="<?= $this->config->item('base_url')?>main/media"> Media <!--<i class="icon-angle-down"></i> --></a> 
            <!--<ul class="dropdown-menu">
              <li><a href="media.html">Media 1</a></li>
              <li><a href="portfolio-3-columns.html">Media 2</a></li>
            </ul>--> 
          </li>
          <li class="dropdown"> <a class="dropdown-toggle" href="<?= $this->config->item('base_url')?>main/contact_us"> Contact Us <i class="icon-angle-down"></i> </a>
            <ul class="dropdown-menu">
              <li><a href="<?= $this->config->item('base_url')?>main/register">Registration</a></li>
              
              <?php if (isset($this->session->userdata['user_id'])){
				  
				   ?>  
              <li><a href="<?= $this->config->item('base_url')?>donor">Donor Area </a></li>
              <?php }else { ?>
              <li><a href="<?= $this->config->item('base_url')?>start/user_login">Donor Area</a></li>
              <?php } ?>
              
              <?php if (isset($this->session->userdata['user_id']) && $this->session->userdata['person_type'] == 'student'): ?>  
              <li><a href="<?= $this->config->item('base_url')?>student">Student Area </a></li>
              <?php else : ?>
              <li><a href="<?= $this->config->item('base_url')?>start/user_login">Student Area</a></li>
              <?php endif; ?>              
            
              
              <li><a href="<?= $this->config->item('base_url')?>main/faqs">FAQs</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </header>

 <?php if (isset($this->session->userdata['user_id'])): ?> 
  <div class="sticky_register_now_login">
  	<a href="<?= $this->config->item('base_url')?>main/contact_us"><img src="<?= $this->config->item('base_url')?>images/contact_us.png" /></a>
  </div>
   
 <?php endif; ?>


  <section class="page-top caliber">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="<?= $this->config->item('base_url')?>">Home</a> <span class="divider">/</span></li>
              <li class="active"><?php 
			  			if(isset($page_name))
						{
			  				echo $page_name; 
						}
			  ?></li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="span10">
            <h2><?php 
			if(isset($page_name))
			{
				echo $page_name; ?> Area
             <?php
			}
			 ?>   
                </h2>
          </div>
        <!--<div class="span2"> <img src="<?= $this->config->item('base_url')?>img/flower3.png" class="full-im"></div>-->
        </div>
      </div>
    </section>
    
  <div role="main" class="main">
  	<div class="container">  