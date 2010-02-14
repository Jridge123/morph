<?php
/**
 * @version		$Id: modules.php 10822 2008-08-27 17:16:00Z tcp $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.module.helper');
/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */
 
 function moduleHeadings($modtitle){
	// splitters
	$pretext = '\\';
	$subtext = '/';
	$twotone = '|';
	
	$spaces = array('<span class="twotone"> ', '<span class="pretext"> ', '<span class="subtext"> ', ' </span>');
	$nospaces = array('<span class="twotone">', '<span class="pretext">', '<span class="subtext">', '</span>');
	
	// Fix amps
	$modtitle = JFilterOutput::ampReplace($modtitle);
	
	
	// subtext & twotone
	if(strstr($modtitle, $subtext) && strstr($modtitle, $twotone)){
		$twotone_arr = explode($twotone, $modtitle);
		$subtext_arr = explode($subtext, $twotone_arr[1]);
		$str_twotone = $twotone_arr[0].' <span class="twotone">'.$subtext_arr[0].'</span>';
		$str_subtext = '<span class="subtext">'.$subtext_arr[1].'</span>';
		
		$string = $str_twotone .' '. $str_subtext;
		return str_replace($spaces, $nospaces, $string);
	}
	
	// subtext & twotone
	if(strstr($modtitle, $pretext) && strstr($modtitle, $twotone)){
		$pretext_arr = explode($pretext, $modtitle);
		$twotone_arr = explode($twotone, $pretext_arr[1]);
		$str_pretext = '<span class="pretext">'.$pretext_arr[0].'</span>';
		$str_twotone = $twotone_arr[0].' <span class="twotone">'.$twotone_arr[1].'</span>';
		
		$string = $str_pretext .' '. $str_twotone;
		return str_replace($spaces, $nospaces, $string);
	}
	
	if(strstr($modtitle, $twotone) && !strstr($modtitle, $pretext)){
		$twotone_arr = explode($twotone, $modtitle);
		$str_twotone = $twotone_arr[0].' <span class="twotone">'.$twotone_arr[1].'</span>';
		
		return str_replace($spaces, $nospaces, $str_twotone);
	}
	
	if(strstr($modtitle, $pretext) && !strstr($modtitle, $twotone)){
		$pretext_arr = explode($pretext, $modtitle);
		$str_pretext = '<span class="pretext">'.$pretext_arr[0].'</span> '.$pretext_arr[1];
		
		return str_replace($spaces, $nospaces, $str_pretext);
	}
	
	if(strstr($modtitle, $subtext) && !strstr($modtitle, $twotone)){
		$subtext_arr = explode($subtext, $modtitle);
		$str_subtext = $subtext_arr[0].'<span class="subtext">'.$subtext_arr[1].'</span>';
		
		return str_replace($spaces, $nospaces, $str_subtext);
	}
	
	if(!strstr($modtitle, $subtext) && !strstr($modtitle, $twotone)){
		return $modtitle;
	}
}

function modChrome_basic($module, &$params, &$attribs) {
$pub_modules = JModuleHelper::getModules($module->position);

$db = JFactory::getDBO();
$query = "SELECT param_value FROM `#__configurator` WHERE `param_name` = '".$module->position."_module_inner';";
$db->setQuery( $query ); $innerwrap = $db->loadResult();

if ($pub_modules[0]->id == $module->id) {
	$posSuffix = ' '.$params->get('moduleclass_sfx') . ' first';
} elseif ($pub_modules[count($pub_modules)-1]->id == $module->id) {
	$posSuffix = ' '.$params->get('moduleclass_sfx') . ' last';
} else {
	$posSuffix = ' '.$params->get('moduleclass_sfx');
} ?>
<div class="<?php if ($module->showtitle == 0) { ?>noheading <?php } ?>mod mod-basic<?php if($innerwrap == 1){ ?> outer-wrap<?php } if($innerwrap == 2){ ?> inner-wrap<?php } echo $posSuffix; ?>" id="mod<?php echo $module->id; ?>">
	<?php if($innerwrap == 1){ ?><div class="modinner"><?php } ?>
	<?php if ($module->showtitle != 0) : ?><h3 class="modhead"><span class="icon"></span><?php echo moduleHeadings($module->title); ?></h3><?php endif; ?>
	<?php if($innerwrap == 2){ ?><div class="modinner"><?php } ?>
	<?php echo $module->content; ?>
	<?php if($innerwrap == 1 || $innerwrap == 2){ ?></div><?php } ?>
</div>
<?php }

function modChrome_grid($module, &$params, &$attribs) {
$pub_modules = JModuleHelper::getModules($module->position);

$db = JFactory::getDBO();
$query = "SELECT param_value FROM `#__configurator` WHERE `param_name` = '".$module->position."_module_inner';";
$db->setQuery( $query ); $innerwrap = $db->loadResult();

if ($pub_modules[0]->id == $module->id) {
	$posSuffix = ' '.$params->get('moduleclass_sfx') . ' first';
} elseif ($pub_modules[count($pub_modules)-1]->id == $module->id) {
	$posSuffix = ' '.$params->get('moduleclass_sfx') . ' last';
} else {
	$posSuffix = ' '.$params->get('moduleclass_sfx');
} ?>
<div class="mod mod-grid yui-u<?php if($innerwrap == 1){ ?> outer-wrap<?php } if($innerwrap == 2){ ?> inner-wrap<?php } echo $posSuffix; ?>" id="mod<?php echo $module->id; ?>">
	<?php if($innerwrap == 1){ ?><div class="modinner"><?php } ?>
	<?php if ($module->showtitle != 0) : ?><h3 class="modhead"><span class="icon"></span><?php echo moduleHeadings($module->title); ?></h3><?php endif; ?>
	<?php if($innerwrap == 2){ ?><div class="modinner"><?php } ?>
	<?php echo $module->content; ?>
	<?php if($innerwrap == 1 || $innerwrap == 2){ ?></div><?php } ?>
</div>
<?php }

