<?php
session_start();
include("include/db_connect.php");

if ($_POST["submit_enter"])
{
    $login = $_POST["input_login"];
    $pass  = $_POST["input_pass"];


    if ($login && $pass)
    {

        $result = $link->query("SELECT * FROM admin WHERE login = '$login' AND password = '$pass'");

        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);

            $_SESSION['auth_admin'] = 'yes_auth';

            header("Location: index.php");
        }else
        {
            $msgerror = "Incorrect login or password.";
        }


    }else
    {
        $msgerror = "Input all fields!";
    }

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style-login.css" rel="stylesheet" type="text/css" />

    <title>Панель управления</title>
</head>
<body>

<div id="block-pass-login" >
    <?php

    if ($msgerror)
    {
        echo '<p id="msgerror" >'.$msgerror.'</p>';

    }

    ?>
    <form method="post" >
        <ul id="pass-login">
            <li><label>Login</label><input type="text" name="input_login" /></li>
            <li><label>Password</label><input type="password" name="input_pass" /></li>
        </ul>
        <p align="right"><input type="submit" name="submit_enter" id="submit_enter" value="Enter" /></p>
    </form>

</div>


</body>
</html>