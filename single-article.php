<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

/* Template Name: Full Width */

get_header(); ?>

<!-- BEGIN #content -->
<section id="content" class="full-width <?php echo $post->post_name; ?>">

<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<div class="article_rating_meta">
					<div class="grid clearfix">	
						<div class="row clearfix">
							<div class="columns-3 padding-right-30">	
								<?php 
								if(has_post_thumbnail()){
									the_post_thumbnail('full', array('class'=> 'img-responsive'));
								}
								?>
							</div>
							<div class="col-2-3 float-right">	
								<div class="grid clearfix">	
									<div class="row clearfix rating_collumns">
										<div class="columns-3 single_rating">
											<h3>Editor Rating</h3>
											<?php 
											$reviews = CBRatingSystemData::get_user_ratings_with_ratingForm(array(1), array(get_the_ID()), array(), '', 'created', 'DESC', array(), true);
											the_child_editor_rating($reviews);
											?>
											<p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, rerum, dolores voluptatibus repellat quam quas dolorum excepturi, asperiores perferendis amet, corporis! Obcaecati.</p>
										</div>
										<div class="columns-3 single_rating">
											<h3>User Rating</h3>
											<?php the_child_user_rating($reviews); ?>

											<p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, rerum, dolores voluptatibus repellat quam quas dolorum excepturi, asperiores perferendis amet..</p>
										</div>
										<div class="columns-3 single_rating">
											<h3>Ovarall Rating</h3>
											<?php the_child_ovarall_rating($reviews); ?>

											<p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, rerum, dolores voluptatibus repellat quam quas dolorum.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="entry clearfix">

					<?php the_content(); ?>

					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'nicethemes' ), 'after' => '</div>' ) ); ?>

				</div>

				<?php	comments_template( '', true ); ?>


				<?php if(function_exists('the_ratings')) { the_ratings(); } ?>

		<?php endwhile; ?>

<?php else : ?>

		<header>
			<h2><?php _e( 'Not Found', 'nicethemes' ); ?></h2>
		</header>
		<p><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'nicethemes' ); ?></p>

		<?php get_search_form(); ?>

<?php endif; ?>

<!-- END #content -->
</section>

<?php get_footer();