<?php
/*
 *  Author: Prospection
 *  URL: prospection.qc.ca
 *  Custom functions, support, custom post types and more.
 */

 /*
 	Fonction pour autoriser la connexion automatique au Prospecteur 1
	Autoriser à partir du profil WP éditeur
 */

if ( current_user_can('delete_others_pages') )
{
	session_start();

	$_SESSION['nom'] = 'asterix';
	$_SESSION['mdp'] = 'Le24Janvier2014$';

}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('prospecteur', get_template_directory() . '/languages');
}

/*
 * ========================================================================
 * Functions
 * ========================================================================
 */

// Load Custom Theme Scripts using Enqueue
function prospecteur_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), '1.11.1'); // Google CDN jQuery
        wp_enqueue_script('jquery'); // Enqueue it!

		wp_register_script('prospecteurscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
		wp_enqueue_script('prospecteurscripts'); // Enqueue it!
    }
}

// Hook into the 'wp_enqueue_scripts' action
//add_action( 'wp_enqueue_scripts', 'frameworkCssJsKickstarter' );
// Loading Conditional Scripts
function conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Theme Stylesheets using Enqueue
function prospecteur_styles()
{
	wp_register_style('prospecteur', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('prospecteur'); // Enqueue it!
}

// RT2014
// Création des options de navigation, des menus éditables via le tableau de bord et affichable ainsi :
// < ?php wp_nav_menu( array( 'theme_location' => 'navigation-principale-horizontale' ) ); ? >
function register_prospecteur_navigation()
{
    register_nav_menus( array(
        'navigation-principale-horizontale' => __('Navigation principale horizontale', 'prospecteur'),
        'navigation-principale-verticale' => __('Navigation Activités', 'prospecteur'),
        'navigation-secondaire' => __('Navigation Club', 'prospecteur'),
		'navigation-pied-de-page' => __('Navigation Mission', 'prospecteur')
    ));
}

add_action('init', 'register_prospecteur_navigation');


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class( $classes, $item )
{
	if( is_single() && $item->title == "Blog" )
	{ //Notice you can change the conditional from is_single() and $item->title
		$classes[] = "special-class";
	}
	return $classes;
}



// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

function more($more) {
return '<a class="read" href="'.get_permalink().'">Lire la suite</a>';
}
add_filter('the_content_more_link', 'more');


// Remove Admin bar
// function remove_admin_bar()
// {
//     return false;
// }

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions
add_action('init', 'prospecteur_scripts'); // Add Custom Scripts
//add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts

//add_action('wp_enqueue_style', 'prospecteur_styles'); // Add Theme Stylesheet

add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5wp_view_article'); // Add 'View Article' button instead of [...] for Excerpts
// add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

add_shortcode('embrouillerCourriel', 'embrouillerCourriel'); // Place [embrouillerCourriel] in Pages, Posts now.

/*
 * ========================================================================
 *  Shortcodes
 * ========================================================================
 */

// Shortcode Demo with simple <h2> tag
function embrouillerCourriel($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<a href="javascript:genDynCourriel( \'info\' )" >Contactez-nous par courriel</a>';
}

// RT2014
// Ajouter un SHORTCODE
// Afficher le contenu via < ?php echo do_shortcode( "[aucuneArticle]" ); ? >
function aucunArticle() // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h5>Aucun article</h5>';
}

add_shortcode('aucunArticle', 'aucunArticle');



/*
Enlever les menus non nécessaires pour le profil éditeur
*/

function remove_menus ()
{
	global $menu;
	global $current_user;

	//$current_user = current_user_can('activate_plugins');

	if ( ! current_user_can('activate_plugins'))
	{
		$restricted = array(__('Links'),__('Tools'),__('Comments'),__('Profil'));
		end ($menu);

		while (prev($menu))
		{
			$value = explode(' ',$menu[key($menu)][0]);

			if(in_array($value[0] != NULL?$value[0]:"" , $restricted))
			{
				unset($menu[key($menu)]);
			}
		}
	}
}

add_action('admin_menu', 'remove_menus');

