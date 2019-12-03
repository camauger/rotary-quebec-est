<?php
/*
	Template Name: Page - Le club
	*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <?php get_template_part('sousmenu', 'leclub'); ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-md-9 col-sm-12">
            <article class="rt-article rt-round">
                <?php the_title('<h1>', '</h1>'); ?>
                <?php
                        if ('' != get_the_post_thumbnail()) :
                            the_post_thumbnail('thumbnail', array('class' => 'align-left'));
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
    <?php if (have_posts()) : ?>
        <?php get_template_part('sousmenu', 'activites'); ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-md-9 col-sm-12">
                <article class="rt-article rt-round">
                    <?php the_title('<h1>', '</h1>'); ?>
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