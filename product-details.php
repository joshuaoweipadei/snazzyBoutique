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


  include ('mysql/database.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
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



  <!-- getting the product id to display riviews and rating -->
  <?php
    if (isset($_GET['pro_id'])) {
      $pro_id = $_GET['pro_id'];

      $sql = "SELECT * FROM products WHERE productId = '$pro_id'";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      if ($query) {
        if (mysqli_num_rows($query) == 1) {
          $row = mysqli_fetch_array($query);

            $product_id = $row['productId'];
            $product_name = $row['productName'];
        }
      }



    }
   ?>
   <?php
   // requring review.php script
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       if (isset($_POST['reviews'])) {
         require 'includes/reviews.php';
       }
     }
    ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 padding-right">
					<div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
              <div class="" id="reviews" >
								<div class="col-sm-12">
                  <h3 class="fat">REVIEWS</h3>
                  <?php
                  $sql1 = "SELECT * FROM reviews WHERE product_id = '$pro_id' ORDER BY review_date DESC";
                  $query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
                  if ($query1) {
                    while ($reviews = mysqli_fetch_array($query1)){
                      $item_name = $reviews['product_name'];
                      $item_review = $reviews['review'];
                      $item_reviewer_name = $reviews['reviewer_name'];
                      $item_reviewer_email = $reviews['reviewer_email'];
                      $item_rating = $reviews['rating'];
                      $item_review_date = $reviews['review_date'];

                      $dateTime = strtotime($item_review_date);
                      $date = date('d-m-y', $dateTime);
                      $time = date('H:i:s A', $dateTime);


                   ?>
                   <div class="row">
                     <div class="col-sm-1 view_container" style="background:#fff">
                       <h1></h1>
                     </div>
                     <div class="col-sm-11 view_container">
                       <div class="views">
                         <ul>
       										<li>
                             <h4><i class="fa fa-user"></i><?php echo $item_reviewer_name; ?> <span style="font-size:11px; text-transform: lowercase;"> <?php echo $item_reviewer_email; ?></span></h4>
                           </li>
       										<li style="float:right; color:#000"><i class="fa fa-clock-o" style="color:#000"></i><?php echo $time; ?></li>
       										<li style="float:right; color:#000"><i class="fa fa-calendar-o" style="color:#000"></i><?php echo $date; ?></li>
       									</ul>
                       </div>
                       <p style="margin-left:4%"><?php echo $item_review; ?></p>
                       <h3 align="right">
                         <?php
                          switch ($item_rating) {
                              case "5":
                                  echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-full'></i>";
                                  break;
                              case "4":
                                  echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-full'></i>";
                                  break;
                              case "3":
                                  echo "<i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star-half-full'></i>";
                                  break;
                              case "2":
                                  echo "<i class='fa fa-star'></i><i class='fa fa-star-half-full'></i>";
                                  break;
                              default:
                                  echo "<i class='fa fa-star-half-full'></i>";
                          }
                          ?>
                       </h3>
                     </div>
                   </div>
                  <?php
                    } }
                   ?>

                   <br><br>
									<p><b>Write Your Review</b></p>
									<form action="" method="post" accept-charset="utf-8">
										<div class="form-review">
                      <input type="hidden" name="id" value="<?php echo $userID; ?>"/>
											<input type="hidden" name="name" value="<?php echo $firstname." ".$lastname; ?>"/>
											<input type="hidden" name="email" value="<?php echo $email; ?>"/>
										</div>
										<textarea name="review" placeholder="Say something about our product.."></textarea>
										<p><label for="rating">Rating: </label><br>
                      <div class="col-sm-2">
                        Excellent/Great <br><input type="radio" name="radio" class="rating5" value="5"/> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>
                      </div>
                      <div class="col-sm-2">
                        I Love it <br><input type="radio" name="radio" class="rating4" value="4"/> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>
                      </div>
                      <div class="col-sm-2">
                        Good but <br><input type="radio" name="radio" class="rating3" value="3"/> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>
                      </div>
                      <div class="col-sm-2">
                        Nice <br><input type="radio" name="radio" class="rating2" value="2"/> <i class="fa fa-star"></i><i class="fa fa-star-half-full"></i>
                      </div>
                      <div class="col-sm-2">
                        Not so Great <br><input type="radio" name="radio" class="rating1" value="1"/> <i class="fa fa-star-half-full"></i>
                      </div>
                    </p>
                    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                    <button type="submit" name="reviews" class="btn btn-default pull-right">Submit</button>
									</form>
								</div><br><br><br><br>
                <!--ERROR/SUCCESS MESSAGES-->
                <?php if(isset($errorMsg)) {
                  echo "<div style='color:#ff3300; font-size:15px; font-weight:600; margin-top:7px'>$errorMsg</div>" ;
                } elseif (isset($successMsg)) {
                  echo "<div style='color:#339933; font-size:15px; font-weight:600; margin-top:7px'>$successMsg</div>" ;
                } ?>
                <!--END OF ERROR/SUCCESS MESSAGES-->
							</div>
            </div>
					</div><!--/category-tab-->
				</div>
        <div class="col-sm-3">

				</div>
			</div>
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
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
