<?php
class Launchable_LaunchCheck {
	var $name, $description, $message, $fixes;

	public function __construct(){
		$this->name = get_class($this);
		$this->description = 'description';
		$this->fixes = $this->name.'_fixes';
	}

	public function shouldRunCheck(){
		return true;
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