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
class Block_Icons_Notices
{

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	/**
	 * Display admin notice.
	 */
	function display_admin_notice()
	{

		if ( get_option( 'block_icons_active_notices_option', false ) ) :
?>
		<div class="notice notice-success notice-block-icons is-dismissible">
			<h2><?php esc_html_e("Hi there! Thank you for installing the Block Icons Google Plugin!", 'block-icons-google'); ?></h2>
			<p><?php esc_html_e('We hope this plugin is beneficial for many people.', 'block-icons-google'); ?></p>
			<p><?php esc_html_e('For usage instructions, please refer to the Usage Guide .', 'block-icons-google'); ?></p>
			<div class="box-btn">
				<a href="https://www.upwork.com/freelancers/~01559dc6ef8a329c82" class="hire-developer" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
						<path d="M320-240 80-480l240-240 57 57-184 184 183 183-56 56Zm320 0-57-57 184-184-183-183 56-56 240 240-240 240Z"></path>
					</svg>
					<?php esc_html_e('Hire Developer!', 'block-icons-google'); ?>
				</a>				
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=block-icons-google' ) ); ?>" class="usage-guide">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
						<path d="M320-240h320v-80H320v80Zm0-160h320v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
					</svg>
					</svg>
					<?php esc_html_e('Usage Guide ', 'block-icons-google'); ?>
				</a>
			</div>
		</div>
<?php
		endif;
	}

	/**
	 * Callback function for AJAX to dismiss admin notices and set a cookie.
	 */
	function dismiss_notice_ajax_callback()
	{
		// Security check: Ensure nonce is valid.
		check_ajax_referer( 'block-icons-ajax-verification', 'mynonce' );

		// Deleted acive notices option
		if ( get_option( 'block_icons_active_notices_option', false ) ) {
			delete_option( 'block_icons_active_notices_option' );

			// Terminate the AJAX request.
			wp_send_json(array('success' => true));
		}

		wp_die();
	}

	/**
	 * Hide all notifications only on specific pages.
	 */
	public function disable_admin_notices_on_specific_pages()
	{
		global $plugin_page;

		// Check if the current page is in the WordPress admin area
		if (is_admin()) {
			if ('block-icons-google' === $plugin_page) {
				remove_all_actions('admin_notices');
			}
		}
	}
}
