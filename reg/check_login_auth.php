<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../settings/db_connect.php';

    $login = ($_POST['auth_login']);

    $result = $link->query("SELECT login FROM user WHERE login = '$login'");

    if (mysqli_num_rows($result) > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
}