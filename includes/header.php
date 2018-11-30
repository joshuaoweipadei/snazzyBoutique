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
            <ul class="nav navbar-nav collapse navbar-collapse">
              <li><a href="index.php" class="list" style="font-family: 'Roboto', sans-serif;">Home</a></li>
              <li><a href="shop.php" class="list" style="font-family: 'Roboto', sans-serif;">Shop</a></li>
              <!-- <li><a href="blog.php" class="list" style="font-family: 'Roboto', sans-serif;">Blog</a></li>
              <li><a href="blog-single.php" class="list" style="font-family: 'Roboto', sans-serif;">Blog Single</a></li> -->
              <li><a class="list" data-toggle="modal" data-target="#firefoxModal" style="cursor:pointer; font-family: 'Roboto', sans-serif;">Start Bidding</a></li>
              <li><a href="contact-us.php" class="list" style="font-family: 'Roboto', sans-serif;">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="search_box pull-right">
            <form action="results.php" method="GET" enctype="multipart/form-data">
              <input class="search" type="text" name="search" placeholder="Search a Product"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!--/header-bottom-->
</header><!--/header-->
