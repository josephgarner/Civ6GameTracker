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
        <script src="JS/parsingData.js"></script>
    </head>
    <body>
        <div id="Players">
        </div>
        <div id="SuccessCode"></div>
        <button class="button">New Game</button>
        <div id="newGame_Modal">
        </div>
        <!-- <form action="dead">
            <span>Score: </span><input type="text" name="playerScore"/>
            <input class="button" type="submit" value="Confirm Defeat"/>
        </form> -->

        

        <div id="CompleteGameModal">
        </div>

        <div id="Games">
        </div>
        
        <div id="Finished_Games">
        </div>
         
    </body>
</html>