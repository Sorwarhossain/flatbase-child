<?php

if( ! function_exists('function_name') ){
	function function_name(){
		register_widget('ChildCategorizedArticle');
	}
	add_action('widgets_init', 'function_name');
}


class ChildCategorizedArticle extends WP_Widget{
	function __construct(){
		parent::__construct(
			'ChildCategorizedArticle',
			__('Child Categorized Articles', 'text-domain'),
			array('description' => __('Display any categorized', 'text-domain'))
		);
	}

	public function widget($args, $instance){
		extract( $args );
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	    // The following variable is for a checkbox option type
	    $post_count = $instance[ 'show_posts' ] ? $instance[ 'show_posts' ] : '3';
	    $article_cat = $instance[ 'article_cat' ] ? $instance[ 'article_cat' ] : '';


		
		echo  $args['before_widget'];
		if ( $title ) {
	        echo $before_title . $title . $after_title;
	    }

	    $posts = get_posts($args);


	    $args = array(
		    'post_type' => 'article',
		    'post_status' => 'publish',
		    'posts_per_page' => $post_count,
		    'tax_query' => array(
		        array(
		            'taxonomy' => 'article-category',
		            'field'    => 'slug',
		            'terms'    => array( $article_cat )
		        )
		    )
		);
		$posts = get_posts( $args );

	    echo '<div class="categorized_wrapper">';
	    if(count($posts) > 0){
	    	foreach($posts as $post) {

	    		$thumb_src = get_the_post_thumbnail_url($post->ID);
				if($thumb_src == false) {
					$thumb_src = 'https://via.placeholder.com/100x100';
				}

	    		?>

				<div class="categorized_item">
					<?php //echo var_dump($post); ?>
					<div class="categorized_item_thumb">
						<img src="<?php echo $thumb_src; ?>" alt="">
					</div>
					<h3><a href="<?php the_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3>
					<h5><?php echo get_the_time('F j, Y', $post->ID); ?></h5>
				</div>


			<?php
	    	}
	    }


	    echo '</div></div>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$defaults = array( 'title' => __( 'Default Title', 'bestblog' ), 'show_posts' => '3' );
	    $instance = wp_parse_args( ( array ) $instance, $defaults ); 

	    $article_cat = esc_attr( $instance[ 'article_cat' ] );
	    ?>


	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
	        <input class="widefat"  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
	    </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'show_posts' ); ?>">Number of posts to show:</label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'show_posts' ); ?>" name="<?php echo $this->get_field_name( 'show_posts' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'show_posts' ] ); ?>" />
		</p>
		<p>
			<?php 
			$categories = get_terms( 'article-category', array(
			    'hide_empty' => false
			) );
			?>
			<label for="<?php echo $this->get_field_id( 'article_cat' ); ?>">Select Article Category</label>
			<select name="<?php echo $this->get_field_name( 'article_cat' ); ?>" id="<?php echo $this->get_field_id( 'article_cat' ); ?>">
			<?php 
			if(count($categories)> 0){
				foreach($categories as $category){
					if($article_cat != $category->slug){
						echo '<option value="'. $category->slug .'">'. $category->name .'</option>';
					} else {
						echo '<option value="'. $category->slug .'" selected>'. $category->name .'</option>';
					}
				}
			}
			?>
			</select>
		</p>
		<?php 
	}

	function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;
	    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
	    // The update for the variable of the checkbox
	    $instance[ 'show_posts' ] = $new_instance[ 'show_posts' ];
	    $instance[ 'article_cat' ] = $new_instance[ 'article_cat' ];


	    return $instance;
	}
}
