<?php

if ($_FILES['upload_image_second']) {

    $imgext = preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image_second']['name']);

    $uploaddir = '../uploads_images/';
    $newfilename = $_POST["form_type"] . '-' . rand(10, 100) . '.' . $imgext;
    $uploadfile = $uploaddir . $newfilename;

    if (move_uploaded_file($_FILES['upload_image_second']['tmp_name'], $uploadfile)) {

        $link->query("UPDATE table_products SET second_image='$newfilename' WHERE products_id = '$id'");

    }
}