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

/* --- Joomla portability --- */
include(JPATH_SITE . DIRECTORY_SEPARATOR ."components". DIRECTORY_SEPARATOR ."com_vikrentcar". DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "adapter" . DIRECTORY_SEPARATOR ."defines.php");
include(JPATH_SITE . DIRECTORY_SEPARATOR ."components". DIRECTORY_SEPARATOR ."com_vikrentcar". DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "adapter" . DIRECTORY_SEPARATOR ."request.php");
include(JPATH_SITE . DIRECTORY_SEPARATOR ."components". DIRECTORY_SEPARATOR ."com_vikrentcar". DIRECTORY_SEPARATOR . "helpers" . DIRECTORY_SEPARATOR . "adapter" . DIRECTORY_SEPARATOR ."error.php");

$er_l = isset($_REQUEST['error_reporting']) && $_REQUEST['error_reporting'] == '-1' ? -1 : 0;
defined('VIKRENTCAR_ERROR_REPORTING') OR define('VIKRENTCAR_ERROR_REPORTING', $er_l);
error_reporting(VIKRENTCAR_ERROR_REPORTING);

//Joomla 3.0
if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
//

require_once(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "helpers" . DS ."lib.vikrentcar.php");
require_once(JPATH_ADMINISTRATOR . DS . "components". DS ."com_vikrentcar" . DS . 'helpers' . DS . 'helper.php');
require_once(JPATH_ADMINISTRATOR . DS . "components". DS ."com_vikrentcar" . DS . "helpers" . DS . "jv_helper.php");
require_once(JPATH_ADMINISTRATOR . DS . "components". DS ."com_vikrentcar" . DS . 'admin.vikrentcar.html.php');

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_vikrentcar/vikrentcar.css');
$document->addStyleSheet('components/com_vikrentcar/resources/fonts/vrcicomoon.css');
JHtml::_('jquery.framework', true, true);
JHtml::_('script', JURI::root().'components/com_vikrentcar/resources/jquery-1.11.1.min.js', false, true, false, false);

$cid = VikRequest::getVar('cid', array(0));
$task = VikRequest::getVar('task');

//Joomla 2.5
$option = empty($option) ? "com_vikrentcar" : $option;
//

require_once(JPATH_ADMINISTRATOR . DS . "components". DS ."com_vikrentcar" . DS . 'toolbar.vikrentcar.php');

switch ($task) {
	case 'viewplaces' :
		HTML_vikrentcar::printHeader("3");
		viewPlaces($option);
		break;
	case 'newplace' :
		HTML_vikrentcar::printHeader("3");
		newPlace($option);
		break;
	case 'editplace' :
		HTML_vikrentcar::printHeader("3");
		editPlace($cid[0], $option);
		break;	
	case 'createplace' :
		HTML_vikrentcar::printHeader();
		savePlace($option);
		break;
	case 'updateplace' :
		HTML_vikrentcar::printHeader();
		updatePlace($option);
		break;	
	case 'removeplace' :
		HTML_vikrentcar::printHeader();
		removePlace($cid, $option);
		break;	
	case 'cancelplace' :
		HTML_vikrentcar::printHeader();
		cancelEditingPlace($option);
		break;
	case 'viewiva' :
		HTML_vikrentcar::printHeader("2");
		viewIva($option);
		break;
	case 'newiva' :
		HTML_vikrentcar::printHeader("2");
		newIva($option);
		break;
	case 'editiva' :
		HTML_vikrentcar::printHeader("2");
		editIva($cid[0], $option);
		break;	
	case 'createiva' :
		HTML_vikrentcar::printHeader();
		saveIva($option);
		break;
	case 'updateiva' :
		HTML_vikrentcar::printHeader();
		updateIva($option);
		break;	
	case 'removeiva' :
		HTML_vikrentcar::printHeader();
		removeIva($cid, $option);
		break;	
	case 'canceliva' :
		HTML_vikrentcar::printHeader();
		cancelEditingIva($option);
		break;	
	case 'viewprices' :
		HTML_vikrentcar::printHeader("1");
		viewPrices($option);
		break;
	case 'newprice' :
		HTML_vikrentcar::printHeader("1");
		newPrice($option);
		break;
	case 'editprice' :
		HTML_vikrentcar::printHeader("1");
		editPrice($cid[0], $option);
		break;	
	case 'createprice' :
		HTML_vikrentcar::printHeader();
		savePrice($option);
		break;
	case 'updateprice' :
		HTML_vikrentcar::printHeader();
		updatePrice($option);
		break;	
	case 'removeprice' :
		HTML_vikrentcar::printHeader();
		removePrice($cid, $option);
		break;	
	case 'cancelprice' :
		HTML_vikrentcar::printHeader();
		cancelEditingPrice($option);
		break;
	case 'viewcategories' :
		HTML_vikrentcar::printHeader("4");
		viewCategories($option);
		break;
	case 'newcat' :
		HTML_vikrentcar::printHeader("4");
		newCat($option);
		break;
	case 'editcat' :
		HTML_vikrentcar::printHeader("4");
		editCat($cid[0], $option);
		break;	
	case 'createcat' :
		HTML_vikrentcar::printHeader();
		saveCat($option);
		break;
	case 'updatecat' :
		HTML_vikrentcar::printHeader();
		updateCat($option);
		break;	
	case 'removecat' :
		HTML_vikrentcar::printHeader();
		removeCat($cid, $option);
		break;	
	case 'cancelcat' :
		HTML_vikrentcar::printHeader();
		cancelEditingCat($option);
		break;
	case 'viewcarat' :
		HTML_vikrentcar::printHeader("5");
		viewCarat($option);
		break;
	case 'newcarat' :
		HTML_vikrentcar::printHeader("5");
		newCarat($option);
		break;
	case 'editcarat' :
		HTML_vikrentcar::printHeader("5");
		editCarat($cid[0], $option);
		break;	
	case 'createcarat' :
		HTML_vikrentcar::printHeader();
		saveCarat($option);
		break;
	case 'updatecarat' :
		HTML_vikrentcar::printHeader();
		updateCarat($option);
		break;	
	case 'removecarat' :
		HTML_vikrentcar::printHeader();
		removeCarat($cid, $option);
		break;	
	case 'cancelcarat' :
		HTML_vikrentcar::printHeader();
		cancelEditingCarat($option);
		break;
	case 'viewoptionals' :
		HTML_vikrentcar::printHeader("6");
		viewOptionals($option);
		break;
	case 'newoptionals' :
		HTML_vikrentcar::printHeader("6");
		newOptionals($option);
		break;
	case 'editoptional' :
		HTML_vikrentcar::printHeader("6");
		editOptional($cid[0], $option);
		break;	
	case 'createoptionals' :
		HTML_vikrentcar::printHeader();
		saveOptionals($option);
		break;
	case 'updateoptional' :
		HTML_vikrentcar::printHeader();
		updateOptional($option);
		break;	
	case 'removeoptionals' :
		HTML_vikrentcar::printHeader();
		removeOptionals($cid, $option);
		break;	
	case 'canceloptionals' :
		HTML_vikrentcar::printHeader();
		cancelEditingOptionals($option);
		break;
	case 'viewstats' :
		HTML_vikrentcar::printHeader("10");
		viewStats($option);
		break;
	case 'removestats' :
		HTML_vikrentcar::printHeader();
		removeStats($cid, $option);
		break;	
	case 'cancelstats' :
		HTML_vikrentcar::printHeader();
		cancelEditingStats($option);
		break;		
	case 'viewcar' :
		HTML_vikrentcar::printHeader("7");
		viewCar($option);
		break;
	case 'newcar' :
		HTML_vikrentcar::printHeader("7");
		newCar($option);
		break;
	case 'editcar' :
		HTML_vikrentcar::printHeader("7");
		editCar($cid[0], $option);
		break;	
	case 'createcar' :
		HTML_vikrentcar::printHeader();
		saveCar($option);
		break;
	case 'updatecar' :
		HTML_vikrentcar::printHeader();
		updateCar($option);
		break;
	case 'updatecarapply' :
		HTML_vikrentcar::printHeader();
		updateCar($option, true);
		break;
	case 'removecar' :
		HTML_vikrentcar::printHeader();
		removeCar($cid, $option);
		break;	
	case 'modavail' :
		HTML_vikrentcar::printHeader();
		modAvail($cid[0], $option);
		break;	
	case 'viewtariffe' :
		viewTariffe($cid[0], $option);
		break;
	case 'removetariffe' :
		removeTariffe($cid, $option);
		break;
	case 'viewtariffehours' :
		viewTariffeHours($cid[0], $option);
		break;
	case 'removetariffehours' :
		removeTariffeHours($cid, $option);
		break;
	case 'viewhourscharges' :
		viewHoursCharges($cid[0], $option);
		break;
	case 'removehourscharges' :
		removeHoursCharges($cid, $option);
		break;
	case 'calendar' :
		viewCalendar($cid[0], $option);
		break;
	case 'editbusy' :
		editBusy($cid[0], $option);
		break;
	case 'updatebusy' :
		updateBusy($option);
		break;
	case 'removebusy' :
		HTML_vikrentcar::printHeader();
		removeBusy($option);
		break;								
	case 'cancel' :
		HTML_vikrentcar::printHeader();
		cancelEditing($option);
		break;
	case 'cancelcalendar' :
		HTML_vikrentcar::printHeader();
		cancelCalendar($option);
		break;
	case 'vieworders' :
		HTML_vikrentcar::printHeader("8");
		viewOrders($option);
		break;
	case 'removeorders' :
		HTML_vikrentcar::printHeader();
		removeOrders($cid, $option);
		break;
	case 'editorder' :
		HTML_vikrentcar::printHeader("8");
		editOrder($cid[0], $option);
		break;	
	case 'canceledorder' :
		HTML_vikrentcar::printHeader();
		cancelEditingOrders($option);
		break;
	case 'viewoldorders' :
		HTML_vikrentcar::printHeader("9");
		viewOldOrders($option);
		break;
	case 'removeoldorders' :
		HTML_vikrentcar::printHeader();
		removeOldOrders($cid, $option);
		break;
	case 'editoldorder' :
		HTML_vikrentcar::printHeader("9");
		editOldOrder($cid[0], $option);
		break;
	case 'canceledoldorder' :
		HTML_vikrentcar::printHeader();
		cancelEditingOldOrders($option);
		break;						
	case 'config' :
		HTML_vikrentcar::printHeader("11");
		viewConfig($option);
		break;	
	case 'saveconfig' :
		HTML_vikrentcar::printHeader();
		saveConfig($option);
		break;
	case 'goconfig' :
		goConfig($option);
		break;
	case 'choosebusy' :
		chooseBusy($option);
		break;
	case 'locfees' :
		HTML_vikrentcar::printHeader("12");
		locFees($option);
		break;
	case 'newlocfee' :
		HTML_vikrentcar::printHeader("12");
		newLocFee($option);
		break;
	case 'editlocfee' :
		HTML_vikrentcar::printHeader("12");
		editLocFee($cid[0], $option);
		break;	
	case 'createlocfee' :
		HTML_vikrentcar::printHeader();
		saveLocFee($option);
		break;
	case 'updatelocfee' :
		HTML_vikrentcar::printHeader();
		updateLocFee($option);
		break;	
	case 'removelocfee' :
		HTML_vikrentcar::printHeader();
		removeLocFee($cid, $option);
		break;	
	case 'cancellocfee' :
		HTML_vikrentcar::printHeader();
		cancelEditingLocFee($option);
		break;
	case 'seasons' :
		HTML_vikrentcar::printHeader("13");
		showSeasons($option);
		break;
	case 'newseason' :
		HTML_vikrentcar::printHeader("13");
		newSeason($option);
		break;
	case 'editseason' :
		HTML_vikrentcar::printHeader("13");
		editSeason($cid[0], $option);
		break;	
	case 'createseason' :
		HTML_vikrentcar::printHeader();
		saveSeason($option);
		break;
	case 'updateseason' :
		HTML_vikrentcar::printHeader();
		updateSeason($option);
		break;	
	case 'removeseasons' :
		HTML_vikrentcar::printHeader();
		removeSeasons($cid, $option);
		break;	
	case 'cancelseason' :
		HTML_vikrentcar::printHeader();
		cancelEditingSeason($option);
		break;
	case 'payments' :
		HTML_vikrentcar::printHeader("14");
		showPayments($option);
		break;
	case 'newpayment' :
		HTML_vikrentcar::printHeader("14");
		newPayment($option);
		break;
	case 'editpayment' :
		HTML_vikrentcar::printHeader("14");
		editPayment($cid[0], $option);
		break;	
	case 'createpayment' :
		HTML_vikrentcar::printHeader();
		savePayment($option);
		break;
	case 'updatepayment' :
		HTML_vikrentcar::printHeader();
		updatePayment($option);
		break;	
	case 'removepayments' :
		HTML_vikrentcar::printHeader();
		removePayments($cid, $option);
		break;	
	case 'cancelpayment' :
		HTML_vikrentcar::printHeader();
		cancelEditingPayment($option);
		break;
	case 'setordconfirmed' :
		setOrderConfirmed($cid[0], $option);
		break;
	case 'overview' :
		HTML_vikrentcar::printHeader("15");
		showOverview($option);
		break;
	case 'viewcustomf' :
		HTML_vikrentcar::printHeader("16");
		viewCustomf($option);
		break;
	case 'newcustomf' :
		HTML_vikrentcar::printHeader("16");
		newCustomf($option);
		break;
	case 'editcustomf' :
		HTML_vikrentcar::printHeader("16");
		editCustomf($cid[0], $option);
		break;	
	case 'createcustomf' :
		HTML_vikrentcar::printHeader();
		saveCustomf($option);
		break;
	case 'updatecustomf' :
		HTML_vikrentcar::printHeader();
		updateCustomf($option);
		break;	
	case 'removecustomf' :
		HTML_vikrentcar::printHeader();
		removeCustomf($cid, $option);
		break;	
	case 'cancelcustomf' :
		HTML_vikrentcar::printHeader();
		cancelEditingCustomf($option);
		break;
	case 'sortfield' :
		sortField($option);
		break;
	case 'removemoreimgs' :
		removeMoreImgs($option);
		break;
	case 'viewcoupons' :
		HTML_vikrentcar::printHeader("17");
		viewCoupons($option);
		break;
	case 'newcoupon' :
		HTML_vikrentcar::printHeader("17");
		newCoupon($option);
		break;
	case 'editcoupon' :
		HTML_vikrentcar::printHeader("17");
		editCoupon($cid[0], $option);
		break;	
	case 'createcoupon' :
		HTML_vikrentcar::printHeader();
		saveCoupon($option);
		break;
	case 'updatecoupon' :
		HTML_vikrentcar::printHeader();
		updateCoupon($option);
		break;	
	case 'removecoupons' :
		HTML_vikrentcar::printHeader();
		removeCoupons($cid, $option);
		break;	
	case 'cancelcoupon' :
		HTML_vikrentcar::printHeader();
		cancelEditingCoupon($option);
		break;
	case 'cars' :
		HTML_vikrentcar::printHeader("7");
		viewCar($option);
		break;
	case 'resendordemail' :
		resendOrderEmail($cid[0], $option);
		break;
	case 'sortcarat' :
		sortCarat($option);
		break;
	case 'sortoptional' :
		sortOptional($option);
		break;
	case 'viewexport' :
		HTML_vikrentcar::printHeader("8");
		viewExport($option);
		break;
	case 'doexport' :
		doExport($option);
		break;
	case 'renewsession' :
		renewSession($option);
		break;
	case 'oohfees' :
		HTML_vikrentcar::printHeader("20");
		viewOohfees($option);
		break;
	case 'newoohfee' :
		HTML_vikrentcar::printHeader("20");
		newOohfee($option);
		break;
	case 'editoohfee' :
		HTML_vikrentcar::printHeader("20");
		editOohfee($cid[0], $option);
		break;	
	case 'createoohfee' :
		saveOohfee($option);
		break;
	case 'updateoohfee' :
		updateOohfee($option);
		break;	
	case 'removeoohfees' :
		removeOohfees($cid, $option);
		break;	
	case 'canceloohfee' :
		cancelEditingOohfee($option);
		break;
	case 'customercheckin' :
		customerCheckin($cid[0], $option);
		break;
	case 'sortlocation' :
		sortLocation($cid[0], $option);
		break;
	case 'geninvoices' :
		generateInvoices($cid, $option);
		break;
	case 'loadpaymentparams' :
		loadPaymentParams();
		break;
	case 'translations' :
		HTML_vikrentcar::printHeader("21");
		viewTranslations($option);
		break;
	case 'savetranslationstay' :
		saveTranslations($option, true);
		break;
	case 'savetranslation' :
		saveTranslations($option);
		break;
	case 'sortcategory' :
		sortCategory($cid[0], $option);
		break;
	case 'edittmplfile' :
		editTmplFile($option);
		break;
	case 'savetmplfile' :
		saveTmplFile($option);
		break;
	case 'unlockrecords' :
		unlockRecords($cid, $option);
		break;
	case 'graphs' :
		//HTML_vikrentcar::printHeader("22");
		viewGraphs($option);
		break;
	case 'checkversion' :
		checkVersion($option);
		break;
	case 'updateprogram' :
		updateProgram($option);
		break;
	case 'updateprogramlaunch' :
		updateProgramLaunch($option);
		break;
	default :
		HTML_vikrentcar::printHeader("18");
		viewDashboard($option);
		break;
}

if(vikrentcar::showFooter()) HTML_vikrentcar::printFooter();

function checkversion($option) {
	$params = new stdClass;
	$params->version 	= E4J_SOFTWARE_VERSION;
	$params->alias 		= $option;

	JPluginHelper::importPlugin('e4j');
	$dispatcher = JEventDispatcher::getInstance();

	$result = $dispatcher->trigger('checkVersion', array(&$params));

	if (!count($result)) {
		$result = new stdClass;
		$result->status = 0;
	} else {
		$result = $result[0];
	}

	echo json_encode($result);
	exit;
}

function updateProgram($option) {
	$params = new stdClass;
	$params->version 	= E4J_SOFTWARE_VERSION;
	$params->alias 		= $option;

	JPluginHelper::importPlugin('e4j');
	$dispatcher = JEventDispatcher::getInstance();
	
	$result = $dispatcher->trigger('getVersionContents', array(&$params));

	if (!count($result) || !$result[0]) {
		$result = $dispatcher->trigger('checkVersion', array(&$params));
	}

	if (!count($result) || !$result[0]->status || !$result[0]->response->status) {
		exit('Error, plugin disabled');
	}

	JToolbarHelper::title(JText::_('VRMAINTITLEUPDATEPROGRAM'));

	HTML_vikrentcar::pUpdateProgram($result[0]->response);
}

function updateProgramLaunch($option) {
	$params = new stdClass;
	$params->version 	= E4J_SOFTWARE_VERSION;
	$params->alias 		= $option;

	JPluginHelper::importPlugin('e4j');
	$dispatcher = JEventDispatcher::getInstance();

	$json = new stdClass;
	$json->status = false;

	try {

		$result = $dispatcher->trigger('doUpdate', array(&$params));

		if( count($result) ) {
			$json->status = (bool) $result[0];
		} else {
			$json->error = 'plugin disabled.';
		}

	} catch(Exception $e) {

		$json->status = false;
		$json->error = $e->getMessage();

	}

	echo json_encode($json);
	exit;
}

function loadPaymentParams() {
	$html = '---------';
	$phpfile = VikRequest::getString('phpfile', '', 'request');
	if (!empty($phpfile)) {
		$html = vikrentcar::displayPaymentParameters($phpfile);
	}
	echo $html;
	exit;
}

function saveTmplFile($option) {
	$fpath = VikRequest::getString('path', '', 'request', VIKREQUEST_ALLOWHTML);
	$pcont = VikRequest::getString('cont', '', 'request', VIKREQUEST_ALLOWHTML);
	$mainframe = JFactory::getApplication();
	$exists = file_exists($fpath) ? true : false;
	if (!$exists) {
		$fpath = urldecode($fpath);
	}
	$fpath = file_exists($fpath) ? $fpath : '';
	if (!empty($fpath)) {
		$fp = fopen($fpath, 'wb');
		$byt = (int)fwrite($fp, $pcont);
		fclose($fp);
		if ($byt > 0) {
			$mainframe->enqueueMessage(JText::_('VRCUPDTMPLFILEOK'));
		} else {
			VikError::raiseWarning('', JText::_('VRCUPDTMPLFILENOBYTES'));
		}
	}else {
		VikError::raiseWarning('', JText::_('VRCUPDTMPLFILEERR'));
	}
	$mainframe->redirect("index.php?option=".$option."&task=edittmplfile&path=".$fpath."&tmpl=component");

	exit;
}

function editTmplFile($option) {
	$fpath = VikRequest::getString('path', '', 'request', VIKREQUEST_ALLOWHTML);
	$exists = file_exists($fpath) ? true : false;
	if(!$exists) {
		$fpath = urldecode($fpath);
	}
	$fpath = file_exists($fpath) ? $fpath : '';
	HTML_vikrentcar::pEditTmplFile($fpath, $option);
}

function viewGraphs($option) {
	$dbo = JFactory::getDBO();
	$session = JFactory::getSession();
	JHtml::_('script', JURI::root().'administrator/components/com_vikrentcar/resources/Chart.min.js', false, true, false, false);
	$pid_car = VikRequest::getInt('id_car', '', 'request');
	$pstatsmode = VikRequest::getString('statsmode', '', 'request');
	$sess_statsmode = $session->get('vrViewStatsMode', '');
	$pstatsmode = empty($pstatsmode) && !empty($sess_statsmode) ? $sess_statsmode : $pstatsmode;
	$pstatsmode = in_array($pstatsmode, array('ts', 'nights')) ? $pstatsmode : 'ts';
	$pdfrom = VikRequest::getString('dfrom', '', 'request');
	$sess_from = $session->get('vrViewStatsFrom', '');
	$pdfrom = empty($pdfrom) && !empty($sess_from) ? $sess_from : $pdfrom;
	$fromts = !empty($pdfrom) ? vikrentcar::getDateTimestamp($pdfrom, '0', '0') : 0;
	$pdto = VikRequest::getString('dto', '', 'request');
	$sess_to = $session->get('vrViewStatsTo', '');
	$pdto = empty($pdto) && !empty($sess_to) ? $sess_to : $pdto;
	$tots = !empty($pdto) ? vikrentcar::getDateTimestamp($pdto, '23', '59') : 0;
	$tots = $tots < $fromts ? 0 : $tots;
	//store last dates in session
	if(!empty($pdfrom)) {
		$session->set('vrViewStatsFrom', $pdfrom);
		$session->set('vrViewStatsTo', $pdto);
	}
	$session->set('vrViewStatsMode', $pstatsmode);
	//
	$arr_cars = array();
	$q = "SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$arr_cars = $dbo->loadAssocList();
	}
	$bookings = array();
	$arr_months = array();
	$arr_channels = array();
	$arr_countries = array();
	$arr_totals = array('total_income' => 0, 'nights_sold' => 0);
	$tot_cars_units = 0;
	//Dates Clauses
	$from_clause = "`o`.`ts`>=".$fromts;
	$to_clause = "`o`.`ts`<=".$tots;
	$order_by = "`o`.`ts` ASC";
	if($pstatsmode == 'nights') {
		$from_clause = "`o`.`consegna`>=".$fromts;
		$to_clause = "`o`.`ritiro`<=".$tots;
		$order_by = "`o`.`ritiro` ASC";
	}
	//
	if(!empty($pid_car)) {
		//filter by car
		$q = "SELECT `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy` WHERE `o`.`status`='confirmed' AND `o`.`idcar`=".$pid_car.(!empty($fromts) ? " AND ".$from_clause : "").(!empty($tots) ? " AND ".$to_clause : "")." ORDER BY ".$order_by.";";
	}else {
		$q = "SELECT `o`.*,`b`.`stop_sales`".($pstatsmode == 'nights' ? ",(SELECT GROUP_CONCAT(`c`.`name` SEPARATOR ',') FROM `#__vikrentcar_cars` AS `c` WHERE `c`.`id`=`o`.`idcar`) AS `car_names`" : '')." FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy` WHERE `o`.`status`='confirmed'".(!empty($fromts) ? " AND ".$from_clause : "").(!empty($tots) ? " AND ".$to_clause : "")." ORDER BY ".$order_by.";";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$bookings = $dbo->loadAssocList();
		$first_ts = $bookings[0]['ts'];
		end($bookings);
		$last_ts = $bookings[(key($bookings))]['ts'];
		reset($bookings);
		$fromts = empty($fromts) ? $first_ts : $fromts;
		$tots = empty($tots) ? $last_ts : $tots;
		foreach ($bookings as $bk => $o) {
			$info_ts = getdate(($pstatsmode == 'nights' ? $o['ritiro'] : $o['ts']));
			$monyear = $info_ts['mon'].'-'.$info_ts['year'];
			if($pstatsmode == 'nights') {
				$is_closure = ($o['stop_sales'] == 1);
				//Prepare the cars booked array
				if(array_key_exists('car_names', $o) && strlen($o['car_names']) > 1) {
					if(!$is_closure) {
						$o['car_names'] = explode(',', $o['car_names']);
					}else {
						unset($o['car_names']);
					}
				}
				//Check and calculate average totals depending on the booked dates - set labels for months of check-in
				if($o['order_total'] > 0) {
					if($o['ritiro'] < $fromts || $o['consegna'] > $tots) {
						$days_in = 0;
						$oinfo_start = getdate($o['ritiro']);
						$oinfo_start = getdate(mktime($oinfo_start['hours'], $oinfo_start['minutes'], $oinfo_start['seconds'], $oinfo_start['mon'], ($oinfo_start['mday'] + 1), $oinfo_start['year']));
						$oinfo_end = getdate($o['consegna']);
						$ots_end = $oinfo_end[0];
						while ($oinfo_start[0] < $ots_end) {
							if($oinfo_start[0] >= $fromts && $oinfo_start[0] <= $tots) {
								$days_in++;
								if($days_in === 1) {
									//Reset variables for the month where the booking took place, it has to be the first night considered
									$monyear = $oinfo_start['mon'].'-'.$oinfo_start['year'];
								}
							}
							if($oinfo_start[0] > $tots) {
								break;
							}
							$oinfo_start = getdate(mktime($oinfo_start['hours'], $oinfo_start['minutes'], $oinfo_start['seconds'], $oinfo_start['mon'], ($oinfo_start['mday'] + 1), $oinfo_start['year']));
						}
						$fullo_total = $o['order_total'];
						$o['order_total'] = round(($o['order_total'] / $o['days'] * $days_in), 2);
						//set new number of nights, percentage of the booked nights calculated and update booking
						$o['avg_stay_pcent'] = 100 * $days_in / $o['days'];
						$o['days'] = $days_in;
					}
				}elseif($is_closure) {
					//car is closed, set the number of nights to 0 for statistics
					$o['avg_stay_pcent'] = 0;
					$o['days'] = 0;
				}else {
					//Total equal to 0 and not a closure
					$o['avg_stay_pcent'] = 0;
					$o['days'] = 0;
				}
				$bookings[$bk] = $o;
				//
				if(!($o['days'] > 0)) {
					//VRC 1.11 Nights-Mode should skip bookings with 0 nights
					continue;
				}
			}
			$arr_totals['total_income'] += $o['order_total'];
			$arr_totals['nights_sold'] += $o['days'];
			if(!empty($o['country'])) {
				if(!array_key_exists($o['country'], $arr_countries)) {
					$arr_countries[$o['country']] = 1;
				}else {
					$arr_countries[$o['country']]++;
				}
			}
			$channel = JText::_('VRCWEBSITECHANNEL');
			if(!in_array($channel, $arr_channels)) {
				$arr_channels[] = $channel;
			}
			if(!array_key_exists($monyear, $arr_months)) {
				$arr_months[$monyear] = array();
			}
			if(!array_key_exists($channel, $arr_months[$monyear])) {
				$arr_months[$monyear][$channel] = array($o);
			}else {
				$arr_months[$monyear][$channel][] = $o;
			}
		}
		if(count($arr_countries)) {
			asort($arr_countries);
			$arr_countries = array_reverse($arr_countries, true);
			$all_countries = array_keys($arr_countries);
			foreach ($all_countries as $kc => $country) {
				$all_countries[$kc] = $dbo->quote($country);
			}
			$q = "SELECT `country_name`,`country_3_code` FROM `#__vikrentcar_countries` WHERE `country_3_code` IN (".implode(',', $all_countries).");";
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() > 0) {
				$countries_names = $dbo->loadAssocList();
				foreach ($countries_names as $kc => $vc) {
					$country_flag = '';
					if(file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'countries'.DIRECTORY_SEPARATOR.$vc['country_3_code'].'.png')) {
						$country_flag = '<img src="'.JURI::root().'administrator/components/com_vikrentcar/resources/countries/'.$vc['country_3_code'].'.png'.'" title="'.$vc['country_name'].'" />';
					}
					$arr_countries[$vc['country_3_code']] = array('country_name' => $vc['country_name'], 'tot_bookings' => $arr_countries[$vc['country_3_code']], 'img' => $country_flag);
				}
			}else {
				$arr_countries = array();
			}
		}
		$q = "SELECT SUM(`units`) AS `tot` FROM `#__vikrentcar_cars` WHERE ".(!empty($pid_car) ? "`id`=".$pid_car : "`avail`=1").";";
		$dbo->setQuery($q);
		$dbo->execute();
		$tot_cars_units = (int)$dbo->loadResult();
	}
	HTML_vikrentcar::pViewGraphs($bookings, $arr_cars, $fromts, $tots, $pstatsmode, $arr_months, $arr_channels, $arr_countries, $arr_totals, $tot_cars_units, $option);
}

