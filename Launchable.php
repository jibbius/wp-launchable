<?php
/*
Plugin Name: WP Launchable
Description:
Author: Jack Barker
Version: 1.0
*/
class Launchable {
	var $text_domain = 'launchable';
	var $checks = array();
    static $plugin_directory = __DIR__ ;

	// init
	public function init() {
		load_plugin_textdomain( $this->text_domain, false, '/localization' );


		if( is_user_logged_in() && current_user_can('manage_options') && is_admin() ){

			// Determine what the current screen is
			$current_screen   = get_current_screen();

			// If(current screen = dashboard)
			if ( in_array( $current_screen->base, array('dashboard') )){
				$this->load_plugin_core_files();
				$this->load_checks();
				add_action( 'admin_enqueue_scripts', array(&$this,'enqueue_scripts'));
				add_action('admin_notices',array(&$this, 'render_alerts'));
			}

			add_action( 'admin_menu', array( &$this, 'add_admin_menu' ) );
		}
	}

	// Load plugin files
	public function load_plugin_core_files(){
		require_once(self::$plugin_directory .'/Launchable_functions.php');
		require_once(self::$plugin_directory .'/core/Launchable_AdminPage.php');
		require_once(self::$plugin_directory .'/core/Launchable_AlertMessage.php');
		require_once(self::$plugin_directory .'/core/Launchable_LaunchCheck.php');
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'launchable', plugins_url( '/core/js/launchable.js', __FILE__ ), array( 'jquery' ) );
		wp_localize_script( 'launchable', 'launchableArgs', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
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
				$this->checks[$className] = $checkInstance;

			} else {
				// Error - ClassName does not match filename
				$message = "ERROR: The file <b>$filename</b> does not contain the expected class <b>$className</b>";
				$alert = new Launchable_AlertMessage($message);
				$x = new Launchable_LaunchCheck;
				$x->queueAlert($alert);
			}
		}
	}

	public function render_alerts(){
		do_action('Launchable_Alerts');
	}

	// Register the options page
	function add_admin_menu() {
		$this->readme_page = new Launchable_AdminPage();

		$this->menu_id = add_menu_page(
			__( 'Launchable Options', $this->text_domain ), // Page Title
			__( 'Launchable', $this->text_domain ), // Menu Title
			'manage_options', // Capability
			$this->text_domain, // Slug
			array(&$this->options_page, 'readme_page') );

		$this->options_page = new Launchable_AdminPage();
		add_submenu_page(
			$this->text_domain, // Slug
			__( 'Readme', $this->text_domain ), // Page Title
			__( 'Readme', $this->text_domain ), // Menu Title
			'manage_options', // Capability
			'launchable-readme',//$this->text_domain, // Menu Slug
			array(&$this->readme_page, 'readme_page') );
	}

}
add_action( 'admin_enqueue_scripts', array(new Launchable, 'init' ) );
