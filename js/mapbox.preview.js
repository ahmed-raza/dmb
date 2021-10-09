(function($, Drupal, drupalSettings){
  Drupal.behaviors.mapbox = {
    attach: function(context) {
      if (drupalSettings.mapbox.accessToken != null) {
        mapboxgl.accessToken = drupalSettings.mapbox.accessToken;
        var map = new mapboxgl.Map({
          container: 'mapbox-preview',
          style: drupalSettings.mapbox.style,
          center: [-118.42064433334353, 33.972018856566876],
          zoom: 10,
          pitch: 45,
          maxPitch: 65,
          keyboard: true
        });
        map.addControl(new mapboxgl.NavigationControl());
        map.on('click', function(e){
          console.log(e.lngLat);
        })
        map.on('load', function(){
          $('input[name="style"]').change(function(){
            map.setStyle($(this).val());
          });
          threeDLayer(map)
        });
      }
    }
  }
})(jQuery, Drupal, drupalSettings);