/**
 * @var $roleObject WP_Role
 * Ajouter le menu dans le tableau de bord de WP : Apparence, afin que le profil éditeur puisse accéder à Apparence -> Menus
 */
$roleObject = get_role( 'editor' );

if (!$roleObject->has_cap( 'edit_theme_options' ) )
{
    $roleObject->add_cap( 'edit_theme_options' );
}

/*
Admin - login personnalisé - ajout du logo de Prospection lors du login - l'image est dans le répertoire images du thème utilisé
*/

add_action("login_head", "my_login_head");
function my_login_head() {
	echo "
	<style>
	body.login {
		background-color:#f2f2f2;}

	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/images/logo-rotary-login.png') no-repeat scroll center top transparent;
		height: 100px;
		width: 317px;
	}
	</style>
	";
}

/*
Custom admin login logo link - destination du lien lors du click sur le logo
*/
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url)
{
	return 'http://www.prospection.qc.ca';
}

/*
Removing Dashboard Widgets - en page d'accueil du tableau de bord, on retire les widgets non désirées
*/

function disable_default_dashboard_widgets()
{
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}

add_action('admin_menu', 'disable_default_dashboard_widgets');

/*
Admin - personnaliser le texte du pied de page
*/
function modify_footer_admin ()
{
	echo 'Créé par <a href="http://www.prospection.qc.ca/">Prospection inc.</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');

/*
Masquer la mention de mise à jour automatique
*/
//add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );


/*
Admin - ajouter des widgets personnalisées au tableau de bord - contenu visible par le client une fois connecté
*/

function mon_widget_bienvenue()
{
	global $wp_meta_boxes;

	wp_add_dashboard_widget('widget_bienvenue', 'Administration du site', 'widget_bienvenue');
}

function widget_bienvenue()
{
	echo '
	<div style="overflow:hidden; margin-top:35px; ">
	<?php # PAGES ?>
	<div style="width:21%; float:left;">
		<a href="../../../contenu/wp-admin/edit.php?post_type=page">
			<img src="../themes/rotary/images/tableau-bord/gestion-pages.png" alt="" />
		</a>
	</div>
	<?php # ARTICLES ?>
	<div style="width:21%; float:left;">
		<a href="../../../contenu/wp-admin/edit.php">
			<img src="../themes/rotary/images/tableau-bord/gestion-articles.png" alt="" />
		</a>
	</div>
	<?php # CATEGORIE ?>
	<div style="width:21%; float:left;">
		<a href="../../../contenu/wp-admin/edit-tags.php?taxonomy=category">
			<img src="../themes/rotary/images/tableau-bord/gestion-categories.png" alt="" />
		</a>
	</div>
	<div style="clear:both;"></div>
	<?php # MEDIAS ?>
	<div style="width:21%; float:left;">
		<a href="../../../contenu/wp-admin/upload.php">
			<img src="../themes/rotary/images/tableau-bord/gestion-medias.png" alt="" />
		</a>
	</div>

</div>
	<br />
	<h2 style="font-size:17px; color:#1A587F">> Gestion des nouvelles</h2><br />
	<span style="font-size:14px; line-height:28px;">
		<span style="font-weight:bold; color:#1A587F;">- Pour ajouter une nouvelle : </span><br />Cliquez sur le lien "Articles" puis "ajouter" entré le titre et texte approprié. <br />** Sélectionnez par la suite la <strong>catégorie "Nouvelles et Activités"</strong> et cliquez sur "publier" (bouton bleu).</span><br />
	<br />
	<span style="font-size:14px; line-height:28px;">
	<span style="font-weight:bold; color:#1A587F;">- Pour modifier une nouvelle :</span><br />Cliquez sur le lien "Articles" et sélectionnez  la liste déroulante "Voir les catégories" cliquez sur <strong>"Nouvelles et Activités"</strong> et appuyez sur "Filtrer". Vous pouvez alors modifiez la nouvelle désirée.</span>
	<br /><br />
	<hr style="color:#ccc;"/>
	<h2 style="font-size:17px; color:#1A587F">> Gestion de vos compétences</h2><br />

	<span style="font-size:14px; line-height:28px;">
		<span style="font-weight:bold; color:#1A587F;">- Pour ajouter un champ de compétence : </span><br />Cliquez sur le lien "Articles" puis "ajouter" entré le titre et texte approprié. <br />** Sélectionnez par la suite la <strong>catégorie "Compétence"</strong> et cliquez sur "publier" (bouton bleu).</span><br />
	<br />
	<span style="font-size:14px; line-height:28px;">
	<span style="font-weight:bold; color:#1A587F;">- Pour modifier un champ de compétence :</span><br />Cliquez sur le lien "Articles" et sélectionnez  la liste déroulante "Voir les catégories" cliquez sur <strong>"Compétence"</strong> et appuyez sur "Filtrer". Vous pouvez alors modifiez le champ de compétence désiré.</span>
	<br /><br />
	<hr style="color:#ccc;"/>
	<h2 style="font-size:17px; color:#1A587F">> Gestion des publications</h2><br />

	<span style="font-size:14px; line-height:28px;">
		<span style="font-weight:bold; color:#1A587F;">- Pour ajouter une publication : </span><br />Cliquez sur le lien "Articles" puis "ajouter" entré le titre et texte approprié. <br />** Sélectionnez par la suite la <strong>catégorie "Publications"</strong> et cliquez sur "publier" (bouton bleu).</span><br /><br />
	<span style="font-size:14px; line-height:28px;">
	<span style="font-weight:bold; color:#1A587F;">- Pour modifier une publication :</span><br />Cliquez sur le lien "Articles" et sélectionnez  la liste déroulante "Voir les catégories" cliquez sur <strong>"Publications"</strong> et appuyez sur "Filtrer". Vous pouvez alors modifiez le champ de compétence désiré.</span>
	<br /><br />

	';
}

