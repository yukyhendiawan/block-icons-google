<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://yukyhendiawan.com
 * @since             1.0.0
 * @package           Block_Icons
 *
 * @wordpress-plugin
 * Plugin Name:       Block Icons: Google Library Collection
 * Plugin URI:        https://yukyhendiawan.com
 * Description:       Block Icons: Google Library Collection is a Gutenberg plugin specifically designed to effortlessly showcase a collection of Google icons. With this plugin, you can seamlessly add and customize Google icons directly through the Gutenberg blocks.
 * Version:           1.2.5
 * Author:            Yuky Hendiawan
 * Author URI:        https://yukyhendiawan.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       block-icons-google
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
define( 'BLOCK_ICONS_NAME', 'Block Icons Google' );
define( 'BLOCK_ICONS_VERSION', '1.2.5' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-block-icons-activator.php
 */
function block_icons_activate() {
    add_option( 'block_icons_redirect_after_activation_option', true );
    add_option( 'block_icons_active_notices_option', true );
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-block-icons-activator.php';
	Block_Icons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-block-icons-deactivator.php
 */
function block_icons_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-block-icons-deactivator.php';
	Block_Icons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'block_icons_activate' );
register_deactivation_hook( __FILE__, 'block_icons_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-block-icons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function block_icons_run() {

	$plugin = new Block_Icons();
	$plugin->run();

}
block_icons_run();
