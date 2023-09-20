<?php $this->load->view('pages/header'); ?>
  <div role="main" class="main">
     <section class="page-top caliber">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="<?= $this->config->item('base_url')?>">Home</a> <span class="divider">/</span></li>
              <li class="active">FAQs</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="span10">
            <h2>FAQs</h2>
          </div>
         <div class="span2"> <img src="<?= $this->config->item('base_url')?>img/flower4.png" class="full-im"></div>
        </div>
      </div>
    </section>
    <div class="container">
      <h2>Frequently Asked <strong>Questions</strong></h2>
      <div class="row">
        <div class="span12">
          <p class="lead">We are one of the leading online Qur'an and Arabic learning institute; we offer full time, part time and weekend courses for adult and children alike. We excel because we design our teaching methods keeping in line with the changing trends of the day utilizing state-of-the-art technology for uninterrupted classes.</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="span12">
          <section class="toggle">
            <input type="checkbox" id="q1">
            <label for="q1">What is the registration / subscription process?</label>
            <p>You can register on our website by giving us some of your basic information like your Name, Contact number, Age etc..</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q2">
            <label for="q2">What are the requirements for online classes?</label>
            <p>For online classes you just need a working computer with an internet connection.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="a3">
            <label for="q3">What installation do we require on our computers for online classes?</label>
            <p>For Online classes you just need to install software called GOTOMEETING</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q4">
            <label for="q4">From where can we install GOTOMEETING software?</label>
            <p>We will help you out by providing this software free of cost.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q5">
            <label for="q5">How to pay?</label>
            <p>Your payments will be done via PayPal online and you can pay us by using your Debit or Credit card.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q6">
            <label for="q6">What is the Hadiya structure and payment procedure?</label>
            <p>Hadiya depends on your selected plan and every month the payment will be done in advance.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q7">
            <label for="q7">Can we select days of our own choice?</label>
            <p>Yes, you can select consecutive days of your own choice.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q8">
            <label for="q8">How long will it take to complete the Holy Quran?</label>
            <p>It depends from where we begin the lesson, if a student is good in TAJWEED and we conduct his/her classes from the beginning of Holy Quran from the day first then it will take approximately 8-11 months for complete recitation of Holy Quran.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q9">
            <label for="q9">Can your teachers teach in English or Arabic?</label>
            <p> Our teachers have complete hold of teaching students in different languages and they are absolutely perfect for teaching Arabic to English (Translation and Explanation), Arabic to Urdu (Translation and Explanation) and Arabic to Arabic (Translation and Explanation).</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q10">
            <label for="q10">What is the age limit for registration?</label>
            <p>Students will be qualified for online classes should be minimum of "4 years" of age and maximum of "80 years" of age.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q11">
            <label for="q11">How you start teaching a kid?</label>
            <p> We provide special trainings to our teachers to teach kids online, first of all we prefer a kid to learn basic fundamentals of ISLAM like: Namaz, Roza, Kalimas , Azan, Zakat etc, and then we educate them about rules, Nazra and Tajweed before the recitation of Holy Quran.</p>
          </section>
          <section class="toggle">
            <input type="checkbox" id="q12">
            <label for="q12">Do you have female teachers for female students?</label>
            <p>Yes, we have female teachers for online teaching and we can provide female teacher as per student's request.</p>
          </section>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('pages/footer'); ?>