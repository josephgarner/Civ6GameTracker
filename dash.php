<!-- http://site2019testing.rf.gd -->
<?php
    require 'connection.inc';
    if ( !isset( $_SESSION['login_user'] ) ) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Civ 6 Game Tracking</title>
        <link href="CSS/main.css" rel="stylesheet" type="text/css">
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="JS/refreshing.js"></script>
    </head>
    <body>
        <form action="logout.php"><input class="button" type="submit" value="Logout"/></form>
        <div class="flex" id="Players">
        </div>
        <?php
        if($_SESSION['admin'] == 1){
        ?>
            <h1>Create New Game</h1>
            <div class="flex" id="newGame_Modal">
            </div>
        <?php
        }
        ?>
        <h1>Current Games</h1>
        <div id="Games">
        </div>
        <h1>Completed Games</h1>
        <div class="flex" id="Finished_Games">
        </div>
         
    </body>
</html>