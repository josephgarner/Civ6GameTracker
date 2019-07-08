<table style="text-align:center">
    <tbody>
        <tr>
            <th>ID</th>
            <th>Player</th>
            <th>Score</th>
            <th>Wins</th>

            <th>Science</th>
            <th>Culture</th>
            <th>Domination</th>
            <th>Religion</th>
            <th>Diplomacy</th>
            <th>Score</th>

            <th>Losses</th>
        </tr>
        <?php  
            require '../connection.inc';
            $parent_sql = "SELECT * FROM Players ORDER BY totalScore DESC";
            $parent_result = mysqli_query($conn, $parent_sql);
            if (mysqli_num_rows($parent_result) > 0) {
                while($row = mysqli_fetch_assoc($parent_result)) {
                    echo "<tr>";
                    echo "<td>$row[player_ID]</td>";
                    echo "<td>$row[pName]</td>";
                    echo "<td>$row[totalScore]</td>";
                    echo "<td>$row[wins]</td>";
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
                                    echo "<td>0</td>";
                                    break;
                            }
                        }
                    }
                    echo "<td>$row[losses]</td>";
                    echo "<td><button onClick='removePlayer(event, $row[player_ID])' class='button'>Remove</button></td>";
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
        <tr>
            <td colspan="3">
                <form action="/" id="addNewPlayer">
                    <span>New Player: </span><input type="text" name="newPlayer"/>
                    <input class="button" type="submit" value="Add Player"/>
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
    </tbody>
</table>