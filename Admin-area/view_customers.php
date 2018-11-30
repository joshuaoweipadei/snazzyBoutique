<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
  <table align="center" width="100%" style="background:#000" border="1">
    <tr align="center">
      <td colspan="6"><h2>View All Customers Here</h2></td>
    </tr>
    <tr align="center" style="color:#fff; border-bottom:4px solid #fff; font-size:17px">
      <th>S/N</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Image</th>
      <th>Email</th>
      <th>Delete</th>
    </tr>

      <?php
      include ('database.php');

      $getCustomer = "SELECT * FROM customers";
      $query = mysqli_query($conn, $getCustomer) or die(mysqli_error($conn));

      $i = 0;

      while ($rowCustomer = mysqli_fetch_array($query)) {
        $c_ID = $rowCustomer['customerId'];
        $c_Firstname = $rowCustomer['c_FirstName'];
        $c_Lastname = $rowCustomer['c_LastName'];
        $c_Email = $rowCustomer['c_Email'];
        // $c_Image = $rowCustomer['c_Image'];

        $i++;

        $SQL = "SELECT * FROM customers_img WHERE customerId = '$c_ID'";
        $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));

        while ($row = mysqli_fetch_array($QUERY)) {
          $c_Image = $row['c_Image'];

       ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $c_Firstname; ?></td>
      <td><?php echo $c_Lastname; ?></td>
      <td><img src="../customer/uploaded_images/<?php echo $c_Image; ?>" width="50" height="50" style="border:2px solid #fff; margin:3px"></td>
      <td><?php echo $c_Email; ?></td>
      <td><a class="btn btn-danger" href="delete_customer.php?delete_customer=<?php echo $c_ID; ?>">Action</a></td>
    </tr>
    <?php
  } }
    ?>
  </table>
