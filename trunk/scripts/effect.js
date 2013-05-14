$(function () {
    $(".menu-group").each(function () {
        $(this).hover(function () {
            blurAllMenu();
            $(this).addClass("hover");
            setMenuHover(this);
            $("#menu-popup").get(0).className = "menu-popup " + (this.id);
            $("#menu-popup").addClass("active");
            $("#menu-popup").css({overflow: "visible"}).stop().animate({width: 350}, 1000, "easeOutQuint");
            $(".menu-popup-form." + this.id + " .menu-popup-list").css({right: 350}).animate({right: 0}, 1100, "easeOutQuint");
        }, function () {
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
	loadMetroPage();
	// showLogin();
	$(".login-info-button").click(function(){
		hideLogin();
	});

    $("#btnLogin").click(function(){
        showLogin();
    });
});
function loadMetroPage() {
	var metroIndex=0;
	$(".metro-item").each(function () {
		$(this).css({left:500,opacity:0}).delay(metroIndex++*50).animate({left:0,opacity:1}, 2000, "easeOutQuint");

	});

	$(".metro-item").hover(function () {
		$(this).children(".metro-bar").animate({height:200}, 500, "easeOutQuint");
	},function () {
		$(this).children(".metro-bar").animate({height:90}, 500, "easeOutQuint");
	});
}
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
function showLogin() {
	$(".popup").removeClass("disable");
	$(".popup").css({opacity:0}).animate({opacity:1},250);
	$(".popup-wrapper").css({opacity:0});
	$(".popup-form").css({width:0}).animate({width:"100%"},1000, "easeOutQuint",function(){
		$(".popup-wrapper").animate({opacity:1},250);
	});
}
function hideLogin() {


	$(".popup-wrapper").animate({opacity:0},250);
	$(".popup-form").animate({width:0},1000, "easeOutQuint");
	$(".popup").delay(300).animate({opacity:0},250,function(){
		$(".popup").addClass("disable");
	});
}