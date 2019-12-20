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

        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FClubRotary&tabs=timeline&width=500&height=0&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=161767141187083" width="500" height="0" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            <!-- <div class="fb-page" data-href="https://www.facebook.com/ClubRotary" data-tabs="timeline" data-width="500" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div> -->
            <!-- <blockquote class="facebook__container">
                <h3>En bref sur <strong>Facebook</strong></h3>
                <div class="fb-post" data-href="https://www.facebook.com/ClubRotaryQuebecEst/posts/2159444704156808" data-width="500" data-show-text="true">
                    <blockquote cite="https://developers.facebook.com/ClubRotaryQuebecEst/posts/2159444704156808" class="fb-xfbml-parse-ignore">
                        <p>Nous avons le privilège et la chance de recevoir Chloé Sainte-Marie au Club. Elle nous a laissé d&#039;excellents souvenirs...</p>Publié par <a href="https://www.facebook.com/ClubRotaryQuebecEst/">Club Rotary Québec-Est</a> sur&nbsp;<a href="https://developers.facebook.com/ClubRotaryQuebecEst/posts/2159444704156808">Vendredi 29 novembre 2019</a>
                    </blockquote> -->
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
            <div class="col-md-6">
                <h2>Cité Joie, de nature à faire du bien</h2>
                <p><img class="wp-image-946 size-full alignleft" src="https://rotary-quebecest.org/contenu/prospecteur/uploads/2015/01/citejoie_logo_noir-site-web.jpg" alt="" width="190" height="190" srcset="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie_logo_noir-site-web.jpg 200w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie_logo_noir-site-web-150x150.jpg 150w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie_logo_noir-site-web-120x120.jpg 120w" sizes="(max-width: 190px) 100vw, 190px"></p>
                <p>Cité Joie est un centre de vacances et répit pour personnes handicapées situé à Lac-Beauport, près de Québec. Parrainé par le club Rotary Québec-Est, le centre&nbsp;reçoit chaque année plus de 2&nbsp;600 personnes handicapées&nbsp;intellectuellement et/ou physiquement, âgées de 3&nbsp;à&nbsp;80 ans, et&nbsp;leur offre un accueil chaleureux en milieu naturel.</p>
                <p><a href="https://rotary-quebecest.org/mission-et-objectifs/citejoie/">Cliquez ici pour en savoir plus sur&nbsp;Cité Joie.</a></p>
                <p>&nbsp;</p>

            </div>
            <div class="col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/Qi2os1Tddd8?rel=0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row homepage__3col">
        <div class="col-md-4">
            <div class="box--grey">
                <p><a href="https://rotary-quebecest.org/"><img class="alignnone size-full wp-image-421" src="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/Logo-Rotary-vignette-web.jpg" alt="Logo-Rotary-vignette-web" srcset="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/Logo-Rotary-vignette-web.jpg 240w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/Logo-Rotary-vignette-web-120x80.jpg 120w" sizes="(max-width: 240px) 100vw, 240px"></a></p>
                <p><b>Club Rotary Québec-Est</b></p>
                <p>Notre groupe d’ami(e)s lié par l’idéal de rendre service à sa communauté et par la philanthropie qui se réunit chaque semaine. Notre œuvre principale est <a title="Cité Joie" href="https://rotary-quebecest.org/mission-et-objectifs/citejoie/">Cité Joie</a>.</p>
            </div>

        </div>
        <div class="col-md-4">
            <div class="box--grey">
                <p><a href="https://rotary-quebecest.org/mission-et-objectifs/fondation-cite-joie/"><img class="size-full wp-image-947 alignnone" src="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie-logo-siteweb.jpg" alt="" srcset="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie-logo-siteweb.jpg 240w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/citejoie-logo-siteweb-120x80.jpg 120w" sizes="(max-width: 240px) 100vw, 240px"></a></p>
                <p><b>Fondation Cité Joie</b></p>
                <p>La Fondation Cité Joie, c’est en quelque sorte le moyen que les membres du Club Rotary Québec-Est se sont donné pour assurer le maintien, le développement et l’avenir de l’œuvre Cité Joie. <a href="https://rotary-quebecest.org/mission-et-objectifs/fondation-cite-joie/">Cliquez ici pour en savoir plus…</a></p>
            </div>

        </div>
        <div class="col-md-4">
            <div class="box--grey">
                <p><a href="https://rotary-quebecest.org/mission-et-objectifs/citejoie/"><img class="alignnone size-full wp-image-452" src="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/CiteJoie-handicap-RotaryQuebecEst-webVF.jpg" alt="CiteJoie-handicap-RotaryQuebecEst-webVF" srcset="https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/CiteJoie-handicap-RotaryQuebecEst-webVF.jpg 240w, https://rotary-quebecest.org/contenu/wp-content/uploads/2015/01/CiteJoie-handicap-RotaryQuebecEst-webVF-120x80.jpg 120w" sizes="(max-width: 240px) 100vw, 240px"></a></p>
                <p><b>Cité Joie</b></p>
                <p>Notre œuvre centrale. Le seul centre de répit pour personnes handicapées en milieu naturel. Nous accueillons 2 600&nbsp;personnes chaque&nbsp;année. <a title="Cité Joie" href="https://rotary-quebecest.org/mission-et-objectifs/citejoie/">Cliquez ici pour en savoir plus…</a></p>
            </div>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>