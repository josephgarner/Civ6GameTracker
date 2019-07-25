$civs = [];
$leaders = [];

function setArrs(civs, leaders){
    $civs = civs;
    $leaders = leaders;
}

function loadLeader(player){
    var id = "#"+player+"CIV";
    var id_Leader = "#"+player+"LEADER";
    var selectedCiv = $(id).children("option:selected").val();
    var select = $(id_Leader);
    if(selectedCiv != 0){
        select.find('option').remove().end()
        $.each($leaders, function(index, value){
            if(value == selectedCiv){
                select.append('<option>'+index+'</option>').val(index);
            }
        });
    }
    else{
        select.find('option').remove().end()
        select.append('<option>Unkown</option>').val(0);
    }
}