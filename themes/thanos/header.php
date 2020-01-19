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

	<?php wp_head(); ?>
</head>

<body id="page-top">

        <nav class="navbar navbar-expand-lg fixed-top border-0 shadow-sm p-0" id="mainNav">
            <button id="nav" class="navbar-brand border-0 m-0 h-100">
                <img class="logo" src="<?php echo get_template_directory_uri() . '/assets/img/logo_linkebin.png';?>" width="150px" >
            </button>
            <div class="container-fluid">
                <button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler navbar-toggler-right" type="button" aria-controls="navbarResponsive"
                        aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav ml-auto">
                        <li id="contact-us" class="nav-item" role="presentation"><a class=" js-scroll-trigger" href="#contact">Contactez-nous</a></li>
                        <li class="nav-item" role="presentation">
                            <?php if (is_user_logged_in()):
	                            $user = get_current_user_id(); ?>
                                <a href="<?= esc_url(get_author_posts_url($user)); ?>" class="my_account  js-scroll-trigger shadow-sm">Mon Compte</a>
                                <a href="?logout=true" class="my_account  js-scroll-trigger shadow-sm">Deconnexion</a>
                            <?php
                            else:?>
                                <a href="<?= esc_url(site_url('/login') ); ?>" class="my_account  js-scroll-trigger shadow-sm">Connexion</a>
                            <?php endif;?>
                        </li>
                    </ul>
                </div>
        </nav>



