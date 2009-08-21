<?php if ( $main_wrap == "1" ) { ?><div id="bd-wrap"><?php } ?>
	<!-- apply outer scheme -->
	<div id="bd" class="yui-t<?php echo $CurrentOuterScheme ?> <?php echo $site_width ?><?php if($option=='com_content' && $layout=='form'){ ?> editmode<?php } ?>">
	<div class="bd-inner">
	<?php if($this->countModules('user1')) { ?><?php include_once("user1.php") ?><?php } ?>
		<div id="yui-main">
			<div class="yui-b<?php if (!$this->countModules('splitleft or topleft or left or bottomleft')) { echo ' no-left'; } ?>">
			<?php $position = 'inset1'; include dirname(__FILE__) . '/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
			<!-- apply inner scheme -->
			<div class="yui-<?php echo $CurrentInnerScheme ?>" id="inner-wrap">
				<div class="yui-u first" id="primary-content">
					<div class="primary-inner">
						<?php $position = 'inset2'; include dirname(__FILE__) . '/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
						<?php if ((JRequest::getVar( 'view' ) != 'frontpage') && ($this->countModules('breadcrumb'))) { ?>
							<div id="breadcrumbs"><span>You are here: </span><jdoc:include type="modules" name="breadcrumb" /></div>
						<?php } ?>
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<?php $position = 'inset3'; include dirname(__FILE__) . '/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
					</div>
				</div>
				<?php if($CurrentInnerScheme !== "gg") { include_once("tertiary.php"); ?><?php } ?>
				<?php $position = 'inset4'; include dirname(__FILE__) . '/../morphBlockClasses.php'; echo blocks($position, $this, $jj_const, $classes, '', $debug_modules, $nojs); ?>
			</div>
		</div>
	</div>
	<?php if($CurrentOuterScheme !== "10") { include_once("secondary.php"); ?><?php } ?>
	<?php if($this->countModules('user2')) { ?><?php include_once("user2.php") ?><?php } ?>
	</div>
</div>
<?php if ( $main_wrap == "1" ) { ?></div><?php } ?>