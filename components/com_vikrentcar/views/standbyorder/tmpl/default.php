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

$ord = $this->ord;
$tar = $this->tar;
$payment = $this->payment;
//vikrentcar 1.6
$calcdays = $this->calcdays;
if(strlen($calcdays) > 0) {
	$origdays = $ord['days'];
	$ord['days'] = $calcdays;
}
//
$vrc_tn = $this->vrc_tn;

$is_cust_cost = (!empty($ord['cust_cost']) && $ord['cust_cost'] > 0);

$currencysymb = vikrentcar::getCurrencySymb();
$nowdf = vikrentcar::getDateFormat();
$nowtf = vikrentcar::getTimeFormat();
if ($nowdf == "%d/%m/%Y") {
	$df = 'd/m/Y';
}elseif ($nowdf == "%m/%d/%Y") {
	$df = 'm/d/Y';
}else {
	$df = 'Y/m/d';
}
$dbo = JFactory::getDBO();
$carinfo = vikrentcar::getCarInfo($ord['idcar'], $vrc_tn);
$imp = $is_cust_cost ? vikrentcar::sayCustCostMinusIva($tar['cost'], $ord['cust_idiva']) : vikrentcar::sayCostMinusIva($tar['cost'], $tar['idprice'], $ord);
$isdue = $is_cust_cost ? $tar['cost'] : vikrentcar::sayCostPlusIva($tar['cost'], $tar['idprice'], $ord);
if (!empty ($ord['optionals'])) {
	$stepo = explode(";", $ord['optionals']);
	foreach ($stepo as $one) {
		if (!empty ($one)) {
			$stept = explode(":", $one);
			$q = "SELECT * FROM `#__vikrentcar_optionals` WHERE `id`=" . $dbo->quote($stept[0]) . ";";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() == 1) {
				$actopt = $dbo->loadAssocList();
				$vrc_tn->translateContents($actopt, '#__vikrentcar_optionals');
				$realcost = (intval($actopt[0]['perday']) == 1 ? ($actopt[0]['cost'] * $ord['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
				if (!empty ($actopt[0]['maxprice']) && $actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
					$realcost = $actopt[0]['maxprice'];
					if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
						$realcost = $actopt[0]['maxprice'] * $stept[1];
					}
				}
				$imp += vikrentcar::sayOptionalsMinusIva($realcost, $actopt[0]['idiva'], $ord);
				$tmpopr = vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva'], $ord);
				$isdue += $tmpopr;
				$optbought .= ($stept[1] > 1 ? $stept[1] . " " : "") . $actopt[0]['name'] . ": <span class=\"vrc_currency\">" . $currencysymb . "</span> <span class=\"vrc_price\">" . vikrentcar::numberFormat($tmpopr) . "</span><br/>";
			}
		}
	}
}
//custom extra costs
if(!empty($ord['extracosts'])) {
	$cur_extra_costs = json_decode($ord['extracosts'], true);
	foreach ($cur_extra_costs as $eck => $ecv) {
		$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $ord);
		$isdue += $efee_cost;
		$efee_cost_without = vikrentcar::sayOptionalsMinusIva($ecv['cost'], $ecv['idtax'], $ord);
		$imp += $efee_cost_without;
		$optbought .= $ecv['name'] . ": <span class=\"vrc_currency\">" . $currencysymb . "</span> <span class=\"vrc_price\">" . vikrentcar::numberFormat($efee_cost) . "</span><br/>";
	}
}
//
if (!empty ($ord['idplace']) && !empty ($ord['idreturnplace'])) {
	$locfee = vikrentcar::getLocFee($ord['idplace'], $ord['idreturnplace']);
	if ($locfee) {
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
			if (array_key_exists($ord['days'], $arrvaloverrides)) {
				$locfee['cost'] = $arrvaloverrides[$ord['days']];
			}
		}
		//end VikRentCar 1.7 - Location fees overrides
		$locfeecost = intval($locfee['daily']) == 1 ? ($locfee['cost'] * $ord['days']) : $locfee['cost'];
		$locfeewithout = vikrentcar::sayLocFeeMinusIva($locfeecost, $locfee['idiva'], $ord);
		$locfeewith = vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $ord);
		$imp += $locfeewithout;
		$isdue += $locfeewith;
	}
}
//VRC 1.9 - Out of Hours Fees
$oohfee = vikrentcar::getOutOfHoursFees($ord['idplace'], $ord['idreturnplace'], $ord['ritiro'], $ord['consegna'], array('id' => (int)$ord['idcar']));
$ooh_time = '';
if(count($oohfee) > 0) {
	$oohfeewithout = vikrentcar::sayOohFeeMinusIva($oohfee['cost'], $oohfee['idiva']);
	$oohfeewith = vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
	$ooh_time = $oohfee['pickup'] == 1 ? $oohfee['pickup_ooh'] : '';
	$ooh_time .= $oohfee['dropoff'] == 1 && $oohfee['dropoff_ooh'] != $oohfee['pickup_ooh'] ? (!empty($ooh_time) ? ', ' : '').$oohfee['dropoff_ooh'] : '';
	$imp += $oohfeewithout;
	$isdue += $oohfeewith;
}
//

