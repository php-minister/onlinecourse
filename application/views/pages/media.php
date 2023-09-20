<?php $this->load->view('pages/header'); ?>
  <div role="main" class="main">
     <section class="page-top caliber">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="<?= $this->config->item('base_url')?>">Home</a> <span class="divider">/</span></li>
              <li class="active">Media</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="span10">
            <h2>Media</h2>
          </div>
        <div class="span2"> <img src="<?= $this->config->item('base_url')?>img/flower4.png" class="full-im"></div>
        </div>
      </div>
    </section>
    <div class="container">
      <!--<div class="row">
        <div class="span9">
          <div class="blog-posts">
            <article class="post post-medium-image">
              <div class="row">
                <div class="span4">
                  <div class="post-image">
                    <div class="flexslider flexslider-center-mobile flexslider-simple" data-plugin-options='{"controlNav":false, "animation":"slide", "slideshow": false, "maxVisibleItems": 1}'>
                      <ul class="slides">
                        <li> <img class="img-rounded" src="<?= $this->config->item('base_url')?>img/blog/blog-medium-image-1.jpg" alt=""> </li>
                        <li> <img class="img-rounded" src="<?= $this->config->item('base_url')?>img/blog/blog-medium-image-2.jpg" alt=""> </li>
                        <li> <img class="img-rounded" src="<?= $this->config->item('base_url')?>img/blog/blog-medium-image-3.jpg" alt=""> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="span5">
                  <div class="post-content">
                    <h2><a href="blog-post.html">Media 1</a></h2>
                    <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. [...]</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="span9">
                  <div class="post-meta"> <span><i class="icon-calendar"></i> January 10, 2013 </span> <span><i class="icon-user"></i> By <a href="#">Saad Nomani</a> </span> <span><i class="icon-tag"></i> <a href="#">Duis</a>, <a href="#">News</a> </span> <span><i class="icon-comments"></i> <a href="#">12 Comments</a></span> <a href="blog-post.html" class="btn btn-mini btn-primary pull-right">Read more...</a> </div>
                </div>
              </div>
            </article>
            <article class="post post-medium-image">
              <div class="row">
                <div class="span4">
                  <div class="post-image">
                    <div class="flexslider flexslider-center-mobile flexslider-simple" data-plugin-options='{"controlNav":false, "animation":"slide", "slideshow": false, "maxVisibleItems": 1}'>
                      <ul class="slides">
                        <li> <img class="img-rounded" src="<?= $this->config->item('base_url')?>img/blog/blog-medium-image-3.jpg" alt=""> </li>
                        <li> <img class="img-rounded" src="<?= $this->config->item('base_url')?>img/blog/blog-medium-image-2.jpg" alt=""> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="span5">
                  <div class="post-content">
                    <h2><a href="blog-post.html">Media 2</a></h2>
                    <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. [...]</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="span9">
                  <div class="post-meta"> <span><i class="icon-calendar"></i> January 10, 2013 </span> <span><i class="icon-user"></i> By <a href="#">Saad Nomani</a> </span> <span><i class="icon-tag"></i> <a href="#">Duis</a>, <a href="#">News</a> </span> <span><i class="icon-comments"></i> <a href="#">12 Comments</a></span> <a href="blog-post.html" class="btn btn-mini btn-primary pull-right">Read more...</a> </div>
                </div>
              </div>
            </article>
            <article class="post post-medium-image">
              <div class="row">
                <div class="span4">
                  <div class="post-image">
                    <div class="flexslider flexslider-center-mobile flexslider-simple" data-plugin-options='{"controlNav":false, "animation":"slide", "slideshow": false, "maxVisibleItems": 1}'>
                      <ul class="slides">
                        <li> <img class="img-rounded" src="<?= $this->config->item('base_url')?>img/blog/blog-medium-image-2.jpg" alt=""> </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="span5">
                  <div class="post-content">
                    <h2><a href="blog-post.html">Media 3</a></h2>
                    <p>Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero. Pellentesque pellentesque tempor tellus eget hendrerit. Morbi id aliquam ligula. Aliquam id dui sem. Proin rhoncus consequat nisl, eu ornare mauris tincidunt vitae. [...]</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="span9">
                  <div class="post-meta"> <span><i class="icon-calendar"></i> January 10, 2013 </span> <span><i class="icon-user"></i> By <a href="#">Saad Nomani</a> </span> <span><i class="icon-tag"></i> <a href="#">Duis</a>, <a href="#">News</a> </span> <span><i class="icon-comments"></i> <a href="#">12 Comments</a></span> <a href="blog-post.html" class="btn btn-mini btn-primary pull-right">Read more...</a> </div>
                </div>
              </div>
            </article>
            <div class="pagination pagination-large pull-right">
              <ul>
                <li><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="span3">
          <aside class="sidebar">
            <form class="form-search">
              <div class="input-append">
                <input type="text" class="span2 search-query" placeholder="Search the blog...">
                <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
              </div>
            </form>
            <hr />
            <h4>Categories</h4>
            <ul class="nav nav-list primary pull-bottom">
              <li><a href="#">Design</a></li>
              <li><a href="#">Photos</a></li>
              <li><a href="#">Videos</a></li>
              <li><a href="#">Lifestyle</a></li>
              <li><a href="#">Technology</a></li>
            </ul>
            <div class="tabs">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#popularPosts" data-toggle="tab"><i class="icon-star"></i> Popular</a></li>
                <li><a href="#recentPosts" data-toggle="tab">Recent</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="popularPosts">
                  <ul class="simple-post-list">
                    <li>
                      <div class="post-image">
                        <div class="thumbnail"> <a href="blog-post.html"> <img src="<?= $this->config->item('base_url')?>img/blog/blog-thumb-1.jpg" alt=""> </a> </div>
                      </div>
                      <div class="post-info"> <a href="blog-post.html">Media 1</a>
                        <div class="post-meta"> Jan 10, 2013 </div>
                      </div>
                    </li>
                    <li>
                      <div class="post-image">
                        <div class="thumbnail"> <a href="blog-post.html"> <img src="<?= $this->config->item('base_url')?>img/blog/blog-thumb-2.jpg" alt=""> </a> </div>
                      </div>
                      <div class="post-info"> <a href="blog-post.html">Media 2</a>
                        <div class="post-meta"> Jan 10, 2013 </div>
                      </div>
                    </li>
                    <li>
                      <div class="post-image">
                        <div class="thumbnail"> <a href="blog-post.html"> <img src="<?= $this->config->item('base_url')?>img/blog/blog-thumb-3.jpg" alt=""> </a> </div>
                      </div>
                      <div class="post-info"> <a href="blog-post.html">Media 3</a>
                        <div class="post-meta"> Jan 10, 2013 </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane" id="recentPosts">
                  <ul class="simple-post-list">
                    <li>
                      <div class="post-image">
                        <div class="thumbnail"> <a href="blog-post.html"> <img src="<?= $this->config->item('base_url')?>img/blog/blog-thumb-2.jpg" alt=""> </a> </div>
                      </div>
                      <div class="post-info"> <a href="blog-post.html">Media 1</a>
                        <div class="post-meta"> Jan 10, 2013 </div>
                      </div>
                    </li>
                    <li>
                      <div class="post-image">
                        <div class="thumbnail"> <a href="blog-post.html"> <img src="<?= $this->config->item('base_url')?>img/blog/blog-thumb-3.jpg" alt=""> </a> </div>
                      </div>
                      <div class="post-info"> <a href="blog-post.html">Media 2</a>
                        <div class="post-meta"> Jan 10, 2013 </div>
                      </div>
                    </li>
                    <li>
                      <div class="post-image">
                        <div class="thumbnail"> <a href="blog-post.html"> <img src="<?= $this->config->item('base_url')?>img/blog/blog-thumb-1.jpg" alt=""> </a> </div>
                      </div>
                      <div class="post-info"> <a href="blog-post.html">Media 3</a>
                        <div class="post-meta"> Jan 10, 2013 </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <hr />
            <h4>About Us</h4>
            <p>AlQuranNow.com is a source of knowledge for those who are on the quest to learn the Quran and teach their children likewise. We have made ourselves available online in order to serve those people of the Muslim ummah who live in parts of the world where it isn't as easy to get access to good Islamic teachers. AlQuranNow serves as a solution to your needs of learning the Qur'an. </p>
          </aside>
        </div>
      </div>-->
      
      <h4> Coming Soon!</h4>
      We are updating the website.
      
    </div>
  </div>
<?php $this->load->view('pages/footer'); ?>