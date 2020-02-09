<?php
/**
 * @package     VikRentCar
 * @subpackage  com_vikrentcar
 * @author      Alessio Gaggii - e4j - Extensionsforjoomla.com
 * @copyright   Copyright (C) 2017 e4j - Extensionsforjoomla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://e4j.com
 */

defined('_JEXEC') OR die('Restricted Area');

$tars=$this->tars;
$car=$this->car;
$pickup=$this->pickup;
$release=$this->release;
$place=$this->place;
$vrc_tn=$this->vrc_tn;

$vat_included = vikrentcar::ivaInclusa();
$tax_summary = !$vat_included && vikrentcar::showTaxOnSummaryOnly() ? true : false;

$nowdf = vikrentcar::getDateFormat();
$nowtf = vikrentcar::getTimeFormat();
if ($nowdf == "%d/%m/%Y") {
	$df = 'd/m/Y';
} elseif ($nowdf == "%m/%d/%Y") {
	$df = 'm/d/Y';
} else {
	$df = 'Y/m/d';
}

$pitemid = VikRequest::getInt('Itemid', '', 'request');
$ptmpl = VikRequest::getString('tmpl', '', 'request');

//load jQuery lib and navigation
$document = JFactory::getDocument();
if(vikrentcar::loadJquery()) {
	JHtml::_('jquery.framework', true, true);
	JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery-1.11.1.min.js', false, true, false, false);
}
$document->addStyleSheet(JURI::root().'components/com_vikrentcar/resources/jquery.fancybox.css');
JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery.fancybox.js', false, true, false, false);
$navdecl = '
jQuery.noConflict();
jQuery(document).ready(function() {
	jQuery(".vrcmodal").fancybox({
		"helpers": {
			"overlay": {
				"locked": false
			}
		},"padding": 0
	});
});';
$document->addScriptDeclaration($navdecl);
//

