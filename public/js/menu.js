/**
 * Created by Fedor on 28.08.2017.
 */
/*  menu line bottom */
var menuElW,fullOffsetControl,menuElOff;
planshet = window.matchMedia('(max-width: 1271px)').matches

function lineBottomMenu() {
    w = $(document).width();

    menuElW = $('.menu-elem.active').width();
    fullOffset =  $('header .container-fool').offset().left;
    fullOffsetControl =  fullOffset;

    /* if planshet */
    if (window.matchMedia("(max-width: 1271px)").matches) {
        fullOffset = (w / 100) * 2.3;
        fullOffsetControl =  0;
    }

    menuElOff = $('.menu-elem.active').offset().left - fullOffsetControl;


    $('<div/>')
        .addClass('line-bottom-menu')
        .css({
            width: w  - fullOffset + 'px',
        })
        .appendTo('header .container-fool');

    $('<div/>')
        .addClass('line-large-menu')
        .css({
            left: menuElOff + 'px',
            width: menuElW + 'px',
        })
        .appendTo('.line-bottom-menu');

}
lineBottomMenu();

window.onresize = function(){
    lineBottomMenu();
}

/* hover menu element */
$('.submenu').slideUp(0);
open = false;

$('.menu-elem').hover(function () {
    if(!planshet) {
        menuElOff = $(this).offset().left - fullOffsetControl;
        menuElW = $(this).width();

        !open ? $(this).hasClass('memu-search') ? setTimeout(function () {
                    searchW()
                }, 500) : '' : ''

        $('.line-large-menu').css({
            left: menuElOff + 'px',
            width: menuElW + 'px',
        });
        $(this).find('.submenu').stop().slideDown(500);
    }

}).mouseleave(function(){
    if(!planshet) {
        menuElOff = $('.menu-elem.active').offset().left - fullOffset;
        menuElW = $('.menu-elem.active').width();
        $('.line-large-menu').css({
            left: menuElOff + 'px',
            width: menuElW + 'px',
        });
        $('.submenu').stop().slideUp(500);
        open ? open = false : '';
    }
});

/* planshet menu & mobile */
$('.with-sub.menu-elem a').click(function (e) {
    if(window.matchMedia('(max-width: 1271px)').matches) {
        if ($(this).parents('ul').hasClass('submenu')) {

        } else {
            e.preventDefault(e);
            console.log(21432);
            $(this).parent().toggleClass('active');
            $('.submenu').slideUp(500);
            $(this).parent().hasClass('active') ? $(this).parent().find('.submenu').slideDown(500) : '';
        }
    }
});

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

/* switch patient */

function switchSites() {
    $('.doctor,.checkbox-label').click(function () {
        if ($(this).hasClass('active')) {
            return true
        }
        cook = getCookie('userstatus');
        if (cook) {
            $('.to-page-doctor form').submit();
            return true
        }
        $('#checkbox1').removeClass('active');
        $('.wrap-pop').addClass('active');
    });
    $('.close-pop, .pop-bg').click(function () {
        $('#checkbox1').addClass('active');
        $('.wrap-pop').removeClass('active');
    });
};switchSites();



function searchW() {
    open = true;
    menuElOff = $('.search-mobb ').offset().left - fullOffset;
    menuElW0 =  $('.memu-search ').width() - 15;
    menuElW =   $('.search-mobb ').width()+ menuElW0 ;

    $('.line-large-menu').css({
        left: menuElOff + 'px',
        width: menuElW +'px',
    });
}
/*hover search menu */
$('.burger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
        $('.nav_container').addClass('active');
        $('#search').addClass('active');
        $('.background-menu-active').addClass('active');
    } else {
        $('.nav_container').removeClass('active');
        $('#search').removeClass('active');
        $('.background-menu-active').removeClass('active');
    }
})


/*background-menu-active hover*/
$('.submenu').mouseover(function () {
    $('.background-menu-active').stop().fadeIn(150)
});
$('.submenu').mouseout(function () {
    $('.background-menu-active').stop().fadeOut(150)
});



/************************ fesak hover katalog*******************************/
$('.hide-ul').each(function () {
    $(this).attr('data-h', $(this).height());
    $(this).css({'height': $(this).attr('data-init-h') + 'px'})
})

$('.hide-ul').hover(function () {
    if ($(this).attr('data-h') <= $(this).attr('data-init-h')) {
        return true
    }
    $(this).css({'height': $(this).attr('data-h') + 'px'})
}).mouseleave(function () {
    $(this).css({'height': $(this).attr('data-init-h') + 'px'})
})
