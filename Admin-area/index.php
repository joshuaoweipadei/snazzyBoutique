<?php
session_start();

if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Area | cPanel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet" media="all">

  <!-- custom style sheet for admin area -->
  <link rel="stylesheet" href="css/style.css">
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
    <div class="container">
      <div class="row" style="overflow-x:hidden; padding;1px">
        <div id="header" class="row">
          <h2><a href="index.php" style="color:gold">Admin | Panel</a></h2>
          <h4 style="color:#fff"> <?php echo $adminEmail; ?>
            <?php if (isset($_GET['948feqx21'])) {
              echo ", you are now loged into the administrative area..!";
            } ?>
          </h4>
        </div>

        <div id="body" class="row">
          <div class="col-sm-3">
            <h4>Manage Contents</h4>
            <li><a href="index.php?insert_product">Insert New Product</a></li>
            <li><a href="index.php?view_products">Veiw All Products</a></li>
            <li><a href="index.php?insert_cat">Insert New Category</a></li>
            <li><a href="index.php?view_cat">View All Category</a></li>
            <li><a href="index.php?insert_brand">Insert New Brand</a></li>
            <li><a href="index.php?view_brands">View All Brands</a></li>
            <li><a href="index.php?view_customers">View Customers</a></li>
            <li><a href="index.php?view_orders">View Orders</a></li>
            <li><a href="index.php?view_payment">View Payments</a></li>
            <h6>Auction | Bidders</h6>
            <li><a href="index.php?insert_auction_item">Insert Auction Item</a></li>
            <li><a href="index.php?view_auction_items">View Auctions Items</a></li>
            <li><a href="index.php?view_bid_items">View Bid Items</a></li>
            <!-- <li><a href="index.php?view_bidders">View Bidders</a></li> -->
            <li><a href="logout.php">Admin Logout</a></li>
          </div>
          <div class="col-sm-9">
            <?php
            // TO INSERT AND VIEW PRODUCT ITEMS(edit & delete as well)
            if (isset($_GET['insert_product'])) {
              include ('insert_product.php');
            }
            if (isset($_GET['view_products'])) {
              include ('view_products.php');
            }
            if (isset($_GET['edit_product'])) {
              include ('edit_product.php');
            }

            // TO INSERT AND VIEW CATEGORY(edit & delete as well)
            if (isset($_GET['insert_cat'])) {
              include ('insert_category.php');
            }
            if (isset($_GET['view_cat'])) {
              include ('view_category.php');
            }
            if (isset($_GET['edit_cat'])) {
              include ('edit_category.php');
            }

            // TO INSERT AND VIEW THE BRANDS(edit & delete as well)
            if (isset($_GET['insert_brand'])) {
              include ('insert_brand.php');
            }
            if (isset($_GET['view_brands'])) {
              include ('view_brand.php');
            }
            if (isset($_GET['edit_brand'])) {
              include ('edit_brand.php');
            }

            // TO VIEW ALL CUSTOMERS
            if (isset($_GET['view_customers'])) {
              include ('view_customers.php');
            }

            // TO INSERT AND VIEW AUCTION ITEMS(edit & delete as well)
            if (isset($_GET['insert_auction_item'])) {
              include ('insert_auction_item.php');
            }
            if (isset($_GET['view_auction_items'])) {
              include ('view_auction_items.php');
            }

            // VIEW AUCTION BIDDERS
            if (isset($_GET['view_bid_items'])) {
              include ('view_bid_items.php');
            }
            if (isset($_GET['viewbiditemid'])) {
              include ('view_item_bidders.php');
            }

             ?>
          </div>
        </div>




        <div id="footer" class="row">
  FOOTER
        </div>

      </div>
    </div>




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
  </body>
</html>
