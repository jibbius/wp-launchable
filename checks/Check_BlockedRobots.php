<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {

	public function runCheck(){
		//Is robots.txt blocked?
		$robots_blocked = get_option('blog_public')<>1;

		if ($robots_blocked){
			$priority = 10;
			$alert = new Launchable_AlertMessage('Robots is blocked');
			$alert->suggestFix_Link('Take me to the settings page','#'); //TODO: Specify link address
			$alert->suggestFix_PHPFunction('Unblock it for me','#'); //TODO: Specify link address
			$alert->suggestFix_CodeSnippet('Unblock it for me','#'); //TODO: Specify link address
			$this->queueAlert($alert,$priority);
		}

	}

}