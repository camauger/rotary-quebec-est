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
            <blockquote class="facebook__container">
                <h3>En bref sur <strong>Facebook</strong></h3>
                <div class="fb-post" data-href="https://www.facebook.com/ClubRotaryQuebecEst/posts/2159444704156808" data-width="500" data-show-text="true">
                    <blockquote cite="https://developers.facebook.com/ClubRotaryQuebecEst/posts/2159444704156808" class="fb-xfbml-parse-ignore">
                        <p>Nous avons le privilège et la chance de recevoir Chloé Sainte-Marie au Club. Elle nous a laissé d&#039;excellents souvenirs...</p>Publié par <a href="https://www.facebook.com/ClubRotaryQuebecEst/">Club Rotary Québec-Est</a> sur&nbsp;<a href="https://developers.facebook.com/ClubRotaryQuebecEst/posts/2159444704156808">Vendredi 29 novembre 2019</a>
                    </blockquote>
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
<div class="">
    <div class="container">
        <div class="row">

            <div>

                <div class="col-md-6">
                    <div class="margin-bottom-1">
                        <h2>Cité Joie, de nature à faire du bien</h2>
                        <p><img class="wp-image-946 size-full alignleft" src="https://rotary-quebecest.org/contenu/prospecteur/uploads/2015/01/citejoie_logo_noir-site-web.jpg" alt="" width="190" height="190" srcset="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie_logo_noir-site-web.jpg 200w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie_logo_noir-site-web-150x150.jpg 150w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie_logo_noir-site-web-120x120.jpg 120w" sizes="(max-width: 190px) 100vw, 190px"></p>
                        <p>Cité Joie est un centre de vacances et répit pour personnes handicapées situé à Lac-Beauport, près de Québec. Parrainé par le club Rotary Québec-Est, le centre&nbsp;reçoit chaque année plus de 2&nbsp;600 personnes handicapées&nbsp;intellectuellement et/ou physiquement, âgées de 3&nbsp;à&nbsp;80 ans, et&nbsp;leur offre un accueil chaleureux en milieu naturel.</p>
                        <p><a href="https://rotary-quebecest.org/mission-et-objectifs/citejoie/">Cliquez ici pour en savoir plus sur&nbsp;Cité Joie.</a></p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="margin-top-2 embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="//www.youtube.com/embed/Qi2os1Tddd8?rel=0" allowfullscreen=""></iframe>
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