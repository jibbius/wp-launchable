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

	public function displayAlert($message, $link=false, $javascript=false,$message_after=''){
			echo '<div class="launchy-message error"><p>',$message,'&nbsp;';
			if($link && !$javascript){
				echo "<a href=\"$link\" class='button'>Fix it</a>";
			} elseif($link && $javascript) {
				echo "<div onclick=\"$link\" class='button'>Fix it</div>";
			}
			echo $message_after,'</p></div>';
	}

	public function suggestFixes(){
		do_action($this->fixes);
	}

}