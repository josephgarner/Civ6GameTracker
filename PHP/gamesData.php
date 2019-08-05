
<?php
    require '../connection.inc';
    $parent_sql = "SELECT game_ID, turns FROM Games WHERE victory_ID = 1;";
    $parent_result = mysqli_query($conn, $parent_sql);
    if (mysqli_num_rows($parent_result) > 0) {
        while($parent_row = mysqli_fetch_assoc($parent_result)) {
            echo "
                <div class='datapill ongoing'>
                <table>
                    <tbody>
                        <tr style='color:#DAA520;'>
                            <th>ID: $parent_row[game_ID]</th>
                            ";
        if($_SESSION['admin'] == 1){
            echo            "<th>
                                <form action='PHP/UpdateGame' method='POST'>
                                    <input type='hidden' name='gameID' value='$parent_row[game_ID]' />
                                    <input class='button warning' type='Submit' value='Update Game'/>
                                </form>
                            </th>";
        }
            echo        "
                            <th colspan='2'>Turns: $parent_row[turns]</th>
                        </tr>
                        <tr>
                            <th>Player</th>
                            <th>Defeated</th>
                            <th>Civ</th>
                            <th>Score</th>
                        </tr>
            ";
            $sql = "SELECT Players.pName, Party.dead, civ_name, Party.party_ID, Players.player_ID, Party.score
                FROM Party
                INNER JOIN Games ON Party.game_ID = Games.game_ID
                INNER JOIN Players On Party.player_ID = Players.player_ID
                LEFT JOIN Civ ON Party.civ = Civ.civ_ID
                WHERE Games.game_ID = '$parent_row[game_ID]';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$row[pName]</td>";
                    if($row['dead'] == 2){
                        echo "<td>Forfeited</td>";
                    }
                    else if($row['dead'] == 1){
                        echo "<td>Defeated</td>";
                    }else{
                        echo "<td>Alive</td>";
                    }
                    echo "<td>$row[civ_name]</td>";
                    echo "<td>$row[score]</td>";
                    echo "</tr>";
                }
            }
            echo "
                    </tbody>
                </table>
                </div>
            ";
        }
    }
?>