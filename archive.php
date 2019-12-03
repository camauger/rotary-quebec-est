<?php get_header(); ?>
<div class="tpl-pages page-archive">
	<div class="grid clearfix">
		<div class="grid-example clearfix">
			<div class="col_8">
				<?php get_template_part( 'loop', 'standard' ); ?>
			</div><!-- .col_8 -->
			<div class="col_4">
				<?php get_sidebar(); ?>	
			</div><!-- .col_4 -->
		</div><!-- #grid-example clearfix -->
	</div><!-- .grid clearfix -->
</div><!-- .page-archive -->
<?php get_footer(); ?>