<div class="datapill createGame">
    <form action="/" id="createNewGame">
        <div class="sbs">
            <div>
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
            </div>
            <div>
                <span>Season: </span><br><input class="select input" type="text" name="season" value="2"/><br>
                <span>Map: </span><br><select class="select input"  name="map">
                    <option value="Continents">Continents</option>
                    <option value="Fractal">Fractal</option>
                    <option value="Inland Sea">Inland Sea</option>
                    <option value="Island Plates">Island Plates</option>
                    <option value="Pangaea">Pangaea</option>
                    <option value="Shuffle">Shuffle</option>
                    <option value="4-Leaf Clover">4-Leaf Clover</option>
                    <option value="6-Armed Snowflake">6-Armed Snowflake</option>
                    <option value="Earth">Earth</option>
                    <option value="True Start Location Earth">True Start Location Earth</option>
                    <option value="Small Continents">Small Continents</option>
                    <option value="East Asia">East Asia</option>
                    <option value="True Start Location East Asia">True Start Location East Asia</option>
                    <option value="Europe">Europe</option>
                    <option value="True Start Location Europe">True Start Location Europe</option>
                </select><br>
                <span>Map Size: </span><br><select class="select input" name="mapSize">
                    <option value="Tiny">Tiny</option>
                    <option value="Small">Small</option>
                    <option value="Standed">Standed</option>
                    <option value="Large">Large</option>
                    <option value="Huge">Huge</option>
                </select><br>
                <span>Sea Level: </span><br><select class="select input" name="sealvl">
                    <option value="Low">Low</option>
                    <option value="Medium">Regular</option>
                    <option value="High">High</option>
                </select><br>
                <span>Speed: </span><br><select class="select input" name="speed">
                    <option value="Online">Online</option>
                    <option value="Quick" selected="selected">Quick</option>
                    <option value="Standard">Standard</option>
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
