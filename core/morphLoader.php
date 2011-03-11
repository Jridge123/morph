<?php defined( '_JEXEC' ) or die( 'Restricted access' );
/*
 * Morph loader
 *
 * This file is part of the Morph template component for Joomla.
 *
 * The Morph template component provides an easy interface for
 * managing the dynamic configuration variables in modern 
 * Joomla templates. 
 *
 * The Morph component is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 */

$morph_component_path = JPATH_ADMINISTRATOR.'/components/com_configurator';
include_once $morph_component_path . '/configurator.common.php';
include_once $morph_component_path . '/configurator.class.php';
include_once $morph_component_path . '/depencies.php';
jimport('joomla.filesystem.file');

class Morph {

	protected $_generated_override = '<?php defined( \'_JEXEC\' ) or die( JText::_( \'Restricted access\' ) );
      if($override = Morph::override(__FILE__, $this)) {
            if(file_exists($override)) include $override;
      }';

	public $scripts = array();
	public $scriptsAfter = array();
	public $scriptDeclarations = '';
	
	public $styleSheets = array();
	public $styleSheetsAfter = array();
	public $styleDeclarations = '';
	
	public static $_timeofday;

	public function __construct( $template = 'morph' )
	{
		$db = JFactory::getDBO();

		if( $template == null ) return;
		
		
		// themelet settings
		$db->setQuery("select param_value from #__configurator where param_name = 'themelet' and template_name = 'morph'");
		$themelet_name = $db->loadResult();
		
		$this->themeletpath = JURI::root(1) . '/morph_assets/themelets/'.$themelet_name;
		$this->absolutepath = JPATH_SITE.'/morph_assets/themelets/'.$themelet_name;
		
		$Itemid = (int) JRequest::getInt('Itemid');
		$db->setQuery("select param_value from #__configurator where param_name = 'themelet' and template_name = '$Itemid.morph'");
		if($themelet = $db->loadResult()) $themelet_name = $themelet;
		
		$themelet_params = array();
		
		
		$db->setQuery( "SHOW TABLES LIKE '%configurator'" );
		$morph_installed = $db->loadResult();

		if ( isset( $morph_installed ) ) {
			//$query = "SELECT * FROM #__configurator WHERE `template_name` = '{$template}'";
			//$db->setQuery($query);
			//$params = (array) $db->loadObjectList();

			JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_configurator/tables');
			$params = JTable::getInstance('ConfiguratorTemplateSettings', 'Table')->template($template)->getConfigs();
		} else {
			$params = array();
		}


		$xml_params = ComConfiguratorHelperUtilities::getTemplateParamList( realpath(dirname(__FILE__).'/morphDetails.xml'), TRUE );
		if(isset($themelet_name)) $themelet_params = getTemplateParamList( JPATH_ROOT.'/morph_assets/themelets/'.$themelet_name.'/themeletDetails.xml', TRUE );

		foreach(array_merge($xml_params, $themelet_params) as $key => $value)
		{
			$this->$key = $value;
		}
		
		// Replace default settings with any settings found in the DB.
		foreach( $params as $param ) {
			$this->{$param->param_name} = $param->param_value;
		}
		
		//Logo stuff
		//@TODO this code is copied from morphVars.php and needs a cleanup
		if ( $this->logo_type == 1 or $this->logo_type == 2 ) {
			if(preg_match('/MSIE 6/i', @$_SERVER['HTTP_USER_AGENT']) && ($this->logo_ielogo_image) !== ''){ 
				$this->logo = JURI::root() . 'morph_assets/logos/'.$this->logo_ielogo_image; 
				if($this->logo_autodimensions == 1) {
					$this->logo_size = getimagesize(JPATH_SITE.'/morph_assets/logos/'.$this->logo_ielogo_image);
				}else{
					$this->logo_size[0] = $this->logo_width;
					$this->logo_size[1] = $this->logo_height;
				}	
			} else{ 
				$this->logo = JURI::root() . 'morph_assets/logos/'.$this->logo_image; 
				if($this->logo_autodimensions == 1) {
					$this->logo_size = getimagesize(JPATH_SITE.'/morph_assets/logos/'.$this->logo_image);
				}else{
					$this->logo_size[0] = $this->logo_width;
					$this->logo_size[1] = $this->logo_height;
				}
			}
		} else {
			$this->logo_size[0] = 'null';
			$this->logo_size[1] = 'null';
			$this->logo = 'null';
		}

		if($this->developer_toolbar || $this->debug)
		{
			$app = JFactory::getApplication();
			$overrides = JRequest::getVar('morph', array(), 'get', 'array');
			
			$overrides = array_merge((array)$app->getUserState('morph'), $overrides);
			foreach($overrides as $name => $override)
			{
				if($name == 'debug') continue;
				if($name != '' . "\0" . '*' . "\0" . '_generated_override') $this->$name = $override;
			}
		}
		
		//TODO: We need to make the caching smarter, so we don't have to do this here
		/*if(isset($this->developer_toolbar) && $this->developer_toolbar)
		{
			$this->pack_css = JRequest::getBool('packcss', $this->pack_css, 'COOKIE');
			$this->pack_js = JRequest::getBool('packjs', $this->pack_js, 'COOKIE');
			if(JRequest::getCmd('gzip') == 'on') $this->gzip_compression = 1;
			else if(JRequest::getCmd('nogzip', false, 'COOKIE') == 'off') $this->gzip_compression = 0;
		}*/
	}
	
