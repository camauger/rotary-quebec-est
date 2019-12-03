<?php
	/*
	Template Name: Page - Activités
	*/
?>
<?php get_header(); ?>

<!----------------------
   * page activité affiche les nouvelles *
------------------------->
<?php if ( is_page( 'activites' ) ) : ?>


	<?php get_template_part( 'sousmenu', 'activites' ); ?>
    <?php     
		include (locate_template('../../../../_config.inc.php'));
		include (locate_template('../../../../_includes/functions.php'));
    ?>
    
    <div class="col-md-8">
        <article class="rt-article rt-round">
         	<?php the_title( '<h1>', '</h1>' ); ?>
       		<?php get_template_part( 'module', 'nouvelles' ); ?>        
        </article>
    </div>
     <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->

<!---------------------------------------------------------------
                            * page calendrier *
----------------------------------------------------------------->
<?php elseif ( is_page( 'calendrier' ) ) : ?>

	<style type="text/css">
	#carreVert{
		margin-left:-10px;}	
	.ie9 #carreVert,
	.ie8 #carreVert{
		margin-left:15px;}
	</style>
  
    
    
		<?php get_template_part( 'sousmenu', 'activites' ); ?>
        <?php     
			include (locate_template('../../../../_config.inc.php'));
			include (locate_template('../../../../_includes/functions.php'));   		     
			#include (locate_template('../../../fr/activites/_inclusionCalendrier.php'));
			
    	?>    
		<script type="text/javascript">
			function filter()
			{	
				document.form_calendar.submit();
			}
    	</script>
        <div class="col-md-8">
            <article class="rt-article rt-round">
            	<?php the_title( '<h1>', '</h1>' ); ?>
                <?php get_template_part( 'script', 'calendrier' ); ?> 
                <?php get_template_part( 'module', 'calendrier' ); ?> 
            </article>
        </div>
 	<!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->

<!---------------------------------------------------------
                         * page nouvelle *
---------------------------------------------------------->
<?php elseif ( is_page( 'nouvelles' ) ) : ?>


	<?php get_template_part( 'sousmenu', 'activites' ); ?>
    <?php     
		include (locate_template('../../../../_config.inc.php'));
		include (locate_template('../../../../_includes/functions.php'));
    ?>
    
    <div class="col-md-8">
        <article class="rt-article rt-round">
         	<?php the_title( '<h1>', '</h1>' ); ?>
       		<?php get_template_part( 'module', 'nouvelles' ); ?>        
        </article>
    </div>
            
    <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->


<!---------------------------------------------------
                     * page programme *
----------------------------------------------------->

<?php elseif ( is_page( 'programmes' ) ) : ?>


    <?php get_template_part( 'sousmenu', 'activites' ); ?>
    <?php     
		include (locate_template('../../../../_config.inc.php'));
		include (locate_template('../../../../_includes/functions.php'));
    ?>
    
    <div class="col-md-8">
        <article class="rt-article rt-round">
        	 <?php the_title( '<h1>', '</h1>' ); ?>
       		<?php get_template_part( 'module', 'programmes' ); ?>        
        </article>
    </div>	        
    <!-- ouvert dans _includes/ menu/nav-secondaire -->
	</div><!-- row -->
</div><!-- container -->
	
<!------------------------------------------------
            * else et autres enfant de la page parent *
-------------------------------------------------->   
    <?php else : ?>
     
    
    	<?php if ( have_posts() ) : ?>
         	
			<?php get_template_part( 'sousmenu', 'activites' ); ?>
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
	 <?php get_template_part( 'sousmenu', 'activites' ); ?>
    <div class="col-md-8">
        <article class="rt-article rt-round">
       		<?php echo do_shortcode( "[aucuneArticle]" ); ?>
        </article>
    </div>  

<?php endif; ?>
		<?php #echo do_shortcode( "[aucuneArticle]" ); ?>    
	<?php endif; ?>
    
<?php get_footer(); ?>