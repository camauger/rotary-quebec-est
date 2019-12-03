<?php get_header(); ?>

<div class="tpl-pages page-category">
	<div class="grid clearfix">
		<div class="grid-example clearfix">
			<?php if ( is_page( 'page-test' ) ) : ?>
				<div class="col_8">
					<?php echo do_shortcode( "[aucunArticle]" ); ?>
				</div><!-- .col_8 -->
				<div class="col_4">
					<?php get_sidebar(); ?>	
				</div><!-- .col_4 -->
			<?php else : ?>
				<div class="col_8">
					<?php get_template_part( 'loop', 'standard' ); ?>
				</div><!-- .col_8 -->
				<div class="col_4">
					<?php get_sidebar(); ?>	
				</div><!-- .col_4 -->
			<?php endif; ?>
		</div><!-- .grid-example clearfix -->
	</div><!-- .grid clearfix -->
</div><!-- .page-page -->

<?php get_footer(); ?>