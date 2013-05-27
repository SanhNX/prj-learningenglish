$(document).ready(function() {
    $('.metro-item-more').click(function() {
        var page = $("#pagevalue").val();
        var id = $("#idvalue").val();
        var str_string = 'page=' + page + '&id=' + id;
        $.ajax({
            type: "POST",
            url: "./BLL/index-more.php",
            data: str_string,
            cache: false,
            success: function(dto) {
                var currHtml = document.getElementById("listvideo");
                var as = currHtml.innerHTML + dto;
                $("#listvideo").html('');
                $("#listvideo").html(as);
               

            }
        });
    });
});