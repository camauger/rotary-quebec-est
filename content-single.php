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
                                <?php #the_content(); ?>
                                <?php #get_template_part( 'loop', 'standard' ); ?>	
                                
								
                                
                        </article>
                    </div>	        
            <!-- ouvert dans _includes/ menu/nav-secondaire -->
            </div><!-- row -->
        </div><!-- container -->    
        <?php endwhile; ?>        
    <?php endif; ?>