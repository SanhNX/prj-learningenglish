$(document).ready(function() {
    $("#contactList").click(function() {
        synMessage();
    });
    $("#btnSend").click(function() {
        var message = $("#message-input").val();
        var str_string = 'flag=sendMessage&message=' + message;
        var now = new Date();
        $.ajax({
            type: "POST",
            url: "./BLL/messageBll.php",
            data: str_string,
            cache: false,
            success: function(dto) {
                if (dto.trim() == "success"){
                    $("#message-input").val("");

                    var liUser = '<li class="message-item"><div class="message-avt" style="background-image: url()">' +
                        '</div><div class="message-content"><div class="message-info"><span class="message-name">Me</span>' +
                        '<span class="message-time">'+now.format("dd/mm/yy hh:MM TT")+'</span></div>' +
                        '<div class="message-text">'+message+'</div></div></li>';
                    var parent = $(".message-item").parent()[0];
                    $(parent).append(liUser);
                    setTimeout(function(){
                        $("#messageList").mCustomScrollbar("scrollTo","bottom");
                    }, 250);
                } else {
                    alert("fail");
                }
            }
        });
    });


});

function synMessage(){
    var str_string = 'flag=initConversation';
    $.ajax({
        type: "POST",
        url: "./BLL/messageBll.php",
        data: str_string,
        cache: false,
        success: function(dto) {
            $("#messageList").html('');
            if (dto.trim() != ""){
                $("#messageList").html(dto);
                $("#messageCompose").removeClass("undisplayed");
                setTimeout(function(){
                    $("#messageList").mCustomScrollbar({
                        autoHideScrollbar: false,
                        theme: "dark-thin",
                        advanced: {updateOnContentResize: true}
                    });
                    $("#messageList").mCustomScrollbar("scrollTo","bottom");
                },350);
            }
//                else
//                    $("#messageList").html('<span class="mess-no-result">* Not found result matched. Please input another keyword !</span>');

        }
    });
}