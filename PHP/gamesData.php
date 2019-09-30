
<?php
    require '../connection.inc';
    $parent_sql = "SELECT game_ID, turns, map, map_size FROM Games WHERE victory_ID = 1 AND season = $season;";
    $parent_result = mysqli_query($conn, $parent_sql);
    if (mysqli_num_rows($parent_result) > 0) {
        while($parent_row = mysqli_fetch_assoc($parent_result)) {
            ?>
            <div class='datapill ongoing'>
                <table>
                    <tbody>
                        <tr style='color:#DAA520;'>
                            <th>ID: <?php echo "$parent_row[game_ID]"; ?></th>
                            <?php if($_SESSION['admin'] == 1){ ?>
                                <th>
                                                    <form action='PHP/UpdateGame' method='POST'>
                                                        <input type='hidden' name='gameID' value='<?php echo "$parent_row[game_ID]" ?>' />
                                                        <input class='button warning' type='Submit' value='Update Game'/>
                                                    </form>
                                                </th>
                            <?php } ?>
                            <th colspan='2'>Turns: <?php echo "$parent_row[turns]" ?></th>
                        </tr>
                        <tr>
                            <th>Player</th>
                            <th>Defeated</th>
                            <th>Civ</th>
                            <th>Score</th>
                        </tr>
            <?php
            $sql = "SELECT Players.pName, Party.dead, civ_name, Party.party_ID, Players.player_ID, Party.score
                FROM Party
                INNER JOIN Games ON Party.game_ID = Games.game_ID
                INNER JOIN Players On Party.player_ID = Players.player_ID
                LEFT JOIN Civ ON Party.civ = Civ.civ_ID
                WHERE Games.game_ID = '$parent_row[game_ID]';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    if($row['dead'] <= 0){
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
            }
            ?>
                <tr>
                    <td colspan='4'>
                        <button class='accordion accordion_game'>More Details</button>
                        <div class='data'>
                            <table width=100% style='margin-bottom:.5em;'>
                                <tbody>
                                    <tr>
                                        <td>Map:</td>
                                        <td><?php echo "$parent_row[map]"; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Map Size:</td>
                                        <td><?php echo "$parent_row[map_size]"; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table width=100%>
                                <tbody>
                                    <tr>
                                        <th colspan='4'>
                                            Defeated Players
                                        </th>
                                    </tr>
                                        <?php
                                        $sql = "SELECT Players.pName, Party.dead, civ_name, Party.party_ID, Players.player_ID, Party.score
                                        FROM Party
                                        INNER JOIN Games ON Party.game_ID = Games.game_ID
                                        INNER JOIN Players On Party.player_ID = Players.player_ID
                                        LEFT JOIN Civ ON Party.civ = Civ.civ_ID
                                        WHERE Games.game_ID = '$parent_row[game_ID]';";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                                if($row['dead'] > 0){ 
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
                                        }?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
        <?php
        }
    }
?>
<script src="JS/accordion.js"></script>
<script>
    var acc_game = document.getElementsByClassName("accordion_game");
    dropdown(acc_game);
</script>
