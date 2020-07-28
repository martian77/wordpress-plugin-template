<?php

/*
Plugin Name: Plugin Template
Plugin URI:  https://electric.studio
Description: Provide a template plugin.
Version:     0.0.3
Author:      Electric Studio
Author URI:  https://www.electricstudio.co.uk/about/
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// Define the plugin file location.
if ( ! defined( 'PT_PLUGIN_FILE' ) ) {
  define( 'PT_PLUGIN_FILE', __FILE__ );
}

// Define the translation domain.
if ( ! defined( 'PT_TRANSLATE_DOMAIN' ) ) {
  define( 'PT_TRANSLATE_DOMAIN', 'plugin-template' );
}

// Include the main plugin class.
if ( ! class_exists( 'PT_Main' ) ) {
  include_once dirname( __FILE__ ) . '/includes/class-pt-main.php';
}

// Initialise the main plugin class on init.
add_action( 'init', function() {
    PT_Main::get_instance();
  }
);

/**
 * Checks module dependencies.
 *
 * @since 0.0.1
 * @return void
 */
function pt_activate_plugin()
{
  $module_dependencies = [
    // Put any dependencies in here.
    // 'classname' => 'Module display title',
    // e.g. 'acf' => 'Advanced Custom Fields',
  ];

  foreach ( $module_dependencies as $classname => $title ) {
    if ( ! class_exists( $classname ) ) {
      deactivate_plugins( plugin_basename( __FILE__ ) );
      wp_die( sprintf( __( 'Please install and activate %s.', PT_TRANSLATE_DOMAIN ), $title ) );
    }
  }
}

register_activation_hook( __FILE__, 'pt_activate_plugin' );

/**
 * Cleans up the database on uninstall.
 *
 * @since 0.0.2
 * @return void
 */
function pt_uninstall_plugin()
{
  global $wpdb;
  $option_name = PT_PLUGIN_SHORTNAME . '_%';
  $wpdb->query( "DELETE FROM {$wpdb->prefix}options WHERE option_name LIKE '{$option_name}';");
}

register_uninstall_hook( __FILE__, 'pt_uninstall_plugin' );
