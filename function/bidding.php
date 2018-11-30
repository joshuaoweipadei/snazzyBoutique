<?php

session_start();

// // Check if user is logged in using the session variable
if (!isset($_SESSION['customerID']) && $_SESSION['c_active'] != 1) {

  header('location: ../404.php');

}else {
  //SESSION VARIABLE DECLARED
  // Makes it easier to read
  $userID = $_SESSION['customerID'];
  $email = $_SESSION['c_email'];

}


include ('../mysql/database.php');


// TO INSERT CUSTOMER BID
if (isset($_POST['bid'])) {
  if ($_POST['bid'] == "biditem") {

    // Escape all $_POST variables to protect against SQL injections
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $auction_item_id = test_input($_POST['auctionItem_id']);
    $bid_price = test_input($_POST['bid_price']);
    // $min_bid_price = test_input($_POST['min_bid_price']);
    $customer_id = test_input($_POST['customer_id']);
    $customer_email = test_input($_POST['customer_email']);

    if ($userID == $customer_id && $email == $customer_email)  {
      if (!empty($bid_price)) {
        if (is_numeric($bid_price)) {
          $sql = "SELECT * FROM auction_items WHERE auctionItemId = '$auction_item_id'";
          $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

          $row = mysqli_fetch_array($query);
            $AuctionItem_MinPrice = $row['a_ItemMinBidPrice'];

            $customer_Bid = number_format((float)$bid_price, 2, '.', '');
            $Minimun_Bid = number_format((float)$AuctionItem_MinPrice, 2, '.', '');

            if ($customer_Bid <= $Minimun_Bid) {
              echo "<div class='alert alert-warning alert-dismissible fade in' role='alert' style='background:#ff6600; color:#fff'>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                      </button>
                      <strong>Ohss!</strong> You've bid below the minimum basic bid..!
                    </div>";

            } else {
              // GETTING INFO FROM THE AUCTION_ITEM TABLE
              $AuctionItemId = $row['auctionItemId'];
              $AuctionItemName = $row['a_ItemName'];
              $AuctionItemCat = $row['a_ItemCat'];
              $AuctionItemBrand = $row['a_ItemBrand'];

              $sql1 = "SELECT * FROM customers WHERE customerId = '$userID' AND c_Email = '$email'";
              $query1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

              $customer = mysqli_fetch_array($query1);
                $customer_first_name = $customer['c_FirstName'];
                $customer_last_name = $customer['c_LastName'];

              // $AuctionItem_DateStart = $row['dateAuctionStarts'];
              // $AuctionItem_DateEnd = $row['dateAuctionEnds'];

                $SQL = "INSERT INTO bidders__customers (customerId, c_First, c_Last, c_Email, auctionBid_Id, auctionBid_Name, itemCat, ItemBrand, min_Bid, customer_Bid, bidded_date)
                        VALUES ('$userID', '$customer_first_name', '$customer_last_name', '$email', '$AuctionItemId', '$AuctionItemName', '$AuctionItemCat',
                        '$AuctionItemBrand', '$Minimun_Bid', '$customer_Bid', NOW())";
                $query = mysqli_query($conn, $SQL) or die(mysqli_error($conn));

                if ($query) {
                  echo "<div class='alert alert-success alert-dismissible fade in' role='alert' style='background:#339933; color:#000'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                          </button>
                          <strong>Okay!</strong> Your bid has been placed successfully.ood.
                        </div>";
                }
            }
        }
      }
    }
  }
}


// if (isset($_POST['bid_price'])) {
//   if ($_POST['bid_price'] == "updatecountdown") {
//
//     $sql = "SELECT * FROM auction_items";
//     $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//
//     if ($query) {
//       $row = mysqli_fetch_array($query);
//       $auctionItem_DateStart = $row['dateAuctionStarts'];
//       $auctionItem_DateEnds = $row['dateAuctionEnds'];
//
//       $start = strtotime($auctionItem_DateStart);
//       $end = strtotime($auctionItem_DateEnds);
//
//       $duration = $end - $start;
//       $diffInSecond = gmdate("H:i:s", $duration);
//
//       echo ($duration);
//     }
//   }
// }

if (isset($_POST['type']) || $_POST['type'] == "countdown") {
  if (isset($_POST['id'])) {

    $timer_id = $_POST['id'];

    $sql = "SELECT * FROM auction_items WHERE auctionItemId = '$timer_id'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $rowAuctionItem = mysqli_fetch_array($query);

    $auctionItem_Id = $rowAuctionItem['auctionItemId'];

     $auctionItem_DateStart = $rowAuctionItem['dateAuctionStarts'];
     $auctionItem_DateEnds = $rowAuctionItem['dateAuctionEnds'];

     $starttime = strtotime($auctionItem_DateStart);
     $endtime = strtotime($auctionItem_DateEnds);

       $duration = $endtime - $starttime;
       ?>
    <script type='text/javascript'>
      setInterval(function(){
       var end = ".$auctionItem_DateEnds." * 1000;
       var current = new Date().getTime();
        var seconds_left = (end - current) /1000;

        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);



      }, 1000);
    </script>";
<?php
echo "<script>days + 'd, ' + hours + 'h, ' + minutes + 'm, ' + seconds + 's ';</script>";
  }
}
?>
