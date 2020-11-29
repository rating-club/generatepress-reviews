<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
    <div class="inside-article">
		<?php

		do_action( 'generate_before_content' );

		if ( generate_show_entry_header() ) :
			?>

            <header class="entry-header">
				<?php

				do_action( 'generate_before_page_title' );

				if ( generate_show_title() ) {
					$params = generate_get_the_title_parameters();

					the_title( $params['before'], $params['after'] );
				}

				do_action( 'generate_after_page_title' );

				?>
            </header>

		<?php
		endif;

		do_action( 'generate_after_entry_header' );

		$itemprop = '';

		if ( 'microdata' === generate_get_schema_type() ) {
			$itemprop = ' itemprop="text"';
		}

		?>

        <div class="entry-content"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
            <h2 class="best-subtitle">Rated by Editor Review</h2>
			<?php get_template_part( 'content', 'best-reviews', $args ); ?>

            <h2 class="best-subtitle">Rated by User Reviews</h2>
			<?php get_template_part( 'content', 'best-ratings', $args ); ?>
        </div>

		<?php
		do_action( 'generate_after_content' );

		?>
    </div>
</article>
