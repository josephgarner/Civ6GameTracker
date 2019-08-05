<?php
    session_start();
    foreach($_POST as $key => $value){
        print_r("$key: $value");
    }
    $_SESSION['season'] = $_POST["Season"];
    header('location:../');
?>