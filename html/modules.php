<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
jimport('joomla.application.module.helper');
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
	$morph = Morph::getInstance();
	$modfx = $params->get('moduleclass_sfx');
	$hasmodstyle = (strstr($modfx, 'modstyle')) ? ' block ' : '';
	$innerwrap = $morph->{$attribs['name'].'_module_inner'};
	if ($pub_modules[0]->id == $module->id) {
		$posSuffix = ' '.$params->get('moduleclass_sfx') . ' first';
	} elseif ($pub_modules[count($pub_modules)-1]->id == $module->id) {
		$posSuffix = ' '.$params->get('moduleclass_sfx') . ' last';
	} else {
		$posSuffix = ' '.$params->get('moduleclass_sfx');
	} ?>
	<div class="<?php echo $hasmodstyle;?> <?php if($innerwrap == 0){ ?> no-wrap<?php } if ($module->showtitle == 0) { ?>noheading <?php } ?>mod mod-basic<?php if($innerwrap == 1){ ?> outer-wrap<?php } if($innerwrap == 2){ ?> inner-wrap<?php } echo $posSuffix; ?>" id="mod<?php echo $module->id; ?>">
		<?php if($innerwrap == 1){ ?><div class="modinner"><?php } ?>
		<?php if ($module->showtitle != 0) : ?><h3 class="modhead"><span class="icon"></span><?php echo moduleHeadings($module->title); ?></h3><?php endif; ?>
		<?php if($innerwrap == 2){ ?><div class="modinner"><?php } ?>
		<?php echo $module->content; ?>
		<?php if($innerwrap == 1 || $innerwrap == 2){ ?></div><?php } ?>
	</div>
