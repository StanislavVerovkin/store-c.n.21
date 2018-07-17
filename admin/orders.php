<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {
    define('myeshop', true);

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Main page</a> \ <a href='orders.php' >Orders</a>";

    include("include/db_connect.php");

    $sort = $_GET["sort"];
    switch ($sort) {

        case 'all-orders':

            $sort = "order_id DESC";
            $sort_name = 'From A to Z';

            break;

        case 'confirmed':

            $sort = "order_confirmed = 'yes' DESC";
            $sort_name = 'Done';

            break;

        case 'no-confirmed':

            $sort = "order_confirmed = 'no' DESC";
            $sort_name = 'Not done';

            break;

        default:

            $sort = "order_id DESC";
            $sort_name = 'From A to Z';

            break;

    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
        <link href="css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>

        <title>Orders</title>
    </head>
    <body>
    <div id="block-body">
        <?php
        include("include/block-header.php");

        $all_count = $link->query("SELECT * FROM orders");
        $all_count_result = mysqli_num_rows($all_count);

        $buy_count = $link->query("SELECT * FROM orders WHERE order_confirmed = 'yes'");
        $buy_count_result = mysqli_num_rows($buy_count);

        $no_buy_count = $link->query("SELECT * FROM orders WHERE order_confirmed = 'no'");
        $no_buy_count_result = mysqli_num_rows($no_buy_count);

        ?>
        <div id="block-content">
            <div id="block-parameters">
                <ul id="options-list">
                    <li>Sorting</li>
                    <li><a id="select-links" href="#"><? echo $sort_name; ?></a>
                        <ul id="list-links-sort">
                            <li><a href="orders.php?sort=all-orders">From A to Z</a></li>
                            <li><a href="orders.php?sort=confirmed">Done</a></li>
                            <li><a href="orders.php?sort=no-confirmed">Not done</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <div id="block-info">
                <ul id="review-info-count">
                    <li> Total orders - <strong><? echo $all_count_result; ?></strong></li>
                    <li>Done - <strong><? echo $buy_count_result; ?></strong></li>
                    <li>Not done - <strong><? echo $no_buy_count_result; ?></strong></li>

                </ul>
            </div>
            <?php
            $result = $link->query("SELECT * FROM orders ORDER BY $sort");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                do {
                    if ($row["order_confirmed"] == 'yes') {
                        $status = '<span class="green">Done</span>';
                    } else {
                        $status = '<span class="red">Not done</span>';
                    }

                    echo '
 <div class="block-order">
 
  <p class="order-datetime" >' . $row["order_datetime"] . '</p>
  <p class="order-number" >Order number ' . $row["order_id"] . ' - ' . $status . '</p>
  <p class="order-link" ><a class="green" href="view_order.php?id=' . $row["order_id"] . '" >Detail</a></p>
 </div>
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