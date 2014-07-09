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

    function testInput($link, $data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = mysqli_real_escape_string($link, $data);
            return $data;
        }

    function convertRound($diff) {
        if ($diff <= 6) {
            return "Easy";
        }
        else if ($diff <= 10) {
            return 'Medium';
        }
        else if ($diff <= 16) {
            return 'Hard';
        }
        else {
            return 'Insane';
        }
    }

?>
