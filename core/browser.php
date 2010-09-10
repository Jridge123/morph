<?php
/**
 * File: Browser.php
 * Author: Chris Schuld (http://chrisschuld.com/)
 * Last Modified: March 14, 2009
 * @version 1.5
 * @package PegasusPHP
 * 
 * Copyright (C) 2008-2009 Chris Schuld  (chris@chrisschuld.com)
*/
class MBrowser {
	private $_agent = '';
	private $_browser_name = '';
	private $_version = '';
	private $_platform = '';
	private $_os = '';
	private $_is_aol = false;
	private $_aol_version = '';

	const BROWSER_UNKNOWN = 'unknown';
	const VERSION_UNKNOWN = 'unknown';
	
	const BROWSER_OPERA = 'Opera';
	const BROWSER_WEBTV = 'WebTV';
	const BROWSER_NETPOSITIVE = 'NetPositive';
	const BROWSER_IE = 'Internet Explorer';
	const BROWSER_POCKET_IE = 'Pocket Internet Explorer';
	const BROWSER_GALEON = 'Galeon';
	const BROWSER_KONQUEROR = 'Konqueror';
	const BROWSER_ICAB = 'iCab';
	const BROWSER_OMNIWEB = 'OmniWeb';
	const BROWSER_PHOENIX = 'Phoenix';
	const BROWSER_FIREBIRD = 'Firebird';
	const BROWSER_FIREFOX = 'Firefox';
	const BROWSER_MOZILLA = 'Mozilla';
	const BROWSER_AMAYA = 'Amaya';
	const BROWSER_LYNX = 'Lynx';
	const BROWSER_SAFARI = 'Safari';
	const BROWSER_IPHONE = 'iPhone';
    const BROWSER_IPOD = 'iPod';
	const BROWSER_CHROME = 'Chrome';
    const BROWSER_ANDROID = 'Android';
    const BROWSER_GOOGLEBOT = 'GoogleBot';
    const BROWSER_SLURP = 'Yahoo! Slurp';
    const BROWSER_W3CVALIDATOR = 'W3C Validator';
    
	const PLATFORM_UNKNOWN = 'unknown';
	const PLATFORM_WINDOWS = 'Windows';
	const PLATFORM_WINDOWS_CE = 'Windows CE';
	const PLATFORM_APPLE = 'Apple';
	const PLATFORM_LINUX = 'Linux';
	const PLATFORM_OS2 = 'OS/2';
	const PLATFORM_BEOS = 'BeOS';
	const PLATFORM_IPHONE = 'iPhone';
	const PLATFORM_IPOD = 'iPod';
	
	const OPERATING_SYSTEM_UNKNOWN = 'unknown';
	
	public function __construct() {
		$this->reset();
		$this->determine();
	}
	public function reset() {
		$this->_agent = $_SERVER['HTTP_USER_AGENT'];
		$this->_browser_name = self::BROWSER_UNKNOWN;
		$this->_version = self::VERSION_UNKNOWN;
		$this->_platform = self::PLATFORM_UNKNOWN;
		$this->_os = self::OPERATING_SYSTEM_UNKNOWN;
		$this->_is_aol = false;
		$this->_aol_version = self::VERSION_UNKNOWN;
	}
	function isBrowser($browserName) { return( 0 == strcasecmp($this->_browser_name, trim($browserName))); }
	
