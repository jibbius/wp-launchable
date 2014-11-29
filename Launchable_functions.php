<?php
if (!function_exists('Launchable_is_production')){
	function Launchable_is_production(){
		$siteurl = get_option( 'siteurl');

		// URL ends in '.dev'?
		if ('.dev' == substr($siteurl,strlen($siteurl)-4,4)){
			$result = false;
		}
		// URL contains 'localhost'
		elseif (strpos($siteurl,'localhost')){
			$result = false;
		}
		// URL contains '127.0.0.1'
		elseif (strpos($siteurl,'127.0.0.1')){
			$result = false;
		}else{
			$result = true;
		}

		return $result;
	}

}