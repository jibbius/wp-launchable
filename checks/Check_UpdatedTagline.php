<?php

class Check_UpdatedTagline extends Launchable_LaunchCheck {
	var $defaultTagline = 'Just another WordPress site';

	public function runCheck(){

		//Am I using the default tagline?
		if ( get_option( 'blogdescription') == 'Just another WordPress site' ){
			$alert = new Launchable_AlertMessage('You are currently using the default tagline: "'.get_option( 'blogdescription') .'"');

			$alert->suggestFix_Link('View page',admin_url('options-general.php'));
			$this->queueAlert($alert);
		}

	}

}