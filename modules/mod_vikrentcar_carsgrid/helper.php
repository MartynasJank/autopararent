<?php
/**------------------------------------------------------------------------
 * mod_vikrentcar_carsgrid - VikRentCar
 * ------------------------------------------------------------------------
 * author    Alessio Gaggii - Extensionsforjoomla.com
 * copyright Copyright (C) 2013 extensionsforjoomla.com. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.extensionsforjoomla.com
 * Technical Support:  tech@extensionsforjoomla.com
 * ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

class modvikrentcar_carsgridHelper {
	public static function getCars($params) {
		$dbo = JFactory::getDBO();
		$vrc_tn = self::getTranslator();
		$showcatname = intval($params->get('showcatname')) == 1 ? true : false;
		$cars = array();
		$query = $params->get('query');
		if($query == 'price') {
			//simple order by price asc
			$q = "SELECT `id`,`name`,`img`,`idcat`,`startfrom`,`short_info` FROM `#__vikrentcar_cars` WHERE `avail`='1';";
			$dbo->setQuery($q);
			$dbo->Query($q);
			if($dbo->getNumRows() > 0) {
				$cars=$dbo->loadAssocList();
				$vrc_tn->translateContents($cars, '#__vikrentcar_cars');
				foreach($cars as $k=>$c) {
					if($showcatname) $cars[$k]['catname'] = self::getCategoryName($c['idcat']);
					if(strlen($c['startfrom']) > 0 && $c['startfrom'] > 0.00) {
						$cars[$k]['cost']=$c['startfrom'];
					}else {
						$q="SELECT `id`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$c['id']."' AND `days`='1' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->Query($q);
						if($dbo->getNumRows() == 1) {
							$tar=$dbo->loadAssocList();
							$cars[$k]['cost']=$tar[0]['cost'];
						}else {
							$q="SELECT `id`,`days`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$c['id']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->Query($q);
							if($dbo->getNumRows() == 1) {
								$tar=$dbo->loadAssocList();
								$cars[$k]['cost']=($tar[0]['cost'] / $tar[0]['days']);
							}else {
								$cars[$k]['cost']=0;
							}
						}
					}
				}
			}
			$cars = self::sortCarsByPrice($cars, $params);
		}elseif($query == 'name') {
			//order by name
			$q = "SELECT `id`,`name`,`img`,`idcat`,`startfrom` FROM `#__vikrentcar_cars` WHERE `avail`='1' ORDER BY `#__vikrentcar_cars`.`name` ".strtoupper($params->get('order'))." LIMIT ".$params->get('numb').";";
			$dbo->setQuery($q);
			$dbo->Query($q);
			if($dbo->getNumRows() > 0) {
				$cars=$dbo->loadAssocList();
				$vrc_tn->translateContents($cars, '#__vikrentcar_cars');
				foreach($cars as $k=>$c) {
					if($showcatname) $cars[$k]['catname'] = self::getCategoryName($c['idcat']);
					if(strlen($c['startfrom']) > 0 && $c['startfrom'] > 0.00) {
						$cars[$k]['cost']=$c['startfrom'];
					}else {
						$q="SELECT `id`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$c['id']."' AND `days`='1' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->Query($q);
						if($dbo->getNumRows() == 1) {
							$tar=$dbo->loadAssocList();
							$cars[$k]['cost']=$tar[0]['cost'];
						}else {
							$q="SELECT `id`,`days`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$c['id']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->Query($q);
							if($dbo->getNumRows() == 1) {
								$tar=$dbo->loadAssocList();
								$cars[$k]['cost']=($tar[0]['cost'] / $tar[0]['days']);
							}else {
								$cars[$k]['cost']=0;
							}
						}
					}
				}
			}
		}else {
			//sort by category
			$q = "SELECT `id`,`name`,`img`,`idcat`,`idcarat`,`info`,`startfrom`,`short_info` FROM `#__vikrentcar_cars` WHERE `avail`='1' AND (`idcat`='".$params->get('catid').";' OR `idcat` LIKE '".$params->get('catid').";%' OR `idcat` LIKE '%;".$params->get('catid').";%' OR `idcat` LIKE '%;".$params->get('catid').";') ORDER BY `#__vikrentcar_cars`.`name` ".strtoupper($params->get('order'))." LIMIT ".$params->get('numb').";";
			$dbo->setQuery($q);
			$dbo->Query($q);
			if($dbo->getNumRows() > 0) {
				$cars=$dbo->loadAssocList();
				$vrc_tn->translateContents($cars, '#__vikrentcar_cars');
				foreach($cars as $k=>$c) {
					if($showcatname) $cars[$k]['catname'] = self::getCategoryName($c['idcat']);
					if(strlen($c['startfrom']) > 0 && $c['startfrom'] > 0.00) {
						$cars[$k]['cost']=$c['startfrom'];
					}else {
						$q="SELECT `id`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$c['id']."' AND `days`='1' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
						$dbo->setQuery($q);
						$dbo->Query($q);
						if($dbo->getNumRows() == 1) {
							$tar=$dbo->loadAssocList();
							$cars[$k]['cost']=$tar[0]['cost'];
						}else {
							$q="SELECT `id`,`days`,`cost` FROM `#__vikrentcar_dispcost` WHERE `idcar`='".$c['id']."' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC LIMIT 1;";
							$dbo->setQuery($q);
							$dbo->Query($q);
							if($dbo->getNumRows() == 1) {
								$tar=$dbo->loadAssocList();
								$cars[$k]['cost']=($tar[0]['cost'] / $tar[0]['days']);
							}else {
								$cars[$k]['cost']=0;
							}
						}
					}
				}
			}
			if($params->get('querycat') == 'price') {
				$cars = self::sortCarsByPrice($cars, $params);
			}
		}
		return $cars;
	}
	
	public static function sortCarsByPrice($arr, $params) {
		$newarr = array ();
		foreach ($arr as $k => $v) {
			$newarr[$k] = $v['cost'];
		}
		asort($newarr);
		$sorted = array ();
		foreach ($newarr as $k => $v) {
			$sorted[$k] = $arr[$k];
		}
		return $params->get('order') == 'desc' ? array_reverse($sorted) : $sorted;
	}
	
	public static function getCategoryName($idcat) {
		$vrc_tn = self::getTranslator();
		$dbo = JFactory::getDBO();
		$q = "SELECT `id`,`name` FROM `#__vikrentcar_categories` WHERE `id`='" . str_replace(";", "", $idcat) . "';";
		$dbo->setQuery($q);
		$dbo->Query($q);
		if($dbo->getNumRows() > 0) {
			$p = $dbo->loadAssocList();
			$vrc_tn->translateContents($p, '#__vikrentcar_categories');
			return $p[0]['name'];
		}
		return '';
	}
	
	public static function limitRes($cars, $params) {
		return array_slice($cars, 0, $params->get('numb'));
	}

	public static function getTranslator() {
		if(!function_exists('vikrentcar')) {
			require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'lib.vikrentcar.php');
		}
		return vikrentcar::getTranslator();
	}

	public static function numberFormat($numb) {
		if(!function_exists('vikrentcar')) {
			require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'lib.vikrentcar.php');
		}
		return vikrentcar::numberFormat($numb);
	}
	
}
