<?php
/**
 * Auto Load Next Post: Theme Customizer
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

class ALNP_Customizer {

	/**
	 * Constructor.
	 *
	 * @since  1.5.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'alnp_init_customizer' ), 50 );
		add_filter( 'customize_loaded_components', array( $this, 'alnp_remove_widgets_panel' ) );
		add_action( 'customize_preview_init', array( $this, 'alnp_add_customizer_preview_scripts' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'add_scripts' ), 30 );
	}

	/**
	 * Initialize the Customizer.
	 *
	 * @access public
	 * @since  1.5.0
	 * @param  WP_Customize_Manager $wp_customize The Customizer object.
	 */
	public function alnp_init_customizer( $wp_customize ) {
		/**
		 * Dont add settings to the customizer if the user does
		 * not have permission to make changes to the theme.
		 */
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		// Auto Load Next Post Panel.
		$panel = array( 'panel' => 'alnp' );

		/**
		 * Add the main panel and sections.
		 *
		 * Only shows if viewing a singular post.
		 */
		$wp_customize->add_panel(
			'alnp', array(
				'title'           => esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ),
				'capability'      => 'edit_theme_options',
				'description'     => esc_html__( 'Auto Load Next Post increases your pageviews by engaging the site viewers to keep reading your content rather than increasing your bounce rate.', 'auto-load-next-post' ),
				'priority'        => 160,
				'active_callback' => array( $this, 'is_page_alnp_ready' )
			)
		);

		// Get the sections.
		$sections = $this->alnp_get_customizer_sections();

		// Add each section.
		foreach( $sections as $section => $args ) {
			/**
			 * If we are not only viewing Auto Load Next Post customizer sections
			 * then move them under our own panel.
			 */
			if ( ! $this->alnp_is_customizer() ) {
				$args = array_merge( $args, $panel );
			}

			$wp_customize->add_section( $section, $args );
		}

		// Get plugin settings.
		$settings = $this->alnp_get_customizer_settings();

		// Add each setting.
		foreach( $settings as $setting => $args ) {
			$wp_customize->add_setting( $setting, $args );
		}

		/**
		 * Let other plugins register extra customizer options for Auto Load Next Post.
		 *
		 * @since 1.5.0
		 * @param WP_Customize_Manager $wp_customize The Customizer object.
		 */
		do_action( 'alnp_customizer_register', $wp_customize );

		$controls = $this->alnp_get_customizer_controls();

		foreach ( $controls as $control => $args ) {
			$wp_customize->add_control( new $args['class']( $wp_customize, $control, $args ) );
		}

		if ( $this->alnp_is_customizer() ) {
			$this->alnp_remove_default_customizer_panels( $wp_customize ); // Remove controls from the customizer.
		}

		// Load custom controllers.
		/*include_once( dirname( __FILE__ ) . '/class-alnp-display-video-controller.php' );

		// Video Help - Coming Soon
		$wp_customize->add_setting( 'alnp_video_theme_selectors', array(
			'default' => '', // The video ID
			'type'    => 'theme_mod',
		) );

		$wp_customize->add_control( new ALNP_Display_Video_Controller( $wp_customize, 'alnp_video_theme_selectors', array(
			'label'    => __( 'Video: How to find your theme selectors', 'auto-load-next-post' ),
			'section'  => 'auto_load_next_post_theme_selectors',
			'settings' => 'alnp_video_theme_selectors',
			'type'     => 'alnp-display-video',
			'priority' => 1,
		) ) );*/

		/**
		 * If Auto Load Next Post Pro is not installed, display a new section
		 * to tell users about the pro version, what comes with it
		 * and link to product page.
		 */
		if ( ! is_alnp_pro_version_installed() ) {
			include_once( dirname( __FILE__ ) . '/class-alnp-pro-preview-controller.php' );

			$preview_args = array(
				'title'    => esc_html__( 'More?', 'auto-load-next-post' ),
				'priority' => 999,
			);

			if ( ! $this->alnp_is_customizer() ) {
				$preview_args = array_merge( $preview_args, $panel );
			}

			$wp_customize->add_section( 'alnp_pro_preview', $preview_args );

			$wp_customize->add_setting( 'alnp_pro_preview', array(
				'default' => null,
			) );

			$wp_customize->add_control( new ALNP_Pro_Preview_Controller( $wp_customize, 'alnp_pro_preview', array(
				'label'    => __( 'Looking for more options?', 'auto-load-next-post' ),
				'section'  => 'alnp_pro_preview',
				'settings' => 'alnp_pro_preview',
				'priority' => 1,
			) ) );
		}
	} // END alnp_init_customizer()

	/**
	 * Removes the core 'Navigation Menu' and 'Widgets' panel from the Customizer.
	 *
	 * @since  1.5.0
	 * @param  array $components Core Customizer components list.
	 * @return array (Maybe) modified components list.
	 */
	public function alnp_remove_widgets_panel( $components ) {
		if ( $this->alnp_is_customizer() ) {
			foreach( $components as $key => $component ) {
				if ( $component == 'widgets' ) unset( $components[ 'widgets' ] );
				if ( $component == 'nav_menus' ) unset( $components[ 'nav_menus' ] );
			}
		}

		return $components;
	}

	/**
	 * Remove any unwanted default conrols.
	 *
	 * @since  1.5.0
	 * @global $wp_cutomize
	 * @param  object $wp_customize
	 * @return boolean
	 */
	public function alnp_remove_default_customizer_panels( $wp_customize ) {
		global $wp_customize;

		$wp_customize->remove_section("themes");
		$wp_customize->remove_control("active_theme");
		$wp_customize->remove_section("title_tagline");
		$wp_customize->remove_section("colors");
		$wp_customize->remove_section("header_image");
		$wp_customize->remove_section("background_image");
		$wp_customize->remove_section("static_front_page");
		$wp_customize->remove_section("custom_css");

		return true;
	} // END alnp_remove_default_customizer_panels()

	/**
	 * Are we looking at the Auto Load Next Post customizer?
	 *
	 * @since  1.5.0
	 * @return boolean
	 */
	public function alnp_is_customizer() {
		return isset( $_GET['alnp-customizer'] ) && $_GET['alnp-customizer'] === 'yes';
	} // END alnp_is_customizer()

	/**
	 * Get Customizer sections for Auto Load Next Post.
	 *
	 * @since  1.5.0
	 * @return array
	 */
	public function alnp_get_customizer_sections() {
		/**
		 * Filter Customizer sections for Auto Load Next Post.
		 *
		 * @param array $sections Customizer sections to add.
		 */
		return apply_filters( 'auto_load_next_post_get_customizer_sections', array(
			'auto_load_next_post_theme_selectors' => array(
				'capability'  => 'edit_theme_options',
				'title'       => __( 'Theme Selectors', 'auto-load-next-post' ),
				'description' => sprintf( __( 'Set the theme selectors below according to the theme. %1$sHow to find my theme selectors?%2$s', 'auto-load-next-post' ), '<a href="' . esc_url( 'https://autoloadnextpost.com/documentation/find-theme-selectors/?utm_source=wpcustomizer&utm_campaign=plugin-settings-theme-selectors' ) . '" target="_blank">', '</a>' ),
			),
			'auto_load_next_post_misc' => array(
				'capability'  => 'edit_theme_options',
				'title'       => __( 'Misc Settings', 'auto-load-next-post' ),
				'description' => sprintf( __( 'Here you can set if you want to track pageviews, remove comments and load %s javascript in the footer.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ),
			),
		) );
	} // END alnp_get_customizer_sections()

	/**
	 * Get Customizer settings for Auto Load Next Post.
	 *
	 * @since  1.5.0
	 * @return array
	 */
	public function alnp_get_customizer_settings() {
		$settings = $this->alnp_get_settings();

		/**
		 * Filter Customizer settings for Auto Load Next Post.
		 *
		 * @param array $settings Customizer settings to add.
		 */
		return apply_filters( 'auto_load_next_post_get_customizer_settings', array(
			'auto_load_next_post_content_container' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_content_container'],
				'sanitize_callback' => 'wp_filter_post_kses',
				'validate_callback' => 'alnp_validate_content_container_selector',
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_title_selector' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_title_selector'],
				'sanitize_callback' => 'wp_filter_post_kses',
				'validate_callback' => 'alnp_validate_post_title_selector',
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_navigation_container' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_navigation_container'],
				'sanitize_callback' => 'wp_filter_post_kses',
				'validate_callback' => 'alnp_validate_post_navigation_selector',
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_previous_post_selector' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_previous_post_selector'],
				'sanitize_callback' => 'wp_filter_post_kses',
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_comments_container' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_comments_container'],
				'sanitize_callback' => 'wp_filter_post_kses',
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_remove_comments' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_remove_comments'],
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_google_analytics' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_google_analytics'],
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
			'auto_load_next_post_js_footer' => array(
				'capability'        => 'edit_theme_options',
				'default'           => $settings['alnp_js_footer'],
				'transport'         => 'postMessage',
				'type'              => 'option',
			),
		) );
	} // END alnp_get_customizer_settings()

	/**
	 * Get Customizer controls for Auto Load Next Post.
	 *
	 * @since  1.5.0
	 * @return array
	 */
	public function alnp_get_customizer_controls() {
		/**
		 * Filter Customizer controls for Auto Load Next Post.
		 *
		 * @param array $controls Customizer controls to add.
		 */
		return apply_filters( 'auto_load_next_post_get_customizer_controls', array(
			'alnp_content_container' => array(
				'class'       => 'WP_Customize_Control',
				'description' => __( 'The primary container where the post content is loaded in. Example: <code>main.site-main</code>', 'auto-load-next-post' ),
				'label'       => esc_html__( 'Content Container', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_theme_selectors',
				'settings'    => 'auto_load_next_post_content_container',
				'type'        => 'text',
			),
			'alnp_title_selector' => array(
				'class'       => 'WP_Customize_Control',
				'description' => __( 'Used to identify which article the user is reading and track should Google Analytics or other analytics be enabled. Example: <code>h1.entry-title</code>', 'auto-load-next-post' ),
				'label'       => esc_html__( 'Post Title Selector', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_theme_selectors',
				'settings'    => 'auto_load_next_post_title_selector',
				'type'        => 'text',
			),
			'alnp_navigation_container' => array(
				'class'       => 'WP_Customize_Control',
				'description' => __( 'Used to identify which post to load next if any. Example: <code>nav.post-navigation</code>', 'auto-load-next-post' ),
				'label'       => esc_html__( 'Post Navigation Container', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_theme_selectors',
				'settings'    => 'auto_load_next_post_navigation_container',
				'type'        => 'text',
			),
			'alnp_comments_container' => array(
				'class'       => 'WP_Customize_Control',
				'description' => __( 'So comments can be removed if enabled under "Misc" settings. Example: <code>div#comments</code>', 'auto-load-next-post' ),
				'label'       => esc_html__( 'Comments Container', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_theme_selectors',
				'settings'    => 'auto_load_next_post_comments_container',
				'type'        => 'text',
			),
			'alnp_remove_comments' => array(
				'class'       => 'WP_Customize_Control',
				'description' => esc_html__( 'Enable to remove comments when each post loads including the initial post.', 'auto-load-next-post' ),
				'label'       => esc_html__( 'Remove Comments', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_misc',
				'settings'    => 'auto_load_next_post_remove_comments',
				'type'        => 'checkbox',
			),
			'alnp_google_analytics' => array(
				'class'       => 'WP_Customize_Control',
				'description' => esc_html__( 'Enable to track each post the visitor is reading. This will count as a pageview. You must already have Google Analytics setup.', 'auto-load-next-post' ),
				'label'       => esc_html__( 'Update Google Analytics', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_misc',
				'settings'    => 'auto_load_next_post_google_analytics',
				'type'        => 'checkbox',
			),
			'alnp_js_footer' => array(
				'class'       => 'WP_Customize_Control',
				'description' => esc_html__( 'Enable to load Auto Load Next Post in the footer instead of the header. Can be useful to optimize your site.', 'auto-load-next-post' ),
				'label'       => esc_html__( 'JavaScript in Footer?', 'auto-load-next-post' ),
				'section'     => 'auto_load_next_post_misc',
				'settings'    => 'auto_load_next_post_google_analytics',
				'type'        => 'checkbox',
			),
		) );
	} // END alnp_get_customizer_controls()

	/**
	 * Validates the content container theme selector to not be empty
	 *
	 * @since  1.5.0
	 * @param  WP_Error $validity Validity.
	 * @param  string   $value    Value, normally pre-sanitized.
	 * @return WP_Error $validity
	 */
	public function alnp_validate_content_container_selector( $validity, $value ) {
		if ( empty( $value ) ) {
			$validity->add( 'required', esc_html__( 'The content container selector is empty. Will not know where to load posts without it.', 'auto-load-next-post' ) );
		}

		return $validity;
	} // END alnp_validate_content_container_selector()

	/**
	 * Validates the post title theme selector to not be empty.
	 *
	 * @since  1.5.0
	 * @param  WP_Error $validity Validity.
	 * @param  string   $value    Value, normally pre-sanitized.
	 * @return WP_Error $validity
	 */
	public function alnp_validate_post_title_selector( $validity, $value ) {
		if ( empty( $value ) ) {
			$validity->add( 'required', esc_html__( 'The post title selector is empty. Will not be able to identify which article the user is reading.', 'auto-load-next-post' ) );
		}

		return $validity;
	} // END alnp_validate_post_title_selector()

	/**
	 * Validates the post navigation theme selector to not be empty.
	 *
	 * @since  1.5.0
	 * @param  WP_Error $validity Validity.
	 * @param  string   $value    Value, normally pre-sanitized.
	 * @return WP_Error $validity
	 */
	public function alnp_validate_post_navigation_selector( $validity, $value ) {
		if ( empty( $value ) ) {
			$validity->add( 'required', esc_html__( 'The post navigation container selector is empty. Required so ALNP can look up the next post to load.', 'auto-load-next-post' ) );
		}

		return $validity;
	} // END alnp_validate_post_navigation_selector()

	/**
	 * Return Auto Load Next Post settings.
	 *
	 * @since  1.5.0
	 * @return array $args
	 */
	public function alnp_get_settings() {
		$args = array(
			'alnp_content_container'      => get_option( 'auto_load_next_post_content_container' ),
			'alnp_title_selector'         => get_option( 'auto_load_next_post_title_selector' ),
			'alnp_navigation_container'   => get_option( 'auto_load_next_post_navigation_container' ),
			'alnp_previous_post_selector' => get_option( 'auto_load_next_post_previous_post_selector' ),
			'alnp_comments_container'     => get_option( 'auto_load_next_post_comments_container' ),
			'alnp_remove_comments'        => get_option( 'auto_load_next_post_remove_comments' ),
			'alnp_google_analytics'       => get_option( 'auto_load_next_post_google_analytics' ),
			'alnp_js_footer'              => get_option( 'auto_load_next_post_js_footer' )
		);

		return $args;
	} // END alnp_get_settings()

	/**
	 * Returns true or false if the page is ready for Auto Load Next Post
	 * panel to show in the customizer.
	 *
	 * @since  1.5.0
	 * @return boolean
	 */
	public function is_page_alnp_ready() {
		if ( is_front_page() && is_home() ) {
			return false;
		} elseif ( is_front_page() ) {
			return false;
		} elseif ( is_home() ) {
			return true;
		}
		elseif ( is_singular( apply_filters( 'alnp_customizer_posts_ready', array( 'post' ) ) ) ) {
			return true;
		}

		return true;
	} // END is_page_alnp_ready()

	/**
	 * Returns the permalink of a random page.
	 *
	 * @since  1.5.0
	 * @static
	 * @param  string $post_type - Default is post.
	 * @return int|boolean
	 */
	public static function alnp_get_random_page_permalink( $post_type = 'post' ) {
		$args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'orderby'        => 'rand',
			'posts_per_page' => 1
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$id = get_the_ID();

				return get_permalink( $id );
			endwhile;
		}
		else {
			return false;
		}
	} // END alnp_get_random_page_permalink()

	/**
	 * Adds script to the previewer to send data to the customizer.
	 *
	 * @since 1.5.0
	 */
	public function alnp_add_customizer_preview_scripts() {
		Auto_Load_Next_Post::load_file( 'alnp-theme-customizer', '/assets/js/customizer/theme-customizer.js', true, array( 'jquery', 'customize-preview' ), '', true );
	} // END alnp_add_customizer_preview_scripts()

	/**
	 * Adds script to help the controls in the customizer.
	 *
	 * @since 1.5.0
	 */
	public function add_scripts() {
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
						console.log( "Random single post loaded." );
						wp.customize.previewer.previewUrl.set( '<?php echo esc_js( $this->alnp_get_random_page_permalink() ); ?>' );
					}
					else {
						console.log( 'Already viewing a single post!' );
					}

				} );
			} );
		} );
		</script>
		<?php
	} // END add_scripts()

} // END Class

new ALNP_Customizer();
