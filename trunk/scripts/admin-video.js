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
var v = null;
var jsonSTR = '';
var startTime = 0;
var endTime = 0;
var hintList = [];
var rows = [];
var answers = {};
var index = 1;
var timeList = {};
var indexTimeList = 1;
var duration = null;
var title = '';
$(document).ready(function() {
    $('#btn-validate').on('click', function(e) {
        var url = $("#url")[0].value;
        var re = /(\?v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/;
        if(!url.match(re)){
            bootbox.alert('<a style="color: #ff0000">♦ URL is not match with format list.</a><br/>' +
                '<br/><a style="color: blue">Suggest :</a>' +
                '<br/><a style="color: blue">• http://www.youtube.com/watch?v=0zM3nApSvMg&feature=feedrec_grec_index</a>' +
                '<br/><a style="color: blue">• http://www.youtube.com/user/IngridMichaelsonVEVO#p/a/u/1/QdK8U-VIH_o</a>' +
                '<br/><a style="color: blue">• http://www.youtube.com/v/0zM3nApSvMg?fs=1&amp;hl=en_US&amp;rel=0</a>' +
                '<br/><a style="color: blue">• http://www.youtube.com/watch?v=0zM3nApSvMg#t=0m10s</a>' +
                '<br/><a style="color: blue">• http://www.youtube.com/embed/0zM3nApSvMg?rel=0</a>' +
                '<br/><a style="color: blue">• http://www.youtube.com/watch?v=0zM3nApSvMg</a>' +
                '<br/><a style="color: blue">• http://youtu.be/0zM3nApSvMg</a>');
            return;
        } else {
            v = url.match(re)[2];
        }
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
                duration = formatTime(this.videoContent.length[0]);
                $(".admin-current-time")[0].innerText = duration + ' min';
                title = this.videoContent.title[0];
                $("#admin-video-title")[0].innerText = title;

                $("#admin-video-title").removeClass("undisplayed");
                $("#keyword-panel").removeClass("undisplayed");
                $("#rows-panel").removeClass("undisplayed");
                $("#hints-panel").removeClass("undisplayed");
                $("#hint-title").removeClass("undisplayed");
                $("#tbContent-panel").removeClass("undisplayed");
                $(".admin-table-foot").addClass("undisplayed");
                $("#btn-save").removeClass('undisplayed');
                $("#btn-edit").addClass('undisplayed');
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

            var answer = $("#admin-keyword-input")[0].value;
            if(answer.length > 0 && row.caption_text.match(answer)){
                var hintTemp = {};
                var j = 1;
                for(var i = 1; i < $(".hint").length; i++){
                    if($(".hint")[i].value != ''){
                        hintTemp[j] = $(".hint")[i].value;
                        j++;
                    }
                    else
                        continue;
                }
                if(j != 1){
                    row.caption_text = row.caption_text.replace(answer, "<input class='play-exam-answer' type='text' value='"+answer +"' name='answer[]' readonly='true'>");
                    answers[index] = answer;
                    answers.length = index;
                    index++;
                    hintTemp.length = j - 1;
                    hintList.push(hintTemp);
                }
                else{
                    bootbox.alert('If this row have keyword, please fill some hint item !');
                    return;
                }
            }
            timeList[indexTimeList] = Math.floor(startTime);
            timeList.length = indexTimeList;
            indexTimeList++;
            rows.push(row);
            resetAllInput();
            $(".admin-table-foot").removeClass("undisplayed");
//            console.log(JSON.stringify(rows).replace(/\\/gi, ""));
//            console.log(JSON.stringify(hintList));
//            console.log(JSON.stringify(answers));
//            console.log(JSON.stringify(timeList));
            jsonSTR = '{"content":	[{"answers": '+JSON.stringify(answers)+'},{"timeList": '+JSON.stringify(timeList)+',"hintList": '+JSON.stringify(hintList)+',"rows": '+JSON.stringify(rows).replace(/\\/gi, "")+'}]}';
            console.log(JSON.parse(jsonSTR));
            var rowHtml = '<tr class="admin-table-row">' +
                '<td class="admin-table-cell">'+formatTime(row.start_time)+'→'+formatTime(row.end_time)+'</td>' +
                '<td class="admin-table-cell-full">' +
                '<span class="table-long-text">'+ row.caption_text +'</span>' +
                '</td>' +
                '<td class="admin-table-cell">' +
                '<input class="admin-table-button edit undisplayed" type="button" value="Edit">' +
                '<input class="admin-table-button delete" type="button" value=" Remove">' +
                '</td>' +
                '</tr>';
            $('tbody')[0].innerHTML += rowHtml;
        }
    });


    $('#btn-clear').on('click', function(e) {
        $('#admin-keyword-input')[0].value = '';
    });
    $('#btn-save').on('click', function(e) {
        writeData(jsonSTR);
    });
    $('#btn-getStartTime').on('click', function(e) {
        startTime = player.getCurrentTime();
        endTime = player.getCurrentTime() + 1;
        $('#startTime')[0].value = formatTime(startTime);
        $('#endTime')[0].value = formatTime(endTime);
    });
    $('#btn-getEndTime').on('click', function(e) {
        endTime = player.getCurrentTime();
        if(endTime < startTime)
            bootbox.alert('End time must required larger than start time. Please get time again ! ');
        else
            $('#endTime')[0].value = formatTime(endTime);
    });

    $('.delete').live('click', function() {
        var arrButtonRemove = $(this);
        var index = arrButtonRemove.index('.delete') + 1;
        bootbox.confirm('Are you want sure to delete this row ?', function(result) {
            if (result) {
                removeTR(index);
            }
        });
    });
    $('.admin-edit').live('click', function() {
        var arrButtonRemove = $(this);
        var index = arrButtonRemove.index('.admin-edit');
        $.ajax({
            type: 'post',
            cache: false,
            url: './BLL/getArticleByIdBLL.php',
            data: {
                idArticle: $('.idArticle')[index].value
            },
            success: function(resp) {
                if(resp){
                    var article = JSON.parse(resp);
                    $("#admin-player")[0].src = article.link;
                    duration = article.duration;
                    $(".admin-current-time")[0].innerText = duration + ' min';
                    title = article.title;
                    $("#admin-video-title")[0].innerText = title;
                    $("#value-cate")[0].value = article.categoryid;
                    $("#value-level")[0].value = article.level;

                    $("#admin-video-title").removeClass("undisplayed");
                    $("#keyword-panel").removeClass("undisplayed");
                    $("#rows-panel").removeClass("undisplayed");
                    $("#hints-panel").removeClass("undisplayed");
                    $("#hint-title").removeClass("undisplayed");
                    $("#tbContent-panel").removeClass("undisplayed");
                    $(".admin-table-foot").removeClass("undisplayed");
                    $("#btn-save").addClass('undisplayed');
                    $("#btn-edit").removeClass('undisplayed');
                    $('body,html').animate({
                        scrollTop: 350
                    }, 800);
                }
            },
            complete: function() {
            }
        });
    });

    $('.admin-delete').live('click', function () {
        var arrButtonRemove = $(this);
        var index = arrButtonRemove.index('.admin-delete');
        bootbox.confirm('<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp• Do you really want to delete this article?</a><br/>', function (result) {
            if (result) {
                $.ajax({
                    type: 'post',
                    cache: false,
                    url: './BLL/deleteArticleByIdBLL.php',
                    data: {
                        idArticle: $('.idArticle')[index].value
                    },
                    success: function (resp) {
                        if (resp === "success") {
                            bootbox.alert('<br/><a style="color: blue">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Delete successful! Press "OK" to refresh page</a><br/>', function () {
                                window.location.reload();
                            });
                            setTimeout(function () {
                                $(".modal")[0].style.width = '655px';
                                $(".modal")[0].style.left = '40%';
                            }, 300);
                        } else {
                            bootbox.alert('<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Delete Fail. Action has been interrupt.' +
                                '<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Or this article had exist in activity history.' +
                                '<br/><a style="color: #ff0000">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp•  Please try again.');
                        }
                    },
                    complete: function () {}
                });
            }
        });
        $(".modal")[0].style.width = '500px';
        $(".modal")[0].style.left = '52%';
    });

});

