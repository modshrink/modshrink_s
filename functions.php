<?php
/**
 * modshrink_s functions and definitions
 *
 * @package modshrink_s
 */

/**
 * Default Time Zone
 */
date_default_timezone_set( 'Asia/Tokyo' );

require_once(ABSPATH . 'wp-admin/includes/template.php');

/**
 * Remove auto P
 */
remove_filter('the_content', 'wpautop');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'modshrink_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function modshrink_s_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on modshrink_s, use a find and replace
	 * to change 'modshrink_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'modshrink_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'modshrink_s' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // modshrink_s_setup
add_action( 'after_setup_theme', 'modshrink_s_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function modshrink_s_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'modshrink_s_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'modshrink_s_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function modshrink_s_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'modshrink_s' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'modshrink_s' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Aside', 'modshrink_s' ),
		'id'            => 'content_aside',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'After <body>', 'modshrink_s' ),
		'id'            => 'after_body',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
	'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'modshrink_s_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function modshrink_s_scripts() {
	wp_enqueue_style( 'modshrink_s-style', get_stylesheet_uri(), array(), date('YmdHis') );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'modshrink_s-navigation', get_template_directory_uri() . '/js/modshrink_s.min.js', array(), '20120206', true );
	//wp_enqueue_style( 'dashicons', site_url('/')."/wp-includes/css/dashicons.min.css");

	//wp_enqueue_script( 'modshrink_s-doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.js', array( 'jquery' ));
/*
	wp_enqueue_script( 'modshrink_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'modshrink_s-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
*/
}
add_action( 'wp_enqueue_scripts', 'modshrink_s_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//**********
// _s導入後追記
//**********

// Add Jetpack share buttons above post
function jptweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display',19 );
	remove_filter( 'the_excerpt', 'sharing_display',19 );
}
add_action( 'loop_end', 'jptweak_remove_share' );

function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/**
* 画像のURLのサイズ違いのURLを取得する
*
* @param string $url 画像のURL
* @param string $size 画像のサイズ (thumbnail, medium, large or full)
*/
function get_attachment_image_src($url, $size) {
	$image = wp_get_attachment_image_src(get_attachment_id($url), $size);
	return $image[0];
}

/**
* 画像のURLからattachemnt_idを取得する
*
* @param string $url 画像のURL
* @return int attachment_id
*/
function get_attachment_id($url) {
	global $wpdb;
	$sql = "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s";
	preg_match('/([^\/]+?)(-e\d+)?(-\d+x\d+)?(\.\w+)?$/', $url, $matches);
	$post_name = $matches[1];
	return (int)$wpdb->get_var($wpdb->prepare($sql, $post_name));
}

//=====================================
//記事の最初の画像を取得
//=====================================

function catch_that_image() {
    global $post, $posts, $wpdb;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

    if(!in_array(NULL, $matches)) {
    	$first_img = $matches [1] [0];

		// 画像URLからidを取得
		$sql = "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s";
		preg_match('/([^\/]+?)(-e\d+)?(-\d+x\d+)?(\.\w+)?$/', $first_img, $matches2);

		$post_name = $matches2[1];

		$image_id = (int)$wpdb->get_var($wpdb->prepare($sql, $post_name));

	    if(preg_match("/(http|https):\/\/farm(.+?)_(.?).jpg/", $first_img)) { // 最初の画像がFlickrだった場合
	       $thumb = preg_replace('/(http|https):\/\/farm(.+?)_(.?).jpg/i', 'http://farm\2_s.jpg', $first_img);
       } elseif(preg_match("/(http|https):\/\/farm(.+?).jpg/", $first_img)) { // 最初の画像がFlickrだった場合(別サイズ)
           echo "aaa";
	       $thumb = preg_replace('/(http|https):\/\/farm(.+?).jpg/i', 'http://farm\2_s.jpg', $first_img);
	    } elseif($image_id !== 0) { // 画像idからサムネイルを取得
			$output_img = wp_get_attachment_image_src($image_id, "thumbnail");
			$first_img_thumbnail = $output_img[0];
			$thumb = $first_img_thumbnail;
	    } else {
	       $thumb = $first_img;

	    }

	    $html  = "<div class=\"entry-thumbnail\">";
		$html .= "<a href=\"".get_permalink()."\"><img class=\"media-object\" width=\"75\" height=\"75\" src=\"".$thumb."\" alt=\"".get_the_title()."のサムネイル\" /></a>";
		$html .= "</div><!-- .entry-thumbnail -->";

	    if(empty($first_img)){
	    	// デフォルト画像
	        //$thumb = bloginfo('template_url')."/images/noimage_75px.png";
	        $html= "";
	    }

	return $html;
    }
}

// WP_query

function category_post_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ($query->is_category()||$query->is_archive) {
        $query->set( 'posts_per_page', '-1' );
        return;
    }
}
add_action( 'pre_get_posts', 'category_post_per_page' );


// Social Count
function social_count($url, $service){

	// Twitter
    if($service == "twitter") {
	    $get_twitter = 'http://urls.api.twitter.com/1/urls/count.json?url=' . $url;
	    $json = file_get_contents($get_twitter);
	    $json = json_decode($json);
	    $count = $json->{'count'};
	}

    // facebook
    if($service == "facebook") {
	    $get_facebook = 'http://api.facebook.com/restserver.php?method=links.getStats&urls=' . $url;
	    $xml = file_get_contents($get_facebook);
	    $xml = simplexml_load_string($xml);
	    $count = $xml->link_stat->total_count; //いいね！のみ…like_count、shareのみ …share_count
	}

	// Google
    if($service == "google") {
    	$get_google = 'https://plusone.google.com/u/0/_/+1/fastbutton?count=true&url=' . $url;
	    $data = file_get_contents($get_google);
	    $data = explode("ld:[,[2,",$data);
	    $data = str_replace("\n","",$data[1]);
	    $data = explode("\,",$data[0]);
	    $count = $data[0];
	}

    // hatena
    if($service == "hatena") {
	    $get_hatebu = 'http://api.b.st-hatena.com/entry.count?url=' . $url;
	    $count = file_get_contents($get_hatebu);
	    if($count == ""){$count = 0;}
	}
    return $count;
}

