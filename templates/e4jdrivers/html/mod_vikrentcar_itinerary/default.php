<?php  
/**
 * Copyright (c) Extensionsforjoomla.com - E4J - Alessio <tech@extensionsforjoomla.com>
 * 
 * You should have received a copy of the License
 * along with this program.  If not, see <http://www.extensionsforjoomla.com/>.
 * 
 * For any bug, error please contact <tech@extensionsforjoomla.com>
 * We will try to fix it.
 * 
 * Extensionsforjoomla.com - All Rights Reserved
 * 
 */

defined('_JEXEC') or die('Restricted Area');

if (!empty($modpickuplocation) || !empty($modpickupts)) {
?>

<div class="vikrentcaritinerary <?php echo $params->get('moduleclass_sfx'); ?>">
<div class="vrcmodit_date-inner">
<?php
if (!empty($modpickupts)) {
	?>
	<div class="vrcmodit_pickupts">
		<i class="fa fa-arrow-circle-o-right"></i>
		<div class="vrcmodit_pickupts_inner">
			<span class="vrcmodit_labelpickupts"><?php echo JText::_('VRCMODITPICKUPDATE'); ?></span>
			<span class="vrcmodit_contpickupts"><?php echo date($df.' '.$tf, $modpickupts); ?></span>
		</div>
	</div>
	<?php
}
if (!empty($moddropoffts)) {
	?>
	<div class="vrcmodit_dropoffts">
		<i class="fa fa-arrow-circle-o-left"></i>
		<div class="vrcmodit_pickupts_inner">
			<span class="vrcmodit_labeldropoffts"><?php echo JText::_('VRCMODITDROPOFFDATE'); ?></span>
			<span class="vrcmodit_contdropoffts"><?php echo date($df.' '.$tf, $moddropoffts); ?></span>
		</div>
	</div>
	<?php
} ?>
</div>
<div class="vrcmodit_loc-inner">
<?php 
if (!empty($modpickuplocation)) {
	if ($modpickuplocation == $moddropofflocation) {
	?>
	<div class="vrcmodit_location">
		<i class="fa fa-map-marker"></i>
		<div class="vrcmodit_location_inner">
			<span class="vrcmodit_labellocations"><?php echo JText::_('VRCMODITLOCATIONS'); ?></span>
			<span class="vrcmodit_contlocations"><?php echo modVikrentcarItineraryHelper::getLocationName($modpickuplocation); ?></span>
		</div>
	</div>
	<?php
	}else {
	?>
	<div class="vrcmodit_location">
		<i class="fa fa-map-marker"></i>
		<div class="vrcmodit_location_inner">
			<span class="vrcmodit_labellocations"><?php echo JText::_('VRCMODITPICKUPLOCATION'); ?></span>
			<span class="vrcmodit_contlocations"><?php echo modVikrentcarItineraryHelper::getLocationName($modpickuplocation); ?></span>
		</div>
	</div>
	<div class="vrcmodit_location">
		<i class="fa fa-map-marker"></i>
		<div class="vrcmodit_location_inner">
			<span class="vrcmodit_labellocations"><?php echo JText::_('VRCMODITDROPOFFLOCATION'); ?></span>
			<span class="vrcmodit_contlocations"><?php echo modVikrentcarItineraryHelper::getLocationName($moddropofflocation); ?></span>
		</div>
	</div>
	<?php
	}
	?>
</div>
	<div class="vrcmodit_changeit">
		<span><a class="btn" href="<?php echo JRoute::_('index.php?option=com_vikrentcar&view=vikrentcar&pickup='.$modpickupts.'&return='.$moddropoffts); ?>"><?php echo JText::_('VRCMODITCHANGE'); ?></a></span>
	</div>
	<?php
}
?>
</div>

<?php
}
?>