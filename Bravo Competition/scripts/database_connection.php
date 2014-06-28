<?php
    require_once "app_config.php";

    mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD)
        or handle_error("There was a problem connecting to the database that contains the necessary information. "
        , mysql_error());
    

    mysql_select_db(DB_NAME)
        or handle_error("There was a problem accessing the database after
        connecting to the database server. ", mysql_error());
?>