<!DOCTYPE HTML>
<!--[if lt IE 7 ]> <html lang="fr" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="fr" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="fr" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="fr" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="fr" class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,  user-scalable=no">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png">

<!-- bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"><link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
<!-- css site -->
<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" type="text/css" media="screen" />



</head>

<body <?php body_class(); ?>>
    <nav id="menupage" class="shadow-bottom navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                    <img class="visible-lg visible-md  rt-brand"
                        src="<?php echo get_template_directory_uri(); ?>/images/rotary-qcest-logo-full.png"
                        alt="Club Rotary Montmagny" />
                    <img class="visible-xs  visible-sm rt-brand"
                        src="<?php echo get_template_directory_uri(); ?>/images/rotary-qcest-logo-medium.png"
                        alt="Club Rotary Québec Est" />
                </a>
            </div>
            <div class="navbar-collapse collapse" id="nav-collapse">
                <?php wp_nav_menu( array('menu' => 'menu-principal', 'container' => '', 'items_wrap' => '<ul class="nav navbar-nav navbar-right rt-navbar">%3$s</ul>' )); ?>
            </div>
        </div>
    </nav>
    <div class="rt-wrapper">