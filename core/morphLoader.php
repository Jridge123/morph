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
$morph_component_path = dirname(__FILE__) . DS . '../../../administrator/components/com_configurator';
include_once ($morph_component_path . DS . "configurator.common.php");
include_once ($morph_component_path . DS . "configurator.class.php");

class morphLoader {

	function morphLoader( $template=null ) {
		$db = JFactory::getDBO();

		if( $template == null ) return;
		
		// themelet settings
		$db->setQuery("select param_value from #__configurator where param_name = 'themelet'");
		$themelet_name = $db->loadResult();

		if(isset($themelet_name)){
		
		}else{
			$themelet_params = array();
		}
		
		$db->setQuery( "SHOW TABLES LIKE '%configurator'" );
		$morph_installed = $db->loadResult();

		if ( isset( $morph_installed ) ) {
			$query = "SELECT * FROM #__configurator WHERE `template_name` = '{$template}'";
			$db->setQuery( $query );
			$params = $db->loadObjectList();
		} else {
			$params = array();
		}

// Get the parameters and their default values from the XML file.
$xml_params = getTemplateParamList( dirname(__FILE__).DS.'morphDetails.xml', TRUE );
// Convert to a associative array.
foreach ($xml_params as $param) {
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
}

function get($param_name=null) {
if(!isset($param_name)) return null;
return $this->$param_name;
}

}

$MORPH = new morphLoader( getTemplateName( dirname(__FILE__).DS.'morphDetails.xml' ) );
?>