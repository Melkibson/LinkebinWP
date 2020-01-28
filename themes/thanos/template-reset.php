<?php
/**
Template Name: Reset
 */


if (isset($_POST['submitted'])):
	$login = $_GET['user_login'];
	$reset_key = $_GET['reset_key'];
	$user = get_user_by('login', $login);
	$user_reset_key = $_SESSION['reset_key'];


	$password = strip_and_trim($_POST['password']);
	$confirmed_password = strip_and_trim($_POST['password2']);

	if (isset($password) && $reset_key === $user_reset_key):
		$args = array(
			'ID' => $user->ID,
			'user_pass' => $password
		);
	endif;
	$user_data = wp_update_user($args);

	if ($password !== $confirmed_password):
		echo '<script>alert("Les mots de passes ne correspondent pas")</script>';
	else:
		wp_update_user($args);
	endif;
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
<body id="user-page" class="h-100">
    <img src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">

			<section class="col-xl-5 col-md-8 col-sm-10 m-auto py-0">
                <div class="form-group form-title">
                    <h2 class="text-left">Reinitialiser son mot de passe</h2>
                </div>
				<form method="post" class=" form-login shadow-lg p-0">
                    <div class="col-10 m-auto form-content">
                        <div class="form-group">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="•••••••••">
                        </div>
                        <div id="message">
                            <p>Le mot de passe doit contenir les elements suivant:</p>
                            <span id="letter" class="invalid">Une minuscule</span><br>
                            <span id="capital" class="invalid">Une majuscule</span><br>
                            <span id="number" class="invalid">Un chiffre</span><br>
                            <span id="length" class="invalid">8 caracteres</span>
                        </div>
                        <div class="form-group">
                            <label for="password2">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="•••••••••">
                            <div id="message-pwd">
                                <span id="match" class="invalid"></span>
                            </div>
                        </div>
                        <div class="form-group pt-3">
                            <input type="submit" class="shadow" id="submit" name="submitted" value="envoyer">
                        </div>
                    </div>
				</form>
			</section>
</body>
<?php get_footer();
