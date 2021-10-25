<?php

// myintbox_snippets.php: coloca lo que quieras para personalizar el plugin
// o los elementos de wordpress...
// No rompas nada :P


/**
 * Colocamos Mailbox en segundo lugar en My-Account
 */
function wpb_woo_my_account_order() {
	$myorder = array(
		'dashboard'          => __( 'Dashboard', 'woocommerce' ),
		'mailbox-info' => __( 'Mailbox info', 'myintbox' ),
		'orders'             => __( 'Orders', 'woocommerce' ),
		'edit-address'       => __( 'Addresses', 'woocommerce' ),
		'edit-account'       => __( 'Account details', 'woocommerce' ),
		'downloads'          => __( 'Downloads', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
	);
	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );

/**
 * Correo posterior al registro de usuario.
 */

add_filter( 'wp_new_user_notification_email' , 'edit_user_notification_email', 10, 3 );
function edit_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
	global $wpdb;	
     // Llamamos a las configuraciones del panel
$my_international_mailbox_options = get_option( 'my_international_mailbox_option_name' ); // Array of All Options
$your_company_0 = $my_international_mailbox_options['your_company_0']; // Your Company
$address_mailbox_1 = $my_international_mailbox_options['address_mailbox_1']; // Address Mailbox
$aditional_info_2 = $my_international_mailbox_options['aditional_info_2']; // Aditional Info
// obtener valores de usuario
global $current_user;
get_currentuserinfo();
    $message = sprintf(__( "¡Bienvenido a %s! Aquí tienes tus datos de acceso:" ), $blogname ) . "\r\n";
	$message .= __('Url de acceso: ');
    $message .= wp_login_url() . "\r\n";
    $message .= sprintf(__( 'Usuario: %s' ), $user->user_login ) . "\r\n";
	$message .= sprintf(__( 'E-mail: %s' ), $user->user_email) . "\r\n\r\n";  
	$message .= __('Datos del buzón:') . "\r\n";
    $message .= sprintf(__( 'Dirección del buzón: %s' ), $my_international_mailbox_options['address_mailbox_1'] ) . "\r\n";
    $message .= sprintf(__( 'ID de buzón de Usuario: %s' ), $user->random_number ) . "\r\n\r\n";
	
	$message .= __('Para establecer tu contraseña dirigete a: ');
	$message .= wp_lostpassword_url( home_url() ) . "\r\n";  
	
    $message .= sprintf(__( 'Si tiene algún problema o duda, por favor contáctenos a %s.'), get_option( 'admin_email' ) ) . "\r\n\r\n";
    $message .= __('Copyright © 2021 LatinChina Group. Todos los derechos reservados.');

    $wp_new_user_notification_email['message'] = $message;

    return $wp_new_user_notification_email;

}
