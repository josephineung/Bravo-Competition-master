<?php
    require_once "../scripts/app_config.php";
    require_once "../scripts/database_connection.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $questionType = testInput($link, $_POST['questionType']);
        $category = testInput($link, $_POST['category']);
        $question = testInput($link, $_POST['question']);
        $answerW = testInput($link, $_POST['answerW']);
        $answerX = testInput($link, $_POST['answerX']);
        $answerY = testInput($link, $_POST['answerY']);
        $answerZ = testInput($link, $_POST['answerZ']);
        $correctAns = testInput($link, $_POST['correctAns']);
        $difficulty = testInput($link, $_POST['difficulty']);
        $sources = testInput($link, $_POST['sources']);

        $insert_sql = "INSERT INTO questionOB 
        (questionType, category, question, answerW, answerX, answerY, answerZ,
        correctAns, difficulty, sources) 
            VALUES 
        ('{$questionType}', '{$category}', '{$question}', '{$answerW}', '{$answerX}', '{$answerY}', '{$answerZ}',
         '{$correctAns}', '{$difficulty}', '{$sources}')";
        
        mysqli_query($link, $insert_sql)
            or handle_error("There was a problem with inserting the values into our servers databases. "
            , mysqli_error($link));  
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Submit a Question!</title>
        <link rel="stylesheet" type="text/css" href="../default.css">
        <link rel="stylesheet" type="text/css" href="oceanBowl.css">
    </head>
    <body>
        <?php include "../_Layout.php";?>
        <div id="content">
        <div id="form">
        <form method="post" class="questionForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
               <ul>
                   <li><h1>Submit an Ocean Bowl Question</h1></li>
                   <li><span class="requiredNotification">*Input is required in every field</span></li>
                   <li><label>Is this a bonus or a toss-up?</label>
                       <input id="smallForm" type=radio name="questionType" value="tossUp" required>Toss Up</input>
                       <input id="smallForm" type=radio name="questionType" value="Bonus" required>Bonus</input>
                   </li>
                   <li><label>What category is it in?</label>
                       <select name="category" required>
                           <option value="biology">Biology</option>
                           <option value="chemistry">Chemistry</option>
                           <option value="geography">Geography</option>
                           <option value="geology">Geology</option>
                           <option value="policy">Marine Policy</option>
                           <option value="oceanography">Physical Oceanography</option>
                           <option value="socialScience">Social Sciences</option>
                           <option value="technology">Technology</option>
                       </select>
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
                       <input id="smallForm" type = radio name="correctAns" value="0" required>W</input>
                       <input id="smallForm" type = radio name="correctAns" value="1" required>X</input>
                       <input id="smallForm" type=radio name="correctAns" value="2" required>Y</input>
                       <input id="smallForm" type=radio name="correctAns" value="3" required>Z</input>
                   </li>
                   <li><label>How hard is the question?</label>
                       <input type="number" name="difficulty" placeholder="Enter Round Number: 1-20" required pattern="^(0?[1-9]|[1][0-9]|20)$" />
                   </li>
                   <li><label>Cite one or more sources to help your peers learn more about the subject!</label>
                       <textarea name="sources" rows="10" cols="50" required placeholder ="One source per line!!!"></textarea> 
                   </li>
                   <li><button class="submit" type="submit">Submit</button></li>
               </ul>
        </form>
        </div>
        </div>
    </body>
</html>