function writeData(content) {
//    document.getElementById("value-cate").value;

    $.ajax({
        type: 'post',
        cache: false,
        url: './BLL/adminVideoBll.php',
        data: {
            v: v,
            title: title,
            duration: duration,
            level: document.getElementById("value-level").value,
            cateid: document.getElementById("value-cate").value,
            content: content
        },
        success: function(resp) {
            if(trim(resp) === 'true'){
                bootbox.confirm('• Create new video success.' +
                    '<br/> • <a style="color: #ff0000">Do you want update this video into current video list to manager continues ?</a>', function(result) {
                    if (result) {
                        window.location.reload();
                    }
                });
            }
            else
                bootbox.alert('<a style="color: #ff0000">Action has been occurs one or some error in below list :<a><br/>&nbsp&nbsp&nbsp&nbsp• This video is exists in database' +
                    '<br/>&nbsp&nbsp&nbsp&nbsp• Action has been interrupt<br/>&nbsp&nbsp&nbsp&nbsp• Please try again with another video');
        },
        complete: function() {
        }
    });
}

function resetAllInput() {
    startTime = player.getCurrentTime();
    $('#startTime')[0].value = formatTime(startTime);
    endTime = player.getCurrentTime() + 1;
    $('#endTime')[0].value = formatTime(endTime);
    $("#admin-keyword-input")[0].value = '';
    $("#admin-textarea-input")[0].value = '';
    for(var i = 1; i < $(".hint").length; i++)
        $(".hint")[i].value = '';
}

