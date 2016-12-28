function initMap()
{
    var container = document.getElementById('map');
    var map = new google.maps.Map(container, {
        center : {lat:47, lng:2.40},
        zoom : 5
    });
    var myMarkerImage = new google.maps.MarkerImage('assets/img/jardin-mini.png');

    $('input[type="hidden"]').each(function(key, elt) {
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat($(elt).attr('data-lat')),
                lng: parseFloat($(elt).attr('data-lng'))
            },
            map: map,
            icon: myMarkerImage,
            mapTypeControl: false,
            title: "France"
        });        
    });
}
