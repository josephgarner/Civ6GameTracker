<form action="Win Game">
    <span>Game Title: </span><input type="text" name="gameTitle"/><br>
    <span>Victory: </span><select name="sealvl">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br>
    <span>Turns: </span><input type="text" name="turns"/><br>
    <span>Nukes: </span><input type="text" name="turns"/><br>
    <script>
        $('#addNewPlayer').submit(function(event){
            event.preventDefault();
            var data = $('#addNewPlayer').serialize();
            $.post('PHP/addnewplayer.php', data);
            $("#Players").load("PHP/playerList.php");
        });
    </script>
    <?php 
        require '../connection.inc';
        $sql = "SELECT pName, Players.player_ID 
                FROM Players
                LEFT JOIN Party ON Players.player_ID = Party.player_ID
                WHERE game_ID = 6;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>$row[pName]</td>";
                echo "<td><input type='checkbox' name='$row[pName]' value='$row[player_ID]' /></td>";
                echo "</tr>";
            }
        }
    ?>
    <input class="button" type="submit" value="Confirm Game Completion"/>
</form>