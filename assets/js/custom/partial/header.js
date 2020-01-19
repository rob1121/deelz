$(document).ready(function () {
    $('.header_cat a').hover(function () {
        $('.category_bloc').hide();
        $('.category_bloc_' + $(this).parent().attr('category_id')).show();
    });
    
    // Lancement de la popup pro après 7 secondes
    setTimeout('header.proPopup()', 10000);
});
header = {
    /**
     * Ouverture de la popup pro
     */
    proPopup: function () {
        $.getJSON($('#base_url').val() + "ajax/proPopup", function (data) {
            if (data == true) {
                $('#proPopup').modal('show');
            }
        });
    }
}