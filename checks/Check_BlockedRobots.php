<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {

	public function runCheck(){
		//Is robots.txt blocked?
		$result = get_option('blog_public')<>1;
		return $result;
	}

}