$(document).ready(function () {
    $('.addToCart').click(function (e) {
        e.preventDefault();
        _this = $(this);
        $.ajax({
            url: $('#base_url').val() + "ajax/addToCart/" + $(this).attr('deals_id'),
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON == 'true') {
                window.location.href = $('#base_url').val() + 'users/cart?notif=product_added';
            } else {
                // TODO Coeur barré ?
            }
        }).error(function () {
            // TODO Coeur barré ?
        });
    });

    $('.deleteInCart').click(function (e) {
        e.preventDefault();
        _this = $(this);
        $.ajax({
            url: $('#base_url').val() + "ajax/deleteInCart/" + $(this).attr('deals_id'),
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON == 'true') {
                window.location.href = $('#base_url').val() + 'users/cart';
            } else {
                // TODO Coeur barré ?
            }
        }).error(function () {
            // TODO Coeur barré ?
        });
    });
});