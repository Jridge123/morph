<?php if ( $main_wrap == "1" ) { ?><div id="bd-wrap"><?php } ?>
   <div id="bd" class="yui-t<?php echo $CurrentOuterScheme ?> <?php echo $site_width ?><?php if($option=='com_content' && $layout=='form'){ ?> editmode<?php } ?>">
   <div class="bd-inner">
   
   <?php if($this->countModules('user1')) { ?><?php include_once("user1.php") ?><?php } ?>
   
      <div id="yui-main">
         <div class="yui-b <?php if (!$this->countModules('left')) echo $no_left ?>">

            <?php if($this->countModules('inset1')) { ?>
            <div id="inset1" class="intelli <?php getYuiSuffix('inset1', $jj_const); ?> <?php echo $inset1_chrome ?>">
               <jdoc:include type="modules" name="inset1" style="<?php echo $inset1_chrome ?>" />
            </div>
            <?php } ?>
            
			<!-- apply inner scheme -->
            <div class="yui-<?php echo $CurrentInnerScheme ?>">
               <div class="yui-u first" id="primary-content">
                	<div class="primary-inner">
					<?php if($this->countModules('inset2')) { ?>
						<div id="inset2" class="intelli <?php getYuiSuffix('inset2', $jj_const); ?> <?php echo $inset2_chrome ?>">
							<jdoc:include type="modules" name="inset2" style="<?php echo $inset2_chrome ?>" />
						</div>
					<?php } ?>

					<?php if ((JRequest::getVar( 'view' ) != 'frontpage') && ($this->countModules('breadcrumb'))) { ?>
				   		<jdoc:include type="modules" name="breadcrumb"/>
			    	<?php } ?>
			    
                 		<jdoc:include type="message" />
                 		<jdoc:include type="component" />
                 	
            		<?php if($this->countModules('inset3')) { ?>
            		<div id="inset3" class="intelli <?php getYuiSuffix('inset3', $jj_const); ?> <?php echo $inset3_chrome ?>">
            	   		<jdoc:include type="modules" name="inset3" style="<?php echo $inset3_chrome ?>" />
            		</div>
            		<?php } ?>
            		</div>
				</div>
              
				<?php include_once("tertiary.php") ?>
      			
            	<?php if($this->countModules('inset4')) { ?>
            	<div id="inset4" class="intelli  <?php getYuiSuffix('inset4', $jj_const); ?> <?php echo $inset4_chrome ?>">
            	   <jdoc:include type="modules" name="inset4" style="<?php echo $inset4_chrome ?>" />
            	</div>
            	<?php } ?>
            	
            </div>
         </div>
      </div>
      
      <?php include_once("secondary.php") ?>
      <?php if($this->countModules('user2')) { ?><?php include_once("user2.php") ?><?php } ?>
      </div>
   </div>
<?php if ( $main_wrap == "1" ) { ?></div><?php } ?>