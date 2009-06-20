<?php
/**
* @version		$Id: radio.php 10707 2008-08-21 09:52:47Z eddieajau $
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
 * Renders a radio element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementRadio extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Radio';
	
	function fetchTooltip($label, $description, &$node, $control_name='', $name='')
	{
		
		$output = '<li class="radio-item"><label class="to-label" id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'">'.JText::_( $label ).'</label>';
		$tooltip = $node->attributes('tooltip');
		if($tooltip){
			switch($tooltip){
				case 'inline': 
				$output .= '<span class="tooltip tt-inline" title="'.JText::_($label).'::'.JText::_($description).'">&nbsp;</span>';
				break;
				case 'modal':
				$output .= '<span class="tt-modal tooltip">';
				$output .= '<strong class="ttim" title="Click here for more information on '.JText::_( $label ).'">help</strong>';
				$output .= '</span>';
				break;
			}
		}
		
		return $output;
	}

	function fetchElement($name, $value, &$node, $control_name)
	{
		$options = array ();
		foreach ($node->children() as $option)
		{
			$val	= $option->attributes('value');
			$text	= $option->data();
			$options[] = JHTML::_('select.option', $val, JText::_($text));
		}

		return JHTML::_('select.radiolist', $options, ''.$control_name.'['.$name.']', '', 'value', 'text', $value, $control_name.$name ).'</li>';
	}
}
