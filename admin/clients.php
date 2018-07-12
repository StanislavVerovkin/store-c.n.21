<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {
    define('myeshop', true);

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Main page</a> \ <a href='clients.php' >Clients</a>";

    include("include/db_connect.php");
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
        <link href="css/reset.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="./js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/admin/js/script.js"></script>
        <script type="text/javascript" src="/admin/js/jquery_confirm.js"></script>
        <title>Clients</title>
    </head>
    <body>
    <div id="block-body">
        <?php
        include("include/block-header.php");
        $all_client = $link->query("SELECT * FROM user");
        $result_count = mysqli_num_rows($all_client);
        ?>
        <div id="block-content">
            <div id="block-parameters">
                <p id="count-client">Clients - <strong><?php echo $result_count ?></strong></p>
            </div>

            <?php
            $num = 4;

            $page = strip_tags($_GET['page']);
            $page = mysqli_real_escape_string($page);

            $count = $link->query("SELECT COUNT(*) FROM user");
            $temp = mysqli_fetch_array($count);
            $post = $temp[0];
            $total = (($post - 1) / $num) + 1;
            $total = intval($total);
            $page = intval($page);

            if (empty($page) or $page < 0) $page = 1;
            if ($page > $total) $page = $total;
            $start = $page * $num - $num;

            if ($temp[0] > 0) {
                $result = $link->query("SELECT * FROM user ORDER BY id DESC LIMIT $start,$num");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    do {

                        echo '
                         <div class="block-clients">
                         
                         <p class="client-datetime" >' . $row["datetime"] . '</p>
                         <p class="client-email" ><strong>' . $row["email"] . '</strong></p>
                         
                         
                         <ul>
                         <li><strong>E-Mail</strong> - ' . $row["email"] . '</li>
                         <li><strong>Surname</strong> - ' . $row["surname"] . ' ' . $row["name"] . '</li>
                         <li><strong>Address</strong> - ' . $row["address"] . '</li>
                         <li><strong>Mobile</strong> - ' . $row["mobile"] . '</li>
                         <li><strong>IP</strong> - ' . $row["ip"] . '</li>
                         <li><strong>Datetime</strong> - ' . $row["datetime"] . '</li>
                         </ul>
                         
                         
                         
                         </div>
                         ';

                    } while ($row = mysqli_fetch_array($result));
                }
            }
            if ($page != 1) $pervpage = '<li><span><a href="clients.php?page=' . ($page - 1) . '" />Prev</a></span></li>';

            if ($page != $total) $nextpage = '<li><span><a href="clients.php?page=' . ($page + 1) . '"/>Next</a></span></li>';

            if ($page - 5 > 0) $page5left = '<li><a href="clients.php?page=' . ($page - 5) . '">' . ($page - 5) . '</a></li>';
            if ($page - 4 > 0) $page4left = '<li><a href="clients.php?page=' . ($page - 4) . '">' . ($page - 4) . '</a></li>';
            if ($page - 3 > 0) $page3left = '<li><a href="clients.php?page=' . ($page - 3) . '">' . ($page - 3) . '</a></li>';
            if ($page - 2 > 0) $page2left = '<li><a href="clients.php?page=' . ($page - 2) . '">' . ($page - 2) . '</a></li>';
            if ($page - 1 > 0) $page1left = '<li><a href="clients.php?page=' . ($page - 1) . '">' . ($page - 1) . '</a></li>';

            if ($page + 5 <= $total) $page5right = '<li><a href="clients.php?page=' . ($page + 5) . '">' . ($page + 5) . '</a></li>';
            if ($page + 4 <= $total) $page4right = '<li><a href="clients.php?page=' . ($page + 4) . '">' . ($page + 4) . '</a></li>';
            if ($page + 3 <= $total) $page3right = '<li><a href="clients.php?page=' . ($page + 3) . '">' . ($page + 3) . '</a></li>';
            if ($page + 2 <= $total) $page2right = '<li><a href="clients.php?page=' . ($page + 2) . '">' . ($page + 2) . '</a></li>';
            if ($page + 1 <= $total) $page1right = '<li><a href="clients.php?page=' . ($page + 1) . '">' . ($page + 1) . '</a></li>';

            if ($page + 5 < $total) {
                $strtotal = '<li> ... <a href="clients.php?page=' . $total . '">' . $total . '</a></li>';
            } else {
                $strtotal = "";
            }


            if ($total > 1) {
                echo '
                    <div id="block-pstrnav">
                    <ul id="pstrnav">
                    ' . $pervpage . $page5left . $page4left . $page3left . $page2left . $page1left . '<li><b>' . $page . '</b></li>' . $page1right . $page2right . $page3right . $page4right . $page5right . $strtotal . $nextpage . '
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
