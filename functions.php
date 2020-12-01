<?php

/** GeneratePress:
 * Alternative version of the function to load templates.
 */
function gdrts__generate_do_template_part( $template, $post_type ) {
	do_action( 'generate_before_do_template_part', $template, $post_type );

	if ( apply_filters( 'generate_do_template_part', true, $template ) ) {
		if ( 'archive' === $template ) {
			get_template_part( 'content-archive', $post_type );
		}

		if ( 'single' === $template ) {
			get_template_part( 'content-single', $post_type );
		}
	}

	do_action( 'generate_after_do_template_part', $template, $post_type );
}

/** GeneratePress:
 * Enable entry meta block for 'product' post type.
 */
add_filter( 'generate_entry_meta_post_types', 'gdrts__generate_entry_meta_post_types' );
add_filter( 'generate_footer_meta_post_types', 'gdrts__generate_entry_meta_post_types' );
function gdrts__generate_entry_meta_post_types( $types ) {
	$types[] = 'host';
	$types[] = 'registrar';

	return $types;
}
