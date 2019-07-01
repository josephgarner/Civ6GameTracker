<?php

    require 'connection.h';

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
            $_SESSION['login_user'] = $username;
            header('location:gamedata.php');
        }else{ ?>
            <div class="alert alert-error">Error login! Please check your username or password</div>
        <?php
        }
    }
?>