<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<div class="" style="width:100%; padding:80px; color:#fff">
  <form action="" method="post">
    <h2>Insert New Brand</h2>
    <br>
    <input class="form-control" type="text" name="new_brand" style="padding:4px; font-size:20px; width:40%">
    <br>
    <button type="submit" name="add_brand" class="btn btn-success" style="padding:6px; font-size:15px; margin-top:8px">Add Brand</button>
  </form>
</div>

<?php

include ('database.php');

if (isset($_POST['add_brand'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $newBrand = test_input($_POST['new_brand']);

  if (!empty($newBrand)) {

    $insertBrand = "INSERT INTO brands (brand_Title) VALUES ('$newBrand')";
    $query = mysqli_query($conn, $insertBrand) or die(mysqli_error($conn));

    if ($query) {
      echo "<script>alert('New Brand Has been Inserted!')</script>";
      echo "<script>window.open('index.php?view_brands', '_self')</script>";
    }

  } else {
    echo "<script>alert('Brands Fields is Empty!')</script>";
    echo "<script>window.open('index.php?insert_brand', '_self')</script>";
  }
}
 ?>
