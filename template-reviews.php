<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
/* Template Name: Reviews */

get_header(); ?>

<section class="homepage-sections">
	<div class="col-full">
		<div class="grid clearfix">
			<div class="row clearfix">
				<div class="col-2-3 first">
					<!-- Homepage Reviews Section -->
					<div class="homepage_reviews_wrapper">
					<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$posts_per_page = 8;
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => $posts_per_page,
						'paged' => $paged,
					);
					$loop = new WP_Query($args);	
					if($loop->have_posts()) : 
						while($loop->have_posts()): $loop->the_post();
					?>
						<div class="single_review">
						<?php 
							$thumb_src = get_the_post_thumbnail_url();
							if($thumb_src == false) {
								$thumb_src = 'https://via.placeholder.com/600x300';
							}
						?>
							<div class="review_thumb">
								<img src="<?php echo $thumb_src; ?>" alt="">
							</div>
							<h3><?php the_title(); ?></h3>
							<h5>Posted On <?php the_time('F j, Y'); ?> by Thomas</h5>
							<p><?php echo wp_trim_excerpt(get_the_excerpt()); ?></p>

							<a href="<?php the_permalink(); ?>" class="readmore">Continue Reading</a>
							<a href="#" class="cat_link"><i class="fa fa-comments"></i> <?php echo get_child_comment_count(get_comments_number()); ?></a>
						</div>

					<?php 
					endwhile; 

					$total_pages = $loop->max_num_pages;
					if ($total_pages > 1){
						echo '<div class="pagination_wrapper">';
							$current_page = max(1, get_query_var('paged'));
					        echo paginate_links(array(
					            'base' => get_pagenum_link(1) . '%_%',
					            'format' => 'page/%#%',
					            'current' => $current_page,
					            'total' => $total_pages,
					            'prev_text'    => __('« prev'),
					            'next_text'    => __('next »'),
					        ));
					    echo '</div>';
					}



				endif;
					?>
					</div>
					<!-- End Homepage Reviews Section -->
				</div>
				<div class="columns-3">
					<?php dynamic_sidebar( 'Primary' ); ?>
				</div>
			</div>
			
		</div>
	</div>
</section>


<?php get_footer();