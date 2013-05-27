$(document).ready(function() {
    $(".search-text").keyup(function() {
        var keyword = $(".search-text").val();
        var str_string = 'keyword=' + keyword;
        $.ajax({
            type: "POST",
            url: "./BLL/search-video.php",
            data: str_string,
            cache: false,
            success: function(dto) {
                $("#listvideo").html('');
                if (dto.trim() != "")
                    $("#listvideo").html(dto);
                else
                    $("#listvideo").html('<span class="mess-no-result">* Not found result matched. Please input another keyword !</span>');

            }
        });
    });
});