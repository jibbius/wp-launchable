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
		add_action("wp_ajax_nopriv_".$action_name, $function);

		// Linkage mechanism
		$if(is_array($function)){
			$class = $function[0];
			$action = $function[1];
		} else {
			$action = $function;
		}
		add_action( 'wp_ajax_nopriv_'.$action, $function );
		$nonce = wp_create_nonce($function.'_nonce');
	    $link = admin_url("admin-ajax.php?action=$function&nonce=$nonce");
	    $link = '#';

		// TODO: Implement linkage mechanism
		// $link = '#'.json_encode($function);
		$this->fixes[] = "<a href='$link' data-nonce='$nonce' class='button $action'>$label</a>";
	}

	public function suggestFix_CodeSnippet($label,$snippet){
	}

}