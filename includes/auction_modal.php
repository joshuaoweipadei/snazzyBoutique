
<div class="modal"style="top:0px" id="firefoxModal" tabindex="-1" role="dialog" aria-labelledby="firefoxModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#400080; color:#fff">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:#fff">&times;</span>
        </button>
        <h3 class="modal-title" id="firefoxModalLabel">Auction | Bidders</h3>
      </div>
      <div class="modal-body">
        <p style="font-size:15px"><b>Start Bidding</b> <br>Join your follow bidders while they bid for an item at a more cheap price!</p>
      </div>
      <div class="modal-footer" style="background:#b366ff; border:2px">
        <?php
        if (isset($_SESSION['customerID'])) {
        ?>
        <a href="auction.php"><button type="button" class="btn join" style="padding:6px 15px; font-size:18px; background:#e1e1e1; color:#000">Join</button></a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
