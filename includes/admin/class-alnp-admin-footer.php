<?php
/**
 * Auto Load Next Post - Admin Footer.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Admin_Footer' ) ) {

	class ALNP_Admin_Footer {

		/**
		 * Constructor
		 *
		 * @access  public
		 */
		public function __construct() {
			add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 15, 1 );
			add_filter( 'update_footer', array( $this, 'update_footer'), 15 );
		} // END __construct()

		/**
		 * Filters the admin footer text by placing simply thank you to those who
		 * like and review the plugin on WordPress.org when viewing 
		 * Auto Load Next Post settings page.
		 *
		 * @access public
		 * @param  string $text text to be rendered in the footer.
		 * @return string $text
		 */
		public function admin_footer_text( $text ) {
			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			if ( $screen_id == 'settings_page_auto-load-next-post' ) {
				// Rating and Review
				$text = sprintf(
					/* translators: 1: Auto Load Next Post 2:: five stars */
					__( 'If you like %1$s, please leave a %2$s rating. A huge thank you in advance!', 'auto-load-next-post' ),
					sprintf( '<strong>%1$s</strong>', esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
					'<a href="' . AUTO_LOAD_NEXT_POST_REVIEW_URL . '?rate=5#new-post" target="_blank" aria-label="' . esc_attr__( 'five star', 'auto-load-next-post' ) . '" data-rated="' . esc_attr__( 'Thanks :)', 'auto-load-next-post' ) . '">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
				);
			}

			return $text;
		} // END admin_footer_text()

		/**
		 * Filters the update footer by placing the version of the plugin
		 * when viewing Auto Load Next Post settings page.
		 *
		 * @access public
		 * @param  string $text
		 * @return string $text
		 */
		public function update_footer( $text ) {
			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';

			if ( $screen_id == 'settings_page_auto-load-next-post' ) {
				return sprintf( __( '%s Version', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . ' ' . esc_attr( AUTO_LOAD_NEXT_POST_VERSION );
			}

			return $text;
		} // END update_footer()

	} // END class

} // END if class exists

return new ALNP_Admin_Footer();
