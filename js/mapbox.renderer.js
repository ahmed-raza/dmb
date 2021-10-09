(function($, Drupal, drupalSettings){
  Drupal.behaviors.mapbox_renderer = {
    attach: function(context) {
      $.each(drupalSettings.mapbox_renderer, function(instanceId, settings){
        renderMap($, settings);
      });

      $('.mapbox-remover').bind('click', function(e){
        e.preventDefault();
        var instance_delta = $(this).attr('data-remove-delta');
        $('input[data-lat-delta="'+instance_delta+'"]').prop('value', '').attr('value', '');
        $('input[data-lng-delta="'+instance_delta+'"]').prop('value', '').attr('value', '');
        $('input[data-marker-delta="'+instance_delta+'"]').prop('value', '').attr('value', '');
        $('input[data-marked-delta="'+ instance_delta +'"]').prop('value', '0').attr('value', '0');
        $('input[data-3d-delta="'+instance_delta+'"]').prop('checked', false).attr('checked', false);
        $('input[data-keyboard-delta="'+instance_delta+'"]').prop('checked', false).attr('checked', false);
        $('select[data-pitch-delta="'+instance_delta+'"]').prop('value', '45').attr('value', '45');
        $('select[data-maxpitch-delta="'+instance_delta+'"]').prop('value', '65').attr('value', '65');
        $('select[data-maxzoom-delta="'+instance_delta+'"]').prop('value', '18').attr('value', '18');
        $('select[data-minzoom-delta="'+instance_delta+'"]').prop('value', '3').attr('value', '3');
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
