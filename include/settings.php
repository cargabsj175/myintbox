<?php
class MyInternationalMailbox {
	private $my_international_mailbox_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'my_international_mailbox_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'my_international_mailbox_page_init' ) );
	}

	public function my_international_mailbox_add_plugin_page() {
		add_menu_page(
			'My international mailbox', // page_title
			'My international mailbox', // menu_title
			'manage_options', // capability
			'my-international-mailbox', // menu_slug
			array( $this, 'my_international_mailbox_create_admin_page' ), // function
			'dashicons-cart', // icon_url
			2 // position
		);
	}

	public function my_international_mailbox_create_admin_page() {
		$this->my_international_mailbox_options = get_option( 'my_international_mailbox_option_name' ); ?>

		<div class="wrap">
			<h2>My international mailbox</h2>
			<p>Configuration options for the international mailbox.</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'my_international_mailbox_option_group' );
					do_settings_sections( 'my-international-mailbox-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function my_international_mailbox_page_init() {
		register_setting(
			'my_international_mailbox_option_group', // option_group
			'my_international_mailbox_option_name', // option_name
			array( $this, 'my_international_mailbox_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'my_international_mailbox_setting_section', // id
			'Settings', // title
			array( $this, 'my_international_mailbox_section_info' ), // callback
			'my-international-mailbox-admin' // page
		);

		add_settings_field(
			'your_company_0', // id
			'Your Company', // title
			array( $this, 'your_company_0_callback' ), // callback
			'my-international-mailbox-admin', // page
			'my_international_mailbox_setting_section' // section
		);

		add_settings_field(
			'address_mailbox_1', // id
			'Address Mailbox', // title
			array( $this, 'address_mailbox_1_callback' ), // callback
			'my-international-mailbox-admin', // page
			'my_international_mailbox_setting_section' // section
		);

		add_settings_field(
			'aditional_info_2', // id
			'Aditional Info', // title
			array( $this, 'aditional_info_2_callback' ), // callback
			'my-international-mailbox-admin', // page
			'my_international_mailbox_setting_section' // section
		);
	}

	public function my_international_mailbox_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['your_company_0'] ) ) {
			$sanitary_values['your_company_0'] = sanitize_text_field( $input['your_company_0'] );
		}

		if ( isset( $input['address_mailbox_1'] ) ) {
			$sanitary_values['address_mailbox_1'] = sanitize_text_field( $input['address_mailbox_1'] );
		}

		if ( isset( $input['aditional_info_2'] ) ) {
			$sanitary_values['aditional_info_2'] = esc_textarea( $input['aditional_info_2'] );
		}

		return $sanitary_values;
	}

	public function my_international_mailbox_section_info() {
		
	}

	public function your_company_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="my_international_mailbox_option_name[your_company_0]" id="your_company_0" value="%s">',
			isset( $this->my_international_mailbox_options['your_company_0'] ) ? esc_attr( $this->my_international_mailbox_options['your_company_0']) : ''
		);
	}

	public function address_mailbox_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="my_international_mailbox_option_name[address_mailbox_1]" id="address_mailbox_1" value="%s">',
			isset( $this->my_international_mailbox_options['address_mailbox_1'] ) ? esc_attr( $this->my_international_mailbox_options['address_mailbox_1']) : ''
		);
	}

	public function aditional_info_2_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="my_international_mailbox_option_name[aditional_info_2]" id="aditional_info_2">%s</textarea>',
			isset( $this->my_international_mailbox_options['aditional_info_2'] ) ? esc_attr( $this->my_international_mailbox_options['aditional_info_2']) : ''
		);
	}

}
if ( is_admin() )
	$my_international_mailbox = new MyInternationalMailbox();

/* 
 * Retrieve this value with:
 * $my_international_mailbox_options = get_option( 'my_international_mailbox_option_name' ); // Array of All Options
 * $your_company_0 = $my_international_mailbox_options['your_company_0']; // Your Company
 * $address_mailbox_1 = $my_international_mailbox_options['address_mailbox_1']; // Address Mailbox
 * $aditional_info_2 = $my_international_mailbox_options['aditional_info_2']; // Aditional Info
 */
