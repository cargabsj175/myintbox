<?php
// myintbox.php: fichero principal
// Asegurarse que WooCommerce esté activo
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
    return;
/*
Plugin Name: My international mailbox
Plugin URI: https://github.com/cargabsj175/
Description: Convert your website in a international mailbox like libertyexpress
Version: 0.2
Author: Carlos Sanchez
Author URI: https://github.com/cargabsj175/
Text Domain: myintbox
Domain Path: /include/langs
License: GPL3
*/

define('MWC_ROOT', dirname(__FILE__));

function myintbox_load_textdomain() {
load_plugin_textdomain( 'myintbox', false, plugin_basename(dirname(__FILE__)) . '/langs/' );
}

add_action( 'plugins_loaded', 'myintbox_load_textdomain' );

// configs del lado de Woocomerce
require_once MWC_ROOT . '/include/settings.php';
// numero unico por usuario
require_once MWC_ROOT . '/include/user.php';
// snippets o personalizaciones
require_once MWC_ROOT . '/include/myintbox_functions.php';
// configs del lado del Usuario
require_once MWC_ROOT . '/include/myintbox_user_wc_tab.php';

