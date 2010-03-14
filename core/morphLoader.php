<?php
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

defined('_JEXEC') or die('Restricted access');
$morph_component_path = JPATH_ADMINISTRATOR.'/components/com_configurator';
include_once ($morph_component_path . "/configurator.common.php");
include_once ($morph_component_path . "/configurator.class.php");

class Morph {

	public $scripts = array();
	public $scriptsAfter = array();
	
	public $styleSheets = array();
	public $styleSheetsAfter = array();

	public function __construct( $template = 'morph' )
	{
		$db = JFactory::getDBO();

		if( $template == null ) return;
		
		
		// themelet settings
		$db->setQuery("select param_value from #__configurator where param_name = 'themelet'");
		$themelet_name = $db->loadResult();
		$themelet_params = array();
		
		
		$db->setQuery( "SHOW TABLES LIKE '%configurator'" );
		$morph_installed = $db->loadResult();

		if ( isset( $morph_installed ) ) {
			$query = "SELECT * FROM #__configurator WHERE `template_name` = '{$template}'";
			$db->setQuery( $query );
			$params = (array) $db->loadObjectList();
		} else {
			$params = array();
		}

		$xml_params = getTemplateParamList( realpath(dirname(__FILE__).'/morphDetails.xml'), TRUE );
		if(isset($themelet_name)) $themelet_params = getTemplateParamList( JPATH_ROOT.'/morph_assets/themelets/'.$themelet_name.'/themeletDetails.xml', TRUE );

		foreach(array_merge($xml_params, $themelet_params) as $key => $value)
		{
			$this->$key = $value;
		}
		
		// Replace default settings with any settings found in the DB.
		foreach( $params as $param ) {
			$this->{$param->param_name} = $param->param_value;
		}

		if($this->developer_toolbar || $this->debug)
		{
			$app = JFactory::getApplication();
			$overrides = JRequest::getVar('morph', array(), 'get', 'array');
			
			$overrides = array_merge((array)$app->getUserState('morph'), $overrides);
			foreach($overrides as $name => $override)
			{
				if($name == 'debug') continue;
				$this->$name = $override;
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
		
		if (empty($instances[$template])) $instances[$template] =& new Morph($template);
		
		return $instances[$template];
	}
	
	public function cache()
	{
		jimport('joomla.filesystem.folder');
		$cache = JPATH_CACHE.'/morph';
		if(JRequest::getCmd('empty', false) == 'cache' && JFolder::exists($cache)) JFolder::delete($cache);
		
		//Where passing the menu item id, so that the cache works with menu item.
		$_SESSION['menuid'] = JRequest::getInt('Itemid');

		if($this->developer_toolbar || $this->debug)
		{
			$app = JFactory::getApplication();
			$params = JRequest::getVar('morph', array(), 'get', 'array');
			$params = array_merge((array)$app->getUserState('morph'), $params);
			$backup = array();
			foreach(array('scripts', 'styleSheets', 'styleSheetsAfter') as $b) $backup[$b] = $this->$b;
			$params = array_merge((array)$this, $params);
			
			
			foreach($params as $name => $param)
			{
				if($name == 'debug') continue;
				//if($name == 'scripts' && !$this->pack_js) continue;
				//if(in_array($name, array('styleSheets', 'styleSheetsAfter')) && !$this->pack_css) continue;
				$this->$name = $param;
			}
			
			if(!$this->jquery_core) unset($this->scripts['/templates/morph/core/js/jquery.js']);
			if(!$this->developer_toolbar) unset($this->styleSheetsAfter['/templates/morph/core/css/devbar.css']);
			if($this->developer_toolbar) $this->addStyleSheetAfter('/templates/morph/core/css/devbar.css');
			
			foreach($backup as $name => $b) $this->$name = $b;
			
			$app->setUserState('morph', (array)$this);
		}
		
		jimport('joomla.filesystem.file');

		$path = JPATH_CACHE.'/morph/data.json';
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
				$uri = JFactory::getURI();
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
		
		$uri->setVar('render', 'js');
		$renderjs = JFilterOutput::ampReplace($uri->toString());
		$uri->setVar('render', 'css');
		$rendercss = JFilterOutput::ampReplace($uri->toString());

		$document = JFactory::getDocument();
		if(!$this->nojs)
		{
		
			if(!$this->jquery_core) unset($this->scripts['/templates/'.$document->template .'/core/js/jquery.js']);
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
}