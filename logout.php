<?php
/* Log out process, unsets and destroys session variables */

session_start();

include_once 'mysql/database.php';



// Check if user is logged in using the session variable
if (!isset($_SESSION['customerID'])) {

  header('location: 404.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['customerID'];
  $firstname = $_SESSION['c_first_name'];
  $lastname = $_SESSION['c_last_name'];
  $email = $_SESSION['c_email'];
  $city = $_SESSION['c_country'];
  $active = $_SESSION['c_active'];

}

$sql = "UPDATE customers SET c_Active = 0 WHERE c_Email = '$email'";
mysqli_query($conn, $sql) or die(mysqli_error($conn));


session_unset();
session_destroy();

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
	<div class="container text-center">
		<div class="logo-404">
			<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
		</div>
		<div class="content-404">
			<!-- <img src="images/404/404.png" class="img-responsive" alt="" /> -->
			<h1><b>Uh... Thank you for stopping by!</br></h1>
			<p> You are now logged out</p>
			<h2><a href="index.php">back to Home</a></h2>
		</div>
	</div>


    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