$tax = $isdue - $imp;

//vikrentcar 1.6 coupon
$usedcoupon = false;
$origisdue = $isdue;
if(strlen($ord['coupon']) > 0) {
	$usedcoupon = true;
	$expcoupon = explode(";", $ord['coupon']);
	$isdue = $isdue - $expcoupon[1];
}
//

//echo vikrentcar::getFullFrontTitle();

?>
		<?php
		if($ord['status'] == 'standby') {
			?>
		<p class="warn"><?php echo JText::_('VRORDEREDON'); ?> <?php echo date($df.' '.$nowtf, $ord['ts']); ?> - <?php echo JText::_('VRWAITINGPAYM'); ?></p>
			<?php
		}else {
			//Cancelled
			?>
		<p class="err"><?php echo JText::_('VRORDEREDON'); ?> <?php echo date($df.' '.$nowtf, $ord['ts']); ?> - <?php echo JText::_('VRCANCELLED'); ?></p>
			<?php
		}
		?>
		
		<div class="vrcvordudata">
			<p><span class="vrcvordudatatitle"><?php echo JText::_('VRPERSDETS'); ?>:</span> <?php echo nl2br($ord['custdata']); ?></p>		
		</div>
		
		<div class="vrcvordcarinfo">
		<?php
		if(!empty($carinfo['img']) && $printer != 1) {
			$imgpath = file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'vthumb_'.$carinfo['img']) ? 'administrator/components/com_vikrentcar/resources/vthumb_'.$carinfo['img'] : 'administrator/components/com_vikrentcar/resources/'.$carinfo['img'];
			?>
			<div class="vrc-imgorder-block">
				<img class="imgresult" alt="<?php echo $carinfo['name']; ?>" src="<?php echo JURI::root().$imgpath; ?>"/>
			</div>
			<?php
		}
		?>
			<p><span class="vrcvordcarinfotitle"><?php echo JText::_('VRCARRENTED'); ?>:</span> <?php echo $carinfo['name']; ?></p>
			<p><span class="vrcvordcarinfotitle"><?php echo JText::_('VRDAL'); ?></span> <?php echo date($df.' '.$nowtf, $ord['ritiro']); ?> - <span class="vrcvordcarinfotitle"><?php echo JText::_('VRAL'); ?></span> <?php echo date($df.' '.$nowtf, $ord['consegna']); ?></p>
			<?php if(!empty($ord['idplace'])) { ?>
			<p><span class="vrcvordcarinfotitle"><?php echo JText::_('VRRITIROCAR'); ?>:</span> <?php echo vikrentcar::getPlaceName($ord['idplace'], $vrc_tn); ?></p>
			<?php } ?>
			<?php if(!empty($ord['idreturnplace'])) { ?>
			<p><span class="vrcvordcarinfotitle"><?php echo JText::_('VRRETURNCARORD'); ?>:</span> <?php echo vikrentcar::getPlaceName($ord['idreturnplace'], $vrc_tn); ?></p>
			<?php } ?>
		</div>
		
		<div class="vrcvordcosts">
			<p><span class="vrcvordcoststitle"><?php echo $is_cust_cost ? JText::_('VRCRENTCUSTRATEPLAN') : vikrentcar::getPriceName($tar['idprice'], $vrc_tn); ?>:</span> <span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat(($is_cust_cost ? $tar['cost'] : vikrentcar::sayCostPlusIva($tar['cost'], $tar['idprice'], $ord))); ?></span></p>
			<?php if(strlen($optbought)){ ?>
			<p><span class="vrcvordcoststitle"><?php echo JText::_('VROPTS'); ?>:</span><div class="vrcvordcostsoptionals"><?php echo $optbought; ?></div></p>
			<?php } ?>
			<?php if($locfeewith) { ?>
			<p><span class="vrcvordcoststitle"><?php echo JText::_('VRLOCFEETOPAY'); ?>:</span> <span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($locfeewith); ?></span></p>
			<?php } ?>
			<?php if($oohfeewith) { ?>
			<p><span class="vrcvordcoststitle"><?php echo JText::sprintf('VRCOOHFEETOPAY', $ooh_time); ?></span> <span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($oohfeewith); ?></span></p>
			<?php } ?>
			<?php if($usedcoupon == true) { ?>
			<p><span class="vrcvordcoststitle"><?php echo JText::_('VRCCOUPON').' '.$expcoupon[2]; ?>:</span> - <span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($expcoupon[1]); ?></span></p>
			<?php } ?>
			<p class="vrcvordcoststot"><span class="vrcvordcoststitle"><?php echo JText::_('VRTOTAL'); ?>:</span> <span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($isdue); ?></span></p>
		</div>
		
		<?php