function sortCategory ($sortid, $option) {
	$sortid = (int)$sortid;
	$pmode = VikRequest::getString('mode', '', 'request');
	$dbo = JFactory::getDBO();
	if (!empty($pmode)) {
		$q="SELECT `id`,`ordering` FROM `#__vikrentcar_categories` ORDER BY `#__vikrentcar_categories`.`ordering` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$totr=$dbo->getNumRows();
		if ($totr > 1) {
			$data = $dbo->loadAssocList();
			if ($pmode=="up") {
				foreach($data as $v){
					if ($v['id']==$sortid) {
						$y=$v['ordering'];
					}
				}
				if ($y && $y > 1) {
					$vik=$y - 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_categories` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_categories` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_categories` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}elseif ($pmode=="down") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y) {
					$vik=$y + 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_categories` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_categories` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_categories` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewcategories");
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function saveTranslations($option, $stay = false) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$vrc_tn = vikrentcar::getTranslator();
	$table = VikRequest::getString('vrc_table', '', 'request');
	$cur_langtab = VikRequest::getString('vrc_lang', '', 'request');
	$langs = $vrc_tn->getLanguagesList();
	$xml_tables = $vrc_tn->getTranslationTables();
	if(!empty($table) && array_key_exists($table, $xml_tables)) {
		$tn = VikRequest::getVar('tn', array(), 'request', VIKREQUEST_ALLOWHTML);
		$tn_saved = 0;
		$table_cols = $vrc_tn->getTableColumns($table);
		$table = $vrc_tn->replacePrefix($table);
		foreach ($langs as $ltag => $lang) {
			if($ltag == $vrc_tn->default_lang) {
				continue;
			}
			if(array_key_exists($ltag, $tn) && count($tn[$ltag]) > 0) {
				foreach ($tn[$ltag] as $reference_id => $translation) {
					$lang_translation = array();
					foreach ($table_cols as $field => $fdetails) {
						if(!array_key_exists($field, $translation)) {
							continue;
						}
						$ftype = $fdetails['type'];
						if($ftype == 'skip') {
							continue;
						}
						if($ftype == 'json') {
							$translation[$field] = json_encode($translation[$field]);
						}
						$lang_translation[$field] = $translation[$field];
					}
					if(count($lang_translation) > 0) {
						$q = "SELECT `id` FROM `#__vikrentcar_translations` WHERE `table`=".$dbo->quote($table)." AND `lang`=".$dbo->quote($ltag)." AND `reference_id`=".$dbo->quote((int)$reference_id).";";
						$dbo->setQuery($q);
						$dbo->execute();
						if($dbo->getNumRows() > 0) {
							$last_id = $dbo->loadResult();
							$q = "UPDATE `#__vikrentcar_translations` SET `content`=".$dbo->quote(json_encode($lang_translation))." WHERE `id`=".(int)$last_id.";";
						}else {
							$q = "INSERT INTO `#__vikrentcar_translations` (`table`,`lang`,`reference_id`,`content`) VALUES (".$dbo->quote($table).", ".$dbo->quote($ltag).", ".$dbo->quote((int)$reference_id).", ".$dbo->quote(json_encode($lang_translation)).");";
						}
						$dbo->setQuery($q);
						$dbo->execute();
						$tn_saved++;
					}
				}
			}
		}
		if($tn_saved > 0) {
			$mainframe->enqueueMessage(JText::_('VRCTRANSLSAVEDOK'));
		}
	}else {
		VikError::raiseWarning('', JText::_('VRCTRANSLATIONERRINVTABLE'));
	}
	$mainframe->redirect("index.php?option=".$option.($stay ? '&task=translations&vrc_table='.$vrc_tn->replacePrefix($table).'&vrc_lang='.$cur_langtab : ''));
}

function viewTranslations($option) {
	$vrc_tn = vikrentcar::getTranslator();
	HTML_vikrentcar::pViewTranslations($vrc_tn, $option);
}

function generateInvoices($ids, $option) {
	$mainframe = JFactory::getApplication();
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		require_once(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "helpers" . DS . "tcpdf" . DS . 'tcpdf.php');
		if (file_exists(JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "helpers" . DS . "tcpdf" . DS . "fonts" . DS . "dejavusans.php")) {
			$usepdffont = 'dejavusans';
		}else {
			$usepdffont = 'helvetica';
		}
		$pinvoice_num = VikRequest::getInt('invoice_num', '', 'request');
		$pinvoice_num = $pinvoice_num <= 0 ? 1 : $pinvoice_num;
		$pinvoice_suff = VikRequest::getString('invoice_suff', '', 'request');
		$pinvoice_date = VikRequest::getString('invoice_date', '', 'request');
		$pcompany_info = VikRequest::getString('company_info', '', 'request', VIKREQUEST_ALLOWHTML);
		$pinvoice_send = VikRequest::getString('invoice_send', '', 'request');
		$pinvoice_send = $pinvoice_send == '1' ? 1 : 0;
		$nowdf = vikrentcar::getDateFormat(true);
		$nowtf = vikrentcar::getTimeFormat(true);
		$tf = $nowtf;
		if ($nowdf=="%d/%m/%Y") {
			$df='d/m/Y';
		}elseif ($nowdf=="%m/%d/%Y") {
			$df='m/d/Y';
		}else {
			$df='Y/m/d';
		}
		$today = date($df);
		$admail = vikrentcar::getAdminMail();
		$currencyname = vikrentcar::getCurrencyName();
		$companylogo = vikrentcar::getSiteLogo();
		$uselogo = '';
		if (!empty($companylogo)) {
			$uselogo = '<img src="./components/com_vikrentcar/resources/'.$companylogo.'"/>';
		}
		$totinvgen = 0;
		sort($ids);
		foreach ($ids as $oid) {
			$q = "SELECT * FROM `#__vikrentcar_orders` WHERE `id`=".(int)$oid." AND `status`='confirmed';";
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() == 1) {
				$order = $dbo->loadAssocList();
				$isdue = 0;
				$descriptions = array();
				$netprices = array();
				$taxes = array();
				//check if the language in use is the same as the one used during the checkout
				if (!empty($order[0]['lang'])) {
					$lang = JFactory::getLanguage();
					if($lang->getTag() != $order[0]['lang']) {
						$lang->load('com_vikrentcar', JPATH_ADMINISTRATOR, $order[0]['lang'], true);
					}
				}
				//
				$car = vikrentcar::getCarInfo($order[0]['idcar']);
				$is_cust_cost = (!empty($order[0]['cust_cost']) && $order[0]['cust_cost'] > 0);
				if(!empty($order[0]['idtar'])) {
					if($order[0]['hourly'] == 1) {
						$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$order[0]['idtar']."';";
					}else {
						$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
					}
					$dbo->setQuery($q);
					$dbo->execute();
					if($dbo->getNumRows() == 0) {
						if($order[0]['hourly'] == 1) {
							$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
							$dbo->setQuery($q);
							$dbo->execute();
							if($dbo->getNumRows() == 1) {
								$tar = $dbo->loadAssocList();
							}
						}
					}else {
						$tar = $dbo->loadAssocList();
					}
				}elseif ($is_cust_cost) {
					//Custom Rate
					$tar = array(0 => array(
						'id' => -1,
						'idcar' => $order[0]['idcar'],
						'days' => $order[0]['days'],
						'idprice' => -1,
						'cost' => $order[0]['cust_cost'],
						'attrdata' => '',
					));
				}
				if($order[0]['hourly'] == 1 && !empty($tar[0]['hours'])) {
					foreach($tar as $kt => $vt) {
						$tar[$kt]['days'] = 1;
					}
				}
				$checkhourscharges = 0;
				$ppickup = $order[0]['ritiro'];
				$prelease = $order[0]['consegna'];
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
				if($checkhourscharges > 0 && $aehourschbasp == true && !$is_cust_cost) {
					$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, false, true, true);
					$tar = $ret['return'];
					$calcdays = $ret['days'];
				}
				if($checkhourscharges > 0 && $aehourschbasp == false && !$is_cust_cost) {
					$tar = vikrentcar::extraHoursSetPreviousFareCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true);
					$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
					$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true, true, true);
					$tar = $ret['return'];
					$calcdays = $ret['days'];
				}else {
					if(!$is_cust_cost) {
						//Seasonal prices only if not a custom rate
						$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
					}
				}
				$ritplace=(!empty($order[0]['idplace']) ? vikrentcar::getPlaceName($order[0]['idplace']) : "");
				$consegnaplace=(!empty($order[0]['idreturnplace']) ? vikrentcar::getPlaceName($order[0]['idreturnplace']) : "");
				$costplusiva = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
				$costminusiva = $is_cust_cost ? vikrentcar::sayCustCostMinusIva($tar[0]['cost'], $order[0]['cust_idiva']) : vikrentcar::sayCostMinusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
				$pricestr = JText::sprintf('VRCINVDESCRCONT', $car['name'], date($df.' '.$tf, $order[0]['ritiro']))."\n";
				$pricestr .= ($is_cust_cost ? JText::_('VRCRENTCUSTRATEPLAN') : vikrentcar::getPriceName($tar[0]['idprice'])).(!empty($tar[0]['attrdata']) ? "\n".vikrentcar::getPriceAttr($tar[0]['idprice']).": ".$tar[0]['attrdata'] : "");
				//description
				$descriptions[] = nl2br(rtrim($pricestr, "\n"));
				//Prices
				$netprices[] = $costminusiva;
				$taxes[] = ($costplusiva - $costminusiva);
				$isdue = $costplusiva;
				//Options
				if (!empty($order[0]['optionals'])) {
					$stepo=explode(";", $order[0]['optionals']);
					foreach($stepo as $oo){
						if (!empty($oo)) {
							$stept=explode(":", $oo);
							$q="SELECT `name`,`cost`,`perday`,`hmany`,`idiva`,`maxprice` FROM `#__vikrentcar_optionals` WHERE `id`=".intval($stept[0]).";";
							$dbo->setQuery($q);
							$dbo->execute();
							if ($dbo->getNumRows() == 1) {
								$actopt=$dbo->loadAssocList();
								$realcost=(intval($actopt[0]['perday'])==1 ? ($actopt[0]['cost'] * $order[0]['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
								if (!empty($actopt[0]['maxprice']) && $actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
									$realcost = $actopt[0]['maxprice'];
									if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
										$realcost = $actopt[0]['maxprice'] * $stept[1];
									}
								}
								$tmpopr=vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva'], $order[0]);
								$isdue+=$tmpopr;
								$optnetprice = vikrentcar::sayOptionalsMinusIva($realcost, $actopt[0]['idiva'], $order[0]);
								$descriptions[] = ($stept[1] > 1 ? $stept[1]." " : "").$actopt[0]['name'].": ".$tmpopr;
								$netprices[] = $optnetprice;
								$taxes[] = ($tmpopr - $optnetprice);
							}
						}
					}
				}
				//Location Fees
				if(!empty($order[0]['idplace']) && !empty($order[0]['idreturnplace'])) {
					$locfee=vikrentcar::getLocFee($order[0]['idplace'], $order[0]['idreturnplace']);
					if($locfee) {
						if (strlen($locfee['losoverride']) > 0) {
							$arrvaloverrides = array();
							$valovrparts = explode('_', $locfee['losoverride']);
							foreach($valovrparts as $valovr) {
								if (!empty($valovr)) {
									$ovrinfo = explode(':', $valovr);
									$arrvaloverrides[$ovrinfo[0]] = $ovrinfo[1];
								}
							}
							if (array_key_exists($order[0]['days'], $arrvaloverrides)) {
								$locfee['cost'] = $arrvaloverrides[$order[0]['days']];
							}
						}
						$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $order[0]['days']) : $locfee['cost'];
						$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $order[0]);
						$isdue+=$locfeewith;
						$locfeewithouttax = vikrentcar::sayLocFeeMinusIva($locfeecost, $locfee['idiva'], $order[0]);
						$descriptions[] = JText::_('VRLOCFEETOPAY');
						$netprices[] = $locfeewithouttax;
						$taxes[] = ($locfeewith - $locfeewithouttax);
					}
				}
				//Out of Hours Fees
				$oohfee = vikrentcar::getOutOfHoursFees($order[0]['idplace'], $order[0]['idreturnplace'], $order[0]['ritiro'], $order[0]['consegna'], array('id' => $order[0]['idcar']));
				if(count($oohfee) > 0) {
					$oohfeewith = vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
					$isdue += $oohfeewith;
					$oohfeewithouttax = vikrentcar::sayOohFeeMinusIva($oohfee['cost'], $oohfee['idiva']);
					$mailoohfee = $oohfeewith;
					$descriptions[] = JText::_('VRCOOHFEEAMOUNT');
					$netprices[] = $oohfeewithouttax;
					$taxes[] = ($oohfeewith - $oohfeewithouttax);
				}
				//custom extra costs
				if(!empty($order[0]['extracosts'])) {
					$cur_extra_costs = json_decode($order[0]['extracosts'], true);
					foreach ($cur_extra_costs as $eck => $ecv) {
						$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $order[0]);
						$isdue += $efee_cost;
						$efee_cost_without = vikrentcar::sayOptionalsMinusIva($ecv['cost'], $ecv['idtax'], $order[0]);
						$descriptions[] = $ecv['name'];
						$netprices[] = $efee_cost_without;
						$taxes[] = ($efee_cost - $efee_cost_without);
					}
				}
				//
				//date
				$usedate = $pinvoice_date == '0' ? date($df, $order[0]['ts']) : $today;
				//compose body
				list($invoicetpl, $pdfparams) = vikrentcar::loadInvoiceTmpl($order[0]);
				$hbody = vikrentcar::parseInvoiceTemplate($invoicetpl, $order[0], $car, array('currencyname' => $currencyname, 'company_logo' => $uselogo, 'company_info' => nl2br($pcompany_info), 'invoice_number' => $pinvoice_num, 'invoice_suffix' => $pinvoice_suff, 'invoice_date' => $usedate, 'invoice_products_descriptions' => $descriptions, 'invoice_products_netprices' => $netprices, 'invoice_products_taxes' => $taxes, 'invoice_grandtotal' => $isdue));
				//generate PDF
				$pdffname = $order[0]['id'] . '_' . $order[0]['sid'] . '.pdf';
				$pathpdf = JPATH_SITE . DS ."components". DS ."com_vikrentcar". DS . "helpers" . DS . "invoices" . DS . "generated" . DS . $pdffname;
				if(file_exists($pathpdf)) @unlink($pathpdf);
				$pdf_page_format = is_array($pdfparams['pdf_page_format']) ? $pdfparams['pdf_page_format'] : constant($pdfparams['pdf_page_format']);
				$pdf = new TCPDF(constant($pdfparams['pdf_page_orientation']), constant($pdfparams['pdf_unit']), $pdf_page_format, true, 'UTF-8', false);
				$pdf->SetTitle(JText::_('VRCINVNUM').' '.$pinvoice_num);
				//Header for each page of the pdf
				if ($pdfparams['show_header'] == 1 && count($pdfparams['header_data']) > 0) {
					$pdf->SetHeaderData($pdfparams['header_data'][0], $pdfparams['header_data'][1], $pdfparams['header_data'][2], $pdfparams['header_data'][3], $pdfparams['header_data'][4], $pdfparams['header_data'][5]);
				}
				//Change some currencies to their unicode (decimal) value
				$unichr_map = array('EUR' => 8364, 'USD' => 36, 'AUD' => 36, 'CAD' => 36, 'GBP' => 163);
				if(array_key_exists($currencyname, $unichr_map)) {
					$hbody = str_replace($currencyname, $pdf->unichr($unichr_map[$currencyname]), $hbody);
				}
				//header and footer fonts
				$pdf->setHeaderFont(array($usepdffont, '', $pdfparams['header_font_size']));
				$pdf->setFooterFont(array($usepdffont, '', $pdfparams['footer_font_size']));
				//margins
				$pdf->SetMargins(constant($pdfparams['pdf_margin_left']), constant($pdfparams['pdf_margin_top']), constant($pdfparams['pdf_margin_right']));
				$pdf->SetHeaderMargin(constant($pdfparams['pdf_margin_header']));
				$pdf->SetFooterMargin(constant($pdfparams['pdf_margin_footer']));
				//
				$pdf->SetAutoPageBreak(true, constant($pdfparams['pdf_margin_bottom']));
				$pdf->setImageScale(constant($pdfparams['pdf_image_scale_ratio']));
				$pdf->SetFont($usepdffont, '', (int)$pdfparams['body_font_size']);
				if ($pdfparams['show_header'] == 0 || !(count($pdfparams['header_data']) > 0)) {
					$pdf->SetPrintHeader(false);
				}
				if ($pdfparams['show_footer'] == 0) {
					$pdf->SetPrintFooter(false);
				}
				$pdf->AddPage();
				$pdf->writeHTML($hbody, true, false, true, false, '');
				$pdf->lastPage();
				$pdf->Output($pathpdf, 'F');
				if(file_exists($pathpdf)) {
					if($pinvoice_send == 1) {
						//send invoice via email
						$mailer = JFactory::getMailer();
						$sender = array($admail, $admail);
						$mailer->setSender($sender);
						$mailer->addRecipient($order[0]['custmail']);
						$mailer->addReplyTo($admail);
						$mailer->setSubject(JText::_('VRCINVMAILSUBJ'));
						$mailer->setBody(JText::_('VRCINVMAILCONT'));
						$mailer->addAttachment($pathpdf);
						$mailer->isHTML(true);
						$mailer->Encoding = 'base64';
						$mailer->Send();
						unset($mailer);
					}
					$totinvgen++;
					$pinvoice_num++;
				}
			}
		}
		$mainframe->enqueueMessage(JText::sprintf('VRCTOTINVGEN', $totinvgen));
		//update values used
		$q = "UPDATE `#__vikrentcar_config` SET `setting`='".($pinvoice_num - 1)."' WHERE `param`='invoiceinum';";
		$dbo->setQuery($q);
		$dbo->execute();
		$q = "UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pinvoice_suff)." WHERE `param`='invoicesuffix';";
		$dbo->setQuery($q);
		$dbo->execute();
		$q = "UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pcompany_info)." WHERE `param`='invcompanyinfo';";
		$dbo->setQuery($q);
		$dbo->execute();
		//
	}
	$mainframe->redirect("index.php?option=".$option."&task=vieworders");
}

function sortLocation ($sortid, $option) {
	$sortid = (int)$sortid;
	$pmode = VikRequest::getString('mode', '', 'request');
	$dbo = JFactory::getDBO();
	if (!empty($pmode)) {
		$q="SELECT `id`,`ordering` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`ordering` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$totr=$dbo->getNumRows();
		if ($totr > 1) {
			$data = $dbo->loadAssocList();
			if ($pmode=="up") {
				foreach($data as $v){
					if ($v['id']==$sortid) {
						$y=$v['ordering'];
					}
				}
				if ($y && $y > 1) {
					$vik=$y - 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_places` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_places` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_places` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}elseif ($pmode=="down") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y) {
					$vik=$y + 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_places` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_places` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_places` SET `ordering`='".$vik."' WHERE `id`='".$sortid."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewplaces");
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function customerCheckin ($oid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_orders` WHERE `id`='".$oid."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() == 1) {
		$order=$dbo->loadAssocList();
		//check if the language in use is the same as the one used during the checkout
		if (!empty($order[0]['lang'])) {
			$lang = JFactory::getLanguage();
			if($lang->getTag() != $order[0]['lang']) {
				$lang->load('com_vikrentcar', JPATH_ADMINISTRATOR, $order[0]['lang'], true);
			}
		}
		//
		//send mail
		$ftitle=vikrentcar::getFrontTitle();
		$nowts=$order[0]['ts'];
		$carinfo=vikrentcar::getCarInfo($order[0]['idcar']);
		$viklink=JURI::root()."index.php?option=com_vikrentcar&task=vieworder&sid=".$order[0]['sid']."&ts=".$order[0]['ts'];
		$is_cust_cost = (!empty($order[0]['cust_cost']) && $order[0]['cust_cost'] > 0);
		if(!empty($order[0]['idtar'])) {
			//vikrentcar 1.5
			if($order[0]['hourly'] == 1) {
				$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$order[0]['idtar']."';";
			}else {
				$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
			}
			//
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() == 0) {
				if($order[0]['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
					$dbo->setQuery($q);
					$dbo->execute();
					if($dbo->getNumRows() == 1) {
						$tar = $dbo->loadAssocList();
					}
				}
			}else {
				$tar = $dbo->loadAssocList();
			}
		}elseif ($is_cust_cost) {
			//Custom Rate
			$tar = array(0 => array(
				'id' => -1,
				'idcar' => $order[0]['idcar'],
				'days' => $order[0]['days'],
				'idprice' => -1,
				'cost' => $order[0]['cust_cost'],
				'attrdata' => '',
			));
		}
		//vikrentcar 1.5
		if($order[0]['hourly'] == 1 && !empty($tar[0]['hours'])) {
			foreach($tar as $kt => $vt) {
				$tar[$kt]['days'] = 1;
			}
		}
		//
		//vikrentcar 1.6
		$checkhourscharges = 0;
		$ppickup = $order[0]['ritiro'];
		$prelease = $order[0]['consegna'];
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
		if($checkhourscharges > 0 && $aehourschbasp == true && !$is_cust_cost) {
			$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, false, true, true);
			$tar = $ret['return'];
			$calcdays = $ret['days'];
		}
		if($checkhourscharges > 0 && $aehourschbasp == false && !$is_cust_cost) {
			$tar = vikrentcar::extraHoursSetPreviousFareCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true);
			$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
			$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true, true, true);
			$tar = $ret['return'];
			$calcdays = $ret['days'];
		}else {
			if(!$is_cust_cost) {
				//Seasonal prices only if not a custom rate
				$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
			}
		}
		//
		$ritplace=(!empty($order[0]['idplace']) ? vikrentcar::getPlaceName($order[0]['idplace']) : "");
		$consegnaplace=(!empty($order[0]['idreturnplace']) ? vikrentcar::getPlaceName($order[0]['idreturnplace']) : "");
		$costplusiva = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$costminusiva = $is_cust_cost ? vikrentcar::sayCustCostMinusIva($tar[0]['cost'], $order[0]['cust_idiva']) : vikrentcar::sayCostMinusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$pricestr = ($is_cust_cost ? JText::_('VRCRENTCUSTRATEPLAN') : vikrentcar::getPriceName($tar[0]['idprice'])).": ".$costplusiva.(!empty($tar[0]['attrdata']) ? "\n".vikrentcar::getPriceAttr($tar[0]['idprice']).": ".$tar[0]['attrdata'] : "");
		$isdue = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$optstr = "";
		$optarrtaxnet = array();
		if (!empty($order[0]['optionals'])) {
			$stepo=explode(";", $order[0]['optionals']);
			foreach($stepo as $oo){
				if (!empty($oo)) {
					$stept=explode(":", $oo);
					$q="SELECT `name`,`cost`,`perday`,`hmany`,`idiva`,`maxprice` FROM `#__vikrentcar_optionals` WHERE `id`=".$dbo->quote($stept[0]).";";
					$dbo->setQuery($q);
					$dbo->execute();
					if ($dbo->getNumRows() == 1) {
						$actopt=$dbo->loadAssocList();
						$realcost=(intval($actopt[0]['perday'])==1 ? ($actopt[0]['cost'] * $order[0]['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
						if (!empty($actopt[0]['maxprice']) && $actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
							$realcost = $actopt[0]['maxprice'];
							if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
								$realcost = $actopt[0]['maxprice'] * $stept[1];
							}
						}
						$tmpopr=vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva'], $order[0]);
						$isdue+=$tmpopr;
						$optnetprice = vikrentcar::sayOptionalsMinusIva($realcost, $actopt[0]['idiva'], $order[0]);
						$optarrtaxnet[] = $optnetprice;
						$optstr.=($stept[1] > 1 ? $stept[1]." " : "").$actopt[0]['name'].": ".$tmpopr."\n";
					}
				}
			}
		}
		//custom extra costs
		if(!empty($order[0]['extracosts'])) {
			$cur_extra_costs = json_decode($order[0]['extracosts'], true);
			foreach ($cur_extra_costs as $eck => $ecv) {
				$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $order[0]);
				$isdue += $efee_cost;
				$efee_cost_without = vikrentcar::sayOptionalsMinusIva($ecv['cost'], $ecv['idtax'], $order[0]);
				$optarrtaxnet[] = $efee_cost_without;
				$optstr.=$ecv['name'].": ".$efee_cost."\n";
			}
		}
		//
		$maillocfee="";
		$locfeewithouttax = 0;
		if(!empty($order[0]['idplace']) && !empty($order[0]['idreturnplace'])) {
			$locfee=vikrentcar::getLocFee($order[0]['idplace'], $order[0]['idreturnplace']);
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
					if (array_key_exists($order[0]['days'], $arrvaloverrides)) {
						$locfee['cost'] = $arrvaloverrides[$order[0]['days']];
					}
				}
				//end VikRentCar 1.7 - Location fees overrides
				$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $order[0]['days']) : $locfee['cost'];
				$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $order[0]);
				$isdue+=$locfeewith;
				$locfeewithouttax = vikrentcar::sayLocFeeMinusIva($locfeecost, $locfee['idiva'], $order[0]);
				$maillocfee=$locfeewith;
			}
		}
		//VRC 1.9 - Out of Hours Fees
		$oohfee = vikrentcar::getOutOfHoursFees($order[0]['idplace'], $order[0]['idreturnplace'], $order[0]['ritiro'], $order[0]['consegna'], array('id' => $order[0]['idcar']));
		$mailoohfee = "";
		$oohfeewithouttax = 0;
		if(count($oohfee) > 0) {
			$oohfeewith = vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
			$isdue += $oohfeewith;
			$oohfeewithouttax = vikrentcar::sayOohFeeMinusIva($oohfee['cost'], $oohfee['idiva']);
			$mailoohfee = $oohfeewith;
		}
		//
		//vikrentcar 1.6 coupon
		$usedcoupon = false;
		$origisdue = $isdue;
		if(strlen($order[0]['coupon']) > 0) {
			$usedcoupon = true;
			$expcoupon = explode(";", $order[0]['coupon']);
			$isdue = $isdue - $expcoupon[1];
		}
		//
		$arrayinfopdf = array('days' => $order[0]['days'], 'tarminusiva' => $costminusiva, 'tartax' => ($costplusiva - $costminusiva), 'opttaxnet' => $optarrtaxnet, 'locfeenet' => $locfeewithouttax, 'oohfeenet' => $oohfeewithouttax, 'order_id' => $order[0]['id'], 'tot_paid' => $order[0]['totpaid']);
		$saystatus = $order[0]['status'] == 'confirmed' ? JText::_('VRCOMPLETED') : ($order[0]['status'] == 'standby' ? JText::_('VRSTANDBY') : JText::_('VRCANCELLED'));
		vikrentcar::generateCheckinPdf($order[0]['custmail'], strip_tags($ftitle)." ".JText::_('VRRENTALORD'), $ftitle, $nowts, $order[0]['custdata'], $carinfo['name'], $order[0]['ritiro'], $order[0]['consegna'], $pricestr, $optstr, $isdue, $viklink, $saystatus, $ritplace, $consegnaplace, $maillocfee, $mailoohfee, $order[0]['id'], $order[0]['coupon'], $arrayinfopdf);
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=editorder&cid[]=".$oid);
}

function updateOohfee($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$pname = VikRequest::getString('name', '', 'request');
	$pfrom = VikRequest::getInt('from', '', 'request');
	$pto = VikRequest::getInt('to', '', 'request');
	$ppickcharge = (float)VikRequest::getString('pickcharge', '', 'request');
	$pdropcharge = (float)VikRequest::getString('dropcharge', '', 'request');
	$pmaxcharge = (float)VikRequest::getString('maxcharge', '', 'request');
	$pidcars = VikRequest::getVar('idcars', array(0));
	$pidplace = VikRequest::getVar('idplace', array(0));
	$ptype = VikRequest::getInt('type', '', 'request');
	$ptype = $ptype > 1 && $ptype <= 3 ? $ptype : 1;
	$paliq = VikRequest::getInt('aliq', '', 'request');
	$pwdays = VikRequest::getVar('wdays', array(0));
	$pwhere = VikRequest::getInt('where', '', 'request');
	if(!(empty($pfrom) && empty($pto)) && $pfrom != $pto && $pfrom < 86400 && $pto < 86400 && !empty($pwhere)) {
		$wdays_str = '';
		foreach ($pwdays as $wday) {
			if(!strlen($wday) > 0) {
				continue;
			}
			$wdays_str .= '-'.(int)$wday.'-,';
		}
		$wdays_str = rtrim($wdays_str, ',');
		$cars_str = '';
		foreach ($pidcars as $idcar) {
			if(empty($idcar)) {
				continue;
			}
			$cars_str .= "-".$idcar."-,";
		}
		$q = "UPDATE `#__vikrentcar_oohfees` SET `oohname`=".$dbo->quote($pname).",`pickcharge`=".$dbo->quote($ppickcharge).",`dropcharge`=".$dbo->quote($pdropcharge).",`maxcharge`=".$dbo->quote($pmaxcharge).",`idcars`=".$dbo->quote($cars_str).",`from`=".$pfrom.",`to`=".$pto.",`type`=".$ptype.",`idiva`=".(!empty($paliq) ? $paliq : 'NULL').",`wdays`=".$dbo->quote($wdays_str)." WHERE `id`=".$pwhere.";";
		$dbo->setQuery($q);
		$dbo->execute();
		$q="DELETE FROM `#__vikrentcar_oohfees_locxref` WHERE `idooh`=".$pwhere.";";
		$dbo->setQuery($q);
		$dbo->execute();
		foreach ($pidplace as $idplace) {
			if(empty($idplace)) {
				continue;
			}
			$q = "INSERT INTO `#__vikrentcar_oohfees_locxref` (`idooh`,`idlocation`) VALUES(".$pwhere.", ".(int)$idplace.");";
			$dbo->setQuery($q);
			$dbo->execute();
		}
		$mainframe->enqueueMessage(JText::_('VRCOOHFEESAVED'));
		$mainframe->redirect("index.php?option=".$option."&task=oohfees");
	}else {
		VikError::raiseWarning('', JText::_('VRCOOHERRTIME'));
		$mainframe->redirect("index.php?option=".$option."&task=oohfees");
	}
}

function saveOohfee($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$pname = VikRequest::getString('name', '', 'request');
	$pfrom = VikRequest::getInt('from', '', 'request');
	$pto = VikRequest::getInt('to', '', 'request');
	$ppickcharge = (float)VikRequest::getString('pickcharge', '', 'request');
	$pdropcharge = (float)VikRequest::getString('dropcharge', '', 'request');
	$pmaxcharge = (float)VikRequest::getString('maxcharge', '', 'request');
	$pidcars = VikRequest::getVar('idcars', array(0));
	$pidplace = VikRequest::getVar('idplace', array(0));
	$ptype = VikRequest::getInt('type', '', 'request');
	$ptype = $ptype > 1 && $ptype <= 3 ? $ptype : 1;
	$paliq = VikRequest::getInt('aliq', '', 'request');
	$pwdays = VikRequest::getVar('wdays', array(0));
	if(!(empty($pfrom) && empty($pto)) && $pfrom != $pto && $pfrom < 86400 && $pto < 86400) {
		$wdays_str = '';
		foreach ($pwdays as $wday) {
			if(!strlen($wday) > 0) {
				continue;
			}
			$wdays_str .= '-'.(int)$wday.'-,';
		}
		$wdays_str = rtrim($wdays_str, ',');
		$cars_str = '';
		foreach ($pidcars as $idcar) {
			if(empty($idcar)) {
				continue;
			}
			$cars_str .= "-".$idcar."-,";
		}
		$q = "INSERT INTO `#__vikrentcar_oohfees` (`oohname`,`pickcharge`,`dropcharge`,`maxcharge`,`idcars`,`from`,`to`,`type`,`idiva`,`wdays`) VALUES(".$dbo->quote($pname).", ".$dbo->quote($ppickcharge).", ".$dbo->quote($pdropcharge).", ".$dbo->quote($pmaxcharge).", ".$dbo->quote($cars_str).", ".$pfrom.", ".$pto.", ".$ptype.", ".(!empty($paliq) ? $paliq : 'NULL').", ".$dbo->quote($wdays_str).");";
		$dbo->setQuery($q);
		$dbo->execute();
		$lid = $dbo->insertid();
		if(!empty($lid)) {
			foreach ($pidplace as $idplace) {
				if(empty($idplace)) {
					continue;
				}
				$q = "INSERT INTO `#__vikrentcar_oohfees_locxref` (`idooh`,`idlocation`) VALUES(".$lid.", ".(int)$idplace.");";
				$dbo->setQuery($q);
				$dbo->execute();
			}
			$mainframe->enqueueMessage(JText::_('VRCOOHFEESAVED'));
		}
		$mainframe->redirect("index.php?option=".$option."&task=oohfees");
	}else {
		VikError::raiseWarning('', JText::_('VRCOOHERRTIME'));
		$mainframe->redirect("index.php?option=".$option."&task=newoohfee");
	}
}

function viewOohfees ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS `ooh`.*,(SELECT COUNT(*) FROM `#__vikrentcar_oohfees_locxref` AS `oohx` WHERE `oohx`.`idooh`=`ooh`.`id`) AS `tot_xref` FROM `#__vikrentcar_oohfees` AS `ooh` ORDER BY `ooh`.`oohname` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewOohfees($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewOohfees($rows, $option);
	}
}

function editOohfee ($oohid, $option) {
	$dbo = JFactory::getDBO();
	$q = "SELECT * FROM `#__vikrentcar_oohfees` WHERE `id`=".(int)$oohid.";";
	$dbo->setQuery($q);
	$dbo->execute();
	$oohfee = $dbo->loadAssocList();
	$q = "SELECT * FROM `#__vikrentcar_oohfees_locxref` WHERE `idooh`=".(int)$oohid.";";
	$dbo->setQuery($q);
	$dbo->execute();
	$oohfee_locxref = $dbo->loadAssocList();
	$nowlocations = array();
	foreach ($oohfee_locxref as $locxref) {
		$nowlocations[$locxref['idlocation']] = $locxref['idlocation'];
	}
	$wselcars = "";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$cars = $dbo->loadAssocList();
		$nowcars = array();
		if(!empty($oohfee[0]['idcars'])) {
			$oohcars = explode(',', $oohfee[0]['idcars']);
			foreach ($oohcars as $idcar) {
				$idcar = intval(str_replace("-", '', trim($idcar)));
				if(empty($idcar)) {
					continue;
				}
				$nowcars[$idcar] = $idcar;
			}
		}
		$wselcars = "<select name=\"idcars[]\" multiple=\"multiple\" size=\"5\">\n";
		foreach($cars as $c) {
			$wselcars .= "<option value=\"".$c['id']."\"".(in_array($c['id'], $nowcars) ? ' selected="selected"' : '').">".$c['name']."</option>\n";
		}
		$wselcars .= "</select>\n";
	}
	$wselplaces = "";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$locations = $dbo->loadAssocList();
		$wselplaces = "<select name=\"idplace[]\" multiple=\"multiple\" size=\"5\">\n";
		foreach($locations as $l) {
			$wselplaces .= "<option value=\"".$l['id']."\"".(in_array($l['id'], $nowlocations) ? ' selected="selected"' : '').">".$l['name']."</option>\n";
		}
		$wselplaces .= "</select>\n";
	}
	HTML_vikrentcar::pEditOohfee($oohfee[0], $wselcars, $wselplaces, $option);
}

function newOohfee ($option) {
	$dbo = JFactory::getDBO();
	$wselcars = "";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$cars = $dbo->loadAssocList();
		$wselcars = "<select name=\"idcars[]\" multiple=\"multiple\" size=\"5\">\n";
		foreach($cars as $c) {
			$wselcars .= "<option value=\"".$c['id']."\">".$c['name']."</option>\n";
		}
		$wselcars .= "</select>\n";
	}
	$wselplaces = "";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$locations = $dbo->loadAssocList();
		$wselplaces = "<select name=\"idplace[]\" multiple=\"multiple\" size=\"5\">\n";
		foreach($locations as $l) {
			$wselplaces .= "<option value=\"".$l['id']."\">".$l['name']."</option>\n";
		}
		$wselplaces .= "</select>\n";
	}
	HTML_vikrentcar::pNewOohfee($wselcars, $wselplaces, $option);
}

function removeOohfees ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_oohfees` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
			$q="DELETE FROM `#__vikrentcar_oohfees_locxref` WHERE `idooh`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=oohfees");
}

function cancelEditingOohfee($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=oohfees");
}

function renewSession($option) {
	$dbo = JFactory::getDBO();
	$q="TRUNCATE TABLE `#__session`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=config");
}

