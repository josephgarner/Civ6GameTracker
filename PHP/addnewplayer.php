<?php
    require '../connection.h';
    $sql = "INSERT INTO Players (pName, wins, losses) VALUES ('".$_POST["newPlayer"]."',0,0)";
    $result = mysqli_query($conn, $sql);
?>