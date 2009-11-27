<?php
/**
 * @version 1.5 beta 4 $Id: default.php 146 2009-10-31 08:27:23Z vistamedia $
 * @package Joomla
 * @subpackage FLEXIcontent
 * @copyright (C) 2009 Emmanuel Danan - www.vistamedia.fr
 * @license GNU/GPL v2
 * 
 * FLEXIcontent is a derivative work of the excellent QuickFAQ component
 * @copyright (C) 2008 Christoph Lukes
 * see www.schlu.net for more information
 *
 * FLEXIcontent is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
?>

<div id="category">
    <div id="category-overview">
        <?php if ($this->params->def( 'show_page_title', 1 )) : ?>
            <h1><?php echo $this->params->get('page_title'); ?></h1>
        <?php endif; ?>
        <div class="catdescription">
            <p><?php echo JText::_( 'FLEXI_ITEMS_WITH_TAG' ).' : <strong>'.$this->escape($this->tag->name).'</strong>'; ?></p>
        </div>
    </div>
    
    <form action="<?php echo $this->action; ?>" method="post" id="adminForm">
    <div id="fc_filter" class="floattext">
    	<div class="fc_fleft">
    		<input type="text" name="filter" id="filter" value="<?php echo $this->lists['filter'];?>" class="text_area" onchange="document.getElementById('adminForm').submit();" />
    		<button onclick="document.getElementById('adminForm').submit();"><?php echo JText::_( 'FLEXI_GO' ); ?></button>
    		<button onclick="document.getElementById('filter').value='';document.getElementById('adminForm').submit();"><?php echo JText::_( 'FLEXI_RESET' ); ?></button>
    	</div>
    </div>
    <input type="hidden" name="option" value="com_flexicontent" />
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['filter_order']; ?>" />
    <input type="hidden" name="filter_order_Dir" value="" />
    <input type="hidden" name="view" value="tags" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="id" value="<?php echo $this->tag->id; ?>" />
    </form>
    
    <div id="category-items">
    <ul>
    	<?php foreach ($this->items as $item) :	?>
        <li><a href="<?php echo JRoute::_(FlexicontentHelperRoute::getItemRoute($item->slug, $item->categoryslug)); ?>"><?php echo $this->escape($item->title); ?></a></li>
    	<?php endforeach; ?>
    </ul>
    </div>
</div>