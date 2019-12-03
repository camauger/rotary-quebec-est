<?php
	/*
	Template Name: Page - Le club
	*/
?>
<?php get_header(); ?>

<!----------------------
   * page activité affiche les nouvelles *
------------------------->
<?php if ( is_page( 'le-club' ) ) :
    
   		header('Location:/le-club/mot-du-president/'); 
	
?>     
    </div>
     <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->
    
<!---------------------------------------------------------
   * les comites *
-------------------------------------------------------------->
<?php elseif ( is_page( 'les-comites' ) ) : ?>


 <?php     
		include (locate_template('../../../../_config.inc.php'));
		include (locate_template('../../../../_includes/functions.php'));
    ?>
    <?php get_template_part( 'sousmenu', 'leclub' ); ?>
    <div class="col-md-8">
        <article class="rt-article rt-round">
        	 <?php the_title( '<h1>', '</h1>' ); ?>
       		<?php get_template_part( 'module', 'comites' ); ?>        
        </article>
    </div> 		
        
     <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->
    
<!------------------------------------------------------------------------
   * conseil administration *
-------------------------------------------------------------------------->
<?php elseif ( is_page( 'le-conseil-dadministration' ) ) : ?>

 <?php     
		include (locate_template('../../../../_config.inc.php'));
		include (locate_template('../../../../_includes/functions.php'));
    ?>
    
    <?php get_template_part( 'sousmenu', 'leclub' ); ?>
    <div class="col-md-8">
        <article class="rt-article rt-round">
        	 <?php the_title( '<h1>', '</h1>' ); ?>
       		<?php get_template_part( 'module', ' module-conseiladmin' ); ?>        
        </article>
    </div>
     <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->
   
	
<!------------------------------------------------------------------------------------------------------------------------------------
            * else et autres enfant de la page parent *
-------------------------------------------------->   
    <?php else : ?>
     
    
    	<?php if ( have_posts() ) : ?>
         	
			<?php get_template_part( 'sousmenu', 'leclub' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
            	<div class="col-md-8">
                    <article class="rt-article rt-round">
                            <?php the_title( '<h1>', '</h1>' ); ?>
                            <?php 
                                if ( '' != get_the_post_thumbnail() ) :
                                    the_post_thumbnail( 'thumbnail', array( 'class' => 'align-left' ) ); 
                                else :
                                    // some code
                                endif;
                            ?>
                            <?php the_content(); ?>
                    </article>
       			</div>	        
        <!-- ouvert dans _includes/ menu/nav-secondaire -->
        </div><!-- row -->
    </div><!-- container -->

	<?php endwhile; ?>

<?php else : ?>
	 <?php get_template_part( 'sousmenu', 'leclub' ); ?>
    <div class="col-md-8">
        <article class="rt-article rt-round">
       		<?php echo do_shortcode( "[aucuneArticle]" ); ?>
        </article>
    </div>  

<?php endif; ?>
		<?php #echo do_shortcode( "[aucuneArticle]" ); ?>    
	<?php endif; ?>
    
<?php get_footer(); ?>