<?php
class Launchable_AlertMessage {
	var $message, $dismisable, $fixes;

	public function __construct($message, $dismissable = true){
		$this->message = $message;
		$this->dismissable = $dismissable;
		$this->fixes = array();
	}

	public function display(){
			echo '<div class="Launchable-message error"><p>',$this->message,'&nbsp;';
			foreach ($this->fixes as $key => $fix) {
				echo $fix;
			}
			echo '</p></div>';
	}

	public function suggestFix_Link($label,$link){
		$this->fixes[] = "<a href='$link' class='button'>$label</a>";
	}

	public function suggestFix_PHPFunction($label,$action,$nonce){
		$alert_button_class = "Launchable-quickfix";
	    $link = '#';

		$this->fixes[] = "<a href='$link' data-nonce='$nonce' data-action='$action' class='button $action $alert_button_class'>$label</a>";
	}

	public function suggestFix_CodeSnippet($label,$snippet){
	}

}