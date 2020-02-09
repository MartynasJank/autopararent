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

jimport('joomla.application.component.view');

class VikrentcarViewCardetails extends JViewLegacy {
	function display($tpl = null) {
		vikrentcar::prepareViewContent();
		$pcarid = VikRequest::getString('carid', '', 'request');
		$dbo = JFactory::getDBO();
		$vrc_tn = vikrentcar::getTranslator();
		$q = "SELECT * FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($pcarid)." AND `avail`='1';";
		$dbo->setQuery($q);
		$dbo->execute();
		if($dbo->getNumRows() == 1) {
			$car=$dbo->loadAssocList();
			$vrc_tn->translateContents($car, '#__vikrentcar_cars');
			$q="SELECT `id`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`=".$dbo->quote($car[0]['id'])." AND `days`='1' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
			$dbo->setQuery($q);
			$dbo->execute();
			if($dbo->getNumRows() == 1) {
				$tar=$dbo->loadAssocList();
				$car[0]['cost']=$tar[0]['cost'];
			}else {
				$q="SELECT `id`,`days`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`=".$dbo->quote($car[0]['id'])." ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
				$dbo->setQuery($q);
				$dbo->execute();
				if($dbo->getNumRows() == 1) {
					$tar=$dbo->loadAssocList();
					$car[0]['cost']=($tar[0]['cost'] / $tar[0]['days']);
				}else {
					$car[0]['cost']=0;
				}
			}
			$actnow=time();
			$q="SELECT * FROM `#__vikrentcar_busy` WHERE `idcar`='".$car[0]['id']."' AND (`ritiro`>=".$actnow." OR `consegna`>=".$actnow.");";
			$dbo->setQuery($q);
			$dbo->execute();
			if ($dbo->getNumRows() > 0) {
				$busy = $dbo->loadAssocList();
			}else {
				$busy="";
			}
			//VRC 1.9
			$car_params = !empty($car[0]['params']) ? json_decode($car[0]['params'], true) : array();
			$document = JFactory::getDocument();
			if(!empty($car_params['custptitle'])) {
				$ctitlewhere = !empty($car_params['custptitlew']) ? $car_params['custptitlew'] : 'before';
				$set_title = $car_params['custptitle'].' - '.$document->getTitle();
				if($ctitlewhere == 'after') {
					$set_title = $document->getTitle().' - '.$car_params['custptitle'];
				}elseif($ctitlewhere == 'replace') {
					$set_title = $car_params['custptitle'];
				}
				$document->setTitle($set_title);
			}
			if(!empty($car_params['metakeywords'])) {
				$document->setMetaData('keywords', $car_params['metakeywords']);
			}
			if(!empty($car_params['metadescription'])) {
				$document->setMetaData('description', $car_params['metadescription']);
			}
			//
			$this->car = &$car[0];
			$this->car_params = &$car_params;
			$this->busy = &$busy;
			$this->vrc_tn = &$vrc_tn;
			//theme
			$theme = vikrentcar::getTheme();
			if($theme != 'default') {
				$thdir = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS.$theme.DS.'cardetails';
				if(is_dir($thdir)) {
					$this->_setPath('template', $thdir.DS);
				}
			}
			//
			parent::display($tpl);
		}else {
			$mainframe = JFactory::getApplication();
			$mainframe->redirect("index.php?option=com_vikrentcar&view=carslist");
		}
	}
}
?>