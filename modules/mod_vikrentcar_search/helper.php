<?php
/**
 * @package     VikRentCar
 * @subpackage  mod_vikrentcar_search
 * @author      Alessio Gaggii - e4j - Extensionsforjoomla.com
 * @copyright   Copyright (C) 2017 e4j - Extensionsforjoomla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://e4j.com
 */

defined('_JEXEC') or die('Restricted Area');

class modVikrentcarSearchHelper {

    public static function getFormattingText(&$params){
        $tx = $params->get('heading_text');
        $tag = $params->get('tag_heading');
        $cssc = $params->get('css_tag_heading');
        if(strlen($tx)){
        	if(strlen($tag)){
        		$tag=str_replace("<", "", $tag);
        		$tag=str_replace(">", "", $tag);
        		$tag=str_replace("/", "", $tag);
        		return "<".$tag.(!empty($cssc) ? " class=\"".$cssc."\"" : "").">".$tx."</".$tag.">";
        	}else{
        		return $tx."<br/>";
        	}
        }
        return "";
    }
	
	public static function mgetHoursMinutes($secs) {
		if ($secs >= 3600) {
			$op = $secs / 3600;
			$hours = floor($op);
			$less = $hours * 3600;
			$newsec = $secs - $less;
			$optwo = $newsec / 60;
			$minutes = floor($optwo);
		} else {
			$hours = "0";
			$optwo = $secs / 60;
			$minutes = floor($optwo);
		}
		$x[] = $hours;
		$x[] = $minutes;
		return $x;
	}
	
	public static function formatLocationClosingDays($clostr) {
		$ret = array();
		$x = explode(",", $clostr);
		foreach($x as $y) {
			if (strlen(trim($y)) > 0) {
				$parts = explode("-", trim($y));
				$date = date('Y-n-j', mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
				if (strlen($date) > 0) {
					$ret[] = '"'.$date.'"';
				}
			}
		}
		return $ret;
	}
	
	public static function setDropDatePlus() {
		$session = JFactory::getSession();
		$sval = $session->get('setDropDatePlus', '');
		if(!empty($sval)) {
			return $sval;
		}else {
			$dbo = JFactory::getDBO();
			$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='setdropdplus';";
			$dbo->setQuery($q);
			$dbo->Query($q);
			$s = $dbo->loadAssocList();
			return $s[0]['setting'];
		}
	}

	public static function getMinDaysAdvance($skipsession = false) {
		if($skipsession) {
			$dbo = JFactory::getDBO();
			$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='mindaysadvance';";
			$dbo->setQuery($q);
			$dbo->Query($q);
			$s = $dbo->loadAssocList();
			return (int)$s[0]['setting'];
		}else {
			$session = JFactory::getSession();
			$sval = $session->get('vrcminDaysAdvance', '');
			if(!empty($sval)) {
				return (int)$sval;
			}else {
				$dbo = JFactory::getDBO();
				$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='mindaysadvance';";
				$dbo->setQuery($q);
				$dbo->Query($q);
				$s = $dbo->loadAssocList();
				$session->set('vrcminDaysAdvance', $s[0]['setting']);
				return (int)$s[0]['setting'];
			}
		}
	}
	
	public static function getMaxDateFuture($skipsession = false) {
		if($skipsession) {
			$dbo = JFactory::getDBO();
			$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='maxdate';";
			$dbo->setQuery($q);
			$dbo->Query($q);
			$s = $dbo->loadAssocList();
			return $s[0]['setting'];
		}else {
			$session = JFactory::getSession();
			$sval = $session->get('vrcmaxDateFuture', '');
			if(!empty($sval)) {
				return $sval;
			}else {
				$dbo = JFactory::getDBO();
				$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='maxdate';";
				$dbo->setQuery($q);
				$dbo->Query($q);
				$s = $dbo->loadAssocList();
				$session->set('vrcmaxDateFuture', $s[0]['setting']);
				return $s[0]['setting'];
			}
		}
	}
	
	public static function getFirstWeekDay($skipsession = false) {
		if($skipsession) {
			$dbo = JFactory::getDBO();
			$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='firstwday';";
			$dbo->setQuery($q);
			$dbo->Query($q);
			$s = $dbo->loadAssocList();
			return $s[0]['setting'];
		}else {
			$session = JFactory::getSession();
			$sval = $session->get('vrcfirstWeekDay', '');
			if(strlen($sval)) {
				return $sval;
			}else {
				$dbo = JFactory::getDBO();
				$q = "SELECT `setting` FROM `#__vikrentcar_config` WHERE `param`='firstwday';";
				$dbo->setQuery($q);
				$dbo->Query($q);
				$s = $dbo->loadAssocList();
				$session->set('vrcfirstWeekDay', $s[0]['setting']);
				return $s[0]['setting'];
			}
		}
	}
	
	public static function getTranslator() {
		if(!class_exists('vikrentcar')) {
			require_once(JPATH_SITE.DIRECTORY_SEPARATOR.'components'.DIRECTORY_SEPARATOR.'com_vikrentcar'.DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'lib.vikrentcar.php');
		}
		return vikrentcar::getTranslator();
	}
	
}

?>
