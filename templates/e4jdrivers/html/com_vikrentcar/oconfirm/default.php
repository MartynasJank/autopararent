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

$car=$this->car;
$price=$this->price;
$selopt=$this->selopt;
$days=$this->days;
//vikrentcar 1.6
$calcdays=$this->calcdays;
if((int)$days != (int)$calcdays) {
	$origdays = $days;
	$days=$calcdays;
}
$coupon=$this->coupon;
//
$first=$this->first;
$second=$this->second;
$ftitle=$this->ftitle;
$place=$this->place;
$returnplace=$this->returnplace;
$payments=$this->payments;
$cfields=$this->cfields;
$countries=$this->countries;
$vrc_tn=$this->vrc_tn;

if (@ is_array($cfields)) {
	foreach ($cfields as $cf) {
		if (!empty ($cf['poplink'])) {
			JHTML::_('behavior.modal');
			break;
		}
	}
	foreach ($cfields as $cf) {
		if ($cf['type'] == 'date') {
			JHTML::_('behavior.calendar');
			break;
		}
	}
}
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
if (vikrentcar::tokenForm()) {
	session_start();
	$vikt = uniqid(rand(17, 1717), true);
	$_SESSION['vikrtoken'] = $vikt;
	$tok = "<input type=\"hidden\" name=\"viktoken\" value=\"" . $vikt . "\"/>\n";
} else {
	$tok = "";
}

//echo $ftitle;
$pitemid = VikRequest::getInt('Itemid', '', 'request');

