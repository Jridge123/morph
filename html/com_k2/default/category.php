<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<!-- Start K2 Category Layout -->
<div id="k2Container" class="itemListView">
	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="itemListCategoriesBlock">
		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory">
			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
			<span class="catItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('Add a new item in this category'); ?>
				</a>
			</span>
			<?php endif; ?>
			<?php if($this->params->get('catImage')): ?>
			<!-- Category image -->
			<img alt="<?php echo $this->category->name; ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
			<?php endif; ?>
			<?php if($this->params->get('catTitle')): ?>
			<!-- Category title -->
			<h1>
			    <?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?>
    			<?php if($this->params->get('catFeedLink')): ?>
    			<!-- RSS feed icon -->
    				<a class="feedicon" href="<?php echo $this->feed; ?>" title="<?php echo JText::_('Subscribe to this RSS feed'); ?>">
    					<?php echo JText::_('Subscribe to this RSS feed'); ?>
    				</a>
    			<?php endif; ?>
			</h1>
			<?php endif; ?>
			<?php if($this->params->get('catDescription')): ?>
			<!-- Category description -->
			<div class="desc"><?php echo $this->category->description; ?></div>
			<?php endif; ?>
			<!-- K2 Plugins: K2CategoryDisplay -->
			<?php echo $this->category->event->K2CategoryDisplay; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div class="blog subcategories">
		    <div class="article-row">
			<?php foreach($this->subCategories as $key=>$subCategory): ?>
			<div class="article-column" style="width:<?php echo number_format(100/$this->params->get('subCatColumns'), 1); ?>%;float:left;">		
				<?php if($this->params->get('subCatTitle')): ?>
				<!-- Subcategory title -->
				<h2>
					<a href="<?php echo $subCategory->link; ?>">
						<?php echo $subCategory->name; ?><?php if($this->params->get('subCatTitleItemCounter')) echo ' <span class="count">('.$subCategory->numOfItems.')</span>'; ?>
					</a>
				</h2>
				<?php endif; ?>
                <?php if($this->params->get('subCatImage')): ?>
                <!-- Subcategory image -->
                <p><a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
                	<img alt="<?php echo $subCategory->name; ?>" src="<?php echo $subCategory->image; ?>" />
                </a></p>
                <?php endif; ?>
				<?php if($this->params->get('subCatDescription')): ?>
				<!-- Subcategory description -->
				<p><?php echo $subCategory->description; ?></p>
				<?php endif; ?>
				<!-- Subcategory more... -->
				<p class="readon" ><a href="<?php echo $subCategory->link; ?>">
					<?php echo JText::_('View items...'); ?>
				</a></p>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			</div><div class="article-row"
			<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
	<div class="itemList">
		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
		<div id="itemListLeading">
			<?php foreach($this->leading as $key=>$item): ?>
			<div class="itemContainer" style="width:<?php echo number_format(100/$this->params->get('num_leading_columns'), 1); ?>%;">
			<?php
				// Load category_item.php by default
				$this->item=$item;
				echo $this->loadTemplate('item');
			?>
			</div>
			<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
		<div id="itemListPrimary">
			<?php foreach($this->primary as $key=>$item): ?>
			<div class="itemContainer" style="width:<?php echo number_format(100/$this->params->get('num_primary_columns'), 1); ?>%;">
			<?php
				// Load category_item.php by default
				$this->item=$item;
				echo $this->loadTemplate('item');
			?>
			</div>
			<?php if(($key+1)%($this->params->get('num_primary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
		<div id="itemsListSecondary">
			<?php foreach($this->secondary as $key=>$item): ?>
			<div class="itemContainer" style="width:<?php echo number_format(100/$this->params->get('num_secondary_columns'), 1); ?>%;">
			<?php
				// Load category_item.php by default
				$this->item=$item;
				echo $this->loadTemplate('item');
			?>
			</div>
			<?php if(($key+1)%($this->params->get('num_secondary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>
		<?php if(isset($this->links) && count($this->links)): ?>
		<!-- Link items -->
		<div class="blog-more clearer">
			<h3><?php echo JText::_('More...'); ?></h3>
			<ul class="more-links">
			<?php foreach($this->links as $key=>$item): ?>
			<?php
				// Load category_item_links.php by default
				$this->item=$item;
				echo $this->loadTemplate('item_links');
			?>
			<?php if(($key+1)%($this->params->get('num_links_columns'))==0): ?>
			<?php endif; ?>
			<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div id="pagination-wrap">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>
	<?php endif; ?>
</div>
<!-- End K2 Category Layout -->
<?php } ?><!-- close the themelet override check -->