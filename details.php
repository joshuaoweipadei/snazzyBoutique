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


<?php include ('function/functions.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet" media="all">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style media="screen">
    .features_items{
      margin-bottom: 235px;
    }
    .product-image-wrapper{
      border: 1px solid #000
    }
    .choose{
      margin-top: 43px
    }
    .choose ul li{
      background: #c1c1c1;
      border-top-right-radius: 14px;
      border-top-left-radius: 14px;
      margin-top: 30px
    }
    .choose ul li a {
      color: #000!important;
    }
    .productinfo h2, h5, p{
      margin-bottom: 20px
    }
    </style>
</head><!--/head-->

<body>

  <!-- REQUIRING THE HEADER -->
  <?php include_once 'includes/header.php'; ?>


  <?php include_once ('includes/auction_modal.php'); ?>


	<section><!--Main Container-->
		<div class="container">

			<div class="row">

				<div class="col-sm-12 padding-right">
          <!--features_items-->
          <?php
          if (isset($_GET['pro_id'])) {
            $product_id = $_GET['pro_id'];

            $get_product = "SELECT * FROM products WHERE productId = '$product_id'";
            $query = mysqli_query($conn, $get_product) or die(mysqli_error($conn));

            while ($row_product = mysqli_fetch_array($query)) {
              $pro_id = $row_product['productId'];
              $pro_name = $row_product['productName'];
              $pro_price = $row_product['productPrice'];
              $pro_img = $row_product['productImage'];
              $pro_desc = $row_product['productDescription'];
              ?>
          <div class="product-details"><!--product-details-->
						<div class="col-sm-7">
							<div class="view-product">
								<img src='Admin-area/product-images/<?php echo $pro_img; ?>' alt=''  />
							</div>
              <br>
              <h3>Product Description</h3>
								<p><?php echo $pro_desc; ?></p>
						</div>
						<div class="col-sm-5">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $pro_name; ?></h2>
								<!-- <p>Web ID: 1089772</p> -->
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>US $<?php echo $pro_price; ?></span>
									<button class='btn btn-default add_to_cart' id='<?php echo $pro_id ?>' ><i class='fa fa-shopping-cart'></i>Add to cart</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
                <p><b>Available Colors:</b>
                <ul class="list-in prod_color">
                  <li>
                    <p>Green</p>
                    <div class="color bg-green"></div>
                  </li>
                  <li>
                    <p>Blue</p>
                    <div class="color bg-blue"></div>
                  </li>
                  <li>
                    <p>Red</p>
                    <div class="color bg-red"></div>
                  </li>
                  <li>
                    <p>Orange</p>
                    <div class="color bg-orange"></div>
                  </li>
                  <div class='choose'>
                    <ul class='nav nav-pills nav-justified'>
                      <li><a href='index.php'><i class='fa fa-backward'></i>Go back</a></li>
                    </ul>
                  </div>
                </ul>
              </p>
								<!-- <p><b>Brand:</b> E-SHOPPER</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
							</div>
              <!--/product-information-->
						</div>
					</div>
          <!--/product-details-->
        <?php } } ?>
				</div>
        <!--end of features_items-->
			</div>
		</div>
	</section><!--End of Main Container-->


  <!-- REQUIRING THE FOOTER -->
  <?php include_once 'includes/footer.php'; ?>


    <script src="js/jquery.js"></script>
    <!-- js for adding items to cart -->
    <script src="js\cart\cart_script.js"></script>
    <!------------------------------------------------------------------------------------->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
     </script>






     <script type="text/javascript">

       $(document).ready(function(){

         $.ajax({
           type:'post',
           url:'index-test.php',
           data:{
             total_cart_items:"totalitems"
           },
           success:function(response) {
             document.getElementById("total_items").value=response;
           }
         });

       });

       function cart(id)
       {
   	  var ele=document.getElementById(id);
   	  var img_src=ele.getElementsByTagName("img")[0].src;
   	  var name=document.getElementById(id+"_name").value;
   	  var price=document.getElementById(id+"_price").value;

   	  $.ajax({
           type:'post',
           url:'index-test.php',
           data:{
             item_src:img_src,
             item_name:name,
             item_price:price
           },
           success:function(response) {
             document.getElementById("total_items").value=response;
           }
         });

       }

       function show_cart()
       {
         $.ajax({
         type:'post',
         url:'index-test.php',
         data:{
           showcart:"cart"
         },
         success:function(response) {
           document.getElementById("mycart").innerHTML=response;
           $("#mycart").slideToggle();
         }
        });

       }

   </script>

</body>
</html>
