$(document).ready(function(){
    function prijaviSe(){
        document.location.href = "index.html";
        return;
    }
    let active=1;
    setInterval(function(){
        $("#" + active).removeClass("active");
        active = active % 3 + 1;
        $("#" + active).addClass("active");
    }, 5000);
    $("#prev").click(function(){
        $("#" + active).removeClass("active");
        active = active-1;
        if(active==0) active=3;
        $("#" + active).addClass("active");
    });
    $("#next").click(function(){
        $("#" + active).removeClass("active");
        active = active % 3 + 1;
        $("#" + active).addClass("active");
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

    var element = $('#carousel');
  
    var topOffset = element.offset().top;
    var leftOffset = element.offset().left;

    $("#transparent-window").css("top", topOffset+450).css("left", leftOffset+50);
});