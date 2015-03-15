$(function(){
    if($('.partners-block').height() > 344){
        $('.wrap_footer').css({
            'margin-top' : -($('.partners-block').height() + $('.footer').height() + 4) + 'px'
        });
        $('.wrap_content').css({
            'padding-bottom' : ($('.partners-block').height() + $('.footer').height() + 4) + 'px'
        });
    }

//  Слайдер новостей
    $('.content-left-block .content-slide-block.second').click(function(){
        var object = $(this);
        $('.content-left-block .content-slide-block.second').removeClass('current');
        object.addClass('current');
        $('.content-left-block .content-slide-block.first *').fadeOut(200, function(){
            $('.content-left-block .content-slide-block.first').html(object.html()).find('*').hide();
            $('.content-left-block .content-slide-block.first img.little').remove();
            $('.content-left-block .content-slide-block.first img.big').removeClass('hide');
            $('.content-left-block .content-slide-block.first *').fadeIn(200);
        });
    });
});