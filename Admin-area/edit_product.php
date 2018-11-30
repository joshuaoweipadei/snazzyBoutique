<?php

if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<?php
  require ('database.php');
  // GETTING THE ID OF A PARTICULAR PRODUCT AND EDITING/UPDATING IT
  // IN DATABASE
  if (isset($_GET['edit_product'])) {
    $pro_id = $_GET['edit_product'];

    $getProduct = "SELECT * FROM products WHERE productId = '$pro_id'";
    $query = mysqli_query($conn, $getProduct) or die(mysqli_error($conn));

    $i = 0;

     $rowProduct = mysqli_fetch_array($query);

      $proID = $rowProduct['productId'];
      $proName = $rowProduct['productName'];
      $proImage = $rowProduct['productImage'];
      $proPrice = $rowProduct['productPrice'];
      $proDesc = $rowProduct['productDescription'];
      $proKeywords = $rowProduct['productKeywords'];
      $proCat = $rowProduct['productCat'];
      $proBrand = $rowProduct['productBrand'];


      // getting category name
      $get_cats = "SELECT * FROM categories WHERE cat_Id = '$proCat'";
      $query = mysqli_query($conn, $get_cats) or die(mysqli_error($conn));

      $row_cats = mysqli_fetch_array($query);
        $cat_title = $row_cats['cat_Title'];


        // getting brand name
      $get_brands = "SELECT * FROM brands WHERE brand_Id = '$proBrand'";
      $query = mysqli_query($conn, $get_brands) or die(mysqli_error($conn));

      $row_brands = mysqli_fetch_array($query);
        $brand_title = $row_brands['brand_Title'];

}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Area | Edit Product</title>
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
      color: #fff
    }
    table td{
      padding-right: 12px
    }
  </style>
  </head>

  <body>
    <form class="" action="" method="post" enctype="multipart/form-data">
      <table align="center" width="100%">
        <tr>
          <td colspan="7" align="center"><h2>Edit & Update Product</h2></td>
        </tr>

        <!-- PRODUCT NAME -->
        <tr>
          <td align="right">Product Name:</td>
          <td><input type="text" name="product_name" value="<?php echo $proName; ?>"/></td>
        </tr>

        <!-- PRODUCT CATEGORY -->
        <tr>
          <td align="right"><b>Product Category:</b></td>
          <td>
            <select name="product_cat">
              <option><?php echo $cat_title ?></option>
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
          <td align="right"><b>Product Brands:</b></td>
          <td>
            <select class="" name="product_brand">
              <option><?php echo $brand_title ?></option>
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
          <td align="right">Product Image:</td>
          <td>
            <input type="file" name="product_image" />
            <img src="product-images/<?php echo $proImage ?>" width="80" height="80">
          </td>
        </tr>

        <!-- PRODUCT PRICE -->
        <tr>
          <td align="right">Product Price:</td>
          <td><input type="text" name="product_price" value="<?php echo $proPrice; ?>"/></td>
        </tr>

        <!-- PRODUCT DESCRIPTION -->
        <tr>
          <td align="right">Product Description:</td>
          <td><textarea name="product_desc" rows="10" cols="20"><?php echo $proDesc; ?></textarea></td>
        </tr>

        <!-- PRODUCT KEYWORDS -->
        <tr>
          <td align="right">Product Keywords:</td>
          <td><input type="text" name="product_keywords" value="<?php echo $proKeywords; ?>"/></td>
        </tr>

        <tr align="center">
          <td colspan="7"><input type="submit" name="update_product" value="Update Product Now" /></td>
        </tr>
      </table>
    </form>

  </body>
</html>

<?php

if (isset($_POST['update_product'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  //getting the text data from the fields
  $updatePro_Id = $proID;
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

  $UpdateProduct = "UPDATE products SET productName = '$product_name', productCat = '$product_cat', productBrand = '$product_brand',
                    productPrice = '$product_price', productDescription = '$product_desc', productImage = '$product_image',
                     productKeywords = '$product_keywords' WHERE productId = '$updatePro_Id'";
  $query = mysqli_query($conn, $UpdateProduct) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('Product Has been Updated..!')</script>";
    echo "<script>window.open('index.php?view_products', '_self')</script>";
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
