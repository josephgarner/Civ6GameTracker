<div class="datapill createGame">
    <form action="/" id="createNewGame">
        <div class="sbs">
            <div>
                <table class='selectPlayers' id="Players">
                    <tbody>
                        <?php  
                            require '../connection.inc';
                            $sql = "SELECT * FROM Players";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                        echo "<td>$row[pName]</td>";
                                        echo "<td><label class='checkbox-label'><input type='checkbox' name='$row[pName]' value='$row[player_ID]' /><span class='checkbox-custom'></span></label></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <?php echo "<span>Season: </span><br><input class='select input' type='number' name='season' value='$season'/><br>";  ?>
                <span>Map: </span><br><select class="select input"  name="map">
                    <?php
                        $sql = "SELECT map_name FROM Maps ORDER BY map_name ASC;";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='$row[map_name]'>$row[map_name]</option>";
                            }
                        }
                    ?>
                </select><br>
                <span>Map Size: </span><br><select class="select input" name="mapSize">
                    <option value="Tiny">Tiny</option>
                    <option value="Small">Small</option>
                    <option value="Standard">Standard</option>
                    <option value="Large">Large</option>
                    <option value="Huge">Huge</option>
                </select><br>
                <span>Sea Level: </span><br><select class="select input" name="sealvl">
                    <option value="Low">Low</option>
                    <option value="Medium">Standard</option>
                    <option value="High">High</option>
                </select><br>
                <span>Speed: </span><br><select class="select input" name="speed">
                    <option value="Online">Online</option>
                    <option value="Quick">Quick</option>
                    <option value="Standard" selected="selected">Standard</option>
                    <option value="Epic">Epic</option>
                    <option value="Marathon">Marathon</option>
                </select><br>
                <span>Rull Set: </span><br><input class="select input" type="text" name="ruleSet" value="GS"/><br>
                <span>Turn Type: </span><br><select class="select input" name="turnType">
                    <option value="Simultaneous">Simultaneous</option>
                    <option value="Sequential">Sequential</option>
                </select><br>
                
            </div>
        </div>
        <input class="button confirm" type="submit" value="Create Game"/>
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
