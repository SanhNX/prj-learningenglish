function updateUser($id, $status)
  {
        if ($status == 1) {
             var str_string = 'id=' + $id + '&status=0';
        } else {
            var str_string = 'id=' + $id + '&status=1';
        }
        //location.hash=page;
        $.ajax({
            type: "POST",
            url: "./BLL/adminUserBLL.php",
            data: str_string,
            cache: false,
            success: function(dto) {
                var check =dto.substr(0,1);
                var showButton =dto.substr(2,1);
                var id = dto.substr(4,5);
                if (check == 1) {
                    $("#"+id).html('');
                    if (showButton == 1) {
                        var abc = '<input class="admin-button submit" type="button" onclick="updateUser('+id+','+showButton+');" style="height: 34px;" value="Active"/>';
                        $("#"+id).html(abc);
                    } else {
                         var abc = '<input class="admin-button cancel" type="button" onclick="updateUser('+id+','+showButton+');" style="height: 34px;" value="Inactive"/>';
                        $("#"+id).html(abc);
                    }
                } else {
                    alert("Update don't success");
                }
               

            }
        });
}