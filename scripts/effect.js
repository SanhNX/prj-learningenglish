//window.onhashchange = function() {
//    if (location.hash != ""){
//        
//    }
//       
//}
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
			removeCalendar();
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
			removeCalendar();
		});
	});
	$(".metro-item-more").hover(function () {
		$(this).stop().animate({height: 120, backgroundColor: "#062E68"}, 1000, "easeOutQuint");
	}, function () {
		$(this).stop().animate({height: 80, backgroundColor: "#0046A9"}, 1000, "easeOutQuint");
	});
	$(".form-head-search").hover(function () {
		$(this).stop().animate({width: 400}, 1000, "easeOutQuint");
		$(".search-text").focus();
	}, function () {
		$(this).stop().animate({width: 80}, 1000, "easeOutQuint");
	});
	loadMetroPage();
	$(".popup-back").click(function () {
		hideLogin();
		resetForm();
	});

	$("#login-info-link-register").click(function () {
		$(".popup-form").css({height: "410px"});
		changeLogin("register");
	});
	$("#btnLogin").click(function () {
		$(".popup-form").css({height: "350px"});
		showLogin("login");
	});
	$("#btnRegis").click(function () {
		$(".popup-form").css({height: "410px"});
		showLogin("register");
	});
	resetCalendarDate();
        resetCalendarWeek();
	initScrollBar();
});
var fbUserData = null;
function getFbUserData(callback) {
	callback = callback || function () {
	};
	if (fbUserData == null) {
		FB.api('/me', function (response) {
			if (!response || response.error) {
				console.log('error get user data');
				console.log(response);
			} else {
				fbUserData = response;
				callback();
			}
		});
	}
	return fbUserData;

}
function onFacebookReady() {
	if (video != null) {
		postPlay(video);
	}
}
function postPlay(video) {
	FB.api(
		'me/listentomeapp:play',
		'post',
		{
			other: video.website_url,
			score: 1000,
			title: video.title
		},
		function (response) {
			// handle the response
			console.log(response);
		}
	);
}
(function (d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id))
		return;
	js = d.createElement(s);
	js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
function loadMetroPage() {
	var metroIndex = 0;
	$(".metro-item").each(function () {
		$(this).css({left: 500, opacity: 0}).delay(metroIndex++ * 50).animate({left: 0, opacity: 1}, 2000, "easeOutQuint");
	});
	resetMetroHover();
}
function resetMetroHover() {
	$(".metro-item").hover(function () {
		$(this).children(".metro-bar").animate({height: 200}, 500, "easeOutQuint");
	}, function () {
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
	$(".menu-item").each(function () {
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
	$(".popup").delay(300).animate({opacity: 0}, 250, function () {
		$(".popup").addClass("disable");
	});
}
function changeLogin(id) {
	$(".popup-wrapper").animate({opacity: 0}, 250);
	$(".popup-form").animate({width: 0}, 1000, "easeOutQuint");
	$(".popup").delay(300).animate({opacity: 0.5}, 250, function () {
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

function resetCalendarDate() {
	setTimeout(function () {
		$('.date-pick').datePicker({
			closeOnSelect: true,
			startDate: "1/1/1980",
			onSelect: function (value) {
				//alert(value.getDate()+"/"+(value.getMonth()+1)+"/"+value.getFullYear());
                                var param1 = value.getFullYear()+"/"+(value.getMonth()+1)+"/"+value.getDate();
                                getRankingByDate(param1, "1");
			},
			showYearNavigation: true, startDate: "1/1/1980"});
	}, 1500);
}

function resetCalendarWeek() {
	setTimeout(function () {
		$('.date-pick.week').datePicker({selectWeek: true,
			closeOnSelect: true,
			startDate: "1/1/1980",
			onSelect: function (value) {
				var endDate = new Date(value.getTime() + 6 * (24 * 60 * 60 * 1000));
				var date = value.getDate() + "/" + (value.getMonth() + 1) + "/" + value.getFullYear();
				var sdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
				$('.date-pick.week').val(date + " - " + sdate);
                                var param1 = value.getFullYear()+"/"+(value.getMonth()+1)+"/"+value.getDate();
                                var param2 = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
                                getRankingByDate(param1, param2);
			}
		});
	}, 1500);
}

function removeCalendar() {
	$('#dp-popup').remove(false);
}

function readURL(input, thumbimage) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$("#thumbimage").attr('src', e.target.result);
//            $("#thumbimage").css({background: "url('"+e.target.result+"') no-repeat center"});
		}
		reader.readAsDataURL(input.files[0]);
		$("#thumbimage").show();
	}
	else {
		$("#thumbimage").attr('src', input.value);
		$("#thumbimage").show();
	}
	$(".removeimg").show();
}
function initScrollBar() {
	$(window).load(function () {
		$(".control-rank-list").mCustomScrollbar({
			autoHideScrollbar: true,
			theme: "light-thin"
		});
		$(".play-exam").mCustomScrollbar({
			theme: "light-thin"
		});
	});
}