<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    include "../settings/db_connect.php";
    include "../functions/send-mail.php";

    $name = ($_POST['feed_name']);
    $email = ($_POST['feed_email']);
    $message = ($_POST['feed_message']);

    send_mail(
        $email,
        'sverevkin25@gmail.com',
        'Letter from user',
        'From: ' . $name . '<br/>' . $message);

    echo 'yes';
}