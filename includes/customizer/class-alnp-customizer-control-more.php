<?php
/**
 * Class to create a Customizer control for displaying information.
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post
 * @since   1.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The 'more' Auto Load Next Post control class
 */
class More_ALNP_Control extends WP_Customize_Control {

	/**
	 * Render the content on the theme customizer page.
	 */
	public function render_content() {
		?>
		<label style="overflow: hidden; zoom: 1;">

			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

			<p>
				<?php printf( esc_html__( 'There\'s a range of %s extensions coming soon to put additional power in your hands. %sSign up for the newsletter%s to be kept in the loop on what is to come.', 'auto-load-next-post' ), 'Auto Load Next Post', '<a href="#" target="_blank">', '</a>' ); ?>
			</p>

			<span class="customize-control-title"><?php printf( esc_html__( 'Enjoying %s?', 'auto-load-next-post' ), 'Auto Load Next Post' ); ?></span>

			<p>
				<?php printf( esc_html__( 'Why not leave me a review on %sWordPress.org%s?  I\'d really appreciate it!', 'auto-load-next-post' ), '<a href="https://wordpress.org/support/view/plugin-reviews/auto-load-next-post?rate=5#postform" target="_blank">', '</a>' ); ?>
			</p>

		</label>
		<?php
	}
}
