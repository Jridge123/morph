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
      $database = JFactory::getDBO();
      
      if( !isset( $template ) ) return;
      // Check if the Morph DB table exists (Morph installed).
      $database->setQuery( "SHOW TABLES LIKE '%morph'" );
      $morph_installed = $database->loadResult();
      if ( isset( $morph_installed ) ) {
          // Load any saved settings.
          $query = "SELECT * FROM #__morph WHERE `template_name` = '{$template}'";
          $database->setQuery( $query );
          $params = $database->loadObjectList();
      } else {
          // Morph not installed or DB missing.
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