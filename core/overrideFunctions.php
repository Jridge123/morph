<?php
defined('_JEXEC') or die('Restricted access');
include_once('templates/morph/core/morphLoader.php');include_once('templates/morph/core/overridesParams.php');
function codeComments($position, $comment, $location='', $linenumber='', $show_comments) {
	$haslocation = '';
   	$haslinenumber = '';
	if ($location !== '') $haslocation = ' | ' . $location;
	if ($linenumber !== '') $haslinenumber = ' | '.$linenumber;

	if ( $show_comments == '1' ){
	   if ( $position == 's' ) {
	       return "<!-- START: $comment | Located in: $location | Starting on line: $linenumber -->\n"; 
	   } else {
	       return "<!-- END: $comment$haslocation$haslinenumber -->\n";
	   }
	}
}
?>