<?php
/**
* @package   Configurator Component
* @author    Prothemer http://www.prothemer.com
* @copyright Copyright (C) 2008 - 2010 Web Monkeys Design Studio CC.
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @desc      Originally based on Tatami from Ninja Forge. http://www.ninjaforge.com
*/

defined('_JEXEC') or die('Restricted access');

class TableConfiguratorTemplateSettings extends JTable
{  
    public $id;
    public $template_name = 'morph';
    public $param_name;
    public $param_value;
    public $source;
    public $published;
    
    /**
     * Array over column map
     *
     * @var array
     */
    protected $__column_map = array(
    	'param'		=> 'param_name',
    	'value' 	=> 'param_value',
    	'template'	=> 'template_name'
    );
    
    /**
     * The menu item id, if one
     *
     * @var int|boolean
     */
    protected $__itemid;
    
    public function __construct($db)
    {
    	$app		  = JFactory::getApplication();
		if($app->isAdmin())
		{
			$itemid		  = $app->getUserState('configurator');
			$this->__itemid = $itemid > 0 ? $itemid : false;
		}
		else
		{
			$this->__itemid = JRequest::getInt('Itemid');
		}
		
    	return parent::__construct('#__configurator', 'id', $db);
    }
    
    public function loadByKey()
    {
        if( !isset($this->template_name) || !isset($this->param_name) ) return null;
        $template = $this->__itemid ? $this->__itemid . '.' . $this->template_name : $this->template_name;
        $template = strtolower($template);
        $this->_db->setQuery("SELECT id FROM #__configurator WHERE `template_name` = '{$template}' AND `param_name` = '{$this->param_name}' LIMIT 1");
        $this->load( $this->_db->loadResult() );
    }
    
    public function getItem()
    {
		if(!isset($this->param_name) ) return (object) array();
		$template = $this->__itemid ? $this->__itemid . '.' . $this->template_name : $this->template_name;
		$template = strtolower($template);
		$this->_db->setQuery("SELECT * FROM #__configurator WHERE `template_name` = '{$template}' AND `param_name` = '{$this->param_name}'");
		$this->setProperties($this->_db->loadAssoc());

    	return $this;
    }
    
    public function getMenuItems()
    {
		//$template = $this->__itemid ? $this->__itemid . '.' . $this->template_name : $this->template_name;
		$this->_db->setQuery("SELECT DISTINCT CAST(`template_name` AS SIGNED) AS itemid FROM #__configurator WHERE `template_name` LIKE '%.%'");
		$items = $this->_db->loadResultArray();

    	return $items;
    }
    
    public function resetMenuItems()
    {
		//$template = $this->__itemid ? $this->__itemid . '.' . $this->template_name : $this->template_name;
		$this->_db->setQuery("SELECT DISTINCT CAST(`template_name` AS SIGNED) AS itemid FROM #__configurator WHERE `template_name` LIKE '%.%'");
		$count = count($this->_db->loadResultArray());

		$this->_db->execute("DELETE FROM #__configurator WHERE `template_name` LIKE '%.%'");

    	return $count;
    }
    
    public function getParams()
    {
		if(!isset($this->template_name) ) return array();
		$template = $this->__itemid ? $this->__itemid . '.' . $this->template_name : $this->template_name;
		$template = strtolower($template);
		$query="SELECT * FROM #__configurator AS t WHERE t.template_name='{$template}'";
		$this->_db->setQuery( $query );
		
		if($this->__itemid)
		{
			$override = $this->_db->loadAssocList('param_name');
			$query="SELECT * FROM #__configurator AS t WHERE t.template_name='morph'";
			$this->_db->setQuery( $query );
			return array_merge($this->_db->loadAssocList('param_name'), $override);
		}
		
		return $this->_db->loadAssocList('param_name');
    }
    
    public function getActiveMenuitemParams()
    {
    	if(!$this->__itemid) return array();
    	$template = $this->__itemid . '.' . $this->template_name;
    	$template = strtolower($template);
    	$query="SELECT param_name FROM #__configurator AS t WHERE t.template_name='{$template}'";
    	$this->_db->setQuery( $query );
    	return (array) $this->_db->loadResultArray();
    }
    
