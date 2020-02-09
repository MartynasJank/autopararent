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

$res = $this->res;
$days = $this->days;
$pickup = $this->pickup;
$release = $this->release;
$place = $this->place;
$all_characteristics = $this->all_characteristics;
$navig = $this->navig;
$vrc_tn = $this->vrc_tn;

$characteristics_map = vikrentcar::loadCharacteristics((count($all_characteristics) > 0 ? array_keys($all_characteristics) : array()), $vrc_tn);
$currencysymb = vikrentcar::getCurrencySymb();

$vat_included = vikrentcar::ivaInclusa();
$tax_summary = !$vat_included && vikrentcar::showTaxOnSummaryOnly() ? true : false;

//Filter by Characteristics
$usecharatsfilter = vikrentcar::useCharatsFilter();
if($usecharatsfilter === true && empty($navig) && count($all_characteristics) > 0) {
	$all_characteristics = vikrentcar::sortCharacteristics($all_characteristics, $characteristics_map);
	?>
<div class="vrc-searchfilter-characteristics-container">
	<div class="vrc-searchfilter-characteristics-list">
	<?php
	foreach ($all_characteristics as $chk => $chv) {
		?>
		<div class="vrc-searchfilter-characteristic">
			<span class="vrc-searchfilter-cinput"><input type="checkbox" value="<?php echo $chk; ?>" /></span>
		<?php
		if(!empty($characteristics_map[$chk]['icon'])) {
			?>
			<span class="vrc-searchfilter-cicon"><img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/<?php echo $characteristics_map[$chk]['icon']; ?>" /></span>
			<?php
		}
		?>
			<span class="vrc-searchfilter-cname"><?php echo !empty($characteristics_map[$chk]['textimg']) ? $characteristics_map[$chk]['textimg'] : $characteristics_map[$chk]['name']; ?></span>
			<span class="vrc-searchfilter-cquantity">(<?php echo $chv; ?>)</span>
		</div>
		<?php
	}
	?>
	</div>
</div>
	<?php
}else {
	$usecharatsfilter = false;
}
//
?>
<p class="vrcarsfound"><?php echo JText::_('VRCARSFND'); ?>: <span><?php echo $this->tot_res; ?></span></p>

