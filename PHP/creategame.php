<?php
    $players = array();
    foreach( $_POST as $item => $val ) {;
        array_push($players, $val);
    }
    $season = array_pop($players);
    $gameName = array_pop($players);
    require '../connection.h';
    $sql = "INSERT INTO Games (title, victory_ID, season) VALUES ('$gameName',0,'$season')";
    $result = mysqli_query($conn, $sql);

    $parent_sql = "SELECT game_ID FROM Games WHERE victory_ID = 0 ORDER BY game_ID DESC LIMIT 1;";
    $parent_result = mysqli_query($conn, $parent_sql);
    $game_val = mysqli_fetch_row($parent_result);
    $gameID = $game_val[0];

    foreach( $players as $p){
        $sql = "INSERT INTO Party (game_ID, player_ID, dead, civ, winner) VALUES ('$gameID',$p,0,'Unknown', null);";
        $result = mysqli_query($conn, $sql);
    }

?>