<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Morgan Competition</title>
        <link rel="stylesheet" type="text/css" href="_/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="_/css/my_styles.css">
    </head>
    <body id="home">
        <?php include "_/php/article-navbar.php"?>
        <section class="container">
            <div class="row">
                <section class="col-md-9">
                    <?php include "_/php/article-announcements.php" ?>
                </section>
                <section class="col-md-3">
                    <?php include "_/php/aside-sb-announcements.php" ?>
                    <br>
                    <hr>
                    <?php include "_/php/aside-ob-announcements.php" ?>
                    <br>
                    <hr>
                    <?php include "_/php/aside-bb-announcements.php" ?>
                </section>
            </div>
            <br>
        </section>
        <!-- JavaScript -->
        <script src="_/js/_bootstrap.js"></script>
        <script src="_/js/_my_scripts.js"></script>
    </body>
</html>
