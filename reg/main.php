<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();

    include "../settings/db_connect.php";

    $error = [];

    $login = strtolower($_POST['reg_login']);
    $pass = strtolower($_POST['reg_pass']);
    $surname = strtolower($_POST['reg_surname']);
    $name = strtolower($_POST['reg_name']);
    $email = strtolower($_POST['reg_email']);
    $phone = strtolower($_POST['reg_mobile']);
    $address = strtolower($_POST['reg_address']);

    if (strlen($login) < 5 or strlen($login) > 15) {
        $error[] = "From 5 till 15 symbols";
    } else {
        $result = $link->query("SELECT login FROM user WHERE login = '$login'");
        if (mysqli_num_rows($result) > 0) {
            $error[] = "Login is already used";
        }
    }

    if (strlen($pass) < 7 or strlen($pass) > 17) $error[] = "From 7 till 17 symbols";
    if (strlen($surname) < 3 or strlen($surname) > 20) $error[] = "From 3 till 20 symbols";
    if (strlen($name) < 3 or strlen($name) > 15) $error[] = "From 3 till 15 symbols";
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", trim($email))) $error[] = "Please input your e-mail";
    if (!$phone) $error[] = "Please input your number of phone";
    if (!$address) $error[] = "Please input your address for delivery";

    if (count($error)) {
        echo implode('<br/>', $error);
    } else {
        $pass = md5($pass);
        $pass = strrev($pass);

        $ip = $_SERVER['REMOTE_ADDR'];

        $link->query("INSERT INTO user(login, password, surname, name, email, mobile, address, datetime, ip) 
                        VALUES (
                                '" . $login . "',
                                '" . $pass . "',
                                '" . $surname . "',
                                '" . $name . "',
                                '" . $email . "',
                                '" . $phone . "',
                                '" . $address . "',
                                NOW(),
                                '" . $ip . "'
                                            )");
        echo 'true';
    }
}
