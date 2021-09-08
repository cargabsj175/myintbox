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
