/**
 * Navigation catégories / sub catégories
 */
$(document).ready(function () {
    /** 
     * INIT
     */
    process.calculDiscount();
    process.dropzone();
    process.typePrice();

    process.datepickers();
    $('.validDeal').click(function (e) {
        validator = step.validStep3();
        if (validator) {
            $('#addDealProcess').submit();
        }
    });

    $('.coupon_choose').click(function () {
        $('.coupon_choose').removeClass('btn-info');
        $(this).addClass('btn-info');
        $('#coupons').val($(this).attr('num'));
    });
    $('#validite').change(function () {
        if ($(this).val() == '4') {
            $('#date_valid_group').show();
        } else {
            $('#date_valid_group').hide();
        }
    });
    /**
     * Loading des sous categories
     */
    $('.categorieChoosed').click(function (e) {
        e.preventDefault();
        $('.categoryChoosed').html($(this).html()).attr('category_id', $(this).attr('category_id'));
        $('#category_id').val($(this).attr('category_id'));
        $('.subCategoriesChoosed').show();
        $('.subCategoryError').hide();
        $('.subCategories').html('');
        $.ajax({
            url: $('#base_url').val() + "ajax/getSubCategories/" + $(this).attr('category_id'),
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON[0] != undefined) {
                for (key in res.responseJSON) {
                    $('.subCategories').append('<li><a href="#" subcategory_id="' + res.responseJSON[key]['id'] + '"><i class="fa fa-arrow-right"></i> ' + res.responseJSON[key]['name'] + '</a></li>');
                }
                // Init de la nav
                step.goStep2();
            } else {
                $('.subCategoryError').show();
            }
        }).error(function () {
            $('.subCategoryError').show();
        });
    });

    // Retour categories
    $('.changeCategory').click(function () {
        step.returnStep1();
    });

    // Retour deal
    $('.modifyDeal').click(function () {
        step.returnStep2();
    });
});

/**
 * Gestion des étapes
 */
