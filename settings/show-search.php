<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "db_connect.php";

    $search = strtolower($_POST['text']);

    $result = $link->query("SELECT * FROM table_products WHERE title LIKE '%$search%'");

    if (mysqli_num_rows($result) > 0) {
        $result = $link->query("SELECT * FROM table_products WHERE title LIKE '%$search%' LIMIT 10");

        $row = mysqli_fetch_array($result);

        do {

            echo '<li><a style="font-size: 14px" href="search.php?q=' . $row["title"] . '">' . $row["title"] . '</a></li>';

        } while ($row = mysqli_fetch_array($result));
    }
}
