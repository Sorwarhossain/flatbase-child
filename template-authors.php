<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
/* Template Name: Authors */

get_header(); ?>

<section class="homepage-sections">
	<div class="col-full">
		<div class="grid clearfix">
			<div class="row clearfix">
				<div class="col-2-3 first">
					<!-- Homepage Reviews Section -->
					<div class="homepage_reviews_wrapper">
					<?php 
					$args = array(
						'post_type' => 'article',
						'tax_query' => array(
							array(
								'taxonomy' => 'article-category',
								'field'    => 'slug',
								'terms'    => 'authors',
							),
						),
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

							<a href="#" class="cat_link"><i class="fa fa-folder"></i> Featured Lifestyle</a>
						</div>

					<?php 
					endwhile; endif;
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