function doExport ($option) {
	$dbo = JFactory::getDBO();
	$oids = VikRequest::getVar('cid', array(0));
	$oids = count($oids) > 0 && intval($oids[key($oids)]) > 0 ? $oids : array();
	$pfrom = VikRequest::getString('from', '', 'request');
	$pto = VikRequest::getString('to', '', 'request');
	$pdatetype = VikRequest::getString('datetype', '', 'request');
	$pdatetype = $pdatetype == 'ts' ? 'ts' : 'ritiro';
	$plocation = VikRequest::getString('location', '', 'request');
	$ptype = VikRequest::getString('type', '', 'request');
	$ptype = $ptype == "csv" ? "csv" : ($ptype == "xml" ? "xml" : "ics");
	$pstatus = VikRequest::getString('status', '', 'request');
	$pdateformat = VikRequest::getString('dateformat', '', 'request');
	$pxml_file = VikRequest::getString('xml_file', '', 'request');
	$nowdf = vikrentcar::getDateFormat(true);
	$nowtf = vikrentcar::getTimeFormat(true);
	$pdateformat .= ' '.$nowtf;
	$tf = $nowtf;
	if ($nowdf=="%d/%m/%Y") {
		$df='d/m/Y';
	}elseif ($nowdf=="%m/%d/%Y") {
		$df='m/d/Y';
	}else {
		$df='Y/m/d';
	}
	$clauses = array();
	if(count($oids) > 0) {
		$clauses[] = "`o`.`id` IN(".implode(',', $oids).")";
	}
	if ($pstatus == "C") {
		$clauses[] = "`o`.`status`='confirmed'";
	}
	if (!empty($pfrom) && vikrentcar::dateIsValid($pfrom)) {
		$fromts = vikrentcar::getDateTimestamp($pfrom, '0', '0');
		$clauses[] = "`o`.`".$pdatetype."`>=".$fromts;
	}
	if (!empty($pto) && vikrentcar::dateIsValid($pto)) {
		$tots = vikrentcar::getDateTimestamp($pto, '23', '59');
		$clauses[] = "`o`.`".$pdatetype."`<=".$tots;
	}
	if (!empty($plocation)) {
		$clauses[] = "(`o`.`idplace`=".intval($plocation)." OR `o`.`idreturnplace`=".intval($plocation).")";
	}
	$download_string = '';
	$q = "SELECT `o`.*,`lp`.`name` AS `pickup_location_name`,`ld`.`name` AS `dropoff_location_name` FROM `#__vikrentcar_orders` AS `o` ".
	"LEFT JOIN `#__vikrentcar_places` `lp` ON `o`.`idplace`=`lp`.`id` ".
	"LEFT JOIN `#__vikrentcar_places` `ld` ON `o`.`idreturnplace`=`ld`.`id`".(count($clauses) > 0 ? " WHERE ".implode(' AND ', $clauses) : "")." ORDER BY `o`.`ritiro` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		if ($ptype == "csv") {
			//init csv creation
			$csvlines = array();
			$csvlines[] = array('ID', JText::_('VRCEXPCSVPICK'), JText::_('VRCEXPCSVDROP'), JText::_('VRCEXPCSVCAR'), JText::_('VRCEXPCSVPICKLOC'), JText::_('VRCEXPCSVDROPLOC'), JText::_('VRCEXPCSVCUSTINFO'), JText::_('VRCEXPCSVPAYMETH'), JText::_('VRCEXPCSVORDSTATUS'), JText::_('VRCEXPCSVTOT'), JText::_('VRCEXPCSVTOTPAID'));
			foreach ($rows as $r) {
				$pickdate = $pdateformat == 'ts' ? $r['ritiro'] : date($pdateformat, $r['ritiro']);
				$dropdate = $pdateformat == 'ts' ? $r['consegna'] : date($pdateformat, $r['consegna']);
				$car = vikrentcar::getCarInfo($r['idcar']);
				$pickloc = vikrentcar::getPlaceName($r['idplace']);
				$droploc = vikrentcar::getPlaceName($r['idreturnplace']);
				$custdata = preg_replace('/\s+/', ' ', trim($r['custdata']));
				$payment = vikrentcar::getPayment($r['idpayment']);
				$saystatus = ($r['status']=="confirmed" ? JText::_('VRCONFIRMED') : ($r['status'] == 'standby' ? JText::_('VRSTANDBY') : JText::_('VRCANCELLED')));
				$csvlines[] = array($r['id'], $pickdate, $dropdate, $car['name'], $pickloc, $droploc, $custdata, $payment['name'], $saystatus, number_format($r['order_total'], 2), number_format($r['totpaid'], 2));
			}
			//end csv creation
		}elseif ($ptype == "ics") {
			//init ics creation
			$icslines = array();
			$icscontent = "BEGIN:VCALENDAR\n";
			$icscontent .= "VERSION:2.0\n";
			$icscontent .= "PRODID:-//e4j//VikRentCar//EN\n";
			$icscontent .= "CALSCALE:GREGORIAN\n";
			$str = "";
			foreach ($rows as $r) {
				$uri = JURI::root().'index.php?option=com_vikrentcar&task=vieworder&sid='.$r['sid'].'&ts='.$r['ts'];
				$pickloc = vikrentcar::getPlaceName($r['idplace']);
				$car = vikrentcar::getCarInfo($r['idcar']);
				//$custdata = preg_replace('/\s+/', ' ', trim($r['custdata']));
				//$description = $car['name']."\\n".$r['custdata'];
				$description = $car['name']."\\n".str_replace("\n", "\\n", trim($r['custdata']));
				$str .= "BEGIN:VEVENT\n";
				//End of the Event set as Pickup Date, decomment line below to have it on Drop Off Date
				//$str .= "DTEND:".date('Ymd\THis\Z', $r['consegna'])."\n";
				$str .= "DTEND:".date('Ymd\THis\Z', $r['ritiro'])."\n";
				//
				$str .= "UID:".uniqid()."\n";
				$str .= "DTSTAMP:".date('Ymd\THis\Z', time())."\n";
				$str .= "LOCATION:".preg_replace('/([\,;])/','\\\$1', $pickloc)."\n";
				$str .= ((strlen($description) > 0 ) ? "DESCRIPTION:".preg_replace('/([\,;])/','\\\$1', $description)."\n" : "");
				$str .= "URL;VALUE=URI:".preg_replace('/([\,;])/','\\\$1', $uri)."\n";
				$str .= "SUMMARY:".JText::sprintf('VRCICSEXPSUMMARY', date($tf, $r['ritiro']))."\n";
				$str .= "DTSTART:".date('Ymd\THis\Z', $r['ritiro'])."\n";
				$str .= "END:VEVENT\n";
			}
			$icscontent .= $str;
			$icscontent .= "END:VCALENDAR\n";
			$download_string = $icscontent;
			//end ics creation
		}elseif ($ptype == "xml") {
			//init xml creation
			if(!empty($pxml_file) && file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'xml_export'.DS.$pxml_file)) {
				require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'xml_export'.DS.$pxml_file);
				foreach ($rows as $key => $row) {
					$rows[$key]['car_details'] = vikrentcar::getCarInfo($row['idcar']);
					$rows[$key]['price_info'] = '';
					$q = "SELECT `c`.`idprice`,`c`.`cost`,`c`.`attrdata`,`p`.`name`,`p`.`idiva`,`t`.`aliq` FROM `#__vikrentcar_dispcost` AS `c` LEFT JOIN `#__vikrentcar_prices` `p` ON `c`.`idprice`=`p`.`id` LEFT JOIN `#__vikrentcar_iva` `t` ON `p`.`idiva`=`t`.`id` WHERE `c`.`id`=".(intval($row['idtar'])).";";
					$dbo->setQuery($q);
					$dbo->execute();
					if ($dbo->getNumRows() > 0) {
						$price_info = $dbo->loadAssoc();
						$rows[$key]['price_info'] = $price_info;
					}
					$rows[$key]['car_details']['category_name'] = '';
					if(!empty($rows[$key]['car_details']['idcat'])) {
						$all_cats = explode(';', $rows[$key]['car_details']['idcat']);
						$rows[$key]['car_details']['category_name'] = vikrentcar::getCategoryName($all_cats[0]);
					}
				}
				$obj = new vikRentCarXmlExport($rows);
				$download_string = $obj->generateXml();
			}else {
				VikError::raiseWarning('', JText::_('VRCEXPORTERRFILE'));
				$mainframe = JFactory::getApplication();
				$mainframe->redirect("index.php?option=".$option."&task=vieworders");
			}
			//end xml creation
		}
		//download file from buffer
		$dfilename = 'export_'.date('Y-m-d_H_i').'.'.$ptype;
		if ($ptype == "csv") {
			header("Content-type: text/csv");
			header("Cache-Control: no-store, no-cache");
			header('Content-Disposition: attachment; filename="'.$dfilename.'"');
			$outstream = fopen("php://output", 'w');
			foreach($csvlines as $csvline) {
				fputcsv($outstream, $csvline);
			}
			fclose($outstream);
			exit;
		}else {
			if($ptype == "xml") {
				header("Content-Type: text/xml; ");
			}else {
				header("Content-Type: application/octet-stream; ");
			}
			header("Cache-Control: no-store, no-cache");
			header("Content-Disposition: attachment; filename=\"".$dfilename."\"");
			$f = fopen('php://output', "w");
			fwrite($f, $download_string);
			fclose($f);
			exit;
		}
	}else {
		VikError::raiseWarning('', JText::_('VRCEXPORTERRNOREC'));
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=vieworders");
	}
}

function viewExport ($option) {
	$dbo = JFactory::getDBO();
	$oids = VikRequest::getVar('cid', array(0));
	$oids = count($oids) > 0 && intval($oids[key($oids)]) > 0 ? $oids : array();
	$locations = '';
	$q = "SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$locations = $dbo->loadAssocList();
	}
	HTML_vikrentcar::pViewExport($oids, $locations, $option);
}

function sortOptional ($option) {
	$sortid = VikRequest::getVar('cid', array(0));
	$pmode = VikRequest::getString('mode', '', 'request');
	$dbo = JFactory::getDBO();
	if (!empty($pmode)) {
		$q="SELECT `id`,`ordering` FROM `#__vikrentcar_optionals` ORDER BY `#__vikrentcar_optionals`.`ordering` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$totr=$dbo->getNumRows();
		if ($totr > 1) {
			$data = $dbo->loadAssocList();
			if ($pmode=="up") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y && $y > 1) {
					$vik=$y - 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_optionals` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_optionals` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_optionals` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}elseif ($pmode=="down") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y) {
					$vik=$y + 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_optionals` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_optionals` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_optionals` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewoptionals");
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function sortCarat ($option) {
	$sortid = VikRequest::getVar('cid', array(0));
	$pmode = VikRequest::getString('mode', '', 'request');
	$dbo = JFactory::getDBO();
	if (!empty($pmode)) {
		$q="SELECT `id`,`ordering` FROM `#__vikrentcar_caratteristiche` ORDER BY `#__vikrentcar_caratteristiche`.`ordering` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$totr=$dbo->getNumRows();
		if ($totr > 1) {
			$data = $dbo->loadAssocList();
			if ($pmode=="up") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y && $y > 1) {
					$vik=$y - 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_caratteristiche` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_caratteristiche` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_caratteristiche` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}elseif ($pmode=="down") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y) {
					$vik=$y + 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_caratteristiche` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_caratteristiche` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_caratteristiche` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewcarat");
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function resendOrderEmail ($oid, $option, $checkdbsendpdf = false) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_orders` WHERE `id`='".$oid."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() == 1) {
		$order=$dbo->loadAssocList();
		//check if the language in use is the same as the one used during the checkout
		if (!empty($order[0]['lang'])) {
			$lang = JFactory::getLanguage();
			if($lang->getTag() != $order[0]['lang']) {
				$lang->load('com_vikrentcar', JPATH_ADMINISTRATOR, $order[0]['lang'], true);
			}
		}
		//
		$vrc_tn = vikrentcar::getTranslator();
		//send mail
		$ftitle=vikrentcar::getFrontTitle($vrc_tn);
		$nowts=$order[0]['ts'];
		$carinfo=vikrentcar::getCarInfo($order[0]['idcar'], $vrc_tn);
		$viklink=JURI::root()."index.php?option=com_vikrentcar&task=vieworder&sid=".$order[0]['sid']."&ts=".$order[0]['ts'];
		$is_cust_cost = (!empty($order[0]['cust_cost']) && $order[0]['cust_cost'] > 0);
		if(!empty($order[0]['idtar'])) {
			//vikrentcar 1.5
			if($order[0]['hourly'] == 1) {
				$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$order[0]['idtar']."';";
			}else {
				$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
			}
			//
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() == 0) {
				if($order[0]['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
					$dbo->setQuery($q);
					$dbo->execute();
					if($dbo->getNumRows() == 1) {
						$tar = $dbo->loadAssocList();
					}
				}
			}else {
				$tar = $dbo->loadAssocList();
			}
		}elseif ($is_cust_cost) {
			//Custom Rate
			$tar = array(0 => array(
				'id' => -1,
				'idcar' => $order[0]['idcar'],
				'days' => $order[0]['days'],
				'idprice' => -1,
				'cost' => $order[0]['cust_cost'],
				'attrdata' => '',
			));
		}
		//vikrentcar 1.5
		if($order[0]['hourly'] == 1 && !empty($tar[0]['hours'])) {
			foreach($tar as $kt => $vt) {
				$tar[$kt]['days'] = 1;
			}
		}
		//
		//vikrentcar 1.6
		$checkhourscharges = 0;
		$ppickup = $order[0]['ritiro'];
		$prelease = $order[0]['consegna'];
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
		if($checkhourscharges > 0 && $aehourschbasp == true && !$is_cust_cost) {
			$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, false, true, true);
			$tar = $ret['return'];
			$calcdays = $ret['days'];
		}
		if($checkhourscharges > 0 && $aehourschbasp == false && !$is_cust_cost) {
			$tar = vikrentcar::extraHoursSetPreviousFareCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true);
			$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
			$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true, true, true);
			$tar = $ret['return'];
			$calcdays = $ret['days'];
		}else {
			if(!$is_cust_cost) {
				//Seasonal prices only if not a custom rate
				$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
			}
		}
		//
		$ritplace=(!empty($order[0]['idplace']) ? vikrentcar::getPlaceName($order[0]['idplace'], $vrc_tn) : "");
		$consegnaplace=(!empty($order[0]['idreturnplace']) ? vikrentcar::getPlaceName($order[0]['idreturnplace'], $vrc_tn) : "");
		$costplusiva = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$costminusiva = $is_cust_cost ? vikrentcar::sayCustCostMinusIva($tar[0]['cost'], $order[0]['cust_idiva']) : vikrentcar::sayCostMinusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$pricestr = ($is_cust_cost ? JText::_('VRCRENTCUSTRATEPLAN') : vikrentcar::getPriceName($tar[0]['idprice'], $vrc_tn)).": ".$costplusiva.(!empty($tar[0]['attrdata']) ? "\n".vikrentcar::getPriceAttr($tar[0]['idprice'], $vrc_tn).": ".$tar[0]['attrdata'] : "");
		$isdue = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$optstr="";
		$optarrtaxnet = array();
		if (!empty($order[0]['optionals'])) {
			$stepo=explode(";", $order[0]['optionals']);
			foreach($stepo as $oo){
				if (!empty($oo)) {
					$stept=explode(":", $oo);
					$q="SELECT `name`,`cost`,`perday`,`hmany`,`idiva`,`maxprice` FROM `#__vikrentcar_optionals` WHERE `id`=".$dbo->quote($stept[0]).";";
					$dbo->setQuery($q);
					$dbo->execute();
					if ($dbo->getNumRows() == 1) {
						$actopt=$dbo->loadAssocList();
						$vrc_tn->translateContents($actopt, '#__vikrentcar_optionals');
						$realcost=(intval($actopt[0]['perday'])==1 ? ($actopt[0]['cost'] * $order[0]['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
						if (!empty($actopt[0]['maxprice']) && $actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
							$realcost = $actopt[0]['maxprice'];
							if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
								$realcost = $actopt[0]['maxprice'] * $stept[1];
							}
						}
						$tmpopr=vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva'], $order[0]);
						$isdue+=$tmpopr;
						$optnetprice = vikrentcar::sayOptionalsMinusIva($realcost, $actopt[0]['idiva'], $order[0]);
						$optarrtaxnet[] = $optnetprice;
						$optstr.=($stept[1] > 1 ? $stept[1]." " : "").$actopt[0]['name'].": ".$tmpopr."\n";
					}
				}
			}
		}
		//custom extra costs
		if(!empty($order[0]['extracosts'])) {
			$cur_extra_costs = json_decode($order[0]['extracosts'], true);
			foreach ($cur_extra_costs as $eck => $ecv) {
				$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $order[0]);
				$isdue += $efee_cost;
				$efee_cost_without = vikrentcar::sayOptionalsMinusIva($ecv['cost'], $ecv['idtax'], $order[0]);
				$optarrtaxnet[] = $efee_cost_without;
				$optstr.=$ecv['name'].": ".$efee_cost."\n";
			}
		}
		//
		$maillocfee="";
		$locfeewithouttax = 0;
		if(!empty($order[0]['idplace']) && !empty($order[0]['idreturnplace'])) {
			$locfee=vikrentcar::getLocFee($order[0]['idplace'], $order[0]['idreturnplace']);
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
					if (array_key_exists($order[0]['days'], $arrvaloverrides)) {
						$locfee['cost'] = $arrvaloverrides[$order[0]['days']];
					}
				}
				//end VikRentCar 1.7 - Location fees overrides
				$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $order[0]['days']) : $locfee['cost'];
				$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $order[0]);
				$isdue+=$locfeewith;
				$locfeewithouttax = vikrentcar::sayLocFeeMinusIva($locfeecost, $locfee['idiva'], $order[0]);
				$maillocfee=$locfeewith;
			}
		}
		//VRC 1.9 - Out of Hours Fees
		$oohfee = vikrentcar::getOutOfHoursFees($order[0]['idplace'], $order[0]['idreturnplace'], $order[0]['ritiro'], $order[0]['consegna'], array('id' => $order[0]['idcar']));
		$mailoohfee = "";
		$oohfeewithouttax = 0;
		if(count($oohfee) > 0) {
			$oohfeewith = vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
			$isdue += $oohfeewith;
			$oohfeewithouttax = vikrentcar::sayOohFeeMinusIva($oohfee['cost'], $oohfee['idiva']);
			$mailoohfee = $oohfeewith;
		}
		//
		//vikrentcar 1.6 coupon
		$usedcoupon = false;
		$origisdue = $isdue;
		if(strlen($order[0]['coupon']) > 0) {
			$usedcoupon = true;
			$expcoupon = explode(";", $order[0]['coupon']);
			$isdue = $isdue - $expcoupon[1];
		}
		//
		if(!empty($order[0]['custmail'])) {
			$arrayinfopdf = array('days' => $order[0]['days'], 'tarminusiva' => $costminusiva, 'tartax' => ($costplusiva - $costminusiva), 'opttaxnet' => $optarrtaxnet, 'locfeenet' => $locfeewithouttax, 'oohfeenet' => $oohfeewithouttax, 'order_id' => $order[0]['id'], 'tot_paid' => $order[0]['totpaid']);
			$sendpdf = true;
			if (!$checkdbsendpdf) {
				$psendpdf = VikRequest::getString('sendpdf', '', 'request');
				if ($psendpdf != "1") {
					$sendpdf = false;
				}
			}
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::sprintf('VRORDERMAILRESENT', $order[0]['custmail']));
			$saystatus = $order[0]['status'] == 'confirmed' ? JText::_('VRCOMPLETED') : ($order[0]['status'] == 'standby' ? JText::_('VRSTANDBY') : JText::_('VRCANCELLED'));
			vikrentcar::sendCustMailFromBack($order[0]['custmail'], strip_tags($ftitle)." ".JText::_('VRRENTALORD'), $ftitle, $nowts, $order[0]['custdata'], $carinfo['name'], $order[0]['ritiro'], $order[0]['consegna'], $pricestr, $optstr, $isdue, $viklink, $saystatus, $ritplace, $consegnaplace, $maillocfee, $mailoohfee, $order[0]['id'], $order[0]['coupon'], $arrayinfopdf, $sendpdf);
		}else {
			VikError::raiseWarning('', JText::_('VRORDERMAILRESENTNOREC'));
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=editorder&cid[]=".$oid);
}

function viewDashboard ($option) {
	//VRC 1.11 - Joomla Updates (>= 3.2.0) - Extra Fields Handler
	$jvobj = new JVersion;
	$jv = $jvobj->getShortVersion();
	if (version_compare($jv, '3.2.0', '>=')) {
		//With this method we populate the extra fields for this extension. We need to store the domain name encoded in base64 for the download of commercial updates.
		//Without the record stored this way, our Update Servers will reject the download request.
		require_once(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'urihandler.php');
		$update = new UriUpdateHandler('com_vikrentcar');
		$domain = JFactory::getApplication()->input->server->getString('HTTP_HOST');
		$update->addExtraField('domain', base64_encode($domain));
		$ord_num = JFactory::getApplication()->input->getString('order_number');
		if (!empty($ord_num)) {
			$update->addExtraField('order_number', $ord_num);
		}
		$update->checkSchema(E4J_SOFTWARE_VERSION);
		$update->register();
		//
	}
	//
	$pidplace = VikRequest::getInt('idplace', '', 'request');
	$dbo = JFactory::getDBO();
	$list_limit = (int)JFactory::getApplication()->get('list_limit');
	$list_limit = $list_limit < 10 ? 10 : $list_limit;
	$q="SELECT COUNT(*) FROM `#__vikrentcar_prices`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$totprices = $dbo->loadResult();
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	$totlocations = $dbo->getNumRows();
	if($totlocations > 0) {
		$allplaces = $dbo->loadAssocList();
	}else {
		$allplaces = "";
	}
	$q="SELECT COUNT(*) FROM `#__vikrentcar_categories`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$totcategories = $dbo->loadResult();
	$q="SELECT COUNT(*) FROM `#__vikrentcar_cars`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$totcars = $dbo->loadResult();
	$q="SELECT COUNT(*) FROM `#__vikrentcar_dispcost`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$totdailyfares = $dbo->loadResult();
	$arrayfirst = array('totprices' => $totprices, 'totlocations' => $totlocations, 'totcategories' => $totcategories, 'totcars' => $totcars, 'totdailyfares' => $totdailyfares);
	$nextrentals = "";
	$totnextrentconf = 0;
	$totnextrentpend = 0;
	$today_start_ts = mktime(0, 0, 0, date("n"), date("j"), date("Y"));
	$today_end_ts = mktime(23, 59, 59, date("n"), date("j"), date("Y"));
	$pickup_today = array();
	$dropoff_today = array();
	$cars_locked = array();
	if($totprices > 0 && $totcars > 0) {
		$q="SELECT `id`,`custdata`,`status`,`idcar`,`ritiro`,`consegna`,`idplace`,`idreturnplace`,`country`,`nominative` FROM `#__vikrentcar_orders` WHERE `ritiro`>".$today_end_ts." ".($pidplace > 0 ? "AND `idplace`='".$pidplace."' " : "")."ORDER BY `#__vikrentcar_orders`.`ritiro` ASC LIMIT ".$list_limit.";";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() > 0) {
			$nextrentals = $dbo->loadAssocList();
		}
		$q="SELECT `id`,`custdata`,`status`,`idcar`,`ritiro`,`consegna`,`idplace`,`idreturnplace`,`country`,`nominative` FROM `#__vikrentcar_orders` WHERE `ritiro`>=".$today_start_ts." AND `ritiro`<=".$today_end_ts." ORDER BY `#__vikrentcar_orders`.`ritiro` ASC LIMIT ".$list_limit.";";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() > 0) {
			$pickup_today = $dbo->loadAssocList();
		}
		$q="SELECT `id`,`custdata`,`status`,`idcar`,`ritiro`,`consegna`,`idplace`,`idreturnplace`,`country`,`nominative` FROM `#__vikrentcar_orders` WHERE `consegna`>=".$today_start_ts." AND `consegna`<=".$today_end_ts." ORDER BY `#__vikrentcar_orders`.`consegna` ASC LIMIT ".$list_limit.";";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() > 0) {
			$dropoff_today = $dbo->loadAssocList();
		}
		$q = "DELETE FROM `#__vikrentcar_tmplock` WHERE `until`<" . time() . ";";
		$dbo->setQuery($q);
		$dbo->execute();
		$q = "SELECT `lock`.*,`c`.`name` AS `car_name`,`o`.`custdata`,`o`.`idcar`,`o`.`country`,`o`.`nominative` FROM `#__vikrentcar_tmplock` AS `lock` LEFT JOIN `#__vikrentcar_orders` `o` ON `lock`.`idorder`=`o`.`id` LEFT JOIN `#__vikrentcar_cars` `c` ON `lock`.`idcar`=`c`.`id` WHERE `lock`.`until`>".time()." ORDER BY `lock`.`id` DESC;";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() > 0) {
			$cars_locked = $dbo->loadAssocList();
		}
		$q="SELECT COUNT(*) FROM `#__vikrentcar_orders` WHERE `ritiro`>".time()." AND `status`='confirmed';";
		$dbo->setQuery($q);
		$dbo->execute();
		$totnextrentconf = $dbo->loadResult();
		$q="SELECT COUNT(*) FROM `#__vikrentcar_orders` WHERE `ritiro`>".time()." AND `status`='standby';";
		$dbo->setQuery($q);
		$dbo->execute();
		$totnextrentpend = $dbo->loadResult();
	}
	HTML_vikrentcar::pViewDashboard($pidplace, $arrayfirst, $allplaces, $nextrentals, $pickup_today, $dropoff_today, $cars_locked, $totnextrentconf, $totnextrentpend, $option);
}

function updateCoupon ($option) {
	$pcode = VikRequest::getString('code', '', 'request');
	$pvalue = VikRequest::getString('value', '', 'request');
	$pfrom = VikRequest::getString('from', '', 'request');
	$pto = VikRequest::getString('to', '', 'request');
	$pidcars = VikRequest::getVar('idcars', array(0));
	$pwhere = VikRequest::getString('where', '', 'request');
	$ptype = VikRequest::getString('type', '', 'request');
	$ptype = $ptype == "1" ? 1 : 2;
	$ppercentot = VikRequest::getString('percentot', '', 'request');
	$ppercentot = $ppercentot == "1" ? 1 : 2;
	$pallvehicles = VikRequest::getString('allvehicles', '', 'request');
	$pallvehicles = $pallvehicles == "1" ? 1 : 0;
	$pmintotord = VikRequest::getString('mintotord', '', 'request');
	$stridcars="";
	if(@count($pidcars) > 0 && $pallvehicles != 1) {
		foreach($pidcars as $ch) {
			if(!empty($ch)) {
				$stridcars.=";".$ch.";";
			}
		}
	}
	$strdatevalid = "";
	if(strlen($pfrom) > 0 && strlen($pto) > 0) {
		$first=vikrentcar::getDateTimestamp($pfrom, 0, 0);
		$second=vikrentcar::getDateTimestamp($pto, 0, 0);
		if($first < $second) {
			$strdatevalid .= $first."-".$second;
		}
	}
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_coupons` WHERE `code`=".$dbo->quote($pcode)." AND `id`!='".$pwhere."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		VikError::raiseWarning('', JText::_('VRCCOUPONEXISTS'));
	}else {
		$app = JFactory::getApplication();
		$app->enqueueMessage(JText::_('VRCCOUPONSAVEOK'));
		$q="UPDATE `#__vikrentcar_coupons` SET `code`=".$dbo->quote($pcode).",`type`='".$ptype."',`percentot`='".$ppercentot."',`value`=".$dbo->quote($pvalue).",`datevalid`='".$strdatevalid."',`allvehicles`='".$pallvehicles."',`idcars`='".$stridcars."',`mintotord`=".$dbo->quote($pmintotord)." WHERE `id`='".$pwhere."';";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcoupons");
}

function saveCoupon ($option) {
	$pcode = VikRequest::getString('code', '', 'request');
	$pvalue = VikRequest::getString('value', '', 'request');
	$pfrom = VikRequest::getString('from', '', 'request');
	$pto = VikRequest::getString('to', '', 'request');
	$pidcars = VikRequest::getVar('idcars', array(0));
	$ptype = VikRequest::getString('type', '', 'request');
	$ptype = $ptype == "1" ? 1 : 2;
	$ppercentot = VikRequest::getString('percentot', '', 'request');
	$ppercentot = $ppercentot == "1" ? 1 : 2;
	$pallvehicles = VikRequest::getString('allvehicles', '', 'request');
	$pallvehicles = $pallvehicles == "1" ? 1 : 0;
	$pmintotord = VikRequest::getString('mintotord', '', 'request');
	$stridcars="";
	if(@count($pidcars) > 0 && $pallvehicles != 1) {
		foreach($pidcars as $ch) {
			if(!empty($ch)) {
				$stridcars.=";".$ch.";";
			}
		}
	}
	$strdatevalid = "";
	if(strlen($pfrom) > 0 && strlen($pto) > 0) {
		$first=vikrentcar::getDateTimestamp($pfrom, 0, 0);
		$second=vikrentcar::getDateTimestamp($pto, 0, 0);
		if($first < $second) {
			$strdatevalid .= $first."-".$second;
		}
	}
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_coupons` WHERE `code`=".$dbo->quote($pcode).";";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		VikError::raiseWarning('', JText::_('VRCCOUPONEXISTS'));
	}else {
		$app = JFactory::getApplication();
		$app->enqueueMessage(JText::_('VRCCOUPONSAVEOK'));
		$q="INSERT INTO `#__vikrentcar_coupons` (`code`,`type`,`percentot`,`value`,`datevalid`,`allvehicles`,`idcars`,`mintotord`) VALUES(".$dbo->quote($pcode).",'".$ptype."','".$ppercentot."',".$dbo->quote($pvalue).",'".$strdatevalid."','".$pallvehicles."','".$stridcars."', ".$dbo->quote($pmintotord).");";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcoupons");
}

function editCoupon ($coupid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_coupons` WHERE `id`='".$coupid."';";
	$dbo->setQuery($q);
	$dbo->execute();
	$coupon = $dbo->loadAssocList();
	$coupon = $coupon[0];
	$wselcars = "";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$cars = $dbo->loadAssocList();
		$filtercarr = array();
		if(strlen($coupon['idcars']) > 0) {
			$cparts = explode(";", $coupon['idcars']);
			foreach($cparts as $fc) {
				if(!empty($fc)) {
					$filtercarr[]=$fc;
				}
			}
		}
		$wselcars = "<select name=\"idcars[]\" multiple=\"multiple\" size=\"5\">\n";
		foreach($cars as $c) {
			$wselcars .= "<option value=\"".$c['id']."\"".(in_array($c['id'], $filtercarr) ? " selected=\"selected\"" : "").">".$c['name']."</option>\n";
		}
		$wselcars .= "</select>\n";
	}
	HTML_vikrentcar::pEditCoupon($coupon, $wselcars, $option);
}

function newCoupon ($option) {
	$dbo = JFactory::getDBO();
	$wselcars = "";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$cars = $dbo->loadAssocList();
		$wselcars = "<select name=\"idcars[]\" multiple=\"multiple\" size=\"5\">\n";
		foreach($cars as $c) {
			$wselcars .= "<option value=\"".$c['id']."\">".$c['name']."</option>\n";
		}
		$wselcars .= "</select>\n";
	}
	HTML_vikrentcar::pNewCoupon($wselcars, $option);
}

function viewCoupons ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_coupons` ORDER BY `#__vikrentcar_coupons`.`code` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewCoupons($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewCoupons($rows, $option);
	}
}

function removeMoreImgs($option) {
	$pcarid = VikRequest::getInt('carid', '', 'request');
	$pimgind = VikRequest::getInt('imgind', '', 'request');
	if(!empty($pcarid) && strlen($pimgind) > 0) {
		$dbo = JFactory::getDBO();
		$q="SELECT `moreimgs` FROM `#__vikrentcar_cars` WHERE `id`='".$pcarid."';";
		$dbo->setQuery($q);
		$dbo->execute();
		$actmore=$dbo->loadResult();
		if(strlen($actmore) > 0) {
			$actsplit=explode(';;', $actmore);
			if(array_key_exists($pimgind, $actsplit)) {
				@unlink(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'big_'.$actsplit[$pimgind]);
				@unlink(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'thumb_'.$actsplit[$pimgind]);
				unset($actsplit[$pimgind]);
				$newstr="";
				foreach($actsplit as $oi) {
					if(!empty($oi)) {
						$newstr.=$oi.';;';
					}
				}
				$q="UPDATE `#__vikrentcar_cars` SET `moreimgs`=".$dbo->quote($newstr)." WHERE `id`='".$pcarid."';";
				$dbo->setQuery($q);
				$dbo->execute();
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=editcar&cid[]=".$pcarid);
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function updateCustomf ($option) {
	$pname = VikRequest::getString('name', '', 'request', VIKREQUEST_ALLOWHTML);
	$ptype = VikRequest::getString('type', '', 'request');
	$pchoose = VikRequest::getVar('choose', array(0));
	$prequired = VikRequest::getString('required', '', 'request');
	$prequired = $prequired == "1" ? 1 : 0;
	$pisemail = VikRequest::getString('isemail', '', 'request');
	$pisemail = $pisemail == "1" ? 1 : 0;
	$pisnominative = VikRequest::getString('isnominative', '', 'request');
	$pisnominative = $pisnominative == "1" && $ptype == 'text' ? 1 : 0;
	$pisphone = VikRequest::getString('isphone', '', 'request');
	$pisphone = $pisphone == "1" && $ptype == 'text' ? 1 : 0;
	$ppoplink = VikRequest::getString('poplink', '', 'request');
	$pwhere = VikRequest::getInt('where', '', 'request');
	$choosestr="";
	if(@count($pchoose) > 0) {
		foreach($pchoose as $ch) {
			if(!empty($ch)) {
				$choosestr.=$ch.";;__;;";
			}
		}
	}
	$dbo = JFactory::getDBO();
	$q="UPDATE `#__vikrentcar_custfields` SET `name`=".$dbo->quote($pname).",`type`=".$dbo->quote($ptype).",`choose`=".$dbo->quote($choosestr).",`required`=".$dbo->quote($prequired).",`isemail`=".$dbo->quote($pisemail).",`poplink`=".$dbo->quote($ppoplink).",`isnominative`=".$pisnominative.",`isphone`=".$pisphone." WHERE `id`=".$dbo->quote($pwhere).";";
	$dbo->setQuery($q);
	$dbo->execute();
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcustomf");
}

function editCustomf ($fid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_custfields` WHERE `id`=".$dbo->quote($fid).";";
	$dbo->setQuery($q);
	$dbo->execute();
	$field=$dbo->loadAssocList();
	HTML_vikrentcar::pEditCustomf($field[0], $option);
}

function saveCustomf ($option) {
	$pname = VikRequest::getString('name', '', 'request', VIKREQUEST_ALLOWHTML);
	$ptype = VikRequest::getString('type', '', 'request');
	$pchoose = VikRequest::getVar('choose', array(0));
	$prequired = VikRequest::getString('required', '', 'request');
	$prequired = $prequired == "1" ? 1 : 0;
	$pisemail = VikRequest::getString('isemail', '', 'request');
	$pisemail = $pisemail == "1" ? 1 : 0;
	$pisnominative = VikRequest::getString('isnominative', '', 'request');
	$pisnominative = $pisnominative == "1" && $ptype == 'text' ? 1 : 0;
	$pisphone = VikRequest::getString('isphone', '', 'request');
	$pisphone = $pisphone == "1" && $ptype == 'text' ? 1 : 0;
	$ppoplink = VikRequest::getString('poplink', '', 'request');
	$choosestr="";
	if(@count($pchoose) > 0) {
		foreach($pchoose as $ch) {
			if(!empty($ch)) {
				$choosestr.=$ch.";;__;;";
			}
		}
	}
	$dbo = JFactory::getDBO();
	$q="SELECT `ordering` FROM `#__vikrentcar_custfields` ORDER BY `#__vikrentcar_custfields`.`ordering` DESC LIMIT 1;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() == 1) {
		$getlast=$dbo->loadResult();
		$newsortnum=$getlast + 1;
	}else {
		$newsortnum=1;
	}
	$q="INSERT INTO `#__vikrentcar_custfields` (`name`,`type`,`choose`,`required`,`ordering`,`isemail`,`poplink`,`isnominative`,`isphone`) VALUES(".$dbo->quote($pname).", ".$dbo->quote($ptype).", ".$dbo->quote($choosestr).", ".$dbo->quote($prequired).", ".$dbo->quote($newsortnum).", ".$dbo->quote($pisemail).", ".$dbo->quote($ppoplink).", ".$pisnominative.", ".$pisphone.");";
	$dbo->setQuery($q);
	$dbo->execute();
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcustomf");
}

function newCustomf ($option) {
	HTML_vikrentcar::pNewCustomf($option);
}

function removeCustomf ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_custfields` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcustomf");
}

function removeCoupons ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_coupons` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcoupons");
}

function sortField ($option) {
	$sortid = VikRequest::getVar('cid', array(0));
	$pmode = VikRequest::getString('mode', '', 'request');
	$dbo = JFactory::getDBO();
	if (!empty($pmode)) {
		$q="SELECT `id`,`ordering` FROM `#__vikrentcar_custfields` ORDER BY `#__vikrentcar_custfields`.`ordering` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$totr=$dbo->getNumRows();
		if ($totr > 1) {
			$data = $dbo->loadAssocList();
			if ($pmode=="up") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y && $y > 1) {
					$vik=$y - 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_custfields` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_custfields` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_custfields` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}elseif ($pmode=="down") {
				foreach($data as $v){
					if ($v['id']==$sortid[0]) {
						$y=$v['ordering'];
					}
				}
				if ($y) {
					$vik=$y + 1;
					$found=false;
					foreach($data as $v){
						if (intval($v['ordering'])==intval($vik)) {
							$found=true;
							$q="UPDATE `#__vikrentcar_custfields` SET `ordering`='".$y."' WHERE `id`='".$v['id']."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							$q="UPDATE `#__vikrentcar_custfields` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->execute();
							break;
						}
					}
					if(!$found) {
						$q="UPDATE `#__vikrentcar_custfields` SET `ordering`='".$vik."' WHERE `id`='".$sortid[0]."' LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->execute();
					}
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewcustomf");
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function viewCustomf ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_custfields` ORDER BY `#__vikrentcar_custfields`.`ordering` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewCustomf($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewCustomf($rows, $option);
	}
}

function showOverview ($option) {
	$dbo = JFactory::getDBO();
	$pmonth = VikRequest::getString('month', '', 'request');
	if(!empty($pmonth)) {
		$tsstart=$pmonth;
	}else {
		$oggid=getdate();
		$tsstart=mktime(0, 0, 0, $oggid['mon'], 1, $oggid['year']);
	}
	$oggid=getdate($tsstart);
	if($oggid['mon']==12) {
		$nextmon=1;
		$year=$oggid['year'] + 1;
	}else {
		$nextmon=$oggid['mon'] + 1;
		$year=$oggid['year'];
	}
	$tsend=mktime(0, 0, 0, $nextmon, 1, $year);
	$today=getdate();
	$firstmonth=mktime(0, 0, 0, $today['mon'], 1, $today['year']);
	//oldest and furthest pickups
	$oldest_ritiro = 0;
	$furthest_consegna = 0;
	$q="SELECT `ritiro` FROM `#__vikrentcar_busy` ORDER BY `ritiro` ASC LIMIT 1;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$oldest_ritiro = $dbo->loadResult();
	}
	$q="SELECT `consegna` FROM `#__vikrentcar_busy` ORDER BY `consegna` DESC LIMIT 1;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$furthest_consegna = $dbo->loadResult();
	}
	//
	$wmonthsel="<select name=\"month\" onchange=\"document.vroverview.submit();\">\n";
	if (!empty($oldest_ritiro)) {
		$oldest_date = getdate($oldest_ritiro);
		$oldest_month = mktime(0, 0, 0, $oldest_date['mon'], 1, $oldest_date['year']);
		if ($oldest_month < $firstmonth) {
			while ($oldest_month < $firstmonth) {
				$wmonthsel.="<option value=\"".$oldest_month."\"".($oldest_month==$tsstart ? " selected=\"selected\"" : "").">".vikrentcar::sayMonth($oldest_date['mon'])." ".$oldest_date['year']."</option>\n";
				if($oldest_date['mon'] == 12) {
					$nextmon = 1;
					$year = $oldest_date['year'] + 1;
				}else {
					$nextmon = $oldest_date['mon'] + 1;
					$year = $oldest_date['year'];
				}
				$oldest_month = mktime(0, 0, 0, $nextmon, 1, $year);
				$oldest_date = getdate($oldest_month);
			}
		}
	}
	$wmonthsel.="<option value=\"".$firstmonth."\"".($firstmonth==$tsstart ? " selected=\"selected\"" : "").">".vikrentcar::sayMonth($today['mon'])." ".$today['year']."</option>\n";
	$futuremonths = 12;
	if (!empty($furthest_consegna)) {
		$furthest_date = getdate($furthest_consegna);
		$furthest_month = mktime(0, 0, 0, $furthest_date['mon'], 1, $furthest_date['year']);
		if ($furthest_month > $firstmonth) {
			$monthsdiff = ceil(($furthest_month - $firstmonth) / (86400 * 30));
			$futuremonths = $monthsdiff > $futuremonths ? $monthsdiff : $futuremonths;
		}
	}
	for($i = 1; $i < $futuremonths; $i++) {
		$newts = getdate($firstmonth);
		if($newts['mon'] == 12) {
			$nextmon = 1;
			$year = $newts['year'] + 1;
		}else {
			$nextmon = $newts['mon'] + 1;
			$year = $newts['year'];
		}
		$firstmonth = mktime(0, 0, 0, $nextmon, 1, $year);
		$newts = getdate($firstmonth);
		$wmonthsel .= "<option value=\"".$firstmonth."\"".($firstmonth==$tsstart ? " selected=\"selected\"" : "").">".vikrentcar::sayMonth($newts['mon'])." ".$newts['year']."</option>\n";
	}
	$wmonthsel.="</select>\n";
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		$arrbusy=array();
		$actnow=time();
		$all_locations = '';
		$q = "SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$all_locations = $dbo->loadAssocList();
		}
		$session = JFactory::getSession();
		$plocation = VikRequest::getInt('location', '', 'request');
		$plocationw = VikRequest::getString('locationw', '', 'request');
		$plocationw = empty($plocationw) || !in_array($plocationw, array('pickup', 'dropoff', 'both')) ? 'pickup' : $plocationw;
		if($plocation > 0) {
			$session->set('vrcViewOverviewLocation', $plocation);
		}else {
			if(isset($_REQUEST['location'])) {
				$session->set('vrcViewOverviewLocation', 0);
			}else {
				$plocation = $session->get('vrcViewOverviewLocation', 0);
			}
		}
		$where_clause = '';
		if($plocation > 0) {
			$where_clause = ' AND ';
			if($plocationw == 'both') {
				$where_clause .= '(`o`.`idplace`='.$plocation.' OR `o`.`idplace` IS NULL OR `o`.`idreturnplace`='.$plocation.' OR `o`.`idreturnplace` IS NULL)';
			}elseif($plocationw == 'dropoff') {
				$where_clause .= '(`o`.`idreturnplace`='.$plocation.' OR `o`.`idreturnplace` IS NULL)';
			}else {
				$where_clause .= '(`o`.`idplace`='.$plocation.' OR `o`.`idplace` IS NULL)';
			}
		}
		foreach($rows as $r) {
			$q="SELECT `b`.*,`o`.`id` AS `idorder`,`o`.`idplace`,`o`.`idreturnplace` FROM `#__vikrentcar_busy` AS `b` LEFT JOIN `#__vikrentcar_orders` `o` ON `b`.`id`=`o`.`idbusy` WHERE `b`.`idcar`='".$r['id']."'".$where_clause." AND (`b`.`ritiro`>=".$tsstart." OR `b`.`consegna`>=".$tsstart.") AND (`b`.`ritiro`<=".$tsend." OR `b`.`consegna`<=".$tsstart.");";
			$dbo->setQuery($q);
			$dbo->execute();
			$cbusy=$dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "";
			$arrbusy[$r['id']]=$cbusy;
		}
		HTML_vikrentcar::pShowOverview($rows, $arrbusy, $wmonthsel, $tsstart, $option, $lim0, $navbut, $all_locations, $plocation, $plocationw);
	}else {
		VikError::raiseWarning('', JText::_('VROVERVIEWNOCARS'));
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option);
	}
}