//add_action('wp_dashboard_setup', 'mon_widget_bienvenue');

/*
Admin - ajouter des widgets personnalisées au tableau de bord - contenu visible par le client une fois connecté
*/
function mon_widget_prospecteur_v1()
{
	global $wp_meta_boxes;

	wp_add_dashboard_widget('widget_prospecteur_v1', 'Gestion du site Internet', 'widget_prospecteur_v1');
}

function widget_prospecteur_v1()
{
    session_start();
	echo '
		<div style="border:solid 1px #ccc; text-align:center; border-radius:4px; padding:15px;">
			<img src="http://rotary-quebecest.org/contenu/prospecteur/themes/rotary/images/gestion-site.jpg" />
			<ul>
				<li><a href="http://rotary-quebecest.org/contenu/wp-admin/edit.php?post_type=page"/>Gestion des pages</a></li>
				<li><a href="http://rotary-quebecest.org/contenu/wp-admin/edit.php?post_type=diaporama"/>Gestion du diaporama (accueil)</a></li>
				<li><a href="http://rotary-quebecest.org/contenu/wp-admin/edit.php?post_type=nouvelles-du-club">Gestion des nouvelles</a></li>
				<li>Modifier Rotary international - accueil (voir section Articles)</li>
				<li><a href="http://rotary-quebecest.org/contenu/wp-admin/edit.php?post_type=section-programme">Gestion des Programmes</a></li>
				<li>Gestion des activités / calendrier</li>
				<li>Modifier le pied de page (voir section Articles)</li>
			</ul>
		</div>
		';
}

/**
*	Personnaliser (remplacer) l'icône WP du dashboard (en haut, à gauche)
*/
add_action('wp_dashboard_setup', 'mon_widget_prospecteur_v1');


//
/*
Admin - ajouter des widgets personnalisées au tableau de bord - contenu visible par le client une fois connecté
*/
function mon_widget_prospecteur_v2()
{
	global $wp_meta_boxes;

	wp_add_dashboard_widget('widget_prospecteur_v2', 'Gestion du CLub Rotary', 'widget_prospecteur_v2');
}

