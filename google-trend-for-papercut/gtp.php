<?php
/*
Plugin Name: Google Trends for Papercut
Plugin URI: http://agctools.blogkita.co.id
Description: Automatically find hot topic and save them for PaperCut campaigns.
Plugin URI: http://agctools.blogkita.co.id
Author: Mutasim Ridlo, S.Kom
Author URI: http://ridho.blogkita.co.id
Version: 1.2.0
*/

/*
## 1.0.1 Release Note:
* Initial Release

## 1.2.0 Release Note:
* Fix Google Domain

*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'GTP_DB_VERSION', '1.0.1' );
define( 'GTP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'GTP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once ( GTP_PLUGIN_DIR.'gtp_database.php' );
require_once ( GTP_PLUGIN_DIR.'gtp_controller.php' );
require_once ( GTP_PLUGIN_DIR.'gtp_trends.php' );
require_once ( GTP_PLUGIN_DIR.'gtp_widget.php' );

class Gtp 
	{
	var $alert = '';
	var $controller;

	public function __construct() 
	{
		$this->controller = new Gtp_Controller();

		add_action( 'admin_init', array( $this, 'post_catcher' ) ); 
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) ); 
		add_action( 'plugins_loaded', array( $this, 'create_schedule' ) ); 
		add_action( 'admin_menu', array( $this, 'gtp_menu' ) ); 

		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
	}
	
	public function post_catcher()
	{
		$message = "";
		if ( isset( $_POST['run_gtp'] ) ) 
		{
			check_admin_referer( 'run_gtp', '_run_gtp' );
			$message .= $this->controller->run_gtp();
		}
		else if ( isset( $_POST['gtp_setting'] ) ) 
		{
			check_admin_referer( 'gtp_setting', '_gtp_setting' );
			$edit_settings = $_POST['gtp_setting'];
			$message= $this->controller->update_gtp_settings($edit_settings);
		}
		
		$this->alert .= $message;
	}
	
	public function gtp_menu() 
	{
		add_menu_page( 'GTrend Papercut' , 'GTrend Papercut' , 'manage_options' , 'gtp' , array( $this , 'gtp_interface' ) , '' ,5  );
	}

	public function enqueue_styles($hook) 
	{
		if( 'toplevel_page_gtp' != $hook )
			return;
		wp_register_style( 'gtp_bootstrap' , plugins_url( 'bootstrap/css/bootstrap.min.css' , __FILE__ ) , false , '3.1.1' );
		wp_register_style( 'gtp_bootstrap_wpadmin' , plugins_url( 'bootstrap/css/bootstrap-wpadmin.min.css' , __FILE__ ) , false , '3.0.2' );
		wp_register_style( 'gtp_gtp_style' , plugins_url( 'style.css' , __FILE__ ) , false , null );
		wp_enqueue_style( 'gtp_bootstrap' );
		wp_enqueue_style( 'gtp_bootstrap_wpadmin' );
		wp_enqueue_style( 'gtp_gtp_style' );
		wp_enqueue_script( 'gtp_bootstrap_js', plugins_url( 'bootstrap/js/bootstrap.min.js' , __FILE__ ) , false , '3.1.1' , true );
	}

	public function create_schedule()
	{
		$schedules = wp_get_schedules();
		foreach( $schedules as $name=>$data ) 
		{
			$schname = 'gtp_'.$name;
			add_action($schname, array($this->controller, 'scheduler' ) );

			if ( ! wp_next_scheduled( $schname, array( $name ) ) ) 
			{
				wp_schedule_event( strtotime("+30 seconds") , $name, $schname, array( $name ) );
			}
		}
	}

	public function activate()
	{
		if (get_option('gtp_db_version') !== GTP_DB_VERSION || !$this->controller->gtp_table_trends_exist() || !$this->controller->gtp_table_settings_exist() || !$this->controller->gtp_table_domains_exist() || !$this->controller->gtp_table_languages_exist() || !$this->controller->gtp_table_trends_country_exist()) 
		{
			$this->controller->create_gtp_trends_table();
			$this->controller->create_gtp_settings_table();
			$this->controller->create_gtp_domains_table();
			$this->controller->create_gtp_languages_table();
			$this->controller->create_gtp_trends_country_table();
		}
		if( $this->controller->get_gtp_settings_exist() < 1 )$this->controller->create_gtp_settings();;
		if( $this->controller->get_gtp_domains_exist() < 1 )$this->controller->create_gtp_domains();;
		if( $this->controller->get_gtp_languages_exist() < 1 )$this->controller->create_gtp_languages();;
		if( $this->controller->get_gtp_trends_country_exist() < 1 )$this->controller->create_gtp_trends_country();;
	}

	public function deactivate()
	{
        $schedules = wp_get_schedules();
		foreach( $schedules as $name=>$data ) {
			$schname = 'gtp_'.$name;
			remove_action($schname, array($this->controller, 'scheduler' ) );
			wp_clear_scheduled_hook( $schname, array( $name ) );
		}
    }

	public function gtp_interface()
	{
		$trends = $this->controller->get_all_trends();
		$gtp_settings=$this->controller->get_gtp_settings();
		$gtp_trends_country=$this->controller->get_gtp_trends_country();
		$trends_count = $this->controller->get_trends_count();
		$gtp_domains=$this->controller->get_gtp_domains();
		$gtp_languages=$this->controller->get_gtp_languages();
		$schedules = wp_get_schedules();
		uasort($schedules, create_function('$a,$b', 'return $a["interval"]-$b["interval"];'));
		include('gtp_interface.php');
		;
	}
}

$gtp = new Gtp();
