<?php
if( !function_exists('fair_edge_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function fair_edge_get_blog($type) {

		$sidebar = fair_edge_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		fair_edge_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}

}

if( !function_exists('fair_edge_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function fair_edge_get_blog_type($type) {
		
		$blog_query = fair_edge_get_blog_query();
		
		$paged = fair_edge_paged();
		$blog_classes = '';

		if(fair_edge_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(fair_edge_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}

		if((fair_edge_options()->getOptionValue('masonry_gallery_appear_animation') == "yes") && ($type == "masonry-gallery")) {
			$blog_classes .= 'edgtf-masonry-appear';
		}

		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type,
			'blog_classes' => $blog_classes
		);

		fair_edge_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}

}

if(!function_exists('fair_edge_get_blog_query')){
	/**
	* Function which create query for blog lists
	*
	* @return wp query object
	*/
	function fair_edge_get_blog_query(){
		global $wp_query;
		
		$id = fair_edge_get_page_id();
		$category = esc_attr(get_post_meta($id, "edgtf_blog_category_meta", true));
		if(esc_attr(get_post_meta($id, "edgtf_show_posts_per_page_meta", true)) != ""){
			$post_number = esc_attr(get_post_meta($id, "edgtf_show_posts_per_page_meta", true));
		}else{			
			$post_number = esc_attr(get_option('posts_per_page'));
		} 
		
		$paged = fair_edge_paged();
		$query_array = array(
			'post_type' => 'post',
			'paged' => $paged,
			'cat' 	=> $category,
			'posts_per_page' => $post_number
		);
		if(is_archive()){
			$blog_query = $wp_query;
		}else{
			$blog_query = new WP_Query($query_array);
		}
		return $blog_query;
		
	}
}


if(!function_exists('fair_edge_get_post_format')){
	/**
	* Function which return post format of post
	*
	* @return string
	*/
	function fair_edge_get_post_format($type){

		$post_format = get_post_format();

		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');


		if($type == 'masonry-gallery'){

			$standard_post_formats	= array('audio', 'video', 'standard');
			$custom_post_formats	= array('quote', 'gallery');

			if($post_format == 'link') {
				$post_format = fair_edge_check_link_post_format_type();
			} elseif($post_format == 'audio' && get_post_meta(get_the_ID(), "edgtf_audio_post_type_meta", true) == 'soundcloud' && get_post_meta(get_the_ID(), "edgtf_post_audio_soundcloud_link_meta", true) !== "") {
				$post_format = 'soundcloud';
			} elseif(in_array($post_format,$custom_post_formats)) {
				$post_format = $post_format;
			}
			else if(in_array($post_format,$standard_post_formats)) {
				$post_format = 'standard';
			} else {
				$post_format = 'standard';
			}

		} else {

			if( in_array($post_format, $supported_post_formats) ) {
				if($post_format == 'link') {
					$post_format = fair_edge_check_link_post_format_type();
				}
			} else {
				$post_format = 'standard';
			}

		}

		return $post_format;
	}
}

if(!function_exists('fair_edge_check_link_post_format_type')){
	/**
	 * Function which check link type
	 *
	 * @return string
	 */
	function fair_edge_check_link_post_format_type(){

		$type = 'link';

		if ( fair_edge_get_tweeter_post()){
			$type = 'twitter';
		} if (fair_edge_get_instagram_post()){
			$type = 'instagram';
		}

		return $type;
	}
}

if(!function_exists('fair_edge_get_instagram_post')){
	/**
	 * Function which get instagram post data
	 *
	 * @return array
	 */
	function fair_edge_get_instagram_post(){

		if($post = get_post_meta(get_the_ID(), "edgtf_post_link_instagram_data_meta", true)){
			return $post;
		}

		return false;

	}
}

if(!function_exists('fair_edge_get_tweeter_post')){
	/**
	 * Function which get tweeter post data
	 *
	 * @return array
	 */
	function fair_edge_get_tweeter_post(){

		if($post = get_post_meta(get_the_ID(), "edgtf_post_link_twitter_data_meta", true)){
			return $post;
		}

		return false;
	}
}