function widget_prospecteur_v2()
{
    session_start();
	echo '
		<div style="margin-top:1em;border:solid 1px #ccc; text-align:center; border-radius:4px; padding:15px;">
			<a href="http://rotary-quebecest.org/prospecteur/index.php" target="_blank" title="Gestion des membres, des envois et des rapports">
				<img src="http://rotary-quebecest.org/contenu/prospecteur/themes/rotary/images/gestion-rotary-wp.jpg" />
			</a>
			<p style="font-size:14px; line-height:1.5em;"><a  style="text-decoration: underline; font-weight: bold;" href="http://rotary-quebecest.org/prospecteur/index.php" target="_blank" title="Gestion des membres, des envois et des rapports">Veuillez cliquez ici pour vous connecter &agrave; la console d&rsquo;administration du <span style="font-weight:bold; color:#21759B;">Prospecteur.</span></a></p>
			<ul>
				<li>Gestion des membres</li>
				<li>Gestion des adhésions</li>
				<li>Gestion des comités</li>
				<li>Gestion de l\'assiduité</li>
				<li>Gestion des envois</li>
				<li>Gestion des rapports</li>
			</ul>
		</div>
		';
}

add_action('wp_dashboard_setup', 'mon_widget_prospecteur_v2');

/**
*	Personnaliser (remplacer) l'icône WP du dashboard (en haut, à gauche)
*/
add_action('admin_head', 'my_custom_logo');

function my_custom_logo() {
	echo "
	<style type='text/css'>
	#wp-admin-bar-wp-logo > .ab-item .ab-icon {background:url('".get_bloginfo('template_url')."/img/logo-ico-prospection.png') no-repeat;}
	#wpadminbar.nojs #wp-admin-bar-wp-logo:hover > .ab-item .ab-icon, #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon { background: url('".get_bloginfo('template_url')."/img/logo-ico-prospection.png') !important; }
	</style>";
}

// Éviter le scroll lors du clique sur le "lire la suite".
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );

// Hide admin help tab
function hide_help() {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
          </style>';
}
add_action('admin_head', 'hide_help');


// renommer le menu du tableau de bord : Articles pour Nouvelles ( adpater selon les besoins )
function menu_item_text( $menu )
{
     $menu = str_ireplace( 'Articles', 'Nouvelles', $menu );
     return $menu;
}
//add_filter('gettext', 'menu_item_text');
//add_filter('ngettext', 'menu_item_text');

/* Disable the Admin Bar. */
add_filter( 'show_admin_bar', '__return_false' );

function hide_admin_bar_settings() {
?>
	<style type="text/css">
		.show-admin-bar {
			display: none;
		}
	</style>
<?php
}

function disable_admin_bar() {
    add_filter( 'show_admin_bar', '__return_false' );
    add_action( 'admin_print_scripts-profile.php',
         'hide_admin_bar_settings' );
}

add_action( 'init', 'disable_admin_bar' , 9 );


// RT2014
// Register Theme Features
function custom_theme_features()
{
	// Add theme support for Post Formats
	$formats = array( 'status', 'quote', 'gallery', 'video', 'link', 'aside' );
	add_theme_support( 'post-formats', $formats );
}

add_action( 'after_setup_theme', 'custom_theme_features' );

// RT 2014
// afficher ou non le fil d'ariane header.php
// On SET la variable GLOBAL dans le fichier fonction
 $GLOBALS['filAriane'] = true;
// On utilise la valeur de la variable dans un fichier TPL
// global $filAriane;
// exemple :
// if ( $filAriane ) :
// wp_nav_menu( array( 'theme_location' => 'navigation-principale-horizontale', 'menu_class' => 'breadcrumbs' ) );
// endif;

