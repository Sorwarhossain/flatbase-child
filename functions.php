<?php

require_once get_stylesheet_directory() . '/inc/widgets/categoriesed_articles_widget.php';


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

   wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css' );
}

add_filter( 'excerpt_length', function( $length ) { return 20; } );



function the_child_user_rating($reviews){
	$total_rate = 0;
	$rev_count = 0;
	foreach($reviews as $review){

		$user_meta=get_userdata($review->user_id);
		$user_roles = $user_meta->roles;

		if(!in_array('editor', $user_roles) && !in_array('author', $user_roles) && !in_array('administrator', $user_roles)){
			$total_rate = $total_rate + $review->rating[0];
			$rev_count++;
		}

	}
	if($total_rate > 0){
		echo "<h2>". $total_rate/$rev_count ."%</h2>";
	} else {
		echo "<h2>Not Rated</h2>";
	}
}


function the_child_ovarall_rating($reviews){
	$total_rate = 0;
	$rev_count = count($reviews);
	foreach($reviews as $review){
		$total_rate = $total_rate + $review->rating[0];
	}
	if($total_rate > 0){
		echo "<h2>". $total_rate/$rev_count ."%</h2>";
	} else {
		echo "<h2>Not Rated</h2>";
	}
}

function get_child_total_comments($reviews){

	$rev_count = count($reviews);
	if($rev_count > 0){
		if($rev_count == 1){
			return $rev_count . " Comment";
		}
		return $rev_count . " Comments";
	} else {
		return "No Comments";
	}
}


function the_child_editor_rating($reviews){
	$total_rate = 0;
	$rev_count = 0;
	foreach($reviews as $review){

		$user_meta=get_userdata($review->user_id);
		$user_roles = $user_meta->roles;

		if(in_array('editor', $user_roles) || in_array('author', $user_roles) || in_array('administrator', $user_roles)){
			$total_rate = $total_rate + $review->rating[0];
			$rev_count++;
		}

	}
	if($total_rate > 0){
		echo "<h2>". $total_rate/$rev_count ."%</h2>";
	} else {
		echo "<h2>Not Rated</h2>";
	}
}

function child_get_limit_text($text, $limit=30){
	$array = explode( "\n", wordwrap( $text, $limit));
	return $array['0'];
}