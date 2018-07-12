<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    include "../settings/db_connect.php";
    include "../functions/generate-pass.php";
    include "../functions/send-mail.php";
    include "../functions/clear-string.php";

    $email = ($_POST['email']);

    if ($email != '') {

        $result = $link->query("SELECT email FROM user WHERE email = '$email'");

        if (mysqli_num_rows($result) > 0) {

            $newPass = gen_pass();

            $pass = md5($newPass);
            $pass = strrev($pass);
            $pass = strtolower("9nm2rv8q" . $pass . "2yo6z");

            $updatePass = $link->query("UPDATE user SET password = '$pass' WHERE email = '$email'");

            send_mail(
                'c.n.21online@store.com',
                $email,
                'New password',
                'Your new password: ' . $newPass
            );

            echo 'yes';

        } else {

            echo 'no';
        }
    }
}