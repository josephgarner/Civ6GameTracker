function empty() {
    var GameTitle, Score, Winner, Victor, Turns;
    GameTitle = document.getElementById("GameTitle");
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
                    console.log("Score at 0");
                    return false;
                }else{
                    Score[i].classList.remove("EMPTY");
                }
            }
            if(Turns == '0'){
                Turns.classList.add("EMPTY");
                console.log("No turn number provided");
                return false;
            }else{
                Turns.classList.remove("EMPTY");
            }
            if(GameTitle.value == '' || GameTitle.value == ' '){
                GameTitle.classList.add("EMPTY");
                console.log("No Title Given");
                return false;
            }
            console.log("Completing Game");
            return true;
        }
        else if(Winner[Winner.length-1].checked){
            console.log("No Winner Selected");
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