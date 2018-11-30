<?php

session_start();

// // Check if user is logged in using the session variable
if (!isset($_SESSION['customerID']) && $_SESSION['c_active'] != 1) {

  header('location: ../404.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['customerID'];
  $email = $_SESSION['c_email'];


}



include ('../mysql/database.php');



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



//TO ADD ITEMS/PRODUCTS TO THE CART TABLE
 if (isset($_POST['add_to_cart'])) {
   if ($_POST['add_to_cart'] == "add_to_cart") {

     $pro_id = $_POST['product_id'];
     $userID = $_SESSION['customerID'];

     $ip = getIp();

     $sql = "SELECT * FROM cart WHERE user_Id = '$userID' AND pro_Id = '$pro_id'";
     $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
     $count = mysqli_num_rows($query);

     if ($count > 0) {
       echo "
       <div class='alert alert-warning'>
         <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
       <b>Product is already added to the cart continue shopping..!</b>
       </div>
       ";

     } else {

       $sql = "SELECT * FROM products WHERE productId = '$pro_id'";
       $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

       $productRow = mysqli_fetch_array($query);

       $p_ID = $productRow['productId'];
       $p_Name = $productRow['productName'];
       $p_Image = $productRow['productImage'];
       $p_Price = $productRow['productPrice'];
       // $p_Desc = $productRow['productId'];
       // $p_ID = $productRow['productId'];
       // $p_ID = $productRow['productId'];

       $sql = "INSERT INTO `cart` (`user_Id`, `ip_Address`, `pro_Id`, `pro_Name`, `pro_Image`, `Qty`, `pro_Price`, `total_Price`)
        VALUES ('$userID', '$ip', '$p_ID', '$p_Name', '$p_Image', '1', '$p_Price', '$p_Price')";

        if (mysqli_query($conn, $sql) or die(mysqli_error($conn))) {
          echo "
            <div class='alert alert-success'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>
            <b>Product is added..!</b>
            </div>
          ";
        }
     }
   }
 }



 //TO GET AND DISPLAY ITEMS IN THE CART TABLE
 if (isset($_POST['cart_count'])) {

   $userID = $_SESSION['customerID'];

   $sql = "SELECT * FROM cart WHERE user_Id = '$userID'";
   $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

   if ($query) {
     $count = mysqli_num_rows($query);

     echo $count;
   }
 }



//TO GET AND DISPLAY ITEMS IN THE CART TABLE
if (isset($_POST['cart_checkout'])) {

  $userID = $_SESSION['customerID'];

  $sql = "SELECT * FROM cart WHERE user_Id = '$userID'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  $count = mysqli_num_rows($query);
  if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
      $cartProduct_id = $row['pro_Id'];
      $cartProduct_name = $row['pro_Name'];
      $cartProduct_image = $row['pro_Image'];
      $cartProduct_qty = $row['Qty'];
      $cartProduct_price = $row['pro_Price'];
      $cartProduct_total = $row['total_Price'];

      echo "
      <div class='row cart-show'>
        <div class='col-sm-2 td'>$cartProduct_name</div>
        <div class='col-sm-3 td'><img src='Admin-area/product-images/$cartProduct_image' width='135' height='60'/></div>
        <div class='col-sm-1 td'><input type='text' class='form-control qty' pid='$cartProduct_id' id='qty-$cartProduct_id' value='$cartProduct_qty'  maxlength='1'/></div>
        <div class='col-sm-2 td'><button type='button' class='btn price' pid='$cartProduct_id' id='price-$cartProduct_id' value='$cartProduct_price' >$ $cartProduct_price</button></div>
        <div class='col-sm-2 td'><input type='text' class='btn total' pid='$cartProduct_id' id='total-$cartProduct_id' value='$ $cartProduct_total' disabled ></div>
        <div class='col-md-2 td'>
          <div class='btn-group'>
            <acronym title='Update'><a href='' updatee_id='$cartProduct_id' class='btn btn-info updatee'><i class='fa fa-refresh'></i></a></acronym>
            <acronym title='Remove'><a href='#' remove_id='$cartProduct_id' class='btn btn-danger remove'><i class='fa fa-trash-o'></i></a></acronym>
          </div>
        </div>
      </div>
      ";

    }
  }
}


//TO REMOVE/DELETE ITEMS FROM THE CART TABLE
if (isset($_POST['remove_from_cart'])) {

  $pid = $_POST['removeId'];
  $userID = $_SESSION['customerID'];

  $sql = "DELETE FROM cart WHERE user_Id = '$userID' AND pro_Id = '$pid'";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  if ($query) {
    echo "Removed..!";
  }
}


//TO UPDATE ITEMS IN THE CART TABLE
if (isset($_POST['update_cart'])) {
  $pid = $_POST['updateId'];
  $qty = $_POST['qty'];
  $price = $_POST['price'];
  $total = $_POST['total'];

  if ($total != 0) {
    if (!is_numeric($qty) || $qty == 0) {
      // do nothing
    } else {
      $sql = "UPDATE cart SET Qty = '$qty', pro_Price = '$price', total_Price = '$total'
              WHERE user_Id = '$userID' AND pro_Id = '$pid'";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      if ($query) {
        echo "Product is updated...!";
      }
    }
  }
}



// // PAGINATION
// if (isset($_POST['page'])) {
//
//   $sql = "SELECT * FROM products";
//   $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//
//   $count = mysqli_num_rows($query);
//   $pageNumber = ceil($count / 9);
//
//   for ($i=1; $i<=$pageNumber; $i++) {
//     echo "
//       <li><a href='#' page='$i' id='page'>$i</a></li>
//     ";
//   }
//
// }





















 ?>
