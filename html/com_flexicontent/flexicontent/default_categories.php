<?php
/**
 * @version 1.5 beta 4 $Id: default_categories.php 146 2009-10-31 08:27:23Z vistamedia $
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

<?php
// Get the directory menu parameters 
$cols	= $this->params->get('columns_count');
$c1		= $this->params->get('column1');
$c2		= $this->params->get('column2');
$c3		= $this->params->get('column3');
$i = 0;
switch ($cols) 
{
	case 1 :
	$condition1	= '';
	$condition2	= '';
	$condition3	= '';
	$style		= ' style="width:100%;"';
	break;

	case 2 :
	$condition1	= $c1;
	$condition2	= '';
	$condition3	= '';
	$style		= ' style="width:47%;"';
	break;

	case 3 :
	$condition1	= $c1;
	$condition2	= ($c1+$c2);
	$condition3	= '';
	$style		= ' style="width:31%;"';
	break;

	case 4 :
	$condition1	= $c1;
	$condition2	= ($c1+$c2);
	$condition3	= ($c1+$c2+$c3);
	$style		= ' style="width:24%;"';
	break;
}
?>

<ul id="index">
<?php foreach ($this->categories as $sub) : ?>
    <li class="cat<?php echo $sub->id; ?>">
        <h2>
    		<a href="<?php echo JRoute::_( FlexicontentHelperRoute::getCategoryRoute($sub->slug) ); ?>">
    			<?php echo $this->escape($sub->title); ?>
    			<?php if ($this->params->get('showassignated')) : ?>
    			<span><?php echo $sub->assigneditems != null ? '('.$sub->assigneditems.')' : '(0)'; ?></span>
    			<?php endif; ?>
    		</a>
    	</h2>
    	<?php if($sub->description !== ''){ ?>
    	<?php echo $sub->description; ?>
    	<?php } ?>
    </li>
<?php endforeach; ?>
</ul>
