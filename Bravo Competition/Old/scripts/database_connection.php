<?php
    require_once "app_config.php";

    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if (mysqli_connect_errno()) {
        handle_error("There was a problem connecting to the database that contains the necessary information. ", mysqli_connect_error());
        exit();
    }
?>