    public function getConfigs()
    {
    	if(!isset($this->template_name) ) return array();
    	$template = $this->__itemid ? $this->__itemid . '.' . $this->template_name : $this->template_name;
    	$template = strtolower($template);
    	$query="SELECT * FROM #__configurator AS t WHERE t.template_name='{$template}'";
    	$this->_db->setQuery( $query );
    	$override = (array) $this->_db->loadObjectList('param_name');
    	$query="SELECT * FROM #__configurator AS t WHERE t.template_name='morph'";
    	$this->_db->setQuery( $query );
    	//$fallback = $this->_db->loadObjectList('param_name');
    	//return $override ? $override : $this->_db->loadObjectList('param_name');
    	return array_merge($this->_db->loadObjectList('param_name'), $override);
    }
    
    public function store()
    {
    	$template = end(explode('.', $this->template_name));
    	$this->template = $this->__itemid ? $this->__itemid . '.' . $template : $template;
    	
    	// Avoid duplicates
    	$this->_db->setQuery("SELECT COUNT(*) FROM #__configurator WHERE `template_name` = '{$this->template}' AND `param_name` = '{$this->param_name}'");
    	$count = (int)$this->_db->loadResult();
    	if($count > 1)
    	{
    		$this->_db->execute("DELETE FROM #__configurator WHERE `template_name` = '{$this->template}' AND `param_name` = '{$this->param_name}' AND `id` != '{$this->id}'");
    	}
    	
    	if($this->__itemid)
    	{
    		$active_items = JRequest::getVar( 'menuitem_active', null, 'post', 'array' );
			if(!array_key_exists($this->param_name, $active_items)) return parent::delete();
		}

    	return parent::store();
    }
    
    public function __call($key, $args)
    {
    	$this->$key = $args[0];
    	
    	return $this;
    }
    
    public function __get($key)
    {
    	return $this->{$this->__column_map[$key]};
    }
    
    public function __set($key, $val)
    {
		$this->{$this->__column_map[$key]} = $val;

		return $this;
    }
        
}


/**
* @package   Configurator Component
* @author    Prothemer http://www.prothemer.com
* @copyright Copyright (C) 2008 - 2010 Web Monkeys Design Studio CC.
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @desc      Originally based on Tatami from Ninja Forge. http://www.ninjaforge.com
*/

abstract class abstractXMLParams {
    
    /**
     * Path to xml file
     *
     * @var string
     */
    protected $_path = null;
    
    /**
     * The complete xml document
     *
     * @var SimpleXMLElement
     */
    protected $_xml;
    
    /**
     * An key/value array over the configuration values
     *
     * @var Array
     */
    protected $_data = array();
    
    /**
     * Initialise morphXMLParams, and if a path is passed with it, prepare the data list
     *
     * @param $path
     */
	public function __construct($path = false)
	{
		$this->_path = $path;
		
		if($this->_path && file_exists($this->_path))
		{
			$this->loadFile();
		}
	}
	
	/**
	 * Load the xml file, and create the list
	 *
	 * @param $path
	 * @return Array
	 */
	public function loadFile()
	{
        $path = $this->_path;
        $this->_xml  = file_exists($path) ? simplexml_load_file($path) : new SimpleXMLElement;
        
        // If the xml don't have the <params> tag, escape
        if(!$this->_xml->params) return;
        
        foreach($this->_xml->params as $params)
        {
	        foreach($params->children() as $param)
	        {
	        	if(isset($param['name'])) $this->_data[(string)$param['name']] = (string)$param['default'];
	        }
        }
        
        return $this->getData();
    }
    
    /**
     * Sets the data
     *
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
    	$this->_data = (array)$data;
    	return $this;
    }
    
    /**
     * Gets the data
     *
     * @return array
     */
    public function getData()
    {
    	return $this->_data;
    }
    
    /**
     * Set the SimpleXMLElement
     *
     * @param $xml
     * @return $this
     */
    public function setXml(SimpleXMLElement $xml)
    {
    	$this->_xml = $xml;
    	return $this;
    }
    
    /**
     * Gets the SimpleXMLElement object
     *
     * @return SimpleXMLElement
     */
    public function getXml()
    {
    	return $this->_xml;
    }
    
