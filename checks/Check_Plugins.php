<?php

class Check_Plugins extends Launchable_LaunchCheck{
//TODO: Implement Check_Plugins
	var suggested_plugins = array(
		'hello-dolly/hello.php' => 'http://ma.tt', 
	);

	public function runCheck(){
		foreach ($this->suggested_plugins) as $plugin => $url {
			if(!is_active_plugin($plugin){

				$message = "You\'re not using the following suggested plugin: $plugin";
				$alert = new Launchable_AlertMessage($message);
				$alert->suggestFix_Link('View Plugins',admin_url( 'plugins.php' ));
				$alert->suggestFix_Link('Install','#'); // TODO: Figure out how to do this!
				$this->queueAlert($alert);

			}
		}
	}
} 