  <footer>
    <div class="container">
      <div class="row">
        <div class="span12 foot-nav-mar">
          <ul class="foot-menu">
            <li><a href="<?= $this->config->item('base_url')?>">Home</a></li>
            <li><a href="<?= $this->config->item('base_url')?>main/about_us">About Us </a></li>
            <li><a href="<?= $this->config->item('base_url')?>main/courses">Courses</a></li>
            <li><a href="<?= $this->config->item('base_url')?>main/students_area">Students Area</a></li>
            <li><a href="<?= $this->config->item('base_url')?>main/media">Media</a></li>
            <li><a href="<?= $this->config->item('base_url')?>main/register">Register</a></li>
            <li><a href="<?= $this->config->item('base_url')?>main/faqs">FAQs</a></li>
            <li class="no-bord-right"><a href="<?= $this->config->item('base_url')?>main/contact_us">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <!--<div class="row center">
        <div class="span12">
          <h2 class="custom-color strong center follow">Follow Us</h2>
          <ul class="social">
            <li class="tweet"><a href="#" class="btn btn-large btn-primary disabled tweet"><span class="caption">Tweet</span>2344</a></li>
            <li class="share"><a href="#" class="btn btn-large btn-primary disabled share"><span class="caption">Share</span>1592</a></li>
            <li class="gshare"><a href="#" class="btn btn-large btn-primary disabled gshare"><span class="caption">Share</span>334</a></li>
            <li class="pinit"><a href="#" class="btn btn-large btn-primary disabled pinit"><span class="caption">Pin it</span>305</a></li>
            <li class="linked"><a href="#" class="btn btn-large btn-primary disabled linked"><span class="caption">Share</span>107</a></li>
          </ul>
        </div>
      </div>-->
    </div>
    <div class="footer-copyright">
      <div class="container">
        <div class="row center">
          <div class="span12">
            <p>Copyright © AlQuran Now. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Libs --> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script>window.jQuery || document.write('<script src="<?= $this->config->item('base_url')?>vendor/jquery.js"><\/script>')</script> 

<script src="<?= $this->config->item('base_url')?>vendor/jquery.easing.js"></script> 

<script src="<?= $this->config->item('base_url')?>vendor/jquery.cookie.js"></script> 
<!-- <script src="master/style-switcher/style.switcher.js"></script> --> 
<script src="<?= $this->config->item('base_url')?>vendor/bootstrap.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/selectnav.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/twitterjs/twitter.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/revolution-slider/js/jquery.themepunch.plugins.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/revolution-slider/js/jquery.themepunch.revolution.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/flexslider/jquery.flexslider.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/circle-flip-slideshow/js/jquery.flipshow.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/fancybox/jquery.fancybox.js"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/jquery.validate.js"></script> 
<script src="<?= $this->config->item('base_url')?>js/plugins.js"></script> 
<script type="text/javascript" src="<?= $this->config->item('base_url')?>js/daterangepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="<?= $this->config->item('base_url')?>css/datepicker.css">
  <script src="<?= $this->config->item('base_url')?>js/bootstrap-datepicker.2.2.1.min.js?ver=1.2"></script>
  
 <script>
    $('document').ready(function(){
        $("#birth_date").datepicker();
	});
</script>


<!-- Current Page Scripts --> 
<script src="<?= $this->config->item('base_url')?>js/views/view.home.js"></script> 

<!-- Theme Initializer --> 
<script src="<?= $this->config->item('base_url')?>js/theme.js"></script> 

<!-- Custom JS --> 
<script src="<?= $this->config->item('base_url')?>js/custom.js"></script> 
<script src="http://vjs.zencdn.net/c/video.js"></script>
<?php if($current_pages == 'contact_us'){?>
<strong><script src="<?= $this->config->item('base_url')?>vendor/jquery.validate.js"></script> 
<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/jquery.mapmarker.js"></script> 
<script>
			$(document).ready(function() {

				var mapMarkers = {
					"markers": [
						{
							"latitude": "43.648948000000000000",
							"longitude":"-79.383765000000000000",
							"icon": "img/pin.png"
						}
					]
				};

				$("#googlemaps").mapmarker({
					zoom : 16,
					center: "43.648948000000000000, -79.383765000000000000",
					dragging:1,
					mousewheel:0,
					markers: mapMarkers,
					featureType:"all",
					visibility: "on",
					elementType:"geometry"
				});
			
			});
		</script> 
<script src="<?= $this->config->item('base_url')?>js/plugins.js"></script> 
  
<!-- Page Scripts --> 
<script src="<?= $this->config->item('base_url')?>js/views/view.contact.js"></script> 
</strong>
<?php } ?>

<?php if($current_pages == 'register'){?>
<strong><script src="<?= $this->config->item('base_url')?>vendor/jquery.validate.js"></script> 
<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script src="<?= $this->config->item('base_url')?>vendor/jquery.mapmarker.js"></script> 

  <script src="<?= $this->config->item('base_url')?>js/plugins.js"></script> 
  
<!-- Page Scripts --> 
<script src="<?= $this->config->item('base_url')?>js/views/view.register.js"></script> 
</strong>
<?php } ?>


<?php if($current_pages == 'home')
{
	?>
 <script src="<?= $this->config->item('base_url')?>vendor/jquery.validate.js"></script>    
<script src="<?= $this->config->item('base_url')?>js/plugins.js"></script> 
  
<!-- Page Scripts --> 
<script src="<?= $this->config->item('base_url')?>js/views/view.home_signup.js"></script> 
</strong>
<?php } ?>

</body>
</html>