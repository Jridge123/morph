<?php defined( '_JEXEC' ) or die( 'Restricted access' );

class morphLayouts {

	
	public function __construct()
	{
		// set variables
		$document = JFactory::getDocument();
		$this->option = JRequest::getCmd('option');
		$this->CurrentOuterScheme = '';
		$this->CurrentInnerScheme = '';
		$this->innerLayouts=array();
	
		$this->total_padding = '';
	
		
		// call layout functions
		
		$this->outerLayout();
		$this->innerLayout();
		$this->outerPos();
		$this->innerLayoutSums(); 
		
		// @andy TODO: $this->innerPos();
				
	}
	
	public function isIE6() 
	{
		$this->isIE6 ='';
		// get the browser and version then target ie6	- make $this->isIE6 var
		$browser = new MBrowser();
		$engine = strtolower(preg_replace("/[^A-Za-z]/i", "", $browser->getBrowser()));
		$version = $engine.str_replace('.', '', $browser->getVersion());
		$version == 'internetexplorer60' ? $this->isIE6 = 1 :  $this->isIE6 = 0;
		return $this->isIE6;
	}
	
	public function get_pageClass() 
	{
		if(!preg_match('/administrator/i', $_SERVER['REQUEST_URI'])){
			$MORPH = Morph::getInstance();
			$this->pageclass   				= "";
			$menus      				= JSite::getMenu();
			$menu      					= $menus->getActive();
			$cache						= $MORPH->cache ? '&cache='.$MORPH->cachetime : false;
			$gzip						= $MORPH->gzip_compression ? '&gzip='.$MORPH->gzip_compression : false;
			if (is_object( $menu )) :
				$params 					= new JParameter( $menu->params );
				$this->pageclass 					= $params->get( 'pageclass_sfx' );
			endif;
			return $this->pageclass;
		} else {
			$this->pageclass   				= "";
			return $this->pageclass;
		}
	}
	
	public function outerLayout()
	{
	
		$this->outerPageSuffix = array (
			'0' => 'yui-t0',
			'1' => 'yui-t1',
			'2' => 'yui-t2',
			'3' => 'yui-t3',
			'4' => 'yui-t4',
			'5' => 'yui-t5',
			'6' => 'yui-t6',
			'7' => 'yui-t8',
			'8' => 'yui-t9'
		);
		
		$this->OuterScheme = '';
		$MORPH = Morph::getInstance();
		if(!preg_match('/administrator/i', $_SERVER['REQUEST_URI'])){
			$this->OuterScheme = array ('default'=>"$MORPH->outer_default");
			foreach($MORPH as $k => $v){
		 		if(preg_match('/od_/i', $k)){
		 			$k = str_replace('od_', '', $k);
		 			$this->OuterScheme[$k] = $v;
		 		}
		 	}
			if ($this->option && isset($this->OuterScheme[$this->option]) && trim($this->OuterScheme[$this->option])!= 'default'){
				$this->CurrentOuterScheme = $this->outerPageSuffix[trim($this->OuterScheme[$this->option])];
			}else{
				$this->CurrentOuterScheme = $this->OuterScheme['default'];
			}
		};
		
		$this->get_pageClass();
		if(isset($this->pageclass)){
			$this->outerSfxArr = (explode("outer",$this->pageclass));
			if (array_key_exists(1,$this->outerSfxArr)) {
				$this->CurrentOuterScheme = $this->outerPageSuffix[substr($this->outerSfxArr[1],0,1)];
			}
		}
		return $this->CurrentOuterScheme;
	}
	
	// set position class on sidebars
	public function outerPos()
	{
		$this->outer_pos_class = '';
		switch ($this->CurrentOuterScheme)
		{
		case 'yui-t1':
			$this->outer_pos_class = 'left-pos';
			break;
		case 'yui-t2':
			$this->outer_pos_class = 'left-pos';
			break;
		case 'yui-t3':
			$this->outer_pos_class = 'left-pos';
			break;
		case 'yui-t4':
			$this->outer_pos_class = 'right-pos';
			break;
		case 'yui-t5':
			$this->outer_pos_class = 'right-pos';
			break;
		case 'yui-t6':
			$this->outer_pos_class = 'right-pos';
			break;
		case 'yui-t8':
			$this->outer_pos_class = 'left-pos';
			break;
		case 'yui-t9':
			$this->outer_pos_class = 'right-pos';
			break;	
		default:
			//code
			break;
		}
		return $this->outer_pos_class;
	}
	
