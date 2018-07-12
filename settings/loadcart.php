<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include "db_connect.php";

    $result = $link->query("SELECT * FROM cart,table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_product");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        do {
            $count = $count + $row['cart_count'];

        } while ($row = mysqli_fetch_array($result));

        echo '
             <a href="/cart">            
             <img src="/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
             </a>
             <span class="header-icons-noti count">' . $count . '</span>
            ';
    }
}