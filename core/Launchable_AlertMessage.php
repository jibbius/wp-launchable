<?php
class Launchable_AlertMessage {
	var $message, $dismissable, $fixes, $errorlevel;

	public function __construct($message, $errorlevel='error', $dismissable = true){
		$this->message = $message;
		$this->errorlevel = $errorlevel;
		$this->dismissable = $dismissable;
		$this->fixes = array();
	}

	public function display(){
			$classes = Array('Launchable-message', 'notice');
			if($this->dismissable) $classes[] = 'is-dismissible';
			if($this->errorlevel) $classes[] = $this->errorlevel;

			echo '<div class="',implode(" ", $classes),'"><p>',$this->message,'&nbsp;';
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


	public function suggestFix_CodeSnippet($label,$snippet,$instruction=''){
		$id = 'launchable-expander-'.uniqid();

		$expando = "<div id='$id' class='launchable expander'
				style='display:none;
			    margin: 10px 20px;'>";

		if($instruction)
			$expando.= "<div class='launchable instruction'
			    style='color: #0090d6; font-weight:bold'>$instruction</div>";

		$expando.="<div class='launchable snippet'
				style='border: 2px solid;
			    background: #282828;
			    tab-size: 4;
			    color: #BEBCBC;
			    padding: 4px 20px;'>
			    <pre>$snippet</pre>
		    </div>
		</div>";
		$link= "jQuery('#$id').slideToggle();";
		$this->fixes[] = "<a onclick=$link class='button'>$label</a>$expando";

	}

}