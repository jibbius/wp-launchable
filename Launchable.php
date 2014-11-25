<?php
/*
Plugin Name: WP Launchable
Description:
Author: Jack Barker
Version: 1.0
*/
class Launchable {
	var $text_domain = 'launchable';

	// init
	public function init() {
		load_plugin_textdomain( $this->text_domain, false, '/localization' );
		$this->load_plugin_files();

		if( is_user_logged_in() && current_user_can('manage_options') && is_admin() ){
			add_action( 'admin_menu', array( &$this, 'add_admin_menu' ) );
		}
	}

	// Load plugin files
	public function load_plugin_files(){
		$plugin_directory = dirname(__FILE__);

		require_once($plugin_directory .'/core/Launchable_AdminPage.php');
		require_once($plugin_directory .'/core/Launchable_LaunchCheck.php');
		require_once($plugin_directory .'/core/Launchable_Quickfix.php');
	}


	// Register the options page
	function add_admin_menu() {
		$this->options_page = new Launchable_AdminPage();
		$this->menu_id = add_options_page(
			__( 'Launchable', $this->text_domain ), // Page Title
			__( 'Launchable', $this->text_domain ), // Menu Title
			'manage_options', // Capability
			$this->text_domain, // Menu Slug
			array(&$this->options_page, 'render_page') );
	}


}
add_action( 'init', array(new Launchable, 'init' ) );
