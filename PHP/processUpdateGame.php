<?php
    require '../connection.inc';
    $gameID = $_POST["gameID"];
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM Party
            WHERE game_ID = $gameID";
        if (mysqli_query($conn, $sql)) {
            echo "Record  Score updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        $sql = "DELETE FROM Games
            WHERE game_ID = $gameID";
        if (mysqli_query($conn, $sql)) {
            echo "Record  Score updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        $victory = $_POST["Victory"];
        $gameTitle = $_POST["GameTitle"];
        $turns = $_POST["turns"];
        $nuke = $_POST["nukes"];
        $winner = $_POST["winner"];
        $victory = $_POST["Victory"];
        $players = array();
        $placement = array();

        echo "gameID: $gameID\n";
        echo "victory: $victory\n";
        echo "gameTitle: $gameTitle\n";
        echo "turns: $turns\n";
        echo "nuke: $nuke\n";
        echo "winner: $winner\n";
        echo "victory: $victory\n";
        
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
                    elseif(strpos($key, 'score') !== false){
                        echo "<br>Updating Score<br>";
                        $sql = "UPDATE Party
                            SET score = $value
                            WHERE game_ID = $gameID
                            AND player_ID = $indx;";
                        if (mysqli_query($conn, $sql)) {
                            echo "Record  Score updated successfully";
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                        if($winner > 0){
                            $sql = "UPDATE PlayerScore
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
                            echo "Record Defeated updated successfully";
                        } else {
                            echo "Error updating record: " . mysqli_error($conn);
                        }
                    }
                }
            }
        }
        echo "<br>Updating Game<br>";
        $sql = "UPDATE Games
                SET title = '$gameTitle', victory_ID = $victory, turns = $turns
                WHERE game_ID = $gameID;";
        if (mysqli_query($conn, $sql)) {
            echo "Record Game Title and Vic updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        foreach($players as $x => $x_value) {
            if($x == $winner){
                echo "<br>Updating Winner<br>";
                $sql = "UPDATE Party
                    SET placement = 1, winner = 1
                    WHERE player_ID = $x
                    AND game_ID = $gameID;";
                if (mysqli_query($conn, $sql)) {
                    echo "Record Party Winner updated successfully";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
                $sql = "INSERT INTO Victories (player_ID, victory_ID, game_ID) VALUES ($x,$victory,$gameID)";
                if (mysqli_query($conn, $sql)) {
                    echo "Record Victories upload updated successfully";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

                $sql = "UPDATE Players
                    SET wins = 1 + wins
                    WHERE player_ID = $x;";
                if (mysqli_query($conn, $sql)) {
                    echo "Record Player Wins updated successfully";
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
                WHERE player_ID = $x
                AND game_ID = $gameID;;";
            if (mysqli_query($conn, $sql)) {
                echo "Record Player Placement updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
            $place++;
        }

        if($winner > 0){
            $sql = "SELECT COUNT(game_ID) as games FROM Games where victory_ID > 1;";
            $result = mysqli_query($conn, $sql);
            $totalGames = mysqli_fetch_row($result);
            echo "<br>Updating End Date<br>";
            $today = date("Y-m-d");
            $gameNum = $totalGames[0] + 1;
            $sql = "UPDATE Games
                SET victory_ID = $victory, end_date = '$today', nukes = $nuke, turns = $turns, complete_NO = $gameNum
                WHERE game_ID = $gameID;";
            if (mysqli_query($conn, $sql)) {
                echo "Record End Date updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
    header('location:../dash');
?>