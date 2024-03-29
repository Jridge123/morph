<?php // no direct access
defined('_JEXEC') or die('Restricted access');
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
require_once (JPATH_SITE.'/components/com_content/helpers/route.php');
class modNewsFlashHelper{
	function renderItem(&$item, &$params, &$access){
		global $mainframe;
		$user 	=& JFactory::getUser();
		$item->text 	= $item->introtext;
		$item->groups 	= '';
		$item->readmore = (trim($item->fulltext) != '');
		$item->metadesc = '';
		$item->metakey 	= '';
		$item->created 	= '';
		$item->modified = '';
		if ($params->get('readmore') || $params->get('link_titles')){
			if ($params->get('intro_only')){
				// Check to see if the user has access to view the full article
				if ($item->access <= $user->get('aid', 0)) {
					$item->linkOn = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->sectionid));
					$item->linkText = JText::_('Read more text');
				} else {
					$item->linkOn = JRoute::_('index.php?option=com_user&view=login');
					$item->linkText = JText::_('Login To Read More');
				}
			}
		}
		if (!$params->get('image')) {
			$item->text = preg_replace( '/<img[^>]*>/', '', $item->text );
		}
		$results = $mainframe->triggerEvent('onAfterDisplayTitle', array (&$item, &$params, 1));
		$item->afterDisplayTitle = trim(implode("\n", $results));
		$results = $mainframe->triggerEvent('onBeforeDisplayContent', array (&$item, &$params, 1));
		$item->beforeDisplayContent = trim(implode("\n", $results));
		require(JModuleHelper::getLayoutPath('mod_newsflash', '_item'));
	}
	function getList(&$params, &$access){
		global $mainframe;
		$db 	=& JFactory::getDBO();
		$user 	=& JFactory::getUser();
		$aid	= $user->get('aid', 0);
		$catid 	= (int) $params->get('catid', 0);
		$items 	= (int) $params->get('items', 0);
		$contentConfig	= &JComponentHelper::getParams( 'com_content' );
		$noauth			= !$contentConfig->get('show_noauth');
		$date =& JFactory::getDate();
		$now = $date->toMySQL();
		$nullDate = $db->getNullDate();
		// query to determine article count
		$query = 'SELECT a.*,' .
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
			' FROM #__content AS a' .
			' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
			' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
			' WHERE a.state = 1 ' .
			($noauth ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
			' AND (a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' ) ' .
			' AND (a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )' .
			' AND cc.id = '. (int) $catid .
			' AND cc.section = s.id' .
			' AND cc.published = 1' .
			' AND s.published = 1' .
			' ORDER BY a.ordering';
		$db->setQuery($query, 0, $items);
		$rows = $db->loadObjectList();
		return $rows;
	}
}
} // close the themelet override check