<?php
    require '../connection.inc';
    $gameID = $_POST["gameID"];
    $gameTitle = $_POST["GameTitle"];
    $players = array();
    echo "gameTitle: $gameTitle\n";
    
    foreach($_POST as $key => $value){
        echo "<br>$key == $value<br>";
        for($indx = 0; $indx <= 20; $indx++){
            if (strpos($key, "$indx") !== false){
                if(strpos($key, 'civ') !== false){
                    echo "<br>Grabbing Civ<br>";
                        $temp_Civ = $value;
                }
                if(strpos($key, 'leader') !== false){
                    echo "<br>Updating Civ<br>";
                    $sql = "SELECT civ_ID FROM Civ
                    WHERE civ_leader = '$value';";
                    $result = mysqli_query($conn, $sql);
                    $civ_id = mysqli_fetch_row($result);
                    $sql = "UPDATE Party SET civ = $civ_id[0] WHERE game_ID = $gameID AND player_ID = $indx;";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                }
                
            }
        }
    }
    $sql = "UPDATE Games
            SET title = '$gameTitle'
            WHERE game_ID = $gameID;";
    if (mysqli_query($conn, $sql)) {
        echo "Record Game Title and Vic updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    header('location:../dash');
?>