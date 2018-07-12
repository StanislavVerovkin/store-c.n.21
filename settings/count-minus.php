<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("db_connect.php");

    $id = strtolower($_POST["id"]);

    $result = $link->query("SELECT * FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $new_count = $row["cart_count"] - 1;

        if ($new_count > 0) {
            $update = $link->query("UPDATE cart SET cart_count='$new_count' WHERE cart_id='$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
            echo $new_count;
        } else {
            echo $row["cart_count"];
        }
    }
}