$carats = vikrentcar::getCarCaratOriz($car['idcarat'], array(), $vrc_tn);
$imp = vikrentcar::sayCostMinusIva($price['cost'], $price['idprice']);
$totdue = vikrentcar::sayCostPlusIva($price['cost'], $price['idprice']);
$saywithout = $imp;
$saywith = $totdue;
if (is_array($selopt)) {
	foreach ($selopt as $selo) {
		$wop .= $selo['id'] . ":" . $selo['quan'] . ";";
		$realcost = (intval($selo['perday']) == 1 ? ($selo['cost'] * $days * $selo['quan']) : ($selo['cost'] * $selo['quan']));
		if (!empty ($selo['maxprice']) && $selo['maxprice'] > 0 && $realcost > $selo['maxprice']) {
			$realcost = $selo['maxprice'];
			if(intval($selo['hmany']) == 1 && intval($selo['quan']) > 1) {
				$realcost = $selo['maxprice'] * $selo['quan'];
			}
		}
		$imp += vikrentcar::sayOptionalsMinusIva($realcost, $selo['idiva']);
		$totdue += vikrentcar::sayOptionalsPlusIva($realcost, $selo['idiva']);
	}
} else {
	$wop = "";
}
?>
<div class="shadow">
<div class="vrc-oconf-mainc">
		<div class="vrcrentalriepilogo"><?php echo JText::_('VRRIEPILOGOORD'); ?>:</div>
		
		<div class="vrcinfocarcontainer">
			<?php
			if(!empty($car['img'])) {
			?>
			<div class="vrc-summary-car-img">
				<img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/<?php echo $car['img']; ?>"/>
			</div>
			<?php
			}
			?>
			<div class="vrcrentforlocs">
			<?php
			if(array_key_exists('hours', $price)) {
				?>
				<div class="vrcrentalfor">
					<div class="vrcrentalforone"><span class="vrc-carname"><?php echo JText::_('VRRENTAL'); ?> <?php echo $car['name']; ?></span> <span class="vrc-car-time"><?php echo JText::_('VRFOR'); ?> <?php echo (intval($price['hours']) == 1 ? "1 ".JText::_('VRCHOUR') : $price['hours']." ".JText::_('VRCHOURS')); ?></span></div>
					
					<div class="vrcrentalfortwo"><div><div class="vrc-car-datetime vrc-car-datetime-w"><span class="vrcrentalforlabel"><?php echo JText::_('VRDAL'); ?></span> <span class="vrcrentalfordate"><?php echo date($df.' '.$nowtf, $first); ?></span></div><div class="vrc-car-datetime vrc-car-datetime-wr"><span class="vrcrentalforlabel"><?php echo JText::_('VRAL'); ?></span> <span class="vrcrentalfordate"><?php echo date($nowtf, $second); ?></span></div></div></div>
					<?php
						if(!empty($place) || !empty($returnplace)) {
						?>
						<div class="vrclocsboxsum">
						<?php if(!empty($place)) { ?>
						<p class="vrcpickuploc"><?php echo JText::_('VRRITIROCAR'); ?>: <span class="vrcpickuplocname"><?php echo vikrentcar::getPlaceName($place, $vrc_tn); ?></span></p>
						<?php } ?>
						<?php if(!empty($returnplace)) { ?>
						<p class="vrcdropoffloc"><?php echo JText::_('VRRETURNCARORD'); ?>: <span class="vrcdropofflocname"><?php echo vikrentcar::getPlaceName($returnplace, $vrc_tn); ?></span></p>
						<?php } ?>
						</div>
						<?php
						}
					?>
				</div>
				<?php
			}else {
				?>
				<div class="vrcrentalfor">
					<div class="vrcrentalforone"><span class="vrc-carname"><?php echo JText::_('VRRENTAL'); ?> <?php echo $car['name']; ?></span> <span class="vrc-car-time"> <?php echo JText::_('VRFOR'); ?> <?php echo (intval($days)==1 ? "1 ".JText::_('VRDAY') : $days." ".JText::_('VRDAYS')); ?></span></div>
					<div class="vrcrentalfortwo"><div><div class="vrc-car-datetime vrc-car-datetime-w"><span class="vrcrentalforlabel"><?php echo JText::_('VRDAL'); ?></span> <span class="vrcrentalfordate"><?php echo date($df.' '.$nowtf, $first); ?></span></div><div class="vrc-car-datetime vrc-car-datetime-wr"><span class="vrcrentalforlabel"><?php echo JText::_('VRAL'); ?></span> <span class="vrcrentalfordate"><?php echo date($df.' '.$nowtf, $second); ?></span></div></div></div>
					<?php
						if(!empty($place) || !empty($returnplace)) {
						?>
						<div class="vrclocsboxsum">
						<?php if(!empty($place)) { ?>
						<p class="vrcpickuploc"><?php echo JText::_('VRRITIROCAR'); ?>: <span class="vrcpickuplocname"><?php echo vikrentcar::getPlaceName($place, $vrc_tn); ?></span></p>
						<?php } ?>
						<?php if(!empty($returnplace)) { ?>
						<p class="vrcdropoffloc"><?php echo JText::_('VRRETURNCARORD'); ?>: <span class="vrcdropofflocname"><?php echo vikrentcar::getPlaceName($returnplace, $vrc_tn); ?></span></p>
						<?php } ?>
						</div>
						<?php
						}
					?>
				</div>
				<?php
			}
			?>
			</div>

			
		</div>
		<div class="help">
		<table class="vrctableorder">
		<tr class="vrctableorderfrow"><td>&nbsp;</td><td align="center"><?php echo (array_key_exists('hours', $price) ? JText::_('VRCHOURS') : JText::_('ORDDD')); ?></td><td align="center"><?php echo JText::_('ORDNOTAX'); ?></td><td align="center"><?php echo JText::_('ORDTAX'); ?></td><td align="center"><?php echo JText::_('ORDWITHTAX'); ?></td></tr>
		<tr class="vrctableorder-car-row"><td align="left"><?php echo $car['name']; ?><br/><?php echo vikrentcar::getPriceName($price['idprice'], $vrc_tn).(!empty($price['attrdata']) ? "<br/>".vikrentcar::getPriceAttr($price['idprice'], $vrc_tn).": ".$price['attrdata'] : ""); ?></td>
		<td align="center"><?php echo (array_key_exists('hours', $price) ? $price['hours'] : $days); ?></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($saywithout); ?></span></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($saywith - $saywithout); ?></span></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($saywith); ?></span></td></tr>
		<?php

