$(document).ready(function() {
    $('#btn-login').on('click', function(e) {

        var email = $("#txtemail").val();
        var pass = $("#txtpass").val();
        var str_string = 'txtemail=' + email + '&txtpass=' + pass;
        var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

        if (!email_regex.test(email) || email === "") {
            $("#txtemail").focus();
            $(".login-popup-error-mess").html('<i></i> Email can not blank and must be valid');
            return false;
        }
        else if (pass === "") {
            $("#txtpass").focus();
            $(".login-popup-error-mess").html('<i></i> Password can not blank !');
            return false;
        }
        else if (email_regex.test(email)) {
            $(".login-popup-error-mess").html('<i></i> Processes running ............');
            $(".popup-progress").removeClass("undisplayed");
            $.ajax({
                type: "POST",
                url: "./BLL/signup_inBll.php",
                data: str_string,
                cache: false,
                success: function(dto) {
                    setTimeout(function() {
                        if (dto === 'success') {
                            $(".login-popup-error-mess").html('<i></i> LOGIN SUCCESSFULL. Please wait a minutes to return page.');
                            setTimeout(function() {
                                $(".popup-progress").addClass("undisplayed");
                                $(".login-popup-error-mess").html('');
                                hideLogin();
                                location.reload();
                            }, 3000);
                            return false;
                        }
                        if (dto === 'fail') {
                            $("#email").focus();
                            $(".login-popup-error-mess").html('<i></i> Email or password is not valid');
                            $(".popup-progress").addClass("undisplayed");
                            return false;
                        }
                    }, 5000);
                }
            });
        }

        return false;
    });
});

$(document).ready(function() {
    $('#btn-register').on('click', function(e) {
        var email = $("#email").val();
        var cemail = $("#cemail").val();
        var pass = $("#pass").val();
        var cpass = $("#cpass").val();
        var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
        var errString = "----- Occurs error in registration process -----<br/>";
        var err1 = "- Email can not blank and must be valid</br>";
        var err2 = "- Email is existing. Please choose another email</br>";
        var err3 = "- Confirm Email must be similar with Email</br>";
        var err4 = "- Password can not blank and larger than 8 character</br>";
        var err5 = "- Confirn Password can not blank and similar with Password</br>";
        var err6 = "- Processes running ............";
        if (!email_regex.test(email) || email === "") {
            $("#email").focus();
            $(".login-info-row")[4].className = "login-info-row error";
            $(".login-message-content").removeClass("undisplayed");
            $(".login-message-footer").removeClass("undisplayed");
            $(".login-message-content").html(errString + err1);
            return false;
        }
        else if (email_regex.test(email)) {
            $(".login-info-row")[4].className = "login-info-row ok";
            var str_string_email = 'email=' + email;
            $.ajax({
                type: "POST",
                url: "./BLL/checkemailexistBll.php",
                data: str_string_email,
                async: false,
                cache: false,
                success: function(dto) {
                    if (dto === 'exist') {
                        $("#email").focus();
                        $(".login-info-row")[4].className = "login-info-row error";
                        $(".login-message-content").removeClass("undisplayed");
                        $(".login-message-footer").removeClass("undisplayed");
                        $(".login-message-content").html(errString + err2);
                        return false;
                    }
                    else {
                        $(".login-info-row")[4].className = "login-info-row ok";
                        if (email !== cemail) {
                            $("#cemail").focus();
                            $(".login-info-row")[5].className = "login-info-row error";
                            $(".login-message-content").removeClass("undisplayed");
                            $(".login-message-footer").removeClass("undisplayed");
                            $(".login-message-content").html(errString + err3);
                            return false;
                        }
                        else if (pass === "" || pass.length < 8) {
                            $(".login-info-row")[5].className = "login-info-row ok";
                            $("#pass").focus();
                            $(".login-info-row")[6].className = "login-info-row error";
                            $(".login-message-content").removeClass("undisplayed");
                            $(".login-message-footer").removeClass("undisplayed");
                            $(".login-message-content").html(errString + err4);
                            return false;
                        }
                        else if (cpass === "" || pass !== cpass) {
                            $(".login-info-row")[6].className = "login-info-row ok";
                            $("#cpass").focus();
                            $(".login-info-row")[7].className = "login-info-row error";
                            $(".login-message-content").removeClass("undisplayed");
                            $(".login-message-footer").removeClass("undisplayed");
                            $(".login-message-content").html(errString + err5);
                            return false;
                        }
                        else {
                            $(".login-message-content").addClass("undisplayed");
                            $(".login-info-row")[5].className = "login-info-row ok";
                            $(".login-info-row")[6].className = "login-info-row ok";
                            $(".login-info-row")[7].className = "login-info-row ok";
                            $(".login-message-content").removeClass("undisplayed");
                            $(".login-message-footer").removeClass("undisplayed");
                            $(".login-message-content").html(err6);
                            $(".popup-progress").removeClass("undisplayed");
                            var gender = 1;
                            if($(".login-info-radio")[1].checked === true)
                                gender = 0;
                            var avatar = "images/resource/avt1.jpg";
                            var str_string = 'email=' + email + '&pass=' + pass + '&avatar=' + avatar + '&gender=' + gender;
//                            alert(str_string);
                            $.ajax({
                                type: "POST",
                                url: "./BLL/registerBll.php",
                                data: str_string,
                                cache: false,
                                success: function(dto_res) {
                                    setTimeout(function() {
                                        $(".popup-progress").addClass("undisplayed");
                                        if (dto_res === 'true') {
                                            hideLogin();
                                            $(".login-popup-error-mess").html("<i></i> Register success. Login now !");
                                            changeLogin("login");
                                            return false;
                                        }
                                        if (dto_res === 'false') {
                                            $(".login-message-content").html("- Register failed. Please try again !");
                                            return false;
                                        }
                                    }, 5000);
                                }
                            });
                        }
                    }
                }
            });
        }

        return false;
    });
});