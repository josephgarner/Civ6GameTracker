function empty() {
    var GameTitle, Score, Winner, Victor, Turns;
    GameTitle = document.getElementById("GameTitle").value;
    Score = document.getElementsByClassName("ID_Score");
    Winner = document.getElementsByClassName("ID_Winner");
    Victor = document.getElementById("Victor").value;
    Turns = document.getElementById("Turns").value;
    console.log(GameTitle);
    console.log(Score);
    console.log(Winner);
    console.log(Victor);
    console.log(Turns);

    // x = document.getElementById("roll-input").value;
    if (Victor != 1 && !Winner[Winner.length-1].checked) {
        for(var i = 0; i < Score.length; i++){
            if(Score[i].value == 0){
                console.log("Score is 0");
                Score[i].classList.add("EMPTY");
                return false;
            }  
        }
        if(Turns == ''){
            Turns.classList.add("EMPTY");
            console.log("No turn number provided");
            return false;
        }
    }
    if(Victor == 1 && !Winner[Winner.length-1].checked){
        Victor.classList.add("EMPTY");
        return false;
    }
    return false;
}