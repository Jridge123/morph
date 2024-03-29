<?php
/**
* @version		$Id: text.php 10707 2008-08-21 09:52:47Z eddieajau $
* @package		Joomla.Framework
* @subpackage	Parameter
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementHeading extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Heading';
	
	function fetchTooltip($label, $description, &$node, $control_name='', $name='')
	{
	
		if($label === ' '){
			$output = '';
		}else{
			$output = '<li class="heading"><h3>'.JText::_($label).'</h3>' ."\n\t\t\t";
		}
		
		if ($description) {
			$output .= '<p class="to-heading-text">'.JText::_($description).'</p></li>';
		} else {
			$output .= '</li>';
		}

		return $output;
	}
	
}