$preturnplace = VikRequest::getString('returnplace', '', 'request');
$carats = vikrentcar::getCarCaratOriz($car['idcarat'], array(), $vrc_tn);
$currencysymb = vikrentcar::getCurrencySymb();
if (!empty ($car['idopt'])) {
	$optionals = vikrentcar::getCarOptionals($car['idopt'], $vrc_tn);
}
$discl = vikrentcar::getDisclaimer($vrc_tn);
?>
    <div class="shadow">
		<form action="<?php echo JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>" method="post">
		<div class="car_container">
			<?php
			if(array_key_exists('hours', $tars[0])) {
				?>
				<p class="car_title"><span class="vrhword"><?php echo JText::_('VRRENTAL'); ?> <?php echo $car['name']; ?> <?php echo JText::_('VRFOR'); ?> <?php echo (intval($tars[0]['hours']) == 1 ? "1 ".JText::_('VRCHOUR') : $tars[0]['hours']." ".JText::_('VRCHOURS')); ?></span></p>
				<?php
			}else {
				?>
				<p class="car_title"><span class="vrhword"><?php echo JText::_('VRRENTAL'); ?> <?php echo $car['name']; ?> <?php echo JText::_('VRFOR'); ?> <?php echo (intval($tars[0]['days']) == 1 ? "1 ".JText::_('VRDAY') : $tars[0]['days']." ".JText::_('VRDAYS')); ?></span></p>
				<?php
			}
			?>
			<div class="car_img_box">
				<img alt="<?php echo $car['name']; ?>" src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/<?php echo $car['img']; ?>"/>
				<?php
				if(strlen($car['moreimgs']) > 0) {
					$moreimages = explode(';;', $car['moreimgs']);
					?>
					<div class="car_moreimages">
						<?php
						foreach($moreimages as $mimg) {
							if(!empty($mimg)) {
								?>
								<a href="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/big_<?php echo $mimg; ?>" rel="vrcgroup<?php echo $car['id']; ?>" target="_blank" class="vrcmodal"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/thumb_<?php echo $mimg; ?>"/></a>
								<?php
							}
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<div class="car_description_box">
				<?php echo $car['info']; ?>
			</div>
			<?php if (!empty($carats)) { ?>
			<div class="vrc-showprc-car-carats">
				<?php echo $carats; ?>
			</div>
			<?php } ?>
		</div>
		
		<div class="car_prices table-responsive">
			<span class="vrhword"><?php echo JText::_('VRPRICE'); ?>:</span>
			<table class="table">
			<?php
			foreach($tars as $k=>$t) {
				$has_promotion = array_key_exists('promotion', $t) ? true : false;
				?>
				<tr><td><label for="pid<?php echo $t['idprice']; ?>"<?php echo $has_promotion === true ? ' class="vrc-label-promo-price"' : ''; ?>><?php echo vikrentcar::getPriceName($t['idprice'], $vrc_tn).": <span class=\"vrc_currency\">".$currencysymb."</span> <span class=\"vrc_price\">".($tax_summary ? vikrentcar::numberFormat($t['cost']) : vikrentcar::numberFormat(vikrentcar::sayCostPlusIva($t['cost'], $t['idprice'])))."</span>".(strlen($t['attrdata']) ? "<br/>".vikrentcar::getPriceAttr($t['idprice'], $vrc_tn).": ".$t['attrdata'] : ""); ?></label></td><td><input type="radio" name="priceid" id="pid<?php echo $t['idprice']; ?>" value="<?php echo $t['idprice']; ?>"<?php echo ($k==0 ? " checked=\"checked\"" : ""); ?>/></td></tr>
				<?php
			}
			?>
			</table>
		</div>
		
		<?php

if (!empty ($car['idopt']) && is_array($optionals)) {
?>
		<div class="car_options table-responsive">
			<span class="vrhword"><?php echo JText::_('VRACCOPZ'); ?>:</span>
			<table class="table">
			<?php

	foreach ($optionals as $k => $o) {
		$optcost = intval($o['perday']) == 1 ? ($o['cost'] * $tars[0]['days']) : $o['cost'];
		if (!empty ($o['maxprice']) && $o['maxprice'] > 0 && $optcost > $o['maxprice']) {
			$optcost = $o['maxprice'];
		}
		$optcost = $optcost * 1;
		//VRC 1.7 Rev.2
		if(!((int)$tars[0]['days'] > (int)$o['forceifdays'])) {
			continue;
		}
		//
		//vikrentcar 1.6
		if(intval($o['forcesel']) == 1) {
			//VRC 1.7 Rev.2
			if((int)$tars[0]['days'] > (int)$o['forceifdays']) {
				$forcedquan = 1;
				$forceperday = false;
				if(strlen($o['forceval']) > 0) {
					$forceparts = explode("-", $o['forceval']);
					$forcedquan = intval($forceparts[0]);
					$forceperday = intval($forceparts[1]) == 1 ? true : false;
				}
				$setoptquan = $forceperday == true ? $forcedquan * $tars[0]['days'] : $forcedquan;
				if(intval($o['hmany']) == 1) {
					$optquaninp = "<input type=\"hidden\" name=\"optid".$o['id']."\" value=\"".$setoptquan."\"/><span class=\"vrcoptionforcequant\"><small>x</small> ".$setoptquan."</span>";
				}else {
					$optquaninp = "<input type=\"hidden\" name=\"optid".$o['id']."\" value=\"".$setoptquan."\"/><span class=\"vrcoptionforcequant\"><small>x</small> ".$setoptquan."</span>";
				}
			}else {
				continue;
			}
			//
		}else {
			if(intval($o['hmany']) == 1) {
				$optquaninp = "<input type=\"text\" name=\"optid".$o['id']."\" value=\"0\" size=\"1\"/>";
			}else {
				$optquaninp = "<input type=\"checkbox\" name=\"optid".$o['id']."\" value=\"1\"/>";
			}
		}
		//
		?>
			<tr><td class="vrc-tableopt-td-img"><?php echo (!empty($o['img']) ? "<img src=\"".JURI::root()."administrator/components/com_vikrentcar/resources/".$o['img']."\" align=\"middle\" />" : "") ?></td><td class="vrc-tableopt-td-name"><?php echo JText::_($o['name']); ?></td><td class="vrc-tableopt-td-price"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo ($tax_summary ? $optcost : vikrentcar::numberFormat(vikrentcar::sayOptionalsPlusIva($optcost, $o['idiva']))); ?></span></td><td class="vrc-tableopt-td-ckbx"><?php echo $optquaninp; ?></td></tr>
			<?php
			if(strlen(strip_tags(trim($o['descr'])))) {
			?>
			<tr class="vrc-tableopt-tr-descr"><td colspan="4"><div class="vrcoptionaldescr"><?php echo $o['descr']; ?></div></td></tr>
			<?php
			}

	}
?>
			</table>
		</div>
		<?php

}
?>
		<input type="hidden" name="place" value="<?php echo $place; ?>"/>
		<input type="hidden" name="returnplace" value="<?php echo $preturnplace; ?>"/>
		<input type="hidden" name="carid" value="<?php echo $car['id']; ?>"/>
  		<input type="hidden" name="days" value="<?php echo $tars[0]['days']; ?>"/>
  		<input type="hidden" name="pickup" value="<?php echo $pickup; ?>"/>
  		<input type="hidden" name="release" value="<?php echo $release; ?>"/>
  		<input type="hidden" name="task" value="oconfirm"/>
  		<?php
if (!empty ($pitemid)) {
	?>
		<input type="hidden" name="Itemid" value="<?php echo $pitemid; ?>"/>
	<?php
}
if($ptmpl == 'component') {
	?>
		<input type="hidden" name="tmpl" value="component"/>
	<?php
}
?>
		<br clear="all">
  		<?php
  		if(strlen($discl)) {
  			?>
			<div class="car_disclaimer"><?php echo $discl; ?></div>
		<?php
		}
		//Build back link without using the JavaScript history
		$pfid = VikRequest::getInt('fid', '', 'request');
		$pcategories = VikRequest::getString('categories', '', 'request');
		if (!empty($pfid)) {
			$backto = 'index.php?option=com_vikrentcar&view=cardetails&carid='.$pfid.'&day='.$pickup.(!empty($pitemid) ? '&Itemid='.$pitemid : '');
		} else {
			$backto = 'index.php?option=com_vikrentcar&task=search&place='.$place.'&pickupdate='.urlencode(date($df, $pickup)).'&pickuph='.date('H', $pickup).'&pickupm='.date('i', $pickup).'&releasedate='.urlencode(date($df, $release)).'&releaseh='.date('H', $release).'&releasem='.date('i', $release).'&returnplace='.$preturnplace.(!empty($pcategories) && $pcategories != 'all' ? '&categories='.$pcategories : '').(!empty($pitemid) ? '&Itemid='.$pitemid : '');
		}
		//
		?>
		
		<div class="car_buttons_box">
			<input type="submit" name="goon" value="<?php echo JText::_('VRBOOKNOW'); ?>" class="booknow"/>
			<div class="goback">
				<a href="<?php echo JRoute::_($backto); ?>"><?php echo JText::_('VRBACK'); ?></a>
			</div>
		</div>
		
	</form>
</div>
<?php
vikrentcar::printTrackingCode();
?>