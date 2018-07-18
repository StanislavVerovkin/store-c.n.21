<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Main page</a> \ <a href='view_order.php' >View order</a>";

    include("include/db_connect.php");

    $id = $_GET["id"];
    $action = $_GET["action"];

    if (isset($action)) {
        switch ($action) {

            case 'accept':

                $update = $link->query("UPDATE orders SET order_confirmed='yes' WHERE order_id = '$id'");

                break;

            case 'delete':

                $delete = $link->query("DELETE FROM orders WHERE order_id = '$id'");
                header("Location: orders.php");

                break;
        }
    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//EN"
            "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
        <link href="css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>

        <title>View orders</title>
    </head>
    <body>
    <div id="block-body">
        <?php
        include("include/block-header.php");
        ?>
        <div id="block-content">
            <div id="block-parameters">
                <p id="title-page">View order</p>
            </div>
            <?php
            if (isset($msgerror)) echo '<p id="form-error" align="center">' . $msgerror . '</p>';


                $result = $link->query("SELECT * FROM orders WHERE order_id = '$id'");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    do {
                        if ($row["order_confirmed"] == 'yes') {
                            $status = '<span class="green">Done</span>';
                        } else {
                            $status = '<span class="red">Not done</span>';
                        }

                        echo '
                          <p class="view-order-link" ><a class="green" href="view_order.php?id=' . $row["order_id"] . '&action=accept" >Accept order</a> | <a class="delete" rel="view_order.php?id=' . $row["order_id"] . '&action=delete" >Delete order</a></p>
                          <p class="order-datetime" >' . $row["order_datetime"] . '</p>
                          <p class="order-number" >Order number ' . $row["order_id"] . ' - ' . $status . '</p>

                        <table align="center" cellpadding="10" width="100%">
                        <tr>
                            <th>Number</th>
                            <th>Name of product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Size</th>
                        </tr>
                        ';
                        $query_product = $link->query("SELECT * FROM buy_products,table_products WHERE buy_products.buy_id_order = '$id' AND table_products.products_id = buy_products.buy_id_product");

                        $result_query = mysqli_fetch_array($query_product);
                        do {
                            $price = $price + ($result_query["price"] * $result_query["buy_count_product"]);
                            $index_count = $index_count + 1;
                            echo '
                                 <tr>
                                    <td  align="center" >' . $index_count . '</td>
                                    <td  align="center" >' . $result_query["title"] . '</td>
                                    <td  align="center" >' . $result_query["price"] . '</td>
                                    <td  align="center" >' . $result_query["buy_count_product"] . '</td>
                                    <td  align="center" >' . $result_query["buy_size_product"] . '</td>
                                </tr>
                                        ';
                        } while ($result_query = mysqli_fetch_array($query_product));


                        if ($row["order_pay"] == "accepted") {
                            $statpay = '<span class="green">Payed</span>';
                        } else {
                            $statpay = '<span class="red">Not payed</span>';
                        }

                        echo '
                                </table>
                                <ul id="info-order">
                                    <li>Total price - <span>' . $price . '</span></li>
                                    <li>Way of delivery - <span>' . $row["order_delievery"] . '</span></li>
                                    <li>Status of pay - ' . $statpay . '</li>
                                    <li>Type of pay - <span>' . $row["order_type_pay"] . '</span></li>
                                    <li>Date of pay - <span>' . $row["order_datetime"] . '</span></li>
                                </ul>


                                <table align="center" cellpadding="10" width="100%">
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                </tr>

                                 <tr>
                                    <td  align="center" >' . $row["order_name"] . '</td>
                                    <td  align="center" >' . $row["order_surname"] . '</td>
                                    <td  align="center" >' . $row["order_address"] . '</td>
                                    <td  align="center" >' . $row["order_phone"] . '</td>
                                    <td  align="center" >' . $row["order_email"] . '
                                </tr>
                                </table>
                                        ';

                    } while ($row = mysqli_fetch_array($result));
                }

            ?>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    header("Location: login.php");
}
?>