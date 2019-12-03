   
        <footer class="rt-footer">
        
            <div class="container">
            	<div class="inner-footer">
                <div class="row">
                   
                       <div class="col-md-6 footer-col-info">
                       		<div class="inner-foot-infos-club">
                            	 <?php query_posts('cat=9'); ?>
										<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                        	<h3 class="club-yellow-foot"><?php echo the_title(); ?></h3> <!--Club Rotary de Québec-Est  --> 
                                            <?php the_content(); ?>
                                    <?php endwhile; endif; ?>
                           		<p class="foot-tel"><span class="glyphicon glyphicon-phone margin-right-5" aria-hidden="true"></span>Téléphone : 418 849-7183</p>
                            </div>
                       </div><!-- -->
                       <div class="col-md-3">
                            <?php query_posts('cat=10'); ?>
                                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
                                    <h4><?php echo the_title(); ?></h4><!-- Événements -->
                           
                                        <?php the_content(); ?>
                                <?php endwhile; endif; ?>                       
                       </div><!-- -->
                       <div class="col-md-3">
                            <?php query_posts('cat=3'); ?>
                            	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                    <h4><?php echo the_title(); ?></h4><!--  Suivez-nous! -->
                                    
                                    <a href="https://www.facebook.com/pages/Club-Rotary-Qu%C3%A9bec-Est/115076485260317" target="_blank">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/facebook-foot.png" />
                                    </a>                     
                                    <div class="row theme-rotary">                                
                                        <p><img class="alignnone size-full wp-image-721" src="https://rotary-quebecest.org/contenu/wp-content/uploads/2014/09/rotary-theme-2018-2019.png" alt="Rotary - Soyons l'inspiration" title="Rotary - Soyons l'inspiration" width="125" height="127"></p>
                               
                             </div>     <?php endwhile; endif; ?>                    
                        </div><!-- -->
                     </div>     
                        <div class="row text-align-center reserve ">
                       		<div class="padding-top-1">                        
                            	<p>Tous droits réservés &copy; <?php echo date('Y'); ?>  <?php echo bloginfo('name'); ?></p>
                          </div>
                        </div><!-- -->
                        
                    
                
                </div><!-- innner -->
            </div><!--container  -->
            
        </footer>
    
</div><!-- .rt-main -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60946453-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>