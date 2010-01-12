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

	function morphLoader( $template=null )
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
			$params = $db->loadObjectList();
		} else {
			$params = array();
		}

		
		if(isset($themelet_name)) $themelet_params = getTemplateParamList( JPATH_ROOT.'/morph_assets/themelets/'.$themelet_name.'/themeletDetails.xml', TRUE );
		$xml_params = getTemplateParamList( realpath(dirname(__FILE__).'/morphDetails.xml'), TRUE );

		foreach ($xml_params as $param) {
		$param = explode( '=', $param );
		$default_params[$param[0]] = $param[1];
		}
		
		foreach ($themelet_params as $param) {
		$param = explode( '=', $param );
		$default_params[$param[0]] = $param[1];
		}
		
		// Replace default settings with any settings found in the DB.
		foreach( (array) $params as $param ) {
		$default_params[$param->param_name] = $param->param_value;
		}
		// Create class members dynamically to be used by template.
		foreach( $default_params as $key => $value ) {
		$this->$key = $value;
		}
		
		//TODO: We need to make the caching smarter, so we don't have to do this here
		if(isset($this->developer_toolbar) && $this->developer_toolbar)
		{
			$this->pack_css = JRequest::getBool('packcss', $this->pack_css, 'COOKIE');
			$this->pack_js = JRequest::getBool('packjs', $this->pack_js, 'COOKIE');
			if(JRequest::getCmd('gzip') == 'on') $this->gzip_compression = 1;
			else if(JRequest::getCmd('nogzip', false, 'COOKIE') == 'off') $this->gzip_compression = 0;
		}
		
		jimport('joomla.filesystem.folder');
		$cache = JPATH_CACHE.'/morph';
		if(JRequest::getCmd('empty', false) == 'cache' && JFolder::exists($cache)) JFolder::delete($cache);
		
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
		
		function get($param_name=null) {
			if(!isset($param_name)) return null;
			return $this->$param_name;
		}
		
		}
		
$MORPH = new morphLoader( getTemplateName( dirname(__FILE__).'/morphDetails.xml' ) );
?>