	public function getBrowser() { return $this->_browser_name; }
	public function setBrowser($browser) { return $this->_browser_name = $browser; }
	public function getPlatform() { return $this->_platform; }
	public function setPlatform($platform) { return $this->_platform = $platform; }
	public function getVersion() { return $this->_version; }
	public function setVersion($version) { $this->_version = preg_replace('/[^0-9,.,a-z,A-Z]/i','',$version); }
	public function getAolVersion() { return $this->_aol_version; }
	public function setAolVersion($version) { $this->_aol_version = preg_replace('/[^0-9,.,a-z,A-Z]/i','',$version); }
	public function isAol() { return $this->_is_aol; }
	public function setAol($isAol) { $this->_is_aol = $isAol; }
	public function getUserAgent() { return $this->_agent; }
	public function setUserAgent($agent_string) {
		$this->reset();
		$this->_agent = $agent_string;
		$this->determine();
	}
	protected function determine() {
		$this->checkPlatform();
		$this->checkBrowsers();
		$this->checkForAol();
	}
	protected function checkBrowsers() {
		return (
					$this->checkBrowserGoogleBot() ||
					$this->checkBrowserSlurp() ||
					$this->checkBrowserInternetExplorer() ||
					$this->checkBrowserFirefox() ||
					$this->checkBrowserChrome() ||
                    $this->checkBrowserAndroid() ||
					$this->checkBrowserSafari() ||
					$this->checkBrowserOpera() ||
					$this->checkBrowserNetPositive() ||
					$this->checkBrowserFirebird() ||
					$this->checkBrowserGaleon() ||
					$this->checkBrowserKonqueror() ||
					$this->checkBrowserIcab() ||
					$this->checkBrowserOmniWeb() ||
					$this->checkBrowserPhoenix() ||
					$this->checkBrowserWebTv() ||
					$this->checkBrowserAmaya() ||
					$this->checkBrowserLynx() ||
					$this->checkBrowseriPhone() ||
					$this->checkBrowseriPod() ||
					$this->checkBrowserW3CValidator() ||
					$this->checkBrowserMozilla() /* Mozilla is such an open standard that you must check it last */	
					);
	}
	protected function checkForAol() {
		$retval = false;
		if( preg_match("/AOL/i", $this->_agent) ) {
			$aversion = explode(' ',stristr($this->_agent, "AOL"));
			$this->setAol(true);
			$this->setAolVersion(preg_replace("/[^0-9,.,a-z,A-Z]/i", "", $aversion[1]));
			$retval = true;
		}
		else {
			$this->setAol(false);
			$this->setAolVersion(self::VERSION_UNKNOWN);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserGoogleBot() {
		$retval = false;
		if( preg_match('/googlebot/i',$this->_agent) ) {
			$aresult = explode("/",stristr($this->_agent,"googlebot"));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->_browser_name = self::BROWSER_GOOGLEBOT;
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserW3CValidator() {
		$retval = false;
		if( preg_match('/W3C-checklink/i',$this->_agent) ) {
			$aresult = explode("/",stristr($this->_agent,"W3C-checklink"));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->_browser_name = self::BROWSER_W3CVALIDATOR;
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserSlurp() {
		$retval = false;
		if( preg_match('/Slurp/i',$this->_agent) ) {
			$aresult = explode("/",stristr($this->_agent,"Slurp"));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->_browser_name = self::BROWSER_SLURP;
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserInternetExplorer() {
		$retval = false;
		if( preg_match('/microsoft internet explorer/i', $this->_agent) ) {
			$this->setBrowser(self::BROWSER_IE);
			$this->setVersion('1.0');
			$aresult = stristr($this->_agent, '/');
			if( ereg('308|425|426|474|0b1', $aresult) ) {
				$this->setVersion('1.5');
			}
			$retval = true;
		}
		else if( preg_match('/msie/i',$this->_agent) && !preg_match('/opera/i',$this->_agent) ) {
			$aresult = explode(' ',stristr(str_replace(';','; ',$this->_agent),'msie'));
			$this->setBrowser( self::BROWSER_IE );
			$this->setVersion($aresult[1]);
			$retval = true;
		}
		else if( preg_match('/mspie/i',$this->_agent) || preg_match('/pocket/i', $this->_agent) ) {
			$aresult = explode(' ',stristr($this->_agent,'mspie'));
			$this->setPlatform( self::PLATFORM_WINDOWS_CE );
			$this->setBrowser( self::BROWSER_POCKET_IE );
			
			if( preg_match('/mspie/i', $this->_agent) ) {
				$this->setVersion($aresult[1]);
			}
			else {
				$aversion = explode('/',$this->_agent);
				$this->setVersion($aversion[1]);
			}
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserOpera() {
		$retval = false;
		if( preg_match('/opera/i',$this->_agent) ) {
			$resultant = stristr($this->_agent, 'opera');
			if( preg_match('/\//',$resultant) ) {
				$aresult = explode('/',$resultant);
				$aversion = explode(' ',$aresult[1]); 
				$this->setVersion($aversion[0]);
				$this->_browser_name = self::BROWSER_OPERA;
				$retval = true;
			}
			else {
				$aversion = explode(' ',stristr($resultant,'opera'));
				$this->setVersion($aversion[1]);
				$this->_browser_name = self::BROWSER_OPERA;
				$retval = true;
			}
		}
		return $retval;
	}
	protected function checkBrowserWebTv() {
		$retval = false;
		if( preg_match('/webtv/i',$this->_agent) ) {
			$aresult = explode("/",stristr($this->_agent,"webtv"));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->_browser_name = self::BROWSER_WEBTV;
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserNetPositive() {
		$retval = false;
		if( preg_match('/NetPositive/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'NetPositive'));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->_browser_name = self::BROWSER_NETPOSITIVE;
			$this->_platform = self::PLATFORM_BEOS;
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserGaleon() {
		$retval = false;
		if( preg_match('/galeon/i',$this->_agent) ) {
			$aresult = explode(' ',stristr($this->_agent,'galeon'));
			$aversion = explode('/',$aresult[0]);
			$this->setVersion($aversion[1]);
			$this->setBrowser(self::BROWSER_GALEON);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserKonqueror() {
		$retval = false;
		if( preg_match('/Konqueror/i',$this->_agent) ) {
			$aresult = explode(' ',stristr($this->_agent,'Konqueror'));
			$aversion = explode('/',$aresult[0]);
			$this->setVersion($aversion[1]);
			$this->setBrowser(self::BROWSER_KONQUEROR);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserIcab() {
		$retval = false;
		if( preg_match('/icab/i',$this->_agent) ) {
			$aversion = explode(' ',stristr(str_replace('/',' ',$this->_agent),'icab'));
			$this->setVersion($aversion[1]);
			$this->setBrowser(self::BROWSER_ICAB);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserOmniWeb() {
		$retval = false;
		if( preg_match('/omniweb/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'omniweb'));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_OMNIWEB);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserPhoenix() {
		$retval = false;
		if( preg_match('/Phoenix/i',$this->_agent) ) {
			$aversion = explode('/',stristr($this->_agent,'Phoenix'));
			$this->setVersion($aversion[1]);
			$this->setBrowser(self::BROWSER_PHOENIX);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserFirebird() {
		$retval = false;
		if( preg_match('/Firebird/i',$this->_agent) ) {
			$aversion = explode('/',stristr($this->_agent,'Firebird'));
			$this->setVersion($aversion[1]);
			$this->setBrowser(self::BROWSER_FIREBIRD);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserFirefox() {
		$retval = false;
		if( preg_match('/Firefox/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Firefox'));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_FIREFOX);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserMozilla() {
		$retval = false;
		if( preg_match('/Mozilla/i',$this->_agent) && preg_match('/rv:[0-9].[0-9][a-b]/i',$this->_agent) && !preg_match('/netscape/i',$this->_agent)) {
			$aversion = explode(' ',stristr($this->_agent,'rv:'));
			preg_match('/rv:[0-9].[0-9][a-b]/i',$this->_agent,$aversion);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_MOZILLA);
			$retval = true;
		}
		else if( preg_match('/mozilla/i',$this->_agent) && preg_match('/rv:[0-9]\.[0-9]/i',$this->_agent) && !preg_match('/netscape/i',$this->_agent) ) {
			$aversion = explode(" ",stristr($this->_agent,'rv:'));
        	preg_match('/rv:[0-9]\.[0-9]\.[0-9]/i',$this->_agent,$aversion);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_MOZILLA);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserLynx() {
		$retval = false;
		if( preg_match('/libwww/i',$this->_agent) && preg_match("/lynx/i", $this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Lynx'));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_LYNX);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserAmaya() {
		$retval = false;
		if( preg_match('/libwww/i',$this->_agent) && preg_match("/amaya/i", $this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Amaya'));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_AMAYA);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserChrome() {
		$retval = false;
		if( preg_match('/Chrome/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Chrome'));
			$aversion = explode(' ',$aresult[1]);
			$this->setVersion($aversion[0]);
			$this->setBrowser(self::BROWSER_CHROME);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserSafari() {
		$retval = false;
		if( preg_match('/Safari/i',$this->_agent) && ! preg_match('/iPhone/i',$this->_agent) && ! preg_match('/iPod/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Version'));
			if( isset($aresult[1]) ) {
				$aversion = explode(' ',$aresult[1]);
				$this->setVersion($aversion[0]);
			}
			else {
				$this->setVersion(self::VERSION_UNKNOWN);
			}
			$this->setBrowser(self::BROWSER_SAFARI);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowseriPhone() {
		$retval = false;
		if( preg_match('/iPhone/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Version'));
			if( isset($aresult[1]) ) {
				$aversion = explode(' ',$aresult[1]);
				$this->setVersion($aversion[0]);
			}
			else {
				$this->setVersion(self::VERSION_UNKNOWN);
			}
			$this->setBrowser(self::BROWSER_IPHONE);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowseriPod() {
		$retval = false;
		if( preg_match('/iPod/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Version'));
			if( isset($aresult[1]) ) {
				$aversion = explode(' ',$aresult[1]);
				$this->setVersion($aversion[0]);
			}
			else {
				$this->setVersion(self::VERSION_UNKNOWN);
			}
			$this->setBrowser(self::BROWSER_IPOD);
			$retval = true;
		}
		return $retval;
	}
	protected function checkBrowserAndroid() {
		$retval = false;
		if( preg_match('/Android/i',$this->_agent) ) {
			$aresult = explode('/',stristr($this->_agent,'Version'));
			if( isset($aresult[1]) ) {
				$aversion = explode(' ',$aresult[1]);
				$this->setVersion($aversion[0]);
			}
			else {
				$this->setVersion(self::VERSION_UNKNOWN);
			}
			$this->setBrowser(self::BROWSER_ANDROID);
			$retval = true;
		}
		return $retval;
	}
	protected function checkPlatform() {
		if( preg_match("/iPhone/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_IPHONE;
		}
		else if( preg_match("/iPod/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_IPOD;
		}
		else if( preg_match("/win/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_WINDOWS;
		}
		elseif( preg_match("/mac/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_APPLE;
		}
		elseif( preg_match("/linux/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_LINUX;
		}
		elseif( preg_match("/OS\/2/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_OS2;
		}
		elseif( preg_match("/BeOS/i", $this->_agent) ) {
			$this->_platform = self::PLATFORM_BEOS;
		}
	}
}