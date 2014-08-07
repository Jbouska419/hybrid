<div style="position:relative">
  <div id="joms-map" class="joms-location-map-preview joms-map"
    data-latitude="<?php echo $lang ?>"
    data-longitude="<?php echo $long ?>"><div style="height:250px"></div></div>
  <div style="position:absolute; top:8px; right:8px;">
    <div>
      <a href="https://www.google.com/maps/@<?php echo $lang ?>,<?php echo $long ?>,19z" target="_blank">
        <button class="joms-show-location"><i class="joms-icon-map-marker"></i><?php echo JText::_('COM_COMMUNITY_MAPS_SHOW') ?></button>
      </a>
    </div>
  </div>
</div>
<script>
joms.jQuery(function( $ ) {
  joms.map.execute(function() {
    setTimeout(function() {
      var container = $('#joms-map'),
          latitude = container.data('latitude'),
          longitude = container.data('longitude'),
          zoom = 14;

      var el = container.children();
      var position = new google.maps.LatLng( latitude, longitude );

      var options = {
        center: position,
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAD,
        mapTypeControl: false,
        disableDefaultUI: true,
        draggable: false,
        scaleControl: false,
        scrollwheel: false,
        navigationControl: false,
        streetViewControl: false,
        disableDoubleClickZoom: true
      };

      var map = new google.maps.Map( el[0], options );
      var marker = new google.maps.Marker({
        draggable: false,
        map: map
      });

      marker.setAnimation( null );
      marker.setPosition( position );
      map.panTo( position );
    }, 0 );
  });
});
</script>
