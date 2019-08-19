<?php
    $name = $_POST["newPlayer"];
    $color = $_POST["color"];
    require '../connection.inc';
    $sql = "INSERT INTO Players (pName) VALUES ('$name');";
    $result = mysqli_query($conn, $sql);
    
    $sql = "SELECT player_ID FROM Players ORDER BY player_ID DESC LIMIT 1;";
    $result = mysqli_query($conn, $sql);
    $value = mysqli_fetch_assoc($result);

    $sql = "UPDATE Player_Color SET player_ID = $value[player_ID] WHERE color = '$color';";
    $result = mysqli_query($conn, $sql);
    header('location:../');
?>