	public static function &getInstance($template = 'morph')
	{
		static $instances;
		
		if (!$instances) $instances = array();
		
		if (empty($instances[$template])) $instances[$template] = new Morph($template);
		
		return $instances[$template];
	}
	
	public function cache()
	{
		jimport('joomla.filesystem.folder');
		$cache = JPATH_CACHE.'/morph';
		if(JRequest::getCmd('empty', false) == 'cache' && JFolder::exists($cache)) JFolder::delete($cache);

		if($this->developer_toolbar || $this->debug)
		{
			$app = JFactory::getApplication();
			$params = JRequest::getVar('morph', array(), 'get', 'array');
			$params = array_merge((array)$app->getUserState('morph'), $params);
			
			/*
			$backup = array();
			foreach(array('scripts', 'styleSheets', 'styleSheetsAfter') as $b) $backup[$b] = $this->$b;
			$params = array_merge((array)$this, $params);

			foreach($params as $name => $param)
			{
				if($name == 'debug') continue;
				//if($name == 'scripts' && !$this->pack_js) continue;
				//if(in_array($name, array('styleSheets', 'styleSheetsAfter')) && !$this->pack_css) continue;

				// Just to avoid errors
				if($name != '' . "\0" . '*' . "\0" . '_generated_override') $this->$name = $param;
			}
			
			if(!$this->jquery_core) unset($this->scripts['/templates/morph/core/js/jquery.js']);
			if(!$this->developer_toolbar) unset($this->styleSheetsAfter['/templates/morph/core/css/devbar.css']);
			if($this->developer_toolbar) $this->addStyleSheetAfter('/templates/morph/core/css/devbar.css');
			
			foreach($backup as $name => $b) $this->$name = $b;
			//*/
			
			$app->setUserState('morph', $params);
		}

		//Generate name for the morph json formatted params that are passed to the css and js views
		$uri	= clone JFactory::getURI();
		$base	= JPATH_CACHE.'/morph-sessions/'.session_id().'/';
		$parts	= array_filter(explode('/', $uri->getPath()));
		//Sometimes index.php are added even if not present in main url. So remove it just in case
		if(end($parts) == 'index.php') array_pop($parts);
		$parts[]= $uri->getHost();
		$pre	= implode('.', $parts);
		$path	= $base.$pre;
		$query	= $uri->getQuery(1);
		$path = $path.'&'.http_build_query($query).'.json';

		if(file_exists($path))
		{
			$created	= time()-date('U', filemtime($path));
			$expire		= (int)$this->cache * 60;
			if($created > $expire)
			{
				$json = json_encode($this);
				JFile::write($path, $json);
			}
		} else {
			$json = json_encode($this);
			JFile::write($path, $json);
		}

		if($this->developer_toolbar || $this->debug)
		{
			if(isset($_GET['morph'])){
				$uri = clone JFactory::getURI();
				$uri->delVar('morph');

				header('Location: ' . $uri->toString());
			}
		}
	}
		
	public function get($param_name=null)
	{
		if(!isset($param_name)) return null;
		return $this->$param_name;
	}

	public function addScript($url, $type = 'text/javascript')
	{
		$this->scripts[$url] = $type;
	}
	
	/**
	 * Adds a script declaration (inline javascript) to Morph
	 *
	 * This allows the js to be optionally packed, minified, gzipped and cached
	 *
	 * @param	string	$script		The script are injected very last in template.js.php.
	 *								This means you'll have to do domready yourself, but gives you full freedom.
	 * @return	object	$this
	 */
	public function addScriptDeclaration($script)
	{
		$this->scriptDeclarations .= $script;

		return $this;
	}
	
	public function addScriptAfter($url, $type = 'text/javascript')
	{
		$this->scriptsAfter[$url] = $type;
	}
	
	public function addStyleSheet($url, $type = 'text/css', $media = null, $attribs = array())
	{
		$this->styleSheets[$url]['mime']	= $type;
		$this->styleSheets[$url]['media']	= $media;
		$this->styleSheets[$url]['attribs']	= $attribs;
	}
	
