<?php get_header();
/*
 Template Name: Register
 */

if (isset($_POST['submitted']) && empty($errors)):
	$user_login = strip_tags(trim($_POST['login']));
	$user_email = filter_var(strip_tags(trim($_POST['email'])),FILTER_VALIDATE_EMAIL );
	$user_password = strip_tags(trim($_POST['password']));
	$user_confirmed_password = strip_tags(trim($_POST['password2']));

	//Password strength validation
	$uppercase = preg_match('@[A-Z]@', $user_password);
	$lowercase = preg_match('@[a-z]@', $user_password);
	$number    = preg_match('@[0-9]@', $user_password);

	$errors = array();

	$args = array(
		'user_pass' => $user_password,
		'user_login' => $user_login,
		'user_email' => $user_email
	);
    if (isset($_POST['submitted']) && isset($errors)):
        if (empty($user_login)):
            $errors['user_login'] = 'Veuillez renseigner un identifiant';
        elseif (strlen($user_login) < 3):
            $errors['user_login'] = 'Identifiant trop court';
        elseif (strlen($user_login) > 10):
            $errors['user_login'] = 'Identifiant trop long';
        endif;
        if (empty($user_email)):
            $errors['user_email'] = 'Veuillez renseigner un email';
        endif;
        if (empty($user_password)):
            $errors['user_password'] = 'Veuillez renseigner un mot de passe';
        elseif (!$uppercase || !$lowercase || !$number || strlen($user_password) < 8):
	        $errors['user_password'] = 'Le mot de passe doit avoir une longueur d\'au moins 8 caractères
	        et contenir une majuscule et un chiffre';
        endif;
        if($user_password != $user_confirmed_password):
            $errors['user_confirmed_password'] = 'Le mot de passe ne correspond pas';
        endif;
    endif;
	wp_insert_user($args);
	$object = 'Confirmation de votre inscription';
	$msg = 'Vous êtes maintenant inscrit';
	$headers = 'From : '.get_option('admin_email')."\r\n";
	wp_mail($user_email, $object, $msg, $headers);
endif;


?>
<form class="login-form" method="post" style="margin-top: 100px; height: 500px; background: #efefef; " action="">
	<div class="form-group" style="padding: 50px 0;">
        <label for="login">Identifiant</label>
        <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
        <span><?= $errors['user_login']?></span>
    </div>
    <div class="form-group" style="padding: 50px 0;">
        <label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" style="">
        <span><?= $errors['user_email']?></span>
	</div>
	<div class="form-group" style="padding: 50px 0;">
		<label for="password">Mot de passe</label>
		<input type="password" class="form-control" id="password" name="password">
        <span><?= $errors['user_password']?></span>
    </div>
	<div class="form-group" style="padding: 50px 0;">
		<label for="password2">Confirmer le mot de passe</label>
		<input type="password" class="form-control" id="password2" name="password2">
        <span><?= $errors['user_confirmed_password']?></span>
    </div>
	<input type="submit" class="btn btn-primary" value="S'inscrire" name="submitted">
</form>

<?php get_footer();