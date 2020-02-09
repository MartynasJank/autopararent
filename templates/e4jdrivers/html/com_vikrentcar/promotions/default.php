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

$promotions = $this->promotions;
$cars = $this->cars;
$showcars = $this->showcars == 1 ? true : false;
$vrc_tn = $this->vrc_tn;

$currencysymb = vikrentcar::getCurrencySymb();
$vrcdateformat = vikrentcar::getDateFormat();
if ($vrcdateformat == "%d/%m/%Y") {
	$df = 'd/m/Y';
}elseif ($vrcdateformat == "%m/%d/%Y") {
	$df = 'm/d/Y';
}else {
	$df = 'Y/m/d';
}

$pitemid = VikRequest::getString('Itemid', '', 'request');

$days_labels = array(
	JText::_('VRCJQCALSUN'),
	JText::_('VRCJQCALMON'),
	JText::_('VRCJQCALTUE'),
	JText::_('VRCJQCALWED'),
	JText::_('VRCJQCALTHU'),
	JText::_('VRCJQCALFRI'),
	JText::_('VRCJQCALSAT')
);

if(count($promotions) > 0) {
	?>
	<div class="vrc-promotions-container">
	<?php
	foreach ($promotions as $k => $promo) {
		?>
		<div class="vrc-promotion-details">
			<div class="vrc-promotion-name"><span><?php echo $promo['spname']; ?></span></div>
			<div class="vrc-promotion-dates">
				<div class="vrc-promotion-dates-left">
					<div class="vrc-promotion-date-from">
						<i class="fa fa-calendar"></i>
						<span class="vrc-promotion-date-label"><?php echo JText::_('VRCPROMORENTFROM'); ?></span>
						<span class="vrc-promotion-date-from-sp"><?php echo date($df, $promo['promo_from_ts']); ?></span>
					</div>
					<div class="vrc-promotion-date-to">
						<span class="vrc-promotion-date-label"><?php echo JText::_('VRCPROMORENTTO'); ?></span>
						<span class="vrc-promotion-date-to-sp"><?php echo date($df, $promo['promo_to_ts']); ?></span>
					</div>
				</div>
				<div class="vrc-promotion-dates-right">

				<?php
				if($promo['promo_to_ts'] != $promo['promo_valid_ts']) {
				?>
					<div class="vrc-promotion-date-validuntil">
						<i class="fa fa-bell"></i>
						<span class="vrc-promotion-date-label"><?php echo JText::_('VRCPROMOVALIDUNTIL'); ?></span>
						<span><?php echo date($df, $promo['promo_valid_ts']); ?></span>
					</div>
				<?php
				}
				if(!empty($promo['wdays'])) {
					$wdays = explode(';', $promo['wdays']);
				?>
					<div class="vrc-promotion-date-weekdays">
					<?php
					foreach ($wdays as $wday) {
						if(!(strlen($wday) > 0)) {
							continue;
						}
						?>
						<span class="vrc-promotion-date-weekday"><?php echo $days_labels[$wday]; ?></span>
						<?php
					}
					?>
					</div>
				<?php
				}
				?>
				</div>
			</div>
			<div class="vrc-promotion-bottom-block">
				<div class="vrc-promotion-description">
					<?php echo $promo['promotxt']; ?>
				</div>
			<?php
			//Cars List
			if($showcars === true && count($cars) > 0 && !empty($promo['idcars'])) {
				$promo_car_ids = explode(',', $promo['idcars']);
				$promo_cars = array();
				foreach ($promo_car_ids as $promo_car_id) {
					$promo_car_id = intval(str_replace("-", "", trim($promo_car_id)));
					if($promo_car_id > 0) {
						$promo_cars[$promo_car_id] = $promo_car_id;
					}
				}
				if(count($promo_cars) > 0) {
				?>
				<div class="vrc-promotion-cars-list">
				<?php
					foreach ($cars as $idcar => $car) {
						if (!array_key_exists($idcar, $promo_cars)) {
							continue;
						}
						?>
					<div class="vrc-promotion-car-block">
						<div class="vrc-promotion-car-img">
						<?php
						if(!empty($car['img'])) {
							$imgpath = file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'vthumb_'.$car['img']) ? 'administrator/components/com_vikrentcar/resources/vthumb_'.$car['img'] : 'administrator/components/com_vikrentcar/resources/'.$car['img'];
							?>
							<img alt="<?php echo $car['name']; ?>" src="<?php echo JURI::root().$imgpath; ?>"/>
							<?php
						}
						?>
						</div>
						<div class="vrc-promotion-car-name">
							<?php echo $car['name']; ?>
						</div>
						<div class="vrc-promotion-car-book-block">
							<a class="btn vrc-promotion-car-book-link" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$car['id'].'&pickup='.$promo['promo_from_ts'].'&promo=1'.(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>"><?php echo JText::_('VRCPROMOCARBOOKNOW'); ?></a>
						</div>
					</div>
						<?php
					}
				}
				?>
				</div>
				<?php
			} 
			//
			if($promo['type'] == 2) {
				?>
				<div class="vrc-promotion-discount">
					<div class="vrc-promotion-discount-details">
				<?php
				if($promo['val_pcent'] == 2) {
					//Percentage
					$disc_amount = ($promo['diffcost'] - abs($promo['diffcost'])) > 0 ? $promo['diffcost'] : abs($promo['diffcost']);
					?>
						<span class="vrc-promotion-discount-percent-amount"><?php echo $disc_amount; ?>%</span>
						<span class="vrc-promotion-discount-percent-txt"><?php echo JText::_('VRCPROMOPERCENTDISCOUNT'); ?></span>
					<?php
				}else {
					//Fixed
					?>
						<span class="vrc-promotion-discount-percent-amount"><span class="vrc_currency"><?php echo $currencysymb; ?></span><span class="vrc_price"><?php echo vikrentcar::numberFormat($promo['diffcost']); ?></span></span>
						<span class="vrc-promotion-discount-percent-txt"><?php echo JText::_('VRCPROMOFIXEDDISCOUNT'); ?></span>
					<?php
				}
				?>
					</div>
				</div>
				<?php
			}
			?>
			</div>
		</div>
		<?php
	}
	?>
	</div>
	<?php
}else {
	?>
	<h3><?php echo JText::_('VRCNOPROMOTIONSFOUND'); ?></h3>
	<?php
}
vikrentcar::printTrackingCode();
?>
