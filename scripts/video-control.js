var hintList = [];
var timeList = [];
var ansContent = [];
var intervalId = null;

var captionContainer;
var captionContent;
var captionItemHeight;
var viewPortHeight;
var articleid;

var lastCaptionTime = 0;
var lastAnswerField = null;
var totalField = 0;
var answeredField = 0;
var btnAutoScroll;
var autoscroll;
var timeIdentity = null;
var BASE_URL = "";

$(document).ready(function() {
    $('.fb-comments').attr('data-width', $('.span6').width());
    $('#btnAutoScroll').click(function() {
    });
    $('.play-exam-item .play-exam-tag').live('click', function() {
        var item = $(this).parent();
        startTime = item.find('.startTime').val();
        lastCaptionTime = startTime;
        player.seekTo(startTime, true);
        activeCaptionTime(item);
    });
    $('.video-control .back5').live('click', function(e) {
        e.preventDefault();
        player.seekTo(player.getCurrentTime() - 5);
    });
    $('.video-control .skip5').live('click', function(e) {
        e.preventDefault();
        player.seekTo(player.getCurrentTime() + 5);
    });
    getVideoContent();
    //$('#hintList').show();
    $('.play-exam-answer').live('blur keyup focus', function() {
        answeredField = 0;
        $('.play-exam-answer').each(function(index) {

            if ($(this).val().trim().length > 0) {
                answeredField++;
            }
            $('.video-control .video-control-score').html(answeredField + "/" + totalField);
        });
    });

    $('.play-exam-answer').live('focus', function() {
        lastAnswerField = $(this);
        var html = '';
        var txtAnswer = $(this);
        var index = txtAnswer.index('.play-exam-answer');
        hintItem = hintList[index];
        if (hintItem[1] !== undefined && hintItem.length > 0) {
            html = '';
            for (i = 0; i < hintItem.length; i++) {
                hint = hintItem[i + 1];
                html += '<span class="play-keyword-item">' + hint + '</span>';
            }
            $('.play-keywords').html(html);

        } else {
            $('.play-keywords').html('No suggestions');
        }
    });

    $('.play-keyword-item').live('click', function(e) {
        e.preventDefault();
        lastAnswerField.val($(this).html());
        lastAnswerField.focus();
    });

    $('#btnReset').click(function(e) {
        e.preventDefault();
        $('#btnSubmitVideoAnswer').button('reset').show();

        // getVideoContent();
        $(".play-exam-answer").each(function(index) {
            $(this).val('');
        });
        answeredField = 0;
        $('.video-control .video-control-score').html(answeredField + "/" + totalField);
    });

    $('#btnSubmitVideoAnswer').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var score = 0;
        if (checkEmptyField() === true) {
            bootbox.alert('Your assignment is to be sent , returns results in seconds...');

            $(this).button('loading');
            var answer = [];
            $(".play-exam-answer").each(function(index) {
                value = $(this).val();
                answer.push(value);
            });
            button.hide();
            player.stopVideo();
            //show spin  button first
            //confirm: Bạn có muốn gửi bài làm của mình ?
            for (var i = 0; i < answer.length; i++) {
                if (ansContent[i + 1] === answer[i])
                    score += 1;
            }
            informPlayerScore(score, 1, toHHMMSS(timeIdentity));
            button.val('Done');
            return false;
        } else {
            stopCountTimer();
            bootbox.hideAll();
            bootbox.alert('To submit assignments , you need to enter at least one box', 'Agree');
            return false;
        }
    });
    $('#btnReset').click(function(e) {
        timeIdentity = 0;
        startCountTimer();
    });

    $('#btnSavePlayerName').click(function(e) {
        $.ajax({
            url: BASE_URL + '/video/saveScore',
            data: {
                playerName: $('#playerName').val(),
                videoId: video.id
            },
            type: 'post',
            success: function(json) {
                var data = $.parseJSON(json);
                if (data.success) {
                    $('#highScoreContent').html(data.msg.scoreHtml);

                }
            },
            complete: function() {
                $('#highscoreDialog').modal('hide');
            }
        });
        e.preventDefault();
    });

    $('#btnOpenReportDialog').click(function() {
        $('#feedbackDialog').modal('show');
    });
    $('#btnSendReport').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + '/video/sendFeedback',
            data: {
                videoId: video.id,
                url: $('#Report_url').val(),
                message: $('#Report_message').val(),
                email: $('#Report_email').val()
            },
            type: 'post',
            success: function(json) {
                var data = $.parseJSON(json);
                bootbox.alert(data.msg);
            },
            complete: function() {
                $('#feedbackDialog').modal('hide');
            }
        });
    });
});

