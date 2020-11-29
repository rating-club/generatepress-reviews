<table class="gdrts-best-companies gdrts-by-user-reviews">
    <thead>
    <th>#</th>
    <th>Company</th>
    <th class="editor-rating">Editor Rating</th>
    <th class="users-rating">Users Rating</th>
    <th>Visit</th>
    </thead>
    <tbody>

	<?php

	$query_args = array(
		'posts_per_page' => 5,
		'post_type'      => $args['gdrts-best-post-type'],
		'orderby'        => 'gdrts',
		'order'          => 'DESC',
		'gdrts_method'   => 'multi-stars-rating',
		'gdrts_value'    => 'rating',
		'gdrts_series'   => $args['gdrts-best-rating-series']
	);

	$the_query = new WP_Query( $query_args );

	if ( $the_query->have_posts() ) {

		$position = 1;
		while ( $the_query->have_posts() ) {
			$the_query->the_post();

			$item = gdrts_get_rating_item_by_post();

			?>

            <tr>
                <td class="position" data-th="Position">
					<?php echo $position ++; ?>
                </td>
                <td class="company-logo" data-th="Company">
					<?php if ( has_post_thumbnail() ): ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
                        </div>
					<?php endif; ?>
                </td>
                <td class="editor-rating" data-th="Editor Rating">
					<?php

					gdrts_posts_render_rating(
						array(
							'echo'   => true,
							'method' => 'multi-stars-review',
							'series' => $args['gdrts-best-rating-series']
						),
						array(
							'template'           => 'overall',
							'style_type'         => 'font',
							'style_name'         => 'star',
							'style_size'         => 16,
							'font_color_current' => '#ba2a2a'
						)
					);

					?>
                </td>
                <td class="users-rating" data-th="Users Rating">
					<?php

					gdrts_posts_render_rating(
						array(
							'echo'   => true,
							'method' => 'multi-stars-rating',
							'series' => $args['gdrts-best-rating-series']
						),
						array(
							'disable_rating'     => true,
							'template'           => 'overall',
							'style_type'         => 'font',
							'style_name'         => 'star',
							'style_size'         => 16,
							'font_color_current' => '#ba2a2a'
						)
					);

					?>
                </td>
                <td class="hosting-visit" data-th="Visit">
                    <a href="<?php echo $item->get_meta( 'reviewed-item_url' ); ?>" target="_blank">Visit Site</a>
                </td>
            </tr>

			<?php

		}
	}

	wp_reset_query();

	?>

    </tbody>
</table>            
