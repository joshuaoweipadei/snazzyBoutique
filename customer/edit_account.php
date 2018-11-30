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


    $sql = "SELECT * FROM customers_img WHERE customerId = '$userID'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $customerRow = mysqli_fetch_array($query);
    $_SESSION['c_image'] = $customerRow['c_Image'];
    $_SESSION['c_username'] = $customerRow['c_Username'];

    // $image = $_SESSION['c_image'];
    $username = $_SESSION['c_username'];

  }


?>


<?php
if (isset($_POST['update_account'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  $firstname = test_input($_POST['firstname']);
  $lastname = test_input($_POST['lastname']);
  $username = test_input($_POST['username']);
  $city = test_input($_POST['city']);
  $address = test_input($_POST['address']);
  $mobile = test_input($_POST['mobile']);


  if (empty($firstname) || empty($lastname) || empty($username) || empty($city) || empty($address) || empty($mobile)) {
    $errorMsg = "Please fill in all fields!";

  } else {
    if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
      $errorMsg = "Firstname: Invalid Character!";

    } else {
      if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        $errorMsg = "Lastname: Invalid Character!";

      } else {
        if (!preg_match("/^[0-9]+$/", $mobile)) {
          $errorMsg = "The mobile number $mobile is not Valid!";

        } else {
          // Check if user with that email already exists
          $sql = "SELECT * FROM customers WHERE customerId = '$userID' AND c_Email = '$email'";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

          if (mysqli_num_rows($query) == 1) {
            // User and Email exist in a database, proceed...

            // UPADATE THE CUSTOMER DETIALS from THE customers TABLE
            $update1 = "UPDATE customers SET c_FirstName = '$firstname', c_LastName = '$lastname', c_City = '$city', c_Address = '$address', c_Number = '$mobile'
                        WHERE Id = '$userID' ";
            $query1 = mysqli_query($conn, $update1) or die(mysqli_error($conn));

            if ($query1) {
              // UPDATE THE CUSTOMER USERNAME from THE customers_img TABLE
              $update2 = "UPDATE customers_img SET c_Username = '$username' WHERE Id = '$userID' ";
              $query2 = mysqli_query($conn, $update2) or die(mysqli_error($conn));

              if ($query2) {
                $successMsg = "Your cccount is successfully Updated..!";
              }
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
     <div class="update-form signup-form"><!--login form-->
       <h2 style="font-size:30px; color:#000; font-weight:bold">EDIT ACCOUNT</h2>
       <?php if(isset($errorMsg)) {
         echo "<div class='alert alert-danger alert-dismissible fade in' role='alert' style='background:#ff3300; color:#fff'>
                 <strong>$errorMsg</strong>
               </div>" ;
       } elseif (isset($successMsg)) {
         echo "<div class='alert alert-danger alert-dismissible fade in' role='alert' style='background:#339933; color:#fff'>
                 <strong>$successMsg</strong>
               </div>" ;
       } ?><br>
         <form action="" method="POST">
           <label for="">First Name: <i class="fa fa-edit"></i></label>
           <input type="text" name="firstname" value="<?php echo $firstname; ?>" required style="width:66%"/>

           <label for="">Last Name: <i class="fa fa-edit"></i></label>
           <input type="text" name="lastname" value="<?php echo $lastname; ?>" required style="width:66%"/>

           <label for="">Email: <i class="fa fa-lock"></i></label>
           <input type="email" name="email" value="<?php echo $email; ?>" disabled required style="width:66%; font-weight:600"/>

           <label for="">Choose a Username: <i class="fa fa-edit"></i></label>
           <input type="text" name="username" value="<?php echo $username; ?>" required style="width:66%"/>

           <label for="">Country: <i class="fa fa-lock"></i></label>
           <select name="country" style="width:66%; font-weight:600" disabled required>
             <option><?php echo $country; ?></option>
             <option>India</option>
             <option>Japan</option>
             <option>Nigeria</option>
             <option>Pakistan</option>
             <option>Isreal</option>
             <option>Nepal</option>
             <option>United Arab Emirates</option>
             <option>China</option>
             <option>USA</option>
             <option>Canada</option>
             <option>United Kingdom</option>
           </select>

           <label for="">City: <i class="fa fa-edit"></i></label>
           <input type="text" name="city" value="<?php echo $city; ?>" required style="width:66%"/>

           <label for="">Address: <i class="fa fa-edit"></i></label>
           <input type="text" name="address" value="<?php echo $address; ?>" required style="width:66%"/>

           <label for="">Phone: <i class="fa fa-edit"></i></label>
           <input type="text" name="mobile" value="<?php echo $number; ?>" required style="width:66%"/>

           <br>
           <button type="submit" name="update_account" class="btn btn-default">Save Changes</button>
         </form>

     </div><!--/login form-->
   </div>
 </div>
