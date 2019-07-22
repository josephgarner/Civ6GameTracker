<?php

    require 'connection.inc';
    $first = $_POST['password'];
    $username = $_POST['username'];
    echo "$username <br>";
    echo "$first <br>";
    $password=md5($_POST['password']);
    echo "$password <br>";
    $sql = "INSERT INTO Logins (username, password) VALUES ('$username','$password');";
    $result = mysqli_query($conn, $sql);
    echo $result;

    header('location:index');
?>