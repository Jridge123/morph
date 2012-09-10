<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if ( $main_wrap == 1 ) { ?><div id="bd-wrap"><?php } ?>
	<!-- apply outer scheme -->
	<div id="bd" class="<?php if($layouts->CurrentOuterScheme != '0'){ echo $layouts->CurrentOuterScheme . ' '; } echo $site_width. ' ' . $layouts->outer_pos_class.'-secondary'; if($option=='com_content' && $layout=='form'){ ?> editmode<?php } ?>">
	<?php if ( $main_inner == 1 ) { ?><div class="bd-inner clearer"><?php } ?>
		<?php if(Morph::countModules('user1')) { ?>
			<?php if ( file_exists($inc_user1)) { include_once($inc_user1); } else { include_once($includespath.'user1.php'); } ?>
		<?php } if($global_wrap == 1 && $global_wrap_start == 7){ ?>
		<div id="global-wrap" class="clearer <?php echo $site_width; ?>"><?php } ?>
		<div id="yui-main">
			<div class="yui-b<?php if (!Morph::countModules('outer1 or outer2 or outer3 or outer4 or outer5') ){ echo ' no-left'; } ?>">
				<?php $position = 'inset1'; include ($blockclassespath); echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
				<!-- apply inner scheme -->
				<div class="<?php if($layouts->CurrentInnerScheme != 'none'){ echo $layouts->innerLayouts['inner_sidebar_position'].'-tertiary '; } ?>clearer" id="inner-wrap">
					<div class="yui-u first" id="primary-content">
						<div class="primary-inner clearer">
							<?php $position = 'inset2'; include ($blockclassespath); echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
							<div class="content-wrap">
							<?php if ((JRequest::getVar( 'view' ) != 'frontpage') && (Morph::countModules('breadcrumb'))) { ?>
								<jdoc:include type="modules" name="breadcrumb" />
							<?php } ?>
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							</div>
							<?php $position = 'inset3'; include ($blockclassespath); echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
						</div>
					</div>
					<?php if($layouts->CurrentInnerScheme !='none') { ?>
						<?php if ( file_exists($inc_tertiary)) { include_once($inc_tertiary); } else { include_once($includespath.'tertiary.php'); } ?>
					<?php } ?>
				</div>				
				<?php $position = 'inset4'; include ($blockclassespath); echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
			</div>
		</div>
		<?php if($layouts->CurrentOuterScheme !='yui-t0') { ?>
			<?php if ( file_exists($inc_secondary)) { include_once($inc_secondary); } else { include_once($includespath.'secondary.php'); } ?>
		<?php } ?>
		<?php if($global_wrap == 1 && $global_wrap_end == 0){ ?></div><?php } ?>
		<?php if(Morph::countModules('user2')) { ?>
			<?php if ( file_exists($inc_user2)) { include_once($inc_user2); } else { include_once($includespath.'user2.php'); } ?>
		<?php } ?>		
	<?php if ( $main_inner == 1 ) { ?></div><?php } ?><!-- bd inner close -->
</div><!-- bd close -->
<?php if($main_wrap == 1){ ?></div><?php } ?><!-- bd wrap close -->
