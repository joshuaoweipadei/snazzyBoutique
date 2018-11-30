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
th, td {
    padding: 5px;
}
</style>
<div class="container-fluid" style="overflow:; ">
  <table  style=" width:99%; background:#000;" border="1">
    <tr align="center">
      <td colspan="8"><h2>View All Auction Items</h2></td>
    </tr>
    <tr style="background:#fff; color:#000">
      <th>S/N</th>
      <th>Name</th>
      <th>OldPrice</th>
      <th>MinPrice</th>
      <th>Discount Rate</th>
      <th>Date Start</th>
      <th>Date End</th>
      <th>Action</th>
    </tr>

      <?php
      include ('database.php');

      $getAuctionItem = "SELECT * FROM auction_items";
      $query = mysqli_query($conn, $getAuctionItem) or die(mysqli_error($conn));

      $i = 0;

      while ($row = mysqli_fetch_array($query)) {
        $AuctionItemId = $row['auctionItemId'];
        $AuctionItemName = $row['a_ItemName'];
        $AuctionItemImage = $row['a_ItemImage'];
        $AuctionItem_OldPrice = $row['a_ItemOldPrice'];
        $AuctionItem_MinPrice = $row['a_ItemMinBidPrice'];
        $AuctionItem_DiscountRate = $row['a_ItemDiscountRate'];
        $AuctionItem_DateStart = $row['dateAuctionStarts'];
        $AuctionItem_DateEnd = $row['dateAuctionEnds'];

        $i++;
       ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td>
        <img src="product-images\<?php echo $AuctionItemImage; ?>" width="70" height="70" ><br>
        <b><?php echo $AuctionItemName; ?></b>
      </td>
      <td><?php echo $AuctionItem_OldPrice; ?></td>
      <td><?php echo $AuctionItem_MinPrice; ?></td>
      <td><?php echo $AuctionItem_DiscountRate; ?></td>
      <td><?php echo $AuctionItem_DateStart; ?></td>
      <td><?php echo $AuctionItem_DateEnd; ?></td>
      <td>
        <button type="button" class="btn btn-danger">
          <a href="delete.php?deldaf643234gfadete_aucd23437tigdfadon_itrer78665875hgry456rewqrem=<?php echo $AuctionItemId; ?>">Delete</a>
        </button>
      </td>

    </tr>
    <?php
    }
    ?>
  </table>
</div>
