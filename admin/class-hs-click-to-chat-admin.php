<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://homescriptone.com
 * @since      1.0.0
 *
 * @package    Hs_Click_To_Chat
 * @subpackage Hs_Click_To_Chat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hs_Click_To_Chat
 * @subpackage Hs_Click_To_Chat/admin
 * @author     Homescriptone Solutions <hello@homescriptone.com>
 */
class Hs_Click_To_Chat_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	private $saved_option;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
		$this->saved_option = get_option( 'hs_click_to_chat' );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hs_Click_To_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hs_Click_To_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hs-click-to-chat-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-phone-validator', plugin_dir_url( __FILE__ ) . 'css/jquery-phone-validator.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Hs_Click_To_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Hs_Click_To_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
			$this->plugin_name . '-phone-validator',
			plugin_dir_url( __FILE__ ) . 'js/jquery-phone-validator.js',
			array(
				'jquery',
				'jquery-ui-tooltip',
			),
			$this->version,
			false
		);

		wp_enqueue_script(
			$this->plugin_name . '-phone-validator-utils',
			plugin_dir_url( __FILE__ ) . 'js/jquery-phone-validator-utils.js',
			array(
				'jquery',
				'jquery-ui-tooltip',
			),
			$this->version,
			false
		);

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hs-click-to-chat-admin.js', array( 'jquery' ), $this->version, false );

		$hs_chat_object['utils_path'] = plugin_dir_url( __FILE__ ) . 'js/jquery-phone-validator-utils.js';
		$hs_chat_object['country_code'] = $this->saved_option['country-code'] ?? 'us';
		wp_localize_script(
			$this->plugin_name,
			'hs_chat_object',
			$hs_chat_object
		);

	}

	/**
	 * Add menu into the WP Dashboard.
	 *
	 * @return void
	 */
	public function add_menu() {

		add_menu_page(
			__( 'Click To Chat', 'hs-click-to-chat' ),
			__( 'Click To Chat', 'hs-click-to-chat' ),
			'manage_options',
			'hs-click-to-chat',
			array( $this, 'get_main_menu_field' ),
			'dashicons-format-chat',
			50
		);
	}


	public function get_main_menu_field() {
		settings_errors();
		formulus_format_fields( '<form method="post" action="options.php">' );
		settings_fields( 'hs_click_to_chat' );
		do_settings_sections( 'hs_click_to_chat' );
		do_action( 'hs_click_to_chat' );
		submit_button();
		formulus_format_fields( '</form>' );
	}



	public function get_display_page() {
		add_settings_section(
			'hs_click_to_chat_page',
			esc_html__( 'Click To Chat', 'hs-click-to-chat' ),
			null,
			'hs_click_to_chat'
		);

		add_settings_field(
			'hs_click_to_chat_enable',
			esc_html__( 'Display the widget :', 'hs-click-to-chat' ),
			array( $this, 'get_enable_fields' ),
			'hs_click_to_chat',
			'hs_click_to_chat_page',
			array(
				'class' => 'hs-click-to-chat-message',
			)
		);

		add_settings_field(
			'hs_click_to_chat_apps',
			esc_html__( 'Apps :', 'hs-click-to-chat' ),
			array( $this, 'get_app_fields' ),
			'hs_click_to_chat',
			'hs_click_to_chat_page',
			array(
				'class' => 'hs-click-to-chat-message',
			)
		);

		add_settings_field(
			'hs_click_to_chat_message',
			esc_html__( 'Message :', 'hs-click-to-chat' ),
			array( $this, 'get_message_field' ),
			'hs_click_to_chat',
			'hs_click_to_chat_page',
			array(
				'class' => 'hs-click-to-chat-message',
			)
		);

		add_settings_field(
			'hs_click_to_chat_phone_number',
			esc_html__( 'Phone Number :', 'hs-click-to-chat' ),
			array( $this, 'get_phone_number_field' ),
			'hs_click_to_chat',
			'hs_click_to_chat_page',
			array(
				'class' => 'hs-click-to-chat-phone-number',
			)
		);

		add_settings_field(
			'hs_click_to_chat_widget_pilot',
			esc_html__( 'Widget Position :', 'hs-click-to-chat' ),
			array( $this, 'get_position_field' ),
			'hs_click_to_chat',
			'hs_click_to_chat_page',
			array(
				'class' => 'hs-click-to-chat-widget-pilot',
			)
		);

		do_action( 'hs_click_to_chat_settings_field' );

		register_setting(
			'hs_click_to_chat',
			'hs_click_to_chat'
		);
	}

	public function get_message_field() {
		formulus_input_fields(
			'hs_click_to_chat[messenger]',
			array(
				'type'        => 'textarea',
				'description' => esc_html__( 'Define the default message, to send when using the Click To Chat widget.', 'hs-click-to-chat' ),
				'input_class' => array(
					'textarea',
				),
			),
			esc_attr( $this->saved_option['messenger'] ) ?? ''
		);
	}

	public function get_position_field() {

		formulus_input_fields(
			'hs_click_to_chat[widget-position]',
			array(
				'type'        => 'select',
				'description' => esc_html__( 'Choose the position where the widget will be displayed.', 'hs-click-to-chat' ),
				'options'     => array(
					'left'  => esc_html__( 'Left', 'hs-click-to-chat' ),
					'right' => esc_html__( 'Right', 'hs-click-to-chat' ),
				),
				'input_class' => array(
					'form-input',
				),
			),
			esc_attr( $this->saved_option['widget-position'] ) ?? 'left'
		);
	}

	public function get_phone_number_field() {
		formulus_format_fields( "<input type='hidden' name='hs_click_to_chat[country-code]' value='".$this->saved_option['country-code']."' />" );
	
		formulus_input_fields(
			'hs_click_to_chat[pn]',
			array(
				'type'        => 'text',
				'id'          => 'hs_click_to_chat_pn',
				'description' => esc_html__( 'Define the phone number, where you can be contacted', 'hs-click-to-chat' ),
			),
			esc_attr( $this->saved_option['pn'] ) ?? ''
		);
	}


	public function get_app_fields() {
		formulus_input_fields(
			'hs_click_to_chat[apps]',
			array(
				'type'        => 'select',
				'description' => esc_html__( 'Choose the application to use for the Click To Chat widget.', 'hs-click-to-chat' ),
				'options'     => array(
					'whatsapp' => esc_html__( 'WhatsApp / WhatsApp Business', 'hs-click-to-chat' ),
				),
			),
			esc_attr( $this->saved_option['apps'] ) ?? 'whatsapp'
		);
	}

	public function get_enable_fields() {
		formulus_input_fields(
			'hs_click_to_chat[enable]',
			array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Yes / No :', 'hs-click-to-chat' ),
				'description' => esc_html__( 'Display the Click To Chat widget on your website pages.', 'hs-click-to-chat' ),
			),
			esc_attr( $this->saved_option['enable'] ?? 0 )
		);
	}

}
