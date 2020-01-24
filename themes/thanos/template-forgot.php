<?php
/*
	Template Name: Forgot
 */

if (isset($_POST['submitted'])):
	$user_login = $_POST['login'];
	$user_email = $_POST['email'];
	$user = get_user_by('login', $user_login);
	$GLOBALS['reset_key'] = get_password_reset_key($user);


	$reset = esc_url(get_site_url() . '/reset?user_login=' . $user_login . '&reset_key='. $GLOBALS['reset_key']);

	if (email_exists($user_email) && username_exists($user_login)):
		$object = 'Reinitialisation de mot passe';
		$msg = <<<HTML
		<div>
		Cliquez sur ce lien pour reinitialiser votre mot de passe.
		<a href="{$reset}">Clique</a>
        </div>

HTML;
		wp_mail($user_email, $object, $msg);
	else:
		echo '<script>alert("je te connais po")</script>';
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
<nav class="form-nav d-flex justify-content-between">
    <img class="h-100" src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">
    <a href="<?= home_url('/') ?>"><img src="<?= get_template_directory_uri() . '/assets/img/back.svg'?>" width="40px" alt=""></a>
</nav>
    <body id="user-page" class="h-100">
    <section class="col-xl-5 col-md-8 col-sm-10 m-auto py-0">
        <div class="form-group form-title">
            <h2 class="text-left">Mot de passe oublié</h2>
        </div>
<form method="post" class="form-login shadow-lg p-0">
    <div class="col-10 m-auto form-content">
	<div class="form-group">
		<label for="login">Identifiant</label>
		<input type="text" class="form-control" id="login" name="login" placeholder="Michel">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="example@linkebin.com">
	</div>
        <div class="form-group pt-3">
            <input type="submit" class="shadow" id="submit" name="submitted" value="envoyer">
        </div>
    </div>
</form>
    </section>

<?php get_footer();
