
<div class="datapill playList">    
    <table class="playerList">
        <tbody>
            <tr>
                <th></th>
                <th>Player</th>
                <th>Score</th>
                <th>Wins</th>
                <th>Losses</th>
            <?php   
                require 'mobile.php';
                if($mobile_browser == 0) {  ?>
                <th>Cul</th>
                <th>Def</th>
                <th>Dip</th>
                <th>Dom</th>
                <th>Rel</th>
                <th>Sci</th>
                <th>Sco</th>
            <?php } ?>
            </tr>
            <?php  
                require '../connection.inc';
                $parent_sql = "SELECT Players.player_ID, pName, PlayerScore.totalScore, color, season, (SELECT count(winner) as wins FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = $season) AS playerWins,
                                (SELECT count(Party.game_ID) FROM Party LEFT JOIN Games ON Party.game_ID = Games.game_ID WHERE player_ID = Players.player_ID AND Games.season = $season AND winner IS NULL AND complete_NO >= 1) AS playerLoss
                                FROM Players 
                                RIGHT JOIN PlayerScore ON PlayerScore.player_ID = Players.player_ID
                                RIGHT JOIN Player_Color ON Player_Color.player_ID = Players.player_ID
                                WHERE Player_Color.player_ID IS NOT NULL
                                AND season = $season
                                ORDER BY playerWins DESC, PlayerScore.totalScore DESC;";
                $parent_result = mysqli_query($conn, $parent_sql);
                if (mysqli_num_rows($parent_result) > 0) {
                    while($row = mysqli_fetch_assoc($parent_result)) {
                        echo "<tr>";
                        echo "<td class='color'><span style='color:$row[color];'>&#9679</span></td>";
                        echo "<td>$row[pName]</td>";
                        echo "<td>$row[totalScore]</td>";
                        echo "<td>$row[playerWins]</td>";
                        echo "<td>$row[playerLoss]</td>";
                        if($mobile_browser == 0) {
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
                        }
                        if($_SESSION['admin'] == 1){
                            // echo "<td><button onClick='removePlayer(event, $row[player_ID])' class='button error'>Remove</button></td>";
                        }
                        echo "</tr>";
                    }
                }
            
            ?>
            <script>
                function removePlayer(event,id_val){
                    event.preventDefault();
                    $.post( "PHP/removePlayer.php", { id: id_val} );
                    $("#Players").load("PHP/playerList.php");
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