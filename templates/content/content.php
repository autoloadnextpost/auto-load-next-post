<?php
/**
 * Template part for displaying the singular post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post/Templates/Content
 * @license GPL-2.0+
 * @version 1.6.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title h1">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="post-thumbnail">
		<div class="post-thumbnail-inner">
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
		</div>
	</figure><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'auto-load-next-post' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<nav class="post-navigation">
		<?php previous_post_link(); ?>
		<?php next_post_link(); ?>
	</nav><!-- .post-navigation -->

</article><!-- #post-${ID} -->