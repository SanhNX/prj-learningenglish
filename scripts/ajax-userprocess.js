$(document).ready(function () {
    $('#btn-login').on('click', function (e) {

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
            $(".login-loading-spin").removeClass("undisplayed");
            $.ajax({
                type: "POST",
                url: "./BLL/signup_inBll.php",
                data: str_string,
                cache: false,
                success: function (dto) {
                    setTimeout(function () {
                        if (dto === 'success') {
                            $(".login-popup-error-mess").html('<i></i> LOGIN SUCCESSFULL. Please wait a minutes to return page.');
                            setTimeout(function () {
                                $(".login-loading-spin").addClass("undisplayed");
                                $(".login-popup-error-mess").html('');
                                hideLogin();
                                location.reload();
                            }, 3000);
                            return false;
                        }
                        if (dto === 'fail') {
                            $("#email").focus();
                            $(".login-popup-error-mess").html('<i></i> Email or password is not valid');
                            $(".login-loading-spin").addClass("undisplayed");
                            return false;
                        }
                    }, 5000);
                }
            });
        }

        return false;
    });
});

$(document).ready(function () {
    $('#btn-register').on('click', function (e) {
        var email = $("#email").val();
        var cemail = $("#cemail").val();
        var pass = $("#pass").val();
        var cpass = $("#cpass").val();
        var name = $("#name").val();
        var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

        if (name === "") {
//        $("#name").slideToggle('slow');
            $("#name").focus();
            $(".popup-error-mess").html('<i></i> FullName can not blank !');
            return false;
        }
        else if (!email_regex.test(email) || email === "") {
            $("#email").focus();
            $(".popup-error-mess").html('<i></i> Email can not blank and must be valid');
            return false;
        }
        else if (email_regex.test(email)) {
            var str_string_email = 'email=' + email;
            $.ajax({
                type: "POST",
                url: "./BLL/checkemailexistBll.php",
                data: str_string_email,
                async: false,
                cache: false,
                success: function (dto) {
                    if (dto === 'exist') {
                        $("#email").focus();
                        $(".popup-error-mess").html('<i></i> Email is existing. Please choose another email !');
                        return false;
                    }
                    else {
                        if (email !== cemail) {
                            $("#cemail").focus();
                            $(".popup-error-mess").html('<i></i> Confirm Email must be similar with Email');
                            return false;
                        }
                        else if (pass === "" || pass.length < 8) {
                            $("#pass").focus();
                            $(".popup-error-mess").html('<i></i> Password can not blank and larger than 8 character');
                            return false;
                        }
                        else if (cpass === "" || pass !== cpass) {
                            $("#cpass").focus();
                            $(".popup-error-mess").html('<i></i> Confirn Password can not blank and similar with Password');
                            return false;
                        }
                        else {
                            $(".popup-error-mess").html('<i></i> Processes running ............');
                            $(".loading-spin").removeClass("undisplayed");
                            var str_string = 'email=' + email + '&cemail=' + cemail + '&cpass=' + cpass + '&pass=' + pass + '&name=' + name;
                            $.ajax({
                                type: "POST",
                                url: "./BLL/registerBll.php",
                                data: str_string,
                                cache: false,
                                success: function (dto_res) {
                                    setTimeout(function () {
                                        $(".loading-spin").addClass("undisplayed");
                                        if (dto_res === 'true') {
                                            closeRegis();
                                            $(".login-popup-error-mess").html('<i></i> Register success. Login now !');
                                            openLogin();
                                            return false;
                                        }
                                        if (dto_res === 'false') {
                                            $(".popup-error-mess").html('<i></i> Register failed. Please try again !');
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