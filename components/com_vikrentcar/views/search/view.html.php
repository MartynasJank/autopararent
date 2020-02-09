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

class VikrentcarViewSearch extends JViewLegacy {
	function display($tpl = null) {
		if (vikrentcar::allowRent()) {
			$session = JFactory::getSession();
			$vrc_tn = vikrentcar::getTranslator();
			$pplace = VikRequest::getString('place', '', 'request');
			$returnplace = VikRequest::getString('returnplace', '', 'request');
			$ppickupdate = VikRequest::getString('pickupdate', '', 'request');
			$ppickupm = VikRequest::getString('pickupm', '', 'request');
			$ppickuph = VikRequest::getString('pickuph', '', 'request');
			$preleasedate = VikRequest::getString('releasedate', '', 'request');
			$preleasem = VikRequest::getString('releasem', '', 'request');
			$preleaseh = VikRequest::getString('releaseh', '', 'request');
			$pcategories = VikRequest::getString('categories', '', 'request');
			if (!empty ($ppickupdate) && !empty ($preleasedate)) {
				$nowdf = vikrentcar::getDateFormat();
				if ($nowdf == "%d/%m/%Y") {
					$df = 'd/m/Y';
				}elseif ($nowdf == "%m/%d/%Y") {
					$df = 'm/d/Y';
				}else {
					$df = 'Y/m/d';
				}
				if (vikrentcar::dateIsValid($ppickupdate) && vikrentcar::dateIsValid($preleasedate)) {
					$first = vikrentcar::getDateTimestamp($ppickupdate, $ppickuph, $ppickupm);
					$second = vikrentcar::getDateTimestamp($preleasedate, $preleaseh, $preleasem);
					$actnow = time();
					$midnight_ts = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
					$today_bookings = vikrentcar::todayBookings();
					if($today_bookings) {
						$actnow = $midnight_ts;
					}
					$checkhourly = false;
					//vikrentcar 1.6
					$checkhourscharges = 0;
					//
					$hoursdiff = 0;
					$min_days_adv = vikrentcar::getMinDaysAdvance();
					$days_to_pickup = floor(($first - $midnight_ts) / 86400);
					if ($second > $first && $first >= $actnow && ($min_days_adv < 1 || $days_to_pickup >= $min_days_adv)) {
						$secdiff = $second - $first;
						$daysdiff = $secdiff / 86400;
						if (is_int($daysdiff)) {
							if ($daysdiff < 1) {
								$daysdiff = 1;
							}
						} else {
							if ($daysdiff < 1) {
								$daysdiff = 1;
								$checkhourly = true;
								$ophours = $secdiff / 3600;
								$hoursdiff = intval(round($ophours));
								if($hoursdiff < 1) {
									$hoursdiff = 1;
								}
							} else {
								$sum = floor($daysdiff) * 86400;
								$newdiff = $secdiff - $sum;
								$maxhmore = vikrentcar::getHoursMoreRb() * 3600;
								if ($maxhmore >= $newdiff) {
									$daysdiff = floor($daysdiff);
								} else {
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
						$dbo = JFactory::getDBO();
						$q = "SELECT * FROM `#__vikrentcar_dispcost` WHERE `days`='" . $daysdiff . "' ORDER BY `#__vikrentcar_dispcost`.`cost` ASC, `#__vikrentcar_dispcost`.`idcar` ASC;";
						$dbo->setQuery($q);
						$dbo->execute();
						if ($dbo->getNumRows() > 0) {
							$tars = $dbo->loadAssocList();
							$arrtar = array();
							foreach ($tars as $tar) {
								$arrtar[$tar['idcar']][] = $tar;
							}
							//vikrentcar 1.5
							if($checkhourly) {
								$arrtar = vikrentcar::applyHourlyPrices($arrtar, $hoursdiff);
							}
							//
							//vikrentcar 1.6
							if($checkhourscharges > 0 && $aehourschbasp == true) {
								$arrtar = vikrentcar::applyExtraHoursChargesPrices($arrtar, $checkhourscharges, $daysdiff);
							}
							//
							$filterplace = (!empty($pplace));
							$filtercat = (!empty($pcategories) && $pcategories != "all");
							//vikrentcar 1.5
							$groupdays = vikrentcar::getGroupDays($first, $second, $daysdiff);
							$morehst = vikrentcar::getHoursCarAvail() * 3600;
							//
							//vikrentcar 1.7 location closing days
							$errclosingdays = '';
							if ($filterplace) {
								$errclosingdays = vikrentcar::checkValidClosingDays($groupdays, $pplace, $returnplace);
							}
							if (empty($errclosingdays)) {
								$all_characteristics = array();
								foreach ($arrtar as $kk => $tt) {
									$check = "SELECT * FROM `#__vikrentcar_cars` WHERE `id`='" . $kk . "';";
									$dbo->setQuery($check);
									$dbo->execute();
									$car = $dbo->loadAssocList();
									$vrc_tn->translateContents($car, '#__vikrentcar_cars');
									if (intval($car[0]['avail']) == 0) {
										unset ($arrtar[$kk]);
										continue;
									} else {
										if ($filterplace) {
											$actplaces = explode(";", $car[0]['idplace']);
											if (!in_array($pplace, $actplaces)) {
												unset ($arrtar[$kk]);
												continue;
											}
											$actretplaces = explode(";", $car[0]['idretplace']);
											if (!in_array($returnplace, $actretplaces)) {
												unset ($arrtar[$kk]);
												continue;
											}
										}
										if ($filtercat) {
											$cats = explode(";", $car[0]['idcat']);
											if (!in_array($pcategories, $cats)) {
												unset ($arrtar[$kk]);
												continue;
											}
										}
									}
									$check = "SELECT `id`,`ritiro`,`consegna`,`stop_sales` FROM `#__vikrentcar_busy` WHERE `idcar`='" . $kk . "' AND `consegna` > ".time().";";
									$dbo->setQuery($check);
									$dbo->execute();
									if ($dbo->getNumRows() > 0) {
										$busy = $dbo->loadAssocList();
										foreach ($groupdays as $kgd => $gday) {
											$bfound = 0;
											foreach ($busy as $bu) {
												if ($gday >= $bu['ritiro'] && $gday <= ($morehst + $bu['consegna'])) {
													$bfound++;
													if($bu['stop_sales'] == 1) {
														$bfound = $car[0]['units'];
														break;
													}
												}elseif(count($groupdays) == 2 && $gday == $groupdays[0]) {
													//VRC 1.7
													if($groupdays[0] < $bu['ritiro'] && $groupdays[0] < ($morehst + $bu['consegna']) && $groupdays[1] > $bu['ritiro'] && $groupdays[1] > ($morehst + $bu['consegna'])) {
														$bfound++;
														if($bu['stop_sales'] == 1) {
															$bfound = $car[0]['units'];
															break;
														}
													}
												}elseif (!empty($groupdays[($kgd + 1)]) && (($bu['consegna'] - $bu['ritiro']) < 86400) && $gday < $bu['ritiro'] && $groupdays[($kgd + 1)] > $bu['consegna']) {
													//VRC 1.10 availability check whith hourly rentals
													$bfound++;
													if($bu['stop_sales'] == 1) {
														$bfound = $car[0]['units'];
														break;
													}
												}elseif(count($groupdays) > 2 && array_key_exists(($kgd - 1), $groupdays) && array_key_exists(($kgd + 1), $groupdays)) {
													//VRC 1.10 gday is at midnight and the pickup for this date may be at a later time
													if($groupdays[($kgd - 1)] < $bu['ritiro'] && $groupdays[($kgd - 1)] < ($morehst + $bu['consegna']) && $gday < $bu['ritiro'] && $groupdays[($kgd + 1)] > $bu['ritiro'] && $gday <= ($morehst + $bu['consegna'])) {
														$bfound++;
														if($bu['stop_sales'] == 1) {
															$bfound = $car[0]['units'];
															break;
														}
													}
												}
											}
											if ($bfound >= $car[0]['units']) {
												unset ($arrtar[$kk]);
												break;
											}
										}
									}
									if (!vikrentcar::carNotLocked($kk, $car[0]['units'], $first, $second)) {
										unset ($arrtar[$kk]);
									}
									//Push Characteristics
									$all_characteristics = vikrentcar::pushCarCharacteristics($all_characteristics, $car[0]['idcarat']);
								}
								if (@ count($arrtar) > 0) {
									if (vikrentcar::allowStats()) {
										$q = "INSERT INTO `#__vikrentcar_stats` (`ts`,`ip`,`place`,`cat`,`ritiro`,`consegna`,`res`) VALUES('" . time() . "','" . getenv('REMOTE_ADDR') . "'," . $dbo->quote($pplace . ';' . $returnplace) . "," . $dbo->quote($pcategories) . ",'" . $first . "','" . $second . "','" . count($arrtar) . "');";
										$dbo->setQuery($q);
										$dbo->execute();
									}
									if (vikrentcar::sendMailStats()) {
										$admsg = vikrentcar::getFrontTitle() . ", " . JText::_('VRSRCHNOTM') . "\n\n";
										$admsg .= JText::_('VRDATE') . ": " . date($df . ' H:i:s') . "\n";
										$admsg .= JText::_('VRIP') . ": " . getenv('REMOTE_ADDR') . "\n";
										$admsg .= (!empty ($pplace) ? JText::_('VRPLACE') . ": " . vikrentcar::getPlaceName($pplace) : "") . (!empty ($returnplace) ? " - " . vikrentcar::getPlaceName($returnplace) : "") . "\n";
										if (!empty ($pcategories)) {
											$admsg .= ($pcategories == "all" ? JText::_('VRCAT') . ": " . JText::_('VRANY') : JText::_('VRCAT') . ": " . vikrentcar::getCategoryName($pcategories)) . "\n";
										}
										$admsg .= JText::_('VRPICKUP') . ": " . date($df . ' H:i', $first) . "\n";
										$admsg .= JText::_('VRRETURN') . ": " . date($df . ' H:i', $second) . "\n";
										$admsg .= JText::_('VRSRCHRES') . ": " . count($arrtar);
										$adsubj = JText::_('VRSRCHNOTM') . ' ' . vikrentcar::getFrontTitle();
										$adsubj = '=?UTF-8?B?' . base64_encode($adsubj) . '?=';
										$admail = vikrentcar::getAdminMail();
										$mailer = JFactory::getMailer();
										$sender = array($admail, $admail);
										$mailer->setSender($sender);
										$mailer->addRecipient($admail);
										$mailer->addReplyTo($admail);
										$mailer->setSubject($adsubj);
										$mailer->setBody($admsg);
										$mailer->isHTML(false);
										$mailer->Encoding = 'base64';
										$mailer->Send();
									}
									//vikrentcar 1.6
									if($checkhourscharges > 0 && $aehourschbasp == false) {
										$arrtar = vikrentcar::extraHoursSetPreviousFare($arrtar, $checkhourscharges, $daysdiff);
										$arrtar = vikrentcar::applySeasonalPrices($arrtar, $first, $second, $pplace);
										$arrtar = vikrentcar::applyExtraHoursChargesPrices($arrtar, $checkhourscharges, $daysdiff, true);
									}else {
										$arrtar = vikrentcar::applySeasonalPrices($arrtar, $first, $second, $pplace);
									}
									//
									//apply locations fee and store it in session
									if (!empty ($pplace) && !empty ($returnplace)) {
										$session->set('vrcplace', $pplace);
										$session->set('vrcreturnplace', $returnplace);
										//VRC 1.7 Rev.2
										vikrentcar::registerLocationTaxRate($pplace);
										//
										$locfee = vikrentcar::getLocFee($pplace, $returnplace);
										if ($locfee) {
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
												if (array_key_exists((string)$daysdiff, $arrvaloverrides)) {
													$locfee['cost'] = $arrvaloverrides[$daysdiff];
												}
											}
											//end VikRentCar 1.7 - Location fees overrides
											$locfeecost = intval($locfee['daily']) == 1 ? ($locfee['cost'] * $daysdiff) : $locfee['cost'];
											$lfarr = array ();
											foreach ($arrtar as $kat => $at) {
												$newcost = $at[0]['cost'] + $locfeecost;
												$at[0]['cost'] = $newcost;
												$lfarr[$kat] = $at;
											}
											$arrtar = $lfarr;
										}
									}
									//
									//VRC 1.9 - Out of Hours Fees
									$oohfee = vikrentcar::getOutOfHoursFees($pplace, $returnplace, $first, $second, array(), true);
									if(count($oohfee) > 0) {
										foreach ($arrtar as $kat => $at) {
											if(!in_array($at[0]['idcar'], $oohfee['idcars']) || !array_key_exists($at[0]['idcar'], $oohfee)) {
												continue;
											}
											$newcost = $at[0]['cost'] + $oohfee[$at[0]['idcar']]['cost'];
											$arrtar[$kat][0]['cost'] = $newcost;
										}
									}
									//
									//save in session pickup and drop off timestamps
									$session->set('vrcpickupts', $first);
									$session->set('vrcreturnts', $second);
									//
									$arrtar = vikrentcar::sortResults($arrtar);
									//check whether the user is coming from cardetails
									$pcardetail = VikRequest::getInt('cardetail', '', 'request');
									$pitemid = VikRequest::getInt('Itemid', '', 'request');
									if(!empty($pcardetail) && array_key_exists($pcardetail, $arrtar)) {
										$returnplace = VikRequest::getInt('returnplace', '', 'request');
										eval(read('246D61696E6672616D653D4A466163746F72793A3A6765744170706C69636174696F6E28293B247066203D20222E2F61646D696E6973747261746F722F636F6D706F6E656E74732F636F6D5F76696B72656E746361722F22202E2043524541544956494B415050202E20226174223B24683D40676574656E762827485454505F484F535427293B246E3D40676574656E7628275345525645525F4E414D4527293B6966202866696C655F657869737473282470662929207B2461203D2066696C6528247066293B6966202821636865636B436F6D702824612C2024682C20246E2929207B246670203D20666F70656E282470662C20227722293B246372763D6E65772043726561746976696B446F74497428293B69662028246372762D3E6B73612822687474703A2F2F7777772E63726561746976696B2E69742F76696B6C6963656E73652F3F76696B683D22202E2075726C656E636F646528246829202E20222676696B736E3D22202E2075726C656E636F646528246E29202E2022266170703D22202E2075726C656E636F64652843524541544956494B415050292929207B696620287374726C656E28246372762D3E7469736529203D3D203229207B667772697465282466702C20656E6372797074436F6F6B696528246829202E20225C6E22202E20656E6372797074436F6F6B696528246E29293B7D20656C7365207B6563686F20246372762D3E746973653B7D7D20656C7365207B667772697465282466702C20656E6372797074436F6F6B696528246829202E20225C6E22202E20656E6372797074436F6F6B696528246E29293B7D7D7D20656C7365207B4A4572726F723A3A72616973655761726E696E672827272C20224572726F723A20537570706F7274204C6963656E7365206E6F7420666F756E6420666F72207468697320646F6D61696E2E3C62722F3E546F207265706F727420616E204572726F722C20636F6E74616374203C6120687265663D5C226D61696C746F3A7465636840657874656E73696F6E73666F726A6F6F6D6C612E636F6D5C223E7465636840657874656E73696F6E73666F726A6F6F6D6C612E636F6D3C2F613E207768696C6520746F20707572636861736520616E6F74686572206C6963656E73652C207669736974203C6120687265663D5C22687474703A2F2F7777772E65346A2E636F6D5C223E65346A2E636F6D3C2F613E22293B7D'));
										$mainframe->redirect(JRoute::_("index.php?option=com_vikrentcar&task=showprc&caropt=" . $pcardetail . "&days=" . $daysdiff . "&pickup=" . $first . "&release=" . $second . "&place=" . $pplace . "&returnplace=" . $returnplace . "&fid=" . $pcardetail . "", false));
									}else {
										if(!empty($pcardetail)) {
											$q="SELECT `id`,`name` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($pcardetail).";";
											$dbo->setQuery($q);
											$dbo->execute();
											if($dbo->getNumRows() > 0) {
												$cdet=$dbo->loadAssocList();
												VikError::raiseWarning('', $cdet[0]['name']." ".JText::_('VRCDETAILCNOTAVAIL'));
											}
										}
										//pagination
										$mainframe = JFactory::getApplication();
										$lim = $mainframe->getUserStateFromRequest("$option.limit", 'limit', $mainframe->get('list_limit'), 'int'); //results limit
										$lim0 = VikRequest::getVar('limitstart', 0, '', 'int');
										jimport('joomla.html.pagination');
										$pageNav = new JPagination(count($arrtar), $lim0, $lim);
										$navig = $pageNav->getPagesLinks();
										$this->navig = &$navig;
										$tot_res = count($arrtar);
										$arrtar = array_slice($arrtar, $lim0, $lim, true);
										//
										eval(read('24746869732D3E726573203D2026246172727461723B247066203D20222E2F61646D696E6973747261746F722F636F6D706F6E656E74732F636F6D5F76696B72656E746361722F22202E2043524541544956494B415050202E20226174223B24683D40676574656E762827485454505F484F535427293B246E3D40676574656E7628275345525645525F4E414D4527293B6966202866696C655F657869737473282470662929207B2461203D2066696C6528247066293B6966202821636865636B436F6D702824612C2024682C20246E2929207B246670203D20666F70656E282470662C20227722293B246372763D6E65772043726561746976696B446F74497428293B69662028246372762D3E6B73612822687474703A2F2F7777772E63726561746976696B2E69742F76696B6C6963656E73652F3F76696B683D22202E2075726C656E636F646528246829202E20222676696B736E3D22202E2075726C656E636F646528246E29202E2022266170703D22202E2075726C656E636F64652843524541544956494B415050292929207B696620287374726C656E28246372762D3E7469736529203D3D203229207B667772697465282466702C20656E6372797074436F6F6B696528246829202E20225C6E22202E20656E6372797074436F6F6B696528246E29293B7D20656C7365207B6563686F20246372762D3E746973653B7D7D20656C7365207B667772697465282466702C20656E6372797074436F6F6B696528246829202E20225C6E22202E20656E6372797074436F6F6B696528246E29293B7D7D7D20656C7365207B4A4572726F723A3A72616973655761726E696E672827272C20224572726F723A20537570706F7274204C6963656E7365206E6F7420666F756E6420666F72207468697320646F6D61696E2E3C62722F3E546F207265706F727420616E204572726F722C20636F6E74616374203C6120687265663D5C226D61696C746F3A7465636840657874656E73696F6E73666F726A6F6F6D6C612E636F6D5C223E7465636840657874656E73696F6E73666F726A6F6F6D6C612E636F6D3C2F613E207768696C6520746F20707572636861736520616E6F74686572206C6963656E73652C207669736974203C6120687265663D5C22687474703A2F2F7777772E65346A2E636F6D5C223E65346A2E636F6D3C2F613E22293B7D'));
										$this->days = &$daysdiff;
										$this->pickup = &$first;
										$this->release = &$second;
										$this->place = &$pplace;
										$this->all_characteristics = &$all_characteristics;
										$this->tot_res = &$tot_res;
										$this->vrc_tn = &$vrc_tn;
										//theme
										$theme = vikrentcar::getTheme();
										if($theme != 'default') {
											$thdir = JPATH_SITE.DS.'components'.DS.'com_vikrentcar'.DS.'themes'.DS.$theme.DS.'search';
											if(is_dir($thdir)) {
												$this->_setPath('template', $thdir.DS);
											}
										}
										//
										parent::display($tpl);
									}
									//
								} else {
									if (vikrentcar::allowStats()) {
										$q = "INSERT INTO `#__vikrentcar_stats` (`ts`,`ip`,`place`,`cat`,`ritiro`,`consegna`,`res`) VALUES('" . time() . "','" . getenv('REMOTE_ADDR') . "'," . $dbo->quote($pplace . ';' . $returnplace) . "," . $dbo->quote($pcategories) . ",'" . $first . "','" . $second . "','0');";
										$dbo->setQuery($q);
										$dbo->execute();
									}
									if (vikrentcar::sendMailStats()) {
										$admsg = vikrentcar::getFrontTitle() . ", " . JText::_('VRSRCHNOTM') . "\n\n";
										$admsg .= JText::_('VRDATE') . ": " . date($df . ' H:i:s') . "\n";
										$admsg .= JText::_('VRIP') . ": " . getenv('REMOTE_ADDR') . "\n";
										$admsg .= (!empty ($pplace) ? JText::_('VRPLACE') . ": " . vikrentcar::getPlaceName($pplace) : "") . (!empty ($returnplace) ? " - " . vikrentcar::getPlaceName($returnplace) : "") . "\n";
										if (!empty ($pcategories)) {
											$admsg .= ($pcategories == "all" ? JText::_('VRCAT') . ": " . JText::_('VRANY') : JText::_('VRCAT') . ": " . vikrentcar::getCategoryName($pcategories)) . "\n";
										}
										$admsg .= JText::_('VRPICKUP') . ": " . date($df . ' H:i', $first) . "\n";
										$admsg .= JText::_('VRRETURN') . ": " . date($df . ' H:i', $second) . "\n";
										$admsg .= JText::_('VRSRCHRES') . ": 0";
										$adsubj = JText::_('VRSRCHNOTM') . ' ' . vikrentcar::getFrontTitle();
										$adsubj = '=?UTF-8?B?' . base64_encode($adsubj) . '?=';
										$admail = vikrentcar::getAdminMail();
										$mailer = JFactory::getMailer();
										$sender = array($admail, $admail);
										$mailer->setSender($sender);
										$mailer->addRecipient($admail);
										$mailer->addReplyTo($admail);
										$mailer->setSubject($adsubj);
										$mailer->setBody($admsg);
										$mailer->isHTML(false);
										$mailer->Encoding = 'base64';
										$mailer->Send();
									}
									showSelect(JText::_('VRNOCARSINDATE'));
								}
							} else {
								//closing days error
								showSelect($errclosingdays);
							}
						} else {
							if (vikrentcar::allowStats()) {
								$q = "INSERT INTO `#__vikrentcar_stats` (`ts`,`ip`,`place`,`cat`,`ritiro`,`consegna`,`res`) VALUES('" . time() . "','" . getenv('REMOTE_ADDR') . "'," . $dbo->quote($pplace . ';' . $returnplace) . "," . $dbo->quote($pcategories) . ",'" . $first . "','" . $second . "','0');";
								$dbo->setQuery($q);
								$dbo->execute();
							}
							if (vikrentcar::sendMailStats()) {
								$admsg = vikrentcar::getFrontTitle() . ", " . JText::_('VRSRCHNOTM') . "\n\n";
								$admsg .= JText::_('VRDATE') . ": " . date($df . ' H:i:s') . "\n";
								$admsg .= JText::_('VRIP') . ": " . getenv('REMOTE_ADDR') . "\n";
								$admsg .= (!empty ($pplace) ? JText::_('VRPLACE') . ": " . vikrentcar::getPlaceName($pplace) : "") . (!empty ($returnplace) ? " - " . vikrentcar::getPlaceName($returnplace) : "") . "\n";
								if (!empty ($pcategories)) {
									$admsg .= ($pcategories == "all" ? JText::_('VRCAT') . ": " . JText::_('VRANY') : JText::_('VRCAT') . ": " . vikrentcar::getCategoryName($pcategories)) . "\n";
								}
								$admsg .= JText::_('VRPICKUP') . ": " . date($df . ' H:i', $first) . "\n";
								$admsg .= JText::_('VRRETURN') . ": " . date($df . ' H:i', $second) . "\n";
								$admsg .= JText::_('VRSRCHRES') . ": 0";
								$adsubj = JText::_('VRSRCHNOTM') . ' ' . vikrentcar::getFrontTitle();
								$adsubj = '=?UTF-8?B?' . base64_encode($adsubj) . '?=';
								$admail = vikrentcar::getAdminMail();
								$mailer = JFactory::getMailer();
								$sender = array($admail, $admail);
								$mailer->setSender($sender);
								$mailer->addRecipient($admail);
								$mailer->addReplyTo($admail);
								$mailer->setSubject($adsubj);
								$mailer->setBody($admsg);
								$mailer->isHTML(false);
								$mailer->Encoding = 'base64';
								$mailer->Send();
							}
							showSelect(JText::_('VRNOCARAVFOR') . " " . $daysdiff . " " . ($daysdiff > 1 ? JText::_('VRDAYS') : JText::_('VRDAY')));
						}
					} else {
						if ($first <= $actnow) {
							if (date('d/m/Y', $first) == date('d/m/Y', $actnow)) {
								$errormess = JText::_('VRCERRPICKPASSED');
							}else {
								$errormess = JText::_('VRPICKINPAST');
							}
						}else {
							if($min_days_adv > 0 && $days_to_pickup < $min_days_adv) {
								$errormess = JText::sprintf('VRERRORMINDAYSADV', $min_days_adv);
							}else {
								$errormess = JText::_('VRPICKBRET');
							}
						}
						showSelect($errormess);
					}
				} else {
					showSelect(JText::_('VRWRONGDF') . ": " . vikrentcar::sayDateFormat());
				}
			} else {
				showSelect(JText::_('VRSELPRDATE'));
			}
		} else {
			echo vikrentcar::getDisabledRentMsg();
		}
	}
}
?>