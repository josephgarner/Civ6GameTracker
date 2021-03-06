
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
        <script src="../JS/civs.js"></script>
        <script>
            function radioGroup(type,playerID){
                console.log("Checking button");
                if(type == 1){
                    if($('#'+playerID+'_forfeit').is(':checked')){
                        console.log('#'+playerID+'_forfeit Checked');
                        $('#'+playerID+'_defeated').prop('checked', false);
                        console.log("Unchecking Defeat");
                    }
                }else{
                    if($('#'+playerID+'_defeated').is(':checked')){
                        console.log('#'+playerID+'_defeated Checked');
                        $('#'+playerID+'_forfeit').prop('checked', false);
                        console.log("Unchecking Forfeit");
                    }
                }
            }
        </script>
    </head>
    <body>
        <div class="datapill">
            <form action="../PHP/processUpdateComplete" method="POST">
            <?php
                echo "<script> setArrs($js_civs, $js_leaders); </script>";
                $gameID = $_POST["gameID"];
                echo "<input type='hidden' name='gameID' value='$gameID'/>";
                $parent_sql = "SELECT title, game_ID, end_date FROM Games WHERE game_ID = '$gameID';";
                    $parent_result = mysqli_query($conn, $parent_sql);
                    if (mysqli_num_rows($parent_result) > 0) {
                        while($parent_row = mysqli_fetch_assoc($parent_result)) {
                            echo "
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Game Name: <input class='input' id='GameTitle' type='text' name='GameTitle' value='$parent_row[title]'/></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th>Player</th>
                                            <th>Defeat</th>
                                            <th>Forfeit</th>
                                            <th>Civ</th>
                                            <th>leader</th>
                                        </tr>
                            ";
                        $sql = "SELECT Players.pName, Party.dead, civ, civ_name, civ_leader, Players.player_ID, Party.score, winner
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
                                }else if($row['winner'] != null){
                                    // echo "<td></td>";
                                    // echo "<td></td>";
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_defeated' class='JS_Defeat' type='checkbox' name='$row[player_ID]_defeated' onChange='radioGroup(0,$row[player_ID])' value='$row[player_ID]' Disabled/><span class='checkbox-custom'></span></label></td>";
                                    echo "<td><label class='checkbox-label'><input id='$row[player_ID]_forfeit' class='JS_Forfeit' type='checkbox' name='$row[player_ID]_forfeit' onChange='radioGroup(1,$row[player_ID])' value='$row[player_ID]' Disabled/><span class='checkbox-custom'></span></label></td>";
                                }
                                else{
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
            <br>
                <input class="button confirm" type="submit" value="Update Game"/>
            </form>
        </div>
    </body>
</html>