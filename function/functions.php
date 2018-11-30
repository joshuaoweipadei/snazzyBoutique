<?php

 // session_start();


    //getting the IP address of a particular user
    function getIp() {
      $ip = $_SERVER['REMOTE_ADDR'];

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }

      return $ip;
    }




    //getting the categories
    function getCategories() {
      global $conn;

      $get_cats = "SELECT * FROM categories";
      $query = mysqli_query($conn, $get_cats) or die(mysqli_error($conn));

      while ($row_cats = mysqli_fetch_array($query)) {
        $cat_id = $row_cats['cat_Id'];
        $cat_title = $row_cats['cat_Title'];

        echo "<div class='panel panel-default'>
                <div class='panel-heading'>
                  <a href='index.php?cat=$cat_id' class='panel-title'><h6 >$cat_title</h6></a>
                </div>
              </div>";
      }
    }



    //getting the brands
    function getBrands() {
      global $conn;

      $get_brands = "SELECT * FROM brands";
      $query = mysqli_query($conn, $get_brands) or die(mysqli_error($conn));

      while ($row_brands = mysqli_fetch_array($query)) {
        $brand_id = $row_brands['brand_Id'];
        $brand_title = $row_brands['brand_Title'];

        echo "<li><a href='index.php?brands=$brand_id'><span class='pull-right'><i class='fa fa-check'></i></span>$brand_title</a></li>";
      }
    }




    //display product
    function getProduct() {
      if (!isset($_GET['cat'])) {
        if (!isset($_GET['brands'])) {

          global $conn;

          $get_product = "SELECT * FROM products ORDER BY RAND() LIMIT 0,12";
          $query = mysqli_query($conn, $get_product) or die(mysqli_error($conn));

          while ($row_product = mysqli_fetch_array($query)) {
            $pro_id = $row_product['productId'];
            $pro_name = $row_product['productName'];
            $pro_brand = $row_product['productBrand'];
            $pro_cat = $row_product['productCat'];
            $pro_price = $row_product['productPrice'];
            $pro_img = $row_product['productImage'];
            // $pro_desc = $row_product['productDescription'];

            echo "<div class='col-sm-4'>
                    <div class='product-image-wrapper'>
                      <div class='single-products'>
                        <div class='productinfo text-center'>
                          <div style='height:127px'>
                            <img src='Admin-area/product-images/$pro_img' alt='' width='100%' height='100%'/>
                          </div>
                          <h2>$ $pro_price</h2>
                          <h5><b>$pro_name</b></h5>
                          <button class='btn btn-default add_to_cart' id='$pro_id' ><i class='fa fa-shopping-cart'></i>Add to cart</button>
                        </div>
                      </div>
                      <div class='choose'>
                        <ul class='nav nav-pills nav-justified'>
                          <li><a href='details.php?pro_id=$pro_id'><i class='fa fa-plus-square'></i>Details</a></li>
                          <li><a href='product-details.php?pro_id=$pro_id'>Rate Us </i><i class='fa fa-star'></i><i class='fa fa-star-half-full'></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>";
          }
        }
      }
    }


    //getting products related to a category
    function getCatProduct() {
      if (isset($_GET['cat'])) {

        $cat_id = $_GET['cat'];

        global $conn;

        $get_cat_product = "SELECT * FROM products WHERE productCat = '$cat_id'";
        $query = mysqli_query($conn, $get_cat_product) or die(mysqli_error($conn));

        $count_cats = mysqli_num_rows($query);
        if ($count_cats == 0) {
          echo "<h4 style='padding:10px 3px 20px 3px'>No products found in this category!</h4>";

        }

        while ($row_cat_product = mysqli_fetch_array($query)) {
          $pro_id = $row_cat_product['productId'];
          $pro_name = $row_cat_product['productName'];
          $pro_brand = $row_cat_product['productBrand'];
          $pro_cat = $row_cat_product['productCat'];
          $pro_price = $row_cat_product['productPrice'];
          $pro_img = $row_cat_product['productImage'];
          // $pro_desc = $row_product['productDescription'];

          echo "<div class='col-sm-4'>
                  <div class='product-image-wrapper'>
                    <div class='single-products'>
                      <div class='productinfo text-center'>
                        <div style='height:160px'>
                          <img src='Admin-area/product-images/$pro_img' alt='' />
                        </div>
                        <h2>$ $pro_price</h2>
                        <h5><b>$pro_name</b></h5>
                        <button class='btn btn-default add_to_cart' id='$pro_id'><i class='fa fa-shopping-cart'></i>Add to cart</button>
                      </div>
                    </div>
                    <div class='choose'>
                      <ul class='nav nav-pills nav-justified'>
                        <li><a href='details.php?pro_id=$pro_id'><i class='fa fa-plus-square'></i>Details</a></li>
                        <li><a href='product-details.php?pro_id=$pro_id'>Rate Us <i class='fa fa-star'></i><i class='fa fa-star-half-full'></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>";

        }
      }
    }



    //getting product related to a brand
    function getBrandProduct() {
      if (isset($_GET['brands'])) {

        $brand_id = $_GET['brands'];

        global $conn;

        $get_brand_product = "SELECT * FROM products WHERE productBrand = '$brand_id'";
        $query = mysqli_query($conn, $get_brand_product) or die(mysqli_error($conn));

        $count_brand = mysqli_num_rows($query);
        if ($count_brand == 0) {
          echo "<h4 style='padding:10px 3px 20px 3px'>No products found associated with this Brand!</h4>";

        }

        while ($row_brand_product = mysqli_fetch_array($query)) {
          $pro_id = $row_brand_product['productId'];
          $pro_name = $row_brand_product['productName'];
          $pro_brand = $row_brand_product['productBrand'];
          $pro_cat = $row_brand_product['productCat'];
          $pro_price = $row_brand_product['productPrice'];
          $pro_img = $row_brand_product['productImage'];
          // $pro_desc = $row_product['productDescription'];

          echo "<div class='col-sm-4'>
                  <div class='product-image-wrapper'>
                    <div class='single-products'>
                      <div class='productinfo text-center'>
                        <div style='height:160px'>
                          <img src='Admin-area/product-images/$pro_img' alt='' />
                        </div>
                        <h2>$ $pro_price</h2>
                        <h5><b>$pro_name</b></h5>
                        <button class='btn btn-default add_to_cart' id='$pro_id'><i class='fa fa-shopping-cart'></i>Add to cart</button>
                      </div>
                    </div>
                    <div class='choose'>
                      <ul class='nav nav-pills nav-justified'>
                        <li><a href='details.php?pro_id=$pro_id'><i class='fa fa-plus-square'></i>Details</a></li>
                        <li><a href='product-details.php?pro_id=$pro_id'>Rate Us <i class='fa fa-star'></i><i class='fa fa-star-half-full'></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>";
        }
      }
    }





