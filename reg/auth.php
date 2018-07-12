<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../settings/db_connect.php';

    $login = ($_POST["login"]);

    $pass = md5($_POST['pass']);
    $pass = strrev($pass);

    if ($_POST['remember_me'] == "yes") {
        setcookie('remember_me', $login . '+' . $pass, time() + 3600 * 24 * 31, "/");
    }

    $result = $link->query("SELECT * FROM user WHERE (login = '$login' OR email = '$login') AND password = '$pass'");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        session_start();

        $_SESSION['auth'] = 'yes_auth';
        $_SESSION['auth_pass'] = $row['pass'];
        $_SESSION['auth_login'] = $row['login'];
        $_SESSION['auth_surname'] = $row['surname'];
        $_SESSION['auth_name'] = $row['name'];
        $_SESSION['auth_address'] = $row['address'];
        $_SESSION['auth_phone'] = $row['mobile'];
        $_SESSION['auth_email'] = $row['email'];

        echo 'yes_auth';
    } else {
        echo 'no_auth';
    }
}