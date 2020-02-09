<?php  
/**------------------------------------------------------------------------
 * Mod_VikGoogleMaps - Vik Google Maps
 * ------------------------------------------------------------------------
 * author    Alessio Gaggii - Extensionsforjoomla.com
 * copyright Copyright (C) 2013 extensionsforjoomla.com. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.extensionsforjoomla.com
 * Technical Support:  tech@extensionsforjoomla.com
 * ------------------------------------------------------------------------
*/

defined('_JEXEC') or die('Restricted Area'); 

$arrmap = array();
$alllats = array();
$alllngs = array();

$apikeygm = $params->get('apikey');

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base().'modules/mod_vikgooglemaps/mod_vikgooglemaps.css');
$document->addStyleSheet(JURI::base().'modules/mod_vikgooglemaps/src/font-awesome.css');
if(intval($params->get('loadjq')) == 1 ) {
	$document->addScript(JURI::base().'modules/mod_vikgooglemaps/src/jquery.js');
}
if (!empty($apikeygm)) {
	$document->addScript('https://maps.google.com/maps/api/js?key='.$apikeygm.'&sensor=false');	
} else {
	$document->addScript('https://maps.google.com/maps/api/js?sensor=false');	
}


$vikgooglemapsid = rand(1, 17);
$width = $params->get('width');
$height = $params->get('height');

$shadowpointleft = $params->get('shadowpointleft');
$shadowpointright = $params->get('shadowpointright');

$getmapstyle = $params->get('mapstyle');

if($getmapstyle == 0) {
	$getmapstyle = "[{\"featureType\": \"landscape.natural.landcover\", \"elementType\": \"geometry\"}]";
}
if($getmapstyle == 1) {
	$getmapstyle = "[{\"featureType\":\"landscape\",\"stylers\":[{\"saturation\":-100},{\"lightness\":65},{\"visibility\":\"on\"}]},{\"featureType\":\"poi\",\"stylers\":[{\"saturation\":-100},{\"lightness\":51},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.highway\",\"stylers\":[{\"saturation\":-100},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.arterial\",\"stylers\":[{\"saturation\":-100},{\"lightness\":30},{\"visibility\":\"on\"}]},{\"featureType\":\"road.local\",\"stylers\":[{\"saturation\":-100},{\"lightness\":40},{\"visibility\":\"on\"}]},{\"featureType\":\"transit\",\"stylers\":[{\"saturation\":-100},{\"visibility\":\"simplified\"}]},{\"featureType\":\"administrative.province\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"},{\"lightness\":-25},{\"saturation\":-100}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"hue\":\"#ffff00\"},{\"lightness\":-25},{\"saturation\":-97}]}]";
}
if($getmapstyle == 2) {
	$getmapstyle = "[{\"featureType\":\"water\",\"stylers\":[{\"color\":\"#021019\"}]},{\"featureType\":\"landscape\",\"stylers\":[{\"color\":\"#08304b\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#0c4152\"},{\"lightness\":5}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#000000\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#0b434f\"},{\"lightness\":25}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#000000\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#0b3d51\"},{\"lightness\":16}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":13}]},{\"featureType\":\"transit\",\"stylers\":[{\"color\":\"#146474\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#000000\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#144b53\"},{\"lightness\":14},{\"weight\":1.4}]}]";
}
if($getmapstyle == 3) {
	$getmapstyle = "[{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"visibility\":\"on\"},{\"color\":\"#e0efef\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"visibility\":\"on\"},{\"hue\":\"#1900ff\"},{\"color\":\"#c0e8e8\"}]},{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry.fill\"},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"lightness\":100},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"stylers\":[{\"color\":\"#7dcdcd\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"on\"},{\"lightness\":700}]}]";
}
if($getmapstyle == 4) {
	$getmapstyle = "[{\"featureType\":\"landscape\",\"stylers\":[{\"hue\":\"#FFA800\"},{\"saturation\":0},{\"lightness\":0},{\"gamma\":1}]},{\"featureType\":\"road.highway\",\"stylers\":[{\"hue\":\"#53FF00\"},{\"saturation\":-73},{\"lightness\":40},{\"gamma\":1}]},{\"featureType\":\"road.arterial\",\"stylers\":[{\"hue\":\"#FBFF00\"},{\"saturation\":0},{\"lightness\":0},{\"gamma\":1}]},{\"featureType\":\"road.local\",\"stylers\":[{\"hue\":\"#00FFFD\"},{\"saturation\":0},{\"lightness\":30},{\"gamma\":1}]},{\"featureType\":\"water\",\"stylers\":[{\"hue\":\"#00BFFF\"},{\"saturation\":6},{\"lightness\":8},{\"gamma\":1}]},{\"featureType\":\"poi\",\"stylers\":[{\"hue\":\"#679714\"},{\"saturation\":33.4},{\"lightness\":-25.4},{\"gamma\":1}]}]";
}

