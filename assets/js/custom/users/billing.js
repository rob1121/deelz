$(document).ready(function(){
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
                             $('#city').val(myAdress[key].long_name);
                             }
                             if ((myAdress[key].types[0] == 'administrative_area_level_1' || myAdress[key].types[0] == 'administrative_area_level_2') && $('#city').val() == '') {
                             $('#city').val(myAdress[key].long_name);
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
        });
});