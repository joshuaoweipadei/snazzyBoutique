<?php

//getting the IP address of a particular user
function getIp() {
  $ip = $_SERVER['REMOTE_ADDR'];

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  return $ip;
}


// Escape all $_POST variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$email = test_input($_POST['email']);
$password = test_input($_POST['password']);

if (isset($email) && isset($password)) {
  if (empty($email) || empty($password)) {
    $errorMsg = "Enter your email and password";

  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMsg = "Invalid Email!";

    } else {
      $sql = "SELECT * FROM customers WHERE c_Email = '$email' AND c_Password = SHA('$password')";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      $checkQuery = mysqli_num_rows($query);
      if ($checkQuery == 1) {
        //THE USER IS FOUND
        $user = mysqli_fetch_array($query);
        $userID = $user['customerId'];
        $emailVerified = $user['c_emailVerified'];
        //CHECK IF THE USER HAS CLICKED ON THE VERIFICATION LINK ON THIER EMAIL

        if ($emailVerified == 0) {
          $errorMsg = "Account not verified yet! Please click on the verification link on your email.";

        } else {

          $ip = getIp();

          $selectCart = "SELECT * FROM cart WHERE ip_Address = '$ip' AND user_Id = '$userID'";
          $query = mysqli_query($conn, $selectCart) or die(mysqli_error($conn));

          $selectCartQuery = mysqli_num_rows($query);

          if ($checkQuery == 1 AND $selectCartQuery == 0) {

            $sql = "UPDATE customers SET c_Active = 1 WHERE customerId=$userID";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));

            // This is how we'll know the user is logged in
            $_SESSION['customerID'] = $user['customerId'];
            $_SESSION['c_first_name'] = $user['c_FirstName'];
            $_SESSION['c_last_name'] = $user['c_LastName'];
            $_SESSION['c_email'] = $user['c_Email'];
            $_SESSION['c_country'] = $user['c_Country'];
            $_SESSION['c_city'] = $user['c_City'];
            $_SESSION['c_address'] = $user['c_Address'];
            $_SESSION['c_number'] = $user['c_Number'];
            $_SESSION['c_active'] = $user['c_Active'];


            header('location: index.php');


          } else {
            $sql = "UPDATE customers SET c_Active = 1 WHERE customerId=$userID";
            mysqli_query($conn, $sql) or die(mysqli_error($conn));

            // This is how we'll know the user is logged in
            $_SESSION['customerID'] = $user['customerId'];
            $_SESSION['c_first_name'] = $user['c_FirstName'];
            $_SESSION['c_last_name'] = $user['c_LastName'];
            $_SESSION['c_email'] = $user['c_Email'];
            $_SESSION['c_country'] = $user['c_Country'];
            $_SESSION['c_city'] = $user['c_City'];
            $_SESSION['c_address'] = $user['c_Address'];
            $_SESSION['c_number'] = $user['c_Number'];
            $_SESSION['c_active'] = $user['c_Active'];


            header('location: checkout.php');
          }
        }
      } else {
        $errorMsg = "You have entered a wrong email or password. Try again!";
      }
    }
  }
}
