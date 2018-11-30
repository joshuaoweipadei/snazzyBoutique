<?php

  session_start();

  include ('mysql/database.php');

  if (isset($_SESSION['customerID'])) {

    $userID = $_SESSION['customerID'];
    $firstname = $_SESSION['c_first_name'];
    $lastname = $_SESSION['c_last_name'];
    $email = $_SESSION['c_email'];
    $country = $_SESSION['c_country'];
    $city = $_SESSION['c_city'];
    $address = $_SESSION['c_address'];
    $number = $_SESSION['c_number'];
    $active = $_SESSION['c_active'];


    $sql = "SELECT * FROM customers_img WHERE customerId = '$userID'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $customerRow = mysqli_fetch_array($query);
    $_SESSION['c_image'] = $customerRow['c_Image'];
    $_SESSION['c_username'] = $customerRow['c_Username'];

    // $image = $_SESSION['c_image'];
    $username = $_SESSION['c_username'];

  }


?>

<?php

include ('function/functions.php');

 ?>

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
</head><!--/head-->

<body>

  <!-- REQUIRING THE HEADER -->
  <?php include_once 'includes/header.php'; ?>

  <?php include_once ('includes/auction_modal.php'); ?>


	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1>Jewelry Shop</h1>
                  <h2 style="color:#ffcc00">MAKE YOUR LIFE BETTER</h2>
				          <P>Genuine diamonds</P>
									<a href="login.php" class="btn btn-default get">Get it now</a>
								</div>
								<div class="col-sm-6">
									<img src="images/slide/5.jpg" class="girl img-responsive" alt="" width="100%"/>
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1>Jewelry Shop</h1>
                  <h2 style="color:#ffcc00">You deserve to be beauty</h2>
				          <p>Golden Bracelets</p>
									<a href="login.php" class="btn btn-default get">Get it now</a>
								</div>
								<div class="col-sm-6">
									<img src="images/slide/1.jpg" class="girl img-responsive" alt="" width="100%"/>
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
							</div>

							<div class="item">
								<div class="col-sm-6">
									<h1>Jewelry Shop</h1>
                  <h2 style="color:#ffe066">She will say “yes”</h2>
				          <p>Engagement Ring</p>
									<a href="login.php" class="btn btn-default get">Get it now</a>
								</div>
								<div class="col-sm-6">
									<img src="images/slide/4.jpeg" class="girl img-responsive" alt="" width="100%"/>
									<img src="images/home/pricing.png" class="pricing" alt="" />
								</div>
							</div>
						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section><!--Main Container-->
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
          <!-- LEFT HAND SIDE (layout) -->
					<div class="left-sidebar">
            <h2>Category</h2>
            <!--category-productsr-->
						<div class="panel-group category-products" id="accordian">
							<?php getCategories(); ?>
						</div>
            <!--/category-products-->

            <!--brands_products-->
						<div class="brands_products">
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php getBrands(); ?>
								</ul>
							</div>
						</div>
            <!--/brands_products-->

            <!--price-range-->
						<!-- <div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!/price-range-->

            <!--advertisement-->
						<div class="shipping text-center">
              <h4>Watche she will definitely love.</h4>
							<a href=""><img src="images/slide/2.jpg" alt="" width="100%"/></a>
              <br><br><br><br><br><br><br><br>

              <a href=""><img src="images/auction/11.png" alt="" width="100%"/></a>
						</div>
            <!--/advertisement-->

					</div>
				</div>

        <!-- RIGHT HAND SIDE (layout) -->
				<div class="col-sm-9 padding-right">
          <!--features_items-->

          <!-- DISPLAYS PRODUCT ADDED MESSAGES -->
          <div class="row">
            <div class="col-md-12" id="product_msg">

            </div>
          </div>
          <!-- DISPLAYS PRODUCT ADDED MESSAGES -->

					<div class="features_items">
						<h1 class="title text-center">New Collections!</h1>
							<?php getProduct(); ?>
              <?php getCatProduct(); ?>
              <?php getBrandProduct(); ?>
					</div>
          <!--features_items-->
				</div>
			</div>

      <div class="row">
        <div class="col-sm-12">
          <!--recommended_items-->
          <div class="recommended_items">
            <h2 class="title text-center"><span style="color:#000">New Cars Showroom</span></h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <!-- SLIDE ONE -->
                <div class="item active">
                  <?php
                  $get_product = "SELECT * FROM products ORDER BY productId DESC LIMIT 0,4";
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
                  <div class="col-sm-3">
                    <div class='product-image-wrapper'>
                      <div class='single-products'>
                        <div class='productinfo text-center'>
                          <div style='height:210px'>
                            <img src='Admin-area/product-images/<?php echo $pro_img ?>' alt='<?php echo $pro_img ?>' width="100%" height="100%"/>
                          </div>
                          <h2 style="color:#000; font-size:20px">$ <?php echo $pro_price; ?></h2>
                          <h5><b><?php echo $pro_name; ?></b></h5>
                          <button class='btn btn-default add_to_cart' id="<?php echo $pro_id ?>" style="margin-bottom:7px"><i class='fa fa-shopping-cart'></i>Add to cart</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                    }
                  ?>
                </div>
                <!-- END OF SLIDE ONE -->

                <!-- SLIDE TWO -->
                <div class="item">
                  <?php
                  $get_product = "SELECT * FROM products ORDER BY productId DESC LIMIT 4,4";
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
                  <div class="col-sm-3">
                    <div class='product-image-wrapper'>
                      <div class='single-products'>
                        <div class='productinfo text-center'>
                          <div style='height:210px'>
                            <img src='Admin-area/product-images/<?php echo $pro_img ?>' alt='<?php echo $pro_img ?>' width="100%" height="100%"/>
                          </div>
                          <h2 style="color:#000; font-size:20px">$ <?php echo $pro_price; ?></h2>
                          <h5><b><?php echo $pro_name; ?></b></h5>
                          <button class='btn btn-default add_to_cart' id="<?php echo $pro_id ?>" style="margin-bottom:7px"><i class='fa fa-shopping-cart'></i>Add to cart</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                    }
                  ?>
                </div>
                <!-- END OF SLIDE TWO -->
              </div>
              <!-- PREVIOUS AND NEXT BUTTON -->
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
            </div>
          </div>
          <!--/recommended_items-->
        </div>
      </div>
		</div>
	</section><!--End of Main Container-->


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






     <!-- <script type="text/javascript">

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

   </script> -->

</body>
</html>
