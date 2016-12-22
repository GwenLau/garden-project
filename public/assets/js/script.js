$(function(){

    // Si on est sur la page d'ajout d'une image
    if($('form[name=add_picture]').length) {
        var $place = $('input[name=place]');
        var $placeId = $('input[name=place-id]');
        var $lat = $('#lat');
        var $lng = $('#lng');

        function refreshMapFromPlace(){
            var container = document.getElementById('map-place');
            var latLng;
            var map;
            var marker;

            $.ajax({
                url: 'https://maps.googleapis.com/maps/api/geocode/json',
                data: {
                    address: $place.val()
                },
                dataType: 'json',
                success: function(r){
                    if(r.results.length) {
                        latLng = {lat: r.results[0].geometry.location.lat, lng: r.results[0].geometry.location.lng};
                        map = new google.maps.Map(container, {
                            center: latLng,
                            zoom: 10
                        });
                        marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            title: $place.val(),
                        });
                    }
                }
            })
        }

        function putCoords(e, ui){
            e.preventDefault();
            $place.val(ui.item.label);
            $placeId.val(ui.item.value);
            refreshMapFromPlace();
        }

        if($place.length) {
            refreshMapFromPlace();
        }

        $place.autocomplete({
            source: function (req, response) {
                $.ajax({
                    url: $('.route-placeholder.places_search').val(),
                    data: {s: req.term},
                    dataType: 'json',
                    success: response,
                    error: function () {
                        response([])
                    },
                })
            },
            minLength: 2,
            focus: putCoords,
            select: putCoords,
            search: function(){
                refreshMapFromPlace();
                $placeId.val('');
            }
        });
    }

    // Si on a une alerte à afficher
    setTimeout(function(){$('.flash .alert').fadeIn().delay(2000).fadeOut()}, 500)
});	