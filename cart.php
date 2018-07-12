<?php include "settings/db_connect.php";
session_start();
include "./reg/auth_cookie.php";


$id = $_GET['id'];
$action = $_GET['action'];

switch ($action) {
    case 'clear':
        $delete_all = $link->query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;

    case 'delete':
        $delete = $link->query("DELETE FROM cart WHERE cart_id = $id AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "include/block-css.php"; ?>

</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">

    <?php
    $result = $link->query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_product");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        echo '
<div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite" id="shop-cart">
                <table class="table-shopping-cart">
                        <tr class="table-head">
                            <th class="column-1"></th>
                            <th class="column-2">Product</th>
                            <th class="column-3">Price</th>
                            <th class="column-4 p-l-70">Quantity</th>
                            <th class="column-5">Total</th>
                        </tr>';

        do {
            $total = $row["cart_price"] * $row["cart_count"];
            $cart_total = $cart_total + $total;

            echo '
                    <tr class="table-row">
                        <td class="column-1">
                          <a href=cart?id=' . $row['cart_id'] . '&action=delete>
                            <div class="cart-img-product b-rad-4 o-f-hidden">
                                <img src="/uploads_images/' . $row['image'] . '" alt="IMG-PRODUCT">
                            </div>
                          </a>
                        </td>
                        <td class="column-2"><a href="/product_detail?id='.$row['products_id'].'">' . $row['title'] .' ('.$row['cart_size'].')</a></td>
                        <td class="column-3">$' . $row['cart_price'] . '</td>
                        <td class="column-4">
                            <div class="flex-w bo5 of-hidden w-size17">
                                <button price="' . $row['cart_price'] . '" data-minus="' . $row['cart_id'] . '" class="btn-num-product-down color1 flex-c-m size7 bg8 eff2 minus">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input id="result ' . $row['cart_id'] . '" class="size8 m-text18 t-center num-product" data-loader="' . $row['cart_id'] . '" type="number" name="num-product1"
                                       value="' . $row['cart_count'] . '">

                                <button price="' . $row['cart_price'] . '" data-plus="' . $row['cart_id'] . '" class="btn-num-product-up color1 flex-c-m size7 bg8 eff2 plus">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                        <td id="total_product" class="column-5 total_product">$' . $total . '</td>
                    </tr>
                        ';

        } while ($row = mysqli_fetch_array($result));
    } else {
        echo
        '<div style="border: none; background-color: #f1f1f1;" class="card text-center">
                              <div class="card-body">
                                <h5 class="card-title">Your cart is empty</h5>
                                <p class="card-text">To add goods go to the shop</p>
                                <a href="/shop" class="btn btn-dark">Continue shopping</a>
                              </div>
                         </div>';
    }
    ?>
    </table>

    <?php if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo '
                <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
                    <div class="size10 trans-0-4 m-t-10 m-b-10">
                        <!-- Button -->
                        <a class="delete-all" href=cart?action=clear>
                            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Delete All
                            </button>
                        </a>
                    </div>
                </div>
                   </div>
                </div>
                <!-- Total -->
                <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
                    <h5 class="m-text20 p-b-24">
                        Cart Totals
                    </h5>
        
                    <!--  -->
                    <div class="flex-w flex-sb-m p-t-26 p-b-30">
                            <span class="m-text22 w-size19 w-full-sm">
                                Total:
                            </span>
        
                        <span class="m-text21 w-size20 w-full-sm final-price">$' . $cart_total . '</span>
                    </div>
        
                    <div class="size15 trans-0-4">
                        <!-- Button -->
                        <a href="/proceed_checkout">
                            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                Proceed to Checkout
                            </button>
                        </a>
        
                    </div>
                </div>
            </div>';
    } ?>
    </div>
    </div>
    </div>
</section>

<?php include "include/block-footer.php" ?>

<?php include "include/block-js.php"; ?>

</body>
</html>
