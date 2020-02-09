<?php
/**
 * @package     VikRentCar
 * @subpackage  com_vikrentcar
 * @author      Alessio Gaggii - e4j - Extensionsforjoomla.com
 * @copyright   Copyright (C) 2017 e4j - Extensionsforjoomla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://e4j.com
 */

defined('_JEXEC') or die('Restricted access');

class TOOLBAR_vikrentcar {
	public static function DEFAULT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINDASHBOARDTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.admin', 'com_vikrentcar')) {
			JToolBarHelper::preferences('com_vikrentcar');
		}
	}
	
	public static function CARS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINDEAFULTTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newcar', JText::_('VRMAINDEFAULTNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editcar', JText::_('VRMAINDEFAULTEDITC'));
			JToolBarHelper::spacer();
			JToolBarHelper::editList('viewtariffe', JText::_('VRMAINDEFAULTEDITT'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::custom( 'calendar', 'edit', 'edit', JText::_('VRMAINDEFAULTCAL'), true, false);
		JToolBarHelper::spacer();
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removecar', JText::_('VRMAINDEFAULTDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function CUSTOMF_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCUSTOMFTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newcustomf', JText::_('VRMAINCUSTOMFNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editcustomf', JText::_('VRMAINCUSTOMFEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removecustomf', JText::_('VRMAINCUSTOMFDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function COUPON_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCOUPONTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newcoupon', JText::_('VRMAINCOUPONNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editcoupon', JText::_('VRMAINCOUPONEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removecoupons', JText::_('VRMAINCOUPONDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function PLACE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPLACETITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newplace', JText::_('VRMAINPLACENEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editplace', JText::_('VRMAINPLACEEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeplace', JText::_('VRMAINPLACEDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function LOCFEES_MENU() {
		JToolBarHelper::title(JText::_('VRMAINLOCFEESTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newlocfee', JText::_('VRMAINLOCFEENEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editlocfee', JText::_('VRMAINLOCFEEEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removelocfee', JText::_('VRMAINLOCFEEDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function SEASONS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINSEASONSTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newseason', JText::_('VRMAINSEASONSNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editseason', JText::_('VRMAINSEASONSEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeseasons', JText::_('VRMAINSEASONSDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function PAYMENTS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPAYMENTSTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newpayment', JText::_('VRMAINPAYMENTSNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editpayment', JText::_('VRMAINPAYMENTSEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removepayments', JText::_('VRMAINPAYMENTSDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function IVA_MENU() {
		JToolBarHelper::title(JText::_('VRMAINIVATITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newiva', JText::_('VRMAINIVANEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editiva', JText::_('VRMAINIVAEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeiva', JText::_('VRMAINIVADEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function CAT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCATTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newcat', JText::_('VRMAINCATNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editcat', JText::_('VRMAINCATEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removecat', JText::_('VRMAINCATDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function CARAT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCARATTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newcarat', JText::_('VRMAINCARATNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editcarat', JText::_('VRMAINCARATEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removecarat', JText::_('VRMAINCARATDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function OPTIONALS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOPTTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newoptionals', JText::_('VRMAINOPTNEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editoptional', JText::_('VRMAINOPTEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeoptionals', JText::_('VRMAINOPTDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function PRICE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPRICETITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newprice', JText::_('VRMAINPRICENEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editprice', JText::_('VRMAINPRICEEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeprice', JText::_('VRMAINPRICEDEL'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function NEWPLACE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPLACETITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createplace', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelplace', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWCUSTOMF_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCUSTOMFTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createcustomf', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelcustomf', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITCUSTOMF_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCUSTOMFTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updatecustomf', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelcustomf', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWCOUPON_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCOUPONTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createcoupon', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelcoupon', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITCOUPON_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCOUPONTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updatecoupon', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelcoupon', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITPLACE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPLACETITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updateplace', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelplace', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWLOCFEE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINLOCFEETITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createlocfee', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancellocfee', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITLOCFEE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINLOCFEETITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updatelocfee', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancellocfee', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWSEASON_MENU() {
		JToolBarHelper::title(JText::_('VRMAINSEASONTITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createseason', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelseason', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITSEASON_MENU() {
		JToolBarHelper::title(JText::_('VRMAINSEASONTITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updateseason', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelseason', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWPAYMENT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPAYMENTTITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createpayment', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelpayment', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITPAYMENT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPAYMENTTITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updatepayment', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelpayment', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function STATS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINSTATSTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removestats', JText::_('VRELIMINA'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancel', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWIVA_MENU() {
		JToolBarHelper::title(JText::_('VRMAINIVATITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createiva', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'canceliva', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITIVA_MENU() {
		JToolBarHelper::title(JText::_('VRMAINIVATITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updateiva', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'canceliva', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWPRICE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPRICETITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createprice', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelprice', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITPRICE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINPRICETITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updateprice', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelprice', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWCAT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCATTITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createcat', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelcat', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITCAT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCATTITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updatecat', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancelcat', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWCARAT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCARATTITLENEW'), 'vikrentcar');
		JToolBarHelper::save( 'createcarat', JText::_('VRSAVE'));
		JToolBarHelper::spacer();
		JToolBarHelper::cancel( 'cancelcarat', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITCARAT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCARATTITLEEDIT'), 'vikrentcar');
		JToolBarHelper::save( 'updatecarat', JText::_('VRSAVE'));
		JToolBarHelper::spacer();
		JToolBarHelper::cancel( 'cancelcarat', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWOPTIONAL_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOPTTITLENEW'), 'vikrentcar');
		JToolBarHelper::save( 'createoptionals', JText::_('VRSAVE'));
		JToolBarHelper::spacer();
		JToolBarHelper::cancel( 'canceloptionals', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITOPTIONAL_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOPTTITLEEDIT'), 'vikrentcar');
		JToolBarHelper::save( 'updateoptional', JText::_('VRSAVE'));
		JToolBarHelper::spacer();
		JToolBarHelper::cancel( 'canceloptionals', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function NEWCAR_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCARTITLENEW'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createcar', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancel', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITCAR_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCARTITLEEDIT'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::apply( 'updatecarapply', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
			JToolBarHelper::save( 'updatecar', JText::_('VRSAVECLOSE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancel', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function TARIFFE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINTARIFFETITLE'), 'vikrentcar');
		JToolBarHelper::save( 'cancel', JText::_('VRMAINTARIFFEBACK'));
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removetariffe', JText::_('VRMAINTARIFFEDEL'));
		}
	}
	
	public static function TARIFFEHOURS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINTARIFFETITLE'), 'vikrentcar');
		JToolBarHelper::save( 'cancel', JText::_('VRMAINTARIFFEBACK'));
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removetariffehours', JText::_('VRMAINTARIFFEDEL'));
		}
	}
	
	public static function HOURSCHARGES_MENU() {
		JToolBarHelper::title(JText::_('VRMAINTARIFFETITLE'), 'vikrentcar');
		JToolBarHelper::save( 'cancel', JText::_('VRMAINTARIFFEBACK'));
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removehourscharges', JText::_('VRMAINTARIFFEDEL'));
		}
	}
	
	public static function ORDERS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINORDERTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::custom( 'viewexport', 'download', 'download', JText::_('VRMAINORDERSEXPORT'), false, false);
			JToolBarHelper::custom( 'vieworders', 'file-2', 'file-2', JText::_('VRCGENINVOICE'), true);
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editorder', JText::_('VRMAINORDEREDIT'));
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeorders', JText::_('VRMAINORDERDEL'));
		}
	}
	
	public static function EXPORT_MENU() {
		JToolBarHelper::title(JText::_('VRMAINEXPORTTITLE'), 'vikrentcar');
		JToolBarHelper::cancel( 'canceledorder', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
	public static function OLDORDERS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOLDORDERTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeoldorders', JText::_('VRMAINOLDORDERDEL'));
			JToolBarHelper::spacer();
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editoldorder', JText::_('VRMAINOLDORDEREDIT'));
			JToolBarHelper::spacer();
		}
	}
	
	public static function EDITORDER_MENU() {
		JToolBarHelper::title(JText::_('VRMAINORDERTITLEEDIT'), 'vikrentcar');
		JToolBarHelper::cancel( 'canceledorder', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITOLDORDER_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOLDORDERTITLEEDIT'), 'vikrentcar');
		JToolBarHelper::cancel( 'canceledoldorder', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
	public static function CALENDAR_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCALTITLE'), 'vikrentcar');
		JToolBarHelper::cancel( 'cancel', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
	public static function EBUSY_MENU() {
		JToolBarHelper::title(JText::_('VRMAINEBUSYTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updatebusy', JText::_('VRSAVE'));
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::custom( 'removebusy', 'delete', 'delete', JText::_('VRMAINEBUSYDEL'), false, false);
		}
		JToolBarHelper::cancel( 'cancelcalendar', JText::_('VRBACK'));
	}
	
	public static function CONFIG_MENU() {
		JToolBarHelper::title(JText::_('VRMAINCONFIGTITLE'), 'vikrentcarconfig');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::apply( 'saveconfig', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancel', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function CHOOSEBUSY_MENU() {
		$dbo = JFactory::getDBO();
		$pts = VikRequest::getInt('ts', '', 'request');
		$pidcar = VikRequest::getInt('idcar', '', 'request');
		$q="SELECT `name` FROM `#__vikrentcar_cars` WHERE `id`=".$dbo->quote($pidcar).";";
		$dbo->setQuery($q);
		$dbo->execute();
		$cname=$dbo->loadResult();
		JToolBarHelper::title(JText::_('VRMAINCHOOSEBUSY')." ".$cname.", ".date('Y-M-d', $pts), 'vikrentcar');
		JToolBarHelper::cancel( 'cancelcalendar', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
	public static function OVERVIEW_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOVERVIEWTITLE'), 'vikrentcar');
		JToolBarHelper::cancel( 'cancel', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}

	public static function OOHFEES_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOOHFEESTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::addNew('newoohfee', JText::_('VRMAINOOHFEENEW'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::editList('editoohfee', JText::_('VRMAINOOHFEEEDIT'));
			JToolBarHelper::spacer();
		}
		if (JFactory::getUser()->authorise('core.delete', 'com_vikrentcar')) {
			JToolBarHelper::deleteList(JText::_('VRCDELCONFIRM'), 'removeoohfees', JText::_('VRMAINOOHFEEDEL'));
			JToolBarHelper::spacer();
		}
	}

	public static function NEWOOHFEE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOOHFEESTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::save( 'createoohfee', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'canceloohfee', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}
	
	public static function EDITOOHFEE_MENU() {
		JToolBarHelper::title(JText::_('VRMAINOOHFEESTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.edit', 'com_vikrentcar')) {
			JToolBarHelper::save( 'updateoohfee', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'canceloohfee', JText::_('VRANNULLA'));
		JToolBarHelper::spacer();
	}

	public static function TRANSLATIONS_MENU() {
		JToolBarHelper::title(JText::_('VRCMAINTRANSLATIONSTITLE'), 'vikrentcar');
		if (JFactory::getUser()->authorise('core.create', 'com_vikrentcar')) {
			JToolBarHelper::apply( 'savetranslationstay', JText::_('VRSAVE'));
			JToolBarHelper::spacer();
			JToolBarHelper::save( 'savetranslation', JText::_('VRSAVECLOSE'));
			JToolBarHelper::spacer();
		}
		JToolBarHelper::cancel( 'cancel', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}

	public static function GRAPHS_MENU() {
		JToolBarHelper::title(JText::_('VRMAINGRAPHSTITLE'), 'vikrentcar');
		JToolBarHelper::cancel( 'canceledorder', JText::_('VRBACK'));
		JToolBarHelper::spacer();
	}
	
}
?>