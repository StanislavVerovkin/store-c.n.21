<?php

$link = mysqli_connect(
    "phples00.mysql.tools",
    "phples00_db",
    "7Wuczspf",
    "phples00_db");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
