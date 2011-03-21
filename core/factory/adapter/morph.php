<?php

class MorphFactoryAdapterMorph extends KFactoryAdapterAbstract
{
	/**
	 * Create an instance of a class based on a class identifier
	 *
	 * @param 	mixed  		 Identifier or Identifier object - lib.morph.[.path].name
	 * @param 	object 		 An optional KConfig object with configuration options
	 * @return object|false  Return object on success, returns FALSE on failure
	 */
	public function instantiate($identifier, KConfig $config)
	{
		$classname = false;

		if($identifier->type == 'lib' && $identifier->package == 'morph')
		{
			$classname = 'Morph'.KInflector::implode($identifier->path).ucfirst($identifier->name);
			$filepath  = KLoader::path($identifier);
			
			if (!class_exists($classname))
			{
				// use default class instead
				$classname = 'Morph'.KInflector::implode($identifier->path).'Default';
				
				if (!class_exists($classname)) {
					throw new KFactoryAdapterException("Class [$classname] not found in file [".basename($filepath)."]" );
				}
			}
		}

		return $classname;
	}
}