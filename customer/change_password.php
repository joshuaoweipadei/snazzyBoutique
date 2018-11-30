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

if (isset($_POST['change_password'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $currentPassword = test_input($_POST['current_password']);
  $newPassword = test_input($_POST['new_password']);
  $newPasswordAgain = test_input($_POST['new_password_verify']);

  if (isset($currentPassword) && isset($newPassword) && isset($newPasswordAgain)) {
    if (empty($currentPassword) || empty($newPassword) || empty($newPasswordAgain)) {
      $errorMsg = "Enter your passwords!";

    } else {
      $sql = "SELECT * FROM customers WHERE c_Password = SHA('$currentPassword') AND customerId = '$userID' AND c_Email = '$email'";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      $result = mysqli_num_rows($query);

      if ($result == 0) {
        $errorMsg = "Your Current Password is wrong..!";

      } else {
        if (strlen($newPassword) < 9) {
          $errorMsg = "Your New Password is weak(8 characters or more)!";

        } else {
          if ($newPassword != $newPasswordAgain) {
            $errorMsg = "Your New Passwords do not Match !";

          } else {
            $update = "UPDATE customers SET c_Password = SHA('$newPassword') WHERE customerId = '$userID'";
            $query = mysqli_query($conn, $update) or die(mysqli_error($conn));

            if ($query) {
              $successMsg = "Password is successfully changed!!";
            }
          }
        }
      }
    }
  }
}

 ?>

<div class="row">
  <div class="col-sm-7 col-sm-offset-2">
    <div class="signup-form"><!--login form-->
      <h2 style="font-size:30px; color:#000; font-weight:bold">RESET PASSWORD</h2>
      <!--ERROR MESSAGES-->
        <?php if(isset($errorMsg)) {
          echo "<div class='alert alert-danger alert-dismissible fade in' role='alert' style='background:#ff3300; color:#fff'>
                  <strong>$errorMsg</strong>
                </div>" ;
        } elseif (isset($successMsg)) {
          echo "<div class='alert alert-danger alert-dismissible fade in' role='alert' style='background:#339933; color:#fff'>
                  <strong>$successMsg</strong>
                </div>" ;
        } ?><br>
        <!--END OF ERROR MESSAGES-->
      <form action="" method="POST">
        <label for="">Current Password</label>
        <input type="password" name="current_password" placeholder="Current Password" style="width:66%"/>
        <br>
        <label for="">New Password</label>
        <input type="password" name="new_password" placeholder="New Password" style="width:66%"/>
        <br>
        <label for="">Enter New Password Again</label>
        <input type="password" name="new_password_verify" placeholder="New Password Again" style="width:66%"/>
        <br>
        <button type="submit" name="change_password" class="btn ">Change Password</button>
      </form>

    </div><!--/login form-->
  </div>
</div>
