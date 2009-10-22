<?php
/**
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once(JPATH_ROOT . '/templates/morph/core/morphFunctions.php');
if ( $gzip_compression == 1 ) {
	// set Joomla's GZIP to on if not set.
	$conf = JFactory::getConfig();
	if($conf->getValue('config.gzip') !== '1'){
		$path = JPATH_CONFIGURATION.DS.'configuration.php';
		JPath::setPermissions($path, '0777');
		if(file_exists($path) && is_writable($path)){			
			$str = file_get_contents($path);
			$line = str_replace('var $gzip = \'0\';', 'var $gzip = \'1\';', $str);
			file_put_contents($path, $line);
		}		
		JPath::setPermissions($path, '0644');
	}
	// enable GZIP if the PHP ZLIB extension is loaded and output_compression is not enabled, else enable output buffering
	if(extension_loaded('zlib') && !ini_get('zlib.output_compression')){
		if(!ob_start("ob_gzhandler")) ob_start();
	}
}

echo $gzip_compression;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<title><?php echo $this->error->code ?> - <?php echo $this->title; ?></title>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/morph/core/css/error.css" type="text/css" />
	<script src="<?php echo $this->baseurl; ?>/templates/morph/core/js/jquery.js" language="javascript" type="text/javascript"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/morph/core/js/corners.js" language="javascript" type="text/javascript"></script>
	<script type="text/javascript">
      $(document).ready(function() {
		$('#morph').corners("10px");
		$('#morph h1').corners("10px top");
      });
    </script>
</head>
<body>
	<div id="morph">
			<h1 id="errorboxheader"><?php echo JText::_('Houston, we have a problem!'); ?> (<?php echo $this->error->code ?>)</h1>
			<p><strong><?php echo JText::_('You may not be able to visit this page because of:'); ?></strong></p>
				<ol>
					<li><?php echo JText::_('An out-of-date bookmark/favourite'); ?></li>
					<li><?php echo JText::_('A search engine that has an out-of-date listing for this site'); ?></li>
					<li><?php echo JText::_('A mis-typed address'); ?></li>
					<li><?php echo JText::_('You have no access to this page'); ?></li>
					<li><?php echo JText::_('The requested resource was not found'); ?></li>
					<li><?php echo JText::_('An error has occurred while processing your request.'); ?></li>
				</ol>
			<p><strong><?php echo JText::_('Please try one of the following pages:'); ?></strong></p>
			<p>
				<ul>
					<li><a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('Go to the home page'); ?>"><?php echo JText::_('Home Page'); ?></a></li>
				</ul>
			</p>
			<p><?php echo JText::_('If difficulties persist, please contact the system administrator of this site.'); ?></p>

			<div id="techinfo">
			<p><?php echo $this->error->message; ?></p>
				<?php if($this->debug) : ?>
					<p><?php echo $this->renderBacktrace(); ?></p>
				<?php endif; ?>
			</div>
	</div>
</body>
</html>
