<?php
    session_start();
// SERVER
    $servername = "sql312.epizy.com";
    $username = "epiz_23994266";
    $password = "C9xXgowGTD";
    $db = "epiz_23994266_storage";

// LOCAL

    // $servername = "localhost";
    // $username = "user";
    // $password = "1234";
    // $db = "storage";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// echo "Connected successfully";
?>