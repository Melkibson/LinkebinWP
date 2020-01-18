<?php
/*
 Template Name: Register
 */


if (isset($_POST['submitted']) && empty($errors)):
	$user_login = strip_and_trim($_POST['login']);
	$user_email = filter_var(strip_and_trim($_POST['email']),FILTER_VALIDATE_EMAIL );
	$user_password = strip_and_trim($_POST['password']);
	$user_confirmed_password = strip_and_trim($_POST['password2']);
	//Password strength validation
	$uppercase = preg_match('@[A-Z]@', $user_password);
	$lowercase = preg_match('@[a-z]@', $user_password);
	$number    = preg_match('@[0-9]@', $user_password);
	$errors = array();


	$args = array(
		'user_pass' => password_hash($user_password, PASSWORD_BCRYPT),
		'user_login' => $user_login,
		'user_email' => $user_email,
		'user_activation_key' => '',
	);
    if (isset($_POST['submitted'])):
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
	wp_mail($user_email, $object, $msg);
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
<body id="reset-page" class="h-100">
    <img src="<?= get_template_directory_uri() . '/assets/img/logo_linkebin.png'?>" width="150px" alt="">
    <section class="col-xl-5 col-md-8 col-sm-10 m-auto py-0">
        <div class="form-group form-title">
            <h2 class="text-left">S'inscrire</h2>
        </div>
        <form class="form-login shadow-lg p-0" method="post"  action="">
            <div class="col-10 m-auto form-content">
                <div class="form-group">
                    <label for="login">Identifiant</label>
                    <input type="text" class="form-control" id="login" name="login">
                    <span><?php if (isset($errors['user_login'])) : echo $errors['user_login']; endif;?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <span><?php if (isset($errors['user_email'])) : echo $errors['user_email']; endif;?></span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span><?php if (isset($errors['user_password'])) : echo $errors['user_password']; endif;?></span>
                </div>
                <div class="form-group">
                    <label for="password2">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password2" name="password2">
                    <span><?php if (isset($errors['user_confirmed_password'])) : echo $errors['user_confirmed_password']; endif;?></span>
                </div>
                <input type="submit" class="shadow" value="s'inscrire" name="submitted" id="submit">
            </div>
        </form>

<?php get_footer();