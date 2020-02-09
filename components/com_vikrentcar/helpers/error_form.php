<?php
/**
 * @package     VikRentCar
 * @subpackage  com_vikrentcar
 * @author      Alessio Gaggii - e4j - Extensionsforjoomla.com
 * @copyright   Copyright (C) 2017 e4j - Extensionsforjoomla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://e4j.com
 */

defined('_JEXEC') or die('Restricted access');

//This is a template file loaded (included) by the main lib in case of errors during the booking process to keep the current query string, without performing any redirect.
//The output of this template file is similar to the default view 'vikrentcar' but it takes an error-message variable declared by the function 'showSelectVb' in the main lib.
//This is not a core-file and, even though it does not support overrides, it can be customized as it is never replaced by any update.

$dbo = JFactory::getDBO();
$vrc_tn = vikrentcar::getTranslator();
if (vikrentcar::allowRent()) {
	$calendartype = vikrentcar::calendarType();
	$document = JFactory::getDocument();
	//load jQuery lib e jQuery UI
	if(vikrentcar::loadJquery()) {
		JHtml::_('jquery.framework', true, true);
		JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery-1.11.1.min.js', false, true, false, false);
	}
	if($calendartype == "jqueryui") {
		$document->addStyleSheet(JURI::root().'components/com_vikrentcar/resources/jquery-ui.min.css');
		//load jQuery UI
		JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery-ui.min.js', false, true, false, false);
	}
	//
	$ppickup = VikRequest::getInt('pickup', '', 'request');
	$preturn = VikRequest::getInt('return', '', 'request');
	$pitemid = VikRequest::getInt('Itemid', '', 'request');
	$ptmpl = VikRequest::getString('tmpl', '', 'request');
	$pval = "";
	$rval = "";
	$vrcdateformat = vikrentcar::getDateFormat();
	$nowtf = vikrentcar::getTimeFormat();
	if ($vrcdateformat == "%d/%m/%Y") {
		$df = 'd/m/Y';
	}elseif ($vrcdateformat == "%m/%d/%Y") {
		$df = 'm/d/Y';
	}else {
		$df = 'Y/m/d';
	}
	if (!empty ($ppickup)) {
		$dp = date($df, $ppickup);
		if (vikrentcar::dateIsValid($dp)) {
			$pval = $dp;
		}
	}
	if (!empty ($preturn)) {
		$dr = date($df, $preturn);
		if (vikrentcar::dateIsValid($dr)) {
			$rval = $dr;
		}
	}
	$coordsplaces = array();
	$selform = "<div class=\"vrcdivsearch\" style=\"margin-bottom:20px\"><form action=\"".JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ? '&Itemid='.$pitemid : ''))."\" method=\"get\">\n";
	$selform .= "<div class=\"vrcdivsearch-fieldlist\" style=\"float:none\">\n";
	$selform .= "<input type=\"hidden\" name=\"option\" value=\"com_vikrentcar\"/>\n";
	$selform .= "<input type=\"hidden\" name=\"task\" value=\"search\"/>\n";
	if($ptmpl == 'component') {
		$selform .= "<input type=\"hidden\" name=\"tmpl\" value=\"component\"/>\n";
	}
	$diffopentime = false;
	$closingdays = array();
	$declclosingdays = '';
	if (vikrentcar::showPlacesFront()) {
		$q = "SELECT * FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`ordering` ASC, `#__vikrentcar_places`.`name` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$places = $dbo->loadAssocList();
			$vrc_tn->translateContents($places, '#__vikrentcar_places');
			//check if some place has a different opening time (1.6)
			foreach ($places as $pla) {
				if(!empty($pla['opentime'])) {
					$diffopentime = true;
				}
				//check if some place has closing days
				if(!empty($pla['closingdays'])) {
					$closingdays[$pla['id']] = $pla['closingdays'];
				}
			}
			//locations closing days (1.7)
			if (count($closingdays) > 0) {
				foreach($closingdays as $idpla => $clostr) {
					$jsclosingdstr = vikrentcar::formatLocationClosingDays($clostr);
					if (count($jsclosingdstr) > 0) {
						$declclosingdays .= 'var loc'.$idpla.'closingdays = ['.implode(", ", $jsclosingdstr).'];'."\n";
					}
				}
			}
			$onchangeplaces = $diffopentime == true ? " onchange=\"javascript: vrcSetLocOpenTime(this.value, 'pickup');\"" : "";
			$onchangeplacesdrop = $diffopentime == true ? " onchange=\"javascript: vrcSetLocOpenTime(this.value, 'dropoff');\"" : "";
			if($diffopentime == true) {
				$onchangedecl = '
jQuery.noConflict();
var vrc_location_change = false;
function vrcSetLocOpenTime(loc, where) {
	if(where == "dropoff") {
		vrc_location_change = true;
	}
	jQuery.ajax({
		type: "POST",
		url: "'.JRoute::_('index.php?option=com_vikrentcar&task=ajaxlocopentime&tmpl=component').'",
		data: { idloc: loc, pickdrop: where }
	}).done(function(res) {
		var vrcobj = jQuery.parseJSON(res);
		if(where == "pickup") {
			jQuery("#vrccomselph").html(vrcobj.hours);
			jQuery("#vrccomselpm").html(vrcobj.minutes);
		}else {
			jQuery("#vrccomseldh").html(vrcobj.hours);
			jQuery("#vrccomseldm").html(vrcobj.minutes);
		}
		if(where == "pickup" && vrc_location_change === false) {
			jQuery("#returnplace").val(loc).trigger("change");
			vrc_location_change = false;
		}
	});
}';
				$document->addScriptDeclaration($onchangedecl);
			}
			//end check if some place has a different opningtime (1.6)
			$selform .= "<div class=\"vrcsfentrycont\"><label>" . JText::_('VRPPLACE') . "</label><div class=\"vrcsfentryselect \"><select name=\"place\" id=\"place\"".$onchangeplaces.">";
			foreach ($places as $pla) {
				$selform .= "<option value=\"" . $pla['id'] . "\" id=\"place".$pla['id']."\">" . $pla['name'] . "</option>\n";
				if(!empty($pla['lat']) && !empty($pla['lng'])) {
					$coordsplaces[] = $pla;
				}
			}
			$selform .= "</select></div></div>\n";
		}
	}
	
	if($diffopentime == true && is_array($places) && strlen($places[0]['opentime']) > 0) {
		$parts = explode("-", $places[0]['opentime']);
		if (is_array($parts) && $parts[0] != $parts[1]) {
			$opent = vikrentcar::getHoursMinutes($parts[0]);
			$closet = vikrentcar::getHoursMinutes($parts[1]);
			$i = $opent[0];
			$imin = $opent[1];
			$j = $closet[0];
		} else {
			$i = 0;
			$imin = 0;
			$j = 23;
		}
	}else {
		$timeopst = vikrentcar::getTimeOpenStore();
		if (is_array($timeopst) && $timeopst[0] != $timeopst[1]) {
			$opent = vikrentcar::getHoursMinutes($timeopst[0]);
			$closet = vikrentcar::getHoursMinutes($timeopst[1]);
			$i = $opent[0];
			$imin = $opent[1];
			$j = $closet[0];
		} else {
			$i = 0;
			$imin = 0;
			$j = 23;
		}
	}
	$hours = "";
	//VRC 1.9
	$pickhdeftime = !empty($places[0]['defaulttime']) ? ((int)$places[0]['defaulttime'] / 3600) : '';
	if(!($i < $j)) {
		while (intval($i) != (int)$j) {
			$sayi = $i < 10 ? "0".$i : $i;
			if ($nowtf != 'H:i') {
				$ampm = $i < 12 ? ' am' : ' pm';
				$ampmh = $i > 12 ? ($i - 12) : $i;
				$sayh = $ampmh < 10 ? "0".$ampmh.$ampm : $ampmh.$ampm;
			}else {
				$sayh = $sayi;
			}
			$hours .= "<option value=\"" . $sayi . "\"".($pickhdeftime == (int)$i ? ' selected="selected"' : '').">" . $sayh . "</option>\n";
			$i++;
			$i = $i > 23 ? 0 : $i;
		}
		$sayi = $i < 10 ? "0".$i : $i;
		if ($nowtf != 'H:i') {
			$ampm = $i < 12 ? ' am' : ' pm';
			$ampmh = $i > 12 ? ($i - 12) : $i;
			$sayh = $ampmh < 10 ? "0".$ampmh.$ampm : $ampmh.$ampm;
		}else {
			$sayh = $sayi;
		}
		$hours .= "<option value=\"" . $sayi . "\">" . $sayh . "</option>\n";
	}else {
		while ($i <= $j) {
			$sayi = $i < 10 ? "0".$i : $i;
			if ($nowtf != 'H:i') {
				$ampm = $i < 12 ? ' am' : ' pm';
				$ampmh = $i > 12 ? ($i - 12) : $i;
				$sayh = $ampmh < 10 ? "0".$ampmh.$ampm : $ampmh.$ampm;
			}else {
				$sayh = $sayi;
			}
			$hours .= "<option value=\"" . $sayi . "\"".($pickhdeftime == (int)$i ? ' selected="selected"' : '').">" . $sayh . "</option>\n";
			$i++;
		}
	}
	//
	$minutes = "";
	for ($i = 0; $i < 60; $i += 15) {
		if ($i < 10) {
			$i = "0" . $i;
		} else {
			$i = $i;
		}
		$minutes .= "<option value=\"" . $i . "\"".((int)$i == $imin ? " selected=\"selected\"" : "").">" . $i . "</option>\n";
	}
	
	//vikrentcar 1.5
	if($calendartype == "jqueryui") {
		if ($vrcdateformat == "%d/%m/%Y") {
			$juidf = 'dd/mm/yy';
		}elseif ($vrcdateformat == "%m/%d/%Y") {
			$juidf = 'mm/dd/yy';
		}else {
			$juidf = 'yy/mm/dd';
		}
		//lang for jQuery UI Calendar
		$ldecl = '
jQuery(function($){'."\n".'
	$.datepicker.regional["vikrentcar"] = {'."\n".'
		closeText: "'.JText::_('VRCJQCALDONE').'",'."\n".'
		prevText: "'.JText::_('VRCJQCALPREV').'",'."\n".'
		nextText: "'.JText::_('VRCJQCALNEXT').'",'."\n".'
		currentText: "'.JText::_('VRCJQCALTODAY').'",'."\n".'
		monthNames: ["'.JText::_('VRMONTHONE').'","'.JText::_('VRMONTHTWO').'","'.JText::_('VRMONTHTHREE').'","'.JText::_('VRMONTHFOUR').'","'.JText::_('VRMONTHFIVE').'","'.JText::_('VRMONTHSIX').'","'.JText::_('VRMONTHSEVEN').'","'.JText::_('VRMONTHEIGHT').'","'.JText::_('VRMONTHNINE').'","'.JText::_('VRMONTHTEN').'","'.JText::_('VRMONTHELEVEN').'","'.JText::_('VRMONTHTWELVE').'"],'."\n".'
		monthNamesShort: ["'.mb_substr(JText::_('VRMONTHONE'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHTWO'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHTHREE'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHFOUR'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHFIVE'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHSIX'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHSEVEN'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHEIGHT'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHNINE'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHTEN'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHELEVEN'), 0, 3, 'UTF-8').'","'.mb_substr(JText::_('VRMONTHTWELVE'), 0, 3, 'UTF-8').'"],'."\n".'
		dayNames: ["'.JText::_('VRCJQCALSUN').'", "'.JText::_('VRCJQCALMON').'", "'.JText::_('VRCJQCALTUE').'", "'.JText::_('VRCJQCALWED').'", "'.JText::_('VRCJQCALTHU').'", "'.JText::_('VRCJQCALFRI').'", "'.JText::_('VRCJQCALSAT').'"],'."\n".'
		dayNamesShort: ["'.mb_substr(JText::_('VRCJQCALSUN'), 0, 3, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALMON'), 0, 3, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALTUE'), 0, 3, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALWED'), 0, 3, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALTHU'), 0, 3, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALFRI'), 0, 3, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALSAT'), 0, 3, 'UTF-8').'"],'."\n".'
		dayNamesMin: ["'.mb_substr(JText::_('VRCJQCALSUN'), 0, 2, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALMON'), 0, 2, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALTUE'), 0, 2, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALWED'), 0, 2, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALTHU'), 0, 2, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALFRI'), 0, 2, 'UTF-8').'", "'.mb_substr(JText::_('VRCJQCALSAT'), 0, 2, 'UTF-8').'"],'."\n".'
		weekHeader: "'.JText::_('VRCJQCALWKHEADER').'",'."\n".'
		dateFormat: "'.$juidf.'",'."\n".'
		firstDay: '.vikrentcar::getFirstWeekDay().','."\n".'
		isRTL: false,'."\n".'
		showMonthAfterYear: false,'."\n".'
		yearSuffix: ""'."\n".'
	};'."\n".'
	$.datepicker.setDefaults($.datepicker.regional["vikrentcar"]);'."\n".'
});';
		$document->addScriptDeclaration($ldecl);
		//
		//locations closing days (1.7)
		if (strlen($declclosingdays) > 0) {
			$declclosingdays .= '
jQuery.noConflict();
function pickupClosingDays(date) {
	var dmy = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
	var wday = date.getDay().toString();
	var arrlocclosd = jQuery("#place").val();
	var checklocarr = window["loc"+arrlocclosd+"closingdays"];
	if (jQuery.inArray(dmy, checklocarr) == -1 && jQuery.inArray(wday, checklocarr) == -1) {
		return [true, ""];
	} else {
		return [false, "", "'.addslashes(JText::_('VRCLOCDAYCLOSED')).'"];
	}
}
function dropoffClosingDays(date) {
	var dmy = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
	var wday = date.getDay().toString();
	var arrlocclosd = jQuery("#returnplace").val();
	var checklocarr = window["loc"+arrlocclosd+"closingdays"];
	if (jQuery.inArray(dmy, checklocarr) == -1 && jQuery.inArray(wday, checklocarr) == -1) {
		return [true, ""];
	} else {
		return [false, "", "'.addslashes(JText::_('VRCLOCDAYCLOSED')).'"];
	}
}';
			$document->addScriptDeclaration($declclosingdays);
		}
		//
		//Minimum Num of Days of Rental (VRC 1.8)
		$dropdayplus = vikrentcar::setDropDatePlus();
		$forcedropday = "jQuery('#releasedate').datepicker( 'option', 'minDate', selectedDate );";
		if (strlen($dropdayplus) > 0 && intval($dropdayplus) > 0) {
			$forcedropday = "
var vrcdate = jQuery(this).datepicker('getDate');
if(vrcdate) {
	vrcdate.setDate(vrcdate.getDate() + ".$dropdayplus.");
	jQuery('#releasedate').datepicker( 'option', 'minDate', vrcdate );
	jQuery('#releasedate').val(jQuery.datepicker.formatDate('".$juidf."', vrcdate));
}";
		}
		//
		$sdecl = "
jQuery.noConflict();
jQuery(function(){
	jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ '' ] );
	jQuery('#pickupdate').datepicker({
		showOn: 'both',
		buttonImage: '".JURI::root()."components/com_vikrentcar/resources/images/calendar.png',
		buttonImageOnly: true,
		onSelect: function( selectedDate ) {
			".$forcedropday."
		}".(strlen($declclosingdays) > 0 ? ", beforeShowDay: pickupClosingDays" : "")."
	});
	jQuery('#pickupdate').datepicker( 'option', 'dateFormat', '".$juidf."');
	jQuery('#pickupdate').datepicker( 'option', 'minDate', '".vikrentcar::getMinDaysAdvance()."d');
	jQuery('#pickupdate').datepicker( 'option', 'maxDate', '".vikrentcar::getMaxDateFuture()."');
	jQuery('#releasedate').datepicker({
		showOn: 'both',
		buttonImage: '".JURI::root()."components/com_vikrentcar/resources/images/calendar.png',
		buttonImageOnly: true,
		onSelect: function( selectedDate ) {
			jQuery('#pickupdate').datepicker( 'option', 'maxDate', selectedDate );
		}".(strlen($declclosingdays) > 0 ? ", beforeShowDay: dropoffClosingDays" : "")."
	});
	jQuery('#releasedate').datepicker( 'option', 'dateFormat', '".$juidf."');
	jQuery('#releasedate').datepicker( 'option', 'minDate', '".vikrentcar::getMinDaysAdvance()."d');
	jQuery('#releasedate').datepicker( 'option', 'maxDate', '".vikrentcar::getMaxDateFuture()."');
	jQuery('#pickupdate').datepicker( 'option', jQuery.datepicker.regional[ 'vikrentcar' ] );
	jQuery('#releasedate').datepicker( 'option', jQuery.datepicker.regional[ 'vikrentcar' ] );
});";
		$document->addScriptDeclaration($sdecl);
		$selform .= "<div class=\"vrcsfentrycont\"><div class=\"vrcsfentrylabsel\"><label>" . JText::_('VRPICKUPCAR') . "</label><div class=\"vrcsfentrydate\"><input type=\"text\" name=\"pickupdate\" id=\"pickupdate\" size=\"10\"/></div></div><div class=\"vrcsfentrytime\"><label>" . JText::_('VRALLE') . "</label><span id=\"vrccomselph\"><select name=\"pickuph\">" . $hours . "</select></span><span class=\"vrctimesep\">:</span><span id=\"vrccomselpm\"><select name=\"pickupm\">" . $minutes . "</select></span></div></div>\n";
		$selform .= "<div class=\"vrcsfentrycont\"><div class=\"vrcsfentrylabsel\"><label>" . JText::_('VRRETURNCAR') . "</label><div class=\"vrcsfentrydate\"><input type=\"text\" name=\"releasedate\" id=\"releasedate\" size=\"10\"/></div></div><div class=\"vrcsfentrytime\"><label>" . JText::_('VRALLEDROP') . "</label><span id=\"vrccomseldh\"><select name=\"releaseh\">" . $hours . "</select></span><span class=\"vrctimesep\">:</span><span id=\"vrccomseldm\"><select name=\"releasem\">" . $minutes . "</select></span></div></div>";
	}else {
		//default Joomla Calendar
		JHTML::_('behavior.calendar');
		$selform .= "<div class=\"vrcsfentrycont\"><div class=\"vrcsfentrylabsel\"><label>" . JText::_('VRPICKUPCAR') . "</label><div class=\"vrcsfentrydate\">" . JHTML::_('calendar', '', 'pickupdate', 'pickupdate', $vrcdateformat, array (
			'class' => '',
			'size' => '10',
			'maxlength' => '19'
		)) . "</div></div><div class=\"vrcsfentrytime\"><label>" . JText::_('VRALLE') . "</label><span id=\"vrccomselph\"><select name=\"pickuph\">" . $hours . "</select></span><span class=\"vrctimesep\">:</span><span id=\"vrccomselpm\"><select name=\"pickupm\">" . $minutes . "</select></span></div></div>\n";
		$selform .= "<div class=\"vrcsfentrycont\"><div class=\"vrcsfentrylabsel\"><label>" . JText::_('VRRETURNCAR') . "</label><div class=\"vrcsfentrydate\">" . JHTML::_('calendar', '', 'releasedate', 'releasedate', $vrcdateformat, array (
			'class' => '',
			'size' => '10',
			'maxlength' => '19'
		)) . "</div></div><div class=\"vrcsfentrytime\"><label>" . JText::_('VRALLEDROP') . "</label><span id=\"vrccomseldh\"><select name=\"releaseh\">" . $hours . "</select></span><span class=\"vrctimesep\">:</span><span id=\"vrccomseldm\"><select name=\"releasem\">" . $minutes . "</select></span></div></div>";
	}
	//
	if (@ is_array($places)) {
		$selform .= "<div class=\"vrcsfentrycont\"><label>" . JText::_('VRRETURNCARORD') . "</label><div class=\"vrcsfentryselect\"><select name=\"returnplace\" id=\"returnplace\"".(strlen($onchangeplacesdrop) > 0 ? $onchangeplacesdrop : "").">";
		foreach ($places as $pla) {
			$selform .= "<option value=\"" . $pla['id'] . "\" id=\"returnplace".$pla['id']."\">" . $pla['name'] . "</option>\n";
		}
		$selform .= "</select></div></div>\n";
	}
	if (vikrentcar::showCategoriesFront()) {
		$q = "SELECT * FROM `#__vikrentcar_categories` ORDER BY `#__vikrentcar_categories`.`ordering` ASC, `#__vikrentcar_categories`.`name` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$categories = $dbo->loadAssocList();
			$vrc_tn->translateContents($categories, '#__vikrentcar_categories');
			$selform .= "<div class=\"vrcsfentrycont\"><label>" . JText::_('VRCARCAT') . "</label><div class=\"vrcsfentryselect\"><select name=\"categories\">";
			$selform .= "<option value=\"all\">" . JText::_('VRALLCAT') . "</option>\n";
			foreach ($categories as $cat) {
				$selform .= "<option value=\"" . $cat['id'] . "\">" . $cat['name'] . "</option>\n";
			}
			$selform .= "</select></div></div>\n";
		}
	}
	$selform .= "<div class=\"vrcsfentrycont\"><div class=\"vrcsfentrysubmit\"><input type=\"submit\" name=\"search\" value=\"" . vikrentcar::getSubmitName() . "\"" . (strlen(vikrentcar::getSubmitClass()) ? " class=\"" . vikrentcar::getSubmitClass() . "\"" : "") . "/></div></div>\n";
	$selform .= "\n";
	//locations on google map
	if(count($coordsplaces) > 0) {
		JHTML::_('behavior.modal');
        $selform .= "</div>";
		$selform .= '<div class="vrclocationsbox"><div class="vrclocationsmapdiv"><a href="'.JURI::root().'index.php?option=com_vikrentcar&view=locationsmap&tmpl=component" rel="{handler: \'iframe\', size: {x: 750, y: 600}}" class="modal" target="_blank">'.JText::_('VRCLOCATIONSMAP').'</a></div></div>';
	}
	//
	$selform .= (!empty ($pitemid) ? "<input type=\"hidden\" name=\"Itemid\" value=\"" . $pitemid . "\"/>" : "") . "</form></div>";
	echo vikrentcar::getFullFrontTitle($vrc_tn);
	echo vikrentcar::getIntroMain($vrc_tn);
	if (strlen($err)) {
		echo "<p class=\"err\">" . $err . "</p>";
	}
	echo $selform;
	echo vikrentcar::getClosingMain($vrc_tn);
	//echo javascript to fill the date values
	if (!empty ($pval) && !empty ($rval)) {
		if($calendartype == "jqueryui") {
			?>
			<script type="text/javascript">
			jQuery.noConflict();
			jQuery(function(){
				jQuery('#pickupdate').val('<?php echo $pval; ?>');
				jQuery('#releasedate').val('<?php echo $rval; ?>');
			});
			</script>
			<?php
		}else {
			?>
			<script type="text/javascript">
			document.getElementById('pickupdate').value='<?php echo $pval; ?>';
			document.getElementById('releasedate').value='<?php echo $rval; ?>';
			</script>
			<?php
		}
	}
	//
} else {
	echo vikrentcar::getDisabledRentMsg($vrc_tn);
}
?>