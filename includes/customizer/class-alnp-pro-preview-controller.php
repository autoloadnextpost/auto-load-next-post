<?php
/**
 * Auto Load Next Post: Customizer Controller for Previewing Auto Load Next Post Pro.
 *
 * @see https://developer.wordpress.org/reference/classes/wp_customize_control/
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Customizer
 * @package  Auto Load Next Post/Customizer/Controller
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( !class_exists( 'Auto_Load_Next_Post_Pro_Preview_Controller' ) ) {

	/**
	 * The 'alnp_pro_preview' for Auto Load Next Post Pro control class.
	 */
	class Auto_Load_Next_Post_Pro_Preview_Controller extends WP_Customize_Control {

		/**
		 * The type of customize control.
		 *
		 * @access public
		 * @since  1.5.0
		 * @var    string
		 */
		public $type = 'alnp-pro-preview';

		/**
		 * Render the content on the theme customizer page via PHP.
		 */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo $this->label; ?></span>

			<p>
				<?php printf( esc_html__( '%1$s is coming soon and will come with more powerful features. Here are just a few of them you can look forward to.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post Pro', 'auto-load-next-post' ) ); ?>
			</p>

			<ul style="list-style: disc; margin-left: 1em;">
				<li><?php echo wptexturize( esc_html__( 'Load the Next Post or Next Post with same Category or New Posts or Related Posts or by Custom Query', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Page and Media Attachment Support', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Custom Post Type Support', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Paginated Posts Supported', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Exclude Post Formats', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Limit Posts per Session', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Query Posts by Category and Tag', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Exclude User Roles and Specific Users', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Pre-Query Posts Ready to Load', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Hide Comments and Show by Toggle Button', 'auto-load-next-post' ) ); ?></li>
				<li><?php echo wptexturize( sprintf( esc_html__( 'Multilingual Support for %1$s and %2$s', 'auto-load-next-post' ), 'WPML', 'Polylang' ) ); ?></li>
				<li><?php echo wptexturize( esc_html__( 'Email Support', 'auto-load-next-post' ) ); ?></li>
			</ul>

			<p>
				<?php printf( esc_html__( 'Find out more about %1$s%2$s%3$s.', 'auto-load-next-post'), '<a target="_blank" href="' . esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'pro/?utm_source=wpcustomizer&utm_campaign=plugin-settings-pro-preview' ) . '">', esc_html__( 'Auto Load Next Post Pro', 'auto-load-next-post' ), '</a>' ); ?>
			</p>

			<span class="customize-control-title"><?php printf( esc_html__( 'Add-ons for %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></span>

			<p>
				<?php printf( esc_html__( 'Add-ons available provide additional support or options for %1$s. %2$sCheck out the add-ons%3$s to see what is available.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a target="_blank" href="' . esc_url( AUTO_LOAD_NEXT_POST_STORE_URL . 'add-ons/?utm_source=wpcustomizer&utm_campaign=plugin-settings-pro-preview' ) . '">', '</a>' ); ?>
			</p>

			<span class="customize-control-title"><?php printf( esc_html__( 'Enjoying %s?', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ); ?></span>

			<div class="notice inline notice-info">
				<p>
					<?php printf( esc_html__( 'Why not leave me a review on %1$sWordPress.org%2$s?  I\'d really appreciate it!', 'auto-load-next-post' ), '<a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?filter=5#postform">', '</a>' ); ?>
				</p>
			</div>
			<?php
		} // END render_content()

	} // END class

} // END if class
