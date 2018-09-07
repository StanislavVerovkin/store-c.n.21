<?php
include "settings/db_connect.php";
session_start();
include "./reg/auth_cookie.php";

$id = $_GET['id'];

if ($id != $_SESSION['count_id']) {

    $queryCount = $link->query("SELECT count FROM table_products WHERE products_id='$id'");
    $resultCount = mysqli_fetch_array($queryCount);

    $newCount = $resultCount["count"] + 1;

    $update = $link->query("UPDATE table_products SET count='$newCount' WHERE products_id='$id'");

}

$_SESSION['count_id'] = $id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>C.N.21 | Product Detail</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include "include/block-css.php"; ?>

</head>
<body class="animsition">

<?php include "include/block-header.php"; ?>

<?php

$result = $link->query("SELECT * FROM table_products WHERE products_id = '$id'");

$resultGallery = $link->query("SELECT * FROM uploads_images WHERE products_id = '$id'");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    echo '
        <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
            <a href="/" class="s-text16">
                Home
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <a href="#" class="s-text16">
                ' . $row['category'] . '
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <a href="/view_categories?cat=' . $row['category'] . '&family=' . $row['family'] . '" class="s-text16">
                ' . $row['family'] . '
                <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
            </a>
            <span class="s-text17">
                ' . $row['title'] . '
                </span>
        </div>';


    echo '
        <div id="block-grey">
        <div class="container bgwhite p-t-35 p-b-80" id="container-white">
            <div class="flex-w flex-sb">
                <div class="w-size13 p-t-30 respon5">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                                    <div class="slick3">';

    if (mysqli_num_rows($resultGallery) > 0) {
        $row1 = mysqli_fetch_array($resultGallery);
        do {
            echo
                '
                            <div class="item-slick3" data-thumb="/uploads_images/' . $row1['image'] . '">
                                <div class="wrap-pic-w">
                                    <img class="picture" src="/uploads_images/' . $row1['image'] . '" alt="IMG-PRODUCT">
                                </div>
                            </div>
            ';
        } while ($row1 = mysqli_fetch_assoc($resultGallery));
    }


    echo ' 
                </div>
                </div>
                </div>
                <div class="w-size14 p-t-30 respon5">
                    <h4 class="product-detail-name m-text16 p-b-13">
                        ' . $row['title'] . '
                    </h4>';


    if ($row['label'] == 'labelsale') {
        echo '<span class="m-text17">
					$' . $row['sale_price'] . '
				    </span>';
    } else {
        echo '<span class="m-text17">
					$' . $row['price'] . '
				    </span>';
    }




    echo '
                    <p class="s-text8 p-t-10">
                        ' . $row['short_description'] . '
                    </p>
                   
        
                    <!--  -->
                    <div class="p-t-33 p-b-60">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Size
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2 size" name="size">
								<option>S</option>
								<option>M</option>
								<option>L</option>
							</select>
						</div>
					</div>

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10" product_id="' . $row['products_id'] . '">
								<!-- Button -->
								<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 add-detail">
									Add to Cart
								</button>
							</div>
						</div>
					</div>
					
						<!-- Container Selection -->
                    <div id="dropDownSelect1"></div>
                    <div id="dropDownSelect2"></div>

					
				</div>
                    
                    <!--  -->
                    <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                            Description
                            <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                            <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                        </h5>
        
                        <div class="dropdown-content dis-none p-t-15 p-b-23">
                            <p class="s-text8">
                                ' . $row['description'] . '
                            </p>
                        </div>
                    </div>
                    <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                        <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                            Reviews (' . $row['count'] . ')
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        </div>';

}
?>


<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<?php include "include/block-js.php"; ?>

<script type="text/javascript">
    $('.btn-addcart-product-detail').each(function () {
        let nameProduct = $('.product-detail-name').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to cart!", "success");
        });
    });
</script>

<script>

    $('.btn-addcart-product-detail').click(function () {

        let product_id = $(this).attr("product_id");
        let size = $(this).parent().parent().parent().find('span.select2-selection__rendered').attr("title");
        console.log(size);
        console.log(product_id);

        $.ajax({
            type: "POST",
            url: '/settings/addtocart.php',
            data: "id=" + product_id + "&size=" + size,
            dataType: "html",
            cache: false,
            success: function () {
                loadCart();
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.picture')
            .css('display', 'block')
            .parent()
            .zoom();
    });
</script>

<?php include "include/block-footer.php" ?>

</body>
</html>
