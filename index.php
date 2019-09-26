<?php
    session_start();
    if (!isset($_SESSION['admin'])){
        $_SESSION['admin'] = 0;
    }
    if (!isset($_SESSION['season'])){
        $_SESSION['season'] = 2;
    }
    $season = $_SESSION['season'];
    // print_r($season);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Civ 6 Game Tracking</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="CSS/main.css" rel="stylesheet" type="text/css">
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
        <link href="CSS/animate.css" rel="stylesheet" type="text/css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="JS/refreshing.js"></script>
    </head>
    <body style='margin-top: 5em;'>
        <div class="infoBar">
            <div class='left'>
                <form action="PHP/sessionChange.php" method="POST" id="selectSeason">
                    <select class='input update' id='Season' name='Season' onchange="this.form.submit()">>
                    <?php
                        require 'connection.inc';
                        $sql = "SELECT season from Games GROUP BY season";
                        $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    if($row[season] == $season){
                                        echo "<option value=$row[season] selected>Season $row[season]</option>";
                                    }else{
                                        echo "<option value=$row[season]>Season $row[season]</option>";
                                    }
                                }
                            }
                    ?>
                    </select>
                </form>
            </div>
            <div class='right'>
            <?php
            if($_SESSION['admin'] == 1){
            ?>
                <form action="logout">
                    <input class='button error' type="submit" value="Log Out" />
                </form>
            <?php
            }else{
            ?>
                <form action="login">
                    <input class='button confirm' type="submit" value="Login" />
                </form>
            <?php
            }
            ?>
            </div>
        </div>
        <div class="flex flex-coloumn animated zoomIn delay-.5s" id="Players">
        </div>
        <?php
        if($_SESSION['admin'] == 1){
        ?>
            <h1>Create New Game</h1>
            <div class="flex animated zoomIn delay-.7s" id="newGame_Modal">
            </div>
        <?php
        }
        ?>
        <h1>Current Games</h1>
        <div class="flex animated zoomIn delay-.9s" id="Games">
        </div>
        <h1>Completed Games</h1>
        <div class="flex cards animated zoomIn delay-1s" id="Finished_Games">
        </div>
         
    </body>
</html>