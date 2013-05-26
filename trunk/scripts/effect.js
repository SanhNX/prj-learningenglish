$(function() {
    $(".menu-group").each(function() {
        $(this).hover(function() {
            blurAllMenu();
            $(this).addClass("hover");
            setMenuHover(this);
            $("#menu-popup").get(0).className = "menu-popup " + (this.id);
            $("#menu-popup").addClass("active");
            $("#menu-popup").css({overflow: "visible"}).stop().animate({width: 350}, 1000, "easeOutQuint");
            $(".menu-popup-form." + this.id + " .menu-popup-list").css({right: 350}).animate({right: 0}, 1100, "easeOutQuint");
        }, function() {
        });

    });

    $("#menu-popup").hover(function() {
        $(this).addClass("active");
        $(this).stop().animate({width: 350});
    }, function() {
        blurAllMenu();
        $(this).stop().animate({width: 0}, "easeOutQuint", function() {
            $(this).removeClass("active");
        });
    });
    $(".form-head-search").hover(function() {
        $(this).stop().animate({width: 400}, 1000, "easeOutQuint");
        $(".search-text").focus();
    }, function() {
        $(this).stop().animate({width: 80}, 1000, "easeOutQuint");
    });
    loadMetroPage();
    $(".popup-back").click(function() {
        hideLogin();
        resetForm();
    });

    $("#login-info-link-register").click(function() {
        $(".popup-form").css({height: "390px"});
        changeLogin("register");
    });
    $("#btnLogin").click(function() {
        $(".popup-form").css({height: "350px"});
        showLogin("login");
    });
    $("#btnRegis").click(function() {
        $(".popup-form").css({height: "390px"});
        showLogin("register");
    });

});
function loadMetroPage() {
    var metroIndex = 0;
    $(".metro-item").each(function() {
        $(this).css({left: 500, opacity: 0}).delay(metroIndex++ * 50).animate({left: 0, opacity: 1}, 2000, "easeOutQuint");

    });

    $(".metro-item").hover(function() {
        $(this).children(".metro-bar").animate({height: 200}, 500, "easeOutQuint");
    }, function() {
        $(this).children(".metro-bar").animate({height: 90}, 500, "easeOutQuint");
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
    $(".menu-item").each(function() {
        $(this).removeClass("hover");
        setMenuBlur(this);
    });
}
function showLogin(id) {
    $(".popup").removeClass("disable");
    $(".popup").css({opacity: 0}).animate({opacity: 1}, 250);
    $(".popup-wrapper").css({opacity: 0});
    $(".popup-form." + id).css({width: 0}).animate({width: "60%"}, 1000, "easeOutQuint");
    $(".popup-form." + id + " .popup-wrapper").delay(300).animate({opacity: 1}, 250);
    $(".popup-form." + id + " .login-info-input").first().focus();
    if (id == "login") {
        $(".register .popup-wrapper").css({display: 'none'});
        $(".login .popup-wrapper").css({display: 'initial'});
    }
    else {
        $(".login .popup-wrapper").css({display: 'none'});
        $(".register .popup-wrapper").css({display: 'initial'});
    }
}
function hideLogin() {
    $(".popup-wrapper").animate({opacity: 0}, 250);
    $(".popup-form").animate({width: 0}, 1000, "easeOutQuint");
    $(".popup").delay(300).animate({opacity: 0}, 250, function() {
        $(".popup").addClass("disable");
    });
}
function changeLogin(id) {
    $(".popup-wrapper").animate({opacity: 0}, 250);
    $(".popup-form").animate({width: 0}, 1000, "easeOutQuint");
    $(".popup").delay(300).animate({opacity: 0.5}, 250, function() {
        showLogin(id);
    });
}
function resetForm() {
    $(".login-info-input")[0].value = "";
    $(".login-info-input")[1].value = "";
    $(".login-info-input")[2].value = "";
    $(".login-info-input")[3].value = "";
    $(".login-info-input")[4].value = "";
    $(".login-info-input")[5].value = "";
    $(".login-info-radio")[0].checked = true;
    $(".login-info-row")[4].className = "login-info-row";
    $(".login-info-row")[5].className = "login-info-row";
    $(".login-info-row")[6].className = "login-info-row";
    $(".login-info-row")[7].className = "login-info-row";
    $(".login-message-content").addClass("undisplayed");
    $(".login-message-footer").addClass("undisplayed");
}
