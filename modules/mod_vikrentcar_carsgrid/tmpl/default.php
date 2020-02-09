<?php
/**------------------------------------------------------------------------
 * mod_vikrentcar_carsgrid - VikRentCar
 * ------------------------------------------------------------------------
 * author    Alessio Gaggii - Extensionsforjoomla.com
 * copyright Copyright (C) 2012 extensionsforjoomla.com. All Rights Reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Websites: http://www.extensionsforjoomla.com
 * Technical Support:  tech@extensionsforjoomla.com
 * ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

//JHtml::_('script', JURI::root().'modules/mod_vikrentcar_carsgrid/src/modernizr.min.js', false, true, false, false);
//JHtml::_('script', JURI::root().'modules/mod_vikrentcar_cars/src/custom.js', false, true, false, false);


$currencysymb = $params->get('currency');
	
?>
<div class="vrcmodcarsgridcontainer column-container container-fluid">

<ul id="grid" class="vrcmodcarsgridcont-items vrcmodcarsgridhorizontal row-fluid">
<?php
foreach($cars as $c) {
	?>
	<li class="col-md-4 col-sm-4 col-xs-6" data-groups='["<?php echo $c['catname']; ?>"]'>

		<figure class="vrcmodcarsgridcont-item">
			<div class="vrcmodcarsgridboxdiv">	
				<?php
				if(!empty($c['img'])) {
				?>
				<img src="<?php echo JURI::root(); ?>administrator/components/com_vikrentcar/resources/<?php echo $c['img']; ?>" class="vrcmodcarsgridimg"/>
				<?php
				}
				?>
				<div class="vrcmodcarsgrid-item_details">
				<figcaption class="vrcmodcarsgrid-item_title"><?php echo $c['name']; ?></figcaption>
		        <?php if($params->get('show_desc')) { ?>
		       		<div class="vrcmodcarsgrid-item-desc"><?php echo $c['short_info']; ?></div>
		        <?php
				}
				?>
				<?php
				if($c['cost'] > 0) {
				?>
				<div class="vrcmodcarsgrid-box-cost">
					<span class="vrcmodcarsgridstartfrom"><?php echo JText::_('VRCMODCARSTARTFROM'); ?></span>
					<span class="vrcmodcarsgridcarcost"><span class="vrc_currency"><?php echo $currencysymb; ?></span> <span class="vrc_price"><?php echo modvikrentcar_carsgridHelper::numberFormat($c['cost']); ?></span></span>
				</div>
				<?php
				}
				?>
		        </div>
				<div class="vrcmodcarsgridview"><a class="btn btn-vrcmodcarsgrid-btn" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=cardetails&carid='.$c['id']); ?>"><?php echo JText::_('VRCMODCARCONTINUE'); ?></a></div>
		        <?php
				if($showcatname) {
				?>
				<div class="vrcmodcarsgrid-item_cat"><?php echo $c['catname']; ?></div>
				<?php
				}
				?>
			</div>	
		</figure>
	</li>
	<?php
}
?>
</ul>
</div>

