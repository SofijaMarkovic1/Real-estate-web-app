$(document).ready(function(){
    $(".predlogCene").click(function (){
        $grad = document.getElementById("poljeZaGrad").value;
        if($grad == ""){
            $("#predlogCenePolje").css("color", "red").html("Morate uneti vrednost za polje grad.");
            return;
        }
        window.location.replace("http://localhost:8080/Login/predlogCene?grad=" + $grad);
        return;
    })
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
        window.location.replace("http://localhost:8080/Login/izmeniPodatke");
        return;
    });
    $('#odjavi').click(function() {
        window.location.replace("http://localhost:8080/Login/odjaviSe");
        return;
    });
    $('#odustani').click(function() {
        window.location.replace("http://localhost:8080/Login/mojProfil");
        return;
    });
    $('#potvrdi').click(function() {
        window.location.replace("http://localhost:8080/Login/mojProfil");
        return;
    });

});