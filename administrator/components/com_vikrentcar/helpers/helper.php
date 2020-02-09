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

class VikHelper {
	
	/*
	* @param $arr_values array
	* @param $current_key string
	* @param $empty_value string string (J3.x only)
	* @param $default
	* @param $input_name string
	*/
	public static function getDropDown($arr_values, $current_key, $empty_value, $default, $input_name) {
		$dropdown = '';
		$x = rand(1, 999);
		if(defined('JVERSION') && version_compare(JVERSION, '2.6.0') < 0) {
			//Joomla 2.5
			$dropdown .= '<select name="'.$input_name.'" onchange="document.adminForm.submit();">'."\n";
			$dropdown .= '<option value="">'.$default.'</option>'."\n";
			$list = "\n";
			foreach ($arr_values as $k => $v) {
				$dropdown .= '<option value="'.$k.'"'.($k == $current_key ? ' selected="selected"' : '').'>'.$v.'</option>'."\n";
			}
			$dropdown .= '</select>'."\n";
		}else {
			//Joomla 3.x
			$dropdown .= '<script type="text/javascript">'."\n";
			$dropdown .= 'function dropDownChange'.$x.'(setval) {'."\n";
			$dropdown .= '	document.getElementById("dropdownval'.$x.'").value = setval;'."\n";
			$dropdown .= '	document.adminForm.submit();'."\n";
			$dropdown .= '}'."\n";
			$dropdown .= '</script>'."\n";
			$dropdown .= '<input type="hidden" name="'.$input_name.'" value="'.$current_key.'" id="dropdownval'.$x.'"/>'."\n";
			$list = "\n";
			foreach ($arr_values as $k => $v) {
				if($k == $current_key) {
					$default = $v;
				}
				$list .= '<li><a href="javascript: void(0);" onclick="dropDownChange'.$x.'(\''.$k.'\');">'.$v.'</a></li>'."\n";
			}
			$list .= '<li class="divider"></li>'."\n".'<li><a href="javascript: void(0);" onclick="dropDownChange'.$x.'(\'\');">'.$empty_value.'</a></li>'."\n";
			$dropdown .= '<div class="btn-group">
		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">'.$default.' <span class="caret"></span></button>
		<ul class="dropdown-menu" role="menu">'.
			$list.
		'</ul>
	</div>';
		}

		return $dropdown;
	}

}

?>