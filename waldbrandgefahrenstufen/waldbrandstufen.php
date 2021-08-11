<?php
/*
Plugin Name: Waldbrandgefahrenstufen
Plugin URI: http://wbs.niklas-ullmann.de/
Description: Zeigt die Waldbrandgefahrenstufe für jede Stadt in deutschland an und informiert somit die Bevölkerung und kann dadurch präventiv Waldbrände verhindern
Version: 1.0.0
Author: Niklas Ullmann
Author URI: https://niklas-ullmann.de/
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

require_once(plugin_dir_path(__FILE__) . '/includes/waldbrandgefahrenstufen-scripts.php');

require_once(plugin_dir_path(__FILE__) . '/includes/waldbrandgefahrenstufen-class.php');


function wbs_register_wbs_widget()
{
    register_widget("Waldbrandgefahrenstufen_Widget");
}

add_action("widgets_init", "wbs_register_wbs_widget");
