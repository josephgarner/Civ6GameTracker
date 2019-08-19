<?php
    session_start();
    $season = $_SESSION['season'];

// LOCAL

    $servername = "localhost";
    $username = "user";
    $password = "1234";
    $db = "storage";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// echo "Connected successfully";
?>