$sf = 2;
if (is_array($selopt)) {
	foreach ($selopt as $aop) {
		if (intval($aop['perday']) == 1) {
			$thisoptcost = ($aop['cost'] * $aop['quan']) * $days;
		} else {
			$thisoptcost = $aop['cost'] * $aop['quan'];
		}
		if (!empty ($aop['maxprice']) && $aop['maxprice'] > 0 && $thisoptcost > $aop['maxprice']) {
			$thisoptcost = $aop['maxprice'];
			if(intval($aop['hmany']) == 1 && intval($aop['quan']) > 1) {
				$thisoptcost = $aop['maxprice'] * $aop['quan'];
			}
		}
		$optwithout = (intval($aop['perday']) == 1 ? vikrentcar::sayOptionalsMinusIva($thisoptcost, $aop['idiva']) : vikrentcar::sayOptionalsMinusIva($thisoptcost, $aop['idiva']));
		$optwith = (intval($aop['perday']) == 1 ? vikrentcar::sayOptionalsPlusIva($thisoptcost, $aop['idiva']) : vikrentcar::sayOptionalsPlusIva($thisoptcost, $aop['idiva']));
		$opttax = vikrentcar::numberFormat($optwith - $optwithout);
		?>
			<tr<?php echo (($sf % 2) == 0 ? " class=\"vrcordrowtwo\"" : " class=\"vrcordrowone\""); ?>><td><?php echo JText::_($aop['name']).($aop['quan'] > 1 ? " <small>(x ".$aop['quan'].")</small>" : ""); ?></td><td align="center"><?php echo (array_key_exists('hours', $price) ? $price['hours'] : $days); ?></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($optwithout); ?></span></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo $opttax; ?></span></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($optwith); ?></span></td></tr>
		<?php

		$sf++;
	}
}
$days = intval($days);
if (!empty ($place) && !empty ($returnplace)) {
	$locfee = vikrentcar::getLocFee($place, $returnplace);
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
			if (array_key_exists($days, $arrvaloverrides)) {
				$locfee['cost'] = $arrvaloverrides[$days];
			}
		}
		//end VikRentCar 1.7 - Location fees overrides
		$locfeecost = intval($locfee['daily']) == 1 ? ($locfee['cost'] * $days) : $locfee['cost'];
		$locfeewithout = vikrentcar::sayLocFeeMinusIva($locfeecost, $locfee['idiva']);
		$locfeewith = vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva']);
		$locfeetax = vikrentcar::numberFormat($locfeewith - $locfeewithout);
		$imp += $locfeewithout;
		$totdue += $locfeewith;
		?>
		
		<tr<?php echo (($sf % 2) == 0 ? " class=\"vrcordrowtwo\"" : " class=\"vrcordrowone\"");?>>
			<td><?php echo JText::_('VRLOCFEETOPAY'); ?></td>
			<td align="center"><?php echo (array_key_exists('hours', $price) ? $price['hours'] : $days); ?></td>
			<td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($locfeewithout); ?></span></td>
			<td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo $locfeetax; ?></span></td>
			<td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($locfeewith); ?></span></td>
		</tr>
		
		<?php
		$sf++;
	}
}
//VRC 1.9 - Out of Hours Fees
$oohfee = vikrentcar::getOutOfHoursFees($place, $returnplace, $first, $second, $car);
if(count($oohfee) > 0) {
	$oohfeecost = $oohfee['cost'];
	$oohfeewithout = vikrentcar::sayOohFeeMinusIva($oohfeecost, $oohfee['idiva']);
	$oohfeewith = vikrentcar::sayOohFeePlusIva($oohfeecost, $oohfee['idiva']);
	$oohfeetax = vikrentcar::numberFormat($oohfeewith - $oohfeewithout);
	$imp += $oohfeewithout;
	$totdue += $oohfeewith;
	$ooh_time = $oohfee['pickup'] == 1 ? $oohfee['pickup_ooh'] : '';
	$ooh_time .= $oohfee['dropoff'] == 1 && $oohfee['dropoff_ooh'] != $oohfee['pickup_ooh'] ? (!empty($ooh_time) ? ', ' : '').$oohfee['dropoff_ooh'] : '';
	?>
	<tr<?php echo (($sf % 2) == 0 ? " class=\"vrcordrowtwo\"" : " class=\"vrcordrowone\"");?>>
		<td><?php echo JText::sprintf('VRCOOHFEETOPAY', $ooh_time); ?></td>
		<td align="center"><?php echo (array_key_exists('hours', $price) ? $price['hours'] : $days); ?></td>
		<td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($oohfeewithout); ?></span></td>
		<td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo $oohfeetax; ?></span></td>
		<td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($oohfeewith); ?></span></td>
	</tr>
	<?php
	$sf++;
}
//

