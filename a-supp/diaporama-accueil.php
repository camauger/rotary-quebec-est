<?php 
	// Diaporama généré via la classe "slideshow" sur le UL tirée du framework CSS
	// Paramètre du diaporama : prospecteur/css/css-framework/js/kickstart.js
	// Les images sont ajoutées grâce au plugin Attachment via "Joindre les fichiers" 
	// ( via les champs de l'article concerné, en bas de page )
	
	$args = array ( 'category_name' => 'diaporama' ); // spécifier le "slug" de la catégorie
	
	$query = new WP_Query( $args );
?>	
<?php if ( $query->have_posts() ) : ?>
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<!-- Afficher l'extrait de l'article si présent, sinon le contenu au complet -->
		<?php get_template_part( 'excerpt', 'article' ); ?>
		
		<?php $attachments = new Attachments( 'mes_pieces_jointes' ); /* plugin Attachments - nom de la fonction - functions.php */ ?> 
		<ul class="slideshow"><!-- Classe utile pour issue du framework CSS pour le SLIDESHOW-->
			<?php if( $attachments->exist() ) : ?>
				<?php while( $attachments->get() ) : ?>
					<li><img src="<?php echo $attachments->src( 'full' ); ?>" title=" <?php echo $attachments->field( 'title' ); ?>" /></li>
				<?php endwhile; ?>
			<?php endif; ?> 
		</ul>
	<?php endwhile; ?>
<?php else : ?>
		<?php echo do_shortcode( "[aucunArticle]" ); ?>
<?php endif; ?>

<?php wp_reset_postdata(); ?>