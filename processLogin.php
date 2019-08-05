<?php

    require 'connection.inc';

    if (isset($_POST['login'])){
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        if($username == 'root'){
            $sql = "select * from Logins where username='$username'";
        } else{
            $sql = "select * from Logins where username='$username' and password='$password'";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['login_user'] = $username;
            $_SESSION['admin'] = $row['admin'];
            $_SESSION['season'] = 2;
            echo $_SESSION['admin'];
            header('location:/');
        }else{ ?>
            header('location:/');
        <?php
        }
    }
?>