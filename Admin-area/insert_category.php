<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<div class="" style="width:100%; padding:80px; color:#fff">
  <form action="" method="post">
    <h2>Insert New Category</h2>
    <br>
    <input class="form-control" type="text" name="new_cat" style="padding:4px; font-size:20px; width:40%">
    <br>
    <button type="submit" name="add_cat" class="btn btn-success" style="padding:6px; font-size:15px; margin-top:8px">Add Category</button>
  </form>
</div>

<?php

include ('database.php');

if (isset($_POST['add_cat'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $newCat = test_input($_POST['new_cat']);

  if (!empty($newCat)) {

    $insertCat = "INSERT INTO categories (cat_Title) VALUES ('$newCat')";
    $query = mysqli_query($conn, $insertCat) or die(mysqli_error($conn));

    if ($query) {
      echo "<script>alert('New Category Has been Inserted!')</script>";
      echo "<script>window.open('index.php?view_cat', '_self')</script>";
    }

  } else {
    echo "<script>alert('Category Fields is Empty!')</script>";
    echo "<script>window.open('index.php?insert_cat', '_self')</script>";
  }
}
 ?>
