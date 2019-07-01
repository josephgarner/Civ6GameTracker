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
    </head>
    <body>
        <table id="Players">
            <tbody>
                <tr>
                    <th>Player</th>
                    <th>Wins</th>
                    <th>Losses</th>
                </tr>
                <?php  
                    $sql = "SELECT * FROM Players";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[wins]</td>";
                            echo "<td>$row[losses]</td>";
                            echo "</tr>";
                        }
                    }
                
                ?>
            </tbody>
        </table>
        <table id="Games">
            <tbody>
                <tr>
                    <th>Game</th>
                    <th>Player</th>
                    <th>Alive</th>
                    <th>Civ</th>
                </tr>
                <?php  
                    $sql = "SELECT Games.title, Players.name, Party.dead, Party.civ
                            FROM Party
                            INNER JOIN Games ON Party.game_ID = Games.game_ID
                            INNER JOIN Players On Party.player_ID = Players.player_ID
                            WHERE Party.winner is null;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>$row[title]</td>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[dead]</td>";
                            echo "<td>$row[civ]</td>";
                            echo "<td><button class='button'>Update Civ</button></td>";
                            echo "<td><button class='button'>Winner</button></td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
        <table id="Finished_Games">
            <tbody>
                <tr>
                    <th>Game</th>
                    <th>Winner</th>
                    <th>Player</th>
                    <th>Alive</th>
                    <th>Civ</th>
                    <th>Vic</th>
                </tr>
                <?php  
                    $sql = "SELECT Party.winner, Games.title, Players.name, Party.dead, Party.civ, Games.victory_ID
                    FROM Party
                    INNER JOIN Games ON Party.game_ID = Games.game_ID
                    INNER JOIN Players On Party.player_ID = Players.player_ID
                    WHERE Party.winner is not null;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>$row[title]</td>";
                            echo "<td>$row[winner]</td>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[dead]</td>";
                            echo "<td>$row[civ]</td>";
                            echo "<td>$row[victory_ID]</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>