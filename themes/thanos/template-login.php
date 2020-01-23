<?php
/*
 Template Name: Login
 */
if ( isset( $_POST['submitted'] ) ):

	$login_data                  = array();
	$login_data['user_login']    = sanitize_user( $_POST['login'] );
	$login_data['user_password'] = esc_attr( $_POST['password'] );


	$user_data = wp_signon( $login_data, false );

	if (is_wp_error($user_data)  ):
		echo '<script>alert("Utilisateur inconnu")</script>';
	else:
		wp_clear_auth_cookie();
		wp_set_current_user( $user_data->ID );
		wp_set_auth_cookie( $user_data->ID, true );
		wp_safe_redirect( home_url( '/' ) );
		exit;
	endif;
endif;
?>
<!doctype html>
<html <?php language_attributes(); ?> style="margin: 0 !important;" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body id="user-page" class="h-100">
<nav class="form-nav d-flex justify-content-between">
    <img class="h-100" src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">
    <a href="<?= home_url('/') ?>"><img src="<?= get_template_directory_uri() . '/assets/img/back.svg'?>" width="40px" alt=""></a>
</nav>
    <section class="col-xl-5 col-md-8 col-sm-10 m-auto py-0">
        <div class="form-group form-title">
            <h2 class="text-left">Se connecter</h2>
        </div>
        <form method="post" class="form-login shadow-lg p-0">
            <div class="col-10 m-auto form-content">
                <div class="form-group">
                    <label for="login">Identifiant</label>
                    <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group d-flex justify-content-between">
                    <a id="forgot" href="<?= esc_url(home_url('forgot'))?>">Mot de passe oublié ?</a>
                    <a id="register" href="<?= esc_url(home_url('register'))?>">Pas encore de compte ?</a>
                </div>
                <div class="form-group pt-3">
                    <input type="submit" class="shadow" id="submit" name="submitted" value="envoyer">
                </div>
            </div>
        </form>
    </section>
<?php  get_footer()?>