<div class="vrc-search-results-block">
<?php
$returnplace = VikRequest::getInt('returnplace', '', 'request');
$pcategories = VikRequest::getString('categories', '', 'request');
$pitemid = VikRequest::getInt('Itemid', '', 'request');
$ptmpl = VikRequest::getString('tmpl', '', 'request');
foreach ($res as $k => $r) {
	$getcar = vikrentcar::getCarInfo($k, $vrc_tn);
	$car_params = !empty($getcar['params']) ? json_decode($getcar['params'], true) : array();
	$carats = vikrentcar::getCarCaratOriz($getcar['idcarat'], $characteristics_map);
	$imgpath = file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'vthumb_'.$getcar['img']) ? 'administrator/components/com_vikrentcar/resources/vthumb_'.$getcar['img'] : 'administrator/components/com_vikrentcar/resources/'.$getcar['img'];
	$vcategory = vikrentcar::sayCategory($getcar['idcat'], $vrc_tn);
	$has_promotion = array_key_exists('promotion', $r[0]) ? true : false;
	$car_cost = $tax_summary ? $r[0]['cost'] : vikrentcar::sayCostPlusIva($r[0]['cost'], $r[0]['idprice']);
	?>
	<div class="car_result" data-car-characteristics="<?php echo $getcar['idcarat']; ?>">
		<div class="vrc-car-result-left">
			<img class="imgresult" alt="<?php echo $getcar['name']; ?>" src="<?php echo JURI::root().$imgpath; ?>" />
		</div>
		<div class="vrc-car-result-right">
			<div class="vrc-car-result-rightinner">
				<div class="vrc-car-result-rightinner-deep">
					<div class="vrc-car-result-inner">
						<span class="vrc-car-name"><?php echo $vcategory; ?><?php echo strlen($vcategory) > 0 ? ':' : ''; ?> <?php echo $getcar['name']; ?></span>
						<div class="vrc-car-result-description">
					<?php
					if(!empty($getcar['short_info'])) {
						echo $getcar['short_info'];
					}else {
						echo (strlen(strip_tags($getcar['info'])) > 250 ? substr(strip_tags($getcar['info']), 0, 250).' ...' : $getcar['info']);
					}
					?>
						</div>
					<?php
					if($has_promotion === true && !empty($r[0]['promotion']['promotxt'])) {
						?>
						<div class="vrc-promotion-block">
							<?php echo $r[0]['promotion']['promotxt']; ?>
						</div>
						<?php
					}
					?>
					</div>
					<div class="vrc-car-lastblock">
						<div class="vrc-car-price">
							<div class="vrcsrowpricediv<?php echo $has_promotion === true ? ' vrc-promotion-price' : ''; ?>">
								<span class="vrcstartfrom"><?php echo JText::_('VRSTARTFROM'); ?></span>
								<span class="car_cost"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($car_cost); ?></span></span>
							</div>
							<?php
						if($car_params['sdailycost'] == 1 && $days > 1) {
							$costperday = $car_cost / $days;
							?>
							<div class="vrc-car-result-dailycost">
								<span class="vrc_currency"><?php echo $currencysymb; ?></span>
								<span class="vrc_price"><?php echo vikrentcar::numberFormat($costperday); ?></span>
								<span class="vrc-perday-txt"><?php echo JText::_('VRCPERDAYCOST'); ?></span>
							</div>
							<?php
						}
						?>
						</div>
						<div class="vrc-car-bookingbtn">
							<form action="<?php echo JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ?  '')); ?>" method="get">
								<input type="hidden" name="option" value="com_vikrentcar"/>
					  			<input type="hidden" name="caropt" value="<?php echo $k; ?>"/>
					  			<input type="hidden" name="days" value="<?php echo $days; ?>"/>
					  			<input type="hidden" name="pickup" value="<?php echo $pickup; ?>"/>
					  			<input type="hidden" name="release" value="<?php echo $release; ?>"/>
					  			<input type="hidden" name="place" value="<?php echo $place; ?>"/>
					  			<input type="hidden" name="returnplace" value="<?php echo $returnplace; ?>"/>
					  			<input type="hidden" name="task" value="showprc"/>
					  			<input type="hidden" name="Itemid" value="<?php echo $pitemid; ?>"/>
					  		<?php
					  		if (!empty($pcategories) && $pcategories != 'all') {
								echo "<input type=\"hidden\" name=\"categories\" value=\"".$pcategories."\"/>\n";
							}
					  		if($ptmpl == 'component') {
								echo "<input type=\"hidden\" name=\"tmpl\" value=\"component\"/>\n";
							}
					  		?>
								<input type="submit" name="goon" value="<?php echo JText::_('VRPROSEGUI'); ?>" class="booknow"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	if(!empty($carats)) {
		?>
		<div class="vrc-car-characteristics">
			<?php echo $carats; ?>
		</div>
		<?php
	}
	?>
	</div>
	<div class="car_separator"></div>
	<?php
}
?>
	<div class="goback">
		<a href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=vikrentcar&pickup='.$pickup.'&return='.$release.(!empty($pitemid) ?  : '')); ?>"><?php echo JText::_('VRCHANGEDATES'); ?></a>
	</div>
</div>
<?php

//pagination
if(strlen($navig) > 0) {
	?>
<div class="vrc-pagination"><?php echo $navig; ?></div>
	<?php
}

?>
<script type="text/javascript">
jQuery(document).ready(function() {
	if (jQuery('.car_result').length) {
		jQuery('.car_result').each(function() {
			var car_img = jQuery(this).find('.vrc-car-result-left').find('img');
			if(car_img.length) {
				jQuery(this).find('.vrc-car-result-right').find('.vrc-car-result-rightinner').find('.vrc-car-result-rightinner-deep').find('.vrc-car-result-inner').css('min-height', car_img.height()+'px');
			}
		});
	};
<?php
if($usecharatsfilter === true) {
	?>
	jQuery('.vrc-searchfilter-cinput input').click(function() {
		var charact_id = jQuery(this).val();
		var charact_el = jQuery(this).parent('span').parent('div');
		var dofilter = jQuery(this)[0].checked;
		var cur_result = parseInt(jQuery('.vrcarsfound span').text());
		jQuery('.car_result').each(function() {
			var car_carats = jQuery(this).attr('data-car-characteristics').replace(/;+$/,'').split(';');
			if(dofilter === true && jQuery.inArray(charact_id, car_carats) === -1) {
				jQuery(this).fadeOut();
				cur_result--;
			}else if(dofilter === false && jQuery.inArray(charact_id, car_carats) === -1) {
				jQuery(this).fadeIn();
				cur_result++;
			}
		});
		jQuery('.vrcarsfound span').text(cur_result);
		(dofilter === true ? charact_el.addClass('vrc-searchfilter-characteristic-active') : charact_el.removeClass('vrc-searchfilter-characteristic-active'));
	});
	jQuery('.vrc-searchfilter-cicon, .vrc-searchfilter-cname, .vrc-searchfilter-cquantity').click(function(){
		jQuery(this).closest('.vrc-searchfilter-characteristic').find('.vrc-searchfilter-cinput').find('input').trigger('click');
	});
	<?php
}
?>
});
</script>
<?php
vikrentcar::printTrackingCode();
?>