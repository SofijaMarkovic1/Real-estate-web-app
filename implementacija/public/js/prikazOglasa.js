$(document).ready(function(){
    let slajd = 0;
    let brojSlika = parseInt($("#brojSlika").val());
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

    $("#prev").click(function(){
        $("#" + slajd).removeClass("active");
        slajd = slajd-1;
        if(slajd<0) slajd=brojSlika-1;
        $("#" + slajd).addClass("active");
    });
    $("#next").click(function(){
        $("#" + slajd).removeClass("active");
        slajd = slajd+1;
        if(slajd==brojSlika) slajd=0;
        $("#" + slajd).addClass("active");
    });
    $("#emailButton").on("click", function() {
        var email = $("#mejlProdavca").val();
        var subject = "Zakazivanje posete nekretnini";
        let imeProdavca = $("#imeProdavca").val();
        let imeKorisnika = $("#imeKupca").val();
        let id=$("#opis").val();
        let dateAndTime = $("#datepicker").val().split("T");
        let datum = dateAndTime[0].split("-");

        var body = "Poštovani/a " + imeProdavca + ",\n" + "Želim da zakažem posetu nekretnini " + id + " u terminu " + datum[2] + "." + datum[1] + "." + datum[0] + ". u " + dateAndTime[1] + ".\n" + "Hvala unapred,\n" + imeKorisnika;
        var mailtoLink = "mailto:" + email + "?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
        window.location.href = mailtoLink;
      });
})