function setOrderConfirmed ($oid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_orders` WHERE `id`='".$oid."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() == 1) {
		$order=$dbo->loadAssocList();
		//check if the language in use is the same as the one used during the checkout
		if (!empty($order[0]['lang'])) {
			$lang = JFactory::getLanguage();
			if($lang->getTag() != $order[0]['lang']) {
				$lang->load('com_vikrentcar', JPATH_ADMINISTRATOR, $order[0]['lang'], true);
			}
		}
		//
		$vrc_tn = vikrentcar::getTranslator();
		$q="SELECT `units` FROM `#__vikrentcar_cars` WHERE `id`='".$order[0]['idcar']."';";
		$dbo->setQuery($q);
		$dbo->execute();
		$units=$dbo->loadResult();
		$realback=vikrentcar::getHoursCarAvail() * 3600;
		$realback+=$order[0]['consegna'];
		if (vikrentcar::carBookable($order[0]['idcar'], $units, $order[0]['ritiro'], $order[0]['consegna'])) {
			$q="INSERT INTO `#__vikrentcar_busy` (`idcar`,`ritiro`,`consegna`,`realback`) VALUES('".$order[0]['idcar']."','".$order[0]['ritiro']."','".$order[0]['consegna']."','".$realback."');";
			$dbo->setQuery($q);
			$dbo->execute();
			$busynow = $dbo->insertid();
		}else {
			$busynow="";
			VikError::raiseWarning('', JText::_('ERRCONFORDERCARNA'));
		}
		$q="UPDATE `#__vikrentcar_orders` SET `status`='confirmed', `idbusy`='".$busynow."' WHERE `id`='".$order[0]['id']."';";
		$dbo->setQuery($q);
		$dbo->execute();
		//send mail
		$ftitle=vikrentcar::getFrontTitle($vrc_tn);
		$nowts=$order[0]['ts'];
		$carinfo=vikrentcar::getCarInfo($order[0]['idcar'], $vrc_tn);
		$viklink=JURI::root()."index.php?option=com_vikrentcar&task=vieworder&sid=".$order[0]['sid']."&ts=".$order[0]['ts'];
		$is_cust_cost = (!empty($order[0]['cust_cost']) && $order[0]['cust_cost'] > 0);
		if(!empty($order[0]['idtar'])) {
			//vikrentcar 1.5
			if($order[0]['hourly'] == 1) {
				$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `id`='".$order[0]['idtar']."';";
			}else {
				$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
			}
			//
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() == 0) {
				if($order[0]['hourly'] == 1) {
					$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `id`='".$order[0]['idtar']."';";
					$dbo->setQuery($q);
					$dbo->execute();
					if($dbo->getNumRows() == 1) {
						$tar = $dbo->loadAssocList();
					}
				}
			}else {
				$tar = $dbo->loadAssocList();
			}
		}elseif ($is_cust_cost) {
			//Custom Rate
			$tar = array(0 => array(
				'id' => -1,
				'idcar' => $order[0]['idcar'],
				'days' => $order[0]['days'],
				'idprice' => -1,
				'cost' => $order[0]['cust_cost'],
				'attrdata' => '',
			));
		}
		//vikrentcar 1.5
		if($order[0]['hourly'] == 1 && !empty($tar[0]['hours'])) {
			foreach($tar as $kt => $vt) {
				$tar[$kt]['days'] = 1;
			}
		}
		//
		//vikrentcar 1.6
		$checkhourscharges = 0;
		$ppickup = $order[0]['ritiro'];
		$prelease = $order[0]['consegna'];
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
		if($checkhourscharges > 0 && $aehourschbasp == true && !$is_cust_cost) {
			$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, false, true, true);
			$tar = $ret['return'];
			$calcdays = $ret['days'];
		}
		if($checkhourscharges > 0 && $aehourschbasp == false && !$is_cust_cost) {
			$tar = vikrentcar::extraHoursSetPreviousFareCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true);
			$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
			$ret = vikrentcar::applyExtraHoursChargesCar($tar, $order[0]['idcar'], $checkhourscharges, $daysdiff, true, true, true);
			$tar = $ret['return'];
			$calcdays = $ret['days'];
		}else {
			if(!$is_cust_cost) {
				//Seasonal prices only if not a custom rate
				$tar = vikrentcar::applySeasonsCar($tar, $order[0]['ritiro'], $order[0]['consegna'], $order[0]['idplace']);
			}
		}
		//
		$ritplace=(!empty($order[0]['idplace']) ? vikrentcar::getPlaceName($order[0]['idplace'], $vrc_tn) : "");
		$consegnaplace=(!empty($order[0]['idreturnplace']) ? vikrentcar::getPlaceName($order[0]['idreturnplace'], $vrc_tn) : "");
		$costplusiva = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$costminusiva = $is_cust_cost ? vikrentcar::sayCustCostMinusIva($tar[0]['cost'], $order[0]['cust_idiva']) : vikrentcar::sayCostMinusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$pricestr = ($is_cust_cost ? JText::_('VRCRENTCUSTRATEPLAN') : vikrentcar::getPriceName($tar[0]['idprice'], $vrc_tn)).": ".$costplusiva.(!empty($tar[0]['attrdata']) ? "\n".vikrentcar::getPriceAttr($tar[0]['idprice'], $vrc_tn).": ".$tar[0]['attrdata'] : "");
		$isdue = $is_cust_cost ? $tar[0]['cost'] : vikrentcar::sayCostPlusIva($tar[0]['cost'], $tar[0]['idprice'], $order[0]);
		$optstr="";
		$optarrtaxnet = array();
		if (!empty($order[0]['optionals'])) {
			$stepo=explode(";", $order[0]['optionals']);
			foreach($stepo as $oo){
				if (!empty($oo)) {
					$stept=explode(":", $oo);
					$q="SELECT `name`,`cost`,`perday`,`hmany`,`idiva`,`maxprice` FROM `#__vikrentcar_optionals` WHERE `id`=".$dbo->quote($stept[0]).";";
					$dbo->setQuery($q);
					$dbo->execute();
					if ($dbo->getNumRows() == 1) {
						$actopt=$dbo->loadAssocList();
						$vrc_tn->translateContents($actopt, '#__vikrentcar_optionals');
						$realcost=(intval($actopt[0]['perday'])==1 ? ($actopt[0]['cost'] * $order[0]['days'] * $stept[1]) : ($actopt[0]['cost'] * $stept[1]));
						if (!empty($actopt[0]['maxprice']) && $actopt[0]['maxprice'] > 0 && $realcost > $actopt[0]['maxprice']) {
							$realcost = $actopt[0]['maxprice'];
							if(intval($actopt[0]['hmany']) == 1 && intval($stept[1]) > 1) {
								$realcost = $actopt[0]['maxprice'] * $stept[1];
							}
						}
						$tmpopr=vikrentcar::sayOptionalsPlusIva($realcost, $actopt[0]['idiva'], $order[0]);
						$isdue+=$tmpopr;
						$optnetprice = vikrentcar::sayOptionalsMinusIva($realcost, $actopt[0]['idiva'], $order[0]);
						$optarrtaxnet[] = $optnetprice;
						$optstr.=($stept[1] > 1 ? $stept[1]." " : "").$actopt[0]['name'].": ".$tmpopr."\n";
					}
				}
			}
		}
		//custom extra costs
		if(!empty($order[0]['extracosts'])) {
			$cur_extra_costs = json_decode($order[0]['extracosts'], true);
			foreach ($cur_extra_costs as $eck => $ecv) {
				$efee_cost = vikrentcar::sayOptionalsPlusIva($ecv['cost'], $ecv['idtax'], $order[0]);
				$isdue += $efee_cost;
				$efee_cost_without = vikrentcar::sayOptionalsMinusIva($ecv['cost'], $ecv['idtax'], $order[0]);
				$optarrtaxnet[] = $efee_cost_without;
				$optstr.=$ecv['name'].": ".$efee_cost."\n";
			}
		}
		//
		$maillocfee="";
		$locfeewithouttax = 0;
		if(!empty($order[0]['idplace']) && !empty($order[0]['idreturnplace'])) {
			$locfee=vikrentcar::getLocFee($order[0]['idplace'], $order[0]['idreturnplace']);
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
					if (array_key_exists($order[0]['days'], $arrvaloverrides)) {
						$locfee['cost'] = $arrvaloverrides[$order[0]['days']];
					}
				}
				//end VikRentCar 1.7 - Location fees overrides
				$locfeecost=intval($locfee['daily']) == 1 ? ($locfee['cost'] * $order[0]['days']) : $locfee['cost'];
				$locfeewith=vikrentcar::sayLocFeePlusIva($locfeecost, $locfee['idiva'], $order[0]);
				$isdue+=$locfeewith;
				$locfeewithouttax = vikrentcar::sayLocFeeMinusIva($locfeecost, $locfee['idiva'], $order[0]);
				$maillocfee=$locfeewith;
			}
		}
		//VRC 1.9 - Out of Hours Fees
		$oohfee = vikrentcar::getOutOfHoursFees($order[0]['idplace'], $order[0]['idreturnplace'], $order[0]['ritiro'], $order[0]['consegna'], array('id' => $order[0]['idcar']));
		$mailoohfee = "";
		$oohfeewithouttax = 0;
		if(count($oohfee) > 0) {
			$oohfeewith = vikrentcar::sayOohFeePlusIva($oohfee['cost'], $oohfee['idiva']);
			$isdue += $oohfeewith;
			$oohfeewithouttax = vikrentcar::sayOohFeeMinusIva($oohfee['cost'], $oohfee['idiva']);
			$mailoohfee = $oohfeewith;
		}
		//
		//vikrentcar 1.6 coupon
		$usedcoupon = false;
		$origisdue = $isdue;
		if(strlen($order[0]['coupon']) > 0) {
			$usedcoupon = true;
			$expcoupon = explode(";", $order[0]['coupon']);
			$isdue = $isdue - $expcoupon[1];
		}
		//
		if(!empty($busynow)) {
			$arrayinfopdf = array('days' => $order[0]['days'], 'tarminusiva' => $costminusiva, 'tartax' => ($costplusiva - $costminusiva), 'opttaxnet' => $optarrtaxnet, 'locfeenet' => $locfeewithouttax, 'oohfeenet' => $oohfeewithouttax, 'order_id' => $order[0]['id'], 'tot_paid' => $order[0]['totpaid']);
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRORDERSETASCONF'));
			vikrentcar::sendCustMailFromBack($order[0]['custmail'], strip_tags($ftitle)." ".JText::_('VRRENTALORD'), $ftitle, $nowts, $order[0]['custdata'], $carinfo['name'], $order[0]['ritiro'], $order[0]['consegna'], $pricestr, $optstr, $isdue, $viklink, JText::_('VRCOMPLETED'), $ritplace, $consegnaplace, $maillocfee, $mailoohfee, $order[0]['id'], $order[0]['coupon'], $arrayinfopdf);
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=editorder&cid[]=".$oid);
}

function removePayments ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_gpayments` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=payments");
}

function updatePayment ($option) {
	$pwhere = VikRequest::getString('where', '', 'request');
	$pname = VikRequest::getString('name', '', 'request');
	$ppayment = VikRequest::getString('payment', '', 'request');
	$ppublished = VikRequest::getString('published', '', 'request');
	$pcharge = VikRequest::getString('charge', '', 'request');
	$psetconfirmed = VikRequest::getString('setconfirmed', '', 'request');
	$pshownotealw = VikRequest::getString('shownotealw', '', 'request');
	$pnote = VikRequest::getString('note', '', 'request', VIKREQUEST_ALLOWHTML);
	$pval_pcent = VikRequest::getString('val_pcent', '', 'request');
	$pval_pcent = !in_array($pval_pcent, array('1', '2')) ? 1 : $pval_pcent;
	$pch_disc = VikRequest::getString('ch_disc', '', 'request');
	$pch_disc = !in_array($pch_disc, array('1', '2')) ? 1 : $pch_disc;
	$vikpaymentparams = VikRequest::getVar('vikpaymentparams', array(0));
	$payparamarr = array();
	$payparamstr = '';
	if(count($vikpaymentparams) > 0) {
		foreach($vikpaymentparams as $setting => $cont) {
			if (strlen($setting) > 0) {
				$payparamarr[$setting] = $cont;
			}
		}
		if (count($payparamarr) > 0) {
			$payparamstr = json_encode($payparamarr);
		}
	}
	$dbo = JFactory::getDBO();
	if(!empty($pname) && !empty($ppayment) && !empty($pwhere)) {
		$setpub=$ppublished=="1" ? 1 : 0;
		$psetconfirmed=$psetconfirmed=="1" ? 1 : 0;
		$pshownotealw=$pshownotealw=="1" ? 1 : 0;
		$q="SELECT `id` FROM `#__vikrentcar_gpayments` WHERE `file`=".$dbo->quote($ppayment)." AND `id`!='".$pwhere."';";
		$dbo->setQuery($q);
		$dbo->execute();
		//VikRentCar 1.8 : no longer block payment methods that are using the same PHP file
		if($dbo->getNumRows() >= 0) {
			$q="UPDATE `#__vikrentcar_gpayments` SET `name`=".$dbo->quote($pname).",`file`=".$dbo->quote($ppayment).",`published`=".$dbo->quote($setpub).",`note`=".$dbo->quote($pnote).",`charge`=".$dbo->quote($pcharge).",`setconfirmed`=".$dbo->quote($psetconfirmed).",`shownotealw`=".$dbo->quote($pshownotealw).",`val_pcent`='".$pval_pcent."',`ch_disc`='".$pch_disc."',`params`=".$dbo->quote($payparamstr)." WHERE `id`=".$dbo->quote($pwhere).";";
			$dbo->setQuery($q);
			$dbo->execute();
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRPAYMENTUPDATED'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=payments");
		}else {
			VikError::raiseWarning('', JText::_('ERRINVFILEPAYMENT'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=editpayment&cid[]=".$pwhere);
		}
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=editpayment&cid[]=".$pwhere);
	}
}

function savePayment ($option) {
	$pname = VikRequest::getString('name', '', 'request');
	$ppayment = VikRequest::getString('payment', '', 'request');
	$ppublished = VikRequest::getString('published', '', 'request');
	$pcharge = VikRequest::getString('charge', '', 'request');
	$psetconfirmed = VikRequest::getString('setconfirmed', '', 'request');
	$pshownotealw = VikRequest::getString('shownotealw', '', 'request');
	$pnote = VikRequest::getString('note', '', 'request', VIKREQUEST_ALLOWHTML);
	$pval_pcent = VikRequest::getString('val_pcent', '', 'request');
	$pval_pcent = !in_array($pval_pcent, array('1', '2')) ? 1 : $pval_pcent;
	$pch_disc = VikRequest::getString('ch_disc', '', 'request');
	$pch_disc = !in_array($pch_disc, array('1', '2')) ? 1 : $pch_disc;
	$vikpaymentparams = VikRequest::getVar('vikpaymentparams', array(0));
	$payparamarr = array();
	$payparamstr = '';
	if(count($vikpaymentparams) > 0) {
		foreach($vikpaymentparams as $setting => $cont) {
			if (strlen($setting) > 0) {
				$payparamarr[$setting] = $cont;
			}
		}
		if (count($payparamarr) > 0) {
			$payparamstr = json_encode($payparamarr);
		}
	}
	$dbo = JFactory::getDBO();
	if(!empty($pname) && !empty($ppayment)) {
		$setpub=$ppublished=="1" ? 1 : 0;
		$psetconfirmed=$psetconfirmed=="1" ? 1 : 0;
		$pshownotealw=$pshownotealw=="1" ? 1 : 0;
		$q="SELECT `id` FROM `#__vikrentcar_gpayments` WHERE `file`=".$dbo->quote($ppayment).";";
		$dbo->setQuery($q);
		$dbo->execute();
		//VikRentCar 1.8 : no longer block payment methods that are using the same PHP file
		if($dbo->getNumRows() >= 0) {
			$q="INSERT INTO `#__vikrentcar_gpayments` (`name`,`file`,`published`,`note`,`charge`,`setconfirmed`,`shownotealw`,`val_pcent`,`ch_disc`,`params`) VALUES(".$dbo->quote($pname).",".$dbo->quote($ppayment).",".$dbo->quote($setpub).",".$dbo->quote($pnote).",".$dbo->quote($pcharge).",".$dbo->quote($psetconfirmed).",".$dbo->quote($pshownotealw).",'".$pval_pcent."','".$pch_disc."',".$dbo->quote($payparamstr).");";
			$dbo->setQuery($q);
			$dbo->execute();
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRPAYMENTSAVED'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=payments");
		}else {
			VikError::raiseWarning('', JText::_('ERRINVFILEPAYMENT'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=newpayment");
		}
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=newpayment");
	}
}

function editPayment ($pid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_gpayments` WHERE `id`=".$dbo->quote($pid).";";
	$dbo->setQuery($q);
	$dbo->execute();
	$pdata=$dbo->loadAssocList();
	HTML_vikrentcar::pEditPayment($pdata[0], $option);
}

function newPayment ($option) {
	HTML_vikrentcar::pNewPayment($option);
}

function showPayments ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_gpayments` ORDER BY `#__vikrentcar_gpayments`.`name` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pShowPayments($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pShowPayments($rows, $option);
	}	
}

function removeSeasons ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_seasons` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=seasons");
}

function updateSeason ($option) {
	$pwhere = VikRequest::getString('where', '', 'request');
	$pfrom = VikRequest::getString('from', '', 'request');
	$pto = VikRequest::getString('to', '', 'request');
	$ptype = VikRequest::getString('type', '', 'request');
	$pdiffcost = VikRequest::getString('diffcost', '', 'request');
	$pidlocation = VikRequest::getInt('idlocation', '', 'request');
	$pidcars = VikRequest::getVar('idcars', array(0));
	$pidprices = VikRequest::getVar('idprices', array(0));
	$pwdays = VikRequest::getVar('wdays', array());
	$pspname = VikRequest::getString('spname', '', 'request');
	$ppickupincl = VikRequest::getString('pickupincl', '', 'request');
	$ppickupincl = $ppickupincl == 1 ? 1 : 0;
	$pkeepfirstdayrate = VikRequest::getString('keepfirstdayrate', '', 'request');
	$pkeepfirstdayrate = $pkeepfirstdayrate == 1 ? 1 : 0;
	$pval_pcent = VikRequest::getString('val_pcent', '', 'request');
	$pval_pcent = $pval_pcent == "1" ? 1 : 2;
	$proundmode = VikRequest::getString('roundmode', '', 'request');
	$proundmode = (!empty($proundmode) && in_array($proundmode, array('PHP_ROUND_HALF_UP', 'PHP_ROUND_HALF_DOWN')) ? $proundmode : '');
	$pyeartied = VikRequest::getString('yeartied', '', 'request');
	$pyeartied = $pyeartied == "1" ? 1 : 0;
	$tieyear = 0;
	$ppromo = VikRequest::getInt('promo', '', 'request');
	$ppromo = $ppromo == 1 ? 1 : 0;
	$ppromodaysadv = VikRequest::getInt('promodaysadv', '', 'request');
	$ppromotxt = VikRequest::getString('promotxt', '', 'request', VIKREQUEST_ALLOWHTML);
	$pnightsoverrides = VikRequest::getVar('nightsoverrides', array());
	$pvaluesoverrides = VikRequest::getVar('valuesoverrides', array());
	$pandmoreoverride = VikRequest::getVar('andmoreoverride', array());
	$dbo = JFactory::getDBO();
	if((!empty($pfrom) && !empty($pto)) || count($pwdays) > 0) {
		$skipseason = false;
		if(empty($pfrom) || empty($pto)) {
			$skipseason = true;
		}
		$skipdays = false;
		$wdaystr = null;
		if(count($pwdays) == 0) {
			$skipdays = true;
		}else {
			$wdaystr = "";
			foreach($pwdays as $wd) {
				$wdaystr .= $wd.';';
			}
		}
		$carstr="";
		if(@count($pidcars) > 0) {
			foreach($pidcars as $car) {
				$carstr.="-".$car."-,";
			}
		}
		$pricestr="";
		if(@count($pidprices) > 0) {
			foreach($pidprices as $price) {
				if(empty($price)) {
					continue;
				}
				$pricestr.="-".$price."-,";
			}
		}
		$valid = true;
		$sfrom = null;
		$sto = null;
		if(!$skipseason) {
			$first=vikrentcar::getDateTimestamp($pfrom, 0, 0);
			$second=vikrentcar::getDateTimestamp($pto, 0, 0);
			if ($second > $first) {
				$baseone=getdate($first);
				$basets=mktime(0, 0, 0, 1, 1, $baseone['year']);
				$sfrom=$baseone[0] - $basets;
				$basetwo=getdate($second);
				$basets=mktime(0, 0, 0, 1, 1, $basetwo['year']);
				$sto=$basetwo[0] - $basets;
				//check leap year
				if($baseone['year'] % 4 == 0 && ($baseone['year'] % 100 != 0 || $baseone['year'] % 400 == 0)) {
					$leapts = mktime(0, 0, 0, 2, 29, $baseone['year']);
					if($baseone[0] >= $leapts) {
						$sfrom -= 86400;
						$sto -= 86400;
					}
				}
				//end leap year
				//tied to the year
				if ($pyeartied == 1) {
					$tieyear = $baseone['year'];
				}
				//
				//check if seasons dates are valid
				$q="SELECT `id` FROM `#__vikrentcar_seasons` WHERE `from`<=".$dbo->quote($sfrom)." AND `to`>=".$dbo->quote($sfrom)." AND `id`!=".$dbo->quote($pwhere)." AND `idcars`=".$dbo->quote($carstr)." AND `locations`=".$dbo->quote($pidlocation)."".(!$skipdays ? " AND `wdays`='".$wdaystr."'" : "").($skipdays ? " AND (`from` > 0 OR `to` > 0) AND `wdays`=''" : "").($pyeartied == 1 ? " AND `year`=".$tieyear : " AND `year` IS NULL")." AND `idprices`=".$dbo->quote($pricestr).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$totfirst=@$dbo->getNumRows();
				if ($totfirst > 0) {
					$valid=false;
				}
				$q="SELECT `id` FROM `#__vikrentcar_seasons` WHERE `from`<=".$dbo->quote($sto)." AND `to`>=".$dbo->quote($sto)." AND `id`!=".$dbo->quote($pwhere)." AND `idcars`=".$dbo->quote($carstr)." AND `locations`=".$dbo->quote($pidlocation)."".(!$skipdays ? " AND `wdays`='".$wdaystr."'" : "").($skipdays ? " AND (`from` > 0 OR `to` > 0) AND `wdays`=''" : "").($pyeartied == 1 ? " AND `year`=".$tieyear : " AND `year` IS NULL")." AND `idprices`=".$dbo->quote($pricestr).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$totsecond=@$dbo->getNumRows();
				if ($totsecond > 0) {
					$valid=false;
				}
				$q="SELECT `id` FROM `#__vikrentcar_seasons` WHERE `from`>=".$dbo->quote($sfrom)." AND `from`<=".$dbo->quote($sto)." AND `to`>=".$dbo->quote($sfrom)." AND `to`<=".$dbo->quote($sto)." AND `id`!=".$dbo->quote($pwhere)." AND `idcars`=".$dbo->quote($carstr)." AND `locations`=".$dbo->quote($pidlocation)."".(!$skipdays ? " AND `wdays`='".$wdaystr."'" : "").($skipdays ? " AND (`from` > 0 OR `to` > 0) AND `wdays`=''" : "").($pyeartied == 1 ? " AND `year`=".$tieyear : " AND `year` IS NULL")." AND `idprices`=".$dbo->quote($pricestr).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$totthird=@$dbo->getNumRows();
				if($totthird > 0) {
					$valid=false;
				}
				//
			}else {
				VikError::raiseWarning('', JText::_('ERRINVDATESEASON'));
				$mainframe = JFactory::getApplication();
				$mainframe->redirect("index.php?option=".$option."&task=editseason&cid[]=".$pwhere);
			}
		}
		if($valid) {
			$losverridestr = "";
			if (count($pnightsoverrides) > 0 && count($pvaluesoverrides) > 0) {
				foreach($pnightsoverrides as $ko => $no) {
					if (!empty($no) && strlen(trim($pvaluesoverrides[$ko])) > 0) {
						$infiniteclause = intval($pandmoreoverride[$ko]) == 1 ? '-i' : '';
						$losverridestr .= intval($no).$infiniteclause.':'.trim($pvaluesoverrides[$ko]).'_';
					}
				}
			}
			$q="UPDATE `#__vikrentcar_seasons` SET `type`='".($ptype == "1" ? "1" : "2")."',`from`=".$dbo->quote($sfrom).",`to`=".$dbo->quote($sto).",`diffcost`=".$dbo->quote($pdiffcost).",`idcars`=".$dbo->quote($carstr).",`locations`=".$dbo->quote($pidlocation).",`spname`=".$dbo->quote($pspname).",`wdays`='".$wdaystr."',`pickupincl`='".$ppickupincl."',`val_pcent`='".$pval_pcent."',`losoverride`=".$dbo->quote($losverridestr).",`keepfirstdayrate`='".$pkeepfirstdayrate."',`roundmode`=".(!empty($proundmode) ? "'".$proundmode."'" : "null").",`year`=".($pyeartied == 1 ? $tieyear : "NULL").",`idprices`=".$dbo->quote($pricestr).",`promo`=".$ppromo.",`promodaysadv`=".(!empty($ppromodaysadv) ? $ppromodaysadv : "null").",`promotxt`=".$dbo->quote($ppromotxt)." WHERE `id`=".$dbo->quote($pwhere).";";
			$dbo->setQuery($q);
			$dbo->execute();
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRSEASONUPDATED'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=seasons");
		}else {
			VikError::raiseWarning('', JText::_('ERRINVDATECARSLOCSEASON'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=editseason&cid[]=".$pwhere);
		}
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=editseason&cid[]=".$pwhere);
	}
}