    /**
     * Sets the path
     *
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
    	if($path && file_exists($path)) $this->_path = $path;
    	return $this;
    }
    
    /**
     * Gets the path to the xml, returns false if the file does not exist
     *
     * @return string|false
     */
    public function getPath()
    {
    	if($this->_path && file_exists($this->_path)) return $this->_path;
    	return false;
    }   
}

/**
* Configurator parameters handler
* @package Configurator
*/

jimport( 'joomla.html.parameter' );

class configuratorParameters extends JParameter {
    /** @var object */
    var $_params     = null;
    /** @var string The raw params string */
    var $_raw         = null;
    /** @var string Path to the xml setup file */
    var $_path         = null;
    /** @var string The type of setup file */
    var $_type         = null;
    /** @var object The xml params element */
    var $_xmlElem     = null;
    /** @var object Custom node to be injected */
    var $_custom_nodes = null;
    
    var $_current_param = null;
    
    var $_param_op_count = null;
    
    var $_param_options = null;
    
    var $_html = null;
/**
* Constructor
* @param string The raw parms text
* @param string Path to the xml setup file
* @var string The type of setup file
*/
    function configuratorParameters( $text, $path='', $type='template' ) {
        $this->_params     = $this->parse( $text );
        $this->_raw     = $text;
        $this->_path     = $path;
        $this->_type     = $type;
        $this->_param_op_count = 0;
        $this->_param_options = array();
    }

    /**
     * Returns the params array
     * @return object
     */
    function toObject() {
        return $this->_params;
    }

    /**
     * Returns a named array of the parameters
     * @return object
     */
    function toArray() {
        return mosObjectToArray( $this->_params );
    }

/**
* @param string The name of the param
* @param string The value of the parameter
* @return string The set value
*/
    function set( $key, $value='' ) {
        $this->_params->$key = $value;
        return $value;
    }
/**
* Sets a default value if not alreay assigned
* @param string The name of the param
* @param string The value of the parameter
* @return string The set value
*/
    function def( $key, $value='' ) {
        return $this->set( $key, $this->get( $key, $value ) );
    }
/**
* @param string The name of the param
* @param mixed The default value if not found
* @return string
*/
    function get( $key, $default='' ) {
        if (isset( $this->_params->$key )) {
            return $this->_params->$key === '' ? $default : $this->_params->$key;
        } else {
            return $default;
        }
    }
/**
* Parse an .ini string, based on phpDocumentor phpDocumentor_parse_ini_file function
* @param mixed The ini string or array of lines
* @param boolean add an associative index for each section [in brackets]
* @return object
*/
    function parse( $txt, $process_sections = false, $asArray = false ) {
        if (is_string( $txt )) {
            $lines = explode( "\n", $txt );
        } else if (is_array( $txt )) {
            $lines = $txt;
        } else {
            $lines = array();
        }
        $obj = $asArray ? array() : new stdClass();

        $sec_name = '';
        $unparsed = 0;
        if (!$lines) {
            return $obj;
        }
        foreach ($lines as $line) {
            // ignore comments
            if ($line && $line[0] == ';') {
                continue;
            }
            $line = trim( $line );

            if ($line == '') {
                continue;
            }
            if ($line && $line[0] == '[' && $line[strlen($line) - 1] == ']') {
                $sec_name = substr( $line, 1, strlen($line) - 2 );
                if ($process_sections) {
                    if ($asArray) {
                        $obj[$sec_name] = array();
                    } else {
                        $obj->$sec_name = new stdClass();
                    }
                }
            } else {
                if ($pos = strpos( $line, '=' )) {
                    $property = trim( substr( $line, 0, $pos ) );

                    if (substr($property, 0, 1) == '"' && substr($property, -1) == '"') {
                        $property = stripcslashes(substr($property,1,count($property) - 2));
                    }
                    $value = trim( substr( $line, $pos + 1 ) );
                    if ($value == 'false') {
                        $value = false;
                    }
                    if ($value == 'true') {
                        $value = true;
                    }
                    if (substr( $value, 0, 1 ) == '"' && substr( $value, -1 ) == '"') {
                        $value = stripcslashes( substr( $value, 1, count( $value ) - 2 ) );
                    }

                    if ($process_sections) {
                        $value = str_replace( '\n', "\n", $value );
                        if ($sec_name != '') {
                            if ($asArray) {
                                $obj[$sec_name][$property] = $value;
                            } else {
                                $obj->$sec_name->$property = $value;
                            }
                        } else {
                            if ($asArray) {
                                $obj[$property] = $value;
                            } else {
                                $obj->$property = $value;
                            }
                        }
                    } else {
                        $value = str_replace( '\n', "\n", $value );
                        if ($asArray) {
                            $obj[$property] = $value;
                        } else {
                            $obj->$property = $value;
                        }
                    }
                } else {
                    if ($line && trim($line[0]) == ';') {
                        continue;
                    }
                    if ($process_sections) {
                        $property = '__invalid' . $unparsed++ . '__';
                        if ($process_sections) {
                            if ($sec_name != '') {
                                if ($asArray) {
                                    $obj[$sec_name][$property] = trim($line);
                                } else {
                                    $obj->$sec_name->$property = trim($line);
                                }
                            } else {
                                if ($asArray) {
                                    $obj[$property] = trim($line);
                                } else {
                                    $obj->$property = trim($line);
                                }
                            }
                        } else {
                            if ($asArray) {
                                $obj[$property] = trim($line);
                            } else {
                                $obj->$property = trim($line);
                            }
                        }
                    }
                }
            }
        }
        return $obj;
    }
    
