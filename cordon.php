<?php
/**
 * @package cordon
 */
/*
Plugin Name: Cordon
Plugin URI: http://mattkirman.com/
Description: An experimental CDN plugin
Version: 0.0.1
Author: Matt Kirman
Author URI: http://mattkirman.com/
Licence: GPLv2
*/

if ( is_admin() )
  require_once dirname(__FILE__) . '/admin.php';

$_options = get_option('cordon');

if ($_options['enabled'] === true) {
  ob_start(function($buffer){
    $host = $_SERVER['HTTP_HOST'];
    $regex = "/http(s?):\/\/($host)\/wp-content\/(.*)\.(css|js|png|jpeg|jpg|gif)/i";

    return preg_replace_callback($regex, function($matches) {
      global $blog_domain;
      $_options = get_option('cordon');

      $file = ABSPATH . 'wp-content/' . $matches[3] . '.' . $matches[4];
      $domain = (!empty($_options['offsite_domain'])) ? $_options['offsite_domain'] : $matches[2];

      return 'http' . $matches[1] . '://' . $domain . '/wp-content/' . $matches[3] . '.' . $matches[4] . '?' . md5_file($file);
    }, $buffer);
  });
}
