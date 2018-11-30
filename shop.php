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
    <title>Shop | E-Shopper</title>
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
	<!-- <section id="advertisement">
		<div class="container">
			<img src="images\shop\Shoppingcart.png" alt="" width="10px" height="100px"/>
		</div>
	</section> -->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
            <!--Displays All the product items -->

            <?php

            $get_product = "SELECT * FROM products ";
            $query = mysqli_query($conn, $get_product) or die(mysqli_error($conn));

            while ($row_product = mysqli_fetch_array($query)) {
              $pro_id = $row_product['productId'];
              $pro_name = $row_product['productName'];
              $pro_brand = $row_product['productBrand'];
              $pro_cat = $row_product['productCat'];
              $pro_price = $row_product['productPrice'];
              $pro_img = $row_product['productImage'];
              // $pro_desc = $row_product['productDescription'];
              ?>
              <div class='col-sm-3 ass'>
                <div class='product-image-wrapper'>
                  <div class='single-products'>
                    <div class='productinfo text-center'>
                      <div style='height:137px'>
                        <img src='Admin-area/product-images/<?php echo $pro_img ?>' alt='<?php echo $pro_img ?>' />
                      </div>
                      <h2>US $<?php echo $pro_price; ?></h2>
                      <h5><b><?php echo $pro_name; ?></b></h5>
                      <button class='btn btn-default add_to_cart' id="<?php echo $pro_id ?>"><i class='fa fa-shopping-cart'></i>Add to cart</button>
                    </div>
                  </div>
                  <div class='choose'>
                    <ul class='nav nav-pills nav-justified'>
                      <li><a href='details.php?pro_id=<?php echo $pro_id ?>'><i class='fa fa-plus-square'></i>Details</a></li>
                      <li><a href='product-details.php?pro_id=<?php echo $pro_id ?>'>Rate Us <i class='fa fa-star'></i><i class='fa fa-star-half-full'></i></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            <?php
              }
            ?>






						<ul class="pagination" id="pageNo">
							<li class="active"><a href="">1</a></li>

							<li><a href="">&raquo;</a></li>
						</ul>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>

  <!-- REQUIRING THE FOOTER -->
  <?php include_once 'includes/footer.php'; ?>




</body>
</html>

<script src="js/jquery.js"></script>
<!-- js for adding items to cart -->
<script src="js\cart\cart_script.js"></script>
<!------------------------------------------------------------------------------------->
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
