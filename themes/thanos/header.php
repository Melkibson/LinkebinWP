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
                                <a href="<?php echo esc_url( wp_registration_url() ); ?>" class="my_account  js-scroll-trigger shadow-sm">Mon Compte</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="myNav" class="overlay-account ">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="overlay-content login-dark mx-auto my-auto">
                        <form method="post" style="  background:linear-gradient(70deg, #d6d9d4 30%, rgba(0,0,0,0) 30%), linear-gradient(30deg, rgb(199, 253, 202) 60%, #fff 60%);">
                            <h2 class="sr-only">Login Form</h2>
                            <div class="illustration"><i class="icon ion-ios-locked-outline" style="color: green;"></i></div>
                            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" style="font-family: Ubuntu, sans-serif;"></div>
                            <div class="form-group"><input class="form-control" type="password" placeholder="Mot de passe" name="password" style="font-family: Ubuntu, sans-serif;"></div>
                            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: green;font-family: Ubuntu, sans-serif;">Se connecter</button>
                            </div><a class="forgot" href="#" style="font-family: Ubuntu, sans-serif;">Identifiant ou mot de passe oublié ?</a>
                        </form>
                </div>
            </div>
        </nav>



