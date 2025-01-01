<?php
/**
 * Content template for submenu page.
 *
 * @package     Block_Icons_Google
 * @author      Yuky Hendiawan <yukyhendiawan1998@gmail.com>
 * @since       1.0.0
 */

// Construct the file path of the plugin.
$plugin_file = WP_PLUGIN_DIR . '/block-icons-google/block-icons.php';

// Check if the plugin file exists.
if ( file_exists( $plugin_file ) ) {
	// Include the necessary WordPress file for plugin data retrieval.
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	// Retrieve the plugin data.
	$plugin_info = get_plugin_data( $plugin_file );

	// Extract relevant plugin information.
	$plugin_name        = $plugin_info['Name'];
	$plugin_description = $plugin_info['Description'];
	$plugin_author      = $plugin_info['AuthorName'];
	$plugin_version     = $plugin_info['Version'];

	// Remove <cite> tag from the plugin description.
	$plugin_description = preg_replace( '/<cite.*?<\/cite>/', '', $plugin_description );
	$plugin_description = wp_strip_all_tags( $plugin_description ); // Remove any remaining HTML tags.

} else {
	return;
}
?>

<section class="wrap">
	<!-- Header -->
	<header class="top">
		<div class="mycontainer">
			<div class="myrow">
				<div class="col-left">
					<h2>
						<?php echo esc_html( $plugin_name ); ?>
						<span><?php echo esc_html( $plugin_version ); ?></span>
					</h2>
					<p><?php echo esc_html( $plugin_description ); ?></p>
				</div>
				<div class="col-right" style="display: none;">
					<a href="#" class="support">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 48C141.1 48 48 141.1 48 256l0 40c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-40C0 114.6 114.6 0 256 0S512 114.6 512 256l0 144.1c0 48.6-39.4 88-88.1 88L313.6 488c-8.3 14.3-23.8 24-41.6 24l-32 0c-26.5 0-48-21.5-48-48s21.5-48 48-48l32 0c17.8 0 33.3 9.7 41.6 24l110.4 .1c22.1 0 40-17.9 40-40L464 256c0-114.9-93.1-208-208-208zM144 208l16 0c17.7 0 32 14.3 32 32l0 112c0 17.7-14.3 32-32 32l-16 0c-35.3 0-64-28.7-64-64l0-48c0-35.3 28.7-64 64-64zm224 0c35.3 0 64 28.7 64 64l0 48c0 35.3-28.7 64-64 64l-16 0c-17.7 0-32-14.3-32-32l0-112c0-17.7 14.3-32 32-32l16 0z"/></svg>
						<?php esc_html_e( 'Support', 'block-icons-google' ); ?>
					</a>						
					<a href="#" class="documentation">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
							<path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
						</svg>
						<?php esc_html_e( 'Documentation', 'block-icons-google' ); ?>
					</a>				
					<a href="#" class="buy-plugin-pro">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
							<path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
						</svg>
						<?php esc_html_e( 'Buy Plugin PRO', 'block-icons-google' ); ?>
					</a>
				</div>
			</div>
		</div>
	</header>

	<!-- Navigation tabs -->
	<nav class="tabs">
		<div class="mycontainer">
			<div class="myrow">
				<div class="box-menu">
					<ul>
						<li><a myid="usage-guide" class="active" href="#usage-guide"><?php esc_html_e('Usage Guide ', 'block-icons-google'); ?></a></li>
						<li><a myid="report" href="#report"><?php esc_html_e('Report ', 'block-icons-google'); ?></a></li>
						<li><a myid="changelog" href="#changelog"><?php esc_html_e( 'Changelog ', 'block-icons-google' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

    <!-- Usage Guide -->
    <section class="content usage-guide data-content">
        <div class="mycontainer">
            <div class="myrow">
                <div class="col-left">
                    <h2>
                        <?php
                        esc_html_e('Usage Guide ', 'block-icons-google');
                        ?>
                    </h2>
                    <p><?php esc_html_e('Welcome to our plugin page! With this plugin, you can easily add icons to your content through the Gutenberg Editor. Here are simple steps to get started:', 'block-icons-google'); ?></p>

                    <br />

                    <ol>
                        <li>
                            <strong><?php esc_html_e('Access the Gutenberg Editor:', 'block-icons-google'); ?></strong>
                            <br />
                            <?php esc_html_e('Open your WordPress editor and select or create a post or page using Gutenberg.', 'block-icons-google'); ?>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Go to Gutenberg Media Category Block and Choose an Icons:', 'block-icons-google'); ?></strong>
                            <br />
                            <?php esc_html_e('Locate the "Media Category" option within the Gutenberg block. Choose the "Icons" and select an icon that suits your needs.', 'block-icons-google'); ?>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Click the Icon Library Button:', 'block-icons-google'); ?></strong>
                            <br />
                            <?php esc_html_e('After selecting the icon category, click the "Icon Library" button to open the available icon library.', 'block-icons-google'); ?>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Choose an Icon:', 'block-icons-google'); ?></strong>
                            <br />
                            <?php esc_html_e('Select one icon from the library. Click on the desired icon to choose it.', 'block-icons-google'); ?>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Apply Styles (Optional):', 'block-icons-google'); ?></strong>
                            <br />
                            <?php esc_html_e('If you want to customize the icon style to match your preferences, you can do so after selecting the icon. Choose the style options that complement your page design.', 'block-icons-google'); ?>
                        </li>
                    </ol>
                    <?php
                    $plugin_dir = plugins_url('block-icons-google/');

                    $image_url = $plugin_dir;
                    ?>

                    <p><?php esc_html_e( 'Step 1: Please select the Icon block in the Gutenberg Editor.', 'block-icons-google' ); ?></p>

                    <img class="step" src="<?php echo esc_url($image_url . 'assets/images/step1.png'); ?>" alt="step1">

                    <p><?php esc_html_e( 'Step 2: Click on the Icon Library icon.', 'block-icons-google' ); ?></p>

                    <img class="step" src="<?php echo esc_url($image_url . 'assets/images/step2.png'); ?>" alt="step2">

                    <p><?php esc_html_e( 'Step 3: Choose one of the icons.', 'block-icons-google' ); ?></p>

                    <img class="step" src="<?php echo esc_url($image_url . 'assets/images/step3.png'); ?>" alt="step3">

                    <p><?php esc_html_e( 'Step 4: You can add icon styles (optional).', 'block-icons-google' ); ?></p>

                    <img class="step" src="<?php echo esc_url($image_url . 'assets/images/step4.png'); ?>" alt="step4">

                    <p><?php esc_html_e('Now, you are ready to effortlessly add icons to your content through the Gutenberg Editor. If you have any further questions or need additional assistance, feel free to contact us. Happy creating!"', 'block-icons-google'); ?></p>
                </div>
				<div class="col-right ads">
				<?php
				// Get the full path to the 'sidebar.php' file within the plugin directory.
				$template_path = plugin_dir_path( __FILE__ ) . 'sidebar.php';

				// Check if the 'sidebar.php' file exists at the specified path.
				if ( file_exists( $template_path ) ) {
					// If the file exists, include it in the script execution.
					include $template_path;
				}
				?>
				</div>
            </div>
        </div>
    </section>

    <!-- Bug Report -->
    <section class="content report data-content hide">
        <div class="mycontainer">
            <div class="myrow">
                <div class="col-left">
                    <h2><?php esc_html_e('Bug Report', 'block-icons-google'); ?></h2>
                    <?php
                    $text_report1 = sprintf(
                        /* translators: %s: Theme name */
                        __('If you encounter any bugs or issues while using the Plugin, we encourage you to promptly report them to us. Reporting bugs is a crucial step in ensuring quick updates and fixes, allowing you to continue experiencing optimal performance with our WordPress Plugin.', 'block-icons-google'),
                    );
                    ?>

                    <p><?php echo esc_html($text_report1); ?></p>

                    <br />

                    <p><?php esc_html_e('Below are the steps to report a bug:', 'block-icons-google'); ?></p>

                    <br />

                    <ol>
                        <li>
                            <strong><?php esc_html_e( 'Identify the Bug:', 'block-icons-google' ); ?></strong>
                            <?php esc_html_e('Please try to identify and understand the issue or bug you encounter. Ensure to record details on how the bug manifests and its impact on the use of the Plugin.', 'block-icons-google'); ?>
                        </li>

                        <li>
                            <strong><?php esc_html_e( 'Provide Detailed Explanation:', 'block-icons-google' ); ?></strong>
                            <?php esc_html_e('When reporting the bug to us, offer a clear and detailed explanation of the problem you are facing.', 'block-icons-google'); ?>
                        </li>

                        <li>
                            <strong><?php esc_html_e( 'Report the Bug:', 'block-icons-google' ); ?></strong>
                            <?php echo esc_html__('Kindly report the bug through ', 'block-icons-google'); ?> 
                            <a href="https://wordpress.org/support/plugin/block-icons-google/" target="_blank">
                                <?php esc_html_e('The Block Icons WordPress Plugin forum', 'block-icons-google'); ?>
                            </a> 
                            <?php echo esc_html__(' or via ', 'block-icons-google'); ?>
                            <a href="https://github.com/yukyhendiawan/block-icons-google/issues" target="_blank">
                                <?php esc_html_e('GitHub Issues.', 'block-icons-google'); ?>
                            </a>
                            <?php echo esc_html__('Include the information you have gathered about the bug in your report.', 'block-icons-google'); ?>
                        </li>

                    </ol>

                    <br />

                    <p><?php esc_html_e('Your support and cooperation in reporting the bug are highly appreciated. We will make every effort to address the bug as quickly as possible so that you can continue enjoying the use of the Plugin without disruption.', 'block-icons-google'); ?></p>

                    <br />

                    <p>
                        <?php esc_html_e('Best regards,', 'block-icons-google'); ?> <br />
                        <?php esc_html_e('Yuky Hendiawan', 'block-icons-google'); ?>
                    </p>
                </div>
				<div class="col-right ads">
				<?php
				// Get the full path to the 'sidebar.php' file within the plugin directory.
				$template_path = plugin_dir_path( __FILE__ ) . 'sidebar.php';

				// Check if the 'sidebar.php' file exists at the specified path.
				if ( file_exists( $template_path ) ) {
					// If the file exists, include it in the script execution.
					include $template_path;
				}
				?>
				</div>
            </div>
        </div>
    </section>	

	<!-- Changelog -->
	<section class="changelog data-content hide">
		<div class="mycontainer">
			<div class="myrow">
				<div class="col-left">
					<h2><?php esc_html_e( 'Changelog', 'block-icons-google' ); ?></h2>
					<div class="changelog-info">
						<ul>
							<li>
								<span class="feat"></span>
								<?php esc_html_e( 'Features', 'block-icons-google' ); ?>
							</li>
							<li>
								<span class="fix"></span>
								<?php esc_html_e( 'Bug Fixes', 'block-icons-google' ); ?>
							</li>
							<li>
								<span class="docs"></span>
								<?php esc_html_e( 'Documentation', 'block-icons-google' ); ?>
							</li>
							<li>
								<span class="style"></span>
								<?php esc_html_e( 'Styles', 'block-icons-google' ); ?>
							</li>
							<li>
								<span class="refactor"></span>
								<?php esc_html_e( 'Code Refactoring', 'block-icons-google' ); ?>
							</li>
							<li>
								<span class="perf"></span>
								<?php esc_html_e( 'Performance Improvements', 'block-icons-google' ); ?>
							</li>
						</ul>
					</div>
					<div class="changelog-list">
					<?php
					// GitHub API URL to get the list of releases.
					$api_url = 'https://api.github.com/repos/yukyhendiawan/block-icons-google/releases';

					// Set arguments for wp_remote_get.
					$args = array(
						'user-agent' => 'PHP-Curl-Client',
						'sslverify'  => false, // Disable SSL verification for development.
					);

					// Make the API request.
					$response = wp_remote_get( $api_url, $args );

					// Check for errors.
					if ( is_wp_error( $response ) ) {
						echo esc_html( 'Error: ' . $response->get_error_message() );
					} else {
						// Decode the JSON response into a PHP array.
						$data = json_decode( wp_remote_retrieve_body( $response ), true );

						if ( isset( $data['message'] ) ) {
							?>
							<p class="no-releases-found"><?php esc_html_e( 'No releases found.', 'block-icons-google' ); ?></p>
							<?php
						} else {
							$max_display = 5; // Maximum number of releases to display.
							$displayed   = 0;   // Counter for displayed releases.

							// Loop through each release in the data.
							foreach ( $data as $release ) {
								// Create a DateTime object from the published_at date.
								$release_date = new DateTime( $release['published_at'] );

								// Format the date as "Released on Month Day, Year".
								$formatted_date = $release_date->format( 'F j, Y' );

								// Extract the body content.
								$body           = $release['body'];
								$changelog_list = block_icons_google_extract_changelog_from_body( $body );
								?>
								<section>
									<h2>
										<?php esc_html_e( 'Version: ', 'block-icons-google' ); ?> 
										<?php echo esc_html( $release['tag_name'] ); ?>
										<span>
											<?php esc_html_e( 'Released On ', 'block-icons-google' ); ?>
											<?php echo esc_html( $formatted_date ); ?>
										</span>
									</h2>
									<div class="release">
										<ul>
											<?php foreach ( $changelog_list as $log_item ) : ?>
												<?php if ( 'other' !== $log_item['commit_info'] ) : ?>
													<li>
														<span class="<?php echo esc_attr( $log_item['commit_info'] ); ?>"></span>
														<?php echo wp_kses_post( $log_item['description'] ); ?>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</div>
								</section>
								<?php

								++$displayed;

								if ( $displayed >= $max_display ) {
									break;
								}
							}

							// Check if there are more releases than displayed.
							if ( $displayed >= $max_display ) {
								?>
								<a id="view-all-releases" target="_blank" href="https://github.com/yukyhendiawan/block-icons-google/releases">
									<?php esc_html_e( 'View All Releases', 'block-icons-google' ); ?>
								</a>
								<?php
							}
						}
					}

					/**
					 * Extracts changelog data from a given body of text.
					 *
					 * This function processes the input body of text, which is expected to follow a specific format,
					 * and extracts information about commits, including descriptions, commit hashes, commit URLs,
					 * and commit types (such as 'feat', 'fix', 'docs', etc.).
					 *
					 * @param string $body The body of text containing changelog entries with commit details.
					 * @return array An array of changelog entries, each containing the description, commit hash,
					 *               commit URL, and commit type.
					 */
					function block_icons_google_extract_changelog_from_body( $body ) {

						// Regular expression to match each line starting with '*'.
						preg_match_all( '/\* (.+?) \(\[([a-f0-9]+)\]\(https:\/\/github\.com\/.*\/commit\/([a-f0-9]+)\)\)/', $body, $matches );

						// Convert matches to an array.
						$changelog = array();
						foreach ( $matches[1] as $index => $description ) {
							// Extract commit type (e.g., refactor, feat, fix).
							preg_match( '/^(refactor|feat|fix|chore|docs|style|perf|test):/', $description, $commit_type_matches );
							$commit_info = ! empty( $commit_type_matches ) ? $commit_type_matches[1] : 'other';  // Default to 'other' if not found.

							$changelog[] = array(
								'description' => $description,
								'commit_hash' => $matches[2][ $index ],
								'commit_url'  => 'https://github.com/yukyhendiawan/block-icons-google/commit/' . $matches[3][ $index ],
								'commit_info' => $commit_info,
							);
						}

						return $changelog;
					}
					?>
					</div>
				</div>
				<div class="col-right ads">
				<?php
				// Get the full path to the 'sidebar.php' file within the plugin directory.
				$template_path = plugin_dir_path( __FILE__ ) . 'sidebar.php';

				// Check if the 'sidebar.php' file exists at the specified path.
				if ( file_exists( $template_path ) ) {
					// If the file exists, include it in the script execution.
					include $template_path;
				}
				?>
				</div>
			</div>
		</div>
	</section>
</section>
