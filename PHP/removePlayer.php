<?php
    require '../connection.h';
    $sql = "DELETE FROM PLAYERS WHERE player_ID = '".$_POST["id"]."'";
    $result = mysqli_query($conn, $sql);
?>