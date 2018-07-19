<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "./settings/db_connect.php";

    $id_order = $_POST['WMI_PAYMENT_NO'];
    $status_pay = strtolower($_POST['WMI_ORDER_STATE']);
    $order_type_pay = $_POST['WMI_PAYMENT_TYPE'];
    $number_order = $_POST['WMI_ORDER_ID'];

    $update = $link->query("UPDATE orders SET order_pay = '$status_pay', order_type_pay = '$order_type_pay' WHERE order_id = '$id_order'");

    echo 'WMI_RESULT=OK&WMI_DESCRIPTION=Success';
}