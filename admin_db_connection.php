<?php
    $servername = "edr.topfavlists.com";
    $username = "admin_usr";
    $password = "6Lb4Prraot";
    $dbname = "admin_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>