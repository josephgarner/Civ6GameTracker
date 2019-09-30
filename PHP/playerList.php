
<div class="datapill playList">    
    <table class="playerList">
        <tbody>
            <tr>
                <!-- <th style='min-width:2em;'></th>
                <th style='text-align:centre;'>Player</th>
                <th style='text-align:centre;'>Score</th>
                <th style='text-align:centre;'>Win/Loss</th>
                <th style='text-align:centre;'>Played</th> -->
                <!-- <th>W/L</th> -->
            </tr>
            <?php  
                require '../connection.inc';
                // $parent_sql = "SELECT Players.player_ID, pName, PlayerScore.totalScore, color, season, (SELECT count(winner) as wins FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = $season) AS playerWins,
                // ROUND((SELECT count(winner) as wins FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = $season) / (SELECT count(Party.game_ID) FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = 2 AND winner IS NULL AND complete_NO >= 1),2) AS ratio
                // FROM Players 
                // RIGHT JOIN PlayerScore ON PlayerScore.player_ID = Players.player_ID
                // RIGHT JOIN Player_Color ON Player_Color.player_ID = Players.player_ID
                // WHERE Player_Color.player_ID IS NOT NULL
                // AND season = $season
                // ORDER BY playerWins DESC, PlayerScore.totalScore DESC";
                $parent_sql = "SELECT Players.player_ID, pName, PlayerScore.totalScore, color, season, (SELECT count(winner) as wins FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = $season) AS playerWins,
                (SELECT count(Party.game_ID) FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = $season AND winner IS NULL AND complete_NO >= 1) AS losses
                FROM Players 
                RIGHT JOIN PlayerScore ON PlayerScore.player_ID = Players.player_ID
                RIGHT JOIN Player_Color ON Player_Color.player_ID = Players.player_ID
                WHERE Player_Color.player_ID IS NOT NULL
                AND season = $season
                ORDER BY playerWins DESC, PlayerScore.totalScore DESC";
                $parent_result = mysqli_query($conn, $parent_sql);
                if (mysqli_num_rows($parent_result) > 0) {
                    while($row = mysqli_fetch_assoc($parent_result)) {
                                    ?>
                        <tr>
                            <td colspan='5'>
                                <button class='accordion'>
                                    <table class='playerList'>
                                        <tbody>
                                            <tr>                                    
                                        <?php
                                        echo "<td class='color'><span style='color:$row[color];'>&#9679</span></td>";
                                        echo "<td><span title='Player'>$row[pName]</span></td>";
                                        echo "<td><span title='Total Score'>$row[totalScore]</span></td>";
                                        $total = $row['playerWins']+$row['losses'];
                                        echo "<td><span title='Wins/Losses'>$row[playerWins]<span style='font-size:.7em;'>/$total</span</span></td>";
                                        // echo "<td><span title='Games played'>$total</span></td>";
                                        ?> 
                                        </tr>
                                    </tbody>
                                </table>
                            </button>
                            <div class='data'>
                                <table class='playerDetails'>
                                    <tbody>
                                        <tr>
                                            <td colspan='2'>Wins:</td>
                                            <?php echo "<td>$row[playerWins]</td>"; ?>
                                            <td></td>
                                            <td colspan='2'>Losses:</td>
                                            <?php echo "<td>$row[losses]</td>"; ?>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>Games:</td>
                                            <?php echo "<td>$total</td>"; ?>
                                            <td></td>
                                            <td colspan='2'>Score:</td>
                                            <?php echo "<td>$row[totalScore]</td>"; ?>
                                        </tr>
                                        <tr style='margin-bottom:2em !important;'>
                                            <td colspan='3'>Victory Style:</td>
                                            <td></td>
                                            <?php
                                                $vic_sql = "Select Victory.vic_name, count(Victory.vic_name) as total FROM Victories 
                                                LEFT JOIN Victory ON Victories.victory_ID = Victory.victory_ID 
                                                WHERE player_ID = $row[player_ID]
                                                GROUP BY Victory.vic_name
                                                ORDER BY total DESC Limit 1;";
                                                $vic_result = mysqli_query($conn, $vic_sql);
                                                $vic = mysqli_fetch_object($vic_result);
                                                if($vic != null){
                                                    echo "<td colspan='3'>$vic->vic_name</td>";
                                                }
                                            ?>
                                        </tr>
                                        <tr style='height:1em;'>
                                        </tr>
                                        <tr>
                                            <th>Cul</th>
                                            <th>Def</th>
                                            <th>Dip</th>
                                            <th>Dom</th>
                                            <th>Rel</th>
                                            <th>Sci</th>
                                            <th>Sco</th>
                                        </tr>
                                        <tr>
                                        <?php
                                        $sql = "SELECT vic_name, COUNT(Victories.victory_ID) as wins
                                        FROM Victory
                                        LEFT OUTER JOIN Victories ON Victory.victory_ID = Victories.victory_ID
                                        AND player_ID = $row[player_ID]
                                        GROUP BY vic_name;";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($child_row = mysqli_fetch_assoc($result)) {
                                                switch("$child_row[vic_name]"){
                                                    case "No Victory":
                                                        // Do noting
                                                        break;
                                                    case "Science":
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                    case "Culture":
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                    case "Domination":
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                    case "Religion":
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                    case "Diplomacy":
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                    case "Score":
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                    default:
                                                        echo "<td>$child_row[wins]</td>";
                                                        break;
                                                }
                                            }
                                        }
                                        ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                }
            
            ?>
            <script>
                // function removePlayer(event,id_val){
                //     event.preventDefault();
                //     $.post( "PHP/removePlayer.php", { id: id_val} );
                //     $("#Players").load("PHP/playerList.php");
                // }   
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                  acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                      panel.style.maxHeight = null;
                    } else {
                      panel.style.maxHeight = panel.scrollHeight + "px";
                    }
                  });
                }
            </script>
        </tbody>
    </table>
</div>

<?php 
if($_SESSION['admin'] == 1){
?>
<div class='datapill centre'>
    <form action="PHP/addnewplayer.php" method='POST' id="addNewPlayer">
        <span>New Player: </span><input class="input" type="text" name="newPlayer"/>
        <br>
        <span>Player Color: </span><select id='colorSelect' class="input" name="color">
            <?php
                $parent_sql = "SELECT color
                FROM Player_Color 
                WHERE player_ID IS NULL";
                $parent_result = mysqli_query($conn, $parent_sql);
                if (mysqli_num_rows($parent_result) > 0) {
                    while($row = mysqli_fetch_assoc($parent_result)) {
                        echo "<option style='background-color:$row[color] ! important;' value=$row[color]>$row[color]</option>";
                    }
                }
            ?>
        </select><br>
        <input class="button confirm" type="submit" value="Add Player"/>
    </form>
<div>
<script>
    $(document).ready(function(){
        var selectedVal = $("#colorSelect option:selected").val();
        $('#colorSelect').css({
            "background-color": selectedVal
        });
    });
    $('#colorSelect').change(function(){
        var selectedVal = $("#colorSelect option:selected").val();
        $('#colorSelect').css({
            "background-color": selectedVal
        });
    });
</script>
<?php
}
?>