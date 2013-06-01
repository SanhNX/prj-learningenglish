$(document).ready(function() {
       reloadCore();
       setInterval("reloadCore()",180000);

});

function reloadCore() {
    $.ajax({
            type: "POST",
            url: "./BLL/index-reload.php",
            cache: false,
            success: function(dto) {
                $(".control-rank-list").html('');
                if (dto.trim() != "")
                    $(".control-rank-list").html(dto);
                else
                    $(".control-rank-list").html('<li class="control-rank-item"> there are currently no participant on this test for the day</li>');
            }
        });
}

function loadMore()
  {
     var page = $("#pagevalue").val();
        var id = $("#idvalue").val();
        var str_string = 'page=' + page + '&id=' + id;
        //location.hash=page;
        $.ajax({
            type: "POST",
            url: "./BLL/index-more.php",
            data: str_string,
            cache: false,
            success: function(dto) {
               //$(".metro-item-more").html('');
               // var removeMore = document.getElementsByClassName("metro-item-more");
                //document.parentNode.removeChild(removeMore);
                //document.getElementById("listvideo").removeChild(document.getElementsByClassName("metro-item-more"));
                $(".metro-item-more").remove();
                var currHtml = document.getElementById("listvideo");
               // currHtml.lastElementChild = null;
                //var currHtml1 = document.removeChild(currHtml.lastElementChild);
                var as = currHtml.innerHTML + dto;
                $("#listvideo").html('');
                $("#listvideo").html(as);
                loadMetroPage();
               

            }
        });
}