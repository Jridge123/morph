<?php
/**
* @version		$Id: usergroup.php 10381 2008-06-01 03:35:53Z pasamio $
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
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementUserGroup extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Editors';
	
	function fetchTooltip($label, $description, &$node, $control_name='', $name='')
	{
		
		$output = '<label class="to-label" id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'">'.JText::_( $label ).'</label>';
		$tooltip = $node->attributes('tooltip');
		if($tooltip){
			switch($tooltip){
				case 'inline': 
				$output .= '<span class="tt-inline" title="'.JText::_($label).'::'.JText::_($description).'">&nbsp;</span>';
				break;
				case 'modal':
				$output .= '<span class="tt-modal" title="'.JText::_($label).'::'.JText::_($description).'"><b class="ttim" title="Click here for more information on '.JText::_($label).'">&nbsp;</b></span>';
				break;
			}
		}
		
		return $output;
	}

	function fetchElement($name, $value, &$node, $control_name)
	{
		$acl	=& JFactory::getACL();
		$gtree	= $acl->get_group_children_tree( null, 'USERS', false );
		$ctrl	= $control_name .'['. $name .']';

		$attribs	= ' ';
		if ($v = $node->attributes('size')) {
			$attribs	.= 'size="'.$v.'"';
		}
		if ($v = $node->attributes('class')) {
			$attribs	.= 'class="'.$v.'"';
		} else {
			$attribs	.= 'class="inputbox"';
		}
		if ($m = $node->attributes('multiple'))
		{
			$attribs	.= 'multiple="multiple"';
			$ctrl		.= '[]';
			//$value		= implode( '|', )
		}
		//array_unshift( $editors, JHTML::_('select.option',  '', '- '. JText::_( 'Select Editor' ) .' -' ) );

		return JHTML::_('select.genericlist',   $gtree, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name );
	}
}
