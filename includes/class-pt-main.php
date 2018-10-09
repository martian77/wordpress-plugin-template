<?php

/**
 * Main plugin class.
 *
 * Initialises all the things that the plugin needs.
 *
 * @category class
 * @author Electric Studio
 * @since 0.0.1
 */
class PT_Main
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
	 * @return void
	 */
	private function init()
	{
		//
	}

	/**
	 * List of constants to define for the plugin.
	 */
	private function define_constants()
	{
		$this->define( 'PT_PLUGIN_SHORTNAME', 'PT');
		$this->define( 'PT_ABSPATH', dirname( PT_PLUGIN_FILE ) . '/' );
	}

	/**
	 * Class includes for the plugin.
	 */
	private function includes()
	{
		$shortname = strtolower( PT_PLUGIN_SHORTNAME );
		include_once PT_ABSPATH . 'includes/class-' . $shortname . '-autoloader.php';
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
