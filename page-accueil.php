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
<!-- <div id="fb-root"></div> -->
<!-- <script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script> -->
<div class="jumbotron">
    <div class="container">
        <?php if (has_post_thumbnail()) {
            the_post_thumbnail();
        } ?>
    </div>
</div>


<div class="container-fluid bg-gris margin-top-1 margin-bottom-3">
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="citation-accueil">
                    <?php $args = array('name' => 'vue-citations');
                    echo render_view($args); ?>
                </div>
            </div>
        </div><!-- row -->
    </div>
</div><!-- container -->

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="">
                <h3>En bref sur <span class="bold">Facebook</span></h3>

                <!-- <div class="fb-page" data-href="https://www.facebook.com/ClubRotaryQuebecEst/" data-tabs="timeline" data-width="500px" data-height="100%" data-small-header="true" data-hide-cta="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/ClubRotaryQuebecEst/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ClubRotaryQuebecEst/">Club Rotary Québec-Est</a></blockquote>
                </div> -->

                <script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml      : true,
      version    : 'v5.0'
    });
  }; 
</script>
<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>



<div 
  class="fb-post" 
  data-href="https://www.facebook.com/115076485260317/posts/<?php echo esc_html($post->facebook) ?>" 
  data-width=""> <!-- leave data-width empty to use fluid width -->
  </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <img src="<?php echo esc_html($post->blocImage) ?>" alt="Nous passons à l'action">
                <h3 class="margin-bottom-1"><?php echo esc_html($post->blocTitre) ?></h3>
                <p><?php echo esc_html($post->blocTexte) ?></p>
            </div>
        </div>

    </div>
</div>
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
    <!-- ******** 3 colonnes ********* -->
    <div class="col-md-12">
        <?php $args = array('name' => 'vue-3colonnes-pinterieures');
        echo render_view($args); ?>
    </div>
    <!--  // ******** 3 colonnes ********* -->
</div>
</div>

<?php get_footer(); ?>