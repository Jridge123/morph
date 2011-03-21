<?php

class MorphLoaderAdapterMorph extends KLoaderAdapterAbstract
{
	/**
	 * The basepath 
	 * 
	 * @var string
	 */
	protected $_basepath = JPATH_SITE;
	
	/**
	 * The prefix
	 * 
	 * @var string
	 */
	protected $_prefix = 'Morph';
	
	
	/**
	 * Get the class prefix
	 *
	 * @return string	Returns the class prefix
	 */
	public function getPrefix()
	{
		return $this->_prefix;
	}

	/**
	 * Sets the basepath during construct
	 *
	 * @author your name
	 * @param $param
	 * @return return type
	 */
	public function __construct()
	{
		$this->_basepath .= '/templates/morph/core';
	}
	
	/**
	 * Get the path based on a class name
	 *
	 * @param  string		  	The class name 
	 * @return string|false		Returns the path on success FALSE on failure
	 */
	protected function _pathFromClassname($classname)
	{
		$path     = false;
		
		$word  = preg_replace('/(?<=\\w)([A-Z])/', '_\\1',  $classname);
		$parts = explode('_', $word);
		
		// If class start with a 'Morph' it is a Morph framework class and we handle it
		if(array_shift($parts) == $this->_prefix)
		{	
			$basepath = $this->_basepath;
			$path     = strtolower(implode('/', $parts));
				
			if(count($parts) == 1) {
				$path = $path.'/'.$path;
			}
			
			if(!is_file($basepath.'/'.$path.'.php')) {
				$path = $path.'/'.strtolower(array_pop($parts));
			}

			$path = $basepath.'/'.$path.'.php';
		}
		
		return $path;
	}	
	
	/**
	 * Get the path based on an identifier
	 *
	 * @param  object  			An Identifier object - lib.joomla.[.path].name
	 * @return string|false		Returns the path on success FALSE on failure
	 */
	protected function _pathFromIdentifier($identifier)
	{
		$path = false;
		
		if($identifier->type == 'lib' && $identifier->package == 'morph')
		{
			$basepath = $this->_basepath;
			
			if(count($identifier->path)) {
				$path .= implode('/',$identifier->path);
			}

			if(!empty($this->name)) {
				$path .= '/'.$identifier->name;
			}
				
			$path = $basepath.'/'.$path.'.php';
		}
		
		return $path;
	}
}