step = {
    returnStep1: function () {
        $(".step_2").animate({width: 'toggle'}, 350, 'linear', function () {
            $(".step_1").show();
        });
    },
    goStep2: function () {
        $('.subCategories li a').unbind('click');
        $('.subCategories li a').click(function (e) {
            e.preventDefault();
            $('.subCategoryChoosed').html($(this).html());
            $('#subcategory_id').val($(this).attr('subcategory_id'));
            process.getCovers($('.categoryChoosed').attr('category_id'));
            $(".step_1").animate({width: 'toggle'}, 350, 'linear', function () {
                if ($('#type_deal').val() == 'boutique') {
                    $(".step_3").show();
                } else {
                    $(".step_2").show();
                    process.loadTinymce();
                    // Go Step informations client
                    $('.goStep3').unbind('click');
                    $('.goStep3').click(function () {
                        step.goStep3();
                    });
                }
            });

        });
    },
    returnStep2: function () {
        $(".step_3").animate({width: 'toggle'}, 350, 'linear', function () {
            $(".step_2").show();
            process.loadTinymce();
        });
    },
    validStep2: function () {
        $('.alert').hide();
        $('input, textarea').css('border-color', '');

        error = false;
        title = $('#title');
        start = $('#start');
        start_submit = $('input[name="start_submit"]');
        end = $('#end');
        end_submit = $('input[name="end_submit"]');
        price_base = $('#price_base');
        price_promo = $('#price_promo');
        promo_amount = $('#promo_amount');
        promo_discount = $('#promo_discount');
        excerpt = $('#excerpt');
        content = $('#content').val();
        date_valid = $('#date_valid');

        if (title.val() == '' || title.val().length <= 5 || title.val().length > 25) {
            error = true;
            title.css('border-color', 'red');
            title.next('.alert').show();
        }
        if (start_submit.val() == '' || !isValidDate(start_submit.val())) {
            error = true;
            start.css('border-color', 'red');
            start_submit.parent().next('.alert').show();
        }
        if (end_submit.val() == '' || !isValidDate(end_submit.val())) {
            error = true;
            end.css('border-color', 'red');
            end_submit.parent().next('.alert').show();
        }
        if (price_base.val() == '' || !$.isNumeric(price_base.val())) {
            error = true;
            price_base.css('border-color', 'red');
            price_base.parent().next('.alert').show();
        }
        if (price_promo.val() == '' || !$.isNumeric(price_promo.val())) {
            error = true;
            price_promo.css('border-color', 'red');
            price_promo.parent().next('.alert').show();
        }
        if (promo_amount.val() == '' || !$.isNumeric(promo_amount.val())) {
            error = true;
            promo_amount.css('border-color', 'red');
            promo_amount.parent().next('.alert').show();
        }
        if (promo_discount.val() == '' || !$.isNumeric(promo_discount.val())) {
            error = true;
            promo_discount.css('border-color', 'red');
            promo_discount.parent().next('.alert').show();
        }
        if (excerpt.val() == '' || excerpt.val().length <= 5 || excerpt.val().length > 85) {
            error = true;
            excerpt.css('border-color', 'red');
            excerpt.next('.alert').show();
        }
        if ($('#validite').val() == '4' && date_valid.val() == '') {
            error = true;
            date_valid.css('border-color', 'red');
            date_valid.parent().next('.alert').show();
        }
        if (process.getTinymce() == '' || process.getTinymce() == 'Description complète de mon ' + $('#type_deal_full').val() + '...' || parseInt($('.mce-wordcount').html().replace('Mots : ', '')) < 50) {
            error = true;
            $('#content').css('border-color', 'red');
            $('.alert', $('#content').parent()).show();
        }
        if ($('#cover').val() == '') {
            error = true;
            $('.errorCover').show();
        }

        if (error == true) {
            return false;
        } else {
            return true;
        }
    },
    goStep3: function () {
        validation = step.validStep2();
        if ($('#pro_id').val() != undefined && $('#pro_id').val() != '' && validation == true) {
            $('#addDealProcess').submit();
            return;
        }
        if (validation == true) {
            $(".step_2").animate({width: 'toggle'}, 350, 'linear', function () {
                process.addressAutocomplete();
                $(".step_3").show();
            });
        }
    },
    validStep3: function () {
        $('.alert').hide();
        $('input, textarea').css('border-color', '');

        error = false;
        company = $('#company');
        siret = $('#siret');
        name_dealer = $('#name_dealer');
        address = $('#address');
        zipcode = $('#zipcode');
        city = $('#city');
        phone = $('#phone');
        email = $('#email');
        legal = $('#legal');

        if (company.val() == '' || company.val().length <= 3 || company.val().length >= 30) {
            error = true;
            company.css('border-color', 'red');
            company.parent().next('.alert').show();
        }
        if (siret.val() == '') {
            error = true;
            siret.css('border-color', 'red');
            siret.parent().next('.alert').show();
        }
        if (name_dealer.val() == '' || name_dealer.val().length <= 3) {
            error = true;
            name_dealer.css('border-color', 'red');
            name_dealer.parent().next('.alert').show();
        }
        if (address.val() == '' || address.val().length <= 5) {
            error = true;
            address.css('border-color', 'red');
            address.parent().next('.alert').show();
        }
        if (city.val() == '' || city.val().length <= 2) {
            error = true;
            city.css('border-color', 'red');
            city.parent().next('.alert').show();
        }
        if (zipcode.val() == '') {
            error = true;
            zipcode.css('border-color', 'red');
            zipcode.parent().next('.alert').show();
        }
        if (phone.val() == '' || !$.isNumeric(phone.val())) {
            error = true;
            phone.css('border-color', 'red');
            phone.parent().next('.alert').show();
        }
        if (email.val() == '' || email.val().length <= 3 || !validateEmail(email.val())) {
            error = true;
            email.css('border-color', 'red');
            email.parent().next('.alert').show();
        }

        if (legal.is(':checked') == false) {
            error = true;
            $('.alert', legal.parent()).show();
        }

        if (error == true) {
            return false;
        } else {
            return true;
        }
    },
}

