$(document).ready(function(){
    // Centrage de la pub
    width = $('.categories div:eq(0) > figure').width();
    height = $('.categories div:eq(0)').height();
    paddingLeft = $('.categories div:eq(0)').css('paddingLeft');

    heightPubButton = $('publicite > div:eq(0)').height();
    if(height > 280) {
        $('.publicite').css('width', width).css('height', height).css('display', 'block').css('marginLeft', paddingLeft);
        $('.publicite > div:eq(1)').css('margin-top', (height-heightPubButton-280)/2);
    }
});