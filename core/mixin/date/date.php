<?php defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * MorphMixinDate
 *
 * Extends Morph with date methods
 * 
 * @author Stian Didriksen <stian@prothemer.com>
 */
class MorphMixinDate extends MorphMixin
{
	public static $_timeofday;
	
	/**
	 * Get the time of day
	 *
	 * @return	string
	 */
	public function getTimeofday()
	{
		if(!isset(self::$_timeofday))
		{
			$user = JFactory::getUser();
			$date = clone JFactory::getDate();

			//Set timezone offset
			if(!$user->guest) $date->setOffset($user->getParam('timezone'));

			$time = $date->toFormat('%H'); 

			$sunrise = date_sunrise($date->toUnix(), SUNFUNCS_RET_DOUBLE); 
			$sunset = date_sunset($date->toUnix(), SUNFUNCS_RET_DOUBLE) + 1; 
			if($time >= $sunrise && $time < $sunrise + 2) $style = 'sunrise'; 
			elseif($time >= $sunrise + 2 && $time < $sunset) $style = 'day'; 
			elseif($time >= $sunset && $time < $sunset + 2) $style = 'sunset'; 
			else $style = 'night';
			
			self::$_timeofday = $style;
		}
		
		return self::$_timeofday;
	}
	
	/**
	 * Formats date acording to configuration
	 *
	 * @param	$date	datetime
	 * @return	string
	 */
	public function date($date)
	{
		$pattern = array(
			'[weekday1]'	=> '<span class="weekday">%a</span>',
			'[weekday2]'	=> '<span class="weekday">%A</span>',
			'[dayofmonth1]' => '<span class="dayofmonth">%d</span>',
			'[dayofmonth2]'	=> '<span class="dayofmonth">%E</span>',
			'[month1]'		=> '<span class="month">%b</span>',
			'[month2]'		=> '<span class="month">%B</span>',
			'[month3]'		=> '<span class="month">%m</span>',
			'[year1]'		=> '<span class="year">%g</span>',
			'[year2]'		=> '<span class="year">%G</span>'
		);
	
		return JHTML::_('date', $date, str_ireplace(array_keys($pattern), array_values($pattern), $this->dateformat));
	}
}