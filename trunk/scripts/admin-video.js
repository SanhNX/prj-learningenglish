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
                $(".admin-current-time")[0].innerText = formatTime(this.videoContent.length[0]);
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

});

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