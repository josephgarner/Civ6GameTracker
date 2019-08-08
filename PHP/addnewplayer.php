<?php
    $name = $_POST["newPlayer"];
    $color = $_POST["color"];
    require '../connection.inc';
    $sql = "INSERT INTO Players (pName, wins) VALUES ('$name',0);";
    $result = mysqli_query($conn, $sql);
    
    $sql = "SELECT player_ID FROM Players ORDER BY player_ID DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $value = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO Player_Color (player_ID, color) VALUES ($value[player_ID],  '$color');";
    $result = mysqli_query($conn, $sql);
    header('location:../');
?>