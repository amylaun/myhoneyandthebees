/* Defer Background images - we may want to move this to the footer, but we would have to remove jquery */
jQuery(window).load(function () {
    var imgs = [];
    jQuery('[data-bg]').each(function(i){
        var thisBG = jQuery(this);
        var src = thisBG.attr('data-bg');
        imgs[i] = new Image();
        imgs[i].onload = function(){
            thisBG.css({backgroundImage:'url('+src+')'});
        };
        imgs[i].src = src;
    });
});
