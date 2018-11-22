<?php 
/* ========================================================
// Homepage Infobox Section
========================================================= */
$nice_infobox_enable = get_option( 'nice_infobox_enable' );
$nice_infobox_order = get_option( 'nice_infobox_order' );

if ( $nice_infobox_order == '' )
	$nice_infobox_order = 'date';

if ( $nice_infobox_enable == 'true' ) :

	nicethemes_infoboxes( array(	'orderby'		=> $nice_infobox_order,
							'numberposts'	=> 3,
							'before' 		=> '<section id="infoboxes" class="infoboxes home-block clearfix"><div class="col-full">',
							'after'			=> '</div></section><!--/.#infobox-->' )
					);

endif;
/* ========================================================
// End Homepage Infobox Section
========================================================= */


/* ========================================================
// Homepage Knowledgebase Section
========================================================= */
// if ( isset( $nice_options['nice_articles_entries'] ) ) $number_articles = $nice_options['nice_articles_entries'];
// else $number_articles = 5;

// nicethemes_knowledgebase( array(	'columns'		=> 3,
// 							'numberposts'	=> $number_articles,
// 							'before'		=> '<section id="knowledgebase" class="home-block clearfix"><div class="col-full">',
// 							'after'			=> '</div></section>' ) );
/* ========================================================
// End Homepage Knowledgebase Section
========================================================= */




/* ========================================================
// Homepage Video Section
========================================================= */
$nice_video_enable = get_option( 'nice_video_enable' );
$nice_video_order = get_option( 'nice_video_order' );

if ( $nice_video_order == '' )
	$nice_video_order = 'date';

if ( $nice_video_enable == 'true' ) : ?>



	<?php

		if ( isset( $nice_options['nice_video_entries'] ) ) $number_videos = $nice_options['nice_video_entries'];
		else $number_videos = 5;

		nice_home_videos( array( 'numberposts' => $number_videos, 'orderby' => $nice_video_order,
									'before'	=> '<section id="home-videos" class="videos home-block clearfix"><div class="col-full">',
									'after'		=> '</div></section>'
									 ) );

	?>
<?php endif; ?>
<!-- Ena Homepage Video Section -->



<!-- Homepage Reviews Section -->
<div class="homepage_reviews_wrapper">
<?php 
$args = array(
	'post_type' => 'post',
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

		<?php 
		$reviews = CBRatingSystemData::get_user_ratings_with_ratingForm(array(1), array(get_the_ID()), array(), '', 'created', 'DESC', array(), true);
		?>
		<a href="#" class="cat_link"><i class="fa fa-comments"></i> <?php echo get_child_total_comments($reviews); ?></a>
	</div>

<?php 
endwhile; endif;
?>
</div>
<!-- End Homepage Reviews Section -->





<?php $nice_footer_columns = ( ! empty( $nice_options['nice_footer_columns'] ) ) ? $nice_options['nice_footer_columns'] : '3'; ?>

<?php $class = ' columns-' . esc_attr( intval( $nice_footer_columns ) ); ?>

<?php if ( 	is_active_sidebar( 'pre-footer-1' ) ||
			is_active_sidebar( 'pre-footer-2' ) ||
			is_active_sidebar( 'pre-footer-3' ) ) : ?>

	<section id="pre-footer-widgets" class="pre-footer-widgets home-block clearfix">

		<div class="col-full">

			<div class="grid">

				<div class="widget-section odd first  <?php echo $class; ?>">
					<?php dynamic_sidebar( 'pre-footer-1' ); ?>
				</div>

				<div class="widget-section even  <?php echo $class; ?>">
					<?php dynamic_sidebar( 'pre-footer-2' ); ?>
				</div>

				<?php if ( $nice_footer_columns == '3' || $nice_footer_columns == '4' ) : ?>
				<?php if ( $nice_footer_columns == '3' ) $class .= ' last'; ?>
				<div class="widget-section odd  <?php echo $class; ?>">
					<?php dynamic_sidebar( 'pre-footer-3' ); ?>
				</div>
				<?php endif; ?>
				<?php if ( $nice_footer_columns == '4' ) : ?>
				<div class="widget-section odd <?php echo $class; ?> last">
					<?php dynamic_sidebar( 'pre-footer-4' ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>

	<!-- END #home-widgets -->
	</section>

<?php endif; ?>