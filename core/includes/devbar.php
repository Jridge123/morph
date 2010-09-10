<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div id="dev-toolbar">
	<ul<?php echo ' class="'.$site_width.'"'; ?>>
		<?php if($nojs == 0){ ?>
		<li class="dev-css">
		    <strong class="tool-label">CSS Packing:</strong>
			<a href="#" <?php if($pack_css == 1){ ?>class="dev-unpack-css">Off<?php }else{ ?>class="dev-pack-css">On<?php }?></a>
			<span class="desc">
				<strong>CSS Packing</strong>
				<span>CSS Packing (otherwise refered to as CSS Concatination) refers to the combining of multiple files into a 
				single file. This boosts your sites performance as fewer http requests are needed..</span>
			</span>
		</li>
		<li class="dev-js">
		    <strong class="tool-label">JS Packing:</strong>
			<a href="#" <?php if($pack_js == 1){ ?>class="dev-unpack-js">Off<?php }else{ ?>class="dev-pack-js">On<?php }?></a>
			<span class="desc">
				<strong>JS Packing</strong>
				<span>JS Packing (otherwise refered to as JS Concatination) refers to the combining of multiple files into a 
				single file. This boosts your sites performance as fewer http requests are needed.</span>
			</span>
		</li>
		<li class="dev-modules">
		    <strong class="tool-label">Modules Outline:</strong>
			<a href="#"<?php if($debug_modules == 0){ ?> class="dev-debug-mods-on">On<?php }else{ ?>class="dev-debug-mods-off">Off<?php }?></a>
			<span class="desc">
				<strong>Modules Outline</strong>
				<span>Enabling this option will globally override all module chromes to use the outline chrome option. This is 
				good when you want to see which module positions are being used where.</span>
			</span>
		</li>
		<li class="dev-gzip">
		    <strong class="tool-label">GZIP:</strong>
			<a href="#"<?php if($gzip_compression == 0){ ?> class="dev-gzip-on">On<?php }else{ ?>class="dev-gzip-off">Off<?php }?></a>
			<span class="desc">
				<strong>GZIP Compression</strong>
				<span>Gzip is a form of optimization that causes pages to be compressed before being transmitted from server to 
				browser, making the transmitted data smaller, thus speeding up the delivery.</span>
			</span>
		</li>
		<li class="dev-fb">
		    <strong class="tool-label">Firebug Lite:</strong>
			<a href="#"<?php if($enable_fb == 0){ ?> class="dev-fb-on">On<?php }else{ ?>class="dev-fb-off">Off<?php }?></a>
			<span class="desc">
				<strong>Firebug Lite</strong>
				<span>Firebug Lite is a smaller JS enabled version of the popular Firebug plugin for Firefox. With Firebug Lite, 
				you can edit, debug, and monitor CSS, HTML, and JavaScript live.</span>
			</span>
		</li>
		<li class="dev-cache">
		    <strong class="tool-label">Clear cache:</strong>
			<a href="#" class="dev-close-devbar">&nbsp;</a>
			<span class="desc">
				<strong>Clear Morph Cache</strong>
				<span>Morph cache your dynamic css, js and params used in dynamic files. If you've made a change to your themelet with caching turned on that doesn't show, clear the cache.</span>
			</span>
		</li>
		<?php } ?>
		
		<li class="dev-nojs">
			<strong class="tool-label">
				<?php if($nojs == 1){ ?>  
					The developer toolbar requires javascript to work. Click the "on" button to re-enable the templates javascript.
				<?php }else{ ?> 
					Zero JS Mode:	
				<?php }?>
			</strong>
			<a href="<?php if($nojs == 1){ if($_SERVER['QUERY_STRING'] == ''){ echo '?json=1'; }else{ echo '?'.$_SERVER['QUERY_STRING'].'&json=1'; }}else{ echo '#'; } ?>"<?php if($nojs == 0){ ?> class="dev-nojs-on">On<?php }else{ ?>class="dev-nojs-off">Off<?php }?></a>
			<span class="desc">
				<strong>Zero Jasascript Mode</strong>
				<span>Enable or Disable the zero Javascript mode.</span>
			</span>
		</li>
		<li class="dev-close">
			<a href="<?php if($nojs == 1){ if($_SERVER['QUERY_STRING'] == ''){ echo '?hide_devbar'; }else{ echo '?'.$_SERVER['QUERY_STRING'].'&hide_devbar'; }}else{ echo '#'; } ?>" class="dev-close-devbar">Close</a>
		</li>
	</ul>
</div>