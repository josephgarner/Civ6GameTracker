<?php
    require '../connection.inc';
    $sql = "DELETE FROM PLAYERS WHERE player_ID = '".$_POST["id"]."'";
    $result = mysqli_query($conn, $sql);
?>