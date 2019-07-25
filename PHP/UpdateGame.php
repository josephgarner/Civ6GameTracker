
<?php
    require '../connection.inc';
    $civs = array();
    $leaders = array();
    $sql = "SELECT civ_name FROM Civ;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if(!in_array("$row[civ_name]", $civs)){
                array_push($civs, "$row[civ_name]");
            }
        }
    }
    $sql = "SELECT civ_name, civ_leader FROM Civ;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $leaders["$row[civ_leader]"] = "$row[civ_name]";
        }
    }
    $js_civs = json_encode($civs);
    $js_leaders = json_encode($leaders);
?>

<!DOCTYPE html>
<html>
    <head>
        <Title>Updateing Game</Title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../CSS/main.css" rel="stylesheet" type="text/css">
        <link href="../CSS/style.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="../JS/check.js"></script>
        <script src="../JS/civs.js"></script>
    </head>
    <body>
        <div class="datapill">
            <form action="../PHP/processUpdateGame" method="POST">
            <?php
                echo "<script> setArrs($js_civs, $js_leaders); </script>";
                $gameID = $_POST["gameID"];
                echo "<input type='hidden' name='gameID' value='$gameID'/>";
                $parent_sql = "SELECT title, game_ID, start_date FROM Games WHERE game_ID = '$gameID';";
                    $parent_result = mysqli_query($conn, $parent_sql);
                    if (mysqli_num_rows($parent_result) > 0) {
                        while($parent_row = mysqli_fetch_assoc($parent_result)) {
                            echo "
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Game Name: <input id='GameTitle' type='text' name='GameTitle' value='$parent_row[title]'/></th>
                                            <th>Start Date: $parent_row[start_date]</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Player</th>
                                            <th>Defeated</th>
                                            <th>Civ</th>
                                            <th>leader</th>
                                            <th>Score</th>
                                            <th>Winner</th>
                                        </tr>
                            ";
                        $sql = "SELECT Players.pName, Party.dead, civ, civ_name, civ_leader, Players.player_ID, Party.score
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
                                if($row['dead'] == 1){
                                    echo "<td>Defeated</td>";
                                }else{
                                    echo "<td><input type='checkbox' name='$row[player_ID]_defeated' value='$row[player_ID]'/></td>";
                                }

                                
                                echo "<td><select id='$row[player_ID]CIV' name='$row[player_ID]_civ' onchange='loadLeader($row[player_ID])'>";
                                if("$row[civ]" == null || "$row[civ]" == 0){
                                    echo "<option value='0'>Unkown</option>";
                                } else{
                                    echo "<option value='$row[civ]'>$row[civ_name]</option>";
                                }
                                foreach ($civs as $obj){
                                    echo "<option value='$obj'>$obj</option>";
                                }
                                echo "</select></td>";


                                echo "<td><select id='$row[player_ID]LEADER' name='$row[player_ID]_civ_leader'>";
                                if("$row[civ]" != null || "$row[civ]" != 0){
                                    echo "<option value='$row[civ]'>$row[civ_leader]</option>";
                                } else{
                                    echo "<option value='0'>Unkown</option>";
                                }
                                echo "<td><span></span><input class='ID_Score' type='input' name='$row[player_ID]_score' value='$row[score]'/></td>";
                                echo "<td><input class='ID_Winner' type='radio' name='winner' value='$row[player_ID]'/></td>";
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
                <span>Victory: </span><select id='Victor' name="Victory">
                    <option value="1">Game not complete</option>
                    <option value="2">Science</option>
                    <option value="3">Culture</option>
                    <option value="4">Domination</option>
                    <option value="5">Religion</option>
                    <option value="6">Diplomacy</option>
                    <option value="7">Score</option>
                    <option value="8">Default</option>
                </select><br>
                <span>Turns: </span><input id='Turns' type='input' name='turns'/><br>
                <span>Nuke: </span><input type='input' name='nukes'/><br>
                <span>Ongoing Game: </span><input class='ID_Winner' type='radio' name='winner' value='0' checked/><br>
                <input class="button" type="submit" value="Update/Complete Game" onClick="return empty()"/>
                <input class="button" type="submit" name="delete" value="Delete Game">
            </form>
        </div>
    </body>
</html>