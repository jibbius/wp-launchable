<?php

class Check_UpdatedAdminFooter extends Launchable_LaunchCheck{
//TODO: Implement Check_UpdatedLoginLogo
	function runCheck(){
		if(!has_filter('admin_footer_text')){

	//			New alert
			$message = 'You haven\'t customised the admin footer; perhaps you\'d like to?';
			$alert = new Launchable_AlertMessage($message);

	//			Alert is now ready to be added to the queue
			$this->queueAlert($alert);

		}

	}

}