if( !function_exists('fair_edge_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */

	function fair_edge_get_post_format_html($type = "") {

		$post_format = fair_edge_get_post_format($type);

		$slug = '';
		if($type !== ""){
			$slug = $type;
			if ($type == 'masonry-full-width'){
				$slug = 'masonry';
			}

			if ($type == 'narrow'){
				$post_format = 'standard';
			}
		}

		$params = array();
		$params['read_more'] = 'no';
		$params['type'] = $type;
		$params['soundcloud'] = false;

		if($post_format == 'audio' && get_post_meta(get_the_ID(), "edgtf_audio_post_type_meta", true) == 'soundcloud' && get_post_meta(get_the_ID(), "edgtf_post_audio_soundcloud_link_meta", true) !== "") {
			$params['soundcloud'] = true;
		}

		$chars_array = fair_edge_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}

		if($post_format == 'twitter') {
			$twitter_params = fair_edge_get_tweeter_post();

			$params['twitter_text'] = $twitter_params['text'];
			$params['twitter_author'] = $twitter_params['author'];
			$params['twitter_time'] = $twitter_params['time'];
		}

		if($post_format == 'instagram') {
			$instagram_params = fair_edge_get_instagram_post();
			$params['instagram_thumbnail_url'] = $instagram_params['thumbnail_url'];
			$params['instagram_thumbnail_width'] = $instagram_params['thumbnail_width'];
			$params['instagram_thumbnail_height'] = $instagram_params['thumbnail_height'];
			$params['instagram_title'] = $instagram_params['title'];
		}

		if($type == 'masonry-gallery'){
			$size = 'default';

			if (get_post_meta(get_the_ID(), 'edgtf_blog_masonry_gallery_dimensions', true) !== '') {
				$size = get_post_meta(get_the_ID(), 'edgtf_blog_masonry_gallery_dimensions', true);
			}
			$params['post_class'] = array('edgtf-post-size-'. $size);
			if (get_post_meta(get_the_ID(), 'edgtf_blog_masonry_gallery_skin', true) !== '') {
				$params['post_class'][] = 'edgtf-masonry-gallery-item-skin-'.get_post_meta(get_the_ID(), 'edgtf_blog_masonry_gallery_skin', true);
			}

			$params['image_size'] =  fair_edge_get_masonry_gallery_image_size(get_the_ID(), $size);
		}

		if($type == 'masonry' || $type == 'masonry-full-width'){
			$params['read_more'] = 'yes';
		}

		fair_edge_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);

	}

}

if( !function_exists('fair_edge_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function fair_edge_get_default_blog_list() {

		$blog_list = fair_edge_options()->getOptionValue('blog_list_type');
		return $blog_list;

	}

}

if( !function_exists('fair_edge_get_masonry_gallery_image_size') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function fair_edge_get_masonry_gallery_image_size($post_id, $size) {

		$image_size = 'fair_edge_square';

		switch($size):

			case 'large-width':
				$image_size = 'fair_edge_large_width';
				break;
			case 'large-height':
				$image_size = 'fair_edge_large_height';
				break;
			case 'large-width-height':
				$image_size = 'fair_edge_large_width_height';
				break;
		endswitch;

		return $image_size;
	}

}
if (!function_exists('fair_edge_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function fair_edge_pagination($pages = '', $range = 4, $paged = 1){

		$showitems = $range+1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}

		if($pages != 1){
			echo '<div class="edgtf-pagination-holder">';
				echo '<div class="edgtf-pagination">';
					echo '<ul>';
						if($paged > 2 && $paged > $range+1 && $showitems < $pages){
							echo '<li class="edgtf-pagination-first-page"><a href="'.esc_url(get_pagenum_link(1)).'"><span class="arrow_carrot-2left"></span></a></li>';
						}
						echo '<li class="edgtf-pagination-prev';
							if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
								echo ' edgtf-pagination-prev-first';
							}
						echo '"><a href="'.esc_url(get_pagenum_link($paged - 1)).'"><span class="arrow_left"></span></a></li>';

						for ($i=1; $i <= $pages; $i++){
							if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
								echo ($paged == $i)? "<li class='active'><span>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a></li>";
							}
						}

						echo '<li class="edgtf-pagination-next';
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
							echo ' edgtf-pagination-next-last';
						}
						echo '"><a href="';
						if($pages > $paged){
							echo esc_url(get_pagenum_link($paged + 1));
						} else {
							echo esc_url(get_pagenum_link($paged));
						}
						echo '"><span class="arrow_right"></span></a></li>';
						if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
							echo '<li class="edgtf-pagination-last-page"><a href="'.esc_url(get_pagenum_link($pages)).'"><span class="arrow_carrot-2right"></span></a></li>';
						}
					echo '</ul>';
				echo "</div>";
			echo "</div>";
		}
	}
}

