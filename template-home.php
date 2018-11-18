<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
/* Template Name: Home */

get_header(); ?>

<section class="homepage-sections">
	<div class="col-full">
		<div class="grid clearfix">
			<div class="row clearfix">
				<div class="col-2-3 first">
					<?php include('inc/homepage-sections.php'); ?>
				</div>
				<div class="columns-3">
					<?php dynamic_sidebar( 'Primary' ); ?>
				</div>
			</div>
			
		</div>
	</div>
</section>


<?php get_footer();