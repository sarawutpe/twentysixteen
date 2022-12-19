<?php

/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_post_thumbnail(); ?>

	<?php if ('post' === get_post_type()) : ?>

		<footer class="entry-footer">
			<?php
			if (in_array(get_post_type(), array('post', 'attachment'), true)) {
				twentysixteen_entry_date();
			}
			?>
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


	<?php endif; ?>


</article>


<!-- #post-<?php the_ID(); ?> -->