$(document).ready(function() {
    $('#btn-admin-logout').on('click', function(e) {
        var r = confirm("Do you really want to log out ?");
        if (r === true) {
            if(FB)
                FB.logout();
            $.post("./BLL/adminUnAuthorizeBLL.php", function(resp) {
                if (resp === "success") {
                    alert("Logout Success !");
                    location.reload();
                }
            });
        }
    });

    $('#btn-admin-login').on('click', function(e) {

        var email = $("#txtemail").val();
        var pass = $("#txtpass").val();
        var str_string = 'txtemail=' + email + '&txtpass=' + pass;
        var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

        if (!email_regex.test(email) || email === "" || pass === "") {
            $("#txtemail").focus();
            bootbox.alert('<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp• Email and password can not blank</a><br/>' +
                        '<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  And Email must be valid with format</a><br/>' +
                        '<br/><a style="color: rgb(64, 92, 96)">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspExample : example@mail.com</a>', function(){
                setTimeout(function(){
                    $(".modal")[0].style.width = '655px';
                    $(".modal")[0].style.left = '40%';
                },300);
            });
            $(".modal")[0].style.width = '500px';
            $(".modal")[0].style.left = '52%';

            return false;
        }
        else if (email_regex.test(email)) {
            $(".admin-progress").removeClass("undisplayed");
            $.ajax({
                type: "POST",
                url: "./BLL/adminAuthorizeBLL.php",
                data: str_string,
                cache: false,
                success: function(dto) {
                    setTimeout(function() {
                        if (dto === 'success') {
                            setTimeout(function() {
                                $(".admin-progress").addClass("undisplayed");
                                bootbox.alert('<br/><a style="color: rgb(64, 92, 96)">&nbsp&nbsp&nbsp&nbspCongratulation ! You had login success.</a>', function(){
                                    setTimeout(function(){
                                        $(".modal")[0].style.width = '655px';
                                        $(".modal")[0].style.left = '40%';
                                        window.location.href = 'admin-video.php';
                                    },300);
                                });
                                $(".modal")[0].style.width = '500px';
                                $(".modal")[0].style.left = '52%';
                            }, 3000);
                            return false;
                        }
                        if (dto === 'fail') {
                            setTimeout(function() {
                                $(".admin-progress").addClass("undisplayed");
                                bootbox.alert('<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbspSorry ! You had login fail.</a>' +
                                    '<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbspPlease try again .</a>', function(){
                                    setTimeout(function(){
                                        $(".modal")[0].style.width = '655px';
                                        $(".modal")[0].style.left = '40%';
                                        $("#email").focus();
                                    },300);
                                });
                                $(".modal")[0].style.width = '500px';
                                $(".modal")[0].style.left = '52%';
                            }, 1000);
                            return false;
                        }
                    }, 4000);
                }
            });
        }

        return false;
    });
});