$(document).ready(function() {
    $("#contactList").click(function() {
        var str_string = '';
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
                    },250);
                    $("#messageList").mCustomScrollbar("scrollTo","bottom");
                }
//                else
//                    $("#messageList").html('<span class="mess-no-result">* Not found result matched. Please input another keyword !</span>');
                
            }
        });
    });
});