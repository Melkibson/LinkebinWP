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

get_header();
?>

<form method="post" style="margin-top: 100px; height: 100px; background: #efefef;">
	<div class="form-group">
		<label for="login">Identifiant</label>
		<input type="text" class="form-control" id="login" name="login" placeholder="Michel">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="example@linkebin.com">
	</div>
	<button type="submit" class="btn btn-primary" name="submitted">Connexion</button>

</form>

<?php get_footer();
