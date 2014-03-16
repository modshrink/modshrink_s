<?php
/**
 * @package modshrink_s
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<div class="social-button">
				<div class="custom-button twitter">
					<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" onClick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!' ); return false;">
							<span class="count"><?php if ( social_count(get_permalink(), 'twitter') != 0 ) { echo social_count(get_permalink(), 'twitter'); } ?></span><span class="label"><?php if(social_count(get_permalink(), 'twitter') > 1) { echo "tweets"; } else { echo "tweet"; } ?></span>
					</a>
				</div>
				<div class="custom-button facebook">
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" onClick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!' ); return false;">
						<span class="count"><?php if ( social_count(get_permalink(), 'facebook') !=0 ) { echo social_count(get_permalink(), 'facebook'); } ?></span><span class="label"><?php if(social_count(get_permalink(), 'facebook') > 1) { echo "likes"; } else { echo "like"; } ?></span>
					</a>
				</div>
				<div class="custom-button google">
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onClick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=!' ); return false;">
						<span class="count"><?php if ( social_count(get_permalink(), 'google') != 0 ) { echo social_count(get_permalink(), 'google'); } ?></span><span class="label">plus</span>
					</a>
				</div>
			</div>
		</div> <!-- .entry-meta -->


	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'modshrink_s' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
			<p class="posted-on">
				<time datetime="<?php the_time('c'); ?>"><?php echo get_post_time('F j, Y'); ?></time>
				<?php if(!is_archive()) { ?>
				 in 
				<?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?>
				<?php } ?>
			</p>
			<dl>
				<dt></dt>
				<dd></dd>
			</dl>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->



<?php if (function_exists('similar_posts')) { ?>
<article class="similar-posts">
	<h3>関連記事</h3>
	<?php similar_posts(); ?>
</article>	

<?php  } ?>