function modChrome_split($module, &$params, &$attribs) {
$pub_modules = JModuleHelper::getModules($module->position);
$menu = JSite::getMenu();
$active_item = $menu->getActive();
$parent_id = $active_item->tree[0];
$parent_item = $menu->getItem($parent_id);
$submenu_heading = $parent_item->name;
$heading = explode(' # ',$submenu_heading);
if ($pub_modules[0]->id == $module->id) {
	$posSuffix = ' '.$params->get('moduleclass_sfx') . ' first';
} elseif ($pub_modules[count($pub_modules)-1]->id == $module->id) {
	$posSuffix = ' '.$params->get('moduleclass_sfx') . ' last';
} else {
	$posSuffix = ' '.$params->get('moduleclass_sfx');
} ?>
<div class="mod mod-basic splitmenu<?php echo ' ' . $posSuffix; ?>" id="mod<?php echo $module->id; ?>">
    <h3 class="modhead"><span class="icon"></span><?php echo $heading[0]; ?></h3>
	<div class="modinner">
	    <?php echo $module->content; ?>
	</div>
</div>
<?php }

function modChrome_tabs($module, &$params, &$attribs) {
global $morph_tabs,$tabscount,$loadtabs,$istabsload;	

	$themodules = JModuleHelper::getModules($module->position);
	$countmodules = count($themodules);
	$db=& JFactory::getDBO();
	$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'tabs' ";
	$db->setQuery( $query );
	$thetabscount = $db->loadResult();
	
	$query = "SELECT param_value FROM `#__configurator` WHERE `param_name` = '".$attribs['name']."_modfx';";
	$db->setQuery( $query );
	$tabs_modfx = $db->loadResult();
		
	foreach ($themodules as $mod){
		if ($mod->content){	
			$currmod = new stdClass();
			$currmod->position = $attribs['name'];	
			$currmod->title = $mod->title;	
			$currmod->content = $mod->content;
			$morph_tabs[$attribs['name']][] = $currmod;
		}
	}
	
	if ($countmodules == count($morph_tabs[ $attribs['name'] ] ) ){ $tabscount++; ?>
		<div id="tabs<?php echo $tabscount; ?>" <?php if($tabs_modfx !== ''){ ?>class="<?php echo $tabs_modfx; ?>"<?php } ?>>
			<ul class="ui-tabs-nav">
			<?php
			$curr_tab = 1;
			$tabs_contents = '';
			foreach ( $morph_tabs[$attribs['name']] as $modul ){
				if ($curr_tab == 1) { ?>
					<li class="ui-state-default ui-tabs-selected"><a href="#tab<?php echo $curr_tab.'-'.$modul->position; ?>"><span class="icon"></span><?php echo moduleHeadings($modul->title);?></a></li>
				<?php } else { ?>
					<li class="ui-state-default"><a href="#tab<?php echo $curr_tab.'-'.$modul->position; ?>"><span class="icon"></span><?php echo moduleHeadings($modul->title);?></a></li>
				<?php 
				}
                                $hide = $curr_tab > 1 ? ' ui-tabs-hide' : '';
    				$tabs_contents .= '<div id="tab'.$curr_tab.'-'.$modul->position.'" class="ui-tabs-panel'.$hide.'">'.$modul->content.'</div>';
    			        $curr_tab++;
			} ?>
			</ul>
		<?php echo $tabs_contents; ?>
		</div>
<?php }
}
function modChrome_accordion($module, &$params, &$attribs) {
global $morph_accordions,$accordionscount,$loadaccordions,$isaccordionsload;

	$themodules = JModuleHelper::getModules($module->position);
	$countmodules = count($themodules);
	$db=& JFactory::getDBO();
	$query = "SELECT COUNT(*) FROM `#__configurator` WHERE `param_value` = 'accordion' ";
	$db->setQuery( $query );
	$theaccordioncount = $db->loadResult();
	
	$query = "SELECT param_value FROM `#__configurator` WHERE `param_name` = '".$attribs['name']."_modfx';";
	$db->setQuery( $query );
	$accordion_modfx = $db->loadResult();
	
	foreach ($themodules as $mod){
		if ($mod->content){	
			$currmod = new stdClass();
			$currmod->position = $attribs['name'];
			$currmod->title = $mod->title;	
			$currmod->content = $mod->content;
			$morph_accordions[$attribs['name']][] = $currmod;
		}
	}

	if ($countmodules == count($morph_accordions[ $attribs['name'] ] ) ){ $accordionscount++; ?>
		<div id="accordions<?php echo $accordionscount; ?>"<?php if($accordion_modfx !== ''){ ?> class="<?php echo $accordion_modfx; ?><?php } ?>">
			<?php
			$curr_accordion = 1;
			$accordions_contents = '';
			foreach ( $morph_accordions[$attribs['name']] as $modul ){ 
				$curr_accordion++;
				if ($curr_accordion == 1) { ?>
					<h3 class="ui-state-default ui-accordion-selected"><a href="#accordion<?php echo $curr_accordion.'-'.$modul->position; ?>"><?php echo moduleHeadings($modul->title);?></a></h3>
				<?php } else { ?>
					<h3 class="ui-state-default"><a href="#accordion<?php echo $curr_accordion.'-'.$modul->position; ?>"><?php echo moduleHeadings($modul->title);?></a></h3>
				<?php 
				}
				echo '<div id="accordion'.$curr_accordion.'-'.$modul->position.'">'.$modul->content.'</div>';	
			}
			//echo $accordions_contents; 
			?>
		</div>
<?php }
}
?>