<?php
class Launchable_LaunchCheck {
	var $name, $description;
	// var $fixes, $dismisable;
	var $alerts = array();

	public function __construct(){
		$this->name = get_class($this);
		$this->description = 'description';
		// $this->fixes = $this->name.'_fixes';
	}

	public function runCheck(){
		// You need to override this
	}

	public function queueAlert($alert,$priority=10){
		add_action('Launchable_Alerts', array(&$alert, 'display'),$priority);
	}


}