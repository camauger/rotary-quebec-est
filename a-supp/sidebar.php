<?php if ( is_page( 'promotions' ) ) : ?>
	<?php if ( is_active_sidebar( 'widget-category' ) ) : ?>
		<?php dynamic_sidebar( 'widget-category' ); ?>
	<?php else : ?>
		<h5>La page demandée est actuellement en maintenance.</h5>
	<?php endif; ?>
<?php else : ?>
	<?php if ( is_active_sidebar( 'widget-area-1' ) || is_active_sidebar( 'widget-area-2' ) ) : ?>
		<?php dynamic_sidebar( 'widget-area-1' ); ?>
		<?php dynamic_sidebar( 'widget-area-2' ); ?>
	<?php else : ?>
	<?php endif; ?>
<?php endif; ?>