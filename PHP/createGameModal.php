<div>
    <form action="/" id="createNewGame">
        <table id="Players">
            <tbody>
                <?php  
                    require '../connection.inc';
                    $sql = "SELECT * FROM Players";
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
            </tbody>
        </table>
        <span>Season: </span><input type="text" name="season"/><br>
        <span>Map: </span><select name="map">
            <option value="Tiny Fractal">Tiny Fractal</option>
            <option value="Fractal">Fractal</option>
        </select><br>
        <span>Sea Level: </span><select name="sealvl">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select><br>
        <span>Speed: </span><select name="speed">
            <option value="Fast">Fast</option>
            <option value="Medium">Medium</option>
            <option value="Slow">Slow</option>
        </select><br>
        <span>Rull Set: </span><input type="text" name="ruleSet"/><br>
        <span>Turn Type: </span><select name="turnType">
            <option value="Simultaneous">Simultaneous</option>
        </select><br>
        <input class="button" type="submit" value="Create Game"/>
    </form>
    <script>
        $('#createNewGame').submit(function(event){
            event.preventDefault();
            var data = $('#createNewGame').serialize();
            $.post('PHP/creategame.php', data);
            $("#newGame_Modal").load("PHP/createGameModal.php");
            $("#Games").load("PHP/gamesData.php");
        });
    </script>
</div>
