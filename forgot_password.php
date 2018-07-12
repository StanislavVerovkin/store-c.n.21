<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Forgot Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "include/block-css.php"; ?>

    <?php
    include "settings/db_connect.php";
    session_start();
    include "./reg/auth_cookie.php";
    ?>

</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="/registration" class="s-text16">
        Sign in
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">Forgot password</span>
</div>
<section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">
        <div id="rem_message"></div>
        <div id="block-remind">
            <div class="form-group">
                <input type="email" class="form-control" id="remind-email" placeholder="Your E-mail">
            </div>
            <div class="buttons">
                <div class="w-size2 p-t-20">
                    <a href="/registration">
                        <button id="button-remind_back"
                                class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                            Go back
                        </button>
                    </a>
                </div>
                <div class="w-size2 p-t-20">
                    <button type="submit" id="button-remind"
                            class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "include/block-footer.php" ?>

<?php include "include/block-js.php"; ?>

<script>
    $('#button-remind').click(function () {
        console.log('ok');
        var recall_email = $('#remind-email').val();

        if (recall_email == '') {
            $('#rem_message').html('Please input your e-mail');
        } else {
            $.ajax({
                type: "POST",
                url: '/reg/remind-pass.php',
                data: "email=" + recall_email,
                dataType: "html",
                cache: false,
                success: function (data) {
                    if (data == 'yes') {
                        $('#block-remind').fadeOut(300, function () {
                            $('#rem_message').fadeIn(400).html(
                                "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">\n" +
                                "  <strong>Your new password successfully sent!</strong>\n" +
                                "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
                                "    <span aria-hidden=\"true\">&times;</span>\n" +
                                "  </button>\n" +
                                "</div>");
                        });
                    }
                }
            })
        }
    })
</script>

</body>
</html>