//store Order Total in session for modules
$session = JFactory::getSession();
$session->set('vikrentcar_ordertotal', $totdue);
//

//vikrentcar 1.6
$origtotdue = $totdue;
$usedcoupon = false;
if(is_array($coupon)) {
	//check min tot ord
	$coupontotok = true;
	if(strlen($coupon['mintotord']) > 0) {
		if($totdue < $coupon['mintotord']) {
			$coupontotok = false;
		}
	}
	if($coupontotok == true) {
		$usedcoupon = true;
		if($coupon['percentot'] == 1) {
			//percent value
			$minuscoupon = 100 - $coupon['value'];
			$couponsave = $totdue * $coupon['value'] / 100;
			$totdue = $totdue * $minuscoupon / 100;
		}else {
			//total value
			$couponsave = $coupon['value'];
			$totdue = $totdue - $coupon['value'];
		}
	}else {
		VikError::raiseWarning('', JText::_('VRCCOUPONINVMINTOTORD'));
	}
}
//

?>
		
		<tr class="vrcordrowtotal"><td><?php echo JText::_('VRTOTAL'); ?></td><td align="center">&nbsp;</td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($imp); ?></span></td><td align="center"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat(($origtotdue - $imp)); ?></span></td><td align="center" class="vrctotalord"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($origtotdue); ?></span></td></tr>
		<?php
		if($usedcoupon == true) {
			?>
			<tr class="vrcordrowtotal"><td><?php echo JText::_('VRCCOUPON'); ?> <?php echo $coupon['code']; ?></td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center" class="vrctotalord"><span class="vrc_currency">- <?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($couponsave); ?></span></td></tr>
			<tr class="vrcordrowtotal"><td><?php echo JText::_('VRCNEWTOTAL'); ?></td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center">&nbsp;</td><td align="center" class="vrctotalord"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo vikrentcar::numberFormat($totdue); ?></span></td></tr>
			<?php
		}
		?>
		</table>
    </div>

	

