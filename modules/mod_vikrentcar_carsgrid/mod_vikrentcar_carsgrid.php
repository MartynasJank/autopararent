<?php
/**------------------------------------------------------------------------
 * mod_vikrentcar_carsgrid - VikRentCar
 * ------------------------------------------------------------------------
 * author    Alessio Gaggii - Extensionsforjoomla.com
 * copyright Copyright (C) 2016 extensionsforjoomla.com. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.extensionsforjoomla.com
 * Technical Support:  tech@extensionsforjoomla.com
 * ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root().'modules/mod_vikrentcar_carsgrid/mod_vikrentcar_carsgrid.css');

$params->def('numb', 4);
$params->def('query', 'price');
$params->def('order', 'asc');
$params->def('catid', 0);
$params->def('querycat', 'price');
$params->def('currency', '&euro;');
$params->def('showcatname', 1);
$showcatname = intval($params->get('showcatname')) == 1 ? true : false;

$cars = modvikrentcar_carsgridHelper::getCars($params);
$cars = modvikrentcar_carsgridHelper::limitRes($cars, $params);

require JModuleHelper::getLayoutPath('mod_vikrentcar_carsgrid', $params->get('layout', 'default'));
