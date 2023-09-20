<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html>
<!--<![endif]-->

<head>

<!-- Basic -->
<meta charset="utf-8">
<title>Welcome to ALQuran Now.com</title>
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="Porto - Responsive HTML5 Template">
<meta name="author" content="Crivos.com">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Libs CSS -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/bootstrap.css">
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/fonts/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>vendor/flexslider/flexslider.css" media="screen" />
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>vendor/fancybox/jquery.fancybox.css" media="screen" />

<!-- Theme CSS -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/theme.css">
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/theme-elements.css">

<!-- Current Page Styles -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>vendor/revolution-slider/css/settings.css" media="screen" />
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>vendor/revolution-slider/css/captions.css" media="screen" />
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>vendor/circle-flip-slideshow/css/component.css" media="screen" />

<!-- Custom CSS -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/custom.css">

<!-- Skin -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/skins/blue.css">

<!-- Responsive CSS -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/bootstrap-responsive.css" />
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/theme-responsive.css" />

<?php if($current_page = 'media' || $current_page == 'courses'){?>
<!-- Current Page Styles -->
<link rel="stylesheet" href="<?= $this->config->item('base_url')?>css/theme-blog.css" media="screen" />
<?php } ?>

<!-- Favicons -->
<link rel="shortcut icon" href="<?= $this->config->item('base_url')?>img/favicon.ico">
<link rel="apple-touch-icon" href="<?= $this->config->item('base_url')?>img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="<?= $this->config->item('base_url')?>72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= $this->config->item('base_url')?>img/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= $this->config->item('base_url')?>img/apple-touch-icon-144x144.png">

<!-- Head Libs -->
<script src="<?= $this->config->item('base_url')?>vendor/modernizr.js"></script>

<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css">
		<![endif]-->

<!--[if lte IE 8]>
			<script src="vendor/respond.js"></script>
		<![endif]-->

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
          <li <?php if($current_pages == 'home'){?>class="active"<?php } ?>> <a href="<?= $this->config->item('base_url')?>"> Home </a> 
            <!--  <ul class="dropdown-menu"> <li class="dropdown"><a class="dropdown-toggle" href="about-us.html">About Us <i class="icon-angle-down"></i> </a>
          
            <ul class="dropdown-menu">
              <li><a href="management.html">Management Team</a></li>
              <li><a href="testimonials.html">Testimonials</a></li>
            </ul>
          </li>
            </ul>--> 
          </li>
          <li class="dropdown <?php if($current_pages == 'about_us' || $current_pages == 'management' || $current_pages == 'testimonials'){?>active<?php } ?>" > <a class="dropdown-toggle" href="<?= $this->config->item('base_url')?>main/about_us">About Us <i class="icon-angle-down"></i> </a>
            <ul class="dropdown-menu">
              <li><a href="<?= $this->config->item('base_url')?>main/management">Management Team</a></li>
              <li><a href="<?= $this->config->item('base_url')?>main/testimonials">Testimonials</a></li>
            </ul>
          </li>
          <li  <?php if($current_pages == 'courses'){?>class="active"<?php } ?>> <a href="<?= $this->config->item('base_url')?>main/courses">Courses</a> </li>
          <li <?php if($current_pages == 'students'){?>class="active"<?php } ?>> <a href="<?= $this->config->item('base_url')?>main/students_area"> Students Area <!--<i class="icon-angle-down"></i>--> </a> 
            <!--<ul class="dropdown-menu">
              <li><a href="#">Teacher 1</a></li>
              <li><a href="feature-grid-system.html">Teacher 2</a></li>
            </ul>--> 
          </li>
          <li <?php if($current_pages == 'media'){?>class="active"<?php } ?>> <a href="<?= $this->config->item('base_url')?>main/media"> Media <!--<i class="icon-angle-down"></i> --></a> 
            <!--<ul class="dropdown-menu">
              <li><a href="media.html">Media 1</a></li>
              <li><a href="portfolio-3-columns.html">Media 2</a></li>
            </ul>--> 
          </li>
          <li class="dropdown <?php if($current_pages == 'contact_us' || $current_pages == 'register' || $current_pages == 'faqs'){?>active<?php } ?>"> <a class="dropdown-toggle" href="<?= $this->config->item('base_url')?>main/contact_us"> Contact Us <i class="icon-angle-down"></i> </a>
            <ul class="dropdown-menu">
              <li><a href="<?= $this->config->item('base_url')?>main/register">Registration</a></li>

              <?php if (isset($this->session->userdata['user_id']) && $this->session->userdata['person_type'] == 'donor'): ?>  
              <li><a href="<?= $this->config->item('base_url')?>donor">Donor Area </a></li>
              <?php else : ?>
              <li><a href="<?= $this->config->item('base_url')?>start/user_login">Donor Area</a></li>
              <?php endif; ?>
              
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
  <?php if($current_pages == 'register'){?>
    
      <div class="sticky_register_now">
        <a href="<?= $this->config->item('base_url')?>start/user_login"><img src="<?= $this->config->item('base_url')?>images/login.png" /></a>
      </div>
      <div class="sticky_login" style="top:465px;">
        <a href="<?= $this->config->item('base_url')?>main/contact_us"><img src="<?= $this->config->item('base_url')?>images/contact_us.png" /></a>  
      </div>  
    
  <?php } else{ ?>
      <div class="sticky_register_now">
        <a href="<?= $this->config->item('base_url')?>main/register"><img src="<?= $this->config->item('base_url')?>images/register_now.png" /></a>
      </div>
      <div class="sticky_login">
        <a href="<?= $this->config->item('base_url')?>start/user_login"><img src="<?= $this->config->item('base_url')?>images/login.png" /></a>
      </div>  
        <div class="sticky_contact">
        <a href="<?= $this->config->item('base_url')?>main/contact_us"><img src="<?= $this->config->item('base_url')?>images/contact_us.png" /></a>
      </div>  
  <?php } ?>