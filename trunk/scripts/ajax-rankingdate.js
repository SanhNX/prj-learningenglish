$(document).ready(function() {
    // today
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    var currentDate = '<i class="menu-popup-icon calendar-date"></i>\n\<span>' + mm + '/' + dd + '/' + yyyy + '</span>\n\<input id="currentdate" value="' + yyyy + '-' + mm + '-' + dd + '" type="hidden">';

    $("#popup-current-ranking-date").html(currentDate);

    var paramdatesearch = yyyy + '-' + mm + '-' + dd;
    getRankingByDate(paramdatesearch, "1");

    $('.menu-popup-calendar-prev').click(function() {
    });


    // week

    // to do start date va end date
    var startdate = "2013-01-13";
    var endtdate = "2013-05-26";
    getRankingByDate(startdate, endtdate);
});
function getRankingByDate($paramDate1, $paramDate2) {
    var str_string = 'date1=' + $paramDate1 + '&date2=' + $paramDate2;
    if ($paramDate2 == 1) {
        $.ajax({
            type: "POST",
            url: "./BLL/rankingDateBLL.php",
            data: str_string,
            cache: false,
            success: function(dto) {
                $("#popupRankingDate").html('');
                $("#popupRankingDate").html(dto);


            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "./BLL/rankingDateBLL.php",
            data: str_string,
            cache: false,
            success: function(dto) {
                $("#popupRankingWeek").html('');
                $("#popupRankingWeek").html(dto);
            }
        });
    }

}