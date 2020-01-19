$(document).ready(function () {
    $('.addToFavorites').click(function (e) {
        e.preventDefault();
        _this = $(this);
        $.ajax({
            url: $('#base_url').val() + "ajax/addToFavorites/" + $(this).attr('deals_id'),
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON == 'not_logged') {
                // Pas connecté > Signup
                window.location.href = $('#base_url').val() + 'users/signup?add_to_favorite=' + _this.attr('deals_id')+'&notif=bad_favorite';
            } else if (res.responseJSON != undefined && res.responseJSON == 'true') {
                if (_this.attr('type') == 'photo') {
                    // Connecté
                    $('i', _this).addClass('is-favorite');
                    _this.addClass('bg-white');
                    _this.parent().attr('title', 'Favoris!').removeClass('cursor-pointer');
                } else {
                    _this.html('<i class="fa fa-heart"></i> Favoris !');
                }
                dealsUpdated = parseInt($('#total_favorites').val()) + 1;
                $('.favorite-count').html(parseInt($('#total_favorites').val()) + 1);
                $('#total_favorites').val(dealsUpdated);
            } else {
                // TODO Coeur barré ?
            }
        }).error(function () {
            // TODO Coeur barré ?
        });
    });

    $('.deleteDeal').click(function (e) {
        e.preventDefault();
        _this = $(this);
        $.ajax({
            url: $('#base_url').val() + "ajax/deleteFavorite/" + $(this).attr('deals_id'),
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON == 'not_logged') {
                // Pas connecté > Signup
                window.location.href = $('#base_url').val() + 'users/signup?add_to_favorite=' + $(this).attr('deals_id');
            } else if (res.responseJSON != undefined && res.responseJSON == 'true') {
                _this.parent().parent().slideUp();
                dealsUpdated = parseInt(_this.attr('total_deals')) - 1;
                $('.favorite-count').html(dealsUpdated);
                $('.deleteDeal').attr('total_deals', dealsUpdated);
                $('#total_favorites').val(dealsUpdated);
            } else {
                // TODO Coeur barré ?
            }
        }).error(function () {
            // TODO Coeur barré ?
        });
    });
});