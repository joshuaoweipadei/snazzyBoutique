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
    <title>Admin Area | Insert Product</title>
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
      opacity: 0.9;
      color: #fff
    }
    table td{
      padding-right: 12px
    }
    table input[type=submit]{
      padding: 9px;
      color: #fff;
      background: green;
      font-size: 19px;
      border: none;
      margin-top: 9px;
      border-radius: 5px
    }
  </style>

  </head>

  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <table align="" width="100%" style="margin-right:9px">
        <tr>
          <td colspan="7" align="center"><h2>Insert Product</h2></td>
        </tr>

        <!-- PRODUCT NAME -->
        <tr>
          <td><b>Product Name:</b></td>
          <td><input class="form-control" type="text" name="product_name" style="width:70%"/></td>
        </tr>

        <!-- PRODUCT CATEGORY -->
        <tr>
          <td><b>Product Category:</b></td>
          <td>
            <select class="form-control" name="product_cat" style="width:70%">
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

        <!-- PRODUCT BRAND -->
        <tr>
          <td><b>Product Brands:</b></td>
          <td>
            <select class="form-control" name="product_brand" style="width:70%">
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

        <!-- PRODUCT IMAGE -->
        <tr>
          <td><b>Product Image:</b></td>
          <td><input type="file" name="product_image" /></td>
        </tr>

        <!-- PRODUCT PRICE -->
        <tr>
          <td><b>Product Price:</b></td>
          <td><input class="form-control" type="text" name="product_price" style="width:35%"/></td>
        </tr>

        <!-- PRODUCT DESCRIPTION -->
        <tr>
          <td><b>Product Description:</b></td>
          <td><textarea class="form-control" name="product_desc" rows="10" cols="20" id="textarea" style="width:96%"></textarea></td>
        </tr>

        <!-- PRODUCT KEYWORDS -->
        <tr>
          <td><b>Product Keywords:</b></td>
          <td><input class="form-control" type="text" name="product_keywords" style="width:40%"/></td>
        </tr>

        <tr>
          <td></td>
          <td><input type="submit" name="insert_post" value="Insert product now" /></td>
        </tr>
      </table>
    </form>

  </body>
</html>




<?php

// INSERTING NEW PRODUCTS INTO THE DATABASE
if (isset($_POST['insert_post'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  //getting the text data from the fields
  $product_name = test_input($_POST['product_name']);
  $product_cat = test_input($_POST['product_cat']);
  $product_brand = test_input($_POST['product_brand']);
  $product_price = test_input($_POST['product_price']);
  $product_desc = test_input($_POST['product_desc']);
  $product_keywords = test_input($_POST['product_keywords']);

  //getting the image from the fields
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp = $_FILES['product_image']['tmp_name'];

  move_uploaded_file($product_image_tmp, "product-images/$product_image");

  if (!empty($product_name) && !empty($product_cat) && !empty($product_brand) ||
      !empty($product_price) && !empty($product_desc) && !empty($product_keywords)) {

      $insert_product = "INSERT INTO products (productName, productCat, productBrand, productPrice, productDescription, productImage, productKeywords, date_inserted)
                          VALUES ('$product_name', '$product_cat', '$product_brand', '$product_price', '$product_desc', '$product_image', '$product_keywords', NOW())";
      $query = mysqli_query($conn, $insert_product) or die(mysqli_error($conn));

      if ($query) {
        echo "<script>alert('Product Has been inserted!')</script>";
        echo "<script>window.open('index.php?view_products', '_self')</script>";
      }
    } else {
      echo "<script>alert('Product Fields are Empty!')</script>";
      echo "<script>window.open('index.php?insert_product', '_self')</script>";
    }
  }
// CREATE TABLE products (
// 	productId int(11) not null AUTO_INCREMENT PRIMARY KEY,
//     productCat int(11) not null,
//     productBrand int(11) not null,
//     productTitle varchar(255) not null,
//     productPrice int(11) not null,
//     productDescription text(200) not null,
//     productImage text(100) not null,
//     productKeywords text(200) not null
// );



 ?>
