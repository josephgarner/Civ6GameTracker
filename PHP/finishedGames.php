<?php 
    require '../connection.inc';
    $parent_sql = "SELECT Games.game_ID, Games.title, Victory.vic_name, map, sealvl, speed, rules, turns, turntype, nukes, end_date
                FROM Games INNER 
                JOIN Victory ON Games.victory_ID = Victory.victory_ID
                WHERE Games.victory_ID > 1
                ORDER BY game_ID DESC;";
    $parent_result = mysqli_query($conn, $parent_sql);
    if (mysqli_num_rows($parent_result) > 0) {
        while($parent_row = mysqli_fetch_assoc($parent_result)) {
            echo "
            <div class='datapill'>
                <table style='text-align:center'>
                    <tbody>
                        <tr>
                            <th>$parent_row[title]</th>
                            <th>$parent_row[vic_name]</th>
                        </tr>
                        <tr>
                            <td>Map:</td>
                            <td>$parent_row[map]</td>
                        </tr>
                        <tr>
                            <td>Sea Level:</td>
                            <td>$parent_row[sealvl]</td>
                        </tr>
                        <tr>
                            <td>Speed:</td><td>$parent_row[speed]</td>
                        </tr>
                        <tr>
                            <td>Rules:</td><td>$parent_row[rules]</td>
                        </tr>
                        <tr>
                            <td>Turn Type:</td><td>$parent_row[turntype]</td>
                        </tr>
                        <tr>
                            <td>Turns:</td><td>$parent_row[turns]</td>
                        </tr>
                        <tr>
                            <td>Nukes Launched:</td><td>$parent_row[nukes]</td>
                        </tr>
                    </tbody>
                <table>
                <table style='text-align:center'>
                    <tbody>
                        <tr>
                            <th>Player</th>
                            <th>Winner</th>
                            <th>Deafeated</th>
                            <th>Civ</th>
                            <th>Score</th>
                        </tr>
            ";
            $sql = "SELECT Players.pName, Party.dead, Party.civ, Party.score, Party.winner
            FROM Party
            INNER JOIN Games ON Party.game_ID = Games.game_ID
            INNER JOIN Players On Party.player_ID = Players.player_ID
            INNER JOIN Victory on Games.victory_ID = Victory.victory_ID
            WHERE Party.game_ID = $parent_row[game_ID]
            AND Games.victory_ID > 1
            ORDER BY placement ASC;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$row[pName]</td>";
                    if($row['winner'] == 1){
                        echo "<td>Victor</td>";
                    }else{
                        echo "<td></td>";
                    }
                    if($row['dead'] == 1){
                        echo "<td>Defeated</td>";
                    }else{
                        echo "<td></td>";
                    }
                    echo "<td>$row[civ]</td>";
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