<?php

class Launchable_AdminPage {
	var $text_domain = 'launchable';

	// Render the options page
	function render_page() {
		global $wpdb;
		?>
		<div class="wrap launchable">
			<h2><?php _e('Launchable', $this->text_domain); ?></h2>
		</div>

	<?php
	}

} 