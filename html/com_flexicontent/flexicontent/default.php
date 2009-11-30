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
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div id="index-wrap">
    <div id="index-top">
    <?php if ($this->params->def( 'show_page_title', 1 )) : ?>
        <h1 class="componentheading clearer">
		    <?php echo $this->params->get('page_title'); ?>
	    </h1>
    <?php endif; ?>
    <?php if ($this->params->get('showintrotext')) : ?>
	    <p class="index-desc">
		    <?php echo $this->params->get('introtext'); ?>
	    </p>
    <?php endif; ?>
    </div>
    <?php echo $this->loadTemplate('categories'); ?>
</div>