	public function outerCount() {
		$morph = Morph::getInstance();
		$outer1_count 				= $morph->countModules('outer1');
		$outer2_count 				= $morph->countModules('outer2');
		$outer3_count 				= $morph->countModules('outer3');
		$outer4_count 				= $morph->countModules('outer4');
		$outer5_count 				= $morph->countModules('outer5');

		$this->get_pageClass();
		if(isset($this->pageclass)){
			strstr($this->pageclass, 'outer0') ? $this->outer_hide=1 : $this->outer_hide=0;
		}
				
		if ($this->outer_hide == 1){ 
			$outer_active = 0;
		} else if ($outer1_count or $outer2_count or $outer3_count or $outer4_count or $outer5_count) {
			$outer_active = 1;
		} else {
			$outer_active ='';
		}
		
		return $outer_active;
	}
	
	public function innerCount() {
		$morph = Morph::getInstance();
		
		$inner_count = '';
		$inner1_count 				= $morph->countModules('inner1');
		$inner2_count 				= $morph->countModules('inner2');
		$inner3_count 				= $morph->countModules('inner3');
		$inner4_count 				= $morph->countModules('inner4');
		$inner5_count 				= $morph->countModules('inner5');
		
		$this->inner_width = $morph->inner_width;
		$this->inner_show = $morph->inner_show;
		
		// first check if modules are published and set var
		if ($inner1_count or $inner2_count or $inner3_count or $inner4_count or $inner5_count) {
			$this->hasModsPublished = 1;
		} else {
			$this->hasModsPublished = 0;
		}
		// check if inner width or show is 1 or 0
		if ($this->inner_width == 0 or $this->inner_show == 0) {
			$this->hasInner = 0;
			$morph->inner_width = 0;
		} else {
			$this->hasInner = 1;
		}
		// finally check if published or show and set count 1 or 0
		if ($this->hasModsPublished == 1 and $this->hasInner == 1) {
			$inner_count = 1;
		} else if ($this->hasInner == 0) {
			$inner_count = 0;
		}

		return $inner_count;
	}

