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
                                            <th>Game Name: <input class='input' id='GameTitle' type='text' name='GameTitle' value='$parent_row[title]'/></th>
                                            <!-- <th>Start Date: $parent_row[start_date]</th> --!>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Player</th>
                                            <th colspan='2'>Defeat/Forfeit</th>
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
                                    echo "<td colspan='2'>Defeated</td>";
                                }
                                else if($row['dead'] == 2){
                                    echo "<td colspan='2'>Forfeited</td>";
                                }else{
                                    echo "<td><label class='checkbox-label'><input type='checkbox' name='$row[player_ID]_defeated' value='$row[player_ID]'/><span class='checkbox-custom'></span></label></td>";
                                    echo "<td><label class='checkbox-label'><input type='checkbox' name='$row[player_ID]_forfeit' value='$row[player_ID]'/><span class='checkbox-custom'></span></label></td>";
                                }

                                
                                echo "<td><select class='input update' id='$row[player_ID]CIV' name='$row[player_ID]_civ' onchange='loadLeader($row[player_ID])'>";
                                if("$row[civ]" == null || "$row[civ]" == 0){
                                    echo "<option value='0'>Unkown</option>";
                                } else{
                                    echo "<option value='$row[civ]'>$row[civ_name]</option>";
                                }
                                foreach ($civs as $obj){
                                    echo "<option value='$obj'>$obj</option>";
                                }
                                echo "</select></td>";


                                echo "<td><select class='input update' id='$row[player_ID]LEADER' name='$row[player_ID]_civ_leader'>";
                                if("$row[civ]" != null || "$row[civ]" != 0){
                                    echo "<option value='$row[civ]'>$row[civ_leader]</option>";
                                } else{
                                    echo "<option value='0'>Unkown</option>";
                                }
                                echo "<td><span></span><input class='input updateNum ID_Score' type='input' name='$row[player_ID]_score' value='$row[score]'/></td>";
                                if($row['dead'] >= 1){
                                    echo "<td></td>";
                                }else{
                                    echo "<td style='padding-left:.5em;'>
                                            <label class='radio-label'>
                                                <input class='input ID_Winner' type='radio' name='winner' value='$row[player_ID]'/>
                                                <span class='checkmark'></span>
                                            </label>
                                        </td>";
                                }
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
                <div class='flex'>
                    <span class='update-span'>Victory: </span><select class='input update' id='Victor' name="Victory">
                        <option value="1">Game not complete</option>
                        <option value="2">Science</option>
                        <option value="3">Culture</option>
                        <option value="4">Domination</option>
                        <option value="5">Religion</option>
                        <option value="6">Diplomacy</option>
                        <option value="7">Score</option>
                        <option value="8">Default</option>
                    </select><br>
                    <span class='update-span'>Turns: </span><input class='input updateNum ID_Score' id='Turns' type='input' name='turns' value='0'/><br>
                    <span class='update-span'>Nuke: </span><input class='input updateNum ID_Score' type='input' name='nukes' value='0'/><br>
                    <span class='update-span'>Ongoing Game: </span>
                    <div class='padding-top'>
                        <label class="radio-label">
                            <input class='input ID_Winner' type='radio' name='winner' value='0' checked/><br>
                            <span class="checkmark"></span>
                        </label>
                    </div>
            </div>
            <div class='flex'>
                    <input class="button confirm" type="submit" value="Update/Complete Game" onClick="return empty()"/>
                    <input class="button error" type="submit" name="delete" value="Delete Game">
                </div>
            </form>
        </div>
    </body>
</html>