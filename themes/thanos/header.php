<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thanos
 */
if (isset($_GET['logout'])):
        wp_logout();
endif;
?>
<!doctype html>
<html <?php language_attributes(); ?> style="margin: 0 !important;">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.6.1/mapbox-gl.css" rel="stylesheet" />
    <style>


    </style>

	<?php wp_head(); ?>
</head>

<body id="page-top">
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js"></script>
<link
        rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css"
        type="text/css"
/>

        <nav class="" id="">
            <div class="logo">
                <span>Linke</span><span>Bin</span>
            </div>
            <div class="">
                <div id="navbarResponsive">
                    <ul class="">
                        <li id="contact-us" class="" role="presentation"><a class=" js-scroll-trigger" href="mailto:contact@linkebin">Contactez-nous</a></li>
                        <li class="nav-item" role="presentation">
                            <?php if (is_user_logged_in()):
	                            $user = get_current_user_id(); ?>
                                <a href="<?= esc_url(get_author_posts_url($user)); ?>" class="my_account  js-scroll-trigger shadow-sm">Mon Compte</a>
                                <a href="?logout=true" class="my_account  js-scroll-trigger shadow-sm">Deconnexion</a>
                            <?php
                            else:?>
                                <a id="submit" href="<?= esc_url(site_url('/login') ); ?>" class="my_account  js-scroll-trigger shadow-sm">Connexion</a>
                            <?php endif;?>
                        </li>
                    </ul>
                </div>
        </nav>



