<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="initial-scale=1, user-scalable=no" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<meta name="google-site-verification" content="MCSoCS7EYpb0K1_DwxgWH6SQ8PeGdAyGYEsSdCK48JQ" />
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
</head>

<body <?php body_class(); ?>>
<?php dynamic_sidebar( 'after_body' ); ?>

	<script type="text/javascript">
jQuery(document).ready(function($){
	$(function(){
        
		var timer = false;

		if($('body').width() > 480){
			// ウィンドウサイズが480より大きい場合
			$(window).resize(function() {
			    if (timer !== false) {
			        clearTimeout(timer);
			    }
			    timer = setTimeout(function() {
			        console.log('resized');
			       	//ウィンドウサイズいが480より小さくなり、トグル用のセレクタが無ければメニューアイコンを表示
			        if($('body').width() < 480 && !$("#global-menu-toggle").size()) {
			        	$(".menu li:first-child").before('<li id="global-menu-toggle" class="menu-item"><a href="#"></a></li>');
							    $("#global-menu-toggle a").click(function(){
									$(".menu li:not(:first)").slideToggle();
	 						   	});
			        }
					//ウィンドウサイズいが481より大きくなったらメニューアイコンを非表示
			        if($('body').width() > 481) {
                            $("li.menu-item").removeAttr("style");
                        
						if($("#global-menu-toggle").size()){
							$("#global-menu-toggle").remove();
						}
			        }
			    }, 200);
			}); 			
		} else {
			// ウィンドウサイズが480より小さい場合は最初からメニューアイコン表示
			$(".menu li:first-child").before('<li id="global-menu-toggle" class="menu-item"><a href="#"></a></li>');
		}

	    $("#global-menu-toggle a").click(function(){
	    	$(".menu li:not(:first)").slideToggle();
	    });

	});
});
	</script>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</nav><!-- #site-navigation -->

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<div id="main" class="site-main">
		
		<div id="primary" class="content-area">

			<div id="content-aside" class="widget-area" role="complementary">
	    		<?php do_action( 'before_sidebar' ); ?>
	    		<?php if ( ! dynamic_sidebar( 'content-aside' ) ) : ?>
	    		<?php endif; // end sidebar widget area ?>
			</div><!-- #tertiary .widget-area -->

			<!--<header id="masthead" class="site-header" role="banner">

				<div class="site-branding">
					<?php dynamic_sidebar( 'header-1' ); ?>
					
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					
					<?php if(get_bloginfo( 'description' ) && is_home()) { ?>
					<div class="site-description">
						<?php bloginfo( 'description' ); ?>
					</div>
					<?php } ?>
				</div>


			</header>--><!-- #masthead -->
