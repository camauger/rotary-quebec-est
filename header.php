<!DOCTYPE HTML>

<html lang="fr" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,  user-scalable=no">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
                                        echo ' :';
                                    } ?> <?php bloginfo('name'); ?></title>

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png">

    <!-- bootstrap -->
    <!-- version 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />

    <!-- css site -->
    <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" type="text/css" media="screen" />

</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v5.0&appId=161767141187083&autoLogAppEvents=1"></script>


<body <?php body_class(); ?>>
<div class="wrapper--nav">
    
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="" href="<?php echo home_url(); ?>">
                                    <img class="d-inline-block align-top" src="<?php echo get_template_directory_uri(); ?>/images/rotary-qcest-logo-full.png" alt="Rotary - Club de Québec-Est">

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto menu-principal">
                <li class="nav-item">
                    <a class="nav-link" href="https://rotary-quebecest.org/le-club/mot-du-president/">Le club</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://rotary-quebecest.org/mission-et-objectifs/mission/">Missions et objectifs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://rotary-quebecest.org/activites/calendrier/">Activités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://rotary-quebecest.org/fr/membres/bottin.php">Bottin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://rotary-quebecest.org/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-secondary" href="https://rotary-quebecest.org/fr/_new/demande_adhesion.php">Devenir membre</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
</div>






    <!-- <nav id="menupage" class="shadow-bottom navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                    <img class="visible-lg visible-md  rt-brand" src="<?php echo get_template_directory_uri(); ?>/images/rotary-qcest-logo-full.png" alt="Club Rotary Montmagny" />
                    <img class="visible-xs  visible-sm rt-brand" src="<?php echo get_template_directory_uri(); ?>/images/rotary-qcest-logo-medium.png" alt="Club Rotary Québec Est" />
                </a>
            </div>
            <div class="navbar-collapse collapse" id="nav-collapse">
                <?php wp_nav_menu(array('menu' => 'menu-principal', 'container' => '', 'items_wrap' => '<ul class="nav navbar-nav navbar-right rt-navbar">%3$s</ul>')); ?>
            </div>
        </div>
    </nav> -->
    <div class="rt-wrapper">