<?php

class Check_DebugMode extends Launchable_LaunchCheck {
    function is_production(){
	    $siteurl = strtolower(get_option( 'siteurl'));

	    switch (true){
		    case ('.dev' == substr($siteurl,strlen($siteurl)-4,4)): // SiteURL ends with .dev
		    case (strpos($siteurl,'test') !== false): // SiteURL contains 'test'
		    case (strpos($siteurl,'localhost') !== false): // SiteURL contains 'localhost'
		    case (strpos($siteurl,'127.0.0.1') !== false): // SiteURL contains '127.0.0.1'
		    case (strpos($siteurl,'staging') !== false): // SiteURL contains 'staging'
			    return false;
	    }
	    return true;
    }

	public function runCheck(){
		$message ='';
		$codefix ='';

		if($this->is_production()){
			if (defined('WP_DEBUG') && WP_DEBUG){
				$message = 'This looks like a production site! <br/>If so, you should disable debug mode';
				$codefix = "define('WP_DEBUG', false);";
			}
		}else{
			if (!defined('WP_DEBUG') || !WP_DEBUG){
				$message = 'This looks like a test/development site! <br/>If so, you should enable debug mode';
				$codefix = "define('WP_DEBUG', true);";
			}
		}
		if($message){
			$alert = new Launchable_AlertMessage($message);
			$alert->suggestFix_CodeSnippet('Show snippet',$codefix, 'Add the following to wp-config:');
			$this->queueAlert($alert);
		}
	}
} 