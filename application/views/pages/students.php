<?php $this->load->view('pages/header'); ?>
  <div role="main" class="main">
    <section class="page-top caliber">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="<?= $this->config->item('base_url')?>">Home</a> <span class="divider">/</span></li>
              <li class="active">Students</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="span10">
            <h2>Students Area</h2>
          </div>
        <div class="span2"> <img src="<?= $this->config->item('base_url')?>img/flower3.png" class="full-im"></div>
        </div>
      </div>
    </section>
    <div class="container">
     <!-- <h2>Students <strong>Area</strong></h2>-->
      <div class="row">
        <div class="span10">
          <p class="lead">AlQuranNow.com brings you more than ever. You will now be able to interact and actually have course material available to download. Not only that, you can also check your schedule and print grade reports while having the privilege of being handed material personally by your teachers. </p>
        </div>
        <div class="span2"> <a href="<?= $this->config->item('base_url')?>main/contact_us" class="btn btn-large btn-primary pull-top pull-right">Contact Us!</a> </div>
      </div>
      <hr>
      <div class="row featured-boxes">
        <div class="span3">
          <div class="featured-box featured-box-primary">
            <div class="box-content"> <i class="icon icon-heart"></i>
              <h4>Downloads Library</h4>
              <p>download your lectures or qirats by Saad Nomani</p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="featured-box featured-box-secundary">
            <div class="box-content"> <i class="icon icon-cogs"></i>
              <h4>Scheduling</h4>
              <p>stay up to date with your lectures and tests</p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="featured-box featured-box-tertiary">
            <div class="box-content"> <i class="icon icon-book"></i>
              <h4>Messaging</h4>
              <p>coordinate and inquire with the staff and teachers</p>
            </div>
          </div>
        </div>
        <div class="span3">
          <div class="featured-box featured-box-quaternary">
            <div class="box-content"> <i class="icon icon-trophy"></i>
              <h4>Grade teachers</h4>
              <p>become a part of the teacher's assessment program</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row pull-top">
        <div class="span12">
          <h2>Parents <strong>Area</strong></h2>
          <div class="row">
            <div class="span6">
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-group"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Viewing attendance</h4>
                  <p>&nbsp;</p>
                 <!-- <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>-->
                </div>
              </div>
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-file"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Viewing incidence reports</h4>
                   <p>&nbsp;</p>
                <!--  <p class="tall">Lorem ipsum dolor sit amet, adip.</p>-->
                </div>
              </div>
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-google-plus"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Checking schedules</h4>
                   <p>&nbsp;</p>
                  <!--<p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>-->
                </div>
              </div>
              
            </div>
            <div class="span6">
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-film"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Checking payments</h4>
                   <p>&nbsp;</p>
                 <!-- <p class="tall">Lorem ipsum dolor sit amet, consectetur.</p>-->
                </div>
              </div>
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-adjust"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Receive students grading</h4>
                   <p>&nbsp;</p>
                 <!-- <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>-->
                </div>
              </div>
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-ok"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Messaging with admin and teachers</h4>
                   <p>&nbsp;</p>
                <!--  <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>-->
                </div>
              </div>
              
              <!--<div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-reorder"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Buttons</h4>
                  <p class="tall">Lorem ipsum dolor sit, consectetur adip.</p>
                </div>
              </div>
              <div class="feature-box">
                <div class="feature-box-icon"> <i class="icon-desktop"></i> </div>
                <div class="feature-box-info">
                  <h4 class="shorter">Lightbox</h4>
                  <p class="tall">Lorem sit amet, consectetur adip.</p>
                </div>
              </div>-->
            </div>
          </div>
        </div>
        <!--<div class="span4">
          <h2>and much more...</h2>
          <div class="accordion" id="accordion">
            <div class="accordion-group">
              <div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="icon-lightbulb"></i> Group Item #1</a> </div>
              <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner"> Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien. Praesent id enim sit amet odio vulputate eleifend in in tortor odio vulputate eleifend in in tortorodio vulputate eleifend in in tortor. </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="icon-bell-alt"></i> Group Item #2</a> </div>
              <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner"> Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien. </div>
              </div>
            </div>
            <div class="accordion-group">
              <div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="icon-laptop"></i> Group Item #3</a> </div>
              <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner"> Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien. </div>
              </div>
            </div>
          </div>
        </div>-->
      </div>
    </div>
  </div>
<?php $this->load->view('pages/footer'); ?>