<?php
session_start();
include("reg/auth_cookie.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | About</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'include/block-css.php' ?>
</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<!-- content page -->
<section class="bgwhite p-t-66 p-b-38" id="grey">
    <div class="container">
        <div class="row">
            <!--            <div class="col-md-4 p-b-30">-->
            <!--                <div class="hov-img-zoom">-->
            <!--                    <img src="images/banner-14.jpg" alt="IMG-ABOUT">-->
            <!--                </div>-->
            <!--            </div>-->

            <div class="col-md-8 p-b-30">

                <h3 class="m-text26 p-t-15 p-b-16">
                    About
                </h3>

                <div class="p-b-28">

                    <p>
                        С.N.21 - self-identification, a brand that connects high and street fashion into a single whole.
                        A
                        kind of hybrid, which is a mixture of street culture and classical fashion.
                    </p>

                    <p>
                        Largely inspired by youth and street culture C.N.21 calls this 'Street Tailoring'.
                    </p>

                    <p>
                        His avant design and classicism will no doubt continue to be a tour de force in the evolution of
                        men
                        and womenswear.
                    </p>

                    <p>
                        All products are based in a concept that adapts from season to season. Manufacturing is based
                        with a
                        core value of the brand to be made from the best and particular opinion regarding fabric, fit
                        and
                        fabrication.
                    </p>

                    <p>
                        The result is to be a young brand embracing a sophisticated manner.
                    </p>
                </div>
                <canvas id="canvas_about"></canvas>
            </div>
        </div>
</section>

<?php include "include/block-footer.php" ?>
<?php include "include/block-js.php"; ?>
<?php include "include/block-canvas.php"; ?>

</body>
</html>
