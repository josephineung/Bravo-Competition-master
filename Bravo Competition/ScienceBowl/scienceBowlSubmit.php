<?php
    require_once "../scripts/app_config.php";
    require_once "../scripts/database_connection.php";

    $valid = TRUE;
    $url_regex = "/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/";


    $questionType = $question = $answerW = $answerX = $answerY
    = $answerZ = $correctAns = $difficulty = $sources = "";

    $typeErr = $questionErr = $wErr = $xErr = $yErr = $zErr 
    = $ansErr = $difficultyErr = $sourcesErr = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $questionType = testInput($_POST['questionType']);
        $question = testInput($_POST['question']);
        $answerW = testInput($_POST['answerW']);
        $answerX = testInput($_POST['answerX']);
        $answerY = testInput($_POST['answerY']);
        $answerZ = testInput($_POST['answerZ']);
        $correctAns = testInput($_POST['correctAns']);
        $difficulty = testInput($_POST['difficulty']);
        $sources = testInput($_POST['sources']);

        if (empty($questionType)){
            $typeErr = "Please select a question type.";
            $valid = FALSE;
        }

        if (empty($question)){
            $questionErr = "Please write a question.";
            $valid =FALSE;
        }
        if (empty($answerW) || empty($answerX) || empty($answerY) || empty($answerZ)){
            $wErr = "Please fill in an answer for <b>every</b> choice(i.e w, x, y, z)";
            $valid = FALSE;
        }
        if (empty($difficulty)){
            $difficultyErr = "Please enter a difficulty associated with the question";
            $valid = FALSE;
        }
        elseif ($difficulty < 1 || $difficulty > 20){
            $difficultyErr = "Please enter a difficulty that is between 1 and 20";
            $valid = FALSE;
        }

        if (empty($sources)){
            $sourcesErr = "Please enter at least one link into the sources form.";
            $valid = FALSE;
        }
        elseif (!preg_match($url_regex, $sources)){
            $sourcesErr = "The url listed is not valid";
            $valid = FALSE;
        }

        if ($valid){
            $insert_sql = "INSERT INTO questionSB 
            (questionType, question, answerW, answerX, answerY, answerZ,
            correctAns, difficulty, sources) 
            VALUES 
            ('{$questionType}', '{$question}', '{$answerW}', '{$answerX}', '{$answerY}', '{$answerZ}',
            '{$correctAns}', '{$difficulty}', '{$sources}')";
        
            mysql_query($insert_sql)
                or handle_error("There was a problem with inserting the values into our servers databases. "
                , mysql_error());  
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Submit a Question!</title>
        <link rel="stylesheet" type="text/css" href="../default.css">
        <link rel="stylesheet" type="text/css" href="scienceBowl.css">
    </head>
    <body>
        <?php include "../_Layout.php";?>
        <div id="content">
        <div id="form">
        <form method="post" class="questionForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
               <ul>
                   <li><h1>Submit an Science Bowl Question</h1></li>
                   <li><span class="requiredNotification">*Input is required in every field</span></li>
                   <li><label>Is this a bonus or a toss-up?</label>
                       <input id="smallForm" type=radio name="questionType" value="tossUp" required>Toss Up</input>
                       <input id="smallForm" type=radio name="questionType" value="Bonus" required>Bonus</input>
                   </li>
                   <li><label>Enter your question here:</label>
                      <textarea name="question" rows=10 cols=50 required placeholder="Enter your question here"></textarea></li>
                   <li><label>Enter the answer for W:</label>
                       <textarea name="answerW" rows=5 cols=50 required></textarea></li>
                   <li><label>Enter the answer for X:</label>
                       <textarea name="answerX" rows=5 cols=50 required></textarea></li>
                   <li><label>Enter the answer for Y:</label>
                       <textarea name="answerY" rows=5 cols=50 required></textarea></li>
                   <li><label>Enter the answer for Z:</label>
                       <textarea name="answerZ" rows=5 cols=50 required></textarea></li>
                   <li><label>Select the correct answer:</label><span class="error"><?php echo $ansErr;?></span>
                       <input id="smallForm" type = radio name="correctAns" value="W" required>W</input>
                       <input id="smallForm" type = radio name="correctAns" value="X" required>X</input>
                       <input id="smallForm" type=radio name="correctAns" value="Y" required>Y</input>
                       <input id="smallForm" type=radio name="correctAns" value="Z" required>Z</input>
                   </li>
                   <li><label>How hard is the question?</label>
                       <input type="number" name="difficulty" placeholder="Enter Round Number: 1-20" required/>
                   </li>
                   <li><label>Cite one or more sources to help your peers learn more about the subject!</label>
                       <textarea name="sources" rows="10" cols="50" required placeholder ="Seperate your sources like this: www.example.com, http://www.example1.com, example3.com"></textarea>
                   </li>
                   <li><button class="submit" type="submit">Submit</button></li>
               </ul>
           </fieldset>
        </form>
        </div>
        </div>
    </body>
</html>
