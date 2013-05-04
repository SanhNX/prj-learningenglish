$(function () {
    $(".menu-item").each(function () {
        $(this).hover(function () {
            blurAllMenu();
            $(this).addClass("hover");
            setMenuHover(this);
            $("#menu-popup").get(0).className = "menu-popup " + (this.id);
            $("#menu-popup").addClass("active");
            $("#menu-popup").css({overflow: "visible"}).stop().animate({width: 350}, 1000, "easeOutQuint");
            $(".menu-popup-form." + this.id + " .menu-popup-list").css({right: 350}).animate({right: 0}, 1100, "easeOutQuint");
        }, function () {

//            $(this).removeClass("hover");
//            setMenuBlur(this);
//            $("#menu-popup").css({overflow: "hidden"}).stop().animate({width: 0}, "easeOutQuint", function () {
//                $(this).removeClass("active");
//            });
        });

    });
    $("#menu-popup").hover(function () {
        $(this).addClass("active");
        $(this).stop().animate({width: 350});
    }, function () {
        blurAllMenu();
        $(this).stop().animate({width: 0}, "easeOutQuint", function () {
            $(this).removeClass("active");
        });
    });
    var metroIndex=0;
    $(".metro-item").each(function () {
        $(this).css({left:500,opacity:0}).delay(metroIndex++*50).animate({left:0,opacity:1}, 2000, "easeOutQuint");

    });
    $(".metro-item").hover(function () {
        $(this).children(".metro-bar").animate({height:200}, 500, "easeOutQuint");
    },function () {
        $(this).children(".metro-bar").animate({height:90}, 500, "easeOutQuint");
    });
});
function setMenuHover(item) {
    $(item).children(".menu-arrow").stop().animate({right: 0}, 200);
    $(item).stop().animate({backgroundColor: "#222222"}, 200);

}
function setMenuBlur(item) {
    $(item).children(".menu-arrow").stop().animate({right: -20}, 200);
    $(item).stop().animate({backgroundColor: "#111111"}, 200);

}
function blurAllMenu() {
    $(".menu-item").each(function () {
        $(this).removeClass("hover");
        setMenuBlur(this);
    });
}
