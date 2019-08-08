
<?php 
    require '../connection.inc';
    require 'mobile.php';
    $parent_sql = "SELECT Games.game_ID, Games.title, Victory.vic_name, map, map_size, sealvl, speed, rules, turns, turntype, nukes, end_date, complete_NO, season
                FROM Games INNER 
                JOIN Victory ON Games.victory_ID = Victory.victory_ID
                WHERE Games.victory_ID > 1
                AND season = $season
                ORDER BY complete_NO DESC;";
    $parent_result = mysqli_query($conn, $parent_sql);
    if (mysqli_num_rows($parent_result) > 0) {
        while($parent_row = mysqli_fetch_assoc($parent_result)) {
            $colorSQL = "Select color FROM Games 
                        INNER JOIN Party ON Party.game_ID = Games.game_ID 
                        INNER JOIN Player_Color ON Party.player_ID = Player_Color.player_ID 
                        WHERE Games.game_ID = $parent_row[game_ID]
                        AND Party.winner = 1;";
            $color_result = mysqli_query($conn, $colorSQL);
            $row = mysqli_fetch_assoc($color_result);            
            echo "<div class='datapill finGame'>";
            echo "
            <div class='winBanner flex' style='background-color:$row[color];'>
                <table class='sortingGames' style='text-align:center'>
                    <tbody>
                        <tr>
                            <th colspan=3>$parent_row[title]</th>
                        </tr>
                        <tr>
                            <th colspan=3>";
                            if("$parent_row[vic_name]" == "Science"){
                                echo "<img src='IMAGES/VICS/science.png' height='50em'/>";
                            }
                            else if("$parent_row[vic_name]" == "Culture"){
                                echo "<img src='IMAGES/VICS/culture.png' height='50em'/>";
                            }
                            else if("$parent_row[vic_name]" == "Diplomacy"){
                                echo "<img src='IMAGES/VICS/diplo.png' height='50em'/>";
                            }
                            else if("$parent_row[vic_name]" == "Default" || "$parent_row[vic_name]" == "Score"){
                                echo "<img src='IMAGES/VICS/generic.png' height='50em'/>";
                            }
                            else if("$parent_row[vic_name]" == "Domination"){
                                echo "<img src='IMAGES/VICS/domination.png' height='50em'/>";
                            }
                            else if("$parent_row[vic_name]" == "Religion"){
                                echo "<img src='IMAGES/VICS/religion.png' height='50em'/>";
                            }
            echo            "</th>   
                        </tr>
                        <tr>
                            <th class='subheading'>Game $parent_row[complete_NO]</th>
                            <th class='subheading'>$parent_row[vic_name]</th>
                            <th class='subheading'>$parent_row[end_date]</th>
                        </tr>
                    </tbody>
                </table>
            </div>";
            echo "
                <table class='finGameTab' style='text-align:center'>
                    <tbody>
                        <tr>
                            <td>Map:</td>
                            <td>$parent_row[map]</td>
                        </tr>
                        <tr>
                            <td>Map Size:</td>
                            <td>$parent_row[map_size]</td>
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
                <table class='finGameTabplay' style='text-align:center'>
                    <tbody>
                        <tr>
                        </tr>
            ";
            // <th>Player</th>
                            // <th>Winner</th>
                            // <th>Deafeated</th>
                            // <th>Civ</th>
                            // <th>Score</th>
            $sql = "SELECT Players.pName, Party.dead, civ_name, civ_leader, Party.score, Party.winner
            FROM Party
            INNER JOIN Games ON Party.game_ID = Games.game_ID
            INNER JOIN Players On Party.player_ID = Players.player_ID
            INNER JOIN Victory on Games.victory_ID = Victory.victory_ID
            LEFT JOIN Player_Color ON Party.player_ID = Player_Color.player_ID
            LEFT JOIN Civ ON Party.civ = Civ.civ_ID
            WHERE Party.game_ID = $parent_row[game_ID]
            AND Games.victory_ID > 1
            ORDER BY placement ASC;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$row[pName]</td>";
                    if($row['winner'] == 1 && $mobile_browser == 0){
                        echo "<td>Victor</td>";
                    }else if($row['winner'] == 1 && $mobile_browser != 0){
                        echo "<td>V</td>";
                    }
                    else if($row['dead'] == 1 && $mobile_browser == 0){
                        echo "<td>Defeated</td>";
                    }else if($row['dead'] == 1 && $mobile_browser != 0){
                        echo "<td>D</td>";
                    }
                    else if($row['dead'] == 2 && $mobile_browser == 0){
                        echo "<td>Forfeited</td>";
                    }else if($row['dead'] == 2 && $mobile_browser != 0){
                        echo "<td>F</td>";
                    }
                    else{
                        echo "<td></td>";
                    }
                    echo "<td>$row[civ_name]</td>";
                    if("$row[civ_leader]" != ""){
                        echo "<td><img src='IMAGES/CIVS/$row[civ_leader].png' height='40em'/></td>";
                    }else{
                        echo "<td><img src='IMAGES/CIVS/Unknown.png' height='40em'/></td>";
                    }
                    echo "<td>$row[score]</td>";
                    echo "</tr>";
                }
            }
            echo "
                    </tbody>
                </table>";
                if($_SESSION['admin'] == 1){
                    echo "<form style='margin-top:1em;' action='PHP/updateCompleteGame' method='POST'>
                        <input type='hidden' name='gameID' value='$parent_row[game_ID]' />
                        <input class='button warning' type='Submit' value='Update Civ Data'/>
                    </form>";
                }
            echo "</div>";
        }
    }
?>