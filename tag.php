<?php get_header(); ?>
<div class="page-tag">
	<div class="grid clearfix">
		<div class="grid-example clearfix">
			<div class="col_8">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_title( '<h4>', '</h4>' ); ?>
						<?php the_content(); ?>	
					<?php endwhile; ?>
				<?php else : ?>
					<?php echo do_shortcode( "[aucuneArticle]" ); ?>
				<?php endif; ?>
			</div><!-- .col_8 -->
			<div class="col_4">
				<?php get_sidebar(); ?>	
			</div><!-- .col_4 -->
		</div><!-- #grid-example clearfix -->
	</div><!-- .grid clearfix -->
</div><!-- .page-tag -->
<?php get_footer(); ?>