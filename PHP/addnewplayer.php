<?php
    $name = $_POST["newPlayer"];
    $color = $_POST["color"];
    $season = $_SESSION['season'];
    require '../connection.inc';
    $sql = "INSERT INTO Players (pName, wins) VALUES ('$name',0)";
    $result = mysqli_query($conn, $sql);
    
    $sql = "SELECT cound(player_ID) FROM Players"
    $result = mysqli_query($conn, $sql);
    $value = mysql_fetch_object($result);

    $sql = "INSERT INTO PlayerScore (player_ID, season) VALUES ($value,  $season);";
    $result = mysqli_query($conn, $sql);

    $sql = "INSERT INTO Player_Color (player_ID, color) VALUES ($value,  '$color');";
    $result = mysqli_query($conn, $sql);
?>