	public function innerLayout()
	{
		$morph = Morph::getInstance();
		
		/* Legacy Layout presets
		$this->innerPageSuffix = array (
		    '0' => 'none',
			'1' => 'yui-g',
			'2' => 'yui-gc',
			'3' => 'yui-ge',
			'4' => 'yui-gi',
			'5' => 'yui-gh'
		);*/
		
		// list presets for inner layout
		$this->innerPageSuffix = array (
		    '0'  => array('0', 'px', ' left'),
			'1'  => array('150', 'px', ' left'),
			'2'  => array('180', 'px', ' left'),
			'3'  => array('200', 'px', ' left'),
			'4'  => array('250', 'px', ' left'),
			'5'  => array('300', 'px', ' left'),
			
			'6'  => array('150', 'px', ' right'),
			'7'  => array('180', 'px', ' right'),
			'8'  => array('200', 'px', ' right'),
			'9'  => array('250', 'px', ' right'),
			'10' => array('300', 'px', ' right'),
		);
		
		// component layouts
		$this->innerScheme='';
		if(!preg_match('/administrator/i', $_SERVER['REQUEST_URI'])){
			$this->innerScheme = array ();	
			foreach($morph as $k => $v){
		 		if(preg_match('/id_/i', $k)){
		 			$k = str_replace('id_', '', $k);
		 			$this->innerScheme[$k] = $v;
		 		}
		 	}
			if($this->option && isset($this->innerScheme[$this->option]) && trim($this->innerScheme[$this->option])!= 'default'){
				$this->CurrentInnerScheme = $this->innerPageSuffix[trim($this->innerScheme[$this->option])];
				$morph->inner_width=$this->CurrentInnerScheme[0];
				$morph->inner_pos=trim($this->CurrentInnerScheme[2]);
				$morph->inner_width_type=$this->CurrentInnerScheme[1];
			}else{
				$this->CurrentInnerScheme = array (
					'width'=>$morph->inner_width.$morph->inner_width_type,
					'position'=>$morph->inner_pos
				);
			}
		};
		
		// per page layouts - page class sfx
		if(!preg_match('/administrator/i', $_SERVER['REQUEST_URI'])){
		$this->get_pageClass();
		if(isset($this->pageclass) && strstr($this->pageclass, 'inner') || strstr($this->pageclass, 'outer')){
			$this->pageSfxArr = (explode(" ",$this->pageclass));
			if (strstr($this->pageSfxArr[0], 'inner')){
				$this->innerSfxArr = (explode("inner",$this->pageSfxArr[0]));
			} elseif (strstr($this->pageSfxArr[1], 'inner')){
				$this->innerSfxArr = (explode("inner",$this->pageSfxArr[1]));
			} else {
				$this->innerSfxArr = (explode("inner",$this->pageSfxArr[0]));
			} 
			if(array_key_exists(1,$this->innerSfxArr)) {
				$morph->inner_show = 1;
				$this->CurrentInnerScheme = $this->innerPageSuffix[substr($this->innerSfxArr[1],0,1)];
				if (isset($this->innerPageSuffix[$this->innerSfxArr[1]][0])) {
				$morph->inner_width=$this->innerPageSuffix[$this->innerSfxArr[1]][0];
				}
				if (isset($this->innerPageSuffix[$this->innerSfxArr[1]][1])) {
				$morph->inner_width_type=$this->innerPageSuffix[$this->innerSfxArr[1]][1];
				}
				if (isset($this->innerPageSuffix[$this->innerSfxArr[1]][2])) {
				$morph->inner_pos=trim($this->innerPageSuffix[$this->innerSfxArr[1]][2]);
				}
			}
		}
		}

		return $this->CurrentInnerScheme;
	}
	
