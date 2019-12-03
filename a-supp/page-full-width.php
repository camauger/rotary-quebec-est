<?php
	/*
	Template Name: Page - full width (no sidebar)
	*/
?>
<?php get_header(); ?>
<div class="tpl-pages page-full-width">
	<div class="grid clearfix">
		<div class="grid-example clearfix">
			<div class="col_12">
				<?php if ( is_page( 'plan-de-site' ) ) : ?>
					<?php get_sidebar(); ?>
				<?php else : ?>
					<?php get_template_part( 'loop', 'standard' ); ?>
				<?php endif; ?>
			</div><!-- .col_12 -->
		</div><!-- .grid-example clearfix -->
	</div><!-- .grid clearfix -->
</div><!-- .page-page -->
<?php get_footer(); ?>