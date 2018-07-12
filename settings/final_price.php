<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('db_connect.php');

    $result = $link->query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        do {
            $total = $total + ($row["cart_price"] * $row["cart_count"]);

        } while ($row = mysqli_fetch_array($result));

        echo $total;
    }
}
