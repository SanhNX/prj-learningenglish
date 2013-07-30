var friendid = null;
$(document).ready(function() {
    $("#contactList").click(function() {
//        synMessage();
    });
    $("#btnSyn").click(function() {
        if(friendid != null)
            synMessage(friendid);
        else
            bootbox.alert("Please choose a friend in friend list to begin send message.");
    });

    $('#message-input').keypress(function(event) {
        if (event.keyCode == '13') {
            if(friendid != null)
                sendMessage();
            else {
                $("#noConversation").removeClass("undisplayed");
                bootbox.alert("Please choose a friend in friend list to begin send message.");
            }
        }
    });

    $('.friend-item').live('click', function(e){
        var index = $(this).index('.friend-item');
        var nodeId = $('.friend-item')[index].getAttribute("id");
        friendid = $('#id' + nodeId).val();
        synMessage(friendid);
    });
    $('#btnReload').live('click', function(e){
        getDataUserFollow();
    });

});
//var interval;
window.onload=function(){
    getAllFriend();
    getDataUserFollow();
//    interval = setInterval(getDataUserFollow,10000);
};

function getDataUserFollow() {
    var str_string = 'flag=getDataUserFollow';
    $.ajax({
        type: "POST",
        url: "./BLL/followFriendBll.php",
        data: str_string,
        cache: false,
        success: function(dto) {
            $("#contactList").html('');
            if (dto.trim() != ""){
                $("#contactList").html(dto);
                $("#contactList").mCustomScrollbar({
                    autoHideScrollbar: false,
                    theme: "dark-thin",
                    advanced: {updateOnContentResize: true}
                });
            }
//                else
//                    $("#messageList").html('<span class="mess-no-result">* Not found result matched. Please input another keyword !</span>');

        }
    });
}

function getAllFriend() {
    var str_string = 'flag=getAllFriend';
    $.ajax({
        type: "POST",
        url: "./BLL/friendListBll.php",
        data: str_string,
        cache: false,
        success: function(dto) {
            $("#friend-list").html('');
            if (dto.trim() != ""){
                $("#friend-list").html(dto);
                setTimeout(function(){
                    $("#friend-list").mCustomScrollbar({
                        autoHideScrollbar: false,
                        theme: "dark-thin",
                        advanced: {updateOnContentResize: true}
                    });
                },350);
            }
//                else
//                    $("#messageList").html('<span class="mess-no-result">* Not found result matched. Please input another keyword !</span>');

        }
    });
}

function sendMessage() {
    if($("#message-input").val().trim() != ""){
        var message = $("#message-input").val();
        var str_string = 'flag=sendMessage&friendid='+friendid+'&message=' + message;
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
    } else {
        return;
    }
}



function synMessage(friendid){

    var str_string = 'flag=initConversation&friendid='+friendid;
    $.ajax({
        type: "POST",
        url: "./BLL/messageBll.php",
        data: str_string,
        cache: false,
        success: function(dto) {
            $("#messageList").html('');
            $(".noConversation").addClass("undisplayed");
            if (dto.trim() != ""){
                $("#messageList").html(dto);
//                $("#messageCompose").removeClass("undisplayed");
                $(".noMessage").addClass("undisplayed");
                setTimeout(function(){
                    $("#messageList").mCustomScrollbar({
                        autoHideScrollbar: false,
                        theme: "dark-thin",
                        advanced: {updateOnContentResize: true}
                    });
                    $("#messageList").mCustomScrollbar("scrollTo","bottom");
                },350);
            } else {
                $(".noMessage").removeClass("undisplayed");
//                $("#messageCompose").addClass("undisplayed");
            }

        }
    });
}