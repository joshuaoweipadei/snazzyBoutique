<?php

  session_start();

  require ('mysql/database.php');


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
    <title>Checkout | E-Shopper</title>
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
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

      <div class="row">
        <div class="col-md-10">
    			<div class="step-one">
    				<h2 class="heading">Step1</h2>
    			</div>
    			<div class="checkout-options">
    				<h3>New User</h3>
    				<p>Checkout options</p>
    				<ul class="nav">
    					<li>
    						<label><input type="checkbox"> Register Account</label>
    					</li>
    					<li>
    						<label><input type="checkbox"> Guest Checkout</label>
    					</li>
    					<li>
    						<a href=""><i class="fa fa-times"></i>Cancel</a>
    					</li>
    				</ul>
    			</div><!--/checkout-options-->

    			<div class="register-req">
    				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
    			</div><!--/register-req-->
        </div>
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

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
								<input type="password" placeholder="Password">
								<input type="password" placeholder="Confirm password">
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>
					</div>
				</div>
			</div>

			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

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
                <!-- PAY NOW WITH PAYPAL -->
                <div class="">
                  <!-- Mini browser method -->
                  <form action="https://www.sandbox.paypal.com/webapps/adaptivepayment/flow/pay" target="PPDGFrame" class="standard">
                    <label for="buy">Buy Now:</label>
                    <input type="image" id="submitBtn" value="Pay with Paypal" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif">
                    <input type="hidden" id="type" name="expType" value="mini">
                    <input type="hidden" id="paykey" name="paykey" value="insert_pay_key">

                    <!-- Identify your business so that you can collect the payments -->
                    <input type="hidden" name="business" value="oweipadeijoshie@gmail.com">

                    <!-- Specify a Buy Now button -->
                    <input type="hidden" name="cmd" value="_xclick" />

                    <!-- Specify details about the item that buyers will purchase -->
                    <input type="hidden" name="item_name" value="Hot Suace-120 Bottle">
                    <input type="hidden" name="first_name" value="Customer's First Name" />
                    <input type="hidden" name="last_name" value="Customer's Last Name" />
                    <input type="hidden" name="payer_email" value="customer@example.com" />
                    <input type="hidden" name="item_number" value="123456" / >
                    <input type="hidden" name="amount" value="<?php  echo $total; ?>" / >
                  </form>
                  <script type="text/javascript" charset="utf-8">
                    var dgFlowMini = new PAYPAL.apps.DGFlowMINI({trigger : 'submitBtn'});
                  </script>
                <div>
                <!-- END OF PAY NOW WITH PAYPAL -->
    					</div>
    				</div>
          <?php } ?>
    			</div>
          <div class="">

          </div>
    		</div>
    	</section><!--/#do_action-->

    </div>
  </section>


  <!-- REQUIRING THE FOOTER -->
  <?php include_once 'includes/footer.php'; ?>



    <script src="js/jquery.js"></script>
    <!-- js for adding items to cart -->
    <?php if (isset($_SESSION['customerID'])) {?>
    <script src="js\cart\cart_script.js"></script>
    <?php } ?>
    <!------------------------------------------------------------------------------------->
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
