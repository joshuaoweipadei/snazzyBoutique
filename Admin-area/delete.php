<?php

session_start();

if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}



include ('database.php');




// DELETE A PRODUCT WITH ITS ID
if (isset($_GET['delete_pro'])) {
  $deleteProduct_Id = $_GET['delete_pro'];

  $deleteProduct = "DELETE FROM products WHERE productId = '$deleteProduct_Id'";
  $query = mysqli_query($conn, $deleteProduct) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('A Product Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_products', '_self')</script>";
  }
}




// DELETE A CATEGORY WITH ITS ID
if (isset($_GET['delete_cat'])) {
  $deleteCategory_Id = $_GET['delete_cat'];

  $deleteCategory = "DELETE FROM categories WHERE cat_Id = '$deleteCategory_Id'";
  $query = mysqli_query($conn, $deleteCategory) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('A Category Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_cat', '_self')</script>";
  }
}





// DELETE A BRAND WITH ITS ID
if (isset($_GET['delete_brand'])) {
  $deleteBrand_Id = $_GET['delete_brand'];

  $deleteBrand = "DELETE FROM brands WHERE brand_Id = '$deleteBrand_Id'";
  $query = mysqli_query($conn, $deleteBrand) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('A Brand Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_brands', '_self')</script>";
  }
}





// DELETE A CUSTOMER WITH THEIR ID
if (isset($_GET['delete_customer'])) {
  $deleteCustomer_Id = $_GET['delete_customer'];

  $deleteCustomer = "DELETE FROM customers WHERE customerId = '$deleteCustomer_Id'";
  $query = mysqli_query($conn, $deleteCustomer) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('This Customer Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_customers', '_self')</script>";
  }
}





// DELETE A AUCTION ITEM WITH ITS ID
if (isset($_GET['deldaf643234gfadete_aucd23437tigdfadon_itrer78665875hgry456rewqrem'])) {

  $deleteAuctionItem_Id = $_GET['deldaf643234gfadete_aucd23437tigdfadon_itrer78665875hgry456rewqrem'];

  $deleteAuctionItem = "DELETE FROM auction_items WHERE auctionItemId = '$deleteAuctionItem_Id'";
  $query = mysqli_query($conn, $deleteAuctionItem) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('An Auction Item Has Been Deleted..!')</script>";
    echo "<script>window.open('index.php?view_customers', '_self')</script>";
  }
}

 ?>
