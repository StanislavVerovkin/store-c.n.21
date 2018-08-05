<?php
include "settings/db_connect.php";
session_start();
include "./reg/auth_cookie.php";

$usrAgent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $usrAgent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($usrAgent, 0, 4)))
    header('location: http://c-n-21.com/shop');
?>

<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
<head>
    <title>C.N.21 | Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "include/block-css.php"; ?>
</head>

<div class="fullscreen-bg">
    <video width="100%" height="100%" muted loop autoplay class="fullscreen-bg__video">
        <source src="/images/IMG_3395.mov" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
    </video>
</div>

<header class="header2">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2" id="topbar">
            <div class="topbar-social">
                <a target="_blank" href="https://www.facebook.com/c.n.21online/"
                   class="topbar-social-item fa fa-facebook"></a>
                <a target="_blank" href="https://www.instagram.com/c.n.21/"
                   class="topbar-social-item fa fa-instagram"></a>
                <a target="_blank" href="https://www.youtube.com/channel/UCCMHEWu2aNpFTSjmZGGDcIg"
                   class="topbar-social-item fa fa-youtube-play"></a>
                <a target="_blank" href="https://soundcloud.com/c-n-21online"
                   class="topbar-social-item fa fa-soundcloud"></a>
            </div>

            <a href="/" class="logo2" id="logo">
                <img src="/images/icons/C.N.21white.svg" alt="IMG-LOGO">
            </a>

            <div class="topbar-child2">

                <?php
                if ($_SESSION['auth'] == 'yes_auth') {
                    echo '
                            <a href="#" class="topbar-email">' . $_SESSION['auth_login'] . '</a>
                            <li>
                                <a class="customer" href="/customer_care">Customer care</a>
                            </li>
                            <div class="w-size11">
                                <!-- Button -->
                                <button  class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4 logout">
                                    Logout
                                </button>
                            </div>
                  ';
                } else {
                    echo '<a href="/registration" class="topbar-email">Sign in</a>
                            <li>
                                <a class="customer" href="/customer_care">Customer care</a>
                            </li>';
                }
                ?>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-13">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown"
                         alt="ICON">
                    <span class="header-icons-noti">0</span>
                </div>
            </div>
        </div>
</header>

<div class="wrap_menu">
    <nav class="menu">
        <ul class="main_menu">
            <li>
                <a href="/">Home</a>
            </li>

            <li>
                <a href="/shop">Shop</a>
            </li>
            <!--            <li class="sale-noti">-->
            <!--                <a href="/sale">Sale</a>-->
            <!--            </li>-->

            <!--            <li>-->
            <!--                <a href="/cart">Cart</a>-->
            <!--            </li>-->

            <li>
                <a href="/about_us">About</a>
            </li>

            <li>
                <a href="/contact_us">Contact</a>
            </li>
        </ul>
    </nav>
</div>

<div class="wrap_header_mobile">
    <!-- Logo moblie -->
    <a href="/" class="logo-mobile">
        <img src="/images/icons/C.N.21.svg" alt="IMG-LOGO">
    </a>

    <!-- Button show menu -->
    <div class="btn-show-menu">
        <!-- Header Icon mobile -->
        <div class="header-icons-mobile">

            <?php
            if ($_SESSION['auth'] == 'yes_auth') {
                echo '
                            <a href="#" class="topbar-email">' . $_SESSION['auth_login'] . '</a>
                            <div class="w-size11">
                                <!-- Button -->
                                <button  class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4 logout">
                                    Logout
                                </button>
                            </div>
                  ';
            } else {
                echo '<a href="/registration" class="topbar-email">Sign in</a>';
            }
            ?>

            <span class="linedivide2"></span>

            <div class="header-wrapicon2">
                <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                <span class="header-icons-noti">0</span>
            </div>
        </div>
    </div>
</div>

<?php include "include/block-js.php"; ?>

</html>
