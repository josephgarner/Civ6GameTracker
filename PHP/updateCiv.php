<?php if (isset($_POST['partyID'])){?>
<form action="POST">
    <?php
        $party = $_POST['partyID'];
        $sql = "SELECT Players.pName, Games.game_ID,
        FROM Party
        LEFT JOIN Players ON Party.player_ID = Players.player_ID
        LEFT JOIN Games On Party.game_ID = Games.game_ID
        WHERE game_ID = $party;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               echo "<span>Player: <span><input type='text' value='$row[pName]' name='lname' disabled>";
            }
        }
    ?>
    <span>Civilisation: </span><input type="text" name="playerScore"/>
    <input class="button" type="submit" value="Confirm Civ"/>
</form>

<?php } ?>