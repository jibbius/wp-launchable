<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {

	public function runCheck(){

		//Is robots.txt blocked?
		$robots_blocked = get_option('blog_public')<>1;

		if ($robots_blocked){

//			New alert
			$message = '<strong>Huge SEO Issue:</strong> You\'re blocking access to robots.txt';
			$alert = new Launchable_AlertMessage($message);

//			Suggested Fix 1: View the settings page
			$alert->suggestFix_Link('View page',admin_url('options-reading.php'));

//			Suggested Fix 2: Call a custom PHP function via AJAX
			$action = 'unblock_robots';
			$nonce = wp_create_nonce($action.'_nonce');
			add_action('wp_ajax_'.$action, array(&$this, $action));

			$alert->suggestFix_PHPFunction('Unblock it for me',$action,$nonce);

//			Alert is now ready to be added to the queue
			$this->queueAlert($alert);
		}
	}

	public function unblock_robots(){
		$action = 'unblock_robots';
		$nonce = $action.'_nonce';

		if ( !wp_verify_nonce( $_REQUEST['nonce'], $nonce)) {
			exit('Request not authorised');
		}
		update_option('blog_public','1');
		$result['type'] = 'success';

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$result = json_encode($result);
			echo $result;
		} else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die();
	}

}