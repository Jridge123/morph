<?php defined( '_JEXEC' ) or die( 'Restricted access' );
if($override = Morph::override(__FILE__, $this)) {
	if(file_exists($override)) include $override;
} else { ?>
<script language="javascript" type="text/javascript">
<!--
	function submitbutton(pressbutton) {
	    var form = document.mailtoForm;
		// do field validation
		if (form.mailto.value == "" || form.from.value == "") {
			alert( '<?php echo JText::_('EMAIL_ERR_NOINFO'); ?>' );
			return false;
		}
		form.submit();
	}
-->
</script>
<?php
$data	= $this->get('data');
?>
<form action="<?php echo JURI::base() ?>index.php" name="mailtoForm" method="post" id="mailto-wrap">
	<h3><?php echo JText::_('EMAIL_THIS_LINK_TO_A_FRIEND'); ?></h3>
	<ul>
		<li><label for="mailto"><?php echo JText::_('EMAIL_TO'); ?>:</label>
		<input type="text" name="mailto" class="text-input" size="25" value="<?php echo $this->escape($data->mailto) ?>" /></li>

		<li><label for="sender"><?php echo JText::_('SENDER'); ?>:</label>
		<input type="text" name="sender" class="text-input" value="<?php echo $this->escape($data->sender) ?>" size="25" /></li>

		<li><label for="from"><?php echo JText::_('YOUR_EMAIL'); ?>:</label>
		<input type="text" name="from" class="text-input" value="<?php echo $this->escape($data->from) ?>" size="25" /></li>

		<li><label for="subject"><?php echo JText::_('SUBJECT'); ?>:</label>
		<input type="text" name="subject" class="text-input" value="<?php echo $this->escape($data->subject) ?>" size="25" /></li>
		
		<li class="form-action">
			<button class="button send" onclick="return submitbutton('send');"><?php echo JText::_('SEND'); ?></button>
		    <button class="button cancel" onclick="window.close();return false;"><?php echo JText::_('CANCEL'); ?></button>
		</li>
	</ul>
    <input type="hidden" name="layout" value="<?php echo $this->getLayout();?>" />
    <input type="hidden" name="option" value="com_mailto" />
    <input type="hidden" name="task" value="send" />
    <input type="hidden" name="tmpl" value="component" />
    <input type="hidden" name="link" value="<?php echo $data->link; ?>" />
    <?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php } ?><!-- close the themelet override check -->