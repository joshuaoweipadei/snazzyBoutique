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
  <table align="center" width="100%" style="background:#000" border="1px">
    <tr align="center">
      <td colspan="6"><h2>View All Brand Here</h2></td>
    </tr>
    <tr align="center">
      <th>Brand ID</th>
      <th>Brand Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

      <?php
      include ('database.php');

      $getBrand = "SELECT * FROM brands";
      $query = mysqli_query($conn, $getBrand) or die(mysqli_error($conn));

      $i = 0;

      while ($rowBrand = mysqli_fetch_array($query)) {
        $brandID = $rowBrand['brand_Id'];
        $brandName = $rowBrand['brand_Title'];

        $i++;
       ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $brandName; ?></td>
      <td><a class="btn btn-info" href="index.php?edit_brand=<?php echo $brandID; ?>">Edit</a></td>
      <td><a class="btn btn-danger" href="delete.php?delete_brand=<?php echo $brandID; ?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </table>
