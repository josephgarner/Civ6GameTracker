$(document).ready(function () {
    $("#Players").load("PHP/playerList.php");
    $("#newGame_Modal").load("PHP/createGameModal.php");
    $("#Finished_Games").load("PHP/finishedGames.php");
    $("#Games").load("PHP/gamesData.php");
    var refreshId = setInterval(function () {
        $("#Players").load('PHP/playerList.php');
        $("#Finished_Games").load("PHP/finishedGames.php");
        $("#Games").load("PHP/gamesData.php");
    }, 240000);
    $.ajaxSetup({
        cache: false
    });
});