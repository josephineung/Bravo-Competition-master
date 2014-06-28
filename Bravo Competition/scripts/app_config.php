<?php
    define("DB_HOST", "mysql.briantom.dreamhosters.com", TRUE);
    define("DB_USERNAME", "btomtom5",TRUE);
    define("DB_PASSWORD", '$$goatGrenade$$',TRUE);
    define("DB_NAME", "bravocompete");
    define("HOST_WWW_ROOT", "/home/britom6/briantom.dreamhosters.com/");

    function handle_error($user_error_message, $system_error_message){
        header("Location: ../../../scripts/showError.php?" . 
                "error_message={$user_error_message}&" . 
                "system_error_message={$system_error_message}");
        exit();
    }

    define("DEBUG_MODE",TRUE);
    function debug_print($message){
        if(DEBUG_MODE){
            echo $message;
        }
    }
    function testInput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = mysql_real_escape_string($data);
            return $data;
        }
?>
