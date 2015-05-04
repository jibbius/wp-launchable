<?php
class Check_BlackListedPasswords extends Launchable_LaunchCheck {
	public function runCheck(){

		$blacklisted_passwords=array('password','p@ssw0rd');

		global $wpdb;
		$results = $wpdb->get_results('SELECT * FROM wp_users' );

		//TODO: Optimise. Needs to be a more efficient means to do this.
		foreach ($results as $result) {
			foreach ( $blacklisted_passwords as $blacklist_pw ) {
				if ( wp_check_password( $blacklist_pw, $result->user_pass, $result->ID ) ) {
					$message = 'User [' . $result->user_login . '] is currently using a black-listed password (e.g. "password"). That\'s very bad!';
					$alert   = new Launchable_AlertMessage( $message );
					$alert->suggestFix_Link( 'Set new password', admin_url( 'user-edit.php?user_id=' . $result->ID.'#pass1' ) );
					$this->queueAlert( $alert );
				}
			}
		}
	}
} 