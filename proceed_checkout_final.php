<?php

include "settings/db_connect.php";
session_start();
include "./reg/auth_cookie.php";

$result = $link->query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_product");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    do {
        $total = $total + ($row["cart_price"] * $row["cart_count"]);

    } while ($row = mysqli_fetch_array($result));

    $_SESSION['total_price'] = $total;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Checkout Final</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "include/block-css.php"; ?>

</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm" id="grey">
    <a href="/cart.php" class="s-text16">
        Cart
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <a href="/proceed_checkout.php" class="s-text16">
        Contact data
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">Confirm order</span>
</div>
<section class="cart bgwhite p-t-70 p-b-100" id="grey">
    <div class="container">
        <?php if ($_SESSION['auth'] != 'yes_auth') {
            echo
                '
                <ul class="list-group list-group-flush" style="width: 350px">
                  <li class="list-group-item">' . $_SESSION['order_surname'] . '</li>
                  <li class="list-group-item">' . $_SESSION['order_name'] . '</li>
                  <li class="list-group-item">' . $_SESSION['order_email'] . '</li>
                  <li class="list-group-item">' . $_SESSION['order_phone'] . '</li>
                  <li class="list-group-item">' . $_SESSION['order_address'] . '</li>
                  <li class="list-group-item">' . $_SESSION['order_delivery'] . '</li>
                </ul>
                <strong style="position: relative; left: 250px">Total: $' . $total . '</strong>
                ';
        } else {
            echo
                '
            <ul class="list-group list-group-flush" style="width: 350px;">
                  <li class="list-group-item">' . $_SESSION['auth_surname'] . '</li>
                  <li class="list-group-item">' . $_SESSION['auth_name'] . '</li>
                  <li class="list-group-item">' . $_SESSION['auth_email'] . '</li>
                  <li class="list-group-item">' . $_SESSION['auth_phone'] . '</li>
                  <li class="list-group-item">' . $_SESSION['auth_address'] . '</li>
                  <li class="list-group-item">' . $_SESSION['auth_delivery'] . '</li>
            </ul>     
            <strong style="position: relative; left: 250px">Total: $' . $total . '</strong>
            ';
        }
        ?>
        <div class="w-size2 p-t-20">
            <form method="post" action="https://wl.walletone.com/checkout/checkout/Index">
                <input type="hidden" name="WMI_MERCHANT_ID" value="124470780570"/>
                <input type="hidden" name="WMI_PAYMENT_AMOUNT" value="<?php echo $total ?>"/>
                <input type="hidden" name="WMI_CURRENCY_ID" value="840"/>
                <input type="hidden" name="WMI_DESCRIPTION" value="Pay for product"/>
                <input type="hidden" name="WMI_SUCCESS_URL" value="http://php-less.xyz/"/>
                <input type="hidden" name="WMI_FAIL_URL" value="http://php-less.xyz/cart.php"/>
                <input class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" value="Pay" type="submit"/>
            </form>
        </div>
    </div>
</section>

<?php include "include/block-footer.php" ?>

<?php include "include/block-js.php"; ?>

</body>
</html>
