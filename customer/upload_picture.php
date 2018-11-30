<?php

 session_start();

  // Check if user is logged in using the session variable
  if (!isset($_SESSION['customerID'])) {

    header('location: ../login.php');

  }else {
    //SESSION VARIABLE DECLARED
    // Makes it easier to read
    $userID = $_SESSION['customerID'];
    $firstname = $_SESSION['c_first_name'];

  }
?>

<?php

include ('../mysql/database.php');



if (!isset($_POST['uploadImage'])) {

  //Getting File(image) Arrays
  $profileImage_Name = $_FILES['image']['name'];
  $profileImage_TmpName = $_FILES['image']['tmp_name'];
  $profileImage_Size = $_FILES['image']['size'];
  $profileImage_Error = $_FILES['image']['error'];
  $profileImage_Type = $_FILES['image']['type'];

  //Get the Extension of the image
  $ImageExt = explode('.', $profileImage_Name);
  $ImageActualExt = strtolower(end($ImageExt));

  //Give the type of image extention the user can upload
  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if (in_array($ImageActualExt, $allowed)) {
    if ($profileImage_Error === 0) {
      if ($profileImage_Size <= 1000000) {
        $profileImage_NameNew = "profilePic".$firstname."-".$userID.".".$ImageActualExt;
        //image file directory
        $target = "uploaded_images/".$profileImage_NameNew;

        if (move_uploaded_file($profileImage_TmpName, $target)) {

          //check if the user has a profile picture or not
          $sql = "SELECT * FROM customers WHERE customerId = '$userID'";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

          if ($query) {
            $sql1 = "SELECT * FROM customers_img WHERE customerId = '$userID'";
            $query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

            if (mysqli_num_rows($query1) == 0) {
              $sql3 = "INSERT INTO customers_img (customerId, c_Image) VALUES ('$userID', '$profileImage_NameNew')";
              mysqli_query($conn, $sql3) or die(mysqli_error($conn));

              header('location: ../account.php');

            } else{
              $sql2 = "UPDATE customers_img SET c_Image = '$profileImage_NameNew' WHERE customerId = '$userID'";
              mysqli_query($conn, $sql2) or die(mysqli_error($conn));

              header('location: ../account.php');
            }
          }
        }
      }
    }
  }
} else {
  echo "<p align='center' style='font-size:12px'>First choose a picture by clicking on your avatar or identicon...";
}

// https://oweipadeijoshie.000webhostapp.com/
 ?>
