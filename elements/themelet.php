<?php
/**
* @version		$Id: folderlist.php 11670 2009-03-08 20:37:02Z willebil $
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
 * Renders a filelist element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementThemelet extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Themelet';
	
	function fetchTooltip($label, $description, &$node, $control_name='', $name='')
	{
		
		$output = '<li><label class="to-label" id="'.$control_name.$name.'-lbl" for="'.$control_name.$name.'">'.JText::_( $label ).'</label>';
		$tooltip = $node->attributes('tooltip');
		if($tooltip){
			switch($tooltip){
				case 'inline': 
				$output .= '<span class="tooltip tt-inline" title="'.JText::_($label).'::'.JText::_($description).'">&nbsp;</span>';
				break;
				case 'modal':
				$output .= '<span class="tt-modal tooltip"  title="'.JText::_($label).'::'.JText::_($description).'">';
				$output .= '<strong class="ttim" title="Click here for more information on '.JText::_( $label ).'">help</strong>';
				$output .= '</span>';
				break;
			}
		}
		
		return $output;
	}

	function fetchElement($name, $value, &$node, $control_name)
	{
		jimport( 'joomla.filesystem.folder' );

		// path to images directory
		$path		= JPATH_ROOT.'/'.$node->attributes('directory');
		$filter		= $node->attributes('filter');
		$exclude	= $node->attributes('exclude');
		$folders	= JFolder::folders($path, $filter);

		$options = array ();
		foreach ($folders as $folder)
		{
			if ($exclude)
			{
				if (preg_match( chr( 1 ) . $exclude . chr( 1 ), $folder )) {
					continue;
				}
			}
			$options[] = JHTML::_('select.option', $folder, $folder);
		}

		if (!$node->attributes('hide_none')) {
			array_unshift($options, JHTML::_('select.option', '-1', '- '.JText::_('Do not use').' -'));
		}

		if (!$node->attributes('hide_default')) {
			array_unshift($options, JHTML::_('select.option', '', '- '.JText::_('Use default').' -'));
		}

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name).'<span class="themelet-options"><a href="#" title="click here to install a new themelet" class="upload-themelet">Install New</a> | <a href="#" title="customize this themelet" class="themelet-tab">Customize</a></span></li>';
	}
}
