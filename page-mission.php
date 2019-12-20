<?php
	/*
	Template Name: Page - Missions et objectifs
	*/
?>
<?php get_header(); ?>

    	<?php if ( have_posts() ) : ?>
         	
			<?php get_template_part( 'sousmenu', 'mission' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
            	<div class="col-md-9 col-sm-12">
                    <article class="rt-article rt-round">
                        <div class="row">
                            <div class="col-md-8">
                                <?php the_title( '<h1>', '</h1>' ); ?>
                                <?php 
                                    if ( '' != get_the_post_thumbnail() ) :
                                        the_post_thumbnail( 'thumbnail', array( 'class' => 'align-left' ) ); 
                                    else :                                   
                                    endif;
                                ?>
                                <?php the_content(); ?>
                            </div><!-- contenu -->
                          
                            <!-- ************************************************************-->
                            
                            <!-- ************* CITATION *************************************-->
                            
                            <div class="col-md-4">
                            	<div class="citation-page-int">
                                	<div class="inner-citation-int">
                                   
                                        <?php 
                                            echo types_render_field("citation-pour-cette-page", array());
                                        ?> 
                                    </div> 
                                </div>
                            </div><!-- citation int -->
                        </div>                        
                                               
                            
                    </article>
                  <div class="row">
                  <?php get_template_part('module-boxes') ; ?>
                  </div>
       			</div>	        
        <!-- ouvert dans _includes/ menu/nav-secondaire -->
        </div><!-- row -->
    </div><!-- container -->

	<?php endwhile; ?>
	<?php else : ?>	
             <?php if ( have_posts() ) : ?>         	
                <?php get_template_part( 'sousmenu', 'activites' ); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-md-9 col-sm-12">
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