<?php
include("settings/db_connect.php");
session_start();
include("reg/auth_cookie.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Contact</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "include/block-css.php"; ?>
</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<!-- content page -->
<section class="bgwhite p-t-66 p-b-60" id="grey">
    <div class="container">
        <div id="rem_message"></div>
        <div id="block-contact" class="row">
            <div class="col-md-6 p-b-30">
                <canvas id="canvas"></canvas>
            </div>
            <div class="col-md-6 p-b-30">
                <form method="post" id="form_contact" action="/settings/contact-form.php">
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Send us your message
                    </h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="feed_name" id="feed_name"
                               placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="feed_email" id="feed_email"
                               placeholder="E-mail Address">
                    </div>
                    <div class="form-group" id="text">
                        <textarea rows="7" type="password" class="form-control" name="feed_message" id="feed_message"
                                  placeholder="Message"></textarea>
                    </div>
                    <div class="w-size25">
                        <!-- Button -->
                        <button type="submit" id="send_message"
                                class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include "include/block-footer.php" ?>
<?php include "include/block-js.php"; ?>
<?php include "include/block-canvas.php"; ?>

<script>
    $(document).ready(function () {
        $('#form_contact').validate({
            rules: {
                "feed_name": {
                    required: true
                },
                "feed_email": {
                    required: true,
                    email: true
                },
                "feed_message": {
                    required: true
                }
            },
            messages: {
                "feed_name": {
                    required: "Please input your name"
                },
                "feed_email": {
                    email: "Incorrect e-mail"
                },
                "feed_message": {
                    required: "Please input your message"
                }
            },

            submitHandler: function (form) {
                $(form).ajaxSubmit({
                    success: function (data) {
                        if (data == 'yes') {
                            $('#block-contact').fadeOut(300, function () {
                                $('#rem_message').fadeIn(400).html("<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">\n" +
                                    "  <strong>Your query successfully sent! Thanks for your feedback</strong>\n" +
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
    })
</script>

</body>
</html>
