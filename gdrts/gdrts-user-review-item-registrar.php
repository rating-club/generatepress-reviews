<?php

$classes = array( 'gdrts-user-review-wrapper', 'gdrts-user-review-custom-layout' );

if ( gdrts_the_review()->user_id == 0 ) {
	$classes[] = 'gdrts-user-review-from-visitor';
} else {
	$classes[] = 'gdrts-user-review-from-user';
}

?>
<div id="user-review-<?php echo gdrts_the_review()->id; ?>" class="<?php echo join( ' ', $classes ); ?>">
    <div class="gdrts-user-review-header">
        <div class="review-overall"><?php echo gdrts_the_review()->percentage; ?>%</div>
        <div class="review-author vcard">
			<?php echo get_avatar( gdrts_the_review()->author_email, 32 ); ?>
			<?php printf( __( "<cite class='fn'>%s</cite> <span class='says'>says:</span>", "gd-rating-system-user-reviews" ), gdrts_the_review()->author_link() ); ?>
        </div>
    </div>
    <div class="gdrts-user-review-content">

		<?php if ( gdrts_the_review()->in_moderation() ) { ?>

            <div class="gdrts-user-review-in-moderation-queue">
				<?php _e( "Your review is currently waiting in moderation queue.", "gd-rating-system-user-reviews" ); ?>
            </div>

		<?php } ?>

		<?php if ( gdrts_ur_is_archive_user_reviews() || gdrts_ur_is_archive_all_reviews() ) { ?>

            <div class="gdrts-user-review-for-post">
				<?php echo sprintf( __( "This is review for %s %s.", "gd-rating-system-user-reviews" ), gdrtsa_user_reviews()->get_post_type_property( gdrts_ur()->post_type, 'singular' ), '\'<a href="' . get_permalink( gdrts_the_review()->post_id ) . '">' . get_the_title( gdrts_the_review()->post_id ) . '</a>\'' ); ?>
            </div>

		<?php } ?>

		<?php do_action( 'gdrts_ur_review_item_default_top' ); ?>

        <div class="gdrts-user-review-content-main">
			<?php if ( ! empty( gdrts_the_review()->subject ) ) { ?>
                <h4><?php echo gdrts_the_review()->subject; ?></h4>
			<?php } ?>

			<?php do_action( 'gdrts_ur_review_item_default_before_content' ); ?>

			<?php echo gdrts_the_review()->content(); ?>

			<?php do_action( 'gdrts_ur_review_item_default_after_content' ); ?>
        </div>

        <div class="gdrts-grid gdrts-wrapper-proscons-rating">
            <div class="gdrts-unit half">
                <div class="gdrts-user-review-content-proscons">
					<?php do_action( 'gdrts_ur_review_item_default_before_proscons' ); ?>

                    <div class="gdrts-user-review-pros">
                        <h5><?php echo gdrtsa_user_reviews()->get_label( 'pros' ); ?>:</h5>
                        <ul>
                            <li><?php echo join( '</li><li>', gdrts_the_review()->pros ); ?></li>
                        </ul>
                    </div>

                    <div class="gdrts-user-review-cons">
                        <h5><?php echo gdrtsa_user_reviews()->get_label( 'cons' ); ?>:</h5>
                        <ul>
                            <li><?php echo join( '</li><li>', gdrts_the_review()->cons ); ?></li>
                        </ul>
                    </div>
                </div>

				<?php do_action( 'gdrts_ur_review_item_default_after_proscons' ); ?>
            </div>
            <div class="gdrts-unit half">
                <div class="gdrts-user-review-rating">
					<?php echo gdrts_the_review()->rating_block( array(
						'style_min_width' => '240px',
						'style_size'      => 24
					) ); ?>
                </div>
            </div>
        </div>

		<?php do_action( 'gdrts_ur_review_item_default_bottom' ); ?>

		<?php if ( gdrts_the_review()->edit_allowed() ) { ?>

            <div class="gdrts-user-review-edit">
                <a href="<?php echo gdrts_the_review()->get_edit_url(); ?>">
					<?php _e( "Edit the Review", "gd-rating-system-user-reviews" ); ?>
                </a>
				<?php gdrts_the_review()->edit_message(); ?>
            </div>

		<?php } ?>
    </div>
    <div class="gdrts-user-review-footer">
		<?php if ( gdrts_ur()->public_rating ) { ?>
            <div class="gdrts-user-review-public-rating">
				<?php gdrts_ur()->show_public_rating_block( gdrts_the_review()->id ); ?>
            </div>
		<?php } ?>
        <div class="gdrts-user-review-datetime">
            <a href="<?php echo gdrts_the_review()->get_url(); ?>">
				<?php printf( __( "%s at %s", "gd-rating-system-user-reviews" ), gdrts_the_review()->get_date(), gdrts_the_review()->get_time() ); ?>
            </a>
        </div>
		<?php if ( gdrts_ur()->is_open_for_comments() ) {
			$_comments = gdrts_the_review()->comments_count; ?>
			<?php if ( $_comments > 0 || gdrts_ur()->is_allowed_to_comment() ) { ?>
                <div class="gdrts-user-review-comments">
                    <a href="<?php echo gdrts_the_review()->get_url( 'gdrts-user-reviews-comments' ); ?>">
						<?php if ( $_comments > 0 ) { ?>
                            <span class="gdrts-user-review-comments-count"><?php echo sprintf( _n( "One comment", "%s comments", $_comments, "gd-rating-system-user-reviews" ), $_comments ); ?></span>
						<?php }
						if ( gdrts_ur()->is_allowed_to_comment() ) { ?>
                            <span class="gdrts-user-review-comments-form"><?php _e( "Leave a comment", "gd-rating-system-user-reviews" ); ?></span>
						<?php } ?>
                    </a>
                </div>
			<?php } ?>
		<?php } ?>
    </div>
</div>
