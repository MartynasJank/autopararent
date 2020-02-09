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

class HTML_vikrentcar {
	public static function printHeader($highlight="") {
		$vrc_auth_cars = JFactory::getUser()->authorise('core.vrc.cars', 'com_vikrentcar');
		$vrc_auth_prices = JFactory::getUser()->authorise('core.vrc.prices', 'com_vikrentcar');
		$vrc_auth_orders = JFactory::getUser()->authorise('core.vrc.orders', 'com_vikrentcar');
		$vrc_auth_gsettings = JFactory::getUser()->authorise('core.vrc.gsettings', 'com_vikrentcar');
		if ($highlight == '18' || $highlight=='11') {
			JHTML::_('behavior.modal');
			//VikUpdater
			JPluginHelper::importPlugin('e4j');
			$dispatcher = JEventDispatcher::getInstance();
			$callable 	= $dispatcher->trigger('isCallable');
			if (count($callable) && $callable[0]) {
				//Plugin enabled
				$params = new stdClass;
				$params->version 	= E4J_SOFTWARE_VERSION;
				$params->alias 		= 'com_vikrentcar';
				
				$upd_btn_text = strrev('setadpU kcehC');
				$ready_jsfun = '';
				$result = $dispatcher->trigger('getVersionContents', array(&$params));
				if (count($result) && $result[0]) {
					$upd_btn_text = $result[0]->response->shortTitle;
				} else {
					$ready_jsfun = 'jQuery("#vik-update-btn").trigger("click");';
				}
				?>
				<button type="button" id="vik-update-btn" onclick="<?php echo count($result) && $result[0] && $result[0]->response->compare == 1 ? 'document.location.href=\'index.php?option=com_vikrentcar&task=updateprogram\'' : 'checkVersion(this);'; ?>" style="display: inline-block; float: right; background: #337AB7; color: #fff; border: 1px solid #2e6da4; border-radius: 4px; padding: 8px 15px 8px 10px;">
					<i class="vrcicn-cloud"></i> 
					<span><?php echo $upd_btn_text; ?></span>
				</button>
				<script type="text/javascript">
				function checkVersion(button) {
					jQuery(button).find('span').text('Checking...');
					jQuery.ajax({
						type: 'POST',
						url: 'index.php?option=com_vikrentcar&task=checkversion&tmpl=component',
						data: {}
					}).done(function(resp){
						var obj = jQuery.parseJSON(resp);
						console.log(obj);
						if (obj.status == 1 && obj.response.status == 1) {
							jQuery(button).find('span').text(obj.response.shortTitle);
							if (obj.response.compare == 1) {
								jQuery(button).attr('onclick', 'document.location.href="index.php?option=com_vikrentcar&task=updateprogram"');
							}
						}
					}).fail(function(resp){
						console.log(resp);
					});
				}
				jQuery(document).ready(function() {
					<?php echo $ready_jsfun; ?>
				});
				</script>
				<?php
			} else {
				//Plugin disabled
			?>
			<a id="vcheck" href="javascript: void(0);" onblur="this.href='javascript: void(0);';" class="modal" rel="{handler: 'iframe'}" target="_blank" style="font-size:11px; background:#22485d; color:#fff; text-decoration:none; display:inline-block; float:right; padding:3px 8px; border:1px solid #003300; border-radius:5px;" onclick="this.href = '<?php echo strrev(strrev(urlencode(E4J_SOFTWARE_VERSION)).'=rev&'.strrev(urlencode(CREATIVIKAPP)).'=ppa&'.strrev(urlencode(getenv("SERVER_NAME"))).'=ns&'.strrev(urlencode(getenv("HTTP_HOST"))).'=nh?/kcehckiv/moc.j4e//:sptth'); ?>';"><?php echo strrev('setadpU kcehC'); ?></a>
			<?php
			}
		}
		?>
		<div class="vrc-menu-container">
			<div class="vrc-menu-left"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/vikrentcar.jpg" alt="VikRentCar Logo" /></div>
			<div class="vrc-menu-right">
				<ul class="vrc-menu-ul">
					<li class="vrc-menu-parent-li">
						<span><i class="vrcicn-key2"></i> <a href="javascript: void(0);"><?php echo JText::_('VRMENUONE'); ?></a></span>
						<ul class="vrc-submenu-ul">
							<li><span class="<?php echo ($highlight=="18" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar"><?php echo JText::_('VRCMENUDASHBOARD'); ?></a></span></li>
						<?php
						if($vrc_auth_prices) {
							?>
							<li><span class="<?php echo ($highlight=="2" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewiva"><?php echo JText::_('VRMENUNINE'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="1" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewprices"><?php echo JText::_('VRMENUFIVE'); ?></a></span></li>
							<?php
						}
						if($vrc_auth_gsettings) {
							?>
							<li><span class="<?php echo ($highlight=="3" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewplaces"><?php echo JText::_('VRMENUTENTHREE'); ?></a></span></li>
							<?php
						}
						?>
						</ul>
					</li>
					<?php
					if($vrc_auth_cars) {
					?>
					<li class="vrc-menu-parent-li">
						<span><i class="vrcicn-truck"></i> <a href="javascript: void(0);"><?php echo JText::_('VRMENUTWO'); ?></a></span>
						<ul class="vrc-submenu-ul">
							<li><span class="<?php echo ($highlight=="4" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewcategories"><?php echo JText::_('VRMENUSIX'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="6" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewoptionals"><?php echo JText::_('VRMENUTENFIVE'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="5" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewcarat"><?php echo JText::_('VRMENUTENFOUR'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="7" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=cars"><?php echo JText::_('VRMENUTEN'); ?></a></span></li>
						</ul>
					</li>
					<?php
					}
					if($vrc_auth_orders) {
					?>
					<li class="vrc-menu-parent-li">
						<span><i class="vrcicn-credit-card"></i> <a href="javascript: void(0);"><?php echo JText::_('VRMENUTHREE'); ?></a></span>
						<ul class="vrc-submenu-ul">
							<li><span class="<?php echo ($highlight=="8" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=vieworders"><?php echo JText::_('VRMENUSEVEN'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="19" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=calendar"><?php echo JText::_('VRCMENUQUICKRES'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="15" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=overview"><?php echo JText::_('VRMENUTENNINE'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="22" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=graphs"><?php echo JText::_('VRMENUGRAPHS'); ?></a></span></li>
						</ul>
					</li>
					<?php
					}
					if($vrc_auth_prices) {
					?>
					<li class="vrc-menu-parent-li">
						<span><i class="vrcicn-calculator"></i> <a href="javascript: void(0);"><?php echo JText::_('VRCMENUFARES'); ?></a></span>
						<ul class="vrc-submenu-ul">
							<li><span class="<?php echo ($highlight=="fares" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewtariffe"><?php echo JText::_('VRCMENUPRICESTABLE'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="13" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=seasons"><?php echo JText::_('VRMENUTENSEVEN'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="12" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=locfees"><?php echo JText::_('VRMENUTENSIX'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="20" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=oohfees"><?php echo JText::_('VRCMENUOOHFEES'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="17" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewcoupons"><?php echo JText::_('VRCMENUCOUPONS'); ?></a></span></li>
						</ul>
					</li>
					<?php
					}
					if($vrc_auth_gsettings) {
					?>
					<li class="vrc-menu-parent-li">
						<span><i class="vrcicn-cogs"></i> <a href="javascript: void(0);"><?php echo JText::_('VRMENUFOUR'); ?></a></span>
						<ul class="vrc-submenu-ul">
							<li><span class="<?php echo ($highlight=="11" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=config"><?php echo JText::_('VRMENUTWELVE'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="21" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=translations"><?php echo JText::_('VRMENUTRANSLATIONS'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="14" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=payments"><?php echo JText::_('VRMENUTENEIGHT'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="16" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewcustomf"><?php echo JText::_('VRMENUTENTEN'); ?></a></span></li>
							<li><span class="<?php echo ($highlight=="10" ? "vmenulinkactive" : "vmenulink"); ?>"><a href="index.php?option=com_vikrentcar&amp;task=viewstats"><?php echo JText::_('VRMENUEIGHT'); ?></a></span></li>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
		<div style="clear: both;"></div>
		<script type="text/javascript">
		jQuery.noConflict();
		var vrc_menu_on = false;
		jQuery(document).ready(function(){
			jQuery('.vrc-menu-parent-li').click(function() {
				if(jQuery(this).find('ul.vrc-submenu-ul').is(':visible')) {
					vrc_menu_on = false;
					return;
				}
				jQuery('ul.vrc-submenu-ul').hide();
				jQuery(this).find('ul.vrc-submenu-ul').show();
				vrc_menu_on = true;
			});
			jQuery('.vrc-menu-parent-li').hover(
				function() {
					if(vrc_menu_on === true) {
						jQuery(this).find('ul.vrc-submenu-ul').show();
					}
				},function() {
					if(vrc_menu_on === true) {
						jQuery(this).find('ul.vrc-submenu-ul').hide();
					}
				}
			);
			var targetY = jQuery('.vrc-menu-right').offset().top + jQuery('.vrc-menu-right').outerHeight() + 150;
			jQuery(document).click(function(event) { 
				if(!jQuery(event.target).closest('.vrc-menu-right').length && parseInt(event.which) == 1 && event.pageY < targetY) {
					jQuery('ul.vrc-submenu-ul').hide();
					vrc_menu_on = false;
				}
			});
			if(jQuery('.vmenulinkactive').length) {
				jQuery('.vmenulinkactive').parent('li').parent('ul').show();
				jQuery('.vmenulinkactive').parent('li').parent('ul').parent('li').addClass('vrc-menu-parent-li-active');
			}
		});
		</script>
		<?php
	}
	
	public static function printFooter() {
		echo '<br clear="all" />' . '<div id="hmfooter">' . JText::sprintf('VRCVERSION', E4J_SOFTWARE_VERSION) . ' <a href="http://www.extensionsforjoomla.com/">e4j - Extensionsforjoomla.com</a></div>';
	}

	//VikUpdater plugin methods - Start

	public static function pUpdateProgram($version) {
		?>
		<form name="adminForm" action="index.php" method="post" enctype="multipart/form-data" id="adminForm">
	
			<div class="span12">
				<fieldset class="form-horizontal">
					<legend><?php $version->shortTitle ?></legend>
					<div class="control"><strong><?php echo $version->title; ?></strong></div>

					<div class="control" style="margin-top: 10px;">
						<button type="button" class="btn btn-primary" onclick="downloadSoftware(this);">
							<?php echo JText::_($version->compare == 1 ? 'VRDOWNLOADUPDATEBTN1' : 'VRDOWNLOADUPDATEBTN0'); ?>
						</button>
					</div>

					<div class="control vik-box-error" id="update-error" style="display: none;margin-top: 10px;"></div>

					<?php if( isset($version->changelog) && count($version->changelog) ) { ?>

						<div class="control vik-update-changelog" style="margin-top: 10px;">

							<?php echo self::digChangelog($version->changelog); ?>

						</div>

					<?php } ?>
				</fieldset>
			</div>

			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="option" value="com_vikrentcar"/>
		</form>

		<div id="vikupdater-loading" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999999 !important; background-color: rgba(0,0,0,0.5);">
			<div id="vikupdater-loading-content" style="position: fixed; left: 33.3%; top: 30%; width: 33.3%; height: auto; z-index: 101; padding: 10px; border-radius: 5px; background-color: #fff; box-shadow: 5px 5px 5px 0 #000; overflow: auto; text-align: center;">
				<span id="vikupdater-loading-message" style="display: block; text-align: center;"></span>
				<span id="vikupdater-loading-dots" style="display: block; font-weight: bold; font-size: 25px; text-align: center; color: green;">.</span>
			</div>
		</div>
		
		<script type="text/javascript">
		var isRunning = false;
		var loadingInterval;

		function vikLoadingAnimation() {
			var dotslength = jQuery('#vikupdater-loading-dots').text().length + 1;
			if (dotslength > 10) {
				dotslength = 1;
			}
			var dotscont = '';
			for (var i = 1; i <= dotslength; i++) {
				dotscont += '.';
			}
			jQuery('#vikupdater-loading-dots').text(dotscont);
		}

		function openLoadingOverlay(message) {
			jQuery('#vikupdater-loading-message').html(message);
			jQuery('#vikupdater-loading').fadeIn();
			loadingInterval = setInterval(vikLoadingAnimation, 1000);
		}

		function closeLoadingOverlay() {
			jQuery('#vikupdater-loading').fadeOut();
			clearInterval(loadingInterval);
		}

		function downloadSoftware(btn) {

			if( isRunning ) {
				return;
			}

			switchRunStatus(btn);
			setError(null);

			var jqxhr = jQuery.ajax({
				url: "index.php?option=com_vikrentcar&task=updateprogramlaunch&tmpl=component",
				type: "POST",
				data: {}
			}).done(function(resp){

				try {
					var obj = jQuery.parseJSON(resp);
				} catch (e) {
					console.log(resp);
					return;
				}
				
				if( obj === null ) {

					// connection failed. Something gone wrong while decoding JSON
					alert('<?php echo addslashes('Connection Error'); ?>');

				} else if( obj.status ) {

					document.location.href = 'index.php?option=com_vikrentcar';
					return;

				} else {

					console.log("### ERROR ###");
					console.log(obj);

					if( obj.hasOwnProperty('error') ) {
						setError(obj.error);
					} else {
						setError('Your website does not own a valid support license!<br />Please visit <a href="https://extensionsforjoomla.com" target="_blank">extensionsforjoomla.com</a> to purchase a license or to receive assistance.');
					}

				}

				switchRunStatus(btn);

			}).fail(function(resp){
				console.log('### FAILURE ###');
				console.log(resp);
				alert('<?php echo addslashes('Connection Error'); ?>');

				switchRunStatus(btn);
			}); 
		}

		function switchRunStatus(btn) {
			isRunning = !isRunning;

			jQuery(btn).prop('disabled', isRunning);

			if( isRunning ) {
				// start loading
				openLoadingOverlay('The process may take a few minutes to complete.<br />Please wait without leaving the page or closing the browser.');
			} else {
				// stop loading
				closeLoadingOverlay();
			}
		}

		function setError(err) {

			if( err !== null && err !== undefined && err.length ) {
				jQuery('#update-error').show();
			} else {
				jQuery('#update-error').hide();
			}

			jQuery('#update-error').html(err);

		}

	</script>
		<?php
	}

	/**
	 * Scan changelog structure.
	 *
	 * @param 	array 	$arr 	The list containing changelog elements.
	 * @param 	mixed 	$html 	The html built. 
	 * 							Specify false to echo the structure immediately.
	 *
	 * @return 	string|void 	The HTML structure or nothing.
	 */
	private static function digChangelog(array $arr, $html = '') {

		foreach( $arr as $elem ):

			if( isset($elem->tag) ):

				// build attributes

				$attributes = "";
				if( isset($elem->attributes) ) {

					foreach( $elem->attributes as $k => $v ) {
						$attributes .= " $k=\"$v\"";
					}

				}

				// build tag opening

				$str = "<{$elem->tag}$attributes>";

				if( $html ) {
					$html .= $str;
				} else {
					echo $str;
				}

				// display contents

				if( isset($elem->content) ) {

					if( $html ) {
						$html .= $elem->content;
					} else {
						echo $elem->content;
					}

				}

				// recursive iteration for elem children

				if( isset($elem->children) ) {
					self::digChangelog($elem->children, $html);
				}

				// build tag closure

				$str = "</{$elem->tag}>";

				if( $html ) {
					$html .= $str;
				} else {
					echo $str;
				}

			endif;

		endforeach;

		return $html;
	}
	//VikUpdater plugin methods - End
	
	public static function pViewDashboard($pidplace, $arrayfirst, $allplaces, $nextrentals, $pickup_today, $dropoff_today, $cars_locked, $totnextrentconf, $totnextrentpend, $option) {
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$selplace = "";
		if(is_array($allplaces)) {
			$selplace = JText::_('VRCDASHPICKUPLOC')." <form action=\"index.php?option=com_vikrentcar\" method=\"post\" name=\"vrcdashform\" style=\"display: inline;\"><select name=\"idplace\" onchange=\"javascript: document.vrcdashform.submit();\">\n<option value=\"0\">".JText::_('VRCDASHALLPLACES')."</option>\n";
			foreach($allplaces as $place) {
				$selplace .= "<option value=\"".$place['id']."\"".($place['id'] == $pidplace ? " selected=\"selected\"" : "").">".$place['name']."</option>\n";
			}
			$selplace .= "</select></form>\n";
		}
		//Todays Pick Up
		?>
		<div class="vrc-dashboard-today-bookings">
			<div class="vrc-dashboard-today-pickup-wrapper">
				<h4><?php echo JText::_('VRCDASHTODAYPICKUP'); ?></h4>
				<div class="vrc-dashboard-today-pickup table-responsive">
					<table class="table">
						<tr class="vrc-dashboard-today-pickup-firstrow">
							<td align="center"><?php echo JText::_('VRCDASHUPRESONE'); ?></td>
							<td align="center"><?php echo JText::_('VRCDASHUPRESTWO'); ?></td>
							<td align="center"><?php echo JText::_('VRPVIEWORDERSTWO'); ?></td>
							<td align="center"><?php echo JText::_('VRCDASHUPRESTHREE'); ?></td>
							<td align="center"><?php echo JText::_('VRCDASHUPRESFOUR'); ?></td>
							<td><?php echo JText::_('VRCDASHUPRESFIVE'); ?></td>
						</tr>
					<?php
					foreach($pickup_today as $next) {
						$car = vikrentcar::getCarInfo($next['idcar']);
						$nominative = strlen($next['nominative']) > 1 ? $next['nominative'] : vikrentcar::getFirstCustDataField($next['custdata']);
						$country_flag = '';
						if(file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'countries'.DS.$next['country'].'.png')) {
							$country_flag = '<img src="'.JURI::root().'administrator/components/com_vikrentcar/resources/countries/'.$next['country'].'.png'.'" title="'.$next['country'].'" class="vrc-country-flag vrc-country-flag-left"/>';
						}
						$status_lbl = '';
						if($next['status'] == 'confirmed') {
							$status_lbl = '<span style="font-weight: bold; color: green;">'.strtoupper(JText::_('VRCONFIRMED')).'</span>';
						}elseif($next['status'] == 'standby') {
							$status_lbl = '<span style="font-weight: bold; color: #f89406;">'.strtoupper(JText::_('VRSTANDBY')).'</span>';
						}elseif($next['status'] == 'cancelled') {
							$status_lbl = '<span style="font-weight: bold; color: red;">'.strtoupper(JText::_('VRCANCELLED')).'</span>';
						}
						?>
						<tr class="vrc-dashboard-today-pickup-rows">
							<td align="center"><a href="index.php?option=com_vikrentcar&amp;task=editorder&amp;cid[]=<?php echo $next['id']; ?>"><?php echo $next['id']; ?></a></td>
							<td align="center"><?php echo $car['name']; ?></td>
							<td align="center"><?php echo $country_flag.$nominative; ?></td>
							<td align="center"><?php echo (!empty($next['idplace']) && empty($pidplace) ? vikrentcar::getPlaceName($next['idplace'])." " : "").date($nowtf, $next['ritiro']); ?></td>
							<td align="center"><?php echo (!empty($next['idreturnplace']) ? vikrentcar::getPlaceName($next['idreturnplace'])." " : "").date($df.' '.$nowtf, $next['consegna']); ?></td>
							<td align="center"><?php echo $status_lbl; ?></td>
						</tr>
						<?php
					}
					?>
					</table>
				</div>
			</div>
			<?php
			//Todays Drop Off
			?>
			<div class="vrc-dashboard-today-dropoff-wrapper">
				<h4><?php echo JText::_('VRCDASHTODAYDROPOFF'); ?></h4>
				<div class="vrc-dashboard-today-dropoff table-responsive">
					<table class="table">
						<tr class="vrc-dashboard-today-dropoff-firstrow">
							<td align="center"><?php echo JText::_('VRCDASHUPRESONE'); ?></td>
							<td align="center"><?php echo JText::_('VRCDASHUPRESTWO'); ?></td>
							<td align="center"><?php echo JText::_('VRPVIEWORDERSTWO'); ?></td>
							<td align="center"><?php echo JText::_('VRCDASHUPRESTHREE'); ?></td>
							<td align="center"><?php echo JText::_('VRCDASHUPRESFOUR'); ?></td>
							<td><?php echo JText::_('VRCDASHUPRESFIVE'); ?></td>
						</tr>
					<?php
					foreach ($dropoff_today as $next) {
						$car = vikrentcar::getCarInfo($next['idcar']);
						$nominative = strlen($next['nominative']) > 1 ? $next['nominative'] : vikrentcar::getFirstCustDataField($next['custdata']);
						$country_flag = '';
						if(file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'countries'.DS.$next['country'].'.png')) {
							$country_flag = '<img src="'.JURI::root().'administrator/components/com_vikrentcar/resources/countries/'.$next['country'].'.png'.'" title="'.$next['country'].'" class="vrc-country-flag vrc-country-flag-left"/>';
						}
						$status_lbl = '';
						if($next['status'] == 'confirmed') {
							$status_lbl = '<span style="font-weight: bold; color: green;">'.strtoupper(JText::_('VRCONFIRMED')).'</span>';
						}elseif($next['status'] == 'standby') {
							$status_lbl = '<span style="font-weight: bold; color: #f89406;">'.strtoupper(JText::_('VRSTANDBY')).'</span>';
						}elseif($next['status'] == 'cancelled') {
							$status_lbl = '<span style="font-weight: bold; color: red;">'.strtoupper(JText::_('VRCANCELLED')).'</span>';
						}
						?>
						<tr class="vrc-dashboard-today-pickup-rows">
							<td align="center"><a href="index.php?option=com_vikrentcar&amp;task=editorder&amp;cid[]=<?php echo $next['id']; ?>"><?php echo $next['id']; ?></a></td>
							<td align="center"><?php echo $car['name']; ?></td>
							<td align="center"><?php echo $country_flag.$nominative; ?></td>
							<td align="center"><?php echo (!empty($next['idplace']) && empty($pidplace) ? vikrentcar::getPlaceName($next['idplace'])." " : "").date($df.' '.$nowtf, $next['ritiro']); ?></td>
							<td align="center"><?php echo (!empty($next['idreturnplace']) ? vikrentcar::getPlaceName($next['idreturnplace'])." " : "").date($nowtf, $next['consegna']); ?></td>
							<td align="center"><?php echo $status_lbl; ?></td>
						</tr>
						<?php
					}
					?>
					</table>
				</div>
			</div>
		</div>

		<br clear="all" /><br clear="all">

		<div class="vrc-dashboard-next-bookings-block">
			<div class="vrc-dashboard-next-bookings table-responsive">
				<h4><?php echo JText::_('VRCDASHUPCRES'); ?></h4>
				<div style="float: right; margin: 13px;"><?php echo $selplace; ?></div>
		<?php
		if(is_array($nextrentals)) {
			?>
				<table class="table">
					<tr class="vrc-dashboard-today-dropoff-firstrow">
						<td align="center"><?php echo JText::_('VRCDASHUPRESONE'); ?></td>
						<td align="center"><?php echo JText::_('VRCDASHUPRESTWO'); ?></td>
						<td align="center"><?php echo JText::_('VRPVIEWORDERSTWO'); ?></td>
						<td align="center"><?php echo JText::_('VRCDASHUPRESTHREE'); ?></td>
						<td align="center"><?php echo JText::_('VRCDASHUPRESFOUR'); ?></td>
						<td align="center"><?php echo JText::_('VRCDASHUPRESFIVE'); ?></td>
					</tr>
			<?php
			foreach($nextrentals as $next) {
				$car = vikrentcar::getCarInfo($next['idcar']);
				$nominative = strlen($next['nominative']) > 1 ? $next['nominative'] : vikrentcar::getFirstCustDataField($next['custdata']);
				$country_flag = '';
				if(file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'countries'.DS.$next['country'].'.png')) {
					$country_flag = '<img src="'.JURI::root().'administrator/components/com_vikrentcar/resources/countries/'.$next['country'].'.png'.'" title="'.$next['country'].'" class="vrc-country-flag vrc-country-flag-left"/>';
				}
				$status_lbl = '';
				if($next['status'] == 'confirmed') {
					$status_lbl = '<span style="font-weight: bold; color: green;">'.strtoupper(JText::_('VRCONFIRMED')).'</span>';
				}elseif($next['status'] == 'standby') {
					$status_lbl = '<span style="font-weight: bold; color: #f89406;">'.strtoupper(JText::_('VRSTANDBY')).'</span>';
				}elseif($next['status'] == 'cancelled') {
					$status_lbl = '<span style="font-weight: bold; color: red;">'.strtoupper(JText::_('VRCANCELLED')).'</span>';
				}
				?>
					<tr class="vrc-dashboard-today-dropoff-rows">
						<td align="center"><a href="index.php?option=com_vikrentcar&amp;task=editorder&amp;cid[]=<?php echo $next['id']; ?>"><?php echo $next['id']; ?></a></td>
						<td align="center"><?php echo $car['name']; ?></td>
						<td align="center"><?php echo $country_flag.$nominative; ?></td>
						<td align="center"><?php echo (!empty($next['idplace']) && empty($pidplace) ? vikrentcar::getPlaceName($next['idplace'])." " : "").date($df.' '.$nowtf, $next['ritiro']); ?></td>
						<td align="center"><?php echo (!empty($next['idreturnplace']) ? vikrentcar::getPlaceName($next['idreturnplace'])." " : "").date($df.' '.$nowtf, $next['consegna']); ?></td>
						<td align="center"><?php echo $status_lbl; ?></td>
					</tr>
				<?php
			}
			?>
				</table>
			<?php
		}
		?>
			</div>
		</div>

		<br clear="all" />

		<?php
		//Cars Locked
		if(count($cars_locked)) {
			?>
		<div class="vrc-dashboard-cars-locked-block">
			<div class="vrc-dashboard-cars-locked table-responsive">
				<h4 id="vrc-dashboard-cars-locked-toggle"><?php echo JText::_('VRCDASHCARSLOCKED'); ?><span>(<?php echo count($cars_locked); ?>)</span></h4>
				<table class="table" style="display: none;">
					<tr class="vrc-dashboard-cars-locked-firstrow">
						<td align="center"><?php echo JText::_('VRCDASHUPRESTWO'); ?></td>
						<td align="center"><?php echo JText::_('VRPVIEWORDERSTWO'); ?></td>
						<td align="center"><?php echo JText::_('VRCDASHLOCKUNTIL'); ?></td>
						<td align="center"><?php echo JText::_('VRCDASHUPRESONE'); ?></td>
						<td align="center">&nbsp;</td>
					</tr>
				<?php
				foreach ($cars_locked as $lock) {
					$country_flag = '';
					if(file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'countries'.DS.$lock['country'].'.png')) {
						$country_flag = '<img src="'.JURI::root().'administrator/components/com_vikrentcar/resources/countries/'.$lock['country'].'.png'.'" title="'.$lock['country'].'" class="vrc-country-flag vrc-country-flag-left"/>';
					}
					?>
					<tr class="vrc-dashboard-cars-locked-rows">
						<td align="center"><?php echo $lock['car_name']; ?></td>
						<td align="center"><?php echo $country_flag.$lock['nominative']; ?></td>
						<td align="center"><?php echo date($df.' '.$nowtf, $lock['until']); ?></td>
						<td align="center"><a href="index.php?option=com_vikrentcar&amp;task=editorder&amp;cid[]=<?php echo $lock['idorder']; ?>" target="_blank"><?php echo $lock['idorder']; ?></a></td>
						<td align="center"><button type="button" class="btn btn-danger" onclick="if(confirm('<?php echo addslashes(JText::_('VRCDELCONFIRM')); ?>')) location.href='index.php?option=com_vikrentcar&amp;task=unlockrecords&amp;cid[]=<?php echo $lock['id']; ?>';"><?php echo JText::_('VRCDASHUNLOCK'); ?></button></td>
					</tr>
					<?php
				}
				?>
				</table>
			</div>
		</div>
		<script type="text/JavaScript">
		jQuery(document).ready(function() {
			jQuery("#vrc-dashboard-cars-locked-toggle").click(function(){
				jQuery(this).next("table").fadeToggle();
			});
		});
		</script>
			<?php
		}
		?>
		
		<div class="vrcdashdivright">
			<h3 class="vrcdashdivrighthead"><?php echo JText::_('VRCDASHSTATS'); ?></h3>
			<p class="vrcdashparag"></p>
		<?php
		if($arrayfirst['totprices'] < 1) {
			?>
			<p class="vrcdashparagred"><?php echo JText::_('VRCDASHNOPRICES'); ?>: 0</p>
			<?php
		}
		if($arrayfirst['totlocations'] < 1) {
			?>
			<p class="vrcdashparagred"><?php echo JText::_('VRCDASHNOLOCATIONS'); ?>: 0</p>
			<?php
		}else {
			?>
			<p class="vrcdashparag"><?php echo JText::_('VRCDASHNOLOCATIONS').': '.$arrayfirst['totlocations']; ?></p>
			<?php
		}
		if($arrayfirst['totcategories'] < 1) {
			?>
			<p class="vrcdashparagred"><?php echo JText::_('VRCDASHNOCATEGORIES'); ?>: 0</p>
			<?php
		}else {
			?>
			<p class="vrcdashparag"><?php echo JText::_('VRCDASHNOCATEGORIES').': '.$arrayfirst['totcategories']; ?></p>
			<?php
		}
		if($arrayfirst['totcars'] < 1) {
			?>
			<p class="vrcdashparagred"><?php echo JText::_('VRCDASHNOCARS'); ?>: 0</p>
			<?php
		}else {
			?>
			<p class="vrcdashparag"><?php echo JText::_('VRCDASHNOCARS').': '.$arrayfirst['totcars']; ?></p>
			<?php
		}
		if($arrayfirst['totdailyfares'] < 1) {
			?>
			<p class="vrcdashparagred"><?php echo JText::_('VRCDASHNODAILYFARES'); ?>: 0</p>
			<?php
		}
		?>
			<p class="vrcdashparag"><?php echo JText::_('VRCDASHTOTRESCONF').': '.$totnextrentconf; ?></p>
			<p class="vrcdashparag"><?php echo JText::_('VRCDASHTOTRESPEND').': '.$totnextrentpend; ?></p>
		</div>
		<?php
	}
	
	public static function printHeaderCar($car, $name, $prezzi, $idcar, $allc) {
		if (file_exists('./components/com_vikrentcar/resources/'.$car) && getimagesize('./components/com_vikrentcar/resources/'.$car)) {
			$img='<img align="middle" class="maxninety" alt="Car Image" src="' . JURI::root() . 'administrator/components/com_vikrentcar/resources/'.$car.'" />';
		}else {
			$img='<img align="middle" alt="vikrentcar logo" src="' . JURI::root() . 'administrator/components/com_vikrentcar/vikrentcar.jpg' . '" />';
		}
		//$fprice="<p class=\"vrcadminfaresctitle\">".$name." - ".JText::_('VRINSERTFEE')."</p>\n";
		//switch bewtween daily, hourly fares
		$fprice="<div class=\"dailypricesactive\">".JText::_('VRCDAILYFARES')."</div><div class=\"hourscharges\"><a href=\"index.php?option=com_vikrentcar&task=viewhourscharges&cid[]=".$idcar."\">".JText::_('VRCHOURSCHARGES')."</a></div><div class=\"hourlyprices\"><a href=\"index.php?option=com_vikrentcar&task=viewtariffehours&cid[]=".$idcar."\">".JText::_('VRCHOURLYFARES')."</a></div>\n";
		//
		if (empty($prezzi)) {
			$fprice.="<br/><span class=\"err\"><b>".JText::_('VRMSGONE')." <a href=\"index.php?option=com_vikrentcar&task=newprice\">".JText::_('VRHERE')."</a></b></span>";
		}else {
			$colsp="2";
			$fprice.="<form name=\"newd\" method=\"post\" action=\"index.php?option=com_vikrentcar\" onsubmit=\"javascript: if(!document.newd.ddaysfrom.value.match(/\S/)){alert('".JText::_('VRMSGTWO')."'); return false;}else{return true;}\">\n<br clear=\"all\"/><div style=\"margin-left: 1px; padding: 10px; background: #cfe788; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px;\"><span style=\"font-weight: bold; color: #5D7120; font-size: 12px; padding: 0 0 7px;\">".JText::_('VRDAYS').": </span><br/><table><tr><td>".JText::_('VRDAYSFROM')." <input type=\"text\" name=\"ddaysfrom\" value=\"\" size=\"5\"/></td><td>&nbsp;&nbsp;&nbsp; ".JText::_('VRDAYSTO')." <input type=\"text\" name=\"ddaysto\" value=\"\" size=\"5\"/></td></tr></table>\n";
			$fprice.="<br/><span style=\"font-weight: bold; color: #5D7120; font-size: 12px; padding: 0 0 7px;\">".JText::_('VRDAILYPRICES').": </span><br/><table>\n";
			$currencysymb=vikrentcar::getCurrencySymb(true);
			foreach($prezzi as $pr){
				$fprice.="<tr><td>".$pr['name'].": </td><td>".$currencysymb." <input type=\"text\" name=\"dprice".$pr['id']."\" value=\"\" size=\"10\"/></td>";
				if (!empty($pr['attr'])) {
					$colsp="4";
					$fprice.="<td>".$pr['attr']."</td><td><input type=\"text\" name=\"dattr".$pr['id']."\" value=\"\" size=\"10\"/></td>";
				}
				$fprice.="</tr>\n";
			}
			$fprice.="<tr><td colspan=\"".$colsp."\" align=\"center\"><input type=\"submit\" class=\"vrcsubmitfares\" name=\"newdispcost\" value=\"".JText::_('VRINSERT')."\"/></td></tr></table></div><input type=\"hidden\" name=\"cid[]\" value=\"".$idcar."\"/><input type=\"hidden\" name=\"task\" value=\"viewtariffe\"/></form>";
		}
		$chcarsel = "<select name=\"cid[]\" onchange=\"javascript: document.vrcchcar.submit();\">\n";
		foreach($allc as $cc) {
			$chcarsel .= "<option value=\"".$cc['id']."\"".($cc['id'] == $idcar ? " selected=\"selected\"" : "").">".$cc['name']."</option>\n";
		}
		$chcarsel .= "</select>\n";
		$chcarf = "<form name=\"vrcchcar\" method=\"post\" action=\"index.php?option=com_vikrentcar\"><input type=\"hidden\" name=\"task\" value=\"viewtariffe\"/>".JText::_('VRCSELVEHICLE').": ".$chcarsel."</form>";
		echo "<table><tr><td colspan=\"2\" valign=\"top\" align=\"left\"><div class=\"vrcadminfaresctitle\">".$name." - ".JText::_('VRINSERTFEE')." <span style=\"float: right; text-transform: none;\">".$chcarf."</span></div></td></tr><tr><td valign=\"top\" align=\"left\">".$img."</td><td valign=\"top\" align=\"left\">".$fprice."</td></tr></table><br/>\n";	
	}
	
	public static function printHeaderCarHours($car, $name, $prezzi, $idcar, $allc) {
		if (file_exists('./components/com_vikrentcar/resources/'.$car) && getimagesize('./components/com_vikrentcar/resources/'.$car)) {
			$img='<img align="middle" class="maxninety" alt="Car Image" src="' . JURI::root() . 'administrator/components/com_vikrentcar/resources/'.$car.'" />';
		}else {
			$img='<img align="middle" alt="vikrentcar logo" src="' . JURI::root() . 'administrator/components/com_vikrentcar/vikrentcar.jpg' . '" />';
		}
		//$fprice="<p class=\"vrcadminfaresctitle\">".$name." - ".JText::_('VRINSERTFEE')."</p>\n";
		//switch bewtween daily, hourly fares
		$fprice="<div class=\"dailyprices\"><a href=\"index.php?option=com_vikrentcar&task=viewtariffe&cid[]=".$idcar."\">".JText::_('VRCDAILYFARES')."</a></div><div class=\"hourscharges\"><a href=\"index.php?option=com_vikrentcar&task=viewhourscharges&cid[]=".$idcar."\">".JText::_('VRCHOURSCHARGES')."</a></div><div class=\"hourlypricesactive\">".JText::_('VRCHOURLYFARES')."</div>\n";
		//
		if (empty($prezzi)) {
			$fprice.="<br/><span class=\"err\"><b>".JText::_('VRMSGONE')." <a href=\"index.php?option=com_vikrentcar&task=newprice\">".JText::_('VRHERE')."</a></b></span>";
		}else {
			$colsp="2";
			$fprice.="<form name=\"newd\" method=\"post\" action=\"index.php?option=com_vikrentcar\" onsubmit=\"javascript: if(!document.newd.hhoursfrom.value.match(/\S/)){alert('".JText::_('VRMSGTWO')."'); return false;}else{return true;}\">\n<br clear=\"all\"/><div style=\"margin-left: 1px; padding: 10px; background: #93d4d4; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px;\"><span style=\"font-weight: bold; color: #025A8D; font-size: 12px; padding: 0 0 7px;\">".JText::_('VRCHOURS').": </span><br/><table><tr><td>".JText::_('VRDAYSFROM')." <input type=\"text\" name=\"hhoursfrom\" value=\"\" size=\"5\"/></td><td>&nbsp;&nbsp;&nbsp; ".JText::_('VRDAYSTO')." <input type=\"text\" name=\"hhoursto\" value=\"\" size=\"5\"/></td></tr></table>\n";
			$fprice.="<br/><span style=\"font-weight: bold; color: #025A8D; font-size: 12px; padding: 0 0 7px;\">".JText::_('VRCHOURLYPRICES').": </span><br/><table>\n";
			$currencysymb=vikrentcar::getCurrencySymb(true);
			foreach($prezzi as $pr){
				$fprice.="<tr><td>".$pr['name'].": </td><td>".$currencysymb." <input type=\"text\" name=\"hprice".$pr['id']."\" value=\"\" size=\"10\"/></td>";
				if (!empty($pr['attr'])) {
					$colsp="4";
					$fprice.="<td>".$pr['attr']."</td><td><input type=\"text\" name=\"hattr".$pr['id']."\" value=\"\" size=\"10\"/></td>";
				}
				$fprice.="</tr>\n";
			}
			$fprice.="<tr><td colspan=\"".$colsp."\" align=\"center\"><input type=\"submit\" class=\"vrcsubmithfares\" name=\"newdispcost\" value=\"".JText::_('VRINSERT')."\"/></td></tr></table></div><input type=\"hidden\" name=\"cid[]\" value=\"".$idcar."\"/><input type=\"hidden\" name=\"task\" value=\"viewtariffehours\"/></form>";
		}
		$chcarsel = "<select name=\"cid[]\" onchange=\"javascript: document.vrcchcar.submit();\">\n";
		foreach($allc as $cc) {
			$chcarsel .= "<option value=\"".$cc['id']."\"".($cc['id'] == $idcar ? " selected=\"selected\"" : "").">".$cc['name']."</option>\n";
		}
		$chcarsel .= "</select>\n";
		$chcarf = "<form name=\"vrcchcar\" method=\"post\" action=\"index.php?option=com_vikrentcar\"><input type=\"hidden\" name=\"task\" value=\"viewtariffehours\"/>".JText::_('VRCSELVEHICLE').": ".$chcarsel."</form>";
		echo "<table><tr><td colspan=\"2\" valign=\"top\" align=\"left\"><div class=\"vrcadminfaresctitle\">".$name." - ".JText::_('VRINSERTFEE')." <span style=\"float: right; text-transform: none;\">".$chcarf."</span></div></td></tr><tr><td valign=\"top\" align=\"left\">".$img."</td><td valign=\"top\" align=\"left\">".$fprice."</td></tr></table><br/>\n";	
	}
	
	public static function printHeaderCarHoursCharges($car, $name, $prezzi, $idcar, $allc) {
		JHTML::_('behavior.tooltip');
		if (file_exists('./components/com_vikrentcar/resources/'.$car) && getimagesize('./components/com_vikrentcar/resources/'.$car)) {
			$img='<img align="middle" class="maxninety" alt="Car Image" src="' . JURI::root() . 'administrator/components/com_vikrentcar/resources/'.$car.'" />';
		}else {
			$img='<img align="middle" alt="vikrentcar logo" src="' . JURI::root() . 'administrator/components/com_vikrentcar/vikrentcar.jpg' . '" />';
		}
		//$fprice="<p class=\"vrcadminfaresctitle\">".$name." - ".JText::_('VRINSERTFEE')."</p>\n";
		//switch bewtween daily, hourly fares or extra hours charges
		$fprice="<div class=\"dailyprices\"><a href=\"index.php?option=com_vikrentcar&task=viewtariffe&cid[]=".$idcar."\">".JText::_('VRCDAILYFARES')."</a></div><div class=\"hourschargesactive\">".JText::_('VRCHOURSCHARGES')."</div><div class=\"hourlyprices\"><a href=\"index.php?option=com_vikrentcar&task=viewtariffehours&cid[]=".$idcar."\">".JText::_('VRCHOURLYFARES')."</a></div>\n";
		//
		if (empty($prezzi)) {
			$fprice.="<br/><span class=\"err\"><b>".JText::_('VRMSGONE')." <a href=\"index.php?option=com_vikrentcar&task=newprice\">".JText::_('VRHERE')."</a></b></span>";
		}else {
			$colsp="2";
			$fprice.="<form name=\"newd\" method=\"post\" action=\"index.php?option=com_vikrentcar\" onsubmit=\"javascript: if(!document.newd.hhoursfrom.value.match(/\S/)){alert('".JText::_('VRMSGTWO')."'); return false;}else{return true;}\">\n<br clear=\"all\"/><div style=\"margin-left: 1px; padding: 10px; background: #8fdc5b; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px;\"><span style=\"font-weight: bold; color: #ffffff; font-size: 12px; padding: 0 0 7px;\">".JText::_('VRCEXTRARHOURS').": </span><br/><table><tr><td>".JText::_('VRDAYSFROM')." <input type=\"text\" name=\"hhoursfrom\" value=\"\" size=\"5\"/></td><td>&nbsp;&nbsp;&nbsp; ".JText::_('VRDAYSTO')." <input type=\"text\" name=\"hhoursto\" value=\"\" size=\"5\"/></td><td>&nbsp;&nbsp;&nbsp; ".JHTML::tooltip(JText::_('VRCSHCHARGESHELP'), JText::_('VRCHOURSCHARGES'), 'tooltip.png', '')."</td></tr></table>\n";
			$fprice.="<br/><span style=\"font-weight: bold; color: #ffffff; font-size: 12px; padding: 0 0 7px;\">".JText::_('VRCHOURLYCHARGES').": </span><br/><table>\n";
			$currencysymb=vikrentcar::getCurrencySymb(true);
			foreach($prezzi as $pr){
				$fprice.="<tr><td>".$pr['name'].": </td><td>".$currencysymb." <input type=\"text\" name=\"hprice".$pr['id']."\" value=\"\" size=\"10\"/></td>";
				$fprice.="</tr>\n";
			}
			$fprice.="<tr><td colspan=\"".$colsp."\" align=\"center\"><input type=\"submit\" class=\"vrcsubmithcharges\" name=\"newdispcost\" value=\"".JText::_('VRINSERT')."\"/></td></tr></table></div><input type=\"hidden\" name=\"cid[]\" value=\"".$idcar."\"/><input type=\"hidden\" name=\"task\" value=\"viewhourscharges\"/></form>";
		}
		$chcarsel = "<select name=\"cid[]\" onchange=\"javascript: document.vrcchcar.submit();\">\n";
		foreach($allc as $cc) {
			$chcarsel .= "<option value=\"".$cc['id']."\"".($cc['id'] == $idcar ? " selected=\"selected\"" : "").">".$cc['name']."</option>\n";
		}
		$chcarsel .= "</select>\n";
		$chcarf = "<form name=\"vrcchcar\" method=\"post\" action=\"index.php?option=com_vikrentcar\"><input type=\"hidden\" name=\"task\" value=\"viewhourscharges\"/>".JText::_('VRCSELVEHICLE').": ".$chcarsel."</form>";
		echo "<table><tr><td colspan=\"2\" valign=\"top\" align=\"left\"><div class=\"vrcadminfaresctitle\">".$name." - ".JText::_('VRINSERTFEE')." <span style=\"float: right; text-transform: none;\">".$chcarf."</span></div></td></tr><tr><td valign=\"top\" align=\"left\">".$img."</td><td valign=\"top\" align=\"left\">".$fprice."</td></tr></table><br/>\n";	
	}
	
	public static function printHeaderBusy ($car) {
		if (file_exists('./components/com_vikrentcar/resources/'.$car['img']) && getimagesize('./components/com_vikrentcar/resources/'.$car['img'])) {
			$img='<img align="middle" class="maxninety" alt="Car Image" src="' . JURI::root() . 'administrator/components/com_vikrentcar/resources/'.$car['img'].'" />';
		}else {
			$img='<img align="middle" alt="vikrentcar logo" src="' . JURI::root() . 'administrator/components/com_vikrentcar/vikrentcar.jpg' . '" />';
		}
		echo "<table><tr><td><div class=\"vrcadminfaresctitle\">".$car['name']." ".JText::_('VRMODRES')."</div></td></tr><tr><td valign=\"top\" align=\"left\">".$img."</td></tr></table><br/>\n";
	}
	
	public static function printHeaderCalendar($car, $msg, $allc, $allpayments, $allcustomf, $pickuparr, $dropoffarr) {
		$dbo = JFactory::getDBO();
		if (file_exists('./components/com_vikrentcar/resources/'.$car['img']) && getimagesize('./components/com_vikrentcar/resources/'.$car['img'])) {
			$img='<img align="middle" class="maxninety" alt="Car Image" src="' . JURI::root() . 'administrator/components/com_vikrentcar/resources/'.$car['img'].'" />';
		}else {
			$img='<img align="middle" alt="vikrentcar logo" src="' . JURI::root() . 'administrator/components/com_vikrentcar/vikrentcar.jpg' . '" />';
		}
		JHTML::_('behavior.calendar');
		//VikRentCar 1.7
		?>
		<script language="JavaScript" type="text/javascript">
		function vrcToggleMoreOptions(objel) {
			var moreopt = document.getElementById('vrcquickresmoreoptions');
			if(moreopt.style.display == 'none') {
				moreopt.style.display = 'block';
				objel.innerHTML = '<?php echo addslashes(JText::_('VRCQUICKRESMOREOPTIONSHIDE')); ?>';
			}else {
				moreopt.style.display = 'none';
				objel.innerHTML = '<?php echo addslashes(JText::_('VRCQUICKRESMOREOPTIONS')); ?>';
			}
		}
		function vrcNotifyCustomer(val) {
			if(val == 'confirmed') {
				document.getElementById('notifycustckbx').checked = false;
			}else {
				document.getElementById('notifycustckbx').checked = false;
			}
		}
		</script>
		<?php
		$moreoptions = '<p style="margin: 3px 0 0 0;">'.JText::_('VRCQUICKRESORDSTATUS').': <select name="ordstatus" onchange="javascript: vrcNotifyCustomer(this.value);"><option value="confirmed">'.JText::_('VRCONFIRMED').'</option><option value="standby">'.JText::_('VRSTANDBY').'</option></select><span id="notifycust" style="display: inline-block; margin-left: 5px;">'.JText::_('VRCQUICKRESNOTIFYCUST').' <input type="checkbox" name="notifycust" id="notifycustckbx" value="1"/></span></p>';
		if (@count($pickuparr) > 0) {
			$moreoptions .= '<p style="margin: 3px 0 0 0;">'.JText::_('VRCQUICKRESPICKUPLOC').': <select name="pickuploc"><option value="">'.JText::_('VRCQUICKRESNOLOCATION').'</option>';
			foreach($pickuparr as $pick) {
				$moreoptions .= '<option value="'.$pick['id'].'">'.$pick['name'].'</option>';
			}
			$moreoptions .= '</select></p>';
		}
		if (@count($dropoffarr) > 0) {
			$moreoptions .= '<p style="margin: 3px 0 0 0;">'.JText::_('VRCQUICKRESDROPOFFLOC').': <select name="dropoffloc"><option value="">'.JText::_('VRCQUICKRESNOLOCATION').'</option>';
			foreach($dropoffarr as $drop) {
				$moreoptions .= '<option value="'.$drop['id'].'">'.$drop['name'].'</option>';
			}
			$moreoptions .= '</select></p>';
		}
		if (is_array($allpayments) && @count($allpayments) > 0) {
			$moreoptions .= '<p style="margin: 3px 0 0 0;">'.JText::_('VRCQUICKRESMETHODOFPAYMENT').': <select name="paymentid"><option value="">'.JText::_('VRCQUICKRESNONE').'</option>';
			foreach($allpayments as $pay) {
				$moreoptions .= '<option value="'.$pay['id'].'='.$pay['name'].'">'.$pay['name'].'</option>';
			}
			$moreoptions .= '</select></p>';
		}
		if (is_array($allcustomf) && @count($allcustomf) > 0) {
			$jscustomfstr = '';
			foreach($allcustomf as $custf) {
				$jscustomfstr .= addslashes(JText::_($custf['name'])).': \r\n';
			}
			$jscustomfstr = rtrim($jscustomfstr, '\r\n');
			?>
			<script language="JavaScript" type="text/javascript">
			function vrcPopulateCustomFields() {
				document.getElementById('custdata').value = "<?php echo $jscustomfstr; ?>";
			}
			</script>
			<?php
			$moreoptions .= '<p style="margin: 5px 0 0 0;"><a href="javascript: void(0);" onclick="javascript: vrcPopulateCustomFields();">'.JText::_('VRCQUICKRESPOPULATECUSTOMINFO').'</a></p>';
		}
		//stop sales
		$moreoptions .= '<p class="vrcstopsales"><label for="stop_sales">'.JText::_('VRCSTOPRENTALS').'</label> <input type="checkbox" name="stop_sales" id="stop_sales" value="1"/></p>';
		//
		$fquick="";
		if ($msg=="1") {
			$fquick.="<p class=\"successmade\" style=\"margin-top: 0;\">".JText::_('VRBOOKMADE')."</p>";
		}elseif ($msg=="0") {
			$fquick.="<p class=\"err\" style=\"margin-top: 0;\">".JText::_('VRBOOKNOTMADE')."</p>";
		}
		$fquick.="<form name=\"newb\" method=\"post\" action=\"index.php?option=com_vikrentcar\" onsubmit=\"javascript: if(!document.newb.pickupdate.value.match(/\S/)){alert('".JText::_('VRMSGTHREE')."'); return false;} if(!document.newb.releasedate.value.match(/\S/)){alert('".JText::_('VRMSGFOUR')."'); return false;} return true;\">";
		$timeopst=vikrentcar::getTimeOpenStore(true);
		if (is_array($timeopst) && $timeopst[0]!=$timeopst[1]) {
			$opent=vikrentcar::getHoursMinutes($timeopst[0]);
			$closet=vikrentcar::getHoursMinutes($timeopst[1]);
			$i=$opent[0];
			$j=$closet[0];
		}else {
			$i=0;
			$j=23;
		}
		while ($i <= $j) {
			if ($i < 10) {
				$i="0".$i;
			}else {
				$i=$i;
			}
			$hours.="<option value=\"".$i."\">".$i."</option>\n";
			$i++;
		}
		for($i=0; $i < 60; $i++){
			if ($i < 10) {
				$i="0".$i;
			}else {
				$i=$i;
			}
			$minutes.="<option value=\"".$i."\">".$i."</option>\n";
		}
		$currencysymb = vikrentcar::getCurrencySymb();
		$wiva = "";
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\" data-aliqid=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']." - ".$iv['aliq']."%")."</option>\n";
			}
		}

		$fquick.="<table><tr><td><strong>".JText::_('VRDATEPICKUP').":</strong> </td><td>".JHTML::_('calendar', '', 'pickupdate', 'pickupdate', vikrentcar::getDateFormat(true), array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true'))." ".JText::_('VRAT')." <select name=\"pickuph\">".$hours."</select> : <select name=\"pickupm\">".$minutes."</select></td></tr>\n";
		$fquick.="<tr><td><strong>".JText::_('VRDATERELEASE').":</strong> </td><td>".JHTML::_('calendar', '', 'releasedate', 'releasedate', vikrentcar::getDateFormat(true), array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true'))." ".JText::_('VRAT')." <select name=\"releaseh\">".$hours."</select> : <select name=\"releasem\">".$minutes."</select></td></tr>";
		$fquick.="<tr><td><strong>".JText::_('VRCRENTCUSTRATEPLANADD').":</strong> </td><td>".$currencysymb." <input name=\"cust_cost\" id=\"cust_cost\" value=\"\" placeholder=\"0.00\" size=\"4\" onfocus=\"document.getElementById('taxid').style.display = 'inline-block';\" type=\"text\" style=\"margin: 0 5px 0 0;\"><select name=\"taxid\" id=\"taxid\" style=\"display: none; margin: 0;\"><option value=\"\">".JText::_('VRNEWOPTFOUR')."</option>".$wiva."</select></td></tr>";
		$fquick.="<tr><td colspan=\"2\"><strong>".JText::_('VRQRCUSTMAIL').":</strong> <input type=\"text\" name=\"custmail\" value=\"\" size=\"30\"/></td></tr>\n";
		$fquick.="<tr><td colspan=\"2\"><strong>".JText::_('VRCUSTINFO').":</strong><br/><textarea name=\"custdata\" id=\"custdata\" rows=\"5\" cols=\"50\"></textarea></td></tr>\n";
		$fquick.="<tr><td colspan=\"2\"><a href=\"javascript: void(0);\" onclick=\"javascript: vrcToggleMoreOptions(this);\">".JText::_('VRCQUICKRESMOREOPTIONS')."</a><div id=\"vrcquickresmoreoptions\" style=\"display: none;\">".$moreoptions."</div><div style=\"text-align: right;\"><input type=\"submit\" name=\"quickb\" class=\"btn btn-primary\" value=\"".JText::_('VRMAKERESERV')."\"/></div></td></tr>\n";
		$fquick.="</table><input type=\"hidden\" name=\"task\" value=\"calendar\"/><input type=\"hidden\" name=\"cid[]\" value=\"".$car['id']."\"/></form>";
		//vikrentcar 1.6
		$chcarsel = "<select name=\"cid[]\" onchange=\"javascript: document.vrcchcar.submit();\">\n";
		foreach($allc as $cc) {
			$chcarsel .= "<option value=\"".$cc['id']."\"".($cc['id'] == $car['id'] ? " selected=\"selected\"" : "").">".$cc['name']."</option>\n";
		}
		$chcarsel .= "</select>\n";
		$chcarf = "<form name=\"vrcchcar\" method=\"post\" action=\"index.php?option=com_vikrentcar\"><input type=\"hidden\" name=\"task\" value=\"calendar\"/>".JText::_('VRCSELVEHICLE').": ".$chcarsel."</form>";
		//
		echo "<table><tr><td colspan=\"2\" valign=\"top\" align=\"left\"><div class=\"vrcadminfaresctitle\">".$car['name'].", ".JText::_('VRQUICKBOOK')." <span style=\"float: right; text-transform: none;\">".$chcarf."</span></div></td></tr><tr><td valign=\"top\" align=\"left\">".$img."</td><td valign=\"top\" align=\"left\">".$fquick."</td></tr></table><br/>\n";		
	}
	
	public static function pShowOverview ($rows, $arrbusy, $wmonthsel, $tsstart, $option, $lim0, $navbut, $all_locations="", $plocation="", $plocationw="") {
		$nowtf = vikrentcar::getTimeFormat(true);
		if(is_array($all_locations)) {
			$loc_options = '<option value="">'.JText::_('VRCORDERSLOCFILTERANY').'</option>'."\n";
			foreach ($all_locations as $location) {
				$loc_options .= '<option value="'.$location['id'].'"'.($location['id'] == $plocation ? ' selected="selected"' : '').'>'.$location['name'].'</option>'."\n";
			}
			?>
			<form action="index.php?option=com_vikrentcar&amp;task=overview" method="post">
				<p class="vrc-par-right" style="float: right;"><label for="locfilter"><?php echo JText::_('VRCORDERSLOCFILTER'); ?></label> <select name="location" id="locfilter"><?php echo $loc_options; ?></select> <select name="locationw" id="locwfilter"><option value="pickup"><?php echo JText::_('VRCORDERSLOCFILTERPICK'); ?></option><option value="dropoff"<?php echo $plocationw == 'dropoff' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCORDERSLOCFILTERDROP'); ?></option><option value="both"<?php echo $plocationw == 'both' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCORDERSLOCFILTERPICKDROP'); ?></option></select> <input type="submit" value="<?php echo JText::_('VRCORDERSLOCFILTERBTN'); ?>"/></p>
				<input type="hidden" name="month" value="<?php echo $tsstart; ?>"/>
			</form>
			<?php
		}
		$nowts=getdate($tsstart);
		?>
		<form action="index.php?option=com_vikrentcar&amp;task=overview" method="post" name="vroverview">
		<?php echo $wmonthsel; ?>
		</form>
		<br/>
		<table class="vrcoverviewtable">
		<tr class="vrcoverviewtablerow">
		<td class="bluedays vrcoverviewtdone"><strong><?php echo vikrentcar::sayMonth($nowts['mon'])." ".$nowts['year']; ?></strong></td>
		<?php
		$mon=$nowts['mon'];
		while ($nowts['mon']==$mon) {
			echo '<td align="center" class="bluedays">'.$nowts['mday'].'</td>';
			$next=$nowts['mday'] + 1;
			$dayts=mktime(0, 0, 0, ($nowts['mon'] < 10 ? "0".$nowts['mon'] : $nowts['mon']), ($next < 10 ? "0".$next : $next), $nowts['year']);
			$nowts=getdate($dayts);
		}
		?>
		</tr>
		<?php
		foreach($rows as $car) {
			$nowts=getdate($tsstart);
			$mon=$nowts['mon'];
			echo '<tr class="vrcoverviewtablerow">';
			echo '<td class="carname"><strong>'.$car['name'].'</strong> ('.$car['units'].')</td>';
			while ($nowts['mon']==$mon) {
				$dclass="notbusy";
				$dalt="";
				$bid="";
				$totfound=0;
				if(@is_array($arrbusy[$car['id']])) {
					foreach($arrbusy[$car['id']] as $b){
						$tmpone=getdate($b['ritiro']);
						$rit=($tmpone['mon'] < 10 ? "0".$tmpone['mon'] : $tmpone['mon'])."/".($tmpone['mday'] < 10 ? "0".$tmpone['mday'] : $tmpone['mday'])."/".$tmpone['year'];
						$ritts=strtotime($rit);
						$tmptwo=getdate($b['consegna']);
						$con=($tmptwo['mon'] < 10 ? "0".$tmptwo['mon'] : $tmptwo['mon'])."/".($tmptwo['mday'] < 10 ? "0".$tmptwo['mday'] : $tmptwo['mday'])."/".$tmptwo['year'];
						$conts=strtotime($con);
						if ($nowts[0]>=$ritts && $nowts[0]<=$conts) {
							$dclass="busy";
							$bid=$b['idorder'];
							if ($nowts[0]==$ritts) {
								$dalt=JText::_('VRPICKUPAT')." ".date($nowtf, $b['ritiro']);
							}elseif ($nowts[0]==$conts) {
								$dalt=JText::_('VRRELEASEAT')." ".date($nowtf, $b['consegna']);
							}
							$totfound++;
						}
					}
				}
				$useday=($nowts['mday'] < 10 ? "0".$nowts['mday'] : $nowts['mday']);
				if($totfound == 1) {
					$dlnk="<a href=\"index.php?option=com_vikrentcar&task=editbusy&return=order&cid[]=".$bid."\" style=\"color: #ffffff;\">".$totfound."</a>";
					$cal="<td align=\"center\" class=\"".$dclass."\"".(!empty($dalt) ? " title=\"".$dalt."\"" : "").">".$dlnk."</td>\n";
				}elseif($totfound > 1) {
					$dlnk="<a href=\"index.php?option=com_vikrentcar&task=choosebusy&idcar=".$car['id']."&ts=".$nowts[0]."\" style=\"color: #ffffff;\">".$totfound."</a>";
					$cal="<td align=\"center\" class=\"".$dclass."\">".$dlnk."</td>\n";
				}else {
					$dlnk=$useday;
					$cal="<td align=\"center\" class=\"".$dclass."\">&nbsp;</td>\n";
				}
				echo $cal;
				$next=$nowts['mday'] + 1;
				$dayts=mktime(0, 0, 0, ($nowts['mon'] < 10 ? "0".$nowts['mon'] : $nowts['mon']), ($next < 10 ? "0".$next : $next), $nowts['year']);
				$nowts=getdate($dayts);
			}
			echo '</tr>';
		}
		?>
		</table>
		<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="overview" />
		<input type="hidden" name="month" value="<?php echo $tsstart; ?>" />
		<?php echo '<br/>'.$navbut; ?>
		</form>
		<?php
	}
	
	public static function pViewCalendar ($car, $busy, $vmode, $option) {
		$check=false;
		$nowtf = vikrentcar::getTimeFormat(true);
		if(empty($busy)){
			echo "<p class=\"warn\">".JText::_('VRNOFUTURERES')."</p>";
		}else {
			$check=true;
			$icalurl = JURI::root().'index.php?option=com_vikrentcar&task=ical&car='.$car['id'].'&key='.vikrentcar::getIcalSecretKey();
			?>
			<p><span class="label"><b><?php echo JText::_('VRVIEW'); ?></b>:</span> <a href="index.php?option=com_vikrentcar&amp;task=calendar&amp;cid[]=<?php echo $car['id']; ?>&amp;vmode=3"><?php echo JText::_('VRTHREEMONTHS'); ?></a> - 
			<a href="index.php?option=com_vikrentcar&amp;task=calendar&amp;cid[]=<?php echo $car['id']; ?>&amp;vmode=6"><?php echo JText::_('VRSIXMONTHS'); ?></a> - 
			<a href="index.php?option=com_vikrentcar&amp;task=calendar&amp;cid[]=<?php echo $car['id']; ?>&amp;vmode=12"><?php echo JText::_('VRTWELVEMONTHS'); ?></a>
			&nbsp;&nbsp;&nbsp;<button type="button" class="btn" onclick="jQuery('#icalsynclinkinp').attr('size', (jQuery('#icalsynclinkinp').val().length + 5)).fadeToggle().focus();"><i class="icon-link"></i> <?php echo JText::_('VRCICALLINK'); ?></button> <input id="icalsynclinkinp" style="display: none;" type="text" value="<?php echo $icalurl; ?>" readonly="readonly" size="40" onfocus="jQuery('#icalsynclinkinp').select();"/>
			</p>
			<?php
		}
		?>
		<table><tr>
		<?php
		$arr=getdate();
		$mon=$arr['mon'];
		$realmon=($mon < 10 ? "0".$mon : $mon);
		$year=$arr['year'];
		$day=$realmon."/01/".$year;
		$dayts=strtotime($day);
		$newarr=getdate($dayts);

		$firstwday = (int)vikrentcar::getFirstWeekDay(true);
		$days_labels = array(
			JText::_('VRSUN'),
			JText::_('VRMON'),
			JText::_('VRTUE'),
			JText::_('VRWED'),
			JText::_('VRTHU'),
			JText::_('VRFRI'),
			JText::_('VRSAT')
		);
		$days_indexes = array();
		for( $i = 0; $i < 7; $i++ ) {
			$days_indexes[$i] = (6-($firstwday-$i)+1)%7;
		}

		for($jj=1; $jj<=$vmode; $jj++){
			$d_count = 0;
			echo "<td valign=\"top\">";
			$cal="";
			?>
			<table class="vrcadmincaltable">
			<tr class="vrcadmincaltrmon"><td colspan="7" align="center"><?php echo vikrentcar::sayMonth($newarr['mon'])." ".$newarr['year']; ?></td></tr>
			<tr class="vrcadmincaltrmdays">
			<?php
			for($i = 0; $i < 7; $i++) {
				$d_ind = ($i + $firstwday) < 7 ? ($i + $firstwday) : ($i + $firstwday - 7);
				echo '<td>'.$days_labels[$d_ind].'</td>';
			}
			?>
			</tr>
			<tr>
			<?php
			for($i=0, $n = $days_indexes[$newarr['wday']]; $i < $n; $i++, $d_count++) {
				$cal.="<td align=\"center\">&nbsp;</td>";
			}
			while ($newarr['mon']==$mon) {
				if($d_count > 6) {
					$d_count = 0;
					$cal.="</tr>\n<tr>";
				}
				$dclass="free";
				$dalt="";
				$bid="";
				if ($check) {
					$totfound=0;
					foreach($busy as $b){
						$tmpone=getdate($b['ritiro']);
						$rit=($tmpone['mon'] < 10 ? "0".$tmpone['mon'] : $tmpone['mon'])."/".($tmpone['mday'] < 10 ? "0".$tmpone['mday'] : $tmpone['mday'])."/".$tmpone['year'];
						$ritts=strtotime($rit);
						$tmptwo=getdate($b['consegna']);
						$con=($tmptwo['mon'] < 10 ? "0".$tmptwo['mon'] : $tmptwo['mon'])."/".($tmptwo['mday'] < 10 ? "0".$tmptwo['mday'] : $tmptwo['mday'])."/".$tmptwo['year'];
						$conts=strtotime($con);
						if ($newarr[0]>=$ritts && $newarr[0]<=$conts) {
							$dclass="busy";
							$bid=$b['idorder'];
							if ($newarr[0]==$ritts) {
								$dalt=JText::_('VRPICKUPAT')." ".date($nowtf, $b['ritiro']);
							}elseif ($newarr[0]==$conts) {
								$dalt=JText::_('VRRELEASEAT')." ".date($nowtf, $b['consegna']);
							}
							$totfound++;
//							break;
						}
					}
				}
				$useday=($newarr['mday'] < 10 ? "0".$newarr['mday'] : $newarr['mday']);
				if($totfound == 1) {
					$dlnk="<a href=\"index.php?option=com_vikrentcar&task=editbusy&cid[]=".$bid."\">".$useday."</a>";
					$cal.="<td align=\"center\" class=\"".$dclass."\"".(!empty($dalt) ? " title=\"".$dalt."\"" : "").">".$dlnk."</td>\n";
				}elseif($totfound > 1) {
					$dlnk="<a href=\"index.php?option=com_vikrentcar&task=choosebusy&idcar=".$car['id']."&ts=".$newarr[0]."\">".$useday."</a>";
					$cal.="<td align=\"center\" class=\"".$dclass."\">".$dlnk."</td>\n";
				}else {
					$dlnk=$useday;
					$cal.="<td align=\"center\" class=\"".$dclass."\">".$dlnk."</td>\n";
				}
				$next=$newarr['mday'] + 1;
				$dayts=mktime(0, 0, 0, ($newarr['mon'] < 10 ? "0".$newarr['mon'] : $newarr['mon']), ($next < 10 ? "0".$next : $next), $newarr['year']);
				$newarr=getdate($dayts);
				$d_count++;
			}
			
			for($i=$d_count; $i <= 6; $i++){
				$cal.="<td align=\"center\">&nbsp;</td>";
			}
			
			echo $cal;
			?>
			</tr>
			</table>
			<?php
			echo "</td>";
			if ($mon==12) {
				$mon=1;
				$year+=1;
				$dayts=mktime(0, 0, 0, ($mon < 10 ? "0".$mon : $mon), 01, $year);
			}else {
				$mon+=1;
				$dayts=mktime(0, 0, 0, ($mon < 10 ? "0".$mon : $mon), 01, $year);
			}
			$newarr=getdate($dayts);
			
			if (($jj % 4)==0 && $vmode > 4) {
				echo "</tr>\n<tr>";
			}
		}
		
		?>
		</tr></table>
		<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		</form>
		<?php
		
	}
	
	public static function pViewCar ($rows, $option, $lim0="0", $navbut="", $orderby="", $ordersort="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOCARSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removecar') {
				if (confirm('<?php echo JText::_('VRJSDELCAR'); ?>?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>
	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title center" align="center" width="30"><a href="index.php?option=com_vikrentcar&amp;task=cars&amp;vrcorderby=id&amp;vrcordersort=<?php echo ($orderby == "id" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "id" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "id" ? "vrcsortdesc" : "")); ?>">ID</a></th>
			<th class="title left" width="150"><a href="index.php?option=com_vikrentcar&amp;task=cars&amp;vrcorderby=name&amp;vrcordersort=<?php echo ($orderby == "name" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "name" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "name" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWCARONE' ); ?></a></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCARTWO' ); ?></th>
			<th class="title center" align="center" width="150"><?php echo JText::_( 'VRPVIEWCARTHREE' ); ?></th>
			<th class="title center" align="center" width="150"><?php echo JText::_( 'VRPVIEWCARFOUR' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCARFIVE' ); ?></th>
			<th class="title center" align="center" width="100"><a href="index.php?option=com_vikrentcar&amp;task=cars&amp;vrcorderby=units&amp;vrcordersort=<?php echo ($orderby == "units" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "units" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "units" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWCARSEVEN' ); ?></a></th>
			<th class="title center" align="center" width="100"><?php echo JText::_( 'VRPVIEWCARSIX' ); ?></th>
		</tr>
		</thead>
		<?php

		$kk = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$dbo = JFactory::getDBO();
			$q="SELECT COUNT(*) AS `totdisp` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$row['id']."' ORDER BY `#__vikrentcar_dispcost`.`days`;";
			$dbo->setQuery($q);
			$dbo->execute();
			$lines = $dbo->loadAssocList();
			$tot=$lines[0]['totdisp'];
			if (!empty($row['idcat'])) {
				$validcats = false;
				$categories = "";
				$cat=explode(";", $row['idcat']);
				$q="SELECT `name` FROM `#__vikrentcar_categories` WHERE ";
				foreach($cat as $k=>$cc){
					if (!empty($cc)) {
						$validcats = true;
						$q.="`id`=".$dbo->quote($cc)." ";
						if ($cc!=end($cat) && !empty($cat[($k + 1)])) {
							$q.="OR ";
						}
					}
				}
				$q.=";";
				if($validcats) {
					$dbo->setQuery($q);
					$dbo->execute();
					$lines = $dbo->loadAssocList();
					if (is_array($lines)) {
						$categories = array();
						foreach($lines as $ll){
							$categories[]=$ll['name'];
						}
						$categories = implode(", ", $categories);
					}else {
						$categories="";
					}
				}else {
					$categories="";
				}
			}else {
				$categories="";
			}
			
			if (!empty($row['idcarat'])) {
				$tmpcarat=explode(";", $row['idcarat']);
				$caratteristiche=totElements($tmpcarat);
			}else {
				$caratteristiche="";
			}
			
			if (!empty($row['idopt'])) {
				$tmpopt=explode(";", $row['idopt']);
				$optionals=totElements($tmpopt);
			}else {
				$optionals="";
			}
			
			if (!empty($row['idplace'])) {
				$explace=explode(";", $row['idplace']);
				$q="SELECT `id`,`name` FROM `#__vikrentcar_places` WHERE `id`=".$dbo->quote($explace[0]).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$lines = $dbo->loadAssocList();
				$luogo=$lines[0]['name'];
				if(@count($explace)>2){
					$luogo.=" ...";
				}
			}else {
				$luogo="";
			}
			
			?>
			<tr class="row<?php echo $kk; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td class="center"><?php echo $row['id']; ?></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=calendar&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
				<td><?php echo $categories; ?></td>
				<td class="center"><?php echo $caratteristiche; ?></td>
				<td class="center"><?php echo $optionals; ?></td>
				<td><?php echo $luogo; ?></td>
				<td class="center"><?php echo $row['units']; ?></td>
                <td class="center"><a href="index.php?option=com_vikrentcar&amp;task=modavail&amp;cid[]=<?php echo $row['id']; ?>"><?php echo (intval($row['avail'])=="1" ? "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/ok.png"."\" border=\"0\" title=\"".JText::_('VRMAKENOTAVAIL')."\"/>" : "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/no.png"."\" border=\"0\" title=\"".JText::_('VRMAKENOTAVAIL')."\"/>"); ?></a></td>
			</tr>
              <?php
            $kk = 1 - $kk;
            unset($categories);
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="cars" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewStats ($rows, $option, $lim0="0", $navbut="") {
		$nowtf = vikrentcar::getTimeFormat(true);
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOSTATSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSTWO' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSTHREE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSFOUR' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSFIVE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSSIX' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWSTATSSEVEN' ); ?></th>
		</tr>
		</thead>
		<?php
		$nowdf = vikrentcar::getDateFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$kk = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			if(!empty($row['place'])) {
				$exp=explode(";", $row['place']);
				$place=vikrentcar::getPlaceName($exp[0]).(!empty($exp[1]) && $exp[0]!=$exp[1] ? " - ".vikrentcar::getPlaceName($exp[1]) : "");
			}else {
				$place="";
			}
			$cat=JText::_('VRANYTHING');
			if (!empty($row['cat'])) {
				$cat=($row['cat']=="all" ? JText::_('VRANYTHING') : vikrentcar::getCategoryName($row['cat']));
			}
			?>
			<tr class="row<?php echo $kk; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><?php echo date($df.' '.$nowtf, $row['ts']); ?></td>
				<td><?php echo $row['ip']; ?></td>
				<td><?php echo date($df.' '.$nowtf, $row['ritiro']); ?></td>
				<td><?php echo date($df.' '.$nowtf, $row['consegna']); ?></td>
                <td><?php echo $place; ?></td>
                <td><?php echo $cat; ?></td>
                <td><?php echo intval($row['res']); ?></td>
			</tr>
              <?php
            $kk = 1 - $kk;	
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewstats" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewOrders ($rows, $option, $lim0="0", $navbut="", $all_locations="", $plocation="", $plocationw="", $orderby="ts", $ordersort="DESC") {
		JHTML::_('behavior.tooltip');
		$nowtf = vikrentcar::getTimeFormat(true);
		$filtnc = VikRequest::getString('filtnc', '', 'request');
		$cid = VikRequest::getVar('cid', array(0));
		if(is_array($all_locations)) {
			$loc_options = '<option value="">'.JText::_('VRCORDERSLOCFILTERANY').'</option>'."\n";
			foreach ($all_locations as $location) {
				$loc_options .= '<option value="'.$location['id'].'"'.($location['id'] == $plocation ? ' selected="selected"' : '').'>'.$location['name'].'</option>'."\n";
			}
			?>
			<div class="btn-toolbar" id="filter-bar">
				<form action="index.php?option=com_vikrentcar&amp;task=vieworders" id="filtnc-form" method="post">
					<input type="hidden" name="task" value="vieworders"/>
					<div class="btn-group pull-left">
						<input type="text" size="35" id="filtnc" name="filtnc" value="<?php echo $filtnc; ?>" placeholder="<?php echo JText::_('VRCFILTCNAMECNUMB'); ?>"/>
					</div>
					<div class="btn-group pull-left">
						<button class="btn" type="submit"><i class="icon-search"></i></button>
						<button class="btn" type="button" onclick="jQuery('#filtnc').val('');jQuery('#filtnc-form').submit();"><i class="icon-remove"></i></button>
					</div>
				</form>
				<form action="index.php?option=com_vikrentcar&amp;task=vieworders" method="post">
					<input type="hidden" name="task" value="vieworders"/>
					<div class="btn-group pull-right">
						<button class="btn" type="submit"><?php echo JText::_('VRCORDERSLOCFILTERBTN'); ?></button>
					</div>
					<div class="btn-group pull-right">
						<select name="locationw" id="locwfilter"><option value="pickup"><?php echo JText::_('VRCORDERSLOCFILTERPICK'); ?></option><option value="dropoff"<?php echo $plocationw == 'dropoff' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCORDERSLOCFILTERDROP'); ?></option><option value="both"<?php echo $plocationw == 'both' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCORDERSLOCFILTERPICKDROP'); ?></option></select>
					</div>
					<div class="btn-group pull-right">
						<select name="location" id="locfilter"><?php echo $loc_options; ?></select>
					</div>
				</form>
			</div>
			<br clear="both" />
			<?php
		}
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOORDERSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
   <script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removeorders') {
				if (confirm('<?php echo JText::_('VRJSDELORDER'); ?>?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>
	
	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title center" width="20" align="center">ID</th>
			<th class="title left" width="110"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=ts&amp;vrcordersort=<?php echo ($orderby == "ts" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "ts" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "ts" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSONE' ); ?></a></th>
			<th class="title left" width="200"><?php echo JText::_( 'VRPVIEWORDERSTWO' ); ?></th>
			<th class="title left" width="150"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=carname&amp;vrcordersort=<?php echo ($orderby == "carname" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "carname" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "carname" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSTHREE' ); ?></a></th>
			<th class="title left" width="110"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=pickupts&amp;vrcordersort=<?php echo ($orderby == "pickupts" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "pickupts" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "pickupts" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSFOUR' ); ?></a></th>
			<th class="title left" width="110"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=dropoffts&amp;vrcordersort=<?php echo ($orderby == "dropoffts" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "dropoffts" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "dropoffts" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSFIVE' ); ?></a></th>
			<th class="title center" width="70" align="center"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=days&amp;vrcordersort=<?php echo ($orderby == "days" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "days" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "days" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSSIX' ); ?></a></th>
			<th class="title center" width="110" align="center"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=total&amp;vrcordersort=<?php echo ($orderby == "total" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "total" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "total" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSSEVEN' ); ?></a></th>
			<th class="title center" width="30"> </th>
			<th class="title center" width="100" align="center"><a href="index.php?option=com_vikrentcar&amp;task=vieworders&amp;vrcorderby=status&amp;vrcordersort=<?php echo ($orderby == "status" && $ordersort == "ASC" ? "DESC" : "ASC"); ?>" class="<?php echo ($orderby == "status" && $ordersort == "ASC" ? "vrcsortasc" : ($orderby == "status" ? "vrcsortdesc" : "")); ?>"><?php echo JText::_( 'VRPVIEWORDERSEIGHT' ); ?></a></th>
		</tr>
		</thead>
		<?php
		$nowdf = vikrentcar::getDateFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$dbo = JFactory::getDBO();
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$kk = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$car = vikrentcar::getCarInfo($row['idcar']);
			$is_cust_cost = (!empty($row['cust_cost']) && $row['cust_cost'] > 0);
			$isdue = 0;
			if (!empty($row['idtar'])) {
				if($row['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$row['idtar']."';";
				}else {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
				}
				$dbo->setQuery($q);
				$dbo->execute();
				if($dbo->getNumRows() == 0) {
					//there are no hourly prices
					if($row['hourly'] == 1) {
						$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() == 1) {
							$price = $dbo->loadAssocList();
						}
					}
					//
				}else {
					$price = $dbo->loadAssocList();
				}
			}elseif ($is_cust_cost) {
				//Custom Rate
				$price = array(0 => array(
					'id' => -1,
					'idcar' => $row['idcar'],
					'days' => $row['days'],
					'idprice' => -1,
					'cost' => $row['cust_cost'],
					'attrdata' => '',
				));
			}
			if($row['hourly'] == 1) {
				foreach($price as $kt => $vt) {
					$price[$kt]['days'] = 1;
				}
			}
			//vikrentcar 1.6
			$checkhourscharges = 0;
			$hoursdiff = 0;
			$ppickup = $row['ritiro'];
			$prelease = $row['consegna'];
			$secdiff = $prelease - $ppickup;
			$daysdiff = $secdiff / 86400;
			if (is_int($daysdiff)) {
				if ($daysdiff < 1) {
					$daysdiff = 1;
				}
			}else {
				if ($daysdiff < 1) {
					$daysdiff = 1;
					$checkhourly = true;
					$ophours = $secdiff / 3600;
					$hoursdiff = intval(round($ophours));
					if($hoursdiff < 1) {
						$hoursdiff = 1;
					}
				}else {
					$sum = floor($daysdiff) * 86400;
					$newdiff = $secdiff - $sum;
					$maxhmore = vikrentcar::getHoursMoreRb() * 3600;
					if ($maxhmore >= $newdiff) {
						$daysdiff = floor($daysdiff);
					}else {
						$daysdiff = ceil($daysdiff);
						//vikrentcar 1.6
						$ehours = intval(round(($newdiff - $maxhmore) / 3600));
						$checkhourscharges = $ehours;
						if($checkhourscharges > 0) {
							$aehourschbasp = vikrentcar::applyExtraHoursChargesBasp();
						}
						//
					}
				}
			}
			if($checkhourscharges > 0 && $aehourschbasp == true && !$is_cust_cost) {
				$ret = vikrentcar::applyExtraHoursChargesCar($price, $row['idcar'], $checkhourscharges, $daysdiff, false, true, true);
				$price = $ret['return'];
				$calcdays = $ret['days'];
			}
			if($checkhourscharges > 0 && $aehourschbasp == false && !$is_cust_cost) {
				$price = vikrentcar::extraHoursSetPreviousFareCar($price, $row['idcar'], $checkhourscharges, $daysdiff, true);
				$price=vikrentcar::applySeasonsCar($price, $row['ritiro'], $row['consegna'], $row['idplace']);
				$ret = vikrentcar::applyExtraHoursChargesCar($price, $row['idcar'], $checkhourscharges, $daysdiff, true, true, true);
				$price = $ret['return'];
				$calcdays = $ret['days'];
			}else {
				if(!$is_cust_cost) {
					//Seasonal prices only if not a custom rate
					$price=vikrentcar::applySeasonsCar($price, $row['ritiro'], $row['consegna'], $row['idplace']);
				}
			}
			//
			$isdue += $is_cust_cost ? $price[0]['cost'] : vikrentcar::sayCostPlusIva($price[0]['cost'], $price[0]['idprice'], $row);
			if (!empty($row['optionals'])) {
				$stepo=explode(";", $row['optionals']);
				foreach($stepo as $oo){
					if (!empty($oo)) {
						$stept=explode(":", $oo);
						$q="SELECT * FROM `#__vikrentcar_optionals` WHERE `id`='".$stept[0]."';";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() == 1) {
							$popts = $dbo->loadAssocList();
							$realcost=(intval($popts[0]['perday'])==1 ? ($popts[0]['cost'] * $row['days'] * $stept[1]) : ($popts[0]['cost'] * $stept[1]));
							if($popts[0]['maxprice'] > 0 && $realcost > $popts[0]['maxprice']) {
								$realcost=$popts[0]['maxprice'];
								if(intval($popts[0]['hmany']) == 1 && intval($stept[1]) > 1) {
									$realcost = $popts[0]['maxprice'] * $stept[1];
								}
							}
							$isdue+=vikrentcar::sayOptionalsPlusIva($realcost, $popts[0]['idiva'], $row);
						}
					}
				}
			}
			//custom extra costs
			if(!empty($row['extracosts'])) {
				$cur_extra_costs = json_decode($row['extracosts'], true);
				foreach ($cur_extra_costs as $eck => $ecv) {
					$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $row);
					$isdue += $efee_cost;
				}
			}
			//
			if(!empty($row['idplace']) && !empty($row['idreturnplace'])) {
				$locfee=vikrentcar::getLocFee($row['idplace'], $row['idreturnplace']);
				if($locfee) {
					//VikRentCar 1.7 - Location fees overrides
					if (strlen($locfee['losoverride']) > 0) {
						$arrvaloverrides = array();
						$valovrparts = explode('_', $locfee['losoverride']);
						foreach($valovrparts as $valovr) {
							if (!empty($valovr)) {
								$ovrinfo = explode(':', $valovr);
								$arrvaloverrides[$ovrinfo[0]] = $ovrinfo[1];
							}
						}
						if (array_key_exists($row['days'], $arrvaloverrides)) {
							$locfee['cost'] = $arrvaloverrides[$row['days']];
						}
					}
					//end VikRentCar 1.7 - Location fees overrides
					$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $row['days']) : $locfee['cost'];
					$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $row);
					$isdue+=$locfeewith;
				}
			}
			//VRC 1.9 - Out of Hours Fees
			$oohfee = vikrentcar::getOutOfHoursFees($row['idplace'], $row['idreturnplace'], $row['ritiro'], $row['consegna'], array('id' => $row['idcar']));
			if(count($oohfee) > 0) {
				$oohfeewith=vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
				$isdue+=$oohfeewith;
			}
			//
			//vikrentcar 1.6 coupon
			$usedcoupon = false;
			$origisdue = $isdue;
			if(strlen($row['coupon']) > 0) {
				$usedcoupon = true;
				$expcoupon = explode(";", $row['coupon']);
				$isdue = $isdue - $expcoupon[1];
			}
			//
			$custdata = !empty($row['custdata']) ? substr($row['custdata'], 0, 45)." ..." : "";
			if(!empty($row['nominative'])) {
				$custdata = $row['nominative'];
				if(!empty($row['country'])) {
					if(file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'countries'.DS.$row['country'].'.png')) {
						$custdata .= '<img src="'.JURI::root().'administrator/components/com_vikrentcar/resources/countries/'.$row['country'].'.png'.'" title="'.$row['country'].'" class="vrc-country-flag vrc-country-flag-left"/>';
					}
				}
			}
			$status_lbl = '';
			if($row['status'] == 'confirmed') {
				$status_lbl = "<span class=\"label label-success\">".JText::_('VRCONFIRMED')."</span>";
			}elseif($row['status'] == 'standby') {
				$status_lbl = "<span class=\"label label-warning\">".JText::_('VRSTANDBY')."</span>";
			}elseif($row['status'] == 'cancelled') {
				$status_lbl = "<span class=\"label label-error\" style=\"background-color: #d9534f;\">".JText::_('VRCANCELLED')."</span>";
			}
			$invoice_icon = '';
			if (file_exists(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "helpers" . DS . "invoices" . DS . "generated" . DS . $row['id'].'_'.$row['sid'].'.pdf')) {
				$invoice_icon = '<a class="hasTooltip" title="'.JText::_('VRCDOWNLOADPDFINVOICE').'" href="'.JURI::root().'components/com_vikrentcar/helpers/invoices/generated/'.$row['id'].'_'.$row['sid'].'.pdf" target="_blank"><i class="vrcicn-file-text" style="margin: 0;"></i></a>';
				if(!empty($row['adminnotes'])) {
					$invoice_icon .= ' &nbsp; ';
				}
			}
			?>
			<tr class="row<?php echo $kk; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=editorder&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editorder&amp;cid[]=<?php echo $row['id']; ?>"><span class="label"><?php echo date($df.' '.$nowtf, $row['ts']); ?></span></a></td>
				<td><?php echo $custdata; ?></td>
				<td><span<?php echo $row['stop_sales'] == 1 ? ' class="label vrc-stopsales-sp" title="'.JText::_('VRCSTOPRENTALS').'"' : ''; ?>><?php echo $car['name']; ?></span></td>
				<td><?php echo date($df.' '.$nowtf, $row['ritiro']); ?></td>
				<td><?php echo date($df.' '.$nowtf, $row['consegna']); ?></td>
                <td class="center"><?php echo ($row['hourly'] == 1 && !empty($price[0]['hours']) ? $price[0]['hours'].' '.JText::_('VRCHOURS') : $row['days']); ?></td>
                <td class="center"><span<?php echo $isdue > $row['order_total'] || $isdue < $row['order_total'] ? ' title="'.addslashes(JText::sprintf('VRCTOTALWOULDBE', vikrentcar::numberFormat($isdue))).'" class="hasTooltip"' : ''; ?>><?php echo $currencysymb." ".vikrentcar::numberFormat($row['order_total']).'</span>'.(!empty($row['totpaid']) ? " &nbsp;(".$currencysymb." ".vikrentcar::numberFormat($row['totpaid']).")" : ""); ?></td>
                <td class="center"><?php echo $invoice_icon.(!empty($row['adminnotes']) ? '<span class="hasTooltip" title="'.htmlentities(nl2br($row['adminnotes'])).'"><i class="vrcicn-info" style="margin: 0; color: #3071a9;"></i></span>' : ''); ?></td>
                <td class="center"><?php echo $status_lbl; ?></td>
			</tr>
              <?php
            $kk = 1 - $kk;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(!empty($plocation)) {
			echo '<input type="hidden" name="location" value="'.$plocation.'" />';
			echo '<input type="hidden" name="locationw" value="'.$plocationw.'" />';
		}
		if(!empty($filtnc)) {
			echo '<input type="hidden" name="filtnc" value="'.$filtnc.'" />';
		}
		?>
		<input type="hidden" name="task" value="vieworders" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
			//VRC 1.9 invoices
			if(count($cid) > 0 && !empty($cid[0])) {
				$nextinvnum = vikrentcar::getNextInvoiceNumber();
				$invsuff = vikrentcar::getInvoiceNumberSuffix();
				$companyinfo = vikrentcar::getInvoiceCompanyInfo();
				?>
			<script type="text/javascript">
			jQuery.noConflict();
			jQuery(document).ready(function(){
				jQuery('.vrc-gen-invoice-close').click(function(){
					jQuery('.vrc-gen-invoice-block').hide();
				});
			});
			</script>
			<form action="index.php?option=com_vikrentcar" method="post">
			<div class="vrc-gen-invoice-block">
				<div class="vrc-gen-invoice-close"></div>
				<div class="vrc-gen-invoice-cont">
					<div class="vrc-gen-invoice-finalentry">
						<strong><?php echo JText::sprintf('VRCINVGENERATING', count($cid)); ?></strong>
					</div>
					<br clear="all"/>
					<div class="vrc-gen-invoice-entry">
						<label for="invoice_num"><?php echo JText::_('VRCINVSTARTNUM'); ?></label>
						<span><input type="number" name="invoice_num" id="invoice_num" value="<?php echo $nextinvnum; ?>" size="4" min="1"/></span>
					</div>
					<div class="vrc-gen-invoice-entry">
						<label for="invoice_suff"><?php echo JText::_('VRCINVNUMSUFF'); ?></label>
						<span><input type="text" name="invoice_suff" id="invoice_suff" value="<?php echo $invsuff; ?>" size="4"/></span>
					</div>
					<div class="vrc-gen-invoice-entry">
						<label for="invoice_date"><?php echo JText::_('VRCINVDATE'); ?></label>
						<span><select name="invoice_date" id="invoice_date"><option value="<?php echo date($df); ?>"><?php echo date($df); ?></option><option value="0"><?php echo JText::_('VRCINVDATERES'); ?></option></select></span>
					</div>
					<div class="vrc-gen-invoice-entry">
						<label for="company_info"><?php echo JText::_('VRCINVCOMPANYINFO'); ?></label>
						<span><textarea name="company_info" id="company_info" rows="3" cols="50"><?php echo $companyinfo; ?></textarea></span>
					</div>
					<div class="vrc-gen-invoice-entry">
						<label for="invoice_send"><?php echo JText::_('VRCINVSENDVIAEMAIL'); ?></label>
						<span><input type="checkbox" name="invoice_send" id="invoice_send" value="1"/></span>
					</div>
					<br clear="all"/>
					<div class="vrc-gen-invoice-finalentry">
						<span><input type="submit" value="<?php echo JText::_('VRCGENINVOICE'); ?>"/></span>
					</div>
				</div>
			</div>
			<?php
			foreach ($cid as $invid) {
				echo '<input type="hidden" name="cid[]" value="'.$invid.'" />';
			}
			?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="geninvoices" />
			</form>
			<?php
			}
			//
		}
	}

	//Deprecated and Removed since VRC 1.11
	public static function pViewOldOrders ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOOLDORDERSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="110"><?php echo JText::_( 'VRPVIEWOLDORDERSTSDEL' ); ?></th>
			<th class="title left" width="110"><?php echo JText::_( 'VRPVIEWOLDORDERSONE' ); ?></th>
			<th class="title left" width="200"><?php echo JText::_( 'VRPVIEWOLDORDERSTWO' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWOLDORDERSTHREE' ); ?></th>
			<th class="title left" width="110"><?php echo JText::_( 'VRPVIEWOLDORDERSFOUR' ); ?></th>
			<th class="title left" width="110"><?php echo JText::_( 'VRPVIEWOLDORDERSFIVE' ); ?></th>
			<th class="title center" width="70" align="center"><?php echo JText::_( 'VRPVIEWOLDORDERSSIX' ); ?></th>
			<th class="title center" width="110" align="center"><?php echo JText::_( 'VRPVIEWOLDORDERSSEVEN' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPVIEWOLDORDERSEIGHT' ); ?></th>
		</tr>
		</thead>
		<?php
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$kk = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$car=vikrentcar::getCarInfo($row['idcar']);
			$dbo = JFactory::getDBO();
			$isdue=0;
			if (!empty($row['idtar'])) {
				if ($row['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$row['idtar']."';";
				}else {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
				}
				$dbo->setQuery($q);
				$dbo->execute();
				if ($dbo->getNumRows() == 1) {
					$price = $dbo->loadAssocList();
					if ($row['hourly'] == 1) {
						foreach($price as $kp => $kv) {
							$price[$kp]['days'] = 1;
						}
					}
					//vikrentcar 1.6
					$checkhourscharges = 0;
					$hoursdiff = 0;
					$ppickup = $row['ritiro'];
					$prelease = $row['consegna'];
					$secdiff = $prelease - $ppickup;
					$daysdiff = $secdiff / 86400;
					if (is_int($daysdiff)) {
						if ($daysdiff < 1) {
							$daysdiff = 1;
						}
					}else {
						if ($daysdiff < 1) {
							$daysdiff = 1;
							$checkhourly = true;
							$ophours = $secdiff / 3600;
							$hoursdiff = intval(round($ophours));
							if($hoursdiff < 1) {
								$hoursdiff = 1;
							}
						}else {
							$sum = floor($daysdiff) * 86400;
							$newdiff = $secdiff - $sum;
							$maxhmore = vikrentcar::getHoursMoreRb() * 3600;
							if ($maxhmore >= $newdiff) {
								$daysdiff = floor($daysdiff);
							}else {
								$daysdiff = ceil($daysdiff);
								//vikrentcar 1.6
								$ehours = intval(round(($newdiff - $maxhmore) / 3600));
								$checkhourscharges = $ehours;
								if($checkhourscharges > 0) {
									$aehourschbasp = vikrentcar::applyExtraHoursChargesBasp();
								}
								//
							}
						}
					}
					if($checkhourscharges > 0 && $aehourschbasp == true) {
						$ret = vikrentcar::applyExtraHoursChargesCar($price, $row['idcar'], $checkhourscharges, $daysdiff, false, true, true);
						$price = $ret['return'];
						$calcdays = $ret['days'];
					}
					if($checkhourscharges > 0 && $aehourschbasp == false) {
						$price = vikrentcar::extraHoursSetPreviousFareCar($price, $row['idcar'], $checkhourscharges, $daysdiff, true);
						$price=vikrentcar::applySeasonsCar($price, $row['ritiro'], $row['consegna'], $row['idplace']);
						$ret = vikrentcar::applyExtraHoursChargesCar($price, $row['idcar'], $checkhourscharges, $daysdiff, true, true, true);
						$price = $ret['return'];
						$calcdays = $ret['days'];
					}else {
						$price=vikrentcar::applySeasonsCar($price, $row['ritiro'], $row['consegna'], $row['idplace']);
					}
					//
					$isdue+=vikrentcar::sayCostPlusIva($price[0]['cost'], $price[0]['idprice']);
				}else {
					//no ourly prices
					if ($row['hourly'] == 1) {
						$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() == 1) {
							$price = $dbo->loadAssocList();
							$price=vikrentcar::applySeasonsCar($price, $row['ritiro'], $row['consegna'], $row['idplace']);
							$isdue+=vikrentcar::sayCostPlusIva($price[0]['cost'], $price[0]['idprice']);
						}
					}
				}
			}
			if (!empty($row['optionals'])) {
				$stepo=explode(";", $row['optionals']);
				foreach($stepo as $oo){
					if (!empty($oo)) {
						$stept=explode(":", $oo);
						$q="SELECT * FROM `#__vikrentcar_optionals` WHERE `id`='".$stept[0]."';";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() == 1) {
							$popts = $dbo->loadAssocList();
							$realcost=(intval($popts[0]['perday'])==1 ? ($popts[0]['cost'] * $row['days'] * $stept[1]) : ($popts[0]['cost'] * $stept[1]));
							if($popts[0]['maxprice'] > 0 && $realcost > $popts[0]['maxprice']) {
								$realcost=$popts[0]['maxprice'];
								if(intval($popts[0]['hmany']) == 1 && intval($stept[1]) > 1) {
									$realcost = $popts[0]['maxprice'] * $stept[1];
								}
							}
							$isdue+=vikrentcar::sayOptionalsPlusIva($realcost, $popts[0]['idiva']);
						}
					}
				}
			}
			if(!empty($row['idplace']) && !empty($row['idreturnplace'])) {
				$locfee=vikrentcar::getLocFee($row['idplace'], $row['idreturnplace']);
				if($locfee) {
					//VikRentCar 1.7 - Location fees overrides
					if (strlen($locfee['losoverride']) > 0) {
						$arrvaloverrides = array();
						$valovrparts = explode('_', $locfee['losoverride']);
						foreach($valovrparts as $valovr) {
							if (!empty($valovr)) {
								$ovrinfo = explode(':', $valovr);
								$arrvaloverrides[$ovrinfo[0]] = $ovrinfo[1];
							}
						}
						if (array_key_exists($row['days'], $arrvaloverrides)) {
							$locfee['cost'] = $arrvaloverrides[$row['days']];
						}
					}
					//end VikRentCar 1.7 - Location fees overrides
					$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $row['days']) : $locfee['cost'];
					$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva']);
					$isdue+=$locfeewith;
				}
			}
			//VRC 1.9 - Out of Hours Fees
			$oohfee = vikrentcar::getOutOfHoursFees($row['idplace'], $row['idreturnplace'], $row['ritiro'], $row['consegna'], array('id' => $row['idcar']));
			if(count($oohfee) > 0) {
				$oohfeewith=vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
				$isdue+=$oohfeewith;
			}
			//
			//vikrentcar 1.6 coupon
			$usedcoupon = false;
			$origisdue = $isdue;
			if(strlen($row['coupon']) > 0) {
				$usedcoupon = true;
				$expcoupon = explode(";", $row['coupon']);
				$isdue = $isdue - $expcoupon[1];
			}
			//
			?>
			<tr class="row<?php echo $kk; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><?php echo date($df.' '.$nowtf, $row['tsdel']); ?></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editoldorder&amp;cid[]=<?php echo $row['id']; ?>"><?php echo date($df.' '.$nowtf, $row['ts']); ?></a></td>
				<td><?php echo (!empty($row['custdata']) ? substr($row['custdata'], 0, 45)." ..." : ""); ?></td>
				<td><?php echo $car['name']; ?></td>
				<td><?php echo date($df.' '.$nowtf, $row['ritiro']); ?></td>
				<td><?php echo date($df.' '.$nowtf, $row['consegna']); ?></td>
                <td class="center"><?php echo ($row['hourly'] == 1 && !empty($price[0]['hours']) ? $price[0]['hours'].' '.JText::_('VRCHOURS') : $row['days']); ?></td>
                <td class="center"><?php echo ($row['totpaid'] > 0 ? $currencysymb." ".vikrentcar::numberFormat($row['totpaid']) : $currencysymb." ".vikrentcar::numberFormat($isdue)); ?></td>
                <td class="center"><?php echo ($row['status']=="confirmed" ? "<span style=\"color: #4ca25a;\">".JText::_('VRCONFIRMED')."</span>" : "<span style=\"color: #ff0000;\">".($row['status'] == 'standby' ? JText::_('VRSTANDBY') : JText::_('VRCANCELLED'))."</span>"); ?></td>
			</tr>
              <?php
            $kk = 1 - $kk;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewoldorders" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewPlaces ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOPLACESFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'removeplace') {
			if (confirm('<?php echo JText::_('VRJSDELPLACES'); ?> ?')){
				submitform( pressbutton );
				return;
			}else{
				return false;
			}
		}

		// do field validation
		try {
			document.adminForm.onsubmit();
		}
		catch(e){}
		submitform( pressbutton );
	}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWPLACESONE' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRCPLACELAT' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRCPLACELNG' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRCPLACEDESCR' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRCPLACEOPENTIME' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRCORDERING' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$opentime = "";
			if(!empty($row['opentime'])) {
				$parts = explode("-", $row['opentime']);
				$openat=vikrentcar::getHoursMinutes($parts[0]);
				$closeat=vikrentcar::getHoursMinutes($parts[1]);
				$opentime = ((int)$openat[0] < 10 ? "0".$openat[0] : $openat[0]).":".((int)$openat[1] < 10 ? "0".$openat[1] : $openat[1])." - ".((int)$closeat[0] < 10 ? "0".$closeat[0] : $closeat[0]).":".((int)$closeat[1] < 10 ? "0".$closeat[1] : $closeat[1]);
			}
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editplace&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
				<td class="center"><?php echo $row['lat']; ?></td>
				<td class="center"><?php echo $row['lng']; ?></td>
				<td><?php echo strip_tags($row['descr']); ?></td>
				<td class="center"><?php echo $opentime; ?></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=sortlocation&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=up"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/up.png" border="0"/></a> <a href="index.php?option=com_vikrentcar&amp;task=sortlocation&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=down"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/down.png" border="0"/></a></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewplaces" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}	
	
	public static function pViewIva ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOIVAFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removeiva') {
				if (confirm('<?php echo JText::_('VRJSDELIVA'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWIVAONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWIVATWO' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['aliq']; ?></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewiva" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewCoupons ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRCNOCOUPONSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{	
		?>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="200"><?php echo JText::_( 'VRCPVIEWCOUPONSONE' ); ?></th>
			<th class="title center" width="200" align="center"><?php echo JText::_( 'VRCPVIEWCOUPONSTWO' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWCOUPONSTHREE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWCOUPONSFOUR' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWCOUPONSFIVE' ); ?></th>
		</tr>
		</thead>
		<?php
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$nowdf = vikrentcar::getDateFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$strtype = $row['type'] == 1 ? JText::_('VRCCOUPONTYPEPERMANENT') : JText::_('VRCCOUPONTYPEGIFT');
			$strtype .= ", ".$row['value']." ".($row['percentot'] == 1 ? "%" : $currencysymb);
			$strdate = JText::_('VRCCOUPONALWAYSVALID');
			if(strlen($row['datevalid']) > 0) {
				$dparts = explode("-", $row['datevalid']);
				$strdate = date($df, $dparts[0])." - ".date($df, $dparts[1]);
			}
			$totvehicles = 0;
			if(intval($row['allvehicles']) == 0) {
				$allve = explode(";", $row['idcars']);
				foreach($allve as $fv) {
					if(!empty($fv)) {
						$totvehicles++;
					} 
				}
			}
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editcoupon&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['code']; ?></a></td>
				<td class="center"><?php echo $strtype; ?></td>
				<td class="center"><?php echo $strdate; ?></td>
				<td class="center"><?php echo intval($row['allvehicles']) == 1 ? JText::_('VRCCOUPONALLVEHICLES') : $totvehicles; ?></td>
				<td class="center"><?php echo $row['mintotord']; ?></td>
			</tr>	
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewcoupons" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewCustomf ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="err"><?php echo JText::_('VRNOFIELDSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		?>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title center" width="50" align="center">ID</th>
			<th class="title left" width="200"><?php echo JText::_( 'VRPVIEWCUSTOMFONE' ); ?></th>
			<th class="title left" width="200"><?php echo JText::_( 'VRPVIEWCUSTOMFTWO' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPVIEWCUSTOMFTHREE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPVIEWCUSTOMFFOUR' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPVIEWCUSTOMFFIVE' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td class="center"><?php echo $row['id']; ?></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editcustomf&amp;cid[]=<?php echo $row['id']; ?>"><?php echo JText::_($row['name']); ?></a></td>
				<td><?php echo ucwords($row['type']).($row['isnominative'] == 1 ? ' <span class="badge">'.JText::_('VRCISNOMINATIVE').'</span>' : '').($row['isphone'] == 1 ? ' <span class="badge">'.JText::_('VRCISPHONENUMBER').'</span>' : ''); ?></td>
				<td class="center"><?php echo intval($row['required']) == 1 ? "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/ok.png\"/>" : "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/no.png\"/>"; ?></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=sortfield&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=up"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/up.png" border="0"/></a> <a href="index.php?option=com_vikrentcar&amp;task=sortfield&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=down"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/down.png" border="0"/></a></td>
				<td class="center"><?php echo intval($row['isemail']) == 1 ? "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/ok.png\"/>" : "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/no.png\"/>"; ?></td>
			</tr>	
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewcustomf" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewCategories ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOCATEGORIESFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removecat') {
				if (confirm('<?php echo JText::_('VRJSDELCATEGORIES'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCATEGORIESONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCATEGORIESDESCR' ); ?></th>
			<th class="title center" width="60" align="center"><?php echo JText::_( 'VRCORDERING' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editcat&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
				<td><?php echo strip_tags($row['descr']); ?></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=sortcategory&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=up" title="<?php echo $row['ordering']; ?>"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/up.png" border="0"/></a> <a href="index.php?option=com_vikrentcar&amp;task=sortcategory&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=down" title="<?php echo $row['ordering']; ?>"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/down.png" border="0"/></a></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewcategories" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewCarat ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOCARATFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removecarat') {
				if (confirm('<?php echo JText::_('VRJSDELCARAT'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCARATONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCARATTWO' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWCARATTHREE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCORDERING' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editcarat&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
				<td>
				<?php 
					echo (file_exists('./components/com_vikrentcar/resources/'.$row['icon']) ? "<span>".$row['icon']." &nbsp;&nbsp;<img align=\"middle\" src=\"./components/com_vikrentcar/resources/".$row['icon']."\"/></span>" : $row['icon']); 
				?>
				</td>
				<td><?php echo $row['textimg']; ?></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=sortcarat&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=up"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/up.png" border="0"/></a> <a href="index.php?option=com_vikrentcar&amp;task=sortcarat&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=down"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/down.png" border="0"/></a></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewcarat" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewOptionals ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOOPTIONALSFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script language="JavaScript" type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removeoptionals') {
				if (confirm('<?php echo JText::_('VRJSDELOPTIONALS'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWOPTIONALSONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWOPTIONALSTWO' ); ?></th>
			<th class="title center" align="center" width="75"><?php echo JText::_( 'VRPVIEWOPTIONALSTHREE' ); ?></th>
			<th class="title center" align="center" width="75"><?php echo JText::_( 'VRPVIEWOPTIONALSFOUR' ); ?></th>
			<th class="title center" align="center" width="75"><?php echo JText::_( 'VRPVIEWOPTIONALSEIGHT' ); ?></th>
			<th class="title center" align="center" width="150"><?php echo JText::_( 'VRPVIEWOPTIONALSFIVE' ); ?></th>
			<th class="title center" align="center" width="150"><?php echo JText::_( 'VRPVIEWOPTIONALSSIX' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWOPTIONALSSEVEN' ); ?></th>
			<th class="title center" width="60" align="center"><?php echo JText::_( 'VRCORDERING' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editoptional&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
				<td><?php echo (strlen($row['descr'])>150 ? substr($row['descr'], 0, 150) : $row['descr']); ?></td>
				<td class="center"><?php echo $row['cost']; ?></td>
				<td class="center"><?php echo vikrentcar::getAliq($row['idiva']); ?>%</td>
				<td class="center"><?php echo $row['maxprice']; ?></td>
				<td class="center"><?php echo (intval($row['perday'])==1 ? "Y" : "N"); ?></td>
				<td class="center"><?php echo (intval($row['hmany'])==1 ? "&gt; 1" : "1"); ?></td>
				<td><?php echo (file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.$row['img']) && !empty($row['img']) ? "<span>".$row['img']." &nbsp;&nbsp;<img align=\"middle\" class=\"maxfifty\" src=\"./components/com_vikrentcar/resources/".$row['img']."\"/></span>" : ""); ?></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=sortoptional&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=up"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/up.png" border="0"/></a> <a href="index.php?option=com_vikrentcar&amp;task=sortoptional&amp;cid[]=<?php echo $row['id']; ?>&amp;mode=down"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/down.png" border="0"/></a></td>
			</tr>
              <?php
			$k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewoptionals" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pViewPrices ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="err"><?php echo JText::_('VRNOPRICESFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removeprice') {
				if (confirm('<?php echo JText::_('VRJSDELPRICES'); ?>')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWPRICESONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWPRICESTWO' ); ?></th>
			<th class="title left" width="75"><?php echo JText::_( 'VRPVIEWPRICESTHREE' ); ?></th>
		</tr>
		</thead>
		<?php

		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['attr']; ?></td>
				<td><?php echo vikrentcar::getAliq($row['idiva']); ?>%</td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="viewprices" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
		
	public static function pEditBusy ($busy, $ord, $car, $allcars, $locations, $option) {
		$dbo = JFactory::getDbo();
		//VikRentCar 1.7
		$pstandbyquick = VikRequest::getString('standbyquick', '', 'request');
		$pstandbyquick = $pstandbyquick == "1" ? 1 : 0;
		$pnotifycust = VikRequest::getString('notifycust', '', 'request');
		$pnotifycust = $pnotifycust == "1" ? 1 : 0;
		//
		$currencysymb=vikrentcar::getCurrencySymb(true);
		JHTML::_('behavior.calendar');
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$rit=date('d/m/Y', $ord[0]['ritiro']);
			$con=date('d/m/Y', $ord[0]['consegna']);
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$rit=date('m/d/Y', $ord[0]['ritiro']);
			$con=date('m/d/Y', $ord[0]['consegna']);
			$df='m/d/Y';
		}else {
			$rit=date('Y/m/d', $ord[0]['ritiro']);
			$con=date('Y/m/d', $ord[0]['consegna']);
			$df='Y/m/d';
		}
		$arit=getdate($ord[0]['ritiro']);
		$acon=getdate($ord[0]['consegna']);
		for($i=0; $i < 24; $i++){
			$ritho.="<option value=\"".$i."\"".($arit['hours']==$i ? " selected=\"selected\"" : "").">".($i < 10 ? "0".$i : $i)."</option>\n";
			$conho.="<option value=\"".$i."\"".($acon['hours']==$i ? " selected=\"selected\"" : "").">".($i < 10 ? "0".$i : $i)."</option>\n";
		}
		for($i=0; $i < 60; $i++){
			$ritmi.="<option value=\"".$i."\"".($arit['minutes']==$i ? " selected=\"selected\"" : "").">".($i < 10 ? "0".$i : $i)."</option>\n";
			$conmi.="<option value=\"".$i."\"".($acon['minutes']==$i ? " selected=\"selected\"" : "").">".($i < 10 ? "0".$i : $i)."</option>\n";
		}
		//vikrentcar 1.5
		if($ord[0]['hourly'] == 1) {
			$secdiff = $ord[0]['consegna'] - $ord[0]['ritiro'];
			$daysdiff = $secdiff / 86400;
			if (is_int($daysdiff)) {
				if ($daysdiff < 1) {
					$daysdiff = 1;
				}
			} else {
				if ($daysdiff < 1) {
					$daysdiff = 1;
					$checkhourly = true;
					$ophours = $secdiff / 3600;
					$hoursdiff = intval(round($ophours));
					if($hoursdiff < 1) {
						$hoursdiff = 1;
					}
				}
			}
		}
		//
		//vikrentcar 1.6
		if(is_array($ord)) {
			$checkhourscharges = 0;
			$ppickup = $ord[0]['ritiro'];
			$prelease = $ord[0]['consegna'];
			$secdiff = $prelease - $ppickup;
			$daysdiff = $secdiff / 86400;
			if (is_int($daysdiff)) {
				if ($daysdiff < 1) {
					$daysdiff = 1;
				}
			}else {
				if ($daysdiff < 1) {
					$daysdiff = 1;
				}else {
					$sum = floor($daysdiff) * 86400;
					$newdiff = $secdiff - $sum;
					$maxhmore = vikrentcar::getHoursMoreRb() * 3600;
					if ($maxhmore >= $newdiff) {
						$daysdiff = floor($daysdiff);
					}else {
						$daysdiff = ceil($daysdiff);
						//vikrentcar 1.6
						$ehours = intval(round(($newdiff - $maxhmore) / 3600));
						$checkhourscharges = $ehours;
						if($checkhourscharges > 0) {
							$aehourschbasp = vikrentcar::applyExtraHoursChargesBasp();
						}
						//
					}
				}
			}
		}
		//
		//VRC 1.11 Custom Rate
		$is_cust_cost = (!empty($ord[0]['cust_cost']) && $ord[0]['cust_cost'] > 0.00);
		$ivas = array();
		$wiva = "";
		$jstaxopts = '<option value=\"\">'.JText::_('VRNEWOPTFOUR').'</option>';
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"aliq\"><option value=\"\">".JText::_('VRNEWOPTFOUR')."</option>\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\" data-aliqid=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']." - ".$iv['aliq']."%")."</option>\n";
				$jstaxopts .= '<option value=\"'.$iv['id'].'\">'.(empty($iv['name']) ? $iv['aliq']."%" : addslashes($iv['name'])." - ".$iv['aliq']."%").'</option>';
			}
			$wiva.="</select>\n";
		}
		//
		?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removebusy') {
				if (confirm('<?php echo JText::_('VRJSDELBUSY'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
		function vrcSwitchCar(newcarid) {
			var curcarid = '<?php echo $car['id']; ?>';
			if(parseInt(curcarid) != parseInt(newcarid) && newcarid.length) {
				jQuery('#vrcsetnewcar').text('<?php echo addslashes(JText::_('VRPEDITBUSYSETCARCHANGE')); ?>').fadeIn();
			}else {
				jQuery('#vrcsetnewcar').text('').fadeOut();
			}
		}
		var vrcMessages = {
			"jscurrency": "<?php echo $currencysymb; ?>",
			"extracnameph": "<?php echo addslashes(JText::_('VRPEDITBUSYEXTRACNAME')); ?>",
			"taxoptions" : "<?php echo $jstaxopts; ?>"
		};
		</script>
		<script type="text/javascript">
		/* custom extra fees for the order */
		function vrcAddExtraCost() {
			var telem = jQuery("#vrc-ebusy-extracosts-table");
			if(telem.length > 0) {
				var extracostcont = "<tr>"+
					"<td class=\"vrc-ebusy-extracosts-cellname\"><input type=\"text\" name=\"extracn[]\" value=\"\" placeholder=\""+vrcMessages.extracnameph+"\" size=\"25\" /></td>"+
					"<td class=\"vrc-ebusy-extracosts-cellcost\"><span class=\"vrc-ebusy-extracosts-currency\">"+vrcMessages.jscurrency+"</span> <input type=\"text\" name=\"extracc[]\" value=\"\" placeholder=\"0.00\" size=\"5\" /></td>"+
					"<td class=\"vrc-ebusy-extracosts-celltax\"><select name=\"extractx[]\">"+vrcMessages.taxoptions+"</select></td>"+
					"<td class=\"vrc-ebusy-extracosts-cellrm\"><button class=\"btn btn-danger\" type=\"button\" onclick=\"vrcRemoveExtraCost(this);\">X</button></td>"+
				"</tr>";
				telem.append(extracostcont);
			}
		}
		function vrcRemoveExtraCost(elem) {
			var parel = jQuery(elem).closest("tr");
			if(parel.length > 0) {
				parel.remove();
			}
		}
		</script>
		<form name="adminForm" action="index.php" method="post" id="adminForm">
		<?php
		if(!is_array($ord)) {
			?>
		<p><?php echo JText::_('VRPEDITBUSYONE'); ?></p>	
		<?php
		}else {
			?>
		<p><strong><?php echo JText::_('VRPEDITBUSYORDERNUMBER'); ?></strong>: <?php echo $ord[0]['id']; ?> - <strong><?php echo JText::_('VRPEDITBUSYTWO'); ?></strong>: <?php echo date($df.' '.$nowtf, $ord[0]['ts']); ?> - <strong><?php echo JText::_('VRPEDITBUSYTHREE'); ?> <?php echo ($ord[0]['days']==1 ? "1 ".JText::_('VRDAY') : $ord[0]['days']." ".JText::_('VRDAYS')); ?></strong></p>
		<?php
			if($busy['stop_sales'] == 1) {
				echo '<p><span class="label vrc-stopsales-sp">'.JText::_('VRCSTOPRENTALS').'</span></p>';
			}
			echo '<strong>'.JText::_('VRCUSTINFO').'</strong>:<br/>'.(!empty($ord[0]['custdata']) ? "<textarea name=\"custdata\" rows=\"5\" cols=\"50\">".$ord[0]['custdata']."</textarea>" : "<textarea name=\"custdata\" rows=\"5\" cols=\"50\"></textarea>");
			echo '<br/><br/><strong>'.JText::_('VRQRCUSTMAIL').'</strong>: <input type="text" name="custmail" value="'.$ord[0]['custmail'].'" size="30"/>'; 
		}
		?>	
		<table class="adminform">
		<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VRCEORDLBLDATESLOCS'); ?></span></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRPEDITBUSYFOUR'); ?>:</b> </td><td><?php echo JHTML::_('calendar', $rit, 'pickupdate', 'pickupdate', vikrentcar::getDateFormat(true), array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?> <?php echo JText::_('VRPEDITBUSYFIVE'); ?> <select name="pickuph"><?php echo $ritho; ?></select> <select name="pickupm"><?php echo $ritmi; ?></select></td></tr>
		<tr><td>&bull; <b><?php echo JText::_('VRPEDITBUSYSIX'); ?>:</b> </td><td><?php echo JHTML::_('calendar', $con, 'releasedate', 'releasedate', vikrentcar::getDateFormat(true), array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?> <?php echo JText::_('VRPEDITBUSYFIVE'); ?> <select name="releaseh"><?php echo $conho; ?></select> <select name="releasem"><?php echo $conmi; ?></select></td></tr>
		<?php
		if (is_array($ord) && (!empty($ord[0]['idtar']) || $is_cust_cost)) {
			$dbo = JFactory::getDBO();
			$wselcars = '<select name="newidcar" onchange="vrcSwitchCar(this.value);">'."\n";
			foreach ($allcars as $ck => $cv) {
				$wselcars .= '<option value="'.$cv['id'].'"'.($cv['id'] == $ord[0]['idcar'] ? ' selected="selected"' : '').'>'.$cv['name'].'</option>'."\n";
			}
			$wselcars .= '</select>'."\n";
			$wselplace = '<select name="idplace"><option value=""> ----- </option>'."\n";
			foreach ($locations as $lk => $lv) {
				$wselplace .= '<option value="'.$lv['id'].'"'.($lv['id'] == $ord[0]['idplace'] ? ' selected="selected"' : '').'>'.$lv['name'].'</option>'."\n";
			}
			$wselplace .= '</select>'."\n";
			$wselreturnplace = '<select name="idreturnplace"><option value=""> ----- </option>'."\n";
			foreach ($locations as $lk => $lv) {
				$wselreturnplace .= '<option value="'.$lv['id'].'"'.($lv['id'] == $ord[0]['idreturnplace'] ? ' selected="selected"' : '').'>'.$lv['name'].'</option>'."\n";
			}
			$wselreturnplace .= '</select>'."\n";
			?>
			<tr><td>&bull; <b><?php echo JText::_('VRPEDITBUSYSETCAR'); ?>:</b> </td><td><?php echo $wselcars; ?><span id="vrcsetnewcar" style="display: none;"></span></td></tr>
			<tr><td>&bull; <b><?php echo JText::_('VRPEDITBUSYPICKPLACE'); ?>:</b> </td><td><?php echo $wselplace; ?></td></tr>
			<tr><td>&bull; <b><?php echo JText::_('VRPEDITBUSYDROPPLACE'); ?>:</b> </td><td><?php echo $wselreturnplace; ?></td></tr>
			<?php
			//vikrentcar 1.5
			if($ord[0]['hourly'] == 1) {
				$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `hours`='".$hoursdiff."' AND `idcar`='".$ord[0]['idcar']."' ORDER BY `#__vikrentcar_dispcosthours`.`cost` ASC;";
			}else {
				$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `days`='".$ord[0]['days']."' AND `idcar`='".$ord[0]['idcar']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC;";
			}
			//
			$dbo->setQuery($q);
			$dbo->execute();
			$tottars = $dbo->getNumRows();
			$proceedtars = false;
			if ($tottars == 0) {
				if($ord[0]['hourly'] == 1) {
					//there are no hourly prices
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `days`='".$ord[0]['days']."' AND `idcar`='".$ord[0]['idcar']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC;";
					$dbo->setQuery($q);
					$dbo->execute();
					if($dbo->getNumRows() > 0) {
						$proceedtars = true;
					}
				}
			}else {
				$proceedtars = true;
			}
			if ($proceedtars) {
				$tars = $dbo->loadAssocList();
				//vikrentcar 1.5
				if($ord[0]['hourly'] == 1) {
					foreach($tars as $kt => $vt) {
						$tars[$kt]['days'] = 1;
					}
				}
				//
				//vikrentcar 1.6
				if($checkhourscharges > 0 && $aehourschbasp == true) {
					$ret = vikrentcar::applyExtraHoursChargesCar($tars, $ord[0]['idcar'], $checkhourscharges, $daysdiff, false, true, true);
					$tars = $ret['return'];
					$calcdays = $ret['days'];
				}
				if($checkhourscharges > 0 && $aehourschbasp == false) {
					$tars = vikrentcar::extraHoursSetPreviousFareCar($tars, $ord[0]['idcar'], $checkhourscharges, $daysdiff, true);
					$tars = vikrentcar::applySeasonsCar($tars, $ord[0]['ritiro'], $ord[0]['consegna'], $ord[0]['idplace']);
					$ret = vikrentcar::applyExtraHoursChargesCar($tars, $ord[0]['idcar'], $checkhourscharges, $daysdiff, true, true, true);
					$tars = $ret['return'];
					$calcdays = $ret['days'];
				}else {
					$tars = vikrentcar::applySeasonsCar($tars, $ord[0]['ritiro'], $ord[0]['consegna'], $ord[0]['idplace']);
				}
				//
				?>
				<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VRPEDITBUSYSEVEN'); ?></span></td></tr>
				<input type="hidden" name="areprices" value="yes"/>
				<tr><td colspan="2"><table style="width: 100%;">
				<?php
				$sel_rate_changed = false;
				foreach($tars as $k=>$t) {
					$cur_cost = vikrentcar::sayCostPlusIva($t['cost'], $t['idprice'], $ord[0]);
					$sel_rate_changed = $t['id'] == $ord[0]['idtar'] ? $cur_cost : $sel_rate_changed;
					if ($t['id']==$ord[0]['idtar']) {
						$acttar=$k;
					}
					?>
					<tr><td style="width: 60%;"><label for="pid<?php echo $t['idprice']; ?>"><?php echo vikrentcar::getPriceName($t['idprice']).(strlen($t['attrdata']) ? "<br/>".vikrentcar::getPriceAttr($t['idprice']).": ".$t['attrdata'] : ""); ?></label></td><td><?php echo $currencysymb." ".$cur_cost; ?></td><td style="text-align: center;"><input type="radio" name="priceid" id="pid<?php echo $t['idprice']; ?>" value="<?php echo $t['idprice']; ?>"<?php echo ($t['id']==$ord[0]['idtar'] ? " checked=\"checked\"" : ""); ?>/></td></tr>
					<?php
				}
				//print the set custom rate
				?>
					<tr><td><label for="cust_cost" class="vrc-custrate-lbl-add hasTooltip" title="<?php echo JText::_('VRCRENTCUSTRATETAXHELP'); ?>"><?php echo JText::_('VRCRENTCUSTRATEPLANADD'); ?></label></td><td><?php echo $currencysymb; ?> <input type="text" name="cust_cost" id="cust_cost" value="<?php echo $ord[0]['cust_cost']; ?>" placeholder="<?php echo vikrentcar::numberFormat(($sel_rate_changed !== false ? $sel_rate_changed : 0)); ?>" size="4" onblur="if(this.value.length) {document.getElementById('priceid').checked = true; document.getElementById('tax').style.display = 'block';}" /><div id="tax" style="display: <?php echo $is_cust_cost ? 'block' : 'none'; ?>;"><?php echo (!empty($wiva) ? str_replace('data-aliqid="'.(int)$ord[0]['cust_idiva'].'"', 'selected="selected"', $wiva) : ''); ?></div></td><td style="text-align: center;"><input type="radio" name="priceid" id="priceid" value=""<?php echo $is_cust_cost ? ' checked="checked"' : ''; ?> onclick="document.getElementById('tax').style.display = 'block';" /></td></tr>
				</table></td></tr>
				<?php
				if(!empty($car['idopt'])){
					$optionals=vikrentcar::getCarOptionals($car['idopt']);
					if (is_array($optionals)) {
						if (!empty($ord[0]['optionals'])) {
							$haveopt=explode(";", $ord[0]['optionals']);
							foreach($haveopt as $ho){
								if (!empty($ho)) {
									$havetwo=explode(":", $ho);
									$arropt[$havetwo[0]]=$havetwo[1];
								}
							}
						}else {
							$arropt[]="";
						}
						
						?>
						<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VRPEDITBUSYEIGHT'); ?></span></td></tr>
						<tr><td colspan="2"><table style="width: 100%;">
						<?php
						foreach($optionals as $k=>$o) { 
							if (intval($o['hmany'])==1) {
								if (array_key_exists($o['id'], $arropt)) {
									$oval=$arropt[$o['id']];
								}else {
									$oval="";
								}
							}else {
								if (array_key_exists($o['id'], $arropt)) {
									$oval=" checked=\"checked\"";
								}else {
									$oval="";
								}
							}
							if(intval($o['perday'])==1) {
								//$thisoptcost=$o['cost'] * $tars[$acttar]['days'];
								$thisoptcost=$o['cost'] * $ord[0]['days'];
							}else {
								$thisoptcost=$o['cost'];
							}
							if($o['maxprice'] > 0 && $thisoptcost > $o['maxprice']) {
								$thisoptcost=$o['maxprice'];
							}
						?>	
							<tr><td style="width: 60%;"><?php echo $o['name']; ?></td><td><?php echo $currencysymb; ?> <?php echo vikrentcar::sayOptionalsPlusIva($thisoptcost, $o['idiva'], $ord[0]); ?></td><td align="center"><?php echo (intval($o['hmany'])==1 ? "<input type=\"text\" name=\"optid".$o['id']."\" value=\"".$oval."\" size=\"2\"/>" : "<input type=\"checkbox\" name=\"optid".$o['id']."\" value=\"1\"".$oval."/>"); ?></td></tr>
					<?php }
						?>
						</table></td></tr>
						<?php
					}
				}
				//custom extra fees for the order
				?>
				<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VRPEDITBUSYEXTRACOSTS'); ?> <button class="btn vrc-ebusy-addextracost" type="button" onclick="vrcAddExtraCost();"><i class="icon-new"></i><?php echo JText::_('VRPEDITBUSYADDEXTRAC'); ?></button></span></td></tr>
				<tr><td colspan="2">
					<table class="vrc-ebusy-extracosts-table" id="vrc-ebusy-extracosts-table">
				<?php
				if(!empty($ord[0]['extracosts'])) {
					$cur_extra_costs = json_decode($ord[0]['extracosts'], true);
					foreach ($cur_extra_costs as $eck => $ecv) {
						$ec_taxopts = '';
						foreach ($ivas as $iv) {
							$ec_taxopts .= "<option value=\"".$iv['id']."\"".(!empty($ecv['idtax']) && $ecv['idtax'] == $iv['id'] ? ' selected="selected"' : '').">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']." - ".$iv['aliq']."%")."</option>\n";
						}
						?>
						<tr>
							<td class="vrc-ebusy-extracosts-cellname"><input type="text" name="extracn[]" value="<?php echo addslashes($ecv['name']); ?>" placeholder="<?php echo addslashes(JText::_('VRPEDITBUSYEXTRACNAME')); ?>" size="25" /></td>
							<td class="vrc-ebusy-extracosts-cellcost"><span class="vrc-ebusy-extracosts-currency"><?php echo $currencysymb; ?></span> <input type="text" name="extracc[]" value="<?php echo addslashes($ecv['cost']); ?>" placeholder="0.00" size="5" /></td>
							<td class="vrc-ebusy-extracosts-celltax"><select name="extractx[]"><option value=""><?php echo JText::_('VRNEWOPTFOUR'); ?></option><?php echo $ec_taxopts; ?></select></td>
							<td class="vrc-ebusy-extracosts-cellrm"><button class="btn btn-danger" type="button" onclick="vrcRemoveExtraCost(this);">X</button></td>
						</tr>
						<?php
					}
				}
				?>
					</table>
				</td></tr>
				<?php
				//end custom extra fees for the order
				?>
				<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VREDITORDERNINE'); ?></span></td></tr>
				<tr><td>&bull; <b><?php echo JText::_('VREDITORDERNINE'); ?>:</b></td><td><input type="text" name="order_total" value="<?php echo $ord[0]['order_total']; ?>" size="5"/> <?php echo $currencysymb; ?></td></tr>
				<tr><td>&bull; <b><?php echo JText::_('VRCAMOUNTPAID'); ?>:</b></td><td><input type="text" name="totpaid" value="<?php echo $ord[0]['totpaid']; ?>" size="5"/> <?php echo $currencysymb; ?></td></tr>
				<?php
			}
		}elseif (is_array($ord) && empty($ord[0]['idtar'])) {
			//order is a quick reservation from administrator
			$dbo = JFactory::getDBO();
			//vikrentcar 1.5
			if($ord[0]['hourly'] == 1) {
				$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `hours`='".$hoursdiff."' AND `idcar`='".$ord[0]['idcar']."' ORDER BY `#__vikrentcar_dispcosthours`.`cost` ASC;";
			}else {
				$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `days`='".$ord[0]['days']."' AND `idcar`='".$ord[0]['idcar']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC;";
			}
			//
			$dbo->setQuery($q);
			$dbo->execute();
			$tottars = $dbo->getNumRows();
			$proceedtars = false;
			if ($tottars == 0) {
				if($ord[0]['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `days`='".$ord[0]['days']."' AND `idcar`='".$ord[0]['idcar']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC;";
					$dbo->setQuery($q);
					$dbo->execute();
					if($dbo->getNumRows() > 0) {
						$proceedtars = true;
					}
				}
			}else {
				$proceedtars = true;
			}
			if ($proceedtars) {
				$tars = $dbo->loadAssocList();
				?>
				<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VRPEDITBUSYSEVEN'); ?></span></td></tr>
				<input type="hidden" name="areprices" value="quick"/>
				<tr><td colspan="2"><table style="width: 100%;">
				<?php
				foreach($tars as $k=>$t) {
					?>
					<tr><td style="width: 60%;"><label for="pid<?php echo $t['idprice']; ?>"><?php echo vikrentcar::getPriceName($t['idprice']).(strlen($t['attrdata']) ? "<br/>".vikrentcar::getPriceAttr($t['idprice']).": ".$t['attrdata'] : ""); ?></label></td><td><?php echo $currencysymb." ".vikrentcar::sayCostPlusIva($t['cost'], $t['idprice'], $ord[0]); ?></td><td style="text-align: center;"><input type="radio" name="priceid" id="pid<?php echo $t['idprice']; ?>" value="<?php echo $t['idprice']; ?>"/></td></tr>
					<?php
				}
				?>
					<tr><td><label for="cust_cost" class="vrc-custrate-lbl-add hasTooltip" title="<?php echo JText::_('VRCRENTCUSTRATETAXHELP'); ?>"><?php echo JText::_('VRCRENTCUSTRATEPLANADD'); ?></label></td><td><?php echo $currencysymb; ?> <input type="text" name="cust_cost" id="cust_cost" value="" placeholder="<?php echo vikrentcar::numberFormat(0); ?>" size="4" onblur="if(this.value.length) {document.getElementById('priceid').checked = true; document.getElementById('tax').style.display = 'block';}" /><div id="tax" style="display: none;"><?php echo (!empty($wiva) ? $wiva : ''); ?></div></td><td style="text-align: center;"><input type="radio" name="priceid" id="priceid" value="" onclick="document.getElementById('tax').style.display = 'block';" /></td></tr>
				</table></td></tr>
				<?php
				if(!empty($car['idopt'])) {
					$optionals=vikrentcar::getCarOptionals($car['idopt']);
					if (is_array($optionals)) {
						?>
						<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VRPEDITBUSYEIGHT'); ?></span></td></tr>
						<tr><td colspan="2"><table style="width: 100%;">
						<?php
						foreach($optionals as $k=>$o) { 
						?>	
							<tr><td style="width: 60%;"><?php echo $o['name']; ?></td><td align="center"><?php echo (intval($o['hmany'])==1 ? "<input type=\"text\" name=\"optid".$o['id']."\" value=\"\" size=\"2\"/>" : "<input type=\"checkbox\" name=\"optid".$o['id']."\" value=\"1\"/>"); ?></td></tr>
						<?php
						}
						?>
						</table></td></tr>
						<?php
					}
				}
				?>
				<tr><td colspan="2"><span class="vrc-ebusy-lbl"><?php echo JText::_('VREDITORDERNINE'); ?></span></td></tr>
				<tr><td>&bull; <b><?php echo JText::_('VREDITORDERNINE'); ?>:</b></td><td><input type="text" name="order_total" value="" size="5"/> <?php echo $currencysymb; ?></td></tr>
				<?php
			}
			//
		}
		?>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="idcar" value="<?php echo $ord[0]['idcar']; ?>">
		<input type="hidden" name="idbusy" value="<?php echo $busy['id']; ?>">
		<input type="hidden" name="idorder" value="<?php echo $ord[0]['id']; ?>">
		<input type="hidden" name="standbyquick" value="<?php echo $pstandbyquick; ?>">
		<input type="hidden" name="notifycust" value="<?php echo $pnotifycust; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<?php
		$preturn = VikRequest::getString('return', '', 'request');
		if(!empty($preturn)) {
			echo '<input type="hidden" name="return" value="'.$preturn.'">';
		}
		?>
		</form>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#pickupdate').val('<?php echo $rit; ?>').attr('data-alt-value', '<?php echo $rit; ?>');
			jQuery('#releasedate').val('<?php echo $con; ?>').attr('data-alt-value', '<?php echo $con; ?>');
		});
		</script>
  
		<?php
	}
	
	public static function pNewCoupon ($wselcars, $option) {
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.calendar');
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$df=vikrentcar::getDateFormat(true);
		?>
		<script language="JavaScript" type="text/javascript">
		function setVehiclesList() {
			if(document.adminForm.allvehicles.checked == true) {
				document.getElementById('vrcvlist').style.display='none';
			}else {
				document.getElementById('vrcvlist').style.display='block';
			}
			return true;
		}
		</script>
		<form name="adminForm" action="index.php" method="post" id="adminForm">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONONE'); ?>:</b> </td><td><input type="text" name="code" value="" size="30"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONTWO'); ?>:</b> </td><td><select name="type"><option value="1"><?php echo JText::_('VRCCOUPONTYPEPERMANENT'); ?></option><option value="2"><?php echo JText::_('VRCCOUPONTYPEGIFT'); ?></option></select></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONTHREE'); ?>:</b> </td><td><select name="percentot"><option value="1">%</option><option value="2"><?php echo $currencysymb; ?></option></select></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONFOUR'); ?>:</b> </td><td><input type="text" name="value" value="" size="4"/></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRCNEWCOUPONFIVE'); ?>:</b> </td><td><input type="checkbox" name="allvehicles" value="1" checked="checked" onclick="javascript: setVehiclesList();"/> <?php echo JText::_('VRCNEWCOUPONEIGHT'); ?><span id="vrcvlist" style="display: none;"><br/><?php echo $wselcars; ?></span></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONSIX'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCNEWCOUPONNINE'), JText::_('VRCNEWCOUPONSIX'), 'tooltip.png', ''); ?></td><td><?php echo JHTML::_('calendar', '', 'from', 'from', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?> - <?php echo JHTML::_('calendar', '', 'to', 'to', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONSEVEN'); ?>:</b> </td><td><input type="text" name="mintotord" value="0.00" size="4"/></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditCoupon ($coupon, $wselcars, $option) {
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.calendar');
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$df=vikrentcar::getDateFormat(true);
		$fromdate = "";
		$todate = "";
		if(strlen($coupon['datevalid']) > 0) {
			$dateparts = explode("-", $coupon['datevalid']);
			if ($df=="%d/%m/%Y") {
				$udf='d/m/Y';
			}elseif ($df=="%m/%d/%Y") {
				$udf='m/d/Y';
			}else {
				$udf='Y/m/d';
			}
			$fromdate = date($udf, $dateparts[0]);
			$todate = date($udf, $dateparts[1]);
		}
		?>
		<script language="JavaScript" type="text/javascript">
		function setVehiclesList() {
			if(document.adminForm.allvehicles.checked == true) {
				document.getElementById('vrcvlist').style.display='none';
			}else {
				document.getElementById('vrcvlist').style.display='block';
			}
			return true;
		}
		</script>
		<form name="adminForm" action="index.php" method="post" id="adminForm">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONONE'); ?>:</b> </td><td><input type="text" name="code" value="<?php echo $coupon['code']; ?>" size="30"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONTWO'); ?>:</b> </td><td><select name="type"><option value="1"<?php echo ($coupon['type'] == 1 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCCOUPONTYPEPERMANENT'); ?></option><option value="2"<?php echo ($coupon['type'] == 2 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCCOUPONTYPEGIFT'); ?></option></select></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONTHREE'); ?>:</b> </td><td><select name="percentot"><option value="1"<?php echo ($coupon['percentot'] == 1 ? " selected=\"selected\"" : ""); ?>>%</option><option value="2"<?php echo ($coupon['percentot'] == 2 ? " selected=\"selected\"" : ""); ?>><?php echo $currencysymb; ?></option></select></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONFOUR'); ?>:</b> </td><td><input type="text" name="value" value="<?php echo $coupon['value']; ?>" size="4"/></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRCNEWCOUPONFIVE'); ?>:</b> </td><td><input type="checkbox" name="allvehicles" value="1"<?php echo ($coupon['allvehicles'] == 1 ? " checked=\"checked\"" : ""); ?> onclick="javascript: setVehiclesList();"/> <?php echo JText::_('VRCNEWCOUPONEIGHT'); ?><span id="vrcvlist" style="display: <?php echo ($coupon['allvehicles'] == 1 ? "none" : "block"); ?>;"><br/><?php echo $wselcars; ?></span></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONSIX'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCNEWCOUPONNINE'), JText::_('VRCNEWCOUPONSIX'), 'tooltip.png', ''); ?></td><td><?php echo JHTML::_('calendar', '', 'from', 'from', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?> - <?php echo JHTML::_('calendar', '', 'to', 'to', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWCOUPONSEVEN'); ?>:</b> </td><td><input type="text" name="mintotord" value="<?php echo $coupon['mintotord']; ?>" size="4"/></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="where" value="<?php echo $coupon['id']; ?>">
		</form>
		<?php
		if(strlen($fromdate) > 0 && strlen($todate) > 0) {
		?>
		<script language="JavaScript" type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#from').val('<?php echo $fromdate; ?>').attr('data-alt-value', '<?php echo $fromdate; ?>');
			jQuery('#to').val('<?php echo $todate; ?>').attr('data-alt-value', '<?php echo $todate; ?>');
		});
		</script>
		<?php
		}
		?>
		<?php
	}
	
	public static function pEditCustomf ($field, $option) {
		$choose="";
		if($field['type']=="select") {
			$x=explode(";;__;;", $field['choose']);
			if(@count($x) > 0) {
				foreach($x as $y) {
					if(!empty($y)) {
						$choose.='<input type="text" name="choose[]" value="'.$y.'" size="40"/><br/>'."\n";
					}
				}
			}
		}
		?>
		<script type="text/javascript">
		function setCustomfChoose (val) {
			if(val == "text") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = '';
				document.getElementById('vrcphone').style.display = '';
			}
			if(val == "textarea") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "date") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "checkbox") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "select") {
				document.getElementById('customfchoose').style.display = 'block';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "separator") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "country") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			return true;
		}
		function addElement() {
			var ni = document.getElementById('customfchooseadd');
			var numi = document.getElementById('theValue');
			var num = (document.getElementById('theValue').value -1)+ 2;
			numi.value = num;
			var newdiv = document.createElement('div');
			var divIdName = 'my'+num+'Div';
			newdiv.setAttribute('id',divIdName);
			newdiv.innerHTML = '<input type=\'text\' name=\'choose[]\' value=\'\' size=\'40\'/><br/>';
			ni.appendChild(newdiv);
		}
		</script>
		<input type="hidden" value="0" id="theValue" />
		
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCUSTOMFONE'); ?>:</b> </td><td><input type="text" name="name" value="<?php echo $field['name']; ?>" size="40"/></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRNEWCUSTOMFTWO'); ?>:</b> </td><td valign="top">
		<select id="stype" name="type" onchange="setCustomfChoose(this.value);"><option value="text"<?php echo ($field['type']=="text" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWCUSTOMFTHREE'); ?></option><option value="textarea"<?php echo ($field['type']=="textarea" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWCUSTOMFTEN'); ?></option><option value="date"<?php echo ($field['type']=="date" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWCUSTOMFDATETYPE'); ?></option><option value="select"<?php echo ($field['type']=="select" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWCUSTOMFFOUR'); ?></option><option value="checkbox"<?php echo ($field['type']=="checkbox" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWCUSTOMFFIVE'); ?></option><option value="country"<?php echo ($field['type']=="country" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCNEWCUSTOMFCOUNTRY'); ?></option><option value="separator"<?php echo ($field['type']=="separator" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWCUSTOMFSEPARATOR'); ?></option></select>
		<div id="customfchoose" style="display: <?php echo ($field['type']=="select" ? "block" : "none"); ?>;">
			<?php
			if($field['type']!="select") {
			?>
			<br/><input type="text" name="choose[]" value="" size="40"/>
			<?php
			}else {
				echo '<br/>'.$choose;
			}
			?>
			<div id="customfchooseadd" style="display: block;"></div>
			<span><b><a href="javascript: void(0);" onclick="javascript: addElement();"><?php echo JText::_('VRNEWCUSTOMFNINE'); ?></a></b></span>
		</div>
		</td></tr>
		<tr><td width="200" style="background: none repeat scroll 0 0 #e9e9e9;">&bull; <b><?php echo JText::_('VRNEWCUSTOMFSIX'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="required" value="1"<?php echo (intval($field['required']) == 1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr><td width="200" style="background: none repeat scroll 0 0 #e9e9e9; border-top: 1px solid #ddd;">&bull; <b><?php echo JText::_('VRNEWCUSTOMFSEVEN'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="isemail" value="1"<?php echo (intval($field['isemail']) == 1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr id="vrcnominative"<?php echo ($field['type']!="text" ? " style=\"display: none;\"" : ""); ?>><td width="200" style="background: none repeat scroll 0 0 #e9e9e9; border-top: 1px solid #ddd;">&nbsp; <b><?php echo JText::_('VRCISNOMINATIVE'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="isnominative" value="1"<?php echo (intval($field['isnominative']) == 1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr id="vrcphone"<?php echo ($field['type']!="text" ? " style=\"display: none;\"" : ""); ?>><td width="200" style="background: none repeat scroll 0 0 #e9e9e9; border-top: 1px solid #ddd;">&nbsp; <b><?php echo JText::_('VRCISPHONENUMBER'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="isphone" value="1"<?php echo (intval($field['isphone']) == 1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCUSTOMFEIGHT'); ?>:</b> </td><td><input type="text" name="poplink" value="<?php echo $field['poplink']; ?>" size="40"/> <small>Ex. <i>index.php?option=com_content&view=article&id=#JoomlaArticleID#</i></small></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="where" value="<?php echo $field['id']; ?>">
		</form>
		<?php
	}
	
	public static function pNewCustomf ($option) {
		?>
		<script language="JavaScript" type="text/javascript">
		function setCustomfChoose (val) {
			if(val == "text") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = '';
				document.getElementById('vrcphone').style.display = '';
			}
			if(val == "textarea") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "date") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "checkbox") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "select") {
				document.getElementById('customfchoose').style.display = 'block';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "separator") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			if(val == "country") {
				document.getElementById('customfchoose').style.display = 'none';
				document.getElementById('vrcnominative').style.display = 'none';
				document.getElementById('vrcphone').style.display = 'none';
			}
			return true;
		}
		function addElement() {
			var ni = document.getElementById('customfchooseadd');
			var numi = document.getElementById('theValue');
			var num = (document.getElementById('theValue').value -1)+ 2;
			numi.value = num;
			var newdiv = document.createElement('div');
			var divIdName = 'my'+num+'Div';
			newdiv.setAttribute('id',divIdName);
			newdiv.innerHTML = '<input type=\'text\' name=\'choose[]\' value=\'\' size=\'40\'/><br/>';
			ni.appendChild(newdiv);
		}
		</script>
		<input type="hidden" value="0" id="theValue" />
		
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCUSTOMFONE'); ?>:</b> </td><td><input type="text" name="name" value="" size="40"/></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRNEWCUSTOMFTWO'); ?>:</b> </td><td valign="top">
		<select id="stype" name="type" onchange="setCustomfChoose(this.value);"><option value="text"><?php echo JText::_('VRNEWCUSTOMFTHREE'); ?></option><option value="textarea"><?php echo JText::_('VRNEWCUSTOMFTEN'); ?></option><option value="date"><?php echo JText::_('VRNEWCUSTOMFDATETYPE'); ?></option><option value="select"><?php echo JText::_('VRNEWCUSTOMFFOUR'); ?></option><option value="checkbox"><?php echo JText::_('VRNEWCUSTOMFFIVE'); ?></option><option value="country"><?php echo JText::_('VRCNEWCUSTOMFCOUNTRY'); ?></option><option value="separator"><?php echo JText::_('VRNEWCUSTOMFSEPARATOR'); ?></option></select>
		<div id="customfchoose" style="display: none;"><br/><input type="text" name="choose[]" value="" size="40"/>
			<div id="customfchooseadd" style="display: block;"></div>
			<span><b><a href="javascript: void(0);" onclick="javascript: addElement();"><?php echo JText::_('VRNEWCUSTOMFNINE'); ?></a></b></span>
		</div>
		</td></tr>
		<tr><td width="200" style="background: none repeat scroll 0 0 #e9e9e9;">&bull; <b><?php echo JText::_('VRNEWCUSTOMFSIX'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="required" value="1"/></td></tr>
		<tr><td width="200" style="background: none repeat scroll 0 0 #e9e9e9; border-top: 1px solid #ddd;">&bull; <b><?php echo JText::_('VRNEWCUSTOMFSEVEN'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="isemail" value="1"/></td></tr>
		<tr id="vrcnominative"><td width="200" style="background: none repeat scroll 0 0 #e9e9e9; border-top: 1px solid #ddd;">&nbsp; <b><?php echo JText::_('VRCISNOMINATIVE'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="isnominative" value="1"/></td></tr>
		<tr id="vrcphone"><td width="200" style="background: none repeat scroll 0 0 #e9e9e9; border-top: 1px solid #ddd;">&nbsp; <b><?php echo JText::_('VRCISPHONENUMBER'); ?>:</b> </td><td>&nbsp;<input type="checkbox" name="isphone" value="1"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCUSTOMFEIGHT'); ?>:</b> </td><td><input type="text" name="poplink" value="" size="40"/> <small>Ex. <i>index.php?option=com_content&view=article&id=#JoomlaArticleID#</i></small></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewPlace ($option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.calendar');
		$hours = "<option value=\"\"> </option>\n";
		for($i=0; $i <= 23; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$hours.="<option value=\"".$i."\">".$in."</option>\n";
		}
		$minutes = "<option value=\"\"> </option>\n";
		for($i=0; $i <= 59; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$minutes.="<option value=\"".$i."\">".$in."</option>\n";
		}
		$dbo = JFactory::getDBO();
		$wiva="<select name=\"praliq\">\n";
		$wiva.="<option value=\"\"> ------ </option>\n";
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
		}
		$wiva.="</select>\n";
		?>
		<script type="text/javascript">
		function vrcAddClosingDate() {
			var closingdadd = document.getElementById('insertclosingdate').value;
			var closingdintv = document.getElementById('closingintv').value;
			if(closingdadd.length > 0) {
				document.getElementById('closingdays').value += closingdadd + closingdintv + ',';
				document.getElementById('insertclosingdate').value = '';
				document.getElementById('closingintv').value = '';
			}
		}
		</script>
		
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="150">&bull; <b><?php echo JText::_('VRNEWPLACEONE'); ?>:</b> </td><td><input type="text" name="placename" value="" size="40"/></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACELAT'); ?>:</b> </td><td><input type="text" name="lat" value="" size="30"/></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACELNG'); ?>:</b> </td><td><input type="text" name="lng" value="" size="30"/></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACEOVERRIDETAX'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCPLACEOVERRIDETAXTXT'), JText::_('VRCPLACEOVERRIDETAX'), 'tooltip.png', ''); ?></td><td><?php echo $wiva; ?></td></tr>
		<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRCPLACEOPENTIME'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCPLACEOPENTIMETXT'), JText::_('VRCPLACEOPENTIME'), 'tooltip.png', ''); ?></td><td><p><?php echo JText::_('VRCPLACEOPENTIMEFROM'); ?>: <select name="opentimefh"><?php echo $hours; ?></select> : <select name="opentimefm"><?php echo $minutes; ?></select></p><p><?php echo JText::_('VRCPLACEOPENTIMETO'); ?>: <select name="opentimeth"><?php echo $hours; ?></select> : <select name="opentimetm"><?php echo $minutes; ?></select></p></td></tr>
		<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRCPLACESUGGOPENTIME'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCPLACESUGGOPENTIMETXT'), JText::_('VRCPLACESUGGOPENTIME'), 'tooltip.png', ''); ?></td><td><select name="suggopentimeh"><?php echo $hours; ?></select></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACEDESCR'); ?>:</b> </td><td><?php echo $editor->display("descr", "", 400, 200, 70, 20); ?></td></tr>
		<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRNEWPLACECLOSINGDAYS'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRNEWPLACECLOSINGDAYSHELP'), JText::_('VRNEWPLACECLOSINGDAYS'), 'tooltip.png', ''); ?></td><td><?php echo JHTML::_('calendar', '', 'insertclosingdate', 'insertclosingdate', '%Y-%m-%d', array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?> <span class="vrc-loc-closeintv"><select id="closingintv"><option value=""><?php echo JText::_('VRNEWPLACECLOSINGDAYSINGLE'); ?></option><option value=":w"><?php echo JText::_('VRNEWPLACECLOSINGDAYWEEK'); ?></option></select></span> <span class="vrcspandateadd" onclick="javascript: vrcAddClosingDate();"><?php echo JText::_('VRNEWPLACECLOSINGDAYSADD'); ?></span><br/><textarea name="closingdays" id="closingdays" rows="5" cols="44"></textarea></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditPlace ($row, $option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.calendar');
		$difftime = false;
		if(!empty($row['opentime'])) {
			$difftime = true;
			$parts = explode("-", $row['opentime']);
			$openat=vikrentcar::getHoursMinutes($parts[0]);
			$closeat=vikrentcar::getHoursMinutes($parts[1]);
		}
		$hours = "<option value=\"\"> </option>\n";
		for($i=0; $i <= 23; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$stat = ($difftime == true && (int)$openat[0] == $i ? " selected=\"selected\"" : "");
			$hours.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
		}
		$sugghours = "<option value=\"\"> </option>\n";
		$defhour = !empty($row['defaulttime']) ? ((int)$row['defaulttime'] / 3600) : '';
		for($i=0; $i <= 23; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$stat = (strlen($defhour) && $defhour == $i ? " selected=\"selected\"" : "");
			$sugghours.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
		}
		$minutes = "<option value=\"\"> </option>\n";
		for($i=0; $i <= 59; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$stat = ($difftime == true && (int)$openat[1] == $i ? " selected=\"selected\"" : "");
			$minutes.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
		}
		$hoursto = "<option value=\"\"> </option>\n";
		for($i=0; $i <= 23; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$stat = ($difftime == true && (int)$closeat[0] == $i ? " selected=\"selected\"" : "");
			$hoursto.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
		}
		$minutesto = "<option value=\"\"> </option>\n";
		for($i=0; $i <= 59; $i++){
			$in = $i < 10 ? "0".$i : $i;
			$stat = ($difftime == true && (int)$closeat[1] == $i ? " selected=\"selected\"" : "");
			$minutesto.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
		}
		$dbo = JFactory::getDBO();
		$wiva="<select name=\"praliq\">\n";
		$wiva.="<option value=\"\"> ------ </option>\n";
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\"".($row['idiva'] == $iv['id'] ? " selected=\"selected\"" : "").">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
		}
		$wiva.="</select>\n";
		?>
		<script type="text/javascript">
		function vrcAddClosingDate() {
			var closingdadd = document.getElementById('insertclosingdate').value;
			var closingdintv = document.getElementById('closingintv').value;
			if(closingdadd.length > 0) {
				document.getElementById('closingdays').value += closingdadd + closingdintv + ',';
				document.getElementById('insertclosingdate').value = '';
				document.getElementById('closingintv').value = '';
			}
		}
		</script>
		
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VREDITPLACEONE'); ?>:</b> </td><td><input type="text" name="placename" value="<?php echo $row['name']; ?>" size="40"/></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACELAT'); ?>:</b> </td><td><input type="text" name="lat" value="<?php echo $row['lat']; ?>" size="30"/></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACELNG'); ?>:</b> </td><td><input type="text" name="lng" value="<?php echo $row['lng']; ?>" size="30"/></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACEOVERRIDETAX'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCPLACEOVERRIDETAXTXT'), JText::_('VRCPLACEOVERRIDETAX'), 'tooltip.png', ''); ?></td><td><?php echo $wiva; ?></td></tr>
		<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRCPLACEOPENTIME'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCPLACEOPENTIMETXT'), JText::_('VRCPLACEOPENTIME'), 'tooltip.png', ''); ?></td><td><p><?php echo JText::_('VRCPLACEOPENTIMEFROM'); ?>: <select name="opentimefh"><?php echo $hours; ?></select> : <select name="opentimefm"><?php echo $minutes; ?></select></p><p><?php echo JText::_('VRCPLACEOPENTIMETO'); ?>: <select name="opentimeth"><?php echo $hoursto; ?></select> : <select name="opentimetm"><?php echo $minutesto; ?></select></p></td></tr>
		<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRCPLACESUGGOPENTIME'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRCPLACESUGGOPENTIMETXT'), JText::_('VRCPLACESUGGOPENTIME'), 'tooltip.png', ''); ?></td><td><select name="suggopentimeh"><?php echo $sugghours; ?></select></td></tr>
		<tr><td width="150">&bull; <b><?php echo JText::_('VRCPLACEDESCR'); ?>:</b> </td><td><?php echo $editor->display("descr", $row['descr'], 400, 200, 70, 20); ?></td></tr>
		<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRNEWPLACECLOSINGDAYS'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRNEWPLACECLOSINGDAYSHELP'), JText::_('VRNEWPLACECLOSINGDAYS'), 'tooltip.png', ''); ?></td><td><?php echo JHTML::_('calendar', '', 'insertclosingdate', 'insertclosingdate', '%Y-%m-%d', array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?> <span class="vrc-loc-closeintv"><select id="closingintv"><option value=""><?php echo JText::_('VRNEWPLACECLOSINGDAYSINGLE'); ?></option><option value=":w"><?php echo JText::_('VRNEWPLACECLOSINGDAYWEEK'); ?></option></select></span> <span class="vrcspandateadd" onclick="javascript: vrcAddClosingDate();"><?php echo JText::_('VRNEWPLACECLOSINGDAYSADD'); ?></span><br/><textarea name="closingdays" id="closingdays" rows="5" cols="44"><?php echo $row['closingdays']; ?></textarea></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
		
	public static function pEditOrder ($row, $payments, $option) {
		$currencyname=vikrentcar::getCurrencyName();
		$car=vikrentcar::getCarInfo($row['idcar']);
		$dbo = JFactory::getDBO();
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$payment=vikrentcar::getPayment($row['idpayment']);
		$is_cust_cost = (!empty($row['cust_cost']) && $row['cust_cost'] > 0);
		if(!empty($row['idtar']) || $is_cust_cost) {
			if(!empty($row['idtar'])) {
				if($row['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$row['idtar']."';";
				}else {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
				}
				$dbo->setQuery($q);
				$dbo->execute();
				$tar=$dbo->loadAssocList();
				if($row['hourly'] == 1) {
					foreach($tar as $kt => $vt) {
						$tar[$kt]['days'] = 1;
					}
				}
			}else {
				//Custom Rate
				$tar = array(0 => array(
					'id' => -1,
					'idcar' => $row['idcar'],
					'days' => $row['days'],
					'idprice' => -1,
					'cost' => $row['cust_cost'],
					'attrdata' => '',
				));
			}
			//vikrentcar 1.6
			$checkhourscharges = 0;
			$hoursdiff = 0;
			$ppickup = $row['ritiro'];
			$prelease = $row['consegna'];
			$secdiff = $prelease - $ppickup;
			$daysdiff = $secdiff / 86400;
			if (is_int($daysdiff)) {
				if ($daysdiff < 1) {
					$daysdiff = 1;
				}
			}else {
				if ($daysdiff < 1) {
					$daysdiff = 1;
					$checkhourly = true;
					$ophours = $secdiff / 3600;
					$hoursdiff = intval(round($ophours));
					if($hoursdiff < 1) {
						$hoursdiff = 1;
					}
				}else {
					$sum = floor($daysdiff) * 86400;
					$newdiff = $secdiff - $sum;
					$maxhmore = vikrentcar::getHoursMoreRb() * 3600;
					if ($maxhmore >= $newdiff) {
						$daysdiff = floor($daysdiff);
					}else {
						$daysdiff = ceil($daysdiff);
						//vikrentcar 1.6
						$ehours = intval(round(($newdiff - $maxhmore) / 3600));
						$checkhourscharges = $ehours;
						if($checkhourscharges > 0) {
							$aehourschbasp = vikrentcar::applyExtraHoursChargesBasp();
						}
						//
					}
				}
			}
			//
		}
		?>
		<script type="text/javascript">
		function vrcToggleLog() {
			var logdiv = document.getElementById('vrcpaymentlogdiv').style.display;
			if(logdiv == 'block') {
				document.getElementById('vrcpaymentlogdiv').style.display = 'none';
			}else {
				document.getElementById('vrcadminnotesdiv').style.display = 'none';
				document.getElementById('vrcpaymentlogdiv').style.display = 'block';
			}
		}
		function vrcToggleNotes() {
			var notesdiv = document.getElementById('vrcadminnotesdiv').style.display;
			if(notesdiv == 'block') {
				document.getElementById('vrcadminnotesdiv').style.display = 'none';
			}else {
				if(document.getElementById('vrcpaymentlogdiv')) {
					document.getElementById('vrcpaymentlogdiv').style.display = 'none';
				}
				document.getElementById('vrcadminnotesdiv').style.display = 'block';
			}
		}
		function changePayment() {
			var newpayment = document.getElementById('newpayment').value;
			if(newpayment != '') {
				var paymentname = document.getElementById('newpayment').options[document.getElementById('newpayment').selectedIndex].text;
				if(confirm('<?php echo addslashes(JText::_('VRCCHANGEPAYCONFIRM')); ?>' + paymentname + '?')) {
					document.adminForm.submit();
				}else {
					document.getElementById('newpayment').selectedIndex = 0;
				}
			}
		}
		function toggleDiscount() {
			var discsp = document.getElementById('vrcdiscenter').style.display;
			if(discsp == 'block') {
				document.getElementById('vrcdiscenter').style.display = 'none';
			}else {
				document.getElementById('vrcdiscenter').style.display = 'block';
			}
		}
		</script>
		<form name="adminForm" action="index.php" method="post" id="adminForm">
		<table class="adminform" style="min-width: 50%;">
		<tr><td width="100%">
		<p class="vrcorderof"><span class="label"><?php echo JText::_('VREDITORDERONE'); ?>: <?php echo date($df.' '.$nowtf, $row['ts']); ?></span><?php echo (!empty($row['idbusy']) || $row['status']=="standby" ? " - <button type=\"button\" class=\"btn\" onclick=\"document.location.href='index.php?option=com_vikrentcar&task=editbusy&return=order&cid[]=".$row['id']."';\"><i class=\"icon-pencil\"></i> ".JText::_('VRMODRES')."</button>" : "").(($row['status'] == 'standby' || count($tar[0]) > 0) && time() < $row['ritiro'] ? " - <button class=\"btn\" type=\"button\" onclick=\"window.open('".JURI::root()."index.php?option=com_vikrentcar&task=vieworder&sid=".$row['sid']."&ts=".$row['ts']."', '_blank');\"><i class=\"icon-eye\"></i> ".JText::_('VRCVIEWORDFRONT')."</button>" : ""); ?></p>
		<?php echo ($row['status']=="confirmed" ? "<p class=\"successmade\"><span class=\"label label-success\">".JText::_('VRCONFIRMED')."</span></p>" : ($row['status'] == 'standby' ? "<p class=\"warn\"><span class=\"label label-warning\">".JText::_('VRSTANDBY')."</span></p><span class=\"vrcorderseatasconf\"><a href=\"index.php?option=com_vikrentcar&task=setordconfirmed&cid[]=".$row['id']."\">".JText::_('VRSETORDCONFIRMED')."</a></span>" : "<p class=\"err\"><span class=\"label label-error\" style=\"background-color: #d9534f;\">".JText::_('VRCANCELLED')."</span></p>")); ?>
		<?php
		if($row['status']=="confirmed" && count($tar[0]) > 0) {
			echo "<span class=\"vrcorderseatasconf\"><a href=\"index.php?option=com_vikrentcar&task=resendordemail&cid[]=".$row['id']."\">".JText::_('VRCRESENDORDEMAIL')."</a></span>";
			echo "<span class=\"vrcorderseatasconf\"><a href=\"index.php?option=com_vikrentcar&task=resendordemail&sendpdf=1&cid[]=".$row['id']."\">".JText::_('VRCRESENDORDEMAILANDPDF')."</a></span>";
		}
		if($row['status']=="confirmed" && !empty($row['carindex'])) {
			?>
			<span class="vrc-customer-checkin">
				<a href="index.php?option=com_vikrentcar&amp;task=customercheckin&amp;cid[]=<?php echo $row['id']; ?>"><?php echo JText::_('VRCCUSTOMERCHECKIN'); ?></a>
			<?php
			if (file_exists(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "resources" . DS . "pdfs" . DS . $row['id'].'_'.$row['ts'].'_checkin.pdf')) {
				?>
				<br/>
				<a href="<?php echo JURI::root(); ?>components/com_vikrentcar/resources/pdfs/<?php echo $row['id'].'_'.$row['ts']; ?>_checkin.pdf" target="_blank" class="vrcpdfcheckin"><?php echo JText::_('VRCPDFCHECKIN'); ?></a>
				<?php
			}
			?>
			</span>
			<?php
		}
		?>
		<div class="vrcorderiddata">
			<span class="label label-info"><?php echo JText::_('VRCORDERNUMBER'); ?>: <?php echo $row['id']; ?></span>
		<?php
		if($row['status']=="confirmed") {
			?>
			<span class="label label-info"><?php echo JText::_('VRCCONFIRMATIONNUMBER'); ?>: <?php echo $row['sid'].'_'.$row['ts']; ?></span>
			<?php
		}
		?>
		</div>
		<?php
		if (file_exists(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "resources" . DS . "pdfs" . DS . $row['id'].'_'.$row['ts'].'.pdf')) {
			?>
			<p class="vrcdownloadpdf"><a href="<?php echo JURI::root(); ?>components/com_vikrentcar/resources/pdfs/<?php echo $row['id'].'_'.$row['ts']; ?>.pdf" target="_blank"><?php echo JText::_('VRCDOWNLOADPDF'); ?></a></p>
			<?php
		}
		if (file_exists(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "helpers" . DS . "invoices" . DS . "generated" . DS . $row['id'].'_'.$row['sid'].'.pdf')) {
			?>
			<p class="vrcdownloadpdf"><a href="<?php echo JURI::root(); ?>components/com_vikrentcar/helpers/invoices/generated/<?php echo $row['id'].'_'.$row['sid']; ?>.pdf" target="_blank"><?php echo JText::_('VRCDOWNLOADPDFINVOICE'); ?></a></p>
			<?php
		}
		?>
		</td></tr>
		<tr><td width="100%">
		<table style="width: 100%;"><tr><td valign="top">
		<p class="vrcorderpar"><?php echo JText::_('VRCCUSTEMAILADDR'); ?>:<br/><input type="text" name="custmail" value="<?php echo $row['custmail']; ?>" size="20"/></p>
		<?php
		if(!empty($row['custdata'])) {
			?>
			<p class="vrcorderpar"><?php echo JText::_('VREDITORDERTWO'); ?>:</p>
			<?php
			if(!empty($row['ujid'])) {
				echo '<i>User ID</i>: '.$row['ujid'].'<br/>';
			}
			echo nl2br($row['custdata']);
		}
		?>
		<br/>
		<div class="vrcorderinfoblock">
			<span class="vrcordersp"><?php echo JText::_('VREDITORDERTHREE'); ?>:</span> <?php echo $car['name']; ?><br/>
			<?php
			if($row['status']=="confirmed" && !empty($car['params'])) {
				//Car Specific Unit
				$car_params = json_decode($car['params'], true);
				$arr_features = array();
				$unavailable_indexes = vikrentcar::getCarUnitNumsUnavailable($row);
				if(is_array($car_params) && @count($car_params['features']) > 0) {
					foreach ($car_params['features'] as $cind => $cfeatures) {
						if(in_array($cind, $unavailable_indexes)) {
							continue;
						}
						foreach ($cfeatures as $fname => $fval) {
							if(strlen($fval)) {
								$arr_features[$cind] = '#'.$cind.' - '.JText::_($fname).': '.$fval;
								break;
							}
						}
					}
				}
				if(count($arr_features) > 0) {
					echo VikHelper::getDropDown($arr_features, $row['carindex'], JText::_('VRCFEATASSIGNUNITEMPTY'), JText::_('VRCFEATASSIGNUNIT'), 'carindex').'<br/>';
				}
			}
			?>
			<span class="vrcordersp"><?php echo JText::_('VREDITORDERFOUR'); ?>:</span> <?php echo ($row['hourly'] == 1 ? $tar[0]['hours'].' '.JText::_('VRCHOURS') : $row['days']); ?><br/>
			<span class="vrcordersp"><?php echo JText::_('VREDITORDERFIVE'); ?>:</span> <?php echo date($df.' '.$nowtf, $row['ritiro']); ?><br/>
			<span class="vrcordersp"><?php echo JText::_('VREDITORDERSIX'); ?>:</span> <?php echo date($df.' '.$nowtf, $row['consegna']); ?><br/>
			<?php if(!empty($row['idplace'])){ ?>
			<span class="vrcordersp"><?php echo JText::_('VRRITIROCAR'); ?>:</span> <?php echo vikrentcar::getPlaceName($row['idplace']); ?><br/>
			<?php } ?>
			<?php if(!empty($row['idreturnplace'])){ ?>
			<span class="vrcordersp"><?php echo JText::_('VRRETURNCARORD'); ?>:</span> <?php echo vikrentcar::getPlaceName($row['idreturnplace']); ?><br/>
			<?php } ?>
			<span class="vrcordersp"><?php echo JText::_('VRCDRIVERNOMINATIVE'); ?>:</span> <span id="vrc-nominativefield" data-vrcnominative="<?php echo $row['nominative']; ?>" style="cursor: pointer;"><?php echo !empty($row['nominative']) ? $row['nominative'] : '-----'; ?></span><br/>
		</div>
		<script>
		jQuery(document).ready(function(){
			jQuery("#vrc-nominativefield").click(function() {
				if(!jQuery(this).find("input").length) {
					jQuery(this).html("<input type='text' name='nominative' size='14' value='"+jQuery(this).attr("data-vrcnominative")+"'/>");
				}
			});
		});
		</script>
		</td>
		<?php 
		if(!empty($row['idtar']) || $is_cust_cost) {
			?>
			<td valign="top" style="padding-left: 30px;">
			<?php
			//vikrentcar 1.6
			if($checkhourscharges > 0 && $aehourschbasp == true && !$is_cust_cost) {
				$ret = vikrentcar::applyExtraHoursChargesCar($tar, $row['idcar'], $checkhourscharges, $daysdiff, false, true, true);
				$tar = $ret['return'];
				$calcdays = $ret['days'];
			}
			if($checkhourscharges > 0 && $aehourschbasp == false && !$is_cust_cost) {
				$tar = vikrentcar::extraHoursSetPreviousFareCar($tar, $row['idcar'], $checkhourscharges, $daysdiff, true);
				$tar = vikrentcar::applySeasonsCar($tar, $row['ritiro'], $row['consegna'], $row['idplace']);
				$ret = vikrentcar::applyExtraHoursChargesCar($tar, $row['idcar'], $checkhourscharges, $daysdiff, true, true, true);
				$tar = $ret['return'];
				$calcdays = $ret['days'];
			}else {
				if(!$is_cust_cost) {
					//Seasonal prices only if not a custom rate
					$tar = vikrentcar::applySeasonsCar($tar, $row['ritiro'], $row['consegna'], $row['idplace']);
				}
			}
			//
			$car_base_cost = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $row);
			$isdue = $car_base_cost;
			?>
			<div class="vrcordcarinfo">
			<p class="vrcorderpar"><?php echo JText::_('VREDITORDERSEVEN'); ?>:</p>
			&nbsp; <?php echo $is_cust_cost ? JText::_('VRCRENTCUSTRATEPLAN') : vikrentcar::getPriceName($tar[0]['idprice']); ?>: <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($car_base_cost); ?><br/>
			<?php 
			echo (!empty($tar[0]['attrdata']) ? "&nbsp; ".vikrentcar::getPriceAttr($tar[0]['idprice']).": ".$tar[0]['attrdata']."<br/>" : ""); 
			if (!empty($row['optionals'])) {
				?>
				<p class="vrcorderpar"><?php echo JText::_('VREDITORDEREIGHT'); ?>:</p>
				<?php 
				$stepo=explode(";", $row['optionals']);
				foreach($stepo as $oo){
					if (!empty($oo)) {
						$stept=explode(":", $oo);
						$q="SELECT * FROM `#__vikrentcar_optionals` WHERE `id`='".$stept[0]."';";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() == 1) {
							$actopt = $dbo->loadAssocList();
							$realcost=(intval($actopt[0]['perday'])==1 ? ($actopt[0]['cost'] * $row['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
							if($actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
								$realcost=$actopt[0]['maxprice'];
								if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
									$realcost = $actopt[0]['maxprice'] * $stept[1];
								}
							}
							$tmpopr=vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva'], $row);
							$isdue+=$tmpopr;
							echo "&nbsp; ".($stept[1] > 1 ? $stept[1]." " : "").$actopt[0]['name'].": ".$currencyname." ".vikrentcar::numberFormat($tmpopr)."<br/>\n";
						}
					}
				}
			}
			if(!empty($row['idplace']) && !empty($row['idreturnplace'])) {
				$locfee=vikrentcar::getLocFee($row['idplace'], $row['idreturnplace']);
				if($locfee) {
					//VikRentCar 1.7 - Location fees overrides
					if (strlen($locfee['losoverride']) > 0) {
						$arrvaloverrides = array();
						$valovrparts = explode('_', $locfee['losoverride']);
						foreach($valovrparts as $valovr) {
							if (!empty($valovr)) {
								$ovrinfo = explode(':', $valovr);
								$arrvaloverrides[$ovrinfo[0]] = $ovrinfo[1];
							}
						}
						if (array_key_exists($row['days'], $arrvaloverrides)) {
							$locfee['cost'] = $arrvaloverrides[$row['days']];
						}
					}
					//end VikRentCar 1.7 - Location fees overrides
					$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $row['days']) : $locfee['cost'];
					$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $row);
					$isdue+=$locfeewith;
					?>
					<br/><span class="vrcordersp"><?php echo JText::_('VREDITORDERTEN'); ?>:</span> <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($locfeewith); ?><br/>
					<?php
				}
			}
			//VRC 1.9 - Out of Hours Fees
			$oohfee = vikrentcar::getOutOfHoursFees($row['idplace'], $row['idreturnplace'], $row['ritiro'], $row['consegna'], array('id' => $row['idcar']));
			if(count($oohfee) > 0) {
				$oohfeewith=vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
				$isdue+=$oohfeewith;
				?>
				<br/><span class="vrcordersp"><?php echo JText::_('VRCOOHFEEAMOUNT'); ?>:</span> <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($oohfeewith); ?><br/>
				<?php
			}
			//
			//custom extra costs
			if(!empty($row['extracosts'])) {
				?>
				<p class="vrcorderpar"><?php echo JText::_('VRPEDITBUSYEXTRACOSTS'); ?>:</p>
				<?php
				$cur_extra_costs = json_decode($row['extracosts'], true);
				foreach ($cur_extra_costs as $eck => $ecv) {
					$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $row);
					$isdue+=$efee_cost;
					echo "&nbsp; ".$ecv['name'].": ".$currencyname." ".vikrentcar::numberFormat($efee_cost)."<br/>\n";
				}
			}
			//
			?>
			</div>
			<?php
			//vikrentcar 1.6 coupon
			$usedcoupon = false;
			$origisdue = $isdue;
			if(strlen($row['coupon']) > 0) {
				$usedcoupon = true;
				$expcoupon = explode(";", $row['coupon']);
				$isdue = $isdue - $expcoupon[1];
				?>
				<br/><span class="vrcordersp"><?php echo JText::_('VRCCOUPON').' '.$expcoupon[2]; ?>:</span> - <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($expcoupon[1]); ?><br/>
				<?php
			}
			//
			?>
			<div class="vrcorderpartot">
			<?php echo JText::_('VREDITORDERNINE'); ?>: <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($row['order_total']); ?>
			<span class="vrcapplydiscsp" onclick="toggleDiscount();"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/down.png" title="<?php echo JText::_('VRCAPPLYDISCOUNT'); ?>"/></span>
			<div class="vrcdiscenter" id="vrcdiscenter" style="display: none;">
				<div class="vrcdiscenter-entry">
					<span class="vrcdiscenter-label"><?php echo JText::_('VRCAPPLYDISCOUNT'); ?>:</span><span class="vrcdiscenter-value"><?php echo $currencyname; ?> <input type="text" name="admindisc" value="" size="4" placeholder="0.00"/></span>
				</div>
				<div class="vrcdiscenter-entrycentered">
					<input type="submit" name="submdisc" value="<?php echo JText::_('VRCAPPLYDISCOUNTSAVE'); ?>"/>
				</div>
			</div>
			</div>
			
			<?php
			$chpayment = '';
			if(is_array($payments)) {
				$chpayment = '<div style="display: block;"><select name="newpayment" id="newpayment" onchange="changePayment();"><option value="">'.JText::_('VRCCHANGEPAYLABEL').'</option>';
				foreach($payments as $pay) {
					$chpayment .= '<option value="'.$pay['id'].'">'.(is_array($payment) && $payment['id'] == $pay['id'] ? ' ::' : '').$pay['name'].'</option>';
				}
				$chpayment .= '</select></div>';
			}
			?>
			<span class="vrcordersp"><?php echo JText::_('VRPAYMENTMETHOD'); ?>:</span> 
			<?php
			if(@is_array($payment)) {
				echo $payment['name'];
			}
			echo $chpayment;
			?>
			
			</td>
		<?php
		}
		?>
		</tr></table>
		</td></tr>
		<tr><td>
			<button type="button" class="btn btn-primary" onclick="javascript: vrcToggleNotes();"><i class="icon-comment"></i> <?php echo JText::_('VRCTOGGLEORDNOTES'); ?></button>
		<?php
		if(!empty($row['paymentlog'])) {
			?>
			&nbsp;&nbsp;&nbsp;
			<a name="paymentlog" href="javascript: void(0);"></a>
			<button type="button" class="btn btn-primary" onclick="javascript: vrcToggleLog();"><i class="icon-key"></i> <?php echo JText::_('VRCPAYMENTLOGTOGGLE'); ?></button>
			<div id="vrcpaymentlogdiv" style="display: none;"><pre style="min-height: 100%;"><?php echo htmlentities($row['paymentlog']); ?></pre></div>
			<script type="text/javascript">
			if(window.location.hash == '#paymentlog') {
				document.getElementById('vrcpaymentlogdiv').style.display = 'block';
			}
			</script>
			<?php
		}
		?>
			<div id="vrcadminnotesdiv" style="display: none;">
				<textarea name="adminnotes" class="vrcadminnotestarea"><?php echo strip_tags($row['adminnotes']); ?></textarea>
				<br clear="all">
				<input name="updadmnotes" value="<?php echo JText::_('VRCUPDATEBTN'); ?>" class="btn" type="submit">
			</div>
		</td></tr>
		</table>
		<input type="hidden" name="task" value="editorder"/>
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>"/>
		<input type="hidden" name="cid[]" value="<?php echo $row['id']; ?>"/>
		<input type="hidden" name="option" value="<?php echo $option; ?>"/>
		</form>
		<?php
	}

	public static function pEditOldOrder ($row, $option) {
		$currencyname=vikrentcar::getCurrencyName();
		$car=vikrentcar::getCarInfo($row['idcar']);
		$dbo = JFactory::getDBO();
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="100%">
		&bull; <b><?php echo JText::_('VREDITORDERONE'); ?></b>: <?php echo date($df.' '.$nowtf, $row['ts']); ?><br/>
		&bull; <b><?php echo JText::_('VRSTATUS'); ?></b>: <?php echo ($row['status']=="confirmed" ? "<p class=\"successmade\">".JText::_('VRCONFIRMED')."</p>" : "<p class=\"warn\">".($row['status'] == 'standby' ? JText::_('VRSTANDBY') : JText::_('VRCANCELLED'))."</p>"); ?>
		</td></tr>
		<tr><td width="100%">
		<table><tr><td valign="top">
		<?php if(!empty($row['custdata'])){ ?>
		&bull; <b><?php echo JText::_('VREDITORDERTWO'); ?></b>:<br/>
		<?php echo str_replace("\n", "<br/>", $row['custdata']); } ?><br/>
		&bull; <b><?php echo JText::_('VREDITORDERTHREE'); ?></b>: <?php echo $car['name']; ?><br/>
		&bull; <b><?php echo JText::_('VREDITORDERFOUR'); ?></b>: <?php echo $row['days']; ?><br/>
		&bull; <b><?php echo JText::_('VREDITORDERFIVE'); ?></b>: <?php echo date($df.' '.$nowtf, $row['ritiro']); ?><br/>
		&bull; <b><?php echo JText::_('VREDITORDERSIX'); ?></b>: <?php echo date($df.' '.$nowtf, $row['consegna']); ?><br/>
		</td>
		<?php 
		if(!empty($row['idtar'])){
			?>
			<td valign="top">
			<?php
			if($row['hourly'] == 1) {
				$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$row['idtar']."';";
			}else {
				$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
			}
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() == 1) {
				$tar=$dbo->loadAssocList();
				if($row['hourly'] == 1) {
					foreach($tar as $kt => $kv) {
						$tar[$kt]['days'] = 1;
					}
				}
				//vikrentcar 1.6
				$checkhourscharges = 0;
				$hoursdiff = 0;
				$ppickup = $row['ritiro'];
				$prelease = $row['consegna'];
				$secdiff = $prelease - $ppickup;
				$daysdiff = $secdiff / 86400;
				if (is_int($daysdiff)) {
					if ($daysdiff < 1) {
						$daysdiff = 1;
					}
				}else {
					if ($daysdiff < 1) {
						$daysdiff = 1;
						$checkhourly = true;
						$ophours = $secdiff / 3600;
						$hoursdiff = intval(round($ophours));
						if($hoursdiff < 1) {
							$hoursdiff = 1;
						}
					}else {
						$sum = floor($daysdiff) * 86400;
						$newdiff = $secdiff - $sum;
						$maxhmore = vikrentcar::getHoursMoreRb() * 3600;
						if ($maxhmore >= $newdiff) {
							$daysdiff = floor($daysdiff);
						}else {
							$daysdiff = ceil($daysdiff);
							//vikrentcar 1.6
							$ehours = intval(round(($newdiff - $maxhmore) / 3600));
							$checkhourscharges = $ehours;
							if($checkhourscharges > 0) {
								$aehourschbasp = vikrentcar::applyExtraHoursChargesBasp();
							}
							//
						}
					}
				}
				//
			}else {
				if($row['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$row['idtar']."';";
					$dbo->setQuery($q);
					$dbo->execute();
					$tar=$dbo->loadAssocList();
				}
			}
			//vikrentcar 1.6
			if($checkhourscharges > 0 && $aehourschbasp == true) {
				$ret = vikrentcar::applyExtraHoursChargesCar($tar, $row['idcar'], $checkhourscharges, $daysdiff, false, true, true);
				$tar = $ret['return'];
				$calcdays = $ret['days'];
			}
			if($checkhourscharges > 0 && $aehourschbasp == false) {
				$tar = vikrentcar::extraHoursSetPreviousFareCar($tar, $row['idcar'], $checkhourscharges, $daysdiff, true);
				$tar = vikrentcar::applySeasonsCar($tar, $row['ritiro'], $row['consegna'], $row['idplace']);
				$ret = vikrentcar::applyExtraHoursChargesCar($tar, $row['idcar'], $checkhourscharges, $daysdiff, true, true, true);
				$tar = $ret['return'];
				$calcdays = $ret['days'];
			}else {
				$tar = vikrentcar::applySeasonsCar($tar, $row['ritiro'], $row['consegna'], $row['idplace']);
			}
			//
			$isdue=vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice']);
			?>
			&bull; <b><u><?php echo JText::_('VREDITORDERSEVEN'); ?></u>:</b><br/>
			&bull; <b><?php echo vikrentcar::getPriceName($tar[0]['idprice']); ?>: <?php echo $currencyname; ?> <?php echo vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice']); ?></b><br/>
			<?php 
			echo (!empty($tar[0]['attrdata']) ? "&bull; <b>".vikrentcar::getPriceAttr($tar[0]['idprice']).": ".$tar[0]['attrdata']."</b><br/>" : ""); 
			if (!empty($row['optionals'])) {
				?>
				<br/>&bull; <b><u><?php echo JText::_('VREDITORDEREIGHT'); ?></u>:</b><br/>
				<?php 
				$stepo=explode(";", $row['optionals']);
				foreach($stepo as $oo){
					if (!empty($oo)) {
						$stept=explode(":", $oo);
						$q="SELECT * FROM `#__vikrentcar_optionals` WHERE `id`='".$stept[0]."';";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() == 1) {
							$actopt = $dbo->loadAssocList();
							$realcost=(intval($actopt[0]['perday'])==1 ? ($actopt[0]['cost'] * $row['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
							if($actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
								$realcost=$actopt[0]['maxprice'];
								if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
									$realcost = $actopt[0]['maxprice'] * $stept[1];
								}
							}
							$tmpopr=vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva']);
							$isdue+=$tmpopr;
							echo "&bull; <b>".($stept[1] > 1 ? $stept[1]." " : "").$actopt[0]['name'].": ".$currencyname." ".$tmpopr."</b><br/>\n";
						}
					}
				}
			}
			if(!empty($row['idplace']) && !empty($row['idreturnplace'])) {
				$locfee=vikrentcar::getLocFee($row['idplace'], $row['idreturnplace']);
				if($locfee) {
					//VikRentCar 1.7 - Location fees overrides
					if (strlen($locfee['losoverride']) > 0) {
						$arrvaloverrides = array();
						$valovrparts = explode('_', $locfee['losoverride']);
						foreach($valovrparts as $valovr) {
							if (!empty($valovr)) {
								$ovrinfo = explode(':', $valovr);
								$arrvaloverrides[$ovrinfo[0]] = $ovrinfo[1];
							}
						}
						if (array_key_exists($row['days'], $arrvaloverrides)) {
							$locfee['cost'] = $arrvaloverrides[$row['days']];
						}
					}
					//end VikRentCar 1.7 - Location fees overrides
					$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $row['days']) : $locfee['cost'];
					$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva']);
					$isdue+=$locfeewith;
					?>
					<br/>&bull; <b><u><?php echo JText::_('VREDITORDERTEN'); ?></u>: <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($locfeewith); ?></b><br/>
					<?php
				}
			}
			//VRC 1.9 - Out of Hours Fees
			$oohfee = vikrentcar::getOutOfHoursFees($row['idplace'], $row['idreturnplace'], $row['ritiro'], $row['consegna'], array('id' => $row['idcar']));
			if(count($oohfee) > 0) {
				$oohfeewith=vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
				$isdue+=$oohfeewith;
				?>
				<br/><span class="vrcordersp"><?php echo JText::_('VRCOOHFEEAMOUNT'); ?>:</span> <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($oohfeewith); ?><br/>
				<?php
			}
			//
			//vikrentcar 1.6 coupon
			$usedcoupon = false;
			$origisdue = $isdue;
			if(strlen($row['coupon']) > 0) {
				$usedcoupon = true;
				$expcoupon = explode(";", $row['coupon']);
				$isdue = $isdue - $expcoupon[1];
				?>
				<br/>&bull; <b><?php echo JText::_('VRCCOUPON').' '.$expcoupon[2]; ?>: - <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($expcoupon[1]); ?></b><br/>
				<?php
			}
			//
			?>
			<br/>&bull; <b><u><?php echo JText::_('VREDITORDERNINE'); ?></u>: <?php echo $currencyname; ?> <?php echo vikrentcar::numberFormat($isdue); ?></b><br/>
			</td>
		<?php
		}
		?>	
		</tr></table>
		</td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewIva ($option) {
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWIVAONE'); ?>:</b> </td><td><input type="text" name="aliqname" value="" size="30"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWIVATWO'); ?>:</b> </td><td><input type="text" name="aliqperc" value="" size="10"/> %</td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditIva ($row, $option) {
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWIVAONE'); ?>:</b> </td><td><input type="text" name="aliqname" value="<?php echo $row['name']; ?>" size="30"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWIVATWO'); ?>:</b> </td><td><input type="text" name="aliqperc" value="<?php echo $row['aliq']; ?>" size="10"/> %</td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewPrice ($option) {
		$dbo = JFactory::getDBO();
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"praliq\">\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
			$wiva.="</select>\n";
		}else {
			$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('NESSUNAIVA')."</a>";
		}
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWPRICEONE'); ?><sup>*</sup> :</b> </td><td><input type="text" name="price" value="" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWPRICETWO'); ?>:</b> </td><td><input type="text" name="attr" value="" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWPRICETHREE'); ?><sup>*</sup> :</b> </td><td><?php echo $wiva; ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditPrice ($row, $option) {
		$dbo = JFactory::getDBO();
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"praliq\">\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\"".($iv['id']==$row['idiva'] ? " selected=\"selected\"" : "").">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
			$wiva.="</select>\n";
		}else {
			$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('NESSUNAIVA')."</a>";
		}
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWPRICEONE'); ?>:</b> </td><td><input type="text" name="price" value="<?php echo $row['name']; ?>" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWPRICETWO'); ?>:</b> </td><td><input type="text" name="attr" value="<?php echo $row['attr']; ?>" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWPRICETHREE'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewCat ($option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCATONE'); ?>:</b> </td><td><input type="text" name="catname" value="" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCATDESCR'); ?>:</b> </td><td><?php echo $editor->display( "descr", "", 400, 200, 70, 20 ); ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditCat ($row, $option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCATONE'); ?>:</b> </td><td><input type="text" name="catname" value="<?php echo $row['name']; ?>" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCATDESCR'); ?>:</b> </td><td><?php echo $editor->display( "descr", $row['descr'], 400, 200, 70, 20 ); ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewCarat ($option) {
		?>
		<script language="JavaScript" type="text/javascript">
		function showResizeSel() {
			if(document.adminForm.autoresize.checked == true) {
				document.getElementById('resizesel').style.display='block';
			}else {
				document.getElementById('resizesel').style.display='none';
			}
			return true;
		}
		</script>
		<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARATONE'); ?>:</b> </td><td><input type="text" name="caratname" value="" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARATTWO'); ?>:</b> </td><td><input type="file" name="caraticon" size="35"/><br/><label for="autoresize"><?php echo JText::_('VRNEWOPTNINE'); ?></label> <input type="checkbox" id="autoresize" name="autoresize" value="1" onclick="showResizeSel();"/> <span id="resizesel" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizeto" value="50" size="3"/> px</span></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARATTHREE'); ?>:</b> </td><td><input type="text" name="carattextimg" value="" size="40"/></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditCarat ($row, $option) {
		?>
		<script language="JavaScript" type="text/javascript">
		function showResizeSel() {
			if(document.adminForm.autoresize.checked == true) {
				document.getElementById('resizesel').style.display='block';
			}else {
				document.getElementById('resizesel').style.display='none';
			}
			return true;
		}
		</script>
		<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARATONE'); ?>:</b> </td><td><input type="text" name="caratname" value="<?php echo $row['name']; ?>" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARATTWO'); ?>:</b> </td><td><?php echo (!empty($row['icon']) && file_exists('./components/com_vikrentcar/resources/'.$row['icon']) ? "<img src=\"./components/com_vikrentcar/resources/".$row['icon']."\"/>&nbsp; " : ""); ?><input type="file" name="caraticon" size="35"/><br/><label for="autoresize"><?php echo JText::_('VRNEWOPTNINE'); ?></label> <input type="checkbox" id="autoresize" name="autoresize" value="1" onclick="showResizeSel();"/> <span id="resizesel" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizeto" value="50" size="3"/> px</span></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARATTHREE'); ?>:</b> </td><td><input type="text" name="carattextimg" value="<?php echo $row['textimg']; ?>" size="40"/></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewOptionals ($option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$dbo = JFactory::getDBO();
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"optaliq\"><option value=\"\"> </option>\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
			$wiva.="</select>\n";
		}else {
			$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('VRNOIVAFOUND')."</a>";
		}
		$currencysymb=vikrentcar::getCurrencySymb(true);
		?>
		<script language="JavaScript" type="text/javascript">
		function showResizeSel() {
			if(document.adminForm.autoresize.checked == true) {
				document.getElementById('resizesel').style.display='block';
			}else {
				document.getElementById('resizesel').style.display='none';
			}
			return true;
		}
		function showForceSel() {
			if(document.adminForm.forcesel.checked == true) {
				document.getElementById('forcevalspan').style.display='block';
			}else {
				document.getElementById('forcevalspan').style.display='none';
			}
			return true;
		}
		</script>
  
		<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTONE'); ?>:</b> </td><td><input type="text" name="optname" value="" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTTWO'); ?>:</b> </td><td><?php echo $editor->display( "optdescr", "", 400, 200, 70, 20 ); ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTTHREE'); ?>:</b> </td><td><?php echo $currencysymb; ?> <input type="text" name="optcost" value="" size="10"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTFOUR'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTFIVE'); ?>:</b> </td><td><input type="checkbox" name="optperday" value="each"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTEIGHT'); ?>:</b> </td><td><?php echo $currencysymb; ?> <input type="text" name="maxprice" value="" size="4"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTSIX'); ?>:</b> </td><td><input type="checkbox" name="opthmany" value="yes"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWOPTFORCEVALIFDAYS'); ?>:</b> </td><td><input type="text" name="forceifdays" value="0" size="2"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTSEVEN'); ?>:</b> </td><td><input type="file" name="optimg" size="35"/><br/><label for="autoresize"><?php echo JText::_('VRNEWOPTNINE'); ?></label> <input type="checkbox" id="autoresize" name="autoresize" value="1" onclick="showResizeSel();"/> <span id="resizesel" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizeto" value="50" size="3"/> px</span></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRCNEWOPTFORCESEL'); ?>:</b> </td><td><input type="checkbox" name="forcesel" value="1" onclick="showForceSel();"/> <span id="forcevalspan" style="display: none;"><?php echo JText::_('VRCNEWOPTFORCEVALT'); ?> <input type="text" name="forceval" value="1" size="2"/><br/><?php echo JText::_('VRCNEWOPTFORCEVALTPDAY'); ?> <input type="checkbox" name="forcevalperday" value="1"/></span></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditOptional ($row, $option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$dbo = JFactory::getDBO();
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"optaliq\"><option value=\"\"> </option>\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\"".($row['idiva']==$iv['id'] ? " selected=\"selected\"" : "").">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
			$wiva.="</select>\n";
		}else {
			$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('VRNOIVAFOUND')."</a>";
		}
		$currencysymb=vikrentcar::getCurrencySymb(true);
		//vikrentcar 1.6
		if(strlen($row['forceval']) > 0) {
			$forceparts = explode("-", $row['forceval']);
			$forcedq = $forceparts[0];
			$forcedqperday = intval($forceparts[1]) == 1 ? true : false;
		}else {
			$forcedq = "1";
			$forcedqperday = false;
		}
		//
		?>
		<script language="JavaScript" type="text/javascript">
		function showResizeSel() {
			if(document.adminForm.autoresize.checked == true) {
				document.getElementById('resizesel').style.display='block';
			}else {
				document.getElementById('resizesel').style.display='none';
			}
			return true;
		}
		function showForceSel() {
			if(document.adminForm.forcesel.checked == true) {
				document.getElementById('forcevalspan').style.display='block';
			}else {
				document.getElementById('forcevalspan').style.display='none';
			}
			return true;
		}
		</script>
		
		<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTONE'); ?>:</b> </td><td><input type="text" name="optname" value="<?php echo $row['name']; ?>" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTTWO'); ?>:</b> </td><td><?php echo $editor->display( "optdescr", $row['descr'], 400, 200, 70, 20 ); ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTTHREE'); ?>:</b> </td><td><?php echo $currencysymb; ?> <input type="text" name="optcost" value="<?php echo $row['cost']; ?>" size="10"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTFOUR'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTFIVE'); ?>:</b> </td><td><input type="checkbox" name="optperday" value="each"<?php echo (intval($row['perday'])==1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTEIGHT'); ?>:</b> </td><td><?php echo $currencysymb; ?> <input type="text" name="maxprice" value="<?php echo $row['maxprice']; ?>" size="4"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTSIX'); ?>:</b> </td><td><input type="checkbox" name="opthmany" value="yes"<?php echo (intval($row['hmany'])==1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCNEWOPTFORCEVALIFDAYS'); ?>:</b> </td><td><input type="text" name="forceifdays" value="<?php echo $row['forceifdays']; ?>" size="2"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWOPTSEVEN'); ?>:</b> </td><td><?php echo (!empty($row['img']) && file_exists('./components/com_vikrentcar/resources/'.$row['img']) ? "<img src=\"./components/com_vikrentcar/resources/".$row['img']."\" class=\"maxfifty\"/> &nbsp;" : ""); ?><input type="file" name="optimg" size="35"/><br/><label for="autoresize"><?php echo JText::_('VRNEWOPTNINE'); ?></label> <input type="checkbox" id="autoresize" name="autoresize" value="1" onclick="showResizeSel();"/> <span id="resizesel" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizeto" value="50" size="3"/> px</span></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRCNEWOPTFORCESEL'); ?>:</b> </td><td><input type="checkbox" name="forcesel" value="1" onclick="showForceSel();"<?php echo (intval($row['forcesel'])==1 ? " checked=\"checked\"" : ""); ?>/> <span id="forcevalspan" style="display: <?php echo (intval($row['forcesel'])==1 ? "block" : "none"); ?>;"><?php echo JText::_('VRCNEWOPTFORCEVALT'); ?> <input type="text" name="forceval" value="<?php echo $forcedq; ?>" size="2"/><br/><?php echo JText::_('VRCNEWOPTFORCEVALTPDAY'); ?> <input type="checkbox" name="forcevalperday" value="1"<?php echo ($forcedqperday == true ? " checked=\"checked\"" : ""); ?>/></span></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pNewCar ($cats, $carats, $optionals, $places, $option) {
		JHTML::_('behavior.tooltip');
		$currencysymb=vikrentcar::getCurrencySymb(true);
		if (is_array($cats)) {
			$wcats="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARONE').":</b> </td><td>";
			$wcats.="<select name=\"ccat[]\" multiple=\"multiple\" size=\"".(count($cats) + 1)."\">";
			foreach($cats as $cat){
				$wcats.="<option value=\"".$cat['id']."\">".$cat['name']."</option>\n";
			}
			$wcats.="</select></td></tr>\n";
		}else {
			$wcats="";
		}
		if (is_array($places)) {
			$wplaces="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARTWO').":</b> </td><td>";
			$wretplaces="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARDROPLOC').":</b> </td><td>";
			$wplaces.="<select name=\"cplace[]\" id=\"cplace\" multiple=\"multiple\" size=\"".(count($places) + 1)."\" onchange=\"vrcSelDropLocation();\">";
			$wretplaces.="<select name=\"cretplace[]\" id=\"cretplace\" multiple=\"multiple\" size=\"".(count($places) + 1)."\">";
			foreach($places as $place){
				$wplaces.="<option value=\"".$place['id']."\">".$place['name']."</option>\n";
				$wretplaces.="<option value=\"".$place['id']."\">".$place['name']."</option>\n";
			}
			$wplaces.="</select></td></tr>\n";
			$wretplaces.="</select></td></tr>\n";
		}else {
			$wplaces="";
			$wretplaces="";
		}
		if (is_array($carats)) {
			$wcarats="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARTHREE').":</b> </td><td>";
			$wcarats.="<table><tr><td valign=\"top\">";
			$nn=0;
			$jj=0;
			foreach($carats as $carat){
				$wcarats.="<input type=\"checkbox\" name=\"ccarat[]\" value=\"".$carat['id']."\"/> ".$carat['name']."<br/>\n";
				$nn++;
				if (($nn % 3) == 0) {
					$jj++;
					if (($jj % 3) == 0) {
						$wcarats.="</td></tr><td valign=\"top\">";
					}else {
						$wcarats.="</td><td valign=\"top\">\n";
					}
				}
			}
			$wcarats.="</td></tr></table>\n";
			$wcarats.="</td></tr>\n";
		}else {
			$wcarats="";
		}
		if (is_array($optionals)) {
			$woptionals="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARFOUR').":</b> </td><td>";
			$woptionals.="<table><tr><td valign=\"top\">";
			$nn=0;
			$jj=0;
			foreach($optionals as $optional){
				$woptionals.="<input type=\"checkbox\" name=\"coptional[]\" value=\"".$optional['id']."\"/> ".$optional['name']." ".$currencysymb."".$optional['cost']."<br/>\n";
				$nn++;
				if (($nn % 3) == 0) {
					$jj++;
					if (($jj % 3) == 0) {
						$woptionals.="</td></tr><td valign=\"top\">";
					}else {
						$woptionals.="</td><td valign=\"top\">\n";
					}
				}
			}
			$woptionals.="</td></tr></table>\n";
			$woptionals.="</td></tr>\n";
		}else {
			$woptionals="";
		}
		$car_params = array('sdailycost' => '', 'email' => '', 'custptitle' => '', 'custptitlew' => '', 'metakeywords' => '', 'metadescription' => '', 'shourlycal' => '');
		if(!array_key_exists('features', $car_params)) {
			$car_params['features'] = array();
		}
		if(!(count($car_params['features']) > 0)) {
			$car_params['features'][1] = vikrentcar::getDefaultDistinctiveFeatures();
		}
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		?>
		<script type="text/javascript">
		function showResizeSel() {
			if(document.adminForm.autoresize.checked == true) {
				document.getElementById('resizesel').style.display='block';
			}else {
				document.getElementById('resizesel').style.display='none';
			}
			return true;
		}
		function vrcSelDropLocation() {
			var picksel = document.getElementById('cplace');
			var dropsel = document.getElementById('cretplace');
			for(i = 0; i < picksel.length; i++) {
				if(picksel.options[i].selected == false) {
					if(dropsel.options[i].selected == true) {
						dropsel.options[i].selected = false;
					}
				}else {
					if(dropsel.options[i].selected == false) {
						dropsel.options[i].selected = true;
					}
				}
			}
		}
		function showResizeSelMore() {
			if(document.adminForm.autoresizemore.checked == true) {
				document.getElementById('resizeselmore').style.display='block';
			}else {
				document.getElementById('resizeselmore').style.display='none';
			}
			return true;
		}
		function addMoreImages() {
			var ni = document.getElementById('myDiv');
			var numi = document.getElementById('moreimagescounter');
			var num = (document.getElementById('moreimagescounter').value -1)+ 2;
			numi.value = num;
			var newdiv = document.createElement('div');
			var divIdName = 'my'+num+'Div';
			newdiv.setAttribute('id',divIdName);
			newdiv.innerHTML = '<input type=\'file\' name=\'cimgmore[]\' size=\'35\'/><br/>';
			ni.appendChild(newdiv);
		}
		jQuery.noConflict();
		var cur_units = 1;
		jQuery(document).ready(function() {
			jQuery('.vrc-features-btn').click(function() {
				jQuery(this).toggleClass('vrc-features-btn-active');
				jQuery('.vrc-distfeatures-block').fadeToggle();
			});
			jQuery('#vrc-units-inp').change(function() {
				var to_units = parseInt(jQuery(this).val());
				if(to_units > cur_units) {
					var diff_units = (to_units - cur_units);
					for (var i = 1; i <= diff_units; i++) {
						var unit_html = "<div class=\"vrc-cunit-features-cont\" id=\"cunit-features-"+(i + cur_units)+"\">"+
										"	<span class=\"vrc-cunit-num\"><?php echo addslashes(JText::_('VRCDISTFEATURECUNIT')); ?>"+(i + cur_units)+"</span>"+
										"	<div class=\"vrc-cunit-features\">"+
										"		<div class=\"vrc-cunit-feature\">"+
										"			<input type=\"text\" name=\"feature-name"+(i + cur_units)+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATURETXT'); ?>\"/>"+
										"			<input type=\"hidden\" name=\"feature-lang"+(i + cur_units)+"[]\" value=\"\"/>"+
										"			<input type=\"text\" name=\"feature-value"+(i + cur_units)+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATUREVAL'); ?>\"/>"+
										"			<span class=\"vrc-feature-remove\">&nbsp;</span>"+
										"		</div>"+
										"		<span class=\"vrc-feature-add\"><?php echo addslashes(JText::_('VRCDISTFEATUREADD')); ?></span>"+
										"	</div>"+
										"</div>";
						jQuery('.vrc-distfeatures-cont').append(unit_html);
					}
					cur_units = to_units;
				}else if(to_units < cur_units) {
					for (var i = cur_units; i > to_units; i--) {
						jQuery('#cunit-features-'+i).remove();
					}
					cur_units = to_units;
				}
			});
			jQuery(document.body).on('click', '.vrc-feature-add', function() {
				var cfeature_id = jQuery(this).parent('div').parent('div').attr('id').split('cunit-features-');
				if(cfeature_id[1].length) {
					jQuery(this).before("<div class=\"vrc-cunit-feature\">"+
										"	<input type=\"text\" name=\"feature-name"+cfeature_id[1]+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATURETXT'); ?>\"/>"+
										"	<input type=\"hidden\" name=\"feature-lang"+cfeature_id[1]+"[]\" value=\"\"/>"+
										"	<input type=\"text\" name=\"feature-value"+cfeature_id[1]+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATUREVAL'); ?>\"/>"+
										"	<span class=\"vrc-feature-remove\">&nbsp;</span>"+
										"</div>"
										);
				}
			});
			jQuery(document.body).on('click', '.vrc-feature-remove', function() {
				jQuery(this).parent('div').remove();
			});
		});
		</script>
		<input type="hidden" value="0" id="moreimagescounter" />
		
		<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARFIVE'); ?>:</b> </td><td><input type="text" name="cname" value="" size="40"/></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRNEWCARSIX'); ?>:</b> </td><td><input type="file" name="cimg" size="35"/><br/><label for="autoresize"><?php echo JText::_('VRNEWOPTNINE'); ?></label> <input type="checkbox" id="autoresize" name="autoresize" value="1" onclick="showResizeSel();"/> <span id="resizesel" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizeto" value="250" size="3"/> px</span></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRMOREIMAGES'); ?>:</b><br/>&nbsp;&nbsp;<a href="javascript: void(0);" onclick="addMoreImages();"><?php echo JText::_('VRADDIMAGES'); ?></a></td><td><input type="file" name="cimgmore[]" size="35"/><div id="myDiv" style="display: block;"></div><label for="autoresizemore"><?php echo JText::_('VRRESIZEIMAGES'); ?></label> <input type="checkbox" id="autoresizemore" name="autoresizemore" value="1" onclick="showResizeSelMore();"/> <span id="resizeselmore" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizetomore" value="600" size="3"/> px</span></td></tr>
		<?php echo $wcats; ?>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRCSHORTDESCRIPTIONCAR'); ?>:</b> </td><td><textarea name="short_info" rows="4" cols="60"></textarea></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRNEWCARSEVEN'); ?>:</b> </td><td><?php echo $editor->display( "cdescr", "", 400, 200, 70, 20 ); ?></td></tr>
		<?php echo $wplaces; ?>
		<?php echo $wretplaces; ?>
		<?php echo $wcarats; ?>
		<?php echo $woptionals; ?>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARNINE'); ?>:</b> </td><td><input type="number" min="1" name="units" id="vrc-units-inp" value="1" size="3" onfocus="this.select();"/><span class="vrc-features-btn"><?php echo JText::_('VRCDISTFEATURESMNG'); ?></span></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCUSTSTARTINGFROM'); ?>:</b> </td><td><input type="text" name="startfrom" value="" size="4"/> <?php echo $currencysymb; ?> &nbsp;&nbsp; <?php echo JHTML::tooltip(JText::_('VRCUSTSTARTINGFROMHELP'), JText::_('VRCUSTSTARTINGFROM'), 'tooltip.png', ''); ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCAREIGHT'); ?>:</b> </td><td><input type="checkbox" name="cavail" value="yes" checked="checked"/></td></tr>
		<tr><td valign="top">&bull; <b><?php echo JText::_('VRCPARAMSCAR'); ?>:</b> </td><td>
			<p class="vrccarparamp"><label for="sdailycost"><?php echo JText::_('VRCPARAMDAILYCOST'); ?></label> <input type="checkbox" id="sdailycost" name="sdailycost" value="1"/></p>
			<p class="vrccarparamp"><label for="shourlycal"><?php echo JText::_('VRCPARAMHOURLYCAL'); ?></label> <input type="checkbox" id="shourlycal" name="shourlycal" value="1"/></p>
			<p class="vrccarparamp"><label for="car_email"><?php echo JText::_('VRCPARAMCAREMAIL'); ?></label> <input type="text" id="car_email" name="email" value=""/> <span><?php echo JText::_('VRCPARAMCAREMAILHELP'); ?></span></p>
			<p class="vrccarparamp"><label for="custptitle"><?php echo JText::_('VRCPARAMPAGETITLE'); ?></label> <input type="text" id="custptitle" name="custptitle" value=""/> <span><select name="custptitlew"><option value="before"><?php echo JText::_('VRCPARAMPAGETITLEBEFORECUR'); ?></option><option value="after"><?php echo JText::_('VRCPARAMPAGETITLEAFTERCUR'); ?></option><option value="replace"><?php echo JText::_('VRCPARAMPAGETITLEREPLACECUR'); ?></option></select></span></p>
			<p class="vrccarparamp"><label for="metakeywords"><?php echo JText::_('VRCPARAMKEYWORDSMETATAG'); ?></label> <textarea name="metakeywords" id="metakeywords" rows="3" cols="40"></textarea></p>
			<p class="vrccarparamp"><label for="metadescription"><?php echo JText::_('VRCPARAMDESCRIPTIONMETATAG'); ?></label> <textarea name="metadescription" id="metadescription" rows="4" cols="40"></textarea></p>
			<p class="vrccarparamp"><label for="sefalias"><?php echo JText::_('VRCARSEFALIAS'); ?></label> <input type="text" id="sefalias" name="sefalias" value="" placeholder="city-car-group-a"/></p>
		</td></tr>
		</table>
		<div class="vrc-distfeatures-block">
			<div class="vrc-distfeatures-inner">
				<fieldset>
					<legend><?php echo JText::_('VRCDISTFEATURES'); ?></legend>
					<div class="vrc-distfeatures-cont">
					<?php
					for ($i=1; $i <= 1; $i++) {
					?>
						<div class="vrc-cunit-features-cont" id="cunit-features-<?php echo $i; ?>">
							<span class="vrc-cunit-num"><?php echo JText::_('VRCDISTFEATURECUNIT'); ?><?php echo $i; ?></span>
							<div class="vrc-cunit-features">
						<?php
						if(array_key_exists($i, $car_params['features'])) {
							foreach ($car_params['features'][$i] as $fkey => $fval) {
								?>
								<div class="vrc-cunit-feature">
									<input type="text" name="feature-name<?php echo $i; ?>[]" value="<?php echo JText::_($fkey); ?>" size="20"/>
									<input type="hidden" name="feature-lang<?php echo $i; ?>[]" value="<?php echo $fkey; ?>"/>
									<input type="text" name="feature-value<?php echo $i; ?>[]" value="<?php echo $fval; ?>" size="20"/>
									<span class="vrc-feature-remove">&nbsp;</span>
								</div>
								<?php
							}
						}
						?>
								<span class="vrc-feature-add"><?php echo JText::_('VRCDISTFEATUREADD'); ?></span>
							</div>
						</div>
					<?php
					}
					?>
					</div>
				</fieldset>
			</div>
		</div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditCar ($row, $cats, $carats, $optionals, $places, $option) {
		JHTML::_('behavior.tooltip');
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root().'components/com_vikrentcar/resources/jquery.fancybox.css');
		JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery.fancybox.js', false, true, false, false);
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$arrcats=array();
		$arrcarats=array();
		$arropts=array();
		$oldcats=explode(";", $row['idcat']);
		foreach($oldcats as $oc){
			if (!empty($oc)) {
				$arrcats[$oc]=$oc;
			}
		}
		$oldcarats=explode(";", $row['idcarat']);
		foreach($oldcarats as $ocr){
			if (!empty($ocr)) {
				$arrcarats[$ocr]=$ocr;
			}
		}
		$oldopts=explode(";", $row['idopt']);
		foreach($oldopts as $oopt){
			if (!empty($oopt)) {
				$arropts[$oopt]=$oopt;
			}
		}
		if (is_array($cats)) {
			$wcats="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARONE').":</b> </td><td>";
			$wcats.="<select name=\"ccat[]\" multiple=\"multiple\" size=\"".(count($cats) + 1)."\">";
			foreach($cats as $cat){
				$wcats.="<option value=\"".$cat['id']."\"".(array_key_exists($cat['id'], $arrcats) ? " selected=\"selected\"" : "").">".$cat['name']."</option>\n";
			}
			$wcats.="</select></td></tr>\n";
		}else {
			$wcats="";
		}
		if (is_array($places)) {
			$wplaces="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARTWO').":</b> </td><td>";
			$wretplaces="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARDROPLOC').":</b> </td><td>";
			$wplaces.="<select name=\"cplace[]\" id=\"cplace\" multiple=\"multiple\" size=\"".(count($places) + 1)."\" onchange=\"vrcSelDropLocation();\">";
			$wretplaces.="<select name=\"cretplace[]\" id=\"cretplace\" multiple=\"multiple\" size=\"".(count($places) + 1)."\">";
			$actplac=explode(";", $row['idplace']);
			$actretplac=explode(";", $row['idretplace']);
			foreach($places as $place){
				$wplaces.="<option value=\"".$place['id']."\"".(in_array($place['id'], $actplac) ? " selected=\"selected\"" : "").">".$place['name']."</option>\n";
				$wretplaces.="<option value=\"".$place['id']."\"".(in_array($place['id'], $actretplac) ? " selected=\"selected\"" : "").">".$place['name']."</option>\n";
			}
			$wplaces.="</select></td></tr>\n";
			$wretplaces.="</select></td></tr>\n";
		}else {
			$wplaces="";
			$wretplaces="";
		}
		if (is_array($carats)) {
			$wcarats="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARTHREE').":</b> </td><td>";
			$wcarats.="<table><tr><td valign=\"top\">";
			$nn=0;
			$jj=0;
			foreach($carats as $carat){
				$wcarats.="<input type=\"checkbox\" name=\"ccarat[]\" value=\"".$carat['id']."\"".(array_key_exists($carat['id'], $arrcarats) ? " checked=\"checked\"" : "")."/> ".$carat['name']."<br/>\n";
				$nn++;
				if (($nn % 3) == 0) {
					$jj++;
					if (($jj % 3) == 0) {
						$wcarats.="</td></tr><td valign=\"top\">";
					}else {
						$wcarats.="</td><td valign=\"top\">\n";
					}
				}
			}
			$wcarats.="</td></tr></table>\n";
			$wcarats.="</td></tr>\n";
		}else {
			$wcarats="";
		}
		if (is_array($optionals)) {
			$woptionals="<tr><td width=\"200\">&bull; <b>".JText::_('VRNEWCARFOUR').":</b> </td><td>";
			$woptionals.="<table><tr><td valign=\"top\">";
			$nn=0;
			$jj=0;
			foreach($optionals as $optional){
				$woptionals.="<input type=\"checkbox\" name=\"coptional[]\" value=\"".$optional['id']."\"".(array_key_exists($optional['id'], $arropts) ? " checked=\"checked\"" : "")."/> ".$optional['name']." ".$currencysymb."".$optional['cost']."<br/>\n";
				$nn++;
				if (($nn % 3) == 0) {
					$jj++;
					if (($jj % 3) == 0) {
						$woptionals.="</td></tr><td valign=\"top\">";
					}else {
						$woptionals.="</td><td valign=\"top\">\n";
					}
				}
			}
			$woptionals.="</td></tr></table>\n";
			$woptionals.="</td></tr>\n";
		}else {
			$woptionals="";
		}
		//more images
		$morei=explode(';;', $row['moreimgs']);
		$actmoreimgs="";
		if(@count($morei) > 0) {
			$notemptymoreim=false;
			foreach($morei as $ki => $mi) {
				if(!empty($mi)) {
					$notemptymoreim=true;
					$actmoreimgs.='<div style="float: left; margin-right: 5px;">';
					$actmoreimgs.='<img src="./components/com_vikrentcar/resources/thumb_'.$mi.'" class="maxfifty"/>';
					$actmoreimgs.='<a style="margin-left: -20px;width: 30px;z-index: 100;" href="index.php?option=com_vikrentcar&task=removemoreimgs&carid='.$row['id'].'&imgind='.$ki.'"><img src="./components/com_vikrentcar/resources/images/remove.png" style="border: 0;"/></a>';
					$actmoreimgs.='</div>';
				}
			}
			if($notemptymoreim) {
				$actmoreimgs.='<br clear="all"/>';
			}
		}
		//end more images
		$car_params = !empty($row['params']) ? json_decode($row['params'], true) : array('sdailycost' => '', 'email' => '', 'custptitle' => '', 'custptitlew' => '', 'metakeywords' => '', 'metadescription' => '', 'shourlycal' => '');
		if(!array_key_exists('features', $car_params)) {
			$car_params['features'] = array();
		}
		if(!array_key_exists('damages', $car_params)) {
			$car_params['damages'] = array();
			for ($i=1; $i <= $row['units']; $i++) {
				$car_params['damages'][$i] = array();
			}
		}
		if(!(count($car_params['features']) > 0)) {
			$default_features = vikrentcar::getDefaultDistinctiveFeatures();
			for ($i=1; $i <= $row['units']; $i++) {
				$car_params['features'][$i] = $default_features;
			}
		}
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		?>
		<script type="text/javascript">
		function showResizeSel() {
			if(document.adminForm.autoresize.checked == true) {
				document.getElementById('resizesel').style.display='block';
			}else {
				document.getElementById('resizesel').style.display='none';
			}
			return true;
		}
		function vrcSelDropLocation() {
			var picksel = document.getElementById('cplace');
			var dropsel = document.getElementById('cretplace');
			for(i = 0; i < picksel.length; i++) {
				if(picksel.options[i].selected == false) {
					if(dropsel.options[i].selected == true) {
						dropsel.options[i].selected = false;
					}
				}else {
					if(dropsel.options[i].selected == false) {
						dropsel.options[i].selected = true;
					}
				}
			}
		}
		function showResizeSelMore() {
			if(document.adminForm.autoresizemore.checked == true) {
				document.getElementById('resizeselmore').style.display='block';
			}else {
				document.getElementById('resizeselmore').style.display='none';
			}
			return true;
		}
		function addMoreImages() {
			var ni = document.getElementById('myDiv');
			var numi = document.getElementById('moreimagescounter');
			var num = (document.getElementById('moreimagescounter').value -1)+ 2;
			numi.value = num;
			var newdiv = document.createElement('div');
			var divIdName = 'my'+num+'Div';
			newdiv.setAttribute('id',divIdName);
			newdiv.innerHTML = '<input type=\'file\' name=\'cimgmore[]\' size=\'35\'/><br/>';
			ni.appendChild(newdiv);
		}
		jQuery.noConflict();
		var cur_units = <?php echo $row['units']; ?>;
		jQuery(document).ready(function() {
			jQuery('.vrc-features-btn').click(function() {
				jQuery(this).toggleClass('vrc-features-btn-active');
				jQuery('.vrc-distfeatures-block').fadeToggle();
			});
			jQuery('#vrc-units-inp').change(function() {
				var to_units = parseInt(jQuery(this).val());
				if(to_units > cur_units) {
					var diff_units = (to_units - cur_units);
					for (var i = 1; i <= diff_units; i++) {
						var unit_html = "<div class=\"vrc-cunit-features-cont\" id=\"cunit-features-"+(i + cur_units)+"\">"+
										"	<span class=\"vrc-cunit-num\"><?php echo addslashes(JText::_('VRCDISTFEATURECUNIT')); ?>"+(i + cur_units)+"</span>"+
										"	<div class=\"vrc-cunit-features\">"+
										"		<div class=\"vrc-cunit-feature\">"+
										"			<input type=\"text\" name=\"feature-name"+(i + cur_units)+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATURETXT'); ?>\"/>"+
										"			<input type=\"hidden\" name=\"feature-lang"+(i + cur_units)+"[]\" value=\"\"/>"+
										"			<input type=\"text\" name=\"feature-value"+(i + cur_units)+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATUREVAL'); ?>\"/>"+
										"			<span class=\"vrc-feature-remove\">&nbsp;</span>"+
										"		</div>"+
										"		<span class=\"vrc-feature-add\"><?php echo addslashes(JText::_('VRCDISTFEATUREADD')); ?></span>"+
										"	</div>"+
										"</div>";
						jQuery('.vrc-distfeatures-cont').append(unit_html);
					}
					cur_units = to_units;
				}else if(to_units < cur_units) {
					for (var i = cur_units; i > to_units; i--) {
						jQuery('#cunit-features-'+i).remove();
					}
					cur_units = to_units;
				}
			});
			jQuery(document.body).on('click', '.vrc-feature-add', function() {
				var cfeature_id = jQuery(this).parent('div').parent('div').attr('id').split('cunit-features-');
				if(cfeature_id[1].length) {
					jQuery(this).before("<div class=\"vrc-cunit-feature\">"+
										"	<input type=\"text\" name=\"feature-name"+cfeature_id[1]+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATURETXT'); ?>\"/>"+
										"	<input type=\"hidden\" name=\"feature-lang"+cfeature_id[1]+"[]\" value=\"\"/>"+
										"	<input type=\"text\" name=\"feature-value"+cfeature_id[1]+"[]\" value=\"\" size=\"20\" placeholder=\"<?php echo JText::_('VRCDISTFEATUREVAL'); ?>\"/>"+
										"	<span class=\"vrc-feature-remove\">&nbsp;</span>"+
										"</div>"
										);
				}
			});
			jQuery(document.body).on('click', '.vrc-feature-remove', function() {
				jQuery(this).parent('div').remove();
			});
			jQuery(document.body).on('click', '.vrc-open-damages', function() {
				var cunit_id = jQuery(this).parent('div').attr('id').split('cunit-features-');
				if(cunit_id[1].length && jQuery('#vrc-feature-damage-block-'+cunit_id[1])) {
					var cname = jQuery('#cname').val();
					jQuery.fancybox({
						"href" : '#vrc-feature-damage-block-'+cunit_id[1],
						"title" : (cname.length ? cname+' - ' : '')+jQuery(this).parent('div').find('.vrc-cunit-num').text() + ' - <?php echo addslashes(JText::_('VRCDISTFEATURECDAMAGES')); ?>',
						"helpers": {
							"overlay": {
								"locked": false
							}
						},"padding": 0
					});
				}
			});
			jQuery(document.body).on('click', '.vrc-feature-damage-imgcont img', function(e) {
				var click_x = (e.pageX - jQuery(this).parent('div').offset().left);
				var click_y = (e.pageY - jQuery(this).parent('div').offset().top);
				var cunit_id = jQuery(this).parent('div').closest('div.vrc-feature-damage-block').attr('id').split('vrc-feature-damage-block-');
				if(cunit_id[1].length) {
					jQuery('#vrc-no-damage-'+cunit_id[1]).remove();
					var tot_damages = jQuery('.vrc-feature-car-damage-'+cunit_id[1]).length;
					var damage_ind = !(tot_damages > 0) ? 1 : (tot_damages + 1);
					jQuery(this).parent('div').append("<span class=\"vrc-feature-damage-circle\" id=\"vrc-damage-circle-"+cunit_id[1]+"-"+damage_ind+"\" style=\"left: "+click_x+"px; top: "+click_y+"px;\">"+damage_ind+"</span>");
					jQuery(this).parent('div').next('div.vrc-feature-damage-actions').prepend("<div class=\"vrc-feature-car-damage vrc-feature-car-damage-"+cunit_id[1]+"\" id=\"vrc-feature-car-damage-"+cunit_id[1]+"-"+damage_ind+"\">"+
																								"	<span class=\"vrc-feature-car-damage-count\">"+damage_ind+"</span>"+
																								"	<span class=\"vrc-feature-damage-remove\">&nbsp;</span>"+
																								"	<div class=\"vrc-feature-car-damage-details\">"+
																								"		<span class=\"vrc-feature-car-damage-detail\"><?php echo addslashes(JText::_('VRCDISTFEATURECDAMAGENOTES')); ?></span>"+
																								"		<span class=\"vrc-feature-car-damage-cont\"><textarea name=\"car-"+cunit_id[1]+"-damage[]\"></textarea></span>"+
																								"		<input type=\"hidden\" name=\"car-"+cunit_id[1]+"-damage-x[]\" value=\""+click_x+"\"/>"+
																								"		<input type=\"hidden\" name=\"car-"+cunit_id[1]+"-damage-y[]\" value=\""+click_y+"\"/>"+
																								"	</div>"+
																								"</div>");
				}
			});
			jQuery(document.body).on('click', '.vrc-feature-damage-remove', function() {
				var id_damage = jQuery(this).parent('div').attr('id').split('vrc-feature-car-damage-');
				var cunit_id = id_damage[1].split('-');
				jQuery('#vrc-damage-circle-'+id_damage[1]).remove();
				jQuery(this).parent('div').remove();
				var tot_damages = jQuery('.vrc-feature-car-damage-'+cunit_id[0]).length;
				if(tot_damages < 1) {
					jQuery('#vrc-feature-damage-block-'+cunit_id[0]).find('div.vrc-feature-damage-actions').html("<span class=\"vrc-no-damage\" id=\"vrc-no-damage-"+cunit_id[0]+"\"><?php echo addslashes(JText::_('VRCDISTFEATURENODAMAGE')); ?></span>");
				}
			});
		});
		</script>
		<input type="hidden" value="0" id="moreimagescounter" />
		
		<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARFIVE'); ?>:</b> </td><td><input type="text" name="cname" id="cname" value="<?php echo $row['name']; ?>" size="40"/></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRNEWCARSIX'); ?>:</b> </td><td><?php echo (!empty($row['img']) && file_exists('./components/com_vikrentcar/resources/'.$row['img']) ? "<img src=\"./components/com_vikrentcar/resources/".$row['img']."\" class=\"maxfifty\"/> &nbsp;" : ""); ?><input type="file" name="cimg" size="35"/><br/><label for="autoresize"><?php echo JText::_('VRNEWOPTNINE'); ?></label> <input type="checkbox" id="autoresize" name="autoresize" value="1" onclick="showResizeSel();"/> <span id="resizesel" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizeto" value="250" size="3"/> px</span></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRMOREIMAGES'); ?>:</b><br/>&nbsp;&nbsp;<a href="javascript: void(0);" onclick="addMoreImages();"><?php echo JText::_('VRADDIMAGES'); ?></a></td><td><?php echo $actmoreimgs; ?><input type="file" name="cimgmore[]" size="35"/><div id="myDiv" style="display: block;"></div><label for="autoresizemore"><?php echo JText::_('VRRESIZEIMAGES'); ?></label> <input type="checkbox" id="autoresizemore" name="autoresizemore" value="1" onclick="showResizeSelMore();"/> <span id="resizeselmore" style="display: none;">&nbsp;<?php echo JText::_('VRNEWOPTTEN'); ?>: <input type="text" name="resizetomore" value="600" size="3"/> px</span></td></tr>
		<?php echo $wcats; ?>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRCSHORTDESCRIPTIONCAR'); ?>:</b> </td><td><textarea name="short_info" rows="4" cols="60"><?php echo $row['short_info']; ?></textarea></td></tr>
		<tr><td width="200" valign="top">&bull; <b><?php echo JText::_('VRNEWCARSEVEN'); ?>:</b> </td><td><?php echo $editor->display( "cdescr", $row['info'], 400, 200, 70, 20 ); ?></td></tr>
		<?php echo $wplaces; ?>
		<?php echo $wretplaces; ?>
		<?php echo $wcarats; ?>
		<?php echo $woptionals; ?>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCARNINE'); ?>:</b> </td><td><input type="number" min="1" name="units" id="vrc-units-inp" value="<?php echo $row['units']; ?>" size="3" onfocus="this.select();"/><span class="vrc-features-btn"><?php echo JText::_('VRCDISTFEATURESMNG'); ?></span></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCUSTSTARTINGFROM'); ?>:</b> </td><td><input type="text" name="startfrom" value="<?php echo $row['startfrom']; ?>" size="4"/> <?php echo $currencysymb; ?> &nbsp;&nbsp; <?php echo JHTML::tooltip(JText::_('VRCUSTSTARTINGFROMHELP'), JText::_('VRCUSTSTARTINGFROM'), 'tooltip.png', ''); ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWCAREIGHT'); ?>:</b> </td><td><input type="checkbox" name="cavail" value="yes"<?php echo (intval($row['avail'])==1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
		<tr><td valign="top">&bull; <b><?php echo JText::_('VRCPARAMSCAR'); ?>:</b> </td><td>
			<p class="vrccarparamp"><label for="sdailycost"><?php echo JText::_('VRCPARAMDAILYCOST'); ?></label> <input type="checkbox" id="sdailycost" name="sdailycost" value="1"<?php echo $car_params['sdailycost'] == 1 ? ' checked="checked"' : ''; ?>/></p>
			<p class="vrccarparamp"><label for="shourlycal"><?php echo JText::_('VRCPARAMHOURLYCAL'); ?></label> <input type="checkbox" id="shourlycal" name="shourlycal" value="1"<?php echo $car_params['shourlycal'] == 1 ? ' checked="checked"' : ''; ?>/></p>
			<p class="vrccarparamp"><label for="car_email"><?php echo JText::_('VRCPARAMCAREMAIL'); ?></label> <input type="text" id="car_email" name="email" value="<?php echo $car_params['email']; ?>"/> <span><?php echo JText::_('VRCPARAMCAREMAILHELP'); ?></span></p>
			<p class="vrccarparamp"><label for="custptitle"><?php echo JText::_('VRCPARAMPAGETITLE'); ?></label> <input type="text" id="custptitle" name="custptitle" value="<?php echo $car_params['custptitle']; ?>"/> <span><select name="custptitlew"><option value="before"<?php echo $car_params['custptitlew'] == 'before' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCPARAMPAGETITLEBEFORECUR'); ?></option><option value="after"<?php echo $car_params['custptitlew'] == 'after' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCPARAMPAGETITLEAFTERCUR'); ?></option><option value="replace"<?php echo $car_params['custptitlew'] == 'replace' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCPARAMPAGETITLEREPLACECUR'); ?></option></select></span></p>
			<p class="vrccarparamp"><label for="metakeywords"><?php echo JText::_('VRCPARAMKEYWORDSMETATAG'); ?></label> <textarea name="metakeywords" id="metakeywords" rows="3" cols="40"><?php echo $car_params['metakeywords']; ?></textarea></p>
			<p class="vrccarparamp"><label for="metadescription"><?php echo JText::_('VRCPARAMDESCRIPTIONMETATAG'); ?></label> <textarea name="metadescription" id="metadescription" rows="4" cols="40"><?php echo $car_params['metadescription']; ?></textarea></p>
			<p class="vrccarparamp"><label for="sefalias"><?php echo JText::_('VRCARSEFALIAS'); ?></label> <input type="text" id="sefalias" name="sefalias" value="<?php echo $row['alias']; ?>" placeholder="city-car-group-a"/></p>
		</td></tr>
		</table>
		<div class="vrc-distfeatures-block">
			<div class="vrc-distfeatures-inner">
				<fieldset>
					<legend><?php echo JText::_('VRCDISTFEATURES'); ?></legend>
					<div class="vrc-distfeatures-cont">
					<?php
					for ($i=1; $i <= $row['units']; $i++) {
						$damage_img = JURI::root().'components/com_vikrentcar/helpers/car_damages/car_inspection.png';
					?>
						<div class="vrc-cunit-features-cont" id="cunit-features-<?php echo $i; ?>">
							<span class="vrc-cunit-num"><?php echo JText::_('VRCDISTFEATURECUNIT'); ?><?php echo $i; ?></span>
							<span class="vrc-open-damages"><?php echo JText::_('VRCDISTFEATURECDAMAGES'); ?></span>
							<div class="vrc-cunit-features">
						<?php
						if(array_key_exists($i, $car_params['features'])) {
							foreach ($car_params['features'][$i] as $fkey => $fval) {
								?>
								<div class="vrc-cunit-feature">
									<input type="text" name="feature-name<?php echo $i; ?>[]" value="<?php echo JText::_($fkey); ?>" size="20"/>
									<input type="hidden" name="feature-lang<?php echo $i; ?>[]" value="<?php echo $fkey; ?>"/>
									<input type="text" name="feature-value<?php echo $i; ?>[]" value="<?php echo $fval; ?>" size="20"/>
									<span class="vrc-feature-remove">&nbsp;</span>
								</div>
								<?php
							}
						}
						?>
								<span class="vrc-feature-add"><?php echo JText::_('VRCDISTFEATUREADD'); ?></span>
							</div>
							<div class="vrc-feature-damage-block" id="vrc-feature-damage-block-<?php echo $i; ?>">
								<div class="vrc-feature-damage-imgcont">
									<img src="<?php echo $damage_img; ?>"/>
							<?php
							$tot_dmg = count($car_params['damages'][$i]);
							if($tot_dmg > 0) {
								$dk = $tot_dmg;
								foreach($car_params['damages'][$i] as $damage) {
									?>
									<span class="vrc-feature-damage-circle" id="vrc-damage-circle-<?php echo $i; ?>-<?php echo $dk; ?>" style="left: <?php echo $damage['x']; ?>px; top: <?php echo $damage['y']; ?>px;"><?php echo $dk; ?></span>
									<?php
									$dk--;
								}
							}
							?>
								</div>
								<div class="vrc-feature-damage-actions">
							<?php
							$tot_dmg = count($car_params['damages'][$i]);
							if($tot_dmg > 0) {
								$dk = $tot_dmg;
								foreach($car_params['damages'][$i] as $damage) {
									?>
									<div class="vrc-feature-car-damage vrc-feature-car-damage-<?php echo $i; ?>" id="vrc-feature-car-damage-<?php echo $i; ?>-<?php echo $dk; ?>">
										<span class="vrc-feature-car-damage-count"><?php echo $dk; ?></span>
										<span class="vrc-feature-damage-remove">&nbsp;</span>
										<div class="vrc-feature-car-damage-details">
											<span class="vrc-feature-car-damage-detail"><?php echo JText::_('VRCDISTFEATURECDAMAGENOTES'); ?></span>
											<span class="vrc-feature-car-damage-cont"><textarea name="car-<?php echo $i; ?>-damage[]"><?php echo $damage['notes']; ?></textarea></span>
											<input type="hidden" name="car-<?php echo $i; ?>-damage-x[]" value="<?php echo $damage['x']; ?>" />
											<input type="hidden" name="car-<?php echo $i; ?>-damage-y[]" value="<?php echo $damage['y']; ?>" />
										</div>
									</div>
									<?php
									$dk--;
								}
							}else {
								?>
									<span class="vrc-no-damage" id="vrc-no-damage-<?php echo $i; ?>"><?php echo JText::_('VRCDISTFEATURENODAMAGE'); ?></span>
								<?php
							}
							?>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					</div>
				</fieldset>
			</div>
		</div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="whereup" value="<?php echo $row['id']; ?>">
		<input type="hidden" name="actmoreimgs" value="<?php echo $row['moreimgs']; ?>">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pViewTariffe ($carrows, $rows, $option) {
		
		if(empty($rows)){
			?>
			<p class="err"><?php echo JText::_('VRNOTARFOUND'); ?></p>
			<form name="adminForm" id="adminForm" action="index.php" method="post">
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}else{
			$mainframe = JFactory::getApplication();
			$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
			$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
			$allpr = array();
			$tottar = array();
			foreach($rows as $r){
				$allpr[$r['idprice']]=vikrentcar::getPriceAttr($r['idprice']);
				$tottar[$r['days']][]=$r;
			}
			$prord = array();
			$prvar = '';
			foreach($allpr as $kap=>$ap){
				$prord[]=$kap;
				$prvar.="<th class=\"title center\" width=\"150\">".vikrentcar::getPriceName($kap).(!empty($ap) ? " - ".$ap : "")."</th>\n";
			}
			$totrows = count($tottar);
			$tottar = array_slice($tottar, $lim0, $lim, true);
			?>
	<script language="JavaScript" type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removetariffe') {
				if (confirm('<?php echo JText::_('VRJSDELTAR'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<tr>
			<th class="title left" style="text-align: left;" width="100"><?php echo JText::_( 'VRPVIEWTARONE' ); ?></th>
			<?php echo $prvar; ?>
			<th width="20" class="title right" style="text-align: right;">
				<input type="submit" name="modtar" value="<?php echo JText::_( 'VRPVIEWTARTWO' ); ?>" onclick="javascript: document.adminForm.task.value = 'cars';"/> &nbsp; <input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
		</tr>
		<?php
		$k = 0;
		$i = 0;
		foreach($tottar as $kt=>$vt){
			
			?>
			<tr class="row<?php echo $k; ?>">
				<td class="left"><?php echo $kt; ?></td>
			<?php
			foreach($prord as $ord){
				$thereis=false;
				foreach($vt as $kkkt=>$vvv){
					if ($vvv['idprice']==$ord) {
						$multiid.=$vvv['id'].";";
//						echo "<td>".$vvv['cost'].(!empty($vvv['attrdata'])? " - ".$vvv['attrdata'] : "")."</td>\n";
						echo "<td class=\"center\"><input type=\"text\" name=\"cost".$vvv['id']."\" value=\"".$vvv['cost']."\" size=\"5\"/>".(!empty($vvv['attrdata'])? " - <input type=\"text\" name=\"attr".$vvv['id']."\" value=\"".$vvv['attrdata']."\" size=\"10\"/>" : "")."</td>\n";
						$thereis=true;
						break;
					}
				}
				
				if (!$thereis) {
					echo "<td></td>\n";
				}
				unset($thereis);
				
			}
			
			?>
			<td class="right" style="text-align: right;"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $multiid; ?>" onclick="Joomla.isChecked(this.checked);"></td>
            </tr>
            <?php
			unset($multiid);
			$k = 1 - $k;
			$i++;
		}
		
		?>
		
		</table>
		<input type="hidden" name="carid" value="<?php echo $carrows['id']; ?>" />
		<input type="hidden" name="cid[]" value="<?php echo $carrows['id']; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="viewtariffe" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $totrows, $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		echo $navbut;
		?>
	</form>
	<?php
		}
		
	}
	
	public static function pViewTariffeHours ($carrows, $rows, $option) {
		
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOTARFOUND'); ?></p>
			<form name="adminForm" id="adminForm" action="index.php" method="post">
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}else{
			$mainframe = JFactory::getApplication();
			$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
			$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
			$allpr = array();
			$tottar = array();
			foreach($rows as $r){
				$allpr[$r['idprice']]=vikrentcar::getPriceAttr($r['idprice']);
				$tottar[$r['hours']][]=$r;
			}
			$prord = array();
			$prvar = '';
			foreach($allpr as $kap=>$ap){
				$prord[]=$kap;
				$prvar.="<th class=\"title center\" width=\"150\">".vikrentcar::getPriceName($kap).(!empty($ap) ? " - ".$ap : "")."</th>\n";
			}
			$totrows = count($tottar);
			$tottar = array_slice($tottar, $lim0, $lim, true);
			?>
	<script language="JavaScript" type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removetariffehours') {
				if (confirm('<?php echo JText::_('VRJSDELTAR'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<tr>
			<th class="title left" style="text-align: left;" width="100"><?php echo JText::_( 'VRCPVIEWTARHOURS' ); ?></th>
			<?php echo $prvar; ?>
			<th width="20" class="title right" style="text-align: right;">
				<input type="submit" name="modtarhours" value="<?php echo JText::_( 'VRPVIEWTARTWO' ); ?>" onclick="javascript: document.adminForm.task.value = 'cars';"/> &nbsp; <input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
		</tr>
		<?php
		$k = 0;
		$i = 0;
		foreach($tottar as $kt=>$vt){
			
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $kt; ?> H</td>
			<?php
			foreach($prord as $ord){
				$thereis=false;
				foreach($vt as $kkkt=>$vvv){
					if ($vvv['idprice']==$ord) {
						$multiid.=$vvv['id'].";";
						echo "<td class=\"center\"><input type=\"text\" name=\"cost".$vvv['id']."\" value=\"".$vvv['cost']."\" size=\"5\"/>".(!empty($vvv['attrdata'])? " - <input type=\"text\" name=\"attr".$vvv['id']."\" value=\"".$vvv['attrdata']."\" size=\"10\"/>" : "")."</td>\n";
						$thereis=true;
						break;
					}
				}
				
				if (!$thereis) {
					echo "<td></td>\n";
				}
				unset($thereis);
				
			}
			
			?>
			<td class="right" style="text-align: right;"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $multiid; ?>" onclick="Joomla.isChecked(this.checked);"></td>
            </tr>
            <?php
			unset($multiid);
			$k = 1 - $k;
			$i++;
		}
		
		?>
		
		</table>
		<input type="hidden" name="carid" value="<?php echo $carrows['id']; ?>" />
		<input type="hidden" name="cid[]" value="<?php echo $carrows['id']; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="viewtariffehours" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $totrows, $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		echo $navbut;
		?>
	</form>
	<?php
		}
		
	}
	
	public static function pViewHoursCharges ($carrows, $rows, $option) {
		
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOTARFOUND'); ?></p>
			<form name="adminForm" id="adminForm" action="index.php" method="post">
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}else{
			$mainframe = JFactory::getApplication();
			$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
			$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
			$allpr = array();
			$tottar = array();
			foreach($rows as $r){
				$allpr[$r['idprice']]=vikrentcar::getPriceAttr($r['idprice']);
				$tottar[$r['ehours']][]=$r;
			}
			$prord = array();
			$prvar = '';
			foreach($allpr as $kap=>$ap){
				$prord[]=$kap;
				$prvar.="<th class=\"title center\" width=\"150\">".vikrentcar::getPriceName($kap)."</th>\n";
			}
			$totrows = count($tottar);
			$tottar = array_slice($tottar, $lim0, $lim, true);
			?>
	<script language="JavaScript" type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removetariffehours') {
				if (confirm('<?php echo JText::_('VRJSDELTAR'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<tr>
			<th class="title left" style="text-align: left;" width="100"><?php echo JText::_( 'VRCPVIEWTARHOURS' ); ?></th>
			<?php echo $prvar; ?>
			<th width="20" class="title right" style="text-align: right;">
				<input type="submit" name="modtarhourscharges" value="<?php echo JText::_( 'VRPVIEWTARTWO' ); ?>" onclick="javascript: document.adminForm.task.value = 'cars';"/> &nbsp; <input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
		</tr>
		<?php
		$k = 0;
		$i = 0;
		foreach($tottar as $kt=>$vt){
			
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $kt; ?> H</td>
			<?php
			foreach($prord as $ord){
				$thereis=false;
				foreach($vt as $kkkt=>$vvv){
					if ($vvv['idprice']==$ord) {
						$multiid.=$vvv['id'].";";
						echo "<td class=\"center\"><input type=\"text\" name=\"cost".$vvv['id']."\" value=\"".$vvv['cost']."\" size=\"5\"/></td>\n";
						$thereis=true;
						break;
					}
				}
				
				if (!$thereis) {
					echo "<td></td>\n";
				}
				unset($thereis);
				
			}
			
			?>
			<td class="right" style="text-align: right;"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $multiid; ?>" onclick="Joomla.isChecked(this.checked);"></td>
            </tr>
            <?php
			unset($multiid);
			$k = 1 - $k;
			$i++;
		}
		
		?>
		
		</table>
		<input type="hidden" name="carid" value="<?php echo $carrows['id']; ?>" />
		<input type="hidden" name="cid[]" value="<?php echo $carrows['id']; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="viewhourscharges" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $totrows, $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		echo $navbut;
		?>
	</form>
	<?php
		}
		
	}
	
	public static function pViewConfigOne () {
		$vrc_app = new VikApplication();
		$timeopst=vikrentcar::getTimeOpenStore(true);
		if (is_array($timeopst) && $timeopst[0]!=$timeopst[1]) {
			$wtos="<input type=\"checkbox\" name=\"timeopenstorealw\" value=\"yes\"/> ".JText::_('VRCONFIGONEONE')."<br/><br/><b>".JText::_('VRCONFIGONETWO')."</b>:<br/><table><tr><td valign=\"top\">".JText::_('VRCONFIGONETHREE')."</td><td><select name=\"timeopenstorefh\">";
			$openat=vikrentcar::getHoursMinutes($timeopst[0]);
			for($i=0; $i <= 23; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$stat=($openat[0]==$i ? " selected=\"selected\"" : "");
				$wtos.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
			}
			$wtos.="</select> <select name=\"timeopenstorefm\">";
			for($i=0; $i <= 59; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$stat=($openat[1]==$i ? " selected=\"selected\"" : "");
				$wtos.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
			}
			$wtos.="</select></td></tr><tr><td>".JText::_('VRCONFIGONEFOUR')."</td><td><select name=\"timeopenstoreth\">";
			$closeat=vikrentcar::getHoursMinutes($timeopst[1]);
			for($i=0; $i <= 23; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$stat=($closeat[0]==$i ? " selected=\"selected\"" : "");
				$wtos.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
			}
			$wtos.="</select> <select name=\"timeopenstoretm\">";
			for($i=0; $i <= 59; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$stat=($closeat[1]==$i ? " selected=\"selected\"" : "");
				$wtos.="<option value=\"".$i."\"".$stat.">".$in."</option>\n";
			}
			$wtos.="</select></td></tr></table>";
		}else {
			$wtos="<input type=\"checkbox\" name=\"timeopenstorealw\" value=\"yes\" checked=\"checked\"/> ".JText::_('VRCONFIGONEONE')."<br/><br/><b>".JText::_('VRCONFIGONETWO')."</b>:<br/><table><tr><td valign=\"top\">".JText::_('VRCONFIGONETHREE')."</td><td><select name=\"timeopenstorefh\">";
			for($i=0; $i <= 23; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$wtos.="<option value=\"".$i."\">".$in."</option>\n";
			}
			$wtos.="</select> <select name=\"timeopenstorefm\">";
			for($i=0; $i <= 59; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$wtos.="<option value=\"".$i."\">".$in."</option>\n";
			}
			$wtos.="</select></td></tr><tr><td>".JText::_('VRCONFIGONEFOUR')."</td><td><select name=\"timeopenstoreth\">";
			for($i=0; $i <= 23; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$wtos.="<option value=\"".$i."\">".$in."</option>\n";
			}
			$wtos.="</select> <select name=\"timeopenstoretm\">";
			for($i=0; $i <= 59; $i++){
				if ($i < 10) {
					$in="0".$i;
				}else {
					$in=$i;
				}
				$wtos.="<option value=\"".$i."\">".$in."</option>\n";
			}
			$wtos.="</select></td></tr></table>";
		}
		$calendartype = vikrentcar::calendarType(true);
		$aehourschbasp = vikrentcar::applyExtraHoursChargesBasp();
		$damageshowtype = vikrentcar::getDamageShowType();
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		
		$maxdatefuture = vikrentcar::getMaxDateFuture(true);
		$maxdate_val = intval(substr($maxdatefuture, 1, (strlen($maxdatefuture) - 1)));
		$maxdate_interval = substr($maxdatefuture, -1, 1);

		$vrcsef = file_exists(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'router.php');
		?>
		<script type="text/javascript">
		function vrcFlushSession() {
			if(confirm('<?php echo addslashes(JText::_('VRCONFIGFLUSHSESSIONCONF')); ?>')) {
				location.href='<?php echo JURI::root(); ?>administrator/index.php?option=com_vikrentcar&task=renewsession';
			}else {
				return false;
			}
		}
		</script>
		<a href="javascript: void(0);" class="vrcflushsession" onclick="vrcFlushSession();"><?php echo JText::_('VRCONFIGFLUSHSESSION'); ?></a>

		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRCCONFIGBOOKINGPART'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONEFIVE'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('allowrent', JText::_('VRYES'), JText::_('VRNO'), (int)vikrentcar::allowRent(), 1, 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONESIX'); ?></b> </td>
						<td><textarea name="disabledrentmsg" rows="5" cols="50"><?php echo vikrentcar::getDisabledRentMsg(); ?></textarea></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONETENSIX'); ?></b> </td>
						<td><input type="text" name="adminemail" value="<?php echo vikrentcar::getAdminMail(); ?>" size="30"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGSENDERMAIL'); ?></b> </td>
						<td><input type="text" name="senderemail" value="<?php echo vikrentcar::getSenderMail(); ?>" size="30"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONESEVEN'); ?></b> </td>
						<td><?php echo $wtos; ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONEELEVEN'); ?></b> </td>
						<td>
							<select name="dateformat">
								<option value="%d/%m/%Y"<?php echo ($nowdf=="%d/%m/%Y" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCONFIGONETWELVE'); ?></option>
								<option value="%Y/%m/%d"<?php echo ($nowdf=="%Y/%m/%d" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCONFIGONETENTHREE'); ?></option>
								<option value="%m/%d/%Y"<?php echo ($nowdf=="%m/%d/%Y" ? " checked=\"checked\"" : ""); ?>><?php echo JText::_('VRCONFIGUSDATEFORMAT'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTIMEFORMAT'); ?></b> </td>
						<td>
							<select name="timeformat">
								<option value="H:i"<?php echo ($nowtf=="H:i" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCONFIGTIMEFORMATLAT'); ?></option>
								<option value="h:i A"<?php echo ($nowtf=="h:i A" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCONFIGTIMEFORMATENG'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONEEIGHT'); ?></b> </td>
						<td><input type="text" name="hoursmorerentback" value="<?php echo vikrentcar::getHoursMoreRb(); ?>" size="3"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGEHOURSBASP'); ?></b> </td>
						<td>
							<select name="ehourschbasp">
								<option value="1"<?php echo ($aehourschbasp == true ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCONFIGEHOURSBEFORESP'); ?></option>
								<option value="0"<?php echo ($aehourschbasp == false ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCONFIGEHOURSAFTERSP'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCCONFIGDAMAGESHOWTYPE'); ?></b> </td>
						<td>
							<select name="damageshowtype">
								<option value="1"<?php echo ($damageshowtype == 1 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCCONFIGDAMAGETYPEONE'); ?></option>
								<option value="2"<?php echo ($damageshowtype == 2 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCCONFIGDAMAGETYPETWO'); ?></option>
								<option value="3"<?php echo ($damageshowtype == 3 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCCONFIGDAMAGETYPETHREE'); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONENINE'); ?></b> </td>
						<td><input type="text" name="hoursmorecaravail" value="<?php echo vikrentcar::getHoursCarAvail(); ?>" size="3"/> <?php echo JText::_('VRCONFIGONETENEIGHT'); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCTODAYBOOKINGS'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('todaybookings', JText::_('VRYES'), JText::_('VRNO'), (int)vikrentcar::todayBookings(), 1, 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONECOUPONS'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('enablecoupons', JText::_('VRYES'), JText::_('VRNO'), (int)vikrentcar::couponsEnabled(), 1, 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONETENFIVE'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('tokenform', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::tokenForm() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGREQUIRELOGIN'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('requirelogin', JText::_('VRYES'), JText::_('VRNO'), (int)vikrentcar::requireLogin(), 1, 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCICALKEY'); ?></b> </td>
						<td><input type="text" name="icalkey" value="<?php echo vikrentcar::getIcalSecretKey(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONETENSEVEN'); ?></b> </td>
						<td><input type="text" name="minuteslock" value="<?php echo vikrentcar::getMinutesLock(); ?>" size="3"/></td>
					</tr>
				</tbody>
			</table>
		</fieldset>

		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRCCONFIGSEARCHPART'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONEDROPDPLUS'); ?></b> </td>
						<td><input type="text" name="setdropdplus" value="<?php echo vikrentcar::setDropDatePlus(true); ?>" size="3"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGMINDAYSADVANCE'); ?></b> </td>
						<td><input type="text" name="mindaysadvance" value="<?php echo vikrentcar::getMinDaysAdvance(true); ?>" size="3"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGMAXDATEFUTURE'); ?></b> </td>
						<td><input type="text" name="maxdate" value="<?php echo $maxdate_val; ?>" size="2" style="float: none; vertical-align: top;"/> <select name="maxdateinterval" style="float: none; margin-bottom: 0;"><option value="d"<?php echo $maxdate_interval == 'd' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEDAYS'); ?></option><option value="w"<?php echo $maxdate_interval == 'w' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEWEEKS'); ?></option><option value="m"<?php echo $maxdate_interval == 'm' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEMONTHS'); ?></option><option value="y"<?php echo $maxdate_interval == 'y' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEYEARS'); ?></option></select></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONETEN'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('placesfront', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::showPlacesFront(true) ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONETENFOUR'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('showcategories', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::showCategoriesFront(true) ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCCONFIGSEARCHFILTCHARACTS'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('charatsfilter', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::useCharatsFilter(true) ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
				</tbody>
			</table>
		</fieldset>

		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRCCONFIGSYSTEMPART'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCCONFENMULTILANG'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('multilang', JText::_('VRYES'), JText::_('VRNO'), (int)vikrentcar::allowMultiLanguage(), 1, 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCCONFSEFROUTER'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('vrcsef', JText::_('VRYES'), JText::_('VRNO'), (int)$vrcsef, 1, 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONEJQUERY'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('loadjquery', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::loadJquery(true) ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGONECALENDAR'); ?></b> </td>
						<td>
							<select name="calendar">
								<option value="jqueryui"<?php echo ($calendartype == "jqueryui" ? " selected=\"selected\"" : ""); ?>>jQuery UI</option>
								<option value="joomla"<?php echo ($calendartype == "joomla" ? " selected=\"selected\"" : ""); ?>>Joomla</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b>Google Maps API Key</b> </td>
						<td><input type="text" name="gmapskey" value="<?php echo vikrentcar::getGoogleMapsKey(); ?>" size="30" /></td>
					</tr>
				</tbody>
			</table>
		</fieldset>

		<?php
	}
	
	public static function pViewConfigTwo () {
		$vrc_app = new VikApplication();
		$formatvals = vikrentcar::getNumberFormatData(true);
		$formatparts = explode(':', $formatvals);
		?>
		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRCCONFIGCURRENCYPART'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREECURNAME'); ?></b> </td>
						<td><input type="text" name="currencyname" value="<?php echo vikrentcar::getCurrencyName(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREECURSYMB'); ?></b> </td>
						<td><input type="text" name="currencysymb" value="<?php echo vikrentcar::getCurrencySymb(true); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREECURCODEPP'); ?></b> </td>
						<td><input type="text" name="currencycodepp" value="<?php echo vikrentcar::getCurrencyCodePp(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGNUMDECIMALS'); ?></b> </td>
						<td><input type="text" name="numdecimals" value="<?php echo $formatparts[0]; ?>" size="2"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGNUMDECSEPARATOR'); ?></b> </td>
						<td><input type="text" name="decseparator" value="<?php echo $formatparts[1]; ?>" size="2"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGNUMTHOSEPARATOR'); ?></b> </td>
						<td><input type="text" name="thoseparator" value="<?php echo $formatparts[2]; ?>" size="2"/></td>
					</tr>
				</tbody>
			</table>
		</fieldset>
		
		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRCCONFIGPAYMPART'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTWOFIVE'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('ivainclusa', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::ivaInclusa(true) ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTAXSUMMARY'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('taxsummary', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::showTaxOnSummaryOnly(true) ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTWOTHREE'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('paytotal', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::payTotal() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTWOFOUR'); ?></b> </td>
						<td><input type="text" name="payaccpercent" value="<?php echo vikrentcar::getAccPerCent(); ?>" size="5"/> <b>%</b></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTWOSIX'); ?></b> </td>
						<td><input type="text" name="paymentname" value="<?php echo vikrentcar::getPaymentName(); ?>" size="25"/></td>
					</tr>
				</tbody>
			</table>
		</fieldset>

		<?php
		
	}
	
	public static function pViewConfigThree () {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$vrc_app = new VikApplication();
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root().'components/com_vikrentcar/resources/jquery.fancybox.css');
		JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery.fancybox.js', false, true, false, false);
		$themesel = '<select name="theme">';
		$themesel .= '<option value="default">default</option>';
		$themes = glob(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS.'*');
		$acttheme = vikrentcar::getTheme();
		if(count($themes) > 0) {
			$strip = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS;
			foreach($themes as $th) {
				if(is_dir($th)) {
					$tname = str_replace($strip, '', $th);
					if($tname != 'default') {
						$themesel .= '<option value="'.$tname.'"'.($tname == $acttheme ? ' selected="selected"' : '').'>'.$tname.'</option>';
					}
				}
			}
		}
		$themesel .= '</select>';
		$firstwday = vikrentcar::getFirstWeekDay(true);
		?>
		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRCCONFIGPAYMPART'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGFIRSTWDAY'); ?></b> </td>
						<td><select name="firstwday" style="float: none;"><option value="0"<?php echo $firstwday == '0' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCSUNDAY'); ?></option><option value="1"<?php echo $firstwday == '1' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCMONDAY'); ?></option><option value="2"<?php echo $firstwday == '2' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCTUESDAY'); ?></option><option value="3"<?php echo $firstwday == '3' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCWEDNESDAY'); ?></option><option value="4"<?php echo $firstwday == '4' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCTHURSDAY'); ?></option><option value="5"<?php echo $firstwday == '5' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCFRIDAY'); ?></option><option value="6"<?php echo $firstwday == '6' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCSATURDAY'); ?></option></select></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREETEN'); ?></b> </td>
						<td><input type="text" name="numcalendars" value="<?php echo vikrentcar::numCalendars(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHUMBSIZE'); ?></b> </td>
						<td><input type="text" name="thumbswidth" value="<?php echo vikrentcar::getThumbnailsWidth(); ?>" size="4"/> px</td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREENINE'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('showpartlyreserved', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::showPartlyReserved() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>

					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGEMAILTEMPLATE'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'email_tmpl.php'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGPDFTEMPLATE'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'pdf_tmpl.php'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGPDFCHECKINTEMPLATE'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'checkin_pdf_tmpl.php'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGPDFINVOICETEMPLATE'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'invoices'.DS.'invoice_tmpl.php'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCCONFIGCUSTCSSTPL'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'vikrentcar_custom.css'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>

					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREEONE'); ?></b> </td>
						<td><input type="text" name="fronttitle" value="<?php echo vikrentcar::getFrontTitle(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREETWO'); ?></b> </td>
						<td><input type="text" name="fronttitletag" value="<?php echo vikrentcar::getFrontTitleTag(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREETHREE'); ?></b> </td>
						<td><input type="text" name="fronttitletagclass" value="<?php echo vikrentcar::getFrontTitleTagClass(); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREEFOUR'); ?></b> </td>
						<td><input type="text" name="searchbtnval" value="<?php echo vikrentcar::getSubmitName(true); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREEFIVE'); ?></b> </td>
						<td><input type="text" name="searchbtnclass" value="<?php echo vikrentcar::getSubmitClass(true); ?>" size="10"/></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREESIX'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('showfooter', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::showFooter() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHEME'); ?></b> </td>
						<td><?php echo $themesel; ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREESEVEN'); ?></b> </td>
						<td><?php echo $editor->display( "intromain", vikrentcar::getIntroMain(), 500, 350, 70, 20 ); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTHREEEIGHT'); ?></b> </td>
						<td><textarea name="closingmain" rows="5" cols="50"><?php echo vikrentcar::getClosingMain(); ?></textarea></td>
					</tr>
				</tbody>
			</table>
		</fieldset>

		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".vrc-edit-tmpl").click(function(){
				var vrc_tmpl_path = jQuery(this).attr("data-tmpl-path");
				jQuery.fancybox({
					"helpers": {
						"overlay": {
							"locked": false
						}
					},
					"href": "index.php?option=com_vikrentcar&task=edittmplfile&path="+vrc_tmpl_path+"&tmpl=component",
					"width": "75%",
					"height": "75%",
					"autoScale": false,
					"transitionIn": "none",
					"transitionOut": "none",
					//"padding": 0,
					"type": "iframe"
				});
			});
		});
		</script>

		<?php
		
	}
	
	public static function pViewConfigFour () {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$vrc_app = new VikApplication();
		JHTML::_('behavior.modal');
		$sitelogo = vikrentcar::getSiteLogo();
		?>
		<fieldset class="adminform">
			<legend class="adminlegend"><?php echo JText::_('VRPANELFOUR'); ?></legend>
			<table cellspacing="1" class="admintable table">
				<tbody>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGFOURLOGO'); ?></b> </td>
						<td><input type="file" name="sitelogo" size="35"/> <?php echo (strlen($sitelogo) > 0 ? '&nbsp;&nbsp;<a href="'.JURI::root().'administrator/components/com_vikrentcar/resources/'.$sitelogo.'" class="modal" target="_blank">'.$sitelogo.'</a>' : ''); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRUSEJUTILITY'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('sendjutility', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::sendJutility() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSENDPDF'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('sendpdf', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::sendPDF() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>

					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGTRACKCODETEMPLATE'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'tracking_code_tmpl.php'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGCONVCODETEMPLATE'); ?></b> </td>
						<td><button type="button" class="btn vrc-edit-tmpl" data-tmpl-path="<?php echo urlencode(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'conversion_code_tmpl.php'); ?>"><i class="icon-edit"></i> <?php echo JText::_('VRCONFIGEDITTMPLFILE'); ?></button></td>
					</tr>

					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGFOURTWO'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('allowstats', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::allowStats() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGFOURTHREE'); ?></b> </td>
						<td><?php echo $vrc_app->printYesNoButtons('sendmailstats', JText::_('VRYES'), JText::_('VRNO'), (vikrentcar::sendMailStats() ? 'yes' : 0), 'yes', 0); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGFOURORDMAILFOOTER'); ?></b> </td>
						<td><?php echo $editor->display( "footerordmail", vikrentcar::getFooterOrdMail(), 500, 350, 70, 20 ); ?></td>
					</tr>
					<tr>
						<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCONFIGFOURFOUR'); ?></b> </td>
						<td><textarea name="disclaimer" rows="7" cols="50"><?php echo vikrentcar::getDisclaimer(); ?></textarea></td>
					</tr>
				</tbody>
			</table>
		</fieldset>

		<?php

	}
	
	public static function pChooseBusy ($reservs, $totres, $pts, $option, $lim0="0", $navbut="") {
		if (file_exists('./components/com_vikrentcar/resources/'.$reservs[0]['img']) && getimagesize('./components/com_vikrentcar/resources/'.$reservs[0]['img'])) {
			$img='<img align="middle" class="maxninety" alt="Car Image" src="' . JURI::root() . 'administrator/components/com_vikrentcar/resources/'.$reservs[0]['img'].'" />';
		}else {
			$img='<img align="middle" alt="vikrentcar logo" src="' . JURI::root() . 'administrator/components/com_vikrentcar/vikrentcar.jpg' . '" />';
		}
		$unitsdisp=$reservs[0]['units'] - $totres;
		$unitsdisp=($unitsdisp < 0 ? "0" : $unitsdisp);
		?>
		<table>
			<tr>
				<td><div class="vrcadminfaresctitle"><?php echo JText::_('VRMAINCHOOSEBUSY'); ?> <?php echo $reservs[0]['name']; ?></div></td>
			</tr>
			<tr>
				<td><?php echo $img; ?></td>
			</tr>
		</table>
		
		<br/>
		<button class="btn btn-primary" type="button">
  			<?php echo JText::_('VRPCHOOSEBUSYCAVAIL'); ?>: <span class="badge"><?php echo $unitsdisp; ?>/<?php echo $reservs[0]['units']; ?></span>
		</button>
		<br/>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th class="title center" width="50"><?php echo JText::_( 'VRCORDERNUMBER' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWORDERSFOUR' ); ?></th>
			<th class="title left" width="250"><?php echo JText::_( 'VRPVIEWORDERSTWO' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWORDERSFIVE' ); ?></th>
			<th class="title center" width="150"><?php echo JText::_( 'VRCUNITASSIGNED' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPCHOOSEBUSYORDATE' ); ?></th>
		</tr>
		</thead>
		<?php
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($reservs); $i < $n; $i++) {
			$row = $reservs[$i];
			//Car Specific Unit
			$car_first_feature = '';
			if(!empty($row['carindex']) && !empty($row['params'])) {
				$car_params = json_decode($row['params'], true);
				if(is_array($car_params) && @count($car_params['features']) > 0) {
					foreach ($car_params['features'] as $cind => $cfeatures) {
						if($cind != $row['carindex']) {
							continue;
						}
						foreach ($cfeatures as $fname => $fval) {
							if(strlen($fval)) {
								$car_first_feature = '#'.$cind.' - '.JText::_($fname).': '.$fval;
								break 2;
							}
						}
					}
				}
			}
			?>
			<tr class="row<?php echo $k; ?>">
				<td class="center"><?php echo $row['idorder']; ?></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editbusy&amp;cid[]=<?php echo $row['idorder']; ?>"><?php echo date($df.' '.$nowtf, $row['ritiro']); ?></a></td>
				<td><?php echo (!empty($row['custdata']) ? substr($row['custdata'], 0, 45)." ..." : ""); ?></td>
				<td><?php echo date($df.' '.$nowtf, $row['consegna']); ?></td>
				<td class="center"><span class="label label-primary"><?php echo $car_first_feature; ?></span></td>
				<td><?php echo date($df.' '.$nowtf, $row['ts']); ?></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="idcar" value="<?php echo $reservs[0]['idcar']; ?>" />
		<input type="hidden" name="ts" value="<?php echo $pts; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="choosebusy" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
		<?php
	}
	
	public static function pLocFees ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOLOCFEES'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removeplace') {
				if (confirm('<?php echo JText::_('VRJSDELLOCFEE'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWPLOCFEEONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPVIEWPLOCFEETWO' ); ?></th>
			<th class="title left" width="100"><?php echo JText::_( 'VRPVIEWPLOCFEETHREE' ); ?></th>
			<th class="title left" width="100"><?php echo JText::_( 'VRPVIEWPLOCFEEFOUR' ); ?></th>
		</tr>
		</thead>
		<?php
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editlocfee&amp;cid[]=<?php echo $row['id']; ?>"><?php echo vikrentcar::getPlaceName($row['from']); ?></a></td>
				<td><?php echo vikrentcar::getPlaceName($row['to']); ?></td>
				<td><?php echo $currencysymb.' '.$row['cost']; ?></td>
				<td><?php echo (intval($row['daily']) == 1 ? JText::_('VRYES') : JText::_('VRNO')); ?></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="locfees" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pNewLocFee ($wsel, $wseltwo, $option) {
		JHTML::_('behavior.tooltip');
		$currencysymb=vikrentcar::getCurrencySymb(true);
		if(strlen($wsel) > 0) {
			$dbo = JFactory::getDBO();
			$q="SELECT * FROM `#__vikrentcar_iva`;";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() > 0) {
				$ivas=$dbo->loadAssocList();
				$wiva="<select name=\"aliq\">\n";
				foreach($ivas as $iv){
					$wiva.="<option value=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
				}
				$wiva.="</select>\n";
			}else {
				$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('VRNOIVAFOUND')."</a>";
			}
			?>
			<script language="JavaScript" type="text/javascript">
			function addMoreOverrides() {
				var ni = document.getElementById('myDiv');
				var numi = document.getElementById('morevalueoverrides');
				var num = (document.getElementById('morevalueoverrides').value -1)+ 2;
				numi.value = num;
				var newdiv = document.createElement('div');
				var divIdName = 'my'+num+'Div';
				newdiv.setAttribute('id',divIdName);
				newdiv.innerHTML = '<p><?php echo addslashes(JText::_('VRLOCFEECOSTOVERRIDEDAYS')); ?> <input type=\'text\' name=\'nightsoverrides[]\' value=\'\' size=\'4\'/> - <?php echo addslashes(JText::_('VRLOCFEECOSTOVERRIDECOST')); ?> <input type=\'text\' name=\'valuesoverrides[]\' value=\'\' size=\'5\'/> <?php echo addslashes($currencysymb); ?></p>';
				ni.appendChild(newdiv);
			}
			</script>
			<input type="hidden" value="0" id="morevalueoverrides" />
			
			<form name="adminForm" id="adminForm" action="index.php" method="post">
			<table class="adminform">
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEEONE'); ?>:</b> </td><td><?php echo $wsel; ?></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEETWO'); ?>:</b> </td><td><?php echo $wseltwo; ?></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRLOCFEEINVERT'); ?>:</b> </td><td><input type="checkbox" name="invert" value="1"/></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEETHREE'); ?>:</b> </td><td><?php echo $currencysymb; ?> <input type="text" name="cost" value="" size="3"/></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEEFOUR'); ?>:</b> </td><td><input type="checkbox" name="daily" value="1"/></td></tr>
			<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRLOCFEECOSTOVERRIDE'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRLOCFEECOSTOVERRIDEHELP'), JText::_('VRLOCFEECOSTOVERRIDE'), 'tooltip.png', ''); ?></td><td><div id="myDiv" style="display: block;"></div><a href="javascript: void(0);" onclick="addMoreOverrides();"><?php echo JText::_('VRLOCFEECOSTOVERRIDEADD'); ?></a></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEEFIVE'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
			</table>
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}else {
			?>
			<p class="warn"><a href="index.php?option=com_vikrentcar&amp;task=newplace"><?php echo JText::_('VRNOPLACESFOUND'); ?></a></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}
	}
	
	public static function pEditLocFee ($fdata, $wsel, $wseltwo, $option) {
		JHTML::_('behavior.tooltip');
		$currencysymb=vikrentcar::getCurrencySymb(true);
		if(strlen($wsel) > 0) {
			$dbo = JFactory::getDBO();
			$q="SELECT * FROM `#__vikrentcar_iva`;";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() > 0) {
				$ivas=$dbo->loadAssocList();
				$wiva="<select name=\"aliq\">\n";
				foreach($ivas as $iv){
					$wiva.="<option value=\"".$iv['id']."\"".($fdata['idiva']==$iv['id'] ? " selected=\"selected\"" : "").">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
				}
				$wiva.="</select>\n";
			}else {
				$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('VRNOIVAFOUND')."</a>";
			}
			
			$actvalueoverrides = '';
			if (strlen($fdata['losoverride']) > 0) {
				$losoverrides = explode('_', $fdata['losoverride']);
				foreach($losoverrides as $loso) {
					if (!empty($loso)) {
						$losoparts = explode(':', $loso);
						$actvalueoverrides .= '<p>'.JText::_('VRLOCFEECOSTOVERRIDEDAYS').' <input type="text" name="nightsoverrides[]" value="'.$losoparts[0].'" size="4"/> - '.JText::_('VRLOCFEECOSTOVERRIDECOST').' <input type="text" name="valuesoverrides[]" value="'.$losoparts[1].'" size="5"/> '.$currencysymb.'</p>';
					}
				}
			}
			?>
			<script language="JavaScript" type="text/javascript">
			function addMoreOverrides() {
				var ni = document.getElementById('myDiv');
				var numi = document.getElementById('morevalueoverrides');
				var num = (document.getElementById('morevalueoverrides').value -1)+ 2;
				numi.value = num;
				var newdiv = document.createElement('div');
				var divIdName = 'my'+num+'Div';
				newdiv.setAttribute('id',divIdName);
				newdiv.innerHTML = '<p><?php echo addslashes(JText::_('VRLOCFEECOSTOVERRIDEDAYS')); ?> <input type=\'text\' name=\'nightsoverrides[]\' value=\'\' size=\'4\'/> - <?php echo addslashes(JText::_('VRLOCFEECOSTOVERRIDECOST')); ?> <input type=\'text\' name=\'valuesoverrides[]\' value=\'\' size=\'5\'/> <?php echo addslashes($currencysymb); ?></p>';
				ni.appendChild(newdiv);
			}
			</script>
			<input type="hidden" value="0" id="morevalueoverrides" />
			
			<form name="adminForm" id="adminForm" action="index.php" method="post">
			<table class="adminform">
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEEONE'); ?>:</b> </td><td><?php echo $wsel; ?></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEETWO'); ?>:</b> </td><td><?php echo $wseltwo; ?></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRLOCFEEINVERT'); ?>:</b> </td><td><input type="checkbox" name="invert" value="1"<?php echo (intval($fdata['invert']) == 1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEETHREE'); ?>:</b> </td><td><?php echo $currencysymb; ?> <input type="text" name="cost" value="<?php echo $fdata['cost']; ?>" size="3"/></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEEFOUR'); ?>:</b> </td><td><input type="checkbox" name="daily" value="1"<?php echo (intval($fdata['daily']) == 1 ? " checked=\"checked\"" : ""); ?>/></td></tr>
			<tr><td width="150" valign="top">&bull; <b><?php echo JText::_('VRLOCFEECOSTOVERRIDE'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRLOCFEECOSTOVERRIDEHELP'), JText::_('VRLOCFEECOSTOVERRIDE'), 'tooltip.png', ''); ?></td><td><div id="myDiv" style="display: block;"><?php echo $actvalueoverrides; ?></div><a href="javascript: void(0);" onclick="addMoreOverrides();"><?php echo JText::_('VRLOCFEECOSTOVERRIDEADD'); ?></a></td></tr>
			<tr><td width="200">&bull; <b><?php echo JText::_('VRNEWLOCFEEFIVE'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
			</table>
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
			<input type="hidden" name="where" value="<?php echo $fdata['id']; ?>">
			</form>
			<?php
		}else {
			?>
			<p class="warn"><a href="index.php?option=com_vikrentcar&amp;task=newplace"><?php echo JText::_('VRNOPLACESFOUND'); ?></a></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}
	}
	
	public static function pShowSeasons ($rows, $carsel, $all_cars, $option, $lim0="0", $navbut="") {
		JHTML::_('behavior.tooltip');
		$pidcar = VikRequest::getInt('idcar', '', 'request');
		?>
		<div class="vrc-ratesoverview-carsel-block">
			<form action="index.php?option=com_vikrentcar" method="post" name="seasonsform">
				<div class="vrc-ratesoverview-carsel-entry">
					<label for="idroom"><?php echo JText::_('VRCRATESOVWCAR'); ?></label>
					<?php echo $carsel; ?>
				</div>
				<input type="hidden" name="task" value="seasons" />
				<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
		</div>
		<br clear="all" />
		<?php
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOSEASONS'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removeseasons') {
				if (confirm('<?php echo JText::_('VRJSDELSEASONS'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPSHOWSEASONSPNAME' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPSHOWSEASONSONE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPSHOWSEASONSTWO' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRPSHOWSEASONSWDAYS' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRPSHOWSEASONSSEVEN' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCSEASONAFFECTEDROOMS' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPSHOWSEASONSTHREE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCISPROMOTION' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPSHOWSEASONSFOUR' ); ?></th>
		</tr>
		</thead>
		<?php
		$currencysymb=vikrentcar::getCurrencySymb(true);
		if (vikrentcar::getDateFormat(true)=="%d/%m/%Y") {
			$df='d/m/Y';
		}else {
			$df='m/d/Y';
		}
		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			if($row['from'] > 0 || $row['to'] > 0) {
				$nowyear=!empty($row['year']) ? $row['year'] : date('Y');
				$tsbase=mktime(0, 0, 0, 1, 1, $nowyear);
				//leap years
				$curyear = $nowyear;
				if($curyear % 4 == 0 && ($curyear % 100 != 0 || $curyear % 400 == 0)) {
					$isleap = true;
				}else {
					$isleap = false;
				}
				//
				$sfrom=date($df, ($tsbase + $row['from']));
				$sto=date($df, ($tsbase + $row['to']));
				//leap years
				if($isleap == true) {
					$infoseason = getdate($tsbase + $row['from']);
					$leapts = mktime(0, 0, 0, 2, 29, $infoseason['year']);
					if($infoseason[0] >= $leapts) {
						$sfrom=date($df, ($tsbase + $row['from'] + 86400));
						$sto=date($df, ($tsbase + $row['to'] + 86400));
					}
				}
				//
			}else {
				$sfrom = "";
				$sto = "";
			}
			$actwdays = explode(';', $row['wdays']);
			$wdaysmatch = array('0' => JText::_('VRCSUNDAY'), '1' => JText::_('VRCMONDAY'), '2' => JText::_('VRCTUESDAY'), '3' => JText::_('VRCWEDNESDAY'), '4' => JText::_('VRCTHURSDAY'), '5' => JText::_('VRCFRIDAY'), '6' => JText::_('VRCSATURDAY'));
			$wdaystr = "";
			if(@count($actwdays) > 0) {
				foreach($actwdays as $awd) {
					if(strlen($awd) > 0) {
						$wdaystr .= substr($wdaysmatch[$awd], 0, 3).' ';
					}
				}
			}
			$aff_cars = 0;
			$aff_cars_title = array();
			$scars = explode(',', $row['idcars']);
			foreach ($scars as $scar) {
				$aff_idcar = intval(str_replace('-', '', $scar));
				if(!empty($scar) && $aff_idcar > 0) {
					$aff_cars++;
					if(array_key_exists($aff_idcar, $all_cars)) {
						$aff_cars_title[] = $all_cars[$aff_idcar];
					}
				}
			}
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td class="center"><a href="index.php?option=com_vikrentcar&amp;task=editseason&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['spname']; ?></a></td>
				<td class="center"><?php echo $sfrom; ?></td>
				<td class="center"><?php echo $sto; ?></td>
				<td class="center"><?php echo $wdaystr; ?></td>
				<td class="center"><?php echo (!empty($row['locations']) ? vikrentcar::getPlaceName($row['locations']) : JText::_('VRSEASONANY')); ?></td>
				<td class="center"><span class="hasTooltip" title="<?php echo implode(', ', $aff_cars_title); ?>"><?php echo $aff_cars; ?></span></td>
				<td class="center"><?php echo (intval($row['type']) == 1 ? JText::_('VRPSHOWSEASONSFIVE') : JText::_('VRPSHOWSEASONSSIX')); ?></td>
				<td class="center"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/images/<?php echo ($row['promo'] == 1 ? 'ok.png' : 'no.png'); ?>"/></td>
				<td class="center"><?php echo $row['diffcost']; ?> <?php echo (intval($row['val_pcent']) == 1 ? $currencysymb : '%'); ?></td>
			</tr>	
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="seasons" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pNewSeason ($wsel, $wpricesel, $wlocsel, $option) {
		$vrc_app = new VikApplication();
		JHTML::_('behavior.tooltip');
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		if(strlen($wsel) > 0) {
			JHTML::_('behavior.calendar');
			$df=vikrentcar::getDateFormat(true);
			$currencysymb=vikrentcar::getCurrencySymb(true);
			?>
			<script type="text/javascript">
			function addMoreOverrides() {
				var sel = document.getElementById('val_pcent');
				var curpcent = sel.options[sel.selectedIndex].text;
				var ni = document.getElementById('myDiv');
				var numi = document.getElementById('morevalueoverrides');
				var num = (document.getElementById('morevalueoverrides').value -1)+ 2;
				numi.value = num;
				var newdiv = document.createElement('div');
				var divIdName = 'my'+num+'Div';
				newdiv.setAttribute('id',divIdName);
				newdiv.innerHTML = '<p><?php echo addslashes(JText::_('VRNEWSEASONNIGHTSOVR')); ?> <input type=\'text\' name=\'nightsoverrides[]\' value=\'\' size=\'4\'/> <select name=\'andmoreoverride[]\'><option value=\'0\'>-------</option><option value=\'1\'><?php echo addslashes(JText::_('VRNEWSEASONVALUESOVREMORE')); ?></option></select> - <?php echo addslashes(JText::_('VRNEWSEASONVALUESOVR')); ?> <input type=\'text\' name=\'valuesoverrides[]\' value=\'\' size=\'5\'/> '+curpcent+'</p>';
				ni.appendChild(newdiv);
			}
			jQuery.noConflict();
			jQuery(document).ready(function() {
				jQuery(".vrc-select-all").click(function(){
					jQuery(this).next("select").find("option").prop('selected', true);
				});
			});
			function togglePromotion() {
				var promo_on = document.getElementById('promo').checked;
				if(promo_on === true) {
					jQuery('.promotr').fadeIn();
					var cur_startd = jQuery('#from').val();
					jQuery('#promovalidity span').text('');
					if(cur_startd.length) {
						jQuery('#promovalidity span').text(' ('+cur_startd+')');
					}
				}else {
					jQuery('.promotr').fadeOut();
				}
			}
			</script>
			<input type="hidden" value="0" id="morevalueoverrides" />
			
			<form name="adminForm" id="adminForm" action="index.php" method="post">
				<fieldset class="adminform fieldset-left">
					<legend class="adminlegend"><?php echo JText::_('VRCSEASON'); ?> &nbsp;&nbsp;<?php echo JHTML::tooltip(JText::_('VRCSPRICESHELP'), JText::_('VRCSPRICESHELPTITLE'), 'tooltip.png', ''); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONONE'); ?></b> </td>
								<td><?php echo JHTML::_('calendar', '', 'from', 'from', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONTWO'); ?></b> </td>
								<td><?php echo JHTML::_('calendar', '', 'to', 'to', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPONLYPICKINCL'); ?></b> </td>
								<td><?php echo $vrc_app->printYesNoButtons('pickupincl', JText::_('VRYES'), JText::_('VRNO'), 0, 1, 0); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPKEEPFIRSTDAYRATE'); ?></b>  &nbsp;&nbsp;<?php echo JHTML::tooltip(JText::_('VRCSPKEEPFIRSTDAYRATEHELP'), JText::_('VRCSPKEEPFIRSTDAYRATE'), 'tooltip.png', ''); ?></td>
								<td><?php echo $vrc_app->printYesNoButtons('keepfirstdayrate', JText::_('VRYES'), JText::_('VRNO'), 0, 1, 0); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPYEARTIED'); ?></b> </td>
								<td><?php echo $vrc_app->printYesNoButtons('yeartied', JText::_('VRYES'), JText::_('VRNO'), 0, 1, 0); ?></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<fieldset class="adminform fieldset-left">
					<legend class="adminlegend"><?php echo JText::_('VRCWEEKDAYS'); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell" style="vertical-align: top;"> <b><?php echo JText::_('VRCSEASONDAYS'); ?></b> </td>
								<td><select multiple="multiple" size="7" name="wdays[]"><option value="0"><?php echo JText::_('VRCSUNDAY'); ?></option><option value="1"><?php echo JText::_('VRCMONDAY'); ?></option><option value="2"><?php echo JText::_('VRCTUESDAY'); ?></option><option value="3"><?php echo JText::_('VRCWEDNESDAY'); ?></option><option value="4"><?php echo JText::_('VRCTHURSDAY'); ?></option><option value="5"><?php echo JText::_('VRCFRIDAY'); ?></option><option value="6"><?php echo JText::_('VRCSATURDAY'); ?></option></select></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<br clear="all" />

				<fieldset class="adminform">
					<legend class="adminlegend"><?php echo JText::_('VRCSEASONPRICING'); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPNAME'); ?></b> </td>
								<td><input type="text" name="spname" value="" size="30"/></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONTHREE'); ?></b> </td>
								<td><select name="type"><option value="1"><?php echo JText::_('VRNEWSEASONSIX'); ?></option><option value="2"><?php echo JText::_('VRNEWSEASONSEVEN'); ?></option></select></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONFOUR'); ?></b> </td>
								<td><input type="text" name="diffcost" value="" size="5"/> <select name="val_pcent" id="val_pcent"><option value="2">%</option><option value="1"><?php echo $currencysymb; ?></option></select> &nbsp;<?php echo JHTML::tooltip(JText::_('VRSPECIALPRICEVALHELP'), JText::_('VRNEWSEASONFOUR'), 'tooltip.png', ''); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONVALUEOVERRIDE'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRNEWSEASONVALUEOVERRIDEHELP'), JText::_('VRNEWSEASONVALUEOVERRIDE'), 'tooltip.png', ''); ?> </td>
								<td><div id="myDiv" style="display: block;"></div><a href="javascript: void(0);" onclick="addMoreOverrides();"><?php echo JText::_('VRNEWSEASONADDOVERRIDE'); ?></a></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONROUNDCOST'); ?></b> </td>
								<td><select name="roundmode"><option value=""><?php echo JText::_('VRNEWSEASONROUNDCOSTNO'); ?></option><option value="PHP_ROUND_HALF_UP"><?php echo JText::_('VRNEWSEASONROUNDCOSTUP'); ?></option><option value="PHP_ROUND_HALF_DOWN"><?php echo JText::_('VRNEWSEASONROUNDCOSTDOWN'); ?></option></select></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONFIVE'); ?></b> </td>
								<td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wsel; ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPTYPESPRICE'); ?></b> </td>
								<td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wpricesel; ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONEIGHT'); ?></b> </td>
								<td><?php echo $wlocsel; ?></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<fieldset class="adminform">
					<legend class="adminlegend"><?php echo JText::_('VRCSPPROMOTIONLABEL'); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCISPROMOTION'); ?></b> </td>
								<td><input type="checkbox" id="promo" name="promo" value="1" onclick="togglePromotion();" /></td>
							</tr>
							<tr class="promotr">
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCPROMOVALIDITY'); ?></b> </td>
								<td><input type="text" name="promodaysadv" value="0" size="5"/><span id="promovalidity"><?php echo JText::_('VRCPROMOVALIDITYDAYSADV'); ?><span></span></span></td>
							</tr>
							<tr class="promotr">
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCPROMOTEXT'); ?></b> </td>
								<td><?php echo $editor->display( "promotxt", "", 400, 200, 70, 20 ); ?></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<input type="hidden" name="task" value="">
				<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}else {
			?>
			<p class="err"><a href="index.php?option=com_vikrentcar&amp;task=newcar"><?php echo JText::_('VRNOCARSFOUNDSEASONS'); ?></a></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}
	}
	
	public static function pEditSeason ($sdata, $wsel, $wpricesel, $wlocsel, $option) {
		$vrc_app = new VikApplication();
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		if(strlen($wsel) > 0) {
			JHTML::_('behavior.calendar');
			$caldf=vikrentcar::getDateFormat(true);
			$currencysymb=vikrentcar::getCurrencySymb(true);
			if ($caldf=="%d/%m/%Y") {
				$df='d/m/Y';
			}elseif ($caldf=="%m/%d/%Y") {
				$df='m/d/Y';
			}else {
				$df='Y/m/d';
			}
			if($sdata['from'] > 0 || $sdata['to'] > 0) {
				$nowyear=!empty($sdata['year']) ? $sdata['year'] : date('Y');
				$frombase=mktime(0, 0, 0, 1, 1, $nowyear);
				$fromdate=date($df, ($frombase + $sdata['from']));
				if($sdata['to'] < $sdata['from']) {
					$nowyear=$nowyear + 1;
					$frombase=mktime(0, 0, 0, 1, 1, $nowyear);
				}
				$todate=date($df, ($frombase + $sdata['to']));
				//leap years
				$checkly=!empty($sdata['year']) ? $sdata['year'] : date('Y');
				if($checkly % 4 == 0 && ($checkly % 100 != 0 || $checkly % 400 == 0)) {
					$frombase=mktime(0, 0, 0, 1, 1, $checkly);
					$infoseason = getdate($frombase + $sdata['from']);
					$leapts = mktime(0, 0, 0, 2, 29, $infoseason['year']);
					if($infoseason[0] >= $leapts) {
						$fromdate=date($df, ($frombase + $sdata['from'] + 86400));
						$frombase=mktime(0, 0, 0, 1, 1, $nowyear);
						$todate=date($df, ($frombase + $sdata['to'] + 86400));
					}
				}
				//
			}else {
				$fromdate = '';
				$todate = '';
			}
			$actweekdays = explode(";", $sdata['wdays']);
			
			$actvalueoverrides = '';
			if (strlen($sdata['losoverride']) > 0) {
				$losoverrides = explode('_', $sdata['losoverride']);
				foreach($losoverrides as $loso) {
					if (!empty($loso)) {
						$losoparts = explode(':', $loso);
						$losoparts[2] = strstr($losoparts[0], '-i') != false ? 1 : 0;
						$losoparts[0] = str_replace('-i', '', $losoparts[0]);
						$actvalueoverrides .= '<p>'.JText::_('VRNEWSEASONNIGHTSOVR').' <input type="text" name="nightsoverrides[]" value="'.$losoparts[0].'" size="4"/> <select name="andmoreoverride[]"><option value="0">-------</option><option value="1"'.($losoparts[2] == 1 ? ' selected="selected"' : '').'>'.JText::_('VRNEWSEASONVALUESOVREMORE').'</option></select> - '.JText::_('VRNEWSEASONVALUESOVR').' <input type="text" name="valuesoverrides[]" value="'.$losoparts[1].'" size="5"/> '.(intval($sdata['val_pcent']) == 2 ? '%' : $currencysymb).'</p>';
					}
				}
			}
			
			?>
			<script type="text/javascript">
			function addMoreOverrides() {
				var sel = document.getElementById('val_pcent');
				var curpcent = sel.options[sel.selectedIndex].text;
				var ni = document.getElementById('myDiv');
				var numi = document.getElementById('morevalueoverrides');
				var num = (document.getElementById('morevalueoverrides').value -1)+ 2;
				numi.value = num;
				var newdiv = document.createElement('div');
				var divIdName = 'my'+num+'Div';
				newdiv.setAttribute('id',divIdName);
				newdiv.innerHTML = '<p><?php echo addslashes(JText::_('VRNEWSEASONNIGHTSOVR')); ?> <input type=\'text\' name=\'nightsoverrides[]\' value=\'\' size=\'4\'/> <select name=\'andmoreoverride[]\'><option value=\'0\'>-------</option><option value=\'1\'><?php echo addslashes(JText::_('VRNEWSEASONVALUESOVREMORE')); ?></option></select> - <?php echo addslashes(JText::_('VRNEWSEASONVALUESOVR')); ?> <input type=\'text\' name=\'valuesoverrides[]\' value=\'\' size=\'5\'/> '+curpcent+'</p>';
				ni.appendChild(newdiv);
			}
			jQuery.noConflict();
			jQuery(document).ready(function() {
				jQuery(".vrc-select-all").click(function(){
					jQuery(this).next("select").find("option").prop('selected', true);
				});
			});
			function togglePromotion() {
				var promo_on = document.getElementById('promo').checked;
				if(promo_on === true) {
					jQuery('.promotr').fadeIn();
					var cur_startd = jQuery('#from').val();
					jQuery('#promovalidity span').text('');
					if(cur_startd.length) {
						jQuery('#promovalidity span').text(' ('+cur_startd+')');
					}
				}else {
					jQuery('.promotr').fadeOut();
				}
			}
			</script>
			<input type="hidden" value="0" id="morevalueoverrides" />
			
			<form name="adminForm" id="adminForm" action="index.php" method="post">
				<fieldset class="adminform fieldset-left">
					<legend class="adminlegend"><?php echo JText::_('VRCSEASON'); ?> &nbsp;&nbsp;<?php echo JHTML::tooltip(JText::_('VRCSPRICESHELP'), JText::_('VRCSPRICESHELPTITLE'), 'tooltip.png', ''); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONONE'); ?></b> </td>
								<td><?php echo JHTML::_('calendar', $fromdate, 'from', 'from', $caldf, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONTWO'); ?></b> </td>
								<td><?php echo JHTML::_('calendar', $todate, 'to', 'to', $caldf, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPONLYPICKINCL'); ?></b> </td>
								<td><?php echo $vrc_app->printYesNoButtons('pickupincl', JText::_('VRYES'), JText::_('VRNO'), (int)$sdata['pickupincl'], 1, 0); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPKEEPFIRSTDAYRATE'); ?></b>  &nbsp;&nbsp;<?php echo JHTML::tooltip(JText::_('VRCSPKEEPFIRSTDAYRATEHELP'), JText::_('VRCSPKEEPFIRSTDAYRATE'), 'tooltip.png', ''); ?></td>
								<td><?php echo $vrc_app->printYesNoButtons('keepfirstdayrate', JText::_('VRYES'), JText::_('VRNO'), (int)$sdata['keepfirstdayrate'], 1, 0); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPYEARTIED'); ?></b> </td>
								<td><?php echo $vrc_app->printYesNoButtons('yeartied', JText::_('VRYES'), JText::_('VRNO'), (!empty($sdata['year']) ? 1 : 0), 1, 0); ?></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<fieldset class="adminform fieldset-left">
					<legend class="adminlegend"><?php echo JText::_('VRCWEEKDAYS'); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell" style="vertical-align: top;"> <b><?php echo JText::_('VRCSEASONDAYS'); ?></b> </td>
								<td><select multiple="multiple" size="7" name="wdays[]"><option value="0"<?php echo (in_array("0", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCSUNDAY'); ?></option><option value="1"<?php echo (in_array("1", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCMONDAY'); ?></option><option value="2"<?php echo (in_array("2", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCTUESDAY'); ?></option><option value="3"<?php echo (in_array("3", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCWEDNESDAY'); ?></option><option value="4"<?php echo (in_array("4", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCTHURSDAY'); ?></option><option value="5"<?php echo (in_array("5", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCFRIDAY'); ?></option><option value="6"<?php echo (in_array("6", $actweekdays) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRCSATURDAY'); ?></option></select></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<br clear="all" />

				<fieldset class="adminform">
					<legend class="adminlegend"><?php echo JText::_('VRCSEASONPRICING'); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPNAME'); ?></b> </td>
								<td><input type="text" name="spname" value="<?php echo $sdata['spname']; ?>" size="30"/></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONTHREE'); ?></b> </td>
								<td><select name="type"><option value="1"<?php echo (intval($sdata['type']) == 1 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWSEASONSIX'); ?></option><option value="2"<?php echo (intval($sdata['type']) == 2 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWSEASONSEVEN'); ?></option></select></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONFOUR'); ?></b> </td>
								<td><input type="text" name="diffcost" value="<?php echo $sdata['diffcost']; ?>" size="5"/> <select name="val_pcent" id="val_pcent"><option value="2"<?php echo (intval($sdata['val_pcent']) == 2 ? " selected=\"selected\"" : ""); ?>>%</option><option value="1"<?php echo (intval($sdata['val_pcent']) == 1 ? " selected=\"selected\"" : ""); ?>><?php echo $currencysymb; ?></option></select> &nbsp;<?php echo JHTML::tooltip(JText::_('VRSPECIALPRICEVALHELP'), JText::_('VRNEWSEASONFOUR'), 'tooltip.png', ''); ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONVALUEOVERRIDE'); ?>:</b> <?php echo JHTML::tooltip(JText::_('VRNEWSEASONVALUEOVERRIDEHELP'), JText::_('VRNEWSEASONVALUEOVERRIDE'), 'tooltip.png', ''); ?> </td>
								<td><div id="myDiv" style="display: block;"><?php echo $actvalueoverrides; ?></div><a href="javascript: void(0);" onclick="addMoreOverrides();"><?php echo JText::_('VRNEWSEASONADDOVERRIDE'); ?></a></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONROUNDCOST'); ?></b> </td>
								<td><select name="roundmode"><option value=""><?php echo JText::_('VRNEWSEASONROUNDCOSTNO'); ?></option><option value="PHP_ROUND_HALF_UP"<?php echo ($sdata['roundmode'] == 'PHP_ROUND_HALF_UP' ? ' selected="selected"' : ''); ?>><?php echo JText::_('VRNEWSEASONROUNDCOSTUP'); ?></option><option value="PHP_ROUND_HALF_DOWN"<?php echo ($sdata['roundmode'] == 'PHP_ROUND_HALF_DOWN' ? ' selected="selected"' : ''); ?>><?php echo JText::_('VRNEWSEASONROUNDCOSTDOWN'); ?></option></select></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONFIVE'); ?></b> </td>
								<td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wsel; ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCSPTYPESPRICE'); ?></b> </td>
								<td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wpricesel; ?></td>
							</tr>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRNEWSEASONEIGHT'); ?></b> </td>
								<td><?php echo $wlocsel; ?></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<fieldset class="adminform">
					<legend class="adminlegend"><?php echo JText::_('VRCSPPROMOTIONLABEL'); ?></legend>
					<table cellspacing="1" class="admintable table">
						<tbody>
							<tr>
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCISPROMOTION'); ?></b> </td>
								<td><input type="checkbox" id="promo" name="promo" value="1" onclick="togglePromotion();" <?php echo $sdata['promo'] == 1 ? "checked=\"checked\"" : ""; ?>/></td>
							</tr>
							<tr class="promotr">
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCPROMOVALIDITY'); ?></b> </td>
								<td><input type="text" name="promodaysadv" value="<?php echo empty($sdata['promodaysadv']) ? '0' : $sdata['promodaysadv']; ?>" size="5"/><span id="promovalidity"><?php echo JText::_('VRCPROMOVALIDITYDAYSADV'); ?><span></span></span></td>
							</tr>
							<tr class="promotr">
								<td width="200" class="vrc-config-param-cell"> <b><?php echo JText::_('VRCPROMOTEXT'); ?></b> </td>
								<td><?php echo $editor->display( "promotxt", $sdata['promotxt'], 400, 200, 70, 20 ); ?></td>
							</tr>
						</tbody>
					</table>
				</fieldset>

				<input type="hidden" name="task" value="">
				<input type="hidden" name="option" value="<?php echo $option; ?>">
				<input type="hidden" name="where" value="<?php echo $sdata['id']; ?>">
			</form>
			<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#from').val('<?php echo $fromdate; ?>').attr('data-alt-value', '<?php echo $fromdate; ?>');
				jQuery('#to').val('<?php echo $todate; ?>').attr('data-alt-value', '<?php echo $todate; ?>');
			});
			togglePromotion();
			</script>
			<?php
		}else {
			?>
			<p class="err"><a href="index.php?option=com_vikrentcar&amp;task=newcar"><?php echo JText::_('VRNOCARSFOUNDSEASONS'); ?></a></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}
	}
	
	public static function pShowPayments ($rows, $option, $lim0="0", $navbut="") {
		$currencysymb=vikrentcar::getCurrencySymb(true);
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRNOPAYMENTS'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		
		?>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'removepayments') {
				if (confirm('<?php echo JText::_('VRJSDELPAYMENTS'); ?> ?')){
					submitform( pressbutton );
					return;
				}else{
					return false;
				}
			}

			// do field validation
			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			submitform( pressbutton );
		}
	</script>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPSHOWPAYMENTSONE' ); ?></th>
			<th class="title left" width="150"><?php echo JText::_( 'VRPSHOWPAYMENTSTWO' ); ?></th>
			<th class="title center" width="150" align="center"><?php echo JText::_( 'VRPSHOWPAYMENTSTHREE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRPSHOWPAYMENTSCHARGEORDISC' ); ?></th>
			<th class="title center" width="50" align="center"><?php echo JText::_( 'VRPSHOWPAYMENTSFIVE' ); ?></th>
		</tr>
		</thead>
		<?php
		
		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$saycharge = "";
			if(strlen($row['charge']) > 0 && $row['charge'] > 0.00) {
				$saycharge .= $row['ch_disc'] == 1 ? "+ " : "- ";
				$saycharge .= $row['charge']." ";
				$saycharge .= $row['val_pcent'] == 1 ? $currencysymb : "%";
			}
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editpayment&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
				<td><?php echo $row['file']; ?></td>
				<td><?php echo strip_tags($row['note']); ?></td>
				<td class="center"><?php echo $saycharge; ?></td>
				<td class="center"><?php echo intval($row['published']) == 1 ? "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/ok.png\"/>" : "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/images/no.png\"/>"; ?></td>
            </tr>  
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="payments" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}
	
	public static function pNewPayment ($option) {
		JHTML::_('behavior.tooltip');
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$allf=glob('./components/com_vikrentcar/payments/*.php');
		$psel="";
		if(@count($allf) > 0) {
			$classfiles=array();
			foreach($allf as $af) {
				$classfiles[]=str_replace('./components/com_vikrentcar/payments/', '', $af);
			}
			sort($classfiles);
			$psel="<select name=\"payment\" onchange=\"vikLoadPaymentParameters(this.value);\">\n<option value=\"\"></option>\n";
			foreach($classfiles as $cf) {
				$psel.="<option value=\"".$cf."\">".$cf."</option>\n";
			}
			$psel.="</select>";
		}
		$currencysymb=vikrentcar::getCurrencySymb(true);
		?>
		<script language="JavaScript" type="text/javascript">
		function vikLoadPaymentParameters(pfile) {
			jQuery.noConflict();
			if(pfile.length > 0) {
				jQuery("#vikparameters").html('<?php echo addslashes(JTEXT::_('VIKLOADING')); ?>');
				jQuery.ajax({
					type: "POST",
					url: "index.php?option=com_vikrentcar&task=loadpaymentparams&tmpl=component",
					data: { phpfile: pfile }
				}).done(function(res) {
					jQuery("#vikparameters").html(res);
				});
			}else {
				jQuery("#vikparameters").html('--------');
			}
		}
		</script>
		
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTONE'); ?>:</b> </td><td><input type="text" name="name" value="" size="30"/></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTTWO'); ?>:</b> </td><td><?php echo $psel; ?></td></tr>
		<tr><td width="170" style="vertical-align: top;">&bull; <b><?php echo JText::_('VRPAYMENTPARAMETERS'); ?>:</b> </td><td id="vikparameters"></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTTHREE'); ?>:</b> </td><td><select name="published"><option value="1"><?php echo JText::_('VRNEWPAYMENTSIX'); ?></option><option value="0"><?php echo JText::_('VRNEWPAYMENTSEVEN'); ?></option></select></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTCHARGEORDISC'); ?>:</b> </td><td><select name="ch_disc"><option value="1"><?php echo JText::_('VRNEWPAYMENTCHARGEPLUS'); ?></option><option value="2"><?php echo JText::_('VRNEWPAYMENTDISCMINUS'); ?></option></select> <input type="text" name="charge" value="" size="5"/> <select name="val_pcent"><option value="1"><?php echo $currencysymb; ?></option><option value="2">%</option></select></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTEIGHT'); ?>:</b> </td><td><select name="setconfirmed"><option value="1"><?php echo JText::_('VRNEWPAYMENTSIX'); ?></option><option value="0" selected="selected"><?php echo JText::_('VRNEWPAYMENTSEVEN'); ?></option></select></td> &nbsp; <?php echo JHTML::tooltip(JText::_('VRCPAYMENTSHELPCONFIRM'), JText::_('VRCPAYMENTSHELPCONFIRMTXT'), 'tooltip.png', ''); ?></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTNINE'); ?>:</b> </td><td><select name="shownotealw"><option value="1"><?php echo JText::_('VRNEWPAYMENTSIX'); ?></option><option value="0" selected="selected"><?php echo JText::_('VRNEWPAYMENTSEVEN'); ?></option></select></td></tr>
		<tr><td width="170" valign="top">&bull; <b><?php echo JText::_('VRNEWPAYMENTFIVE'); ?>:</b> </td><td><?php echo $editor->display( "note", "", 400, 200, 70, 20 ); ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}
	
	public static function pEditPayment ($payment, $option) {
		JHTML::_('behavior.tooltip');
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$allf=glob('./components/com_vikrentcar/payments/*.php');
		$psel="";
		if(@count($allf) > 0) {
			$classfiles=array();
			foreach($allf as $af) {
				$classfiles[]=str_replace('./components/com_vikrentcar/payments/', '', $af);
			}
			sort($classfiles);
			$psel="<select name=\"payment\" onchange=\"vikLoadPaymentParameters(this.value);\">\n<option value=\"\"></option>\n";
			foreach($classfiles as $cf) {
				$psel.="<option value=\"".$cf."\"".($cf==$payment['file'] ? " selected=\"selected\"" : "").">".$cf."</option>\n";
			}
			$psel.="</select>";
		}
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$payparams = vikrentcar::displayPaymentParameters($payment['file'], $payment['params']);
		?>
		<script language="JavaScript" type="text/javascript">
		function vikLoadPaymentParameters(pfile) {
			jQuery.noConflict();
			if(pfile.length > 0) {
				jQuery("#vikparameters").html('<?php echo addslashes(JTEXT::_('VIKLOADING')); ?>');
				jQuery.ajax({
					type: "POST",
					url: "index.php?option=com_vikrentcar&task=loadpaymentparams&tmpl=component",
					data: { phpfile: pfile }
				}).done(function(res) {
					jQuery("#vikparameters").html(res);
				});
			}else {
				jQuery("#vikparameters").html('--------');
			}
		}
		</script>
		
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTONE'); ?>:</b> </td><td><input type="text" name="name" value="<?php echo $payment['name']; ?>" size="30"/></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTTWO'); ?>:</b> </td><td><?php echo $psel; ?></td></tr>
		<tr><td width="170" style="vertical-align: top;">&bull; <b><?php echo JText::_('VRPAYMENTPARAMETERS'); ?>:</b> </td><td id="vikparameters"><?php echo $payparams; ?></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTTHREE'); ?>:</b> </td><td><select name="published"><option value="1"<?php echo intval($payment['published']) == 1 ? " selected=\"selected\"" : ""; ?>><?php echo JText::_('VRNEWPAYMENTSIX'); ?></option><option value="0"<?php echo intval($payment['published']) != 1 ? " selected=\"selected\"" : ""; ?>><?php echo JText::_('VRNEWPAYMENTSEVEN'); ?></option></select></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTCHARGEORDISC'); ?>:</b> </td><td><select name="ch_disc"><option value="1"<?php echo ($payment['ch_disc'] == 1 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWPAYMENTCHARGEPLUS'); ?></option><option value="2"<?php echo ($payment['ch_disc'] == 2 ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRNEWPAYMENTDISCMINUS'); ?></option></select> <input type="text" name="charge" value="<?php echo $payment['charge']; ?>" size="5"/> <select name="val_pcent"><option value="1"<?php echo ($payment['val_pcent'] == 1 ? " selected=\"selected\"" : ""); ?>><?php echo $currencysymb; ?></option><option value="2"<?php echo ($payment['val_pcent'] == 2 ? " selected=\"selected\"" : ""); ?>>%</option></select></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTEIGHT'); ?>:</b> </td><td><select name="setconfirmed"><option value="1"<?php echo intval($payment['setconfirmed']) == 1 ? " selected=\"selected\"" : ""; ?>><?php echo JText::_('VRNEWPAYMENTSIX'); ?></option><option value="0"<?php echo intval($payment['setconfirmed']) != 1 ? " selected=\"selected\"" : ""; ?>><?php echo JText::_('VRNEWPAYMENTSEVEN'); ?></option></select> &nbsp; <?php echo JHTML::tooltip(JText::_('VRCPAYMENTSHELPCONFIRM'), JText::_('VRCPAYMENTSHELPCONFIRMTXT'), 'tooltip.png', ''); ?></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VRNEWPAYMENTNINE'); ?>:</b> </td><td><select name="shownotealw"><option value="1"<?php echo intval($payment['shownotealw']) == 1 ? " selected=\"selected\"" : ""; ?>><?php echo JText::_('VRNEWPAYMENTSIX'); ?></option><option value="0"<?php echo intval($payment['shownotealw']) != 1 ? " selected=\"selected\"" : ""; ?>><?php echo JText::_('VRNEWPAYMENTSEVEN'); ?></option></select></td></tr>
		<tr><td width="170" valign="top">&bull; <b><?php echo JText::_('VRNEWPAYMENTFIVE'); ?>:</b> </td><td><?php echo $editor->display( "note", $payment['note'], 400, 200, 70, 20 ); ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="where" value="<?php echo $payment['id']; ?>">
		</form>
		<?php
	}
	
	public static function pViewExport ($oids, $locations, $option) {
		JHTML::_('behavior.calendar');
		$nowdf = vikrentcar::getDateFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$optlocations = '';
		if (is_array($locations) && count($locations) > 0) {
			foreach($locations as $loc) {
				$optlocations .= '<option value="'.$loc['id'].'">'.$loc['name'].'</option>';
			}
		}
		$xml_export = '<select name="xml_file">';
		$xml_path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'xml_export'.DS;
		$xml_files = glob($xml_path.'*.xml.php');
		foreach ($xml_files as $xml_file) {
			$xml_name = str_replace($xml_path, '', $xml_file);
			$xml_export .= '<option value="'.$xml_name.'">'.$xml_name.'</option>'."\n";
		}
		$xml_export .= '</select>';
		?>
		<script type="text/javascript">
		jQuery.noConflict();
		function vrcExportSetType(val) {
			if(val == 'csv') {
				document.getElementById('vrcexpdateftr').style.display = '';
			}else {
				jQuery('#vrcexpdateftr').fadeOut();
			}
			if(val == 'xml') {
				jQuery('#vrcexpxmlfile').fadeIn();
			}else {
				jQuery('#vrcexpxmlfile').fadeOut();
			}
		}
		</script>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
		<table class="adminform">
		<?php
		if(!(count($oids) > 0)) {
		?>
		<tr><td width="170">&bull; <b><?php echo JText::_('VREXPORTDATETYPE'); ?>:</b> </td><td><select name="datetype"><option value="ritiro"><?php echo JText::_('VREXPORTDATETYPEPICK'); ?></option><option value="ts"><?php echo JText::_('VREXPORTDATETYPETS'); ?></option></select></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VREXPORTONE'); ?>:</b> </td><td><?php echo JHTML::_('calendar', '', 'from', 'from', $nowdf, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VREXPORTTWO'); ?>:</b> </td><td><?php echo JHTML::_('calendar', '', 'to', 'to', $nowdf, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VREXPORTELEVEN'); ?>:</b> </td><td><select name="location"><option value="">--------</option><?php echo $optlocations; ?></select></td></tr>
		<?php
		}else {
			foreach($oids as $oid) {
				echo '<input type="hidden" name="cid[]" value="'.$oid.'"/>'."\n";
			}
			?>
		<tr><td width="170" colspan="2">&bull; <b><?php echo JText::sprintf('VREXPORTNUMORDS', count($oids)); ?></b></td></tr>
			<?php
		}
		?>
		<tr><td width="170">&bull; <b><?php echo JText::_('VREXPORTTHREE'); ?>:</b> </td><td><select name="type" id="vrctype" onchange="vrcExportSetType(this.value);"><option value="csv"><?php echo JText::_('VREXPORTFOUR'); ?></option><option value="ics"><?php echo JText::_('VREXPORTFIVE'); ?></option><option value="xml"><?php echo JText::_('VREXPORTXML'); ?></option></select></td></tr>
		<tr id="vrcexpxmlfile" style="display: none;"><td>&bull; <b><?php echo JText::_('VREXPORTCHOOSEXML'); ?>:</b> </td><td><?php echo $xml_export; ?></td></tr>
		<tr id="vrcexpdateftr" style=""><td width="170">&bull; <b><?php echo JText::_('VREXPORTTEN'); ?>:</b> </td><td><select name="dateformat"><option value="Y/m/d"<?php echo $df == 'Y/m/d' ? " selected=\"selected\"" : ""; ?>>Y/m/d</option><option value="m/d/Y"<?php echo $df == 'm/d/Y' ? " selected=\"selected\"" : ""; ?>>m/d/Y</option><option value="d/m/Y"<?php echo $df == 'd/m/Y' ? " selected=\"selected\"" : ""; ?>>d/m/Y</option><option value="Y-m-d">Y-m-d</option><option value="m-d-Y">m-d-Y</option><option value="d-m-Y">d-m-Y</option><option value="ts">Unix Timestamp</option></select></td></tr>
		<tr><td width="170">&bull; <b><?php echo JText::_('VREXPORTSIX'); ?>:</b> </td><td><select name="status"><option value="C"><?php echo JText::_('VREXPORTSEVEN'); ?></option><option value="CP"><?php echo JText::_('VREXPORTEIGHT'); ?></option></select></td></tr>
		<tr><td width="170">&nbsp;</td><td><button type="submit" class="btn"><i class="vrcicn-cloud-download"></i> <?php echo JText::_('VREXPORTNINE'); ?></button></td></tr>
		</table>
		<input type="hidden" name="task" value="doexport">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}

	public static function pViewOohfees ($rows, $option, $lim0="0", $navbut="") {
		if(empty($rows)){
			?>
			<p class="warn"><?php echo JText::_('VRCNOOOHFEESFOUND'); ?></p>
			<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			</form>
			<?php
		}else{
		?>

	<form action="index.php?option=com_vikrentcar" method="post" name="adminForm" id="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="table table-striped">
		<thead>
		<tr>
			<th width="20">
				<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle">
			</th>
			<th class="title left" width="200"><?php echo JText::_( 'VRCPVIEWOOHFEESONE' ); ?></th>
			<th class="title center" width="200" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESTWO' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESTHREE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESFOUR' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESFIVE' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCWEEKDAYS' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESSEVEN' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESEIGHT' ); ?></th>
			<th class="title center" width="100" align="center"><?php echo JText::_( 'VRCPVIEWOOHFEESNINE' ); ?></th>
		</tr>
		</thead>
		<?php
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$base_time = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
		$k = 0;
		$i = 0;
		for ($i = 0, $n = count($rows); $i < $n; $i++) {
			$row = $rows[$i];
			$tot_cars = !empty($row['idcars']) ? ((int)count(explode(',', $row['idcars'])) - 1) : 0;
			$tot_cars = $tot_cars > 0 ? $tot_cars : 0;
			$pickdrop = $row['type'] == 1 ? JText::_('VRCPVIEWOOHFEESTEN') : ($row['type'] == 2 ? JText::_('VRCPVIEWOOHFEESELEVEN') : JText::_('VRCPVIEWOOHFEESTWELVE'));
			$wdays_parts = explode(",", $row['wdays']);
			?>
			<tr class="row<?php echo $k; ?>">
				<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="Joomla.isChecked(this.checked);"></td>
				<td><a href="index.php?option=com_vikrentcar&amp;task=editoohfee&amp;cid[]=<?php echo $row['id']; ?>"><?php echo $row['oohname']; ?></a></td>
				<td class="center"><?php echo date($nowtf, ($base_time + $row['from'])); ?></td>
				<td class="center"><?php echo date($nowtf, ($base_time + $row['to'])); ?></td>
				<td class="center"><?php echo $row['pickcharge']; ?></td>
				<td class="center"><?php echo $row['dropcharge']; ?></td>
				<td class="center"><?php echo count($wdays_parts); ?></td>
				<td class="center"><?php echo $tot_cars; ?></td>
				<td class="center"><?php echo $row['tot_xref']; ?></td>
				<td class="center"><?php echo $pickdrop; ?></td>
			</tr>
              <?php
            $k = 1 - $k;
		}
		?>
		
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<?php
		if(defined('JVERSION') && version_compare(JVERSION, '1.6.0') < 0) {
			//Joomla 1.5
			
		}
		?>
		<input type="hidden" name="task" value="oohfees" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHTML::_( 'form.token' ); ?>
		<?php echo $navbut; ?>
	</form>
	<?php
		}
	}

	public static function pNewOohfee ($wselcars, $wselplaces, $option) {
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$df=vikrentcar::getDateFormat(true);
		$fromsel = "<select name=\"from\">\n";
		for ($i=0; $i <= 23; $i++) { 
			$h = $i < 10 ? '0'.$i : $i;
			$seconds = $i * 3600;
			for ($j=0; $j < 60; $j+=15) {
				$seconds += $j > 0 ? (15 * 60) : 0;
				$m = $j < 10 ? '0'.$j : $j;
				$fromsel .= '<option value="'.$seconds.'">'.$h.' : '.$m.'</option>'."\n";
			}
		}
		$fromsel .= "</select>\n";
		$tosel = "<select name=\"to\">\n";
		for ($i=0; $i <= 23; $i++) { 
			$h = $i < 10 ? '0'.$i : $i;
			$seconds = $i * 3600;
			for ($j=0; $j < 60; $j+=15) {
				$seconds += $j > 0 ? (15 * 60) : 0;
				$m = $j < 10 ? '0'.$j : $j;
				$tosel .= '<option value="'.$seconds.'">'.$h.' : '.$m.'</option>'."\n";
			}

		}
		$tosel .= "</select>\n";
		$dbo = JFactory::getDBO();
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"aliq\"><option value=\"\"> </option>\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
			$wiva.="</select>\n";
		}else {
			$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('VRNOIVAFOUND')."</a>";
		}
		$wselwdays = "<select name=\"wdays[]\" multiple=\"multiple\" size=\"7\">\n";
		$wdays_map = array(JText::_('VRCSUNDAY'), JText::_('VRCMONDAY'), JText::_('VRCTUESDAY'), JText::_('VRCWEDNESDAY'), JText::_('VRCTHURSDAY'), JText::_('VRCFRIDAY'), JText::_('VRCSATURDAY'));
		for ($oj=0; $oj < 7; $oj++) { 
			$wselwdays .= "<option value=\"".$oj."\" selected=\"selected\">".$wdays_map[$oj]."</option>\n";
		}
		$wselwdays .= "</select>\n";
		?>
		<script type="text/javascript">
		jQuery.noConflict();
		function vrcMaxChargeOohf() {
			var pick_charge = jQuery("#pickcharge").val().length ? parseFloat(jQuery("#pickcharge").val()) : 0.00;
			var drop_charge = jQuery("#dropcharge").val().length ? parseFloat(jQuery("#dropcharge").val()) : 0.00;
			var max_charge = pick_charge + drop_charge;
			jQuery("#maxcharge").val(max_charge.toFixed(2));
		}
		jQuery(document).ready(function() {
			jQuery(".vrc-select-all").click(function(){
				jQuery(this).next("select").find("option").prop('selected', true);
			});
			jQuery("#pickcharge, #dropcharge").keyup(function(){
				vrcMaxChargeOohf();
			});
		});
		</script>
		<form name="adminForm" action="index.php" method="post" id="adminForm">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESONE'); ?>:</b> </td><td><input type="text" name="name" value="" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESTWO'); ?>:</b> </td><td><?php echo $fromsel; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESTHREE'); ?>:</b> </td><td><?php echo $tosel; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESFOUR'); ?>:</b> </td><td><input type="text" id="pickcharge" name="pickcharge" placeholder="0.00" value="" size="4"/> <?php echo $currencysymb; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESFIVE'); ?>:</b> </td><td><input type="text" id="dropcharge" name="dropcharge" placeholder="0.00" value="" size="4"/> <?php echo $currencysymb; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESSIX'); ?>:</b> </td><td><input type="text" id="maxcharge" name="maxcharge" value="" size="4"/> <?php echo $currencysymb; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCWEEKDAYS'); ?>:</b> </td><td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wselwdays; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESSEVEN'); ?>:</b> </td><td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wselcars; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESEIGHT'); ?>:</b> </td><td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wselplaces; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESNINE'); ?>:</b> </td><td><select name="type"><option value="1"><?php echo JText::_('VRCPVIEWOOHFEESTEN'); ?></option><option value="2"><?php echo JText::_('VRCPVIEWOOHFEESELEVEN'); ?></option><option value="3"><?php echo JText::_('VRCPVIEWOOHFEESTWELVE'); ?></option></select></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESTAX'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<?php
	}

	public static function pEditOohfee ($oohfee, $wselcars, $wselplaces, $option) {
		$currencysymb=vikrentcar::getCurrencySymb(true);
		$df=vikrentcar::getDateFormat(true);
		$fromsel = "<select name=\"from\">\n";
		for ($i=0; $i <= 23; $i++) { 
			$h = $i < 10 ? '0'.$i : $i;
			$seconds = $i * 3600;
			for ($j=0; $j < 60; $j+=15) {
				$seconds += $j > 0 ? (15 * 60) : 0;
				$m = $j < 10 ? '0'.$j : $j;
				$fromsel .= '<option value="'.$seconds.'"'.($oohfee['from'] == $seconds ? ' selected="selected"' : '').'>'.$h.' : '.$m.'</option>'."\n";
			}
		}
		$fromsel .= "</select>\n";
		$tosel = "<select name=\"to\">\n";
		for ($i=0; $i <= 23; $i++) { 
			$h = $i < 10 ? '0'.$i : $i;
			$seconds = $i * 3600;
			for ($j=0; $j < 60; $j+=15) {
				$seconds += $j > 0 ? (15 * 60) : 0;
				$m = $j < 10 ? '0'.$j : $j;
				$tosel .= '<option value="'.$seconds.'"'.($oohfee['to'] == $seconds ? ' selected="selected"' : '').'>'.$h.' : '.$m.'</option>'."\n";
			}

		}
		$tosel .= "</select>\n";
		$dbo = JFactory::getDBO();
		$q="SELECT * FROM `#__vikrentcar_iva`;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$ivas=$dbo->loadAssocList();
			$wiva="<select name=\"aliq\"><option value=\"\"> </option>\n";
			foreach($ivas as $iv){
				$wiva.="<option value=\"".$iv['id']."\"".($oohfee['idiva']==$iv['id'] ? " selected=\"selected\"" : "").">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
			}
			$wiva.="</select>\n";
		}else {
			$wiva="<a href=\"index.php?option=com_vikrentcar&task=viewiva\">".JText::_('VRNOIVAFOUND')."</a>";
		}
		$wselwdays = "<select name=\"wdays[]\" multiple=\"multiple\" size=\"7\">\n";
		$cur_wdays = explode(',', $oohfee['wdays']);
		$wdays_map = array(JText::_('VRCSUNDAY'), JText::_('VRCMONDAY'), JText::_('VRCTUESDAY'), JText::_('VRCWEDNESDAY'), JText::_('VRCTHURSDAY'), JText::_('VRCFRIDAY'), JText::_('VRCSATURDAY'));
		for ($oj=0; $oj < 7; $oj++) { 
			$wselwdays .= "<option value=\"".$oj."\"".(in_array('-'.$oj.'-', $cur_wdays) ? " selected=\"selected\"" : "").">".$wdays_map[$oj]."</option>\n";
		}
		$wselwdays .= "</select>\n";
		?>
		<script type="text/javascript">
		jQuery.noConflict();
		function vrcMaxChargeOohf() {
			var pick_charge = jQuery("#pickcharge").val().length ? parseFloat(jQuery("#pickcharge").val()) : 0.00;
			var drop_charge = jQuery("#dropcharge").val().length ? parseFloat(jQuery("#dropcharge").val()) : 0.00;
			var max_charge = pick_charge + drop_charge;
			jQuery("#maxcharge").val(max_charge.toFixed(2));
		}
		jQuery(document).ready(function() {
			jQuery(".vrc-select-all").click(function(){
				jQuery(this).next("select").find("option").prop('selected', true);
			});
			jQuery("#pickcharge, #dropcharge").keyup(function(){
				vrcMaxChargeOohf();
			});
		});
		</script>
		<form name="adminForm" action="index.php" method="post" id="adminForm">
		<table class="adminform">
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESONE'); ?>:</b> </td><td><input type="text" name="name" value="<?php echo $oohfee['oohname']; ?>" size="40"/></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESTWO'); ?>:</b> </td><td><?php echo $fromsel; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESTHREE'); ?>:</b> </td><td><?php echo $tosel; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESFOUR'); ?>:</b> </td><td><input type="text" id="pickcharge" name="pickcharge" placeholder="0.00" value="<?php echo $oohfee['pickcharge']; ?>" size="4"/> <?php echo $currencysymb; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESFIVE'); ?>:</b> </td><td><input type="text" id="dropcharge" name="dropcharge" placeholder="0.00" value="<?php echo $oohfee['dropcharge']; ?>" size="4"/> <?php echo $currencysymb; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESSIX'); ?>:</b> </td><td><input type="text" id="maxcharge" name="maxcharge" value="<?php echo $oohfee['maxcharge']; ?>" size="4"/> <?php echo $currencysymb; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCWEEKDAYS'); ?>:</b> </td><td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wselwdays; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESSEVEN'); ?>:</b> </td><td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wselcars; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESEIGHT'); ?>:</b> </td><td><span class="vrc-select-all"><?php echo JText::_('VRCSELECTALL'); ?></span><?php echo $wselplaces; ?></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESNINE'); ?>:</b> </td><td><select name="type"><option value="1"<?php echo $oohfee['type'] == 1 ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCPVIEWOOHFEESTEN'); ?></option><option value="2"<?php echo $oohfee['type'] == 2 ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCPVIEWOOHFEESELEVEN'); ?></option><option value="3"<?php echo $oohfee['type'] == 3 ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCPVIEWOOHFEESTWELVE'); ?></option></select></td></tr>
		<tr><td width="200">&bull; <b><?php echo JText::_('VRCPVIEWOOHFEESTAX'); ?>:</b> </td><td><?php echo $wiva; ?></td></tr>
		</table>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="where" value="<?php echo $oohfee['id']; ?>">
		</form>
		<?php
	}

	public static function pViewTranslations($vrc_tn, $option) {
		$editor = JEditor::getInstance(JFactory::getApplication()->get('editor'));
		$langs = $vrc_tn->getLanguagesList();
		$xml_tables = $vrc_tn->getTranslationTables();
		$active_table = '';
		$active_table_key = '';
		if(!(count($langs) > 1)) {
			//Error: only one language is published. Translations are useless
			?>
			<p class="err"><?php echo JText::_('VRCTRANSLATIONERRONELANG'); ?></p>
			<form name="adminForm" id="adminForm" action="index.php" method="post">
				<input type="hidden" name="task" value="">
				<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}elseif(!(count($xml_tables) > 0) || strlen($vrc_tn->getError())) {
			//Error: XML file not readable or errors occurred
			?>
			<p class="err"><?php echo $vrc_tn->getError(); ?></p>
			<form name="adminForm" id="adminForm" action="index.php" method="post">
				<input type="hidden" name="task" value="">
				<input type="hidden" name="option" value="<?php echo $option; ?>">
			</form>
			<?php
		}else {
			$cur_langtab = VikRequest::getString('vrc_lang', '', 'request');
			$table = VikRequest::getString('vrc_table', '', 'request');
			if(!empty($table)) {
				$table = $vrc_tn->replacePrefix($table);
			}
		?>
		<script type="text/Javascript">
		var vrc_tn_changes = false;
		jQuery(document).ready(function(){
			jQuery('#adminForm input[type=text], #adminForm textarea').change(function() {
				vrc_tn_changes = true;
			});
		});
		function vrcCheckChanges() {
			if(!vrc_tn_changes) {
				return true;
			}
			return confirm("<?php echo addslashes(JText::_('VRCTANSLATIONSCHANGESCONF')); ?>");
		}
		</script>
		<form action="index.php?option=com_vikrentcar&amp;task=translations" method="post" onsubmit="return vrcCheckChanges();">
			<div style="width: 100%; display: inline-block;" class="btn-toolbar" id="filter-bar">
				<div class="btn-group pull-right">
					<button class="btn" type="submit"><?php echo JText::_('VRCGETTRANSLATIONS'); ?></button>
				</div>
				<div class="btn-group pull-right">
					<select name="vrc_table">
						<option value="">-----------</option>
					<?php
					foreach ($xml_tables as $key => $value) {
						$active_table = $vrc_tn->replacePrefix($key) == $table ? $value : $active_table;
						$active_table_key = $vrc_tn->replacePrefix($key) == $table ? $key : $active_table_key;
						?>
						<option value="<?php echo $key; ?>"<?php echo $vrc_tn->replacePrefix($key) == $table ? ' selected="selected"' : ''; ?>><?php echo $value; ?></option>
						<?php
					}
					?>
					</select>
				</div>
			</div>
			<input type="hidden" name="vrc_lang" class="vrc_lang" value="<?php echo $vrc_tn->default_lang; ?>">
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="translations" />
		</form>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
			<div class="vrc-translation-langtabs">
		<?php
		foreach ($langs as $ltag => $lang) {
			$is_def = ($ltag == $vrc_tn->default_lang);
			$lcountry = substr($ltag, 0, 2);
			$flag = file_exists(JPATH_SITE.DS.'media'.DS.'mod_languages'.DS.'images'.DS.$lcountry.'.gif') ? '<img src="'.JURI::root().'media/mod_languages/images/'.$lcountry.'.gif"/>' : '';
				?>
				<div class="vrc-translation-tab<?php echo $is_def ? ' vrc-translation-tab-default' : ''; ?>" data-vrclang="<?php echo $ltag; ?>">
				<?php
				if(!empty($flag)) {
					?>
					<span class="vrc-translation-flag"><?php echo $flag; ?></span>
					<?php
				}
				?>
					<span class="vrc-translation-langname"><?php echo $lang['name']; ?></span>
				</div>
			<?php
		}
		?>
				<div class="vrc-translation-tab vrc-translation-tab-ini" data-vrclang="">
					<span class="vrc-translation-iniflag">.INI</span>
					<span class="vrc-translation-langname"><?php echo JText::_('VRCTRANSLATIONINISTATUS'); ?></span>
				</div>
			</div>
			<div class="vrc-translation-tabscontents">
		<?php
		$table_cols = !empty($active_table_key) ? $vrc_tn->getTableColumns($active_table_key) : array();
		$table_def_dbvals = !empty($active_table_key) ? $vrc_tn->getTableDefaultDbValues($active_table_key, array_keys($table_cols)) : array();
		if(!empty($active_table_key)) {
			echo '<input type="hidden" name="vrc_table" value="'.$active_table_key.'"/>'."\n";
		}
		foreach ($langs as $ltag => $lang) {
			$is_def = ($ltag == $vrc_tn->default_lang);
			?>
				<div class="vrc-translation-langcontent" style="display: <?php echo $is_def ? 'block' : 'none'; ?>;" id="vrc_langcontent_<?php echo $ltag; ?>">
			<?php
			if(empty($active_table_key)) {
				?>
					<p class="warn"><?php echo JText::_('VRCTRANSLATIONSELTABLEMESS'); ?></p>
				<?php
			}elseif(strlen($vrc_tn->getError()) > 0) {
				?>
					<p class="err"><?php echo $vrc_tn->getError(); ?></p>
				<?php
			}else {
				?>
					<fieldset class="adminform">
						<legend class="adminlegend"><?php echo $active_table; ?> - <?php echo $lang['name'].($is_def ? ' - '.JText::_('VRCTRANSLATIONDEFLANG') : ''); ?></legend>
						<table cellspacing="1" class="admintable table">
							<tbody>
				<?php
				if($is_def) {
					//Values of Default Language to be translated
					foreach ($table_def_dbvals as $reference_id => $values) {
						?>
								<tr data-reference="<?php echo $ltag.'-'.$reference_id; ?>">
									<td class="vrc-translate-reference-cell" colspan="2"><?php echo $vrc_tn->getRecordReferenceName($table_cols, $values); ?></td>
								</tr>
						<?php
						foreach ($values as $field => $def_value) {
							$title = $table_cols[$field]['jlang'];
							$type = $table_cols[$field]['type'];
							if($type == 'html') {
								$def_value = strip_tags($def_value);
							}
							?>
								<tr data-reference="<?php echo $ltag.'-'.$reference_id; ?>">
									<td width="200" class="vrc-translate-column-cell"> <b><?php echo $title; ?></b> </td>
									<td><?php echo $type != 'json' ? $def_value : ''; ?></td>
								</tr>
							<?php
							if($type == 'json') {
								$tn_keys = $table_cols[$field]['keys'];
								$keys = !empty($tn_keys) ? explode(',', $tn_keys) : array();
								$json_def_values = json_decode($def_value, true);
								if(count($json_def_values) > 0) {
									foreach ($json_def_values as $jkey => $jval) {
										if((!in_array($jkey, $keys) && count($keys) > 0) || empty($jval)) {
											continue;
										}
										?>
								<tr data-reference="<?php echo $ltag.'-'.$reference_id; ?>">
									<td width="200" class="vrc-translate-column-cell"><?php echo !is_numeric($jkey) ? ucwords($jkey) : '&nbsp;'; ?></td>
									<td><?php echo $jval; ?></td>
								</tr>
										<?php
									}
								}
							}
							?>
							<?php
						}
					}
				}else {
					//Translation Fields for this language
					$lang_record_tn = $vrc_tn->getTranslatedTable($active_table_key, $ltag);
					foreach ($table_def_dbvals as $reference_id => $values) {
						?>
								<tr data-reference="<?php echo $ltag.'-'.$reference_id; ?>">
									<td class="vrc-translate-reference-cell" colspan="2"><?php echo $vrc_tn->getRecordReferenceName($table_cols, $values); ?></td>
								</tr>
						<?php
						foreach ($values as $field => $def_value) {
							$title = $table_cols[$field]['jlang'];
							$type = $table_cols[$field]['type'];
							if($type == 'skip') {
								continue;
							}
							$tn_value = '';
							$tn_class = ' vrc-missing-translation';
							if(array_key_exists($reference_id, $lang_record_tn) && array_key_exists($field, $lang_record_tn[$reference_id]['content']) && strlen($lang_record_tn[$reference_id]['content'][$field])) {
								if(in_array($type, array('text', 'textarea', 'html'))) {
									$tn_class = ' vrc-field-translated';
								}else {
									$tn_class = '';
								}
							}
							?>
								<tr data-reference="<?php echo $ltag.'-'.$reference_id; ?>">
									<td width="200" class="vrc-translate-column-cell<?php echo $tn_class; ?>"<?php echo in_array($type, array('textarea', 'html')) ? ' style="vertical-align: top !important;"' : ''; ?>> <b><?php echo $title; ?></b> </td>
									<td>
							<?php
							if($type == 'text') {
								if(array_key_exists($reference_id, $lang_record_tn) && array_key_exists($field, $lang_record_tn[$reference_id]['content'])) {
									$tn_value = $lang_record_tn[$reference_id]['content'][$field];
								}
								?>
										<input type="text" name="tn[<?php echo $ltag; ?>][<?php echo $reference_id; ?>][<?php echo $field; ?>]" value="<?php echo $tn_value; ?>" size="40" placeholder="<?php echo $def_value; ?>"/>
								<?php
							}elseif($type == 'textarea') {
								if(array_key_exists($reference_id, $lang_record_tn) && array_key_exists($field, $lang_record_tn[$reference_id]['content'])) {
									$tn_value = $lang_record_tn[$reference_id]['content'][$field];
								}
								?>
										<textarea name="tn[<?php echo $ltag; ?>][<?php echo $reference_id; ?>][<?php echo $field; ?>]" rows="5" cols="40"><?php echo $tn_value; ?></textarea>
								<?php
							}elseif($type == 'html') {
								if(array_key_exists($reference_id, $lang_record_tn) && array_key_exists($field, $lang_record_tn[$reference_id]['content'])) {
									$tn_value = $lang_record_tn[$reference_id]['content'][$field];
								}
								echo $editor->display( "tn[".$ltag."][".$reference_id."][".$field."]", $tn_value, 500, 350, 70, 20, true, "tn_".$ltag."_".$reference_id."_".$field );
							}
							?>
									</td>
								</tr>
							<?php
							if($type == 'json') {
								$tn_keys = $table_cols[$field]['keys'];
								$keys = !empty($tn_keys) ? explode(',', $tn_keys) : array();
								$json_def_values = json_decode($def_value, true);
								if(count($json_def_values) > 0) {
									$tn_json_value = array();
									if(array_key_exists($reference_id, $lang_record_tn) && array_key_exists($field, $lang_record_tn[$reference_id]['content'])) {
										$tn_json_value = json_decode($lang_record_tn[$reference_id]['content'][$field], true);
									}
									foreach ($json_def_values as $jkey => $jval) {
										if((!in_array($jkey, $keys) && count($keys) > 0) || empty($jval)) {
											continue;
										}
										?>
								<tr data-reference="<?php echo $ltag.'-'.$reference_id; ?>">
									<td width="200" class="vrc-translate-column-cell"><?php echo !is_numeric($jkey) ? ucwords($jkey) : '&nbsp;'; ?></td>
									<td><input type="text" name="tn[<?php echo $ltag; ?>][<?php echo $reference_id; ?>][<?php echo $field; ?>][<?php echo $jkey; ?>]" value="<?php echo $tn_json_value[$jkey]; ?>" size="40"/></td>
								</tr>
										<?php
									}
								}
							}
						}
					}
				}
				?>
							</tbody>
						</table>
					</fieldset>
				<?php
				//echo '<pre>'.print_r($table_def_dbvals, true).'</pre><br/>';
				//echo '<pre>'.print_r($table_cols, true).'</pre><br/>';
			}
			?>
				</div>
			<?php
		}
		//ini files status
		$all_inis = $vrc_tn->getIniFiles();
		?>
				<div class="vrc-translation-langcontent" style="display: none;" id="vrc_langcontent_ini">
					<fieldset class="adminform">
						<legend class="adminlegend">.INI <?php echo JText::_('VRCTRANSLATIONINISTATUS'); ?></legend>
						<table cellspacing="1" class="admintable table">
							<tbody>
							<?php
							foreach ($all_inis as $initype => $inidet) {
								$inipath = $inidet['path'];
								?>
								<tr>
									<td class="vrc-translate-reference-cell" colspan="2"><?php echo JText::_('VRCINIEXPL'.strtoupper($initype)); ?></td>
								</tr>
								<?php
								foreach ($langs as $ltag => $lang) {
									$t_file_exists = file_exists(str_replace('en-GB', $ltag, $inipath));
									$t_parsed_ini = $t_file_exists ? parse_ini_file(str_replace('en-GB', $ltag, $inipath)) : false;
									?>
								<tr>
									<td width="200" class="vrc-translate-column-cell <?php echo $t_file_exists ? 'vrc-field-translated' : 'vrc-missing-translation'; ?>"> <b><?php echo ($ltag == 'en-GB' ? 'Native ' : '').$lang['name']; ?></b> </td>
									<td>
										<span class="vrc-inifile-totrows <?php echo $t_file_exists ? 'vrc-inifile-exists' : 'vrc-inifile-notfound'; ?>"><?php echo $t_file_exists && $t_parsed_ini !== false ? JText::_('VrcINIDEFINITIONS').': '.count($t_parsed_ini) : JText::_('VrcINIMISSINGFILE'); ?></span>
										<span class="vrc-inifile-path <?php echo $t_file_exists ? 'vrc-inifile-exists' : 'vrc-inifile-notfound'; ?>"><?php echo JText::_('VrcINIPATH').': '.str_replace('en-GB', $ltag, $inipath); ?></span>
									</td>
								</tr>
									<?php
								}
							}
							?>
							</tbody>
						</table>
					</fieldset>
				</div>
			<?php
			//end ini files status
			?>
			</div>
			<input type="hidden" name="vrc_lang" class="vrc_lang" value="<?php echo $vrc_tn->default_lang; ?>">
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<script type="text/Javascript">
		jQuery(document).ready(function(){
			jQuery('.vrc-translation-tab').click(function() {
				var langtag = jQuery(this).attr('data-vrclang');
				if(jQuery('#vrc_langcontent_'+langtag).length) {
					jQuery('.vrc_lang').val(langtag);
					jQuery('.vrc-translation-tab').removeClass('vrc-translation-tab-default');
					jQuery(this).addClass('vrc-translation-tab-default');
					jQuery('.vrc-translation-langcontent').hide();
					jQuery('#vrc_langcontent_'+langtag).fadeIn();
				}else {
					jQuery('.vrc-translation-tab').removeClass('vrc-translation-tab-default');
					jQuery(this).addClass('vrc-translation-tab-default');
					jQuery('.vrc-translation-langcontent').hide();
					jQuery('#vrc_langcontent_ini').fadeIn();
				}
			});
		<?php
		if(!empty($cur_langtab)) {
			?>
			jQuery('.vrc-translation-tab').each(function() {
				var langtag = jQuery(this).attr('data-vrclang');
				if(langtag != '<?php echo $cur_langtab; ?>') {
					return true;
				}
				if(jQuery('#vrc_langcontent_'+langtag).length) {
					jQuery('.vrc_lang').val(langtag);
					jQuery('.vrc-translation-tab').removeClass('vrc-translation-tab-default');
					jQuery(this).addClass('vrc-translation-tab-default');
					jQuery('.vrc-translation-langcontent').hide();
					jQuery('#vrc_langcontent_'+langtag).fadeIn();
				}
			});
			<?php
		}
		?>
		});
		</script>
		<?php
		}
	}

	public static function pEditTmplFile($fpath, $option) {
		$editor = JFactory::getEditor('codemirror');
		$fcode = '';
		$fp = fopen($fpath, "rb");
		if (FALSE === $fp || empty($fpath)) {
			?>
			<p class="err"><?php echo JText::_('VRCTMPLFILENOTREAD'); ?></p>
			<?php
		}else {
			while (!feof($fp)) {
				$fcode .= fread($fp, 8192);
			}
			fclose($fp);
		?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
			<fieldset class="adminform">
				<legend class="adminlegend"><?php echo JText::_('VRCEDITTMPLFILE'); ?></legend>
				<p class="vrc-path-tmpl-file"><?php echo $fpath; ?></p>
				<?php echo $editor->display("cont", $fcode, 400, 300, 90, 40); ?>
				<br clear="all" />
				<p style="text-align: center;"><button type="submit" class="btn btn-success"><?php echo JText::_('VRCSAVETMPLFILE'); ?></button></p>
			</fieldset>
			<input type="hidden" name="path" value="<?php echo $fpath; ?>">
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="savetmplfile" />
		</form>
		<?php
		}
	}

	public static function pViewGraphs($bookings, $arr_cars, $fromts, $tots, $pstatsmode, $arr_months, $arr_channels, $arr_countries, $arr_totals, $tot_cars_units, $option) {
		JHTML::_('behavior.tooltip');
		JHTML::_('behavior.calendar');
		$pid_car = VikRequest::getInt('id_car', '', 'request');
		$df = vikrentcar::getDateFormat(true);
		if ($df == "%d/%m/%Y") {
			$usedf = 'd/m/Y';
		}elseif ($df == "%m/%d/%Y") {
			$usedf = 'm/d/Y';
		}else {
			$usedf = 'Y/m/d';
		}
		$currencysymb = vikrentcar::getCurrencySymb(true);
		$days_diff = (int)floor(($tots - $fromts) / 86400);
		?>
		<form action="index.php?option=com_vikrentcar&amp;task=graphs" id="vrc-statsform" method="post" style="margin: 0;">
			<div id="filter-bar" class="btn-toolbar" style="width: 100%; display: inline-block;">
				<div class="btn-group pull-left">
					<select name="statsmode" onchange="document.getElementById('vrc-statsform').submit();">
						<option value="ts"<?php echo $pstatsmode == 'ts' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCSTATSMODETS'); ?></option>
						<option value="nights"<?php echo $pstatsmode == 'nights' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCSTATSMODENIGHTS'); ?></option>
					</select>
				</div>
				<div class="btn-group pull-right">
					&nbsp;<button type="submit" class="btn"><?php echo JText::_('VRCORDERSLOCFILTERBTN'); ?></button>
				</div>
				<div class="btn-group pull-right">
					<select name="id_car">
						<option value=""><?php echo JText::_('VRCSTATSALLCARS'); ?></option>
					<?php
					foreach($arr_cars as $car) {
						?>
						<option value="<?php echo $car['id']; ?>"<?php echo $car['id'] == $pid_car ? ' selected="selected"' : ''; ?>><?php echo $car['name']; ?></option>
						<?php
					}
					?>
					</select>
				</div>
				<div class="btn-group pull-right">
					<?php echo JHTML::_('calendar', date($usedf, $tots), 'dto', 'dto', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?>
				</div>
				<div class="btn-group pull-right">
					<?php echo JHTML::_('calendar', date($usedf, $fromts), 'dfrom', 'dfrom', $df, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?>
				</div>
			</div>
		</form>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#dfrom').val('<?php echo date($usedf, $fromts); ?>').attr('data-alt-value', '<?php echo date($usedf, $fromts); ?>');
			jQuery('#dto').val('<?php echo date($usedf, $tots); ?>').attr('data-alt-value', '<?php echo date($usedf, $tots); ?>');
		});
		</script>
		<?php
		$months_map = array(
			'1' => JText::_('VRSHORTMONTHONE'),
			'2' => JText::_('VRSHORTMONTHTWO'),
			'3' => JText::_('VRSHORTMONTHTHREE'),
			'4' => JText::_('VRSHORTMONTHFOUR'),
			'5' => JText::_('VRSHORTMONTHFIVE'),
			'6' => JText::_('VRSHORTMONTHSIX'),
			'7' => JText::_('VRSHORTMONTHSEVEN'),
			'8' => JText::_('VRSHORTMONTHEIGHT'),
			'9' => JText::_('VRSHORTMONTHNINE'),
			'10' => JText::_('VRSHORTMONTHTEN'),
			'11' => JText::_('VRSHORTMONTHELEVEN'),
			'12' => JText::_('VRSHORTMONTHTWELVE')
		);
		if(!(count($bookings) > 0) || !(count($arr_months) > 0)) {
			?>
		<p class="warn"><?php echo JText::_('VRNOBOOKINGSTATS'); ?></p>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
			<?php
		}else {
			$datasets = array();
			$donut_datasets = array();
			$nights_datasets = array();
			$nights_donut_datasets = array();
			$months_labels = array_keys($arr_months);
			foreach ($months_labels as $mlbk => $mlbv) {
				$mlb_parts = explode('-', $mlbv);
				$months_labels[$mlbk] = $months_map[$mlb_parts[0]].' '.$mlb_parts[1];
			}
			$tot_months = count($months_labels);
			$tot_channels = count($arr_channels);
			$cars_pool = array();
			foreach ($bookings as $bk => $bv) {
				if(array_key_exists('car_names', $bv) && count($bv['car_names']) > 0) {
					foreach ($bv['car_names'] as $r) {
						if(!in_array($r, $cars_pool)) {
							$cars_pool[] = $r;
						}
					}
				}
			}
			$tot_cars = count($cars_pool);
			$rand_max = $tot_channels + $tot_cars;
			$rgb_rand = array();
			for ($z = 0; $z < $rand_max; $z++) { 
				$rgb_rand[$z] = mt_rand(0, 255).','.mt_rand(0, 255).','.mt_rand(0, 255);
			}
			$known_ch_rgb = array(
				JText::_('VRCWEBSITECHANNEL') => '34,72,93',
			);
			$ch_dataset = array();
			$ch_donut_dataset = array();
			$ch_map = array();
			foreach ($arr_channels as $chname) {
				$ch_color = $rgb_rand[rand(0, ($tot_channels - 1))];
				if(array_key_exists(strtolower($chname), $known_ch_rgb)) {
					$ch_color = $known_ch_rgb[strtolower($chname)];
				}else {
					foreach ($known_ch_rgb as $kch => $krgb) {
						if(stripos($chname, $kch) !== false) {
							$ch_color = $krgb;
							break;
						}
					}
				}
				$ch_dataset[$chname] = array(
					'label' => $chname,
					'fillColor' => "rgba(".$ch_color.",0.2)",
					'strokeColor' => "rgba(".$ch_color.",1)",
					'pointColor' => "rgba(".$ch_color.",1)",
					'pointStrokeColor' => "#fff",
					'pointHighlightFill' => "#fff",
					'pointHighlightStroke' => "rgba(".$ch_color.",1)",
					'tot_bookings' => 0,
					'data' => array()
				);
				$ch_donut_dataset[$chname] = array(
					'label' => $chname,
					'color' => "rgba(".$ch_color.",1)",
					'highlight' => "rgba(".$ch_color.",0.9)",
					'value' => 0
				);
				$ch_map[$chname] = $chname;
			}
			$ch_nights_dataset = array(
				'label' => JText::_('VRCGRAPHTOTNIGHTSLBL'),
				'fillColor' => "rgba(34,72,93,0.2)",
				'strokeColor' => "rgba(34,72,93,1)",
				'pointColor' => "rgba(34,72,93,1)",
				'pointStrokeColor' => "#fff",
				'pointHighlightFill' => "#fff",
				'pointHighlightStroke' => "rgba(34,72,93,1)",
				'tot_nights' => 0,
				'data' => array()
			);
			$ch_nights_donut_dataset = array();
			foreach ($cars_pool as $rpk => $r) {
				$ch_color = $rgb_rand[($tot_channels + $rpk)];
				$ch_nights_donut_dataset[$r] = array(
					'label' => $r,
					'color' => "rgba(".$ch_color.",1)",
					'highlight' => "rgba(".$ch_color.",0.9)",
					'value' => 0
				);
			}
			foreach ($arr_months as $monyear => $chbookings) {
				$tot_monchannels = count($chbookings);
				$monchannels = array();
				$totnb = 0;
				foreach ($chbookings as $chname => $ords) {
					$monchannels[] = $chname;
					$totchb = 0;
					foreach ($ords as $ord) {
						$totchb += (float)$ord['order_total'];
						$totnb += $ord['days'];
						if(array_key_exists('car_names', $ord)) {
							foreach ($ord['car_names'] as $r) {
								if(array_key_exists($r, $ch_nights_donut_dataset)) {
									$ch_nights_donut_dataset[$r]['value'] += $ord['days'];
								}
							}
						}
					}
					$ch_dataset[$chname]['tot_bookings'] += count($ords);
					$ch_dataset[$chname]['data'][] = $totchb;
					$ch_donut_dataset[$chname]['value'] += $totchb;
				}
				$ch_nights_dataset['tot_nights'] += $totnb;
				$ch_nights_dataset['data'][] = $totnb;
				if($tot_monchannels < $tot_channels) {
					$ch_missing = array_diff($ch_map, $monchannels);
					foreach ($ch_missing as $chnk => $chnv) {
						if(array_key_exists($chnv, $ch_dataset)) {
							$ch_dataset[$chnv]['data'][] = 0;
						}
					}
				}
			}
			foreach ($ch_dataset as $chname => $chgraph) {
				$chgraph['label'] = $chgraph['label'].' ('.$chgraph['tot_bookings'].')';
				unset($chgraph['tot_bookings']);
				$datasets[] = $chgraph;
			}
			foreach ($ch_donut_dataset as $chname => $chgraph) {
				$donut_datasets[] = $chgraph;
			}
			$nights_datasets[] = $ch_nights_dataset;
			//Sort the array depending on the number of days sold per car
			$nights_donut_sortmap = array();
			foreach ($ch_nights_donut_dataset as $rname => $rgraph) {
				$nights_donut_sortmap[$rname] = $rgraph['value'];
			}
			arsort($nights_donut_sortmap);
			$copy_nights_donut = $ch_nights_donut_dataset;
			$ch_nights_donut_dataset = array();
			foreach ($nights_donut_sortmap as $rname => $soldnights) {
				$ch_nights_donut_dataset[$rname] = $copy_nights_donut[$rname];
			}
			unset($copy_nights_donut);
			//end Sort
			foreach ($ch_nights_donut_dataset as $rname => $rgraph) {
				$nights_donut_datasets[] = $rgraph;
			}
			?>
		<form name="adminForm" id="adminForm" action="index.php" method="post">
			<fieldset class="adminform">
				<legend class="adminlegend"><?php echo JText::sprintf('VRCSTATSFOR', count($bookings), $days_diff); ?></legend>
				<div class="vrc-graph-introtitle"><span><?php echo JText::_('VRCGRAPHTOTSALES'); ?></span></div>
				<div class="vrc-graphstats-left">
					<canvas id="vrc-graphstats-left-canv"></canvas>
					<div id="vrc-graphstats-left-legend"></div>
				</div>
				<!--
				<div class="vrc-graphstats-right">
					<canvas id="vrc-graphstats-right-canv"></canvas>
					<div id="vrc-graphstats-right-legend"></div>
				</div>
				-->
				<div class="vrc-graphstats-secondright">
					<h4><?php echo JText::_('VRCSTATSTOPCOUNTRIES'); ?></h4>
					<div class="vrc-graphstats-countries">
					<?php
					$clisted = 0;
					foreach ($arr_countries as $ccode => $cdata) {
						if($clisted > 4) {
							break;
						}
						?>
						<div class="vrc-graphstats-country-wrap">
							<span class="vrc-graphstats-country-img"><?php echo $cdata['img']; ?></span>
							<span class="vrc-graphstats-country-name"><?php echo $cdata['country_name']; ?></span>
							<span class="vrc-graphstats-country-totb badge"><?php echo $cdata['tot_bookings']; ?></span>
						</div>
						<?php
						$clisted++;
					}
					?>
					</div>
				</div>
				<div class="vrc-graphstats-thirdright">
					<p class="vrc-graphstats-income"><span><?php echo JText::_('VRCSTATSTOTINCOME'); ?></span> <?php echo $currencysymb.' '.vikrentcar::numberFormat($arr_totals['total_income']); ?></p>
					<?php
				if($pstatsmode == 'nights') {
					?>
					<span style="float: right;"><i class="vrcicn-info hasTooltip" title="<?php echo addslashes(JText::_('VRCGRAPHAVGVALUES')); ?>"></i></span>
					<?php
				}
				?>
				</div>
			<?php
			if($pstatsmode == 'nights') {
				$tot_occ_pcent = round((100 * $arr_totals['nights_sold'] / ($tot_cars_units * $days_diff)), 3);
			?>
				<br clear="all" /><br/>
				<div class="vrc-graph-introtitle"><span><?php echo JText::sprintf('VRCGRAPHTOTNIGHTS', $arr_totals['nights_sold']); ?> - <?php echo JText::sprintf('VRCGRAPHTOTOCCUPANCY', $tot_occ_pcent); ?></span></div>
				<div class="vrc-graphstats-left vrc-graphstats-left-nights">
					<canvas id="vrc-graphstats-left-canv-nights"></canvas>
					<div id="vrc-graphstats-left-legend-nights"></div>
				</div>
			<?php
				if(count($nights_donut_datasets) > 0) {
				?>
				<div class="vrc-graphstats-right vrc-graphstats-right-nights">
					<canvas id="vrc-graphstats-right-canv-nights"></canvas>
					<div id="vrc-graphstats-right-legend-nights"></div>
				</div>
				<?php
				}
				?>
				<div class="vrc-graphstats-thirdright vrc-graphstats-thirdright-nights">
					<p class="vrc-graphstats-totocc"><span><?php echo JText::_('VRCGRAPHTOTOCCUPANCYLBL'); ?></span> <?php echo $tot_occ_pcent; ?>%</p>
					<p class="vrc-graphstats-totunits"><span><?php echo JText::_('VRCGRAPHTOTUNITSLBL'); ?></span> <?php echo $tot_cars_units; ?></p>
				<?php
				if($tot_months > 1 && count($nights_datasets[0]['data']) > 1) {
					$remonths_labels = array_keys($arr_months);
					$max_nights = max($nights_datasets[0]['data']);
					$min_nights = min($nights_datasets[0]['data']);
					$max_month_key = array_search($max_nights, $nights_datasets[0]['data']);
					$min_month_key = array_search($min_nights, $nights_datasets[0]['data']);
					$max_monyear = explode('-', $remonths_labels[$max_month_key]);
					$max_month_days = date('t', mktime(0, 0, 0, $max_monyear[0], 1, $max_monyear[1]));
					$min_monyear = explode('-', $remonths_labels[$min_month_key]);
					$min_month_days = date('t', mktime(0, 0, 0, $min_monyear[0], 1, $min_monyear[1]));
					if($max_month_key !== false && $min_month_key !== false) {
						?>
					<div class="vrc-graphstats-thirdright-nights-bestworst">
						<span class="vrc-graphstats-nights-best"><i class="vrcicn-stats-bars2" style="color: green;"></i> <?php echo $months_labels[$max_month_key]; ?>: <?php echo $max_nights; ?> <?php echo JText::_('VRCGRAPHTOTNIGHTSLBL'); ?> (<?php echo round((100 * $max_nights / ($tot_cars_units * $max_month_days)), 3); ?>%)</span>
						<span class="vrc-graphstats-nights-worst"><?php echo $months_labels[$min_month_key]; ?>: <?php echo $min_nights; ?> <?php echo JText::_('VRCGRAPHTOTNIGHTSLBL'); ?> (<?php echo round((100 * $min_nights / ($tot_cars_units * $min_month_days)), 3); ?>%) <i class="vrcicn-stats-bars2" style="color: red; margin: 0 0 0 0.25em;"></i></span>
					</div>
						<?php
					}
				}
				?>
				</div>
				<?php
			}
			?>
			</fieldset>
			<input type="hidden" name="task" value="">
			<input type="hidden" name="option" value="<?php echo $option; ?>">
		</form>
		<script type="text/javascript">
		Chart.defaults.global.responsive = true;

		var data = {
			labels: <?php echo json_encode($months_labels); ?>,
			datasets: <?php echo json_encode($datasets); ?>
		};

		var donut_data = <?php echo json_encode($donut_datasets); ?>;

		var nights_data = {
			labels: <?php echo json_encode($months_labels); ?>,
			datasets: <?php echo json_encode($nights_datasets); ?>
		};

		var nights_donut_data = <?php echo json_encode($nights_donut_datasets); ?>;

		var options = {
			///Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines : true,
			//String - Colour of the grid lines
			scaleGridLineColor : "rgba(0,0,0,.05)",
			//Number - Width of the grid lines
			scaleGridLineWidth : 1,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve : true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension : 0.4,
			//Boolean - Whether to show a dot for each point
			pointDot : true,
			//Number - Radius of each point dot in pixels
			pointDotRadius : 4,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth : 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius : 20,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke : true,
			//Number - Pixel width of dataset stroke
			datasetStrokeWidth : 2,
			//Boolean - Whether to fill the dataset with a colour
			datasetFill : true,
			//String - A legend template
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span class=\"entry\" style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			tooltipTemplate: "<%if (label){%><%=label%>: <%}%><?php echo $currencysymb; ?> <%=value%>",
			multiTooltipTemplate: "<%if (datasetLabel){%><%=datasetLabel.substring( 0, datasetLabel.indexOf('(')-1 )%>: <%}%><?php echo $currencysymb; ?> <%=value%>",
			scaleLabel: "<?php echo $currencysymb; ?> <%=value%>"
		};

		var donut_options = {
			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke : true,
			//String - The colour of each segment stroke
			segmentStrokeColor : "#fff",
			//Number - The width of each segment stroke
			segmentStrokeWidth : 2,
			//Number - The percentage of the chart that we cut out of the middle
			//percentageInnerCutout : 30, // This is 0 for Pie charts, 50 for Donut charts
			//Number - Amount of animation steps
			animationSteps : 100,
			//String - Animation easing effect
			animationEasing : "easeOutQuart",
			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate : true,
			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale : false,
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span class=\"entry\" style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><span class=\"vrc-graphstats-legend-sub\">(<?php echo $currencysymb; ?> <%=segments[i].value%>)</span><%}%></li><%}%></ul>",
			tooltipTemplate: "<%if (label){%><%=label%>: <%}%><?php echo $currencysymb; ?> <%=value%>"
		};

		var ctx = document.getElementById("vrc-graphstats-left-canv").getContext("2d");
		var vrcLineChart = new Chart(ctx).Line(data, options);
		var legend = vrcLineChart.generateLegend();
		jQuery('#vrc-graphstats-left-legend').html(legend);

		/*
		var donut_ctx = document.getElementById("vrc-graphstats-right-canv").getContext("2d");
		var vrcDonutChart = new Chart(donut_ctx).Pie(donut_data, donut_options);
		var legend = vrcDonutChart.generateLegend();
		jQuery('#vrc-graphstats-right-legend').html(legend);
		*/

		<?php if($pstatsmode == 'nights') { ?>
		var nights_options = options;
		nights_options.tooltipTemplate = "<%if (label){%><%=label%>: <%}%><%=value%> <?php echo addslashes(JText::_('VRCGRAPHTOTNIGHTSLBL')); ?>";
		nights_options.scaleLabel = "<%=value%>";
		var nights_ctx = document.getElementById("vrc-graphstats-left-canv-nights").getContext("2d");
		var vrcLineChart = new Chart(nights_ctx).Line(nights_data, nights_options);
		var legend = vrcLineChart.generateLegend();
		jQuery('#vrc-graphstats-left-legend-nights').html(legend);
		<?php } ?>

		<?php if(count($nights_donut_datasets) > 0) { ?>
		var nights_donut_options = donut_options;
		nights_donut_options.legendTemplate = "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span class=\"entry\" style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><span class=\"vrc-graphstats-legend-sub\">(<%=segments[i].value%>)</span><%}%></li><%}%></ul>";
		nights_donut_options.tooltipTemplate = "<%if (label){%><%=label%>: <%}%> <%=value%> <?php echo addslashes(JText::_('VRCGRAPHTOTNIGHTSLBL')); ?>";
		var donut_ctx = document.getElementById("vrc-graphstats-right-canv-nights").getContext("2d");
		var vrcDonutChart = new Chart(donut_ctx).Pie(nights_donut_data, nights_donut_options);
		var legend = vrcDonutChart.generateLegend();
		jQuery('#vrc-graphstats-right-legend-nights').html(legend);
		<?php } ?>

		</script>
			<?php
		}
	}
	
}
?>