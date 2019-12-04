<?php
/*
	Template Name: Page - Accueil
	*/

// WP_Query - Arguments
$args = array(
    'category_name' => 'diaporama',
    'order' => 'ASC',
    'orderby' => 'date',
    'posts_per_page' => 15,
);
// La requête
$the_query_xs = new WP_Query($args);

?>

<?php get_header(); ?>



<div class="jumbotron">
    <div class="container">
        <?php if (has_post_thumbnail()) {
            the_post_thumbnail();
        } ?>
    </div>
</div>


<div class="bg-gris">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="citation-accueil">
                    <?php $args = array('name' => 'vue-citations');
                    echo render_view($args); ?>
                </div>
            </div>
        </div><!-- row -->
    </div>
</div><!-- container -->

<section class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="facebook__container">
                <h3>En bref sur <strong>Facebook</strong></h3>
<?php echo $post->$facebook ; ?>
               
            </div>
        </div>
        <div class="col-md-5">
            <div class="">
                <h3><?php echo esc_html($post->blocTitre) ?></h3>
                <img src="<?php echo esc_html($post->blocImage) ?>" alt="Nous passons à l'action">
                <p><?php echo esc_html($post->blocTexte) ?></p>
            </div>
        </div>

    </div>
</section>
<!-- container -->
<div class="container-fluid fluid-bg-cite-joie">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="promo-cite-joie">
                    <!-- rt-box-index rt-round -->

                    <div>
                        <?php $args = array('name' => 'vue-promo-cite-joie');
                        echo render_view($args); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-12">
        <?php $args = array('name' => 'vue-3colonnes-pinterieures');
        echo render_view($args); ?>
    </div>
</div>
</div>

<?php get_footer(); ?>