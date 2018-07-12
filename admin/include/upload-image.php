<?php
$error_img = array();

if ($_FILES['upload_image']['error'] > 0) {
    switch ($_FILES['upload_image']['error']) {
        case 1:
            $error_img[] = 'Размер превышает значение UPLOAD_MAX_FILE_SIZE';
            break;
        case 2:
            $error_img[] = 'Размер превышает значение MAX_FILE_SIZE';
            break;
        case 3:
            $error_img[] = 'Не удалось загрузить часть файла';
            break;
        case 4:
            $error_img[] = 'Файл не был загружен';
            break;
        case 6:
            $error_img[] = 'Отсутствует временная папка';
            break;
        case 7:
            $error_img[] = 'Не удалось записать файл на диск';
            break;
        case 8:
            $error_img[] = 'Ошибка.';
            break;
    }

} else {
    if ($_FILES['upload_image']['type'] == 'image/jpeg' || $_FILES['upload_image']['type'] == 'image/jpg' || $_FILES['upload_image']['type'] == 'image/png') {

        $imgext = preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['upload_image']['name']);

        $uploaddir = '../uploads_images/';
        $newfilename = $_POST["form_type"] . '-' . rand(10, 100) . '.' . $imgext;
        $uploadfile = $uploaddir . $newfilename;

        if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile)) {

            $link->query("UPDATE table_products SET image='$newfilename' WHERE products_id = '$id'");
        } else {
            $error_img[] = "Error.";
        }

    } else {
        $error_img[] = 'jpeg, jpg, png';
    }
}