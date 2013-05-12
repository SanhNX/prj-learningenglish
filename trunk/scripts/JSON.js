$(document).ready(function() {
    $.getJSON('data-video/1.json',function(data){
        var html = "";
        for(var i = 0; i < data.rows.length; i++){
            // var row = '<div class="captionItem" id="captionItem-'+ (i+1) +'" data-number="' + i + '" data-start="' + data.rows[i].start_time + '" data-end="' + data.rows[i].end_time + '">'+
            //             '<input type="hidden" class="timeValue" value="00:00:06,860 --&gt; 00:00:08,369">'+
            //             '<input type="hidden" class="startTime" value="' + data.rows[i].start_time + '">'+
            //             '<input type="hidden" class="endTime" value="' + data.rows[i].end_time + '">'+
            //             '<a class="hand">'+
            //                     '<i class="select icon-hand-right"></i>'+
            //                     '<i class="play icon-play" style="display:none;"></i>'+
            //                     '<span class="captionTime">00:0'+ data.rows[i].start_time +'</span>'+
            //             '</a><div class="captionText" style="width: 555px;">' + data.rows[i].caption_text + '</div></div>';
            var row = '<div class="play-exam-item" id="captionItem-'+ (i+1) +'" data-number="' + i + '" data-start="' + data.rows[i].start_time + '" data-end="' + data.rows[i].end_time + '">'+
                            '<input type="hidden" class="timeValue" value="00:00:06,860 --&gt; 00:00:08,369">'+
                            '<input type="hidden" class="startTime" value="' + data.rows[i].start_time + '">'+
                            '<input type="hidden" class="endTime" value="' + data.rows[i].end_time + '">'+
                            '<a class="play-exam-tag" title="click to seek">'+
                                '<span class="caption-time">00:0'+ data.rows[i].start_time +'</span>'+
                            '</a>'+
                            '<div class="play-exam-text">' + data.rows[i].caption_text + '</div>'+
                        '</div>';
                html += row;
        }
        $(".play-exam-list").append(html);
        $('.play-exam-answer:eq(0)').focus();
    });
    
function formatTime(t){
    var time = parseInt(Math.round(t));
    if(time > 59)
        return "";
}
});