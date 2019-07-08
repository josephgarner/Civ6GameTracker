<?php
    $players = array();
    foreach( $_POST as $item => $val ) {;
        array_push($players, $val);
        echo $val;
        echo '<br>';
    }
    $turnType = array_pop($players);
    $ruleSet = array_pop($players);
    $speed = array_pop($players);
    $sealvl = array_pop($players);
    $map = array_pop($players);
    $season = array_pop($players);
    require '../connection.inc';
    $sql = "INSERT INTO Games (victory_ID, season, map, sealvl, speed, rules, turntype) 
    VALUES (1,'$season','$map','$sealvl','$speed','$ruleSet','$turnType')";
    $result = mysqli_query($conn, $sql);

    $parent_sql = "SELECT game_ID FROM Games WHERE victory_ID = 1 ORDER BY game_ID DESC LIMIT 1;";
    $parent_result = mysqli_query($conn, $parent_sql);
    $game_val = mysqli_fetch_row($parent_result);
    $gameID = $game_val[0];
    

    echo $gameID;
    echo '<br>';

    foreach( $players as $p){
        $sql = "INSERT INTO Party (game_ID, player_ID) VALUES ($gameID,$p);";
        $result = mysqli_query($conn, $sql);
        echo 'Added Player';
        echo '<br>';
    }
?>