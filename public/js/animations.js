/**
 * Created by Админ on 05.09.2017.
 */
/* scroll elements */
$(function () {
    if (window.location.hash) {
        scrollBody(1000);
    };
});
$('.Top-link').click(function (e) {
    e.preventDefault(e);
    history.pushState('', '', $(this).attr('href'))
    scrollBody(1000);
});

function scrollBody(tim) {
    $('body,html').animate({
        scrollTop: $(window.location.hash).offset().top - 150 + 'px'
    }, tim);
};
portdefault = window.location.protocol + '//' + window.location.hostname + '/';
mainPage = $('.wrapper').hasClass('init-page');
/*init lines on scroll*/
function linesOnScroll() {
    $('.line-container').each(function () {
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
// alert(elOffTop < winTop + w_h - 300)
            elOffTop < winTop + w_h - 300 ? ($(this).addClass('active'), line.css({height: line.attr('data-height') + 'px'})) : ($(this).removeClass('active'), line.css({height: 0 + 'px'}));
        }
    });
};
/* lines and words params */
function wordLinePosition(z) {
    $('.line-container').each(function () {

        if (!$(this).parents('aside').hasClass('aside') && !$(this).parent().hasClass('aside-block')) {
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
            $(this).css({height: $(this).parent().height() + 'px'});
            line.attr('data-height', ($(this).height() - word.width() - 15));

        }
    });
};
window.onresize = function () {
    wordLinePosition(1);
    linesOnScroll();

    /* blog page slides */
    if (window.matchMedia('(max-width: 767px)').matches) {
        $('.blog-section.hidden-blog').css({'height': 279 + 'px'})
    } else {
        $('.blog-section.hidden-blog').css({'height': 174 + 'px'})
    }


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
$('.reload').bind('click', requestCapcha);

function requestCapcha() {
    $.ajax({
        url: '/captcha',
        success: function (data) {
            img = document.querySelectorAll(".captcha");
            for (i = 0; i < img.length; i++) {
                img[i].src = "/captcha";
            }

        }
    });
}
/* to top */
function btnToTop() {
    if ($('body').scrollTop() > window.innerHeight) {
        $('.wrap-top-top').css({'opacity': 1, 'height': 'auto', 'width': 'auto'})
    } else {
        $('.wrap-top-top').css({'opacity': 0, 'height': '0', 'width': '0'});
    }
};
btnToTop();
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
$('.signup-form').click(function () {
    $('.event-signup').css({display: 'none'});
});
$('.signup-close').click(function () {
    $('.event-signup').css({display: 'none'});
});
$('.event-signup').click(function (e) {
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

    };
    cities();
    $('#country').change(function () {
        idCounrty = $('#country').val();
        cities();
    })
}

/* blog oomments */

$('.content-answer').click(function (e) {
    e.preventDefault(e);
    idn = $(this).attr('data-parent');
    par = $(this).parents('li');
    form = $('.section-form').html();

    $('.post-list li').each(function () {
        $(this).find('.comment-post').remove();
    });
    if ($(this).hasClass('active')) {
        $(this).removeClass('active')
    } else {
        $(this).addClass('active')
        $('<div />').html('<div class="section-form answ-comment">' + form + '</div>')
            .addClass('comment-post')
            .appendTo(par);
        $('<input type="hidden" name="comment_parent" />')
            .val(idn)
            .appendTo('.answ-comment form');

        $('.reload').unbind('click', requestCapcha)
            .bind('click', requestCapcha);

        $('.section-form .but-section-form').unbind('click', requestComments)
            .bind('click', requestComments);

    }
});

$('.section-form .but-section-form').bind('click', requestComments);

function requestComments(e) {
    e.preventDefault(e);
    form = $(this).parents('form');
    $.ajax({
        url: '/comments',
        data: form.serialize(),
        type: 'POST',
        success: function (data) {
            if (data.hasOwnProperty('error')) {
                for (var key in data.error) {
                    form.find('input[name="' + key + '"]').css({'border': '2px solid red'});
                    form.find('textarea[name="' + key + '"]').css({'border': '2px solid red'});
                }
                setTimeout(function () {
                    form.find('input').attr('style', ' ');
                    form.find('textarea').attr('style', ' ')
                }, 2000)
            } else {
                if (form.parents('.section-form').hasClass('answ-comment')) {
                    form.parents('.comment-post').remove();
                } else {
                    form.trigger('reset');
                }

            }
        }
    })
}

$('.will-open').click(function () {
    h_small_init = window.matchMedia('(max-width: 767px)').matches ? 279 : 174;

    $(this).parents('.hidden-blog').hasClass('blog-section') ? h_small = h_small_init : h_small = '75';
    $(this).toggleClass('noactive');
    if (!$(this).hasClass('noactive')) {
        $(this).html('Больше')
        $(this).parents('.hidden-blog').stop().animate({'height': h_small + 'px'}, 500);
    } else {
        $(this).html('Скрыть')
        $(this).parents('.hidden-blog').stop().animate({'height': $(this).parents('.hidden-blog').attr('h_full') + 'px'}, 500);
    }
});
$('.hidden-blog').each(function () {
    $(this).attr('h_full', $(this).height());
    h_small_init = window.matchMedia('(max-width: 767px)').matches ? 279 : 174;

    $(this).hasClass('blog-section') ? h_small = h_small_init : h_small = '75';
    $(this).stop().animate({'height': h_small + 'px'}, 0);
})


$(window).on('load', function () {
    (function () {
        var adSlider = $('.just-slider');
        var current = 0;
        var len = adSlider.find('a').length;

        if (len) {
            var spans = '';
            for (var i = 0; i < len; i++) {
                spans += '<span></span>'
            }
            adSlider.find('.pagination').html(spans)
        }

        adSlider.find('.slides a:eq(0), .pagination span:eq(0)').addClass('active');

        adSlider.find('.pagination').on('click', 'span', function () {
            current = $(this).index();
            changeAdSlide()
        });

        setInterval(function () {
            current++;
            if (current > adSlider.find('.slides a').length - 1) current = 0;
            changeAdSlide()
        }, 3000);

        function changeAdSlide() {
            adSlider.find('.slides a.active, .pagination span.active').removeClass('active');
            adSlider.find('.slides a:eq(' + current + '), .pagination span:eq(' + current + ')').addClass('active');
        }
    })();
});
var more = true;
$('.more-articles').click(function () {
    offs = '';
    if (more) {
        $('.doctor-page').length ? offs += '&own=2' : offs += '&own=1';
        offs += '&offset=' + $('.statyi-block').length;
        $.ajax({
            url: '/more_lasts',
            type: 'POST',
            data: offs,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data) {
                console.log(data);
                $('.main-content').append(data.success.content);
                if (!data.success.has_more) {
                    $('.more-articles').fadeOut(500)
                }
            }
        })
    }
});