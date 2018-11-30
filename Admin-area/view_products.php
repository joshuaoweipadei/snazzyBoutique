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
      <td colspan="6"><h2>View All Products Here</h2></td>
    </tr>
    <tr align="center">
      <th>S/N</th>
      <th>Name</th>
      <th>Image</th>
      <th>Price</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>

      <?php
      include ('database.php');

      $getProduct = "SELECT * FROM products";
      $query = mysqli_query($conn, $getProduct) or die(mysqli_error($conn));

      $i = 0;

      while ($rowProduct = mysqli_fetch_array($query)) {
        $proID = $rowProduct['productId'];
        $proName = $rowProduct['productName'];
        $proImage = $rowProduct['productImage'];
        $proPrice = $rowProduct['productPrice'];
        $i++;
       ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $proName; ?></td>
      <td><img src="product-images\<?php echo $proImage; ?>" width="80" height="80" ></td>
      <td><?php echo $proPrice; ?></td>
      <td><a href="index.php?edit_product=<?php echo $proID; ?>" class="btn btn-info">Edit</a></td>
      <td><a href="delete.php?delete_pro=<?php echo $proID; ?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </table>
