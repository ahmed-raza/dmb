(function($, Drupal, drupalSettings){
  Drupal.behaviors.mapbox_singlemap = {
    attach: function(context, settings) {
      var mapbox = drupalSettings.mapbox_singlemap;
      if (mapbox.center != null && mapbox.positions != null) {
        mapboxgl.accessToken = mapbox.accessToken;
        var map = new mapboxgl.Map({
          container: mapbox.mapboxInstance,
          style: mapbox.style,
          center: [mapbox.center.lng, mapbox.center.lat],
          zoom: mapbox.options.zoom,
          minZoom: mapbox.options.minZoom,
          maxZoom: mapbox.options.maxZoom,
          pitch: mapbox.options.pitch,
          maxPitch: mapbox.options.maxPitch,
          keyboard: mapbox.options.keyboard
        });
        if (mapbox.options.navigation)
          map.addControl(new mapboxgl.NavigationControl());

        map.on('load', function() {
          $.each(mapbox.positions, function(delta, position){
            var marker = document.getElementById('mapbox-marker-'+position.markerInstance);
            marker.style.display = 'inline-block';
            if (position.markerText)
              var popup = new mapboxgl.Popup({ offset: 40 }).setText(position.markerText);

            new mapboxgl.Marker(marker).setLngLat([position.lng, position.lat]).setPopup(popup).addTo(map);
          });
          if (mapbox.options.threeDBuildings)
            threeDLayer(map)
        });
      }
    }
  };
})(jQuery, Drupal, drupalSettings);
