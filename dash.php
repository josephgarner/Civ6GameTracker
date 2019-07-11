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
        <div id="Players">
        </div>
        <br>
        <br>
        <button class="button">New Game</button>

        <div id="newGame_Modal">
        </div>
        <br>
        <br>
        <div id="Games">
        </div>
        <br>
        <br>
        <div id="Finished_Games">
        </div>
         
    </body>
</html>