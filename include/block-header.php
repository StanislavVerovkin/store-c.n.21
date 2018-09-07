<!-- Header -->
<header class="header2" style="background-color: black">
    <!-- Header desktop -->
    <div class="container-menu-header-v2 p-t-26">
        <div class="topbar2">
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

            <!-- Logo2 -->
            <a href="/" class="logo2">
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
                                <a class="customer" href="/customer_care">Customer care</a>
                            ';
                }
                ?>

                <span class="linedivide1"></span>

                <div class="header-wrapicon2 m-r-13">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">0</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="wrap_header" style="background-color: black; padding-bottom: 15px;">
    <!-- Menu -->
    <div class="wrap_menu">
        <nav class="menu">
            <ul class="main_menu">
                <li>
                    <a href="/">Home</a>
                </li>

                <li>
                    <a href="/shop">Shop</a>
                </li>

                <!--                <li class="sale-noti">-->
                <!--                    <a href="/sale">Sale</a>-->
                <!--                </li>-->

                <!--                <li>-->
                <!--                    <a href="/cart">Cart</a>-->
                <!--                </li>-->
                <li>
                    <a href="/about_us">About</a>
                </li>

                <li>
                    <a href="/contact_us">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</div>

<!-- Header Mobile -->
<div class="wrap_header_mobile" style="background-color: black">
    <!-- Logo moblie -->
    <a href="/" class="logo-mobile">
        <img src="/images/icons/C.N.21white.svg" alt="IMG-LOGO">
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

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
        </div>
    </div>
</div>

<!-- Menu Mobile -->
<div class="wrap-side-menu">
    <nav class="side-menu">
        <ul class="main-menu">
            <li class="item-topbar-mobile p-l-10">
                <div class="topbar-social-mobile">
                    <a id="social" target="_blank" href="https://www.facebook.com/c.n.21online/"
                       class="topbar-social-item fa fa-facebook"></a>
                    <a id="social" target="_blank" href="https://www.instagram.com/c.n.21/"
                       class="topbar-social-item fa fa-instagram"></a>
                    <a id="social" target="_blank" href="https://www.youtube.com/channel/UCCMHEWu2aNpFTSjmZGGDcIg"
                       class="topbar-social-item fa fa-youtube-play"></a>
                    <a id="social" target="_blank" href="https://soundcloud.com/c-n-21online"
                       class="topbar-social-item fa fa-soundcloud"></a>
                </div>
            </li>

            <li class="item-menu-mobile">
                <a href="/">Home</a>
            </li>

            <li class="item-menu-mobile">
                <a href="/shop">Shop</a>
            </li>

            <!--            <li class="item-menu-mobile">-->
            <!--                <a href="/sale">Sale</a>-->
            <!--            </li>-->

            <!--            <li class="item-menu-mobile">-->
            <!--                <a href="/cart">Cart</a>-->
            <!--            </li>-->

            <li class="item-menu-mobile">
                <a href="/about_us">About</a>
            </li>

            <li class="item-menu-mobile">
                <a href="/contact_us">Contact</a>
            </li>
            <li class="item-menu-mobile">
                <a href="/customer_care">Customer care</a>
            </li>
        </ul>
    </nav>
</div>

