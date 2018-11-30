<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}


?>

<?php

include ('database.php');

 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet" media="all">

  <script src="js/tinymce_4.8.2_dev/tinymce/js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'#textarea'});</script>
  <style media="screen">
    table{
      background: #000;
      opacity: 0.7;
      color: #000;
      font-size: 16px
    }
    table td{
      padding-right: 12px
    }
    table tr{
      border-bottom: 2px solid #fff;
    }
  </style>

  </head>

  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <table align="center" width="100%" style="background:orangered">
        <tr>
          <td colspan="7" align="center"><h2><b>Insert Auction Items</b></h2></td>
        </tr>

        <!-- ITEM NAME -->
        <tr>
          <td><b>Auction Item Name:</b></td>
          <td><input class="form-control" type="text" name="auction_item_name" style="width:70%"/></td>
          <td></td>
          <td></td>
        </tr>

        <!-- ITEM CATEGORY -->
        <tr>
          <td><b>Auction Item Category:</b></td>
          <td>
            <select class="form-control" name="auction_item_cat" style="width:70%">
              <option value="">Select a Category</option>
              <?php
                  $get_cats = "SELECT * FROM categories";
                  $query = mysqli_query($conn, $get_cats) or die(mysqli_error($conn));

                  while ($row_cats = mysqli_fetch_array($query)) {
                    $cat_id = $row_cats['cat_Id'];
                    $cat_title = $row_cats['cat_Title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                  }
               ?>
            </select>
          </td>
        </tr>

        <!-- ITEM BRAND -->
        <tr>
          <td ><b>Auction Item Brands:</b></td>
          <td>
            <select class="form-control" name="auction_item_brand" style="width:70%">
              <option value="">Select a Brand</option>
              <?php
                  $get_brands = "SELECT * FROM brands";
                  $query = mysqli_query($conn, $get_brands) or die(mysqli_error($conn));

                  while ($row_brands = mysqli_fetch_array($query)) {
                    $brand_id = $row_brands['brand_Id'];
                    $brand_title = $row_brands['brand_Title'];

                    echo "<option value='$brand_id'>$brand_title</option>";
                  }
               ?>
            </select>
          </td>
        </tr>

        <!-- ITEM IMAGE -->
        <tr>
          <td><b>Auction Item Image:</b></td>
          <td><input type="file" name="auction_item_image" style="width:70%"/></td>
        </tr>

        <!-- Old Price Amount -->
        <tr>
          <td><b>Enter Old Price:</b></td>
          <td><input class="form-control" type="text" name="auction_item_old_price" style="width:40%"/></td>
        </tr>

        <!-- Minimum Bid Amount -->
        <tr>
          <td><b>Enter Minimum Bid Amount (in Rs.):</b></td>
          <td><input class="form-control" type="text" name="auction_item_min_price" style="width:40%"/></td>
        </tr>

        <!-- ITEM DESCRIPTION -->
        <tr>
          <td><b>Auction Item Description:</b></td>
          <td><textarea class="form-control" name="auction_item_desc" rows="10" cols="20" id="textarea" style="width:96%"></textarea></td>
        </tr>

        <!-- ITEM KEYWORDS -->
        <tr>
          <td><b>Auction Item Keywords:</b></td>
          <td><input  class="form-control" type="text" name="auction_item_keywords" style="width:70%"/></td>
        </tr>

        <!-- AUCTION DURATION TIME -->
        <tr>
          <td><b>Enter Auction Time (in minutes):</b></td>
          <td><input  class="form-control" type="text" name="auction_item_duration" style="width:40%"/></td>
        </tr>

        <tr>
          <td></td>
          <td><input type="submit" name="insert_auction" value="insert auction item" style="background:blue; color:#fff; padding:10px 10px; border:none"/></td>
        </tr>
      </table>
    </form>

  </body>
</html>




<?php

// INSERTING NEW PRODUCTS INTO THE DATABASE
if (isset($_POST['insert_auction'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  //getting the text data from the fields
  $auctionItemName = test_input($_POST['auction_item_name']);
  $auctionItemCat = test_input($_POST['auction_item_cat']);
  $auctionItemBrand = test_input($_POST['auction_item_brand']);
  $auctionItemOldPrice = test_input($_POST['auction_item_old_price']);
  $auctionItemMinPrice = test_input($_POST['auction_item_min_price']);
  $auctionItemDesc = test_input($_POST['auction_item_desc']);
  $auctioItemKeyword = test_input($_POST['auction_item_keywords']);

  $duration = test_input($_POST['auction_item_duration']);

  //getting the image from the fields
  $auctionItemImage = $_FILES['auction_item_image']['name'];
  $product_image_tmp = $_FILES['auction_item_image']['tmp_name'];
  move_uploaded_file($product_image_tmp, "product-images/$auctionItemImage");


  // CONVERTING THE TIME TO MYSQL TIME FORMAT
  date_default_timezone_set("Africa/Lagos");
  $date = date("Y-m-d H:i:s");
  $end_date = date('Y-m-d H:i:s', strtotime('+'.$duration.'minutes', strtotime($date)));


  // CALCULATING THE DISCOUNT RATE
  $rate = 100 - (($auctionItemMinPrice * 100)/$auctionItemOldPrice);
  $discount_Rate = number_format((float)$rate, 2, '.', '')."%";


  if (!empty($auctionItemName) && !empty($auctionItemCat) && !empty($auctionItemBrand) && !empty($auctionItemOldPrice) &&
      !empty($auctionItemMinPrice) && !empty($auctionItemDesc) && !empty($auctioItemKeyword) && !empty($duration) && !empty($auctionItemImage)) {

      $insertAuctionItem = "INSERT INTO auction_items (a_ItemName, a_ItemCat, a_ItemBrand, a_ItemImage, a_ItemDescription, a_ItemKeywords, a_ItemOldPrice, a_ItemMinBidPrice, a_ItemDiscountRate, dateAuctionStarts, dateAuctionEnds)
                          VALUES ('$auctionItemName', '$auctionItemCat', '$auctionItemBrand', '$auctionItemImage', '$auctionItemDesc', '$auctioItemKeyword', '$auctionItemOldPrice', '$auctionItemMinPrice', '$discount_Rate', NOW(), '$end_date')";
      $query = mysqli_query($conn, $insertAuctionItem) or die(mysqli_error($conn));

      if ($query) {
        echo "<script>alert('Auction Item Has been inserted!')</script>";
        echo "<script>window.open('index.php?view_auction_items', '_self')</script>";
      }
    } else {
      echo "<script>alert('Auction Fields are Empty!')</script>";
      echo "<script>window.open('index.php?insert_auction_item', '_self')</script>";
    }
  }



 ?>
