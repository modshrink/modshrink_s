<?php
/**
 * @package modshrink_s
 */
?>

<?php
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page' => 1,
	'post__in'  => $sticky,
	'ignore_sticky_posts' => 0
);
$query = new WP_Query( $args );
if ( array_pop( $sticky ) == $id && is_home() ) {
	echo '<h2 class="section-title">'. __('Inforemation') . '</h2>';
}
wp_reset_postdata();

$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page' => 1,
	'post__not_in'  => $sticky,
	'ignore_sticky_posts' => 1
);
$newest_post = new WP_Query( $args );
$newest_post_id = $newest_post->post->ID;
if ( $newest_post_id == $id && is_home() ) {
	echo '<h2 class="section-title">'. __('Resent posts') . '</h2>';
}
wp_reset_postdata();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>

	<?php if ( is_sticky() && has_post_thumbnail() ) { ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark"> <?php the_post_thumbnail(); ?> </a>
	 <?php } else {
		echo catch_that_image();
	} ?>

	<header class="entry-header">

	<?php if( !is_sticky() ) { ?>
		<div class="entry-meta">
			<span class="posted"><?php modshrink_s_posted_on(); ?></span>
		</div> <!-- .entry-meta -->
	<?php } ?>

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<?php endif; ?>

</article><!-- #post-## -->