<?php
//vikrentcar 1.6
if(vikrentcar::couponsEnabled() && !is_array($coupon)) {
	?>
	<div class="vrc-oconf-paymfields">
		<form action="<?php echo JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>" method="post">
			<div class="vrcentercoupon">
			<span class="vrchaveacoupon"><?php echo JText::_('VRCHAVEACOUPON'); ?></span><input type="text" name="couponcode" value="" size="20" class="vrcinputcoupon"/><input type="submit" class="vrcsubmitcoupon btn" name="applyacoupon" value="<?php echo JText::_('VRCSUBMITCOUPON'); ?>"/>
			</div>
			<input type="hidden" name="priceid" value="<?php echo $price['idprice']; ?>"/>
			<input type="hidden" name="place" value="<?php echo $place; ?>"/>
			<input type="hidden" name="returnplace" value="<?php echo $returnplace; ?>"/>
			<input type="hidden" name="carid" value="<?php echo $car['id']; ?>"/>
	  		<input type="hidden" name="days" value="<?php echo $days; ?>"/>
	  		<input type="hidden" name="pickup" value="<?php echo $first; ?>"/>
	  		<input type="hidden" name="release" value="<?php echo $second; ?>"/>
	  		<?php
	  		if (is_array($selopt)) {
				foreach ($selopt as $aop) {
					echo '<input type="hidden" name="optid'.$aop['id'].'" value="'.$aop['quan'].'"/>'."\n";
				}
	  		}
        if (!empty ($pitemid)) {
		?>
		<input type="hidden" name="Itemid" value="<?php echo $pitemid; ?>"/>
		<?php
		}	  		
?>
	  		<input type="hidden" name="task" value="oconfirm"/>
		</form>
	</div>
</div>
	<?php
}
//
?>
		
		<script type="text/javascript">
		function vrcValidateEmail(email) { 
		    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		    return re.test(email);
		}
  		function checkvrcFields(){
  			var vrvar = document.vrc;
			<?php

if (@ is_array($cfields)) {
	foreach ($cfields as $cf) {
		if (intval($cf['required']) == 1) {
			if ($cf['type'] == "text" || $cf['type'] == "textarea" || $cf['type'] == "date" || $cf['type'] == "country") {
			?>
			if(!vrvar.vrcf<?php echo $cf['id']; ?>.value.match(/\S/)) {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='#ff0000';
				return false;
			}else {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='';
			}
			<?php
				if($cf['isemail'] == 1) {
				?>
			if(!vrcValidateEmail(vrvar.vrcf<?php echo $cf['id']; ?>.value)) {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='#ff0000';
				return false;
			}else {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='';
			}
				<?php
				}
			}elseif ($cf['type'] == "select") {
			?>
			if(!vrvar.vrcf<?php echo $cf['id']; ?>.value.match(/\S/)) {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='#ff0000';
				return false;
			}else {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='';
			}
			<?php

			} elseif ($cf['type'] == "checkbox") {
				//checkbox
			?>
			if(vrvar.vrcf<?php echo $cf['id']; ?>.checked) {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='';
			}else {
				document.getElementById('vrcf<?php echo $cf['id']; ?>').style.color='#ff0000';
				return false;
			}
			<?php

			}
		}
	}
}
?>
  			return true;
  		}
		</script>
    
        <!--    CUSTOM RADIO    -->
        <?php
            $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            $fizinis = '';
            $juridinis = '';
            if(strpos($url, 'lt') == true){
                $fizinis = 'Fizinis asmuo';
                $juridinis = 'Juridinis asmuo';
            } else if(strpos($url, 'en') == true) {
                $fizinis = 'Personal person';
                $juridinis = 'Juridical person';
            }
        ?>
        <label class="container-custom"><?= $fizinis; ?>
            <input type="radio" checked="checked" name="radio" value="fizinis">
            <span class="checkmark"></span>
        </label>
        <label class="container-custom"><?= $juridinis; ?>
            <input type="radio" name="radio" value="juridinis">
            <span class="checkmark"></span>
        </label>
        <!--    CUSTOM RADIO END    -->
		<div class="vrc-oconf-paymfields">
		
		<?php