function saveSeason ($option) {
	$pfrom = VikRequest::getString('from', '', 'request');
	$pto = VikRequest::getString('to', '', 'request');
	$ptype = VikRequest::getString('type', '', 'request');
	$pdiffcost = VikRequest::getString('diffcost', '', 'request');
	$pidlocation = VikRequest::getInt('idlocation', '', 'request');
	$pidcars = VikRequest::getVar('idcars', array(0));
	$pidprices = VikRequest::getVar('idprices', array(0));
	$pwdays = VikRequest::getVar('wdays', array());
	$pspname = VikRequest::getString('spname', '', 'request');
	$ppickupincl = VikRequest::getString('pickupincl', '', 'request');
	$ppickupincl = $ppickupincl == 1 ? 1 : 0;
	$pkeepfirstdayrate = VikRequest::getString('keepfirstdayrate', '', 'request');
	$pkeepfirstdayrate = $pkeepfirstdayrate == 1 ? 1 : 0;
	$pval_pcent = VikRequest::getString('val_pcent', '', 'request');
	$pval_pcent = $pval_pcent == "1" ? 1 : 2;
	$proundmode = VikRequest::getString('roundmode', '', 'request');
	$proundmode = (!empty($proundmode) && in_array($proundmode, array('PHP_ROUND_HALF_UP', 'PHP_ROUND_HALF_DOWN')) ? $proundmode : '');
	$pyeartied = VikRequest::getString('yeartied', '', 'request');
	$pyeartied = $pyeartied == "1" ? 1 : 0;
	$tieyear = 0;
	$ppromo = VikRequest::getInt('promo', '', 'request');
	$ppromodaysadv = VikRequest::getInt('promodaysadv', '', 'request');
	$ppromotxt = VikRequest::getString('promotxt', '', 'request', VIKREQUEST_ALLOWHTML);
	$pnightsoverrides = VikRequest::getVar('nightsoverrides', array());
	$pvaluesoverrides = VikRequest::getVar('valuesoverrides', array());
	$pandmoreoverride = VikRequest::getVar('andmoreoverride', array());
	$dbo = JFactory::getDBO();
	if((!empty($pfrom) && !empty($pto)) || count($pwdays) > 0) {
		$skipseason = false;
		if(empty($pfrom) || empty($pto)) {
			$skipseason = true;
		}
		$skipdays = false;
		$wdaystr = null;
		if(count($pwdays) == 0) {
			$skipdays = true;
		}else {
			$wdaystr = "";
			foreach($pwdays as $wd) {
				$wdaystr .= $wd.';';
			}
		}
		$carstr="";
		if(@count($pidcars) > 0) {
			foreach($pidcars as $car) {
				$carstr.="-".$car."-,";
			}
		}
		$pricestr="";
		if(@count($pidprices) > 0) {
			foreach($pidprices as $price) {
				if(empty($price)) {
					continue;
				}
				$pricestr.="-".$price."-,";
			}
		}
		$valid = true;
		$sfrom = null;
		$sto = null;
		if(!$skipseason) {
			$first=vikrentcar::getDateTimestamp($pfrom, 0, 0);
			$second=vikrentcar::getDateTimestamp($pto, 0, 0);
			if ($second > $first) {
				$baseone=getdate($first);
				$basets=mktime(0, 0, 0, 1, 1, $baseone['year']);
				$sfrom=$baseone[0] - $basets;
				$basetwo=getdate($second);
				$basets=mktime(0, 0, 0, 1, 1, $basetwo['year']);
				$sto=$basetwo[0] - $basets;
				//check leap year
				if($baseone['year'] % 4 == 0 && ($baseone['year'] % 100 != 0 || $baseone['year'] % 400 == 0)) {
					$leapts = mktime(0, 0, 0, 2, 29, $baseone['year']);
					if($baseone[0] >= $leapts) {
						$sfrom -= 86400;
						$sto -= 86400;
					}
				}
				//end leap year
				//tied to the year
				if ($pyeartied == 1) {
					$tieyear = $baseone['year'];
				}
				//
				//check if seasons dates are valid
				$q="SELECT `id` FROM `#__vikrentcar_seasons` WHERE `from`<=".$dbo->quote($sfrom)." AND `to`>=".$dbo->quote($sfrom)." AND `idcars`=".$dbo->quote($carstr)." AND `locations`=".$dbo->quote($pidlocation)."".(!$skipdays ? " AND `wdays`='".$wdaystr."'" : "").($skipdays ? " AND (`from` > 0 OR `to` > 0) AND `wdays`=''" : "").($pyeartied == 1 ? " AND `year`=".$tieyear : " AND `year` IS NULL")." AND `idprices`=".$dbo->quote($pricestr).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$totfirst=@$dbo->getNumRows();
				if ($totfirst > 0) {
					$valid=false;
				}
				$q="SELECT `id` FROM `#__vikrentcar_seasons` WHERE `from`<=".$dbo->quote($sto)." AND `to`>=".$dbo->quote($sto)." AND `idcars`=".$dbo->quote($carstr)." AND `locations`=".$dbo->quote($pidlocation)."".(!$skipdays ? " AND `wdays`='".$wdaystr."'" : "").($skipdays ? " AND (`from` > 0 OR `to` > 0) AND `wdays`=''" : "").($pyeartied == 1 ? " AND `year`=".$tieyear : " AND `year` IS NULL")." AND `idprices`=".$dbo->quote($pricestr).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$totsecond=@$dbo->getNumRows();
				if ($totsecond > 0) {
					$valid=false;
				}
				$q="SELECT `id` FROM `#__vikrentcar_seasons` WHERE `from`>=".$dbo->quote($sfrom)." AND `from`<=".$dbo->quote($sto)." AND `to`>=".$dbo->quote($sfrom)." AND `to`<=".$dbo->quote($sto)." AND `idcars`=".$dbo->quote($carstr)." AND `locations`=".$dbo->quote($pidlocation)."".(!$skipdays ? " AND `wdays`='".$wdaystr."'" : "").($skipdays ? " AND (`from` > 0 OR `to` > 0) AND `wdays`=''" : "").($pyeartied == 1 ? " AND `year`=".$tieyear : " AND `year` IS NULL")." AND `idprices`=".$dbo->quote($pricestr).";";
				$dbo->setQuery($q);
				$dbo->execute();
				$totthird=@$dbo->getNumRows();
				if($totthird > 0) {
					$valid=false;
				}
				//
			}else {
				VikError::raiseWarning('', JText::_('ERRINVDATESEASON'));
				$mainframe = JFactory::getApplication();
				$mainframe->redirect("index.php?option=".$option."&task=newseason");
			}
		}
		if($valid) {
			$losverridestr = "";
			if (count($pnightsoverrides) > 0 && count($pvaluesoverrides) > 0) {
				foreach($pnightsoverrides as $ko => $no) {
					if (!empty($no) && strlen(trim($pvaluesoverrides[$ko])) > 0) {
						$infiniteclause = intval($pandmoreoverride[$ko]) == 1 ? '-i' : '';
						$losverridestr .= intval($no).$infiniteclause.':'.trim($pvaluesoverrides[$ko]).'_';
					}
				}
			}
			$q="INSERT INTO `#__vikrentcar_seasons` (`type`,`from`,`to`,`diffcost`,`idcars`,`locations`,`spname`,`wdays`,`pickupincl`,`val_pcent`,`losoverride`,`keepfirstdayrate`,`roundmode`,`year`,`idprices`,`promo`,`promodaysadv`,`promotxt`) VALUES('".($ptype == "1" ? "1" : "2")."', ".$dbo->quote($sfrom).", ".$dbo->quote($sto).", ".$dbo->quote($pdiffcost).", ".$dbo->quote($carstr).", ".$dbo->quote($pidlocation).", ".$dbo->quote($pspname).", ".$dbo->quote($wdaystr).", '".$ppickupincl."', '".$pval_pcent."', ".$dbo->quote($losverridestr).", '".$pkeepfirstdayrate."', ".(!empty($proundmode) ? "'".$proundmode."'" : "null").", ".($pyeartied == 1 ? $tieyear : "NULL").", ".$dbo->quote($pricestr).", ".($ppromo == 1 ? '1' : '0').", ".(!empty($ppromodaysadv) ? $ppromodaysadv : "null").", ".$dbo->quote($ppromotxt).");";
			$dbo->setQuery($q);
			$dbo->execute();
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRSEASONSAVED'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=seasons");
		}else {
			VikError::raiseWarning('', JText::_('ERRINVDATECARSLOCSEASON'));
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=".$option."&task=newseason");
		}
	}else {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=newseason");
	}
}

function editSeason ($sid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_seasons` WHERE `id`=".$dbo->quote($sid).";";
	$dbo->setQuery($q);
	$dbo->execute();
	$sdata=$dbo->loadAssocList();
	$split=explode(",", $sdata[0]['idcars']);
	$wsel="";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wsel.="<select name=\"idcars[]\" multiple=\"multiple\" size=\"5\">\n";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wsel.="<option value=\"".$d['id']."\"".(in_array("-".$d['id']."-", $split) ? " selected=\"selected\"" : "").">".$d['name']."</option>\n";
		}
		$wsel.="</select>\n";
	}
	$wpricesel="";
	$splitprices=explode(",", $sdata[0]['idprices']);
	$q="SELECT `id`,`name` FROM `#__vikrentcar_prices` ORDER BY `#__vikrentcar_prices`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wpricesel.="<select name=\"idprices[]\" multiple=\"multiple\" size=\"5\">\n";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wpricesel.="<option value=\"".$d['id']."\"".(in_array("-".$d['id']."-", $splitprices) ? " selected=\"selected\"" : "").">".$d['name']."</option>\n";
		}
		$wpricesel.="</select>\n";
	}
	$wlocsel="<input type=\"hidden\" name=\"idlocation\" value=\"0\"/>";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wlocsel="<select name=\"idlocation\">\n<option value=\"0\">".JText::_('VRSEASONANY')."</option>";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wlocsel.="<option value=\"".$d['id']."\"".($d['id'] == $sdata[0]['locations'] ? " selected=\"selected\"" : "").">".$d['name']."</option>\n";
		}
		$wlocsel.="</select>\n";
	}
	HTML_vikrentcar::pEditSeason($sdata[0], $wsel, $wpricesel, $wlocsel, $option);
}

function newSeason ($option) {
	$dbo = JFactory::getDBO();
	$wsel="";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wsel.="<select name=\"idcars[]\" multiple=\"multiple\" size=\"5\">\n";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wsel.="<option value=\"".$d['id']."\">".$d['name']."</option>\n";
		}
		$wsel.="</select>\n";
	}
	$wpricesel="";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_prices` ORDER BY `#__vikrentcar_prices`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wpricesel.="<select name=\"idprices[]\" multiple=\"multiple\" size=\"5\">\n";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wpricesel.="<option value=\"".$d['id']."\" selected=\"selected\">".$d['name']."</option>\n";
		}
		$wpricesel.="</select>\n";
	}
	$wlocsel="<input type=\"hidden\" name=\"idlocation\" value=\"0\"/>";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wlocsel="<select name=\"idlocation\">\n<option value=\"0\">".JText::_('VRSEASONANY')."</option>";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wlocsel.="<option value=\"".$d['id']."\">".$d['name']."</option>\n";
		}
		$wlocsel.="</select>\n";
	}
	HTML_vikrentcar::pNewSeason($wsel, $wpricesel, $wlocsel, $option);
}

function showSeasons ($option) {
	$dbo = JFactory::getDBO();
	$pidcar = VikRequest::getInt('idcar', '', 'request');
	$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	$all_cars = $dbo->getNumRows() > 0 ? $dbo->loadAssocList() : array();
	$car_names = array();
	$carsel = '<select id="idcar" name="idcar" onchange="document.seasonsform.submit();"><option value="">'.JText::_('VRCAFFANYCAR').'</option>';
	if(count($all_cars) > 0) {
		foreach ($all_cars as $car) {
			$carsel .= '<option value="'.$car['id'].'"'.($car['id'] == $pidcar ? ' selected="selected"' : '').'>- '.$car['name'].'</option>';
			$car_names[$car['id']] = $car['name'];
		}
	}
	$carsel .= '</select>';
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_seasons`".(!empty($pidcar) ? " WHERE `idcars` LIKE '%-".$pidcar."-%'" : "")." ORDER BY `#__vikrentcar_seasons`.`spname` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pShowSeasons($rows, $carsel, $car_names, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pShowSeasons($rows, $carsel, $car_names, $option);
	}	
}

function removeLocFee ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_locfees` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=locfees");
}

function updateLocFee ($option) {
	$pwhere = VikRequest::getString('where', '', 'request');
	$pfrom = VikRequest::getInt('from', '', 'request');
	$pto = VikRequest::getInt('to', '', 'request');
	$pcost = VikRequest::getString('cost', '', 'request');
	$pdaily = VikRequest::getString('daily', '', 'request');
	$paliq = VikRequest::getInt('aliq', '', 'request');
	$pinvert = VikRequest::getString('invert', '', 'request');
	$pinvert = $pinvert == "1" ? 1 : 0;
	$pnightsoverrides = VikRequest::getVar('nightsoverrides', array());
	$pvaluesoverrides = VikRequest::getVar('valuesoverrides', array());
	$dbo = JFactory::getDBO();
	if(!empty($pwhere) && !empty($pfrom) && !empty($pto)) {
		$losverridestr = "";
		if (count($pnightsoverrides) > 0 && count($pvaluesoverrides) > 0) {
			foreach($pnightsoverrides as $ko => $no) {
				if (!empty($no) && strlen(trim($pvaluesoverrides[$ko])) > 0) {
					$losverridestr .= $no.':'.trim($pvaluesoverrides[$ko]).'_';
				}
			}
		}
		$q="UPDATE `#__vikrentcar_locfees` SET `from`=".$dbo->quote($pfrom).",`to`=".$dbo->quote($pto).",`daily`='".(intval($pdaily) == 1 ? "1" : "0")."',`cost`=".$dbo->quote($pcost).",`idiva`=".$dbo->quote($paliq).",`invert`='".$pinvert."',`losoverride`='".$losverridestr."' WHERE `id`=".$dbo->quote($pwhere).";";
		$dbo->setQuery($q);
		$dbo->execute();
		$app = JFactory::getApplication();
		$app->enqueueMessage(JText::_('VRLOCFEEUPDATE'));
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=locfees");
	
}

function saveLocFee ($option) {
	$pfrom = VikRequest::getInt('from', '', 'request');
	$pto = VikRequest::getInt('to', '', 'request');
	$pcost = VikRequest::getString('cost', '', 'request');
	$pdaily = VikRequest::getString('daily', '', 'request');
	$paliq = VikRequest::getInt('aliq', '', 'request');
	$pinvert = VikRequest::getString('invert', '', 'request');
	$pinvert = $pinvert == "1" ? 1 : 0;
	$pnightsoverrides = VikRequest::getVar('nightsoverrides', array());
	$pvaluesoverrides = VikRequest::getVar('valuesoverrides', array());
	$dbo = JFactory::getDBO();
	if(!empty($pfrom) && !empty($pto)) {
		$losverridestr = "";
		if (count($pnightsoverrides) > 0 && count($pvaluesoverrides) > 0) {
			foreach($pnightsoverrides as $ko => $no) {
				if (!empty($no) && strlen(trim($pvaluesoverrides[$ko])) > 0) {
					$losverridestr .= $no.':'.trim($pvaluesoverrides[$ko]).'_';
				}
			}
		}
		$q="INSERT INTO `#__vikrentcar_locfees` (`from`,`to`,`daily`,`cost`,`idiva`,`invert`,`losoverride`) VALUES(".$dbo->quote($pfrom).", ".$dbo->quote($pto).", '".(intval($pdaily) == 1 ? "1" : "0")."', ".$dbo->quote($pcost).", ".$dbo->quote($paliq).", '".$pinvert."', '".$losverridestr."');";
		$dbo->setQuery($q);
		$dbo->execute();
		$app = JFactory::getApplication();
		$app->enqueueMessage(JText::_('VRLOCFEESAVED'));
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=locfees");
	
}

function editLocFee ($fid, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_locfees` WHERE `id`=".$dbo->quote($fid).";";
	$dbo->setQuery($q);
	$dbo->execute();
	$fdata=$dbo->loadAssocList();
	$wsel="";
	$wseltwo="";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wsel.="<select name=\"from\">\n<option value=\"\"></option>\n";
		$wseltwo.="<select name=\"to\">\n<option value=\"\"></option>\n";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wsel.="<option value=\"".$d['id']."\"".($d['id'] == $fdata[0]['from'] ? " selected=\"selected\"" : "").">".$d['name']."</option>\n";
			$wseltwo.="<option value=\"".$d['id']."\"".($d['id'] == $fdata[0]['to'] ? " selected=\"selected\"" : "").">".$d['name']."</option>\n";
		}
		$wsel.="</select>\n";
		$wseltwo.="</select>\n";
	}
	HTML_vikrentcar::pEditLocFee($fdata[0], $wsel, $wseltwo, $option);
}

function newLocFee ($option) {
	$dbo = JFactory::getDBO();
	$wsel="";
	$wseltwo="";
	$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if($dbo->getNumRows() > 0) {
		$wsel.="<select name=\"from\">\n<option value=\"\"></option>\n";
		$wseltwo.="<select name=\"to\">\n<option value=\"\"></option>\n";
		$data=$dbo->loadAssocList();
		foreach($data as $d) {
			$wsel.="<option value=\"".$d['id']."\">".$d['name']."</option>\n";
			$wseltwo.="<option value=\"".$d['id']."\">".$d['name']."</option>\n";
		}
		$wsel.="</select>\n";
		$wseltwo.="</select>\n";
	}
	HTML_vikrentcar::pNewLocFee($wsel, $wseltwo, $option);
}

function locFees ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_locfees`";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pLocFees($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pLocFees($rows, $option);
	}	
}

function chooseBusy ($option) {
	$pts = VikRequest::getInt('ts', '', 'request');
	$pidcar = VikRequest::getInt('idcar', '', 'request');
	if(!empty($pts) && !empty($pidcar)) {
		//ultimo secondo del giorno scelto
		$realritiro=$pts + 86399;
		//
		$mainframe = JFactory::getApplication();
		$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
		$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
		$dbo = JFactory::getDBO();
		$q="SELECT COUNT(*) FROM `#__vikrentcar_busy` AS `b` WHERE `b`.`idcar`=".$dbo->quote($pidcar)." AND `b`.`ritiro`<=".$dbo->quote($realritiro)." AND `b`.`consegna`>=".$dbo->quote($pts)."";
		$dbo->setQuery($q);
		$dbo->execute();
		$totres=$dbo->loadResult();
		$q="SELECT SQL_CALC_FOUND_ROWS `b`.`id`,`b`.`idcar`,`b`.`ritiro`,`b`.`consegna`,`o`.`id` AS `idorder`,`o`.`custdata`,`o`.`ts`,`o`.`carindex`,`c`.`name`,`c`.`img`,`c`.`units`,`c`.`params` FROM `#__vikrentcar_busy` AS `b`,`#__vikrentcar_orders` AS `o`,`#__vikrentcar_cars` AS `c` WHERE `b`.`idcar`=".$dbo->quote($pidcar)." AND `b`.`ritiro`<=".$dbo->quote($realritiro)." AND `b`.`consegna`>=".$dbo->quote($pts)." AND `o`.`idbusy`=`b`.`id` AND `c`.`id`=`b`.`idcar` ORDER BY `b`.`ritiro` ASC";
		$dbo->setQuery($q, $lim0, $lim);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$reservs=$dbo->loadAssocList();
			$dbo->setQuery('SELECT FOUND_ROWS();');
			jimport('joomla.html.pagination');
			$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
			$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
			HTML_vikrentcar::pChooseBusy($reservs, $totres, $pts, $option, $lim0, $navbut);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function viewCar ($option) {
	$pmodtar = VikRequest::getString('modtar', '', 'request');
	//vikrentcar 1.5
	$pmodtarhours = VikRequest::getString('modtarhours', '', 'request');
	//
	//vikrentcar 1.6
	$pmodtarhourscharges = VikRequest::getString('modtarhourscharges', '', 'request');
	//
	$pcarid = VikRequest::getString('carid', '', 'request');
	$dbo = JFactory::getDBO();
	if (!empty($pmodtar) && !empty($pcarid)) {
		$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `idcar`=".$dbo->quote($pcarid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$tars = $dbo->loadAssocList();
			foreach($tars as $tt){
				$tmpcost = VikRequest::getString('cost'.$tt['id'], '', 'request');
				$tmpattr = VikRequest::getString('attr'.$tt['id'], '', 'request');
				if (strlen($tmpcost)) {
					$q="UPDATE `#__vikrentcar_dispcost` SET `cost`='".$tmpcost."'".(strlen($tmpattr) ? ", `attrdata`=".$dbo->quote($tmpattr)."" : "")." WHERE `id`='".$tt['id']."';";
					$dbo->setQuery($q);
					$dbo->execute();
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewtariffe&cid[]=".$pcarid);
	}elseif(!empty($pmodtarhours) && !empty($pcarid)) {
		//vikrentcar 1.5 fares for hours
		$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `idcar`=".$dbo->quote($pcarid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$tars = $dbo->loadAssocList();
			foreach($tars as $tt){
				$tmpcost = VikRequest::getString('cost'.$tt['id'], '', 'request');
				$tmpattr = VikRequest::getString('attr'.$tt['id'], '', 'request');
				if (strlen($tmpcost)) {
					$q="UPDATE `#__vikrentcar_dispcosthours` SET `cost`='".$tmpcost."'".(strlen($tmpattr) ? ", `attrdata`=".$dbo->quote($tmpattr)."" : "")." WHERE `id`='".$tt['id']."';";
					$dbo->setQuery($q);
					$dbo->execute();
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewtariffehours&cid[]=".$pcarid);
		//
	}elseif(!empty($pmodtarhourscharges) && !empty($pcarid)) {
		//vikrentcar 1.6 extra hours charges
		$q="SELECT * FROM `#__vikrentcar_hourscharges` WHERE `idcar`=".$dbo->quote($pcarid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() > 0) {
			$tars = $dbo->loadAssocList();
			foreach($tars as $tt){
				$tmpcost = VikRequest::getString('cost'.$tt['id'], '', 'request');
				if (strlen($tmpcost)) {
					$q="UPDATE `#__vikrentcar_hourscharges` SET `cost`='".$tmpcost."' WHERE `id`='".$tt['id']."';";
					$dbo->setQuery($q);
					$dbo->execute();
				}
			}
		}
		$mainframe = JFactory::getApplication();
		$mainframe->redirect("index.php?option=".$option."&task=viewhourscharges&cid[]=".$pcarid);
		//
	}else {
		$mainframe = JFactory::getApplication();
		$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
		$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
		$session = JFactory::getSession();
		$pvrcorderby = VikRequest::getString('vrcorderby', '', 'request');
		$pvrcordersort = VikRequest::getString('vrcordersort', '', 'request');
		$validorderby = array('id', 'name', 'units');
		$orderby = $session->get('vrcViewCarsOrderby', 'id');
		$ordersort = $session->get('vrcViewCarsOrdersort', 'DESC');
		if (!empty($pvrcorderby) && in_array($pvrcorderby, $validorderby)) {
			$orderby = $pvrcorderby;
			$session->set('vrcViewCarsOrderby', $orderby);
			if (!empty($pvrcordersort) && in_array($pvrcordersort, array('ASC', 'DESC'))) {
				$ordersort = $pvrcordersort;
				$session->set('vrcViewCarsOrdersort', $ordersort);
			}
		}
		$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`".$orderby."` ".$ordersort;
		eval(read('2464626F2D3E73657451756572792824712C20246C696D302C20246C696D293B2464626F2D3E6578656375746528293B247066203D20222E2F636F6D706F6E656E74732F636F6D5F76696B72656E746361722F22202E2043524541544956494B415050202E20226174223B24683D40676574656E762827485454505F484F535427293B246E3D40676574656E7628275345525645525F4E414D4527293B6966202866696C655F657869737473282470662929207B2461203D2066696C6528247066293B6966202821636865636B436F6D702824612C2024682C20246E2929207B246670203D20666F70656E282470662C20227722293B246372763D206E65772043726561746976696B446F74497428293B69662028246372762D3E6B73612822687474703A2F2F7777772E63726561746976696B2E69742F76696B6C6963656E73652F3F76696B683D22202E2075726C656E636F646528246829202E20222676696B736E3D22202E2075726C656E636F646528246E29202E2022266170703D22202E2075726C656E636F64652843524541544956494B415050292929207B696620287374726C656E28246372762D3E7469736529203D3D203229207B667772697465282466702C20656E6372797074436F6F6B696528246829202E20225C6E22202E20656E6372797074436F6F6B696528246E29293B7D20656C7365207B6563686F20246372762D3E746973653B7D7D20656C7365207B667772697465282466702C20656E6372797074436F6F6B696528246829202E20225C6E22202E20656E6372797074436F6F6B696528246E29293B7D7D7D20656C7365207B4A4572726F723A3A72616973655761726E696E672827272C20224572726F723A20537570706F7274204C6963656E7365206E6F7420666F756E6420666F72207468697320646F6D61696E2E3C62722F3E546F207265706F727420616E204572726F722C20636F6E74616374203C6120687265663D5C226D61696C746F3A7465636840657874656E73696F6E73666F726A6F6F6D6C612E636F6D5C223E7465636840657874656E73696F6E73666F726A6F6F6D6C612E636F6D3C2F613E207768696C6520746F20707572636861736520616E6F74686572206C6963656E73652C207669736974203C6120687265663D5C22687474703A2F2F7777772E65346A2E636F6D5C223E65346A2E636F6D3C2F613E22293B7D'));
		if ($dbo->getNumRows() > 0) {
			$rows = $dbo->loadAssocList();
			$dbo->setQuery('SELECT FOUND_ROWS();');
			jimport('joomla.html.pagination');
			$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
			$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
			HTML_vikrentcar::pViewCar($rows, $option, $lim0, $navbut, $orderby, $ordersort);
		}else {
			$rows="";
			HTML_vikrentcar::pViewCar($rows, $option);
		}
	}
}

function viewOrders ($option) {
	$dbo = JFactory::getDBO();
	$all_locations = '';
	$q = "SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$all_locations = $dbo->loadAssocList();
	}
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$session = JFactory::getSession();
	$plocation = VikRequest::getInt('location', '', 'request');
	$plocationw = VikRequest::getString('locationw', '', 'request');
	$plocationw = empty($plocationw) || !in_array($plocationw, array('pickup', 'dropoff', 'both')) ? 'pickup' : $plocationw;
	$pvrcorderby = VikRequest::getString('vrcorderby', '', 'request');
	$pvrcordersort = VikRequest::getString('vrcordersort', '', 'request');
	$pfiltnc = VikRequest::getString('filtnc', '', 'request');
	$validorderby = array('ts', 'carname', 'pickupts', 'dropoffts', 'days', 'total', 'status');
	$orderby = $session->get('vrcViewOrdersOrderby', 'ts');
	$ordersort = $session->get('vrcViewOrdersOrdersort', 'DESC');
	if (!empty($pvrcorderby) && in_array($pvrcorderby, $validorderby)) {
		$orderby = $pvrcorderby;
		$session->set('vrcViewOrdersOrderby', $orderby);
		if (!empty($pvrcordersort) && in_array($pvrcordersort, array('ASC', 'DESC'))) {
			$ordersort = $pvrcordersort;
			$session->set('vrcViewOrdersOrdersort', $ordersort);
		}
	}
	if($plocation > 0) {
		$session->set('vrcViewOrdersLocation', $plocation);
	}else {
		if(isset($_REQUEST['location'])) {
			$session->set('vrcViewOrdersLocation', 0);
		}else {
			$plocation = $session->get('vrcViewOrdersLocation', 0);
		}
	}
	$where_clause = '';
	if($plocation > 0 || !empty($pfiltnc)) {
		$where_clause = ' WHERE ';
		if($plocation > 0) {
			if($plocationw == 'both') {
				$where_clause .= '(`o`.`idplace`='.$plocation.' OR `o`.`idreturnplace`='.$plocation.")";
			}elseif($plocationw == 'dropoff') {
				$where_clause .= '`o`.`idreturnplace`='.$plocation;
			}elseif($plocationw == 'pickup') {
				$where_clause .= '`o`.`idplace`='.$plocation;
			}
		}
		if(!empty($pfiltnc)) {
			$where_clause .= $plocation > 0 ? ' AND ' : '';
			$where_clause .= "(CONCAT_WS('_', `o`.`sid`, `o`.`ts`) = ".$dbo->quote($pfiltnc)." OR `o`.`sid`=".$dbo->quote(str_replace('_', '', trim($pfiltnc)))." OR `o`.`custdata` LIKE ".$dbo->quote('%'.$pfiltnc.'%')." OR `o`.`nominative` LIKE ".$dbo->quote('%'.$pfiltnc.'%').")";
		}
	}
	$q="SELECT SQL_CALC_FOUND_ROWS `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy`".$where_clause." ORDER BY `o`.`".$orderby."` ".$ordersort;
	if($orderby == 'carname') {
		$q="SELECT SQL_CALC_FOUND_ROWS `o`.*,`b`.`stop_sales`,`c`.`name` AS `carname` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy` LEFT JOIN `#__vikrentcar_cars` `c` ON `o`.`idcar`=`c`.`id`".$where_clause." ORDER BY `c`.`name` ".$ordersort;
	}elseif($orderby == 'pickupts') {
		$q="SELECT SQL_CALC_FOUND_ROWS `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy`".$where_clause." ORDER BY `o`.`ritiro` ".$ordersort;
	}elseif($orderby == 'dropoffts') {
		$q="SELECT SQL_CALC_FOUND_ROWS `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy`".$where_clause." ORDER BY `o`.`consegna` ".$ordersort;
	}elseif($orderby == 'total') {
		$q="SELECT SQL_CALC_FOUND_ROWS `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy`".$where_clause." ORDER BY `o`.`order_total` ".$ordersort;
	}
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	$tot_orders = $dbo->getNumRows();
	if ($tot_orders == 1) {
		$row = $dbo->loadAssoc();
		$mainframe->redirect('index.php?option=com_vikrentcar&task=editorder&cid[]='.$row['id']);
	}elseif ($tot_orders > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewOrders($rows, $option, $lim0, $navbut, $all_locations, $plocation, $plocationw, $orderby, $ordersort);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewOrders($rows, $option, '', '', $all_locations, $plocation, $plocationw);
	}
}

function viewOldOrders ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_oldorders` ORDER BY `#__vikrentcar_oldorders`.`tsdel` DESC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if (@$dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewOldOrders($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewOldOrders($rows, $option);
	}
}

function viewStats ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_stats` ORDER BY `#__vikrentcar_stats`.`ts` DESC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewStats($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewStats($rows, $option);
	}
}

function viewConfig ($option) {
	echo "<form name=\"adminForm\" id=\"adminForm\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">\n";
	jimport( 'joomla.html.html.tabs' );
	$options = array(
		'onActive' => 'function(title, description){
			description.setStyle("display", "block");
			title.addClass("open").removeClass("closed");
		}',
		'onBackground' => 'function(title, description){
			description.setStyle("display", "none");
			title.addClass("closed").removeClass("open");
		}',
		'startOffset' => 0,
		'useCookie' => true
	);
	echo JHtml::_('tabs.start', 'tab_group_id', $options);
	
	echo JHtml::_('tabs.panel', JText::_('VRPANELONE'), 'panel_1_id');
	HTML_vikrentcar::pViewConfigOne();
	
	echo JHtml::_('tabs.panel', JText::_('VRPANELTWO'), 'panel_2_id');
	HTML_vikrentcar::pViewConfigTwo();
	
	echo JHtml::_('tabs.panel', JText::_('VRPANELTHREE'), 'panel_3_id');
	HTML_vikrentcar::pViewConfigThree();
	
	echo JHtml::_('tabs.panel', JText::_('VRPANELFOUR'), 'panel_4_id');
	HTML_vikrentcar::pViewConfigFour();
	
	echo JHtml::_('tabs.end');
	
	echo "<input type=\"hidden\" name=\"task\" value=\"\">\n";
	echo "<input type=\"hidden\" name=\"option\" value=\"".$option."\"/>\n</form>";
}

