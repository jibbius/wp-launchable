<?php
// The path to the WordPress tests checkout.
define( 'WP_TESTS_DIR', '/srv/www/wordpress-develop/tests/phpunit/' );

// The path to the main file of the plugin to test.
define( 'TEST_PLUGIN_FILE', '/srv/www/launchable.php' );

// Load the The WordPress suite
require_once WP_TESTS_DIR . 'includes/functions.php';

// Manually load the plugin main file.
function _manually_load_plugin() {
	require TEST_PLUGIN_FILE;
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Commence our tests
require WP_TESTS_DIR . 'includes/bootstrap.php';