if (@ is_array($cfields)) {
	?>
		<div class="vrccustomfields">
	<?php
	$currentUser = JFactory::getUser();
	$juseremail = !empty($currentUser->email) ? $currentUser->email : "";
	$previousdata = vikrentcar::loadPreviousUserData($currentUser->id);
        // SEPERATOR
    foreach($cfields as $df){
		if ($df['type'] == "separator") {
			$dfsepclass = strlen(JText::_($df['name'])) > 30 ? "vrcseparatorcflong" : "vrcseparatorcf";
		?>
            <div class="sepcontainer <?php echo $df['name'];?>">
                <form action="<?php echo JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>" name="vrc" method="post" onsubmit="javascript: return checkvrcFields();">
                <div class="vrcdivcustomfield vrccustomfldinfo">
                    <div class="<?php echo $dfsepclass; ?>"><?php echo JText::_($df['name']); ?></div>
                </div>
                <?php
                foreach ($cfields as $cf) {
                    if($df['name'] == "ORDER_FIZINIS"){
                        if($cf[id] == 2){$cf['required'] = 1;}
                        if($cf[id] == 3){$cf['required'] = 1;}
                        if($cf[id] == 10){$cf['required'] = 1;}
                    } else if ($df['name'] = "ORDER_JURIDINIS"){
                        if($cf[id] == 14){$cf['required'] = 1;}
                        if($cf[id] == 15){$cf['required'] = 1;}
                        if($cf[id] == 16){$cf['required'] = 1;}        
                    }
                    if (intval($cf['required']) == 1) {
                        $isreq = "<span class=\"vrcrequired\"><sup>*</sup></span> ";
                    } else {
                        $isreq = "";
                    }
                    if (!empty ($cf['poplink'])) {
                        $fname = "<a href=\"" . $cf['poplink'] . "\" id=\"vrcf" . $cf['id'] . "\" rel=\"{handler: 'iframe', size: {x: 750, y: 600}}\" target=\"_blank\" class=\"modal\">" . JText :: _($cf['name']) . "</a>";
                    } else {
                        $fname = "<span id=\"vrcf" . $cf['id'] . "\">" . JText::_($cf['name']) . "</span>";
                    }
                    if ($cf['type'] == "textarea") {
                        $defaultval = array_key_exists($cf['id'], $previousdata['customfields']) ? $previousdata['customfields'][$cf['id']] : '';
                    ?>
                        <div class="vrcdivcustomfield vrcdivcustomfield-txtarea">
                            <div class="vrc-customfield-label">
                                <?php echo $isreq; ?><?php echo $fname; ?>
                            </div>
                            <div class="vrc-customfield-input">
                                <textarea name="vrcf<?php echo $cf['id']; ?>" rows="5" cols="30" class="vrctextarea"><?php echo $defaultval; ?></textarea>
                            </div>
                        </div>
                    <?php
                    }elseif ($cf['type'] == "date") {
                        $defaultval = array_key_exists($cf['id'], $previousdata['customfields']) ? $previousdata['customfields'][$cf['id']] : '';
                    ?>
                        <div class="vrcdivcustomfield">
                            <div class="vrc-customfield-label">
                                <?php echo $isreq; ?><?php echo $fname; ?>
                            </div>
                            <div class="vrc-customfield-input">
                                <?php echo JHTML::_('calendar', '', 'vrcf'.$cf['id'], 'vrcf'.$cf['id'].'date', $nowdf, array('class'=>'vrcinput', 'size'=>'10', 'value'=>$defaultval, 'maxlength'=>'19')); ?>
                            </div>
                        </div>
                        <?php
                        if (!empty($defaultval)) {
                        ?>
                        <script type="text/javascript">
                        jQuery(document).ready(function() {
                            jQuery('#vrcf<?php echo $cf['id']; ?>date').val('<?php echo addslashes($defaultval); ?>');
                        });
                        </script>
                        <?php
                        }
                        ?>
                    <?php
                    }elseif ($cf['type'] == "country" && is_array($countries)) {
                        $defaultval = array_key_exists($cf['id'], $previousdata['customfields']) ? $previousdata['customfields'][$cf['id']] : '';
                        $countries_sel = '<div class="vrc-customfield-select"><select name="vrcf'.$cf['id'].'"><option value=""></option>'."\n";
                        foreach ($countries as $country) {
                            $countries_sel .= '<option value="'.$country['country_3_code'].'::'.$country['country_name'].'"'.($defaultval == $country['country_3_code'] ? ' selected="selected"' : '').'>'.$country['country_name'].'</option>'."\n";
                        }
                        $countries_sel .= '</select></div>';
                    ?>
                        <div class="vrcdivcustomfield">
                            <div class="vrc-customfield-label">
                                <?php echo $isreq; ?><?php echo $fname; ?>
                            </div>
                            <div class="vrc-customfield-input">
                                <?php echo $countries_sel; ?>
                            </div>
                        </div>
                    <?php
                    }elseif ($cf['type'] == "select") {
                        $defaultval = array_key_exists($cf['id'], $previousdata['customfields']) ? $previousdata['customfields'][$cf['id']] : '';
                        $answ = explode(";;__;;", $cf['choose']);
                        $wcfsel = "<div class=\"vrc-customfield-select\"><select name=\"vrcf" . $cf['id'] . "\">\n";
                        foreach ($answ as $aw) {
                            if (!empty ($aw)) {
                                $wcfsel .= "<option value=\"" . JText::_($aw) . "\"".($defaultval == JText::_($aw) ? ' selected="selected"' : '').">" . JText::_($aw) . "</option>\n";
                            }
                        }
                        $wcfsel .= "</select></div>\n";
                    ?>
                        <div class="vrcdivcustomfield">
                            <div class="vrc-customfield-label">
                                <?php echo $isreq; ?><?php echo $fname; ?>
                            </div>
                            <div class="vrc-customfield-input">
                                <?php echo $wcfsel; ?>
                            </div>
                        </div>
                    <?php

                    }elseif($cf['type'] == "text") {
                        if($df['name'] == "ORDER_JURIDINIS" && ($cf['id'] == 2 || $cf['id'] == 3 || $cf['id'] == 10)){
                            echo '';
                    } else if($df['name'] == "ORDER_FIZINIS" && ($cf['id'] == 14 || $cf['id'] == 15 || $cf['id'] == 16)){
                            echo '';
                        }
                        else{
                        $textmailval = intval($cf['isemail']) == 1 ? $juseremail : "";
                        $textmailval = array_key_exists($cf['id'], $previousdata['customfields']) ? $previousdata['customfields'][$cf['id']] : $textmailval;
                    ?>
                        <div class="vrcdivcustomfield">
                            <div class="vrc-customfield-label0">
                                <?php echo $isreq; ?><?php 
                                    if($df['name'] == "ORDER_JURIDINIS" && $cf[id] == 2 && strpos($url,'lt') == true){
                                        echo "Įmonės pavadinimas";
                                    }
                                echo $fname;
                                ?>
                            </div>
                            <div class="vrc-customfield-input">
                                <input type="text" name="vrcf<?php echo $cf['id']; ?>" value="<?php echo $textmailval; ?>" size="40" class="vrcinput"/>
                            </div>
                        </div>
                    <?php
                    } 
                    }
                } ?>
		<?php
                
?>
		<input type="hidden" name="days" value="<?php echo $days; ?>"/>
		<?php
		//vikrentcar 1.6
		if($origdays) {
			?>
			<input type="hidden" name="origdays" value="<?php echo $origdays; ?>"/>
			<?php
		}
		//
		?>
		<input type="hidden" name="pickup" value="<?php echo $first; ?>"/>
		<input type="hidden" name="release" value="<?php echo $second; ?>"/>
		<input type="hidden" name="car" value="<?php echo $car['id']; ?>"/>
		<input type="hidden" name="prtar" value="<?php echo $price['id']; ?>"/>
		<input type="hidden" name="priceid" value="<?php echo $price['idprice']; ?>"/>
		<input type="hidden" name="optionals" value="<?php echo $wop; ?>"/>
		<input type="hidden" name="totdue" value="<?php echo $totdue; ?>"/>
		<input type="hidden" name="place" value="<?php echo $place; ?>"/>
		<input type="hidden" name="returnplace" value="<?php echo $returnplace; ?>"/>
		<?php
		if(array_key_exists('hours', $price)) {
			?>
		<input type="hidden" name="hourly" value="<?php echo $price['hours']; ?>"/>	
			<?php
		}
		if($usedcoupon == true && is_array($coupon)) {
			?>
		<input type="hidden" name="couponcode" value="<?php echo $coupon['code']; ?>"/>
			<?php
		}
		?>
		<?php echo $tok; ?>
		<input type="hidden" name="task" value="saveorder"/>
		<?php

if (@ is_array($payments)) {
	?>
	<div class="vrc-oconfirm-paym-block">
		<h4 class="vrc-medium-header"><?php echo JText::_('VRCHOOSEPAYMENT'); ?></h4>
		<ul class="vrc-noliststyletype">
	<?php
	foreach ($payments as $pk => $pay) {
		$rcheck = $pk == 0 ? " checked=\"checked\"" : "";
		$saypcharge = "";
		if ($pay['charge'] > 0.00) {
			$decimals = $pay['charge'] - (int)$pay['charge'];
			if($decimals > 0.00) {
				$okchargedisc = vikrentcar::numberFormat($pay['charge']);
			}else {
				$okchargedisc = number_format($pay['charge'], 0);
			}
			$saypcharge .= " (".($pay['ch_disc'] == 1 ? "+" : "-");
			$saypcharge .= "<span class=\"".($pay['val_pcent'] == 1 ? 'vrc_price' : '')."\">" . $okchargedisc . "</span> <span class=\"".($pay['val_pcent'] == 1 ? 'vrc_currency' : '')."\">" . ($pay['val_pcent'] == 1 ? $currencysymb : "%") . "</span>";
			$saypcharge .= ")";
		}
		?>
			<li><input type="radio" name="gpayid" value="<?php echo $pay['id']; ?>" id="gpay<?php echo $pay['id']; ?>"<?php echo $rcheck; ?>/> <label for="gpay<?php echo $pay['id']; ?>"><?php echo $pay['name'].$saypcharge; ?></label></li>
		<?php
	}
	?>
		</ul>
	</div>
	<?php
}
?>
		<div class="vrc-save-order-block">
			<input type="submit" name="saveorder" value="<?php echo JText::_('VRORDCONFIRM'); ?>" class="btn booknow"/>
		</div>
		<?php
	$ptmpl = VikRequest::getString('tmpl', '', 'request');
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
		</form>
                </div>
                    <?php
        }
                    }
    }
        // END OF SEPERATOR
	?>
        <script>
            jQuery(document).ready(function(){
                jQuery('.ORDER_JURIDINIS').hide();
                jQuery('input[type=radio][name=radio]').change(function() {
                    if (this.value == 'fizinis') {
                        jQuery('.ORDER_JURIDINIS').hide();
                        jQuery('.ORDER_FIZINIS').show();   
                    }
                    else if (this.value == 'juridinis') {
                        jQuery('.ORDER_FIZINIS').hide();
                        jQuery('.ORDER_JURIDINIS').show();
                    }
                });
            });    
        </script>

		<?php
		//Build back link without using the JavaScript history
		$backto = 'index.php?option=com_vikrentcar&task=showprc&caropt='.$car['id'].'&days='.$days.'&pickup='.$first.'&release='.$second.'&place='.$place.'&returnplace='.$returnplace.(!empty($pitemid) ? '&Itemid='.$pitemid : '');
		?>
	</div>
		<div class="goback">
			<a class="btn" href="javascript: void(0);" onclick="javascript: window.history.back();"><?php echo JText::_('VRBACK'); ?></a>
		</div>
</div>
<?php
vikrentcar::printTrackingCode();

?>
