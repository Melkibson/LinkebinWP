<?php
/**
Template Name: Reset
 */


if (isset($_POST['submitted'])):
	$login = $_GET['user_login'];
	$reset_key = $_GET['reset_key'];
	$user = get_user_by('login', $login);
	$user_reset_key = $GLOBALS['reset_key'];


	$password = strip_and_trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
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

get_header();?>
<div class="container"></div>

	<form method="post" style="margin-top: 100px; height: 100px; background: #efefef;">
		<?php
		?>
		<p></p>
		<div class="form-group">
			<label for="password">Nouveau mot de passe</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="•••••••••">
				<div class="message">
					<p>Le mot de passe doit contenir les elements suivant:</p>
					<span id="letter" class="invalid"><b>Une minuscule</b></span><br>
					<span id="capital" class="invalid"><b>Une majuscule</b></span><br>
					<span id="number" class="invalid"><b>Un chiffre</b></span><br>
					<span id="length" class="invalid"><b>8 caracteres</b></span>
				</div>
		</div>
		<div class="form-group">
			<label for="password2">Confirmer le mot de passe</label>
			<input type="password" class="form-control" id="password2" name="password2" placeholder="•••••••••">
			<div class="message">
				<span id="match" class="invalid">les mots de passes ne correspondent pas</span>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="submitted">Envoyer</button>
		</div>
	</form>

<?php get_footer();
