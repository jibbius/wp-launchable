<?php

class Check_ClientLogins extends Launchable_LaunchCheck {
	public function runCheck(){
		global $wpdb;
		$results = $wpdb->get_results('SELECT * FROM wp_users' );
		foreach ($results as $result){
			// Have I changed the admin password?
			$default_password = 'password';
			if($result->user_pass == md5($default_password)) // TODO: Test this. Not convinced there's no salting to be done.
			{
				//			New alert
				$message = 'You\'re currently using the default password. That\'s very bad!';
				$alert = new Launchable_AlertMessage($message);
				$alert->suggestFix_Link('View page',admin_url( 'profile.php' ));
				$this->queueAlert($alert);
			}
			// Have I changed the email?
			if($result->user_email == '')
			{
				// TODO: Possibly include something here?
			}
		}
		// Have I created client logins?
		if (count($results) == 1){
			$message = 'You haven\'t created any client logins';
			$alert = new Launchable_AlertMessage($message);
			$alert->suggestFix_Link('View page',admin_url( 'user-new.php' ));
			$this->queueAlert($alert);
		}
	}
} 