$get_textarea_above = $params->get('textarea_above');
$get_textarea_under = $params->get('textarea_under');
$get_cnt_address = $params->get('contact_address');
$get_cnt_email = $params->get('contact_email');
$get_cnt_telephone = $params->get('contact_tel');
$get_cnt_enabled = $params->get('contact_enabled');
$get_cnt_title = $params->get('contact_header');

$cnt = '';
$cnt .= '<div class="vikgm_cnt_container"><div class="vikgm_cnt_inner">';
if(!empty($get_cnt_title)) {
	$cnt .= '<div class="vikgm_cnt_item vikgm_cnt_title"><h2>'.$get_cnt_title.'</h2></div>';
}
if(!empty($get_textarea_above)) {
	$cnt .= '<div class="vikgm_cnt_item vikgm_cnt_textone">'.$get_textarea_above.'</div>';
}
if(!empty($get_cnt_address)) {
	$cnt .= '<div class="vikgm_cnt_det vikgm_cnt_address"><i class="vik-icons fa fa-map-marker"></i> <span>'.$get_cnt_address.'</span></div>';
}
if(!empty($get_cnt_email)) {
	$cnt .= '<div class="vikgm_cnt_det vikgm_cnt_email"><i class="vik-icons fa fa-envelope"></i> <span>'.$get_cnt_email.'</span></div>';
}
if(!empty($get_cnt_telephone)) {
	$cnt .= '<div class="vikgm_cnt_det vikgm_cnt_tel"><i class="vik-icons fa fa-phone"></i> <span>'.$get_cnt_telephone.'</span></div>';
}
if(!empty($get_textarea_under)) {
	$cnt .= '<div class="vikgm_cnt_item vikgm_cnt_texttwo">'.$get_textarea_under.'</div>';
}
$cnt .= '</div></div>';

$stylesize = '';
if (!empty($width) && !empty($height)) {
	$stylesize .= 'style="width: '.$width.'; height: '.$height.';"';
}else {
	$stylesize .= 'style="width: 100%; height: 200px;"';
}

for($v = 1; $v <= 5; $v++) {
	$gettitle = $params->get('viktitle_'.$v);
	$getlat = $params->get('viklat_'.$v);
	$getlng = $params->get('viklng_'.$v);
	$gettext = $params->get('viktext_'.$v);
	$getshape = $params->get('vikshape_'.$v);
	$getshadow = $params->get('vikshadow_'.$v);
	if (!empty($getlat) && !empty($getlng)) {
		$arrmap[$v]['latitude'] = $getlat;
		$alllats[] = $getlat;
		$arrmap[$v]['longitude'] = $getlng;
		$alllngs[] = $getlng;
		$arrmap[$v]['title'] = $gettitle;
		$arrmap[$v]['text'] = $gettext;
		$arrmap[$v]['shape'] = $getshape;
		$arrmap[$v]['shadow'] = $getshadow;
	}
}

