<?php

class Check_FileEditorDisabled extends Launchable_LaunchCheck {

	public function runCheck(){

		// Have I disabled the code editor?
		if (!defined('DISALLOW_FILE_EDIT') || !DISALLOW_FILE_EDIT){

//			New alert
			$message = 'Disable the file editor in wp-config:<br/><pre>define(\'DISALLOW_FILE_EDIT\)';
			$alert = new Launchable_AlertMessage($message);

//			Alert is now ready to be added to the queue
			$this->queueAlert($alert);
		}
	}
}


