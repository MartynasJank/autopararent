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

class vikRentCarPayment {
	
	private $order_info;
	
	public function __construct ($order) {
		$this->order_info=$order;
	}
	
	public function showPayment () {
		$depositmess="";
		if($this->order_info['leave_deposit']) {
			$depositmess="<br/><p><strong>".JText::_('VRLEAVEDEPOSIT')." ".vikrentcar::numberFormat($this->order_info['total_to_pay'])." ".$this->order_info['currency_symb']."</strong></p><br/>";
		}
		//output
		echo $depositmess;
		echo $this->order_info['payment_info']['note'];
		
		return true;
	}
	
	public function validatePayment () {
		$array_result=array();
		$array_result['verified']=1;
		
		return $array_result;
	}
	
}


?>