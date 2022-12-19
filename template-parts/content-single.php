<?php

/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<div class="posts">
	<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
		<!-- Breadcrumb -->
		<?php if (function_exists('yoast_breadcrumb')) {
			yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
		} ?>
		<!-- Title -->
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</header><!-- .entry-header -->
		<!-- Date -->
		<?php
		if (in_array(get_post_type(), array('post', 'attachment'), true)) {
			twentysixteen_entry_date();
		}
		?>

		<?php twentysixteen_excerpt(); ?>

		<?php twentysixteen_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentysixteen') . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'twentysixteen') . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);

			if ('' !== get_the_author_meta('description')) {
				get_template_part('template-parts/biography');
			}
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php twentysixteen_entry_meta(); ?>
			<?php edit_post_link(sprintf(__('Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen'), get_the_title()), '<span class="edit-link">', '</span>'); ?>
		</footer>
		<!-- .entry-footer -->

		<!-- Get custom fields -->
		<?php
		$custom_field_id = 'link';
		$custom_fields = get_post_meta($post->ID, $custom_field_id, false);
		if (count($custom_fields) > 0) {
			echo '<div class="download-link-wrapper">';
			$secert_hex = bin2hex(random_bytes('16'));
			foreach ($custom_fields as $field) {
				$link = explode("=", $field);
				if (count($link) > 1) {
					// Encrypt link to aes-256-ecb
					$field_name = $link[0];
					$field_link = $link[1];

					$chiperRaw = openssl_encrypt($field_link, 'AES-256-ECB', $secert_hex, OPENSSL_RAW_DATA);
					$encrypt_str = trim(base64_encode($chiperRaw));
					echo ('<button class="btn btn-primary download" onclick="openLink(' . "'$encrypt_str'" . ');">'
						. $field_name .
						'</button>');
				}
			}
			echo '</div>';
		}
		?>

		<script>
			var secertHex = '<?= $secert_hex ?>'

			function openLink(encryptStr) {
				const secertObj = CryptoJS.enc.Utf8.parse(secertHex)
				const decryptedphp = CryptoJS.AES.decrypt(encryptStr, secertObj, {
					mode: CryptoJS.mode.ECB,
				})
				const haveLink = decryptedphp.toString(CryptoJS.enc.Utf8)
				if (haveLink != "") {
					console.log(haveLink);
					window.open(haveLink, '_blank');
				}
			}
		</script>


	</article><!-- #post-<?php the_ID(); ?> -->
</div>