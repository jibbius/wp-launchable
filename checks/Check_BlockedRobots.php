<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {

	public function runCheck(){

		//Is robots.txt blocked?
		$robots_blocked = get_option('blog_public')<>1;

		if ($robots_blocked){
			$priority = 10;
			$alert = new Launchable_AlertMessage('<strong>Huge SEO Issue:</strong> You\'re blocking access to robots.txt');
			$alert->suggestFix_Link('View page',admin_url('options-reading.php'));
			$alert->suggestFix_PHPFunction('Unblock it for me', array($this->name, 'unblock_robots'));
			$this->queueAlert($alert,$priority);
		}

	}

	public function unblock_robots(){
		update_option('blog_public','1');
	}

}