	public function addStyleDeclaration($style)
	{
		$this->styleDeclarations .= $style;
	}
	
	public function addStyleSheetAfter($url, $type = 'text/css', $media = null, $attribs = array())
	{
		$this->styleSheetsAfter[$url]['mime']	 = $type;
		$this->styleSheetsAfter[$url]['media']	 = $media;
		$this->styleSheetsAfter[$url]['attribs'] = $attribs;
	}
	
	public function updateJDocument()
	{
		$uri	= clone JFactory::getURI();
		$cache	= $this->cache ? $uri->setVar('cache', $this->cachetime) : false;
		$gzip	= $this->gzip_compression ? $uri->setVar('gzip', $this->gzip_compression) : false;
		$duris	= $this->data_uris ? $uri->setVar('data_uris', $this->data_uris) : false;
		
		$uri->setVar('render', 'js');
		$renderjs = JFilterOutput::ampReplace($uri->toString());
		$uri->setVar('render', 'css');
		$rendercss = JFilterOutput::ampReplace($uri->toString());

		$document = JFactory::getDocument();
		if(!$this->nojs)
		{
		
			if(!$this->jquery_core) unset($this->scripts['/templates/'.$document->template.'/core/js/jquery.js']);
			if($this->pack_js)
			{
				$document->_scripts = array_merge(array($renderjs => 'text/javascript'), $document->_scripts);
			}
			else
			{
				$scriptsBefore = array();
				foreach($this->scripts as $script => $type)
				{
					$scriptsBefore[JURI::root(1).$script] = $type;
				}
				
				$document->_scripts = array_merge($scriptsBefore, array($renderjs => 'text/javascript'), $document->_scripts);
				$this->scripts = array();
			}
		}
		
		if($this->pack_css)
		{
			$document->addStyleSheet($rendercss);
		}
		else
		{
			foreach($this->styleSheets as $css => $args)
			{
				$document->addStyleSheet(JURI::root(1).$css, $args['mime'], $args['media'], $args['attribs']);
			}
			
			$document->addStyleSheet($rendercss);
			
			foreach($this->styleSheetsAfter as $css => $args)
			{
				$document->addStyleSheet(JURI::root(1).$css, $args['mime'], $args['media'], $args['attribs']);
			}
			$this->styleSheets = array();
			$this->styleSheetsAfter = array();
		}
		$this->cache();
	}
	
	public function countModules($condition)
	{
		$result = '';
		
		$document = JFactory::getDocument();

		$words = explode(' ', $condition);
		for($i = 0; $i < count($words); $i+=2)
		{
			// odd parts (modules)
			$name		= strtolower($words[$i]);
			$words[$i]	= 0;
			
			if(!isset($document->_buffer['modules'][$name])) 
			{
				$modules = JModuleHelper::getModules($name);
				$result  = $document->getBuffer('modules', $name);
				$words[$i] += !empty($result);
			}
		}

		$str = 'return '.implode(' ', $words).';';

		return eval($str);
	}
	
	/**
	 * Parse relative layout path
	 *
	 * @param  $layout	string		Should be the __FILE__ constant.
	 * @return string				The new path
	 */
	protected static function parsePath($layout)
	{
		$parts		= explode(DIRECTORY_SEPARATOR, $layout);
		foreach(array('file', 'layout', 'extension') as $name) $$name = array_pop($parts);
		$override = '/html/' . $extension . '/' . $layout . '/' . $file;
		if($extension == 'html') $override = '/html/' . $layout . '/' . $file;
		$base 		= self::getThemeletPath();
		return $base.$override;
	}
	
	/**
	 * Function for getting a themelet layout override
	 *
	 * Gives themelets the possibility to have html overrides on their own.
	 *
	 * @param  $layout	string		Should be the __FILE__ constant.
	 * @param  $view	object		Should be the $this object available to the layout.
	 * @return 			boolean		Returns true if the themelet had an override, false if not
	 */
	public function override($layout, $view)
	{
		$tmpl		= self::parsePath($layout);


		//Prevent eternal recursing
		static $paths;
		if(!isset($paths)) $paths = array();
		
		if(isset($paths[$tmpl])) {
			list(, $caller) = debug_backtrace(false);
			$calling_file	= self::parsePath($caller['file']);
			if($calling_file == $tmpl) return false;
		} else {
			$paths[$tmpl] = $tmpl;
		}


		if(file_exists($tmpl))
		{
			if(method_exists($view, 'addTemplatePath'))
			{
				$view->addTemplatePath(dirname($tmpl));

				echo $view->loadTemplate();
				
				return true;
			}
			else
			{
				return $tmpl;
			}
		}
		return false;
	}
	
