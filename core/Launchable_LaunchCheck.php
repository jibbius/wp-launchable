<?php
class Launchable_LaunchCheck {
	var $name, $description, $message, $fixes;

	public function __construct(){
		$this->name = get_class($this);
		$this->description = 'description';
	}

	public function shouldRunCheck(){
		return true;
	}

	public function doesCheckPass(){
		$checkDidPass = true;
		return $checkDidPass;
	}

	public function displayAlert(){
		do_action($this->name);
	}

}