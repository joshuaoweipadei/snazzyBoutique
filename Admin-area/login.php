<?php

session_start();

if (isset($_SESSION['admin_email'] )) {

  header('location: index.php');
}


include ('database.php');

?>



<?php

if (isset($_POST['admin_login'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $adminEmail = test_input($_POST['email']);
  $adminPassword = test_input($_POST['password']);

  if (isset($adminEmail) && isset($adminPassword)) {
    if (empty($adminEmail) || empty($adminPassword)) {
      $errorMsg = "Admin email and password is required";

    } else {
      if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Invalid Email!";

      } else {
        $sql = "SELECT * FROM admins WHERE Admin_Email = '$adminEmail' AND Admin_Password = '$adminPassword'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $result = mysqli_num_rows($query);
        if ($result == 0) {
          $errorMsg = "Password or Email is wrong, try again!";

        } else {
          $Admin = mysqli_fetch_array($query);

          $_SESSION['admin_email'] = $Admin['Admin_Email'];

          header('location: index.php?948feqx21');

        }
      }
    }
  }
}


 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Area | Login</title>
    <link rel="stylesheet" href="css/admin-login.css">

    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet"> -->
  </head>
  <body>

  <div id="logo">
    <h1><i> JOSH INDUSTRIES</i></h1>
  </div>

  <section class="stark-login">
    <form action="" method="post">
      <div id="fade-box">
        <input type="text" name="email" id="username" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="admin_login">Log In</button>
      </div>
    </form>

    </section>
      <div id="circle1">
        <div id="inner-cirlce1">
          <h2> </h2>
        </div>
      </div>
      <div style="padding:20px; font-size:20px; color:#ff8080; width:50%; margin:auto">
        <!--ERROR MESSAGES-->
          <?php if(isset($errorMsg)) {
            echo "<div class='row error'>$errorMsg</div>" ;
          } ?>
          <?php if (isset($_GET['3og2g90eed5u7t'])) {
            echo "You have been logged out..!";
          } ?>
          <!--END OF ERROR MESSAGES-->
      </div>
        <!-- <ul style="color:#fff">
          <li>dfgd</li>
          <li>fdd</li>
          <li>dg</li>
          <li>fdgd</li>
          <li>ssee</li>
        </ul> -->

      <!-- <script src="js/admin-login.js"></script> -->
  </body>
</html>
