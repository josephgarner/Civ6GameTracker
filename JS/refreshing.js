$(document).ready(function () {
    $("#Players").load("PHP/playerList.php");
    $("#newGame_Modal").load("PHP/createGameModal.php");
    var refreshId = setInterval(function () {
        $("#Players").load('PHP/playerList.php');
    }, 30000);
    $.ajaxSetup({
        cache: false
    });
});