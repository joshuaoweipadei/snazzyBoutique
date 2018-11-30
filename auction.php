<?php

  session_start();

  // Check if user is logged in using the session variable
  if (!isset($_SESSION['customerID'])) {

    header('location: login.php');

  }else {
    //SESSION VARIABLE DECLARED
    // Makes it easier to read
    $userID = $_SESSION['customerID'];
    $firstname = $_SESSION['c_first_name'];
    $lastname = $_SESSION['c_last_name'];
    $email = $_SESSION['c_email'];
    $country = $_SESSION['c_country'];
    $city = $_SESSION['c_city'];
    $address = $_SESSION['c_address'];
    $number = $_SESSION['c_number'];
    $active = $_SESSION['c_active'];

  }

    require ('mysql/database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
                <h4><?php if (isset($_SESSION['customerID'])) {
                  echo "Welcome <span style='color:#6600cc; font-size:17px'>".$email."</span> !! "." "." "." Your Online Shop.";
                } ?></h4>
                <?php if (isset($_SESSION['customerID'])) {
                  echo "<li class='pull-right'><a href='logout.php'><i class='fa fa-sign-in'></i> Log out</a></li>";
                 } else {
                  echo "<li class='pull-right'><a href='login.php'><i class='fa fa-sign-in'></i> Sign in</a></li>";
                  echo "<li class='pull-right'><a href='login.php'> Sign up</a></li>";
                } ?>
                <li class="pull-right"><a href="checkout.php"><i class="fa fa-shopping-cart"></i> Cart
                  <?php if(isset($_SESSION['customerID'])) {
                  echo "<span class='badge' style='background:#400080; font-size:17px'>
                    <div id='cart_count'></div>
                  </span>";
                   } ?>
                </li>
                <li class="pull-right"><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
                <!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->
                <!-- <li><a href="cart.php"><i class="fa fa-crosshairs"></i> Checkout</a></li> -->
                <?php //cart(); ?>
              </ul>
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
            <div class="mainmenu pull-left">

            </div>
          </div>
          <div class="col-sm-3">
            <div class="search_box pull-right">
              <form class="" action="results.php" method="GET" enctype="multipart/form-data">
                <input type="text" name="search" placeholder="Search a Product"/>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
  </header><!--/header-->

  <!--AUCTION-->
  <section id="cart_items">
    <div class="container">
      <div class="row auction_container">
        <a href=""><img src="images/slide/2.jpg" alt="" width="100%" height="170px"/></a>
      </div>
      <div class="row">
        <!-- AUCTION SECTION (leftside) -->
        <div class="col-sm-2" style="height:700px; background:orangered">
          <p class="h1">countdown</p>
          <div id="clockdiv">
            <div>
              <span class="days" id="day"></span>
              <div class="smalltext">
                Days
              </div>
            </div>
            <div>
              <span class="hours" id="hours"></span>
              <div class="smalltext">
                Hours
              </div>
            </div>
            <div>
              <span class="minutes" id="minutes"></span>
              <div class="smalltext">
                Minutes
              </div>
            </div>
            <div>
              <span class="seconds" id="seconds"></span>
              <div class="smalltext">
                Seconds
              </div>
            </div>
          </div>
          <p id="demo"></p>

          <?php
          $sql = "SELECT * FROM auction_items WHERE auctionItemId = 4";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

          while ($rowAuctionItem = mysqli_fetch_array($query)) {

          $auctionItem_Id = $rowAuctionItem['auctionItemId'];

           $auctionItem_DateStart = $rowAuctionItem['dateAuctionStarts'];
           $auctionItem_DateEnds = $rowAuctionItem['dateAuctionEnds'];

           $starttime = strtotime($auctionItem_DateStart);
           $endtime = strtotime($auctionItem_DateEnds);

             $duration = $endtime - $starttime;
           ?>

          <script type="text/javascript">
            var deadline = <?php echo strtotime("10:19:09")*1000;?>;
            var x = setInterval(function(){
              var now = new Date().getTime();
              var t = (deadline - now) / 1000;
              var days = Math.floor(t / (1000 * 60 * 60 * 24));
              var hours = Math.floor((t % (1000 * 60 * 60 * 24))/(1000 * 60 * 60));
              var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((t % (1000 * 60)) / 1000);

              document.getElementById('day').innerHTML = days;
              document.getElementById('hours').innerHTML = hours;
              document.getElementById('minutes').innerHTML = minutes;
              document.getElementById('seconds').innerHTML = seconds;
              if (t < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "TIME UP";
                document.getElementById("day").innerHTML = '0';
                document.getElementById("hours").innerHTML = '0';
                document.getElementById("minutes").innerHTML = '0';
                document.getElementById("seconds").innerHTML = '0'; }
              }, 1000);
          </script>
<?php } ?>

          <script type="text/javascript">
            setInterval(function(){
             var end = <?php echo strtotime($auctionItem_DateEnds)*1000;?>;
             var current = new Date().getTime();
              var seconds_left = (end - current) /1000;

              days = parseInt(seconds_left / 86400);
              seconds_left = seconds_left % 86400;

              hours = parseInt(seconds_left / 3600);
              seconds_left = seconds_left % 3600;

              minutes = parseInt(seconds_left / 60);
              seconds = parseInt(seconds_left % 60);

                document.getElementById('pp').innerHTML = (days + "d, " + hours + "h, " + minutes + "m, " + seconds + "s ");

            }, 1000);
          </script>
          <p id="pp"></p>


          <div class="row">



                   <?php
                   $sql = "SELECT * FROM auction_items WHERE auctionItemId = '2'";
                   $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                   $rowAuctionItem = mysqli_fetch_array($query);
                    $auctionItem_Id = $rowAuctionItem['auctionItemId'];
                     $auctionItem_DateStart = $rowAuctionItem['dateAuctionStarts'];
                     $auctionItem_DateEnds = $rowAuctionItem['dateAuctionEnds'];

                   function timer($auctionItem_DateEnds, $auctionItem_Id){
                       date_default_timezone_set("Europe/London"); //changing time to london(uk) time.
                       $starttime = strtotime($auctionItem_DateStart);
                       $endtime = strtotime($auctionItem_DateEnds); //converting the string from database into time form
                       $idtemp = $auctionItem_Id; //Returns the current time
                       ?>
                       <script>
                       (function(){
                           //convert server time to milliseconds
                           var server_current = <?php $starttime; ?> * 1000,
                               server_end_time = <?php echo $endtime; ?> * 1000,
                               client_current_time = new Date().getTime(),
                               finish_time = server_end_time - server_current + client_current_time, //server end time - server current time + client current time
                               timer,
                               uniqueID = '<?php echo json_encode($idtemp); ?>';

                           function countdown(){
                               var now = new Date();
                               var left = finish_time - now;

                               //Following code convert the remaining milliseconds into hours, minutes and days.
                               //milliseconds conversion
                               //1000-second 60,000-minute
                               //3,600,000-hour  86,400,400-hour
                               var hour = Math.floor( (left % 86000000 ) / 3600000 );
                               var minute = Math.floor( (left % 3600000) / 60000 );
                               var second = Math.floor( (left % 60000) / 1000 );

                               document.getElementById(uniqueID).innerHTML = "Hours:"+hour+" Minutes:"+minute+" Seconds:"+second;
                           }
                           timer = setInterval(countdown, 1000);
                       })();
                       </script>
                   <?php } ?>

                   <h3>Auction House </h3>


          </div>
        </div>
      <!-- END OF AUCTION SECTION  -->

      <!-- BODY CONTAINER(rightside) -->
        <div class="col-sm-10">
            <?php
              $sql = "SELECT * FROM auction_items";
              $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

              while ($rowAuctionItem = mysqli_fetch_array($query)) {
                $auctionItem_Id = $rowAuctionItem['auctionItemId'];
                $auctionItem_Name = $rowAuctionItem['a_ItemName'];
                $auctionItem_Image = $rowAuctionItem['a_ItemImage'];
                $auctionItem_OldPrice = $rowAuctionItem['a_ItemOldPrice'];
                $auctionItem_MinPrice = $rowAuctionItem['a_ItemMinBidPrice'];
                $auctionItem_DiscountRate = $rowAuctionItem['a_ItemDiscountRate'];
                $auctionItem_DateStart = $rowAuctionItem['dateAuctionStarts'];
                $auctionItem_DateEnds = $rowAuctionItem['dateAuctionEnds'];
                $auctionItem_Desc = $rowAuctionItem['a_ItemDescription'];
                $auctionItem_Cat = $rowAuctionItem['a_ItemCat'];
                $auctionItem_Brand = $rowAuctionItem['a_ItemBrand'];

                $start = strtotime($auctionItem_DateStart);
                $end = strtotime($auctionItem_DateEnds);

                $duration = $end - $start;
                $diffInSecond = gmdate("H:i:s", $duration);



             ?>

             <div class='col-sm-6'>
               <div class='product-image-wrapper'>
                 <div class='single-products'>
                   <div class="panel-heading" style="padding-top:0px; padding-bottom:0px">
                     <h3 style="color:#400080"><b><?php echo $auctionItem_Name; ?></b>
                       <input type="hidden" id="timer-<?php echo $auctionItem_Id; ?>" value="<?php echo $diffInSecond; ?>">
                       <button style="float:right; border:none; background:none" class="timer" timer="<?php echo $auctionItem_Id; ?>">Countdown</button>
                       <h2 id="t"></h2>
                     </h3>
                   </div>
                   <div class='productinfo'>
                     <div style='height:180px; margin-bottom:5px'>
                       <img src='Admin-area/product-images/<?php echo $auctionItem_Image ?>' alt='<?php echo $auctionItem_Image ?>' />
                       <div class="discount">
                         <span class='badge'>
                           <?php echo $auctionItem_DiscountRate; ?> <span style="font-size:15px; color:#000">off</span>
                         </span>
                       </div>
                     </div>
                     <div class="">
                       <div class="col-sm-6" >
                         <h4>
                           <span>US $<s><?php echo $auctionItem_OldPrice; ?></s></span>
                         </h4>
                         <div class="">
                           <p><b>Minimum Basic Bid: <span style="color:blue">$<?php echo $auctionItem_MinPrice; ?></span></b></p>
                           <!-- MAXIMUM BIDDER -->
                           <?php
                           $SQL = "SELECT MAX(customer_Bid) AS Highestcustomer_Bid FROM bidders__customers WHERE auctionBid_Id = '$auctionItem_Id'";
                           $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                           while ($row = mysqli_fetch_array($QUERY)) {
                             $price = $row['Highestcustomer_Bid'];

                             echo "<span style='font-size:12px'>Max. Bidder - $".$price."</span><br>";
                           }
                            ?>
                           <!-- MINIMUM BIDDER -->
                           <?php
                           $SQL = "SELECT MIN(customer_Bid) AS Lowestcustomer_Bid FROM bidders__customers WHERE auctionBid_Id = '$auctionItem_Id'";
                           $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                           while ($row = mysqli_fetch_array($QUERY)) {
                             $price = $row['Lowestcustomer_Bid'];

                             echo "<span style='font-size:12px'>Min. Bidder - $".$price."</span><br>";
                           }
                            ?>
                         </div>

                         <div style="margin-top:10px">
                           <label style="font-size:12px">Enter Your Bid Amount</label>
                           <input type="text" class="form-control bid" name="bid_price" class="bid_price" id="bid_price-<?php echo $auctionItem_Id; ?>">

                           <!-- GETTING THE PRODUCT id -->
                           <input type="hidden" class="tah" id="auction_id-<?php echo $auctionItem_Id; ?>" value="<?php echo $auctionItem_Id; ?>">
                           <input type="hidden" id="auction_price-<?php echo $auctionItem_Id; ?>" value="<?php echo $auctionItem_MinPrice; ?>">

                           <!-- HIDING THIS INPUT FIELDS THAT CONTAINES THE CUSTOMER id AND email -->
                           <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $userID; ?>">
                           <input type="hidden" name="customer_email" id="customer_email" value="<?php echo $email; ?>">

                           <input type="submit" submit="<?php echo $auctionItem_Id; ?>" class="btn btn-info place_bid" value="BID" style="margin-top:5px; border-radius:15px; padding-left:15px; padding-right:15px; font-weight:600">
                         </div>
                       </div>
                       <div class="col-sm-6">
                         <h5 align="center"><b>Current Bidders :</b></h5>
                         <div class="bidders_list" align="center">
                           <?php
                           // getting to display the bidders/customers and their price
                           $SQL = "SELECT * FROM bidders__customers WHERE auctionBid_Id = '$auctionItem_Id'";
                           $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                           while ($row = mysqli_fetch_array($QUERY)) {
                             $bidder_firstname = $row['c_First'];
                             $bidder_lastname = $row['c_Last'];
                             $bidder_bid = $row['customer_Bid'];

                              echo "<li style='font-size:11px'>".$bidder_lastname." ".$bidder_firstname." - ".$bidder_bid."</li>";
                            }
                            ?>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>

                 <div class='choose' style="clear:both">
                   <br>
                   <div style="padding-left:7px; font-size:12px">
                     <div class="msg">

                     </div>
                     <p style="font-family:cursive"><b>Note:</b> Your bid amount must be more than minimum basic bid.</p>
                   </div>
                   <ul class='nav nav-pills nav-justified'>
                     <li><a href=''><i class='fa fa-plus-square'></i>Info</a></li>
                   </ul>
                 </div>
               </div>
             </div>
           <?php }?>
        </div>
      <!-- BODY CONTAINER(RIGHT-SIDE) -->

      </div>
    </div>
  </section>
  <!--END OF AUCTION-->

  <!-- REQUIRING THE FOOTER -->
  <?php include_once 'includes/footer.php'; ?>



    <script src="js/jquery.js"></script>

    <!-- AUCTION COUNTDOWN TIMER -->
    <script type="text/javascript">
      $(function(){

      })
    </script>

    <!-- js for adding items to cart -->
    <?php if (isset($_SESSION['customerID'])) {?>
    <script src="js\cart\cart_script.js"></script>
    <?php } ?>
    <!------------------------------------------------------------------------------------->

	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>

    <script src="js/main.js"></script>
</body>
</html>