if (is_array($payment) && $ord['status'] == 'standby') {
	require_once(JPATH_ADMINISTRATOR . DS ."components". DS ."com_vikrentcar". DS . "payments" . DS . $payment['file']);
	$return_url = JURI::root() . "index.php?option=com_vikrentcar&task=vieworder&sid=" . $ord['sid'] . "&ts=" . $ord['ts'];
	$error_url = JURI::root() . "index.php?option=com_vikrentcar&task=vieworder&sid=" . $ord['sid'] . "&ts=" . $ord['ts'];
	$notify_url = JURI::root() . "index.php?option=com_vikrentcar&task=notifypayment&sid=" . $ord['sid'] . "&ts=" . $ord['ts']."&tmpl=component";
	$transaction_name = vikrentcar::getPaymentName();
	$leave_deposit = 0;
	$percentdeposit = "";
	$array_order = array ();
	$array_order['order'] = $ord;
	$array_order['account_name'] = vikrentcar::getPaypalAcc();
	$array_order['transaction_currency'] = vikrentcar::getCurrencyCodePp();
	$array_order['vehicle_name'] = $carinfo['name'];
	$array_order['transaction_name'] = !empty ($transaction_name) ? $transaction_name : $carinfo['name'];
	$array_order['order_total'] = $isdue;
	$array_order['currency_symb'] = $currencysymb;
	$array_order['net_price'] = $imp;
	$array_order['tax'] = $tax;
	$array_order['return_url'] = $return_url;
	$array_order['error_url'] = $error_url;
	$array_order['notify_url'] = $notify_url;
	$array_order['total_to_pay'] = $isdue;
	$array_order['total_net_price'] = $imp;
	$array_order['total_tax'] = $tax;
	$totalchanged = false;
	if ($payment['charge'] > 0.00) {
		$totalchanged = true;
		if($payment['ch_disc'] == 1) {
			//charge
			if($payment['val_pcent'] == 1) {
				//fixed value
				$array_order['total_net_price'] += $payment['charge'];
				$array_order['total_tax'] += $payment['charge'];
				$array_order['total_to_pay'] += $payment['charge'];
				$newtotaltopay = $array_order['total_to_pay'];
			}else {
				//percent value
				$percent_net = $array_order['total_net_price'] * $payment['charge'] / 100;
				$percent_tax = $array_order['total_tax'] * $payment['charge'] / 100;
				$percent_to_pay = $array_order['total_to_pay'] * $payment['charge'] / 100;
				$array_order['total_net_price'] += $percent_net;
				$array_order['total_tax'] += $percent_tax;
				$array_order['total_to_pay'] += $percent_to_pay;
				$newtotaltopay = $array_order['total_to_pay'];
			}
		}else {
			//discount
			if($payment['val_pcent'] == 1) {
				//fixed value
				$array_order['total_net_price'] -= $payment['charge'];
				$array_order['total_tax'] -= $payment['charge'];
				$array_order['total_to_pay'] -= $payment['charge'];
				$newtotaltopay = $array_order['total_to_pay'];
			}else {
				//percent value
				$percent_net = $array_order['total_net_price'] * $payment['charge'] / 100;
				$percent_tax = $array_order['total_tax'] * $payment['charge'] / 100;
				$percent_to_pay = $array_order['total_to_pay'] * $payment['charge'] / 100;
				$array_order['total_net_price'] -= $percent_net;
				$array_order['total_tax'] -= $percent_tax;
				$array_order['total_to_pay'] -= $percent_to_pay;
				$newtotaltopay = $array_order['total_to_pay'];
			}
		}
	}
	if (!vikrentcar::payTotal()) {
		$percentdeposit = vikrentcar::getAccPerCent();
		if ($percentdeposit > 0) {
			$leave_deposit = 1;
			$array_order['total_to_pay'] = $array_order['total_to_pay'] * $percentdeposit / 100;
			$array_order['total_net_price'] = $array_order['total_net_price'] * $percentdeposit / 100;
			//$array_order['total_tax'] = $tax * $percentdeposit / 100;
			$array_order['total_tax'] = ($array_order['total_to_pay'] - $array_order['total_net_price']);
		}
	}
	$array_order['leave_deposit'] = $leave_deposit;
	$array_order['percentdeposit'] = $percentdeposit;
	$array_order['payment_info'] = $payment;
	
	?>
	<div class="vrcvordpaybutton">
	<?php	
	if($totalchanged) {
		$chdecimals = $payment['charge'] - (int)$payment['charge'];
		?>
		<p class="vrcpaymentchangetot">
		<?php echo $payment['name']; ?> 
		(<?php echo ($payment['ch_disc'] == 1 ? "+" : "-").($chdecimals > 0.00 ? vikrentcar::numberFormat($payment['charge']) : number_format($payment['charge'], 0))." ".($payment['val_pcent'] == 1 ? $currencysymb : "%"); ?>) 
		<span class="vrcorddiffpayment"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($newtotaltopay); ?></span></span>
		</p>
		<?php
	}
	$obj = new vikRentCarPayment($array_order, json_decode($payment['params'], true));
	$obj->showPayment();
	?>
	</div>
	<?php
}
vikrentcar::printTrackingCode();
?>