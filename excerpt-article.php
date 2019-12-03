<?php if ( ! has_excerpt() ) : ?>
	<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'align-left' ) ); ?>
	<?php else : ?>
			<!-- ajouter, le cas échéant une image par défaut -->
	<?php endif; ?>
	<?php the_content(); ?>
<?php else : ?>
	<?php the_excerpt(); ?>
	<p>
		<i class="icon-angle-right"></i> <a class="more-link" href="<?php the_permalink();?>"><?php _e('Lire la suite de : ');?> <?php the_title(); ?></a>
	</p>
<?php endif; ?>