<?php
	/*
	Template Name: Page - Activités
	*/
?>
<?php get_header(); ?>
<!-- ------------------------------------------------------------------

				             * Nouvelles *

----------------------------------------------------------------------->
<?php if ( is_page( 'nouvelles' ) ) : ?>
		<?php get_template_part( 'sousmenu', 'activites' ); ?>
		<div class="col-md-9 col-sm-12">
			<article class="rt-article rt-round">
				<h1>Nouvelles</h1>
				<?php $args = array( 'name' => 'nouvelles-toutes-avec-pagination' ); echo render_view( $args ); ?>
			</article>
		</div>	        
		<!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->

<!-- ------------------------------------------------------------------

				             * Programme *

----------------------------------------------------------------------->
<?php elseif ( is_page( 'programmes' ) ) : ?>
	<?php get_template_part( 'sousmenu', 'activites' ); ?>
			<div class="col-md-9 col-sm-12">
				<article class="rt-article rt-round">
					<h1>Programmes</h1>
					<?php $args = array( 'name' => 'programmes-tous-resume' ); echo render_view( $args ); ?>
				</article>
			</div>	        
		<!-- ouvert dans _includes/ menu/nav-secondaire -->
		</div><!-- row -->
	</div><!-- container -->
    

<?php else : ?>	
		 <?php if ( have_posts() ) : ?>         	
        	<?php get_template_part( 'sousmenu', 'activites' ); ?>
        	<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-9 col-sm-12">
	            <?php if( is_page( 'calendrier' ) ) : ?>
	            	<article class="rt-artdicle rt-rodund">
						<?php the_title( '<h1 style="margin-top: 0;">', '</h1>' ); ?>                       
	                    <?php the_content(); ?>   
	                </article>
	            <?php else : ?>
	            	<article class="rt-article rt-round">
						<?php the_title( '<h1>', '</h1>' ); ?>                       
	                    <?php the_content(); ?>   
	                </article>
	            <?php endif; ?>
            </div> 
            <?php endwhile  ?> 
       
<!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container --> 
<?php endif; ?> 
   

  
<?php endif; ?>	 
<?php get_footer(); ?>