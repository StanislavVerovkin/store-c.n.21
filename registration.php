<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Sign in</title>
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

<section class="cart bgwhite p-t-70 p-b-100" id="girl">
    <div class="container">
        <form method="post" id="form_reg" action="/reg/main.php">
            <p id="reg_message"></p>
            <div id="block-form-registration">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" name="reg_login" id="reg_login" class="form-control" placeholder="Login">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="password" class="form-control" name="reg_pass" id="reg_pass"
                               placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="reg_surname" id="reg_surname"
                           placeholder="Surname">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="reg_name" id="reg_name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="reg_email" id="reg_email" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="reg_mobile" id="reg_mobile" placeholder="Phone">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="reg_address" id="reg_address"
                           placeholder="Address">
                </div>
                <div class="w-size2 p-t-20">
                    <button type="submit" name="reg_submit" id="form_submit"
                            class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Register
                    </button>
                </div>
            </div>
        </form>
        <form method="post" id="form_login">
            <p id="login_message"></p>
            <div id="block-form-login">
                <div class="form-group">
                    <input type="text" class="form-control" name="auth_login" id="auth_login"
                           placeholder="Login">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="auth_pass" id="auth_pass"
                           placeholder="Password">
                </div>
                <div style="left: 20px;" class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>
                <a id="remind_pass" href="/forgot_password">Forgot your password ?</a>
                <div class="w-size2 p-t-20">
                    <button type="submit" name="button_auth" id="button_auth"
                            class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        Login
                    </button>
                </div>
            </div>
        </form>

    </div>
</section>
<!--<canvas id="canvas_register"></canvas>-->
<?php include "include/block-footer.php" ?>
<?php include "include/block-js.php"; ?>
<?php //include "include/block-canvas.php"; ?>

<script>
    $(document).ready(function () {
        $('#form_reg').validate({
            rules: {
                "reg_login": {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                    remote: {
                        type: "POST",
                        url: "/reg/check_login.php"
                    }
                },
                "reg_pass": {
                    required: true,
                    minlength: 7,
                    maxlength: 17
                },
                "reg_surname": {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                "reg_name": {
                    required: true,
                    minlength: 3,
                    maxlength: 15
                },
                "reg_email": {
                    required: true,
                    email: true
                },
                "reg_mobile": {
                    required: true
                },
                "reg_address": {
                    required: true
                }
            },

            messages: {
                "reg_login": {
                    required: "Please input your login",
                    minlength: "From 5 till 15 symbols",
                    maxlength: "From 5 till 15 symbols",
                    remote: "Login is already used"
                },
                "reg_pass": {
                    required: "Please input your password",
                    minlength: "From 7 till 17 symbols",
                    maxlength: "From 7 till 17 symbols"
                },
                "reg_surname": {
                    required: "Please input your surname",
                    minlength: "From 3 till 20 symbols",
                    maxlength: "From 3 till 20 symbols"
                },
                "reg_name": {
                    required: "Please input your name",
                    minlength: "From 3 till 15 symbols",
                    maxlength: "From 3 till 15 symbols"
                },
                "reg_email": {
                    required: "Please input your e-mail",
                    email: "Incorrect e-mail"
                },
                "reg_mobile": {
                    required: "Please input your number of phone"
                },
                "reg_address": {
                    required: "Please input your address for delivery"
                }
            },

            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    success: function (data) {
                        if (data == 'true') {
                            $('#block-form-registration').fadeOut(300, function () {
                                $('#reg_message').addClass("reg_message_good").fadeIn(400).html("You are registered");
                                $('#form_submit').hide();
                            });
                        } else {
                            $('#reg_message').addClass("reg_message_error").fadeIn(400).html(data);
                        }
                    }
                });
            }
        });
    });
</script>

<script>
    $('#button_auth').click(function () {

        var auth_login = $('#auth_login').val();
        var auth_pass = $('#auth_pass').val();

        if ($("#remember_me").prop('checked')) {
            auth_remember_me = 'yes';

        } else {
            auth_remember_me = 'no';
        }

        $.ajax({
            type: "POST",
            url: "/reg/auth.php",
            data: "login=" + auth_login + "&pass=" + auth_pass + "&remember_me=" + auth_remember_me,
            dataType: "html",
            cache: false,
            success: function (data) {
                if (data == 'yes_auth') {
                    window.location.replace('/')
                }
            }
        })
    })
</script>

<script>
    $('#form_login').validate({
        rules: {
            "auth_login": {
                required: true,
                remote: {
                    type: "POST",
                    url: "/reg/check_login_auth.php"
                }
            },
            "auth_pass": {
                required: true
            }
        },
        messages: {
            "auth_login": {
                required: "Please input your login",
                remote: "User is not found"
            },
            "auth_pass": {
                required: "Please input your password"
            }
        }
    });
</script>
</body>
</html>
