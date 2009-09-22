<?php if ( $footer_show == 0 ) { ?>
    <?php if ( $footer_wrap == 1 ) { ?><div id="footer-wrap"><?php } ?>  
        <?php if ( $footer_type == 0 ) { ?>
            <?php echo codeComments('s','Footer Block','includes/foot.php','5', $code_comments); ?>
            	<div id="footer" class="<?php echo $site_width ?><?php if ( $footer_swish == 1 ) { ?> swish<?php } ?>">
            	    <?php if ( $footer_swish == 1 ) { ?><a href="http://www.prothemer.com" title="professional templates for your favorite cms" target="_blank" class="logo-swish">Prothemer</a><?php } ?>
                	<ul id="footer-links">
                	    <li class="footer-links">
                	        <jdoc:include type="modules" name="footernav" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
                	    </li>
                	    <li class="footer-validation">
                	        <?php if ($footer_validation == 1) { ?>
                	            <a target="_blank" href="http://validator.w3.org/check?uri=<?php echo JURI::root() ?>">XHTML</a> &amp; 
                	            <a target="_blank" href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo JURI::root() ?>">CSS Valid</a>
                	        <?php } if ($footer_validation == 1 && $footer_morphlink == 1) { ?>
                	          |  
                 	        <?php } if ($footer_morphlink == 1) { ?>
                               Powered by <a target="_blank" href="http://www.joomla.org" title="joomla open source cms">Joomla &amp; 
                               <a target="_blank" href="http://www.joomlajunkie.com/morph" title="powered by the morph joomla template framework">Morph</a>
                            <?php } ?>
                	    </li>
                	    <li class="footer-copyright">
                            <?php echo $footer_copyright; ?>
                	    </li>
                	    <li class="footer-credits">
                	        <?php echo $footer_credits; ?>
                	    </li>
                    </ul>
            	</div>
            <?php echo codeComments('e','Footer Block', '', '', $code_comments); ?>
        <?php } if ( $footer_type == 1 ) { ?>
        	<div id="footer" class="<?php echo $site_width ?> <?php echo $footer_chrome ?> <?php getYuiSuffix('footer', $jj_const); ?>">
            	<jdoc:include type="modules" name="footer" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } elseif(isset($nojs) && $nojs == 1) { 
            	echo 'basic'; } else { echo $footer_chrome; } ?>" />
        	</div>
        <?php } ?>
    <?php if ( $footer_wrap == 1 ) { ?></div><?php } ?>
<?php } ?>