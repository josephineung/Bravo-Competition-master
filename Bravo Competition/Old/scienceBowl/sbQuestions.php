<?php
    //ob_start();
    require_once "../scripts/app_config.php";
    require_once "../scripts/database_connection.php";
   
    $catArray = array('biology', 'chemistry','energy');
    $diffArray = array('Easy', 'Medium', 'easy');
    
    //$catArray = $_POST['category'];
    //$diffArray = $_POST['difficulty'];

    $pairArray = array();
    for($i = 0; $i < count($catArray); $i++){
        $pairArray[] = 'category = '. '"' . $catArray[$i] . '"' . ' AND ' . 
                        'difficulty = ' . '"' . $diffArray[$i] . '"';
    }
    
    $retrieveQueury = 'SELECT * FROM questionSB WHERE ( ' . 
                      implode( ') OR ( ', $pairArray) . ' ) ' . 'LIMIT 100';
    $result = mysqli_query($link, $retrieveQueury) or 
                handle_error("We could not retrieve the queury you requested. Please try another request.", mysqli_error());	
    
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $replace = array($row['category'], $row['questionType'], $row['difficulty'], $row['sources'], $row['question'], $row['answerW'], $row['answerX'], $row['answerY'], $row['answerZ'], $row['correctAns'], $row['questionID']); 
        echo vsprintf("%s<QUESTION_ITEM>%s<QUESTION_ITEM>%s<QUESTION_ITEM>%s<QUESTION_ITEM>%s<QUESTION_ITEM>%s<ANSWER>%s<ANSWER>%s<ANSWER>%s<QUESTION_ITEM>%u<QUESTION_ITEM>%u<QUESTION>", $replace);
    }

    // $page = ob_get_contents();
     //ob_end_clean();
     //$page = preg_replace("/(<QUESTION>)$/i", "", $page);
     //echo preg_replace("/\s+/", " ", $page);
?>
<script>
     window.location.replace("singlePlayer.php");
</script>

