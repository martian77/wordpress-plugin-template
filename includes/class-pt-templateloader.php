<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Loads templates as required.
 *
 * @category class
 * @author Electric Studio
 * @since 0.0.1
 */
class PT_TemplateLoader
{
	/**
	 * Locate template.
	 *
	 * Locate the called template.
	 * Search Order:
	 * 1. /themes/theme/woocommerce-plugin-templates/$template_name
	 * 2. /themes/theme/$template_name
	 * 3. /plugins/woocommerce-plugin-templates/templates/$template_name.
	 *
	 * @since 0.0.1
	 *
	 * @param 	string 	$template_name			Template to load.
	 * @param 	string 	$string $template_path	Path to templates.
	 * @param 	string	$default_path			Default path to template files.
	 * @return 	string 							Path to the template file.
	 */
	public function locate_template( $template_name, $template_path = '', $default_path = '' ) {
		// Set variable to search in electricsocial folder of theme.
		if ( ! $template_path ) {
			$template_path = 'electricsocial/';
		}

		// Set default plugin templates path.
		if ( ! $default_path ) {
			$default_path = ESOC_ABSPATH . 'templates/'; // Path to the template folder
		}

		// Search template file in theme folder.
		$template = locate_template( array(
			$template_path . $template_name,
			$template_name,
		) );

		// Get plugins template file.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}
		return apply_filters( 'esoc_locate_template', $template, $template_name, $template_path, $default_path );
	}

	/**
	 * Get template.
	 *
	 * Search for the template and include the file.
	 *
	 * @since 0.0.1
	 *
	 * @param string 	$template_name			Template to load.
	 * @param array 	$args					Args passed for the template file.
	 * @param string 	$string $template_path	Path to templates.
	 * @param string	$default_path			Default path to template files.
	 */
	public function get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
		if ( '.php' != substr( $template_name, -4, 4) ) {
			$template_name .= '.php';
		}
		if ( is_array( $args ) && isset( $args ) ) {
			extract( $args );
		}
		$template_file = $this->locate_template( $template_name, $tempate_path, $default_path );
		if ( ! file_exists( $template_file ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
			return;
		}
		include $template_file;
	}
}
