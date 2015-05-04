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