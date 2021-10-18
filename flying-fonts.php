<?php
/**
 * Plugin Name: Flying Fonts by FlyingPress
 * Plugin URI: https://wordpress.org/plugins/flying-fonts/
 * Description: Remove Google Fonts and Use System Fonts
 * Author: FlyingPress
 * Author URI: https://flying-press.com/
 * Version: 1.0.1
 * Text Domain: flying-fonts
 */

defined('ABSPATH') or die('Bye!');
define('FLYING_FONTS_VERSION', '1.0.1');

function flying_fonts_rewrite_html($html)
{
  $html = preg_replace('/<link.*fonts.googleapis.com.*>/i', '', $html);
  $html = preg_replace('/<link.*fonts.gstatic.com.*>/i', '', $html);
  $style =
    "<style>body{font-family:-apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,'Fira Sans','Droid Sans','Helvetica Neue',sans-serif !important}code{font-family:Menlo,Consolas,Monaco,Liberation Mono,Lucida Console,monospace !important}</style>";
  $html = str_replace('</head>', $style . '</head>', $html);
  return $html;
}

if (!is_admin()) {
  ob_start('flying_fonts_rewrite_html');
}

if (!defined('FLYING_PRESS_VERSION')) {
  add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
    $plugin_shortcuts[] =
      '<a href="https://flying-press.com?ref=flying_fonts" target="_blank" style="color:#3db634;">Get FlyingPress</a>';
    return array_merge($links, $plugin_shortcuts);
  });
}
