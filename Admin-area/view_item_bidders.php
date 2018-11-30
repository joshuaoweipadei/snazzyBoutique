<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>
<style media="screen">
table, th, td {
    border: 1px solid #fff;
    border-collapse: collapse;
}
</style>
  <table align="" style="background:#000; width:100%; font-size:12px">
    <tr align="center">
      <td colspan="12"><h2 style="padding-bottom:15px">See All Bidders Here</h2></td>
    </tr>
    <tr align="" style="color:#fff; font-size:15px">
      <th>S/N</th>
      <th>Names</th>
      <th>Email</th>
      <th>Bid Item(ID)</th>
      <th>Bid Min Price</th>
      <th>Bidders Price</th>
      <th>High Bid</th>
      <th>Delete</th>
    </tr>
      <?php
      include ('database.php');

      if (isset($_GET['viewbiditemid'])) {
        $bidItem_id = $_GET['viewbiditemid'];

        $sql = "SELECT * FROM bidders__customers WHERE auctionBid_Id = '$bidItem_id'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($query) {
          $i = 0;
          while ($row = mysqli_fetch_array($query)) {

            $bidder_id = $row['customerId'];
            $bidder_firstname = $row['c_First'];
            $bidder_lastname = $row['c_Last'];
            $bidder_email = $row['c_Email'];
            $bidItem_Name = $row['auctionBid_Name'];
            $min_bid = $row['min_Bid'];
            $customer_bid = $row['customer_Bid'];

            $i++;

            $SQL = "SELECT * FROM customers_img WHERE customerId = '$bidder_id'";
            $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));

              $rowImage = mysqli_fetch_array($QUERY);
                $c_Image = $rowImage['c_Image'];

                $SQL = "SELECT MAX(customer_Bid) AS Highestcustomer_Bid FROM bidders__customers WHERE auctionBid_Id = '$bidItem_id'";
                $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($QUERY)) {
                  $price = $row['Highestcustomer_Bid'];

      // $getCustomer = "SELECT * FROM customers";
      // $query = mysqli_query($conn, $getCustomer) or die(mysqli_error($conn));
      //
      // $i = 0;
      //
      // while ($rowCustomer = mysqli_fetch_array($query)) {
      //   $customer_ID = $rowCustomer['customerId'];
      //   $i++;
      //
      //   $SQL = "SELECT * FROM customers_img WHERE customerId = '$customer_ID'";
      //   $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
      //
      //   while ($rowImage = mysqli_fetch_array($QUERY)) {
      //     $c_Image = $rowImage['c_Image'];
      //
      //     // GETTING THE EXACT BIDDER
      //     $sql_1 = "SELECT * FROM bidders__customers WHERE customerId = '$customer_ID'";
      //     $query_1 = mysqli_query($conn, $sql_1) or die(mysqli_error($conn));
      //
      //     while ($row = mysqli_fetch_array($query_1)) {
      //       $auctionBid_id = $row['auctionBid_Id'];
      //       $customer_first = $row['c_First'];
      //       $customer_last = $row['c_Last'];
      //       $customer_email = $row['c_Email'];
      //       $bidItem_Name = $row['auctionBid_Name'];
      //       $min_bid = $row['min_Bid'];
      //       $customer_bid = $row['customer_Bid'];
      //
      //       $SQL = "SELECT MAX(customer_Bid) AS Highestcustomer_Bid FROM bidders__customers WHERE auctionBid_Id = '$auctionBid_id'";
      //       $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
      //       while ($row = mysqli_fetch_array($QUERY)) {
      //         $price = $row['Highestcustomer_Bid'];

            //<!-- MINIMUM BIDDER -->

            // $SQL = "SELECT MIN(customer_Bid) AS Lowestcustomer_Bid FROM bidders__customers WHERE auctionBid_Id = '$auctionItem_Id'";
            // $QUERY = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
            // while ($row = mysqli_fetch_array($QUERY)) {
            //   $price = $row['Lowestcustomer_Bid'];
            //
            //   echo "<span style='font-size:12px'>Min. Bidder - ".$price."</span><br>";
            // }

       ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td>
        <img src="../customer/uploaded_images/<?php echo $c_Image; ?>" width="50" height="50" style="border:2px solid #fff"><br>
        <?php echo $bidder_firstname; ?><br><?php echo $bidder_lastname; ?>
      </td>
      <td><?php echo $bidder_email; ?></td>
      <td><?php echo $bidItem_Name; ?></td>
      <td><?php echo $min_bid; ?></td>
      <td><?php echo $customer_bid; ?></td>
      <td><?php echo $price; ?></td>
      <td><a href="delete_customer.php?delete_customer=<?php echo $c_ID; ?>">Delete</a></td>
    </tr>
    <?php
  } } } }
    ?>
  </table>