if(!function_exists('fair_edge_post_info')){
	/**
	 * Function that loads parts of blog post info section
	 * Possible options are:
	 * 1. date
	 * 2. category
	 * 3. author
	 * 4. comments
	 * 5. like
	 * 6. share
	 *
	 * @param $config array of sections to load
	 */
	function fair_edge_post_info($config){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($author == 'yes'){
			fair_edge_get_module_template_part('templates/parts/post-info-author', 'blog');
		}

		if($date == 'yes'){
			fair_edge_get_module_template_part('templates/parts/post-info-date', 'blog');
		}

		if($category == 'yes'){
			fair_edge_get_module_template_part('templates/parts/post-info-category', 'blog');
		}

		if($comments == 'yes'){
			fair_edge_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}

		if($like == 'yes'){
			fair_edge_get_module_template_part('templates/parts/post-info-like', 'blog');
		}

		if($share == 'yes'){
			fair_edge_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
	}
}

if(!function_exists('fair_edge_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in edgt_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function fair_edge_excerpt($excerpt_length = '') {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(fair_edge_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = '45';
			if(isset($excerpt_length) && $excerpt_length != ""){
				$word_count = $excerpt_length;

			} elseif(fair_edge_options()->getOptionValue('number_of_chars') != '') {
				$word_count = esc_attr(fair_edge_options()->getOptionValue('number_of_chars'));
			}
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//add exerpt postfix
				$excert_postfix		= apply_filters('fair_edge_excerpt_postfix', '...');

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array).$excert_postfix;

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="edgtf-post-excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('fair_edge_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function fair_edge_get_blog_single() {
		$sidebar = fair_edge_sidebar_layout();
		$type = fair_edge_get_meta_field_intersect('blog_single_type');

		$params = array(
			"sidebar"	=> $sidebar,
			"type"		=> $type
		);

		fair_edge_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('fair_edge_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function fair_edge_get_single_html() {

		$single_type = fair_edge_get_meta_field_intersect('blog_single_type');

		$post_format = get_post_format();
		$supported_post_formats = array('audio', 'video', 'link', 'quote', 'gallery');
		if( !in_array($post_format,$supported_post_formats)) {
			$post_format = 'standard';
		}

		$soundcloud = false;
		if($post_format == 'audio' && get_post_meta(get_the_ID(), "edgtf_audio_post_type_meta", true) == 'soundcloud' && get_post_meta(get_the_ID(), "edgtf_post_audio_soundcloud_link_meta", true) !== "") {
			$soundcloud = true;
		}

		//Related posts
		$related_posts_params = array();
		$show_related = (fair_edge_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = fair_edge_sidebar_layout();
			$post_id = get_the_ID();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array(
				'posts_per_page' => $related_post_number
			);
			$related_posts_params = array(
				'related_posts' => fair_edge_get_related_post_type($post_id, $related_posts_options)
			);
		}


		if($single_type == 'with-title-image'){
			fair_edge_get_module_template_part('templates/single/parts/title-image-bottom', 'blog');
		} else {
			fair_edge_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog', '', array('soundcloud' => $soundcloud));
		}

		fair_edge_get_module_template_part('templates/single/parts/author-info', 'blog');
		if ($show_related) {
			fair_edge_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
		}
		comments_template('', true);
	}

}

if( !function_exists('fair_edge_get_single_top_html') ) {

	/**
	 * Function return top part on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function fair_edge_get_single_top_html() {

		fair_edge_get_module_template_part('templates/single/parts/title-image-top', 'blog');

	}

}

if( !function_exists('fair_edge_container_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function fair_edge_container_additional_post_items() {

		$query = fair_edge_get_blog_query();
		if(is_singular('post')) {
			return fair_edge_get_module_template_part('templates/single/parts/single-navigation', 'blog');
		}

		if(get_page_template_slug(fair_edge_get_page_id()) == 'blog-standard.php' || ((is_home() || (is_archive() && !fair_edge_is_woocommerce_page())) && fair_edge_options()->getOptionValue('blog_list_type') == 'standard')) {
			if (fair_edge_options()->getOptionValue('pagination') == 'yes' && $query->max_num_pages != 1) { ?>
				<div class="edgtf-container edgtf-container-bottom-navigation">
					<div class="edgtf-container-inner">
						<?php fair_edge_pagination($query->max_num_pages, fair_edge_get_blog_page_range($query), fair_edge_paged()); ?>
					</div>
				</div>
			<?php }
		}

		if(get_page_template_slug(fair_edge_get_page_id()) == 'blog-masonry.php' || ((is_home() || (is_archive() && !fair_edge_is_woocommerce_page())) && fair_edge_options()->getOptionValue('blog_list_type') == 'masonry')) {
			$pagination_type = fair_edge_options()->getOptionValue('masonry_pagination');
			if (fair_edge_options()->getOptionValue('pagination') == 'yes' && ($pagination_type != 'load-more' && $pagination_type != 'infinite-scroll')) {
				fair_edge_pagination($query->max_num_pages, fair_edge_get_blog_page_range($query), fair_edge_paged());
			}
		}
	}
	add_action('fair_edge_after_container_close', 'fair_edge_container_additional_post_items');
}

if( !function_exists('fair_edge_full_width_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 *
	 * @return single.php html
	 */

	function fair_edge_full_width_additional_post_items() {

		$query = fair_edge_get_blog_query();

		if(get_page_template_slug(fair_edge_get_page_id()) == 'blog-narrow.php'|| ((is_home() || is_archive()) && fair_edge_options()->getOptionValue('blog_list_type') == 'blog-narrow')) {
			if (fair_edge_options()->getOptionValue('pagination') == 'yes'  && $query->max_num_pages != 1) { ?>
				<div class="edgtf-container edgtf-container-bottom-navigation">
					<div class="edgtf-container-inner">
						<?php fair_edge_pagination($query->max_num_pages, fair_edge_get_blog_page_range($query), fair_edge_paged()); ?>
					</div>
				</div>
			<?php }
		}

		if(get_page_template_slug(fair_edge_get_page_id()) == 'blog-masonry-gallery.php') {
			$pagination_type = fair_edge_options()->getOptionValue('masonry_gallery_pagination');
			if (fair_edge_options()->getOptionValue('pagination') == 'yes' && $pagination_type == 'standard' && $query->max_num_pages != 1) { ?>
				<div class="edgtf-container edgtf-container-bottom-navigation">
					<?php fair_edge_pagination($query->max_num_pages, fair_edge_get_blog_page_range($query), fair_edge_paged()); ?>
				</div>
			<?php }
		}

		if(get_page_template_slug(fair_edge_get_page_id()) == 'blog-masonry-full-width.php'|| ((is_home() || is_archive()) && fair_edge_options()->getOptionValue('blog_list_type') == 'blog-masonry-full-width')) {
			$pagination_type = fair_edge_options()->getOptionValue('masonry_pagination');
			if (fair_edge_options()->getOptionValue('pagination') == 'yes' && $query->max_num_pages != 1 && ($pagination_type != 'load-more' && $pagination_type != 'infinite-scroll')) { ?>
				<div class="edgtf-container edgtf-container-bottom-navigation">
					<?php fair_edge_pagination($query->max_num_pages, fair_edge_get_blog_page_range($query), fair_edge_paged()); ?>
				</div>
			<?php }
		}
	}
	add_action('fair_edge_after_full_width_container_close', 'fair_edge_full_width_additional_post_items');
}


if (!function_exists('fair_edge_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */

	function fair_edge_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'edgtf-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' edgtf-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' edgtf-pingback-comment';
		}

		?>

		<li <?php comment_class(); ?>>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="edgtf-comment-image"> <?php echo fair_edge_kses_img(get_avatar($comment, 110)); ?> </div>
			<?php } ?>
			<div class="edgtf-comment-text">
				<div class="edgtf-comment-info">
					<div class="edgtf-comment-info-inner">
						<h5 class="edgtf-comment-name">
							<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'fair'); } ?>
							<?php echo wp_kses_post(get_comment_author_link()); ?>
							<?php if($is_author_comment) { ?>
								<i class="fa fa-user post-author-comment-icon"></i>
							<?php } ?>
						</h5>
						<span class="edgtf-comment-date"><?php comment_time(get_option('date_format')); ?> <?php comment_time(get_option('time_format')); ?></span>
					</div>
					<span class="edgtf-reply-edit-holder">
						<?php
						edit_comment_link();
						comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) );
						?>
					</span>
				</div>
			<?php if(!$is_pingback_comment) { ?>
				<div class="edgtf-text-holder" id="comment-<?php echo comment_ID(); ?>">
					<?php comment_text(); ?>
				</div>
			<?php } ?>
		</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}
}

