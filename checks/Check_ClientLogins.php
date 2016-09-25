<?php

class Check_ClientLogins extends Launchable_LaunchCheck {
	public function runCheck(){
		global $wpdb;
		$results = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'users' );

		// Have I created client logins?
		if (count($results) == 1){
			$message = 'You haven\'t created any client logins';
			$alert = new Launchable_AlertMessage($message);
			$alert->suggestFix_Link('View page',admin_url( 'user-new.php' ));
			$this->queueAlert($alert);
		}
	}
} 