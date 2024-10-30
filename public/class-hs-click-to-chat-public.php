<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://homescriptone.com
 * @since      1.0.0
 *
 * @package    Hs_Click_To_Chat
 * @subpackage Hs_Click_To_Chat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hs_Click_To_Chat
 * @subpackage Hs_Click_To_Chat/public
 * @author     Homescriptone Solutions <hello@homescriptone.com>
 */
class Hs_Click_To_Chat_Public {

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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hs-click-to-chat-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hs-click-to-chat-public.js', array( 'jquery' ), $this->version, false );

	}


	public function add_widget() {
		$saved_options = get_option( 'hs_click_to_chat' );

		$enabled = $saved_options['enable'] ?? 0;

		if ( $enabled == 0 ) {
			return;
		}

		$wha_ico_url = plugin_dir_url( __FILE__ ) . 'img/green-icon-with-name.png';
		$elem_css    = 'whatsapp-icon-right';
		if ( isset( $saved_options['widget-position'] ) && $saved_options['widget-position'] == 'left' ) {
			$elem_css = 'whatsapp-icon-left';
		}
		$message              = $saved_options['messenger'];
		$country_code         = $saved_options['country-code'];
		$pn                   = $saved_options['pn'];
		$decoded_country_code = hs_click_to_chat_get_country_town_code( strtoupper( $country_code ) );

		$rpn = hs_click_to_chat_split_space_in_numbers( $decoded_country_code . $pn );

		echo wp_kses_post( '<a href="https://wa.me/' . $rpn . '?text=' . $message . '" target="_blank" class=""><img src="' . $wha_ico_url . '" alt="WhatsApp Icon"  class="hs-click-to-chat-whatsapp-button ' . $elem_css . '"></a>' );
	}



}
