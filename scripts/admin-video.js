// ------------------------- START Load Iframe Player API --------------------------
// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('admin-player', {
        height: '390',
        width: '640',
//        videoId: 'M7lc1UVf-VE',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
//    event.target.playVideo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
//        setTimeout(stopVideo, 6000);
//        done = true;
    }
}
function stopVideo() {
    player.stopVideo();
}
// ------------------------- END Load Iframe Player API --------------------------
var startTime = 0;
var endTime = 0;
var hintList = [];
var rows = [];
$(document).ready(function() {
    $('#btn-validate').on('click', function(e) {
        var url = $("#url")[0].value;
        var re = /(\?v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/;
        var v = url.match(re)[2];
        $.ajax({
            type: "POST",
            url: "./BLL/getcontentBLL.php",
            data: 'v=' + v,
            cache: false,
            success: function(dto) {
                console.log(JSON.parse(dto));
                this.videoContent = JSON.parse(dto);
                $("#admin-player")[0].src = 'http://www.youtube.com/embed/'+v;
//                player.loadVideoByUrl('http://www.youtube.com/embed/'+v);
                $(".admin-current-time")[0].innerText = formatTime(this.videoContent.length[0]) + ' min';
                $("#admin-video-title")[0].innerText = this.videoContent.title[0];

                $("#admin-video-title").removeClass("undisplayed");
                $("#keyword-panel").removeClass("undisplayed");
                $("#rows-panel").removeClass("undisplayed");
                $("#hints-panel").removeClass("undisplayed");
                $("#hint-title").removeClass("undisplayed");
                $("#tbContent-panel").removeClass("undisplayed");
                $('body,html').animate({
                    scrollTop: 350
                }, 800);
            }
        });
    });
    $('#btn-newRow').on('click', function(e) {
        var str_format = '00:00:00';

        if($("#startTime")[0].value === str_format || $("#endTime")[0].value === str_format || $("#admin-textarea-input")[0].value === '')
            bootbox.alert('• Press <a class="admin-alert-button time"></a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp to get start, end time from video.<br/>• End time must required larger than start time.' +
                '<br/>• Row content can not blank.');
        else {
            var row = {};
            row.start_time = Math.floor(startTime);
            row.end_time = Math.floor(endTime);
            row.caption_text = $("#admin-textarea-input")[0].value;
            rows.push(row);

            var hintTemp = {};
            var j = 1;
            for(var i = 1; i < $(".hint").length; i++){
                if($(".hint")[i].value != '')
                    hintTemp[j] = $(".hint")[i].value;
                else
                    continue;
                j++;
            }
            hintTemp.length = j - 1;
            hintList.push(hintTemp);
            console.log(JSON.stringify(rows));
            console.log(JSON.stringify(hintList));
            var rowHtml = '<tr class="admin-table-row">' +
                '<td class="admin-table-cell">'+formatTime(row.start_time)+'→'+formatTime(row.end_time)+'</td>' +
                '<td class="admin-table-cell-full">' +
                '<span class="table-long-text">'+ row.caption_text +'</span>' +
                '</td>' +
                '<td class="admin-table-cell">' +
                '<input class="admin-table-button edit" type="button" value="Edit">' +
                '<input class="admin-table-button delete" type="button" value="Remove">' +
                '</td>' +
                '</tr>';
            $('tbody')[0].innerHTML += rowHtml;
        }
    });


    $('#btn-clear').on('click', function(e) {
        $('#admin-keyword-input')[0].value = '';
    });
    $('#btn-getStartTime').on('click', function(e) {
        startTime = player.getCurrentTime();
        $('#startTime')[0].value = formatTime(player.getCurrentTime());
    });
    $('#btn-getEndTime').on('click', function(e) {
        endTime = player.getCurrentTime();
        if(endTime < startTime)
            bootbox.alert('End time must required larger than start time. Please get time again ! ');
        else
            $('#endTime')[0].value = formatTime(player.getCurrentTime());
    });

    $('.delete').live('click', function() {
        var arrButtonRemove = $(this);
        var index = arrButtonRemove.index('.delete') + 1;
        bootbox.confirm('Are you sure delete this row ?', function(result) {
            if (result) {
                removeTR(index);
            }
        });
    });

});

function removeTR(pos) {
    $('tr')[pos].remove();
}

function formatTime(start_time) {
    // var time = parseInt(Math.round(t));
    var minute, second;
    var m = parseInt(start_time / 60);
    var s = parseInt(start_time % 60);
    if (m === 0)
        minute = "00";
    else if (m < 10)
        minute = "0" + m;
    else
        minute = m;
    if (s === 0)
        second = "00";
    else if (s < 10)
        second = "0" + s;
    else
        second = s;
    return minute + ":" + second;
}

// ------------------------------ START Progress binding keyword from textare -----------------------
<!--//--><![CDATA[//><!--

$(document).ready(function(){
    // install the event handler for #debug #output
    $('textarea').keyup(update).mousedown(update).mousemove(update).mouseup(update);
});
function update(e) {
    var range = $(this).getSelection();
    if(range.text != ''){
//        console.log('-----------'+range.text);
        this.start = range.start;
        this.end = range.end;
        $('#admin-keyword-input')[0].value = range.text;
    }
}

//--><!]]>

// ------------------------------ END Progress binding keyword from textare -----------------------