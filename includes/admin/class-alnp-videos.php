<?php
/**
 * Auto Load Next Post Videos class
 *
 * Displays Videos available to help users know how to use Auto Load Next Post.
 *
 * @since    1.6.0
 * @author   Sébastien Dumont
 * @category Classes
 * @package  Auto Load Next Post/Classes/Videos
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Auto_Load_Next_Post_Videos' ) ) {

	class Auto_Load_Next_Post_Videos {

		/**
		 * Videos Var
		 * 
		 * @access public
		 * @static
		 */
		public static $videos;

		/**
		 * Initialize Videos.
		 *
		 * @access public
		 */
		public function __construct() {
			$this->id    = 'videos';
			$this->label = esc_html__( 'Videos', 'auto-load-next-post' );

			// Below are the Videos hosted on YouTube.com
			self::$videos = array(
				array(
					'video_id' => '4Noj5RaaR9g',
					'title'    => esc_html__( 'The Last of Us Part 2 PS4 Ellie Dynamic Theme', 'auto-load-next-post' )
				),
				array(
					'video_id' => 'euBlNq5kda0',
					'title'    => esc_html__( 'PlayStation 4 Pro Teardown', 'auto-load-next-post' )
				),
			);

			add_filter( 'auto_load_next_post_settings_tabs_array', array( $this, 'add_videos_page' ), 99 );
			add_action( 'auto_load_next_post_settings_end', array( $this, 'output' ), 10, 2 );
		} // END __construct()

		/**
		 * Add the videos page to the settings.
		 *
		 * @access public
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_videos_page( $pages ) {
			$pages[$this->id] = $this->label;

			return $pages;
		} // END add_videos_page()

		/**
		 * Output the videos.
		 * 
		 * @access public
		 * @param string $current_tab
		 * @param array  $tabs
		 */
		public function output( $current_tab, $tabs ) {
			if ( $current_tab !== 'videos' ) {
				return;
			}

			// Display settings tabs.
			$tab_exists        = isset( $tabs[ $current_tab ] ) || has_action( 'auto_load_next_post_sections_' . $current_tab ) || has_action( 'auto_load_next_post_settings_' . $current_tab ) || has_action( 'auto_load_next_post_settings_tabs_' . $current_tab );
			$current_tab_label = isset( $tabs[ $current_tab ] ) ? $tabs[ $current_tab ] : '';
			?>
			<div class="wrap auto-load-next-post">
				<nav class="nav-tab-wrapper">
					<?php
					foreach ( $tabs as $slug => $label ) {
						echo '<a href="' . esc_html( admin_url( 'options-general.php?page=auto-load-next-post-settings&tab=' . esc_attr( $slug ) ) ) . '" class="nav-tab ' . ( $current_tab === $slug ? 'nav-tab-active' : '' ) . '">' . esc_html( $label ) . '</a>';
					}

					do_action( 'auto_load_next_post_settings_tabs' );
					?>
				</nav>
				<h1 class="screen-reader-text"><?php echo esc_html( $current_tab_label ); ?></h1>
			</div>

			<style type="text/css">
				
			</style>

			<div class="alnp-video-container">
				<?php foreach( self::$videos as $video ) { ?>
					<div class="alnp-video">
						<a href="https://www.youtube.com/watch?v=<?php echo $video['video_id']; ?>" target="_blank">
							<img src="https://i.ytimg.com/vi/<?php echo $video['video_id']; ?>/hqdefault.jpg" alt="<?php echo $video['title']; ?>" />
						</a>
					</div>
				<?php
				} // END foreach()
				?>
			</div>
			<?php
		} // END output()

	} // END class

} // END if class

return new Auto_Load_Next_Post_Videos();