echo "<!-- Init VikGoogleMaps https://extensionsforjoomla.com -->	";	?>

	<?php
	//Vale completa o cambia qua e poi togli il commento!:
	$def_zoom = $params->get('zoom');
	$def_center_lat = $params->get('center_lat');
	$def_center_lng = $params->get('center_lng');
	//
	if(@count($arrmap) > 0) {
		?>
		<script language="JavaScript" type="text/javascript">
		jQuery.noConflict();
		jQuery(document).ready(function(){
			var map = new google.maps.Map(document.getElementById("vikgooglemaps_<?php echo $vikgooglemapsid; ?>"), {<?php echo (!empty($def_zoom) ? 'zoom: '.intval($def_zoom).', ' : '').(!empty($def_center_lat) && !empty($def_center_lng) ? 'center: new google.maps.LatLng('.floatval($def_center_lat).', '.floatval($def_center_lng).'), ' : ''); ?>mapTypeId: google.maps.MapTypeId.ROADMAP, scrollwheel: false, styles:<?php echo $getmapstyle; ?>});
		<?php
		foreach($arrmap as $k => $v) {
		?>	
			var marker<?php echo $k; ?> = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo $v['latitude']; ?>, <?php echo $v['longitude']; ?>),
				map: map,
				title: '<?php echo addslashes($v['title']); ?>'
				<?php
				if(!empty($v['shape'])) {
					?>
				,icon: '<?php echo JURI::root().'modules/mod_vikgooglemaps/src/markers/shapes/'.$v['shape']; ?>'	
					<?php
				}
				if(!empty($v['shadow'])) {
					?>
				,shadow: {url: '<?php echo JURI::root().'modules/mod_vikgooglemaps/src/markers/shadows/'.$v['shadow']; ?>', anchor: new google.maps.Point(<?php echo $shadowpointleft; ?>, <?php echo $shadowpointright; ?>)}	
					<?php
				}
				?>
			});	
			<?php
			if(!empty($v['text'])) {
			?>
			var tooltip<?php echo $k; ?> = '<div class="vikgmapinfow"><h3><?php echo addslashes($v['title']); ?></h3><?php echo addslashes(preg_replace('/\s\s+/', ' ', $v['text'])); ?></div>';
			var infowindow<?php echo $k; ?> = new google.maps.InfoWindow({
				content: tooltip<?php echo $k; ?>
			});
			google.maps.event.addListener(marker<?php echo $k; ?>, 'click', function() {
				infowindow<?php echo $k; ?>.open(map, marker<?php echo $k; ?>);
			});
			<?php
			}
			?>
		<?php
		}
		?>
			var lat_min = <?php echo min($alllats); ?>;
			var lat_max = <?php echo max($alllats); ?>;
			var lng_min = <?php echo min($alllngs); ?>;
			var lng_max = <?php echo max($alllngs); ?>;
			<?php
			if(empty($def_zoom)) {
			?>
			map.setCenter(new google.maps.LatLng( ((lat_max + lat_min) / 2.0), ((lng_max + lng_min) / 2.0) ));
			map.fitBounds(new google.maps.LatLngBounds(new google.maps.LatLng(lat_min, lng_min), new google.maps.LatLng(lat_max, lng_max)));
			<?php
			}
			?>
		});
		</script>
		<?php
	}
	?>

<?php ?>
<div class="vikgooglemapscontainer <?php echo $params->get('contact_position'); ?>">
	<?php if($get_cnt_enabled == 1) { echo $cnt; } ?>
	<div class="vikgooglemaps_content">	
		<div id="vikgooglemaps_<?php echo $vikgooglemapsid; ?>" <?php echo $stylesize; ?>></div>
	</div>
</div>
<?php

echo "<!-- End VikGoogleMaps http://www.extensionsforjoomla.com/ -->	";

?>

	