<?php

  session_start();


  // Check if user is logged in using the session variable
  if (!isset($_SESSION['customerID']) && $_SESSION['c_active'] != 1) {

    header('location: login.php');

  }else {
    //SESSION VARIABLE DECLARED
    // Makes it easier to read
    $userID = $_SESSION['customerID'];
    $firstname = $_SESSION['c_first_name'];
    $lastname = $_SESSION['c_last_name'];
    $email = $_SESSION['c_email'];
    $user_name = $_SESSION['c_country'];
    $active = $_SESSION['c_active'];

  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contact | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS PLUGINS -->
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
  	<link href="css/main.css" rel="stylesheet">
  	<link href="css/responsive.css" rel="stylesheet">

    <link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
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

<body>
  <!-- REQUIRING THE HEADER -->
  <?php include_once 'includes/header.php'; ?>

  <?php include_once ('includes/auction_modal.php'); ?>

	 <div id="contact-page" class="container">
    	<div class="bg">
        <!--OUR TEAM  -->
  			<div class="row team_box">
  				<h3 class="m_2">Our Team</h3>
  				<div class="col-md-3 team1">
  				  <a class="popup-with-zoom-anim" href="#small-dialog1" >
              <img src="images/blog/1.jpg" title="continue" alt="" width="100%"/>
            </a>
  				  <div id="small-dialog1" class="mfp-hide">
  					  <div class="pop_up2">
    					   <h2>Lm ipsum </h2>
    						 <p>Lorem ioreet dolore ma lobortis nisl ut aliquip rerit in vulputate velit esse molestie.</p>
  					   </div>
  					</div>
  					<h4 class="m_5"><a href="#">Lorem Ipsum is simply dummy</a></h4>
  				    <p class="m_6">sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna</p>
  				</div>
  				<div class="col-md-3 team1">
  					<a class="popup-with-zoom-anim" href="#small-dialog2">
              <img src="images/blog/2.jpg" title="continue" alt="" width="100%"/>
            </a>
  				    <div id="small-dialog2" class="mfp-hide">
  					   <div class="pop_up2">
  					   	 <h2>Lodasdsgfjnghfdem </h2>
  						 <p>Lorem ipsolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie.</p>
					   </div>
					</div>
					<h4 class="m_5"><a href="#">simply dummy</a></h4>
				    <p class="m_6">sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna</p>
				</div>
				<div class="col-md-3 team1">
					<a class="popup-with-zoom-anim" href="#small-dialog3">
            <img src="images/blog/3.jpg" title="continue" alt="" width="100%"/>
          </a>
				    <div id="small-dialog3" class="mfp-hide">
					   <div class="pop_up2">
					   	 <h2>Lorem jhhjhbkj</h2>
						 <p>Loremna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie.</p>
					   </div>
					</div>
					<h4 class="m_5"><a href="#">dummy</a></h4>
				    <p class="m_6">sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna</p>
				</div>
				<div class="col-md-3 team1">
					<a class="popup-with-zoom-anim" href="#small-dialog4">
            <img src="images/blog/4.jpg" title="continue" alt="" width="100%"/>
          </a>
				    <div id="small-dialog4" class="mfp-hide">
					   <div class="pop_up2">
					   	 <h2>Lorem</h2>
						 <p>Loreiquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie.</p>
					   </div>
					</div>
					<h4 class="m_5"><a href="#">Lorem Ipsum is simply dummy</a></h4>
				    <p class="m_6">sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 team_bottom">
				  <ul class="team_list">
					<h4>Advantages</h4>
            <li><a href="#">Always free from repetition</a><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p></li>
            <li><a href="#">Always free from repetition</a><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p></li>
            <li><a href="#">Always free from repetition</a><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p></li>
            <li><a href="#">Always free from repetition</a><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p></li>
          </ul>
				</div>
				<div class="col-md-8">
					<ul>
					 <h4>Vision Statement</h4>
					 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
             <div class="col-md-12" style="width:100%; height: 300px; background:#400080">
               <img src="images/blog/1.jpg" class="" alt="" width="100%" height="100%"/>
             </div>
          </ul>
				</div>
			</div>
    		<div class="row">
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" action="sendemail.php" method="post">
  		            <div class="form-group col-md-6">
  		                <input type="text" name="name" class="form-control"  placeholder="Name">
  		            </div>
  		            <div class="form-group col-md-6">
  		                <input type="email" name="email" class="form-control"  placeholder="Email">
  		            </div>
  		            <div class="form-group col-md-12">
  		                <input type="text" name="subject" class="form-control"  placeholder="Subject">
  		            </div>
  		            <div class="form-group col-md-12">
  		                <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
  		            </div>
  		            <div class="form-group col-md-12">
  		                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
  		            </div>
				       </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>
	    	</div>
    	</div>
    </div><!--/#contact-page-->

    <!-- REQUIRING THE FOOTER -->
    <?php include_once 'includes/footer.php'; ?>


    <script src="js/jquery.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
			});
		});
		</script>
    <!-- END OF Add fancyBox main JS and CSS files -->

    <!-- js for adding items to cart -->
    <?php if (isset($_SESSION['customerID'])) {?>
    <script src="js\cart\cart_script.js"></script>
    <?php } ?>
    <!------------------------------------------------------------------------------------->
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
	<script src="js/contact.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
