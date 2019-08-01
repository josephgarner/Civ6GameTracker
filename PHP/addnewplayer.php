<?php
    require '../connection.inc';
    $sql = "INSERT INTO Players (pName, wins) VALUES ('".$_POST["newPlayer"]."',0)";
    $result = mysqli_query($conn, $sql);
    
    $sql = "SELECT cound(player_ID) FROM Players"
    $result = mysqli_query($conn, $sql);
    $value = mysql_fetch_object($result);

    $sql = "INSERT INTO PlayerScore (player_ID) VALUES ($value);";
    $result = mysqli_query($conn, $sql);
?>