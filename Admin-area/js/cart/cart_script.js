$(document).ready(function(data) {

  $('.add_to_cart').click(function(event){
    event.preventDefault();
    var product_id = $(this).attr('id');

    $.ajax({
      url : "/cars/function/add-to-cart.php",
      method : "POST",
      data : {
        add_to_cart : "add_to_cart",
        product_id : product_id
      },
      success:function(data){
        $('#product_msg').html(data);
        cart_count();
      }
    })
  });


  //TO COUNT/DISPLAY THE NUMEBER OF ITEMS A USER HAVE (cart_checkout)
   cart_count();

    function cart_count() {
      $.ajax({
        url: "/cars/function/add-to-cart.php",
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
        url: "/cars/function/add-to-cart.php",
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
    var total = qty * price;
    $('#total-'+pid).val(total);
  })


  //TO DELETE ITEMS FROM THE CART TABLE
  $('body').delegate('.remove','click',function(event){
    event.preventDefault();
    var pid = $(this).attr("remove_id");
    $.ajax({
      url : "/cars/function/add-to-cart.php",
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
      url : "/cars/function/add-to-cart.php",
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

  })


});
