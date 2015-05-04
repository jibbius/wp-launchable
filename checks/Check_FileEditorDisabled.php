<?php

class Check_FileEditorDisabled extends Launchable_LaunchCheck {

	public function runCheck(){

		// Have I disabled the code editor?
		if (!defined('DISALLOW_FILE_EDIT') || !DISALLOW_FILE_EDIT){

//			New alert
			$message = 'The Wordpress Code Editor is enabled. Leaving this enabled is not best practice.';
			$alert = new Launchable_AlertMessage($message);

			$instruction = 'Disable the file editor in wp-config:';
			$codefix = "define('DISALLOW_FILE_EDIT',true);";
			$codefix = esc_html($codefix); // It's generally a good idea to do this
			$alert->suggestFix_CodeSnippet('Show snippet',$codefix, $instruction);

//			Alert is now ready to be added to the queue
			$this->queueAlert($alert);
		}
	}
}


