<?php
/**
 * The template for displaying Archive pages.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// add_action( 'generate_after_entry_header', 'gdrts__display_thumbs_rating_block', 5 );

add_filter( 'generate_page_header_default_size', 'gdrts__archive_thumbnail_size' );
function gdrts__archive_thumbnail_size( $size ) {
	$size = 'medium';

	return $size;
}

add_filter( 'post_class', 'gdrts__generate_blog_post_classes', 100 );
function gdrts__generate_blog_post_classes( $classes ) {
	if ( ( $key = array_search( 'resize-featured-image', $classes ) ) !== false ) {
		unset( $classes[ $key ] );
	}

	return $classes;
}

get_header(); ?>

    <div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
        <main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php

			do_action( 'generate_before_main_content' );

			if ( generate_has_default_loop() ) {
				if ( have_posts() ) :
					do_action( 'generate_archive_title' );

					while ( have_posts() ) :

						the_post();

						gdrts__generate_do_template_part( 'archive', 'product' );

					endwhile;

					do_action( 'generate_after_loop', 'archive' );

				else :

					generate_do_template_part( 'none' );

				endif;
			}

			do_action( 'generate_after_main_content' );

			?>
        </main>
    </div>

<?php

do_action( 'generate_after_primary_content_area' );

generate_construct_sidebars();

get_footer();
