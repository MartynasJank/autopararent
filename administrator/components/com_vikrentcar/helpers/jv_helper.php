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

if(!class_exists('VikApplication')) {
	class VikApplication {
		
		public $jv = 3;
		
		function __construct($force_version = 0) {
			$version = new JVersion();
			$v = $version->getShortVersion();
			if(!empty($force_version)) {
				$v = $force_version;
			}
			if( version_compare($v, '1.5.0') >= 0 && version_compare($v, '1.6.0') < 0 ) {
				//any Joomla 1.5
				$this->jv = 1;
			}elseif( version_compare($v, '1.6.0') >= 0 && version_compare($v, '3.0') < 0 ) {
				//any Joomla from 1.6 to 2.5
				$this->jv = 2;
			}elseif( version_compare($v, '3.0') >= 0 ) {
				//any Joomla 3.x
				$this->jv = 3;
			}else {
				die('UNSUPPORTED JOOMLA VERSION '.$v);
			}
		}

		public function getAdminTableClass() {
			if( $this->jv < 3 ) {
				// 2.5
		 		return "adminlist";
			} else {
		  		// 3.x
		 		return "table table-striped";
		 	}
		}
		
		public function openTableHead() {
			if( $this->jv < 3 ) {
				// 2.5
		 		return "";
			} else {
		  		// 3.x
		 		return "<thead>";
		 	}
		}
		
		public function closeTableHead() {
			if( $this->jv < 3 ) {
				// 2.5
		 		return "";
			} else {
		  		// 3.x
		 		return "</thead>";
		 	}
		}
		
		public function getAdminThClass($h_align='center') {
			if( $this->jv < 3 ) {
				// 2.5
		 		return 'title';
			} else {
		  		// 3.x
		 		return 'title ' . $h_align;
		 	}
		}
		
		public function getAdminToggle($count) {
			if( $this->jv < 3 ) {
				// 2.5
		 		return '<input type="checkbox" name="toggle" value="" onclick="checkAll('.$count.');" />';
			} else {
		  		// 3.x
		 		return '<input type="checkbox" onclick="Joomla.checkAll(this)" value="" name="checkall-toggle" />';
		 	}
		}
		
		public function checkboxOnClick($js_arg = 'this.checked') {
			if( $this->jv < 3 ) {
				// 2.5
		 		return 'isChecked('.$js_arg.');';
			} else {
		  		// 3.x
		 		return 'Joomla.isChecked('.$js_arg.');';
		 	}
		}
		
		public function sendMail($from_address, $from_name, $to, $reply_address, $subject, $hmess, $is_html=true, $encoding='base64') {
			if( $this->jv < 3 ) {
				// 2.5
		 		JUtility::sendMail($from_address, $fromname, $to, $subject, $hmess, $is_html, null, null, null, $reply_address, $from_name);
			} else {
		  		// 3.x
		 		$mailer = JFactory::getMailer();
				$sender = array($from_address, $from_name);
				$mailer->setSender($sender);
				$mailer->addRecipient($to);
				$mailer->addReplyTo($reply_address);
				$mailer->setSubject($subject);
				$mailer->setBody($hmess);
				$mailer->isHTML($is_html);
				$mailer->Encoding = $encoding;
				$mailer->Send();
		 	}
		}
		
		public function addScript($path='', $arg1=false, $arg2=true, $arg3=false, $arg4=false) {
			if( empty($path) ) return; 
			
			if( $this->jv < 3 ) {
		 		$doc = JFactory::getDocument();
				$doc->addScript($path);
			} else {
		  		JHtml::_( 'script', $path, $arg1, $arg2, $arg3, $arg4 );
		 	}
		}
		
		public function emailToPunycode($email='') {
			if( $this->jv < 3 ) {
		 		// 2.5
		 		return $email;
			} else {
				// 3.x
		  		return JStringPunycode::emailToPunycode($email);
			}
		}

		public function printYesNoButtons($name, $label_yes, $label_no, $cur_value = '1', $yes_value = '1', $no_value = '0', $id_yes = '', $id_no = '', $oldjv_inp_type = 'checkbox') {
			$html = '';
			$id_yes = empty($id_yes) ? $name.'-on' : $id_yes;
			$id_no = empty($id_no) ? $name.'-off' : $id_no;
			if( $this->jv < 3 ) {
				//Joomla 2.5
				if($oldjv_inp_type == 'checkbox') {
					$html = '<input type="checkbox" id="'.$name.'-field" value="'.$yes_value.'" name="'.$name.'"'.($cur_value === $yes_value ? ' checked="checked"' : '').'>';
				}else {
					//radio buttons
					$html = '<input type="radio" id="'.$id_yes.'" value="'.$yes_value.'" name="'.$name.'" class="btn-group"'.($cur_value === $yes_value ? ' checked="checked"' : '').'>
			<label style="display: inline-block; margin: 0;" for="'.$id_yes.'">'.$label_yes.'</label>&nbsp;&nbsp;
			<input type="radio" id="'.$id_no.'" value="'.$no_value.'" name="'.$name.'" class="btn-group"'.($cur_value === $no_value ? ' checked="checked"' : '').'>
			<label style="display: inline-block; margin: 0;" for="'.$id_no.'">'.$label_no.'</label>';
				}
			}else {
				//Joomla 3.x
				$html = '<div class="controls">
		<fieldset class="radio btn-group btn-group-yesno">
			<input type="radio" id="'.$id_yes.'" value="'.$yes_value.'" name="'.$name.'" class="btn-group"'.($cur_value === $yes_value ? ' checked="checked"' : '').'>
			<label style="display: inline-block; margin: 0;" for="'.$id_yes.'">'.$label_yes.'</label>
			<input type="radio" id="'.$id_no.'" value="'.$no_value.'" name="'.$name.'" class="btn-group"'.($cur_value === $no_value ? ' checked="checked"' : '').'>
			<label style="display: inline-block; margin: 0;" for="'.$id_no.'">'.$label_no.'</label>
		</fieldset>
	</div>';
			}

			return $html;
		}

	}
}

?>
