<?php

/*
Plugin Name: Plugin Template
Plugin URI:  https://electric.studio
Description: Provide a template plugin.
Version:     0.0.1
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

// Include the main plugin class.
if ( ! class_exists( 'PT_Main' ) ) {
  include_once dirname( __FILE__ ) . '/includes/class-pt-main.php';
}

// Initialise the main plugin class on init.
add_action( 'init', function() {
    PT_Main::get_instance();
  }
);
