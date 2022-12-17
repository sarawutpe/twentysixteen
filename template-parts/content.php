<?php

/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php twentysixteen_post_thumbnail(); ?>

	<header class="entry-header">
		<?php if (is_sticky() && is_home() && !is_paged()) : ?>
			<span class="sticky-post"><?php _e('Featured', 'twentysixteen'); ?></span>
		<?php endif; ?>

		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
	</footer>

	<!-- edit -->
	<?php
	edit_post_link(
		sprintf(
			__('Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen'),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
	?>

	<!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<!-- <div class="clear"></div> -->