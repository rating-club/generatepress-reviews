<?php
/**
 * Template Name: Best Registrars
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

    <div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
        <main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php

			do_action( 'generate_before_main_content' );

			if ( generate_has_default_loop() ) {
				while ( have_posts() ) :

					the_post();

					get_template_part( 'content', 'page-best', array(
						'gdrts-best-post-type'     => 'registrar',
						'gdrts-best-rating-series' => 'registrar'
					) );

				endwhile;
			}

			do_action( 'generate_after_main_content' );

			?>
        </main>
    </div>

<?php

do_action( 'generate_after_primary_content_area' );

get_footer();
