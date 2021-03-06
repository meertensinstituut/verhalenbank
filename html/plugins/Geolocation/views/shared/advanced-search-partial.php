<?php 
$request = Zend_Controller_Front::getInstance()->getRequest();

// Get the address, latitude, longitude, and the radius from parameters
$address = trim($request->getParam('geolocation_address'));
$currentLat = trim($request->getParam('geolocation-latitude'));
$currentLng = trim($request->getParam('geolocation-longitude'));
$radius = trim($request->getParam('geolocation-radius'));

if (empty($radius)) {
    $radius = 10; // 10 miles
}
?>

<div class="field">
    <div class="label"><?php echo __('Geographic Address'); ?></div>
    <center>
    <table width=90%>
    <tr>
        <td><div>
            <?php echo __('Geographic Address') . " (" . __("Place of narration") . ")"; ?></div>
        </td>
        <td>
            <?php #echo $this->formText('geolocation-latitude', $currentLat, array('name'=>'geolocation-latitude','id'=>'geolocation-latitude','class'=>'textinput', "style" => "margin-bottom:0")); ?>
            <?php echo $this->formText('geolocation-address',  $address, array('name'=>'geolocation-address','size' => '40','id'=>'geolocation-address','class'=>'textinput', "style" => "margin-bottom:0")); ?>
            <?php echo $this->formHidden('geolocation-latitude', $currentLat, array('name'=>'geolocation-latitude','id'=>'geolocation-latitude')); ?>
            <?php echo $this->formHidden('geolocation-longitude', $currentLng, array('name'=>'geolocation-longitude','id'=>'geolocation-longitude')); ?>
            <?php #echo $this->formHidden('geolocation-radius', $radius, array('name'=>'geolocation-radius','id'=>'geolocation-radius')); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php echo $this->formLabel('geolocation-radius', __('Geographic Radius (km)')); ?>
        </td>
        <td>
            <?php echo $this->formText('geolocation-radius', $radius, array('name'=>'geolocation-radius','size' => '10','id'=>'geolocation-radius','class'=>'textinput', "style" => "margin-bottom:0")); ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>OR</td>
    </tr>
    <?php
    foreach(explode("\n", get_option("geolocation_public_search_fields")) as $geo_field):?>
        <?php 
        $geo_field = trim($geo_field);
        $search_value = trim($request->getParam("geolocation-".$geo_field));?>
        <tr>
        <td><div><?php echo __($geo_field);?></div></td>
        <td>
            <?php echo $this->formText("geolocation-".$geo_field, $search_value, array('name' => "geolocation-".$geo_field, 'size' => '40', 'id' => "geolocation-".$geo_field, 'class'=>'textinput', "style" => "margin-bottom:0"));?>
        </td>
        </tr>
    <?php endforeach; ?>
    </table>
</div>

<script type="text/javascript">
    if (google){
        var options = {
    	    types: []
        };
    	var input = document.getElementById('geolocation-address');
    	var autocomplete = new google.maps.places.Autocomplete(input, options);
        jQuery(document).ready(function() {
//    	    jQuery('#<?php echo $searchButtonId; ?>').click(function(event) {
    	    jQuery('.submit').click(function(event) {
    	        // Find the geolocation for the address
    	        var address = jQuery('#geolocation-address').val();
                if (jQuery.trim(address).length > 0) {
                    var geocoder = new google.maps.Geocoder();	        
                    geocoder.geocode({'address': address}, function(results, status) {
                        // If the point was found, then put the marker on that spot
                		if (status == google.maps.GeocoderStatus.OK) {
                			var gLatLng = results[0].geometry.location;
                	        // Set the latitude and longitude hidden inputs
                	        jQuery('#geolocation-latitude').val(gLatLng.lat());
//                	        jQuery('#geolocation-latitude').val(gLatLng.lat());
                	        jQuery('#geolocation-longitude').val(gLatLng.lng());
                            jQuery('#<?php echo $searchFormId; ?>').submit();
                		} else {
                		  	// If no point was found, give us an alert
                		    alert('Error: "' + address + '" was not found!');
                		}
                    });
                
                    event.stopImmediatePropagation();
        	        return false;
                }                
    	    });
        });
    };
</script>