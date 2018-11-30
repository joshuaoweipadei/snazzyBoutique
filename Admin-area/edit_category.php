<?php

if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<?php

include ('database.php');

if (isset($_GET['edit_cat'])) {

  $cat_id = $_GET['edit_cat'];

  $getCat = "SELECT * FROM categories WHERE cat_Id = '$cat_id'";
  $query = mysqli_query($conn, $getCat) or die(mysqli_error($conn));

  $rowCat = mysqli_fetch_array($query);
  $catID = $rowCat['cat_Id'];
  $catName = $rowCat['cat_Title'];
}

 ?>
<div class="" style="width:100%; padding:80px; color:#fff">
  <form class="" action="" method="post">
    <h2>Update Category</h2>
    <br>
    <input type="text" name="new_cat" value="<?php echo $catName; ?>" style="padding:4px; font-size:20px">
    <br>
    <button type="submit" name="add_cat" style="padding:4px; font-size:13px; margin-top:8px">Update Category</button>
  </form>
</div>

<?php



if (isset($_POST['add_cat'])) {

  // Escape all $_POST variables to protect against SQL injections
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $updateCat_Id = $catID;
  $newCat = test_input($_POST['new_cat']);

  $updateCat = "UPDATE categories SET cat_Title = '$newCat' WHERE cat_Id = '$catID'";
  $query = mysqli_query($conn, $updateCat) or die(mysqli_error($conn));

  if ($query) {
    echo "<script>alert('Category Has been Updated!')</script>";
    echo "<script>window.open('index.php?view_cat', '_self')</script>";
  }
}

 ?>