//
// //display product
// function getAllProduct() {
//
//   $limit = 9;
//   if (isset($_POST['setPage'])) {
//
//
//     $pageNo = $_POST['pageNumber'];
//     $startPage = ($pageNo * $limit) - $limit;
//   } else {
//     $startPage = 0;
//   }
//
//       global $conn;
//
//       $get_product = "SELECT * FROM products LIMIT $startPage,$limit";
//       $query = mysqli_query($conn, $get_product) or die(mysqli_error($conn));
//
//       while ($row_product = mysqli_fetch_array($query)) {
//         $pro_id = $row_product['productId'];
//         $pro_name = $row_product['productName'];
//         $pro_brand = $row_product['productBrand'];
//         $pro_cat = $row_product['productCat'];
//         $pro_price = $row_product['productPrice'];
//         $pro_img = $row_product['productImage'];
//         // $pro_desc = $row_product['productDescription'];
//
//         echo "<div class='col-sm-3 ass'>
//                 <div class='product-image-wrapper'>
//                   <div class='single-products'>
//                     <div class='productinfo text-center'>
//                       <div style='height:130px'>
//                         <img src='Admin-area/product-images/$pro_img' alt='' />
//                       </div>
//                       <h2># $pro_price</h2>
//                       <h5><b>$pro_name</b></h5>
//                       <button class='btn btn-default add_to_cart' id='$pro_id' ><i class='fa fa-shopping-cart'></i>Add to cart</button>
//                     </div>
//                   </div>
//                   <div class='choose'>
//                     <ul class='nav nav-pills nav-justified'>
//                       <li><a href='details.php?pro_id=$pro_id'><i class='fa fa-plus-square'></i>Details</a></li>
//                       <li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li>
//                     </ul>
//                   </div>
//                 </div>
//               </div>";
//       }
//     }
//
//
//
//
//
//
// // function fer() {
//   // $limit = 9;
//   // if (isset($_POST['setPage'])) {
//   //
//   //
//   //   $pageNo = $_POST['pageNumber'];
//   //   $startPage = ($pageNo * $limit) - $limit;
//   // } else {
//   //   $startPage = 0;
//   // }
// // }
//
//
//


 ?>
