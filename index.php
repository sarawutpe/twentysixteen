<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<!-- Posts -->
		<div class="posts">
			<?php if (have_posts()) : ?>

				<?php if (is_home() && !is_front_page()) : ?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

			<?php
				// Start the loop.
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', get_post_format());

				// End the loop.
				endwhile;

			endif;
			?>

		</div>

		<!-- If no content, include the "No posts found" template. -->
		<?php if (!have_posts()) : ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>

		<!-- Pagination -->
		<?php the_posts_pagination(array('prev_text' => '', 'next_text' => '')); ?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>