function saveConfig ($option) {
	$dbo = JFactory::getDBO();
	$session = JFactory::getSession();
	$pallowrent = VikRequest::getString('allowrent', '', 'request');
	$pdisabledrentmsg = VikRequest::getString('disabledrentmsg', '', 'request', VIKREQUEST_ALLOWHTML);
	$ptimeopenstorealw = VikRequest::getString('timeopenstorealw', '', 'request');
	$ptimeopenstorefh = VikRequest::getString('timeopenstorefh', '', 'request');
	$ptimeopenstorefm = VikRequest::getString('timeopenstorefm', '', 'request');
	$ptimeopenstoreth = VikRequest::getString('timeopenstoreth', '', 'request');
	$ptimeopenstoretm = VikRequest::getString('timeopenstoretm', '', 'request');
	$phoursmorerentback = VikRequest::getString('hoursmorerentback', '', 'request');
	$phoursmorecaravail = VikRequest::getString('hoursmorecaravail', '', 'request');
	$pplacesfront = VikRequest::getString('placesfront', '', 'request');
	$pdateformat = VikRequest::getString('dateformat', '', 'request');
	$ptimeformat = VikRequest::getString('timeformat', '', 'request');
	$pshowcategories = VikRequest::getString('showcategories', '', 'request');
	$pcharatsfilter = VikRequest::getString('charatsfilter', '', 'request');
	$pcharatsfilter = $pcharatsfilter == 'yes' ? 1 : 0;
	$pdamageshowtype = VikRequest::getInt('damageshowtype', '', 'request');
	$pdamageshowtype = $pdamageshowtype > 0 && $pdamageshowtype < 4 ? $pdamageshowtype : 1;
	$ptokenform = VikRequest::getString('tokenform', '', 'request');
	$padminemail = VikRequest::getString('adminemail', '', 'request');
	$psenderemail = VikRequest::getString('senderemail', '', 'request');
	$picalkey = VikRequest::getString('icalkey', '', 'request');
	$picalkey = str_replace(' ', '', $picalkey);
	$pminuteslock = VikRequest::getString('minuteslock', '', 'request');
	$pfooterordmail = VikRequest::getString('footerordmail', '', 'request', VIKREQUEST_ALLOWHTML);
	$prequirelogin = VikRequest::getString('requirelogin', '', 'request');
	$ploadjquery = VikRequest::getString('loadjquery', '', 'request');
	$ploadjquery = $ploadjquery == "yes" ? "1" : "0";
	$pcalendar = VikRequest::getString('calendar', '', 'request');
	$pcalendar = $pcalendar == "joomla" ? "joomla" : "jqueryui";
	$pehourschbasp = VikRequest::getString('ehourschbasp', '', 'request');
	$pehourschbasp = $pehourschbasp == "1" ? 1 : 0;
	$penablecoupons = VikRequest::getString('enablecoupons', '', 'request');
	$penablecoupons = $penablecoupons == "1" ? 1 : 0;
	$ptodaybookings = VikRequest::getString('todaybookings', '', 'request');
	$ptodaybookings = $ptodaybookings == "1" ? 1 : 0;
	$psetdropdplus = VikRequest::getString('setdropdplus', '', 'request');
	$psetdropdplus = !empty($psetdropdplus) ? intval($psetdropdplus) : '';
	$pmindaysadvance = VikRequest::getInt('mindaysadvance', '', 'request');
	$pmindaysadvance = $pmindaysadvance < 0 ? 0 : $pmindaysadvance;
	$pmaxdate = VikRequest::getString('maxdate', '', 'request');
	$pmaxdate = intval($pmaxdate) < 1 ? 2 : $pmaxdate;
	$pmaxdateinterval = VikRequest::getString('maxdateinterval', '', 'request');
	$pmaxdateinterval = !in_array($pmaxdateinterval, array('d', 'w', 'm', 'y')) ? 'y' : $pmaxdateinterval;
	$maxdate_str = '+'.$pmaxdate.$pmaxdateinterval;
	$pvrcsef = VikRequest::getInt('vrcsef', '', 'request');
	$vrcsef = file_exists(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'router.php');
	if($pvrcsef === 1) {
		if(!$vrcsef) {
			rename(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'_router.php', JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'router.php');
		}
	}else {
		if($vrcsef) {
			rename(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'router.php', JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'_router.php');
		}
	}
	$pmultilang = VikRequest::getString('multilang', '', 'request');
	$pmultilang = $pmultilang == "1" ? 1 : 0;
	$picon="";
	if (intval($_FILES['sitelogo']['error']) == 0 && trim($_FILES['sitelogo']['name'])!="") {
		jimport('joomla.filesystem.file');
		if (@is_uploaded_file($_FILES['sitelogo']['tmp_name'])) {
			$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['sitelogo']['name'])));
			if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
				$j=1;
				while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
					$j++;
				}
				$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
			}else {
				$j="";
				$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
			}
			@move_uploaded_file($_FILES['sitelogo']['tmp_name'], $pwhere);
			if(!getimagesize($pwhere)){
				@unlink($pwhere);
				$picon="";
			}else {
				@chmod($pwhere, 0644);
				$picon=$j.$safename;
			}
		}
		if (!empty($picon)) {
			$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($picon)." WHERE `param`='sitelogo';";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	if (empty($pallowrent) || $pallowrent!="1") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='allowrent';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='allowrent';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($pplacesfront) || $pplacesfront!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='placesfront';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='placesfront';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($pshowcategories) || $pshowcategories!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='showcategories';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='showcategories';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$pcharatsfilter." WHERE `param`='charatsfilter';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$pdamageshowtype." WHERE `param`='damageshowtype';";
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($ptokenform) || $ptokenform!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='tokenform';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='tokenform';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($pfooterordmail)." WHERE `param`='footerordmail';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($pdisabledrentmsg)." WHERE `param`='disabledrentmsg';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($padminemail)." WHERE `param`='adminemail';";
	$dbo->setQuery($q);
	$dbo->execute();
	//Sender email address
	$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='senderemail' LIMIT 1;";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$q = "UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($psenderemail)." WHERE `param`='senderemail';";
		$dbo->setQuery($q);
		$dbo->execute();
	} else {
		$q = "INSERT INTO `#__vikrentcar_config` (`param`,`setting`) VALUES ('senderemail',".$dbo->quote($psenderemail).");";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	//
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($picalkey)." WHERE `param`='icalkey';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$pmultilang."' WHERE `param`='multilang';";
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($pdateformat)) {
		$pdateformat="%d/%m/%Y";
	}
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pdateformat)." WHERE `param`='dateformat';";
	$dbo->setQuery($q);
	$dbo->execute();
	$session->set('getDateFormat', '');
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($ptimeformat)." WHERE `param`='timeformat';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pminuteslock)." WHERE `param`='minuteslock';";
	$dbo->setQuery($q);
	$dbo->execute();
	if (!empty($ptimeopenstorealw)) {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='' WHERE `param`='timeopenstore';";
	}else {
		$openingh=$ptimeopenstorefh * 3600;
		$openingm=$ptimeopenstorefm * 60;
		$openingts=$openingh + $openingm;
		$closingh=$ptimeopenstoreth * 3600;
		$closingm=$ptimeopenstoretm * 60;
		$closingts=$closingh + $closingm;
		if ($closingts <= $openingts) {
			$q="UPDATE `#__vikrentcar_config` SET `setting`='' WHERE `param`='timeopenstore';";
		}else {
			$q="UPDATE `#__vikrentcar_config` SET `setting`='".$openingts."-".$closingts."' WHERE `param`='timeopenstore';";
		}
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if (!ctype_digit($phoursmorerentback)) {
		$phoursmorerentback="0";
	}
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$phoursmorerentback."' WHERE `param`='hoursmorerentback';";
	$dbo->setQuery($q);
	$dbo->execute();
	if (!ctype_digit($phoursmorecaravail)) {
		$phoursmorecaravail="0";
	}
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$phoursmorecaravail."' WHERE `param`='hoursmorecaravail';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".($prequirelogin == "1" ? "1" : "0")."' WHERE `param`='requirelogin';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$ploadjquery."' WHERE `param`='loadjquery';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$pcalendar."' WHERE `param`='calendar';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$pehourschbasp."' WHERE `param`='ehourschbasp';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$penablecoupons."' WHERE `param`='enablecoupons';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$ptodaybookings."' WHERE `param`='todaybookings';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$psetdropdplus."' WHERE `param`='setdropdplus';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$pmindaysadvance."' WHERE `param`='mindaysadvance';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$maxdate_str."' WHERE `param`='maxdate';";
	$dbo->setQuery($q);
	$dbo->execute();
	
	$pfronttitle = VikRequest::getString('fronttitle', '', 'request');
	$pfronttitletag = VikRequest::getString('fronttitletag', '', 'request');
	$pfronttitletagclass = VikRequest::getString('fronttitletagclass', '', 'request');
	$psearchbtnval = VikRequest::getString('searchbtnval', '', 'request');
	$psearchbtnclass = VikRequest::getString('searchbtnclass', '', 'request');
	$pshowfooter = VikRequest::getString('showfooter', '', 'request');
	$pintromain = VikRequest::getString('intromain', '', 'request', VIKREQUEST_ALLOWHTML);
	$pclosingmain = VikRequest::getString('closingmain', '', 'request', VIKREQUEST_ALLOWHTML);
	$pcurrencyname = VikRequest::getString('currencyname', '', 'request', VIKREQUEST_ALLOWHTML);
	$pcurrencysymb = VikRequest::getString('currencysymb', '', 'request', VIKREQUEST_ALLOWHTML);
	$pcurrencycodepp = VikRequest::getString('currencycodepp', '', 'request');
	$pnumdecimals = VikRequest::getString('numdecimals', '', 'request');
	$pnumdecimals = intval($pnumdecimals);
	$pdecseparator = VikRequest::getString('decseparator', '', 'request');
	$pdecseparator = empty($pdecseparator) ? '.' : $pdecseparator;
	$pthoseparator = VikRequest::getString('thoseparator', '', 'request');
	$numberformatstr = $pnumdecimals.':'.$pdecseparator.':'.$pthoseparator;
	$pshowpartlyreserved = VikRequest::getString('showpartlyreserved', '', 'request');
	$pshowpartlyreserved = $pshowpartlyreserved == "yes" ? 1 : 0;
	$pnumcalendars = VikRequest::getInt('numcalendars', '', 'request');
	$pnumcalendars = $pnumcalendars > -1 ? $pnumcalendars : 3;
	$pthumbswidth = VikRequest::getInt('thumbswidth', '', 'request');
	$pthumbswidth = $pthumbswidth > 0 ? $pthumbswidth : 200;
	$pfirstwday = VikRequest::getString('firstwday', '', 'request');
	$pfirstwday = intval($pfirstwday) >= 0 && intval($pfirstwday) <= 6 ? $pfirstwday : '0';
	//Google Maps API Key
	$pgmapskey = VikRequest::getString('gmapskey', '', 'request');
	$q = "SELECT * FROM `#__vikrentcar_config` WHERE `param`='gmapskey';";
	$dbo->setQuery($q);
	$dbo->Query($q);
	if($dbo->getNumRows() > 0) {
		$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pgmapskey)." WHERE `param`='gmapskey';";
		$dbo->setQuery($q);
		$dbo->Query($q);
	}else {
		$q="INSERT INTO `#__vikrentcar_config` (`param`,`setting`) VALUES ('gmapskey', ".$dbo->quote($pgmapskey).");";
		$dbo->setQuery($q);
		$dbo->Query($q);
	}
	//theme
	$ptheme = VikRequest::getString('theme', '', 'request');
	if(empty($ptheme) || $ptheme == 'default') {
		$ptheme = 'default';
	}else {
		$validtheme = false;
		$themes = glob(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS.'*');
		if(count($themes) > 0) {
			$strip = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS;
			foreach($themes as $th) {
				if(is_dir($th)) {
					$tname = str_replace($strip, '', $th);
					if($tname == $ptheme) {
						$validtheme = true;
						break;
					}
				}
			}
		}
		if($validtheme == false) {
			$ptheme = 'default';
		}
	}
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($ptheme)." WHERE `param`='theme';";
	$dbo->setQuery($q);
	$dbo->execute();
	//
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pshowpartlyreserved)." WHERE `param`='showpartlyreserved';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pnumcalendars)." WHERE `param`='numcalendars';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pthumbswidth)." WHERE `param`='thumbswidth';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pfirstwday)." WHERE `param`='firstwday';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($pfronttitle)." WHERE `param`='fronttitle';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pfronttitletag)." WHERE `param`='fronttitletag';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pfronttitletagclass)." WHERE `param`='fronttitletagclass';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($psearchbtnval)." WHERE `param`='searchbtnval';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($psearchbtnclass)." WHERE `param`='searchbtnclass';";
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($pshowfooter) || $pshowfooter!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='showfooter';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='showfooter';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($pintromain)." WHERE `param`='intromain';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($pclosingmain)." WHERE `param`='closingmain';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pcurrencyname)." WHERE `param`='currencyname';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pcurrencysymb)." WHERE `param`='currencysymb';";
	$dbo->setQuery($q);
	$dbo->execute();
	$session->set('getCurrencySymb', '');
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pcurrencycodepp)." WHERE `param`='currencycodepp';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($numberformatstr)." WHERE `param`='numberformat';";
	$dbo->setQuery($q);
	$dbo->execute();
	
	$pivainclusa = VikRequest::getString('ivainclusa', '', 'request');
	$ptaxsummary = VikRequest::getString('taxsummary', '', 'request');
	$ptaxsummary = empty($ptaxsummary) || $ptaxsummary != "yes" ? "0" : "1";
	$pccpaypal = VikRequest::getString('ccpaypal', '', 'request');
	$ppaytotal = VikRequest::getString('paytotal', '', 'request');
	$ppayaccpercent = VikRequest::getString('payaccpercent', '', 'request');
	$ppaymentname = VikRequest::getString('paymentname', '', 'request');
	if (empty($pivainclusa) || $pivainclusa!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='ivainclusa';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='ivainclusa';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`='".$ptaxsummary."' WHERE `param`='taxsummary';";
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($ppaytotal) || $ppaytotal!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='paytotal';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='paytotal';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($pccpaypal)." WHERE `param`='ccpaypal';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($ppaymentname)." WHERE `param`='paymentname';";
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_config` SET `setting`=".$dbo->quote($ppayaccpercent)." WHERE `param`='payaccpercent';";
	$dbo->setQuery($q);
	$dbo->execute();
	
	$psendjutility = VikRequest::getString('sendjutility', '', 'request');
	$psendpdf = VikRequest::getString('sendpdf', '', 'request');
	$pallowstats = VikRequest::getString('allowstats', '', 'request');
	$psendmailstats = VikRequest::getString('sendmailstats', '', 'request');
	$pdisclaimer = VikRequest::getString('disclaimer', '', 'request', VIKREQUEST_ALLOWHTML);
	//Deprecated and Removed since VRC 1.11
	/*
	$poldorders = VikRequest::getString('oldorders', '', 'request');
	if (empty($poldorders) || $poldorders!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='oldorders';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='oldorders';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	*/
	//
	if (empty($psendjutility) || $psendjutility!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='sendjutility';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='sendjutility';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($psendpdf) || $psendpdf!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='sendpdf';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='sendpdf';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($pallowstats) || $pallowstats!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='allowstats';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='allowstats';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	if (empty($psendmailstats) || $psendmailstats!="yes") {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='0' WHERE `param`='sendmailstats';";
	}else {
		$q="UPDATE `#__vikrentcar_config` SET `setting`='1' WHERE `param`='sendmailstats';";
	}
	$dbo->setQuery($q);
	$dbo->execute();
	$q="UPDATE `#__vikrentcar_texts` SET `setting`=".$dbo->quote($pdisclaimer)." WHERE `param`='disclaimer';";
	$dbo->setQuery($q);
	$dbo->execute();
	
	$app = JFactory::getApplication();
	$app->enqueueMessage(JText::_('VRSETTINGSAVED'));
	goConfig($option);
}

function modAvail ($car, $option) {
	if (!empty($car)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `avail` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($car).";";
		$dbo->setQuery($q);
		$dbo->execute();
		$get = $dbo->loadAssocList();
		$q="UPDATE `#__vikrentcar_cars` SET `avail`='".(intval($get[0]['avail'])==1 ? 0 : 1)."' WHERE `id`=".$dbo->quote($car).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditing($option);
}

function updateBusy ($option) {
	$pidbusy = VikRequest::getString('idbusy', '', 'request');
	$pidorder = VikRequest::getInt('idorder', '', 'request');
	$preturn = VikRequest::getString('return', '', 'request');
	$porder_total = VikRequest::getString('order_total', '', 'request');
	$pnewidcar = VikRequest::getInt('newidcar', '', 'request');
	$pidplace = VikRequest::getInt('idplace', '', 'request');
	$pidreturnplace = VikRequest::getInt('idreturnplace', '', 'request');
	$ppickupdate = VikRequest::getString('pickupdate', '', 'request');
	$preleasedate = VikRequest::getString('releasedate', '', 'request');
	$ppickuph = VikRequest::getString('pickuph', '', 'request');
	$ppickupm = VikRequest::getString('pickupm', '', 'request');
	$preleaseh = VikRequest::getString('releaseh', '', 'request');
	$preleasem = VikRequest::getString('releasem', '', 'request');
	$pidcar = VikRequest::getString('idcar', '', 'request');
	$origidcar = $pidcar;
	if(!empty($pnewidcar) && $pnewidcar > 0) {
		$pidcar = $pnewidcar;
	}
	$pcustdata = VikRequest::getString('custdata', '', 'request');
	$pcustmail = VikRequest::getString('custmail', '', 'request');
	$pareprices = VikRequest::getString('areprices', '', 'request');
	$ppriceid = VikRequest::getString('priceid', '', 'request');
	$ptotpaid = VikRequest::getString('totpaid', '', 'request');
	//VikRentCar 1.7
	$pstandbyquick = VikRequest::getString('standbyquick', '', 'request');
	$pstandbyquick = $pstandbyquick == "1" ? 1 : 0;
	$pnotifycust = VikRequest::getString('notifycust', '', 'request');
	$pnotifycust = $pnotifycust == "1" ? 1 : 0;
	//
	$pcust_cost = VikRequest::getFloat('cust_cost', '', 'request');
	$paliq = VikRequest::getInt('aliq', '', 'request');
	$pextracn = VikRequest::getVar('extracn', array());
	$pextracc = VikRequest::getVar('extracc', array());
	$pextractx = VikRequest::getVar('extractx', array());
	$dbo = JFactory::getDBO();
	$actnow=time();
	$nowdf = vikrentcar::getDateFormat(true);
	if ($nowdf=="%d/%m/%Y") {
		$df='d/m/Y';
	}elseif ($nowdf=="%m/%d/%Y") {
		$df='m/d/Y';
	}else {
		$df='Y/m/d';
	}
	if (!empty($pidorder)) {
		$first=vikrentcar::getDateTimestamp($ppickupdate, $ppickuph, $ppickupm);
		$second=vikrentcar::getDateTimestamp($preleasedate, $preleaseh, $preleasem);
		if ($second > $first) {
			$q="SELECT `units` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($pidcar).";";
			$dbo->setQuery($q);
			$dbo->execute();
			$units=$dbo->loadResult();
			//vikrentcar 1.5
			$checkhourly = false;
			$hoursdiff = 0;
			$secdiff=$second - $first;
			$daysdiff=$secdiff / 86400;
			if (is_int($daysdiff)) {
				if ($daysdiff < 1) {
					$daysdiff=1;
				}
			}else {
				if ($daysdiff < 1) {
					$daysdiff=1;
					$checkhourly = true;
					$ophours = $secdiff / 3600;
					$hoursdiff = intval(round($ophours));
					if($hoursdiff < 1) {
						$hoursdiff = 1;
					}
				}else {
					$sum=floor($daysdiff) * 86400;
					$newdiff=$secdiff - $sum;
					$maxhmore=vikrentcar::getHoursMoreRb() * 3600;
					if ($maxhmore >= $newdiff) {
						$daysdiff=floor($daysdiff);
					}else {
						$daysdiff=ceil($daysdiff);
					}
				}
			}
			$groupdays = vikrentcar::getGroupDays($first, $second, $daysdiff);
			$opertwounits=true;
			$check = "SELECT `id`,`ritiro`,`realback`,`stop_sales` FROM `#__vikrentcar_busy` WHERE `idcar`='" . $pidcar . "' AND `id`!=".$dbo->quote($pidbusy).";";
			$dbo->setQuery($check);
			$dbo->execute();
			if ($dbo->getNumRows() > 0) {
				$busy = $dbo->loadAssocList();
				foreach ($groupdays as $gday) {
					$bfound = 0;
					foreach ($busy as $bu) {
						if ($gday >= $bu['ritiro'] && $gday <= $bu['realback']) {
							$bfound++;
							if($bu['stop_sales'] == 1) {
								$bfound = $units;
								break;
							}
						}elseif(count($groupdays) == 2 && $gday == $groupdays[0]) {
							//VRC 1.7
							if($groupdays[0] < $bu['ritiro'] && $groupdays[0] < $bu['realback'] && $groupdays[1] > $bu['ritiro'] && $groupdays[1] > $bu['realback']) {
								$bfound++;
								if($bu['stop_sales'] == 1) {
									$bfound = $units;
									break;
								}
							}
						}
					}
					if ($bfound >= $units) {
						$opertwounits=false;
					}
				}
			}
			//
			if (vikrentcar::carNotLocked($pidcar, $units, $first, $second)) {
				if ($opertwounits) {
					$doup=false;
					//vikrentcar 1.5
					if($checkhourly) {
						$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `idcar`='".$pidcar."' AND `hours`='".$hoursdiff."' AND `idprice`='".$ppriceid."';";
					}else {
						$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$pidcar."' AND `days`='".$daysdiff."' AND `idprice`='".$ppriceid."';";
					}
					//
					$dbo->setQuery($q);
					$dbo->execute();
					if ($dbo->getNumRows() == 1) {
						$dispcost = $dbo->loadAssocList();
						//vikrentcar 1.5
						if($checkhourly) {
							foreach($dispcost as $kt => $vt) {
								$dispcost[$kt]['days'] = 1;
							}
						}
						$doup=true;
					}else {
						//there are no hourly prices
						if($checkhourly) {
							$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$pidcar."' AND `days`='".$daysdiff."' AND `idprice`='".$ppriceid."';";
							$dbo->setQuery($q);
							$dbo->execute();
							if ($dbo->getNumRows() == 1) {
								$dispcost = $dbo->loadAssocList();
								$doup=true;
							}
						}
					}
					//VRC 1.11 Custom Rate
					$set_custom_rate = 0;
					if(!$doup && empty($ppriceid) && !empty($pcust_cost) && floatval($pcust_cost) > 0) {
						$doup = true;
						$set_custom_rate = $pcust_cost;
					}
					//
					if ($doup === true || intval($pidcar) != intval($origidcar)) {
						$realback=vikrentcar::getHoursCarAvail() * 3600;
						$realback+=$second;
						if(!empty($pidbusy)) {
							$q="UPDATE `#__vikrentcar_busy` SET `idcar`=".(int)$pidcar.",`ritiro`='".$first."', `consegna`='".$second."', `realback`='".$realback."' WHERE `id`=".$dbo->quote($pidbusy).";";
							$dbo->setQuery($q);
							$dbo->execute();
						}
						$q="SELECT * FROM `#__vikrentcar_orders` WHERE `id`=".$pidorder.";";
						$dbo->setQuery($q);
						$dbo->execute();
						if (@$dbo->getNumRows() == 1) {
							$orderdata = $dbo->loadAssocList();
							$qfinal="UPDATE `#__vikrentcar_orders` SET `custdata`=".$dbo->quote($pcustdata).", `idcar`=".(int)$pidcar.", `days`='".$daysdiff."', `ritiro`='".$first."', `consegna`='".$second."'";
							if (@is_array($dispcost) && $doup === true && empty($set_custom_rate)) {
								$qfinal.=", `idtar`='".$dispcost[0]['id']."'";
							}elseif ($set_custom_rate > 0) {
								$qfinal.=", `idtar`=NULL, `cust_cost`=".$dbo->quote($set_custom_rate).(!empty($paliq) ? ", `cust_idiva`=".(int)$paliq : '');
							}elseif ($doup === false) {
								$qfinal.=", `idtar`=NULL";
								if(intval($pidcar) != intval($origidcar)) {
									VikError::raiseNotice('', JText::_('VRCUPDBUSYCARSWITCHED'));
								}
							}
							$q="SELECT * FROM `#__vikrentcar_optionals`;";
							$dbo->setQuery($q);
							$dbo->execute();
							if ($dbo->getNumRows() > 0) {
								$toptionals=$dbo->loadAssocList();
								foreach($toptionals as $opt){
									$tmpvar=VikRequest::getString('optid'.$opt['id'], '', 'request');
									if (!empty($tmpvar)) {
										$wop.=$opt['id'].":".$tmpvar.";";
									}
								}
								if (strlen($wop)) {
									$qfinal.=", `optionals`='".$wop."'";
								}
							}
							$qfinal.=", `custmail`=".$dbo->quote($pcustmail)."";
							if($pidplace != $orderdata[0]['idplace']) {
								$qfinal.=", `idplace`='".$pidplace."'";
							}
							if($pidreturnplace != $orderdata[0]['idreturnplace']) {
								$qfinal.=", `idreturnplace`='".$pidreturnplace."'";
							}
							if (strlen($ptotpaid) > 0) {
								$qfinal.=", `totpaid`='".floatval($ptotpaid)."'";
							}else {
								$qfinal.=", `totpaid`=null";
							}
							//calculate the extra costs and increase taxes + isdue
							$extracosts_arr = array();
							if(count($pextracn) > 0) {
								foreach ($pextracn as $eck => $ecn) {
									if(strlen($ecn) > 0 && array_key_exists($eck, $pextracc) && floatval($pextracc[$eck]) >= 0.00) {
										$ecidtax = array_key_exists($eck, $pextractx) && intval($pextractx[$eck]) > 0 ? (int)$pextractx[$eck] : '';
										$extracosts_arr[] = array('name' => $ecn, 'cost' => (float)$pextracc[$eck], 'idtax' => $ecidtax);
										$ecplustax = !empty($ecidtax) ? vikrentcar::sayOptionalsPlusIva((float)$pextracc[$eck], $ecidtax, $orderdata[0]) : (float)$pextracc[$eck];
										$ecminustax = !empty($ecidtax) ? vikrentcar::sayOptionalsMinusIva((float)$pextracc[$eck], $ecidtax, $orderdata[0]) : (float)$pextracc[$eck];
										$ectottax = (float)$pextracc[$eck] - $ecminustax;
									}
								}
							}
							if(count($extracosts_arr) > 0) {
								$qfinal.=", `extracosts`=".$dbo->quote(json_encode($extracosts_arr));
							}else {
								$qfinal.=", `extracosts`=NULL";
							}
							//end extra costs
							if (strlen($porder_total) > 0) {
								//The order total amount should be manually entered when altering the order.
								$qfinal.=", `order_total`='".floatval($porder_total)."'";
							}
							$qfinal.=" WHERE `id`='".$orderdata[0]['id']."';";
							$dbo->setQuery($qfinal);
							$dbo->execute();
							$app = JFactory::getApplication();
							$app->enqueueMessage(JText::_('RESUPDATED'));
							//VikRentCar 1.7
							if ($pstandbyquick == 1) {
								//remove busy because this is an order from quick reservation with standby status
								$q="DELETE FROM `#__vikrentcar_busy` WHERE `id`='".$pidbusy."';";
								$dbo->setQuery($q);
								$dbo->execute();
								$q="UPDATE `#__vikrentcar_orders` SET `idbusy`=null WHERE `id`='".$orderdata[0]['id']."';";
								$dbo->setQuery($q);
								$dbo->execute();
							}
							if ($pnotifycust == 1) {
								resendOrderEmail($orderdata[0]['id'], $option, true);
								return;
							}
							//
						}
					}
				}else {
					VikError::raiseWarning('', JText::_('VRCARNOTRIT')." ".date($df.' H:i', $first)." ".JText::_('VRCARNOTCONSTO')." ".date($df.' H:i', $second));
				}
			}else {
				VikError::raiseWarning('', JText::_('ERRCARLOCKED'));
			}
		}else {
			VikError::raiseWarning('', JText::_('ERRPREV'));
		}
		$mainframe = JFactory::getApplication();
		if(intval($pidcar) != intval($origidcar)) {
			$mainframe->redirect("index.php?option=".$option."&task=editbusy&return=".$preturn."&cid[]=".$pidorder);
		}elseif($preturn == 'order') {
			$mainframe->redirect("index.php?option=".$option."&task=editorder&cid[]=".$pidorder);
		}else {
			$mainframe->redirect("index.php?option=".$option."&task=calendar&cid[]=".$pidcar);
		}
	}else {
		cancelEditing($option);
	}
}

function removeTariffe ($ids, $option) {
	$pcarid = VikRequest::getString('carid', '', 'request');
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $r){
			$x=explode(";", $r);
			foreach($x as $rm){
				if (!empty($rm)) {
					$q="DELETE FROM `#__vikrentcar_dispcost` WHERE `id`=".$dbo->quote($rm).";";
					$dbo->setQuery($q);
					$dbo->execute();
				}
			}
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewtariffe&cid[]=".$pcarid);
}

function removeTariffeHours ($ids, $option) {
	$pcarid = VikRequest::getString('carid', '', 'request');
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $r){
			$x=explode(";", $r);
			foreach($x as $rm){
				if (!empty($rm)) {
					$q="DELETE FROM `#__vikrentcar_dispcosthours` WHERE `id`=".$dbo->quote($rm).";";
					$dbo->setQuery($q);
					$dbo->execute();
				}
			}
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewtariffehours&cid[]=".$pcarid);
}

function removeHoursCharges ($ids, $option) {
	$pcarid = VikRequest::getString('carid', '', 'request');
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $r){
			$x=explode(";", $r);
			foreach($x as $rm){
				if (!empty($rm)) {
					$q="DELETE FROM `#__vikrentcar_hourscharges` WHERE `id`=".$dbo->quote($rm).";";
					$dbo->setQuery($q);
					$dbo->execute();
				}
			}
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewhourscharges&cid[]=".$pcarid);
}

function editBusy ($oid, $option) {
	$dbo = JFactory::getDBO();
	if (!empty($oid)) {
		$q="SELECT * FROM `#__vikrentcar_orders` WHERE `id`=".$dbo->quote($oid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$ord = $dbo->loadAssocList();
			$q="SELECT * FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allcars = $dbo->loadAssocList();
			$carrows = array(0 => array());
			foreach ($allcars as $ck => $cv) {
				if($cv['id'] == $ord[0]['idcar']) {
					$carrows[0] = $allcars[$ck];
					break;
				}
			}
			$busy = array(0 => array());
			if(!empty($ord[0]['idbusy'])) {
				$q="SELECT * FROM `#__vikrentcar_busy` WHERE `id`='".$ord[0]['idbusy']."';";
				$dbo->setQuery($q);
				$dbo->execute();
				if ($dbo->getNumRows() == 1) {
					$busy = $dbo->loadAssocList();
				}
			}
			$q="SELECT `id`,`name` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$locations = $dbo->getNumRows() > 0 ? $dbo->loadAssocList() : array();
			HTML_vikrentcar::printHeaderBusy($carrows[0]);
			HTML_vikrentcar::pEditBusy($busy[0], $ord, $carrows[0], $allcars, $locations, $option);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function viewCalendar ($aid, $option) {
	//vikrentcar 1.6
	if (empty($aid)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `id` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC LIMIT 1";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$aid = $dbo->loadResult();
		}
	}
	//
	if (!empty($aid)) {
		session_start();
		$pvmode = VikRequest::getString('vmode', '', 'request');
		if (!empty($pvmode) && ctype_digit($pvmode)) {
			unset($_SESSION['vikrentcarvmode']);
			$_SESSION['vikrentcarvmode']=$pvmode;
		}elseif (!isset($_SESSION['vikrentcarvmode'])) {
			$_SESSION['vikrentcarvmode']="3";
		}
		$hmany=$_SESSION['vikrentcarvmode'];
		$dbo = JFactory::getDBO();
		$q="SELECT `id`,`name`,`img`,`idplace`,`units`,`idretplace` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($aid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$carrows = $dbo->loadAssocList();
			$calmsg="";
			$actnow=time();
			$ppickupdate = VikRequest::getString('pickupdate', '', 'request');
			$preleasedate = VikRequest::getString('releasedate', '', 'request');
			$ppickuph = VikRequest::getString('pickuph', '', 'request');
			$ppickupm = VikRequest::getString('pickupm', '', 'request');
			$preleaseh = VikRequest::getString('releaseh', '', 'request');
			$preleasem = VikRequest::getString('releasem', '', 'request');
			$pcustdata = VikRequest::getString('custdata', '', 'request');
			$pcustmail = VikRequest::getString('custmail', '', 'request');
			$pordstatus = VikRequest::getString('ordstatus', '', 'request');
			$pstop_sales = VikRequest::getInt('stop_sales', '', 'request');
			$pstop_sales = $pstop_sales == 1 ? 1 : 0;
			$pordstatus = (empty($pordstatus) || !in_array($pordstatus, array('confirmed', 'standby') || $pstop_sales == 1) ? 'confirmed' : $pordstatus);
			$ppaymentid = VikRequest::getString('paymentid', '', 'request');
			$pnotifycust = VikRequest::getString('notifycust', '', 'request');
			$pnotifycust = $pnotifycust == "1" ? 1 : 0;
			$ppickuploc = VikRequest::getString('pickuploc', '', 'request');
			$pdropoffloc = VikRequest::getString('dropoffloc', '', 'request');
			$pcust_cost = VikRequest::getFloat('cust_cost', 0, 'request');
			$ptaxid = VikRequest::getInt('taxid', '', 'request');
			if (!empty($ppickupdate) && !empty($preleasedate)) {
				if (vikrentcar::dateIsValid($ppickupdate) && vikrentcar::dateIsValid($preleasedate)) {
					$first=vikrentcar::getDateTimestamp($ppickupdate, $ppickuph, $ppickupm);
					$second=vikrentcar::getDateTimestamp($preleasedate, $preleaseh, $preleasem);
					$checkhourly = false;
					$hoursdiff = 0;
					if ($second > $first) {
						$secdiff=$second - $first;
						$daysdiff=$secdiff / 86400;
						if (is_int($daysdiff)) {
							if ($daysdiff < 1) {
								$daysdiff=1;
							}
						}else {
							if ($daysdiff < 1) {
								$daysdiff=1;
								$checkhourly = true;
								$ophours = $secdiff / 3600;
								$hoursdiff = intval(round($ophours));
								if($hoursdiff < 1) {
									$hoursdiff = 1;
								}
							}else {
								$sum=floor($daysdiff) * 86400;
								$newdiff=$secdiff - $sum;
								$maxhmore=vikrentcar::getHoursMoreRb() * 3600;
								if ($maxhmore >= $newdiff) {
									$daysdiff=floor($daysdiff);
								}else {
									$daysdiff=ceil($daysdiff);
								}
							}
						}
						//if the car is totally booked or locked because someone is paying, the administrator is not able to make a reservation for that car  
						if (vikrentcar::carBookable($carrows[0]['id'], $carrows[0]['units'], $first, $second) && vikrentcar::carNotLocked($carrows[0]['id'], $carrows[0]['units'], $first, $second)) {
							$realback=vikrentcar::getHoursCarAvail() * 3600;
							$realback+=$second;
							$q="INSERT INTO `#__vikrentcar_busy` (`idcar`,`ritiro`,`consegna`,`realback`,`stop_sales`) VALUES('".$carrows[0]['id']."','".$first."','".$second."','".$realback."', ".$pstop_sales.");";
							$dbo->setQuery($q);
							$dbo->execute();
							$lid = $dbo->insertid();
							if (!empty($lid)) {
								$sid=vikrentcar::getSecretLink();
								//VRC 1.7 Rev.2
								$locationvat = '';
								$q="SELECT `p`.`name`,`i`.`aliq` FROM `#__vikrentcar_places` AS `p` LEFT JOIN `#__vikrentcar_iva` `i` ON `p`.`idiva`=`i`.`id` WHERE `p`.`id`='".intval($ppickuploc)."';";
								$dbo->setQuery($q);
								$dbo->execute();
								if ($dbo->getNumRows() > 0) {
									$getdata = $dbo->loadAssocList();
									if (!empty($getdata[0]['aliq'])) {
										$locationvat = $getdata[0]['aliq'];
									}
								}
								//
								$set_total = $pcust_cost > 0 ? $pcust_cost : 0;
								$q="INSERT INTO `#__vikrentcar_orders` (`idbusy`,`custdata`,`ts`,`status`,`idcar`,`days`,`ritiro`,`consegna`,`custmail`,`sid`,`idplace`,`idreturnplace`,`idpayment`,`hourly`,`order_total`,`locationvat`,`cust_cost`,`cust_idiva`) VALUES('".$lid."',".$dbo->quote($pcustdata).",'".$actnow."','".$pordstatus."','".$carrows[0]['id']."','".$daysdiff."','".$first."','".$second."',".$dbo->quote($pcustmail).",'".$sid."',".(!empty($ppickuploc) ? "'".$ppickuploc."'" : "null").",".(!empty($pdropoffloc) ? "'".$pdropoffloc."'" : "null").",".$dbo->quote($ppaymentid).",'".($checkhourly ? "1" : "0")."', ".($set_total > 0 ? $dbo->quote($set_total) : "null").", ".(strlen($locationvat) > 0 ? "'".$locationvat."'" : "null").", ".($pcust_cost > 0 ? $dbo->quote($pcust_cost) : "null").", ".($pcust_cost > 0 && !empty($ptaxid) ? $dbo->quote($ptaxid) : "null").");";
								$dbo->setQuery($q);
								$dbo->execute();
								$lid = $dbo->insertid();
								$calmsg="1";
								//VikRentCar 1.7
								if ($pordstatus == 'standby') {
									$app = JFactory::getApplication();
									$app->enqueueMessage(JText::_('VRCQUICKRESWARNSTANDBY').($pnotifycust == 1 ? JText::_('VRCQUICKRESWARNSTANDBYSENDMAIL') : ""));
									$mainframe = JFactory::getApplication();
									$mainframe->redirect("index.php?option=".$option."&task=editbusy&cid[]=".$lid."&standbyquick=1&notifycust=".$pnotifycust);
								}else {
									if ($pnotifycust == 1) {
										$app = JFactory::getApplication();
										$app->enqueueMessage(JText::_('VRCQUICKRESWARNCONFIRMED'));
										$mainframe = JFactory::getApplication();
										$mainframe->redirect("index.php?option=".$option."&task=editbusy&cid[]=".$lid."&confirmedquick=1&notifycust=".$pnotifycust);
									}
								}
								//
							}
						}else {
							$calmsg="0";
						}
					}else {
						VikError::raiseWarning('', 'Invalid Dates: Right now it is '.date('Y/m/d H:i', $actnow).' and you wanted to make a reservation from the '.date('Y/m/d H:i', $first).' to the '.date('Y/m/d H:i', $second));
					}
				}else {
					VikError::raiseWarning('', 'Invalid Dates');
				}
			}
			
			$q="SELECT `b`.*,`o`.`id` AS `idorder` FROM `#__vikrentcar_busy` AS `b` LEFT JOIN `#__vikrentcar_orders` `o` ON `b`.`id`=`o`.`idbusy` WHERE `b`.`idcar`='".$carrows[0]['id']."' AND (`b`.`ritiro`>=".$actnow." OR `b`.`consegna`>=".$actnow.");";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() > 0) {
				$busy = $dbo->loadAssocList();
			}else {
				$busy="";
			}
			$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allc=$dbo->loadAssocList();
			$q="SELECT `id`,`name` FROM `#__vikrentcar_gpayments` WHERE `published`='1' ORDER BY `#__vikrentcar_gpayments`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allpayments=$dbo->loadAssocList();
			$q="SELECT `id`,`name` FROM `#__vikrentcar_custfields` WHERE `type`!='separator' ORDER BY `#__vikrentcar_custfields`.`ordering` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allcustomf=$dbo->loadAssocList();
			$pickuparr = array();
			$dropoffarr = array();
			$pickupids = explode(";", $carrows[0]['idplace']);
			$dropoffids = explode(";", $carrows[0]['idretplace']);
			if (count($pickupids) > 0) {
				foreach($pickupids as $k => $pick) {
					if (empty($pick)) {
						unset($pickupids[$k]);
					}
				}
				if (count($pickupids) > 0) {
					$q="SELECT `id`,`name` FROM `#__vikrentcar_places` WHERE `id` IN (".implode(", ", $pickupids).");";
					$dbo->setQuery($q);
					$dbo->execute();
					$pickuparr=$dbo->loadAssocList();
				}
			}
			if (count($dropoffids) > 0) {
				foreach($dropoffids as $k => $drop) {
					if (empty($drop)) {
						unset($dropoffids[$k]);
					}
				}
				if (count($dropoffids) > 0) {
					$q="SELECT `id`,`name` FROM `#__vikrentcar_places` WHERE `id` IN (".implode(", ", $dropoffids).");";
					$dbo->setQuery($q);
					$dbo->execute();
					$dropoffarr=$dbo->loadAssocList();
				}
			}
			HTML_vikrentcar::printHeaderCalendar($carrows[0], $calmsg, $allc, $allpayments, $allcustomf, $pickuparr, $dropoffarr);
			HTML_vikrentcar::pViewCalendar($carrows[0], $busy, $hmany, $option);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function viewTariffe ($aid, $option) {
	//vikrentcar 1.6
	if (empty($aid)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `id` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC LIMIT 1";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$aid = $dbo->loadResult();
		}
	}
	//
	if (!empty($aid)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `id`,`name`,`img` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($aid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$carrows = $dbo->loadAssocList();
			$q="SELECT * FROM `#__vikrentcar_prices`;";
			$dbo->setQuery($q);
			$dbo->execute();
			$prices=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
			$pnewtar = VikRequest::getString('newdispcost', '', 'request');
			$pddaysfrom = VikRequest::getString('ddaysfrom', '', 'request');
			$pddaysto = VikRequest::getString('ddaysto', '', 'request');
			if (!empty($pnewtar) && !empty($pddaysfrom) && is_array($prices)) {
				if(empty($pddaysto) || $pddaysfrom==$pddaysto) {
					foreach($prices as $pr){
						$tmpvarone=VikRequest::getString('dprice'.$pr['id'], '', 'request');
						if (!empty($tmpvarone)) {
							$tmpvartwo=VikRequest::getString('dattr'.$pr['id'], '', 'request');
							$multipattr=is_numeric($tmpvartwo) ? true : false;
							$safeq="SELECT `id` FROM `#__vikrentcar_dispcost` WHERE `days`=".$dbo->quote($pddaysfrom)." AND `idcar`='".$carrows[0]['id']."' AND `idprice`='".$pr['id']."';";
							$dbo->setQuery($safeq);
							$dbo->execute();
							if ($dbo->getNumRows() == 0) {
								$q="INSERT INTO `#__vikrentcar_dispcost` (`idcar`,`days`,`idprice`,`cost`,`attrdata`) VALUES('".$carrows[0]['id']."',".$dbo->quote($pddaysfrom).",'".$pr['id']."','".($tmpvarone * $pddaysfrom)."',".($multipattr ? "'".($tmpvartwo  * $pddaysfrom)."'" : $dbo->quote($tmpvartwo)).");";
								$dbo->setQuery($q);
								$dbo->execute();
							}
						}
					}
				}else {
					for($i=intval($pddaysfrom); $i<=intval($pddaysto); $i++) {
						foreach($prices as $pr){
							$tmpvarone=VikRequest::getString('dprice'.$pr['id'], '', 'request');
							if (!empty($tmpvarone)) {
								$tmpvartwo=VikRequest::getString('dattr'.$pr['id'], '', 'request');
								$multipattr=is_numeric($tmpvartwo) ? true : false;
								$safeq="SELECT `id` FROM `#__vikrentcar_dispcost` WHERE `days`=".$dbo->quote($i)." AND `idcar`='".$carrows[0]['id']."' AND `idprice`='".$pr['id']."';";
								$dbo->setQuery($safeq);
								$dbo->execute();
								if ($dbo->getNumRows() == 0) {
									$q="INSERT INTO `#__vikrentcar_dispcost` (`idcar`,`days`,`idprice`,`cost`,`attrdata`) VALUES('".$carrows[0]['id']."',".$dbo->quote($i).",'".$pr['id']."','".($tmpvarone * $i)."',".($multipattr ? "'".($tmpvartwo  * $i)."'" : $dbo->quote($tmpvartwo)).");";
									$dbo->setQuery($q);
									$dbo->execute();
								}
							}
						}
					}
				}
			}
			$q="SELECT * FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$carrows[0]['id']."' ORDER BY `#__vikrentcar_dispcost`.`days` ASC, `#__vikrentcar_dispcost`.`idprice` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$lines = ($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
			$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allc=$dbo->loadAssocList();
			HTML_vikrentcar::printHeaderCar($carrows[0]['img'], $carrows[0]['name'], $prices, $carrows[0]['id'], $allc);
			HTML_vikrentcar::pViewTariffe($carrows[0], $lines, $option);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function viewTariffeHours ($aid, $option) {
	if (!empty($aid)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `id`,`name`,`img` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($aid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$carrows = $dbo->loadAssocList();
			$q="SELECT * FROM `#__vikrentcar_prices`;";
			$dbo->setQuery($q);
			$dbo->execute();
			$prices=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
			$pnewtar = VikRequest::getString('newdispcost', '', 'request');
			$phhoursfrom = VikRequest::getString('hhoursfrom', '', 'request');
			$phhoursto = VikRequest::getString('hhoursto', '', 'request');
			//maximum 23 hours
			if(intval($phhoursfrom) > 23) {
				$phhoursfrom = 23;
			}
			if(intval($phhoursto) > 23) {
				$phhoursto = 23;
			}
			//
			if (!empty($pnewtar) && !empty($phhoursfrom) && is_array($prices)) {
				if(empty($phhoursto) || $phhoursfrom==$phhoursto) {
					foreach($prices as $pr){
						$tmpvarone=VikRequest::getString('hprice'.$pr['id'], '', 'request');
						if (!empty($tmpvarone)) {
							$tmpvartwo=VikRequest::getString('hattr'.$pr['id'], '', 'request');
							$multipattr=is_numeric($tmpvartwo) ? true : false;
							$safeq="SELECT `id` FROM `#__vikrentcar_dispcosthours` WHERE `hours`=".$dbo->quote($phhoursfrom)." AND `idcar`='".$carrows[0]['id']."' AND `idprice`='".$pr['id']."';";
							$dbo->setQuery($safeq);
							$dbo->execute();
							if ($dbo->getNumRows() == 0) {
								$q="INSERT INTO `#__vikrentcar_dispcosthours` (`idcar`,`hours`,`idprice`,`cost`,`attrdata`) VALUES('".$carrows[0]['id']."',".$dbo->quote($phhoursfrom).",'".$pr['id']."','".($tmpvarone * $phhoursfrom)."',".($multipattr ? "'".($tmpvartwo * $phhoursfrom)."'" : $dbo->quote($tmpvartwo)).");";
								$dbo->setQuery($q);
								$dbo->execute();
							}
						}
					}
				}else {
					for($i=intval($phhoursfrom); $i<=intval($phhoursto); $i++) {
						foreach($prices as $pr){
							$tmpvarone=VikRequest::getString('hprice'.$pr['id'], '', 'request');
							if (!empty($tmpvarone)) {
								$tmpvartwo=VikRequest::getString('hattr'.$pr['id'], '', 'request');
								$multipattr=is_numeric($tmpvartwo) ? true : false;
								$safeq="SELECT `id` FROM `#__vikrentcar_dispcosthours` WHERE `hours`=".$dbo->quote($i)." AND `idcar`='".$carrows[0]['id']."' AND `idprice`='".$pr['id']."';";
								$dbo->setQuery($safeq);
								$dbo->execute();
								if ($dbo->getNumRows() == 0) {
									$q="INSERT INTO `#__vikrentcar_dispcosthours` (`idcar`,`hours`,`idprice`,`cost`,`attrdata`) VALUES('".$carrows[0]['id']."',".$dbo->quote($i).",'".$pr['id']."','".($tmpvarone * $i)."',".($multipattr ? "'".($tmpvartwo * $i)."'" : $dbo->quote($tmpvartwo)).");";
									$dbo->setQuery($q);
									$dbo->execute();
								}
							}
						}
					}
				}
			}
			$q="SELECT * FROM `#__vikrentcar_dispcosthours` WHERE `idcar`='".$carrows[0]['id']."' ORDER BY `#__vikrentcar_dispcosthours`.`hours` ASC, `#__vikrentcar_dispcosthours`.`idprice` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$lines = ($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
			$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allc=$dbo->loadAssocList();
			HTML_vikrentcar::printHeaderCarHours($carrows[0]['img'], $carrows[0]['name'], $prices, $carrows[0]['id'], $allc);
			HTML_vikrentcar::pViewTariffeHours($carrows[0], $lines, $option);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function viewHoursCharges ($aid, $option) {
	if (!empty($aid)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `id`,`name`,`img` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($aid).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$carrows = $dbo->loadAssocList();
			$q="SELECT * FROM `#__vikrentcar_prices`;";
			$dbo->setQuery($q);
			$dbo->execute();
			$prices=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
			$pnewtar = VikRequest::getString('newdispcost', '', 'request');
			$phhoursfrom = VikRequest::getString('hhoursfrom', '', 'request');
			$phhoursto = VikRequest::getString('hhoursto', '', 'request');
			//maximum 23 hours
			if(intval($phhoursfrom) > 23) {
				$phhoursfrom = 23;
			}
			if(intval($phhoursto) > 23) {
				$phhoursto = 23;
			}
			//
			if (!empty($pnewtar) && !empty($phhoursfrom) && is_array($prices)) {
				if(empty($phhoursto) || $phhoursfrom==$phhoursto) {
					foreach($prices as $pr){
						$tmpvarone=VikRequest::getString('hprice'.$pr['id'], '', 'request');
						if (!empty($tmpvarone)) {
							$safeq="SELECT `id` FROM `#__vikrentcar_hourscharges` WHERE `ehours`=".$dbo->quote($phhoursfrom)." AND `idcar`='".$carrows[0]['id']."' AND `idprice`='".$pr['id']."';";
							$dbo->setQuery($safeq);
							$dbo->execute();
							if ($dbo->getNumRows() == 0) {
								$q="INSERT INTO `#__vikrentcar_hourscharges` (`idcar`,`ehours`,`idprice`,`cost`) VALUES('".$carrows[0]['id']."',".$dbo->quote($phhoursfrom).",'".$pr['id']."','".($tmpvarone * $phhoursfrom)."');";
								$dbo->setQuery($q);
								$dbo->execute();
							}
						}
					}
				}else {
					for($i=intval($phhoursfrom); $i<=intval($phhoursto); $i++) {
						foreach($prices as $pr){
							$tmpvarone=VikRequest::getString('hprice'.$pr['id'], '', 'request');
							if (!empty($tmpvarone)) {
								$safeq="SELECT `id` FROM `#__vikrentcar_hourscharges` WHERE `ehours`='".$i."' AND `idcar`='".$carrows[0]['id']."' AND `idprice`='".$pr['id']."';";
								$dbo->setQuery($safeq);
								$dbo->execute();
								if ($dbo->getNumRows() == 0) {
									$q="INSERT INTO `#__vikrentcar_hourscharges` (`idcar`,`ehours`,`idprice`,`cost`) VALUES('".$carrows[0]['id']."','".$i."','".$pr['id']."','".($tmpvarone * $i)."');";
									$dbo->setQuery($q);
									$dbo->execute();
								}
							}
						}
					}
				}
			}
			$q="SELECT * FROM `#__vikrentcar_hourscharges` WHERE `idcar`='".$carrows[0]['id']."' ORDER BY `#__vikrentcar_hourscharges`.`ehours` ASC, `#__vikrentcar_hourscharges`.`idprice` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$lines = ($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
			$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` ORDER BY `#__vikrentcar_cars`.`name` ASC;";
			$dbo->setQuery($q);
			$dbo->execute();
			$allc=$dbo->loadAssocList();
			HTML_vikrentcar::printHeaderCarHoursCharges($carrows[0]['img'], $carrows[0]['name'], $prices, $carrows[0]['id'], $allc);
			HTML_vikrentcar::pViewHoursCharges($carrows[0], $lines, $option);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function saveCar ($option) {
	$pcname = VikRequest::getString('cname', '', 'request');
	$pccat = VikRequest::getVar('ccat', array(0));
	$pcdescr = VikRequest::getString('cdescr', '', 'request', VIKREQUEST_ALLOWHTML);
	$pshort_info = VikRequest::getString('short_info', '', 'request', VIKREQUEST_ALLOWHTML);
	$pcplace = VikRequest::getVar('cplace', array(0));
	$pcretplace = VikRequest::getVar('cretplace', array(0));
	$pccarat = VikRequest::getVar('ccarat', array(0));
	$pcoptional = VikRequest::getVar('coptional', array(0));
	$pcavail = VikRequest::getString('cavail', '', 'request');
	$pautoresize = VikRequest::getString('autoresize', '', 'request');
	$presizeto = VikRequest::getString('resizeto', '', 'request');
	$pautoresizemore = VikRequest::getString('autoresizemore', '', 'request');
	$presizetomore = VikRequest::getString('resizetomore', '', 'request');
	$punits = VikRequest::getInt('units', '', 'request');
	$pimages = VikRequest::getVar('cimgmore', null, 'files', 'array');
	$pstartfrom = VikRequest::getString('startfrom', '', 'request');
	$psdailycost = VikRequest::getString('sdailycost', '', 'request');
	$psdailycost = intval($psdailycost) == 1 ? 1 : 0;
	$pshourlycal = VikRequest::getString('shourlycal', '', 'request');
	$pshourlycal = intval($pshourlycal) == 1 ? 1 : 0;
	$pemail = VikRequest::getString('email', '', 'request');
	$pcustptitle = VikRequest::getString('custptitle', '', 'request');
	$pcustptitlew = VikRequest::getString('custptitlew', '', 'request');
	$pcustptitlew = in_array($pcustptitlew, array('before', 'after', 'replace')) ? $pcustptitlew : 'before';
	$pmetakeywords = VikRequest::getString('metakeywords', '', 'request');
	$pmetadescription = VikRequest::getString('metadescription', '', 'request');
	$psefalias = VikRequest::getString('sefalias', '', 'request');
	$psefalias = empty($psefalias) ? JFilterOutput::stringURLSafe($pcname) : JFilterOutput::stringURLSafe($psefalias);
	jimport('joomla.filesystem.file');
	if (!empty($pcname)) {
		if (intval($_FILES['cimg']['error']) == 0 && caniWrite(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR) && trim($_FILES['cimg']['name'])!="") {
			if (@is_uploaded_file($_FILES['cimg']['tmp_name'])) {
				$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['cimg']['name'])));
				if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
					$j=1;
					while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
						$j++;
					}
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
				}else {
					$j="";
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
				}
				@move_uploaded_file($_FILES['cimg']['tmp_name'], $pwhere);
				if(!($mainimginfo = getimagesize($pwhere))){
					@unlink($pwhere);
					$picon="";
				}else {
					@chmod($pwhere, 0644);
					$picon=$j.$safename;
					if($pautoresize=="1" && !empty($presizeto)) {
						$eforj = new vikResizer();
						$origmod = $eforj->proportionalImage($pwhere, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'r_'.$j.$safename, $presizeto, $presizeto);
						if($origmod) {
							@unlink($pwhere);
							$picon='r_'.$j.$safename;
						}
					}
					$thumbs_width = vikrentcar::getThumbnailsWidth();
					//VikRentCar 1.7 - Thumbnail for better CSS forcing result
					if ($mainimginfo[0] > $thumbs_width) {
						$eforj = new vikResizer();
						$eforj->proportionalImage(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$picon, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'vthumb_'.$picon, $thumbs_width, $thumbs_width);
					}
					//end VikRentCar 1.7 - Thumbnail for better CSS forcing result
				}
			}else {
				$picon="";
			}
		}else {
			$picon="";
		}
		//more images
		$creativik = new vikResizer();
		$bigsdest = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
		$thumbsdest = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
		$dest = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
		$moreimagestr="";
		foreach($pimages['name'] as $kk=>$ci) if(!empty($ci)) $arrimgs[]=$kk;
		if (is_array($arrimgs)) {
			foreach($arrimgs as $imgk){
				if(strlen(trim($pimages['name'][$imgk]))) {
					$filename = JFile::makeSafe(str_replace(" ", "_", strtolower($pimages['name'][$imgk])));
					$src = $pimages['tmp_name'][$imgk];
					$j="";
					if (file_exists($dest.$filename)) {
						$j=rand(171, 1717);
						while (file_exists($dest.$j.$filename)) {
							$j++;
						}
					}
					$finaldest=$dest.$j.$filename;
					$check=getimagesize($pimages['tmp_name'][$imgk]);
					if($check[2] & imagetypes()) {
						if (JFile::upload($src, $finaldest)) {
							$gimg=$j.$filename;
							//orig img
							$origmod = true;
							if($pautoresizemore == "1" && !empty($presizetomore)) {
								$origmod = $creativik->proportionalImage($finaldest, $bigsdest.'big_'.$j.$filename, $presizetomore, $presizetomore);
							}else {
								copy($finaldest, $bigsdest.'big_'.$j.$filename);
							}
							//thumb
							$thumb = $creativik->proportionalImage($finaldest, $thumbsdest.'thumb_'.$j.$filename, 70, 70);
							if (!$thumb || !$origmod) {
								if(file_exists($bigsdest.'big_'.$j.$filename)) @unlink($bigsdest.'big_'.$j.$filename);
								if(file_exists($thumbsdest.'thumb_'.$j.$filename)) @unlink($thumbsdest.'thumb_'.$j.$filename);
								VikError::raiseWarning('', 'Error While Uploading the File: '.$pimages['name'][$imgk]);
							}else {
								$moreimagestr.=$j.$filename.";;";
							}
							@unlink($finaldest);
						}else {
							VikError::raiseWarning('', 'Error While Uploading the File: '.$pimages['name'][$imgk]);
						}
					}else {
						VikError::raiseWarning('', 'Error While Uploading the File: '.$pimages['name'][$imgk]);
					}
				}
			}
		}
		//end more images
		if (!empty($pcplace) && @count($pcplace)) {
			$pcplacedef="";
			foreach($pcplace as $cpla){
				$pcplacedef.=$cpla.";";
			}
		}else {
			$pcplacedef="";
		}
		if (!empty($pcretplace) && @count($pcretplace)) {
			$pcretplacedef="";
			foreach($pcretplace as $cpla){
				$pcretplacedef.=$cpla.";";
			}
		}else {
			$pcretplacedef="";
		}
		if (!empty($pccat) && @count($pccat)) {
			foreach($pccat as $ccat){
				$pccatdef.=$ccat.";";
			}
		}else {
			$pccatdef="";
		}
		if (!empty($pccarat) && @count($pccarat)) {
			foreach($pccarat as $ccarat){
				$pccaratdef.=$ccarat.";";
			}
		}else {
			$pccaratdef="";
		}
		if (!empty($pcoptional) && @count($pcoptional)) {
			foreach($pcoptional as $coptional){
				$pcoptionaldef.=$coptional.";";
			}
		}else {
			$pcoptionaldef="";
		}
		$pcavaildef=($pcavail=="yes" ? "1" : "0");
		//params
		$car_params = array();
		$car_params['sdailycost'] = $psdailycost;
		$car_params['email'] = $pemail;
		$car_params['custptitle'] = $pcustptitle;
		$car_params['custptitlew'] = $pcustptitlew;
		$car_params['metakeywords'] = $pmetakeywords;
		$car_params['metadescription'] = $pmetadescription;
		$car_params['shourlycal'] = $pshourlycal;
		//distinctive features
		$car_params['features'] = array();
		if ($punits > 0) {
			for ($i=1; $i <= $punits; $i++) { 
				$distf_name = VikRequest::getVar('feature-name'.$i, array(0));
				$distf_lang = VikRequest::getVar('feature-lang'.$i, array(0));
				$distf_value = VikRequest::getVar('feature-value'.$i, array(0));
				foreach ($distf_name as $distf_k => $distf) {
					if(strlen($distf) > 0 && strlen($distf_value[$distf_k]) > 0) {
						$use_key = strlen($distf_lang[$distf_k]) > 0 ? $distf_lang[$distf_k] : $distf;
						$car_params['features'][$i][$use_key] = $distf_value[$distf_k];
					}
				}
			}
		}
		//
		$dbo = JFactory::getDBO();
		$q="INSERT INTO `#__vikrentcar_cars` (`name`,`img`,`idcat`,`idcarat`,`idopt`,`info`,`idplace`,`avail`,`units`,`idretplace`,`moreimgs`,`startfrom`,`short_info`,`params`,`alias`) VALUES(".$dbo->quote($pcname).",".$dbo->quote($picon).",".$dbo->quote($pccatdef).",".$dbo->quote($pccaratdef).",".$dbo->quote($pcoptionaldef).",".$dbo->quote($pcdescr).",".$dbo->quote($pcplacedef).",".$dbo->quote($pcavaildef).",".($punits > 0 ? $dbo->quote($punits) : "'1'").",".$dbo->quote($pcretplacedef).", ".$dbo->quote($moreimagestr).", ".(strlen($pstartfrom) > 0 ? "'".$pstartfrom."'" : "null").", ".$dbo->quote($pshort_info).", ".$dbo->quote(json_encode($car_params)).", ".$dbo->quote($psefalias).");";
		$dbo->setQuery($q);
		$dbo->execute();
		$lid = $dbo->insertid();
		if(!empty($lid)) {
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRCCARSAVEOK'));
			goViewTariffe($lid, $option);
		}else {
			cancelEditing($option);
		}
	}else {
		cancelEditing($option);
	}
}

function updateCar ($option, $remain = false) {
	$pcname = VikRequest::getString('cname', '', 'request');
	$pccat = VikRequest::getVar('ccat', array(0));
	$pcdescr = VikRequest::getString('cdescr', '', 'request', VIKREQUEST_ALLOWHTML);
	$pshort_info = VikRequest::getString('short_info', '', 'request', VIKREQUEST_ALLOWHTML);
	$pcplace = VikRequest::getVar('cplace', array(0));
	$pcretplace = VikRequest::getVar('cretplace', array(0));
	$pccarat = VikRequest::getVar('ccarat', array(0));
	$pcoptional = VikRequest::getVar('coptional', array(0));
	$pcavail = VikRequest::getString('cavail', '', 'request');
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	$pautoresize = VikRequest::getString('autoresize', '', 'request');
	$presizeto = VikRequest::getString('resizeto', '', 'request');
	$pautoresizemore = VikRequest::getString('autoresizemore', '', 'request');
	$presizetomore = VikRequest::getString('resizetomore', '', 'request');
	$punits = VikRequest::getInt('units', '', 'request');
	$pimages = VikRequest::getVar('cimgmore', null, 'files', 'array');
	$pactmoreimgs = VikRequest::getString('actmoreimgs', '', 'request');
	$pstartfrom = VikRequest::getString('startfrom', '', 'request');
	$psdailycost = VikRequest::getString('sdailycost', '', 'request');
	$psdailycost = intval($psdailycost) == 1 ? 1 : 0;
	$pshourlycal = VikRequest::getString('shourlycal', '', 'request');
	$pshourlycal = intval($pshourlycal) == 1 ? 1 : 0;
	$pemail = VikRequest::getString('email', '', 'request');
	$pcustptitle = VikRequest::getString('custptitle', '', 'request');
	$pcustptitlew = VikRequest::getString('custptitlew', '', 'request');
	$pcustptitlew = in_array($pcustptitlew, array('before', 'after', 'replace')) ? $pcustptitlew : 'before';
	$pmetakeywords = VikRequest::getString('metakeywords', '', 'request');
	$pmetadescription = VikRequest::getString('metadescription', '', 'request');
	$psefalias = VikRequest::getString('sefalias', '', 'request');
	$psefalias = empty($psefalias) ? JFilterOutput::stringURLSafe($pcname) : JFilterOutput::stringURLSafe($psefalias);
	jimport('joomla.filesystem.file');
	if (!empty($pcname)) {
		if (intval($_FILES['cimg']['error']) == 0 && caniWrite(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR) && trim($_FILES['cimg']['name'])!="") {
			if (@is_uploaded_file($_FILES['cimg']['tmp_name'])) {
				$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['cimg']['name'])));
				if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
					$j=1;
					while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
						$j++;
					}
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
				}else {
					$j="";
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
				}
				@move_uploaded_file($_FILES['cimg']['tmp_name'], $pwhere);
				if(!($mainimginfo = getimagesize($pwhere))){
					@unlink($pwhere);
					$picon="";
				}else {
					@chmod($pwhere, 0644);
					$picon=$j.$safename;
					if($pautoresize=="1" && !empty($presizeto)) {
						$eforj = new vikResizer();
						$origmod = $eforj->proportionalImage($pwhere, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'r_'.$j.$safename, $presizeto, $presizeto);
						if($origmod) {
							@unlink($pwhere);
							$picon='r_'.$j.$safename;
						}
					}
					$thumbs_width = vikrentcar::getThumbnailsWidth();
					//VikRentCar 1.7 - Thumbnail for better CSS forcing result
					if ($mainimginfo[0] > $thumbs_width) {
						$eforj = new vikResizer();
						$eforj->proportionalImage(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$picon, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'vthumb_'.$picon, $thumbs_width, $thumbs_width);
					}
					//end VikRentCar 1.7 - Thumbnail for better CSS forcing result
				}
			}else {
				$picon="";
			}
		}else {
			$picon="";
		}
		//more images
		$creativik = new vikResizer();
		$bigsdest = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
		$thumbsdest = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
		$dest = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR;
		$moreimagestr=$pactmoreimgs;
		foreach($pimages['name'] as $kk=>$ci) if(!empty($ci)) $arrimgs[]=$kk;
		if (@count($arrimgs) > 0) {
			foreach($arrimgs as $imgk){
				if(strlen(trim($pimages['name'][$imgk]))) {
					$filename = JFile::makeSafe(str_replace(" ", "_", strtolower($pimages['name'][$imgk])));
					$src = $pimages['tmp_name'][$imgk];
					$j="";
					if (file_exists($dest.$filename)) {
						$j=rand(171, 1717);
						while (file_exists($dest.$j.$filename)) {
							$j++;
						}
					}
					$finaldest=$dest.$j.$filename;
					$check=getimagesize($pimages['tmp_name'][$imgk]);
					if($check[2] & imagetypes()) {
						if (JFile::upload($src, $finaldest)) {
							$gimg=$j.$filename;
							//orig img
							$origmod = true;
							if($pautoresizemore == "1" && !empty($presizetomore)) {
								$origmod = $creativik->proportionalImage($finaldest, $bigsdest.'big_'.$j.$filename, $presizetomore, $presizetomore);
							}else {
								copy($finaldest, $bigsdest.'big_'.$j.$filename);
							}
							//thumb
							$thumb = $creativik->proportionalImage($finaldest, $thumbsdest.'thumb_'.$j.$filename, 70, 70);
							if (!$thumb || !$origmod) {
								if(file_exists($bigsdest.'big_'.$j.$filename)) @unlink($bigsdest.'big_'.$j.$filename);
								if(file_exists($thumbsdest.'thumb_'.$j.$filename)) @unlink($thumbsdest.'thumb_'.$j.$filename);
								VikError::raiseWarning('', 'Error While Uploading the File: '.$pimages['name'][$imgk]);
							}else {
								$moreimagestr.=$j.$filename.";;";
							}
							@unlink($finaldest);
						}else {
							VikError::raiseWarning('', 'Error While Uploading the File: '.$pimages['name'][$imgk]);
						}
					}else {
						VikError::raiseWarning('', 'Error While Uploading the File: '.$pimages['name'][$imgk]);
					}
				}
			}
		}
		//end more images
		if (!empty($pcplace) && @count($pcplace)) {
			$pcplacedef="";
			foreach($pcplace as $cpla){
				$pcplacedef.=$cpla.";";
			}
		}else {
			$pcplacedef="";
		}
		if (!empty($pcretplace) && @count($pcretplace)) {
			$pcretplacedef="";
			foreach($pcretplace as $cpla){
				$pcretplacedef.=$cpla.";";
			}
		}else {
			$pcretplacedef="";
		}
		if (!empty($pccat) && @count($pccat)) {
			foreach($pccat as $ccat){
				$pccatdef.=$ccat.";";
			}
		}else {
			$pccatdef="";
		}
		if (!empty($pccarat) && @count($pccarat)) {
			foreach($pccarat as $ccarat){
				$pccaratdef.=$ccarat.";";
			}
		}else {
			$pccaratdef="";
		}
		if (!empty($pcoptional) && @count($pcoptional)) {
			foreach($pcoptional as $coptional){
				$pcoptionaldef.=$coptional.";";
			}
		}else {
			$pcoptionaldef="";
		}
		$pcavaildef=($pcavail=="yes" ? "1" : "0");
		//params
		$car_params = array();
		$car_params['sdailycost'] = $psdailycost;
		$car_params['email'] = $pemail;
		$car_params['custptitle'] = $pcustptitle;
		$car_params['custptitlew'] = $pcustptitlew;
		$car_params['metakeywords'] = $pmetakeywords;
		$car_params['metadescription'] = $pmetadescription;
		$car_params['shourlycal'] = $pshourlycal;
		//distinctive features
		$car_params['features'] = array();
		$damages = array();
		$damage_show_type = vikrentcar::getDamageShowType();
		$damage_png_path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_vikrentcar'.DS.'resources'.DS.'damage_mark.png';
		$cstatus_png_path = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'car_damages'.DS.'car_inspection.png';
		$damage_font = 'helsinki';
		$damage_font_size = 11;
		// Set the enviroment variable for PHP-GD
		//font residing in /administrator/components/com_vikrentcar/resources/ (arial.ttf by default)
		putenv('GDFONTPATH=' . realpath('./components/com_vikrentcar/resources'));
		//$font = 'dejavusans'; //i.e. for loading the file dejavusans.ttf or use a custom font
		//
		$gd_available = function_exists('imagecreatefrompng');
		if($gd_available) {
			$damage_png = imagecreatefrompng($damage_png_path);
			imagesavealpha($damage_png, true);
			imagealphablending($damage_png, true);
			list($damage_png_width, $damage_png_height) = getimagesize($damage_png_path);
			list($cstatus_png_width, $cstatus_png_height) = getimagesize($cstatus_png_path);
		}
		if ($punits > 0) {
			for ($i=1; $i <= $punits; $i++) {
				$distf_name = VikRequest::getVar('feature-name'.$i, array(0));
				$distf_lang = VikRequest::getVar('feature-lang'.$i, array(0));
				$distf_value = VikRequest::getVar('feature-value'.$i, array(0));
				foreach ($distf_name as $distf_k => $distf) {
					if(strlen($distf) > 0 && strlen($distf_value[$distf_k]) > 0 && (!empty($distf) && !empty($distf_value[$distf_k]))) {
						$use_key = strlen($distf_lang[$distf_k]) > 0 ? $distf_lang[$distf_k] : $distf;
						$car_params['features'][$i][$use_key] = $distf_value[$distf_k];
					}
				}
				//damages
				$damage_notes = VikRequest::getVar('car-'.$i.'-damage', array(0));
				$damage_notes_x = VikRequest::getVar('car-'.$i.'-damage-x', array(0));
				$damage_notes_y = VikRequest::getVar('car-'.$i.'-damage-y', array(0));
				$dind = 1;
				foreach ($damage_notes as $dk => $damage) {
					if(strlen($damage) && strlen($damage_notes_x[$dk]) && strlen($damage_notes_y[$dk]) && (!empty($damage) && !empty($damage_notes_x[$dk]))) {
						$damages[$i][$dind]['notes'] = $damage;
						$damages[$i][$dind]['x'] = $damage_notes_x[$dk];
						$damages[$i][$dind]['y'] = $damage_notes_y[$dk];
						$dind++;
					}
				}
				$tot_dmg = count($damages[$i]);
				if($tot_dmg > 0 && $gd_available) {
					//generate PNG
					$base_png = imagecreatefrompng($cstatus_png_path);
					imagesavealpha($base_png, true);
					imagealphablending($base_png, true);
					$unit_png = imagecreatetruecolor($cstatus_png_width, $cstatus_png_height);
					$white = imagecolorallocate($unit_png, 255, 255, 255);
					$black = imagecolorallocate($unit_png, 0, 0, 0);
					imagefill($unit_png, 0, 0, $black);
					imagecopy($unit_png, $base_png, 0, 0, 0, 0, $cstatus_png_width, $cstatus_png_height);
					$dk = $tot_dmg;
					foreach($damages[$i] as $dind => $dmg_point) {
						//damage PNG
						$allocate_x = (int)((int)$dmg_point['x'] - ((int)$damage_png_width / 2));
						$allocate_y = (int)((int)$dmg_point['y'] - ((int)$damage_png_height / 2));
						imagecopy($unit_png, $damage_png, $allocate_x, $allocate_y, 0, 0, $damage_png_width, $damage_png_height);
						if($damage_show_type > 1) {
							$type_space = imagettfbbox($damage_font_size, 0, $damage_font, (string)$dk);
							$type_width = floor($type_space[4] - $type_space[0]);
							$type_height = floor($type_space[5] - $type_space[1]);
							$allocate_x = ceil((int)$dmg_point['x'] - ((int)$type_width / 2));
							$allocate_y = floor((int)$dmg_point['y'] - ((int)$type_height / 2));
							imagettftext($unit_png, $damage_font_size, 0, $allocate_x, $allocate_y, $white, $damage_font, (string)$dk);
						}
						$dk--;
					}
					imagepng($unit_png, JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'car_damages'.DS.$pwhereup.'_'.$i.'.png');
					imagedestroy($unit_png);
				}else {
					if(file_exists(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'car_damages'.DS.$pwhereup.'_'.$i.'.png')) {
						unlink(JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'helpers'.DS.'car_damages'.DS.$pwhereup.'_'.$i.'.png');
					}
				}
			}
			if(count($damages) > 0) {
				$car_params['damages'] = $damages;
			}
		}
		//
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_cars` SET `name`=".$dbo->quote($pcname).",".(strlen($picon) > 0 ? "`img`='".$picon."'," : "")."`idcat`=".$dbo->quote($pccatdef).",`idcarat`=".$dbo->quote($pccaratdef).",`idopt`=".$dbo->quote($pcoptionaldef).",`info`=".$dbo->quote($pcdescr).",`idplace`=".$dbo->quote($pcplacedef).",`avail`=".$dbo->quote($pcavaildef).",`units`=".($punits > 0 ? $dbo->quote($punits) : "'1'").",`idretplace`=".$dbo->quote($pcretplacedef).",`moreimgs`=".$dbo->quote($moreimagestr).",`startfrom`=".(strlen($pstartfrom) > 0 ? "'".$pstartfrom."'" : "null").",`short_info`=".$dbo->quote($pshort_info).",`params`=".$dbo->quote(json_encode($car_params)).",`alias`=".$dbo->quote($psefalias)." WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
		$app = JFactory::getApplication();
		$app->enqueueMessage(JText::_('VRCCARUPDATEOK'));
		if($remain === true) {
			$app->redirect("index.php?option=".$option."&task=editcar&cid[]=".$pwhereup);
			exit;
		}
	}
	cancelEditing($option);
}

function goViewTariffe ($aid, $option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewtariffe&cid[]=".$aid);
}

function viewPlaces ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`ordering` ASC,`#__vikrentcar_places`.`name` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewPlaces($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewPlaces($rows, $option);
	}
}

function viewIva ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_iva`";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewIva($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewIva($rows, $option);
	}
}

function viewCategories ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_categories` ORDER BY `#__vikrentcar_categories`.`ordering` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewCategories($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewCategories($rows, $option);
	}
}

function viewCarat ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_caratteristiche` ORDER BY `#__vikrentcar_caratteristiche`.`ordering` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewCarat($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewCarat($rows, $option);
	}
}

