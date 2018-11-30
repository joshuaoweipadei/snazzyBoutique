<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}


?>

<?php

include ('database.php');


  // GETTING THE ID OF A PARTICULAR PRODUCT AND EDITING/UPDATING IT
  // IN DATABASE
  if ($_GET['edit_auction_item']) {
    $AuctionItem_id = $_GET['edit_auction_item'];

    $getAuctionItem = "SELECT * FROM auction_items WHERE auctionItemId = '$AuctionItem_id'";
    $query = mysqli_query($conn, $getAuctionItem) or die(mysqli_error($conn));

    if ($query) {
     $row = mysqli_fetch_array($query);

      $A_itemID = $row['auctionItemId'];
      $A_itemName = $row['a_ItemName'];
      $A_itemImage = $row['a_ItemImage'];
      $A_itemOldPrice = $row['a_ItemOldPrice'];
      $A_itemMinPrice = $row['a_ItemMinBidPrice'];
      $A_itemDesc = $row['a_ItemDescription'];
      $A_itemKeywords = $row['a_ItemKeywords'];

      $A_itemCat = $row['a_ItemCat'];
      $A_itemBrand = $row['a_ItemBrand'];


      // getting category name
      $get_cats = "SELECT * FROM categories WHERE cat_Id = '$A_itemCat'";
      $query = mysqli_query($conn, $get_cats) or die(mysqli_error($conn));

      $row_cats = mysqli_fetch_array($query);
        $cat_title = $row_cats['cat_Title'];


        // getting brand name
      $get_brands = "SELECT * FROM brands WHERE brand_Id = '$A_itemBrand'";
      $query = mysqli_query($conn, $get_brands) or die(mysqli_error($conn));

      $row_brands = mysqli_fetch_array($query);
        $brand_title = $row_brands['brand_Title'];
      }
}


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
          <td colspan="7" align="center">
            <h2><b>Edit Auction Item</b></h2>
            <p><b>Note: </b>Editing this auction goods requires you to add in a new time.</p>
          </td>
        </tr>

        <!-- ITEM NAME -->
        <tr>
          <td><b>Auction Item Name:</b></td>
          <td><input type="text" name="auction_item_name" value="<?php echo $A_itemName; ?>"/></td>
          <td></td>
          <td></td>
        </tr>

        <!-- ITEM CATEGORY -->
        <tr>
          <td align=""><b>Auction Item Category:</b></td>
          <td>
            <select name="auction_item_cat">
              <option><?php echo $cat_title; ?></option>
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
            <select class="" name="auction_item_brand">
              <option><?php echo $brand_title; ?></option>
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
          <td>
            <input type="file" name="auction_item_image" />
            <img src="product-images/<?php echo $A_itemImage ?>" width="80" height="80">
          </td>
        </tr>

        <!-- Old Price Amount -->
        <tr>
          <td><b>Enter Old Price:</b></td>
          <td><input type="text" name="auction_item_old_price" value="<?php echo $A_itemOldPrice; ?>"/></td>
        </tr>

        <!-- Minimum Bid Amount -->
        <tr>
          <td><b>Enter Minimum Bid Amount (in Rs.):</b></td>
          <td><input type="text" name="auction_item_min_price" value="<?php echo $A_itemMinPrice; ?>"/></td>
        </tr>

        <!-- ITEM DESCRIPTION -->
        <tr>
          <td><b>Auction Item Description:</b></td>
          <td><textarea name="auction_item_desc" rows="10" cols="20"><?php echo $A_itemDesc; ?></textarea></td>
        </tr>

        <!-- ITEM KEYWORDS -->
        <tr>
          <td><b>Auction Item Keywords:</b></td>
          <td><input type="text" name="auction_item_keywords" value="<?php echo $A_itemKeywords; ?>"/></td>
        </tr>

        <!-- AUCTION DURATION TIME -->
        <tr>
          <td><b>Enter Auction Time (in minutes):</b></td>
          <td><input type="text" name="auction_item_duration"/></td>
        </tr>

        <tr>
          <td></td>
          <td><input type="submit" name="update_auction" value="Update auction item" style="background:blue; color:#fff; padding:10px 10px; border:none"/></td>
        </tr>
      </table>
    </form>

  </body>
</html>




<?php

if (isset($_POST['update_auction'])) {

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


  if (!empty($auctionItemName) && !empty($auctionItemCat) && !empty($auctionItemBrand) && !empty($auctionItemOldPrice)
        && !empty($auctionItemMinPrice) && !empty($auctionItemDesc) && !empty($auctioItemKeyword) && !empty($duration) && !empty($auctionItemImage)) {

      $Update_AuctionItem = "UPDATE auction_items SET a_ItemName = '$auctionItemName', a_ItemCat = '$auctionItemCat', a_ItemBrand = '$auctionItemBrand',
                          a_ItemImage = '$auctionItemImage', a_ItemDescription = '$auctionItemDesc', a_ItemKeywords = '$auctioItemKeyword', a_ItemOldPrice = '$auctionItemOldPrice',
                           a_ItemMinBidPrice = '$auctionItemMinPrice', a_ItemDiscountRate = '$discount_Rate', dateAuctionStarts = NOW(), dateAuctionEnds = '$end_date'
                            WHERE auctionItemId = '$A_itemID'";
      $query = mysqli_query($conn, $Update_AuctionItem) or die(mysqli_error($conn));

      if ($query) {
        echo "<script>alert('Auction Item Has been Updated..! You will be redirected to view all auctioned items.')</script>";
        echo "<script>window.open('index.php?view_auction_items', '_self')</script>";
      }
    } else {
      echo "<script>alert('Some Fields are Empty. Fill All Fields Please!')</script>";
      echo "<script>window.open('index.php?view_auction_items', '_self')</script>";
    }
  }


 ?>
