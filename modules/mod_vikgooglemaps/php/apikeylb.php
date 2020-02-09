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

class JFormFieldApikeylb extends JFormField
{
	protected $type = 'apikeylb';

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
		
		return sprintf('<div class="vik-apikey">Google Maps needs an API KEY to work properly, you can follow these simple steps to get your API KEY: <br /> 
				<ol>
				<li>Go on this link: <a href="https://console.developers.google.com/apis/dashboard" target="_blank">https://console.developers.google.com/apis/dashboard </a></li>
				<li>Create a New Project </li>
				<li>Go in the Credentials tab and Create New credentials for Browser key. </li>
				<li>Follow the simple instructions, create your Api Key and copy it in the above field (we would suggest to insert your website url in this way: <strong>http://www.yourwebsite.com/*</strong> )</li>
				</ol>
				</div>', call_user_func_array('sprintf', $options));
	}
}
?>