	public function innerLayoutSums() 
	{
		$morph = Morph::getInstance();
		// calculate width of remaining content for inner and main
		// 1. get outer width
		$this->outer_w = '';
		// if no outer sidebar
		$this->outerCount() ? $this->CurrentOuterScheme = $this->CurrentOuterScheme : $this->CurrentOuterScheme = 'yui-t0';
		if ($this->CurrentOuterScheme == 'yui-t1') : $this->outer_w = 160;
		elseif ($this->CurrentOuterScheme == 'yui-t2') : $this->outer_w = 180;
		elseif ($this->CurrentOuterScheme == 'yui-t4') : $this->outer_w = 180;
		elseif ($this->CurrentOuterScheme == 'yui-t5') : $this->outer_w = 240;
		elseif ($this->CurrentOuterScheme == 'yui-t3') : $this->outer_w = 300;
		elseif ($this->CurrentOuterScheme == 'yui-t6') : $this->outer_w = 300;
		elseif ($this->CurrentOuterScheme == 'yui-t8') : $this->outer_w = 200;
		elseif ($this->CurrentOuterScheme == 'yui-t9') : $this->outer_w = 200;
		elseif ($this->CurrentOuterScheme == 'yui-t0') : $this->outer_w = 0;
		endif;
						
		//2. get current layout
		$this->site_w = '';
		if ($morph->site_width == 'doc') : $this->site_w = 750;
		elseif ($morph->site_width == 'doc2') : $this->site_w = 950;
		elseif ($morph->site_width == 'doc4') : $this->site_w = 974;
		elseif ($morph->site_width == 'doc3') : $this->site_w = "100%";
		endif;
		
		//3. get available width
		$this->available_maininner = $this->site_w - $this->outer_w;
				
		// custom page class suffix
		$this->get_pageClass();
		if(strstr($this->pageclass, '-inner')) {
			$customInnerSfxArr = (explode("-",$this->pageclass));
			$morph->inner_width = $customInnerSfxArr[0];
			$morph->inner_width_type = $customInnerSfxArr[1];	
			$morph->inner_pos = $customInnerSfxArr[2];			
		}							
		
		$morph->inner_pos == 'right' ? $this->main_pos = 'left' :  $this->main_pos = 'right';
				
		// .set multiplication of em's based on browser	
		
		// apply 12.9333 if its ie6 for accurate pixel perfect layout
		$this->isIE6 = $this->isIE6();
		$this->isIE6 ? $em_multiply = 12.9333 : $em_multiply = 13;
										
		// Goal: get total padding for bd-inner and inner-wrap from Configurator options
		$this->total_padding = '';
		
		// if be inner padding is shorthand, lets build the array
		if (strlen($morph->padding_bdinner) == 3) {
			$morph->padding_bdinner = $morph->padding_bdinner.' '.$morph->padding_bdinner.' '.$morph->padding_bdinner.' '.$morph->padding_bdinner;
		}
		
			// 1. get total bdinner padding - left and right only
			if (strstr($morph->padding_bdinner, 'em')) {
				$this->padding_bdinner_unit = "em ";
			}	else if (strstr($morph->padding_bdinner, 'px')) {
				$this->padding_bdinner_unit = "px ";
				$em_multiply = 1;
			} else {
				$this->padding_bdinner_unit = '';
			}
												
			$this->padding_bdinner = explode($this->padding_bdinner_unit, $morph->padding_bdinner);
			// adjustment to be able to use all css shorthand options for padding ie.. "1px 3px" or "3px 3px 2px" etc
			// take string array that was just exploded from padding string and count it
			$padding_bdinner_unitcount = count($this->padding_bdinner);
			// now create position variables for each count to say which item in array is left and right padding
			if ($padding_bdinner_unitcount == 1) {
				$right_padding_bdinner_pos = 0;
				$left_padding_bdinner_pos = 0;
			} else if ($padding_bdinner_unitcount == 2 or $padding_bdinner_unitcount == 3) {
				$right_padding_bdinner_pos = 1;
				$left_padding_bdinner_pos = 1;
			} else if ($padding_bdinner_unitcount == 4) {
				$right_padding_bdinner_pos = 1;
				$left_padding_bdinner_pos = 3;
			}
			
			$right_padding_bdinner = $this->padding_bdinner[$right_padding_bdinner_pos] *$em_multiply;
			$left_padding_bdinner = $this->padding_bdinner[$left_padding_bdinner_pos] *$em_multiply;
			
			$total_bdinner = $right_padding_bdinner + $left_padding_bdinner;
			
			// 2 sidebar gutter
			// get gutter value, check unit used then remove the "em or px unit" and then multiply by em_multiply
			
			if (strstr($morph->sidebars_gutter, 'em')) {
				$this->sidebars_gutter_unit = 'em';
			}	else if (strstr($morph->sidebars_gutter, 'px')) {
				$this->sidebars_gutter_unit = 'px';
				$em_multiply = 1;
			}	else {
				$this->sidebars_gutter_unit = '';
			}
						
			$this->sidebar_gutter = str_replace($this->sidebars_gutter_unit, '', $morph->sidebars_gutter) * $em_multiply;
			
			// divide margin by 2 if its IE6 to fix the double padding bug
			if($this->isIE6) {
				$this->sidebar_gutter = str_replace($this->sidebars_gutter_unit, '', $morph->sidebars_gutter) * $em_multiply / 2;
			}
						
			// double gutter if outer sidebar active.. ie.. both sidebars are in use
			if ($this->outerCount() && $this->innerCount()) {
				$this->gutter_multiply = 2;
			} else if (!$this->outerCount() && !$this->innerCount()) { 
				$this->gutter_multiply = 0;
			} else {
				$this->gutter_multiply = 1;
			}
									
		// if no inner sidebar make width 0
		if (!$this->innerCount()) {
			$morph->inner_width = 0;
		}
		
		// Goal result : lastly get total padding from both to get total gutter to reduce width by that amount
		$this->total_padding = $total_bdinner;
		
		// Calculate content width by deducting all padding and gutters from available main inner
		$this->primary_w = $this->available_maininner - $morph->inner_width - $this->total_padding - ($this->sidebar_gutter * $this->gutter_multiply);
		if($this->isIE6) {
			$this->primary_w = $this->available_maininner - $morph->inner_width - $this->total_padding - ($this->sidebar_gutter * $this->gutter_multiply) - ($this->sidebar_gutter *2);
		}
		//change primary_w if the user selects % instead of px
		if ($morph->inner_width_type == '%' and $morph->site_width != 'doc3') {
			$this->sidebar_gutter = str_replace('%', '', $morph->sidebars_gutter);
			if (strstr($morph->sidebars_gutter, 'em')) {
				$this->sidebar_gutter = str_replace('em', '', $morph->sidebars_gutter);
			}
			$this->primary_w = 100 - $morph->inner_width - $this->sidebar_gutter;
			$morph->inner_width = $morph->inner_width - $this->sidebar_gutter;
		}
		
		if ($morph->site_width == 'doc3') {
			$this->available_maininner = "undefined";
			$this->primary_w = 100 - $morph->inner_width - $this->sidebar_gutter;
			if ($this->gutter_multiply == 2) {
				$morph->inner_width = $morph->inner_width - $this->sidebar_gutter;
			}
		}
				
		$this->innerLayouts = '';
		
		$this->innerLayouts = array(
			"site_width" => $this->site_w,
			"outer_width" => $this->outer_w,
			"available_main_inner" => $this->available_maininner,
			// morph vars from Configurator input
			"inner_width" => $morph->inner_width,
			"type" => $morph->inner_width_type,
			"inner_sidebar_position" => $morph->inner_pos,
			"padding_bdinner" => $morph->padding_bdinner,
			"padding_bdinner unit" => $this->padding_bdinner_unit,
			"padding_total_left+right" =>$this->total_padding,
			"sidebars_gutter" =>$this->sidebar_gutter,
			"gutter_multiply"=>$this->gutter_multiply,
			//gutter total = gutter x multiply
			"gutter_total" =>$this->sidebar_gutter * $this->gutter_multiply,
			"sidebar_gutter_unit" =>$this->sidebars_gutter_unit,
			"primary_width" => $this->primary_w,
			"outer_count" =>$this->outerCount(),
			"inner_count" =>$this->innerCount(),
			"main_pos"=>$this->main_pos,
			"isIE6"=>$this->isIE6);
				
		return $this->innerLayouts;
	}
	
