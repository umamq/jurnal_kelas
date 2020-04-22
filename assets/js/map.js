var map;
var marker;
var circle;
var geocoder;

function load() {
    geocoder = new google.maps.Geocoder();

    if ($("#field-latitude").val() != '' && $("#field-longitude").val() != '')
        var latlng = new google.maps.LatLng($("#field-latitude").val(), $("#field-longitude").val());
    else
        var latlng = new google.maps.LatLng(-1.6186336, 103.0149414);
    var myOptions = {
        zoom: 18,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    map = new google.maps.Map(document.getElementById("location-map"), myOptions);

    // Create the search box and link it to the UI element.
      var input = document.getElementById('pac-input');
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

      var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          // markers.forEach(function(marker) {
          //   marker.setMap(null);
          // });
          // markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            // var icon = {
            //   url: place.icon,
            //   size: new google.maps.Size(71, 71),
            //   origin: new google.maps.Point(0, 0),
            //   anchor: new google.maps.Point(17, 34),
            //   scaledSize: new google.maps.Size(25, 25)
            // };

            // Create a marker for each place.
            // markers.push(new google.maps.Marker({
            //   map: map,
            //   icon: icon,
            //   title: place.name,
            //   position: place.geometry.location
            // }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
          addMarker(map.getCenter());
        });

        addMarker(map.getCenter());

    google.maps.event.addListener(map, "click", function(event) {
        addMarker(event.latLng);
    });

}


function addMarker(location) {
    if (marker) {
        marker.setMap(null);
    }
    document.getElementById("field-latitude").value = location.lat();
    document.getElementById("field-longitude").value = location.lng();
    console.log("Coordinates found / Latitude - " + location.lat() + " & longitude - " + location.lng());
    marker = new google.maps.Marker({
        position: location,
        draggable: true
    });
    marker.setMap(map);
    google.maps.event.addListener(marker, "dragend", function(event) {
        newlatlng = event.latLng;
        map.setCenter(newlatlng);
        document.getElementById("field-latitude").value = newlatlng.lat();
        document.getElementById("field-longitude").value = newlatlng.lng();
    });
}

window.onload = function() {
    load();
    $('#field-zip').blur(function() {
        codeAddress();
    });
    $('#field-zip').css('text-transform', 'uppercase');
}
