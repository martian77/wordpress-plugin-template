<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Autoloads classes on demand for the plugin.
 *
 * Generates class filename from the classname.
 *
 * @category class
 * @author Electric Studio
 * @since 0.0.1
 */
class PT_autoloader {

  /**
   * Path to the includes directory.
   * @var String
   */
  private $include_path = '';

  /**
   * The constructor.
   */
  public function __construct() {
    if ( function_exists( "__autoload" ) ) {
      spl_autoload_register( "__autoload" );
    }

    spl_autoload_register( array( $this, 'autoload' ) );

    $this->include_path = untrailingslashit( plugin_dir_path( PT_PLUGIN_FILE ) ) . '/includes/';
  }

  /**
   * Autoloads the class files.
   *
   * @param  String $class Name of the class to autoload.
   */
  public function autoload( $class ) {
    $class = strtolower( $class );

    if ( 0 !== strpos($class, $shortname . '_')) {
      return;
    }

    $file = $this->get_filename_from_classname( $class );
    $path = '';
    $shortname = strtolower( PT_PLUGIN_SHORTNAME );

    if ( 0 === strpos( $class, $shortname . '_admin_' ) ) {
      $path = $this->include_path . 'admin/';
    }

    if ( empty($path) || ! $this->load_file($path . $file) ) {
      $this->load_file( $this->include_path . $file );
    }
  }

  /**
   * Returns a filename from a given class.
   *
   * @param  String $classname lowercase name of class
   * @return String            name of file
   */
  private function get_filename_from_classname( $classname ) {
    return 'class-' . str_replace( '_', '-', $classname ) . '.php';
  }

  /**
   * Includes the file.
   *
   * @param  String $path Filepath to include.
   * @return Boolean      True if successful, false otherwise.
   */
  private function load_file( $path ) {
    if ( ! empty( $path ) && is_readable( $path ) ) {
      include_once( $path );
      return true;
    }
    return false;
  }
}

new PT_autoloader();
