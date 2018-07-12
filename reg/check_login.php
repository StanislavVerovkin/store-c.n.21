<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../settings/db_connect.php';

    $login = ($_POST['reg_login']);

    $result = $link->query("SELECT login FROM user WHERE login = '$login'");

    if (mysqli_num_rows($result) > 0) {
        echo 'false';
    } else {
        echo 'true';
    }
}