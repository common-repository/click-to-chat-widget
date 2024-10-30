<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://homescriptone.com
 * @since             1.0.0
 * @package           Hs_Click_To_Chat
 *
 * @wordpress-plugin
 * Plugin Name:       Click To Chat Widget
 * Plugin URI:        https://homescriptone.com/plugins/
 * Description:       Click To chat feature is bringed to your wordpress site.
 * Version:           1.0.0
 * Author:            Homescriptone Solutions
 * Author URI:        https://homescriptone.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hs-click-to-chat
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'HS_CLICK_TO_CHAT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hs-click-to-chat-activator.php
 */
function activate_hs_click_to_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hs-click-to-chat-activator.php';
	Hs_Click_To_Chat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hs-click-to-chat-deactivator.php
 */
function deactivate_hs_click_to_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hs-click-to-chat-deactivator.php';
	Hs_Click_To_Chat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hs_click_to_chat' );
register_deactivation_hook( __FILE__, 'deactivate_hs_click_to_chat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hs-click-to-chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hs_click_to_chat() {

	$plugin = new Hs_Click_To_Chat();
	$plugin->run();

}
run_hs_click_to_chat();
