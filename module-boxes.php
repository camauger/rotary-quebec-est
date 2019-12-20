<div class="container">
    <div class="row homepage__3col">

        <?php
        $boxes = get_posts(array(
            'post_type' => 'Boîtes',
            'order' => 'ASC',
            'showposts' => 3
        ));

        foreach ($boxes as $post) {
            $image = get_the_post_thumbnail($post->ID, 'large');
        ?>
            <div class="col-md-4">
                <div class="box--grey">

                    <a href="">
                        <?php echo $image ?>
                        <h3><?php the_title_attribute() ?></h3>
                    </a>
                </div>
            </div>

        <?php }
        ?>

    </div>
</div>


<!-- 
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
</div> -->