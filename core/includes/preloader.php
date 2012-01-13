<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php if ( $preloader_all == 1 ) { ?>
<script type="text/javascript">
 jQuery.noConflict();   
 QueryLoader.selectorPreload = "body";
 QueryLoader.init();
</script>
<?php } ?>