    function insertEntities( $new_params_xml=null, $section='params' ) {
        if(!isset($new_params_xml)) return;
        $this->_custom_nodes = $new_params_xml;
    }
    
    // New parse functions.
    function startElementHandler($parser, $name, $attribs) {
        if($this->_in_params && $this->_section == 'param' && $name == 'option') {
            $this->_section = 'option';
            $this->_current_option->value = $attribs['value'];
        }
        if($this->_in_params && $name == 'param') {
            $this->_section = 'param';
            $this->_current_param->name = $attribs['name'];
            $this->_current_param->label = $attribs['label'];
            $this->_current_param->size = $attribs['size'];
            $this->_current_param->type = $attribs['type'];
            $this->_current_param->description = $attribs['description'];
            $this->_current_param->default = $attribs['default'];
        }
        if($name == 'params') $this->_in_params = true;
    }
    
    function endElementHandler($parser, $name) {
        if(!$this->_useTabs && $this->_current_param->type == 'tab' ) return;
        if($this->_in_params && $this->_section == 'option' && $name == 'option') {
            $this->_param_options[] = $this->_current_option;
            $this->_current_option = null;
            $this->_section = 'param';
        }
        if($this->_in_params && $this->_section == 'param' && $name == 'param') {
            $param = & $this->_current_param;
            $param->childNodes = & $this->_param_options;
            $this->_param_count++;
            $result = $this->renderParam( $param, 'params' );
            if( $param->type == 'tab' ) {
                $this->_html[] = $result[1];
            } else {
                $this->_html[] = '<tr>';

                $this->_html[] = '<td align="right" valign="top" class="param-label">' . $result[0] . '<span class="editlinktip">tip</span></td>';
                $this->_html[] = '<td class="param-input">' . $result[1] . '</td>';

                $this->_html[] = '</tr>';
            }
            $this->_section = null;
            $this->_current_param = null;
            $this->_param_options = array();
        }
        if( $name == "params" ) {
            $this->section = null;
            $this->_in_params = false;
        }
    }
                                            
