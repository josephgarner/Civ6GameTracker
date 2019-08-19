<!DOCTYPE html>
<?php require 'connection.inc';?>
<html>
    <head>
        <title>Civ 6 Game Tracking</title>
        <link href="CSS/main.css" rel="stylesheet" type="text/css">
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h2>Civ 6 Game Tracker</h2>
        <div class="loginPane">
            <form class="loginForm" action="processLogin.php" method="post">
                <input class="userInput" type="text" name="username" placeholder="Username"/>
                <input class="userInput" type="password" name="password" placeholder="Password"/>
                <input class="button" type="submit" name="login" value="Login">
            </form>
        </div>
        <?php  
            
        ?>
    </body>
</html>