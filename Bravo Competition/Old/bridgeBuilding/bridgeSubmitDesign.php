<?php ob_start();
      require_once "../scripts/app_config.php";
      require_once "../scripts/database_connection.php";

      $nameErr=$weightErr=$capacityErr=$yearErr=$blueprintErr=$reportErr="";
      $bridgeName=$weight=$capacity=$year=$blueprint=$report="";
      $php_errors = array(1 => "Max file size in php.ini exceeded",
                          2 => "Max file size in HTML form exceeded",
                          3 => "Only part of the file was uploaded",
                          4 => "No file was selected to upload.");

      if ($_SERVER["REQUEST_METHOD"] === "POST"){
          if (empty($_POST['bridgeName'])){
              $nameErr = "No name was entered into the field.";
              }
          elseif (preg_match("/[^'A-Z 0-9]+/i",$_POST['bridgeName'])){
              $nameErr = "Please only use alphanumerics.";
              }
          elseif (count($_POST['bridgeName']) > 20){
              $nameErr = "The name is too many characters long.";
              }
          else {
              $bridgeName = testInput($_POST['bridgeName']);
              }

          if (!empty($_POST['weight']) && $_POST['weight']<0){
              $weightErr = "Please enter a positive weight!";
              }
          else{
              $weight = testInput($_POST['weight']);
              }
            
          if (empty($_POST['capacity'])){
              $capacityErr = "The maximum capacity was not entered.";
              }
          elseif (!($_POST['capacity'] > 50 && $_POST['capacity'] < 3000)){
              $capacityErr = "We only accept weights from 50-3000 pounds.";
              }
          else {
              $capacity = testInput($_POST['capacity']);
              }
               
          if (!empty($_POST['year']) && !($_POST['year'] > 1980 && $_POST['year'] <= date("Y"))){
              $yearErr = "Please enter a year from 1980 until the present year.";
              }
          else{
              $year = testInput($_POST['year']);
              }

          if (strlen($_POST['comments'])>500){
              $commentsErr = "Please keep comments under 500 characters.";
              }
          else {
              $comments = testInput($_POST['comments']);
               }

          ($_FILES["blueprint"]['error'] == 0) 
              or $blueprintErr = $php_errors[$_FILES["blueprint"]['error']];

          ($_FILES["report"]['error'] == 0)
              or $reportErr = $php_errors[$_FILES["report"]['error']];

          if ($nameErr==$weightErr && $weightErr==$capacityErr &&
          $capacityErr==$yearErr && $yearErr==$blueprintErr &&
          $blueprintErr==$reportErr && $reportErr == ""){
                
            $uploadDirBP = HOST_WWW_ROOT . "uploads/bridgeBuilding/blueprints/";
            $uploadDirTR = HOST_WWW_ROOT . "uploads/bridgeBuilding/techReports/";
            $blueprint = "blueprint";
            $report = "report";

            @is_uploaded_file($_FILES[$blueprint]['tmp_name'])
                or handle_error("Your blueprint name cannot be accepted by our servers. Please rename your file. ",
                "Uploaded request: Blueprint named " . "{$_FILES[$blueprint]['tmp_name']}");

            @getimagesize($_FILES[$blueprint]['tmp_name'])
                or handle_error("The file you submitted is not an image!",
                "{$_FILES[$blueprint]['tmp_name']}". " is not a valid image file.");

            @is_uploaded_file($_FILES[$report]['tmp_name'])
                or handle_error("The technical report cannot be accepted by our servers. Please rename your file. ",
               "Uploaded request: Technical report named " . "{$_FILES[$report]['tmp_name']}" );

            $now = time();
            while (file_exists($uploadFilenameBP = $uploadDirBP . $now . "-" . 
                                                   $_FILES[$blueprint]['name'])
                                                   ||
                   file_exists($uploadFilenameTR = $uploadDirTR . $now . "-" .
                                                   $_FILES[$report]['name'])
                  )   
                  {
                  $now++;
                  }
                
            @move_uploaded_file($_FILES[$blueprint]['tmp_name'], $uploadFilenameBP)
              or handle_error("We could not move your image to it's final location",
              "Permissions to moving file {$_FILES[$blueprint]['tmp_name']}");
          
            @move_uploaded_file($_FILES[$report]['tmp_name'], $uploadFilenameTR)
              or handle_error("We could not move your technical report to it's final location on our server",
              "Permissions to moving file {$_FILES[$report]['tmp_name']}");
          
            $insert_sql = "INSERT INTO bridgeDesigns (bridgeName, bridgeWeight,
                        maxCapacity, constructYear, comments, blueprintPath, reportPath) VALUES  ('{$bridgeName}', '{$weight}',
                       '{$capacity}', '{$year}', '{$comments}', '{$uploadFilenameBP}', '{$uploadFilenameTR}')";

            mysql_query($insert_sql)
                or handle_error("There was a problem with inserting the values into our servers databases. "
                , mysql_error());     
                
            header("Location: submitDesign.php");
            exit();
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Bridge Building</title>
        <link rel="stylesheet" type="text/css" href="../default.css">
        <link rel="stylesheet" type="text/css" href="bridgeBuilding.css">
    </head>
    <body>    
    <?php include "../_Layout.php";?>  
        <div id="content">
        <div id="form">
        <form class="questionForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" method="POST">
              <ul>
                  <li><h1>Submit a Bridge Design</h1></li>
                  <li><span class=requiredNotification>* Input is Required</span>
                  <li><label>Bridge Name</label><input type="text" required name="bridgeName"></li>
                  <li><label>Bridge Weight</label><input type="number" name="weight" placeholder="Round to nearest gram" pattern="^(0*[0-9]{1,3}|[1-2][0-9]{3}|3000)$"></li>
                  <li><label>Bridge Capacity</label><input type="number" required name="capacity" placeholder="Round to nearest pound" pattern="^(0?0?[5-9][0-9]|0?[0-9]{3}|[0-2][0-9]{3}|3000)$">
                  <li><label>Year of Construct</label><input type="number" required name="year" pattern="^([1][9][8-9][0-9]|[2][0][0-2][0-9]|2030)$"></li>
                  <li><label>Comments: Describe the reason and the location of failure.</label>
                      <textarea rows=10 cols=50 name="comments" required placeholder="Also please include miscillaneous comments here"></textarea></li>
                  <li><input type="hidden" name="MAX_IMAGE_SIZE" value="10000000">
                    <label>Blueprint</label><input type="file" required name="blueprint"></li>
                  <li><label>Technical Report</label><input type="file" required name="report"></li>
                  <li><button type="submit" class="submit">Submit</button></li>
               </ul>    
        </form>
        </div> 
        </div>            
    </body>
</html>