	/**
	 * Utility function for creating layout overrides
	 *
	 * Makes it possible for a themelet to override a extension layout
	 * that don't ship with Morph.
	 *
	 * @return void
	 */
	public function createOverrides()
	{
		$morph = self::getInstance();
		$paths = array('morph' => JPATH_ROOT.'/templates/morph/html', 'themelet' => self::getThemeletPath().'/html');
		
		//If the themelet don't have a html folder, then there's no files to create.
		if(!is_dir($paths['themelet'])) return;
		
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		
		$files = array(
			'morph'		=> JFolder::files($paths['morph']	, '\.php$', true, true),
			'themelet'	=> JFolder::files($paths['themelet'], '\.php$', true, true)
		);
		foreach($files as $where => $folder)
		{
			$files[$where] = array();
			foreach($folder as $file)
			{
				$parts = explode(DS, $file);
				$count = count($parts);
				if($parts[$count - 3] != 'html' && $parts[$count - 4] != 'html') continue;
				$parts = array_reverse(array($parts[--$count], $parts[--$count], $parts[--$count]));
				if($parts[0] == 'html') array_shift($parts); 
				$key   = implode(DS, $parts);
				$files[$where][$key] = $file;
			}
		}
		
		//Find the dynamically generated overrides
		$generated = array_filter($files['morph'], array($morph, 'findGeneratedOverrides'));
		
		//Find the generated overrides that are no longer in use and delete them.
		$deprecated = array_diff_key($generated, $files['themelet']);
		JFile::delete($deprecated);
		
		//Find the layouts that only the themelet is overriding that don't already exist in morph
		$missing = array_diff_key($files['themelet'], $files['morph']);
		
		foreach($missing as $relative => $absolute)
		{
			JFile::write($paths['morph'].'/'.$relative, $morph->_generated_override);
		}
	}
	
	/**
	 * Finds generated override files
	 *
	 * @param  string  $file
	 * @return boolean
	 */
	protected function findGeneratedOverrides($file)
	{
		$text = self::getInstance()->_generated_override;
		if(@filesize($file) > strlen($text)) return false;
		$buffer = JFile::read($file, false, strlen($text));

		return $buffer == $text;

	}
	
	/**
	 * Get the base path for the current themelet, or optionally an specific one.
	 *
	 * @param  $themelet	string				Optionally specify the themelet
	 * @return 				string || boolean	Returns the absolute basepath for a themelet.
	 *											If the themelet path don't exist, return false.
	 */
	public function getThemeletPath($themelet = false)
	{
		static $path;
		static $themelet;

		if(!$themelet) $themelet = self::getInstance()->themelet;

		if(!$path) {
			$path = JPATH_ROOT.'/morph_assets/themelets/' . $themelet;
			$path = is_dir($path) ? $path : false;
		}

		return $path;
	}
	
	/**
	 * Get the time of day
	 *
	 * @return	string
	 */
	public function getTimeofday()
	{
		if(!isset(self::$_timeofday))
		{
			$user = JFactory::getUser();
			$date = clone JFactory::getDate();

			//Set timezone offset
			if(!$user->guest) $date->setOffset($user->getParam('timezone'));

			$time = $date->toFormat('%H'); 

			$sunrise = date_sunrise($date->toUnix(), SUNFUNCS_RET_DOUBLE); 
			$sunset = date_sunset($date->toUnix(), SUNFUNCS_RET_DOUBLE) + 1; 
			if($time >= $sunrise && $time < $sunrise + 2) $style = 'sunrise'; 
			elseif($time >= $sunrise + 2 && $time < $sunset) $style = 'day'; 
			elseif($time >= $sunset && $time < $sunset + 2) $style = 'sunset'; 
			else $style = 'night';
			
			self::$_timeofday = $style;
		}
		
		return self::$_timeofday;
	}
	
	/**
	 * Formats date acording to configuration
	 *
	 * @param	$date	datetime
	 * @return	string
	 */
	public function date($date)
	{
		$pattern = array(
			'[weekday1]'	=> '<span class="weekday">%a</span>',
			'[weekday2]'	=> '<span class="weekday">%A</span>',
			'[dayofmonth1]' => '<span class="dayofmonth">%d</span>',
			'[dayofmonth2]'	=> '<span class="dayofmonth">%E</span>',
			'[month1]'		=> '<span class="month">%b</span>',
			'[month2]'		=> '<span class="month">%B</span>',
			'[month3]'		=> '<span class="month">%m</span>',
			'[year1]'		=> '<span class="year">%g</span>',
			'[year2]'		=> '<span class="year">%G</span>'
		);
	
		return JHTML::_('date', $date, str_ireplace(array_keys($pattern), array_values($pattern), $this->dateformat));
	}
}