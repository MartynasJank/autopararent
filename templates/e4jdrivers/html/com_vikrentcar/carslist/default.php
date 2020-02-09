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

$cars=$this->cars;
$category=$this->category;
$vrc_tn=$this->vrc_tn;
$navig=$this->navig;

$currencysymb = vikrentcar::getCurrencySymb();

$pitemid = VikRequest::getString('Itemid', '', 'request');

if(is_array($category)) {
	?>
	<h3 class="vrcclistheadt"><?php echo $category['name']; ?></h3>
	<?php
	if(strlen($category['descr']) > 0) {
		?>
		<div class="vrccatdescr">
			<?php echo $category['descr']; ?>
		</div>
		<?php
	}
}else {
	echo vikrentcar::getFullFrontTitle($vrc_tn);
}

?>

<div id="vrc-search-results-block" class="vrc-search-results-block">

<?php
foreach($cars as $c) {
	$carats = vikrentcar::getCarCaratOriz($c['idcarat'], array(), $vrc_tn);
	$vcategory = vikrentcar::sayCategory($c['idcat'], $vrc_tn);
	?>
	<div class="car_result">
	<div class="car_result-inner">
		<div class="vrc-car-result-left">
		<?php
		if(!empty($c['img'])) {
			$imgpath = file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'vthumb_'.$c['img']) ? 'administrator/components/com_vikrentcar/resources/vthumb_'.$c['img'] : 'administrator/components/com_vikrentcar/resources/'.$c['img'];
			?>
			<img class="imgresult" alt="<?php echo $c['name']; ?>" src="<?php echo JURI::root().$imgpath; ?>"/>
			<?php
		}
		?>
		</div>
		<div class="vrc-car-result-right">
			<div class="vrc-car-result-rightinner">
				<div class="vrc-car-result-rightinner-deep">
					<div class="vrc-car-result-inner">
						<span class="vrc-car-name"><a href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id']); ?>"><?php echo JText::_($vcategory); ?><?php echo strlen($vcategory) > 0 ? ':' : ''; ?> <?php echo $c['name']; ?></a></span>
						<div class="vrc-car-result-description">
						<?php
						if(!empty($c['short_info'])) {
							//BEGIN: Joomla Content Plugins Rendering
							JPluginHelper::importPlugin('content');
							$myItem = &JTable::getInstance('content');
							$dispatcher = &JDispatcher::getInstance();
							$myItem->text = $c['short_info'];
							$dispatcher->trigger('onContentPrepare', array('com_vikrentcar.carslist', &$myItem, &$params, 0));
							$c['short_info'] = $myItem->text;
							//END: Joomla Content Plugins Rendering
							echo $c['short_info'];
						}else {
							echo (strlen(strip_tags($c['info'])) > 250 ? substr(strip_tags($c['info']), 0, 250).' ...' : $c['info']);
						}
						?>
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
					<div class="vrc-car-lastblock">
						<div class="vrc-car-lastblock-inner">
							<div class="vrc-car-price">
								<div class="vrcsrowpricediv">
								<?php
								if($c['cost'] > 0) {
								?>
									<span class="vrcstartfrom"><?php echo JText::_('VRCLISTSFROM'); ?></span>
									<span class="car_cost"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo strlen($c['startfrom']) > 0 ? $c['startfrom'] : vikrentcar::numberFormat($c['cost']); ?></span></span>
								<?php
								}
								?>
								</div>
							</div>
							<div class="vrc-car-bookingbtn">
								<span class="vrclistgoon"><a href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id']); ?>"><?php echo JText::_('VRCLISTPICK'); ?></a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
	<?php
}
?>
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
});
</script>
<?php
vikrentcar::printTrackingCode();
?>
