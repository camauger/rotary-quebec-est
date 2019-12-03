<?php get_header(); ?>
	<?php get_template_part( 'sousmenu', 'activites' ); ?>
		<div class="col-md-8">
			<article class="rt-article rt-round">
				<?php
					$id = get_the_ID();							
					$args = array( 'name' => 'nouvelles-toutes-avec-pagination', 'post_id' => $id ); echo render_view( $args ); 
				?>		
			</article>
		</div>	        
		<!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->
<?php get_footer(); ?>
