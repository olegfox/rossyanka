$(function(){
    if($('.partners-block').height() > 344){
        $('.wrap_footer').css({
            'margin-top' : -($('.partners-block').height() + $('.footer').height() + 4) + 'px'
        });
        $('.wrap_content').css({
            'padding-bottom' : ($('.partners-block').height() + $('.footer').height() + 4) + 'px'
        });
    }
});