function getDataYT(id) {
    articleid = id;
    captionContainer = $('#play-exam');
    captionContent = $('#play-exam-list');
    viewPortHeight = captionContainer.height();
    $.ajax({
        url: './BLL/getDataJSONBll.php',
        data: {
            id: id
        },
        type: 'post',
        complete: function() {
        },
        success: function(resp) {
            var jsonParse = JSON.parse(resp);
            var data = jsonParse.content[1];
            ansContent = jsonParse.content[0].answers;
            timeList = data.timeList;
            totalField = data.hintList.length;
            hintList = data.hintList;
            hintItem = data.hintList[0];
            if (hintItem[1] !== undefined && hintItem.length > 0) {
                hintHtml = '';
                for (i = 0; i < hintItem.length; i++) {
                    hint = hintItem[i + 1];
                    hintHtml += '<span class="play-keyword-item">' + hint + '</span>';
                }
                $('.play-keywords').html(hintHtml);

            } else {
                $('.play-keywords').html('No suggestions');
            }
            //------------------------------ fill exam list --------------------------------------------
            var html = "";
            for (var i = 0; i < data.rows.length; i++) {
                var row = '<div class="play-exam-item" id="captionItem-' + (i + 1) + '" data-number="' + i + '" data-start="' + data.rows[i].start_time + '" data-end="' + data.rows[i].end_time + '">' +
                        '<input type="hidden" class="timeValue" value="00:00:06,860 --&gt; 00:00:08,369">' +
                        '<input type="hidden" class="startTime" value="' + data.rows[i].start_time + '">' +
                        '<input type="hidden" class="endTime" value="' + data.rows[i].end_time + '">' +
                        '<a class="play-exam-tag" title="click to seek">' +
                        '<span class="caption-time">' + formatTime(data.rows[i].start_time) + '</span>' +
                        '</a>' +
                        '<div class="play-exam-text">' + data.rows[i].caption_text + '</div>' +
                        '</div>';
                // console.log(row);
                html += row;
            }
            setTimeout(function() {
                $(".play-exam-list").append(html);
                $('.play-exam-answer:eq(0)').focus();
                startCountTimer();
            }, 10);
        }
    });
}

