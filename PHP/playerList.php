
<div class="datapill">    
    <table class="playerList">
        <tbody>
            <tr>
                <th></th>
                <th>Player</th>
                <th>Score</th>
                <th>Wins</th>
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
                $parent_sql = "SELECT Players.player_ID, pName, PlayerScore.totalScore, wins, color 
                                FROM Players 
                                RIGHT JOIN PlayerScore ON PlayerScore.player_ID = Players.player_ID
                                RIGHT JOIN Player_Color ON Player_Color.player_ID = Players.player_ID
                                ORDER BY Players.wins DESC, PlayerScore.totalScore DESC";
                $parent_result = mysqli_query($conn, $parent_sql);
                if (mysqli_num_rows($parent_result) > 0) {
                    while($row = mysqli_fetch_assoc($parent_result)) {
                        echo "<tr>";
                        echo "<td class='color'><span style='color:$row[color];'>&#9679</span></td>";
                        echo "<td>$row[pName]</td>";
                        echo "<td>$row[totalScore]</td>";
                        echo "<td>$row[wins]</td>";
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
                            echo "<td><button onClick='removePlayer(event, $row[player_ID])' class='button error'>Remove</button></td>";
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
            <?php 
            if($_SESSION['admin'] == 1){
            ?>
            <tr>
                <td colspan="5">
                    <form action="/" id="addNewPlayer">
                        <span>New Player: </span><input type="text" name="newPlayer"/>
                        <input class="button confirm" type="submit" value="Add Player"/>
                    </form>
                    <script>
                        $('#addNewPlayer').submit(function(event){
                            event.preventDefault();
                            var data = $('#addNewPlayer').serialize();
                            $.post('PHP/addnewplayer.php', data);
                            $("#Players").load("PHP/playerList.php");
                        });
                    </script>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>