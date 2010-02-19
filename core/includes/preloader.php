<?php if ( $preloader_all == 1 ) { ?>
<script>
 $ = jQuery.noConflict();   
 QueryLoader.selectorPreload = "body";
 QueryLoader.init();
</script>
<?php } ?>