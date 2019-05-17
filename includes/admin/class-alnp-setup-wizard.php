<?php
/**
 * Auto Load Next Post Setup Wizard class
 *
 * Scans the active theme for theme selectors and single post template.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Setup Wizard
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Setup_Wizard' ) ) {

	class ALNP_Setup_Wizard {

		/**
		 * Initialize Setup Wizard.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'setup-wizard';
			$this->label = esc_html__( 'Setup Wizard', 'auto-load-next-post' );

			add_action( 'auto_load_next_post_settings_end', array( $this, 'output' ), 10, 2 );
		} // END __construct()

		/**
		 * Output the setup wizard.
		 * 
		 * @access public
		 * @param  string $current_view
		 */
		public function output( $current_view ) {
			if ( $current_view !== 'setup-wizard' ) {
				return;
			}

			// Get active theme
			$active_theme = wp_get_theme();
			?>
			<div class="wrap auto-load-next-post setup-wizard">

				<div class="container">

					<div class="content">
						<div class="logo">
							<a href="https://autoloadnextpost.com/" target="_blank">
								<img src="<?php echo AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/images/logo.png'; ?>" alt="<?php esc_html_e( 'Auto Load Next Post', 'auto-load-next-post' ); ?>" />
							</a>
						</div><!-- .logo -->

						<h1><?php echo esc_html__( 'Welcome to the Setup Wizard', 'auto-load-next-post' ); ?></h1>

						<?php
						// Stop users from using the Setup Wizard if theme already supports Auto Load Next Post.
						if ( ! isset( $_GET['force-setup'] ) && is_alnp_supported() ) {
							echo '<p>' . sprintf( __( 'Running the Setup Wizard is not required for your active theme %1$s as it already supports %2$s.', 'auto-load-next-post' ), '<strong>' . $active_theme->name . '</strong>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>';

							echo '<p style="text-align: center;"><a href="' . add_query_arg( array( 'page' => 'auto-load-next-post' ), admin_url( 'options-general.php' ) ) . '" class="button button-primary button-large" aria-label="' . sprintf( esc_attr__( 'View %s settings', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '">' . esc_html__( 'View Settings', 'auto-load-next-post' ) . '</a></p>';
						} else {
						?>
						<div class="box enter show-box">
							<p><?php _e( 'The setup wizard will scan a random post on your site and identify your theme\'s selectors matching those that are known and used in many different themes. It will also look for the directory within the theme for where the theme content loops are stored.', 'auto-load-next-post' ); ?></p>

							<p><?php _e( 'Once found, they will be set for you once the scan is complete.', 'auto-load-next-post' ); ?></p>

							<p><?php _e( 'So let\'s get started.', 'auto-load-next-post' ); ?></p>

							<p class="small red"><i><?php echo sprintf( esc_html__( 'Please note that the setup wizard is not full proof and some manual work maybe required depending on the results. If you have %1$sWP_DEBUG%2$s enabled then results on what was found will be displayed to you.', 'auto-load-next-post' ), '<strong>', '</strong>' ); ?></i></p>

							<p style="text-align: center;">
								<a class="button button-primary button-large scan-button" href="#" data-step="template-location"><?php _e( 'Start', 'auto-load-next-post' ); ?></a>
							</p>

							<div class="meter blue animate" style="display:none;">
								<span style="width: 100%"><span></span></span>
							</div>
						</div><!-- .box.enter -->

						<div class="box template-location-results">
							<h2><?php _e( 'Setup Wizard: Template Location', 'auto-load-next-post' ); ?></h2>

							<p class="template-found"><?php printf( __( '%s has detected the template location and has set it for you. Please continue the wizard to scan for theme selectors next.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>

							<p class="no-template-found"><?php printf( __( 'Setup Wizard was not able to locate your template location for this theme. This is likely because the theme is using either a directory or filename that %s does not recognise.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>

							<p class="no-template-found"><?php printf( __( 'A fallback template will be used instead. To fully support %s with this theme, view the repeater template override guide in the documentation.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>

							<?php
							/**
							 * Displays the theme template location if WP_DEBUG is enabled.
							 */
							if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
							?>
							<p class="template-location debug-mode">
								<strong class="red"><?php _e( 'Developers:', 'auto-load-next-post' ); ?></strong> <?php echo sprintf( __( 'You can %1$sapply a filter to set the template location%2$s with the found directory for your theme.', 'auto-load-next-post' ), '<a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/filter-hooks.md#filter-alnp_template_location" target="_blank">', '</a>' ); ?>
							</p>

							<p><?php _e( 'Copy:', 'auto-load-next-post' ); ?> <i class="bold copy"><span class="location">*</span></i></p>
							<?php } ?>

							<hr>

							<p style="text-align: center;">
								<a class="button button-primary button-large scan-button" href="#" data-step="theme-selectors"><?php _e( 'Continue', 'auto-load-next-post' ); ?></a>
								<a class="button button-large button-doc" href="<?php echo esc_url( 'https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/repeater-template.md#repeater-template' ); ?>" target="_blank"><?php _e( 'Documentation', 'auto-load-next-post' ); ?></a>
							</p>

							<div class="meter blue animate" style="display:none;">
								<span style="width: 100%"><span></span></span>
							</div><!-- .meter -->
						</div><!-- .box.template-location-results -->

						<div class="box theme-selector-results">
							<h2><?php _e( 'Setup Wizard: Theme Selectors', 'auto-load-next-post' ); ?></h2>

							<?php
							/**
							 * Displays the theme selector results if WP_DEBUG is enabled.
							 */
							if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
							?>
							<div class="theme-selectors debug-mode">
								<p><?php _e( 'If any selector was not found, click on the help icon next to the result for more details.', 'auto-load-next-post' ); ?></p>

								<p><strong><?php _e( 'Post scanned:', 'auto-load-next-post' ); ?></strong> <i><span class="post-tested">*</span></i></p>

								<div class="selectors left">
									<span class="bold"><?php _e( 'Selector', 'auto-load-next-post' ); ?></span>
									<div class="container pending">
										<span class="selector"><?php _e( 'Content Container', 'auto-load-next-post' ); ?></span>
									</div>
									<div class="title pending">
										<span class="selector"><?php _e( 'Post Title', 'auto-load-next-post' ); ?></span>
									</div>
									<div class="navigation pending">
										<span class="selector"><?php _e( 'Post Navigation', 'auto-load-next-post' ); ?></span>
									</div>
									<div class="comments pending">
										<span class="selector"><?php _e( 'Comments Container', 'auto-load-next-post' ); ?></span>
									</div>
								</div><!-- .selectors -->

								<div class="results-found right">
									<span class="bold"><?php _e( 'Result', 'auto-load-next-post' ); ?></span>
									<div class="container"><span class="result">-</span></div>
									<div class="title"><span class="result">-</span></div>
									<div class="navigation"><span class="result">-</span></div>
									<div class="comments"><span class="result">-</span></div>
								</div><!-- .results-found -->

								<p><strong class="red"><?php _e( 'Developers:', 'auto-load-next-post' ); ?></strong> <?php echo sprintf( __( 'Checkout the %1$sadd theme support guide%2$s to apply these found theme selectors automatically when another user installs your theme with %3$s.', 'auto-load-next-post' ), '<a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/add-theme-support.md#add-theme-support" target="_blank">', '</a>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>

							</div><!-- .debug-mode -->
							<?php } ?>

							<p class="theme-selectors-undetected"><?php printf( esc_html__( 'Setup Wizard was unable to detect some of the theme selectors. You can scan again just to be sure the wizard did not timeout but most likley you will have to manually set them yourself. %1$sFollow the theme selectors guide to find them%2$s.', 'auto-load-next-post' ), '<a href="https://github.com/autoloadnextpost/alnp-documentation/blob/master/en_US/theme-selectors.md#how-to-find-your-theme-selectors" target="_blank">', '</a>' ); ?></p>

							<p class="no-post-navigation"><?php printf( __( 'No post navigation on the scanned post was detected. If this is incorrect, please %1$scontact me%2$s and let me know your site URL address.', 'auto-load-next-post' ), '<a href="https://autoloadnextpost.com/contact/" target="_blank">', '</a>' ); ?></p>

							<p class="setup-complete"><?php printf( __( 'Congratulations, %s is now setup and ready. Further optional options are available via the settings page.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>

							<hr>

							<p style="text-align: center;">
								<button class="button button-large rescan"><?php _e( 'Scan Again?', 'auto-load-next-post' ); ?></button>
								<a class="button button-primary button-large" href="<?php echo add_query_arg( array( 'page' => 'auto-load-next-post', 'view' => 'misc' ), admin_url( 'options-general.php' ) ); ?>"><?php _e( 'View Settings', 'auto-load-next-post' ); ?></a>
							</p>
						</div><!-- .box.theme-selector-results -->
						<?php } ?>

					</div><!-- .content -->

				</div><!-- .container -->

			</div><!-- .wrap -->
			<?php
		} // END output()

	} // END class

} // END if class

return new ALNP_Setup_Wizard();