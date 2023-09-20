<?php $this->load->view('pages/header'); ?>
  <div role="main" class="main">
     <section class="page-top caliber">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="breadcrumb">
              <li><a href="<?= $this->config->item('base_url')?>">Home</a> <span class="divider">/</span></li>
              <li class="active">Register</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="span10">
            <h2>Register</h2>
          </div>
       <div class="span2"> <img src="<?= $this->config->item('base_url')?>img/flower4.png" class="full-im"></div>
        </div>
      </div>
    </section>
    <div class="container">
      <div class="row">
          <div class="alert alert-success hidden" id="contactSuccess"> <strong>Thank You!</strong> Your request has been sent. </div>
          <div class="alert alert-error hidden" id="contactError"> <strong>Error!</strong> There was an error sending your request. </div>
          <div class="alert alert-error hidden" id="contactErrorEmail"> <strong>Error!</strong> Email address already exist. </div>
          <div class="alert alert-error hidden" id="contactErrorCaptcha"> <strong>Error!</strong> Correct the captcha. </div>      
        <div class="span12">
          <h2 class="short">Registration</h2>
          <p>Please fill and submit the complete form, provided below, and you will be contacted via email or phone for Online classes. You can also call or send us email at register@alqurannow.com for details and information, you will be briefed according to your queries. </p>
          <form id="contactForm">
            <div class="row controls">
              <div class="span6 control-group">
                <label>Student's name (required)</label>
                <input type="text" value="" maxlength="100" class="span6" name="name" id="name">
              </div>
              <div class="span6 control-group">
                <label>Email address (required)</label>
                <input type="text" value="" maxlength="100" class="span6" name="email" id="email">
              </div>

            </div>
            <div class="row controls">
              <div class="span6 control-group">
                <label>Date of Birth</label>
                        <input type="text" name="birth_date" id="birth_date"  class="span6" data-date-viewmode="years">				
              </div>
              <div class="span6 control-group">
                <label>Student's Gender</label>
                <!--<div class="span2 no-mar-left">
                  <input type="radio"  maxlength="100" class=" radio-width" value="Male">
                  <span class="value">Male</span> </div>
                <div class="span2 no-mar-left">
                  <input type="radio"  maxlength="100" class=" radio-width" value="Female">
                  <span class="value">Female</span> </div>-->
                
                <select size="1"  maxlength="100" class="span6" name="gender" id="gender" >
                  <option selected="selected" value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>
            

            <div class="row controls">
              <div class="span6 control-group">
                <label>Preferred Language for Learning</label>
                <select maxlength="100" class="span6" name="lang" id="lang">
                  <option value="English">English</option>
                  <option value="Urdu">Urdu</option>
                  <option value="Arabic" selected="selected">Arabic</option>
                  <option value="Punjabi">Punjabi</option>
                  <option value="Pashto">Pashto</option>
                </select>
              </div>
              <div class="span6 control-group">
                <label>Country (required)</label>
                <select  maxlength="100" class="span6 dropdown" id="country" name="country">
                  <option selected="selected" value="Canada">Canada</option>
                  <option value="USA">USA</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="Australia">Australia</option>
                  <option value="Europe">Europe</option>
                  <option value="Other">Other</option>
                  <option value="---------">--------------</option>
                  <option value="Afghanistan">Afghanistan</option>
                  <option value="Albania">Albania</option>
                  <option value="Algeria">Algeria</option>
                  <option value="American Samoa">American Samoa</option>
                  <option value="Andorra">Andorra</option>
                  <option value="Angola">Angola</option>
                  <option value="Anguilla">Anguilla</option>
                  <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Armenia">Armenia</option>
                  <option value="Austria">Austria</option>
                  <option value="Azerbaijan">Azerbaijan</option>
                  <option value="Bahamas">Bahamas</option>
                  <option value="Bahrain">Bahrain</option>
                  <option value="Bangladesh">Bangladesh</option>
                  <option value="Barbados">Barbados</option>
                  <option value="Belarus">Belarus</option>
                  <option value="Belgium">Belgium</option>
                  <option value="Belize">Belize</option>
                  <option value="Bermuda">Bermuda</option>
                  <option value="Bhutan">Bhutan</option>
                  <option value="Bolivia">Bolivia</option>
                  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                  <option value="Botswana">Botswana</option>
                  <option value="Brazil">Brazil</option>
                  <option value="Brunei">Brunei</option>
                  <option value="Bulgaria">Bulgaria</option>
                  <option value="Burkina Faso">Burkina Faso</option>
                  <option value="Burundi">Burundi</option>
                  <option value="Cambodia">Cambodia</option>
                  <option value="Cameroon">Cameroon</option>
                  <option value="Cape Verde">Cape Verde</option>
                  <option value="Cayman Islands">Cayman Islands</option>
                  <option value="Central African Republic">Central African Republic</option>
                  <option value="Chad">Chad</option>
                  <option value="Chile">Chile</option>
                  <option value="China">China</option>
                  <option value="Colombia">Colombia</option>
                  <option value="Comoros">Comoros</option>
                  <option value="Congo (DRC)">Congo (DRC)</option>
                  <option value="Congo">Congo</option>
                  <option value="Cook Islands">Cook Islands</option>
                  <option value="Costa Rica">Costa Rica</option>
                  <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                  <option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
                  <option value="Cuba">Cuba</option>
                  <option value="Cyprus">Cyprus</option>
                  <option value="Czech Republic">Czech Republic</option>
                  <option value="Denmark">Denmark</option>
                  <option value="Djibouti">Djibouti</option>
                  <option value="Dominica">Dominica</option>
                  <option value="Dominican Republic">Dominican Republic</option>
                  <option value="East Timor">East Timor</option>
                  <option value="Ecuador">Ecuador</option>
                  <option value="Egypt">Egypt</option>
                  <option value="El Salvador">El Salvador</option>
                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                  <option value="Eritrea">Eritrea</option>
                  <option value="Estonia">Estonia</option>
                  <option value="Ethiopia">Ethiopia</option>
                  <option value="Falkland Islands">Falkland Islands</option>
                  <option value="Faroe Islands">Faroe Islands</option>
                  <option value="Fiji Islands">Fiji Islands</option>
                  <option value="Finland">Finland</option>
                  <option value="France">France</option>
                  <option value="French Guiana">French Guiana</option>
                  <option value="French Polynesia">French Polynesia</option>
                  <option value="Gabon">Gabon</option>
                  <option value="Gambia">Gambia</option>
                  <option value="Georgia">Georgia</option>
                  <option value="Germany">Germany</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Gibraltar">Gibraltar</option>
                  <option value="Greece">Greece</option>
                  <option value="Greenland">Greenland</option>
                  <option value="Grenada">Grenada</option>
                  <option value="Guadeloupe">Guadeloupe</option>
                  <option value="Guam">Guam</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Guinea">Guinea</option>
                  <option value="Guinea-Bissau">Guinea-Bissau</option>
                  <option value="Guyana">Guyana</option>
                  <option value="Haiti">Haiti</option>
                  <option value="Honduras">Honduras</option>
                  <option value="Hong Kong SAR">Hong Kong SAR</option>
                  <option value="Hungary">Hungary</option>
                  <option value="India">India</option>
                  <option value="Iceland">Iceland</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="Iran">Iran</option>
                  <option value="Iraq">Iraq</option>
                  <option value="Ireland">Ireland</option>
                  <option value="Italy">Italy</option>
                  <option value="Jamaica">Jamaica</option>
                  <option value="Japan">Japan</option>
                  <option value="Jordan">Jordan</option>
                  <option value="Kazakhstan">Kazakhstan</option>
                  <option value="Kenya">Kenya</option>
                  <option value="Kiribati">Kiribati</option>
                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                  <option value="Kuwait">Kuwait</option>
                  <option value="Laos">Laos</option>
                  <option value="Latvia">Latvia</option>
                  <option value="Lebanon">Lebanon</option>
                  <option value="Lesotho">Lesotho</option>
                  <option value="Liberia">Liberia</option>
                  <option value="Libya">Libya</option>
                  <option value="Liechtenstein">Liechtenstein</option>
                  <option value="Lithuania">Lithuania</option>
                  <option value="Luxembourg">Luxembourg</option>
                  <option value="Macao SAR">Macao SAR</option>
                  <option value="Macedonia">Macedonia</option>
                  <option value="Madagascar">Madagascar</option>
                  <option value="Malawi">Malawi</option>
                  <option value="Malaysia">Malaysia</option>
                  <option value="Maldives">Maldives</option>
                  <option value="Mali">Mali</option>
                  <option value="Malta">Malta</option>
                  <option value="Martinique">Martinique</option>
                  <option value="Mauritania">Mauritania</option>
                  <option value="Mauritius">Mauritius</option>
                  <option value="Mayotte">Mayotte</option>
                  <option value="Mexico">Mexico</option>
                  <option value="Micronesia">Micronesia</option>
                  <option value="Moldova">Moldova</option>
                  <option value="Monaco">Monaco</option>
                  <option value="Mongolia">Mongolia</option>
                  <option value="Montserrat">Montserrat</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Mozambique">Mozambique</option>
                  <option value="Myanmar">Myanmar</option>
                  <option value="Namibia">Namibia</option>
                  <option value="Nauru">Nauru</option>
                  <option value="Nepal">Nepal</option>
                  <option value="Netherlands Antilles">Netherlands Antilles</option>
                  <option value="Netherlands">Netherlands</option>
                  <option value="New Caledonia">New Caledonia</option>
                  <option value="New Zealand">New Zealand</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Niger">Niger</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Niue">Niue</option>
                  <option value="Norfolk Island">Norfolk Island</option>
                  <option value="North Korea">North Korea</option>
                  <option value="Norway">Norway</option>
                  <option value="Oman">Oman</option>
                  <option value="Pakistan">Pakistan</option>
                  <option value="Panama">Panama</option>
                  <option value="Papua New Guinea">Papua New Guinea</option>
                  <option value="Paraguay">Paraguay</option>
                  <option value="Peru">Peru</option>
                  <option value="Philippines">Philippines</option>
                  <option value="Pitcairn Islands">Pitcairn Islands</option>
                  <option value="Poland">Poland</option>
                  <option value="Portugal">Portugal</option>
                  <option value="Puerto Rico">Puerto Rico</option>
                  <option value="Qatar">Qatar</option>
                  <option value="Reunion">Reunion</option>
                  <option value="Romania">Romania</option>
                  <option value="Russia">Russia</option>
                  <option value="Rwanda">Rwanda</option>
                  <option value="Samoa">Samoa</option>
                  <option value="Saudi Arabia">Saudi Arabia</option>
                  <option value="South Africa">South Africa</option>
                  <option value="San Marino">San Marino</option>
                  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                  <option value="Senegal">Senegal</option>
                  <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                  <option value="Seychelles">Seychelles</option>
                  <option value="Sierra Leone">Sierra Leone</option>
                  <option value="Singapore">Singapore</option>
                  <option value="Slovakia">Slovakia</option>
                  <option value="Slovenia">Slovenia</option>
                  <option value="Solomon Islands">Solomon Islands</option>
                  <option value="Somalia">Somalia</option>
                  <option value="South Korea">South Korea</option>
                  <option value="Spain">Spain</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="St. Helena">St. Helena</option>
                  <option value="St. Kitts and Nevis">St. Kitts and Nevis</option>
                  <option value="St. Lucia">St. Lucia</option>
                  <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>
                  <option value="St. Vincent &amp; Grenadines">St. Vincent &amp; Grenadines</option>
                  <option value="Sudan">Sudan</option>
                  <option value="Suriname">Suriname</option>
                  <option value="Swaziland">Swaziland</option>
                  <option value="Sweden">Sweden</option>
                  <option value="Switzerland">Switzerland</option>
                  <option value="Syria">Syria</option>
                  <option value="Taiwan">Taiwan</option>
                  <option value="Tajikistan">Tajikistan</option>
                  <option value="Tanzania">Tanzania</option>
                  <option value="Thailand">Thailand</option>
                  <option value="Togo">Togo</option>
                  <option value="Tokelau">Tokelau</option>
                  <option value="Tonga">Tonga</option>
                  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                  <option value="Tunisia">Tunisia</option>
                  <option value="Turkey">Turkey</option>
                  <option value="Turkmenistan">Turkmenistan</option>
                  <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                  <option value="Tuvalu">Tuvalu</option>
                  <option value="United Arab Emirates">United Arab Emirates</option>
                  <option value="Uganda">Uganda</option>
                  <option value="Ukraine">Ukraine</option>
                  <option value="Uruguay">Uruguay</option>
                  <option value="Uzbekistan">Uzbekistan</option>
                  <option value="Vanuatu">Vanuatu</option>
                  <option value="Venezuela">Venezuela</option>
                  <option value="Vietnam">Vietnam</option>
                  <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                  <option value="Virgin Islands">Virgin Islands</option>
                  <option value="Wallis and Futuna">Wallis and Futuna</option>
                  <option value="Yemen">Yemen</option>
                  <option value="Yugoslavia">Yugoslavia</option>
                  <option value="Zambia">Zambia</option>
                  <option value="Zimbabwe">Zimbabwe</option>
                </select>
              </div>
            </div>
            <div class="row controls">
              <div class="span6 control-group">
                <label>Full Telephone (required)</label>
                <input type="text" value="" maxlength="100" class="span6" id="phone" name="phone">
              </div>
              <div class="span6 control-group">
                <label>Best Time to Call</label>
                <select maxlength="100" class="span6" name="calltime" id="call_time">
                  <option selected="selected">Morning</option>
                  <option>Evening</option>
                  <option >Weekend</option>
                  <option>Any Time</option>
                </select>
              </div>
            </div>
            <div class="row controls">
              <div class="span12 control-group">
                <label>Message (required)</label>
                <textarea maxlength="5000" rows="10" class="span12" name="message" id="message"></textarea>
              </div>
            </div>

            <div class="row controls">
              <div class="span6 control-group" style="width:270px;">
                <label></label>
                     <?php echo $captcha; ?>
              </div>
              <div class="span6 control-group">
                <label></label>
                <input type="text" value="" maxlength="100" class="span3" name="captcha" id="captcha">                
              </div>
            </div>            
            
            <div class="btn-toolbar">
              <input type="submit" value="Register" class="btn btn-primary btn-large">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php $this->load->view('pages/footer'); ?>