<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {
    define('myeshop', true);

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Main page</a> \ <a href='product.php' >Products</a>";

    include("include/db_connect.php");

    $action = $_GET["action"];
    if (isset($action)) {
        $id = (int)$_GET["id"];
        switch ($action) {

            case 'delete':

                $delete = $link->query("DELETE FROM table_products WHERE products_id = '$id'");

                break;
        }
    }

    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
        <link href="css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="/admin/js/script.js"></script>
        <script type="text/javascript" src="/admin/js/jquery_confirm.js"></script>

        <title>Панель управления</title>
    </head>
    <body>
    <div id="block-body">
        <?php
        include('include/block-header.php');
        $all_count = $link->query("SELECT * FROM table_products");
        $all_count_result = mysqli_num_rows($all_count);
        ?>
        <div id="block-content">
            <div id="block-parameters">
                <p id="title-page">General statistic</p>
            </div>
            <div id="block-info">
                <p id="count-style">Total - <strong><?php echo $all_count_result; ?></strong></p>
                <p align="right" id="add-style" ><a href="add_product.php" >Add product</a></p>
            </div>
            <ul id="block-tovar">
                <?php

                $num = 8;

                $page = (int)$_GET['page'];

                $count = $link->query("SELECT COUNT(*) FROM table_products $cat");
                $temp = mysqli_fetch_array($count);
                $post = $temp[0];
                $total = (($post - 1) / $num) + 1;
                $total = intval($total);
                $page = intval($page);
                if (empty($page) or $page < 0) $page = 1;
                if ($page > $total) $page = $total;
                $start = $page * $num - $num;

                if ($temp[0] > 0) {
                    $result = $link->query("SELECT * FROM table_products $cat ORDER BY products_id DESC LIMIT $start, $num");

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        do {
                            if (strlen($row["image"]) > 0 && file_exists("../uploads_images/" . $row["image"])) {
                                $img_path = '../uploads_images/' . $row["image"];
                                $max_width = 160;
                                $max_height = 160;
                                list($width, $height) = getimagesize($img_path);
                                $ratioh = $max_height / $height;
                                $ratiow = $max_width / $width;
                                $ratio = min($ratioh, $ratiow);
                                $width = intval($ratio * $width);
                                $height = intval($ratio * $height);
                            } else {
                                $img_path = "./images/no-image-90.png";
                                $width = 90;
                                $height = 164;
                            }

                            echo '
                                 <li>
                                
                                 <p>' . $row["title"] . '</p>
                                <center>
                                 <img src="' . $img_path . '" width="' . $width . '" height="' . $height . '" />
                                </center>
                                <p align="center" class="link-action" >
                                <a class="green" href="edit_product.php?id=' . $row["products_id"] . '">Edit</a> | <a rel="product.php?' . $url . 'id=' . $row["products_id"] . '&action=delete" class="delete" >Delete</a>
                                </p>
                                 </li> 
                                 ';

                        } while ($row = mysqli_fetch_array($result));
                        echo '
                                </ul>
                                    ';
                    }
                }

                if ($page != 1) $pervpage = '<li><a class="pstr-prev" href="product.php?' . $url . 'page=' . ($page - 1) . '" />Prev</a></li>';

                if ($page != $total) $nextpage = '<li><a class="pstr-next" href="product.php?' . $url . 'page=' . ($page + 1) . '"/>Next</a></li>';

                if ($page - 5 > 0) $page5left = '<li><a href="product.php?' . $url . 'page=' . ($page - 5) . '">' . ($page - 5) . '</a></li>';
                if ($page - 4 > 0) $page4left = '<li><a href="product.php?' . $url . 'page=' . ($page - 4) . '">' . ($page - 4) . '</a></li>';
                if ($page - 3 > 0) $page3left = '<li><a href="product.php?' . $url . 'page=' . ($page - 3) . '">' . ($page - 3) . '</a></li>';
                if ($page - 2 > 0) $page2left = '<li><a href="product.php?' . $url . 'page=' . ($page - 2) . '">' . ($page - 2) . '</a></li>';
                if ($page - 1 > 0) $page1left = '<li><a href="product.php?' . $url . 'page=' . ($page - 1) . '">' . ($page - 1) . '</a></li>';

                if ($page + 5 <= $total) $page5right = '<li><a href="product.php?' . $url . 'page=' . ($page + 5) . '">' . ($page + 5) . '</a></li>';
                if ($page + 4 <= $total) $page4right = '<li><a href="product.php?' . $url . 'page=' . ($page + 4) . '">' . ($page + 4) . '</a></li>';
                if ($page + 3 <= $total) $page3right = '<li><a href="product.php?' . $url . 'page=' . ($page + 3) . '">' . ($page + 3) . '</a></li>';
                if ($page + 2 <= $total) $page2right = '<li><a href="product.php?' . $url . 'page=' . ($page + 2) . '">' . ($page + 2) . '</a></li>';
                if ($page + 1 <= $total) $page1right = '<li><a href="product.php?' . $url . 'page=' . ($page + 1) . '">' . ($page + 1) . '</a></li>';

                if ($page + 5 < $total) {
                    $strtotal = '<li><p class="nav-point">...</p></li><li><a href="product.php?' . $url . 'page=' . $total . '">' . $total . '</a></li>';
                } else {
                    $strtotal = "";
                }

                ?>

                <div id="footerfix"></div>
                <?php
                if ($total > 1) {
                    echo '
                        <center>
                        <div class="pstrnav">
                        <ul>   
                        ';
                    echo $pervpage . $page5left . $page4left . $page3left . $page2left . $page1left . "<li><a class='pstr-active' href='product.php?" . $url . "page=" . $page . "'>" . $page . "</a></li>" . $page1right . $page2right . $page3right . $page4right . $page5right . $strtotal . $nextpage;
                    echo '
                        </center>   
                        </ul>
                        </div>
                        ';
                }
                ?>

        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    header("Location: login.php");
}
?>
