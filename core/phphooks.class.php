<?php
/**
 * @author andy neale - modified and simplified version - original by: eric.wzy@gmail.com
 * @version 1.1
 * @package morphhooks
 * @category Plugins
 * 
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */

class morphhooks {
	
	/**
	 * hooks data
	 * @var array
	 */
	var $hooks = array ();
	
	
	/**
	* register hook name/tag, so plugin developers can attach functions to hooks
	* @package morphhooks
	* @since 1.0
	* 
	* @param string $tag. The name of the hook.
	*/
	//@andy this adds whatever "tag" is in the "set_hooks($tag)" into the array "hooks"
	function set_hook($tag) {
		$this->hooks [$tag] = '';
	}
	
	/**
	 * register multiple hooks name/tag
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param array $tags. The name of the hooks.
	 */
	function set_hooks($tags) {
		foreach ( $tags as $tag ) {
			$this->set_hook ( $tag );
		}
	}
	
	/**
	 * write hook off
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the hook.
	 */
	function unset_hook($tag) {
		unset ( $this->hooks [$tag] );
	}
	
	/**
	 * write multiple hooks off
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param array $tags. The name of the hooks.
	 */
	function unset_hooks($tags) {
		foreach ( $tags as $tag ) {
			$this->developer_unset_hook ( $tag );
		}
	}
	
	/**
	 * attach custom function to hook
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the hook.
	 * @param string $function. The function you wish to be called.
	 * @param int $priority optional. Used to specify the order in which the functions associated with a particular action are executed.(range 0~20, 0 first call, 20 last call)
	 */
	 
	function add_hook($tag, $function, $priority = 10) {
		$this->set_hook($tag);
		if (! isset ( $this->hooks [$tag] )) {
			die ( "There is no such place ($tag) for hooks." );
		} else {
			$this->hooks [$tag] [$priority] [] = $function;
		}
	}
	
	/**
	 * check whether any function is attached to hook
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param string $tag The name of the hook.
	 */
	function hook_exist($tag) {
		return (trim ( $this->hooks [$tag] ) == "") ? false : true;
	}
	
	/**
	 * execute all functions which are attached to hook, you can provide argument (or arguments via array)
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the hook.
	 * @param mix $args optional.The arguments the function accept (default none)
	 * @return optional.
	 */
	function execute_hook($tag, $args = '') {
		if (isset ( $this->hooks [$tag] )) {
			$these_hooks = $this->hooks [$tag];
			for($i = 0; $i <= 20; $i ++) {
				if (isset ( $these_hooks [$i] )) {
				// @andy - initialize array to try fix [] error when using argument
				$args = array();
					foreach ( $these_hooks [$i] as $hook ) {
						$args [] = $result;
						$result = call_user_func ( $hook, $args );
					}
				}
			}
			return $result;
		} else {
			// @andy - lets rather return false if no action found instead of the die message
			return false;
			//die ( "There is no such placez ($tag) for hooks." );
		}
	}
	
	/**
	 * filter $args and after modify, return it. (or arguments via array)
	 * @package morphhooks
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the hook.
	 * @param mix $args optional.The arguments the function accept to filter(default none)
	 * @return array. The $args filter result.
	 */
	function filter_hook($tag, $args = '') {
		$result = $args;
		if (isset ( $this->hooks [$tag] )) {
			$these_hooks = $this->hooks [$tag];
			for($i = 0; $i <= 20; $i ++) {
				if (isset ( $these_hooks [$i] )) {
					foreach ( $these_hooks [$i] as $hook ) {
						$args = $result;
						$result = call_user_func ( $hook, $args );
					}
				}
			}
			return $result;
		} else {
			die ( "There is no such place ($tag) for hooks." );
		}
	}
}


?>