<?php
    require '../connection.inc';
    $completed = false;
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
            <!-- <form action="/" method="POST"> -->
            <?php
                echo "<script> setArrs($js_civs, $js_leaders); </script>";
                $gameID = $_POST["gameID"];
                echo "<input type='hidden' name='gameID' value='$gameID'/>";
                $parent_sql = "SELECT title, game_ID, turns, nukes, start_date, victory_ID, complete_NO FROM Games WHERE game_ID = '$gameID';";
                    $parent_result = mysqli_query($conn, $parent_sql);
                    if (mysqli_num_rows($parent_result) > 0) {
                        while($parent_row = mysqli_fetch_assoc($parent_result)) {
                            echo "
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>
                                                Game Name: <input class='input' id='GameTitle' type='text' name='GameTitle' value='$parent_row[title]'/>
                                            </th>
                                            <!-- <th>Start Date: $parent_row[start_date]</th> --!>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Player</th>
                                            <th>Defeat</th>
                                            <th>Forfeit
                                            <th>Civ</th>
                                            <th>leader</th>
                                            <th>Score</th>
                                            <th>Winner</th>
                                        </tr>
                            ";

                        if("$parent_row[complete_NO]" != NULL){
                            echo "<input type='hidden' id='completed' name='completed' value='true'>";
                            $completed = true;
                        }else{
                            echo "<input type='hidden' id='completed' name='completed' value='false'>";
                            $completed = false;
                        }
                        
                        $sql = "SELECT Players.pName, Party.dead, civ, civ_name, civ_leader, Players.player_ID, Party.score, Party.winner
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
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_defeated' class='JS_Defeat' type='checkbox' name='$row[player_ID]_defeated' onChange='radioGroup(0,$row[player_ID])' value='$row[player_ID]' checked/><span class='checkbox-custom'></span></label></td>";
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_forfeit' class='JS_Forfeit' type='checkbox' name='$row[player_ID]_forfeit' onChange='radioGroup(1,$row[player_ID])' value='$row[player_ID]'/><span class='checkbox-custom'></span></label></td>";
                                }
                                else if($row['dead'] == 2){
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_defeated' class='JS_Defeat' type='checkbox' name='$row[player_ID]_defeated' onChange='radioGroup(0,$row[player_ID])' value='$row[player_ID]'/><span class='checkbox-custom'></span></label></td>";
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_forfeit' class='JS_Forfeit' type='checkbox' name='$row[player_ID]_forfeit' onChange='radioGroup(1,$row[player_ID])' value='$row[player_ID]'/ checked><span class='checkbox-custom'></span></label></td>";
                                }else{
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_defeated' class='JS_Defeat' type='checkbox' name='$row[player_ID]_defeated' onChange='radioGroup(0,$row[player_ID])' value='$row[player_ID]'/><span class='checkbox-custom'></span></label></td>";
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_forfeit' class='JS_Forfeit' type='checkbox' name='$row[player_ID]_forfeit' onChange='radioGroup(1,$row[player_ID])' value='$row[player_ID]'/><span class='checkbox-custom'></span></label></td>";
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
                                if($completed){
                                    echo "<td><span></span><input class='input updateNum ID_Score' type='number' name='$row[player_ID]_score' value='$row[score]' disabled/></td>";
                                }
                                else{
                                    echo "<td><span></span><input class='input updateNum ID_Score' type='number' name='$row[player_ID]_score' value='$row[score]'/></td>";
                                }

                                    echo "<td style='padding-left:.5em;'>
                                            <label class='radio-label'>";
                                    if("$row[winner]" == 1){
                                        echo        "<input class='input ID_Winner' type='radio' name='winner' value='$row[player_ID]' checked/>";
                                    }else{
                                        echo        "<input class='input ID_Winner' type='radio' name='winner' value='$row[player_ID]' />";
                                    }
                                                
                                    echo            "<span class='checkmark'></span>
                                            </label>
                                        </td>";
                                echo "</tr>";
                            }
                        }
                        echo "
                                </tbody>
                            </table>
                        ";

                        echo "<span class='update-span'>Turns: </span><input class='input updateNum' id='Turns' type='number' name='turns' value='$parent_row[turns]'/><br>";
                        echo "<span class='update-span'>Nuke: </span><input class='input updateNum' id='nukes' type='number' name='nukes' value='$parent_row[nukes]'/><br>";
                        echo "
                            <div class='flex'>
                                <span class='update-span'>Victory: </span><select class='input update' id='Victor' name='Victory'>";
                                    if("$parent_row[victory_ID]" == 1){
                                        echo "<option value='1' selected>Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 2){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2' selected>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 3){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3' selected>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 4){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4' selected>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 5){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5' selected>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 6){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6' selected>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 7){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7' selected>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }else if("$parent_row[victory_ID]" == 7){
                                        echo "<option value='1' >Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8' selected>Default</option>";
                                    }else{
                                        echo "<option value='1'>Game not complete</option>";
                                        echo "<option value='2'>Science</option>";
                                        echo "<option value='3'>Culture</option>";
                                        echo "<option value='4'>Domination</option>";
                                        echo "<option value='5'>Religion</option>";
                                        echo "<option value='6'>Diplomacy</option>";
                                        echo "<option value='7'>Score</option>";
                                        echo "<option value='8'>Default</option>";
                                    }                                    
                        echo "        </select><br>
                                <span class='update-span'>Ongoing Game: </span>
                                <div class='padding-top'>
                                    <label class='radio-label'>";
                            if("$parent_row[victory_ID]" == 1){
                                echo "<input class='input ID_Winner' type='radio' name='winner' value='0' checked/><br>";
                            }else{
                                echo "<input class='input ID_Winner' type='radio' name='winner' value='0'/><br>";
                            }
                                        
                            echo            "<span class='checkmark'></span>
                                    </label>
                                </div>
                            </div>
                        ";
                    }
                }
            ?>  
                
            <div class='flex'>
                    <input class="button confirm" type="submit" value="Update/Complete Game" onClick="return empty()"/>
                    <input class="button error" type="submit" name="delete" value="Delete Game">
                    <input class="button warning" type="submit" name="cancel" value="Cancel">
                </div>
            </form>
        </div>
    </body>
</html>