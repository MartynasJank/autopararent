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

defined('_JEXEC') or die ('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldCenterdesclb extends JFormField
{
	protected $type = 'centerdesclb';

	function getInput()
	{
		return $this->fetchElement($this->element['name'], $this->value, $this->element, $this->name);
	}
	
	function fetchElement($name, $value, &$node, $control_name)
	{
		$options = array(JText::_($value));
		foreach ($node->children() as $option)
		{
			$options[] = $option->data();
		}
		
		return sprintf('<div class="vik-message">These are the coordinates that Google needs just to center your map, you need to insert your Locations coordinates from the <strong>LOCATIONS</strong> tab. <br />
		<span><strong>Without the <u>Locations</u> coordinates the map will not show up.</strong></span> 
				</div>', call_user_func_array('sprintf', $options));
	}
}
?>
