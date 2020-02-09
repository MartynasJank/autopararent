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

class VikrentcarViewUserorders extends JViewLegacy {
	function display($tpl = null) {
		$dbo = JFactory::getDBO();
		$pconfirmnum = VikRequest::getString('confirmnum', '', 'request');
		$pitemid = VikRequest::getString('Itemid', '', 'request');
		if (!empty($pconfirmnum)) {
			$parts = explode('_', $pconfirmnum);
			$sid = $parts[0];
			$ts = $parts[1];
			if (!empty ($sid) && !empty ($ts)) {
				$q = "SELECT `id`,`ts`,`sid` FROM `#__vikrentcar_orders` WHERE `sid`=" . $dbo->quote($sid) . " AND `ts`=" . $dbo->quote($ts) . ";";
				$dbo->setQuery($q);
				$dbo->execute();
				if ($dbo->getNumRows() > 0) {
					$order = $dbo->loadAssocList();
					$mainframe = JFactory::getApplication();
					$mainframe->redirect(JRoute::_('index.php?option=com_vikrentcar&task=vieworder&sid='.$order[0]['sid'].'&ts='.$order[0]['ts'].(!empty($pitemid) ? '&Itemid='.$pitemid : ''), false));
				}else {
					VikError::raiseWarning('', JText::_('VRCINVALIDCONFNUMB'));
				}
			}else {
				VikError::raiseWarning('', JText::_('VRCINVALIDCONFNUMB'));
			}
		}
		$rows = "";
		$pagelinks = "";
		$islogged = 0;
		$psearchorder = VikRequest::getString('searchorder', '', 'request');
		$searchorder = intval($psearchorder) == 1 ? 1 : 0;
		if (vikrentcar::userIsLogged()) {
			$islogged = 1;
			$user = JFactory::getUser();
			//number of orders per page
			$lim=15;
			//
			$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
			$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `#__vikrentcar_orders` WHERE `ujid`='".$user->id."' ORDER BY `#__vikrentcar_orders`.`ts` DESC";
			$dbo->setQuery($q, $lim0, $lim);
			$rows=$dbo->loadAssocList();
			if (!empty($rows)) {
				$dbo->setQuery('SELECT FOUND_ROWS();');
				jimport('joomla.html.pagination');
				$pageNav = new JPagination( $dbo->loadResult(), $lim0, $lim );
				$pagelinks="<table align=\"center\"><tr><td>".$pageNav->getPagesLinks()."</td></tr></table>";
			}
			$this->rows = &$rows;
			$this->searchorder = &$searchorder;
			$this->islogged = &$islogged;
			$this->pagelinks = &$pagelinks;
			//theme
			$theme = vikrentcar::getTheme();
			if($theme != 'default') {
				$thdir = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS.$theme.DS.'userorders';
				if(is_dir($thdir)) {
					$this->_setPath('template', $thdir.DS);
				}
			}
			//
			parent::display($tpl);
		}else {
			if ($searchorder == 1) {
				$this->rows = &$rows;
				$this->searchorder = &$searchorder;
				$this->islogged = &$islogged;
				$this->pagelinks = &$pagelinks;
				//theme
				$theme = vikrentcar::getTheme();
				if($theme != 'default') {
					$thdir = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS.$theme.DS.'userorders';
					if(is_dir($thdir)) {
						$this->_setPath('template', $thdir.DS);
					}
				}
				//
				parent::display($tpl);
			}else {
				VikError::raiseWarning('', JText::_('VRCLOGINFIRST'));
				$mainframe = JFactory::getApplication();
				$mainframe->redirect(JRoute::_('index.php?option=com_vikrentcar&view=loginregister'.(!empty($pitemid) ? '&Itemid='.$pitemid : ''), false));
			}
		}
	}
}


?>