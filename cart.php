<?php

  session_start();


  // // Check if user is logged in using the session variable
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


  include ('mysql/database.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | E-Shopper</title>
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

<body>
  <!-- REQUIRING THE HEADER -->
  <?php include_once 'includes/header.php'; ?>

  <?php include_once ('includes/auction_modal.php'); ?>


	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>

      <!-- DISPLAYS CART ITEMS AND PRICES -->
      <div class="col-md-10">
      <div class="panel panel-primary">
        <div class="panel-heading"></div>
        <div class="panel-body">
          <div class="row" style="margin-bottom:13px">
            <div class="col-sm-2"><b>Product Name</b></div>
            <div class="col-sm-3"><b>Product Image</b></div>
            <div class="col-sm-1"><b>Qty</b></div>
            <div class="col-sm-2"><b>Price</b></div>
            <div class="col-sm-2"><b>Total</b></div>
            <div class="col-sm-2"><b>Actions</b></div>
          </div>
          <!-- displays the total item of a particular user from the database -->
          <div id="cart_checkout"></div>
        </div>
      </div>
    </div>
      <!-- END OF DISPLAYS CART ITEMS AND PRICES -->
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>

							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
        <?php
          $sql = "SELECT SUM(total_Price) AS TotalItemsOrdered FROM cart WHERE user_Id = '$userID'";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if ($query) {

            $sum = mysqli_fetch_array($query);
            $cart_sub_total = $sum['TotalItemsOrdered'];

            $grand = $cart_sub_total + 1000;
         ?>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$<?php echo $cart_sub_total; ?></span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$<?php echo $grand; ?></span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
      <?php } ?>
			</div>
		</div>
	</section><!--/#do_action-->

  <!-- REQUIRING THE FOOTER -->
  <?php include_once 'includes/footer.php'; ?>



  <script src="js/jquery.js"></script>
<!-- js for adding items to cart -->
<?php if (isset($_SESSION['customerID'])) {?>
<script src="js\cart\cart_script.js"></script>
<?php } ?>
<!------------------------------------------------------------------------------------->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>
