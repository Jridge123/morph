<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * MorphMixin
 *
 * Base mixin class for Morph mixins
 * 
 * @author Stian Didriksen <stian@prothemer.com>
 */
class MorphMixin extends KMixinAbstract
{
	/**
	 * Overloaded get function
	 *
	 * @TODO submit patch to mailing list about __get returned by reference allowing you to do this:
	 * $object->array[] = 'new value';
	 * Without that throwing a notice like: Indirect modification of overloaded property self::$array has no effect
	 *
	 * @param  string 	The variable name.
	 * @return mixed
	 */
	public function &__get($key)
	{
		if($key == 'mixer') {
			return $this->_mixer;
		} else {
			return $this->_mixer->$key;
		}
	}
}