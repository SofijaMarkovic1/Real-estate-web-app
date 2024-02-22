$(document).ready(function(){
    for(let i=1; i<=12; i++){
        $("#srce" + i).click(function(){
            if($("#srce" + i).attr("src")=="images/srce.png"){
                $("#srce" + i).attr("src", "images/srceFull.png");
                $("#skinut").css("display", "none");
                $("#dodat").css("display", "block");
                setTimeout(function(){
                    $("#dodat").css("display", "none");
                }, 3000);
            }
            else {
                $("#srce" + i).attr("src", "images/srce.png");
                $("#dodat").css("display", "none");
                $("#skinut").css("display", "block");
                setTimeout(function(){
                    $("#skinut").css("display", "none");
                }, 3000);
            }
            
        });
    }
    $('#minCena').on('input', function() {
        let value = $(this).val();
        $("#minCenaLabela").html("" + value + "€");
    });
    $('#maxCena').on('input', function() {
        let value = $(this).val();
        $("#maxCenaLabela").html("" + value + "€");
    });
    $('#minKvadratura').on('input', function() {
        let value = $(this).val();
        $("#minKvadraturaLabela").html("" + value + "€");
    });
    $('#maxKvadratura').on('input', function() {
        let value = $(this).val();
        $("#maxKvadraturaLabela").html("" + value + "€");
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
    $("#minCenaLabela").html("" + $('#minCena').val() + "€");
    $("#maxCenaLabela").html("" + $('#maxCena').val() + "€");
    $("#minKvadraturaLabela").html("" + $('#minKvadratura').val() + "m2");
    $("#maxKvadraturaLabela").html("" + $('#maxKvadratura').val() + "m2");
});