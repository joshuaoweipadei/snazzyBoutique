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


$ip = getIp();

$firstname = test_input($_POST['firstname']);
$lastname = test_input($_POST['lastname']);
$email = test_input($_POST['email']);
$country = test_input($_POST['country']);
$city = test_input($_POST['city']);
$address = test_input($_POST['address']);
$mobile = test_input($_POST['mobile']);
$password = test_input($_POST['password']);
$verifyPassword = test_input($_POST['verifypassword']);
$hash = test_input(md5(rand(0,1000000)));

if (empty($firstname) || empty($lastname) || empty($email) || empty($country) || empty($city) || empty($address) || empty($mobile) || empty($password) || empty($verifyPassword)) {
  $errorMsg = "Please fill in all fields!";

} else {
  if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
    $errorMsg = "Firstname : Invalid Character!";

  } else {
    if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
      $errorMsg = "Lastname : Invalid Character!";

    } else {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "This $email is Invalid!";

      } else {
        if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $mobile)) {
          $errorMsg = "This mobile number $mobile is not Valid!";

        } else {
          if (strlen($password) < 9) {
            $errorMsg = "Password is weak(8 characters or more)!";

          } else {
            if ($password != $verifyPassword) {
              $errorMsg = "Password don't match!";

            } else {
              // Check if user with that email already exists
              $sql = "SELECT * FROM customers WHERE c_Email = '$email'";
              $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

              if (mysqli_num_rows($query) > 0) {
                $errorMsg = "User with this Email already exists!";

              } else { // Email doesn't already exist in a database, proceed...
                $sql = "INSERT INTO customers (customerIP, c_FirstName, c_LastName, c_Email, c_Password, c_Hash, c_Country, c_City, c_Address, c_Number)
                        VALUES ('$ip', '$firstname','$lastname','$email',SHA('$password'),'$hash', '$country', '$city', '$address', '$mobile')";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                //Send registration confirmation link (verify.php)
                $to      = $email;
                $from   = 'cars@gmail.com';
                $subject = 'Account Verification';
                $message_body = '
                Hello '.$firstname.' '.$lastname.',

                Thank you for signing up!

                Please click this link to activate your account:

                http://localhost/cars/verify.php?email='.$email.'&hash='.$hash;

                mail( $to, $subject, $message_body, "From: $from\n" );

                $successMsg = "<span style='color:green; font-size:21px'>Registration successfully!</span></br>
                <span>Email confirmation required.</span></br></br>
                 Please comfirm your email to fully access your account. Check your email ($email) inbox as well as
                  spam section for confirmation letter and click on the link in it to confirm/activate your account..!";

              }
            }
          }
        }
      }
    }
  }
}




?>