if( !function_exists('fair_edge_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */

	function fair_edge_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, fair_edge_blog_full_width_types())){
			$classes['holder'] = 'edgtf-full-width';
			$classes['inner'] = 'edgtf-full-width-inner';
		} elseif(in_array($blog_type, fair_edge_blog_grid_types())){
			$classes['holder'] = 'edgtf-container';
			$classes['inner'] = 'edgtf-container-inner clearfix';
		}

		return $classes;

	}

}

if( !function_exists('fair_edge_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */

	function fair_edge_blog_full_width_types() {

		$types = array('masonry-full-width','narrow','masonry-gallery');

		return $types;

	}

}

if( !function_exists('fair_edge_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function fair_edge_blog_grid_types() {

		$types = array('standard', 'masonry', 'standard-whole-post');

		return $types;

	}

}

if( !function_exists('fair_edge_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */

	function fair_edge_blog_types() {

		$types = array_merge(fair_edge_blog_grid_types(), fair_edge_blog_full_width_types());

		return $types;

	}

}

if( !function_exists('fair_edge_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */

	function fair_edge_blog_templates() {

		$templates = array();
		$grid_templates = fair_edge_blog_grid_types();
		$full_templates = fair_edge_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;

	}

}

if( !function_exists('fair_edge_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */

	function fair_edge_blog_lists_number_of_chars() {

		$number_of_chars = array();

		if(fair_edge_options()->getOptionValue('standard_number_of_chars')) {
			$number_of_chars['standard'] = fair_edge_options()->getOptionValue('standard_number_of_chars');
		}
		if(fair_edge_options()->getOptionValue('masonry_number_of_chars')) {
			$number_of_chars['masonry'] = fair_edge_options()->getOptionValue('masonry_number_of_chars');
			$number_of_chars['masonry-full-width'] = fair_edge_options()->getOptionValue('masonry_number_of_chars');
		}
		if(fair_edge_options()->getOptionValue('narrow_number_of_chars')) {
			$number_of_chars['narrow'] = fair_edge_options()->getOptionValue('narrow_number_of_chars');
		}

		return $number_of_chars;

	}

}

if (!function_exists('fair_edge_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function fair_edge_excerpt_length( $length ) {

		if(fair_edge_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(fair_edge_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'fair_edge_excerpt_length', 999 );
}

if (!function_exists('fair_edge_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function fair_edge_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'fair_edge_excerpt_more');
}

if(!function_exists('fair_edge_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function fair_edge_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('fair_edge_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function fair_edge_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('fair_edge_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function fair_edge_modify_read_more_link() {
		$link = '<div class="edgtf-more-link-container">';
		$link .= fair_edge_get_button_html(array(
			'size' => 'small',
			'type' => 'solid',
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'fair')
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'fair_edge_modify_read_more_link');
}


if( !function_exists('fair_edge_blog_style') ) {

    /**
     * Function that return blog style
     */

    function fair_edge_blog_style($style) {
        $id = fair_edge_get_page_id();
        $class_prefix = fair_edge_get_unique_page_class();

        $blog_single_bottom_width_selector = array(
            $class_prefix.' .edgtf-blog-with-title-image .edgtf-post-info-outer',
            $class_prefix.' .edgtf-blog-with-title-image .edgtf-comments-holder-outer',
            $class_prefix.' .edgtf-blog-with-title-image .edgtf-author-description',
            $class_prefix.' .edgtf-blog-with-title-image .edgtf-related-posts-holder',
        );

        $blog_single_width = array();
        $bottom_content_width = get_post_meta($id, "edgtf_blog_single_image_bottom_width_meta", true);

        if($bottom_content_width){
            $blog_single_width['width'] = $bottom_content_width.'%';
        }

        $current_style = fair_edge_dynamic_css($blog_single_bottom_width_selector, $blog_single_width);
		$style[]       = $current_style;

        return $style;

    }
    add_filter('fair_edge_add_page_custom_style', 'fair_edge_blog_style');
}

if(!function_exists('fair_edge_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function fair_edge_has_blog_widget() {
		$widgets_array = array(
			'edgt_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('fair_edge_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function fair_edge_has_blog_shortcode() {
		$blog_shortcodes = array(
			'edgtf_blog_list',
			'edgtf_blog_slider',
			'edgtf_blog_carousel'
		);

		$slider_field = get_post_meta(fair_edge_get_page_id(), 'edgtf_page_slider_meta', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = fair_edge_has_shortcode($blog_shortcode) || fair_edge_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}


if(!function_exists('fair_edge_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see fair_edge_is_ajax_enabled()
	 * @see fair_edge_is_ajax_enabled_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see edgt_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see edgt_has_blog_widget()
	 * @return bool
	 */
	function fair_edge_load_blog_assets() {
		return fair_edge_is_ajax_enabled() || fair_edge_is_blog_template() || is_home() || is_single() || fair_edge_has_blog_shortcode() || is_archive() || is_search() || fair_edge_has_blog_widget();
	}
}

if(!function_exists('fair_edge_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see fair_edge_get_page_template_name()
	 */
	function fair_edge_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = fair_edge_get_page_template_name();
		}

		$blog_templates = fair_edge_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('fair_edge_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function fair_edge_read_more_button($option = '', $class = '') {
		if($option != '') {
			$show_read_more_button = fair_edge_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if($show_read_more_button && !fair_edge_post_has_read_more() && !post_password_required()) {
			echo fair_edge_get_button_html(array(
				'size'         => 'small',
				'type'         => 'solid',
				'link'         => get_the_permalink(),
				'text'         => esc_html__('Read More', 'fair'),
				'custom_class' => $class
			));
		}
	}
}

if(!function_exists('fair_edge_is_masonry_template')){
	/**
     * Check if is masonry template enabled
     * return boolean
     */ 
	function fair_edge_is_masonry_template(){
			
			$page_id = fair_edge_get_page_id();
			$page_template = get_page_template_slug($page_id);
			$page_options_template = fair_edge_options()->getOptionValue('blog_list_type');

			if(!is_archive()){
				if($page_template == 'blog-masonry.php' ||  $page_template =='blog-masonry-full-width.php'){
					return true;
				}
			}elseif(is_archive() || is_home()){
				if($page_options_template == 'masonry' || $page_options_template == 'masonry-full-width'){
					return true;
				}
			}			
			else{
				return false;
			}
	}

}

if(!function_exists('fair_edge_get_max_number_of_pages')) {
    /**
     * Function that return max number of posts/pages for pagination
     * @return int
     *
     * @version 0.1
     */
    function fair_edge_get_max_number_of_pages() {
        global $wp_query;

        $max_number_of_pages = 10; //default value
        
        if($wp_query) {
            $max_number_of_pages = $wp_query->max_num_pages;
        }

        return $max_number_of_pages;
    }
}

if(!function_exists('fair_edge_get_blog_page_range')) {
    /**
     * Function that return current page for blog list pagination
     * @return int
     *
     * @version 0.1
     */
    function fair_edge_get_blog_page_range($query = '') {
        global $wp_query;

		if($query == ''){
			$query = $wp_query;
		}

        if(fair_edge_options()->getOptionValue('blog_page_range') != ""){
            $blog_page_range = esc_attr(fair_edge_options()->getOptionValue('blog_page_range'));
        } else{
			$blog_page_range = $query->max_num_pages;
        }
        return $blog_page_range;
    }
}

if ( ! function_exists('fair_edge_comment_form_submit_button')) {
    /**
     * Override comment form submit button
     *
     * @return mixed|string
     */
    function fair_edge_comment_form_submit_button() {

        $comment_form_button = fair_edge_get_button_html(array(
            'html_type'     => 'input',
            'type'          => 'solid',
            'input_name'    => 'submit',
            'text'          => 'Submit'
        ));

        return $comment_form_button;
    }

    add_filter('comment_form_submit_button', 'fair_edge_comment_form_submit_button');

}
?>