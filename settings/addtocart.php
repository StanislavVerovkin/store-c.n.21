<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("db_connect.php");

    $id = strtolower($_POST['id']);
    $size = $_POST['size'];

//    $result = $link->query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_product = '$id'");
    $result1 = $link->query("SELECT * FROM table_products WHERE products_id = '$id'");


    if (mysqli_num_rows($result) > 0) {
//        $row = mysqli_fetch_array($result);
        $row1 = mysqli_fetch_array($result1);

//        $new_count = $row["cart_count"] + 1;
//        $update = $link->query("UPDATE cart SET cart_count='$new_count' WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_product ='$id'");

        $link->query("INSERT INTO cart(cart_id_product,cart_price,cart_datetime,cart_ip,cart_size)
						VALUES(	
                            '" . $row1['products_id'] . "',
                            '" . $row1['price'] . "',				
							NOW(),
                            '" . $_SERVER['REMOTE_ADDR'] . "',                                                                        
                            '" . $size . "'                                                                        
						    )");

    } else {

        $result = $link->query("SELECT * FROM table_products WHERE products_id = '$id'");
        $row = mysqli_fetch_array($result);

        if ($row['sale_price'] == 0) {
            $link->query("INSERT INTO cart(cart_id_product,cart_price,cart_datetime,cart_ip,cart_size)
						VALUES(	
                            '" . $row['products_id'] . "',
                            '" . $row['price'] . "',				
							NOW(),
                            '" . $_SERVER['REMOTE_ADDR'] . "',                                                                        
                            '" . $size . "'                                                                        
						    )");
        } else {
            $link->query("INSERT INTO cart(cart_id_product,cart_price,cart_datetime,cart_ip,cart_size)
						VALUES(	
                            '" . $row['products_id'] . "',
                            '" . $row['sale_price'] . "',					
							NOW(),
                            '" . $_SERVER['REMOTE_ADDR'] . "',                                                                       
                            '" . $size . "'                                                                       
						    )");
        }
    }
}