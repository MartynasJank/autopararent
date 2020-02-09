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

$priceid = $this->priceid;
$place = $this->place;
$returnplace = $this->returnplace;
$carid = $this->carid;
$days = $this->days;
$pickup = $this->pickup;
$release = $this->release;
$copts = $this->copts;

$action = 'index.php?option=com_user&amp;task=login';

$pitemid = VikRequest::getString('Itemid', '', 'request');

if (!empty($carid) && !empty($pickup) && !empty($release)) {
	$chosenopts = "";
	if(is_array($copts) && @count($copts) > 0) {
		foreach($copts as $idopt => $quanopt) {
			$chosenopts .= "&optid".$idopt."=".$quanopt;
		}
	}
	$goto = "index.php?option=com_vikrentcar&task=oconfirm&priceid=".$priceid."&place=".$place."&returnplace=".$returnplace."&carid=".$carid."&days=".$days."&pickup=".$pickup."&release=".$release.(!empty($chosenopts) ? $chosenopts : "").(!empty($pitemid) ? "&Itemid=".$pitemid : "");
	$goto = vikrentcar::getLoginReturnUrl($goto);
} else {
	//User Reservations page
	$goto = "index.php?option=com_vikrentcar&view=userorders";
	$goto = vikrentcar::getLoginReturnUrl($goto);
}
$return_url = base64_encode($goto);

?>

<script language="JavaScript" type="text/javascript">
function checkVrcReg() {
	var vrvar = document.vrcreg;
	if(!vrvar.name.value.match(/\S/)) {
		document.getElementById('vrcfname').style.color='#ff0000';
		return false;
	}else {
		document.getElementById('vrcfname').style.color='';
	}
	if(!vrvar.lname.value.match(/\S/)) {
		document.getElementById('vrcflname').style.color='#ff0000';
		return false;
	}else {
		document.getElementById('vrcflname').style.color='';
	}
	if(!vrvar.email.value.match(/\S/)) {
		document.getElementById('vrcfemail').style.color='#ff0000';
		return false;
	}else {
		document.getElementById('vrcfemail').style.color='';
	}
	if(!vrvar.username.value.match(/\S/)) {
		document.getElementById('vrcfusername').style.color='#ff0000';
		return false;
	}else {
		document.getElementById('vrcfusername').style.color='';
	}
	if(!vrvar.password.value.match(/\S/)) {
		document.getElementById('vrcfpassword').style.color='#ff0000';
		return false;
	}else {
		document.getElementById('vrcfpassword').style.color='';
	}
	if(!vrvar.confpassword.value.match(/\S/)) {
		document.getElementById('vrcfconfpassword').style.color='#ff0000';
		return false;
	}else {
		document.getElementById('vrcfconfpassword').style.color='';
	}
	return true;
}
</script>

<div class="loginregistercont">
		
	<div class="registerblock">
	<form action="<?php echo JRoute::_('index.php?option=com_vikrentcar'.(!empty($pitemid) ? '&Itemid='.$pitemid : '')); ?>" method="post" name="vrcreg" onsubmit="return checkVrcReg();">
	<h3><?php echo JText::_('VRREGSIGNUP'); ?></h3>
	<div class="registerblock-content">
		<div><input placeholder="<?php echo JText::_('VRREGNAME'); ?>" type="text" name="name" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGLNAME'); ?>" type="text" name="lname" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGEMAIL'); ?>" type="text" name="email" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGUNAME'); ?>" type="text" name="username" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGPWD'); ?>" type="password" name="password" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGCONFIRMPWD'); ?>"type="password" name="confpassword" value="" size="20" class="vrcinput"/></div>
		<div class="registerblock-send"><input type="submit" value="<?php echo JText::_('VRREGSIGNUPBTN'); ?>" class="btn booknow" name="submit" /></div>
	</div>
	<input type="hidden" name="priceid" value="<?php echo $priceid; ?>" />
	<input type="hidden" name="place" value="<?php echo $place; ?>" />
	<input type="hidden" name="returnplace" value="<?php echo $returnplace; ?>" />
	<input type="hidden" name="carid" value="<?php echo $carid; ?>" />
	<input type="hidden" name="days" value="<?php echo $days; ?>" />
	<input type="hidden" name="pickup" value="<?php echo $pickup; ?>" />
	<input type="hidden" name="release" value="<?php echo $release; ?>" />
	<?php
	if(is_array($copts) && @count($copts) > 0) {
		foreach($copts as $idopt => $quanopt) {
			?>
	<input type="hidden" name="optid<?php echo $idopt; ?>" value="<?php echo $quanopt; ?>" />
			<?php
		}
	}
	?>
	<input type="hidden" name="Itemid" value="<?php echo $pitemid; ?>" />
	<input type="hidden" name="option" value="com_vikrentcar" />
	<input type="hidden" name="task" value="register" />
	</form>
	</div>
<?php
jimport('joomla.version');
$version = new JVersion();
$jv=$version->getShortVersion();
if(version_compare($jv, '1.6.0') < 0) {
	$validate = JUtility::getToken();
	//Joomla 1.5
?>
	<div class="loginblock">
	<form action="<?php echo $action; ?>" method="post">
	<h3><?php echo JText::_('VRREGSIGNIN'); ?></h3>
	<div class="loginblock-content">
		<div><input placeholder="<?php echo JText::_('VRREGUNAME'); ?>" type="text" name="username" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGPWD'); ?>" type="password" name="passwd" value="" size="20" class="vrcinput"/></div>
		<div class="loginblock-send"><input type="submit" value="<?php echo JText::_('VRREGSIGNINBTN'); ?>" class="btn booknow" name="Login" /></div>
	</div>
	<input type="hidden" name="remember" id="remember" value="yes" />
	<input type="hidden" value="login" name="op2" />
	<input type="hidden" name="return" value="<?php echo $return_url; ?>" />
	<input type="hidden" name="<?php echo $validate; ?>" value="1" />
	</form>
	</div>
<?php
}else {
	//joomla 3.0
?>
	<div class="loginblock">
	<form action="index.php?option=com_users" method="post">
	<h3><?php echo JText::_('VRREGSIGNIN'); ?></h3>
	<div class="loginblock-content">
		<div><input placeholder="<?php echo JText::_('VRREGUNAME'); ?>" type="text" name="username" value="" size="20" class="vrcinput"/></div>
		<div><input placeholder="<?php echo JText::_('VRREGPWD'); ?>" type="password" name="passwd" value="" size="20" class="vrcinput"/></div>
		<div class="loginblock-send"><input type="submit" value="<?php echo JText::_('VRREGSIGNINBTN'); ?>" class="btn booknow" name="Login" /></div>
	</div>
	<input type="hidden" name="remember" id="remember" value="yes" />
	<input type="hidden" name="return" value="<?php echo $return_url; ?>" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<?php echo JHtml::_('form.token'); ?>
	</form>
	</div>
<?php
}
?>
		
</div>
<?php
vikrentcar::printTrackingCode();
?>
