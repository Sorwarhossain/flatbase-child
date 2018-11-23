<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

get_header(); ?>


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








<!-- BEGIN #content -->
<section id="content">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article <?php post_class(); ?>>
			<header>
				<?php nice_post_meta(); ?>
			</header>
			
			<div class="entry">

				<?php
				$embed = get_post_meta( $id, 'embed', true );
				$video_class = '';

				if ( $embed <> '' ){
					echo nice_embed( array ( 'id' => get_the_ID() ) );
					$video_class = ' has-video';
				} ?>

					<div class="post-content<?php echo $video_class; ?>">
						<?php the_content( __( 'Continue reading', 'nicethemes' ) . ' &raquo;' ); ?>
					</div>

			</div>

			<footer class="entry-meta">

				<?php if ( $tags = get_the_tag_list() ) : ?>
					<span class="tag-links">
						<?php the_tags( '<i class="fa fa-tag"></i>', '', ''); ?>
					</span>
				<?php endif; ?>

				<?php if ( $categories = get_the_category_list() ) : ?>
					<span class="category-links">
						<i class="fa fa-archive"></i> <?php the_category( ' ', '', ''); ?>
					</span>
				<?php endif; ?>

			</footer>

		</article>

		<?php nice_pagenavi(); ?>

		<?php
			if ( nice_bool ( get_option( 'nice_post_author' ) ) )
				nice_post_author();
		?>

		<?php comments_template( '', true ); ?>

	<?php endwhile; ?>

<!-- END #content -->
</section>

<?php
get_footer();