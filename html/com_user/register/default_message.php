<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<div id="login-wrap">
	<h1><?php echo $this->message->title ; ?></h1>
	<p class="message"><?php echo  $this->message->text ; ?></p>
</div>
<?php } ?><!-- close the themelet override check -->