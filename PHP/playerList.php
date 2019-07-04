<table>
    <tbody>
        <tr>
            <th>Player</th>
            <th>Wins</th>
            <th>Losses</th>
        </tr>
        <?php  
            require '../connection.h';
            $sql = "SELECT * FROM Players";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$row[pName]</td>";
                    echo "<td>$row[wins]</td>";
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