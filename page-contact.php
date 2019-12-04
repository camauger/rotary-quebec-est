<?php
	/*
	Template Name: Page - Contact
	*/
?>
<?php get_header(); ?>

<!----------------------
   * page activité affiche les nouvelles *
------------------------->
<?php if ( is_page( 'contact' ) ) : ?>
    
   <?php if ( have_posts() ) : ?>
		          
           <div class="container">
               <div class="col-md-12">
                    <?php while ( have_posts() ) : the_post(); ?>
                    
                        <article class="rt-article rt-round">
                            <?php the_title( '<h1>', '</h1>' ); ?>
                            <?php  the_content(); ?>      
                        </article>
                
                    <?php endwhile; ?>
                 <?php endif; ?>
     	</div>
    </div>
     <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->  
	
<!------------------------------------------------
            * else et autres enfant de la page parent *
-------------------------------------------------->   
    
	<?php else : ?>	
             <?php if ( have_posts() ) : ?>        	
             
                <?php while ( have_posts() ) : the_post(); ?>
					<div class="col-md-12 col-sm-12">
						<article class="rt-article rt-round">
							<?php the_title( '<h1>', '</h1>' ); ?>                       
							<?php the_content(); ?>   
						</article>
					</div> 
                <?php endwhile  ?> 
           
    <!-- ouvert dans _includes/ menu/nav-secondaire -->
        </div><!-- row -->
    </div><!-- container --> 
    <?php endif; ?> 


<?php endif; ?>
    
<?php get_footer(); ?>