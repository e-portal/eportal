/**
 * Created by Админ on 05.09.2017.
 */
/* scroll elements */
$(function(){
    if(window.location.hash) {
        scrollBody(1000);
    };
});
$('.Top-link').click(function(e){
    e.preventDefault(e);
    history.pushState('', '', $(this).attr('href'))
    scrollBody(1000);
});
function scrollBody(tim) {
    $('body,html').animate({
        scrollTop: $(window.location.hash).offset().top - 150 + 'px'
    },tim);
};
portdefault = window.location.protocol + '//' + window.location.hostname + '/';
mainPage = $('.wrapper').hasClass('init-page');
/*init lines on scroll*/
function linesOnScroll() {
    $('.line-container').each(function(){
        if (!$(this).parents('aside').hasClass('aside') && !$(this).parent().hasClass('aside-block')) {
            w_h = $(window).height();
            winTop = $(window).scrollTop();
            elOffTop = $(this).offset().top;
            line = $(this).find('.vertical-line');
            if (!mainPage && window.matchMedia("(max-width: 991px)").matches) {
                line.attr('style', ' ');
                return true
            }
            if (window.matchMedia("(max-width:767px)").matches) {
                line.attr('style', ' ');
                return true
            }

            elOffTop < winTop + w_h - 300 ? ($(this).addClass('active'), line.css({height: line.attr('data-height') + 'px'})) : ($(this).removeClass('active'), line.css({height: 0 + 'px'}));
        }
    });
};
/* lines and words params */
function wordLinePosition(z) {
    $('.line-container').each(function(){

        if(!$(this).parents('aside').hasClass('aside') && !$(this).parent().hasClass('aside-block')) {
            if (!mainPage && window.matchMedia("(max-width: 991px)").matches) {
                return true
            }
            if (!mainPage && window.matchMedia("(max-width: 767px)").matches) {
                return true
            }
                

            line = $(this).find('.vertical-line');
            word = $(this).find('h2');
            wordInner = word.html();
            wordFuture = '';
            tran = .1 * wordInner.length;
            if (!z) {
                for (i = 0; i < wordInner.length; i++) {
                    wordFuture += '<span style="right:' + 100 + 'px;  ">' + wordInner[i] + '</span>';
                }
                word.html(wordFuture);
            }

            line.attr('data-height', ($(this).height() - word.width() - 15));

        }
    });
};
window.onresize = function () {
    wordLinePosition(1);
    linesOnScroll();
}
setTimeout(function () {
    $(window).scroll(function () {
        linesOnScroll();
        btnToTop();
    });
    wordLinePosition();
    linesOnScroll();
}, 2000);

/*video block lines main page */
$('.video .button-block a').hover(function () {
    $(this).parent().addClass('active');
    $(this).parent().siblings('.articles-horizontal').addClass('active');
}).mouseleave(function () {
    $(this).parent().removeClass('active');
    $(this).parent().siblings('.articles-horizontal').removeClass('active');
});

$('.content .button-block a').hover(function () {
    $(this).parent().addClass('active');
    $(this).parents('.content').addClass('active');
}).mouseleave(function () {
    $(this).parent().removeClass('active');
    $(this).parents('.content').removeClass('active');
});
if ($('.slider').length) {
    k = new SliderMain($('.slider'), $('.slider article'));
}
if ($('.slide-meropryyatyya').length) {
    k = new SliderMain($('.slide-meropryyatyya'), $('.slide-meropryyatyya img'));
}
/* s;ider main page */
function SliderMain(slider, slides) {
    el = slider
    el.slider = slider;
    el.slides = slides;
    el.sliderRemote = sliderRemote
    el.sliderEvents = sliderEvents
    el.autoslide = autoslide
    el.sliderGo = sliderGo


    curr = 0;
    canGo = true;

    function sliderRemote() {
        dots = '';
        for (i = 0; i < el.slides.length; i++) {
            dots += i == 0 ? '<div class="dot active" data-id="' + i + '"></div>' : '<div class="dot" data-id="' + i + '"></div>';
        }

        $('<div />')
            .addClass('slider-nav')
            .appendTo(this.slider);
        $('.slider-nav').html('<div class="arr-slider prev-slide"><</div><div class="dots">' + dots + '</div><div class="arr-slider next-slide">></<div>')
        sliderEvents();
        autoslide(0);

    }
    el.sliderRemote();


    function sliderEvents() {
        var stopAuto;
        $('.arr-slider').click(function () {
            $(this).hasClass('prev-slide') ? (curr -= 1, curr < 0 ? curr = el.slides.length - 1 : '') : (curr += 1, curr == el.slides.length ? curr = 0 : '');
            canGo = false;
            clearTimeout(stopAuto);
            stopAuto = setTimeout(function () {
                canGo = true;
                autoslide(1);
            }, 4000);

            sliderGo();
        });
        $('.dot').click(function () {
            curr = $(this).attr('data-id');
            canGo = false;
            clearTimeout(stopAuto);
            stopAuto = setTimeout(function () {
                canGo = true;
                autoslide(1);
            }, 4000);
            sliderGo();
        });
    };

    function autoslide(int) {
        if (!canGo) {
            window.cancelAnimationFrame(autoslide);
            return true
        }
        ;
        int ? curr += 1 : '';
        curr >= el.slides.length ? curr = 0 : '';

        setTimeout(function () {
            window.requestAnimationFrame(autoslide)
        }, 4000);
        sliderGo();
    }
    function sliderGo() {
        slides.removeClass('active');
        slides.eq(curr).addClass('active');
        $('.dot').removeClass('active');
        $('.dot').eq(curr).addClass('active');
    };

};

