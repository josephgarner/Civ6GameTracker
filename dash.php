<!-- http://site2019testing.rf.gd -->
<?php
    require 'connection.inc';
    if ( !isset( $_SESSION['login_user'] ) ) {
        header("Location: index.php");
    }
    $season = $_SESSION['season'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Civ 6 Game Tracking</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="CSS/main.css" rel="stylesheet" type="text/css">
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="JS/refreshing.js"></script>
    </head>
    <body style='margin-top: 5em;'>
        <div class="infoBar">
            <div class="left">
                <?php 
                    echo "<h3>Season $season</h3>"; 
                ?>
            </div>
            <div class="right">
                <!-- <form action="logout.php">
                    <select class="select" name="season">
                    <option value="2">Season 2</option>
                    <option value="3">Small</option>
                    <option value="4">Standed</option>
                    <option value="5">Large</option>
                    <option value="6">Huge</option>
                    </select>
                </form> -->
                <form action="setSeason.php"><input class="button error" type="submit" value="Logout"/></form>
            </div>
        </div>
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
        <div class="flex" id="Games">
        </div>
        <h1>Completed Games</h1>
        <div class="flex cards" id="Finished_Games">
        </div>
         
    </body>
</html>