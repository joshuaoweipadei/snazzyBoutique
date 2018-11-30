<?php


if (!isset($_SESSION['admin_email'] )) {

  header('location: login.php');

} else {
  $adminEmail = $_SESSION['admin_email'];
}

?>


<div class="row" style="background:#000; color:#fff; padding:5px 10px; font-size:20px">
  <div class="col-sm-4">
    <h2 align="center" style="margin-bottom:30px">View Bid Items</h2>
      <table>
        <tr style="border-bottom:2px solid #fff">
          <th>S/N</th>
          <th>Items</th>
        </tr>
      <?php
      include ('database.php');

      $sql = "SELECT * FROM auction_items";
      $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

      $i = 0;
      while ($row = mysqli_fetch_array($query)) {
        $auctionItem_Id = $row['auctionItemId'];
        $auctionItem_Name = $row['a_ItemName'];

        $i++;
        ?>
        <tr>
          <td><?php echo $i.". "; ?></td>
          <td><a href="index.php?viewbiditemid=<?php echo $auctionItem_Id; ?>"><?php echo " ".$auctionItem_Name; ?></a></td>
        </tr>
        <?php
        }
        ?>
    </table>
  </div>
</div>
