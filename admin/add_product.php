<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth") {

    if (isset($_GET["logout"])) {
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }

    $_SESSION['urlpage'] = "<a href='index.php' >Main page</a> \ <a href='product.php' >Products</a> \ <a>Add product</a>";

    include("include/db_connect.php");

    if ($_POST["submit_add"]) {

        $_POST["form_title"];
        $_POST["form_price"];
        $_POST["sale_price"];

        if ($_POST["sale"]) {
            $chk_sale = "labelsale";
        }

        if ($_POST["new"]) {
            $chk_sale = 'labelnew';
        }

        $link->query("INSERT INTO table_products(title,price,category,short_description,description,label,datetime,sale_price)
            VALUES(						
                '" . $_POST["form_title"] . "',
                '" . $_POST["form_price"] . "',
                '" . $_POST["form_type"] . "',
                '" . $_POST["txt1"] . "',
                '" . $_POST["txt2"] . "',
                '" . $chk_sale . "',
                NOW(),
                '" . $_POST["sale_price"] . "'
            )");

        $id = mysqli_insert_id($link);

        if (empty($_POST["upload_image"])) {
            include("include/upload-image.php");
            unset($_POST["upload_image"]);
        }

        if (empty($_POST["galleryimg"])) {
            include("include/upload-gallery.php");
            unset($_POST["galleryimg"]);
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
        <link href="./jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css"/>
        <link href="./jquery_confirm/jquery_confirm.js" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="./js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="/admin/js/script.js"></script>
        <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>


        <title>Панель управления</title>
    </head>
    <body>
    <div id="block-body">
        <?php
        include('include/block-header.php');
        ?>
        <div id="block-content">
            <div id="block-parameters">
                <p id="title-page">Add product</p>
            </div>

            <form enctype="multipart/form-data" method="post">
                <ul id="edit-tovar">
                    <li>
                        <label>Title</label>
                        <input type="text" name="form_title"/>
                    </li>
                    <li>
                        <label>Price</label>
                        <input type="text" name="form_price"/>
                    </li>
                    <li>
                        <label>Sale price</label>
                        <input type="text" name="sale_price"/>
                    </li>
                    <li>
                        <label>Category</label>
                        <select name="form_type" id="type" size="1">
                            <option value="Women">Women</option>
                            <option value="Men">Men</option>
                            <option value="Accessories">Accessories</option>
                            <option value="Sale">Sale</option>
                            <option value="Pre-order">Pre-order</option>
                        </select>
                    </li>
                </ul>

                <label class="stylelabel">Image</label>
                <div id="baseimg-upload">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                    <input type="file" name="upload_image"/>
                </div>
                <h3 class="h3click">Short description</h3>
                <div class="div-editor1">
                    <textarea id="editor1" name="txt1" cols="100" rows="20"></textarea>
                    <script type="text/javascript">
                        var ckeditor1 = CKEDITOR.replace("editor1");
                        AjexFileManager.init({
                            returnTo: "ckeditor",
                            editor: ckeditor1
                        });
                    </script>
                </div>
                <h3 class="h3click">Description</h3>
                <div class="div-editor1">
                    <textarea id="editor2" name="txt2" cols="100" rows="20"></textarea>
                    <script type="text/javascript">
                        var ckeditor2 = CKEDITOR.replace("editor2");
                        AjexFileManager.init({
                            returnTo: "ckeditor",
                            editor: ckeditor2
                        });
                    </script>
                </div>
                <label class="stylelabel">Gallery images</label>
                <div id="objects">
                    <div id="addimage1" class="addimage">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                        <input type="file" name="galleryimg[]"/>
                    </div>
                </div>
                <p id="add-input">Add</p>
                <h3 class="h3title">Settings</h3>
                <ul id="chkbox">
                    <li><input type="checkbox" name="sale" id="sale"/><label for="sale">Sale label</label></li>
                    <li><input type="checkbox" name="new" id="new"/><label for="new">New label</label></li>
                </ul>

                <p align="right"><input type="submit" id="submit_form" name="submit_add" value="Add product"/></p>
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    header("Location: login.php");
}
?>
