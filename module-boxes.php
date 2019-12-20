

        <?php


        $boxes = get_posts(array(
            'post_type' => 'Boîtes',
            'order' => 'ASC',
            'showposts' => 3
        ));

        foreach ($boxes as $post) {
            $image = get_the_post_thumbnail($post->ID, 'large');
            $url = $post->url;
            $content = $post->text;
        ?>
            <div class="col-md-4">
                <div class="box--grey">

                    <a href="<?php echo $url; ?>">
                        <?php echo $image ?>
                        <h3><?php the_title_attribute() ?></h3>
                        <?php echo $content ?>

                    </a>
                </div>
            </div>

        <?php }
        ?>

