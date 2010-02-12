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

class morphLoader {

	public $scripts = array();
	public $scriptsAfter = array();
	
	public $styleSheets = array();
	public $styleSheetsAfter = array();

	public function morphLoader( $template = null )
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
		
		//TODO: We need to make the caching smarter, so we don't have to do this here
		if(isset($this->developer_toolbar) && $this->developer_toolbar)
		{
			$this->pack_css = JRequest::getBool('packcss', $this->pack_css, 'COOKIE');
			$this->pack_js = JRequest::getBool('packjs', $this->pack_js, 'COOKIE');
			if(JRequest::getCmd('gzip') == 'on') $this->gzip_compression = 1;
			else if(JRequest::getCmd('nogzip', false, 'COOKIE') == 'off') $this->gzip_compression = 0;
		}
	}
	
	public function cache()
	{
		jimport('joomla.filesystem.folder');
		$cache = JPATH_CACHE.'/morph';
		if(JRequest::getCmd('empty', false) == 'cache' && JFolder::exists($cache)) JFolder::delete($cache);
		
		//Where passing the menu item id, so that the cache works with menu item.
		$_SESSION['menuid'] = JRequest::getInt('Itemid');
		
		jimport('joomla.filesystem.file');
	
		$path = JPATH_CACHE.'/morph/data.json';
		if(file_exists($path))
		{
			$created	= time()-date('U', filemtime($path));
			$expire		= $this->cache * 60;
			if($created > $expire)
			{
				$json = json_encode($this);
				JFile::write($path, $json);
			}
		} else {
			$json = json_encode($this);
			JFile::write($path, $json);
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
		$cache	= $this->cache ? '&cache='.$this->cachetime : false;
		$gzip	= $this->gzip_compression ? '&gzip='.$this->gzip_compression : false;
		$renderjs = JRoute::_('&render=js'.$cache.$gzip);
		$rendercss = JRoute::_('&render=css'.$cache.$gzip);

		$document = JFactory::getDocument();
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
		}
		
		$this->cache();
	}
}

$MORPH = new morphLoader( getTemplateName( dirname(__FILE__).'/morphDetails.xml' ) );