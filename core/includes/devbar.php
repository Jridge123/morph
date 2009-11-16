<div id="dev-toolbar">
	<ul<?php echo ' class="'.$site_width.'"'; ?>>
		<li class="dev-label">Developer Toolbar</li>
		<li class="dev-css"><strong class="tool-label">CSS Packing</strong>:
			<span class="desc">
				<strong>CSS Packing</strong>
				<p>CSS Packing (otherwise refered to as CSS Concatination) refers to the combining of multiple files into a 
				single file. This boosts your sites performance as fewer http requests are needed..</p>
			</span>
			<a href="#" <?php if($pack_css == 1){ ?>class="dev-unpack-css">Off<?php }else{ ?>class="dev-pack-css">On<?php }?></a>
		</li>
		<li class="dev-js"><strong class="tool-label">JS Packing</strong>:
			<span class="desc">
				<strong>JS Packing</strong>
				<p>JS Packing (otherwise refered to as JS Concatination) refers to the combining of multiple files into a 
				single file. This boosts your sites performance as fewer http requests are needed.</p>
			</span>
			<a href="#" <?php if($pack_js == 1){ ?>class="dev-unpack-js">Off<?php }else{ ?>class="dev-pack-js">On<?php }?></a>
		</li>
		<li class="dev-modules"><strong class="tool-label">Modules Outline</strong>:
			<span class="desc">
				<strong>Modules Outline</strong>
				<p>Enabling this option will globally override all module chromes to use the outline chrome option. This is 
				good when you want to see which module positions are being used where.</p>
			</span>
			<a href="#"<?php if($debug_modules == 0){ ?> class="dev-debug-mods-on">On<?php }else{ ?>class="dev-debug-mods-off">Off<?php }?></a>
		</li>
		<li class="dev-gzip"><strong class="tool-label">GZIP Compression</strong>:
			<span class="desc">
				<strong>GZIP Compression</strong>
				<p>Gzip is a form of optimization that causes pages to be compressed before being transmitted from server to 
				browser, making the transmitted data smaller, thus speeding up the delivery.</p>
			</span>
			<a href="#"<?php if($gzip_compression == 0){ ?> class="dev-gzip-on">On<?php }else{ ?>class="dev-gzip-off">Off<?php }?></a>
		</li>
		<li class="dev-fb"><strong class="tool-label">Firebug Lite</strong>:
			<span class="desc">
				<strong>Firebug Lite</strong>
				<p>Firebug Lite is a smaller JS enabled version of the popular Firebug plugin for Firefox. With Firebug Lite, 
				you can edit, debug, and monitor CSS, HTML, and JavaScript live.</p>
			</span>
			<a href="#"<?php if($enable_fb == 0){ ?> class="dev-fb-on">On<?php }else{ ?>class="dev-fb-off">Off<?php }?></a>
		</li>
	</ul>
</div>