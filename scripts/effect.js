$(function () {
    $(".menu-group").each(function () {
        $(this).hover(function () {
            $("#menu-popup").get(0).className = "menu-popup " + (this.id);
            $("#menu-popup").css({overflow: "visible"}).stop().animate({width: 350},1000,"easeOutQuint");
            $(".menu-popup-form." + this.id + " .menu-popup-list").css({right: 350}).animate({right: 0},1000,"easeOutQuint");

        }, function () {
            $("#menu-popup").css({overflow: "hidden"}).stop().animate({width: 0});
        });

    });
    $("#menu-popup").hover(function () {
        $(this).stop().animate({width: 350});
    }, function () {
        $(this).stop().animate({width: 0});
    });
});