<?php

class Launchable_AdminPage {
	var $text_domain = 'launchable';

	// Render the options page
	function readme_page() {
		global $wpdb;
		?>
		<div class="wrap launchable">
			<h2><?php _e('Launchable', $this->text_domain); ?></h2>
			<pre><?php include( Launchable::$plugin_directory .'/README.md'); ?></pre>
		</div>

	<?php
	}

} 