<?php }
function modChrome_grid($module, &$params, &$attribs) {
	$pub_modules = JModuleHelper::getModules($module->position);
	$morph = Morph::getInstance();
	$modfx = $params->get('moduleclass_sfx');
	$hasmodstyle = (strstr($modfx, 'modstyle')) ? ' block ' : '';
	$innerwrap = $morph->{$attribs['name'].'_module_inner'};
	if ($pub_modules[0]->id == $module->id) {
		$posSuffix = ' '.$params->get('moduleclass_sfx') . ' first';
	} elseif ($pub_modules[count($pub_modules)-1]->id == $module->id) {
		$posSuffix = ' '.$params->get('moduleclass_sfx') . ' last';
	} else {
		$posSuffix = ' '.$params->get('moduleclass_sfx');
	} ?>
	<div class="mod mod-grid yui-u<?php echo $hasmodstyle;?><?php if($innerwrap == 0){ ?> no-wrap<?php } if($innerwrap == 1){ ?> outer-wrap<?php } if($innerwrap == 2){ ?> inner-wrap<?php } echo $posSuffix; ?>" id="mod<?php echo $module->id; ?>">
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
	$morph = Morph::getInstance();
	$innerwrap = $morph->{$attribs['name'].'_module_inner'};
	$parent_id = $active_item->tree[0];
	$parent_item = $menu->getItem($parent_id);
	$submenu_heading = $parent_item->name;
	$heading = explode(' # ',$submenu_heading);
	$split_modfx = $morph->{$attribs['name'].'_modfx'};
	$hasmodstyle = (strstr($split_modfx, 'modstyle')) ? ' block ' : '';
	if ($pub_modules[0]->id == $module->id) {
		$posSuffix = ' '.$params->get('moduleclass_sfx') . ' first';
	} elseif ($pub_modules[count($pub_modules)-1]->id == $module->id) {
		$posSuffix = ' '.$params->get('moduleclass_sfx') . ' last';
	} else {
		$posSuffix = ' '.$params->get('moduleclass_sfx');
	} 
	
?>
<div class="mod mod-basic <?php if($split_modfx){ echo ' ' . $hasmodstyle.$split_modfx; } ?> splitmenu<?php echo ' ' . $posSuffix; ?><?php if($innerwrap == 0){ ?> no-wrap<?php } if($innerwrap == 1){ ?> outer-wrap<?php } if($innerwrap == 2){ ?> inner-wrap<?php } echo $posSuffix; ?>" id="mod<?php echo $module->id; ?>">
	<?php if($innerwrap == 1){ ?><div class="modinner"><?php } ?>
	<?php if ($module->showtitle != 0) : ?><h3 class="modhead"><span class="icon"></span><?php echo $heading[0]; ?></h3><?php endif; ?>
	<?php if($innerwrap == 2){ ?><div class="modinner"><?php } ?>
	<?php echo $module->content; ?>
	<?php if($innerwrap == 1 || $innerwrap == 2){ ?></div><?php } ?>
</div>
<?php }
function modChrome_tabs($module, &$params, &$attribs) {
global $morph_tabs,$tabscount,$loadtabs,$istabsload;	
	$themodules = JModuleHelper::getModules($module->position);
	$countmodules = count($themodules);
	$morph = Morph::getInstance();
	$tabs_modfx = $morph->{$attribs['name'].'_modfx'};
	$hasmodstyle = (strstr($tabs_modfx, 'modstyle')) ? ' block ' : '';		
	if(!isset($morph_tabs[$attribs['name']])){	
		foreach ($themodules as $mod){
			if(!$mod->content){
				ob_start();
				$mod->content = JModuleHelper::renderModule($mod, array('name' => $attribs['name'], 'style' => 'none'));
			 	ob_end_clean();
			 }
			if ($mod->content){	
				$currmod = new stdClass();
				$currmod->position = $attribs['name'];	
				$currmod->title = $mod->title;	
				$currmod->content = $mod->content;
				$params = new JParameter($mod->params);
				$currmod->suffix = $params->toObject()->moduleclass_sfx;
				$morph_tabs[$attribs['name']][] = $currmod;
			}
		}
		$tabscount++; ?>
		<div id="tabs<?php echo $tabscount; ?>" class="mod<?php if($tabs_modfx){ echo ' ' . $hasmodstyle.$tabs_modfx; } ?>">
			<ul class="ui-tabs-nav clearer">
			<?php
			$curr_tab = 1;
			$tabs_contents = '';
			foreach ( $morph_tabs[$attribs['name']] as $modul ){
				if ($curr_tab == 1) { ?>
					<li class="ui-state-default <?php echo $modul->suffix ?> ui-tabs-selected"><a href="#tab<?php echo $curr_tab.'-'.$modul->position; ?>"><span class="icon"></span><?php echo moduleHeadings($modul->title);?></a></li>
				<?php } else { ?>
					<li class="ui-state-default <?php echo $modul->suffix ?>"><a href="#tab<?php echo $curr_tab.'-'.$modul->position; ?>"><span class="icon"></span><?php echo moduleHeadings($modul->title);?></a></li>
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
	global $mainframe,$morph_accordions,$accordionscount,$loadaccordions,$isaccordionsload;
	$themodules = JModuleHelper::getModules($module->position);
	$countmodules = count($themodules);
	$morph = Morph::getInstance();
	$accordion_modfx = $morph->{$attribs['name'].'_modfx'};
	$hasmodstyle = (strstr($accordion_modfx, 'modstyle')) ? 'block ' : '';	
	if(!isset($morph_accordions[$attribs['name']])){
		foreach ($themodules as $i => $mod){	
			if(!$mod->content){
				ob_start();
				$mod->content = JModuleHelper::renderModule($mod, array('name' => $attribs['name'], 'style' => 'none'));
			 	ob_end_clean();
			 }
			if ($mod->content){
				$currmod = new stdClass();
				$currmod->position = $attribs['name'];
				$currmod->title = $mod->title;	
				$currmod->content = $mod->content;
				$params = new JParameter($mod->params);
				$currmod->suffix = $params->toObject()->moduleclass_sfx;
				$morph_accordions[$attribs['name']][$mod->id] = $currmod;
			}
		}
	$accordionscount++; ?>
		<div id="accordions<?php echo $accordionscount; ?>" class="mod<?php if($accordion_modfx){ echo ' ' . $hasmodstyle.$accordion_modfx; } ?>">
			<?php
			$curr_accordion = 1;
			$accordions_contents = '';
			foreach ( $morph_accordions[$attribs['name']] as $modul ){ 
				$curr_accordion++;
				
				if ($curr_accordion == 1) { ?>
					<h3 class="ui-state-default modhead <?php echo $modul->suffix ?> ui-accordion-selected"><a href="#accordion<?php echo $curr_accordion.'-'.$modul->position; ?>"><?php echo moduleHeadings($modul->title);?></a></h3>
				<?php } else { ?>
					<h3 class="ui-state-default modhead <?php echo $modul->suffix ?>"><a href="#accordion<?php echo $curr_accordion.'-'.$modul->position; ?>"><?php echo moduleHeadings($modul->title);?></a></h3>
				<?php 
				}
				echo '<div id="accordion'.$curr_accordion.'-'.$modul->position.'">'.$modul->content.'</div>';	
			}
			?>
		</div>
<?php }
}
} // close the themelet override check