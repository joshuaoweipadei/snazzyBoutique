<?php

  // Check if user is logged in using the session variable
  if (!isset($_SESSION['customerID']) && $_SESSION['c_active'] != 1) {

    header('location: ../login.php');

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
?>

<?php
// include ('database.php');

if (isset($_POST['yes'])) {

  $deleteCustomer = "DELETE FROM customers WHERE customerId = '$userID' AND c_Email = '$email'";
  mysqli_query($conn, $deleteCustomer) or die(mysqli_error($conn));

  $errorMsg = "Your Account has been DELETED..!";

  header('location: ../index.php');
}



if (isset($_POST['no'])) {

  echo"<script>window.open('account.php?not892na22ds68hi90ghaqp0926dle3hd432343rndeddfneeenkdsdfcwoe', '_self')</script>";
}
// https://oweipadeijoshie.000webhostapp.com/
 ?>

<div class="row">
  <div class="col-sm-7 col-sm-offset-2">
    <div class="signup-form"><!--login form-->
      <h2>Do you really want to DELETE your account..?</h2>
      <!--ERROR MESSAGES-->
        <!--END OF ERROR MESSAGES-->
      <form action="" method="POST">
        <input type="submit" name="yes" value="Yes I Want to Delete my Account"
        style="background:red; border:none; border-radius:6px; color:#fff;
        font-size:17px; font-weight:600; width:80%; margin:10px auto"/>

        <input type="submit" name="no" value="No Take my Back"
        style="background:#00b300; border:none; border-radius:6px; color:#fff;
        font-size:17px; font-weight:600"/>
      </form>

    </div><!--/login form-->
  </div>
</div>
