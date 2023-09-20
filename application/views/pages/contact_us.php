<?php $this->load->view('pages/header');?>

  <div role="main" class="main">
     <section class="page-top caliber">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="<?= $this->config->item('base_url')?>">Home</a> <span class="divider">/</span></li>
              <li class="active">Contact Us</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="span12">
            <h2>Contact Us</h2>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Google Maps -->
    <div id="googlemaps" class="google-map hidden-phone"></div>
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="alert alert-success hidden" id="contactSuccess"> <strong>Thank You!</strong> Your message has been sent. </div>
          <div class="alert alert-error hidden" id="contactError"> <strong>Error!</strong> There was an error sending your message. </div>
          <div class="alert alert-error hidden" id="contactErrorCaptcha"> <strong>Error!</strong> Correct the captcha. </div>
          <h2 class="short"><strong>Contact</strong> Us</h2>
          
          <form action="<?= $this->config->item('base_url')?>contact/contact_admin" id="contactForm" type="post" >
            <div class="row controls">
              <div class="span3 control-group">
                <label>Your name *</label>
                <input type="text" value="" maxlength="100" class="span3" name="name" id="name">
              </div>
              <div class="span3 control-group">
                <label>Your email address *</label>
                <input type="email" value="" maxlength="100" class="span3" name="email" id="email">
              </div>
            </div>
            <div class="row controls">
              <div class="span6 control-group">
                <label>Subject</label>
                <input type="text" value="" maxlength="100" class="span6" name="subject" id="subject">
              </div>
            </div>
            <div class="row controls">
              <div class="span6 control-group">
                <label>Message *</label>
                <textarea maxlength="5000" rows="10" class="span6" name="message" id="message"></textarea>
              </div>
            </div>
            
            <div class="row controls">
              <div class="span3 control-group">
                <label></label>
                <?php echo $captcha; ?>
              </div>
              <div class="span3 control-group">
                <label></label>
                <input type="text" value="" maxlength="100" class="span3" name="captcha" id="captcha">
              </div>
            </div>
                        
            <div class="btn-toolbar">
              <input type="submit" value="Send Message" class="btn btn-primary btn-large" data-loading-text="Loading...">
            </div>
          </form>
        </div>
        <div class="span6">
          <h4 class="pull-top">Get in <strong>touch</strong></h4>
          <p>Get in touch with us by simply completing the information form hereunder and you will be contacted by us shortly.</p>
          <hr />
          <h4>The <strong>Office</strong></h4>
          <ul class="unstyled">
            <li><i class="icon-map-marker"></i> <strong>Address:</strong> 100 King Street West,Suite 5700, Toronto,
ON, Canada,M5X 1C7
</li>
           <!-- <li><i class="icon-phone"></i> <strong>Phone:</strong> US/Canada: +1-866-611-8272   Dubai: +971-4-431-7373   Pakistan: +92-21-32818114 </li>-->
            <li><i class="icon-envelope"></i> <strong>Email:</strong> <a href="mailto:support@alQuranNow.com">support@alQuranNow.com</a></li>
          </ul>
          <hr />
          <h4><strong>Registration</strong></h4>
          
         <!-- <ul class="unstyled">
            <li><i class="icon-time"></i> Monday - Friday 9am to 5pm</li>
            <li><i class="icon-time"></i> Saturday - 9am to 2pm</li>
            <li><i class="icon-time"></i> Sunday - Closed</li>
          </ul>-->
          <strong>Email:</strong> <a href="mailto:register@alQuranNow.com  ">register@alQuranNow.com</a>
        </div>
      </div>
    </div>
  </div>

<?php $this->load->view('pages/footer');?>