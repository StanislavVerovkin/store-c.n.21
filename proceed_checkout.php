<?php

include "settings/db_connect.php";
session_start();
include "./reg/auth_cookie.php";

if (isset($_POST['submit_data'])) {

    if ($_SESSION['auth'] == 'yes_auth') {

        $link->query("INSERT INTO orders(order_datetime,order_delievery,order_name, order_surname,order_address,order_phone,order_email)
						VALUES(	
                             NOW(),
                            '" . $_POST["order_delivery"] . "',					
							'" . $_SESSION['auth_name'] . "',
							'" . $_SESSION['auth_surname'] . "',
                            '" . $_SESSION['auth_address'] . "',
                            '" . $_SESSION['auth_phone'] . "',
                            '" . $_SESSION['auth_email'] . "'                              
						    )");

    } else {
        $_SESSION['order_surname'] = $_POST['order_surname'];
        $_SESSION['order_name'] = $_POST['order_name'];
        $_SESSION['order_email'] = $_POST['order_email'];
        $_SESSION['order_phone'] = $_POST['order_phone'];
        $_SESSION['order_address'] = $_POST['order_address'];
        $_SESSION['order_delivery'] = $_POST['order_delivery'];
        $_SESSION['order_delivery_auth'] = $_POST['order_delivery_auth'];

        $link->query("INSERT INTO orders(order_datetime,order_delievery,order_name,order_surname,order_address,order_phone,order_email)
						VALUES(	
                             NOW(),
                            '" . $_POST["order_delivery"] . "',				
                            '" . $_POST["order_name"] . "',				
                            '" . $_POST["order_surname"] . "',				
                            '" . $_POST["order_address"] . "',				
                            '" . $_POST["order_phone"] . "',			
                            '" . $_POST["order_email"] . "'			
						    )");
    }

    $_SESSION["order_id"] = mysqli_insert_id($link);

    $result = $link->query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        do {

            $link->query("INSERT INTO buy_products(buy_id_order,buy_id_product,buy_count_product)
						VALUES(	
                            '" . $_SESSION["order_id"] . "',					
							'" . $row["cart_id_product"] . "',
                            '" . $row["cart_count"] . "'                   
						    )");


        } while ($row = mysqli_fetch_array($result));
    }

    header("Location: proceed_checkout_final");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Checkout</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "include/block-css.php"; ?>

</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="/" class="s-text16">
        Cart
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">Contact data</span>
</div>
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <?php if ($_SESSION['auth'] != 'yes_auth') {
            echo
                '
        <form method="post" id="form_checkout">
        <h4>Delivery methods:</h4>
        <hr>
            <ul id="info-radio">
                <li>
                    <input required type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="Nova Poshta"/>
                    <label class="label_delivery" for="order_delivery1">Nova Poshta (Ukraine, World)</label>
                </li>
                <li>
                    <input required type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Representative of the brand"/>
                    <label class="label_delivery" for="order_delivery2">Representative of the brand (Kiev only)</label>
                </li>
                <hr>
            </ul>
            <p id="reg_message"></p>
            <div id="block-form-registration">
                <div class="form-group">
                    <input type="text" class="form-control" name="order_surname" id="order_surname"
                           placeholder="Surname (ex. Smith)" value="' . $_SESSION['order_surname'] . '">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="order_name" id="order_name" placeholder="Name (ex. John)" value="' . $_SESSION['order_name'] . '">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="order_email" id="order_email" placeholder="E-mail (ex. john_smith@gmail.com)" value="' . $_SESSION['order_email'] . '">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="order_phone" id="order_phone" placeholder="Phone (ex. +38 063 *** ** **)" value="' . $_SESSION['order_phone'] . '">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="order_address" id="order_address"
                           placeholder="Address (ex. str. Kreschatik 14, apt. 13)" value="' . $_SESSION['order_address'] . '">
                </div>
                <div class="w-size2 p-t-20">
                    <button type="submit" name="submit_data" id="confirm-button-next"
                            class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Next
                    </button>
                </div>
            </div>
            <hr>
        </form>
            ';
        } else {
            echo '
                  <p class="reg_message_good">Your contact data successfully saved after authorization</p>
                                     <hr>
            <form method="post">
                   <h4>Delivery methods:</h4>
                   <hr>
            <ul id="info-radio">
                <li>
                    <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="Nova Poshta"/>
                    <label class="label_delivery" for="order_delivery1">Nova Poshta (Ukraine, World)</label>
                </li>
                <li>
                    <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Representative of the brand"/>
                    <label class="label_delivery" for="order_delivery2">Representative of the brand (Kiev only)</label>
                </li>
            </ul>
                  <div class="w-size2 p-t-20">
                  <a href="/proceed_checkout_final">
                    <button type="submit" name="submit_data" id="confirm-button-next" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Next
                    </button>
                  </a>
                  </div>
                 <hr>
                 </form>
                  ';
        }
        ?>
    </div>
</section>
<?php include "include/block-footer.php" ?>

<?php include "include/block-js.php"; ?>

<script>
    $('#form_checkout').validate({
        rules: {
            "order_surname": {
                required: true
            },
            "order_name": {
                required: true
            },
            "order_email": {
                required: true,
                email: true
            },
            "order_phone": {
                required: true
            },
            "order_address": {
                required: true
            }
        },
        messages: {
            "order_surname": {
                required: "Please input your Surname"
            },
            "order_name": {
                required: "Please input your Name"
            },
            "order_email": {
                required: "Please input your E-mail"
            },
            "order_phone": {
                required: "Please input your contact phone"
            },
            "order_address": {
                required: "Please input your address for delivery"
            }
        }
    });
</script>

</body>
</html>
