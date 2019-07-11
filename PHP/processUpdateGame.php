<?php
    $gameID = $_POST["gameID"];
    $victory = $_POST["Victory"];
    $gameTitle = $_POST["GameTitle"];
    $turns = $_POST["turns"];
    $nuke = $_POST["nukes"];
    $winner = $_POST["winner"];
    $victory = $_POST["Victory"];
    $players = array();
    $placement = array();
    require '../connection.inc';
    foreach($_POST as $key => $value){
        echo "<br>$key == $value<br>";
        for($indx = 0; $indx <= 20; $indx++){
            if (strpos($key, "$indx") !== false){
                if(strpos($key, 'civ') !== false){
                    echo "<br>Updating Civ<br>";
                    $sql = "UPDATE Party
                        SET civ = '$value'
                        WHERE game_ID = $gameID
                        AND player_ID = $indx;";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                }
                elseif(strpos($key, 'score') !== false){
                    echo "<br>Updating Score<br>";
                    $sql = "UPDATE Party
                        SET score = $value
                        WHERE game_ID = $gameID
                        AND player_ID = $indx;";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                    if($winner > 0){
                        $sql = "UPDATE Players
                                SET totalScore = totalScore + $value
                                WHERE player_ID = $indx;";
                        mysqli_query($conn, $sql);
                    }
                    $players[$indx]=$value;
                }
                elseif(strpos($key, 'defeated') !== false){
                    echo "<br>Updating Defeated<br>";
                    $sql = "UPDATE Party
                        SET dead = 1
                        WHERE game_ID = $gameID
                        AND player_ID = $indx;";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                }
            }
        }
    }
    echo "<br>Updating Game<br>";
    $sql = "UPDATE Games
            SET title = '$gameTitle', victory_ID = $victory
            WHERE game_ID = $gameID;";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    foreach($players as $x => $x_value) {
        if($x == $winner){
            echo "<br>Updating Winner<br>";
            $sql = "UPDATE Party
                SET placement = 1
                WHERE player_ID = $x;";
            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }else{
            $placement[$x]=$x_value;
        }
    }
    arsort($placement);
    $place = 2;
    foreach($placement as $x => $x_value) {
        echo "<br>Updating Placement<br>";
        $sql = "UPDATE Party
            SET placement = $place
            WHERE player_ID = $x;";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        $place++;
    }

    if($winner > 0){
        echo "<br>Updating End Date<br>";
        $today = date("Y-m-d");
        $sql = "UPDATE Games
            SET victory_ID = $victory, end_date = $today, nukes = $nuke, turns = $turns
            WHERE game_ID = $gameID;";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    header('location:../dash');
?>