/* Capture */
$('.reload').click(function () {
    $.ajax({
        url: '/captcha',
        success: function (data) {
            img = document.getElementById("captcha");
            img.src = "/captcha";
        }
    });

});

/* to top */
function btnToTop() {
    if ($('body').scrollTop() > window.innerHeight) {
        $('.wrap-top-top').css({'opacity': 1, 'height': 'auto', 'width': 'auto'})
    } else {
        $('.wrap-top-top').css({'opacity': 0, 'height': '0', 'width': '0'});
    }
};btnToTop();
$('.wrap-top-top').click(function () {
    $('body,html').animate({scrollTop: 0 + 'px'}, 500);
});


/* raiting  init*/


function golosovanie(dataId, dataSource, token, ind) {
    $.ajax({
        url: '/ratio',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: ({
            data_id: dataId,
            source_id: dataSource,
            ratio: ind
        }),
        success: function (data) {
            console.log(data['success']);
            if (data['success']) {
                if (!data['success'].hasOwnProperty('avg')) {
                    avg = data['success'][0]['avg'];
                    count = data['success'][0]['count'];
                    str = '<span class="avg">' + avg + '</span>/' + count + '- (голосов - ' + count + ')';
                    $('.rating p').html(str);
                    colorStars(avg);
                }
            }
        }
    });
}

/* stars to black */
function colorStars(num) {
    num = Math.round(num);
    stars = $('.top-rating span');
    for (i = num; i >= 0; i--) {
        stars.eq(5 - i).addClass('active');
    }
}

if ($('.top-rating').length) {
    colorStars($('.avg').html());
}
function findIndexes(obj) {
    ind = (obj.index() - 5) * (-1);
    dataId = obj.parent().attr('data-id');
    dataSource = obj.parent().attr('data-source');
    token = obj.parent().attr('data-token');

    golosovanie(dataId, dataSource, token, ind)
}

/* click rait */
$('.top-rating span').click(function () {
    findIndexes($(this))
});


/****************line map-site***********************/
// $('.js-block-parent').each(function () {
//     blockLast = $(this).find('.js-block-chaild').eq(-1).find('.block-before');
//     lastBlockTop = blockLast.offset().top;


//     //console.log(lastBlockTop);


//     blockFirst = $(this).find('.js-block-chaild').eq(1).find('.block-before');
//     firstBlockTop = blockFirst.offset().top;

//     firstBlockHeight = blockFirst.height();

//     console.log(firstBlockHeight + '+' + firstBlockTop + '-' + lastBlockTop)


//     blockLast.css('height', firstBlockHeight + firstBlockTop - lastBlockTop + 'px');

// });


/* pop-meropriyatia */
$('.js-pop').click(function () {
    $('.event-signup .event_source').val($(this).parent().attr('data-id'));
    $('.event-signup').css({display: 'flex'});
});

$('.event-signup').click(function (e) {
    console.log($(this).parent('form').length);
    if ($(this).parents('form')) {

    } else {
        $('.event-signup').css({display: 'none'});
    }
});

$('.btn-large').click(function (e) {
    e.preventDefault(e);
    _this = $(this)
    $.ajax({
        url: _this.parents('form').attr('action'),
        type: 'POST',
        data: _this.parents('form').serialize(),
        success: function (data) {
            if (data.hasOwnProperty('error')) {
                for (var key in data.error) {
                    _this.parents('form').find('input[name="' + key + '"]').css({'border': '2px solid red'});
                }
                setTimeout(function () {
                    _this.parents('form').find('input').attr('style', ' ')
                }, 2000)
            } else {
                $('.event-signup').css({display: 'none'});
            }
        }
    });
});

/* meropriyatia */
if ($('.form-organizer').length) {
    function cities() {
        idCounrty = $('#country').val() ? $('#country').val() : '000';
        $('#city option').each(function () {
            idCity = $(this).attr('data-country');
            console.log(idCounrty + ' ' + idCity);
            if (idCounrty == idCity) {
                $(this).attr('disabled', false).show();
            } else {
                $(this).attr('disabled', true).hide();
                ;
            }
        });

    };cities();
    $('#country').change(function () {
        idCounrty = $('#country').val();
        cities();
    })
}