setInterval(checkVideoTime, 500);
//setInterval(function() {
//    console.log(Math.round(player.getCurrentTime()));
//    
//}, 1000);
function checkVideoTime() {
    currentTime = player.getCurrentTime();
    number = null;
    for (p in timeList) {
        p = parseInt(p);
        number = timeList[p];
//        console.log("-------------------------" + lastCaptionTime);
        if (currentTime > p && p > lastCaptionTime) {
            lastCaptionTime = p;
            var item = $('#captionItem-' + number);
            setCaptionInView(item);
            activeCaptionTime(item);
            break;
        }
    }
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

function setCaptionInView(item) {

    if (autoscroll === 0) {
        return;
    }
    captionTextHeight = item.find('.play-exam-text').height();
    viewTop = captionContent.offset().top;
    if ($.browser.mozilla !== undefined) {
        viewTop -= 20;
    }
    viewBottom = viewTop + viewPortHeight - captionTextHeight;
    itemTop = item.offset().top;

    if (!(itemTop >= viewTop && itemTop <= viewBottom)) {
        if (itemTop < viewTop) {
//            console.log("itemTop < viewTop : " + itemTop - viewTop)
            captionContainer.mCustomScrollbar("scrollTo", itemTop - viewTop);
        } else if (itemTop > viewBottom) {
//            console.log("itemTop > viewTop : " + itemTop - (viewBottom) + captionTextHeight);
            captionContainer.mCustomScrollbar("scrollTo", itemTop - (viewBottom) + captionTextHeight);
        }
    } else {
        captionContainer.mCustomScrollbar("scrollTo", 0);
    }

}
function startCheckVideoTime() {
    intervalId = setInterval(checkVideoTime, 1000);
}
function stopCheckVideoTime() {
    window.clearInterval(intervalId);
}
function activeCaptionTime(item) {
    if (item.hasClass('play') === false) {
        $('.play-exam-item').removeClass('play');
        // $('.play').hide();
        // $('.select').show();
        item.addClass('play');
        item.find('.play').show();
        // item.find('.select').hide();
        // console.log("-------------------------"+item);
    }
}

function saveHighScore(score) {
    $('#playScore').html(data.msg.score);
    $('#highscoreDialog').modal('show');
}

function checkEmptyField() {
    $('.play-exam-answer').removeClass('inputError');
    var result = false;
    $(".play-exam-answer").each(function(index) {

        value = $(this).val();

        if (value !== null && value.trim() !== '') {

            result = true;
            return false;
        }
    });
    return result;
}


var tag = document.createElement('script');

// This is a protocol-relative URL as described here:
//     http://paulirish.com/2010/the-protocol-relative-url/
// If you're testing a local page accessed via a file:/// URL, please set tag.src to
//     "https://www.youtube.com/iframe_api" instead.
tag.src = "//www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '385',
        width: '100%',
//	  	videoId: youtubeId,
        playerVars: {
            showinfo: 0
        },
        events: {
//		    'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerReady() {
    $('#btnBack5Sec').click(function(e) {
        e.preventDefault();
        player.seekTo(player.getCurrentTime() - 5);
    });

    $('#btnNext5Sec').click(function(e) {
        e.preventDefault();
        player.seekTo(player.getCurrentTime() + 5);
    });
}

function onPlayerStateChange(event) {
    if (event.data === 1) {
        startCheckVideoTime();
    } else {
        stopCheckVideoTime();
    }
}



$(document).ready(function() {
    btnAutoScroll = $('#btnAutoScroll');
    autoscroll = $.cookie('autoscroll');
    $.cookie('autoscroll', 0);
    setAutoScrollText();
    btnAutoScroll.click(function(e) {
        e.preventDefault();
        console.log("before -----------" + autoscroll);
        changeAutoScroll();
        console.log("after -----------" + autoscroll);
        setAutoScrollText();

    });
    function setAutoScrollText() {
        if (parseInt(autoscroll) === 0 || autoscroll === null) {
            $("#btnAutoScroll")[0].addClassName = "video-control-metro large scroll";
            $("#btnAutoScroll")[0].innerText = "Enable Autoscroll";
        } else {
            $("#btnAutoScroll")[0].addClassName = "video-control-metro large scroll off";
            $("#btnAutoScroll")[0].innerText = "Disable Autoscroll";
        }
    }

    function changeAutoScroll() {
        if (parseInt(autoscroll) === 0 || autoscroll === null) {
            $.cookie('autoscroll', 1);
            autoscroll = 1;
        } else {
            $.cookie('autoscroll', 0);
            autoscroll = 0;
        }
    }
});


$(document).ready(function() {
    $('#btnYourPosition').click(function() {

    });
});

function shareScore(score, rank, video) {

    if (fbUserData !== null) {
        message = fbUserData.name + ' vừa đạt ' + score + ' trong video tiếng Anh ' + video.title + ' tại ListenToMe.vn';
        FB.api('/me/feed', 'post', {
            'message': message,
            'link': video.website_url,
            'description': 'Số điểm: ' + score + '\r\n' + 'Xếp hạng: ' + rank
        }, function(response) {
            console.log(response);
        });
    }
}

function increasePlayCount() {
    var count = $.cookie('playcount');
    if (count === undefined)
        count = 0;
    $.cookie('playcount', ++count);

}
function getFbUserData(callback) {
    callback = callback || function() {
    };
    if (fbUserData == null) {
        FB.api('/me', function(response) {
            if (!response || response.error) {
                console.log('error get user data');
                console.log(response);
            } else {
                fbUserData = response;
                callback();
            }
        });
    }
    return fbUserData;

}
function informPlayerScore(score, rank, time) {
    rankText = null;
    switch (rank) {
        case 1:
            rankText = 'Bạn là người đứng đầu trong video này';
            break;
        case 2:
            rankText = 'Bạn là người đứng thứ 2 trong video này.';
            break;
        case 3:
            rankText = 'Bạn là người đứng thứ 3 trong video này';
            break;
        default:
            rankText = 'Bạn là người đứng thứ ' + rank + ' trong video này';

    }
    if (fbUserData !== null) {
        bootbox.hideAll();
        bootbox.confirm('Chúc mừng bạn đã đạt được ' + score + ' điểm. '
                + rankText + '.<br/>'
                + 'Thời gian hoàn thành của bạn là ' + time
                + '. Bạn có muốn chia sẽ kết quả này ?', 'Để lát nữa.', 'Post lên Facebook liền !', function(result) {
            if (result) {
                shareScore(score, rank, video);
            }
        });
    } else {
        bootbox.hideAll();
        bootbox.confirm('Congratulations on getting  ' + score + ' points. Your Completion time is ' + time + '.<br/>Do you want save this result ??', function(result) {
            if (result) {
                $.ajax({
                    url: './BLL/submitExamBll.php',
                    data: {
                        articleid: articleid,
                        score: score
                    },
                    type: 'post',
                    success: function(resp) {
                        if(trim(resp) === 'true'){
                            bootbox.hideAll();
                            bootbox.alert('This exam saved success !')
                        }
                    }
                });
            }
        });
    }

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
function reloadHighScore(videoId) {
    $.ajax({
        url: BASE_URL + '/video/scoreList',
        data: {
            videoId: videoId
        },
        type: 'get',
        success: function(json) {
            var data = $.parseJSON(json);
            if (data.success) {
                $('#highscoreList').html(data.msg.html);
            }
        }
    });
}

$(document).ready(function() {
    $('#btnShowResult').click(function(e) {
        e.preventDefault();
        seeResult(video);
    });
});


var isShowResult = false;


function seeResult(video) {
    if (isShowResult === false) {
        bootbox.confirm('Bạn đang yêu cầu xem đáp án của video: ' + video.title + '. <br/>Đáp án video chỉ được xem <strong>một lần</strong> duy nhất. <br/>Bạn chỉ có <strong>30 giây</strong> để xem kết quả. <br/>Hãy quan sát thật kỹ những từ mà bạn muốn xem đáp án.', 'Thôi', 'Tiếp tục xem', function(confirm) {
            if (confirm) {
                getResult(video.id);
            }
        });
    }

}
function getResult(videoId) {
    isShowResult = true;
    $.ajax({
        url: BASE_URL + '/video/result',
        data: {
            id: videoId
        },
        type: 'post',
        success: function(json) {
            var data = $.parseJSON(json);
            if (data.success) {
                $('#displayContent').html(data.msg.resultContent);
                $('#btnShowResult').text('Đang hiện đáp án');
                setTimerToRestoreResult();
                startCountDown();
            }
        }
    });
}

function startCountDown() {
    var time = 30;
    var showResultIntervalId = setInterval(function() {

        time--;
        $('#btnShowResult').text('Kết thúc trong ' + '(' + time + ')');
        console.log('Show result in' + time);
        if (time < 0) {
            $('#btnShowResult').hide();
            window.clearInterval(showResultIntervalId);
        }

    }, 1000);
}

function setTimerToRestoreResult() {
    setTimeout(getVideoContent, 30 * 1000);
}

function getVideoContent(callback) {
    callback = callback || function() {
    };

    $.ajax({
        url: BASE_URL + '/video/start',
        data: {
//            id: video.id
        },
        type: 'post',
        success: function(json) {
            var data = $.parseJSON(json);
            if (data.success) {
                timeIdentity = data.msg.timeIdentity;
                hintList = data.msg.hint;
                $('#displayContentContainer').html(data.msg.html);
                $('#displayContentContainer').show();
                $('#hintContainer').show();
                $('#finishAction').show();
                $('.txtAnswer:eq(0)').focus();
                if (data.msg.timeList !== undefined) {
                    timeList = data.msg.timeList;
                }
                startCheckVideoTime();
                totalField = $('.txtAnswer').length;
                $('#answerStat').show();
                $('#answerStat #totalQuestion').html(totalField);
                $('#answerStat #totalAnswer').html(0);
                callback();

                captionContainer = $('#displayContentContainer');
                captionContent = $('#displayContent');
                captionItemHeight = $('.captionText:eq(0)').height();
                viewPortHeight = captionContainer.height();
                var width = $('#displayContent').width() - 90;
                $('.captionText').css({width: width + 'px'});
            } else {
                bootbox.alert(data.msg);
            }
        }
    });
}
//------------------------------FUNCTION TIMER----------------------------------
var timeIdentity = 0;
var t;
var timer_is_on = 0;
function timedCount()
{
//    document.getElementById('txt').value=c;
    timeIdentity += 1;
    t = setTimeout("timedCount()", 1000);
}

function startCountTimer()
{
    if (!timer_is_on)
    {
        timer_is_on = 1;
        timedCount();
    }
}

function stopCountTimer()
{
    clearTimeout(t);
    timer_is_on = 0;
}
//------------------------------END FUNCTION TIMER------------------------------
function toHHMMSS(number) {
    var sec_num = parseInt(number, 10); // don't forget the second parm
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    var time = hours + ':' + minutes + ':' + seconds;
    return time;
}