<?php

class Check_BlockedRobots extends Launchable_LaunchCheck {
	var $action = 'unblock_robots'; // used in AJAX call

	public function runCheck(){

		//Is robots.txt blocked?
		$robots_blocked = get_option('blog_public')<>1;

		if ($robots_blocked){

			$message = '<strong>Huge SEO Issue:</strong> You\'re blocking access to robots.txt';
			$alert = new Launchable_AlertMessage($message);

//			Fix 1: View the settings page
			$alert->suggestFix_Link('View page',admin_url('options-reading.php'));

//			Fix 2: Call a custom PHP function, via AJAX
			$alert->suggestFix_PHPFunction('Unblock it for me', array( &$this , 'unblock_robots'),$this->action);
			add_action("wp_ajax_unblock_robots", array(&$this, 'unblock_robots'));

			$this->queueAlert($alert);
		}
	}

	public function unblock_robots(){
		if ( !wp_verify_nonce( $_REQUEST['nonce'], $this->action.'_nonce')) {
			exit('Request not authorised');
		}
		update_option('blog_public','0');
		$result['type'] = 'success';

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$result = json_encode($result);
			echo $result;
		}
	else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
		}
		die();
	}

}