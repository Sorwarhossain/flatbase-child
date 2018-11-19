<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}

global $nice_options;
?>
<!DOCTYPE html>
<!--[if IE 7]>	<html class="ie ie7" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">	<![endif]-->
<!--[if IE 8]>	<html class="ie ie8" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">	<![endif]-->
<!--[if IE 9]>	<html class="ie ie9" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">	<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '&laquo;', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>

	<!-- Pingback -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrapper -->
<div id="wrapper">

	<!-- BEGIN #header -->
	<header id="header" class="clearfix">

		<!-- BEGIN #top -->
		<div id="top" class="col-full">

			<!-- BEGIN #logo -->
			<?php nice_logo( array( 'before'	=> '<div id="logo" class="fl">',
									'after'		=> '</div>'
						 ) ); ?>
			<!-- END #logo -->

			<a href="#" id="toggle-nav"><i class="fa fa-bars"></i></a>

			<!-- BEGIN #navigation -->
			<nav id="navigation">

			<?php $defaults = array(
								'menu'				=> '',
								'container'			=> 'div',
								'container_class'	=> '',
								'container_id'		=> '',
								'menu_class'		=> 'nav fl clearfix',
								'menu_id'			=> 'main-nav',
								'echo'				=> true,
								'fallback_cb'		=> '',
								'before'			=> '',
								'after'				=> '',
								'link_before'		=> '',
								'link_after'		=> '',
								'depth'				=> 0,
								'walker'			=> new Nice_Walker_Nav_Menu(),
								'theme_location'	=> 'navigation-menu' );
			?>

			<?php wp_nav_menu( $defaults ); ?>

			<!-- END #navigation -->
			</nav>

		<!-- END #top -->
		</div>

	<?php

	$nice_livesearch_enable = get_option( 'nice_livesearch_enable' );

	if (  nice_bool( $nice_livesearch_enable )  && ( is_front_page() || is_page_template( 'template-home.php' ) ) ) : ?>


	<!-- #live-search -->
	<section id="live-search" class="clearfix">
		<div class="container col-full">

			<?php

			$nice_welcome_message = get_option( 'nice_welcome_message' );
			$nice_welcome_message_extended = get_option( 'nice_welcome_message_extended' );

			if ( ( ( $nice_welcome_message != '' ) || ( $nice_welcome_message_extended != '' ) ) && is_front_page() ) : ?>

					<!-- BEGIN .welcome-message -->
					<section class="welcome-message clearfix">

							<div class="col-full">

								<?php if ( $nice_welcome_message != '' ) : ?>
									<header>
										<h2><?php echo stripslashes( htmlspecialchars_decode( nl2br( $nice_welcome_message ) ) ); ?></h2>
									</header>
								<?php endif ;?>

							</div>

					<!-- END .welcome-message -->
					</section>

			<?php endif; ?>


				<?php
				$social_items = '';

				if ( $nice_options["nice_facebook_url"] <> '' )
					$social_items .= '<li id="facebook"><a href="' . esc_url( $nice_options["nice_facebook_url"] ) . '"><i class="fa fa-facebook"></i></a></li>';

				if ( $nice_options["nice_twitter_url"] <> '' )
					$social_items .= '<li id="twitter"><a href="' . esc_url( $nice_options["nice_twitter_url"] ) . '"><i class="fa fa-twitter"></i></a></li>';

				if ( $nice_options["nice_instagram_url"] <> '' )
					$social_items .= '<li id="instagram"><a href="' . esc_url( $nice_options["nice_instagram_url"] ) . '"><i class="fa fa-instagram"></i></a></li>';

				if ( $nice_options["nice_google_url"] <> '' )
					$social_items .= '<li id="google"><a href="' . esc_url( $nice_options["nice_google_url"] ) . '"><i class="fa fa-google-plus"></i></a></li>';

				if ( $nice_options["nice_dribbble_url"] <> '' )
					$social_items .= '<li id="dribbble"><a href="' . esc_url( $nice_options["nice_dribbble_url"] ) . '"><i class="fa fa-dribbble"></i></a></li>';

				if ( $nice_options["nice_vimeo_url"] <> '' )
					$social_items .= '<li id="vimeo"><a href="' . esc_url( $nice_options["nice_vimeo_url"] ) . '"><i class="fa fa-vimeo-square"></i></a></li>';

				if ( $nice_options["nice_tumblr_url"] <> '' )
					$social_items .= '<li id="tumblr"><a href="' . esc_url( $nice_options["nice_tumblr_url"] ) . '"><i class="fa fa-tumblr"></i></a></li>';

				if ( $nice_options["nice_flickr_url"] <> '' )
					$social_items .= '<li id="flickr"><a href="' . esc_url( $nice_options["nice_flickr_url"] ) . '"><i class="fa fa-flickr"></i></a></li>';

				if ( $nice_options["nice_youtube_url"] <> '' )
					$social_items .= '<li id="youtube"><a href="' . esc_url( $nice_options["nice_youtube_url"] ) . '"><i class="fa fa-youtube-play"></i></a></li>';

				if ( $nice_options["nice_linkedin_url"] <> '' )
					$social_items .= '<li id="linkedin"><a href="' . esc_url( $nice_options["nice_linkedin_url"] ) . '"><i class="fa fa-linkedin"></i></a></li>';

				if ( $nice_options["nice_dropbox_url"] <> '' )
					$social_items .= '<li id="dropbox"><a href="' . esc_url( $nice_options["nice_dropbox_url"] ) . '"><i class="fa fa-dropbox"></i></a></li>';

				if ( $nice_options["nice_foursquare_url"] <> '' )
					$social_items .= '<li id="foursquare"><a href="' . esc_url( $nice_options["nice_foursquare_url"] ) . '"><i class="fa fa-foursquare"></i></a></li>';

				if ( $nice_options["nice_pinterest_url"] <> '' )
					$social_items .= '<li id="pinterest"><a href="' . esc_url( $nice_options["nice_pinterest_url"] ) . '"><i class="fa fa-pinterest"></i></a></li>';

				if ( $nice_options["nice_skype_url"] <> '' )
					$social_items .= '<li id="skype"><a href="' . esc_url( $nice_options["nice_skype_url"] ) . '"><i class="fa fa-skype"></i></a></li>';

				if ( $nice_options["nice_bitbucket_url"] <> '' )
					$social_items .= '<li id="bitbucket"><a href="' . esc_url( $nice_options["nice_bitbucket_url"] ) . '"><i class="fa fa-bitbucket"></i></a></li>';

				if ( $nice_options["nice_github_url"] <> '' )
					$social_items .= '<li id="github"><a href="' . esc_url( $nice_options["nice_github_url"] ) . '"><i class="fa fa-github"></i></a></li>';

				if ( $nice_options["nice_stack_exchange_url"] <> '' )
					$social_items .= '<li id="stack-exchange"><a href="' . esc_url( $nice_options["nice_skype_url"] ) . '"><i class="fa fa-stack-exchange"></i></a></li>';

				if ( $nice_options["nice_stack_overflow_url"] <> '' )
					$social_items .= '<li id="stack-overflow"><a href="' . esc_url( $nice_options["nice_skype_url"] ) . '"><i class="fa fa-stack-overflow"></i></a></li>';

				if ( $nice_options["nice_trello_url"] <> '' )
					$social_items .= '<li id="trello"><a href="' . esc_url( $nice_options["nice_trello_url"] ) . '"><i class="fa fa-trello"></i></a></li>';


				if ( ! empty ( $social_items ) ) :
				?>

				<div class="social-links clearfix">

					<ul id="social">
						<?php echo $social_items; ?>
					</ul>

				</div>
				<?php endif; ?>


		</div>
	</section>
	<!-- /#live-search -->



<?php endif; ?>

	<!-- END #header -->
	</header>

<?php if ( ! is_page_template( 'template-home.php' ) ) : ?>
<!-- BEGIN #container -->
<div id="container" class="clearfix">
<?php endif; ?>