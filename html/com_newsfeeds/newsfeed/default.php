<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<?php
		$lang = &JFactory::getLanguage();
		$myrtl =$this->newsfeed->rtl;
		 if ($lang->isRTL() && $myrtl==0){
		   $direction= "direction:rtl !important;";
		   $align= "text-align:right !important;";
		   }
		 else if ($lang->isRTL() && $myrtl==1){
		   $direction= "direction:ltr !important;";
		   $align= "text-align:left !important;";
		   }
		  else if ($lang->isRTL() && $myrtl==2){
		   $direction= "direction:rtl !important;";
		   $align= "text-align:right !important;";
		   }

		else if ($myrtl==0) {
		$direction= "direction:ltr !important;";
		   $align= "text-align:left !important;";
		   }
		else if ($myrtl==1) {
		$direction= "direction:ltr !important;";
		   $align= "text-align:left !important;";
		   }
		else if ($myrtl==2) {
		   $direction= "direction:rtl !important;";
		   $align= "text-align:right !important;";
		   }

?>
<div style="<?php echo $direction; ?><?php echo $align; ?>">
<?php if ($this->params->get('show_page_title', 1)) : ?>
    <h1 style="<?php echo $direction; ?><?php echo $align; ?>">
	<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
<?php endif; ?>
	<table width="100%" class="contentpane<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<tr>
		<td class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>" style="<?php echo $direction; ?><?php echo $align; ?>">
			<a href="<?php echo $this->newsfeed->channel['link']; ?>" target="_blank">
				<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['title']); ?></a>
		</td>
	</tr>
	<?php if ( $this->params->get( 'show_feed_description' ) ) : ?>
	<tr>
		<td>
			<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['description']); ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php if ( isset($this->newsfeed->image['url']) && isset($this->newsfeed->image['title']) && $this->params->get( 'show_feed_image' ) ) : ?>
	<tr>
		<td>
			<img src="<?php echo $this->newsfeed->image['url']; ?>" alt="<?php echo $this->newsfeed->image['title']; ?>" />
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td>
			<ul>
			<?php foreach ( $this->newsfeed->items as $item ) :  ?>
				<li>
				<?php if ( !is_null( $item->get_link() ) ) : ?>
					<a href="<?php echo $item->get_link(); ?>" target="_blank">
						<?php echo $item->get_title(); ?></a>
				<?php endif; ?>
				<?php if ( $this->params->get( 'show_item_description' ) && $item->get_description()) : ?>
					<br />
					<?php $text = $this->limitText($item->get_description(), $this->params->get( 'feed_word_count' ));
						echo str_replace('&apos;', "'", $text);
					?>
				<?php endif; ?>
				</li>
			<?php endforeach; ?>
			</ul>
		</td>
	</tr>
	</table>
</div>
<?php } ?><!-- close the themelet override check -->