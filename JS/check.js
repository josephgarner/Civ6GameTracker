function empty() {
    var GameTitle, Score, Winner, Victor, Turns;
    GameTitle = document.getElementById("GameTitle");
    Defeat = document.getElementsByClassName("JS_Defeat");
    Forfeit = document.getElementsByClassName("JS_Forfeit");
    Score = document.getElementsByClassName("ID_Score");
    Winner = document.getElementsByClassName("ID_Winner");
    Victor = document.getElementById("Victor");
    Turns = document.getElementById("Turns");

    if (Victor.value != 1){
        Victor.classList.remove("EMPTY");
        if(!Winner[Winner.length-1].checked){
            Winner[Winner.length-1].classList.remove("EMPTY");
            for(var i = 0; i < Score.length; i++){
                if(Score[i].value == 0){
                    console.log("Score is 0");
                    Score[i].classList.add("EMPTY");
                    Score[i].focus();
                    console.log("Score at 0");
                    return false;
                }else{
                    Score[i].classList.remove("EMPTY");
                }
            }
            if(Turns.value == '0' || Turns.value == '' || Turns.value == ' '){
                Turns.focus();
                Turns.classList.add("EMPTY");
                console.log("No turn number provided");
                return false;
            }else{
                Turns.classList.remove("EMPTY");
            }
            if(GameTitle.value == '' || GameTitle.value == ' '){
                GameTitle.focus();
                GameTitle.classList.add("EMPTY");
                console.log("No Title Given");
                return false;
            }else{
                for(var i = 0; i < Defeat.length; i++){
                    if(Winner[i].checked && Defeat[i].checked || Winner[i].checked && Forfeit[i].checked){
                        alert("Defeated Player has been selected as winner");
                        return false;
                    }
                }
            }
            console.log("Completing Game");
            return true;
        }
        else if(Winner[Winner.length-1].checked){
            console.log("No Winner Selected");
            alert("You have not chosen a winner");
            Winner[Winner.length-1].classList.add("EMPTY");
            return false;
        }
    }else{
        if(!Winner[Winner.length-1].checked){
            Victor.classList.add("EMPTY");
            return false;
        }else{
            console.log("Updating Game");
            return true;
        }
    }
}

function radioGroup(type,playerID){
    console.log("Checking button");
    if(type == 1){
        if($('#'+playerID+'_forfeit').is(':checked')){
            console.log('#'+playerID+'_forfeit Checked');
            $('#'+playerID+'_defeated').prop('checked', false);
            console.log("Unchecking Defeat");
        }
    }else{
        if($('#'+playerID+'_defeated').is(':checked')){
            console.log('#'+playerID+'_defeated Checked');
            $('#'+playerID+'_forfeit').prop('checked', false);
            console.log("Unchecking Forfeit");
        }
    }
}