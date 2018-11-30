$(document).ready(function() {

  $('.add_to_cart').click(function(event){
    event.preventDefault();
    var product_id = $(this).attr('id');

    $.ajax({
      url : "/jewelry/function/add-to-cart.php",
      method : "POST",
      data : {
        add_to_cart : "add_to_cart",
        product_id : product_id
      },
      success:function(data){
        $('#product_msg').html(data);

        // CALLING SO THAT WHENEVEN THE CART BUTTON IS CLICKED IT ADDS UP THE COUNT
        cart_count();
      }
    })
  });


  //TO COUNT/DISPLAY THE NUMEBER OF ITEMS A USER HAVE (cart_checkout)
   cart_count();

    function cart_count() {
      $.ajax({
        url: "/jewelry/function/add-to-cart.php",
        method : "POST",
        data : {
          cart_count : 1
        },
        success : function(data) {
          $("#cart_count").html(data);
        }
      })
    }


  //calling the function below(cart_checkout)
   cart_checkout();

    function cart_checkout() {
      $.ajax({
        url: "/jewelry/function/add-to-cart.php",
        method : "POST",
        data : {
          cart_checkout : 1
        },
        success : function(data) {
          $("#cart_checkout").html(data);
        }
      })
    }



  //calculating the price and the total price with the quantity
  //from get cart_checkout
  $('body').delegate('.qty','keyup',function(){
    var pid = $(this).attr("pid");
    var qty = $('#qty-'+pid).val();
    var price = $('#price-'+pid).val();

    if (qty == 0 || isNaN(qty)) {
      $('#qty-'+pid).css('border', '1px solid red');

    }else {
      $('#qty-'+pid).css('border', '1px solid blue');

      var total = qty * price;
      $('#total-'+pid).val(total);
    }
  });



  //TO DELETE ITEMS FROM THE CART TABLE
  $('body').delegate('.remove','click',function(event){
    event.preventDefault();
    var pid = $(this).attr("remove_id");
    $.ajax({
      url : "/jewelry/function/add-to-cart.php",
      method : "POST",
      data : {
        remove_from_cart : 1,
        removeId : pid
      },
      success : function(data){
        cart_checkout();
        cart_count();
      }
    })
  });


  //TO UPDATE ITEMS IN THE CART TABLE
  $('body').delegate('.updatee','click',function(event){
    event.preventDefault();
    var pid = $(this).attr("updatee_id");
    var qty = $('#qty-'+pid).val();
    var price = $('#price-'+pid).val();
    var total = $('#total-'+pid).val();

    $.ajax({
      url : "/jewelry/function/add-to-cart.php",
      method : "POST",
      data : {
        update_cart : 1,
        updateId : pid,
        qty : qty,
        price : price,
        total : total
      },
      success : function(data){
        cart_checkout();
        cart_count();
      }
    })
  });


  // pagination();
  // function pagination() {
  //   $.ajax({
  //     url : "/jewelry/function/add-to-cart.php",
  //     method : "POST",
  //     data : {page : 1},
  //     success : function(data){
  //       $('#pageNo').html(data);
  //     }
  //   })
  // }
  // $('body').delegate('#page','click',function(){
  //   var pg = $(this).attr('page');
  //   $.ajax({
  //     url : "/cars/shop.php",
  //     method : "POST",
  //     data : {
  //       setPage : 1,
  //       pageNumber : pg
  //     },
  //     success : function(data){
  //       $('.ass').html(data);
  //     }
  //   })
  // });





<!-- // GETTING CUSTOMERS BID AND THE Price -->
    $(".place_bid").click(function() {

        var item_id = $(this).attr("submit");
        var bid_price = $('#bid_price-'+item_id).val();
        var min_bid_price = $('#auction_price-'+item_id).val();

        var Actual_min_bid_price = Math.round(min_bid_price);
        var Actual_bid_price = Math.round(bid_price);
        // var s = parseFloat(auctionItem_old_price).toFixed(2);
          if (bid_price == "" || isNaN(bid_price)) {
            $("#bid_price-"+item_id).focus();
            $("#bid_price-"+item_id).css('border' , '1px solid red');
          } else {

            if (Actual_min_bid_price >= Actual_bid_price) {
              $("#bid_price-"+item_id).focus();
              $("#bid_price-"+item_id).css('border' , '1px solid red');
            }else {
              $("#bid_price-"+item_id).css('border' , '1px solid #e1e1e1');

              var auctionItem_id = $('#auction_id-'+item_id).val();
              var customer_id = $("#customer_id").val();
              var customer_email = $("#customer_email").val();

              $.ajax({
                  url : "/jewelry/function/bidding.php",
                  method : "POST",
                  data : {
                    bid : "biditem",
                    auctionItem_id : auctionItem_id,
                    bid_price : Actual_bid_price,
                    min_bid_price : Actual_min_bid_price,
                    customer_id : customer_id,
                    customer_email : customer_email
                  },
                  success : function(data){
                    $('.msg').html(data);
                  }
                })
                //Remove the text from the textarea, ready for another comment!
                //Possibly...
                $('#bid_price-'+item_id).val("");

              } //end else
            }
          });




    // // var timer = $("[cou]");
    // // // setInterval(function(){
    // // //   $.ajax({
    // // //     url : "/jewelry/function/bidding.php",
    // // //     method : "POST",
    // // //     data : {
    // // //       bid_price : "updatecountdown"
    // // //     },
    // // //     success : function(data){
    // // //       setInterval(function(){
    // // //       $(".cou").html(data);
    // // //       }, 1000);
    // // //     }
    // // //   });
    // // // }, 1000);
    //
    //
    //
    //
    //
    // //
    // // setInterval(function(){
    // //     $.post("/jewelry/function/bidding.php", {bid_price : "updatecountdown"}, function(data){
    // //       timer.html("Time Left: " + data + " seconds.")
    // //     });
    // // }, 1000);
    //
    //
    //
    //
    //
    // function timer(){
    //   var timer = $("[cou]").val();
    // }
    // setTimeout("timer()", 1000);


});
