<!-- http://site2019testing.rf.gd -->
<?php
    require 'connection.h';
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
        <div id="SuccessCode"></div>
        <button class="button">New Game</button>
        <div id="newGame_Modal">
        </div>
        <?php
            $parent_sql = "SELECT title, start_date FROM Games WHERE victory_ID = 1;";
            $parent_result = mysqli_query($conn, $parent_sql);
            if (mysqli_num_rows($parent_result) > 0) {
                while($parent_row = mysqli_fetch_assoc($parent_result)) {
                    echo "
                        <table id='Games'>
                            <tbody>
                                <tr>
                                    <th>$parent_row[title]</th>
                                    <th>$parent_row[start_date]</th>
                                </tr>
                                <tr>
                                    <th>Player</th>
                                    <th>Alive</th>
                                    <th></th>
                                    <th>Civ</th>
                                </tr>
                    ";
                    $sql = "SELECT Players.pName, Party.dead, Party.civ
                        FROM Party
                        INNER JOIN Games ON Party.game_ID = Games.game_ID
                        INNER JOIN Players On Party.player_ID = Players.player_ID
                        WHERE Games.title = '$parent_row[title]';";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>$row[pName]</td>";
                            if($row['dead'] == 1){
                                echo "<td>Dead</td>";
                            }else{
                                echo "<td>Alive</td>";
                                echo "<td><button class='button'>Died</button></td>";
                            }
                            echo "<td>$row[civ]</td>";
                            echo "<td><button class='button'>Update Civ</button></td>";
                            echo "<td><button class='button'>Winner</button></td>";
                            echo "</tr>";
                        }
                    }
                    echo "
                            </tbody>
                        </table>
                    ";
                }
            }
        ?>

        <?php 
            $parent_sql = "SELECT Games.title, Victory.name, Games.start_date, Games.end_date
                        FROM Games INNER 
                        JOIN Victory ON Games.victory_ID = Victory.victory_ID
                        WHERE Games.victory_ID > 1;";
            $parent_result = mysqli_query($conn, $parent_sql);
            if (mysqli_num_rows($parent_result) > 0) {
                while($parent_row = mysqli_fetch_assoc($parent_result)) {
                    echo "
                        <table id='Finished_Games'>
                            <tbody>
                                <tr>
                                    <th>$parent_row[title]</th>
                                    <th>$parent_row[name]</th>
                                    <th>$parent_row[start_date]</th>
                                    <th>$parent_row[end_date]</th>
                                </tr>
                                <tr>
                                    <th>Winner</th>
                                    <th>Player</th>
                                    <th>Alive</th>
                                    <th>Civ</th>
                                </tr>
                    ";
                    $sql = "SELECT Party.winner, Players.pName, Party.dead, Party.civ, Victory.name
                    FROM Party
                    INNER JOIN Games ON Party.game_ID = Games.game_ID
                    INNER JOIN Players On Party.player_ID = Players.player_ID
                    INNER JOIN Victory on Games.victory_ID = Victory.victory_ID
                    WHERE Party.winner is not null;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            if($row['winner'] == 1){
                                echo "<td>Winner</td>";
                            }else{
                                echo "<td></td>";
                            }
                            echo "<td>$row[pName]</td>";
                            if($row['dead'] == 1){
                                echo "<td>Dead</td>";
                            }else{
                                echo "<td></td>";
                            }
                            echo "<td>$row[civ]</td>";
                            echo "</tr>";
                        }
                    }
                    echo "
                            </tbody>
                        </table>
                    ";
                }
            }
        ?>
         
    </body>
</html>