

$(document).ready(function () {
    // Go to section mobile
    if (ismobile) {
        /**
         * Changement des links
         */
        process.changeLinks();
    }

    /**
     * Choix logos
     */
    process.getLogos();
    
    /**
     * Choix Photos store
     */
    process.dropzone();

    /**
     * Autocomplete address
     */
    process.autocomplete();

    /**
     * Select boost Social
     */
    $('.social_choose').click(function () {
        process.boostSocial($(this));
    });


    /**
     * Calcul commission bost zotdeal
     */
    $('#boost_slider, #boost_top').change(function () {
        process.calculCommission();
    });

    $('#boost_target').change(function () {
        process.facebookTarget();
    });

    /**
     * Statistiques
     */
    $('ul.nav a').click('shown.bs.tab', function (e) {
        if ($(e.target).attr('href') == '#stats') {
            process.statsViews();
            process.statsSales();
        }
    });

    /**
     * Legal confirmation
     */
    if ($('#legalConfirm') != undefined) {
        process.legalConfirm();
    }
    
    /**
     * Changement de pass
     */
    $('#changePass').click(function(e){
        e.preventDefault();
        $('.changePass').slideDown();
        $('#changePass').hide();
    });
});

process = {
    legalConfirm: function () {
        $('#legalConfirm').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#legalConfirm').modal('show');
    },
    changeLinks: function () {
        $('a[aria-controls]').each(function () {
            if ($(this).attr('href_mobile') != undefined) {
                $(this).attr('href', $(this).attr('href_mobile'));
                $(this).removeAttr('data-toggle').removeAttr('aria-controls').removeAttr('aria-expanded').removeAttr('role').removeAttr('href_mobile');
            }
        });
    },
    autocomplete: function () {

        // Autocomplete EDIT
        var input = document.getElementById('address');
        autocomplete = new google.maps.places.SearchBox(input);
        autocomplete.addListener('places_changed', function () {
            var places = autocomplete.getPlaces();
            myAdress = places[0].address_components;
            // DEBUG !
            //console.log(myAdress);
            //console.log(places);
            if (places[0] != undefined) {
                if (places[0].types != undefined && places[0].types[0] != undefined && places[0].types[0] == 'street_address') {
                    for (key in myAdress) {
                        if (myAdress[key].types != undefined) {
                            if (myAdress[key].types[0] == 'postal_code') {
                                $('#zipcode').val(myAdress[key].long_name);
                            }
                            if (myAdress[key].types[0] == 'street_number') {
                                $('#address').val(myAdress[key].long_name);
                            }
                            if (myAdress[key].types[0] == 'route') {
                                $('#address').val($('#address').val() + ' ' + myAdress[key].long_name);
                            }
                        }
                    }

                }
            }

            // Latitude - Longitude
            lat = places[0].geometry.location.lat();
            lng = places[0].geometry.location.lng();
            if (lat != null && lng != null) {
                $('#latitude').val(lat);
                $('#longitude').val(lng);
            }
        });
    },
    boostSocial: function (target) {
        $('.social_choose').removeClass('btn-info');
        target.addClass('btn-info');
        $('#social_amount').val(target.attr('num'));
    },
    calculCommission: function () {
        priceTotal = 0;
        priceTotal += parseInt($('#boost_slider').val()) * 30;
        priceTotal += parseInt($('#boost_top').val()) * 10;
        $('#boost_zotdeal_calcul h4:eq(2)').html(priceToShow(priceTotal));
        if (priceTotal > 0) {
            $('#valid_boost_zotdeal').show();
        } else {
            $('#valid_boost_zotdeal').hide();
        }
    },
    statsViews: function () {
        if ($('.stats_view_data').data('count') != undefined) {
            stats = [];
            $('.stats_view_data').each(function () {
                stats.push({day: $(this).data('day'), value: $(this).data('count')})
            });
            $('#stats_views').css('width', parseInt($('#stats').width()) - 30);
            myStatsViews = new Morris.Line({
                parseTime: false,
                element: 'stats_views',
                data: stats,
                xkey: 'day',
                ykeys: ['value'],
                labels: ['Nombre de visiteurs']
            });
            myStatsViews.redraw();
            $('svg').css('width', parseInt($('#stats').width()) - 30);
        }
    },
    statsSales: function () {
        if ($('.stats_sales_data').data('count') != undefined) {
            statsSales = [];
            $('.stats_sales_data').each(function () {
                statsSales.push({day: $(this).data('day'), value: $(this).data('count')})
            });
            $('#stats_sales').css('width', parseInt($('#stats').width()) - 30);
            myStatsSales = new Morris.Line({
                element: 'stats_sales',
                data: statsSales,
                xkey: 'day',
                ykeys: ['value'],
                labels: ['Nombre de ventes']
            });
            myStatsSales.redraw();
            $('svg').css('width', parseInt($('#stats').width()) - 30);
        }
    },
    facebookTarget: function () {
        switch ($('#boost_target').val()) {
            case '0' :
                $('.social_choose:eq(0) span').html('17 000');
                $('.social_choose:eq(1) span').html('40 000');
                $('.social_choose:eq(2) span').html('100 000');
                break;
            case 'Nord' :
                $('.social_choose:eq(0) span').html('17 000');
                $('.social_choose:eq(1) span').html('37 000');
                $('.social_choose:eq(2) span').html('75 000');
                break;
            case 'Sud' :
                $('.social_choose:eq(0) span').html('13 000');
                $('.social_choose:eq(1) span').html('28 000');
                $('.social_choose:eq(2) span').html('47 000');
                break;
            case 'Est' :
                $('.social_choose:eq(0) span').html('12 000');
                $('.social_choose:eq(1) span').html('26 000');
                $('.social_choose:eq(2) span').html('36 000');
                break;
            case 'Ouest' :
                $('.social_choose:eq(0) span').html('13 000');
                $('.social_choose:eq(1) span').html('28 000');
                $('.social_choose:eq(2) span').html('49 000');
                break;
        }
    },
    getLogos: function (category_id) {
        $('.logos').html('');
        // Ajout des photos de couverture
        $.ajax({
            url: $('#base_url').val() + "ajax/loadBrandLogos",
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON != 'false') {
                for (key in res.responseJSON) {
                    $('.logos').append('<div class="col-md-3 mb-5 text-center" ' + (ismobile == true ? '' : 'style="height: 125px;"') + '><a href="#" class="logoToChoose" image="shops/' + res.responseJSON[key] + '"><img src="' + $('#base_url').val() + 'assets/images/brands/shops/' + res.responseJSON[key] + '" ' + (ismobile == true ? '' : 'style="max-height: 125px;"') + ' /></div>');
                }
                $('.logos').append('<div class="clear clearfix">&nbsp;</div>');
                process.chooseLogo();
            } else {
                // Error
            }
        }).error(function () {
            // Error
        });
    },
    chooseLogo: function () {
        $('.logoToChoose').unbind('click');
        $('.logoToChoose').click(function (e) {
            e.preventDefault();
            _this = $(this);
            $.ajax({
                url: $('#base_url').val() + "ajax/updateLogo",
                data: {logo: $(this).attr('image')},
                method: 'post',
                dataType: 'json'
            }).complete(function (res) {
                if (res.responseJSON != undefined && res.responseJSON == true) {
                    $('#logo_brand').attr('src', $('#base_url').val() + 'assets/images/brands/' + _this.attr('image'));
                    $('#chooseLogo').modal('hide');
                } else {
                    // Error
                    //window.location.href = $('#base_url').val() + 'store/pro?notif=unknown';
                }
            }).error(function () {
                // Error
                //window.location.href = $('#base_url').val() + 'store/pro?notif=unknown';
            });
        });
    },
    dropzone: function () {
        // Désactive Dropzone onload
        Dropzone.autoDiscover = false;
        // Dropzone
        $("#addMyPics").dropzone({
            url: $('#base_url').val() + 'ajax/addPicsStore/',
            addRemoveLinks: true,
            dictRemoveFile: 'Supprimer',
            dictCancelUpload: 'Annuler',
            dictInvalidFileType: "Fichier non autorisé",
            dictFileTooBig: "Cette photo est trop grande. Maximum autorisé : {{maxFilesize}}Mb",
            maxFilesize: 10,
            maxFiles: 4,
            acceptedFiles: 'image/*',
            dictDefaultMessage: '<h3 class="text-center"><span class="font-lg"><i class="fa fa-photo"></i> .png .jpg .gif <span class="font-xs"></span></span><h3>&nbsp&nbsp<h4 class="display-inline"></h4>',
            dictResponseError: 'Erreur durant l\'envoi de vos photos',
            removedfile: function (file) {
                // Todo 
                $.ajax({
                    url: $('#base_url').val() + "ajax/deletePicsStore/",
                    data: {name: file.name},
                    dataType: 'json',
                    method: 'post'
                }).complete(function (res) {
                    if (res.responseJSON != undefined && res.responseJSON != 'false') {
                        $(file.previewElement).remove();
                    } else {
                        // Error
                    }
                }).error(function () {
                    // Error
                });
            }
        });
    }
}