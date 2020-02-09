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

$option = JFactory::getApplication()->input->get('option');

defined('JPATH_COMPONENT_SITE') or define('JPATH_COMPONENT_SITE', JPATH_SITE.DIRECTORY_SEPARATOR.$option);
defined('JPATH_COMPONENT_ADMINISTRATOR') or define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.$option);

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

if( class_exists('JViewLegacy') ) {

	class JViewUI extends JViewLegacy {
		/* adapter for JViewLegacy */
	}

	class JControllerUI extends JControllerLegacy {
		/* adapter for JControllerLegacy */
	}

} else {

	class JViewUI extends JView {
		/* adapter for JView */
	}

	class JControllerUI extends JController {
		/* adapter for JController */
	}

}

?>