	static function addLayoutCSS() {
		$layouts = new morphLayouts();
		$morph = Morph::getInstance();
		$pos_margin_css = '';
		$margin_css = '';
		$bd_inner_css = '
#bd .bd-inner {padding: '. $layouts->innerLayouts['padding_bdinner'].';}';
		$tertiary_css = '
#tertiary-content {width:'.$layouts->innerLayouts['inner_width'].$layouts->innerLayouts['type'].';float:'.$layouts->innerLayouts['inner_sidebar_position'].';}';
		$primary_css = '
#primary-content {width:'.$layouts->innerLayouts['primary_width'].$layouts->innerLayouts['type'].';float:'.$layouts->innerLayouts['main_pos'].';}';
	if ($layouts->innerLayouts['outer_count'] == 1) {
		if ($layouts->innerLayouts['sidebars_gutter'] == 0) {
			$pos_margin_css = '
#bd.left-pos-secondary #inset1,
#bd.left-pos-secondary #inset4 {margin-left:13px;}

#bd.right-pos-secondary #inset1,
#bd.right-pos-secondary #inset4 {margin-right:13px}';
			} else {
			$pos_margin_css = '
#bd.left-pos-secondary #inset1,
#bd.left-pos-secondary #inset4,
#bd.left-pos-secondary #inner-wrap.right-tertiary #primary-content,
#bd.left-pos-secondary #inner-wrap.left-tertiary #tertiary-content {margin-left:'. $layouts->innerLayouts['sidebars_gutter'].$layouts->innerLayouts['type'] .';}
		
#bd.right-pos-secondary #inset1,
#bd.right-pos-secondary #inset4,
#bd.right-pos-secondary #inner-wrap.left-tertiary #primary-content,
#bd.right-pos-secondary #inner-wrap.right-tertiary #tertiary-content {margin-right:'.$layouts->innerLayouts['sidebars_gutter'].$layouts->innerLayouts['type'] .';}';
			}
		}
		$morph->addStyleDeclaration($bd_inner_css.$tertiary_css.$primary_css.$pos_margin_css);
	}
}


