// Init Vars
var latUser = false;
var lngUser = false;
var mapStore = false;
var mapDeal = false;

$(document).ready(function () { 

    process.showDeals();

    $('#show_stores').click(function () {
        process.showStores();
    });

    $('#show_deals').click(function () {
        process.showDeals();
    });
    $('#geoloc').change(function () {
        process.geoloc();
    });
    $('.change_category').change(function () {
        process.changeCategory();
    });
});

process = {
    showStores: function () {
        $('#show_stores').addClass('btn-info');
        $('#show_deals').removeClass('btn-info');
        $('#deals-map').hide();
        $('#store-map').show();
        var mapCanvas = document.getElementById('store-map');

        var markers = [];

        var mapOptions = {
            center: new google.maps.LatLng(latUser == false ? $('#store-map').data('latitude') : latUser, lngUser == false ? $('#store-map').data('longitude') : lngUser),
            zoom: latUser == false ? $('#deals-map').data('zoom') : 13,
            scrollwheel: false,
            panControl: false,
            zoomControl: true,
            scaleControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        mapStore = new google.maps.Map(mapCanvas, mapOptions);

        var latlng = [];
        var allMakers = [];
        var i = 0;

        // Créé un tab des catégories acceptées pour l'affichage
        categoriesAccepted = [];
        $('.change_category:checked').each(function () {
            categoriesAccepted.push(parseInt($(this).val()));
        });

        $('.store-localization').each(function (k, v) {
            if ($.inArray(parseInt($(v).data('category')), categoriesAccepted) > -1) {
                var precision = 5;

                var latitude = $(v).data('latitude');
                var longitude = $(v).data('longitude');

                if (latitude != '' && latitude != undefined) {
                    latitude = parseFloat(latitude.toFixed(precision));
                    longitude = parseFloat(longitude.toFixed(precision));

                    var exists = false;
                    for (var j = 0; j < allMakers.length; j++) {
                        if (allMakers[j]['lat'] == latitude && allMakers[j]['lng'] == longitude) {
                            exists = true;
                            var foundIndex = j;
                        }
                    }

                    if (exists) {
                        // Update marker informations if latitude and longitude already exist
                        allMakers[foundIndex].title = 'Plusieurs commerces à cet endroit';
                        allMakers[foundIndex].description += '<hr /><strong>' + $(v).data('title') + '</strong><br />' + $(v).data('address') + '<br /><a href="' + $(v).data('link') + '">Voir leur page</a>';
                        allMakers[foundIndex].label++;
                    } else {
                        // Create marker
                        allMakers[i] = {};
                        allMakers[i].lat = latitude;
                        allMakers[i].lng = longitude;
                        allMakers[i].title = $(v).data('title');
                        allMakers[i].description = '<a href="' + $(v).data('link') + '"><img src="' + $(v).data('image') + '" style="max-height: 150px; max-width: 150px;" /></a><br />';
                        allMakers[i].description += '<strong class="mb-5">' + $(v).data('title') + '</strong><br />' + $(v).data('address') + '<br /><a href="' + $(v).data('link') + '" class="btn btn-xs mt-5"><i class="fa fa-eye"></i> Voir sa boutique</a>';
                        allMakers[i].label = 1;
                        i++;
                    }
                }
            }
        });
        marker = [];
        $.each(allMakers, function (k, v) {
            // Marker creation
            marker[k] = new google.maps.Marker({
                position: {lat: v.lat, lng: v.lng},
                map: mapStore,
                title: v.title,
                icon: {
                    url: 'https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%7CEE639E',
                    labelOrigin: new google.maps.Point(11, 11)
                },
                label: {
                    text: v.label.toString(),
                    color: 'white',
                    fontSize: '11px',
                    fontWeight: 'bold'
                }
            });

            markers.push(marker[k]);

            // Make tooltip open with a click
            marker[k].addListener('mouseover', function () {
                if (typeof infowindow !== 'undefined')
                    infowindow.close();
                // Tooltip creation
                infowindow = new google.maps.InfoWindow({
                    content: v.description,
                    maxWidth: 300
                });
                infowindow.open(mapStore, marker[k]);
            });

            google.maps.event.addListener(mapStore, 'click', function (event) {
                if (typeof infowindow !== 'undefined')
                    infowindow.close();
            });

            latlng.push(new google.maps.LatLng(v.lat, v.lng));
        });

        var latlngbounds = new google.maps.LatLngBounds();
        for (var i = 0; i < latlng.length; i++) {
            latlngbounds.extend(latlng[i]);
        }
        //mapStore.fitBounds(latlngbounds);

        var markerCluster = new MarkerClusterer(mapStore, markers, {
            maxZoom: 15,
            imagePath: $('#base_url').val() + 'assets/images/brands/boutique',
            styles: [{
                    textColor: '#FFFFFF',
                    url: $('#base_url').val() + 'assets/images/brands/store.png',
                    width: 55,
                    height: 55,
                    fontWeight: 'bold',
                    textSize: 14
                }]
        });
    },
    showDeals: function () {
        $('#show_stores').removeClass('btn-info');
        $('#show_deals').addClass('btn-info');
        $('#store-map').hide();
        $('#deals-map').show();
        var mapCanvas = document.getElementById('deals-map');

        var markers = [];

        var mapOptions = {
            center: new google.maps.LatLng(latUser == false ? $('#deals-map').data('latitude') : latUser, lngUser == false ? $('#deals-map').data('longitude') : lngUser),
            zoom: latUser == false ? $('#deals-map').data('zoom') : 13,
            scrollwheel: false,
            panControl: false,
            zoomControl: true,
            scaleControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        mapDeal = new google.maps.Map(mapCanvas, mapOptions);

        var latlng = [];
        var allMakers = [];
        var i = 0;

        // Créé un tab des catégories acceptées pour l'affichage
        categoriesAccepted = [];
        $('.change_category:checked').each(function () {
            categoriesAccepted.push(parseInt($(this).val()));
        });

        $('.deals-localization').each(function (k, v) {
            if ($.inArray(parseInt($(v).data('category')), categoriesAccepted) > -1) {
                var precision = 5;

                var latitude = $(v).data('latitude');
                var longitude = $(v).data('longitude');

                if ($(v).data('latitude') != '') {
                    latitude = parseFloat(latitude.toFixed(precision));
                    longitude = parseFloat(longitude.toFixed(precision));

                    var exists = false;
                    for (var j = 0; j < allMakers.length; j++) {
                        if (allMakers[j]['lat'] == latitude && allMakers[j]['lng'] == longitude) {
                            exists = true;
                            var foundIndex = j;
                        }
                    }

                    if (exists) {
                        // Update marker informations if latitude and longitude already exist
                        allMakers[foundIndex].title = 'Plusieurs bons plans à cet endroit';
                        allMakers[foundIndex].description += '<hr /><strong>' + $(v).data('title') + '</strong><br />' + $(v).data('company') + '<br /><a href="' + $(v).data('link') + '"><img src="' + $(v).data('image') + '" style="max-height: 150px; max-width: 150px;" /></a><br /><a href="' + $(v).data('link') + '">Voir le bon plan</a>';
                        allMakers[foundIndex].label++;
                    } else {
                        // Create marker
                        allMakers[i] = {};
                        allMakers[i].lat = latitude;
                        allMakers[i].lng = longitude;
                        allMakers[i].title = $(v).data('title');
                        allMakers[i].description = '<a href="' + $(v).data('link-company') + '" class="btn btn-xs mt-5"><i class="fa fa-eye"></i> Voir la boutique</a><br /><br /><strong class="mb-5">' + $(v).data('title') + '</strong><br />' + $(v).data('company') + '<br /><a href="' + $(v).data('link') + '"><img  style="max-height: 150px; max-width: 150px;" src="' + $(v).data('image') + '" /></a>';
                        allMakers[i].label = 1;
                        i++;
                    }
                }
            }
        });

        marker = [];
        $.each(allMakers, function (k, v) {
            // Marker creation
            marker[k] = new google.maps.Marker({
                position: {lat: v.lat, lng: v.lng},
                map: mapDeal,
                title: v.title,
                icon: {
                    url: 'https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%7CEE639E',
                    labelOrigin: new google.maps.Point(11, 11)
                },
                label: {
                    text: v.label.toString(),
                    color: 'white',
                    fontSize: '11px',
                    fontWeight: 'bold'
                }
            });
            markers.push(marker[k]);
            // Pour les clusters
            /*for (i = v.label; i >= 1; i--) {
                markers.push(new google.maps.Marker({
                    position: {lat: v.lat, lng: v.lng},
                    map: mapDeal,
                    title: v.title,
                    icon: {
                        url: 'https://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%7CEE639E',
                        labelOrigin: new google.maps.Point(11, 11)
                    },
                    label: {
                        text: v.label.toString(),
                        color: 'white',
                        fontSize: '11px',
                        fontWeight: 'bold'
                    }
                }));
            }*/

            // Make tooltip open with a hover
            marker[k].addListener('mouseover', function () {
                if (typeof infowindow !== 'undefined')
                    infowindow.close();
                // Tooltip creation
                infowindow = new google.maps.InfoWindow({
                    content: v.description,
                    maxWidth: 300
                });
                infowindow.open(mapDeal, marker[k]);
            });
            marker[k].addListener('click', function () {
                if (typeof infowindow !== 'undefined')
                    infowindow.close();
                // Tooltip creation
                infowindow = new google.maps.InfoWindow({
                    content: v.description,
                    maxWidth: 300
                });
                infowindow.open(mapDeal, marker[k]);
            });

            google.maps.event.addListener(mapDeal, 'click', function (event) {
                if (typeof infowindow !== 'undefined')
                    infowindow.close();
            });

            latlng.push(new google.maps.LatLng(v.lat, v.lng));
        });

        var latlngbounds = new google.maps.LatLngBounds();
        for (var i = 0; i < latlng.length; i++) {
            latlngbounds.extend(latlng[i]);
        }
        //mapDeal.fitBounds(latlngbounds);

        var markerCluster = new MarkerClusterer(mapDeal, markers, {
            maxZoom: 15,
            imagePath: $('#base_url').val() + 'assets/images/brands/cluster',
            styles: [{
                    textColor: '#FFFFFF',
                    url: $('#base_url').val() + 'assets/images/brands/cluster.png',
                    width: 55,
                    height: 55,
                    fontWeight: 'bold',
                    textSize: 14
                }]
        });
    },
    geoloc: function () {
        // HTTPS !!! 
        if ($('#geoloc').is(':checked')) {
            // Check si on a déjà accepté la géoloc
            if (typeof localStorage['authorizedGeoLocation'] == "undefined" || localStorage['authorizedGeoLocation'] == "0") {
                $('#acceptGeoloc').modal('show');
            }
            if (typeof localStorage['authorizedGeoLocation'] != "undefined" && localStorage['authorizedGeoLocation'] == "1") {
                $('#wait').modal('show');
            }
            // Tente la geoloc sur le nav
            if (navigator.geolocation) {
                // Récupère la position de l'user
                navigator.geolocation.getCurrentPosition(function (position) {
                    $('#acceptGeoloc').modal('hide');
                    $('#wait').modal('hide');
                    localStorage['authorizedGeoLocation'] = 1;
                    latUser = position.coords.latitude;
                    lngUser = position.coords.longitude;
                    if (mapDeal != false) {
                        mapDeal.setCenter(new google.maps.LatLng(latUser, lngUser));
                        mapDeal.setZoom(13);
                    }
                    if (mapStore != false) {
                        mapStore.setCenter(new google.maps.LatLng(latUser, lngUser));
                        mapStore.setZoom(13);
                    }
                },
                        function (error) {
                            localStorage['authorizedGeoLocation'] = 0;
                            $('#acceptGeoloc').modal('hide');
                        });
            } else {
                localStorage['authorizedGeoLocation'] = 0;
                $('#acceptGeoloc').modal('hide');
                alert("Malheureusement votre navigateur Internet est trop vieux, impossible d'utiliser cette fonctionnalité. :(");
            }
        } else {
            mapStore.setCenter(new google.maps.LatLng($('#store-map').data('latitude'), $('#store-map').data('longitude')));
            mapStore.setZoom($('#store-map').data('zoom'));
            mapDeal.setCenter(new google.maps.LatLng($('#deals-map').data('latitude'), $('#deals-map').data('longitude')));
            mapDeal.setZoom($('#deals-map').data('zoom'));
            latUser = false;
            lngUser = false;
        }
    },
    changeCategory: function () {
        console.log($('#store-map').is(':visible'));
        if ($('#store-map').is(':visible')) {
            process.showStores();
        } else {
            process.showDeals();
        }
    }
}