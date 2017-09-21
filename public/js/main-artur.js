$(document).ready(function () {
    $('.horoscope-path').each(function () {
        var h = $(this).height();
        $(this)
            .attr('data-h', h)
            .css({'height': '161px'});
    });

    $('.span-spoiler').click(function () {
        // z = 145
        // if() планшет z = ??
        //else if мобиле z = ??

        $('.horoscope-path').css({'height': 161 + 'px'});
        var h = $(this).parents('.horoscope-description').find('.horoscope-path').attr('data-h');
        var opa = $(this).parent().hasClass('opened');
        $('.horoscope-controller.opened').removeClass('opened');

        if (!opa) {
            $(this).parent().addClass('opened');
            $(this).parents('.horoscope-description').find('.horoscope-path').css({'height': h + 'px'});

        }
    });

});

