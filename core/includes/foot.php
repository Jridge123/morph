<?php if ( $footer_show == 0 ) { ?>
<?php if ( $footer_wrap == 1 ) { ?><div id="footer-wrap"><?php } ?>

<?php if ( $footer_type == 0 ) { ?>
<?php echo codeComments('s','Footer Block','includes/foot.php','5', $code_comments); ?>
	<div id="footer" class="<?php echo $site_width ?>">
    	<?php if ( $footer_swish == 1 ) { ?>
            <a title="JoomlaJunkie Commercial and free Joomla Templates" href="http://www.joomlajunkie.com" class="joomlajunkie-swish">Powered by Morph</a>
        <?php } ?>
        <ul id="footer-links"<?php if ( $footer_swish == "0" ) { ?>class="no-swish"<?php } ?>>
			<li class="fl-left"><jdoc:include type="modules" name="footernav" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" /></li>
			<li class="fl-right">
				<ul>
					<?php if ($footer_morphlink == "1") { ?><li class="morph-link">
					<a target="_blank" href="http://www.joomlajunkie.com/morph">morph inside</a></li>
					<?php } if ($footer_xhtml == "1") { ?><li class="w3c-valid-xhtml">
					<a target="_blank" href="http://validator.w3.org/check?uri=<?php echo JURI::root() ?>">xhtml</a></li>
					<?php } if ($footer_css == "1") { ?>
					<li class="w3c-valid-css"><a target="_blank" href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo JURI::root() ?>">css</a></li>
					<?php } if ($footer_rss == "1") { ?>
					<li class="footer-rss"><jdoc:include type="modules" name="syndicate" /></li>
					<?php } ?>
				</ul>
			</li>
		</ul>
		<ul id="footer-text">
        	<li class="ft-left"><?php echo $footer_copyright; ?></li>
           	<li class="ft-right"><?php echo $footer_credits; ?></li>
		</ul>
	</div>
<?php echo codeComments('e','Footer Block', '', '', $code_comments); ?>
<?php } if ( $footer_type == 1 ) { ?>

	<div id="footer" class="<?php echo $site_width ?> <?php echo $footer_chrome ?> <?php getYuiSuffix('footer', $jj_const); ?>">
    	<jdoc:include type="modules" name="footer" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { echo 'basic'; } else { echo $footer_chrome; } ?>" />

	</div>
	
<?php } ?>

<?php if ( $footer_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>