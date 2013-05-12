var hintList = [];
var timeList = [];
var intervalId = null;

var lastCaptionTime = 0;
var lastAnswerField = null;
var totalField = 0;
var answeredField = 0;
var btnAutoScroll;
var autoscroll;
var timeIdentity = null;    
var BASE_URL = "";
$.getJSON('data-video/1.json',function(data){
        timeList = data.timeList;
    });
$.getJSON('data-video/1.json', function(data) {
            hintList = data.hintList[0];
            if (hintList[1] != undefined && hintList.length > 0) {

                html = '';
                for (i = 0; i < hintList.length; i++) {
                    hint = hintList[i + 1];
                    html += '<span class="play-keyword-item">' + hint + '</span>';
                }
                $('.play-keywords').html(html);

            } else {
                $('.play-keywords').html('No suggestions');
            }
        });
 
setInterval(checkVideoTime, 800);
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
        console.log("-------------------------"+lastCaptionTime);
        if (currentTime > p && p > lastCaptionTime) {
            lastCaptionTime = p;
            var item = $('#captionItem-' + number);
            // setCaptionInView(item);
            activeCaptionTime(item);
            break;
        }
    }
}

var captionContainer = $('#displayContentContainer');
var captionContent = $('#displayContent');
var captionItemHeight;
var viewPortHeight;
function setCaptionInView(item) {
    if (autoscroll == 0) {
        return;
    }
    captionTextHeight = item.find('.captionText').height();
    viewTop = captionContent.offset().top;
    if ($.browser.mozilla != undefined) {
        viewTop -= 20;
    }
    viewBottom = viewTop + viewPortHeight - captionTextHeight;
    itemTop = item.offset().top;

    if (!(itemTop >= viewTop && itemTop <= viewBottom)) {
        if (itemTop < viewTop) {
            captionContainer.scrollTop(itemTop - viewTop);
        } else if (itemTop > viewBottom) {

            captionContainer.scrollTop(itemTop - (viewBottom) + captionTextHeight);
        }
    }

}
function startCheckVideoTime() {
    intervalId = setInterval(checkVideoTime, 1000);
}
function stopCheckVideoTime() {
    window.clearInterval(intervalId);
}
function activeCaptionTime(item) {
    if (item.hasClass('play') == false) {
        $('.play-exam-item').removeClass('play');
        // $('.play').hide();
        // $('.select').show();
        item.addClass('play');
        item.find('.play').show();
        // item.find('.select').hide();
        console.log("-------------------------"+item);
    }


}
$(document).ready(function()
{

    $('.fb-comments').attr('data-width', $('.span6').width());

    $('#btnAutoScroll').click(function() {

    })
    $('.play-exam-item .play-exam-tag').live('click', function() {
        var item = $(this).parent();
        startTime = item.find('.startTime').val();
        lastCaptionTime = startTime;
        player.seekTo(startTime, true);
        activeCaptionTime(item);
    });
    getVideoContent();
    //$('#hintList').show();
    $('.play-exam-answer').live('blur keyup focus', function() {
        answeredField = 0;
        $('.play-exam-answer').each(function(index) {

            if ($(this).val().trim().length > 0) {
                answeredField++;
            }
            $('.video-control .video-control-score').html(answeredField + "/20");
        });
    });

    $('.play-exam-answer').live('focus', function() {
        lastAnswerField = $(this);
        var html = '';
        var txtAnswer = $(this);
        var index = txtAnswer.index('.play-exam-answer');
        $.getJSON('data-video/1.json', function(data) {
            hintList = data.hintList[index];
            if (hintList[1] != undefined && hintList.length > 0) {
                html = '';
                for (i = 0; i < hintList.length; i++) {
                    hint = hintList[i + 1];
                    html += '<span class="play-keyword-item">' + hint + '</span>';
                }
                $('.play-keywords').html(html);

            } else {
                $('.play-keywords').html('No suggestions');
            }
        });

    });

    $('.play-keyword-item').live('click', function(e) {
        e.preventDefault();
        lastAnswerField.val($(this).html());
        lastAnswerField.focus();
    });

    $('#btnReset').click(function(e) {
        e.preventDefault();
        $('#btnSubmitVideoAnswer').button('reset').show();

        getVideoContent();
    })

    $('#btnSubmitVideoAnswer').click(function(e) {
        e.preventDefault();
        var button = $(this);

        if (checkEmptyField() == true) {
            bootbox.alert('Bài làm của bạn đang được gửi, kết quả sẽ trả về trong vài giây...');

            $(this).button('loading');
            var answer = [];
            $(".txtAnswer").each(function(index) {
                value = $(this).val();
                answer.push(value);
            });
            button.hide();
            player.stopVideo();
            //show spin  button first
            //confirm: Bạn có muốn gửi bài làm của mình ?
            $.ajax({
                url: BASE_URL + '/video/finish?id=' + video.id,
                data: {
                    answer: answer,
                    id: video.id,
                    timeIdentity: timeIdentity
                },
                type: 'post',
                error: function(json) {
                    bootbox.alert('Rất tiếc, chúng tôi đang gặp sự cố, và chúng tôi đang khắc phục lỗi này');
                },
                complete: function(json) {

                },
                success: function(json) {
                    bootbox.hideAll();
                    var data = $.parseJSON(json);
                    if (data.success) {

                        $('#displayContent').html(data.msg.resultContent);
                        informPlayerScore(data.msg.score, data.msg.rank, data.msg.time);
                        $('#highscoreList #yw0').yiiGridView('update');
                        //reloadHighScore(video.id);						
                    } else {
                        bootbox.alert(data.msg);
                    }
                }
            });
            button.val('Đã làm xong');
            return false;
        } else {
            bootbox.alert('Để nộp bài làm, bạn cần nhập ít nhất một ô', 'Đồng ý');
            return false;
        }
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
        })
    })


});

