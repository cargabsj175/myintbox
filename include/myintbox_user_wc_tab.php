<?php
// myintbox_user_wc_tab.php: Crea pestaña con la info del buzon en perfil de usuario

// Nota: Actualizar Permalinks o tendra error 404

function myintbox_add_info_settings_endpoint() {
    add_rewrite_endpoint( 'mailbox-info', EP_ROOT | EP_PAGES );
}
 
add_action( 'init', 'myintbox_add_info_settings_endpoint' );
 
 
// ------------------
// 2. Add new query var
 
function myintbox_settings_query_vars( $vars ) {
    $vars[] = 'mailbox-info';
    return $vars;
}
 
add_filter( 'query_vars', 'myintbox_settings_query_vars', 0 );
 
 
// ------------------
// 3. Insert the new endpoint into the My Account menu
 
function myintbox_add_info_settings_link_my_account( $items ) {
    $items['mailbox-info'] = __('Mailbox Info', 'myintbox' );
    return $items;
}
 
add_filter( 'woocommerce_account_menu_items', 'myintbox_add_info_settings_link_my_account' );
 
 
// ------------------
// 4. Add content to the new endpoint
 
function myintbox_settings_content() {
global $wpdb;	
// Llamamos a las configuraciones del panel
// 
$my_international_mailbox_options = get_option( 'my_international_mailbox_option_name' ); // Array of All Options
$your_company_0 = $my_international_mailbox_options['your_company_0']; // Your Company
$address_mailbox_1 = $my_international_mailbox_options['address_mailbox_1']; // Address Mailbox
$aditional_info_2 = $my_international_mailbox_options['aditional_info_2']; // Aditional Info
$country_3 = $my_international_mailbox_options['country_3']; // Country
// obtener valores de usuario
global $current_user;
get_currentuserinfo();
$random_number = $current_user->random_number;

echo "<h3>". $your_company_0, __(' Mailbox Info', 'myintbox' )."</h3>";

echo "<h5>".__('General Info:', 'myintbox' )."</h5>";
echo 'Dirección: '.$address_mailbox_1.'</br>';
echo 'Información Adicional: '.$aditional_info_2.'</br>';

echo "<h5>".__('Personal Info:', 'myintbox' )."</h5>";
echo ''.$your_company_0.' ID: <strong>'.$random_number.'</strong></br>';
}

add_action( 'woocommerce_account_mailbox-info_endpoint', 'myintbox_settings_content' );
// Note: add_action must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format
