<?php
/*
Plugin Name: WP Launchable
Description:
Author: Jack Barker
Version: 1.0
*/
class Launchable {
	var $text_domain = 'launchable';
    static $plugin_directory = __DIR__ ;

	// init
	public function init() {
		load_plugin_textdomain( $this->text_domain, false, '/localization' );

		// TODO: If(dashboard);
		$this->load_plugin_core_files();
		$this->load_checks();
		add_action('admin_notices',array(&$this, 'render_alerts'));
		// TODO: Endif;

		if( is_user_logged_in() && current_user_can('manage_options') && is_admin() ){
			add_action( 'admin_menu', array( &$this, 'add_admin_menu' ) );
		}
	}

	// Load plugin files
	public function load_plugin_core_files(){
		require_once(self::$plugin_directory .'/core/Launchable_AdminPage.php');
		require_once(self::$plugin_directory .'/core/Launchable_AlertMessage.php');
		require_once(self::$plugin_directory .'/core/Launchable_LaunchCheck.php');
	}

	// Load check files
	public function load_checks(){
		$path = self::$plugin_directory.'/checks/*.php';
		foreach (glob($path) as $filename)
		{
			include $filename;
			$className = basename($filename, ".php");

			if(class_exists($className) && in_array('Launchable_LaunchCheck',class_parents($className))){
				$r = new ReflectionClass($className);
				$checkInstance = $r->newInstance();
				if(method_exists($checkInstance,'runCheck')){
					$checkInstance->runCheck();
				}
			}
		}
	}

	public function render_alerts(){
		do_action('Launchable_Alerts');
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
