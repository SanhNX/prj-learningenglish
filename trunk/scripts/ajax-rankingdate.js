$(document).ready(function() {
    // today
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var currentDate = '<i class="menu-popup-icon calendar-date" id="currentdateIcon"></i><input id="currentdate"  class="date-pick" value="' + yyyy + '-' + mm + '-' + dd + '">';
    $("#popup-current-ranking-date").html(currentDate);
    var paramdatesearch = yyyy + '-' + mm + '-' + dd;
    getRankingByDate(paramdatesearch, "1");
    // week

    // to do start date va end date
    var startdate = "2013-01-13";
    var endtdate = "2013-05-26";
    getRankingByDate(startdate, endtdate);
    
    
    
    
    // change date
    $('#currentdateIcon').focus(function() {
        alert("asdasd");
    });

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