function viewOptionals ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_optionals` ORDER BY `#__vikrentcar_optionals`.`ordering` ASC";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewOptionals($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewOptionals($rows, $option);
	}
}

function viewPrices ($option) {
	$dbo = JFactory::getDBO();
	$mainframe = JFactory::getApplication();
	$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int');
	$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_prices`";
	$dbo->setQuery($q, $lim0, $lim);
	$dbo->execute();
	if ($dbo->getNumRows() > 0) {
		$rows = $dbo->loadAssocList();
		$dbo->setQuery('SELECT FOUND_ROWS();');
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
		$navbut="<table align=\"center\"><tr><td>".$pageNav->getListFooter()."</td></tr></table>";
		HTML_vikrentcar::pViewPrices($rows, $option, $lim0, $navbut);
	}else {
		$rows = "";
		HTML_vikrentcar::pViewPrices($rows, $option);
	}
}

function editPrice ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_prices` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditPrice($rows[0], $option);
	}else {
		cancelEditingPrice($option);
	}
}

function editIva ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_iva` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditIva($rows[0], $option);
	}else {
		cancelEditingIva($option);
	}
}

function editPlace ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_places` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditPlace($rows[0], $option);
	}else {
		cancelEditingPlace($option);
	}
}

function editCat ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_categories` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditCat($rows[0], $option);
	}else {
		cancelEditingCat($option);
	}
}

function editCarat ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_caratteristiche` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditCarat($rows[0], $option);
	}else {
		cancelEditingCarat($option);
	}
}

