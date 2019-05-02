<?php
/**
 * Auto Load Next Post Getting Started class
 *
 * Thanks the user for choosing Auto Load Next Post.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Getting Started
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Getting_Started' ) ) {

	class ALNP_Getting_Started {

		/**
		 * Initialize Getting Started.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'getting-started';
			$this->label = esc_html__( 'Getting Started', 'auto-load-next-post' );

			add_action( 'auto_load_next_post_settings_end', array( $this, 'output' ), 10, 2 );
		} // END __construct()

		/**
		 * Output the getting started page.
		 * 
		 * @access public
		 * @param string $current_view
		 */
		public function output( $current_view ) {
			if ( $current_view !== 'getting-started' ) {
				return;
			}

			// Get active theme
			$active_theme = wp_get_theme();
			?>
			<div class="wrap auto-load-next-post getting-started">

				<div class="container">

					<div class="content">
						<div class="logo">
							<a href="https://autoloadnextpost.com/" target="_blank">
								<img src="<?php echo AUTO_LOAD_NEXT_POST_URL_PATH . '/assets/images/logo.png'; ?>" alt="<?php esc_html_e( 'Auto Load Next Post', 'auto-load-next-post' ); ?>" />
							</a>
						</div>

						<h1><?php printf( __( 'Getting started with %s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></h1>

						<p><strong><?php echo esc_html__( 'Thanks for choosing Auto Load Next Post.', 'auto-load-next-post' ); ?></strong></p>

						<p><?php echo esc_html__( 'Your well on your way to increasing your pageviews by engaging your site viewers to keep reading your content and reduce bounce rate.', 'auto-load-next-post' ); ?></p>

						<?php
						// Is Theme already supported?
						if ( is_alnp_supported() ) {
						?>
							<p><?php echo sprintf( __( 'Your active theme %1$s supports %2$s so everything is already setup for you.', 'auto-load-next-post' ), '<strong>' . $active_theme->name . '</strong>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></p>
						<?php
						} else {
						?>
							<p><?php echo sprintf( __( 'To help you setup %1$s, run the %2$s or %3$s if you are developing a theme and want to add support for %1$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), esc_html__( 'Setup Wizard', 'auto-load-next-post' ), esc_html__( 'View Documentation', 'auto-load-next-post' ) ); ?></p>

							<p style="text-align: center;">
								<a class="button button-primary button-large" href="<?php echo add_query_arg( array( 'page' => 'auto-load-next-post', 'view' => 'setup-wizard' ), admin_url( 'options-general.php' ) ); ?>"><?php _e( 'Setup Wizard', 'auto-load-next-post' ); ?></a>
								<a class="button button-large" href="<?php echo AUTO_LOAD_NEXT_POST_DOCUMENTATION_URL; ?>"><?php _e( 'View Documentation', 'auto-load-next-post' ); ?></a>
							</p>

							<hr>
							<?php
						}

						/**
						 * Display content depending on if you have Auto Load Next Post Pro installed or not.
						 */
						if ( ! is_alnp_pro_version_installed() ) {
							include( dirname( __FILE__ ) . '/views/html-getting-started.php' );
						} else {
							include( dirname( __FILE__ ) . '/views/html-getting-started-pro.php' );
						}
						?>

						<p><?php echo sprintf(
							/* translators: 1: Opening <a> tag to the Auto Load Next Post Twitter account, 2: Opening <a> tag to the Auto Load Next Post Instagram account, 3: Opening <a> tag to the Auto Load Next Post contact page, 4: Opening <a> tag to the Auto Load Next Post newsletter, 5: Closing </a> tag */
							esc_html__( 'If you have any questions or feedback, let me know on %1$sTwitter%5$s, %2$sInstagram%5$s or via the %3$sContact page%5$s. Also, %4$ssubscribe to my newsletter%5$s if you want to stay up to date with what\'s new and upcoming in Auto Load Next Post.', 'auto-load-next-post' ), '<a href="https://twitter.com/autoloadnxtpost" target="_blank">', '<a href="https://instagram.com/autoloadnextpost" target="_blank">', '<a href="https://autoloadnextpost.com/contact/" target="_blank">', '<a href="http://eepurl.com/bvLz2H" target="_blank">', '</a>'
						);
						?></p>

						<p><?php echo esc_html__( 'Enjoy!', 'auto-load-next-post' ); ?></p>
					</div>

				</div>

			</div>
		<?php
		} // END output()

	} // END class

} // END if class

return new ALNP_Getting_Started();