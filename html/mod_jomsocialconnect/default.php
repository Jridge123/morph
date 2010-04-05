<?php defined( '_JEXEC' ) or die( JText::_( 'Restricted access' ) );
      if($override = Morph::override(__FILE__, $this)) {
            if(file_exists($override)) include $override;
      }