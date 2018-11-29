<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
	</header>

	<figure class="post-thumbnail">
		<div class="post-thumbnail-inner">
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
		</div>
	</figure>

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

	<footer class="entry-footer">
		<?php twentynineteen_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
	<?php get_template_part( 'template-parts/post/author', 'bio' ); ?>
	<?php endif; ?>

</article><!-- #post-${ID} -->