function saveHighScore(score) {
    $('#playScore').html(data.msg.score);
    $('#highscoreDialog').modal('show');
}

function checkEmptyField() {
    $('.txtAnswer').removeClass('inputError');
    var result = false;
    $(".txtAnswer").each(function(index) {

        value = $(this).val();

        if (value != null && value.trim() != '') {

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
    })
}

function onPlayerStateChange(event) {
    if (event.data == 1) {
        startCheckVideoTime();
    } else {
        stopCheckVideoTime();
    }
}



$(document).ready(function() {
    btnAutoScroll = $('#btnAutoScroll');
    autoscroll = $.cookie('autoscroll');
    setAutoScrollText();
    btnAutoScroll.click(function(e) {
        e.preventDefault();
        changeAutoScroll();
        setAutoScrollText();

    });
    function setAutoScrollText() {
        if (autoscroll == 0 || autoscroll == null) {
            btnAutoScroll.html('<i class="icon-ok-sign icon-white"></i> Bật tự cuộn');
        } else {
            btnAutoScroll.html('<i class="icon-remove-sign icon-white"></i> Tắt tự cuộn');
        }
    }

    function changeAutoScroll() {
        if (autoscroll == 0 || autoscroll == null) {
            $.cookie('autoscroll', 1);
            autoscroll = 1;
        } else {
            $.cookie('autoscroll', 0);
            autoscroll = 0;
        }
    }
})


$(document).ready(function() {
    $('#btnYourPosition').click(function() {

    })
})

function shareScore(score, rank, video) {

    if (fbUserData != null) {
        message = fbUserData.name + ' vừa đạt ' + score + ' trong video tiếng Anh ' + video.title + ' tại ListenToMe.vn';
        FB.api('/me/feed', 'post', {
            'message': message,
            'link': video.website_url,
            'description': 'Số điểm: ' + score + '\r\n' + 'Xếp hạng: ' + rank
        }, function(response) {
            console.log(response)
        })
    }
}

function increasePlayCount() {
    var count = $.cookie('playcount');
    if (count == undefined)
        count = 0;
    $.cookie('playcount', ++count);

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

    if (fbUserData != null) {
        bootbox.confirm('Chúc mừng bạn đã đạt được ' + score + ' điểm. '
                + rankText + '.<br/>'
                + 'Thời gian hoàn thành của bạn là ' + time
                + '. Bạn có muốn chia sẽ kết quả này ?', 'Để lát nữa.', 'Post lên Facebook liền !', function(result) {
            if (result) {
                shareScore(score, rank, video);
            }
        });
    } else {
        bootbox.alert('Chúc mừng bạn đã đạt được ' + score + ' điểm. ' + rankText);
    }

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
    })
}


$(document).ready(function() {
    $('#btnShowResult').click(function(e) {
        e.preventDefault();
        seeResult(video);
    })
})


var isShowResult = false;


function seeResult(video) {
    if (isShowResult == false) {
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
    })
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
                if (data.msg.timeList != undefined) {
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