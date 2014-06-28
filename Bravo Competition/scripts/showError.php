<?php 
  $error_message = $_REQUEST['error_message'];
  $system_error_message = $_REQUEST['system_error_message'];
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Error Page</title>
        <link rel="stylesheet" type="text/css" href="../default.css">
    </head>
    <body>
        <?php include "../_Layout.php";?>
        <div id="content">
        <h1>Oops...We have encountered and error</h1>
        <p> We are really sorry for the inconvienence. Don't worry though, we have been notified of the error
            and the issue will be resolved in 48 to 72 hours. If this is an important page for you, please feel free to contact us 
            for a faster turnover time. In meantime, please feel free to explore our other content.

         <p>This is the error that you encountered:<b><?php echo $error_message; ?></b></p>

          <p>System Error: <b>
                <?php if (DEBUG_MODE) {
                  echo $system_error_message; }?>
              </b>
          </p>
            </div>    
    </body>
</html>