function editOptional ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_optionals` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditOptional($rows[0], $option);
	}else {
		cancelEditingOptionals($option);
	}
}

function editCar ($id, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_cars` WHERE `id`='".$id."';";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		$q="SELECT * FROM `#__vikrentcar_places`;";
		$dbo->setQuery($q);
		$dbo->execute();
		$places=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
		$q="SELECT * FROM `#__vikrentcar_categories`;";
		$dbo->setQuery($q);
		$dbo->execute();
		$cats=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
		$q="SELECT * FROM `#__vikrentcar_caratteristiche` ORDER BY `#__vikrentcar_caratteristiche`.`ordering` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$carats=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
		$q="SELECT * FROM `#__vikrentcar_optionals`;";
		$dbo->setQuery($q);
		$dbo->execute();
		$optionals=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
		HTML_vikrentcar::pEditCar($rows[0], $cats, $carats, $optionals, $places, $option);
	}else {
		cancelEditing($option);
	}
}

function newPlace ($option) {
	HTML_vikrentcar::pNewPlace($option);
}

function newIva ($option) {
	HTML_vikrentcar::pNewIva($option);
}

function newPrice ($option) {
	HTML_vikrentcar::pNewPrice($option);
}

function newCat ($option) {
	HTML_vikrentcar::pNewCat($option);
}

function newCarat ($option) {
	HTML_vikrentcar::pNewCarat($option);
}

function newOptionals ($option) {
	HTML_vikrentcar::pNewOptionals($option);
}

function newCar ($option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_places`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$places=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
	$q="SELECT * FROM `#__vikrentcar_categories`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$cats=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
	$q="SELECT * FROM `#__vikrentcar_caratteristiche` ORDER BY `#__vikrentcar_caratteristiche`.`ordering` ASC;";
	$dbo->setQuery($q);
	$dbo->execute();
	$carats=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
	$q="SELECT * FROM `#__vikrentcar_optionals`;";
	$dbo->setQuery($q);
	$dbo->execute();
	$optionals=($dbo->getNumRows() > 0 ? $dbo->loadAssocList() : "");
	HTML_vikrentcar::pNewCar($cats, $carats, $optionals, $places, $option);
}

function savePlace ($option) {
	$pname = VikRequest::getString('placename', '', 'request');
	$plat = VikRequest::getString('lat', '', 'request');
	$plng = VikRequest::getString('lng', '', 'request');
	$ppraliq = VikRequest::getString('praliq', '', 'request');
	$pdescr = VikRequest::getString('descr', '', 'request', VIKREQUEST_ALLOWHTML);
	$popentimefh = VikRequest::getString('opentimefh', '', 'request');
	$popentimefm = VikRequest::getInt('opentimefm', '', 'request');
	$popentimeth = VikRequest::getString('opentimeth', '', 'request');
	$popentimetm = VikRequest::getInt('opentimetm', '', 'request');
	$pclosingdays = VikRequest::getString('closingdays', '', 'request');
	$psuggopentimeh = VikRequest::getInt('suggopentimeh', '', 'request');
	$opentime = "";
	$suggopentimeh = !empty($psuggopentimeh) ? ($psuggopentimeh * 3600) : '';
	if(strlen($popentimefh) > 0 && strlen($popentimeth) > 0) {
		$openingh=$popentimefh * 3600;
		$openingm=$popentimefm * 60;
		$openingts=$openingh + $openingm;
		$closingh=$popentimeth * 3600;
		$closingm=$popentimetm * 60;
		$closingts=$closingh + $closingm;
		if ($closingts > $openingts || $openingts > $closingts) {
			$opentime = $openingts."-".$closingts;
		}
	}
	if (!empty($pname)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `ordering` FROM `#__vikrentcar_places` ORDER BY `#__vikrentcar_places`.`ordering` DESC LIMIT 1;";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() == 1) {
			$getlast=$dbo->loadResult();
			$newsortnum=$getlast + 1;
		}else {
			$newsortnum=1;
		}
		$q="INSERT INTO `#__vikrentcar_places` (`name`,`lat`,`lng`,`descr`,`opentime`,`closingdays`,`idiva`,`defaulttime`,`ordering`) VALUES(".$dbo->quote($pname).", ".$dbo->quote($plat).", ".$dbo->quote($plng).", ".$dbo->quote($pdescr).", '".$opentime."', ".$dbo->quote($pclosingdays).", ".(!empty($ppraliq) ? "'".$ppraliq."'" : "null").", ".(!empty($suggopentimeh) ? "'".$suggopentimeh."'" : "null").", ".$newsortnum.");";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingPlace($option);
}

function updatePlace ($option) {
	$pname = VikRequest::getString('placename', '', 'request');
	$plat = VikRequest::getString('lat', '', 'request');
	$plng = VikRequest::getString('lng', '', 'request');
	$ppraliq = VikRequest::getString('praliq', '', 'request');
	$pdescr = VikRequest::getString('descr', '', 'request', VIKREQUEST_ALLOWHTML);
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	$popentimefh = VikRequest::getString('opentimefh', '', 'request');
	$popentimefm = VikRequest::getInt('opentimefm', '', 'request');
	$popentimeth = VikRequest::getString('opentimeth', '', 'request');
	$popentimetm = VikRequest::getInt('opentimetm', '', 'request');
	$pclosingdays = VikRequest::getString('closingdays', '', 'request');
	$psuggopentimeh = VikRequest::getInt('suggopentimeh', '', 'request');
	$opentime = "";
	$suggopentimeh = !empty($psuggopentimeh) ? ($psuggopentimeh * 3600) : '';
	if(strlen($popentimefh) > 0 && strlen($popentimeth) > 0) {
		$openingh=$popentimefh * 3600;
		$openingm=$popentimefm * 60;
		$openingts=$openingh + $openingm;
		$closingh=$popentimeth * 3600;
		$closingm=$popentimetm * 60;
		$closingts=$closingh + $closingm;
		if ($closingts > $openingts || $openingts > $closingts) {
			$opentime = $openingts."-".$closingts;
		}
	}
	if (!empty($pname)) {
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_places` SET `name`=".$dbo->quote($pname).",`lat`=".$dbo->quote($plat).",`lng`=".$dbo->quote($plng).",`descr`=".$dbo->quote($pdescr).",`opentime`='".$opentime."',`closingdays`=".$dbo->quote($pclosingdays).",`idiva`=".(!empty($ppraliq) ? "'".$ppraliq."'" : "null").",`defaulttime`=".(!empty($suggopentimeh) ? "'".$suggopentimeh."'" : "null")." WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingPlace($option);
}

function saveIva ($option) {
	$paliqname = VikRequest::getString('aliqname', '', 'request');
	$paliqperc = VikRequest::getString('aliqperc', '', 'request');
	if (!empty($paliqperc)) {
		$dbo = JFactory::getDBO();
		$q="INSERT INTO `#__vikrentcar_iva` (`name`,`aliq`) VALUES(".$dbo->quote($paliqname).", ".$dbo->quote($paliqperc).");";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingIva($option);
}

function updateIva ($option) {
	$paliqname = VikRequest::getString('aliqname', '', 'request');
	$paliqperc = VikRequest::getString('aliqperc', '', 'request');
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	if (!empty($paliqperc)) {
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_iva` SET `name`=".$dbo->quote($paliqname).",`aliq`=".$dbo->quote($paliqperc)." WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingIva($option);
}

function savePrice ($option) {
	$pprice = VikRequest::getString('price', '', 'request');
	$pattr = VikRequest::getString('attr', '', 'request');
	$ppraliq = VikRequest::getString('praliq', '', 'request');
	if (!empty($pprice)) {
		$dbo = JFactory::getDBO();
		$q="INSERT INTO `#__vikrentcar_prices` (`name`,`attr`,`idiva`) VALUES(".$dbo->quote($pprice).", ".$dbo->quote($pattr).", ".$dbo->quote($ppraliq).");";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingPrice($option);
}

function updatePrice ($option) {
	$pprice = VikRequest::getString('price', '', 'request');
	$pattr = VikRequest::getString('attr', '', 'request');
	$ppraliq = VikRequest::getString('praliq', '', 'request');
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	if (!empty($pprice)) {
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_prices` SET `name`=".$dbo->quote($pprice).",`attr`=".$dbo->quote($pattr).",`idiva`=".$dbo->quote($ppraliq)." WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingPrice($option);
}

function saveCat ($option) {
	$pcatname = VikRequest::getString('catname', '', 'request');
	$pdescr = VikRequest::getString('descr', '', 'request', VIKREQUEST_ALLOWHTML);
	if (!empty($pcatname)) {
		$dbo = JFactory::getDBO();
		$q="SELECT `ordering` FROM `#__vikrentcar_categories` ORDER BY `#__vikrentcar_categories`.`ordering` DESC LIMIT 1;";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() == 1) {
			$getlast=$dbo->loadResult();
			$newsortnum=$getlast + 1;
		}else {
			$newsortnum=1;
		}
		$q="INSERT INTO `#__vikrentcar_categories` (`name`,`descr`,`ordering`) VALUES(".$dbo->quote($pcatname).", ".$dbo->quote($pdescr).", ".(int)$newsortnum.");";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingCat($option);
}

function updateCat ($option) {
	$pcatname = VikRequest::getString('catname', '', 'request');
	$pdescr = VikRequest::getString('descr', '', 'request', VIKREQUEST_ALLOWHTML);
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	if (!empty($pcatname)) {
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_categories` SET `name`=".$dbo->quote($pcatname).", `descr`=".$dbo->quote($pdescr)." WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingCat($option);
}

function saveCarat ($option) {
	$pcaratname = VikRequest::getString('caratname', '', 'request');
	$pcaratmix = VikRequest::getString('caratmix', '', 'request');
	$pcarattextimg = VikRequest::getString('carattextimg', '', 'request');
	$pautoresize = VikRequest::getString('autoresize', '', 'request');
	$presizeto = VikRequest::getString('resizeto', '', 'request');
	if (!empty($pcaratname)) {
		if (intval($_FILES['caraticon']['error']) == 0 && caniWrite(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR) && trim($_FILES['caraticon']['name'])!="") {
			jimport('joomla.filesystem.file');
			if (@is_uploaded_file($_FILES['caraticon']['tmp_name'])) {
				$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['caraticon']['name'])));
				if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
					$j=1;
					while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
						$j++;
					}
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
				}else {
					$j="";
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
				}
				@move_uploaded_file($_FILES['caraticon']['tmp_name'], $pwhere);
				if(!getimagesize($pwhere)){
					@unlink($pwhere);
					$picon="";
				}else {
					@chmod($pwhere, 0644);
					$picon=$j.$safename;
					if($pautoresize=="1" && !empty($presizeto)) {
						$eforj = new vikResizer();
						$origmod = $eforj->proportionalImage($pwhere, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'r_'.$j.$safename, $presizeto, $presizeto);
						if($origmod) {
							@unlink($pwhere);
							$picon='r_'.$j.$safename;
						}
					}
				}
			}else {
				$picon="";
			}
		}else {
			$picon="";
		}
		$dbo = JFactory::getDBO();
		$q="SELECT `ordering` FROM `#__vikrentcar_caratteristiche` ORDER BY `#__vikrentcar_caratteristiche`.`ordering` DESC LIMIT 1;";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() == 1) {
			$getlast=$dbo->loadResult();
			$newsortnum=$getlast + 1;
		}else {
			$newsortnum=1;
		}
		$q="INSERT INTO `#__vikrentcar_caratteristiche` (`name`,`icon`,`align`,`textimg`,`ordering`) VALUES(".$dbo->quote($pcaratname).", ".$dbo->quote($picon).", ".$dbo->quote($pcaratmix).", ".$dbo->quote($pcarattextimg).", '".$newsortnum."');";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingCarat($option);
}

function updateCarat ($option) {
	$pcaratname = VikRequest::getString('caratname', '', 'request');
	$pcaratmix = VikRequest::getString('caratmix', '', 'request');
	$pcarattextimg = VikRequest::getString('carattextimg', '', 'request');
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	$pautoresize = VikRequest::getString('autoresize', '', 'request');
	$presizeto = VikRequest::getString('resizeto', '', 'request');
	if (!empty($pcaratname)) {
		if (intval($_FILES['caraticon']['error']) == 0 && caniWrite(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR) && trim($_FILES['caraticon']['name'])!="") {
			jimport('joomla.filesystem.file');
			if (@is_uploaded_file($_FILES['caraticon']['tmp_name'])) {
				$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['caraticon']['name'])));
				if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
					$j=1;
					while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
						$j++;
					}
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
				}else {
					$j="";
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
				}
				@move_uploaded_file($_FILES['caraticon']['tmp_name'], $pwhere);
				if(!getimagesize($pwhere)){
					@unlink($pwhere);
					$picon="";
				}else {
					@chmod($pwhere, 0644);
					$picon=$j.$safename;
					if($pautoresize=="1" && !empty($presizeto)) {
						$eforj = new vikResizer();
						$origmod = $eforj->proportionalImage($pwhere, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'r_'.$j.$safename, $presizeto, $presizeto);
						if($origmod) {
							@unlink($pwhere);
							$picon='r_'.$j.$safename;
						}
					}
				}
			}else {
				$picon="";
			}
		}else {
			$picon="";
		}
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_caratteristiche` SET `name`=".$dbo->quote($pcaratname).",".(strlen($picon) > 0 ? "`icon`='".$picon."'," : "")."`align`=".$dbo->quote($pcaratmix).",`textimg`=".$dbo->quote($pcarattextimg)." WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingCarat($option);
}

function saveOptionals ($option) {
	$poptname = VikRequest::getString('optname', '', 'request');
	$poptdescr = VikRequest::getString('optdescr', '', 'request', VIKREQUEST_ALLOWHTML);
	$poptcost = VikRequest::getString('optcost', '', 'request');
	$poptperday = VikRequest::getString('optperday', '', 'request');
	$pmaxprice = VikRequest::getString('maxprice', '', 'request');
	$popthmany = VikRequest::getString('opthmany', '', 'request');
	$poptaliq = VikRequest::getString('optaliq', '', 'request');
	$pautoresize = VikRequest::getString('autoresize', '', 'request');
	$presizeto = VikRequest::getString('resizeto', '', 'request');
	$pforcesel = VikRequest::getString('forcesel', '', 'request');
	$pforceval = VikRequest::getString('forceval', '', 'request');
	$pforceifdays = VikRequest::getInt('forceifdays', '', 'request');
	$pforcevalperday = VikRequest::getString('forcevalperday', '', 'request');
	$pforcesel = $pforcesel == "1" ? 1 : 0;
	if($pforcesel == 1) {
		$strforceval = intval($pforceval)."-".($pforcevalperday == "1" ? "1" : "0");
	}else {
		$strforceval = "";
	}
	if (!empty($poptname)) {
		if (intval($_FILES['optimg']['error']) == 0 && caniWrite(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR) && trim($_FILES['optimg']['name'])!="") {
			jimport('joomla.filesystem.file');
			if (@is_uploaded_file($_FILES['optimg']['tmp_name'])) {
				$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['optimg']['name'])));
				if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
					$j=1;
					while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
						$j++;
					}
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
				}else {
					$j="";
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
				}
				@move_uploaded_file($_FILES['optimg']['tmp_name'], $pwhere);
				if(!getimagesize($pwhere)){
					@unlink($pwhere);
					$picon="";
				}else {
					@chmod($pwhere, 0644);
					$picon=$j.$safename;
					if($pautoresize=="1" && !empty($presizeto)) {
						$eforj = new vikResizer();
						$origmod = $eforj->proportionalImage($pwhere, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'r_'.$j.$safename, $presizeto, $presizeto);
						if($origmod) {
							@unlink($pwhere);
							$picon='r_'.$j.$safename;
						}
					}
				}
			}else {
				$picon="";
			}
		}else {
			$picon="";
		}
		$poptperday=($poptperday=="each" ? "1" : "0");
		($popthmany=="yes" ? $popthmany="1" : $popthmany="0");
		$dbo = JFactory::getDBO();
		$q="SELECT `ordering` FROM `#__vikrentcar_optionals` ORDER BY `#__vikrentcar_optionals`.`ordering` DESC LIMIT 1;";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() == 1) {
			$getlast=$dbo->loadResult();
			$newsortnum=$getlast + 1;
		}else {
			$newsortnum=1;
		}
		$q="INSERT INTO `#__vikrentcar_optionals` (`name`,`descr`,`cost`,`perday`,`hmany`,`img`,`idiva`,`maxprice`,`forcesel`,`forceval`,`ordering`,`forceifdays`) VALUES(".$dbo->quote($poptname).", ".$dbo->quote($poptdescr).", ".$dbo->quote($poptcost).", ".$dbo->quote($poptperday).", ".$dbo->quote($popthmany).", '".$picon."', ".$dbo->quote($poptaliq).", ".$dbo->quote($pmaxprice).", '".$pforcesel."', '".$strforceval."', '".$newsortnum."', '".$pforceifdays."');";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingOptionals($option);
}

function updateOptional ($option) {
	$poptname = VikRequest::getString('optname', '', 'request');
	$poptdescr = VikRequest::getString('optdescr', '', 'request', VIKREQUEST_ALLOWHTML);
	$poptcost = VikRequest::getString('optcost', '', 'request');
	$poptperday = VikRequest::getString('optperday', '', 'request');
	$pmaxprice = VikRequest::getString('maxprice', '', 'request');
	$popthmany = VikRequest::getString('opthmany', '', 'request');
	$poptaliq = VikRequest::getString('optaliq', '', 'request');
	$pwhereup = VikRequest::getString('whereup', '', 'request');
	$pautoresize = VikRequest::getString('autoresize', '', 'request');
	$presizeto = VikRequest::getString('resizeto', '', 'request');
	$pforcesel = VikRequest::getString('forcesel', '', 'request');
	$pforceval = VikRequest::getString('forceval', '', 'request');
	$pforceifdays = VikRequest::getInt('forceifdays', '', 'request');
	$pforcevalperday = VikRequest::getString('forcevalperday', '', 'request');
	$pforcesel = $pforcesel == "1" ? 1 : 0;
	if($pforcesel == 1) {
		$strforceval = intval($pforceval)."-".($pforcevalperday == "1" ? "1" : "0");
	}else {
		$strforceval = "";
	}
	if (!empty($poptname)) {
		if (intval($_FILES['optimg']['error']) == 0 && caniWrite(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR) && trim($_FILES['optimg']['name'])!="") {
			jimport('joomla.filesystem.file');
			if (@is_uploaded_file($_FILES['optimg']['tmp_name'])) {
				$safename=JFile::makeSafe(str_replace(" ", "_", strtolower($_FILES['optimg']['name'])));
				if (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename)) {
					$j=1;
					while (file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename)) {
						$j++;
					}
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$j.$safename;
				}else {
					$j="";
					$pwhere=JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$safename;
				}
				@move_uploaded_file($_FILES['optimg']['tmp_name'], $pwhere);
				if(!getimagesize($pwhere)){
					@unlink($pwhere);
					$picon="";
				}else {
					@chmod($pwhere, 0644);
					$picon=$j.$safename;
					if($pautoresize=="1" && !empty($presizeto)) {
						$eforj = new vikResizer();
						$origmod = $eforj->proportionalImage($pwhere, JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'r_'.$j.$safename, $presizeto, $presizeto);
						if($origmod) {
							@unlink($pwhere);
							$picon='r_'.$j.$safename;
						}
					}
				}
			}else {
				$picon="";
			}
		}else {
			$picon="";
		}
		($poptperday=="each" ? $poptperday="1" : $poptperday="0");
		($popthmany=="yes" ? $popthmany="1" : $popthmany="0");
		$dbo = JFactory::getDBO();
		$q="UPDATE `#__vikrentcar_optionals` SET `name`=".$dbo->quote($poptname).",`descr`=".$dbo->quote($poptdescr).",`cost`=".$dbo->quote($poptcost).",`perday`=".$dbo->quote($poptperday).",`hmany`=".$dbo->quote($popthmany).",".(strlen($picon)>0 ? "`img`='".$picon."'," : "")."`idiva`=".$dbo->quote($poptaliq).", `maxprice`=".$dbo->quote($pmaxprice).", `forcesel`='".$pforcesel."', `forceval`='".$strforceval."', `forceifdays`='".$pforceifdays."' WHERE `id`=".$dbo->quote($pwhereup).";";
		$dbo->setQuery($q);
		$dbo->execute();
	}
	cancelEditingOptionals($option);
}

function removePlace ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_places` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	cancelEditingPlace($option);
}

function removeIva ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_iva` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	cancelEditingIva($option);
}

function removeBusy ($option) {
	$pidbusy = VikRequest::getString('idbusy', '', 'request');
	$pidorder = VikRequest::getInt('idorder', '', 'request');
	$pidcar = VikRequest::getString('idcar', '', 'request');
	if (!empty($pidorder) && !empty($pidcar)) {
		$dbo = JFactory::getDBO();
		$q = "SELECT `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy` WHERE `o`.`id`=".$dbo->quote($pidorder).";";
		$dbo->setQuery($q);
		$dbo->execute();
		if ($dbo->getNumRows() == 1) {
			$ord=$dbo->loadAssocList();
			/*
			//Deprecated and removed since VRC 1.11
			if(vikrentcar::saveOldOrders() && $ord[0]['stop_sales'] != 1) {
				$q="INSERT INTO `#__vikrentcar_oldorders` (`tsdel`,`custdata`,`ts`,`status`,`idcar`,`days`,`ritiro`,`consegna`,`idtar`,`optionals`,`custmail`,`sid`) VALUES('".time()."',".$dbo->quote($ord[0]['custdata']).",'".$ord[0]['ts']."','".$ord[0]['status']."','".$ord[0]['idcar']."','".$ord[0]['days']."','".$ord[0]['ritiro']."','".$ord[0]['consegna']."','".$ord[0]['idtar']."','".$ord[0]['optionals']."','".$ord[0]['custmail']."','".$ord[0]['sid']."');";
				$dbo->setQuery($q);
				$dbo->execute();
			}
			*/
			$q = "DELETE FROM `#__vikrentcar_tmplock` WHERE `idorder`=" . intval($ord[0]['id']) . ";";
			$dbo->setQuery($q);
			$dbo->execute();
			if($ord[0]['status'] == 'cancelled') {
				$q = "DELETE FROM `#__vikrentcar_orders` WHERE `id`='".$ord[0]['id']."' LIMIT 1;";
			}else {
				$q = "UPDATE `#__vikrentcar_orders` SET `idbusy`=NULL,`status`='cancelled' WHERE `id`='".$ord[0]['id']."';";
			}
			$dbo->setQuery($q);
			$dbo->execute();
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('VRMESSDELBUSY'));
		}
		if(!empty($pidbusy)) {
			$q = "DELETE FROM `#__vikrentcar_busy` WHERE `id`=".$dbo->quote($pidbusy)." LIMIT 1;";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=calendar&cid[]=".$pidcar);
}

function removePrice ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_prices` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	cancelEditingPrice($option);
}

function removeCat ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_categories` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	cancelEditingCat($option);
}

function removeCarat ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="SELECT `icon` FROM `#__vikrentcar_caratteristiche` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() == 1) {
				$rows = $dbo->loadAssocList();
				if (!empty($rows[0]['icon']) && file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$rows[0]['icon'])) {
					@unlink(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$rows[0]['icon']);
				}
			}	
			$q="DELETE FROM `#__vikrentcar_caratteristiche` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	cancelEditingCarat($option);
}

function removeOptionals ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="SELECT `img` FROM `#__vikrentcar_optionals` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() == 1) {
				$rows = $dbo->loadAssocList();
				if (!empty($rows[0]['img']) && file_exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$rows[0]['img'])) {
					@unlink(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$rows[0]['img']);
				}
			}	
			$q="DELETE FROM `#__vikrentcar_optionals` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	cancelEditingOptionals($option);
}

function removeOrders ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		//$moveoldor=vikrentcar::saveOldOrders();
		foreach($ids as $d) {
			$q="SELECT `o`.*,`b`.`stop_sales` FROM `#__vikrentcar_orders` AS `o` LEFT JOIN `#__vikrentcar_busy` `b` ON `b`.`id`=`o`.`idbusy` WHERE `o`.`id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() == 1) {
				$rows = $dbo->loadAssocList();
				if (!empty($rows[0]['idbusy'])) {
					$q="DELETE FROM `#__vikrentcar_busy` WHERE `id`='".$rows[0]['idbusy']."';";
					$dbo->setQuery($q);
					$dbo->execute();
				}
				/*
				//Deprecated and removed since VRC 1.11
				if ($moveoldor && $rows[0]['stop_sales'] != 1) {
					$q="INSERT INTO `#__vikrentcar_oldorders` (`tsdel`,`custdata`,`ts`,`status`,`idcar`,`days`,`ritiro`,`consegna`,`idtar`,`optionals`,`custmail`,`sid`,`idplace`,`idreturnplace`,`totpaid`,`hourly`,`coupon`) VALUES('".time()."',".$dbo->quote($rows[0]['custdata']).",'".$rows[0]['ts']."','".$rows[0]['status']."','".$rows[0]['idcar']."','".$rows[0]['days']."','".$rows[0]['ritiro']."','".$rows[0]['consegna']."','".$rows[0]['idtar']."','".$rows[0]['optionals']."','".$rows[0]['custmail']."','".$rows[0]['sid']."','".$rows[0]['idplace']."','".$rows[0]['idreturnplace']."','".$rows[0]['totpaid']."','".$rows[0]['hourly']."',".$dbo->quote($rows[0]['coupon']).");";
					$dbo->setQuery($q);
					$dbo->execute();
				}
				*/
				$q = "DELETE FROM `#__vikrentcar_tmplock` WHERE `idorder`=" . intval($rows[0]['id']) . ";";
				$dbo->setQuery($q);
				$dbo->execute();
				if($rows[0]['status'] == 'cancelled') {
					$q = "DELETE FROM `#__vikrentcar_orders` WHERE `id`='".$rows[0]['id']."';";
				}else {
					$q = "UPDATE `#__vikrentcar_orders` SET `idbusy`=NULL,`status`='cancelled' WHERE `id`='".$rows[0]['id']."';";
				}
				$dbo->setQuery($q);
				$dbo->execute();
			}
		}
		$app = JFactory::getApplication();
		$app->enqueueMessage(JText::_('VRMESSDELBUSY'));
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=vieworders");
}

function removeOldOrders ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_oldorders` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewoldorders");
}

function removeCar ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
			$q="DELETE FROM `#__vikrentcar_dispcost` WHERE `idcar`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=cars");
}

function unlockRecords ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_tmplock` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option);
}

function removeStats ($ids, $option) {
	if (@count($ids)) {
		$dbo = JFactory::getDBO();
		foreach($ids as $d){
			$q="DELETE FROM `#__vikrentcar_stats` WHERE `id`=".$dbo->quote($d).";";
			$dbo->setQuery($q);
			$dbo->execute();
		}
	}
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewstats");
}

function editOrder ($ido, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_orders` WHERE `id`=".$dbo->quote($ido).";";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		$q="SELECT `id`,`name` FROM `#__vikrentcar_gpayments` ORDER BY `#__vikrentcar_gpayments`.`name` ASC;";
		$dbo->setQuery($q);
		$dbo->execute();
		$payments = $dbo->getNumRows() > 0 ? $dbo->loadAssocList() : '';
		$padminnotes = VikRequest::getString('adminnotes', '', 'request');
		$pnewpayment = VikRequest::getString('newpayment', '', 'request');
		$padmindisc = VikRequest::getString('admindisc', '', 'request');
		$pcustmail = VikRequest::getString('custmail', '', 'request');
		$pcarindex = VikRequest::getString('carindex', '', 'request');
		$pnominative = VikRequest::getString('nominative', '', 'request');
		if (!empty($padminnotes)) {
			$q = "UPDATE `#__vikrentcar_orders` SET `adminnotes`=".$dbo->quote($padminnotes)." WHERE `id`=".$rows[0]['id'].";";
			$dbo->setQuery($q);
			$dbo->execute();
			$rows[0]['adminnotes'] = $padminnotes;
		}
		if (!empty($pnewpayment) && is_array($payments)) {
			foreach ($payments as $npay) {
				if ((int)$npay['id'] == (int)$pnewpayment) {
					$newpayvalid = $npay['id'].'='.$npay['name'];
					$q = "UPDATE `#__vikrentcar_orders` SET `idpayment`=".$dbo->quote($newpayvalid)." WHERE `id`=".$rows[0]['id'].";";
					$dbo->setQuery($q);
					$dbo->execute();
					$rows[0]['idpayment'] = $newpayvalid;
					break;
				}
			}
		}
		if (strlen($padmindisc) > 0) {
			if(floatval($padmindisc) > 0.00) {
				$admincoupon = '-1;'.floatval($padmindisc).';'.JText::_('VRCADMINDISCOUNT');
			}else {
				$admincoupon = '';
			}
			$q = "UPDATE `#__vikrentcar_orders` SET `coupon`=".$dbo->quote($admincoupon)." WHERE `id`=".$rows[0]['id'].";";
			$dbo->setQuery($q);
			$dbo->execute();
			$rows[0]['coupon'] = $admincoupon;
		}
		if (strlen($pcustmail) > 0) {
			$q = "UPDATE `#__vikrentcar_orders` SET `custmail`=".$dbo->quote($pcustmail)." WHERE `id`=".$rows[0]['id'].";";
			$dbo->setQuery($q);
			$dbo->execute();
			$rows[0]['custmail'] = $pcustmail;
		}
		if(isset($_REQUEST['carindex'])) {
			$q = "UPDATE `#__vikrentcar_orders` SET `carindex`=".(!empty($pcarindex) ? $dbo->quote($pcarindex) : 'NULL')." WHERE `id`=".$rows[0]['id'].";";
			$dbo->setQuery($q);
			$dbo->execute();
			$rows[0]['carindex'] = $pcarindex;
		}
		if (strlen($pnominative) > 0) {
			$q = "UPDATE `#__vikrentcar_orders` SET `nominative`=".$dbo->quote($pnominative)." WHERE `id`=".$rows[0]['id'].";";
			$dbo->setQuery($q);
			$dbo->execute();
			$rows[0]['nominative'] = $pnominative;
		}
		HTML_vikrentcar::pEditOrder($rows[0], $payments, $option);
	}else {
		cancelEditingOrders($option);
	}
}

function editOldOrder ($ido, $option) {
	$dbo = JFactory::getDBO();
	$q="SELECT * FROM `#__vikrentcar_oldorders` WHERE `id`=".$dbo->quote($ido).";";
	$dbo->setQuery($q);
	$dbo->execute();
	if ($dbo->getNumRows() == 1) {
		$rows = $dbo->loadAssocList();
		HTML_vikrentcar::pEditOldOrder($rows[0], $option);
	}else {
		cancelEditingOldOrders($option);
	}
}

function cancelEditingOldOrders($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewoldorders");
}

function cancelEditingOrders($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=vieworders");
}

function cancelEditing($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=cars");
}

function cancelEditingPlace($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewplaces");
}

function cancelEditingIva($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewiva");
}

function cancelEditingPrice($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewprices");
}

function cancelEditingCat($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcategories");
}

function cancelEditingCarat($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcarat");
}

function cancelEditingOptionals($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewoptionals");
}

function cancelEditingStats($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewstats");
}

function cancelCalendar($option) {
	$pidcar = VikRequest::getString('idcar', '', 'request');
	$preturn = VikRequest::getString('return', '', 'request');
	$pidorder = VikRequest::getString('idorder', '', 'request');
	$mainframe = JFactory::getApplication();
	if($preturn == 'order' && !empty($pidorder)) {
		$mainframe->redirect("index.php?option=".$option."&task=editorder&cid[]=".$pidorder);
	}else {
		$mainframe->redirect("index.php?option=".$option."&task=calendar&cid[]=".$pidcar);
	}
}

function goConfig($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=config");
}

function cancelEditingLocFee($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=locfees");
}

function cancelEditingSeason($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=seasons");
}

function cancelEditingPayment($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=payments");
}

function cancelEditingCustomf($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcustomf");
}

function cancelEditingCoupon($option) {
	$mainframe = JFactory::getApplication();
	$mainframe->redirect("index.php?option=".$option."&task=viewcoupons");
}

?>
