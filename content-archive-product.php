<?php
/**
 * The template for displaying posts within the loop.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'gdrts-post-type-archive' ); ?> <?php generate_do_microdata( 'article' ); ?>>
    <div class="inside-article">
        <div class="featured-image">
            <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail( 'medium', $attrs = array( 'itemprop' => 'image' ) ); ?></a>
        </div>
        <div class="product-ratings">
			<?php

			$post_type = get_post()->post_type;

			?>

            <h5>Editor Review Rating</h5>
			<?php

			gdrts_posts_render_rating(
				array(
					'echo'   => true,
					'method' => 'multi-stars-review',
					'series' => $post_type == 'host' ? 'hosting' : 'registrar'
				),
				array(
					'template'   => 'overall',
					'style_size' => 28
				)
			);

			?>

            <h5>Users Reviews Rating</h5>
			<?php

			gdrts_posts_render_rating(
				array(
					'echo'   => true,
					'method' => 'multi-stars-rating',
					'series' => $post_type == 'host' ? 'hosting' : 'registrar'
				),
				array(
					'template'   => 'overall',
					'style_size' => 28
				)
			);

			?>
        </div>
        <div class="product-information">
			<?php

			$itemprop = '';

			if ( 'microdata' === generate_get_schema_type() ) {
				$itemprop = ' itemprop="text"';
			}

			?>

            <div class="entry-summary"<?php echo $itemprop; // phpcs:ignore -- No escaping needed. ?>>
				<?php the_excerpt(); ?>
            </div>

			<?php

			do_action( 'generate_after_content' );

			?>
        </div>
    </div>
</article>
