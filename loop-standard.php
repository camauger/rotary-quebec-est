<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_title( '<h2>', '</h2>' ); ?>
		<?php 
			if ( '' != get_the_post_thumbnail() ) :
				the_post_thumbnail( 'thumbnail', array( 'class' => 'align-left' ) ); 
			else :
				// some code
			endif;
		?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php else : ?>
	<?php echo do_shortcode( "[aucuneArticle]" ); ?>
<?php endif; ?>