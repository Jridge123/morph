<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $this->addScript(JURI::root().$templatepath .'/core/js/iphone_switch.js') ?>
<?php $switch = isset($_COOKIE['iPhone']) ? $_COOKIE['iPhone'] : 'optimized' ?>
<?php $swichActive = array($switch == 'optimized' ? 'active-mode' : '', $switch == 'normal' ? 'active-mode' : '') ?>
<div id="switch">
    <ul>
        <li class="optimized <?php echo $swichActive[0] ?>"><a href="#switch-optimized" onclick="switchState()">Optimized mode</a></li>
        <li class="normal <?php echo $swichActive[1] ?>"><a href="#switch-normal" onclick="switchState()">Normal mode</a></li>
    </ul>
</div>