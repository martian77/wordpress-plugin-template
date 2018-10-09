<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Adds a settings page for the plugin.
 *
 * This includes displaying admin messages if required.
 *
 * @since 0.0.1
 */
class PT_Admin_Settings
{

  /**
   * Menu slug for the options page.
   * @since 0.0.1
   * @var string
   */
  private $menu_slug;

  /**
   * Setting name for the DB option.
   * @since 0.0.1
   * @var string
   */
  private $settings_name;

  /**
   * Contains any messages sent.
   * @since 0.0.1
   * @var string
   */
  protected $message_text = '';

  /**
   * Construct the setting class.
   *
   * @since 0.0.1
   */
  public function __construct()
  {
    $this->menu_slug = PT_PLUGIN_SHORTNAME . '_settings';
    $this->settings_name = PT_PLUGIN_SHORTNAME . '_settings';

    // Add actions.
    add_action( 'admin_init', [$this, 'admin_init'] );
    add_action( 'admin_menu', [$this, 'add_options_page'] );
  }

  /**
   * Initialises the settings details.
   *
   * @since 0.0.1
   * @return void
   */
  public function admin_init()
  {
    // Call any other code.
    $this->register_settings();
  }

  /**
   * Adds the settings page to the menu.
   *
   * @since 0.0.1
   * @return void
   */
  public function add_options_page()
  {
    $page_id = add_options_page(
      PT_PLUGIN_NAME . ' Settings',
      PT_PLUGIN_NAME,
      'manage_options',
      $this->menu_slug,
      array( $this, 'render_page' )
    );

    // Add an action on load to deal with any messages set.
    add_action( "load-$page_id", array ( $this, 'parse_message' ) );
  }

  /**
   * Renders the settings page.
   *
   * @since 0.0.1
   * @return void
   */
  public function render_page()
  {
    $options_name = $this->settings_name;
    $page_name = $this->menu_slug;
    include dirname( __FILE__ ) . '/views/html_pt_admin_settings.php';
  }

  /**
   * Set up the intro to the main settings section.
   * @return void
   */
  public function main_section_text()
  {
    echo '<p>Main section for settings</p>';
  }

  /**
   * Parses any message added on page load.
   *
   * @return void
   */
  public function parse_message()
  {
    if ( ! isset( $_GET['msg'] ) ) {
      return;
    }
    $message_text = false;
    // This allows us to make the messages more user-friendly.
    switch ( $_GET['msg'] ) {
      default:
        // If we haven't set up an alternative, just display.
        $message_text = $_GET['msg'];
    }
    if ( $message_text ) {
      // Escape the message.
      $this->message_text = esc_html( $message_text );
      add_action( 'admin_notices', [$this, 'render_message'] );
    }
  }

  /**
   * Renders any admin message.
   *
   * @return void
   */
  public function render_message()
  {
    echo '<div class="updated"><p>'
            . $this->message_text . '</p></div>';
  }

  /**
   * Renders a settings field.
   *
   * The default here is to always render a text field.
   * This could easily be extended to pass a field type in the args and display
   * different types of fields that way.
   *
   * @param array $args The arguments passed when add_settings_field called.
   * @return void       This needs to echo the HTML output.
   */
  public function render_field( array $args )
  {
    $option_name = $args['option_name'];
    $this->setting_text_value( $option_name );
  }

  /**
   * This sets up all of settings for the page.
   * @since 0.0.1
   * @return void
   */
  private function register_settings()
  {
    // We set the option group and option name to the same thing here.
    // Also, everything gets saved under a single options entry.
    register_setting( $this->settings_name, $this->settings_name );

    $main_section = $this->settings_name . '_main';
    add_settings_section (
      $main_section,
      PT_PLUGIN_NAME . ' Main',
      array( $this, 'main_section_text' ),
      $this->menu_slug
    );

    // Then add the fields to this section. Pass the setting name in the final args array.
    add_settings_field( 'first_field', 'First Setting Field', array($this, 'render_field'), $this->settings_name, $main_section, ['option_name' => 'first_field'] );
  }

  /**
   * Set up a text settings field.
   *
   * @since 0.0.1
   * @param  string  $option_name  Name of the option.
   * @param  integer $field_length How long should the text field be.
   * @return void
   */
  private function setting_text_value( $option_name, $field_length = 50 )
  {
    $options = get_option( $this->settings_name );
    $value = ! empty( $options[ $option_name ] ) ? $options[ $option_name ] :'';
    $field_name = $this->settings_name . '[' . $option_name . ']';
    echo '<input type="text" size="' . $field_length . '" id="' . $field_name . '" name="' . $field_name . '" value="' . $value . '"/>';
  }

}
