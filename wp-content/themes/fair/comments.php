<?php

if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number()) { ?>
	<div class="edgtf-comments-holder-outer">
		<div class="edgtf-comment-holder clearfix" id="comments">
			<div class="edgtf-comment-number">
				<div class="edgtf-comment-number-inner">
					<h4><?php comments_number( esc_html__('No Comments','fair'), esc_html__(' Comment: ','fair') . '1', esc_html__(' Comments: ','fair') . '% '); ?></h4>
				</div>
			</div>
			<div class="edgtf-comments">
				<?php if ( have_comments() ) : ?>
					<ul class="edgtf-comment-list">
						<?php wp_list_comments(array( 'callback' => 'fair_edge_comment')); ?>
					</ul>
				<?php endif; ?>
			<?php if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' )){ ?>
				<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'fair'); ?></p>
			<?php } ?>

		</div>
		</div>
		<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );

			$args = array(
				'id_form' => 'commentform',
				'id_submit' => 'submit_comment',
				'title_reply'=> esc_html__( 'Post a Comment','fair' ),
				'title_reply_to' => esc_html__( 'Post a Reply to %s','fair' ),
				'cancel_reply_link' => esc_html__( 'Cancel Reply','fair' ),
				'label_submit' => esc_html__( 'Submit','fair' ),
				'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Write your comment here...','fair' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' => '<div class="edgtf-three-columns clearfix"><div class="edgtf-three-columns-inner clearfix"><div class="edgtf-column"><div class="edgtf-column-inner"><input id="author" name="author" placeholder="'. esc_html__( 'Your full name','fair' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
					'url' => '<div class="edgtf-column"><div class="edgtf-column-inner"><input id="email" name="email" placeholder="'. esc_html__( 'E-mail address','fair' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
					'email' => '<div class="edgtf-column"><div class="edgtf-column-inner"><input id="url" name="url" type="text" placeholder="'. esc_html__( 'Website','fair' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div>'
					 ) ) );

				if(is_user_logged_in()){
					$args['class_form'] = 'edgtf-comment-registered-user';
					$args['title_reply_before'] = '<h4 id="reply-title" class="comment-reply-title edgtf-comment-reply-title-registered">';
					$args['title_reply_after'] = '</h4>';
				}
				else{
					$args['title_reply_before'] = '<h4 id="reply-title" class="comment-reply-title">';
					$args['title_reply_after'] = '</h4>';
				}
		?>
		<?php if(get_comment_pages_count() > 1){ ?>
			<div class="edgtf-comment-pager">
				<p><?php paginate_comments_links(); ?></p>
			</div>
		<?php } ?>
		 <div class="edgtf-comment-form">
			<?php comment_form($args); ?>
		</div>
	</div>
<?php } ?>

