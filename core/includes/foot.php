<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if ( $footer_show == 0 ) { ?>
    <?php if ( $footer_wrap == 1 ) { ?><div id="footer-wrap" class="block wrap <?php echo $footer_blockfx; ?>"><?php } ?>  
        <?php if ( $footer_type == 0 ) { ?>
            <?php echo codeComments('s','Footer Block','includes/foot.php','5', $code_comments); ?>
            <div id="footer" class="<?php echo $site_width; ?> block <?php echo $footer_blockfx;?>">
                <div class="footer-left">
                    <?php if(JDocumentHTML::countModules('footernav')) { ?>
                    <jdoc:include type="modules" name="footernav" style="<?php if( $debug_modules == 1 ){ echo 'outline'; } else { echo 'none'; } ?>" />
                    <?php } ?>
                    <?php if ($footer_copyright_show == 1) { ?>
                    <p class="footer-copyright"><?php echo $footer_copyright; ?></p>
                    <?php } ?>
                </div>
                <div class="footer-right">
                    <?php if ($footer_validation == 1 || $footer_morphlink == 1) { ?><p class="footer-validation"><?php } ?>
                        <?php if ($footer_validation == 1) { ?>
                            <a target="_blank" href="http://validator.w3.org/check?uri=<?php echo JURI::root() ?>">XHTML</a> &amp; 
                            <a target="_blank" href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo JURI::root() ?>">CSS</a> Valid
                        <?php } if ($footer_validation == 1 && $footer_morphlink == 1) { ?>
                            |  
                        <?php } if ($footer_morphlink == 1) { ?>
                            Powered by <a target="_blank" href="http://www.joomla.org" title="joomla open source cms">Joomla</a> &amp; 
                            <a target="_blank" href="http://www.joomlajunkie.com/morph" title="powered by the morph joomla template framework">Morph</a>
                        <?php } ?>  
                    <?php if ($footer_validation == 1 || $footer_morphlink == 1) { ?></p><?php } ?>
                    <?php if ($footer_credits_show == 1) { ?>
                    <p class="footer-credits"><?php echo $footer_credits; ?></p>
                    <?php } ?>
                </div>
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
<?php if($global_wrap_end == 2){ ?></div><?php } ?>