<div>
    <form action="/" id="createNewGame">
        <table id="Players">
            <tbody>
                <?php  
                    require '../connection.h';
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
        <span>Game Name: </span><input type="text" name="gameName"/>
        <span>Season: </span><input type="text" name="season"/>
        <input class="button" type="submit" value="Create Game"/>
    </form>
    <script>
        $('#createNewGame').submit(function(event){
            event.preventDefault();
            var data = $('#createNewGame').serialize();
            $.post('PHP/creategame.php', data);
            $("#newGame_Modal").load("PHP/createGameModal.php");
        });
    </script>
</div>
