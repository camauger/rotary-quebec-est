<?php get_header(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
	<?php get_template_part( 'sousmenu', 'leclub' ); ?>
		<div class="col-md-8">
			<article class="rt-article rt-round">
				<?php
				
				
				
					$id = get_the_ID();	 // Récupération de de l'ID de l'article
					//( ATTENTION : aller dans functions.php pour setter le parent : post_id via la fonction : show_only_postid()
					// is_singular est utilisé pour sélection le bon CPT créé dans Types

					if( is_singular( 'nouvelles-du-club' ) ) : // Menu -> Types & Taxonomies -> Type de publication -> copier/coller le ligne-bloc/slug
						$args = array( 'name' => 'nouvelles-toutes-avec-pagination', 'post_id' => $id ); echo render_view( $args );

					elseif( is_singular( 'section-programme' ) ) : //  // Menu -> Types & Taxonomies -> Type de publication -> copier/coller le ligne-bloc/slug
						$args = array( 'name' => 'programmes-description-complete', 'ids' => $id ); echo render_view( $args );

					elseif( is_singular( 'comite' ) ) : //  // Menu -> Types & Taxonomies -> Type de publication -> copier/coller le ligne-bloc/slug

						// Récupérer l'URL et supprimmer le dernier /
						$mylink = substr($_SERVER['REQUEST_URI'], 0, -1 );
						// Scinder l'URL en se basant sur les /
						$link_array = explode('/',$mylink);
						//Récupérer le dernier élément de l'URL
						$lastpart = end($link_array);
						// Setter la variable pour afficher le bon comité
						// Attention les CPTS doivent tous avoir le même slug pour que ça fonctionne (CPT Comité, Membres...)
						$metaComite = 'wpcf-comite-' . $lastpart;
						// Setter la variable pour afficher le bon rôle par comité
						$metaComiteRole = 'wpcf-role-' . $lastpart;

						global $post;
					
						$args = array(
							'post_type' => 'membre-club',
							'meta_key' => $metaComite,
							'meta_value' => 'Oui',
							'orderby' => 'meta_value_num',
       						'order' => 'ASC'
						);

						$loop = new WP_Query( $args );
						// Titre du comité
						echo the_title( '<h2>', '</h2>');
						echo '<ul class="ulMembresComite">';
							// Liste des membres par comité
							while ( $loop->have_posts() ) : $loop->the_post();
								echo '<li class="entry-content">';
								the_title( '<span class="vPrenomNomMembre">', '</span>' );
								$metaTitre = get_post_meta( $post->ID, $metaComiteRole, true );
								echo '' . $metaTitre . '';
								echo '</li>';
							endwhile;
						echo '</ul>';
					else :
						echo 'Aucune donnée n\'est actuellement disponible';
					endif;
				?>
			</article>
		</div>	<!-- `/.col-md-8 -->
		<!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->
<?php get_footer(); ?>
