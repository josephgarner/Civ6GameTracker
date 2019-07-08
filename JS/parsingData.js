function winGame(event){
    event.preventDefault();
    var data = $('#addNewPlayer').serialize();
    $.post('PHP/addnewplayer.php', data);
    // $("#Players").load("PHP/playerList.php");
}

function updateCiv(event, playerID, partyID){
    event.preventDefault();
    data = "playerID="+playerID+"&partyID="+partyID;
    console.log(data);
    $form = $form = $("<form></form>");
    $form.append('<span>Player: <span><input type="text" value='+playerID+' name="playerID" disabled>');

    $.post('PHP/gamesData.php', data);
    $("#CompleteGameModal").load("PHP/updateCiv.php");
}