<?php
class Launchable_AlertMessage {
	var $message, $dismisable;

	public function __construct($message, $dismissable = true){
		$this->message = $message;
		$this->dismissable = $dismissable;
	}

	public function suggestFix_Link($label,$link){
	}

	public function suggestFix_PHPFunction($label,$function){
	}
	
	public function suggestFix_CodeSnippet($label,$snippet){
	}

}