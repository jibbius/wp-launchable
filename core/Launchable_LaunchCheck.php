<?php
class Launchable_LaunchCheck {
	var $name, $description, $message, $fixes, $dismisable;

	public function __construct($dismissable = true){
		$this->name = get_class($this);
		$this->description = 'description';
		$this->fixes = $this->name.'_fixes';
	}

	public function shouldRunCheck(){
		return true;
	}

	public function queueAlert(){
		
	}

	public function doesCheckPass(){
		$checkDidPass = true;
		return $checkDidPass;
	}

	public function displayAlert(){
		$this->suggestFixes();
	}

	public function suggestFixes(){
		do_action($this->fixes);
	}

}