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
<link
        rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css"
        type="text/css"
/>

    <nav class="" id="">
        <div class="logo">
            <span>Linke</span><span>Bin</span>
        </div>
        <div>
            <ul class="">
                <li id="contact-us" class="" role="presentation"><a class=" js-scroll-trigger" href="mailto:contact@linkebin">Contactez-nous</a></li>
                <li class="nav-item" role="presentation">
                    <?php if (is_user_logged_in()):
                        $user = get_current_user_id(); ?>
                        <a href="<?= esc_url(get_author_posts_url($user)); ?>" class="my_account  js-scroll-trigger shadow-sm">Mon Compte</a>
                        <a href="?logout=true" class="my_account  js-scroll-trigger shadow-sm">Deconnexion</a>
                    <?php
                    else:?>
                        <a class="btn-login">Connexion</a>
                    <?php endif;?>
                </li>
            </ul>
        </div>
    </nav>
    <section class="section-login">

        <div class="text">
        <a href="#" id="back">Retour connexion</a>
            <h2 class="text-left">Bienvenue sur<br>Linke<span>Bin</span>!</h2>
        </div>
        <div class="line"></div>
        <div class="container-form">
            <div class="container-register">
                <form method="post">
                    <div class="">
                        <div class="container-input">
                            <label for="login">Identifiant</label>
                            <input type="text" class="form-control" id="login" name="login" <?php if (isset($errors['user_login'])):?> value="<?= $user_login; endif;?>">
                            <div class="line-input"></div>
                            <span><?php if (isset($errors['user_login'])) : echo $errors['user_login']; endif;?></span>
                        </div>
                        <div class="container-input">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" <?php if (isset($errors['user_email'])):?> value="<?= $user_email; endif;?>">
                            <div class="line-input"></div>
                            <span><?php if (isset($errors['user_email'])) : echo $errors['user_email']; endif;?></span>
                        </div>
                        <div class="container-input">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="line-input"></div>
                            <span><?php if (isset($errors['user_password'])) : echo $errors['user_password']; endif;?></span>
                        </div>
                        <!-- <div id="message">
                            <p>Le mot de passe doit contenir les elements suivant:</p>
                            <span id="letter" class="invalid">Une minuscule</span><br>
                            <span id="capital" class="invalid">Une majuscule</span><br>
                            <span id="number" class="invalid">Un chiffre</span><br>
                            <span id="length" class="invalid">8 caracteres</span>
                        </div> -->
                        <div class="container-input">
                            <label for="password2">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                            <div class="line-input"></div>
                            <span><?php if (isset($errors['user_confirmed_password'])) : echo $errors['user_confirmed_password']; endif;?></span>

                        </div>
                    <!-- <div id="message-pwd">
                        <span id="match" class="invalid"></span>
                    </div> -->
                        <div class="submit">
                            <input type="submit"  id="submit" name="submitted" value="s'inscrire">
                        </div>
                    </div>
                </form>
            </div>
            <div class="container-login">
                <form method="post">
                    <div class="">
                        <div class="container-input">
                            <label for="login">Identifiant</label>
                            <input type="text" id="login" name="login" aria-describedby="emailHelp">
                            <div class="line-input"></div>
                        </div>
                        <div class="container-input">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password">
                            <div class="line-input"></div>
                        </div>
                        <div class="form-footer">
                            <a id="forgot" href="#">Mot de passe oublié ?</a>
                            <a id="register" href="#">Pas encore de compte ?</a>
                        </div>
                        <div class="submit">
                            <input type="submit"  id="submit" name="submitted" value="se connecter">
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="container-forgot">
                <form method="post">
                    <div class="">
                        <div class="container-input">
                            <label for="login">Identifiant</label>
                            <input type="text" class="form-control" id="login" name="login" placeholder="Michel">
                            <div class="line-input"></div>
                        </div>
                        <div class="container-input">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@linkebin.com">
                            <div class="line-input"></div>
                        </div>
                            <div class="submit">
                                <input type="submit" class="shadow" id="submit" name="submitted" value="envoyer">
                            </div>
                        </div>
                    </div>
                </form>     
            </div>
        </div>
    </section>