    function characterDataHandler($parser, $cdata) {
        if($this->_in_params && $this->_section == 'option'){
            $this->_current_option->text = $cdata;
        }
    }
    
/**
* @param object A param tag node
* @param string The control name
* @return array Any array of the label, the form element and the tooltip
*/
    function renderParam( &$param, $control_name='params' ) {
        $result = array();

        //$name = $param->getAttribute( 'name' );
        $name = $param->name;
        
        //$label = $param->getAttribute( 'label' );
        $label = $param->label;

        //$value = $this->get( $name, $param->getAttribute( 'default' ) );
        $value = $this->get( $name, $param->default);
        //$description = $param->getAttribute( 'description' );
        $description = $param->description;

        $result[0] = $label ? $label : $name;

      
        $name = ($name == '@tab') ? $label : $name;
        //$type = $param->getAttribute( 'type' );
        $type = $param->type;

        if (in_array( '_form_' . $type, $this->_methods )) {
            $result[1] = call_user_func( array( &$this, '_form_' . $type ), $name, $value, $param, $control_name );
        } else {
            $result[1] = _HANDLER . ' = ' . $type;
        }

        if ( $description ) {
            $result[2] = JHTML::_( 'tooltip', $description, $result[0] );
            $result[2] = '';
        } else {
            $result[2] = '';
        }

        return $result;
    }
    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_text( $name, $value, &$node, $control_name ) {
        //$size = $node->getAttribute( 'size' );
        $size = $node->size;

        return '<input type="text" name="'. $control_name .'['. $name .']" value="'. htmlspecialchars($value) .'" id="'.$name.'" class="text_area" size="'. $size .'" onchange="makeCustom(this.form)" />';
    }
    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_list( $name, $value, &$node, $control_name ) {
        //$size = $node->getAttribute( 'size' );
        $size = $node->size;

        $options = array();
        foreach ($node->childNodes as $option) {
            //$val = $option->getAttribute( 'value' );
            $val = $option->value;
            //$text = $option->gettext();
            $text = $option->text;
            $options[] = JHTML::_('select.option', $val, $text);
        }

        return JHTML::_('select.genericlist', $options, ''. $control_name .'['. $name .']', 'id="'.$name.'" class="inputbox" onchange="makeCustom(this.form)"', 'value', 'text', $value );
    }
    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_radio( $name, $value, &$node, $control_name ) {
        $options = array();
        foreach ($node->childNodes as $option) {
            //$val     = $option->getAttribute( 'value' );
            $val     = $option->value;
            //$text     = $option->gettext();
            $text     = $option->text;
            $options[] = JHTML::_('select.option', $val, $text );
        }

        return JHTML::_('select.radiolist', $options, ''. $control_name .'['. $name .']', 'id="'.$name.'" onclick="makeCustom(this.form)"', 'value','text', $value );
    }
    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_filelist( $name, $value, &$node, $control_name ) {

        // path to images directory
        $path     = JPATH_ROOT . $node->getAttribute( 'directory' );
        $filter = $node->getAttribute( 'filter' );
        jimport('joomla.filesystem.folder');
        $files     = JFolder::files( $path, $filter );

        $options = array();
        foreach ($files as $file) {
            $options[] = JHTML::_('select.option', $file, $file );
        }
        if ( !$node->getAttribute( 'hide_none' ) ) {
            array_unshift( $options, JHTML::_('select.option', '-1', '- '. 'Do Not Use' .' -' ) );
        }
        if ( !$node->getAttribute( 'hide_default' ) ) {
            array_unshift( $options, JHTML::_('select.option', '', '- '. 'Use Default' .' -' ) );
        }

        return JHTML::_('select.genericlist', $options, ''. $control_name .'['. $name .']', 'id="'.$name.'" onchange="makeCustom(this.form)" class="inputbox"', 'value', 'text', $value, "param$name" );
    }
    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_imagelist( $name, $value, &$node, $control_name ) {
        $node->setAttribute( 'filter', '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$' );
        return $this->_form_filelist( $name, $value, $node, $control_name );
    }
    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_textarea( $name, $value, &$node, $control_name ) {
         $rows     = $node->rows;
         $cols     = $node->cols;
         // convert <br /> tags so they are not visible when editing
         $value     = str_replace( '<br />', "\n", $value );

         return '<textarea name="' .$control_name.'['. $name .']" cols="'. $cols .'" rows="'. $rows .'" onchange="makeCustom(this.form)" id="'.$name.'" class="text_area">'. htmlspecialchars($value) .'</textarea>';
    }

    /**
    * @param string The name of the form element
    * @param string The value of the element
    * @param object The xml element for the parameter
    * @param string The control name
    * @return string The html for the element
    */
    function _form_spacer( $name, $value, &$node, $control_name ) {
        if ( $value ) {
            return $value;
        } else {
            return '<hr class="'.$name.'" />';
        }
    }
    
