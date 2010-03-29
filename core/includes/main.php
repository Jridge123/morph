<?php if($global_wrap == 1 && $global_wrap_start == 5){ ?><div id="global-wrap" class="<?php echo $site_width; ?>"><?php } ?>
<?php if ( $main_wrap == 1 ) { ?><div id="bd-wrap"><?php } ?>
	<!-- apply outer scheme -->
	<div id="bd" class="<?php if($CurrentOuterScheme != '0'){ echo $CurrentOuterScheme . ' '; } echo $site_width; if($option=='com_content' && $layout=='form'){ ?> editmode<?php } ?>">
	<?php if ( $main_inner == 1 ) { ?><div class="bd-inner clearer"><?php } ?>
		<?php if(JDocumentHTML::countModules('user1')) { ?><?php include_once("user1.php") ?><?php } ?>
		<div id="yui-main">
			<div class="yui-b<?php if (!$this->countModules('outer1 or outer2 or outer3 or outer4 or outer5') && ($this->countMenuChildren() < 1 ) ){ echo ' no-left'; } ?>">
				<?php $position = 'inset1'; include dirname(__FILE__).'/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
				<!-- apply inner scheme -->
				<div class="<?php if($CurrentInnerScheme != 'none'){ echo $CurrentInnerScheme . ' '; } ?>clearer" id="inner-wrap">
					<div class="yui-u first" id="primary-content">
						<div class="primary-inner clearer">
							<?php $position = 'inset2'; include dirname(__FILE__).'/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
							<?php if ((JRequest::getVar( 'view' ) != 'frontpage') && (JDocumentHTML::countModules('breadcrumb'))) { ?>
								<jdoc:include type="modules" name="breadcrumb" />
							<?php } ?>
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<?php $position = 'inset3'; include dirname(__FILE__).'/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
						</div>
					</div>
					<?php if($CurrentInnerScheme !='none') { include_once("tertiary.php"); } ?>
				</div>
				<?php $position = 'inset4'; include dirname(__FILE__).'/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
			</div>
		</div>
		<?php if($CurrentOuterScheme !='yui-t0') { include_once("secondary.php"); } ?>
		<?php if(JDocumentHTML::countModules('user2')) { include_once("user2.php"); } ?>
	<?php if ( $main_inner == 1 ) { ?></div><?php } ?><!-- bd inner close -->
</div><!-- bd close -->
<?php if($main_wrap == 1){ ?></div><?php } ?><!-- bd wrap close -->
<?php if($global_wrap == 1 && $global_wrap_end == 0){ ?></div><?php } ?>
