<?php
class Launchable_AlertMessage {
	var $message, $dismisable, $fixes;

	public function __construct($message, $dismissable = true){
		$this->message = $message;
		$this->dismissable = $dismissable;
		$this->fixes = array();
	}

	public function display(){
			echo '<div class="launchable-message error"><p>',$this->message,'&nbsp;';
			foreach ($this->fixes as $key => $fix) {
				echo $fix;
			}
			echo '</p></div>';
	}

	public function suggestFix_Link($label,$link){
		$this->fixes[] = "<a href='$link' class='button'>$label</a>";
	}

	public function suggestFix_PHPFunction($label,$function,$action_name){
		//
		// add_action("wp_ajax_".$action_name, "my_user_vote");

		// Linkage mechanism
		if(is_array($function)){
			$class = $function[0];
			$action = $function[1];
		} else {
			$action = $function;
		}
		add_action( 'wp_ajax_nopriv_'.$action_name, $function );
		$nonce = wp_create_nonce('unblock_robots_nonce');
	    $link = '#';

		$this->fixes[] = "<a href='$link' data-nonce='$nonce' class='button $action_name'>$label</a>";
//		$this->fixes[] = "<a href='$link' class='button $action_name'>$label</a>";
	}

	public function suggestFix_CodeSnippet($label,$snippet){
	}

}