/**
 * TIMEタグ挿入
 */

add_action( 'admin_print_footer_scripts', 'time_tag_add_quicktags' );

function time_tag_add_quicktags() {
	if ( wp_script_is( 'quicktags' ) ){
?>
	<script type="text/javascript">
		QTags.addButton( 'time_tag_add_quicktags', 'time', '<time datetime=\"\">', '', 'r', 'TIME tag' );
	</script>
<?php
	}
}

/**
 * 最近の投稿ウィジェット
 */

// 既存の Recent Posts ウィジェットを削除

add_action( 'widgets_init', 'remove_recent_posts_widget' );

function remove_recent_posts_widget() {
	unregister_widget( 'WP_Widget_Recent_Posts' );
}

// Recent Posts ウィジェットを継承

add_action( 'widgets_init', create_function( '', 'return register_widget( "WP_Widget_Recent_Posts_Time_Tweak" );' ) );

class WP_Widget_Recent_Posts_Time_Tweak extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$elapsed_time = isset( $instance['elapsed_time']) ? $instance['elapsed_time'] : false;
		$hide_topage = isset( $instance['hide_topage']) ? $instance['hide_topage'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php if ( !$hide_topage || ( $hide_topage && !is_home() ) ) { ?>
			<?php echo $before_widget; ?>
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<ul>
			<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
				<?php if ( $show_date ) : ?>
				<span class="post-date"><?php if ( $elapsed_time ) : printf( __( '%s ago' ), human_time_diff( get_the_time( 'U' ) ) ); else : echo get_the_date(); endif; ?></span>
				<?php endif; ?>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php echo $after_widget; ?>
		<?php } ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['elapsed_time'] = isset( $new_instance['elapsed_time'] ) ? (bool) $new_instance['elapsed_time'] : false;
		$instance['hide_topage'] = isset( $new_instance['hide_topage'] ) ? (bool) $new_instance['hide_topage'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$elapsed_time = isset( $instance['elapsed_time'] ) ? (bool) $instance['elapsed_time'] : false;
		$hide_topage = isset( $instance['hide_topage'] ) ? (bool) $instance['hide_topage'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $elapsed_time ); ?> id="<?php echo $this->get_field_id( 'elapsed_time' ); ?>" name="<?php echo $this->get_field_name( 'elapsed_time' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'elapsed_time' ); ?>"><?php _e( 'Time elapsed since posted' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $hide_topage ); ?> id="<?php echo $this->get_field_id( 'hide_topage' ); ?>" name="<?php echo $this->get_field_name( 'hide_topage' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'hide_topage' ); ?>"><?php _e( 'Hide from the top page' ); ?></label></p>
<?php
	}
}

/**
 * 何日前の投稿ウィジェット
 */

add_action( 'widgets_init', create_function('', 'return register_widget("My_Recent_Posts");') );

class My_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "Recent posts and number of days elapsed.") );
		parent::__construct('my-recent-posts', __('My Recent Posts'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_my_recent_posts', 'widget');

		if ( !is_array($cache) )
		$cache = array();

		if ( ! isset( $args['widget_id'] ) )
		$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
		  $number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
		?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<li>
		<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
		<?php if ( $show_date ) : ?>
		<span class="post-date"><?php printf( __( '%s ago' ), human_time_diff(get_the_time( 'U' ))); ?></span>
		<?php endif; ?>
		</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
		delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
	<?php
	}
}

/**
 * コード専用ウィジェット
 */

add_action( 'widgets_init', create_function( '', 'return register_widget("internalCodeWidget");' ) );

class internalCodeWidget extends WP_Widget {
	function __construct() {
		$widget_ops = array('description' => 'Output for internal codes.');
		$control_ops = array( 'width' => 300, 'height' => 600 );
		parent::__construct( false, 'Internal Code', $widget_ops, $control_ops );
	}

	public function form( $par ) {
		$title = (isset($par['title']) && $par['title']) ? $par['title'] : '';
		$id = $this->get_field_id('title');
		$name = $this->get_field_name('title');
		echo '<p>タイトル：';
		echo '<input type="text" id="'.$id.'" name="'.$name.'" value="';
		echo trim(htmlentities($title, ENT_QUOTES, 'UTF-8'));
		echo '" /></p>';

		$text = ( isset($par['text'] ) && $par['text']) ? $par['text'] : '';
		$id = $this->get_field_id( 'text' );
		$name = $this->get_field_name( 'text' );
		echo '<p>テキスト：</p>';
		echo '<textarea style="width:100%" id="'.$id.'" name="'.$name.'">';
		if ( $par['text'] ) { echo trim( esc_html( $par['text'], ENT_QUOTES, 'UTF-8' ) ); }
		echo '</textarea>';
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	public function widget( $args, $par ) {
		if ( $par['text'] ) {
			echo trim( $par['text'] );
		}
	}
}


/**
 * テーマの情報を取得
 */

function get_theme_info( $value ) {
	$my_theme = wp_get_theme();
	echo $my_theme->get( $value );
}