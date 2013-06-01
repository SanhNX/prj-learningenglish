$(document).ready(function() {
    // today
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var currentDate = '<i class="menu-popup-icon calendar-date" id="currentdateIcon"></i><input readonly="readonly" id="currentdate"  class="date-pick" value="'+ dd + '/' + mm + '/' + yyyy +'">';
    $("#popup-current-ranking-date").html(currentDate);
    var paramdatesearch = yyyy + '-' + mm + '-' + dd;
    getRankingByDate(paramdatesearch, "1");
    
    
    // week 
    // to do start date va end date 
    var startdate = "";
    var endtdate = "";
    
    var showstartdate = "";
    var showendtdate = "";
    
    var dayOfWeek = today.getDay();
    switch(dayOfWeek)
    {
        // sunday
    case 0: 
      var endDate = new Date(today.getTime() - 6 * (24 * 60 * 60 * 1000));
      startdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
      endtdate  = yyyy + '-' + mm + '-' + dd;
      
      showstartdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
      showendtdate = dd + '-' + mm + '-' + yyyy;
              
      break;
      // Monday
    case 1:
        var endDate = new Date(today.getTime() + 6 * (24 * 60 * 60 * 1000));
        
        startdate = yyyy + '-' + mm + '-' + dd;
        endtdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
        
        showstartdate = dd + '-' + mm + '-' + yyyy;
        showendtdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
        break;
      // Tuesday
    case 2:
        var endDate = new Date(today.getTime() - 1 * (24 * 60 * 60 * 1000));
        startdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
        
        var endDate1 = new Date(today.getTime() + 5 * (24 * 60 * 60 * 1000));
        endtdate = endDate1.getFullYear() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getDate();
        
        showstartdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
        showendtdate = endDate1.getDate() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getFullYear();
       
        break;
      // Wednesday
    case 3:
        var endDate = new Date(today.getTime() - 2 * (24 * 60 * 60 * 1000));
        startdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
        
        var endDate1 = new Date(today.getTime() + 4 * (24 * 60 * 60 * 1000));
        endtdate = endDate1.getFullYear() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getDate();
        
        showstartdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
        showendtdate = endDate1.getDate() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getFullYear();
        break;
      // Thursday
    case 4:
        var endDate = new Date(today.getTime() - 3 * (24 * 60 * 60 * 1000));
        startdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
        
        var endDate1 = new Date(today.getTime() + 3 * (24 * 60 * 60 * 1000));
        endtdate = endDate1.getFullYear() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getDate();
        
        showstartdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
        showendtdate = endDate1.getDate() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getFullYear();
        break;
      // Friday
    case 5:
        var endDate = new Date(today.getTime() - 4 * (24 * 60 * 60 * 1000));
        startdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
        
        var endDate1 = new Date(today.getTime() + 2 * (24 * 60 * 60 * 1000));
        endtdate = endDate1.getFullYear() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getDate();
        
        showstartdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
        showendtdate = endDate1.getDate() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getFullYear();
        break;
      // Saturday
    case 6:
        var endDate = new Date(today.getTime() - 5 * (24 * 60 * 60 * 1000));
        startdate = endDate.getFullYear() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getDate();
        
        var endDate1 = new Date(today.getTime() + 1 * (24 * 60 * 60 * 1000));
        endtdate = endDate1.getFullYear() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getDate();
        
        showstartdate = endDate.getDate() + "/" + (endDate.getMonth() + 1) + "/" + endDate.getFullYear();
        showendtdate = endDate1.getDate() + "/" + (endDate1.getMonth() + 1) + "/" + endDate1.getFullYear();
        break;
    }
    //alert(startdate + " - " + endtdate);
    $('#currentweek').val(showstartdate + " - " + showendtdate);
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
                if (dto.trim() != "")
                    $("#popupRankingDate").html(dto);
                else 
                    $("#popupRankingDate").html('<span style="text-align: center;display: block;font-weight: bold;">NOT FOUND</span>');

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
               
                if (dto.trim() != "")
                     $("#popupRankingWeek").html(dto);
                else 
                    $("#popupRankingWeek").html('<span style="text-align: center;display: block;font-weight: bold;">NOT FOUND</span>');
            }
        });
    }

}