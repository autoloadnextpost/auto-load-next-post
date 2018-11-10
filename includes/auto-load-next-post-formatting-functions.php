<?php
/**
 * Auto Load Next Post Formatting
 *
 * @since    1.0.0
 * @version  1.5.4
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Core/Functions
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 *
 * @since   1.0.0
 * @version 1.5.4
 * @param   string|array $var Data to sanitize.
 * @return  string|array *
 */
if ( ! function_exists( 'auto_load_next_post_clean' ) ) {
	function auto_load_next_post_clean( $var ) {
		if ( is_array( $var ) ) {
			return array_map( 'auto_load_next_post_clean', $var );
		} else {
			return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		}
	} // END auto_load_next_post_clean()
}

/**
 * Seconds to words.
 *
 * Forked from: https://github.com/thatplugincompany/login-designer/blob/master/includes/admin/class-login-designer-feedback.php
 *
 * @since   1.4.10
 * @version 1.5.4
 * @param   string $seconds Seconds in time.
 * @return  string
 */
if ( ! function_exists( 'auto_load_next_post_seconds_to_words' ) ) {
	function auto_load_next_post_seconds_to_words( $seconds ) {
		// Get the years.
		$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
		if ( $years > 1 ) {
			/* translators: Number of years */
			return sprintf( __( '%s years', 'auto-load-next-post' ), $years );
		} elseif ( $years > 0 ) {
			return __( 'a year', 'auto-load-next-post' );
		}

		// Get the weeks.
		$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
		if ( $weeks > 1 ) {
			/* translators: Number of weeks */
			return sprintf( __( '%s weeks', 'auto-load-next-post' ), $weeks );
		} elseif ( $weeks > 0 ) {
			return __( 'a week', 'auto-load-next-post' );
		}

		// Get the days.
		$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
		if ( $days > 1 ) {
			/* translators: Number of days */
			return sprintf( __( '%s days', 'auto-load-next-post' ), $days );
		} elseif ( $days > 0 ) {
			return __( 'a day', 'auto-load-next-post' );
		}

		// Get the hours.
		$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
		if ( $hours > 1 ) {
			/* translators: Number of hours */
			return sprintf( __( '%s hours', 'auto-load-next-post' ), $hours );
		} elseif ( $hours > 0 ) {
			return __( 'an hour', 'auto-load-next-post' );
		}

		// Get the minutes.
		$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
		if ( $minutes > 1 ) {
			/* translators: Number of minutes */
			return sprintf( __( '%s minutes', 'auto-load-next-post' ), $minutes );
		} elseif ( $minutes > 0 ) {
			return __( 'a minute', 'auto-load-next-post' );
		}

		// Get the seconds.
		$seconds = intval( $seconds ) % 60;
		if ( $seconds > 1 ) {
			/* translators: Number of seconds */
			return sprintf( __( '%s seconds', 'auto-load-next-post' ), $seconds );
		} elseif ( $seconds > 0 ) {
			return __( 'a second', 'auto-load-next-post' );
		}
	} // END auto_load_next_post_seconds_to_words()
}
