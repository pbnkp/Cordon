<?php
// Create options pages
add_action('admin_init', 'Cordon_Admin::init');
add_action('admin_menu', 'Cordon_Admin::config_page');

class Cordon_Admin
{

  private static $_options = array();


  /**
   *
   */
  public static function config_page()
  {
    if (function_exists('add_options_page')) {
      add_options_page(__('Cordon'), __('Cordon'), 'manage_options', 'cordon', 'Cordon_Admin::options_page');
    }
  }


  /**
   *
   */
  public static function init()
  {
    self::$_options = get_option('cordon');

    register_setting('cordon', 'cordon', 'Cordon_Admin::validate_options');
    add_settings_section('cordon_activation_options', '', 'Cordon_Admin::activation_options', 'cordon');

    add_settings_field('cordon_enabled', 'Use Cordon?', 'Cordon_Admin::activation_checkbox', 'cordon', 'cordon_activation_options');
    add_settings_field('cordon_offsite_domain', 'Off-site URL', 'Cordon_Admin::offsite_domain_string', 'cordon', 'cordon_activation_options');
  }


  /**
   * 
   */
  public static function validate_options($input)
  {
    $output = array();

    $output['enabled'] = ($input['enabled'] == 'true') ? true : false;
    $output['offsite_domain'] = $input['offsite_domain'];

    return $output;
  }


  /**
   * 
   */
  public static function activation_options()
  {
    // Text here
  }


  /**
   * 
   */
  public static function activation_checkbox()
  {
    echo '<input type="checkbox" id="cordon_enabled" name="cordon[enabled]" value="true"';
    if (self::$_options['enabled'] == true) echo ' checked="checked"';
    echo ' />';
  }


  /**
   * 
   */
  public static function offsite_domain_string()
  {
    echo '<input type="text" id="cordon_offsite_domain" name="cordon[offsite_domain]" value="' . self::$_options['offsite_domain'] . '" />';
  }


  /**
   * 
   */
  public static function options_page()
  { require_once 'settings.php'; }

}
