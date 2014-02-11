<?php
/**
 * @package modshrink_s
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clear'); ?>>

	<?php echo catch_that_image(); ?>

	<header class="entry-header">

		<div class="entry-meta">
			<span class="posted"><?php modshrink_s_posted_on(); ?></span>
		</div> <!-- .entry-meta -->

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<?php endif; ?>

</article><!-- #post-## -->

