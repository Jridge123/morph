<?php if ($this->countModules( 'user3 or user4' ) && $topnav_show == 0 ) { ?>
<?php if ( $topnav_wrap == "1" ) { ?><div id="topnav-wrap"><?php } ?>
	<div id="topnav" class="<?php echo $site_width; if ( $subtext_top >= 1 ) { ?> subtext<?php } if ( $topnav_actionlink >= 1 ) { ?> call-for-action<?php } ?> clearer">
	  <?php if($this->countModules('user3')) { ?>
	  	<div id="nav" <?php if ( $topfish >= 1 ) { ?>class="topfish"<?php } if ( $topdrop >= 1 ) { ?>class="topdrop"<?php } ?>>
	     <jdoc:include type="modules" name="user3" style="none" />
	    </div>
	  <?php } if($this->countModules('user4')) { ?>
	  	<div>
	     <jdoc:include type="modules" name="user4" style="none" />
	    </div>
	  <?php } ?>
	  
	</div>
<?php if ( $topnav_wrap == "1" ) { ?></div><?php } ?>
<?php } ?>