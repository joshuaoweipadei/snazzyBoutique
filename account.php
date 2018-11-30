<?php

  session_start();

  include ('mysql/database.php');

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


    $sql = "SELECT * FROM customers_img WHERE customerId = '$userID'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $customerRow = mysqli_fetch_array($query);
    $_SESSION['c_image'] = $customerRow['c_Image'];
    $_SESSION['c_username'] = $customerRow['c_Username'];

    // $image = $_SESSION['c_image'];
    $username = $_SESSION['c_username'];

  }


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
    <?php include_once 'includes/header.php'; ?>


  <?php include_once ('includes/auction_modal.php'); ?>


  <section id="cart_items" class="account"  style="padding:10px 30px">
    <div class="container">
      <div class="row">
        <!-- CUSTOMER ACCOUNT -->
        <div class="col-sm-3">
          <div class="img-container" align="center">
            <?php
            $sql = "SELECT * FROM customers_img WHERE customerId = '$userID'";
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $customerImage = mysqli_fetch_array($query);

            echo "<div style='width:150px; height:150px'>";
            if (!empty($customerImage['c_Image'])) {
              echo "<img src='customer/uploaded_images/".$customerImage['c_Image']."' width='100%' height='100%' class='Avatar' style='border-radius:100%; border:2px solid #000'>";
            } else {
              echo "<img src='customer/uploaded_images/profiledefault.png' width='100%' height='100%' class='Avatar' style='border-radius:100%; border:2px solid #000'>";
            }
            echo "</div>";
            ?>
            <form action="customer/upload_picture.php" method="POST" enctype="multipart/form-data">
              <!--IMAGE FILE-->
              <input type="file" name="image" id="newAvatar" style="display:none">
              <abbr title="Click to Upload Picture">
                <button type="submit" name="uploadImage" class="btn btn-default" style="border:none; float:right; padding:4px 4px">
                  <i class="fa fa-camera" style="font-size:20px"></i>
                </button>
              </abbr>
            </form>



            <p style="font-size:12px; margin-top:20px; clear:both"><?php echo $firstname." ".$lastname; ?></p>
          </div>
          <div class="list-group">
            <a href="account.php?my_orders" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-level-down"></i> My Orders <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="account.php?edit_account" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-edit"></i> Edit Account <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="account.php?change_password" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-pencil"></i> Change Password <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="account.php?delete_account" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-trash-o"></i> Delete Account <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-money"></i> Payment Methods <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-tags"></i> All Transactions <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-puzzle-piece"></i> Privacy <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
            <a href="logout.php" class="list-group-item list-group-item-action">
              <i style="font-size:18px" class="fa fa-sign-out"></i> Logout <i style="float:right; font-size:18px" class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>
      <!-- END OF CUSTOMER ACCOUNT  -->

      <!-- BODY CONTAINER(RIGHT-SIDE) -->
      <div class="col-sm-9" style="padding-top:20px; padding-bottom:40px; background:#fff">
                  <!-- SUCCESS
                  <div class="alert alert-success alert-dismissible fade in" role="alert" style="background:#339933; color:#000">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                  </div>
                  PRIMARY
                  <div class="alert alert-info alert-dismissible fade in" role="alert" style="background:#3399ff; color:#fff">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                  </div>
                  WARNING
                  <div class="alert alert-warning alert-dismissible fade in" role="alert" style="background:#ff6600; color:#fff">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                  </div>
                  DANGER
                  <div class="alert alert-danger alert-dismissible fade in" role="alert" style="background:#ff3300; color:#fff">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                  </div> -->
      <!--ERROR MESSAGES-->
        <?php
          if(isset($_GET['not892na22ds68hi90ghaqp0926dle3hd432343rndeddfneeenkdsdfcwoe'])) {
            echo "<div class='alert alert-warning alert-dismissible fade in' role='alert' style='background:#ff6600 !important; color:#fff !important; width:90%; margin:auto !important; font-size:15px'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <strong>Oh jess! </strong> Do not joke again..
                  </div>
            " ;
            }

          if(isset($_GET['jhsd7io3edjija93hi90ghaqp0uijd3097hdcc7u466bc823rdsdee'])) {
            echo "<div class='alert alert-warning alert-dismissible fade in' role='alert' style='background:#ff6600 !important; color:#fff !important; width:90%; margin:auto !important; font-size:15px'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
                    <strong>Oh jess! </strong> Do not joke again..
                  </div>
            " ;
            }
          ?>
        <!--END OF ERROR MESSAGES-->

        <?php
        if (!isset($_GET['my_orders'])) {
          if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['change_password'])) {
              if (!isset($_GET['delete_account'])) {
                echo "<div style='padding:0px 30px 130px 30px; color:#4d4d4d'>
                        <h2 style='font-style:oblique; font-size:16px; text-transform:uppercase'><b>Let's get you all set up so you can make the most of our JEWELRY store.</b></h2>
                        <br>
                        <h3>Make the most of your profile</h3>
                        <div style='height:3px; background:#400080'></div>
                        <p>Everything here is optional, it just feels nice to have a profile that is complete and lookin' good.</p>
                        <p>You're lot more recognizable around JEWELRY ONLINE with an avatar.</p>
                        <h4><b>Upload a new avatar</b></h4>
                        <div style='width:260px; border:2px dashed #000; background:#e1e1e1; padding:20px'>
                          <p>TO CHANGE YOUR AVATAR, CLICK ON THE CAMERA ICON AND SELECT A FILE (not more than 1MB). THEN HIT ON UPLOADS
                        </div>
                      </div>";
              }
            }
          }
        }
        ?>
        <?php
        if (isset($_GET['edit_account'])) {
          include ('customer/edit_account.php');
        }
         ?>
       <?php
       if (isset($_GET['change_password'])) {
         include ('customer/change_password.php');
       }
        ?>
        <?php
        if (isset($_GET['delete_account'])) {
          include ('customer/delete_account.php');
        }
         ?>
      </div>

    </div>
    </div>
  </section>
  <!--END OF USER ACCOUNT-->


  <!-- REQUIRING THE FOOTER -->
  <?php include_once 'includes/footer.php'; ?>


            <script src="js/jquery.js"></script>

    <!-- SCRIPT TO UPLOAD USER PICTURE -->
    <script type="text/javascript">
      $(".Avatar").click(function(){
        $("#newAvatar").trigger("click");
      });


      function div_show() {
        document.getElementById('abc').style.display = "block";
        $("#y").fadeOut('4000');
      }

      function div_hide() {
        document.getElementById('abc').style.display = "none";
        $("#y").fadeIn('7000');
      }
    </script>

    <!-- <script>
      var firefoxTestDone = false
      function reportFirefoxTestResult(result) {
        if (!firefoxTestDone) {
          $('#ff-bug-test-result')
            .addClass(result ? 'text-success' : 'text-danger')
            .text(result ? 'PASS' : 'FAIL')
        }
      }

      $(function () {
        $('[data-toggle="popover"]').popover()
        $('[data-toggle="tooltip"]').tooltip()

        $('#tall-toggle').click(function () {
          $('#tall').toggle()
        })

        $('#ff-bug-input').one('focus', function () {
          $('#firefoxModal').on('focus', reportFirefoxTestResult.bind(false))
          $('#ff-bug-input').on('focus', reportFirefoxTestResult.bind(true))
        })

        $('#btnPreventModal').on('click', function () {
          $('#firefoxModal').one('shown.bs.modal', function () {
            $(this).modal('hide')
          })
          .one('hide.bs.modal', function (event) {
            event.preventDefault()
            if ($(this).data('bs.modal')._isTransitioning) {
              console.error('Modal plugin should not set _isTransitioning when hide event is prevented')
            } else {
              console.log('Test passed')
              $(this).modal('hide') // work as expected
            }
          })
          .modal('show')
        })
      })
    </script> -->


    <!-- <script src="js/assets/js/vendor/jquery-slim.min.js"></script>
        <script src="js/assets/js/vendor/popper.min.js"></script> -->
        <!-- <script src="js/dist/util.js"></script>
        <script src="js/dist/modal.js"></script>
        <script src="js/dist/collapse.js"></script>
        <script src="js/dist/tooltip.js"></script>
        <script src="js/dist/popover.js"></script> -->


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
