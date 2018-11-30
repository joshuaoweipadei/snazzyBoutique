<?php

if (!isset($_SESSION['customerID']) && $_SESSION['c_active'] != 1) {
  header('location: ../404.php');

}else {
  $userID = $_SESSION['customerID'];
  $email = $_SESSION['c_email'];
}


// Escape all $_POST variables to protect against SQL injections
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Add slashes even with arrays
function addslashes_array($input_arr){
  if (is_array($input_arr)) {
    $tmp = array();
    foreach ($input_arr as $key1 => $value) {
      $tmp[$key1] = addslashes_array($value);
    }
    return $tmp;
  } else {
    return addslashes($input_arr);
  }
}



if (isset($_POST['radio'])) {

  $reviewer_id = test_input($_POST['id']);
  $reviewer_name = test_input($_POST['name']);
  $reviewer_email = test_input($_POST['email']);
  $review = test_input($_POST['review']);
  $reviewer_rating = test_input($_POST['radio']);
  $product_id = test_input($_POST['product_id']);
  $product_name = test_input($_POST['product_name']);

  if (!empty($reviewer_name) && !empty($reviewer_email) && !empty($review) && !empty($reviewer_rating) && !empty($product_id) && !empty($product_name) && !empty($reviewer_id)) {
    if (strlen($review) < 3) {
      $errorMsg = "<strong>Required | Enter your review!</strong>";

    } else {
      $reviewsss = addslashes_array(str_replace("\n" , "<br>", $review));

      $sql = "INSERT INTO reviews (product_id, product_name, rating, review, reviewer_Id, reviewer_name, reviewer_email, review_date)
              VALUES ('$product_id', '$product_name', '$reviewer_rating', '$reviewsss', '$reviewer_id', '$reviewer_name', '$reviewer_email', NOW())";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      $successMsg = "<strong>Thanks for rating us!</strong>";
    }
  } else {
  $errorMsg = "<strong>Required | Enter your review!</strong>";
  }
} else {
  $errorMsg = "<strong>Your have to rate us first!</strong>";
}
























 ?>