/**
 * Gestion du process
 */
process = {
    datepickers: function () {
        /*configFR = {
         monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
         monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
         weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
         weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
         today: 'Aujourd\'hui',
         clear: 'Effacer',
         close: 'Fermer',
         firstDay: 1,
         format: 'dd/mm/yyyy',
         formatSubmit: 'dd/mm/yyyy',
         labelMonthNext: "Mois suivant",
         labelMonthPrev: "Mois précédent",
         labelMonthSelect: "Sélectionner un mois",
         labelYearSelect: "Sélectionner une année"
         }*/
        configFR = {
            firstDay: 1,
            format: 'yyyy-mm-dd',
            formatSubmit: 'yyyy-mm-dd'
        }
        var from_$input = $('#start').pickadate(configFR),
                from_picker = from_$input.pickadate('picker');

        var to_$input = $('#end').pickadate(configFR),
                to_picker = to_$input.pickadate('picker');
        $('#date_valid').pickadate(configFR);


        // Check if there’s a “from” or “to” date to start with.
        if (from_picker.get('value')) {
            to_picker.set('min', from_picker.get('select'));
        }
        if (to_picker.get('value')) {
            from_picker.set('max', to_picker.get('select'));
        } 

        // When something is selected, update the “from” and “to” limits.
        if ($('#type_deal').val() != 'bon-plan') {
            from_picker.on('set', function (event) {
                if (event.select) {
                    dateExploded = $('#start').val().split('/');
                    var nextDay = new Date(dateExploded[2] + '-' + dateExploded[1] + '-' + dateExploded[0]);
                    nextDay.setDate(nextDay.getDate() + 60);
                    to_picker.set('min', from_picker.get('select'));
                    to_picker.set('max', nextDay);
                } else if ('clear' in event) {
                    to_picker.set('min', false);
                    to_picker.set('max', false);
                }
            });
            to_picker.on('set', function (event) {
                if (event.select) {
                    dateExploded = $('#end').val().split('/');
                    var nextDay = new Date(dateExploded[2] + '-' + dateExploded[1] + '-' + dateExploded[0]);
                    nextDay.setDate(nextDay.getDate() - 60);
                    from_picker.set('max', to_picker.get('select'));
                    from_picker.set('min', nextDay);
                } else if ('clear' in event) {
                    from_picker.set('max', false);
                    from_picker.set('min', false);
                }
            });
        }
    },
    typePrice: function () {
        $('#price_type').change(function () {
            switch ($(this).val()) {
                case 'free' :
                case 'quotation' :
                    $('#price_base').val('0');
                    $('#price_base').attr('disabled', 'disabled');
                    $('.price_baseField').slideUp();
                    $('.tvaField').slideUp();
                    if ($(this).val() == 'quotation') {
                        $('.quotation_onlineField').slideDown();
                    } else {
                        $('.quotation_onlineField').slideUp();
                        $('#coupons').val(0);
                    }
                    break;
                default :
                    $('.price_baseField').slideDown();
                    $('.tvaField').slideDown();
                    $('#price_base').removeAttr('disabled');
                    $('.quotation_onlineField').slideUp();
                    $('#coupons').val(0);
                    break;
            }
        });

        $('#quotation_online').change(function () {
            if ($(this).is(':checked')) {
                $('#plan_quotation').slideDown();
                $('#coupons').val(10);
            } else {
                $('#plan_quotation').slideUp();
                $('#coupons').val(0);
            }
        });
    },
    calculDiscount: function () {
        // Fonction du prix promo
        $('#price_promo, #price_base').change(function () {
            prixBase = $('#price_base').val();
            prixPromo = $('#price_promo').val();
            if (prixBase != '' && $.isNumeric(prixBase) && prixPromo != '' && $.isNumeric(prixPromo)) {
                $('#promo_amount').val(prixBase - prixPromo);
                $('#promo_discount').val(Math.abs(parseInt((prixPromo - prixBase) / prixBase * 100)));
                process.calculComission();
            }
        });

        // Fonction d'un montant de réduc
        $('#promo_amount').change(function () {
            prixBase = $('#price_base').val();
            promoAmount = $('#promo_amount').val();
            if (prixBase != '' && $.isNumeric(prixBase) && promoAmount != '' && $.isNumeric(promoAmount)) {
                $('#price_promo').val(prixBase - promoAmount);
                prixPromo = $('#price_promo').val();
                $('#promo_discount').val(Math.abs(parseInt((prixPromo - prixBase) / prixBase * 100)));
                process.calculComission();
            }
        });

        // Fonction d'un pourcentage de réduc
        $('#promo_discount').change(function () {
            prixBase = $('#price_base').val();
            promoDiscount = $('#promo_discount').val();
            if (prixBase != '' && $.isNumeric(prixBase) && promoDiscount != '' && $.isNumeric(promoDiscount)) {
                $('#promo_discount').val(Math.abs(promoDiscount));
                promoDiscount = $('#promo_discount').val();
                $('#price_promo').val(parseInt(prixBase - (prixBase * parseInt(promoDiscount) / 100)));
                prixPromo = $('#price_promo').val();
                $('#promo_amount').val(prixBase - prixPromo);
                process.calculComission();
            }
        });

        // Bon plan
        if ($('#type_deal').val() == 'bon-plan') {
            $('#price_base').change(function () {
                process.calculComission();
            });
            $('#start').change(function () {
                process.calculComission();
            });
            $('#end').change(function () {
                process.calculComission();
            });
        }

    },
    calculComission: function () {
        $('#commission').hide();
        $('#coupon').hide();
        $('#plan').hide();
        if ($('#type_deal').val() == 'deal') {
            promoPrice = parseInt($('#price_promo').val());
            if (promoPrice > 0 && promoPrice != '') {
                $('#commission h4:eq(2)').html(priceToShow(parseInt(parseInt(promoPrice) - (parseInt(promoPrice) * (parseInt($('#coef_deals').val()) / 100)))));
                $('#commission').slideDown();
            } else {
                $('#commission').hide();
            }
        } else if ($('#type_deal').val() == 'bon-de-réduction') {
            promoPrice = parseInt($('#price_promo').val());
            if (promoPrice > 0 && promoPrice != '') {
                $('#coupon a:eq(0) span').html(priceToShow(parseInt((parseInt(promoPrice) * (parseInt($('#coef_coupons').val()) / 100) * 10))));
                $('#coupon a:eq(1) span').html(priceToShow(parseInt((parseInt(promoPrice) * (parseInt($('#coef_coupons').val()) / 100) * 50))));
                $('#coupon a:eq(2) span').html(priceToShow(parseInt((parseInt(promoPrice) * (parseInt($('#coef_coupons').val()) / 100) * 100))));
                $('#coupon').slideDown();
            } else {
                $('#coupon').hide();
            }
        } else {
            /*price = parseInt($('#price_base').val());
             if (price > 0 && price != '' && $('#start').val() != '' && $('#end').val() != '') {
             dateStart = $('#start').val().split('/');
             var dateStart = new Date(dateStart[2] + '-' + dateStart[1] + '-' + dateStart[0]);
             dateEnd = $('#end').val().split('/');
             var dateEnd = new Date(dateEnd[2] + '-' + dateEnd[1] + '-' + dateEnd[0]);
             // Nombre de jours entre les é dates
             WNbJours = dateEnd.getTime() - dateStart.getTime();
             diffDays = Math.ceil(WNbJours / (1000 * 60 * 60 * 24));
             
             $('#plan h4:eq(2)').html(priceToShow(parseInt((parseInt(price) * 0.01 * diffDays)));
             $('#plan').slideDown();
             } else {
             $('#plan').hide();
             }*/
        }

    },
    getCovers: function (category_id) {
        $('.loadingCoversError').hide();
        $('.covers').html('');
        // Ajout des photos de couverture
        $.ajax({
            url: $('#base_url').val() + "ajax/loadImagesCategory/" + category_id,
            dataType: 'json'
        }).complete(function (res) {
            if (res.responseJSON != undefined && res.responseJSON != 'false') {
                for (key in res.responseJSON) {
                    $('.covers').append('<div class="col-md-3 mb-5 text-center" ' + (ismobile == true ? '' : 'style="height: 125px;"') + '><a href="#" class="coverToChoose" image="' + res.responseJSON[key] + '"><img src="' + $('#base_url').val() + 'assets/images/' + res.responseJSON[key] + '" ' + (ismobile == true ? '' : 'style="max-height: 125px;"') + ' /></div>');
                }
                $('.covers').append('<div class="clear clearfix">&nbsp;</div>');
                process.chooseCover();
            } else {
                $('.loadingCoversError').show();
            }
        }).error(function () {
            $('.loadingCoversError').show();
        });
    },
    chooseCover: function () {
        $('.coverToChoose').unbind('click');
        $('.coverToChoose').click(function (e) {
            e.preventDefault();
            $('.coverToChoose img').css('border', '');
            $('img', this).css('border', '3px solid lightgreen');
            $('#cover').val($(this).attr('image'));
            $('#chooseCover').modal('hide');
        });
    },
    addressAutocomplete: function () {
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
                            if (myAdress[key].types[0] == 'locality') {
                                $('.city_deal').val(myAdress[key].long_name).html(myAdress[key].long_name);
                            }
                            if ((myAdress[key].types[0] == 'administrative_area_level_1' || myAdress[key].types[0] == 'administrative_area_level_2') && $('#city').val() == '') {
                                $('.city_deal').val(myAdress[key].long_name).html(myAdress[key].long_name);
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
    loadTinymce: function () {
        tinymce.init({
            selector: '#content',
            menubar: false,
            language: 'fr_FR',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | link'
        });
    },
    getTinymce: function () {
        return tinymce.activeEditor.getContent({format: 'text'});
    },
    dropzone: function () {
        // Désactive Dropzone onload
        Dropzone.autoDiscover = false;
        // Dropzone
        $("#addMyPics").dropzone({
            url: $('#base_url').val() + 'ajax/addPics/',
            addRemoveLinks: true,
            dictRemoveFile: 'Supprimer',
            dictCancelUpload: 'Annuler',
            dictInvalidFileType: "Fichier non autorisé",
            dictFileTooBig: "Cette photo est trop grande. Maximum autorisé : {{maxFilesize}}Mb",
            maxFilesize: 10,
            maxFiles: 20,
            acceptedFiles: 'image/*',
            dictDefaultMessage: '<h3 class="text-center"><span class="font-lg"><i class="fa fa-photo"></i> .png .jpg .gif <span class="font-xs"></span></span><h3>&nbsp&nbsp<h4 class="display-inline"></h4>',
            dictResponseError: 'Erreur durant l\'envoi de vos photos',
            removedfile: function (file) {
                // Todo 
                $.ajax({
                    url: $('#base_url').val() + "ajax/deletePics/" + ($('#deals_id').val() != undefined ? $('#deals_id').val() : 'false'),
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
            },
            init: function () {
                if ($('#deals_id').val() != undefined) {
                    var thisDropzone = this;
                    $.getJSON($('#base_url').val() + "ajax/loadDealImages/" + $('#deals_id').val(), function (data) {
                        $.each(data, function (key, value) {
                            var mockFile = {name: value.name, size: value.size};
                            thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                            thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.url);
                        });
                    });
                }
            }
        });
    }

}