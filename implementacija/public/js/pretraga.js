$(document).ready(function(){
    let len= 1;
    let nekretnine = [];
    let srca = document.getElementsByClassName("srce");
    let srcaGost = document.getElementsByClassName("srceGost");
    let kante = document.getElementsByClassName("kanta");
    if(srca.length > 0){
        for(let i = 0; i < srca.length; i++){
            nekretnine.push(srca[i].id);
        }

        for(let i = 0; i < srca.length; i++){
            (function(index) {
                $(srca[i]).click(function () {
                    if ($(srca[i]).attr("src") == "http://localhost:8080/images/srce.png") {
                        $(srca[i]).attr("src", "http://localhost:8080/images/srceFull.png");
                        $("#skinut").css("display", "none");
                        $("#dodat").css("display", "block");
                        setTimeout(function () {
                            $("#dodat").css("display", "none");
                        }, 3000);
                        document.location.replace("/Login/dodajFavorit?id=" + nekretnine[index]);
                    } else {
                        $(srca[i]).attr("src", "http://localhost:8080/images/srce.png");
                        $("#dodat").css("display", "none");
                        $("#skinut").css("display", "block");
                        setTimeout(function () {
                            $("#skinut").css("display", "none");
                        }, 3000);
                        document.location.replace("/Login/ukloniFavorit?id=" + nekretnine[index]);
                    }
                });
            })(i);
        }
    }
    if(srcaGost.length>0){
        for(let i = 0; i < srcaGost.length; i++){
            (function(index) {

                $(srcaGost[i]).click(function () {
                    $("#dodat").css("display", "block");
                    setTimeout(function () {
                        $("#dodat").css("display", "none");
                    }, 3000);
                });

            })(i);
        }
    }
    if(kante.length > 0){
        for(let i = 0; i < kante.length; i++){
            nekretnine.push(kante[i].id);
        }

        for(let i = 0; i < kante.length; i++){
            (function(index) {
                $(kante[i]).click(function () {
                    document.location.replace("/Login/obrisiNekretninu?id=" + nekretnine[index]);
                });
            })(i);
        }
    }


    $("#searchBar").keyup(function (){
        $.ajax({
            url : "get_nekretnine",
            type : "POST",
            data : {
                keyword : $(this).val().length !== 0 ? $(this).val() : ''
            },
            success : function (response){
                $("#oglasi").html(response);
            }
        })
    });


    $("#minCenaHidden").val($("#minCena").val());
    $("#maxCenaHidden").val($("#maxCena").val());
    $("#minKvHidden").val($("#minKvadratura").val());
    $("#maxKvHidden").val($("#maxKvadratura").val());

    $('#minCena').on('input', function() {
        let value = $(this).val();
        $("#minCenaLabela").html("" + value + "€");
        $("#minCenaHidden").val($(this).val());
    });
    $('#maxCena').on('input', function() {
        let value = $(this).val();
        $("#maxCenaLabela").html("" + value + "€");
        $("#maxCenaHidden").val($(this).val());
    });
    $('#minKvadratura').on('input', function() {
        let value = $(this).val();
        $("#minKvadraturaLabela").html("" + value + "€");
        $("#minKvHidden").val($(this).val());
    });
    $('#maxKvadratura').on('input', function() {
        let value = $(this).val();
        $("#maxKvadraturaLabela").html("" + value + "€");
        $("#maxKvHidden").val($(this).val());
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