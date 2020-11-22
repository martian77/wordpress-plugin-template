<?php

namespace PT;

use PT\Admin\AdminSettings;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Main plugin class.
 *
 * Initialises all the things that the plugin needs.
 *
 * @category class
 * @author Electric Studio
 * @since 0.0.1
 */
class Main
{

	/**
	 * Singleton instance of the plugin class.
	 * @var PT_Main
	 */
	private static $_instance;

	/**
	 * Constructs the class.
	 */
	private function __construct()
	{
		$this->define_constants();
		$this->includes();
		$this->init();
	}

	/**
	 * Initialise anything that needs doing.
	 *
	 * @since 0.0.1
	 * @return void
	 */
	private function init()
	{
		// Add any actions.
		add_action( 'admin_init', [$this, 'admin_init'] );

		// Instantiate any classes.
		$settings = new AdminSettings();
		// And check the latest default options are set.
		$settings->update_default_options();
	}

	/**
	 * List of constants to define for the plugin.
	 */
	private function define_constants()
	{
		// Display name for the plugin. Used for settings page name etc.
		$this->define( 'PT_PLUGIN_NAME', 'Plugin Template' );
		// This constant should be changed for your new plugin. Make it lowercase!
		$this->define( 'PT_PLUGIN_SHORTNAME', 'pt');
		$this->define( 'PT_ABSPATH', dirname( PT_PLUGIN_FILE ) . '/' );
		$this->define( 'PT_TEMPLATE_PATH', 'plugintemplate');
	}

	/**
	 * Class includes for the plugin.
	 *
	 * @since 0.0.1
	 */
	private function includes()
	{
		include_once PT_ABSPATH . 'includes/autoloader.php';
	}

	/**
	 * Include anything that only needs initiating for admins.
	 *
	 * @return [type] [description]
	 */
	public function admin_init()
	{

	}

	/**
	 * Defines constants.
	 *
	 * Checks if constant is already defined and if not defines it.
	 *
	 * @param  String $name  Name of new constant.
	 * @param  mixed  $value Value for new constant
	 */
	private function define($name, $value) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Fetches a singleton instance of this class.
	 * @return PT_Main
	 */
	public static function get_instance() {
		if ( ! self::$_instance instanceof self ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}
