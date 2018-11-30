<?php

if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>

<?php

include ('database.php');

if (isset($_GET['edit_brand'])) {

  $brand_id = $_GET['edit_brand'];

  $getBrand = "SELECT * FROM brands WHERE brand_Id = '$brand_id'";
  $query = mysqli_query($conn, $getBrand) or die(mysqli_error($conn));

  $rowBrand = mysqli_fetch_array($query);
    $brandID = $rowBrand['brand_Id'];
    $brandName = $rowBrand['brand_Title'];
}

 ?>
<div class="" style="width:100%; padding:80px; color:#fff">
  <form class="" action="" method="post">
    <h2>Insert New Brand</h2>
    <br>
    <input type="text" name="new_brand" value="<?php echo $brandName; ?>" style="padding:4px; font-size:20px">
    <br>
    <button type="submit" name="add_brand" style="padding:4px; font-size:13px; margin-top:8px">Update Brand</button>
  </form>
</div>

<?php


if (isset($_POST['add_brand'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $updateBrand_Id = $brandID;
  $newBrand = test_input($_POST['new_brand']);

  $insertBrand = "UPDATE brands SET brand_Title = '$newBrand' WHERE brand_Id = '$updateBrand_Id'";
  $query = mysqli_query($conn, $insertBrand) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('Brand Has been Updated!')</script>";
    echo "<script>window.open('index.php?view_brands', '_self')</script>";
  }
}

 ?>
