$(function () {
    $(".menu-group").each(function () {
        $(this).hover(function () {
            $("#menu-popup").get(0).className = "menu-popup " + (this.id);
            $("#menu-popup").css({overflow:"visible"}).stop().animate({width: 350}, 300);
            $(".menu-popup-form." + this.id+" .menu-popup-list").css({right:350}).animate({right: 0}, 300);

        }, function () {
            $("#menu-popup").css({overflow:"hidden"}).stop().animate({width: 0}, 300,function(){$(this).css({})});
        });

    });
    $("#menu-popup").hover(function () {
        $(this).stop().css({overflow:"visible"}).animate({width: 350}, 300);
    }, function () {
        $(this).stop().css({overflow:"hidden"}).animate({width: 0}, 300,function(){$(this).css({})});
    });
});