<?php
/**
 * Auto Load Next Post: Theme Customizer Scripts
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Customizer
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if Auto_Load_Next_Post_Customizer_Scripts class already exists.
if ( !class_exists( 'Auto_Load_Next_Post_Customizer_Scripts' ) ) {

	class Auto_Load_Next_Post_Customizer_Scripts {

		/**
		 * Constructor.
		 *
		 * @since  1.5.0
		 * @access public
		 */
		public function __construct() {
			add_action( 'customize_preview_init', array( $this, 'alnp_add_customizer_preview_scripts' ) );
			add_action( 'customize_controls_print_scripts', array( $this, 'alnp_add_scripts' ), 30 );
		}

		/**
		 * Adds script to the previewer to send data to the customizer.
		 *
		 * @since 1.5.0
		 */
		public function alnp_add_customizer_preview_scripts() {
			Auto_Load_Next_Post::load_file( 'alnp-theme-customizer', '/assets/js/customizer/theme-customizer.js', true, array( 'customize-preview' ), '', true );
		} // END alnp_add_customizer_preview_scripts()

		/**
		 * Adds script to help the controls in the customizer.
		 *
		 * @since 1.5.0
		 */
		public function alnp_add_scripts() {
			?>
			<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				'use strict';

				var is_page_single = false; // Is the page the user viewing a single post?

				wp.customize.bind( 'ready', function() {
					wp.customize.previewer.bind( 'alnp_is_page_single', function( data ) {
						is_page_single = data; // Returns response and updates variable.
					} );
				} );

				// Auto Load Next Post Theme Selectors Section.
				wp.customize.section( 'auto_load_next_post_theme_selectors', function( section ) {
					section.expanded.bind( function( isExpanded ) {

						/**
						 * Load a random post if the theme selectors section is expanded
						 * but we are not viewing a single post.
						 */
						if ( isExpanded && !is_page_single ) {
							wp.customize.previewer.previewUrl.set( '<?php echo esc_js( alnp_get_random_page_permalink() ); ?>' );
						}

					} );
				} );
			} );
			</script>
			<?php
		} // END alnp_add_scripts()

	} // END class

} // END if class exists.

new Auto_Load_Next_Post_Customizer_Scripts();
