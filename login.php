<?php

session_start();

if (isset($_SESSION['customerID'])) {

  header('location: index.php');

}


include_once 'mysql/database.php';
// require ('function/country.php');

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //if the sign in button is clicked
    if (isset($_POST['sign_up'])) {
      require 'includes/sign_up.php';

      //if the sign up button si clicked
    } elseif (isset($_POST['sign_in'])) {
      require 'includes/sign_in.php';
    }
  }
 ?>

<body>
  <!-- REQUIRING THE HEADER -->

  <header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="index.php"><img src="images/home/logo.png" alt="" /></a>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
  </header><!--/header-->




	<section id="form"><!--form-->
		<div class="container">
      <div class="" align="center">
        <h3>Login or Register to Buy Cars at an Affortable Price..!</h3>
      </div>
        <!--ERROR MESSAGES-->
        <?php if(isset($errorMsg)) {
          echo "<div class='row error'>$errorMsg</div>" ;
        } elseif (isset($successMsg)) {
          echo "<div class='row success'>$successMsg</div>" ;
        } ?>
        <!--END OF ERROR MESSAGES-->

			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
							<input type="email" name="email" placeholder="Email Address" />
              <br>
							<input type="password" name="password" placeholder="Password" />

							<button type="submit" name="sign_in" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
							<input type="text" name="firstname" placeholder="First Name"/>
              <br>
              <input type="text" name="lastname" placeholder="Last Name"/>
              <br>
							<input type="email" name="email" placeholder="Email Address"/>
              <br>

              <select id="country" name="country">
                <option disabled>--select your country--</option>

	<!-- <option value="AD">AD - Andorra (+376)</option>
	<option value="AE">AE - United Arab Emirates (+971)</option>
	<option value="AF">AF - Afghanistan (+93)</option>
	<option value="AG">AG - Antigua And Barbuda (+1268)</option>
	<option value="AI">AI - Anguilla (+1264)</option>
	<option value="AL">AL - Albania (+355)</option>
	<option value="AM">AM - Armenia (+374)</option>
	<option value="AN">AN - Netherlands Antilles (+599)</option>
	<option value="AO">AO - Angola (+244)</option>
	<option value="AQ">AQ - Antarctica (+672)</option>
	<option value="AR">AR - Argentina (+54)</option>
	<option value="AS">AS - American Samoa (+1684)</option>
	<option value="AT">AT - Austria (+43)</option>
	<option value="AU">AU - Australia (+61)</option>
	<option value="AW">AW - Aruba (+297)</option>
	<option value="AZ">AZ - Azerbaijan (+994)</option>
	<option value="BA">BA - Bosnia And Herzegovina (+387)</option>
	<option value="BB">BB - Barbados (+1246)</option>
	<option value="BD">BD - Bangladesh (+880)</option>
	<option value="BE">BE - Belgium (+32)</option>
	<option value="BF">BF - Burkina Faso (+226)</option>
	<option value="BG">BG - Bulgaria (+359)</option>
	<option value="BH">BH - Bahrain (+973)</option>
	<option value="BI">BI - Burundi (+257)</option>
	<option value="BJ">BJ - Benin (+229)</option>
	<option value="BL">BL - Saint Barthelemy (+590)</option>
	<option value="BM">BM - Bermuda (+1441)</option>
	<option value="BN">BN - Brunei Darussalam (+673)</option>
	<option value="BO">BO - Bolivia (+591)</option>
	<option value="BR">BR - Brazil (+55)</option>
	<option value="BS">BS - Bahamas (+1242)</option>
	<option value="BT">BT - Bhutan (+975)</option>
	<option value="BW">BW - Botswana (+267)</option>
	<option value="BY">BY - Belarus (+375)</option>
	<option value="BZ">BZ - Belize (+501)</option>
	<option value="CA">CA - Canada (+1)</option>
	<option value="CC">CC - Cocos (keeling) Islands (+61)</option>
	<option value="CD">CD - Congo, The Democratic Republic Of The (+243)</option>
	<option value="CF">CF - Central African Republic (+236)</option>
	<option value="CG">CG - Congo (+242)</option>
	<option value="CH">CH - Switzerland (+41)</option>
	<option value="CI">CI - Cote D Ivoire (+225)</option>
	<option value="CK">CK - Cook Islands (+682)</option>
	<option value="CL">CL - Chile (+56)</option>
	<option value="CM">CM - Cameroon (+237)</option>
	<option value="CN">CN - China (+86)</option>
	<option value="CO">CO - Colombia (+57)</option>
	<option value="CR">CR - Costa Rica (+506)</option>
	<option value="CU">CU - Cuba (+53)</option>
	<option value="CV">CV - Cape Verde (+238)</option>
	<option value="CX">CX - Christmas Island (+61)</option>
	<option value="CY">CY - Cyprus (+357)</option>
	<option value="CZ">CZ - Czech Republic (+420)</option>
	<option value="DE">DE - Germany (+49)</option>
	<option value="DJ">DJ - Djibouti (+253)</option>
	<option value="DK">DK - Denmark (+45)</option>
	<option value="DM">DM - Dominica (+1767)</option>
	<option value="DO">DO - Dominican Republic (+1809)</option>
	<option value="DZ">DZ - Algeria (+213)</option>
	<option value="EC">EC - Ecuador (+593)</option>
	<option value="EE">EE - Estonia (+372)</option>
	<option value="EG">EG - Egypt (+20)</option>
	<option value="ER">ER - Eritrea (+291)</option>
	<option value="ES">ES - Spain (+34)</option>
	<option value="ET">ET - Ethiopia (+251)</option>
	<option value="FI">FI - Finland (+358)</option>
	<option value="FJ">FJ - Fiji (+679)</option>
	<option value="FK">FK - Falkland Islands (malvinas) (+500)</option>
	<option value="FM">FM - Micronesia, Federated States Of (+691)</option>
	<option value="FO">FO - Faroe Islands (+298)</option>
	<option value="FR">FR - France (+33)</option>
	<option value="GA">GA - Gabon (+241)</option>
	<option value="GB">GB - United Kingdom (+44)</option>
	<option value="GD">GD - Grenada (+1473)</option>
	<option value="GE">GE - Georgia (+995)</option>
	<option value="GH">GH - Ghana (+233)</option>
	<option value="GI">GI - Gibraltar (+350)</option>
	<option value="GL">GL - Greenland (+299)</option>
	<option value="GM">GM - Gambia (+220)</option>
	<option value="GN">GN - Guinea (+224)</option>
	<option value="GQ">GQ - Equatorial Guinea (+240)</option>
	<option value="GR">GR - Greece (+30)</option>
	<option value="GT">GT - Guatemala (+502)</option>
	<option value="GU">GU - Guam (+1671)</option>
	<option value="GW">GW - Guinea-bissau (+245)</option>
	<option value="GY">GY - Guyana (+592)</option>
	<option value="HK">HK - Hong Kong (+852)</option>
	<option value="HN">HN - Honduras (+504)</option>
	<option value="HR">HR - Croatia (+385)</option>
	<option value="HT">HT - Haiti (+509)</option>
	<option value="HU">HU - Hungary (+36)</option>
	<option value="ID">ID - Indonesia (+62)</option>
	<option value="IE">IE - Ireland (+353)</option>
	<option value="IL">IL - Israel (+972)</option>
	<option value="IM">IM - Isle Of Man (+44)</option>
	<option value="IN">IN - India (+91)</option>
	<option value="IQ">IQ - Iraq (+964)</option>
	<option value="IR">IR - Iran, Islamic Republic Of (+98)</option>
	<option value="IS">IS - Iceland (+354)</option>
	<option value="IT">IT - Italy (+39)</option>
	<option value="JM">JM - Jamaica (+1876)</option>
	<option value="JO">JO - Jordan (+962)</option>
	<option value="JP">JP - Japan (+81)</option>
	<option value="KE">KE - Kenya (+254)</option>
	<option value="KG">KG - Kyrgyzstan (+996)</option>
	<option value="KH">KH - Cambodia (+855)</option>
	<option value="KI">KI - Kiribati (+686)</option>
	<option value="KM">KM - Comoros (+269)</option>
	<option value="KN">KN - Saint Kitts And Nevis (+1869)</option>
	<option value="KP">KP - Korea Democratic Peoples Republic Of (+850)</option>
	<option value="KR">KR - Korea Republic Of (+82)</option>
	<option value="KW">KW - Kuwait (+965)</option>
	<option value="KY">KY - Cayman Islands (+1345)</option>
	<option value="KZ">KZ - Kazakstan (+7)</option>
	<option value="LA">LA - Lao Peoples Democratic Republic (+856)</option>
	<option value="LB">LB - Lebanon (+961)</option>
	<option value="LC">LC - Saint Lucia (+1758)</option>
	<option value="LI">LI - Liechtenstein (+423)</option>
	<option value="LK">LK - Sri Lanka (+94)</option>
	<option value="LR">LR - Liberia (+231)</option>
	<option value="LS">LS - Lesotho (+266)</option>
	<option value="LT">LT - Lithuania (+370)</option>
	<option value="LU">LU - Luxembourg (+352)</option>
	<option value="LV">LV - Latvia (+371)</option>
	<option value="LY">LY - Libyan Arab Jamahiriya (+218)</option>
	<option value="MA">MA - Morocco (+212)</option>
	<option value="MC">MC - Monaco (+377)</option>
	<option value="MD">MD - Moldova, Republic Of (+373)</option>
	<option value="ME">ME - Montenegro (+382)</option>
	<option value="MF">MF - Saint Martin (+1599)</option>
	<option value="MG">MG - Madagascar (+261)</option>
	<option value="MH">MH - Marshall Islands (+692)</option>
	<option value="MK">MK - Macedonia, The Former Yugoslav Republic Of (+389)</option>
	<option value="ML">ML - Mali (+223)</option>
	<option value="MM">MM - Myanmar (+95)</option>
	<option value="MN">MN - Mongolia (+976)</option>
	<option value="MO">MO - Macau (+853)</option>
	<option value="MP">MP - Northern Mariana Islands (+1670)</option>
	<option value="MR">MR - Mauritania (+222)</option>
	<option value="MS">MS - Montserrat (+1664)</option>
	<option value="MT">MT - Malta (+356)</option>
	<option value="MU">MU - Mauritius (+230)</option>
	<option value="MV">MV - Maldives (+960)</option>
	<option value="MW">MW - Malawi (+265)</option>
	<option value="MX">MX - Mexico (+52)</option>
	<option value="MY">MY - Malaysia (+60)</option>
	<option value="MZ">MZ - Mozambique (+258)</option>
	<option value="NA">NA - Namibia (+264)</option>
	<option value="NC">NC - New Caledonia (+687)</option>
	<option value="NE">NE - Niger (+227)</option>
	<option value="NG">NG - Nigeria (+234)</option>
	<option value="NI">NI - Nicaragua (+505)</option>
	<option value="NL">NL - Netherlands (+31)</option>
	<option value="NO">NO - Norway (+47)</option>
	<option value="NP">NP - Nepal (+977)</option>
	<option value="NR">NR - Nauru (+674)</option>
	<option value="NU">NU - Niue (+683)</option>
	<option value="NZ">NZ - New Zealand (+64)</option>
	<option value="OM">OM - Oman (+968)</option>
	<option value="PA">PA - Panama (+507)</option>
	<option value="PE">PE - Peru (+51)</option>
	<option value="PF">PF - French Polynesia (+689)</option>
	<option value="PG">PG - Papua New Guinea (+675)</option>
	<option value="PH">PH - Philippines (+63)</option>
	<option value="PK">PK - Pakistan (+92)</option>
	<option value="PL">PL - Poland (+48)</option>
	<option value="PM">PM - Saint Pierre And Miquelon (+508)</option>
	<option value="PN">PN - Pitcairn (+870)</option>
	<option value="PR">PR - Puerto Rico (+1)</option>
	<option value="PT">PT - Portugal (+351)</option>
	<option value="PW">PW - Palau (+680)</option>
	<option value="PY">PY - Paraguay (+595)</option>
	<option value="QA">QA - Qatar (+974)</option>
	<option value="RO">RO - Romania (+40)</option>
	<option value="RS">RS - Serbia (+381)</option>
	<option value="RU">RU - Russian Federation (+7)</option>
	<option value="RW">RW - Rwanda (+250)</option>
	<option value="SA">SA - Saudi Arabia (+966)</option>
	<option value="SB">SB - Solomon Islands (+677)</option>
	<option value="SC">SC - Seychelles (+248)</option>
	<option value="SD">SD - Sudan (+249)</option>
	<option value="SE">SE - Sweden (+46)</option>
	<option value="SG">SG - Singapore (+65)</option>
	<option value="SH">SH - Saint Helena (+290)</option>
	<option value="SI">SI - Slovenia (+386)</option>
	<option value="SK">SK - Slovakia (+421)</option>
	<option value="SL">SL - Sierra Leone (+232)</option>
	<option value="SM">SM - San Marino (+378)</option>
	<option value="SN">SN - Senegal (+221)</option>
	<option value="SO">SO - Somalia (+252)</option>
	<option value="SR">SR - Suriname (+597)</option>
	<option value="ST">ST - Sao Tome And Principe (+239)</option>
	<option value="SV">SV - El Salvador (+503)</option>
	<option value="SY">SY - Syrian Arab Republic (+963)</option>
	<option value="SZ">SZ - Swaziland (+268)</option>
	<option value="TC">TC - Turks And Caicos Islands (+1649)</option>
	<option value="TD">TD - Chad (+235)</option>
	<option value="TG">TG - Togo (+228)</option>
	<option value="TH">TH - Thailand (+66)</option>
	<option value="TJ">TJ - Tajikistan (+992)</option>
	<option value="TK">TK - Tokelau (+690)</option>
	<option value="TL">TL - Timor-leste (+670)</option>
	<option value="TM">TM - Turkmenistan (+993)</option>
	<option value="TN">TN - Tunisia (+216)</option>
	<option value="TO">TO - Tonga (+676)</option>
	<option value="TR">TR - Turkey (+90)</option>
	<option value="TT">TT - Trinidad And Tobago (+1868)</option>
	<option value="TV">TV - Tuvalu (+688)</option>
	<option value="TW">TW - Taiwan, Province Of China (+886)</option>
	<option value="TZ">TZ - Tanzania, United Republic Of (+255)</option>
	<option value="UA">UA - Ukraine (+380)</option>
	<option value="UG">UG - Uganda (+256)</option>
	<option value="US">US - United States (+1)</option>
	<option value="UY">UY - Uruguay (+598)</option>
	<option value="UZ">UZ - Uzbekistan (+998)</option>
	<option value="VA">VA - Holy See (vatican City State) (+39)</option>
	<option value="VC">VC - Saint Vincent And The Grenadines (+1784)</option>
	<option value="VE">VE - Venezuela (+58)</option>
	<option value="VG">VG - Virgin Islands, British (+1284)</option>
	<option value="VI">VI - Virgin Islands, U.s. (+1340)</option>
	<option value="VN">VN - Viet Nam (+84)</option>
	<option value="VU">VU - Vanuatu (+678)</option>
	<option value="WF">WF - Wallis And Futuna (+681)</option>
	<option value="WS">WS - Samoa (+685)</option>
	<option value="XK">XK - Kosovo (+381)</option>
	<option value="YE">YE - Yemen (+967)</option>
	<option value="YT">YT - Mayotte (+262)</option>
	<option value="ZA">ZA - South Africa (+27)</option>
	<option value="ZM">ZM - Zambia (+260)</option>
	<option value="ZW">ZW - Zimbabwe (+263)</option> -->

                <option>Afghanistan</option>
                <option>India</option>
                <option>Japan</option>
                <option>Nigeria</option>
                <option>Pakistan</option>
                <option>Isreal</option>
                <option>Nepal</option>
                <option>United Arab Emirates</option>
                <option>China</option>
                <option>USA</option>
                <option>Canada</option>
                <option>United Kingdom</option>
              </select><br>
              <input type="text" name="city" placeholder="City"/>
              <br>
              <input type="text" name="address" placeholder="Contact Address"/>
              <br>
              <input type="text" name="mobile" placeholder="Mobile Number"/>
              <br>
							<input type="password" name="password" placeholder="Password"/>
              <br>
              <input type="password" name="verifypassword" placeholder="Verify Password"/>
              <br>
							<button type="submit" name="sign_up" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


  <!-- REQUIRING THE FOOTER -->

  <footer id="footer"><!--Footer-->
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <div class="companyinfo">
              <h2><span>e</span>-shopper</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
            </div>
          </div>
          <div class="col-sm-7">
            <div class="col-sm-3">
              <div class="video-gallery text-center">
                <a href="#">
                  <div class="iframe-img">
                    <img src="images/home/iframe1.png" alt="" />
                  </div>
                  <div class="overlay-icon">
                    <i class="fa fa-play-circle-o"></i>
                  </div>
                </a>
                <p>Circle of Hands</p>
                <h2>24 DEC 2014</h2>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="video-gallery text-center">
                <a href="#">
                  <div class="iframe-img">
                    <img src="images/home/iframe2.png" alt="" />
                  </div>
                  <div class="overlay-icon">
                    <i class="fa fa-play-circle-o"></i>
                  </div>
                </a>
                <p>Circle of Hands</p>
                <h2>24 DEC 2014</h2>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="video-gallery text-center">
                <a href="#">
                  <div class="iframe-img">
                    <img src="images/home/iframe3.png" alt="" />
                  </div>
                  <div class="overlay-icon">
                    <i class="fa fa-play-circle-o"></i>
                  </div>
                </a>
                <p>Circle of Hands</p>
                <h2>24 DEC 2014</h2>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="video-gallery text-center">
                <a href="#">
                  <div class="iframe-img">
                    <img src="images/home/iframe4.png" alt="" />
                  </div>
                  <div class="overlay-icon">
                    <i class="fa fa-play-circle-o"></i>
                  </div>
                </a>
                <p>Circle of Hands</p>
                <h2>24 DEC 2014</h2>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="address">
              <img src="images/home/map.png" alt="" />
              <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Service</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Online Help</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Order Status</a></li>
                <li><a href="#">Change Location</a></li>
                <li><a href="#">FAQ’s</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Quock Shop</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">T-Shirt</a></li>
                <li><a href="#">Mens</a></li>
                <li><a href="#">Womens</a></li>
                <li><a href="#">Gift Cards</a></li>
                <li><a href="#">Shoes</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>Policies</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Privecy Policy</a></li>
                <li><a href="#">Refund Policy</a></li>
                <li><a href="#">Billing System</a></li>
                <li><a href="#">Ticket System</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="single-widget">
              <h2>About Shopper</h2>
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">Company Information</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Store Location</a></li>
                <li><a href="#">Affillate Program</a></li>
                <li><a href="#">Copyright</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3 col-sm-offset-1">
            <!--CHANGE LANGUAGE-->
            <dl id="sample" class="dropdown">
              <dt><a><span>Change Language <i class="fa fa-arrow-down"></i> </span></a></dt>
                <dd>
                  <ul>
                    <li><a href="#">Australia<img class="flag" src="images/flag/as.png" alt="" /><span class="value">AS</span></a></li>
                    <li><a href="#">Sri Lanka<img class="flag" src="images/flag/srl.png" alt="" /><span class="value">SL</span></a></li>
                    <li><a href="#">Newziland<img class="flag" src="images/flag/nz.png" alt="" /><span class="value">NZ</span></a></li>
                    <li><a href="#">Pakistan<img class="flag" src="images/flag/pk.png" alt="" /><span class="value">Pk</span></a></li>
                    <li><a href="#">United Kingdom<img class="flag" src="images/flag/uk.png" alt="" /><span class="value">UK</span></a></li>
                    <li><a href="#">United States<img class="flag" src="images/flag/us.png" alt="" /><span class="value">US</span></a></li>
                  </ul>
               </dd>
            </dl><br><br><br>
            <!--END OF CHANGE LANGUAGE-->
            <div class="single-widget">
              <h2>About Shopper</h2>
              <form action="#" class="searchform">
                <input type="text" placeholder="Your email address" />
                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                <p>Get the most recent updates from <br />our site and be updated your self...</p>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
          <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
        </div>
      </div>
    </div>

  </footer><!--/Footer-->




    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