    function _form_tab( $name, $value, &$node, $control_name ) {
        $return = '';
        if($this->_tabOpen) {
            $return .= '</table>';
            //ob_start();
            $return .= $this->_tabs->endPanel();
            //$return .= ob_get_clean();
            $this->_tabOpen = false;
        }
        //ob_start();
        $return .= $this->_tabs->startPanel($name, strtolower(str_replace(' ','_',$name)));
        //$return .= ob_get_clean();
        $return .= '<table>';
        $this->_tabOpen = true;
        return $return;
    }
    
    function _form_colorpicker($name, $value, &$node, $control_name ) {
        $this->_cp_count = (!isset($this->_cp_count))? 1:$this->_cp_count+1;
        $return = '<script language="JavaScript" type="text/javascript">var cp'.$this->_cp_count.' = new ColorPicker(\'window\');</script>';
        $return .= '<input type="text" name="'. $control_name .'['. $name .']" value="'. htmlspecialchars($value) .'" id="'.$name.'" class="text_area" size="'. $size .'" onchange="makeCustom(this.form)" />';
        $return .= '<a href="#" onclick="cp'.$this->_cp_count.'.select(document.getElementById(\''. $name .'\'),\'pick'.$this->_cp_count.'\');return false;" name="pick'.$this->_cp_count.'" id="pick'.$this->_cp_count.'" class="colorpicker" >[Choose]</a>';
        return $return;
    }

    /**
    * special handling for textarea param
    */
    function textareaHandling( &$txt ) {
        $total = count( $txt );
        for( $i=0; $i < $total; $i++ ) {
            if ( strstr( $txt[$i], "\n" ) ) {
                $txt[$i] = str_replace( "\n", '<br />', $txt[$i] );
            }
        }
        $txt = implode( "\n", $txt );

        return $txt;
    }
}

class morphXMLLoader {
    var $_xml_file = null;
    
    var $_data = null;
    
    var $_section = null;
    
    var $is_morph = null;
    
    var $name = null;
    
    var $description = null;
    
    var $creationdate = null;
    
    var $use_favicons = null;
    
    var $use_tabs = null;
    
    var $tab_type = null;
    
    var $is_counter = null;
    
    function morphXMLLoader( $xml_file=null ) {
        $this->_xml_file = $xml_file;
        $this->_data = array();
        $this->is_morph = false;
        $this->use_favicons = false;
        $this->use_tabs = false;
        $this->tab_type = 'Tabs';
        $this->is_counter = false;
    }
    
    function startElementHandler($parser, $name, $attribs) {
        if($this->is_counter && isset($this->_section)) {
            if($name == $this->_section) $this->total++;
            return;
        }
        if( $name == 'morph' && $attribs['type'] == 'template' ) $this->is_morph = true;
        if( $name == 'name' ) $this->_section = 'name';
        if( strtolower($name) == 'creationdate' ) $this->_section = 'creationdate';
        if( $name == 'favicons' ) $this->_section = 'favicons';
        If( $name == 'tabs' ) {
            $this->_section = 'tabs';
            $this->tab_type = isset($attribs['type'])?$attribs['type']:'Tabs';
        }
        if($name == 'params') {
            $this->_section = 'params';
            return;
        }
        
        if($name == 'param' && $this->_section == 'params') {
            $this->_data[$attribs['name']] = isset($attribs['default'])?$attribs['default']:'';
        }
        
        if($name == 'description') $this->_section = 'description';
    }
    
    function endElementHandler($parser, $name) {
        if( $this->_section == strtolower($name) && !$this->is_counter ) $this->_section = null;
    }
    
    function characterDataHandler($parser, $cdata) {
        if( $this->is_counter ) return;
        if( $this->_section == 'name' ) $this->name = $cdata;
        if( $this->_section == 'creationdate' ) $this->creationdate = $cdata;
        if( $this->_section == 'favicons' && strtolower($cdata) == 'yes' ) $this->use_favicons = true;
        if( $this->_section == 'tabs' && strtolower($cdata) == 'yes' ) $this->use_tabs = true;
        if( $this->_section == 'description' ) $this->description = trim($cdata);
    }
    
