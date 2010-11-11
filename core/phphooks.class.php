<?php
/**
 * @author andy neale - modified and simplified version - original by: eric.wzy@gmail.com
 * @version 1.1
 * @package morphactions
 * @category Plugins
 * 
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */

class morphactions {
	
	/**
	 * actions data
	 * @var array
	 */
	var $actions = array ();
	
	
	/**
	* register action name/tag, so plugin developers can attach functions to actions
	* @package morphactions
	* @since 1.0
	* 
	* @param string $tag. The name of the action.
	*/
	//@andy this adds whatever "tag" is in the "set_actions($tag)" into the array "actions"
	function set_action($tag) {
		$this->actions [$tag] = '';
	}
	
	/**
	 * register multiple actions name/tag
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param array $tags. The name of the actions.
	 */
	function set_actions($tags) {
		foreach ( $tags as $tag ) {
			$this->set_action ( $tag );
		}
	}
	
	/**
	 * write action off
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the action.
	 */
	function unset_action($tag) {
		unset ( $this->actions [$tag] );
	}
	
	/**
	 * write multiple actions off
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param array $tags. The name of the actions.
	 */
	function unset_actions($tags) {
		foreach ( $tags as $tag ) {
			$this->developer_unset_action ( $tag );
		}
	}
	
	/**
	 * attach custom function to action
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the action.
	 * @param string $function. The function you wish to be called.
	 * @param int $priority optional. Used to specify the order in which the functions associated with a particular action are executed.(range 0~20, 0 first call, 20 last call)
	 */
	 
	function add_action($tag, $function, $priority = 10) {
		$this->set_action($tag);
		if (! isset ( $this->actions [$tag] )) {
			die ( "There is no such place ($tag) for actions." );
		} else {
			$this->actions [$tag] [$priority] [] = $function;
		}
	}
	
	/**
	 * check whether any function is attached to action
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param string $tag The name of the action.
	 */
	function action_exist($tag) {
		return (trim ( $this->actions [$tag] ) == "") ? false : true;
	}
	
	/**
	 * execute all functions which are attached to action, you can provide argument (or arguments via array)
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the action.
	 * @param mix $args optional.The arguments the function accept (default none)
	 * @return optional.
	 */
	function do_action($tag, $args = '') {
		if (isset ( $this->actions [$tag] )) {
			$these_actions = $this->actions [$tag];
			for($i = 0; $i <= 20; $i ++) {
				if (isset ( $these_actions [$i] )) {
				// @andy - initialize array to try fix [] error when using argument
				$args = array();
					foreach ( $these_actions [$i] as $action ) {
						$args [] = $result;
						$result = call_user_func ( $action, $args );
					}
				}
			}
			return $result;
		} else {
			// @andy - lets rather return false if no action found instead of the die message
			return false;
			//die ( "There is no such placez ($tag) for actions." );
		}
	}
	
	/**
	 * filter $args and after modify, return it. (or arguments via array)
	 * @package morphactions
	 * @since 1.0
	 * 
	 * @param string $tag. The name of the action.
	 * @param mix $args optional.The arguments the function accept to filter(default none)
	 * @return array. The $args filter result.
	 */
	function filter_action($tag, $args = '') {
		$result = $args;
		if (isset ( $this->actions [$tag] )) {
			$these_actions = $this->actions [$tag];
			for($i = 0; $i <= 20; $i ++) {
				if (isset ( $these_actions [$i] )) {
					foreach ( $these_actions [$i] as $action ) {
						$args = $result;
						$result = call_user_func ( $action, $args );
					}
				}
			}
			return $result;
		} else {
			die ( "There is no such place ($tag) for actions." );
		}
	}
	
//	static function do_actions($tag, $args) {
//		$action = new morphactions();
//		$action->do_action ($tag, $args);
//	}
//	
//	static function add_actions($tag, $function, $priority = 10) {
//		$action = new morphactions();
//		$action->add_action ( $tag, $function, $priority );
//	}
//	
//	static function has_actions($tag) {
//		if ($self->action_exist ($tag)) {
//			return true;
//		} else {
//			return false;
//		}
//	}
}


?>