$(document).ready(function(){
    var tagovi = []
    $("#dodajTag").click(function(){
        if(tagovi.includes($("#tag").val())) return;
        tagovi.push($("#tag").val());
        let string = "";
        for(let i=0; i<tagovi.length-1;i++){
            string += tagovi[i] + ", ";
        }
        string += tagovi[tagovi.length-1];
        $("#tagovi").html(string);
    });
    $("#ukloniTag").click(function(){
        alert("tu sam");
        if(tagovi.includes($("#tag").val())){
            tagovi = tagovi.filter(item => item !== $("#tag").val());
            let string = "";
            if(tagovi.length>0){
                for(let i=0; i<tagovi.length-1;i++){
                    string += tagovi[i] + ", ";
                }
                string += tagovi[tagovi.length-1];
            }
            $("#tagovi").html(string);
        }
    });
    $('.dropdown-toggle').mouseenter(function() {
        var dropdown = $('#menuD');
        dropdown.css('display', "block");
        $(this).attr('aria-expanded', 'true');
    });
    $('#menuD').mouseleave(function() {
        var dropdown = $('#menuD');
        dropdown.css('display', "none");
        $(this).attr('aria-expanded', 'true');
    });
    $('#izmeni').click(function() {
        document.location.href="izmeniPodatke.html";
        return;
    });
    $('#odjavi').click(function() {
        document.location.href="login.html";
        return;
    });
    $('#odustani').click(function() {
        document.location.href="mojProfil.html";
        return;
    });
    $('#potvrdi').click(function() {
        document.location.href="mojProfil.html";
        return;
    });
});