//RT2014
// Fil d'arianne
// la classe "breadcrumbs" est liée au framework CSS Kickstarter 99Lime
function filAriane()
{
	global $post;
	// Afficher le premier lien du fil d'ariane (remarque : le 70 est l'ID de la PAGE d'accueil (à adapter à chaque fois))
	$crumbs = '<ul class="breadcrumbs"><li><a href="'.get_option( 'home' ).'">'.get_the_title( 70 ).'</a></li>';

	// Si la PAGE à un PARENT, afficher le lien vers celui-ci
	if ( $post->post_parent )
	{
		$crumbs .= '<li><a href="'.get_permalink( $post->post_parent ).'">'.get_the_title( $post->post_parent ).'</a></li>';
	}

	// Si ce ni la page d'accueil du site, ni la page des articles
	if(( ! is_front_page() ) && ( is_page() ) )
	{
		$crumbs .= '<li>'.get_the_title( $post->ID ).'</li>';
	}

	// Si ce n'est ni la page d'accueil du site, ni la page des articles ou archives
	if ( ( is_home() || ( is_archive() ) ) )
	{
		$crumbs .= ' <li>'.get_the_title( get_option( page_for_posts ) ).'</li>';
	}

	// Si c,est une page SINGLE
	if ( is_single() )
	{
		$crumbs .= '<li><a href="'.get_permalink(get_option( page_for_posts ) ).'">'.get_the_title( get_option( page_for_posts ) ).'</a></li>';
		$crumbs .= ' <li>'.get_the_title( $post->ID ).'</li>';
	}

	$crumbs .=    '</ul>';

	echo $crumbs;
}

// RT2014
// supprimer toutes les classes "excédentaires" générées par WP
//add_filter( 'nav_menu_css_class', 'mycssattributesfilter', 100, 1 );
//add_filter( 'nav_menu_item_id', 'mycssattributesfilter', 100, 1 );
add_filter( 'page_css_class', 'mycssattributesfilter', 100, 1 );

function mycssattributesfilter($var)
{
  return is_array( $var ) ? array_intersect( $var, array( 'current-menu-item' ) ) : '';
}

// RT2014
// test ajout META
add_action('wp_head','keywords_and_desc');
function keywords_and_desc(){
    global $post;
    if (is_single()||is_page()){
        if(get_post_meta($post->ID,'my_keywords',true) != '')
            echo    '<meta content="'.get_post_meta($post->ID,'my_keywords',true).'" name="keywords">';
        if(get_post_meta($post->ID,'my_description',true) != '')
            echo    '<meta content="'.get_post_meta($post->ID,'my_description',true).'" name="description">';
    }
}

/* TRES IMPORTANT - PERMET D'AFFICHER UNE VIEW PAR SINGLE POST (SINON IMPOSSIBLE) */
/* ref. : http://wp-types.com/forums/topic/cant-get-render_view-to-show-a-specific-post/ */
add_filter('wpv_filter_query', 'show_only_postid', 10, 2);

function show_only_postid( $query, $settings )
{
	if ( $settings['view_id'] == 21 ) // ID de la VIEW, ne fonctionne pas avec le NAME ou le SLUG /
	{
		global $WP_Views;
		$view_shortcode_attributes = $WP_Views->view_shortcode_attributes;
		$query['p'] = $view_shortcode_attributes[0]['post_id'];
	}

	elseif ( $settings['view_id'] == 14) // ID de la VIEW, ne fonctionne pas avec le NAME ou le SLUG /
	{
		global $WP_Views;
		$view_shortcode_attributes = $WP_Views->view_shortcode_attributes;
		$query['p'] = $view_shortcode_attributes[0]['post_id'];
	}

	return $query;
}




/**
* Supprimer la barre de tâche admin de WP pour les abonnés
*/
function themerotary_disable_admin_bar() {
	if( ! current_user_can('edit_posts') )
		add_filter('show_admin_bar', '__return_false');
}
add_action( 'after_setup_theme', 'themerotary_disable_admin_bar' );

/**
* Rediriger les abonnés (membres rotary) vers la page du bottin privé lorsqu'ils sont connectés
*/
function themerotary_redirect_admin()
{
	// Vérifier si le profil est moins élevé qu'éditeur
	if ( ! current_user_can( 'publish_pages' ) )
	{
		wp_redirect( 'http://rotary-quebecest.org/fr/membres/bottin.php' );
		exit;
	}
}

add_action( 'admin_init', 'themerotary_redirect_admin' );
