<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else {
// Define default image size (do not change)
$image = 'image'.$this->item->params->get($this->item->itemGroup.'ImgSize');
?>
<li class="catItemView group<?php echo ucfirst($this->item->itemGroup); ?><?php if($this->item->params->get('pageclass_sfx')) echo ' '.$this->item->params->get('pageclass_sfx'); ?>">
	<a href="<?php echo $this->item->link; ?>"><?php echo $this->item->title; ?></a>
</li>
<?php } ?><!-- close the themelet override check -->