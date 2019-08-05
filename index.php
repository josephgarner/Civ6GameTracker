<!-- http://site2019testing.rf.gd -->
<?php
    session_start();
    if (!isset($_SESSION['admin'])){
        $_SESSION['admin'] = 0;
    }
    $_SESSION['season'] = 2;
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
            <div class='left'>
            <select class='input update' id='Season' names='Season' onchange='reloadAll()'>
                <?php
                    $sql = "SELECT season from Games";
                    $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=$row[season]>Season $row[season]</option>";
                            }
                        }
                ?>
                    <option>Season 2</season>
                </select>
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
        <div class="flex flex-coloumn" id="Players">
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