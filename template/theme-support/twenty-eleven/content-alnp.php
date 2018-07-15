<?php
/**
 * The repeater template for displaying a post when called for Twenty Eleven.
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post/Templates/Theme Support
 * @license GPL-2.0+
 * @version 1.5.0
 */

if ( have_posts() ) :

	// Load content before the loop.
	do_action( 'alnp_load_before_loop' );

	// Check that there are posts to load.
	while ( have_posts() ) : the_post();

		// Load content before the post content.
		do_action( 'alnp_load_before_content' );
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php twentyeleven_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'auto-load-next-post' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<footer class="entry-meta">
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'auto-load-next-post' ) );

					/* translators: used between list items, there is a space after the comma */
					$tag_list = get_the_tag_list( '', __( ', ', 'auto-load-next-post' ) );
				if ( '' != $tag_list ) {
					$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'auto-load-next-post' );
				} elseif ( '' != $categories_list ) {
					$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'auto-load-next-post' );
				} else {
					$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'auto-load-next-post' );
				}

					printf(
						$utility_text,
						$categories_list,
						$tag_list,
						esc_url( get_permalink() ),
						the_title_attribute( 'echo=0' ),
						get_the_author(),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
					);
				?>

				<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php
						/** This filter is documented in author.php */
						echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) );
						?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( __( 'About %s', 'auto-load-next-post' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
						<div id="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'auto-load-next-post' ), get_the_author() ); ?>
							</a>
						</div><!-- #author-link	-->
					</div><!-- #author-description -->
				</div><!-- #author-info -->
				<?php endif; ?>
			</footer><!-- .entry-meta -->
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php
		// Load content after the post content.
		do_action( 'alnp_load_after_content' );

	// End the loop.
	endwhile;

	// Load content after the loop.
	do_action( 'alnp_load_after_loop' );

else :

	// Load content if there are no more posts.
	do_action( 'alnp_no_more_posts' );

endif; // END if have_posts()
