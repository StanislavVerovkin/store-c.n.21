<?php
include "settings/db_connect.php";
session_start();
include "./reg/auth_cookie.php";


$search = $_GET['q'];


$sorting = $_GET['sort'];

switch ($sorting) {
    case 'price-asc';
        $sorting = 'price ASC';
        $sort_name = 'Price: low to high';
        break;

    case 'price-desc';
        $sorting = 'price DESC';
        $sort_name = 'Price: high to low';
        break;

    case 'popular';
        $sorting = 'count DESC';
        $sort_name = 'Popularity';
        break;

    default:
        $sorting = 'products_id DESC';
        $sort_name = 'Default sorting';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search - <?php echo $search ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "include/block-css.php"; ?>

</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->
                    <h4 class="m-text14 p-b-7">
                        Categories
                    </h4>

                    <ul class="p-b-54">
                        <li class="p-t-4">
                            <a href="/shop" class="s-text13">
                                All
                            </a>
                        </li>

                        <li class="p-t-4">
                            <a href="/view_categories?cat=women" class="s-text13">
                                Women
                            </a>
                        </li>

                        <li class="p-t-4">
                            <a href="/view_categories?cat=men" class="s-text13">
                                Men
                            </a>
                        </li>
                        <li class="p-t-4">
                            <a href="/view_categories?cat=accessories" class="s-text13">
                                Accessories
                            </a>
                        </li>
<!--                        <li class="sale-noti">-->
<!--                            <a href="/sale" class="s-text13">-->
<!--                                Sale-->
<!--                            </a>-->
<!--                        </li>-->
                        <li class="p-t-4">
                            <a href="/view_categories?cat=pre-order" class="s-text13">
                                Pre-order
                            </a>
                        </li>
                    </ul>

                    <div id="block-search" class="search-product pos-relative bo4 of-hidden">
                        <form method="get" action="search?q=">
                            <input class="s-text7 size6 p-l-23 p-r-50" type="text" id="input-search" name="q"
                                   placeholder="Search Products...">

                            <button type="submit" id="button-search"
                                    class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                        <ul class="search-product pos-relative bo4 of-hidden" id="result-search"></ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">

                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $sort_name ?>
                            </button>
                            <div class="dropdown-menu sort" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/search?q=<?php echo $search ?>&sort=price-asc">Price:
                                    low to high</a>
                                <a class="dropdown-item" href="/search?q=<?php echo $search ?>&sort=price-desc">Price:
                                    high to low</a>
                                <a class="dropdown-item" href="/search?q=<?php echo $search ?>&sort=popular">Popularity</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <?php
                    $num = 9;
                    $page = (int)$_GET['page'];

                    $count = $link->query("SELECT COUNT(*) FROM table_products WHERE title LIKE '%$search%' AND sale_price = 0");
                    $temp = mysqli_fetch_array($count);

                    if ($temp[0] > 0) {
                        $tempcount = $temp[0];

                        $total = (($tempcount - 1) / $num) + 1;
                        $total = intval($total);

                        $page = intval($page);

                        if (empty($page) or $page < 0) $page = 1;
                        if ($page > $total) $page = $total;

                        $start = $page * $num - $num;
                    }

                    if ($temp[0] > 0) {

                        $result = $link->query("SELECT * FROM table_products WHERE title LIKE '%$search%' AND sale_price = 0 ORDER BY $sorting LIMIT $start, $num");

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);

                            do {
                                echo '<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-' . $row['label'] . '">
                                <img src="/uploads_images/' . $row['image'] . '"
                                     alt="IMG-PRODUCT">
                              
                            </div>
                            <div class="block2-txt p-t-20">
                                <a href="/product_detail?id=' . $row['products_id'] . '" class="block2-name dis-block s-text3 p-b-5">
                                    ' . $row['title'] . '
                                </a>';

                                if ($row['label'] == 'labelsale'){
                                    echo '
                                    <span class="block2-oldprice m-text7 p-r-5">
                                        $' . $row['price'] . '
									</span>
									<span class="block2-newprice m-text8 p-r-5">
                                        $' . $row['sale_price'] . '
									</span>
									';
                                } else {
                                    echo
                                        '
                                <span class="block2-price m-text6 p-r-5">
                                        $' . $row['price'] . '
									</span>
                                ';
                                }
                                echo '
                            </div>
                        </div>
                    </div>';
                            } while ($row = mysqli_fetch_assoc($result));
                        }
                    } else {
                        echo 'There are no products in your query';
                    }
                    ?>
                </div>

                <?php include 'settings/show-pagination.php' ?>

            </div>
        </div>
    </div>
</section>

<?php include "include/block-footer.php" ?>
<?php include "include/block-js.php"; ?>

</body>
</html>
