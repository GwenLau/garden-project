function initMap()
{
    var container = document.getElementById('map');
    var map = new google.maps.Map(container, {
        center : {lat:45, lng:5},
        zoom : 5
    });

    var marker = new google.maps.Marker({
        position: {lat:45, lng:5},
        map: map,
        title: "La France"
    });
    var marker = new google.maps.Marker({
        position: {lat:42, lng:5},
        map: map,
        title: "La France"
    });
}


// Pattern "Module"
var mapHandler = (function() {
    var self = {};
    self.markers = [];

    self.addMarker = function(position, title) {
        var marker = new google.maps.Marker({
            position: position,
            map: self.map,
            title: title
        });
        self.markers.push(marker);
    }

    self.getMarkers = function() {
        return self.markers;
    }

    self.showMap = function (container, coords, zoom) {
        var mapContainer = document.getElementById(container);

        self.map = new google.maps.Map(mapContainer, {
            center: coords,
            zoom: zoom
        });
    };
    return self;
})();

function initMap() {
    var coords = {lat: 45.058, lng: 5.285};

    mapHandler.showMap('map', coords, 4);
    mapHandler.addMarker({lat: 45, lng: 4}, 'Marker 1');
    mapHandler.addMarker({lat: 46, lng: 5}, 'Marker 2');
    mapHandler.addMarker({lat: 40, lng: 3}, 'Marker 3');
}