    function getParamDefaults()
    {
        if(!isset($this->_xml_file)) return null;
        $xml_parser = xml_parser_create();
        xml_set_object( $xml_parser, $this );
        xml_parser_set_option($xml_parser,XML_OPTION_CASE_FOLDING,0);
        xml_set_element_handler($xml_parser, 'startElementHandler','endElementHandler');
        xml_set_character_data_handler($xml_parser, 'characterDataHandler');
        jimport('joomla.filesystem.file');
        $data = JFile::read($this->_xml_file);
        if(!xml_parse($xml_parser, $data)) die("xml error: " . xml_error_string(xml_get_error_code($xml_parser)));
        xml_parser_free($xml_parser);
        return $this->_data;
    }
}

class morphXMLParams extends abstractXMLParams {}

class morphXMLPresets extends abstractXMLParams {
    
    /**
     * Get the presets, if it's the right preset
     *
     * @param $name
     * @return return type
     */
    public function getData($name)
    {
    	if($this->_xml->params->name == $name) return parent::getData();
    	return array();
    }
}


/**
* @package   Configurator Component
* @author    Prothemer http://www.prothemer.com
* @copyright Copyright (C) 2008 - 2010 Web Monkeys Design Studio CC.
* @license   http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @desc      Originally based on Tatami from Ninja Forge. http://www.ninjaforge.com
*/

/**
 * ComConfiguratorHelperUtilities
 *
 * Helper class full of utility functions
 * 
 * @author Stian Didriksen <stian@prothemer.com>
 */
class ComConfiguratorHelperUtilities extends JObject
{
	/**
	 * Cleans up deprecated files
	 *
	 * @return void
	 */
	public static function installCleanup()
	{
		$path	= ComConfiguratorDefines::getManifestPath();

		if(!JFile::exists($path)) return;
		
		$xml	= simplexml_load_file($path);

		if(!isset($xml->deprecated)) return;

		foreach($xml->deprecated->children() as $type => $asset)
		{
			$class  = 'J' . $type;
			$exists = array($class, 'exists');
			$delete = array($class, 'delete');
			$asset  = array(JPATH_ADMINISTRATOR.'/components/com_configurator/'.(string)$asset);
			$result = call_user_func_array($exists, $asset);
			if(call_user_func_array($exists, $asset)) call_user_func_array($delete, $asset);
		}
	}
	
	/**
	 * Turns filesizes into human readable text
	 *
	 * @param int $bytes
	 * @param int $precision	rounding precision
	 * @return string
	 */
	public static function formatBytes($bytes, $precision = 2)
	{
		$units = array('b', 'kb', 'mb', 'gb', 'tb');

		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);

		$bytes /= pow(1024, $pow);

		return round($bytes, $precision) . $units[$pow];
	}
	
	/**
	 * Gets a list over template parameters
	 *
	 * @author Stian Didriksen <stian@prothemer.com>
	 * @param $file	  path to morph or themelet xml file
	 * @return array  xml data
	 */
	public static function getTemplateParamList( $file = false )
	{
		if( !$file ) return array();
		$xml = new morphXMLParams( $file );
		return $xml->getData();
	}
	
	/**
	 * Resets installer state
	 *
	 * @author Stian Didriksen <stian@prothemer.com>
	 */
	public static function resetInstallState()
	{
		$app = JFactory::getApplication();
		
		$app->setUserState('configurator.install', false);
	}
	
	/**
	 * Sets installer state
	 *
	 * @author Stian Didriksen <stian@prothemer.com>
	 * @param  $key		the key
	 * @param  $val		the state value
	 */
	public static function setInstallState($key, $val)
	{
		$app = JFactory::getApplication();
		
		$state = $app->getUserState('configurator.install');
		$state[$key] = $val;
		$app->setUserState('configurator.install', $state);
	}
	
	/**
	 * Gets installer state
	 *
	 * @author Stian Didriksen <stian@prothemer.com>
	 * @param  $key		the key
	 */
	public static function getInstallState($key)
	{
		$app = JFactory::getApplication();
		
		$state = $app->getUserState('configurator.install');
		return isset($state[$key]) ? $state[$key] : false;
	}
}