function removeTR(pos) {
    var currCaption = rows[pos - 1].caption_text;
    var answerIndex = null;
    for(var i = 0;i < rows.length; i++){
        var tempCaption = rows[i].caption_text;
        if(tempCaption.match("<input class='play-exam-answer' type='text'")){
            answerIndex = 0;
            answerIndex += 1;
            if(tempCaption === currCaption)
                break;
        }

    }
    if(answerIndex != null){
        for(var i = 1; i <= answers.length;i++){
            if(i == pos){
                for(var j = pos; j < answers.length;j++){
                    answers[j] = answers[j+1];
                }
                delete answers[answers.length];
                answers.length -= 1;
                break;
            }
        }
        for(var i = 1; i <= timeList.length;i++){
            if(i == pos){
                for(var j = pos; j < timeList.length;j++){
                    timeList[j] = timeList[j+1];
                }
                delete timeList[timeList.length];
                timeList.length -= 1;
                break;
            }
        }
        hintList.splice(answerIndex, 1);
    }
    rows.splice(pos - 1, 1);

    $('tr')[pos].remove();
    if(pos == 1)
        $(".admin-table-foot").addClass("undisplayed");
    jsonSTR = '{"content":	[{"answers": '+JSON.stringify(answers)+'},{"timeList": '+JSON.stringify(timeList)+',"hintList": '+JSON.stringify(hintList)+',"rows": '+JSON.stringify(rows).replace(/\\/gi, "")+'}]}';
    console.log(JSON.parse(jsonSTR));
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

function LTrim(value) {
    var re = /\s*((\S+\s*)*)/;
    return value.replace(re, "$1");
}
// Hàm cắt ký tự trắng ở cuối chuỗi
function RTrim(value) {
    var re = /((\s*\S+)*)\s*/;
    return value.replace(re, "$1");
}
// Cắt các ký tự trắng ở đầu và cuối chuỗi
function trim(value) {
    return LTrim(RTrim(value));
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