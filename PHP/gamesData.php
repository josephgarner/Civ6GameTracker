<?php
    require '../connection.inc';
    $parent_sql = "SELECT title, game_ID, start_date FROM Games WHERE victory_ID = 1;";
    $parent_result = mysqli_query($conn, $parent_sql);
    if (mysqli_num_rows($parent_result) > 0) {
        while($parent_row = mysqli_fetch_assoc($parent_result)) {
            echo "
                <table>
                    <tbody>
                        <tr>
                            <th>$parent_row[title]</th>
                            <th>$parent_row[start_date]</th>
                            <th>
                                <form action='PHP/UpdateGame' method='POST'>
                                    <input type='hidden' name='gameID' value='$parent_row[game_ID]' />
                                    <input class='button' type='Submit' value='Update Game'/>
                                </form>
                            </th>
                        </tr>
                        <tr>
                            <th>Player</th>
                            <th>Defeated</th>
                            <th>Civ</th>
                            <th>Score</th>
                        </tr>
            ";
            $sql = "SELECT Players.pName, Party.dead, Party.civ, Party.party_ID, Players.player_ID, Party.score
                FROM Party
                INNER JOIN Games ON Party.game_ID = Games.game_ID
                INNER JOIN Players On Party.player_ID = Players.player_ID
                WHERE Games.game_ID = '$parent_row[game_ID]';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$row[pName]</td>";
                    if($row['dead'] == 1){
                        echo "<td>Defeated</td>";
                    }else{
                        echo "<td>Alive</td>";
                    }
                    echo "<td>$row[civ]</td>";
                    echo "<td>$row[score]</td>";
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