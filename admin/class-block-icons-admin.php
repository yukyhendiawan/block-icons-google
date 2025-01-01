<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://yukyhendiawan.com
 * @since      1.0.0
 *
 * @package    Block_Icons
 * @subpackage Block_Icons/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Block_Icons
 * @subpackage Block_Icons/admin
 * @author     Yuky Hendiawan <yukyhendiawan1998@gmail.com>
 */
class Block_Icons_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		// Enqueue a global admin style.
		wp_enqueue_style( $this->plugin_name . '-admin-global-style', plugins_url() . '/block-icons-google/assets/css/admin-global.min.css', array(), $this->version, 'all' );

		// Conditionally enqueue a specific admin menu style for the information page.
		if ( 'toplevel_page_block-icons-google-information' === $hook ) {
			wp_enqueue_style( $this->plugin_name . '-admin-menu-style', plugins_url( 'block-icons-google' ) . '/assets/css/admin-menu.min.css', array(), $this->version, );			
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		// Admin global.
		wp_enqueue_script( 'block-icons-admin-global', plugins_url() . '/block-icons-google/assets/js/admin-global.min.js', array( 'jquery' ), $this->version, true );

		// Localize admin.
		wp_localize_script(
			'block-icons-admin-global',
			'blockIconsGoogleAdminLocalize',
			array(
				'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
				'ajaxNonce' => wp_create_nonce( 'block-icons-ajax-verification' ),
				'adminUrl'  => esc_url( admin_url() ),
			)
		);

		// Conditionally enqueue a specific admin menu script for the information page.
		if ( 'toplevel_page_block-icons-google-information' === $hook ) {
			// Enqueue the admin JavaScript file with jQuery as a dependency.
			wp_enqueue_script( $this->plugin_name . '-admin-menu-script', plugins_url( 'block-icons-google' ) . '/assets/js/admin-menu.min.js', array(), $this->version, true );		
		}
	}

	/**
	 * Registers a new admin menu page for the plugin.
	 *
	 * This function adds a new top-level menu page to the WordPress admin area.
	 * The menu page displays the 'information.php' template from the plugin's admin/templates directory.
	 *
	 * @since 1.0.0
	 */
	public function admin_menu_page() {
		add_menu_page(
			__( 'Icons Google', 'block-icons-google' ), // Page title.
			__( 'Icons Google', 'block-icons-google' ), // Menu title.
			'manage_options', // Capability required.
			'block-icons-google-information', // Menu slug.
			array( $this, 'template_for_information_menu' ), // Callback function.
			'dashicons-admin-generic', // Icon URL.
			30 // $position.
		);
	}

	/**
	 * Displays the information template for the admin menu page.
	 *
	 * This function defines the path to the 'information.php' template file and includes it if it exists.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function template_for_information_menu() {
		// Define the path to the template file.
		$template_path = BLOCK_ICONS_DIR_PATH . 'admin/templates/information.php';

		// Check if the template file exists.
		if ( file_exists( $template_path ) ) {
			// Include the template file if it exists.
			include $template_path;
		}
	}

	/**
	 * Initializes and registers a custom block type for icons, and sets script translations for internationalization.
	 *
	 * @since    1.0.0
	 */
	public function initialize_block_icons() {
		// Registers the block type using the path to the build directory of the plugin.
		register_block_type( plugin_dir_path( __DIR__ ) . '/build' );

		// Sets script translations for 'block-icons-script' with the 'block-icons-google' domain.
		wp_set_script_translations( 'block-icons-script', 'block-icons-google' );
	}	

	/**
	 * Redirects user after theme/plugin activation if option is set.
	 *
	 * This function checks if the 'block_icons_redirect_after_activation_option' is set to true.
	 * If true, it deletes the option and redirects the user to 'admin.php?page=block-icons-google-information'.
	 */
	public function activation_redirect() {
		// Check if the 'block_icons_redirect_after_activation_option' is set to true
		if ( get_option( 'block_icons_redirect_after_activation_option', false ) ) {
			// Delete the option to prevent redirection on subsequent activations
			delete_option( 'block_icons_redirect_after_activation_option' );

			// Construct the URL
			$redirect_url = admin_url( 'admin.php?page=block-icons-google-information' );

			// Make a GET request to the URL and check the HTTP response code
			$response = wp_remote_get( $redirect_url );

			if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
				// If the response code is 200, redirect the user
				wp_redirect( esc_url( $redirect_url ) );
				exit;
			} else {
				// Handle the error, redirect to another page
				wp_redirect( esc_url( admin_url() ) );
				exit;
			}
		}
	}
}
