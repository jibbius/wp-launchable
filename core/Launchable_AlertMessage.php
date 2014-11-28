<?php
class Launchable_AlertMessage {
	var $message, $dismisable, $fixes;

	public function __construct($message, $dismissable = true){
		$this->message = $message;
		$this->dismissable = $dismissable;
	}

	public function display(){
			echo '<div class="launchable-message error"><p>',$this->message,'&nbsp;';
			foreach ($this->fixes as $key => $fix) {
				echo $fix;
			}
			echo '</p></div>';
	}

	public function suggestFix_Link($label,$link){
		$fixes[] = "<a href='$link' class='button'>$label</a>";
	}

	public function suggestFix_PHPFunction($label,$function){
		// TODO: Implement linkage mechanism
		$link = '#'.print_r($function);
		$fixes[] = "<a href='$link' class='button'>$label</a>";
	}
	
	public function suggestFix_CodeSnippet($label,$snippet){
	}

}