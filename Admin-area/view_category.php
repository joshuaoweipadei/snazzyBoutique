<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<style media="screen">
  table{
    background: #000;
    opacity: 0.9;
    color: #fff;
    font-size: 16px
  }
  table td{
    padding-right: 12px
  }
  table tr{
    margin: 10px
  }
</style>
  <table align="center" width="100%" style="background:#000" border>
    <tr align="center">
      <td colspan="6"><h2>View All Categories Here</h2></td>
    </tr>
    <tr align="center">
      <th>Category ID</th>
      <th>Category Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

      <?php
      include ('database.php');

      $getCategory = "SELECT * FROM categories";
      $query = mysqli_query($conn, $getCategory) or die(mysqli_error($conn));

      $i = 0;

      while ($rowCat = mysqli_fetch_array($query)) {
        $catID = $rowCat['cat_Id'];
        $catName = $rowCat['cat_Title'];

        $i++;
       ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $catName; ?></td>
      <td><a class="btn btn-info" href="index.php?edit_cat=<?php echo $catID; ?>">Edit</a></td>
      <td><a class="btn btn-danger" href="delete.php?delete_cat=<?php echo $catID; ?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </table>
