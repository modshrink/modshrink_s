<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="initial-scale=1, user-scalable=no" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>


	<div id="main" class="site-main">
		
		<div id="primary" class="content-area">

			<div id="content-aside" class="widget-area" role="complementary">
	    		<?php do_action( 'before_sidebar' ); ?>
	    		<?php if ( ! dynamic_sidebar( 'content-aside' ) ) : ?>
	    		<?php endif; // end sidebar widget area ?>
			</div><!-- #tertiary .widget-area -->

			<header id="masthead" class="site-header" role="banner">

				<div class="site-branding">
					<?php dynamic_sidebar( 'header-1' ); ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

					<?php if(get_bloginfo( 'description' ) && is_home()) { ?>
					<div class="site-description">
						<?php bloginfo( 'description' ); ?>
					</div>
					<?php } ?>
				</div><!-- .site-brading -->

				<?php // <nav class="navigation-main"> ?>
					<?php // wp_nav_menu(); ?>
				<?php // </nav><!-- .navigation-main --> ?>

			</header><!-- #masthead -->
