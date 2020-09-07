<?php
//Register form validation

if (isset($_POST['register-submit']) && empty($errors)):

	$user_login = sanitize_user($_POST['register-login']);
	$user_email = filter_var(strip_and_trim($_POST['register-email']),FILTER_VALIDATE_EMAIL );
	$user_password = strip_and_trim($_POST['register-password']);
	$user_confirmed_password = strip_and_trim($_POST['password2']);
	//Password strength validation
	$uppercase = preg_match('@[A-Z]@', $user_password);
	$lowercase = preg_match('@[a-z]@', $user_password);
	$number    = preg_match('@[0-9]@', $user_password);
	$args = array(
		'user_pass' => $user_password,
		'user_login' => $user_login,
		'user_email' => $user_email,
		'user_activation_key' => '',
	);
    if (isset($_POST['register-submit'])):
	    $errors = array();
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
        if (empty($user_password) && empty($user_confirmed_password)):
            $errors['user_password'] = 'Veuillez renseigner un mot de passe';
        elseif (!$uppercase || !$lowercase || !$number || strlen($user_password) < 8):
	        $errors['user_password'] = 'Le mot de passe doit avoir une longueur d\'au moins 8 caractères
	        et contenir une majuscule et un chiffre';
        endif;
        if($user_password !== $user_confirmed_password):
            $errors['user_confirmed_password'] = 'Le mot de passe ne correspond pas';
        endif;
    endif;
	$data = wp_insert_user($args);
	if (!is_wp_error($data)):
        wp_insert_user($args);
        $user = get_user_by('login', $user_login);
        $user_id = $user->ID;
        $url = 'http://localhost:8000/AddUser/' . $user_id;
        wp_remote_get($url);
        $object = 'Confirmation de votre inscription';
        $msg = 'Vous êtes maintenant inscrit';
        wp_mail($user_email, $object, $msg);
        wp_safe_redirect(esc_url(home_url()));
	exit;
	endif;

endif;

//Login form validation

if ( isset( $_POST['login-submit'] ) ):

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

//Forgotten password form validation

if (isset($_POST['forgot-submit'])):
	$user_login = $_POST['forgot-login'];
	$user_email = $_POST['forgot-email'];
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